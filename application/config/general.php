<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$config['salt'] = "B0no5"; ///SALT

$config['minDate'] = '01/01/1980';

$config['superadmin'] = 5;

$config['upload_config'] = array(
        'comprobantes'=>array(
            'upload_path'=>'./assets/files/comprobantes/',
            'allowed_types'=>'pdf',
            'remove_spaces'=>TRUE,
            'max_size'=>1024 * 15,
            'detect_mime'=>true,
            'file_name'=>'tmp_comprobante',
        ),
    );

$config['extension_comprobante'] = array('pdf');

$config['modulos_no_sesion'] = array(
    'login' => array('index', 'cerrar_session', 'cerrar_session_ajax'),
    'registro' => array('*'),
    'account' => array('*'),
    'pagina_no_encontrada' => array('index'),
    'recuperar_contrasenia' => '*',
    'captcha' => '*'
);
$config['modulos_sesion_generales'] = array(
    'login' => array('cerrar_session', 'cerrar_session_ajax'),
    'rol' => '*',
    'pagina_no_encontrada' => array('index'),
    'pruebas' => '*'
);

$config['institucion'] = array('avala'=>'A', 'imparte'=>'I');

$config['categorias_designar_validador'] = array('36112580','35312180');

/////Ruta de solicitudes
$config['ruta_documentacion'] = $_SERVER["DOCUMENT_ROOT"] . "/sipimss_bonos/assets/files/archivos_bono/";
$config['ruta_documentacion_web'] = asset_url() . 'files/archivos_bono/'; //base_url()."assets/files/solicitudes/";

$config['tiempo_eliminar_archivo'] = 60 * 10; //3600 = 1 hora => Tiempo que no será considerado para eliminación de archivo. Referencia administración/eliminar_archivos

$config['numero_registros_eliminar'] = 100;

$config['tiempo_fuerza_bruta'] = 60 * 60; //3600 = 1 hora => Tiempo válido para chequeo de fuerza bruta

$config['intentos_fuerza_bruta'] = 10; ///Número de intentos válidos durante tiempo 'tiempo_fuerza_bruta'

$config['tiempo_recuperar_contrasenia'] = 60 * 60 * 24; //3600 * 24 = 86400 = 1 día => Límite de tiempo que estará activo el link

$config['meses'] = array(1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre');

$config['cestado_usuario'] = array('ACTIVO'=>array('id'=>1), 'INACTIVO'=>array('id'=>2), 'RESTABLECERCONTRASENIA'=>array('id'=>3), 'RESTABLECERCMA'=>array('id'=>4));

$config['USU_GENERO'] = array('M'=>'Masculino', 'F'=>'Femenino', 'H'=>'Masculino');

$config['alert_msg'] = array(
    'SUCCESS' => array('id_msg' => 1, 'class' => 'success'),
    'DANGER' => array('id_msg' => 2, 'class' => 'danger'),
    'WARNING' => array('id_msg' => 3, 'class' => 'warning'),
    'INFO' => array('id_msg' => 4, 'class' => 'info')
);


$config['parametros_bitacora'] = array(
        'USUARIO_CVE' => 'NULL', 
        'BIT_OPERACION' => 'NULL',
        'BIT_IP' => 'NULL', 
        'BIT_RUTA' => 'NULL', 
        'MODULO_CVE' => 'NULL',
        'ENTIDAD' => 'NULL', 
        'REGISTRO_ENTIDAD_CVE' => 'NULL',
        'PARAMETROS_JSON' => 'NULL');
$config['parametros_log'] = array('USUARIO_CVE' => 'NULL', 'LOG_INI_SES_IP' => 'NULL',
    'INICIO_SATISFACTORIO' => 'NULL');

//ejemplo para enviar un where $condiciones = array(enum_ecg::cejercicio_predominante=>array('EJER_PREDOMI_CVE '=>'2'));                  
$config['catalogos_definidos'] = array(//Catógos generales que existen actualmente y su identificación
    'cdelegacion' => array('id' => 'DELEGACION_CVE', 'nombre' => 'DEL_NOMBRE' , 'where' => null),
    'ccategoria' => array('id' => 'des_clave', 'nombre' => 'nom_categoria' , 'where' => null),
    'cdepartamento' => array('id' => 'departamento_cve', 'nombre' => 'dep_nombre' , 'where' => null),
    'crol' => array('id' => 'ROL_CVE', 'nombre' => 'ROL_NOMBRE' , 'where' => null),
    'modulo' => array('id' => 'MODULO_CVE', 'nombre' => 'MOD_NOMBRE' , 'where' => null),
    'cestado_usuario' => array('id' => 'ESTADO_USUARIO_CVE', 'nombre' => 'EDO_USUARIO_DESC' , 'where' => null),
    'cunidad' => array('id' => 'UNIDAD_CVE', 'nombre' => 'UNI_DESC' , 'where' => null),
);



