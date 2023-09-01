<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
    $nombre_usuario = array(
        'id'                => 'nombre_usuario',
        'name'              => 'nombre_usuario',
        'class'             => 'form-control',
        'placeholder'       => 'Nombre de usuario',
        'style'             => 'width: 80%',
        'value'             => set_value('nombre_usuario',$usuario[0]->nombre_usuario)
    );

    $telefono = array(
        'id'                => 'telefono',
        'name'              => 'telefono',
        'class'             => 'form-control',
        'placeholder'       => 'Telefonos de contacto',
        'style'             => 'width: 80%',
        'value'             => set_value('telefono',$usuario[0]->telefono)
    );

    $correo = array(
        'id'                => 'correo_electronico',
        'name'              => 'correo_electronico',
        'class'             => 'form-control',
        'placeholder'       => 'Correo electronico',
        'style'             => 'width: 80%',
        'value'             => set_value('correo_electronico',$usuario[0]->correo)
    );

    $cargo = array(
        'id'                => 'cargo',
        'name'              => 'cargo',
        'class'             => 'form-control',
        'placeholder'       => 'Cargo asignado',
        'style'             => 'width: 80%',
        'value'             => set_value('cargo',$usuario[0]->cargo)
    );
    
?>

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

    .register-table td,
    .register-table tr {
        margin: 0px;
        padding-bottom: 4px;
        padding-left: 10px;
        padding-top: 4px;
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
        padding: 10px 5px;
        padding-left: 20px;
        text-align: left;
        background-color: #f8f8f8;
        /*border: 1px solid #5e8cb3;*/
        border: 1px solid #CCCCCC;
        color: #31708f;
        font-weight: bold;
        outline: medium none;
        text-transform: uppercase;
        font-family: Calibri;
        font-size: 15px;
        width: 150px;
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

    .campo1 {
        margin-left: 5px;
        padding-left: 5px;
        text-align: left;
        border: 1px solid #CCCCCC;
        color: black;
        outline: medium none;
        font-family: Calibri;
        font-size: 14px;
    }
</style>

<div class="row">
    <div class="col-lg-pull-12" style="margin-top:10px">        
        <div class="col-md-6 col-xs-12">
            <span style="font-family:Calibri; font-weight:bold; text-transform:uppercase; color:#337AB7; margin-left:15px; padding:0; font-size:18px;">
                Modificar mis datos
            </span>
        </div>

        <div class="col-md-6 col-xs-12">
            <a href="<?php echo site_url('users/miperfil'); ?>" class="btn btn-default pull-right" style="margin-right: 5px"><i class="fa fa-arrow-circle-left"></i> Regresar</a>

            <a href="javascript:void(0)" onclick="guardar();" class="btn btn-primary pull-right" style="margin-right: 5px"><i class="fa fa-save"></i> Guardar</a>            
        </div>
    </div>
</div>

<hr />

<div id="dv_notificacion" class="alert alert-danger alert-dismissable" style="display:none;">
    <button type="button" class="close" aria-hidden="true" onclick="$('#dv_notificacion').fadeOut();">&times;</button>
    Campos requeridos!!!, Corrija en intente guardar nuevamente.
</div>

<div class="col-lg-8">
    <div class="panel panel-primary">
        <div class="panel-heading" style="font-family: Calibri; font-size: 18px">
            Informaci&oacute;n de usuario
        </div>
        <div class="panel-body" style="padding:0; margin:0">
            <div style="margin:0; padding:0;">
                <table class="register-table" style="margin-left:0; border-collapse:collapse">
                    <tr>
                        <th class="title">Acceso:</th>
                        <td class="campo1">
                           <label style="color: #337ab7; margin-left: 5px;">&nbsp;<?php echo $usuario[0]->nombre_acceso; ?></label> 
                        </td>
                    </tr>

                    <tr>
                        <th class="title">Perfil:</th>
                        <td class="campo">
                            <label style="color: #337ab7; margin-left: 5px;">&nbsp;<?php echo $usuario[0]->perfil; ?></label> 
                        </td>
                    </tr>

                    <tr>
                        <th class="title">Nombre: *</th>
                        <td class="campo">
                            <?php echo form_input($nombre_usuario); ?>
                        </td>
                    </tr>

                    <tr>
                        <th class="title">Telefonos:</th>
                        <td class="campo">
                            <?php echo form_input($telefono); ?>
                        </td>
                    </tr>

                    <tr>
                        <th class="title">Correo: *</th>
                        <td class="campo">
                            <?php echo form_input($correo); ?>
                        </td>
                    </tr>

                    <tr>
                        <th class="title">Cargo: *</th>
                        <td class="campo">
                            <?php echo form_input($cargo); ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="panel-footer">
            <span style="font-size:11px; text-transform:uppercase; color:gray; font-family:Calibri;">* Campos requeridos</span>
        </div>
    </div>
</div>

<script type="text/javascript">
    function guardar()
    {
        var id = '<?php echo $usuario[0]->id; ?>';
        var nombre = $("#nombre_usuario").val();
        var telefo = $("#telefono").val();
        var cargo  = $("#cargo").val();
        var correo = $("#correo_electronico").val();

        if ((nombre != "") && (correo != "")) 
        {
            $.ajax({
                url: '<?php echo site_url('users/editarperfil_action'); ?>',
                type: 'POST',
                data: {
                    id: id,
                    nombre: nombre,
                    telefono: telefo, 
                    cargo: cargo,
                    correo: correo
                },
                error: function() {
                    alert('Ocurrio un error al guardar');
                },
                success: function(data) {
                    var id = parseInt(data);
                    var url = '<?php echo site_url('users/miperfil'); ?>';
                    $(location).attr("href", url);
                }
            });
        }
    }
</script>