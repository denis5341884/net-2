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
                "type": "textgroup",
                "label": "Новое Группа текста 1",
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

