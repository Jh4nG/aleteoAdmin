var _PodCast = (function (){

    var modalAñadir = ()=>{
        $("#modalAnadirAudio").modal('show');
    }


    return {
        modalAñadir:modalAñadir
    }
})(jQuery);

$(document).ready(function(){
    $("#formAnadirAudio").submit(function(event){
        event.preventDefault();
        
        var form_data = new FormData(this); //Creates new FormData object
        form_data.append('metodo', 'upload');
        form_data.append('parametros', [$("#nameAudio").val(), $("#descripcionAudio").val()]);
        
        $.ajax({
	        url : "Controller/Podcast.controller.php",
	        type: "POST",
	        data : form_data,
			contentType: false,
			cache: false,
			processData:false,
			beforeSend: function () {
				
			},
	    }).done(function(response){ 
	    	
		
	    });
    });
});