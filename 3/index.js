var myList = [{ "name": "abc", "age": 50, "hobby": "lissen" },{ "name": "dfg", "age": 25, "hobby": "swimming" },{ "name": "xyz", "age": 50, "hobby": "programming" }];

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
