//var myList = [{ "name": "abc", "age": 50, "hobby": "lissen" },{ "name": "dfg", "age": 25, "hobby": "swimming" },{ "name": "xyz", "age": 50, "hobby": "programming" }];
var myList = [
    {
        "id": "num_doc",
        "type": "number",
        "label": "Номер документа",
        "value": null,
        "onclick": null,
        "mandatory": false,
        "properties": null,
        "customattribute": ""
    },
    {
        "id": "data_doc",
        "type": "datetime",
        "label": "Дата документа",
        "value": null,
        "onclick": null,
        "mandatory": false,
        "properties": null,
        "customattribute": ""
    },
    {
        "id": "kassa_doc",
        "type": "spr",
        "label": "Касса",
        "value": "",
        "spr_id": "29",
        "onclick": "show_spr_modal(29,0,this.id)",
        "spr_vlad": null,
        "mandatory": false,
        "value_kod": "0",
        "properties": null,
        "customattribute": ""
    },
    {
        "id": "kont_doc",
        "type": "spr",
        "label": "Абонент",
        "value": "",
        "spr_id": "1",
        "onclick": "show_spr_modal(1,0,this.id)",
        "spr_vlad": null,
        "mandatory": false,
        "value_kod": "0",
        "properties": null,
        "customattribute": ""
    },
    {
        "id": "dog_doc",
        "type": "spr",
        "label": "Договор контрагента",
        "value": "",
        "spr_id": "2",
        "onclick": "show_spr_modal(2,1,this.id)",
        "spr_vlad": "1",
        "mandatory": false,
        "value_kod": "0",
        "properties": null,
        "customattribute": ""
    },
    {
        "id": "summa_doc",
        "type": "number",
        "label": "Сумма документа",
        "value": "",
        "onclick": null,
        "mandatory": false,
        "properties": null,
        "customattribute": ""
    },
    {
        "id": null,
        "type": "text",
        "label": "Примечание",
        "value": "",
        "onclick": null,
        "mandatory": false,
        "properties": {
            "lengthmax": 0,
            "lengthmin": 0,
            "multiline": false,
            "lengthmeasurement": "no"
        },
        "customattribute": ""
    }
];
// Builds the HTML Table out of myList.
function buildHtmlTable(selector) {
  var columns = addAllColumnHeaders(myList, selector);
  for (var i = 0; i < myList.length; i++) {
    var row$ = $('<tr class="w3-hover-lime"/>');
    for (var colIndex = 0; colIndex < columns.length; colIndex++) {
      var cellValue = myList[i][columns[colIndex]];
      if (cellValue == null) cellValue = "";
      row$.append($('<td/>').html(cellValue));
    }
    $(selector).append(row$);
  }
}
// Adds a header row to the table and returns the set of columns.
// Need to do union of keys from all records as some records may not contain
// all records.
function addAllColumnHeaders(myList, selector) {
  var columnSet = [];
  var headerTr$ = $('<tr class="w3-dark-grey" />');
  for (var i = 0; i < myList.length; i++) {
    var rowHash = myList[i];
    for (var key in rowHash) {
      if ($.inArray(key, columnSet) == -1) {
        columnSet.push(key);
        headerTr$.append($('<th/>').html(key));
      }
    }
  }
  $(selector).append(headerTr$);
  return columnSet;
}

function html2json(tt){
  var table = $('#'+tt).tableToJSON(); // Convert the table into a javascript object

  console.log(myList);
  console.log("----------------------");
  console.log(table);
}

  function html2json22(tt) {
    var json = '[';
    var otArr = [];
    var tbl2 = $('#'+tt+' tr').each(function(i) {        
       x = $(this).children();
       var itArr = [];
       x.each(function() {
          itArr.push('"' + $(this).text() + '"');
       });
       otArr.push('{' + itArr.join(',') + '}');
    })
    json += otArr.join(",") + ']'
    
    var myList = [{ "name": "abc", "age": 50, "hobby": "lissen" },{ "name": "dfg", "age": 25, "hobby": "swimming" },{ "name": "xyz", "age": 50, "hobby": "programming" }];
    
    console.log(myList);
    console.log("----------------------");
    console.log(json);
    //return json;
 }
