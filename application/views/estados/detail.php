<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-pull-12" style="margin-top:10px">        
        <div class="col-md-6 col-xs-12">
            <span style="font-family:Calibri; font-weight:bold; text-transform:uppercase; color:#337AB7; margin-left:15px; padding:0; font-size:18px;">
                Nombre del estado
            </span>
        </div>

        <div class="col-md-6 col-xs-12">
            <a href="<?php echo site_url('estados/index')?>" class="btn btn-default pull-right" style="margin-right: 5px"><i class="fa fa-arrow-circle-left"></i> Regresar</a>
            
            <a href="<?php echo site_url('estados/edit/').$estado[0]->id; ?>" class="btn btn-primary pull-right" style="margin-right: 5px"><i class="fa fa-edit"></i> Modificar</a>            
        </div>
    </div>
</div>

<hr />
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                T&iacute;tulo del estado
            </div>
            <div class="panel-body" style="padding:0; margin:0">
                <table class="register-table" style="margin-left:0; border-collapse:collapse">
                    <tr>
                        <th class="title">Nombre del estado:</th>
                        <td class="campo">
                            <?php echo $estado[0]->descripcion; ?>
                        </td>
                    </tr>                   
                </table>
            </div>

            <div class="panel-footer">
                &nbsp;
            </div>
        </div>
    </div>
</div>