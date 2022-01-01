/*=======ToolTip =========*/
$(function () {
	$('[data-toggle="tooltip"]').tooltip()
})
/*=======ToolTip =========*/


$(document).ready(function(){

	/* ==== VIA AJAX ===*/
	$('.FormularioAjax').submit(function(e){
		e.preventDefault();
	
		var form=$(this);
	
		var tipo=form.attr('data-form');
		var accion=form.attr('action');
		var metodo=form.attr('method');
		var respuesta=form.children('.RespuestaAjax');
	
		var msjError="<script>swal('Ocurrió un error inesperado','Por favor recargue la página','error');</script>";
		var formdata = new FormData(this);
	
	
		var textoAlerta;
		if(tipo==="save"){
			textoAlerta="Los datos que enviaras quedaran almacenados en el sistema";
		}else if(tipo==="delete"){
			textoAlerta="Los datos serán eliminados completamente del sistema";
		}else if(tipo==="update"){
			textoAlerta="Los datos del sistema serán actualizados";
		}else if(tipo="search"){
			textoAlerta="Se buscarán los datos en el sistema";
		}else{
			textoAlerta="¿Quieres realizar la operación solicitada?";
		}
	
		swal({
				title: "¿Estás seguro?",   
				text: textoAlerta,   
				type: "question",   
				showCancelButton: true,     
				confirmButtonText: "Aceptar",
				cancelButtonText: "Cancelar"
		}).then(function () {
			$.ajax({
				type: metodo,
				url: accion,
				data: formdata ? formdata : form.serialize(),
				cache: false,
				contentType: false,
				processData: false,
				xhr: function(){
					var xhr = new window.XMLHttpRequest();
					xhr.upload.addEventListener("progress", function(evt) {
					  if (evt.lengthComputable) {
						var percentComplete = evt.loaded / evt.total;
						percentComplete = parseInt(percentComplete * 100);
						if(percentComplete<100){
							respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress"><div class="progress-bar bg-success" role="progressbar" style="width: '+percentComplete+'%;">'+percentComplete+'</div></div>');
						  }else{
							  respuesta.html('<p class="text-center"></p>');
						  }
					  }
					}, false);
					return xhr;
				},
				success: function (data) {
					respuesta.html(data);
				},
				error: function() {
					respuesta.html(msjError);
				}
			});
			return false;
		});
	});
	/* ==== VIA AJAX ===*/
	
});



/* validar extesion */
function validarExt()
{
	var archivoInput  = document.getElementById('archivoInput');
	var archivoRuta = archivoInput.value;
	var extPermitidas = /(.PNG|.png|.jpg|.JPG|.jpeg|.svg|.SVG)$/i;

	if(!extPermitidas.exec(archivoRuta)){
		swal("Ocurrió un error","El archivo que intenta cargar no es válido","error");
		archivoInput.value='';
		return false;
	}
}

/*VALIDAR QUE SOLO SEA NUM*/
function valideKey(evt){
    
    // code is the decimal ASCII representation of the pressed key.
    var code = (evt.which) ? evt.which : evt.keyCode;
    
    if(code==8) { // backspace.
      return true;
    } else if(code>=48 && code<=57) { // is a number.
      return true;
    } else{ // other keys.
      return false;
    }
}
