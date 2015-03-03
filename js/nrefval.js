function txtOnly(e) {
	var a = 65;
	var z = 90;
	var funckeyS = 8;
	var funckeyE = 46;
	if (e.which < a || e.which > z) {
		if (e.which < funckeyS || e.which > funckeyE) {
			e.preventDefault();
		};
	};
}

function check0(selector1, msgError){
	
	// Se agarra el valor del selector
	var sel_val = $(selector1).val();
	var msgError = msgError;

	// Si no se carga un archivo.
	/*if ($(selector1).attr('type')=='file') {
		
	};*/

	// Si el contenido del valor es menor a 0
	if (sel_val.length == 0) {
		// Creo un mensaje de error
		var msg = msgError;

		// Quito el # de jQuery del input
		for (var i = 0; i < selector1.length; i++) {
			var sel_id = selector1.substr(1, i);
		};

		// Sel_class '#div+ nombre del input'
		var sel_class = '#div'+sel_id;

		// Si existe una clase exito, se remueve
		if ($(selector1).hasClass('exito')) {
			$(selector1).removeClass('exito');
		};

		// Y se agrega una clase error
		$(sel_class).addClass('has-error');
		$(selector1).addClass('error');
		$('#sbmt').addClass('disabled');

		// Se agrega un tooltip con el mensaje error
		//$(selector1).tooltip('destroy');
		$(selector1).tooltip({
			title: msg
		});
		$(selector1).tooltip('show');

	// Si el contenido del valor es mayor a 0
	} else {

		// Quito el # de jQuery del input
		for (var i = 0; i < selector1.length; i++) {
			var sel_id = selector1.substr(1, i);
		};

		// Sel_class '#div+ nombre del input'
		var sel_class = '#div'+sel_id;

		// Creo un msg OK
		//var msg = 'Ok';

		// Si existe una clase con error, se remueve y se añade una de exito
		if ($(sel_class).hasClass('has-error')) {
			$(sel_class).removeClass('has-error')
			$('#sbmt').removeClass('disabled')
		}
		// Se destruye el tooltip del input
		$(selector1).tooltip('destroy');

		//Se agrega un tooltip con el msg OK
		/*$(selector1).tooltip({
			title: msg
		});
		$(selector1).tooltip('show');*/

		//Agrego clases de exito
		$(sel_class).addClass('has-success');
		$(selector1).addClass('exito');
		$('#sbmt').removeClass('disabled')
		// Si todo salio bien, devuelvo 10.
			return 10;
	};
};

$(document).ready(function(){
	onlyNumber($('#tel1'), $('tel2'), $('tel3'));
	$('#nom').focusout(function(){
		check0('#nom', 'Error: Introduzca un nombre');
	});
	$('#ape').focusout(function(){
		check0('#ape', 'Error: Introduzca un apellido');
	});
	$('#tel1').focusout(function(){
		check0('#tel1', 'Error: Introduzca N# celular');
	});
	$('#nom').keydown(function(e){
		txtOnly(e);
	});
	$('#ape').keydown(function(e){
		txtOnly(e);
	});
	$('#sbmt').click(function(e){
		var nom, ape, tel1;
		nom = $('#nom').val();
		ape = $('#ape').val();
		tel1 = $('#tel1').val();		
		if (nom.length > 2) {
			console.log('clickeo');
			//$('#sbmt').click();
		} else {
			e.preventDefault();
		}
	});
});