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

function tableToJson(tt) {
    let result = [];
    let table = document.getElementById(tt).getElementsByTagName("tbody")[0];
    let trs = table.getElementsByTagName("tr");
    for (let i = 1; i < trs.length; i++) {
      let tds = trs[i].getElementsByTagName("td");
      let obj = {};
        obj.name = tds[0].innerHTML;
        obj.rank = tds[1].innerHTML;
        obj.phone = tds[2].innerHTML;
        result.push(obj);
    }
    console.log(JSON.stringify(result));
  }

  function html2json(tt) {
    var json = '{';
    var otArr = [];
    var tbl2 = $('#'+tt+' tr').each(function(i) {        
       x = $(this).children();
       var itArr = [];
       x.each(function() {
          itArr.push('"' + $(this).text() + '"');
       });
       otArr.push('"' + i + '": [' + itArr.join(',') + ']');
    })
    json += otArr.join(",") + '}'
 
    console.log(json);
    //return json;
 }

 function tableToJSON2(tt) {
    var table=document.getElementById(tt);
    var obj = {};
    var row, rows = table.rows;
    for (var i=0, iLen=rows.length; i<iLen; i++) {
      row = rows[i];
      obj[row.cells[0].textContent] = row.cells[1].textContent
    }
    //return JSON.stringify(obj);
    console.log(JSON.stringify(obj));
  }