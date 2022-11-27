var ejfStyle = ejfBootstrapStyle; //Imported from 'easyjsonform-bootstrap.js'
var sampleEasyJsonForm;
var sampleEasyJsonFormOptions = {
    disabled: false,
    formContainer: 'form',
    formAction: null,
    formMethod: null,
    onStructureChange: () => {},
    onValueChange: () => {},
};

function open_struc(sd){
    let str=[];
    if (sd){
        str = [
            {
                "type": "text",
                "label": "New Text 1",
                "customattribute": "",
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
                "type": "textgroup",
                "label": "New Text group 1",
                "customattribute": "",
                "mandatory": false,
                "properties": {
                    "items": [
                        1,
                        2,
                        3
                    ]
                },
                "value": [
                    "",
                    "",
                    ""
                ]
            },
            {
                "type": "singlechoice",
                "label": "New Single choice 1",
                "customattribute": "",
                "mandatory": false,
                "properties": {
                    "items": [
                        1,
                        2,
                        3
                    ]
                },
                "value": null
            }
        ];
        sd=false;
    }else
    {
        str=sampleEasyJsonForm.structureExport();
    }
    return str;
}

function open_form(b_or_f){
    //build false
    //form true
    str=open_struc(!b_or_f);
    sampleEasyJsonForm = new EasyJsonForm('sample', str, ejfStyle, sampleEasyJsonFormOptions);
    if (b_or_f)
    {
        document.querySelector('#form').appendChild(sampleEasyJsonForm.formGet());
    }
    else
    {
        document.querySelector('#form').appendChild(sampleEasyJsonForm.builderGet());
    }
}

