var _error, _success, _warning;

_error = {
	icon: "error",
	buttons: {
		confirm: {
			text: "Salir",
			icon: "<i style='color:#DF584C' class='fas fa-exclamation-circle'></i>",
			visible: true,
			className: 'btn btn-danger'
		}
	}
};

_success = {
	icon: "success",
	buttons: {
		confirm: {
			text: "Continuar",
			icon: "<i style='color:#29A76A' class='fas fa-check-circle'></i>",
			visible: true,
			className: 'btn btn-success'
		}
	}
};

_warning = {
	icon: "warning",
	buttons: {
		confirm: {
			text: "Continuar",
			icon: "<i style='color:#FFD355' class='fas fa-exclamation-circle'></i>",
			visible: true,
			className: 'btn btn-warning'
		}
	}
};

function ajaxJson(ruta,data,type = 'post'){
    return $.ajax({
        url: ruta,
        type: type,
        dataType: 'json',
        data: data,
    });
}

function ajaxJsonForm(ruta,data,type = 'post'){
    return $.ajax({
        url: ruta,
        type: type,
        dataType: 'json',
        data: data,
		contentType: false,
		cache: false,
		processData: false,
    });
}

function limpiarFormulario (id){
	$('#'+id)[0].reset();
}

var lang_dataTable = {
	"sLengthMenu": "Mostrar _MENU_ Registros",
	"sZeroRecords": "No se encontraron resultados",
	"sEmptyTable": "Ningún dato disponible en esta tabla",
	"sInfo": "Mostrando _START_ a _END_ de _TOTAL_ Registro(s)",
	"sInfoEmpty": "",
	"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
	"sInfoPostFix": "",
	"sSearch": "Filtro:",
	"sUrl": "",
	"sInfoThousands": ",",
	"sLoadingRecords": "Cargando...",
	"oPaginate": {
	  "sFirst": "Primero",
	  "sLast": "Final",
	  "sNext": "Siguiente",
	  "sPrevious": "Anterior"
	},
	"select" : {"rows": "%d fila(s) seleccionada(s)"},
	"oAria": {
	"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
	"sSortDescending": ": Activar para ordenar la columna de manera descendente"
	}
};

var _Admin = (function (){

    var cerrarSession = () =>{
        var ruta = 'Controller/Login.controller.php';
		var data = {"metodo":"cerrarSession"};
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            if(data){
				location.href ="login.php";
				window.localStorage.setItem('vista', 'estadisticos');
				window.localStorage.setItem('nav', 'estadisticos');
            }
        });
	}
	
	var traerVista = (vista,id) =>{
		$("[id^='navleft']").removeClass('active');
		$('#contentDiv').html('');
		var ruta = 'Vistas/'+vista+'.php';
		window.localStorage.setItem('vista', vista);
		window.localStorage.setItem('nav', id);
		$.ajax({
			url: ruta,
			success:function (data){
				$('#contentDiv').html(data);
				$('#navleft'+localStorage.nav).attr('class','active');
			},
			error: function(err){
				swal("Error!", "Modulo no encontrado",_error);
			}
		});
	}

    return {
		cerrarSession:cerrarSession,
		traerVista:traerVista
    }
})(jQuery);

$(document).ready(function(){
	$("[class='nav-item has-sub open']").removeClass('open');
	var vista = 'estadisticos';
	var nav = 'estadisticos';
	
	if(localStorage.vista != undefined){
		vista = localStorage.vista;
		nav = localStorage.nav;
	}
	_Admin.traerVista(vista,nav);
    $('#btnLogout').on('click',()=>{
        _Admin.cerrarSession();
    });
});
