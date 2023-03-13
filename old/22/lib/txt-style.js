//@ts-check

/** 
 * 
 * @class
 * @summary Класс отвечающий за хранение в себе стиля текста
 * @description На данный момент этот класс не применим в реальном использовании,
 * в будущем его нужно будет задейтсвовать
 * @since 1.0.0
 * @copyright Все права за @Irik1 и @GnomGad 2021
*/
class TxtStyle
{
    /**
     * Конструктор класса
     * @constructor
     * @default
     * @param {string} fontName Название шрифта Time New Romans
     * @param {number} fontSize Размер шрифта
     * @param {number} fontSealing Уплотнение шрифта
     * @param {number} paragraphIndent значение отступа
     * @param {boolean} isMultiline Допустим ли перенос текста в ячейке таблицы
     * @param {number} cellWidth Ширина ячейки таблицы
     */
    constructor(fontName = "Times New Roman",fontSize = 10,fontSealing = 0,paragraphIndent = 0,isMultiline = false,cellWidth = 0) {
        this.fontName = fontName;
        this.fontSize = fontSize;
        this.fontSealing = fontSealing;
        this.paragraphIndent = paragraphIndent;
        this.isMultiline = isMultiline;
        this.cellWidth = cellWidth;
    }
}

module.exports = TxtStyle;  