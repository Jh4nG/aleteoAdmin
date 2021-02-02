var _Login = (function (){

    var iniciarSesion = () =>{
        if($('#user-name').val() == '' || $('#user-password').val() ==''){
            swal("Advertencia", "No se han ingresado los datos",_warning);
            return;
        }
        var ruta = 'Controller/Login.controller.php';
        var data = {"metodo":"iniciarSesion", 
                    "parametros":{
                        "user":$('#user-name').val(),
                        "password":$('#user-password').val()
                    }};
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            if(data.status == 200){
                location.href ="index.php";
            }else if(data.status == 401){
                swal("Error", data.msj, _error);
            }else if(data.status == 403){
                swal("Advertencia", data.msj, _warning);
            }else{
                swal("Error", data.msj, _error);
            }
        });

    }
    return {
        iniciarSesion:iniciarSesion
    }
})(jQuery);

$(document).ready(function(){
    $('#btnLogin').on('click',()=>{
       _Login.iniciarSesion()
    });
});
