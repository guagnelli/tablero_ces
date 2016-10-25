<?php

/**
 * Archivo que contiene los textos del sistema
 * Contrucción del índice.
 * 	- Archivo fuente: interface_
 * 	- Modulo: login
 *  - Controlador: login
 *  - Identificador único del texto dentro del arreglo: texto_bienvenida
 * 		Ej:
 * 			$lang['interface_login']['login']['texto_bienvenida'] = 'Bienvenido al sistema SIPIMSS';
 * 			$lang['interface_login']['login']['texto_usuario'] = 'Usuario:';
 * 			$lang['interface_login']['login']['texto_contrasenia'] = 'Contraseña:';
 * 			$lang['interface_censo']['formacion']['texto_bienvenida'] = '...';
 * 			$lang['interface_censo']['actividad']['texto_bienvenida'] = '...';
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

//$lang['interface_'][''][''] = '';
//$lang['interface']['registro']['texto_bienvenida'] = 'Hola mundo';
$lang['interface'] = array(

    'registro' => array(
        'lbl_bienvenido' => 'Bienvenido',
        'lbl_formulario' => 'Registro de docentes al censo de profesores',
        'lbl_campos_obligatorios' => 'Campos obligatorios',
        'lbl_matricula' => 'Matrícula',
        'plh_matricula' => 'Introduzca su matrícula',
        'lbl_delegacion' => 'Delegación',
        'plh_delegacion' => 'Seleccione su delegación',
        'lbl_contrasenia' => 'Introduzca una contraseña',
        'plh_contrasenia' => 'Introduzca una contraseña',
        'lbl_confirma_contrasenia' => 'Confirmar contraseña',
        'plh_confirma_contrasenia' => 'Confirme su contraseña',
        'lbl_correo' => 'Correo electrónico',
        'plh_correo' => 'Introduzca su correo electronico',
        'lbl_captcha' => 'Codigo de seguridad',
        'plh_captcha' => 'Escriba el texto de la imágen',
        'plh_btn_guardar' => 'Registrar',
        'lbl_no_registrado' => '¿No se ha registrado?',
        'lbl_existe_registro' => 'El usuario ya se encuentra registrado',
        'phl_la_matricula_no_existe' => 'El usuario con matricula: [field] no se encuentrá registrado en el sistema de personal',
        'phl_la_matricula_existe' => 'El usuario con matricula: [field] ya se encuentrá registrado',
        'phl_registro_correcto' => 'El registro se efectuo correctamente',
        'phl_registro_incorrecto_del_empleado' => 'El registro del empleado no se pudo validar',
        'error_no_inserto_empleado' => 'No se pudieron guardar los datos del empleado'
    ),
    'restablecer_contrasenia' => array(
        'lbl_olvido_contrasenia' => 'He olvidado mi contraseña',
    ),
    'login' => array(
        'lbl_formulario' => 'Iniciar sesión',
        'er_no_usuario' => 'No se encontró registro del usuario',
        'er_contrasenia_incorrecta' => 'La contraseña del usuario es incorrecta',
        'er_general' => 'Datos incorrectos'
    ),
    //perfil string values
    //Selección de roles del usuario 
    'rol' => array(
        'lbl_selecciona_rol' => 'Debe seleccionar un rol para cargar',
    ),
    //Textos generales
    'general' => array(
        'msg_no_existe_empleado' => 'No se encontrarón datos del empleado. Por favor registre sus datos',
        'advertencia_agregar_todos_los_datos' => 'Debe llenar todos los campos obligatorios',
        'datos_almacenados_correctamente' => 'Los datos se almacenaron correctamente',
        'error_guardar' => 'Los datos no se almacenaron. Por favor intentemo más tarde',
        'cerrar' => 'Cerrar',
        'guardar' => 'Guardar',
        'ver' => 'Ver',
        'editar' => 'Editar',
        'eliminar' => 'Eliminar',
        'validar' => 'Validar',
        'subir_archivo' => 'Subir archivo',
        'lbl_tipo_comprobante' => 'Tipo de comprobante',
        'drop_tipo_comprobante' => 'Seleccione el tipo de comprobante',
        'title_tipo_comprobante' => 'Tipo de comprobante',
        'lbl_comprobante' => 'Comprobante',
        'title_cargar_comprobante' => 'Cargar comprobante',
        'carga_correcta' => 'Se ha cargado correctamente el archivo. Para persistir los datos, guarde los cambios.',
        'ver_archivo' => 'Ver archivo',
        'descargar_archivo' => 'Descargar archivo',
        'confirmar_eliminacion' => 'Confirme que realmente desea eliminar los datos',
        'archivo_incorrecto' => 'Archivo incorrecto',
        'archivo_inexistente' => 'Archivo inexistente',
        'opciones' => 'Opciones',
        'error_sql' => 'Ocurrio un error durante el guardado, intentelo más tarde.',
        't_h_comprobante' => 'Comprobante',
        'lbl_ver_comprobante' => 'Ver comprobante',
        'validado' => 'Validado'
    ),
    'error' => array(
        'crear_carpeta' => 'No es posible crear la carpeta, verifique permisos de escritura con administrador.',
        'falta_carga_archivo' => 'Debe subir el archivo antes de continuar con el guardado.'
    ),
    'model' => array(
        'insercion' => 'Se ha insertado correctamente la información.',
        'actualizacion' => 'Se ha actualizado correctamente la información.',
        'eliminacion' => 'Se ha eliminado correctamente.',
        'error' => 'Ocurrió un error, por favor intentelo de nuevo más tarde.',
        'error_validaciones_asociadas' => 'No es posible eliminar el registro debido a que tiene validaciones asociadas.'
    ),
    
    'password_reset' => array(
        'title_begin_password_reset' => 'Recuperar tu contraseña en SIPIMSS',
        'title_midle_step_password_reset' => 'Paso 1: Código de recuperación de contraseña',
        'title_endup_password_reset' => 'Paso 2: Nueva contraseña',
        'lbl_matricula_password_reset' => 'Ingresa tu matrícula',
        'lbl_mail_password_reset' => 'Ingresa tu correo electrónico registrado en SIPIMSS',
        'lbl_new_password_reset' => 'Ingresa tu nueva contraseña',
        'lbl_confirm_password_reset' => 'Confirma tu nueva contraseña',
        'lbl_code_active_password_reset' => 'Ingresa el código de recuperación de contraseña',
        'msg_error_mail_no_exist_password_reset' => 'No pudimos encontrar la cuenta SIPIMSS con el correo electrónico enviado',
        'msg_error_mail_incorrect_password_reset' => 'El correo electrónico no cumple con las características de un correo electrónico valido',
        'msg_error_new_password_no_lowercase_password_reset' => 'La contraseña debe tener por lo menos una letra mayúscula',
        'msg_error_new_password_no_uppercase_password_reset' => 'La contraseña debe tener por lo menos una letra minúscula ',
        'msg_error_new_password_no_number_password_reset' => 'La contraseña debe tener por lo menos un número',
        'msg_error_new_password_no_special_char_password_reset' => 'La contraseña debe tener por lo menos uno de los siguientes caracteres especiales " <strong> - , _ . / * + </strong> "',
        'msg_success_email_send' => 'Un mensaje ha sido enviado a tu correo electrónico, por favor sigue las instrucciones para reestablecer tucontraseña',
        'msg_success_change_password' => 'Tu contraseña se ha actualizado correctamente, ',
        'msg_no_user_exists' => 'Lo sentimos, no se ha podido encontrar un usuario con los datos proporcionados',
        'msg_error_end_time_change_pass' => 'El limite de tiempo para el cambio de contraseña ha concluido',
        'msg_error_no_mat_exists' => 'No existe la matrícula introducida',
        'msg_error_no_mat_on_cod_rec' => 'El código de recuperación no coincide con la matrícula introducida',
        'msg_error_no_mat_on_token' => 'El token no coincide con la matrícula introducida',
        'msg_error_no_token_exists' => 'Error, URL no válida',
        'msg_success_ultimate_step' => 'El código de recuperación de contraseña ha sido verificado correctamente',
        'msg_endup_success' => 'La recuperación de contraseña ha sido exitosa, puede dar clic en el siguiente botón para iniciar sesión: <br>',
        'msg_error_end_time_change_pass' => 'El código de recuperación que intenta usar ya ha sido registrado',
        'link_inicio_sesion' => 'da clic en esta liga para ir al inicio de sesión',
        'btn_endup_success' => '<a href="' . site_url('login') . '" class="btn btn-info">Iniciar sesión</a>',
    ),
);	

$lang['interface_secd'] = array(
    'lbl_secd_titulo' => "Solicitud de evaluaci&oacute;n curricular docente",
    'lbl_solicitud_titulo' => "Solicitud",
    'lbl_info_prof' => "Informaci&oacute;n del profesor(a):",
    'lbl_titulo_convocatoria' => "Requisitos m&iacute;nimos para la evaluaci&oacute;n",
    'lbl_list_sol_title' => "Listado de solicitudes",
    "lbl_info_nombre" => "Nombre:",
    "lbl_info_matricula" => "Matr&iacute;cula:",
    "lbl_info_categoria" => "Categor&iacute;a docente:",
    "lbl_info_del" => "Delegaci&oacute;n:",
    "lbl_info_adscripcion" => "Adscripci&oacute;n:",
    "lbl_info_vigencia" => "Vigencia:",
    "lbl_info_submit" => "Enviar solicitud",
    'lbl_convocatoria' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
    'lbl_link_convocatoria' => 'Si desea consultar la convocatoria, puede hacerlo en la esiguiente URL: <a href="#">Convoctoria</a>',
);

$lang["interface_tpl"] = array(
    'lbl_link_logout' => 'Cerrar sesión',
    'lbl_link_profile' => 'Mi perfil',
);

//$lang['interface_registro_profesor'] = 'Impresión de texto prueba';
//$lang['interface_otro_mensaje'] = '&lsaquo; Primero';