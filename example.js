$(document).ready(function(){
    // Shows JSON in nice popup
    function showFormJson(json) {
        var jsonText = JSON.stringify(json, null, "    ");        
        $('#popup')
            .empty()
            .append( "<h3>Result of <code>$(<THE_FORM>).jqDynaForm('get')</code></h3>" )
            .append( $('<pre></pre>').append(jsonText) )
            .dialog({
                title: "JSON representation of the form",
                width: 600,
                height: 500
            });      
    }

    // Simple form demo
    $('#smallForm').jqDynaForm();
    $('#smallForm').jqDynaForm('set', smallJson);
    $('#saveSmallForm').click(function(){    
        var json = $('#smallForm').jqDynaForm('get');    
        showFormJson(json);          
    });        
    
    // Complicated form demo
    $('#bigForm').jqDynaForm();
    $('#bigForm').jqDynaForm('set', bigJson);
    $('#saveBigForm').click(function(){    
        var json = $('#bigForm').jqDynaForm('get');    
        showFormJson(json);          
    });
});
		 