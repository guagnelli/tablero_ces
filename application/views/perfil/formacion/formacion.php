<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/javascript">
var confirmar_eliminacion = "<?php echo $string_values['confirmar_eliminacion']; ?>";
</script>
<?php echo js('perfil/formacion.js'); 
if($this->seguridad->verificar_liga_agregar_docente()){
    $readonly = '';
    $disabled = '';
} else {
    $readonly = 'readonly';
    $disabled = 'disabled';
}?>
    <ul id="tabList" class="nav nav-tabs">
        <li class="active">
            <a data-toggle="tab" href="#formacionPersonalSalud">
                <strong>
                    <?php echo $string_values['lbl_formacion_personal_salud']; ?>
                </strong>
            </a>
        </li>
        <li>
            <a data-toggle="tab" href="#formacionDocente">
                <strong>
                    <?php echo $string_values['lbl_formacion_docente']; ?>
                </strong>
            </a>
        </li>
    </ul>
    <div id = 'tabContentFormacion' class='tab-content col-md-12'>
        <div id = 'formacionPersonalSalud' class = 'tab-pane fade in active'>
            <div class="panel">
                <div class="panel-body">
                    <div id="mensaje1"></div>
                    <?php echo form_open('perfil#seccion_formacion', array('id'=>'formulario_ejercicio_profesional')); ?>
                    <div class="row">
                        <div class='col-sm-12 col-md-12 col-lg-3 text-right'>
                            <label class="control-label">
                                * <?php echo $string_values['lbl_ejercicio_profesional']; ?>:
                            </label>
                        </div>
                        <div class='col-sm-12 col-md-12 col-lg-7 text-left'>
                            <div class="form-group">
                                <div class="input-group">
                                    <?php
                                    echo $this->form_complete->create_element(array('id'=>'ejercicio_profesional', 'type'=>'dropdown', 'value'=>$ejercicio_profesional['emp_eje_pro_cve'], 'options'=>$catalogos['cejercicio_profesional'], 'first'=>array(''=>'Selecciona...'), 'attributes'=>array('class'=>'form-control', $readonly => $readonly, $disabled => $disabled, 'placeholder'=>$string_values['lbl_ejercicio_profesional'], 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>$string_values['lbl_ejercicio_profesional'])));
                                    ?>                      
                                </div>
                            </div>
                            <div id="error_ejercicio_profesional"></div>
                        </div>
                        <?php if($this->seguridad->verificar_liga_agregar_docente()){ ?>
                            <div class='col-sm-12 col-md-12 col-lg-2 text-right'>
                                <div>
                                    <button type="button" aria-expanded="false" class="btn btn-success btn_agregar_ejercicio">
                                        <?php echo $string_values['btn_guardar']; ?>
                                    </button>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php echo form_close();
                    $vista_formacion_salud = (empty($ejercicio_profesional['emp_eje_pro_cve'])) ? 'display:none;' : 'display:block;'; ?>
                    
                    <div id="div_datos_salud" style="<?php echo $vista_formacion_salud; ?>">                    
                        <div class="panel-group" id="accordionSalud" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOneSalud">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordionSalud" href="#collapseSalud<?php echo $this->config->item('EFPCS_FOR_INICIAL')['INICIAL']['id']; ?>" aria-expanded="true" aria-controls="collapseSalud<?php echo $this->config->item('EFPCS_FOR_INICIAL')['INICIAL']['id']; ?>">
                                            <?php echo $string_values['lbl_formacion_salud_opc']; //Formación docente ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseSalud<?php echo $this->config->item('EFPCS_FOR_INICIAL')['INICIAL']['id']; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOneSalud" data-value="<?php echo $this->config->item('EFPCS_FOR_INICIAL')['INICIAL']['id']; ?>">
                                    <div class="panel-body">
                                    <div class="row">
                                        <?php if($this->seguridad->verificar_liga_agregar_docente()){ ?>
                                            <div class='col-sm-12 col-md-12 col-lg-12 text-right'>
                                                <div>
                                                    <button type="button" aria-expanded="false" class="btn btn-success btn_agregar_formacion_salud_modal" data-toggle="modal" data-target="#modal_censo" data-value="1">
                                                        <?php echo $string_values['btn_add_new_formacion_salud']; ?>
                                                    </button>
                                                </div>
                                            </div>                                            
                                        <?php } ?>
                                    </div><br>
                                        <div id="list_formacion_salud_inicial">                                        
                                            <table class='table table-striped'>
                                                <thead>
                                                    <tr>
                                                        <th><?php echo $string_values['validado']; ?></th>
                                                        <th><?php echo $string_values['lbl_fecha_inicio']; ?></th>
                                                        <th><?php echo $string_values['lbl_fecha_final']; ?></th>
                                                        <th><?php echo $string_values['lbl_tipo_formacion']; ?></th>
                                                        <th><?php echo $string_values['t_h_comprobante']; ?></th>
                                                        <th><?php echo $string_values['opciones']; ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($formacion_salud['inicial'] as $key_ini => $fsi) {
                                                        $id = $this->seguridad->encrypt_base64($fsi['FPCS_CVE']);
                                                        $validation_estado = (isset($fsi['validation_estado']) && !empty($fsi['validation_estado'])) ? $fsi['validation_estado'] : null;
                                                        $btn_comprobante = (!is_null($fsi['COMPROBANTE_CVE'])) ? '<a href="'.site_url('administracion/ver_archivo/'.$this->seguridad->encrypt_base64($fsi['COMPROBANTE_CVE'])).'" target="_blank">'.$string_values['lbl_ver_comprobante'].'</a>' : '';
                                                        $btn_eliminar = ($this->seguridad->verificar_liga_eliminar_docente($fsi['IS_VALIDO_PROFESIONALIZACION'])) ? '<button type="button" class="btn btn-link btn-sm btn_eliminar_fi" data-value="'.$id.'">'.$string_values['eliminar'].'</button>' : '';
                                                        $btn_editar = ($this->seguridad->verificar_liga_editar_docente($fsi['IS_VALIDO_PROFESIONALIZACION'], $validation_estado)) ? '<button type="button" class="btn btn-link btn-sm btn_editar_fi" aria-expanded="false" data-toggle="modal" data-target="#modal_censo" data-value="'.$id.'">'.$string_values['editar'].'</button>' : '';
                                                        echo '<tr id="tr_'.$id.'">
                                                                <td class="text-center">'.$this->seguridad->html_verificar_valido_profesionalizacion($fsi['IS_VALIDO_PROFESIONALIZACION']).'</td>
                                                                <td>'.nice_date($fsi['EFPCS_FCH_INICIO'], 'm-Y').'</td>
                                                                <td>'.nice_date($fsi['EFPCS_FCH_FIN'], 'm-Y').'</td>
                                                                <td>'.$fsi['TIP_FORM_SALUD_NOMBRE'].((!empty($fsi['SUBTIP_NOMBRE'])) ? ' > '.$fsi['SUBTIP_NOMBRE'] : '').'</td>
                                                                <td>'.$btn_comprobante.'</td>
                                                                <td><button type="button" class="btn btn-link btn-sm btn_ver_fs" aria-expanded="false" data-toggle="modal" data-target="#modal_censo" data-value="'.$id.'" onclick="ver_fs(this);">'.
                                                                       $string_values['ver'].
                                                                    '</button>
                                                                    '.$btn_editar.'
                                                                    '.$btn_eliminar.'
                                                                </td>
                                                            </tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwoSalud">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionSalud" href="#collapseSalud<?php echo $this->config->item('EFPCS_FOR_INICIAL')['CONTINUA']['id']; ?>" aria-expanded="false" aria-controls="collapseSalud<?php echo $this->config->item('EFPCS_FOR_INICIAL')['CONTINUA']['id']; ?>">
                                            <?php echo $string_values['lbl_formacion_continua_salud_opc']; ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseSalud<?php echo $this->config->item('EFPCS_FOR_INICIAL')['CONTINUA']['id']; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwoSalud" data-value="<?php echo $this->config->item('EFPCS_FOR_INICIAL')['CONTINUA']['id']; ?>">
                                    <div class="panel-body">
                                        <?php if($this->seguridad->verificar_liga_agregar_docente()){ ?>
                                            <div class="row">
                                                <div class='col-sm-12 col-md-12 col-lg-12 text-right'>
                                                    <div>
                                                        <button type="button" aria-expanded="false" class="btn btn-success btn_agregar_formacion_salud_modal" data-toggle="modal" data-target="#modal_censo" data-value="2">
                                                            <?php echo $string_values['btn_add_new_formacion_salud']; ?>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div><br>
                                        <?php } ?>
                                        <div id="list_formacion_salud_continua">
                                            <table class='table table-striped'>
                                                <thead>
                                                    <tr>
                                                        <th><?php echo $string_values['validado']; ?></th>
                                                        <th><?php echo $string_values['lbl_fecha_inicio']; ?></th>
                                                        <th><?php echo $string_values['lbl_fecha_final']; ?></th>
                                                        <th><?php echo $string_values['lbl_tipo_formacion']; ?></th>
                                                        <th><?php echo $string_values['t_h_comprobante']; ?></th>
                                                        <th><?php echo $string_values['opciones']; ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($formacion_salud['continua'] as $key_ini => $fsi) {
                                                        $id = $this->seguridad->encrypt_base64($fsi['FPCS_CVE']);
                                                        $validation_estado = (isset($fsi['validation_estado']) && !empty($fsi['validation_estado'])) ? $fsi['validation_estado'] : null;
                                                        $btn_comprobante = (!is_null($fsi['COMPROBANTE_CVE'])) ? '<a href="'.site_url('administracion/ver_archivo/'.$this->seguridad->encrypt_base64($fsi['COMPROBANTE_CVE'])).'" target="_blank">'.$string_values['lbl_ver_comprobante'].'</a>' : '';
                                                        $btn_eliminar = ($this->seguridad->verificar_liga_eliminar_docente($fsi['IS_VALIDO_PROFESIONALIZACION'])) ? '<button type="button" class="btn btn-link btn-sm btn_eliminar_fi" data-value="'.$id.'">'.$string_values['eliminar'].'</button>' : '';
                                                        $btn_editar = ($this->seguridad->verificar_liga_editar_docente($fsi['IS_VALIDO_PROFESIONALIZACION'], $validation_estado)) ? '<button type="button" class="btn btn-link btn-sm btn_editar_fi" aria-expanded="false" data-toggle="modal" data-target="#modal_censo" data-value="'.$id.'">'.$string_values['editar'].'</button>' : '';
                                                        echo '<tr id="tr_'.$id.'">
                                                                <td class="text-center">'.$this->seguridad->html_verificar_valido_profesionalizacion($fsi['IS_VALIDO_PROFESIONALIZACION']).'</td>
                                                                <td>'.nice_date($fsi['EFPCS_FCH_INICIO'], 'm-Y').'</td>
                                                                <td>'.nice_date($fsi['EFPCS_FCH_FIN'], 'm-Y').'</td>
                                                                <td>'.$fsi['TIP_FORM_SALUD_NOMBRE'].((!empty($fsi['SUBTIP_NOMBRE'])) ? ' > '.$fsi['SUBTIP_NOMBRE'] : '').'</td>
                                                                <td>'.$btn_comprobante.'</td>
                                                                <td><button type="button" class="btn btn-link btn-sm btn_ver_fs" aria-expanded="false" data-toggle="modal" data-target="#modal_censo" data-value="'.$id.'" onclick="ver_fs(this);">'.
                                                                       $string_values['ver'].
                                                                    '</button>
                                                                    '.$btn_editar.'
                                                                    '.$btn_eliminar.'
                                                                </td>
                                                            </tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                </div>
            </div>
        </div>
        <div id = 'formacionDocente' class = 'tab-pane fade'>
            <div class="panel">
                <div class="panel-body">
                    <div id="mensaje"></div>
                    <?php if($this->seguridad->verificar_liga_agregar_docente()){ ?>
                        <div class="row">
                            <div class='col-sm-12 col-md-12 col-lg-12 text-right'>
                                <div>
                                    <button type="button" aria-expanded="false" class="btn btn-success btn_agregar_formacion_docente_modal" data-toggle="modal" data-target="#modal_censo" data-value="">
                                        <?php echo $string_values['btn_add_new_formacion_docente']; ?>
                                    </button>
                                </div>
                            </div>
                        </div><br>
                    <?php
                    }
                    foreach ($catalogos['ctipo_formacion_profesional'] as $key_tfp => $formacion) { ?>
                        <div class="panel-group" id="accordion<?php echo $key_tfp; ?>" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading<?php echo $key_tfp; ?>">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion<?php echo $key_tfp; ?>" href="#collapse<?php echo $key_tfp; ?>" aria-expanded="true" aria-controls="collapse<?php echo $key_tfp; ?>">
                                            <?php echo $formacion; //Formación docente ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse<?php echo $key_tfp; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading<?php echo $key_tfp; ?>">
                                    <div class="panel-body">
                                        <div id="list_tfp<?php echo $key_tfp; ?>">                                        
                                            <?php
                                            if($this->config->item('tipo_curso')['FORMACION_CONTINUA']['id']==$key_tfp){ 
                                                foreach ($catalogos['csubtipo_formacion_profesional'] as $key_sfp => $subtipo) { ?>
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="heading<?php echo $key_tfp.'_'.$key_sfp; ?>">
                                                            <h4 class="panel-title">
                                                                <a role="button" data-toggle="collapse" data-parent="#accordion<?php echo $key_tfp.'_'.$key_sfp; ?>" href="#collapse<?php echo $key_tfp.'_'.$key_sfp; ?>" aria-expanded="true" aria-controls="collapse<?php echo $key_tfp.'_'.$key_sfp; ?>">
                                                                    <?php echo $subtipo; //Formación docente ?>
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse<?php echo $key_tfp.'_'.$key_sfp; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading<?php echo $key_tfp.'_'.$key_sfp; ?>">
                                                            <div class="panel-body">
                                                                <div id="list_sfp_<?php echo $key_tfp.'_'.$key_sfp; ?>">                                        
                                                                    <div id="div_formacion_docente_<?php echo $key_tfp.'_'.$key_sfp; ?>" class="table-responsive">
                                                                        <table class="table table-striped table-hover table-bordered" id="tabla_formacion_docente_<?php echo $key_tfp.'_'.$key_sfp; ?>">
                                                                            <thead>
                                                                                <tr class='btn-default'>
                                                                                    <th><?php echo $string_values['validado']; ?></th>
                                                                                    <th><?php echo $string_values['t_h_anio']; ?></th>
                                                                                    <th><?php echo $string_values['lbl_tipo_formacion_docente']; ?></th>
                                                                                    <th><?php echo $string_values['t_h_curso']; ?></th>
                                                                                    <th><?php echo $string_values['t_h_institucion']; ?></th>
                                                                                    <th><?php echo $string_values['t_h_modalidad']; ?></th>
                                                                                    <th><?php echo $string_values['t_h_comprobante']; ?></th>
                                                                                    <th><?php echo $string_values['opciones']; ?></th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php //Generará la tabla que muestrá las actividades del docente
                                                                                if(isset($formacion_docente) && array_key_exists($key_tfp, $formacion_docente) && array_key_exists($key_sfp, $formacion_docente[$key_tfp])){
                                                                                    //pr($key_tfp);
                                                                                    //pr($formacion_docente);
                                                                                    if(count($formacion_docente[$key_tfp][$key_sfp])>0) {
                                                                                        foreach ($formacion_docente[$key_tfp][$key_sfp] as $key_fd => $for_doc) {
                                                                                            $id = $this->seguridad->encrypt_base64($for_doc['EMP_FORMACION_PROFESIONAL_CVE']);
                                                                                            $validation_estado = (isset($for_doc['validation_estado']) && !empty($for_doc['validation_estado'])) ? $for_doc['validation_estado'] : null;
                                                                                            $btn_comprobante = (!is_null($for_doc['COMPROBANTE_CVE'])) ? '<a href="'.site_url('administracion/ver_archivo/'.$this->seguridad->encrypt_base64($for_doc['COMPROBANTE_CVE'])).'" target="_blank">'.$string_values['lbl_ver_comprobante'].'</a>' : '';
                                                                                            $btn_eliminar = ($this->seguridad->verificar_liga_eliminar_docente($for_doc['IS_VALIDO_PROFESIONALIZACION'])) ? '<button type="button" class="btn btn-link btn-sm btn_eliminar_fd" data-value="'.$id.'">'.$string_values['eliminar'].'</button>' : '';
                                                                                            $btn_editar = ($this->seguridad->verificar_liga_editar_docente($for_doc['IS_VALIDO_PROFESIONALIZACION'], $validation_estado)) ? '<button type="button" class="btn btn-link btn-sm btn_editar_fd" aria-expanded="false" data-toggle="modal" data-target="#modal_censo" data-value="'.$id.'">'.$string_values['editar'].'</button>' : '';
                                                                                            echo '<tr id="tr_'.$id.'">
                                                                                                <td class="text-center">'.$this->seguridad->html_verificar_valido_profesionalizacion($for_doc['IS_VALIDO_PROFESIONALIZACION']).'</td>
                                                                                                <td>'.$for_doc['EFO_ANIO_CURSO'].'</td>
                                                                                                <td>'.$for_doc['TIP_FOR_PRO_NOMBRE'].((isset($for_doc['SUB_FOR_PRO_NOMBRE']) && !empty($for_doc['SUB_FOR_PRO_NOMBRE'])) ? ' > '.$for_doc['SUB_FOR_PRO_NOMBRE'] : '').'</td>
                                                                                                <td>'.$for_doc['CUR_NOMBRE'].'</td>
                                                                                                <td>'.$for_doc['IA_NOMBRE'].'</td>
                                                                                                <td>'.$for_doc['MOD_NOMBRE'].'</td>
                                                                                                <td>'.$btn_comprobante.'</td>
                                                                                                <td><button type="button" class="btn btn-link btn-sm btn_ver_fd" aria-expanded="false" data-toggle="modal" data-target="#modal_censo" data-value="'.$id.'" onclick="ver_fd(this);">'.
                                                                                                       $string_values['ver'].
                                                                                                    '</button>
                                                                                                    '.$btn_editar.'
                                                                                                    '.$btn_eliminar.'
                                                                                                </td>
                                                                                            </tr>';
                                                                                        }
                                                                                    } else {
                                                                                        echo '<tr><td colspan="6">'.$string_values['lbl_no_registros'].'</td></tr>';
                                                                                    }
                                                                                } else {
                                                                                    echo '<tr><td colspan="6">'.$string_values['lbl_no_registros'].'</td></tr>';
                                                                                }
                                                                                ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><br>
                                                <?php }
                                            } else { //Listar registros que no cuentan con subtipo ?>
                                                <div id="list_sfp_<?php echo $key_tfp; ?>">                                        
                                                    <div id="div_formacion_docente_<?php echo $key_tfp; ?>" class="table-responsive">
                                                        <table class="table table-striped table-hover table-bordered" id="tabla_formacion_docente_<?php echo $key_tfp; ?>">
                                                            <thead>
                                                                <tr class='btn-default'>
                                                                    <th><?php echo $string_values['validado']; ?></th>
                                                                    <th><?php echo $string_values['t_h_anio']; ?></th>
                                                                    <th><?php echo $string_values['lbl_tipo_formacion_docente']; ?></th>
                                                                    <th><?php echo $string_values['t_h_curso']; ?></th>
                                                                    <th><?php echo $string_values['t_h_institucion']; ?></th>
                                                                    <th><?php echo $string_values['t_h_modalidad']; ?></th>
                                                                    <th><?php echo $string_values['t_h_comprobante']; ?></th>
                                                                    <th><?php echo $string_values['opciones']; ?></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php //Generará la tabla que muestrá las actividades del docente
                                                                if(isset($formacion_docente) && array_key_exists($key_tfp, $formacion_docente)){
                                                                    if(count($formacion_docente[$key_tfp][0])>0) {
                                                                        foreach ($formacion_docente[$key_tfp][0] as $key_fd => $for_doc) {
                                                                            $id = $this->seguridad->encrypt_base64($for_doc['EMP_FORMACION_PROFESIONAL_CVE']);
                                                                            $validation_estado = (isset($for_doc['validation_estado']) && !empty($for_doc['validation_estado'])) ? $for_doc['validation_estado'] : null;
                                                                            $btn_comprobante = (!is_null($for_doc['COMPROBANTE_CVE'])) ? '<a href="'.site_url('administracion/ver_archivo/'.$this->seguridad->encrypt_base64($for_doc['COMPROBANTE_CVE'])).'" target="_blank">'.$string_values['lbl_ver_comprobante'].'</a>' : '';
                                                                            $btn_eliminar = ($this->seguridad->verificar_liga_eliminar_docente($for_doc['IS_VALIDO_PROFESIONALIZACION'])) ? '<button type="button" class="btn btn-link btn-sm btn_eliminar_fd" data-value="'.$id.'">'.$string_values['eliminar'].'</button>' : '';
                                                                            $btn_editar = ($this->seguridad->verificar_liga_editar_docente($for_doc['IS_VALIDO_PROFESIONALIZACION'], $validation_estado)) ? '<button type="button" class="btn btn-link btn-sm btn_editar_fd" aria-expanded="false" data-toggle="modal" data-target="#modal_censo" data-value="'.$id.'">'.$string_values['editar'].'</button>' : '';
                                                                            echo '<tr id="tr_'.$id.'">
                                                                                <td class="text-center">'.$this->seguridad->html_verificar_valido_profesionalizacion($for_doc['IS_VALIDO_PROFESIONALIZACION']).'</td>
                                                                                <td>'.$for_doc['EFO_ANIO_CURSO'].'</td>
                                                                                <td>'.$for_doc['TIP_FOR_PRO_NOMBRE'].((isset($for_doc['SUB_FOR_PRO_NOMBRE']) && !empty($for_doc['SUB_FOR_PRO_NOMBRE'])) ? ' > '.$for_doc['SUB_FOR_PRO_NOMBRE'] : '').'</td>
                                                                                <td>'.$for_doc['CUR_NOMBRE'].'</td>
                                                                                <td>'.$for_doc['IA_NOMBRE'].'</td>
                                                                                <td>'.$for_doc['MOD_NOMBRE'].'</td>
                                                                                <td>'.$btn_comprobante.'</td>
                                                                                <td><button type="button" class="btn btn-link btn-sm btn_ver_fd" aria-expanded="false" data-toggle="modal" data-target="#modal_censo" data-value="'.$id.'" onclick="ver_fd(this);">'.
                                                                                       $string_values['ver'].
                                                                                    '</button>
                                                                                    '.$btn_editar.'
                                                                                    '.$btn_eliminar.'
                                                                                </td>
                                                                            </tr>';
                                                                        }
                                                                    } else {
                                                                        echo '<tr><td colspan="6">'.$string_values['lbl_no_registros'].'</td></tr>';
                                                                    }
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>