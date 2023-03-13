const Convert = require("./lib/convert");
const DocFields = require("./lib/document-fields");
const fs = require('fs');
var path = require('path');
const PDFMerger = require('pdf-merger-js');
const cov = require('convert-multiple-files');


var BASIC = {
    type:'1',//Тип формы
    data:[],// Данные
    convertData:[
        'Hello',
        'My friend',
        '0952283221',
        '388-22-11',
        'lol@mail.ru',
    ],
    characteristic:[
        'chWhSl_p',
        'chWhSl_y',
        'tel',
        'fax',
        'e_mail',
    ],

    //данные заполнения
    folder:path.join(process.cwd(),'test','templates')
};



async function ConvertToPDF(){
    let type = BASIC.type;
    let data = BASIC.characteristic;
    let fields = [];
    let i =0;
    BASIC.convertData.forEach(el=>{
        let temp = new DocFields(data[i],el)
        i++;
        fields.push(temp);
    });
    let convertClass = new Convert(fields, 
        path.join(BASIC.folder, BASIC.type+".docx") , 
        BASIC.folder,
        BASIC.folder,type);
        await convertClass.FillPDF().then(function(fpath){
            checkExistsWithTimeout(fpath[0],100000).then(function(result){
                
                        // fs.unlinkSync(filePath);
                console.log(fpath);
            }).catch((er)=>{
                console.log(er);
            });
        });
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

const http = require("http");
http.createServer(function(request,response){
}).listen(3000, "127.0.0.1",function(){
    ConvertToPDF()

});