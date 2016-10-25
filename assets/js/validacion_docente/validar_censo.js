var menu_busqueda_validar_censo = new Object();
menu_busqueda_validar_censo['matricula'] = 'Matrícula';
menu_busqueda_validar_censo['nombre'] = 'Nombre del empleado';
menu_busqueda_validar_censo['clavecategoria'] = 'Categoría';

$(function () {
    $('#btnEditarNombre').on('click', function () {
        var isReadOnly = $('.nameFields').prop('readonly');
        $('.nameFields').prop('readonly', !isReadOnly);
    });



    var hash = window.location.hash;
    $('.nav.nav-pills a[href="' + hash + '"]').tab('show', function () {
        $(document).scrollTop();
    });

//    $('.botonF1').hover(function () {
//        $('.btn').addClass('animacionVer');
//    })
//    
//    $('.contenedor').mouseleave(function () {
//        $('.btn').removeClass('animacionVer');
//    })


});


function funcion_buscar_docentes_validar() {
    var path = site_url + '/validacion_censo_profesores/data_buscar_docentes_validar/0';
//    var val_post = $('#form_busqueda_docentes_validar').serialize();
    data_ajax(path, '#form_busqueda_docentes_validar', '#div_result_docentes_validacion');
}

/**
 * 
 * @param {type} name Menu de opciónes de filtro
 * @returns {undefined}
 */
function funcion_menu_tipo_busqueda_validar_censo(name) {
    var text = menu_busqueda_validar_censo[name];//Busca en el hashmap el nombre indicado
    $("#menu_select").val(name);//Modifica el valor del menu
    $("#btn_buscar_por").text(text);//Cambia el texto del botón
    $("#btn_buscar_por").append('<span class="caret"> </span>');//Agregar span al botón para mostrar icono flechita
    $("#buscador_docente").attr('data-original-title', 'Buscar por ' + text);//Cambia el texto del la caja de texto 
    $("#btn_buscar_b").attr('data-original-title', 'Buscar por ' + text);//Cambia el texto del botón
}

function runScript_busqueda_val(e) {
    if (e.keyCode == 13) {
//      var tb = document.getElementById("scriptBox");
//      eval(tb.value);
        $("#btn_buscar_docentes_validacion").trigger("click");//Dispara el onclic del botón buscar validador en el sied
        return false;
    }
}

/**
 * Carga el valor de 
 * @param {type} element
 * @returns {undefined}
 */
function funcion_ver_validacion_empleado(element) {
    var button_obj = $(element); //Convierte a objeto todos los elementos del this que llegan del componente html (button en esté caso)
    var empcve = button_obj.data('empcve');
    var matricula = button_obj.data('matricula');
    var estval = button_obj.data('estval');
    var validadorcve = button_obj.data('validadorcve');
    var histvalcve = button_obj.data('histvalcve');
    var valgrlcve = button_obj.data('valgrlcve');
    var usuariocve = button_obj.data('usuariocve');
    var convocatoria_cve = button_obj.data('convocatoriacve');
    var idrow = button_obj.data('usuariocve');
    //Remover contenido de un div 
    $('#select_perfil_validar').empty();
    var obj_post = {empcve: empcve, matricula: matricula, estval: estval, validadorcve: validadorcve,
        histvalcve: histvalcve, valgrlcve: valgrlcve, usuariocve: usuariocve, convocatoria_cve: convocatoria_cve};
    data_ajax_post(site_url + '/validacion_censo_profesores/seccion_index', null, '#select_perfil_validar', obj_post);
}
function funcion_cerrar_validacion_empleado(element) {
//    alert('jsahjhdadas');
    $('#select_perfil_validar').empty();
    data_ajax_post(site_url + '/validacion_censo_profesores/seccion_delete_datos_validado', null, null);
}

function ver_comentario_estado_doc(element) {
    var obj = $(element); //Convierte a objeto todos los elementos del this que llegan del componente html (button en esté caso)
//    var hist_val_cve = obj.data('histvalcve');
    var empleado_cve = obj.data('empcve');
    var convocatoria_cve = obj.data('convocatoriacve');
    var formData = {convocatoria_cve: convocatoria_cve, empleado_cve: empleado_cve};
    data_ajax_post(site_url + '/validacion_censo_profesores/ver_comentario_estado', null, '#modal_content', formData);
}


    