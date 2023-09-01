<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-pull-12" style="margin-top:10px">        
        <div class="col-md-6 col-xs-12">
            <span style="font-family:Calibri; font-weight:bold; text-transform:uppercase; color:#337AB7; margin-left:15px; padding:0; font-size:18px;">
                Detalle del &aacute;rea
            </span>
        </div>

        <div class="col-md-6 col-xs-12">
            <a href="<?php echo site_url('areas/index')?>" class="btn btn-default pull-right" style="margin-right: 5px"><i class="fa fa-arrow-circle-left"></i> Regresar</a>
            
            <a href="<?php echo site_url('areas/edit/').$area[0]->id; ?>" class="btn btn-primary pull-right" style="margin-right: 5px"><i class="fa fa-edit"></i> Modificar</a>            
        </div>
    </div>
</div>

<hr />
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Datos del &aacute;rea
            </div>
            <div class="panel-body" style="padding:0; margin:0">
                <div style="margin:0; padding:0;">
                    <table class="register-table" style="margin-left:0; border-collapse:collapse">
                        <tr>
                            <th class="title">Nombre del &aacute;rea:</th>
                            <td class="campo">
                                <?php echo $area[0]->descripcion; ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="title">Fecha de creaci&oacute;n:</th>
                            <td class="campo">
                                <?php 
                                    $date = new DateTime($area[0]->creado);
                                    echo $date->format('d/m/Y h:i:s a');
                                ?>
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
</div>