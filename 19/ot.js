function customizeToolbar(toolbar) {
    var tabs = toolbar.getTabs();
    toolbar.getTabs = function () {
            delete tabs[0];
            delete tabs[1];
            delete tabs[2];
            delete tabs[7];
        return tabs;
    }
}

function getJSONData() {
    return [{
        "Category": {
            type: "level",
            hierarchy: "Food"
        },
        "Item": {
            type: "level",
            hierarchy: "Food",
            level: "Dish",
            parent: "Category"
        },
        "Serving Size": {
            type: "level",
            hierarchy: "Food",
            level: "Size",
            parent: "Dish"
        },
        "Calories": {
            type: "number"
        },
        "Calories from Fat": {
            type: "number"
        }
    },
    {
        "Category": "Breakfast",
        "Item": "Frittata",
        "Serving Size": "4.8 oz (136 g)",
        "Calories": 300,
        "Calories from Fat": 120
    }];
} 

function updateDataCSV() {
    webdatarocks.updateData({
      filename: 'https://cdn.webdatarocks.com/data/data.csv'
    });
  }

function setOption(option, value) {
    webdatarocks.setOptions({
        grid: {
            [option]: value
        }
    });
    webdatarocks.refresh();
}

function open_ot(){
    var pivot = new WebDataRocks({
    container: "#wdr-component",
    toolbar: true,
    beforetoolbarcreated: customizeToolbar,
    report: {
        dataSource: {
            data: getJSONData()
        }
    },
    global: {
        localization: "ru.json",
        configuratorButton: true,
    },
    cellclick: function(cell) {
        alert("Click on cell - row: " +
            cell.rowIndex + ", column: " +
            cell.columnIndex +
            ", label: " +
            cell.label);
    }
    });
}