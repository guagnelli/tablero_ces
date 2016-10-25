<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// HELPER General
/**
 * M�todo que preformatea una cadena
 * @autor 		: Jes�s D�az P.
 * @param 		: mixed $mix Cadena, objeto, arreglo a mostrar
 * @return  	: Cadena preformateada
 */
 class Seguridad {
	 
	public function __construct() {
    	$this->CI =& get_instance();
        $this->CI->load->library('session');
    }
 
	public function crear_token(){
        return md5(uniqid(rand(),TRUE));
    }
  
    public function token(){
        $this->CI->session->set_userdata('token', $this->crear_token());
        return;
    }

    public function crear_token_url(){
        return hash('sha512', uniqid(rand(),TRUE));
    }

    /**
     * M�todo que codifica una cadena a base 64
     * @autor       : Jes�s D�az P.
     * @modified    : 
     * @param       : string $string Cadena a codificar
     * @return      : string Cadena codificada
     */
    public function encrypt_base64($string){
        //return base64_encode($string); //convert_uuencode($string);
        //return strtr(base64_encode($string), '+/=', '-_*');
        return rtrim(strtr(base64_encode($string), '+/', '-_'), '=');
    }

    /**
     * M�todo que decodifica una cadena en base 64
     * @autor       : Jes�s D�az P.
     * @modified    : 
     * @param       : string $string Cadena a decodificar
     * @return      : string Cadena decodificada
     */
    public function decrypt_base64($string){
        //return base64_decode($string); //convert_uudecode($string);
        //return base64_decode(strtr($string, '-_*', '+/='));
        return base64_decode(str_pad(strtr($string, '-_', '+/'), strlen($string) % 4, '=', STR_PAD_RIGHT));
    }
	
    /**
     * M�todo que encripta una cadena con el algoritmo sha256
     * @autor       : Jes�s D�az P.
     * @modified    : 
     * @param       : string $string Cadena a decodificar
     * @return      : string Cadena decodificada
     */
    public function encrypt_sha256($string){
        return hash('sha256', $string);
    }

    /**
     * M�todo que encripta una cadena con el algoritmo sha512
     * @autor       : Jes�s D�az P.
     * @modified    : 
     * @param       : string $string Cadena a decodificar
     * @return      : string Cadena decodificada
     */
    public function encrypt_sha512($string){
        return hash('sha512', $string);
    }

    /**
     * M�todo que encripta una cadena con el algoritmo md5
     * @autor       : Jes�s D�az P.
     * @modified    : 
     * @param       : string $string Cadena a decodificar
     * @return      : string Cadena decodificada
     */
    public function encrypt_carpeta_nombre($string){
        return md5($string);
    }


    public function folio_random($limit = 6, $anadirEspecial=false)
    {
        $cadena_base =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; //Alfa
        $cadena_base .= '0123456789'; //N�meros
        if($anadirEspecial)
        {
            $cadena_base .= '%&*_,.!'; //Caracteres especiales
        }

        $password = '';
        $limite = strlen($cadena_base) - 1;

        for($i=0; $i < $limit; $i++)
        {
            $password .= $cadena_base[rand(0, $limite)];
        }

        return $password;
    }

    public function verificar_liga_validar($IS_VALIDO_PROFESIONALIZACION=null, $validation_estado=null, $validation_estado_anterior=null){
        //$this->CI->load->config('general');
        $flag_validar = false;
        $estados_val_censo = $this->CI->config->item('estados_val_censo'); ///Obtener listado de estados de la validaci�n, definidos en archivo de configuraci�n
        $rol_validador_actual = $this->CI->session->userdata('datos_validador')['ROL_CVE']; //Obtener de sesi�n el rol del usuario que validar�
        $estado_validacion_actual = $this->CI->session->userdata('datosvalidadoactual')['est_val']; //Obtener de sesi�n el estado actual de la validaci�n
        //pr($this->CI->session->userdata());
        //pr($estados_val_censo[$estado_validacion_actual]['rol_permite']);
        //echo $IS_VALIDO_PROFESIONALIZACION."|".$rol_validador_actual."|".$estado_validacion_actual; pr('<br>');
        $fue_validado = $this->CI->session->userdata('datosvalidadoactual')['estado']['fue_validado'];
        if($IS_VALIDO_PROFESIONALIZACION==0 && in_array($rol_validador_actual, $estados_val_censo[$estado_validacion_actual]['rol_permite'])){
            //pr('////////////////////////////////////////////////');
            //pr('entro');
            if($fue_validado['result']==true){
                //pr('entro1: '.$validation_estado_anterior.'|'.$this->CI->config->item('cvalidacion_curso_estado')['CORRECCION']['id']);
                if($validation_estado_anterior == $this->CI->config->item('cvalidacion_curso_estado')['CORRECCION']['id']){
                    /*pr('entro2');
                    pr('/////////');
                    pr($validation_estado_anterior);
                    pr($this->CI->config->item('cvalidacion_curso_estado')['CORRECCION']['id']);*/
                    $flag_validar = true;
                }
            } else {
                //pr('else');
                $estado_validacion_actual = $this->CI->session->userdata('datosvalidadoactual')['est_val']; //Estado actual de la validaci�n
                if($this->CI->config->item('estados_val_censo')[$estado_validacion_actual]['color_status'] == $this->CI->config->item('CORRECCION')
                    && ($this->CI->config->item('cvalidacion_curso_estado')['CORRECCION']['id'] != $validation_estado)) { //Validar estado en correcci�n
                    $flag_validar = false;
                    //pr('else2');
                } else {
                    $flag_validar = true;
                }
            }
        }
        return $flag_validar;
    }
    
    /*public function verificar_estado_correccion($estado, $btn){
        $estado_validacion_actual = $this->CI->session->userdata('datosvalidadoactual')['est_val']; //Estado actual de la validaci�n
        if($this->CI->config->item('estados_val_censo')[$estado_validacion_actual]['color_status'] == $this->CI->config->item('CORRECCION')
            && ($this->CI->config->item('cvalidacion_curso_estado')['CORRECCION']['id'] != $estado)) { //Validar estado en correcci�n
            $btn = '';
        }

        return $btn;
    }*/

    public function html_verificar_valido_profesionalizacion($is_valido_profesionalizacion=null){
        return ($is_valido_profesionalizacion == 1) ? '<span class="class_validacion_registro text-black glyphicon glyphicon-ok-sign" data-toggle="tooltip" data-placement="left" title="Validaci&oacute;n confirmada por profesionalizaci&oacute;n"></span>' : '';
    }

    public function html_verificar_validacion_registro($is_validado, $is_valido_profesionalizacion, $estado_actual, $validation_estado_anterior){
        $estado_validacion_actual = $this->CI->session->userdata('datosvalidadoactual')['est_val']; //Estado actual de la validaci�n
        $fue_validado = $this->CI->session->userdata('datosvalidadoactual')['estado']['fue_validado'];
        //pr($this->CI->session->userdata());
        $html_valido = '<span class="class_validacion_registro ' . (($is_valido_profesionalizacion == 1) ? 'text-black' : '') . ' glyphicon glyphicon-ok-sign" data-toggle="tooltip" data-placement="left" title="' . (($is_valido_profesionalizacion == 1) ? 'Validaci&oacute;n confirmada por profesionalizaci&oacute;n' : 'Validaci&oacute;n realizada') . '"></span>';
        $html = $html_no_valido = '-';


        $estados_val_censo = $this->CI->config->item('estados_val_censo'); ///Obtener listado de estados de la validaci�n, definidos en archivo de configuraci�n
        $rol_validador_actual = $this->CI->session->userdata('datos_validador')['ROL_CVE']; //Obtener de sesi�n el rol del usuario que validar�
        $estado_validacion_actual = $this->CI->session->userdata('datosvalidadoactual')['est_val']; //Obtener de sesi�n el estado actual de la validaci�n
        //pr($estados_val_censo);
        //pr($rol_validador_actual);
        //pr($estado_validacion_actual);
        //pr(in_array($rol_validador_actual, $estados_val_censo[$estado_validacion_actual]['rol_permite']));
        //pr($fue_validado['result']);
        if(in_array($rol_validador_actual, $estados_val_censo[$estado_validacion_actual]['rol_permite'])==false && $fue_validado['result']==false){
            $html = $html_no_valido;
        } elseif(in_array($rol_validador_actual, $estados_val_censo[$estado_validacion_actual]['rol_permite'])==false && $fue_validado['result']==true){
            //pr(in_array($rol_validador_actual, $estados_val_censo[$estado_validacion_actual]['rol_permite']));
            $html = $html_valido;
            //pr('***');
        } else {
            //pr('////');
            //echo $is_validado."|".$is_valido_profesionalizacion."|".$estado_actual."|".$validation_estado_anterior; pr('<br>');
            $html = ($is_validado > 0 || $is_valido_profesionalizacion == 1 || 
                    ($this->CI->config->item('estados_val_censo')[$estado_validacion_actual]['color_status'] == $this->CI->config->item('CORRECCION')
                        && ($this->CI->config->item('cvalidacion_curso_estado')['CORRECCION']['id'] != $estado_actual))
                )
                ? $html_valido : $html_no_valido;
            if($fue_validado['result']==true && $validation_estado_anterior != $this->CI->config->item('cvalidacion_curso_estado')['CORRECCION']['id']
                && $is_validado == 0){ ///Modificar icono en caso de que se haya validado con anterioridad y el estado de la anterior validaci�n sea correcci�n
                $html = $html_valido;
            }
        }
        return $html;
    }

    public function verificar_liga_agregar_docente(){
        $estado_actual = $this->CI->session->userdata('datosvalidadoactual')['est_val'];

        if($this->CI->config->item('estados_val_censo')[$estado_actual]['agregar_docente']){
            return true;
        } else {
            return false;
        }
    }

    public function verificar_liga_eliminar_docente($is_valido_profesionalizacion){
        $estado_actual = $this->CI->session->userdata('datosvalidadoactual')['est_val'];

        if(!$is_valido_profesionalizacion && $this->CI->config->item('estados_val_censo')[$estado_actual]['eliminacion_docente']){
            return true;
        } else {
            return false;
        }
    }

    public function verificar_liga_editar_docente($is_valido_profesionalizacion, $estado_actual_registro){
        $estado_actual = $this->CI->session->userdata('datosvalidadoactual')['est_val'];

        if(!$is_valido_profesionalizacion){
            if($this->CI->config->item('estados_val_censo')[$estado_actual]['edicion_docente']){ //En caso de que se permita la edici�n
                if($estado_actual==Enum_ev::Correccion_docente){ //Validar estado correcci�n, solo se mostrar� liga a los marcados como en correcci�n
                    if($this->CI->config->item('cvalidacion_curso_estado')['CORRECCION']['id'] == $estado_actual_registro){
                        return true;
                    }
                } else { ///En caso de que sea parte de la edici�n
                    return true;
                }
            }
        }
        return false;
    }
}