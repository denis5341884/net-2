function GFG_Fun(){
    $.getJSON('read.php').success(
        function(data) { // ajax-запрос, данные с сервера запишутся в переменную data
            htmlstr = '<table>';              
            for (var i=0; i<data.length; i++) {  // цикл по сотрудникам
              htmlstr += '<tr>';
              htmlstr += '<td>' + data[i].fio + '</td>';      // первая колонка - ФИО
              htmlstr += '<td>' + data[i].birthday + '</td>'; // вторая колонка - Дата рождения
              htmlstr += '</tr>';
            }
            htmlstr = '</table>';
            $('div.info').html(htmlstr); // в div с классом info выводим получившуюся таблицу с данными
        });
    
}