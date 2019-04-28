$(document).ready(function(){
  	//activar Datatable
    $('.data-table').DataTable({
      responsive: true,
      lenguaje: {
        url: 'plugins/datatables/spanish.json'
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
    $(".fecha").datepicker({
      changeMonth: true,
      changeYear: true
    });

    // numeric
    $('.numero').numeric();
    
    $(".int").numeric({
      decimal: true,
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

    // select2
    $('.select2').select2({
      language: {
        noResults: function() {
          return "Sin resultados";
        },
        searching: function() {
          return "Buscando..";
        }
      }
    });

});
