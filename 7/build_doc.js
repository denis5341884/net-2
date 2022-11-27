function open_doc(){


    <fieldset>
    <legend>PopulateJS</legend>
        <label class="form-label" for="last_name">Last name</label>&nbsp;
        <input type="text" name="last_name" id="last_name">
        <label class="form-label" for="date_n">Last name</label>&nbsp;
        <input type="date" name="date_n" id="date_n">
        <label class="form-label" for="last_name_aa">Last name</label>&nbsp;
        <input type="text" name="last_name_aa" id="last_name">
    <br>

    var myjson=[
        {
            "type": "fieldset",
            "label": "PopulateJS",
            "class":""
        },
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




}