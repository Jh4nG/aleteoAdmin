var _Voice = (function () {
    var TablesVoice;
    _columnsVoice = [
        {"width": "1%"},
        {"width": "20%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"}
    ];
    TablesVoice = $("#tableVoice").DataTable({
        pagingType: "numbers",
        language: lang_dataTable,
        autoWidth: false,
        searching: true,
        ordering: true,
        paging: true,
        destroy: true,
        pageLength: 10,
        columns: _columnsVoice,
        order: [[0, 'asc']]
    });

    var init = ()=>{
        listarVoces();
    }

    const listarVoces = () =>{
        let data = {
            "controlador": "Podcast",
            "metodo": "getDataPodcastUserAll"
        }
        data = JSON.stringify(data);
        let type = 'POST';
        $.when(ajaxJson(APIMuseo,data,type)).done((data)=>{
            TablesVoice.rows().clear().draw();
            if(data.status == 200){
                $.each(data.data, (i,e)=>{
                    TablesVoice.row.add([
                        e.id,
                        e.name_user,
                        `<audio controls src="${e.url_podcast}"></audio>`,
                        `<div class="checkbox-con">
                            <input onchange="_Voice.setStatusPodcast(${e.id})" data-status="${e.check_terminos}" id="checkbox${e.id}" type="checkbox" ${(e.check_terminos == 1) ? 'checked' : ''}>
                        </div>`,
                        e.register_create
                    ]);
                });
                TablesVoice.draw();
            }
        });
    }

    const setStatusPodcast = (id)=>{
        let item = $(`#checkbox${id}`);
        let status = item.data('status');
        let data = {
            "controlador": "Podcast",
            "metodo": "setStatusPodcast",
            "id" : id,
            "status" : status
        }
        data = JSON.stringify(data);
        let type = 'POST';
        $.when(ajaxJson(APIMuseo,data,type)).done((data)=>{
            if(data.status == 200){ // Cambio correcto
                item.attr('data-status',`${(status == 1) ? '0' : '1'}`);
                swal('Éxito!',data.msg,_success);
            }else{ // Error en el cambio
                if(status == 1){
                    item.attr('checked',true);
                }else{
                    item.removeAttr('checked');
                }
                swal('Error!',data.msg,_error);
            }
        });
    }

    return {
        init:init,
        setStatusPodcast:setStatusPodcast
    }
})(jQuery);

$(document).ready(function(){
    _Voice.init();
});
