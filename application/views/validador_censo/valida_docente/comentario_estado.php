<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$label_just = $string_values['lbl_jus_comentario'] . ((isset($tipo_transicion)) ? $tipo_transicion : '');
//pr($historial_estados);
?>

<div id="id_div_comentarios_estado">
    <?php
    if (!empty($historial_estados)) {
        $estados_censo = $this->config->item('estados_val_censo');
        $array_colores = $this->config->item('cvalidacion_curso_estado');
        $this->load->helper('fecha');
        foreach ($historial_estados as $value) {
            if (intval($value['is_comentario']) === 1) {
                $estado = $estados_censo[$value['estado_validacion']];
                $color = $array_colores[$estado['color_status']]['color']; //Obtiene los array de color del estado
                ?>
                <div class="alert alert-<?php echo $color; ?>">
                    <span><?php echo $string_values['titulo_fecha_validacion'] . get_fecha_local($value['fecha_validacion']); ?></span><br>
                    <span><?php echo $string_values['titulo_estado_validacion'] . $value['nom_estado_validacion']; ?></span><br>
                    <span><?php echo $string_values['titulo_validador'] . $value['nom_validador']; ?></span><br>
                    <span><?php echo $string_values['lbl_comentario'] . $value['comentario_estado']; ?></span>
                </div>

                <?php
            }
        }
        ?>

    <?php } else { ?>
        <span class="alert-info"><?php echo $string_values['msj_sin_comntarios_estado']; ?></span>
    <?php } ?>
</div>  