<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>
    </script>
    <div class="">
        <div class="">
                <div class="panel-body">
                            <div class='row'>
                                <div class="col-md-6">
                                    <label for='Seleccione tipo de curso' class="control-label">
                                         <?php echo $string_values['lbl_tipo_curso']; ?>
                                    </label>
                                    <div class="input-group">
                                        <label class="registro"><?php echo isset($TIP_CUR_NOMBRE) ? $TIP_CUR_NOMBRE : ''; ?></label>
                                        <?php 
                                            /*echo $this->form_complete->create_element(array('id' => 'ctipo_curso', 'type' => 'dropdown', 
                                                'options' => $ctipo_curso, 
                                                'first' => array('' => $string_values['drop_tipo_curso']), 
                                                'value' => isset($ctipo_curso_cve)? $ctipo_curso_cve: '',
                                                'attributes' => array('name' => 'categoria', 'class' => 'form-control', 
                                                'placeholder' => 'Categoría', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 
                                                'onchange' =>  "cargar_curso()",
                                                'title' => $string_values['lbl_tipo_curso'] ))); */
                                        ?>
                                   </div>
                                </div>
                                <div class="col-md-6" id="curso_div_gen">
                                   <?php  if(isset($ccurso_pinta)){ 
                                       echo $ccurso_pinta;   
                                   }?>
                                </div>
                                
                            </div>
                                
                            <div class='row'>
                                <div class="col-md-6">
                                    <label for='lbl_institucion_edu_avala' class="control-label">
                                         <?php echo $string_values['lbl_institucion_edu_avala']; ?>
                                    </label>
                                    <div class="input-group">
                                        <label class="registro"><?php echo isset($IA_NOMBRE) ? $IA_NOMBRE : ''; ?></label>
                                   </div>
                                </div>
                                <div class="col-md-6">
                                    <label for='lbl_recibe_pago_extra' class="control-label">
                                         <?php echo $string_values['lbl_recibe_pago_extra']; ?>
                                    </label>
                                    <div class='row'>
                                        <div class="col-md-12 text-left">
                                            <label class="registro"><?php echo (isset($pago_extra) AND $pago_extra === '1') ? 'Si' : 'No' ; ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="col-md-6">
                                    <label for='lbl_tipo_formacion_profesional' class="control-label">
                                         <?php echo $string_values['lbl_tipo_formacion_profesional']; ?>
                                    </label>
                                    <div class="input-group">
                                        <label class="registro"><?php echo isset($TIP_FOR_PRO_NOMBRE) ? $TIP_FOR_PRO_NOMBRE : ''; ?></label>
                                   </div>
                                </div>
                                <div class="col-md-6">
                                     <label for='lbl_rol_desempenia' class="control-label">
                                         <?php echo $string_values['lbl_rol_desempenia']; ?>
                                    </label>
                                    <div class="input-group">
                                        <label class="registro"><?php echo isset($ROL_DESEMPENIA) ? $ROL_DESEMPENIA : ''; ?></label>
                                   </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="col-md-6">
                                        <label for='lbl_anio_que_impartio_curso' class="control-label">
                                            <?php echo $string_values['lbl_anio_que_impartio_curso']; ?>
                                        </label>
                                        <div class="input-group date datepicker" id="datetimepicker_anio">
                                            <label class="registro"><?php echo $actividad_anios_dedicados_docencia; ?></label>
                                        </div>
                                </div>
                                <div class="col-md-6">
                                    <label for='lbl_modalidad' class="control-label">
                                         <?php echo $string_values['lbl_modalidad']; ?>
                                    </label>
                                    <div class="input-group">
                                        <label class="registro"><?php echo isset($MOD_NOMBRE) ? $MOD_NOMBRE : ''; ?></label>
                                   </div>
                                </div>
                            </div>
                            <br>
                            <div class='row'>
                                <div class="col-md-12 text-center">
                                    <label for='lbl_duracion' class="control-label">
                                        <?php echo $string_values['lbl_duracion']; ?>
                                    </label>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-sm-6 col-lg-6' id="div_horas_dedicadas" style="<?php echo $mostrar_hora_fecha_duracion==='hora_dedicadas'?'display: block':'display: none';?>">
                                    <label for='lbl_duracion_horas' class="control-label">
                                        <?php echo $string_values['radio_duracion_horas']; ?>
                                    </label>
                                    <div class="input-group">
                                        <label class="registro"><?php echo (isset($hora_dedicadas))?$hora_dedicadas:''; ?></label>
                                    </div>
                                </div>
                                <div class='col-sm-6 col-lg-6 text-center' id="fecha_inicio" style="<?php echo $mostrar_hora_fecha_duracion==='fecha_dedicadas'?'display: block':'display: none';?>">
                                    <label for='lbl_duracion_fecha_inicio' class="control-label">
                                        <?php echo $string_values['lbl_duracion_fecha_inicio']; ?>
                                    </label>

                                    <div class="form-group">
                                        <div class="input-group date" id="datetimepicker1" >
                                            <label class="registro"><?php echo $fecha_inicio_pick; ?></label>
                                        </div>
                                    </div>
                                </div>

                                <div class='col-sm-6 text-center' id="fecha_fin" style="<?php echo $mostrar_hora_fecha_duracion==='fecha_dedicadas'?'display: block':'display: none';?>">
                                    <label for='radio_duracion_fecha' class="control-label">
                                        <?php echo $string_values['lbl_duracion_fecha_final']; ?>
                                    </label>
                                    <div class="form-group">
                                        <div class='input-group date' id='datetimepicker2'>
                                            <label class="registro"><?php echo $fecha_fin_pick; ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <?php echo $formulario_carga_archivo; ?>
                            <?php echo $formulario_validacion; ?>
                    </div>
                </div>
            </div>
