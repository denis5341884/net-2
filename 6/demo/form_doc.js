var ejfStyle = net_css;//ejfBootstrapStyle; //Imported from 'easyjsonform-bootstrap.js'
var sampleEasyJsonForm;
var sampleEasyJsonFormOptions = {
    disabled: false,
    formContainer: 'form',
    formAction: null,
    formMethod: null,
    onStructureChange: () => {},
    onValueChange: () => {},
};
var rt=true;

function open_struc(sd){
    let str=[];
    if (rt){
        str = [
            {
                "type": "text",
                "label": "Новое Текстовое поле 1",
                "customattribute": "11111",
                "mandatory": false,
                "properties": {
                    "lengthmeasurement": "no",
                    "lengthmax": 0,
                    "lengthmin": 0,
                    "multiline": false
                },
                "value": ""
            },
            {
                "type": "number",
                "label": "Новое Числовое поле 1",
                "customattribute": "2222222",
                "mandatory": false,
                "properties": null,
                "value": ""
            },
            {
                "type": "date",
                "label": "Новое Дата 1",
                "customattribute": "33333333",
                "mandatory": false,
                "properties": null,
                "value": null
            }
        ];
        rt=false;
    }else
    {
        //sampleEasyJsonForm.formUpdate();
        str=sampleEasyJsonForm.structureExport();
    }
    console.log(str);
    return str;
}

function open_form(b_or_f){
    //build false
    //form true
    str=open_struc(!b_or_f);
    sampleEasyJsonForm = new EasyJsonForm('form_doc', str, ejfStyle, sampleEasyJsonFormOptions);
    if (b_or_f)
    {
        document.querySelector('#form').appendChild(sampleEasyJsonForm.formGet());
    }
    else
    {
        document.querySelector('#form').appendChild(sampleEasyJsonForm.builderGet());
    }
}

