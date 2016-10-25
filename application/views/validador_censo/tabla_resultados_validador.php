<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//pr($lista_unidades);
?>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/validacion_docente/validar_censo.js"></script>
<div id="tabla_designar_validador" class="col-lg-12 table-responsive">
    <!--Mostrará la tabla de actividad docente --> 
    <table class="table table-striped table-hover table-bordered" id="tabla_investigacion_docente">
        <thead>
            <tr class="bg-info">
                <th><?php echo $string_values['titulo_tab_matricula'] ?></th>
                <th><?php echo $string_values['titulo_tab_nombre'] ?></th>
                <th><?php echo $string_values['titulo_tab_categoria'] ?></th>
                <th><?php echo $string_values['titulo_tab_fecha_ultimo_estado'] ?></th>
                <th><?php echo $string_values['titulo_tab_estado_validacion'] ?></th>
                <th><?php echo $string_values['titulo_tab_ver_ultimo_comentario'] ?></th>
                <th><?php echo $string_values['titulo_tab_validar_cursos'] ?></th>
                <!--<th>Opciones</th>-->
            </tr>
        </thead >
        <tbody>
            <?php
            foreach ($lista_docentes_validar as $key_ai => $val) {
//                pr($val['hist_validacion_cve']);
                $empleado_cve = $this->seguridad->encrypt_base64(intval($val['empleado_cve']));
                $matricula = $this->seguridad->encrypt_base64($val['matricula']);
                $estado_val = $this->seguridad->encrypt_base64(intval($val['estado_validacion']));
                $validador_cve = $this->seguridad->encrypt_base64(intval($val['validador_cve']));
                $hist_val_cve = $this->seguridad->encrypt_base64(intval($val['hist_validacion_cve']));
                $val_grl_cve = $this->seguridad->encrypt_base64(intval($val['validaor_grl_cve']));
                $usuario_cve = $this->seguridad->encrypt_base64(intval($val['usuario_cve']));
                $convocatoria_cve = $this->seguridad->encrypt_base64(intval($val['convocatoria_cve']));
                $link_ver_comentario = '';
                if(intval($val['is_comentario'])===1){//link_ver_comentario
                $link_ver_comentario = '<button '
                            . 'id="btn_ver_comentario" '
                            . 'type="button" '
                            . 'class="btn btn-link btn-sm" '
                            . 'data-idrow ="' . $key_ai . '"'
                            . 'data-empcve="' . $empleado_cve . '"' 
                            . 'data-convocatoriacve="' . $convocatoria_cve . '"'
                            . 'data-toggle="modal"'
                            . 'data-target="#modal_censo"'
                            . 'onclick="ver_comentario_estado_doc(this)" >' .
                            $string_values['link_ver_comentario']
                            . '</button>';
                }
                $link_ver_curso = 'class="text-center" onclick="funcion_ver_validacion_empleado(this)" '
                        . 'data-empcve="' . $empleado_cve . '"' 
                        . 'data-matricula="' . $matricula . '"' 
                        . 'data-estval="' . $estado_val . '"' 
                        . 'data-validadorcve="' . $validador_cve . '"' 
                        . 'data-histvalcve="' . $hist_val_cve . '"' 
                        . 'data-valgrlcve="' . $val_grl_cve . '"' 
                        . 'data-usuariocve="' . $usuario_cve . '"'
                        . 'data-convocatoriacve="' . $convocatoria_cve . '"';
                echo "<tr id='id_row_" . $key_ai . "' data-keyrow=" . $key_ai . ">";
                echo "<td>" . $val['matricula'] . "</td>";
                echo "<td>" . $val['nom_docente'] . "</td>";
                echo "<td>" . $val['nom_categoria'] . "</td>";
                echo "<td>" . $val['fecha_estado_validacion'] . "</td>";
                echo "<td>" . $val['nombre_estado_validacion'] . "</td>";
                echo "<td class='text-center'>" . $link_ver_comentario . "</td>";
                echo "<td  " . $link_ver_curso . "><a data-toggle='tab' href='#select_perfil_validar'> " .$string_values['lbl_validar_empleado']. " </a></td>";
                echo "<tr>";
            }
            ?>
        </tbody>
    </table>
</div>