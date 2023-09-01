<div class="row">
    <div class="col-lg-pull-12" style="margin-top:10px">        
        <div class="col-md-6 col-xs-12">
            <span style="font-family:Calibri; font-weight:bold; text-transform:uppercase; color:#337AB7; margin-left:15px; padding:0; font-size:18px;">
                Detalle del perfil
            </span>
        </div>

        <div class="col-md-6 col-xs-12">
            <a href="<?php echo site_url('profiles/index')?>" class="btn btn-default pull-right" style="margin-right: 5px"><i class="fa fa-arrow-circle-left"></i> Regresar</a>
            
            <a href="<?php echo site_url('profiles/edit/').$perfil[0]->id; ?>" class="btn btn-primary pull-right" style="margin-right: 5px"><i class="fa fa-edit"></i> Modificar</a>            
        </div>
    </div>
</div>

<hr />

<div class="col-lg-8">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Datos del perfil
        </div>
        <div class="panel-body" style="padding:0; margin:0">
            <div style="margin:0; padding:0;">
                <table class="register-table" style="margin-left:0; border-collapse:collapse">
                    <tr>
                        <th class="title">Descripcion:</th>
                        <td class="campo">
                            <?php echo $perfil[0]->descripcion; ?>
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

<style type="text/css">
    .text-input {
        height: 21px;
        width: 200px;
    }

    .register-table {
        margin: 0;
        padding: 0;
        width: 100%;
    }

    .register-table td, .register-table tr {
        margin: 0px;
        padding-bottom: 2px;
        padding-left: 10px;
        padding-top: 2px;
        border-spacing: 0px;
        border-collapse: collapse;
        font-family: Verdana;
        font-size: 12px;
    }

    h3 {
        display: inline-block;
        margin: 0px;
    }

    .title {
        padding: 10px 10px;
        text-align: left;
        background-color: #f8f8f8;
        /*border: 1px solid #5e8cb3;*/
        border: 1px solid #CCCCCC;
        color: #31708f;
        font-weight: bold;
        outline: medium none;
        text-transform: uppercase;
        font-family: Calibri;
        font-size: 14px;
        width: 170px;
        margin: 0;
    }

    .campo {
        margin-left: 5px;
        padding-left: 5px;
        text-align: left;
        border: 1px solid #CCCCCC;
        color: black;
        outline: medium none;
        text-transform: uppercase;
        font-family: Calibri;
        font-size: 14px;
    }

    .campo2 {
        margin-left: 5px;
        padding-left: 5px;
        text-align: left;
        border: 1px solid #CCCCCC;
        color: black;
        outline: medium none;
        text-transform: lowercase;
        font-family: Calibri;
        font-size: 14px;
    }
</style>