// Enviar por AJAX.
/*function enviar(){
    // Nombre de los inputs
    var inputs = [];
    // Valores de los inputs
    var inputs_val = [];
    for (var i = 0; i < arguments.length; i++) {
        // Guarda los inputs
        inputs[i] = arguments[i];
        // Guarda los valores
        inputs_val[i] = $(arguments[i]).val();
    };
    /*console.log('inputs count: '+arguments.length);
    console.log('inputs: '+inputs);
    console.log('val inputs: '+inputs_val);
    $.post(
        'f5data.php',
        {
            inputs: inputs,
            inputs_val: inputs_val
        },
        function(data) {
            if (data == 0) {
                alert('No hay registros en esa fecha.');
            } else {
                if (data) {
                    console.log(data);
                    
                    //$('#divsubmit').addClass('alert alert-success');
                    //$('#divsubmit').html(data);
                    //$('#divsubmit').append(data);
                    $('.removeme').remove();
                    $('#tabla').append(data);
                }
            };
        }
        );
};*/

// Date picker
$(function() {
    $( "#fecha" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
});
// /Date picker

// Cuando cambia la fecha
//var fecha;
/*function cambio(fecha) {
    console.log('Se envio la fecha: ' + fecha);
    enviar(fecha);
}
$("#fecha").change(function(){
    enviar('#fecha', '#own', '#rol');
    console.log('se envio');
});*/