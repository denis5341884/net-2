$(document).ready( function () {
    var table = $('#example').DataTable({
  
      ajax: 'https://dev.kiosk4school.be/admin/checkins/json.txt',
      columns: [
          { data: 'naam' },
          { data: 'klas' },
          { data: 'status' },
          { data: 'tijdregistratie' },
      ],
  
      rowCallback: function (data) {
        if (data[2] === 'Afwezig') {
          $(row).addClass('green');
        }
        else {
          $(row).addClass('red');                            
        }                               
                    }    
  
    });
  } );