<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que muestra un mensaje personalizado para el error 404
 * @version 	: 1.0.0
 * @autor 		: Jesús Díaz P.
 */
class Pagina_no_encontrada extends CI_Controller {

    var $sessionData;

    public function __construct() {
        parent::__construct();
        $this->sessionData = $this->session->userdata();
    }

    public function index() {
        $datos[''] = null;
        $template['main_content'] = $this->load->view('errors/html/error_404', $datos, TRUE);
        if (isset($this->sessionData['usuario_logeado']) && $this->sessionData['usuario_logeado'] == 1) {
            $data_tmp = &$datos;
//            $datos['heading'] = 'Pagina no encontrada';
//            $datos['message'] = 'La pagina que solicita no se encontró';
            $this->template->template_conricyt($template);
        } else {
            $this->template->template_buscador($template);
        }
    }

}
