<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogos_generales extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }

    //******************************************************************************************************************
    /**
     * 
     * @return type array retorna los datos del catálogo "cestado_civil" 
     * "EJER_PREDOMI_CVE"  ,  "EJE_PRE_NOMBRE"
     * "AND", "OR", "HAVING()", OR_HAVING();
     */
    public function get_catalogo_general($entidad, $order_by, $array_where = null, $type_where = 'AND') {
//        pr($entidad . ' => ' . $type_where);
        if (!is_null($array_where)) {
            foreach ($array_where as $key => $value) {
                if (is_array($value)) {
                    switch ($type_where) {
                        case 'OR'://or in   
                            $this->db->or_where_in($key, $value);
                            break;
                        case 'NOTOR'://or not_in   
                            $this->db->where_not_in($key, $value);
                            break;
                        default :
//                            foreach ($value as $key => $value_prima) {
                            $this->db->where($value);
//                            }
                    }
                } else {
                    $this->db->where($key, $value);
                }
            }
        }
        $this->db->order_by($order_by);
        $query = $this->db->get($entidad);
        $estadoCivil = $query->result_array();
        $query->free_result();
//        pr($this->db->last_query());
        return $estadoCivil;
    }

    //******************************************************************************************************************

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
    public function set_bitacora_gral($parametros = null) {
        if (!isset($parametros)) {
            return false;
        }

        if (is_null($parametros)) {
            return false;
        }
        if (!isset($parametros['USUARIO_CVE']) || is_null($parametros['USUARIO_CVE'])) {
            return false;
        }
        if (!isset($parametros['BIT_OPERACION']) || is_null($parametros['BIT_OPERACION'])) {
            $parametros['BIT_OPERACION'] = 'NULL';
        }
        if (!isset($parametros['BIT_IP']) || is_null($parametros['BIT_IP'])) {
            $parametros['BIT_IP'] = 'NULL';
        }
        if (!isset($parametros['BIT_RUTA']) || is_null($parametros['BIT_RUTA'])) {
            $parametros['BIT_RUTA'] = 'NULL';
        }
        if (!isset($parametros['MODULO_CVE'])AND is_null($parametros['MODULO_CVE'])) {
            $parametros['MODULO_CVE'] = 'NULL';
        }
        if (!isset($parametros['ENTIDAD']) || is_null($parametros['ENTIDAD'])) {
            $parametros['ENTIDAD'] = 'NULL';
        }
        if (!isset($parametros['REGISTRO_ENTIDAD_CVE']) || is_null($parametros['REGISTRO_ENTIDAD_CVE'])) {
            $parametros['REGISTRO_ENTIDAD_CVE'] = 'NULL';
        }
        if (!isset($parametros['PARAMETROS_JSON']) || is_null($parametros['PARAMETROS_JSON'])) {
            $parametros['PARAMETROS_JSON'] = 'NULL';
        }
        $usuario_cve = $parametros['USUARIO_CVE'];
        $bit_operacion = $parametros['BIT_OPERACION'];
        $bit_ip = $parametros['BIT_IP'];
        $bit_ruta = $parametros['BIT_RUTA'];
        $modulo_cve = $parametros['MODULO_CVE'];
        $entidad = $parametros['ENTIDAD'];
        $registro_entidad_cve = $parametros['REGISTRO_ENTIDAD_CVE'];
        $parametros_json = $parametros['PARAMETROS_JSON'];
        $res = '@res';
        $this->db->reconnect();
        //genera la llamada al procedimiento
        $llamada = "call bitacora_ejecuta_historico($usuario_cve, '$bit_operacion', '$bit_ip', '$bit_ruta', $modulo_cve, '$entidad', '$registro_entidad_cve', '$parametros_json', $res )";
        $procedimiento = $this->db->query($llamada); //Ejecuta el procedimiento almacenado
        $resultado = isset($procedimiento->result()[0]->res);
        $resultado = $resultado && $procedimiento->result()[0]->res;
        $procedimiento->free_result(); //Libera el resultado
        $this->db->close();

        return $resultado;
    }

    public function delete_registro_general($entidad, $array_where) {
        $this->db->where($array_where);
        $this->db->delete($entidad);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return -1;
        } else {
            return 1;
        }
    }

    /**
     * 
     * @param type $id_usuario identificador del usuario
     * 
     */
    public function getDatos_empleado($id_usuario) {
        $query = $this->db->where('USUARIO_CVE', $id_usuario); //Condicion del usuario 
        $query = $this->db->get('empleado'); //Obtener conjunto de registros
        $resultado = $query->result_array();

        $query->free_result(); //Libera la memoria
//        pr($resultado);
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "rist_delegacion"
     * 
     */
    public function getDelegaciones_rist($array_where = null) {
//        $this->db->select(array(''));
        $query = $this->db->get('rist_delegacion'); //Obtener conjunto de registros
        $resultado = $query->result_array();

        $query->free_result(); //Libera la memoria
//        pr($resultado);
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "cdelegacion" que es la 
     * tabla principal de delegaciones
     * 
     */
    public function getDelegaciones($array_where = null) {
//        $this->db->select(array(''));
        $query = $this->db->get('cdelegacion'); //Obtener conjunto de registros
        $resultado = $query->result_array();

        $query->free_result(); //Libera la memoria
//        pr($resultado);
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "ccurso" 
     * 
     * 
     */
    public function get_ccurso($array_where = null) {
//        $this->db->select(array(''));
        $query = $this->db->get('ccurso'); //Obtener conjunto de registros
        $resultado = $query->result_array();

        $query->free_result(); //Libera la memoria
//        pr($resultado);
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "ctipo_actividad_docente" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_tipo_actividad_docente($array_where = null) {
        $query = $this->db->get('ctipo_actividad_docente'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /////*******Checar campos
    /**
     * 
     * @return type array retorna los datos del catálogo "cmaterial" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_cmaterial($array_where = null) {
        $query = $this->db->get('cmaterial'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "licenciatura" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_licenciatura($array_where = null) {
        $query = $this->db->get('licenciatura'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "cmodulo" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_cmodulo($array_where = null) {
        $query = $this->db->get('cmodulo'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "carea" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_carea($array_where = null) {
        $query = $this->db->get('carea'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "cinstitucion_avala" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_cinstitucion_avala($array_where = null) {
        $query = $this->db->get('cinstitucion_avala'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "crol_desempenia" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_crol_desempenia($array_where = null) {
        $query = $this->db->get('crol_desempenia'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "crol_desempenia" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_cmodalidad($array_where = null) {
        $query = $this->db->get_where('cmodalidad', $array_where); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "crol_desempenia" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_ctipo_comprobante($array_where = null) {
        $query = $this->db->get('ctipo_comprobante'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "ctipo_especialidad" 
     * "TIP_ESP_MEDICA_CVE"  y  "TIP_ESP_MED_NOMBRE"
     * 
     */
    public function get_ctipo_especialidad($array_where = null) {
        $query = $this->db->get('ctipo_especialidad'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "ctipo_especialidad" 
     * "TIP_FOR_PROF_CVE"  ,  "TIP_FOR_PRO_NOMBRE"   y "SUB_FOR_PRO_CVE"
     * 
     */
    public function get_ctipo_formacion_profesional($array_where = null) {
        $query = $this->db->get('ctipo_formacion_profesional'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "ctipo_participacion" 
     * "TIP_PARTICIPACION_CVE"  ,  "TIP_PAR_NOMBRE" 
     * 
     */
    public function get_ctipo_participacion($array_where = null) {
        $query = $this->db->get('ctipo_participacion'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "ctipo_participacion" 
     * "TIP_MATERIAL_CVE"  ,  "TIP_MAT_NOMBRE"  y "TIP_MAT_TIPO"
     * 
     */
    public function get_ctipo_material($array_where = null) {
        $query = $this->db->get('ctipo_material'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "ctipo_curso" 
     * "TIP_CURSO_CVE"  ,  "TIP_CUR_NOMBRE"
     * 
     */
    public function get_ctipo_curso($array_where = null) {
        $query = $this->db->get('ctipo_curso'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "cestado_civil" 
     * "CESTADO_CIVIL_CVE"  ,  "EDO_CIV_NOMBRE"
     * 
     */
    public function get_cestado_civil($array_where = null) {
        $query = $this->db->get('cestado_civil');
        $estadoCivil = $query->result_array();
        $query->free_result();
        return $estadoCivil;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "cestado_civil" 
     * "EJE_PRO_CVE"  ,  "EJE_PRO_NOMBRE"
     * 
     */
    public function get_cejercicio_profesional($array_where = null) {
        $query = $this->db->get('cejercicio_profesional');
        $estadoCivil = $query->result_array();
        $query->free_result();
        return $estadoCivil;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "cestado_civil" 
     * "EJER_PREDOMI_CVE"  ,  "EJE_PRE_NOMBRE"
     * 
     */
    public function get_cejercicio_predominante($array_where = null) {
        $query = $this->db->get('cejercicio_predominante');
        $estadoCivil = $query->result_array();
        $query->free_result();
        return $estadoCivil;
    }

    public function delete_comprobante($id_comprobante = null) {
        $result_comprobante['result'] = -1;
        $result_comprobante['entidad'] = '';
        if (is_null($id_comprobante)) {
            return $result_comprobante;
        }

        $res = $this->get_comprobante($id_comprobante);
        if (!empty($res)) {
            $res = $res[0];
            $this->db->where('COMPROBANTE_CVE', $id_comprobante);
            $this->db->delete('comprobante');
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $result_comprobante['result'] = $id_comprobante;
                $result_comprobante['entidad'] = $res;
            }
        }
        return $result_comprobante;
    }

    /**
     * 
     * @param autor LEAS
     * @param type $id_comprobante
     * @return type
     */
    public function get_comprobante($id_comprobante = null) {
        if (!is_null($id_comprobante)) {
            $this->db->where('COMPROBANTE_CVE', $id_comprobante);
        }
        $query = $this->db->get('comprobante');
        $array_comprobante = $query->result_array();
        $query->free_result();
        return $array_comprobante;
    }

    /**
     * 
     * @param autor LEAS
     * @param type $array_campos
     * @return type
     */
    public function insert_comprobante($array_campos) {
        if (is_null($array_campos)) {
            return -1;
        }
        $this->db->insert('comprobante', $array_campos); //Almacena usuario
        $obtiene_id_comprobante = $this->db->insert_id();
//        pr($this->db->last_query());
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return -1;
        } else {
            return $obtiene_id_comprobante;
        }
    }

    public function update_comprobante($id_comprobante = null, $parametros_comprobante = null) {
        $result_comprobante['result'] = -1;
        $result_comprobante['entidad'] = '';
        if (is_null($id_comprobante)) {
            return $result_comprobante;
        }
        if (is_null($parametros_comprobante)) {
            return $result_comprobante;
        }

        if (!empty($res)) {
            $this->db->where('COMPROBANTE_CVE', $id_comprobante);
            $this->db->update('comprobante');
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $result_comprobante['result'] = $id_comprobante;
                $parametros_comprobante['COMPROBANTE_CVE'] = $id_comprobante;
                $result_comprobante['entidad'] = $parametros_comprobante;
            }
        }
        return $result_comprobante;
    }

    /**
     * @param autor LEAS
     * @fecha 29/08/2016
     * @param type $delegacion_cve
     * @return type Objet con la convocatoria asociada a la delegación
     * La consulta obtiene la convocatoria relacionada con la delegación, demás, 
     * si existe más de una convocatoria asociada a la delegación, entonces,
     * obtiene el maximo id de la convocatoría
     * Por etro lado regresa el estado de las fechas
     * 
     */
    public function get_convocatoria_delegacion($delegacion_cve = null) {
        $select = 'select vc.VAL_CON_CVE "convocatoria_cve",
        if(now() < vc.VAL_CON_FCH_INICIO_ACTUALIZACION, "sin", 
       	(if(now() between vc.VAL_CON_FCH_INICIO_ACTUALIZACION and vc.VAL_CON_FCH_FIN_ACTUALIZACION, "act", 
       (if(now() between vc.VAL_CON_FCH_INICIO_VALIDACION_FASE_I and vc.VAL_CON_FCH_FIN_VALIDACION_FASE_I,"vf1",
        (if(now() between vc.VAL_CON_FCH_INICIO_VALIDACION_FASE_II and vc.VAL_CON_FCH_FIN_VALIDACION_FASE_II, "vf2", "nap")))))))
        "aplica_convocatoria"
        from validacion_convocatoria vc
        
        where vc.VAL_CON_CVE in 
        (select max(vcp.VAL_CON_CVE) from validacion_convocatoria_delegacion vcd 
        join validacion_convocatoria vcp on vcp.VAL_CON_CVE = vcd.VAL_CON_CVE
        where vcd.VAL_CON_DEL_CVE = ' . $delegacion_cve . ')';
        $num_rows = $this->db->query($select)->result();
//        pr($this->db->last_query());
        if (!empty($num_rows)) {
            $num_rows = $num_rows[0];
        }
        return $num_rows;
    }

    /**
     * 
     * @param type $MODULO_CVE Modulo cve hace referencia al módulo descrito en 
     * el archivo de constantes "En_cat_mod" 
     * @param type $nom_campo
     * @return type
     */
    public function get_condiciones_modulos_($MODULO_CVE = null, $nom_campo = null) {
        if (is_null($MODULO_CVE) AND is_null($nom_campo)) {
            return array();
        }
        $this->db->select($nom_campo . ' as cve'); //Nombre del campo de la entidad solicitada
        $this->db->where('MODULO_CVE', $MODULO_CVE);
        $this->db->where($nom_campo.' is not null');
        $query = $this->db->get('campos_catalogos');
        $array_comprobante = $query->result_array();
        $query->free_result();
//        pr($this->db->last_query());
        return $array_comprobante;
    }
    
    /*
     * Retorna catálogo posibles dictamenes para asignar
     * Return   ResultSet Array
     */
    public function get_cat_dictamen_result(){
//        $sql = "SELECT * FROM ccategoria_dictamen";
        $query = $this->db->get('ccategoria_dictamen'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); 
        return $resultado;
    }

//Function getALL is Deprecated from this model, now, it's located in Expediente_model...
    /* Clase que gestiona el login
     * @version     : 1.0.0
     * @autor       : Mr. Guag
     * @date: 26/09/2016
     * @attributes: 
     *              $empleado_cve: Id del empleado
     *              $validado: si es nulo ignora la condición; si es TRUE busca todos los registros validados, 
     *                          si es FALSE busca todos los registros sin validación.
     *              $where: debe ir con el formato array("campo"=>valor)
     * @returns: Mixed array()
     * @comments: Usa el archivo de configuración con el arreglo asosiativo
     *               $config["get_secciones"]
     *               @acronimo : clave diminutiva para identificar el curso
     *               @entidad : Nombre de la entidad en la base de datos
     *               @curso : Nombre del curso o campo de donde se optiene el nombre del curso
     *               @tipo_curso: Tipo de curso 
     *               @pk : Llave primaria de la entidad en base de datos
     *               @model : nombre del modelo 
     *               @function : nombre de la funcion que regresa los datos de la sección
     */
    /*function getAll($empleado_cve = null, $validado = null, $where = null) {
        if (is_null($empleado_cve)) {
            throw new Exception('Id de usuario nulo');
        }

        //información del profesor
        $parametros = array("conditions"=>array("empleado_cve"=>$empleado_cve));

        $this->load->model("Empleado_model", "emp");
        $data["empleado"] = $this->emp->getEmpECD($parametros);

        if (!is_null($validado)) {
            if (is_bool($validado)) {
                $parametros["conditions"]["IS_VALIDO_PROFESIONALIZACION"]=$validado;
            } else {
                throw new Exception('La función espera un valor booleano');
            }
        }
        
        $this->lang->load('interface', 'spanish');

        //Etiquetas
        $data["string_value"] = $this->lang->line('interface_secd') + $this->lang->line('interface')["secciones"];
        // $data["cfg_actividad"] = $this->config->item("get_secciones");
        $secciones = $this->config->item("secciones_model");

        foreach ($secciones as $key => $seccion) {
            $params["conditions"] = (isset($where[$key]) && !is_null($where[$key])) ? array_merge($parametros["conditions"], $where[$key]) : $parametros["conditions"];
            
            $this->load->model($seccion["model"], $seccion["acronimo"]);
            $res = $this->{$seccion["acronimo"]}->$seccion["function"]($params);
            unset($seccion["model"]);
            unset($seccion["function"]);
            if (!empty($res)) {
                $data["actividades"][$seccion["acronimo"]] = $res;
                $data["labels"][$seccion["acronimo"]] = "lbl_" . $seccion["acronimo"] . "_titulo";
                $data["cfg_actividad"][$seccion["acronimo"]] = $seccion;
            }
        }
        return $data;
    }
*/

}
