//Сюда добавляем методы для конвертации в ПДФ и ДБФ
const Convert = require("./lib/convert");
const DocFields = require("./lib/document-fields");
const fs = require('fs');
var path = require('path');
const PDFMerger = require('pdf-merger-js');

exports.ConvertPDF = function (request, response) {
    let type = request.body.type;
    let data = request.body.data;
    let convertData = [];
    let i = 0;
    let app = this;
    let res = response;
    let complex = false;
    db.models.Form.findAll({limit: 1,where: {FormSymbName: type},  }).then(async function(entries){
        await db.query(`
        SELECT * from "Characteristics"
        where "Characteristics"."FormId" = ` + entries[0].dataValues.Id + ` order by "Characteristics"."Id"`
        ).then(async function(result){
            result[0].forEach(el => {
                let temp = new DocFields(
                    el.Characteristic,
                    data[i],
                    null,
                    null,
                    null,
                    null,
                    el.Flag,
                    null
                )
                if (!el.Flag)
                    complex = true;
                convertData.push(temp);
                console.log(i +` ${el.Characteristic} ${ data[i]}`);
                i++;

            });

            if (complex == true)
            {
                ComplexPDF(request,convertData,res);
            }
            else
            {
                const [formData, metadata] = await db.query(`
                        select "Document_url" from "Documents"
                            join "FormTemplates" on "FormTemplates"."FileId" =  "Documents"."Id"
                            where "FormTemplates"."FormSymbolId" = '${type}'`);
                let tmpPath = formData[0].Document_url;
                let mainPath = process.cwd();
                let file = path.join(mainPath,tmpPath );
                let pdfpath = path.join(mainPath, "/backend/pdfconvert/pdf");
                let convertClass = new Convert(convertData, file, pdfpath,pdfpath,type);
                await convertClass.FillPDF().then(function(filePath){
                    checkExistsWithTimeout(filePath[0],100000).then(function(result){
                        app.get('/api/download/' + filePath[1], (req, res) => {
                            res.download(filePath[0]);
                        });
                        // fs.unlinkSync(filePath);
                        res.json(filePath);
                    })
                });
            }
        });
    }); 
};

async function ComplexPDF(request,convertData,res)
{
    console.log(convertData);
    let type = request.body.type;
    let filename = type + "_p2.docx";
    let count = Object.keys(convertData[convertData.length-1].value).length;
    //создаем новую страницу и добавляем ее
    if (count > 5)
    {

        const delay = ms => new Promise(resolve => setTimeout(resolve, ms))
        var merger = new PDFMerger();
        let tables = [];
        let TableCount = [];
        //делаем как обычно
        let file = path.join(__dirname, "../pdfconvert/templates/" + type + ".docx");
        let pdfpath = path.join(__dirname, "/../pdfconvert/pdf");
        let convertClass = new Convert(convertData, file, pdfpath,pdfpath,type);
        await convertClass.FillPDF().then(function(filePath){
                checkExistsWithTimeout(filePath[0],100000).then(function(result){
                        console.log(filePath[0]);
                        merger.add(filePath[0]);
                    })
                });




        var i,j,temparray,chunk = 5;
        for (i=0,j=count; i<j; i+=chunk) {
            temparray = convertData[convertData.length-1].value.slice(i,i+chunk);
            tables.push(temparray);
        }
        tables.forEach(async el => {
            await delay(1000);
            let file = path.join(__dirname, "../pdfconvert/templates/" + filename);
            let pdfpath = path.join(__dirname, "/../pdfconvert/pdf");
            let convertClass = new Convert(convertData, file, pdfpath,pdfpath,type);
            await convertClass.FillPDF().then(function(filePath){
                checkExistsWithTimeout(filePath[0],100000).then(function(result){
                    console.log(filePath[0]);
                    merger.add(filePath[0]);
                })
            });
        })
        let dat = new Date().getTime();
        let name = type + "_" + dat + ".pdf";
        await merger.save(path.join(__dirname, "/../pdfconvert/pdf/" + name));
        let pathFile = [];
        pathFile[0] = path.join(__dirname, "/../pdfconvert/pdf/" + name);
        pathFile[1] = type + "_" + dat;
        return pathFile
    }
    else
    {
        console.log("Its okay!");
        //делаем как обычно
        let file = path.join(__dirname, "../pdfconvert/templates/" + type + ".docx");
            let pdfpath = path.join(__dirname, "/../pdfconvert/pdf");
            let convertClass = new Convert(convertData, file, pdfpath,pdfpath,type);
            await convertClass.FillPDF().then(function(filePath){
                checkExistsWithTimeout(filePath[0],100000).then(function(result){
                    // app.get('/api/download/' + filePath[1], (req, res) => {
                    //     res.download(filePath[0]);
                    // });
                    // // fs.unlinkSync(filePath);
                    // res.json(filePath);
                    return filePath[1];
                })
            });
    }
};

function checkExistsWithTimeout(filePath, timeout) {
    return new Promise(function (resolve, reject) {

        var timer = setTimeout(function () {
            watcher.close();
            reject(new Error('File did not exists and was not created during the timeout.'));
        }, timeout);

        fs.access(filePath, fs.constants.R_OK, function (err) {
            if (!err) {
                clearTimeout(timer);
                watcher.close();
                resolve();
            }
        });

        var dir = path.dirname(filePath);
        var basename = path.basename(filePath);
        var watcher = fs.watch(dir, function (eventType, filename) {
            if (eventType === 'rename' && filename === basename) {
                clearTimeout(timer);
                watcher.close();
                resolve();
            }
        });
    });
};