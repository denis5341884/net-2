
function ii(){
    input = document.createElement("input");
		
    input.type = "datetime-local";
    input.style.padding = "4px";
    input.style.width = "100%";
    input.style.boxSizing = "border-box";
}


//define column header menu as column visibility toggle
var headerMenu = function(){
    var menu = [];
    var columns = this.getColumns();

    for(let column of columns){

        //create checkbox element using font awesome icons
        let icon = document.createElement("i");
        icon.classList.add("fas");
        icon.classList.add(column.isVisible() ? "fa-check-square" : "fa-square");

        //build label
        let label = document.createElement("span");
        let title = document.createElement("span");

        title.textContent = " " + column.getDefinition().title;

        label.appendChild(icon);
        label.appendChild(title);

        //create menu item
        menu.push({
            label:label,
            action:function(e){
                //prevent menu closing
                e.stopPropagation();

                //toggle current column visibility
                column.toggle();

                //change menu item icon
                if(column.isVisible()){
                    icon.classList.remove("fa-square");
                    icon.classList.add("fa-check-square");
                }else{
                    icon.classList.remove("fa-check-square");
                    icon.classList.add("fa-square");
                }
            }
        });
    }

   return menu;
};

//create header popup contents
var headerPopupFormatter = function(e, column, onRendered){
    var container = document.createElement("div");

    var label = document.createElement("label");
    label.innerHTML = "Filter Column:";
    label.style.display = "block";
    label.style.fontSize = ".7em";

    var input = document.createElement("input");
    input.placeholder = "Filter Column...";
    input.value = column.getHeaderFilterValue() || "";

    input.addEventListener("keyup", (e) => {
        column.setHeaderFilterValue(input.value);
    });

    container.appendChild(label);
    container.appendChild(input);

    return container;
}

//create dummy header filter to allow popup to filter
var emptyHeaderFilter = function(){
    return document.createElement("div");;
}

//define data
var tabledata = [
    {id:1, OB:"Обьект 111-111", A:12, MU:"male", T:"Основной", AP:1100 },
    {id:2, OB:"Обьект 222-222", A:1, MU:"female", T:"Основной Т", AP:1200 },
    {id:55, OB:"Обьект 333-333", A:42, MU:"female", T:"Основной Т", AP:1200 },
    {id:4, OB:"Обьект 444-444", A:100, MU:"male", T:"Основной Т", AP:1200 },
    {id:5, OB:"Обьект 555-555", A:16, MU:"female", ratTing:5, T:"Основной Т", AP:1200},
];

//var tabledata = [{}];

//Build Tabulator
var table = new Tabulator("#example-table", {
    height:"600px",
    layout:"fitColumns",
    movableColumns:true,
    reactiveData:true, 
    pagination:"local",
    paginationSize:10,
    paginationSizeSelector:[10, 20, 50, 100],
    paginationCounter:"rows",
    printAsHtml:true,
    printHeader:"<h1>Example Table Header<h1>",
    printFooter:"<h2>Example Table Footer<h2>",
    scrollToRowIfVisible: false,
    selectable:1,
    data:tabledata,
    columns:[
        //{title:"Name", field:"name", sorter:"string", width:200, headerMenu:headerMenu},
        {title:"Обьект", field:"OB", width:300, sorter:"string", headerMenu:headerMenu, headerPopup:headerPopupFormatter, headerPopupIcon:"<i class='fas fa-filter' title='Filter column'></i>", headerFilter:emptyHeaderFilter, headerFilterFunc:"like"},
        {title:"", field:"A", sorter:"number", width:100, headerMenu:headerMenu},
        {title:"Место установки", width:500, field:"MU", sorter:"string", headerMenu:headerMenu},
        {title:"Тариф", field:"T", width:300, hozAlign:"center", sorter:"string", headerMenu:headerMenu},
        {title:"АП", field:"AP", sorter:"number", headerMenu:headerMenu},
    ]
});

//add row to bottom of table on button click
document.getElementById("reactivity-add").addEventListener("click", function(){
    //tabledata.push({name:"IM A NEW ROW", progress:100, gender:"male"});
    table.addRow({name:"IM A NEW ROW", progress:100, gender:"male"});

});

//remove bottom row from table on button click
document.getElementById("reactivity-delete").addEventListener("click", function(){
    table.replaceData("/data.php");
});

//update name on first row in table on button click
document.getElementById("reactivity-update").addEventListener("click", function(){
    tabledata[0].name = "IVE BEEN UPDATED";
    alert("hhhhhh");
});

//update name on first row in table on button click
document.getElementById("rrt").addEventListener("click", function(){
    var selectedData = table.getSelectedData();
    console.log(selectedData);
    alert(JSON.stringify(selectedData));
});

//update name on first row in table on button click
document.getElementById("wer").addEventListener("click", function(){
    
    console.log('hello');

});