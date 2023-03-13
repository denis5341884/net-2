function data_array(){
    var arr=[
    {
        field: 'state',
        checkbox: true,
        class: "success"
    },  
    {
        field: 'id',
        title: 'Item ID',
        sortable: true,
        class: "success",
        visible: false
    }, {
        field: 'name',
        title: 'Item Name',
        sortable: true,
        class: "success"
    }, {
        field: 'price',
        title: 'Item Price',
        sortable: true,
        class: "success"
    }, {
        field: 'operate',
        title: 'Item Price',
        formatter: 'operateFormatter',
        events: 'operateEvents',
        clickToSelect: false
    }];
    return arr;
}

function data_array2(){
    var arr=[
    {
        field: 'id',
        title: 'Item ID',
        sortable: true,
        class: "success",
        visible: false
    }, {
        field: 'name',
        title: 'Item Name',
        sortable: true,
        class: "success"
    }, {
        field: 'price',
        title: 'Item Price',
        sortable: true,
        class: "success"
    }];
    return arr;
}

window.operateEvents = {
    'click .like': function (e, value, row, index) {
      alert('You click like action, row: ' + JSON.stringify(row))
    },
    'click .remove': function (e, value, row, index) {
        rClick(e, value, row, index);
    }
  }

function detailFormatter(index, row) {
    var html = []
    $.each(row, function (key, value) {
      html.push('<p><b>' + key + ':</b> ' + value + '</p>')
    })
    return html.join('')
  }

function headerStyle(column) {
return {
    id: {
    classes: 'w3-dark-grey'
    },
    name: {
    classes: 'w3-dark-grey'
    },
    price: {
    classes: 'w3-dark-grey'
    }
}[column.field]
}

function queryParams(params) {
    params.search = 8
    return params
  }

function rowAttributes(row, index) {
return {
    'data-toggle': 'popover',
    'data-placement': 'bottom',
    'data-trigger': 'hover',
    'data-content': [
    'Index: ' + index,
    'ID: ' + row.id,
    'Name: ' + row.name,
    'Price: ' + row.price
    ].join(', ')
}
}

function rowStyle(row, index) {
    var classes = [
      'bg-blue',
      'bg-green',
      'bg-orange',
      'bg-yellow',
      'bg-red'
    ]

    if (index % 2 === 0 && index / 2 < classes.length) {
      return {
        classes: classes[index / 2]
      }
    }
    return {
      css: {
        color: 'blue'
      }
    }
  
}

function operateFormatter(value, row, index) {
return [,
    '<input class="w3-button w3-dark-grey w3-hover-lime" type="button" value="+"></input>',
    '<input class="remove" type="button" value="-"></input>'
].join('')
}

function wClick(e, value, row, index){
    alert('You click like action, row: ' + JSON.stringify(row))
}

function rClick(e, value, row, index){
    $('#id_table').bootstrapTable('remove',
                            {
                                field: 'id',
                                values: [row.id]
                            }
                            )
}

function InsertRow(){
    var randomId = 100 + ~~(Math.random() * 100)
    $('#id_table').bootstrapTable('insertRow', {
    index: 19999,
    row: {
        id: randomId,
        name: 'SDD ' + randomId,
        price: '$' + randomId
    }
    })

}

function exportTable(){
    $('#id_table').bootstrapTable('destroy').bootstrapTable({
        exportDataType: $(this).val(),
        exportTypes: [ 'csv', 'txt', 'excel', 'pdf'],
        columns: data_array2()
      })
}

function ddd(idt,idtl){
    $('#'+idt).bootstrapTable({
        id: idt,
        locale: 'ru-RU',
        toolbar: '#'+ idtl,
        toggle: idt,
        search: true,
        height:'800',
        url: 'data2.json',
        headerStyle:'headerStyle',
        minimumCountColumns: 1,
        queryParams:"queryParams",
        method:"get",
        rememberOrder: true,
        rowAttributes:"rowAttributes",
        rowStyle: "rowStyle",
        searchHighlight: true,
        showcolumns:true,
        showButtonIcons: true,
        showRefresh: true,
        singleSelect: true,
        clickToSelect: true,
        showColumnsToggleAll: true,
        showExport: true,
        showColumns: true,
        resizable: true,
        reorderablecolumns:true,
        useRowAttrFunc:true,
        reorderableRows:true,
        columns: data_array()
      })
}
