//@ts-check

const DocumentFields = require('./document-fields');

var fs = require('fs');
var path = require('path');
const temp = require('easy-template-x');
const cov = require('convert-multiple-files');



/** Класс конвертации в пдф, хранит в себе стили, строки и пути
 * @class
 * @summary Класс конвертации в пдф
 * @since 1.0.0
 * @copyright Все права за @Irik1 и @GnomGad 2021
 */
class ConvertToPDF {
  /**
   * @default
   * @param {DocumentFields[]} documentFields Объект с полями для заполнения
   * @param {string} templatePath Полный путь к файлу с шаблоном для заполнения
   * @param {string} PDFPath Полный путь к папке или файлу для сохранения
   * @param {string} docSavePath Полный путь к временному файлу, либо null
   * @param {string} fileName Название файла, будет использоваться в качестве приставки во всех файлах
   */
  constructor(documentFields, templatePath, PDFPath, docSavePath=null, fileName) {
    if(!documentFields || !templatePath || !PDFPath || !fileName){
      throw new Error("Неверный тип аргумента")
    }
    this.documentFields = documentFields;
    this.templatePath = templatePath;
    this.PDFPath = PDFPath;
    this.docSavePath = docSavePath;
    this.fileName = fileName;
  }

  /**
   * @summary Заполнение шаблона Word и конвертация его в pdf
   * @description Реализация слишком сложна, возможно стоит упростить и модуль свой юзать
   * @async
   * @function
   * @returns {Promise<string[]>} путь к файлу и название файла
   */
  async FillPDF() {
    let names = this.#initializationNames();
    let data = this.#initializationFields();

    const templateFile = fs.readFileSync(this.templatePath);
    const handler = new temp.TemplateHandler();
    const doc = await handler.process(templateFile, data);
    fs.writeFileSync(names["fileTMPNameWord"], doc);

    const pathOutput = await cov.convert(
      names["fileTMPNameWord"],
      names["ext"],
      names["folder"],
    ).catch((er)=>{
      console.log('er:: '+er);
    });
    fs.unlinkSync(names["fileTMPNameWord"]);
    return [pathOutput, names["nameFile"]];
  }
  
  /**
   * Формирует словарь значений для работы с путями и возвращает его
   * @returns {{}}
   */
  #initializationNames() {
    let extTemplateFile = path.extname(this.templatePath);
    let extPDFFile = path.extname(this.PDFPath);
    let namePDFFile = path.basename(this.PDFPath);
    let isFolderPDF = false;

    //если шаблон неподходящий, то мы его не можем прочитать
    if(!extTemplateFile.match(/\.(doc|docx|odt)$/)){
      throw new Error('Невозможно прочитать шаблон');
    }

    // если фай не имеет расширения, значит это папка
    if(!extPDFFile.match(/(pdf)$/)){
      if(!namePDFFile){
        throw new Error('Невозможно сохранить конвертацию по указанному пути');
      }
      else{
        isFolderPDF = true;
      }
    }
    
    if(!this.docSavePath){
      this.docSavePath = ''
    }
    // сформировать список с путем 
    let info = {};
    info["milliseconds"] = new Date().getTime(); // время
    info["nameFile"] = this.fileName + info["milliseconds"]; // название файла без расширения
    info["fileTMPNameWord"] = info["nameFile"]+'.'+extTemplateFile;
    info["folder"] = isFolderPDF? this.PDFPath : path.dirname(this.PDFPath);
    info["ext"] = isFolderPDF? 'pdf': extPDFFile;
    return info;
  }

  /**
   * Берет из полей данные и выдает их в словаре
   * @returns {{}}
   */
  #initializationFields(){
    let data = {};
    this.documentFields.forEach((el) => {
      if (el.type) data[el.name] = el.value;
    }, this);
    return data;
  }

}

module.exports = ConvertToPDF;