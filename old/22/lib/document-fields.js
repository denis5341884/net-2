//@ts-check
const TxtStyle = require("./txt-style");

/**
 * @class
 * @summary Класс хранит в себе поля с определенным стилем
 * @description В версии 1.0.0 обладает рядом непонятных моментов в конструкторе, используется только несколько полей
 * @since 1.0.0
 * @copyright Все права за @Irik1 и @GnomGad 2021
 */
class DocumentFields
{
    /**
     * Конструктор класса
     * @constructor
     * @default
     * @param {string} name Название поля
     * @param {string} value Значение поля
     * @param {TxtStyle} style Стиль элементов
     * @param {number} valueMaxLen Максимальная длина элементов
     * @param {number} type Тип положения 0 - Normal, 1 - Vertical, 2 - Horizontal
     * @param {number} rowHeight Высота строки
     */
    constructor(name = "",value = "", style = new TxtStyle(), valueMaxLen = 0, type = 1,rowHeight = null) {
        if (name == null)
            this.name = "";
        else this.name = name;
        if (value != null && (valueMaxLen === 0 || value.length <= valueMaxLen))
            this.value = value;
        this.value = value;
        this.style = style;
        this.valueMaxLen = valueMaxLen;
        this.type = type;
        this.rowHeight = rowHeight;
    }

    /**
     * Вернуть объект запаршенный
     * @function
     * @returns {JSON} возвращает JSON копию объекта
     */
    Copy()
    {
        return JSON.parse(JSON.stringify(this));
    }

}
module.exports = DocumentFields;