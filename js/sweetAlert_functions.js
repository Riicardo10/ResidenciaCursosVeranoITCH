function mensajeError(titulo, descripcion){
	swal(titulo, descripcion, 'error');
}

function mensaje(mensaje){
	swal(mensaje);
}

function mensajeDescripcion(titulo, descripcion){
	swal(titulo, descripcion);
}

function mensajeExitoso(titulo, descripcion){
	swal(titulo, descripcion, 'success');
}

function swMensajeDescripcionImagen(titulo, descripcion, img){
	swal({
		title : titulo,
		text : descripcion,
		imageUrl : img
	});
}

function swMensajeHTML(titulo, descripcion){
	swal({
		title : titulo,
		text: descripcion,
		html : true
	});
}

function swMensajeAutoCerrado(titulo, descripcion, tiempo){
	swal({
		title : titulo,
		text : descripcion,
		timer : tiempo,
		showCancelButton : false,
		showConfirmButton: false
	});
}

function cerrar(){
	swal({
		title : "",
		text : "",
		timer : 0,
		showCancelButton : false,
		showConfirmButton: false
	});
}

function swMensajeInformacion(titulo, descripcion, descripcionFinalizada){
	swal({
		title: titulo,
		text: descripcion,
		type: "info",
		showCancelButton: true,
		showConfirmButton: false,
		closeOnConfirm: false,
		showLoaderOnConfirm: true,
	},
	function(){
		setTimeout(function(){
			cerrar();
		}, 0);
	});
}


// ENTRADA DE DATOSSSSSSSSSS
function mensajeConfirmacion(titulo, descripcion){
	swal({
		title : titulo,
		text : descripcion,
		type : "warning",
		showCancelButton : true,
		confirmButtonColor : "#DD6B55",
		cancelButtonColor: '#d33',
		confirmButtonText : "Eliminar",
		cancelButtonText : "Cancelar",
		closeOnConfirm : false,
		closeOnCancel : false
	},
	function(isConfirm){
		if(isConfirm){
			swal('Eliminado', 'Eliminacion confirmada', 'success');
		}
		else{
			swal('Cancelado', 'Eliminacion cancelada', 'error');
		}
	});
}



function swEntradaDeDatos(titulo, descripcion, placeholder, msjError){
	swal({
		title: titulo,
		text: descripcion,
		type: "input",
		showCancelButton: true,
		closeOnConfirm: false,
		animation: "slide-from-top",
		inputPlaceholder: placeholder,
	},
	function(inputValue){
		if (inputValue === false)
			return false;
		if (inputValue === "") {
			swal.showInputError(msjError);
			return false
		}
		
		//variable = inputValue;
		cerrar();
	});
}