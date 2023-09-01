<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-pull-12" style="margin-top:10px">        
        <div class="col-md-6 col-xs-12">
            <span style="font-family:Calibri; font-weight:bold; text-transform:uppercase; color:#337AB7; margin-left:15px; padding:0; font-size:18px;">
                Detalle de la categor&iacute;a
            </span>
        </div>

        <div class="col-md-6 col-xs-12">
            <a href="<?php echo site_url('categorias/index')?>" class="btn btn-default pull-right" style="margin-right: 5px"><i class="fa fa-arrow-circle-left"></i> Regresar</a>

            <a href="<?php echo site_url('categorias/edit/').$categoria->id; ?>" class="btn btn-primary pull-right" style="margin-right: 5px"><i class="fa fa-edit"></i> Modificar</a>
        </div>
    </div>
</div>

<hr />

<div id="dv_notificacion" class="alert alert-success alert-dismissable" style="display:none;">
    <button type="button" class="close" aria-hidden="true" onclick="$('#dv_notificacion').fadeOut();">&times;</button>
    ¡Se reestableci&oacute; la contrase&ntilde;a del usuario correctamente!
</div>

<div class="col-lg-8">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Datos de la categor&iacute;a
        </div>
        <div class="panel-body" style="padding:0; margin:0">
            <div style="margin:0; padding:0;">
                <table class="register-table" style="margin-left:0; border-collapse:collapse">
                    <tr>
                        <th class="title">Tipo de caso:</th>
                        <td class="campo">
                            <?php echo $categoria->tipo_caso; ?>
                        </td>
                    </tr> 
                    <tr>
                        <th class="title">Nombre categor&iacute;a:</th>
                        <td class="campo">
                            <?php echo $categoria->descripcion; ?>
                        </td>
                    </tr>                    
                </table>
            </div>
        </div>
        <div class="panel-footer">
            &nbsp;
        </div>
    </div>
</div>