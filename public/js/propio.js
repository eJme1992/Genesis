$(document).ready(function(){
      	//Eliminar alertas que no contengan la clase alert-important luego de 7seg
      	// $('div.alert').not('.alert-important').delay(7000).slideUp(300);

  	//activar Datatable
    $('.data-table').DataTable({
      responsive: true,
      language: {
      	url:'{{asset("plugins/datatables/spanish.json")}}'
      }
    });

    // file input para imagenes
    $("#file_input").fileinput({
      'showUpload': false,
      'previewFileType':'any',
      'allowedFileTypes': ["image"],
      'allowedFileExtensions': ["jpg", "gif", "png"],
      'elErrorContainer': "#errorBlock",
      'maxFilePreviewSize': 5000,
      'browseClass': "btn btn-primary btn-block"
    });

    // datapicker español
    $.datepicker.regional['es'] = {
     closeText: 'Cerrar',
     prevText: '< Ant',
     nextText: 'Sig >',
     currentText: 'Hoy',
     monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
     monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
     dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
     dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
     dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
     weekHeader: 'Sm',
     dateFormat: 'dd/mm/yy',
     firstDay: 1,
     isRTL: false,
     showMonthAfterYear: false,
     yearSuffix: ''
     };

    $.datepicker.setDefaults($.datepicker.regional['es']);

    // datapicker
    $(".fecha").datepicker();
    
    // numeric
    $('.numero').numeric();
    $(".int").numeric({ 
      decimal: false, 
      negative: false 
    }, function() { 
      alert("Ingrese solo numeros"); 
      this.value = ""; 
      this.focus(); 
    });

    // number format
    $('.nf').inputNumberFormat({
      'decimal': 2,
      'decimalAuto': 2,
      'separator': '.',
      'separatorAuthorized': [',']
    });
});