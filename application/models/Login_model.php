<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->config->load('general');
        // $this->load->database();
    }

    /**
     * 
     * @autor       : LEAS.
     * @Fecha       : 12052016.
     * @param array $parametros 'USUARIO_CVE', 'LOG_INI_SES_IP'
     * @return boolean Si se inserta el registro de log con los parametros 
     * correspondientes. Devuelve 1 si todo se cumplió satisfactoriamente, si no, 
     * en el caso de que el usuario sea nullo o algo ocurrio en la base de datos, devuelve 0
     */
    public function set_log_ususario_doc($parametros = null) {
        if (!isset($parametros)) {
            return false;
        }

        if (is_null($parametros)) {
            return false;
        }
        if (!isset($parametros['USUARIO_CVE']) && is_null($parametros['USUARIO_CVE'])) {
            return false;
        }
        if (!isset($parametros['LOG_INI_SES_IP'])) {
            $parametros['LOG_INI_SES_IP'] = 'NULL';
        }
        if (!isset($parametros['INICIO_SATISFACTORIO'])) {
            $parametros['INICIO_SATISFACTORIO'] = 'NULL';
        }
        $usuario_cve = $parametros['USUARIO_CVE'];
        $log_ini_ses_ip = $parametros['LOG_INI_SES_IP'];
        $inicio_satisfactorio = $parametros['INICIO_SATISFACTORIO'];
        $resp = '@resp';
        $this->db->reconnect();
        $llamada = "call log_usuario_ejecuta($usuario_cve, '$log_ini_ses_ip', $inicio_satisfactorio ,$resp)";

//        pr($llamada);
        $procedimiento = $this->db->query($llamada); //Ejecuta el procedimiento almacenado
        $resultado = isset($procedimiento->result()[0]->res);
        $resultado = $resultado && $procedimiento->result()[0]->res;
        $procedimiento->free_result(); //Libera el resultado
        $this->db->close();
        return $resultado;
    }

    /**
     * 
     * @autor       : LEAS.
     * @Fecha       : 13052016.
     * @param String $cve_usuario
     * @return array con ROL_CVE, MODULO_CVE, ROL_NOMBRE, MOD_NOMBRE
     * 
     * 
     */
    public function get_usuario_rol_modulo_sesion($cve_usuario = null) {
        if (is_null($cve_usuario)) {
            return null;
        }
        $select = array('cr.ROL_CVE "cve_rol"', 'cr.ROL_NOMBRE "nombre_rol"',
            'm.MOD_NOMBRE "nombre_modulo"', 'm.MOD_RUTA "ruta"', 'm.IS_CONTROLADOR "is_controlador"',
            'm.MODULO_CVE_PADRE "padre"', 'mh.MOD_RUTA "ruta_padre"', 'mh.MOD_NOMBRE "nombre_padre"',
            'mh.IS_CONTROLADOR "is_controlador_padre"', 'm.MODULO_CVE "cve_modulo"'
        );

        $this->db->select($select);
        $this->db->from('rol_modulo as rm');
        $this->db->join('modulo as m', 'm.MODULO_CVE = rm.MODULO_CVE');
        $this->db->join('crol as cr', 'cr.ROL_CVE = rm.ROL_CVE');
        $this->db->join('usuario_rol as urm', 'urm.ROL_CVE = cr.ROL_CVE');
        $this->db->join('modulo as mh', 'mh.MODULO_CVE = m.MODULO_CVE_PADRE', 'left');
        $this->db->where('m.MOD_EST_CVE', 1);
        $this->db->where('urm.USUARIO_CVE', $cve_usuario);
        $this->db->order_by('m.ORDEN_MODULO', 'ASC');
        $this->db->order_by('cr.ROL_CVE', 'ASC');
        $this->db->order_by('m.MODULO_CVE', 'ASC');
        $query = $this->db->get();
//        $result = $query->row();
        $result = $query->result_array();

        if (!isset($result)) {
            $result = null;
        } else if (empty($result)) {
            $result = null;
        }
        $query->free_result();
        return $result;
    }

    /**
     * 
     * @autor              : LEAS
     * @Fecha_creación     : 24052016.
     * @Fecha_modificacion : 
     * @Descripción        : La consulta obtiene los modulos extras a los que 
     * puede tener acceso el usuario o a los que no podría tener acceso, según la bandera acceso
     * @param              : String $matricula
     * @return array con ROL_CVE, MODULO_CVE, ROL_NOMBRE, MOD_NOMBRE
     * 
     * 
     */
    public function get_usuario_modulo_extra_sesion($cve_usuario = null) {
        if (is_null($cve_usuario)) {
            return null;
        }

        $select = array('m.MODULO_CVE "cve_modulo"', 'm.MOD_NOMBRE "nombre_modulo"',
            'um.ACCESO "acceso_modulo"', 'm.MOD_RUTA "ruta"', 'm.IS_CONTROLADOR "is_controlador"',
            'mh.MOD_NOMBRE "nombre_padre"', 'm.MODULO_CVE_PADRE "padre"', 'mh.MOD_RUTA "ruta_padre"',
            'mh.IS_CONTROLADOR "is_controlador_padre"'
        );

        $this->db->select($select);
        $this->db->from('usuario_modulo as um');
        $this->db->join('modulo as m', 'm.MODULO_CVE = um.MODULO_CVE');
        $this->db->join('modulo as mh', 'mh.MODULO_CVE = m.MODULO_CVE_PADRE', 'left');
        $this->db->where('um.USUARIO_CVE', $cve_usuario);
        $this->db->order_by('m.MODULO_CVE', 'ASC');
        $query = $this->db->get();
//        $result = $query->row();
        $result = $query->result_array();
        // pr($this->db->last_query());
        if (!isset($result)) {
            $result = null;
        } else if (empty($result)) {
            $result = null;
        }
        $query->free_result();
        return $result;
    }

    /**
     * @autor LEAS
     * Fecha creación: 18-05-2016
     * Fecha actualización: 26-05-2016
     * @param String $matricula Matricula del docente o nombre de usuario 
     * @param String $password Password del docente o usuario
     * @return Array con la cantidad de registros que encontro, si existe, sólo
     * deberia arrojar 1, si no encuentra ninguna coinsidencia con los 
     * parametros, devuelve cero 0
     */
    public function set_login_user($matricula = null, $password = null) {
        if (is_null($matricula) && is_null($password)) {
            return null;
        }
        $result = new stdClass();
        $select = array('us.USUARIO_CVE "user_cve"',
            'us.USU_MATRICULA "usr_matricula"', 'us.USU_NOMBRE "usr_nombre"',
            'us.USU_PATERNO "usr_paterno"', 'us.USU_MATERNO "usr_materno"',
            'us.USU_CONTRASENIA "usr_passwd"', 'emp.CATEGORIA_CVE "usr_categoria"',
            'emp.ADSCRIPCION_CVE "usr_adscripcion"', 'emp.DELEGACION_CVE "usr_delegacion"',
            'us.USU_CORREO "usr_correo"', 'emp.EMPLEADO_CVE "empleado_cve"'
        );

        $this->db->select($select);
//        $this->db->from('usuario as us');
        $this->db->join('empleado emp', 'emp.USUARIO_CVE = us.USUARIO_CVE');    
        $this->db->where('us.USU_MATRICULA', $matricula);
//        $this->db->where('us.USU_CONTRASENIA', $password_encrypt); //Aplica condición password
        $this->db->limit(1);
        $query = $this->db->get('usuario as us');
        
        $result->cantidad_reg = 0;
        if ($query->num_rows() == 1) {
            $result = $query->row();
            $result->cantidad_reg = $query->num_rows();
//            $password_encrypt = hash('sha512', $password.$matricula); //aplica algoritmo de seguridad
            $password_encrypt = contrasenia_formato($matricula, $password); //aplica algoritmo de seguridad
            //
            //Si las contraseñas son diferentes
//            pr('aa '.$password_encrypt);
//            pr($result->usr_passwd);
            if ($password_encrypt != $result->usr_passwd) {
                //Le decimos que si existe el usuario, pero que el passwores incorrecto
                $result->cantidad_reg = -1;
            }
        }
//        pr($this->db->last_query());
//        $result->usr_passwd = " ";
        $query->free_result();
        return $result;
    }

    /**
     * 
     * @param String $matricula Matricula del usuario
     * @param Integer $lapso_intentos
     * @return numero de reg encontrados. Verifica los intentos que un usuario 
     * intento acceder a su cuenta de forma fallida en cierto tiempo. Para proteger 
     * un ataque por fuerza bruta  
     */
    public function set_checkbrute_usuario($matricula = null, $lapso_intentos = null) {
        $this->db->select('LOG_INI_SES_FCH_INICIO');
        $this->db->from('log_inicio_sesion as ises');
        $this->db->join('usuario as us', 'us.USUARIO_CVE = ises.USUARIO_CVE');
        $this->db->where('us.USU_MATRICULA', $matricula);
        $this->db->where('ises.INICIO_SATISFACTORIO', 0);
        $this->db->where("LOG_INI_SES_FCH_INICIO > now() - " . intval($lapso_intentos));
        $query = $this->db->get(); //Obtener número de registros
        /* pr($this->db->last_query());
          pr($query->num_rows());
          exit(); */
        return $query->num_rows();
    }

    function intento_fallido($matricula) {
        $intento['usr_matricula'] = $matricula;
        $this->db->insert('ini_ses_int', $intento);
    }

    /**
     * @autor LEAS
     * Fecha creación: 18-05-2016
     * Fecha actualización: 26-05-2016
     * @return Permisos de acceso para sesiones no iniciadas
     */
    public function get_rol_mod_no_sesion() {
        $select = array('cr.ROL_CVE "cve_rol"', 'cr.ROL_NOMBRE "nombre_rol"',
            'm.MODULO_CVE "cve_modulo"', 'm.MOD_NOMBRE "nombre_modulo"'
            , 'm.MOD_RUTA "controlador"'
        );

        $this->db->select($select);
        $this->db->from('rol_modulo as rm');
        $this->db->join('modulo as m', 'm.MODULO_CVE = rm.MODULO_CVE');
        $this->db->join('crol as cr', 'cr.ROL_CVE = rm.ROL_CVE');
        $this->db->where('m.MOD_EST_CVE', 1);
        $this->db->where('cr.ROL_CVE', 1);
        $this->db->order_by('cr.ROL_CVE', 'ASC');
        $this->db->order_by('m.MODULO_CVE', 'ASC');
        $query = $this->db->get();
        $result = $query->result_array();

        if (!isset($result)) {
            $result = null;
        } else if (empty($result)) {
            $result = null;
        }
        $query->free_result();
        return $result;
    }

    /**
     * 
     * @autor       : LEAS.
     * @Fecha       : 09052016.
     * @param array $parametros 'USUARIO_CVE', 'BIT_VALORES', 'MODULO_CVE', 'BIT_IP' 
     * y 'BIT_RUTA'
     * @return boolean Si se inserta el registro de bitacora con los parametros 
     * correspondientes. Devuelve 1 si todo se cumplio satisfactoriamente, si no, 
     * en el caso de que el usuario sea nullo o algo ocurrio en la base de datos, devuelve 0
     */
    public function set_bitacora($parametros = null) {
        if (!isset($parametros)) {
            return false;
        }

        if (is_null($parametros)) {
            return false;
        }
        if (!isset($parametros['USUARIO_CVE']) && is_null($parametros['USUARIO_CVE'])) {
            return false;
        }
        if (!isset($parametros['BIT_VALORES'])) {
            $parametros['BIT_VALORES'] = 'NULL';
        }
        if (!isset($parametros['BIT_IP'])) {
            $parametros['BIT_IP'] = 'NULL';
        }
        if (!isset($parametros['BIT_RUTA'])) {
            $parametros['BIT_RUTA'] = 'NULL';
        }
        if (!isset($parametros['MODULO_CVE'])) {
            $parametros['MODULO_CVE'] = 'NULL';
        }
        $usuario_cve = $parametros['USUARIO_CVE'];
        $bit_valores = $parametros['BIT_VALORES'];
        $bit_ip = $parametros['BIT_IP'];
        $bit_ruta = $parametros['BIT_RUTA'];
        $modulo_cve = $parametros['MODULO_CVE'];
        $res = '@res';
        $this->db->reconnect();
        //genera la llamada al procedimiento
        $llamada = "call bitacora_ejecuta_historico($usuario_cve, '$bit_valores', '$bit_ip', '$bit_ruta', $modulo_cve, $res )";

//        pr($llamada);
        $procedimiento = $this->db->query($llamada); //Ejecuta el procedimiento almacenado
        $resultado = isset($procedimiento->result()[0]->res);
        $resultado = $resultado && $procedimiento->result()[0]->res;
        $procedimiento->free_result(); //Libera el resultado
        $this->db->close();

        return $resultado;
    }

}
