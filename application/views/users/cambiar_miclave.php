<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
    $clave_anterior = array(
        'id'                => 'clave_anterior',
        'name'              => 'clave_anterior',
        'class'             => 'form-control',
        'placeholder'       => 'Clave actual',
        'style'             => 'width: 50%'
    ); 

    $nueva_clave1 = array(
        'id'                => 'nueva_clave1',
        'name'              => 'nueva_clave1',
        'class'             => 'form-control',
        'placeholder'       => 'Nueva clave',
        'style'             => 'width: 50%'
    ); 

    $nueva_clave2 = array(
        'id'                => 'nueva_clave2',
        'name'              => 'nueva_clave2',
        'class'             => 'form-control',
        'placeholder'       => 'Repita clave',
        'style'             => 'width: 50%'
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
        width: 210px;
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
</style>

<div class="row">
    <div class="col-lg-pull-12" style="margin-top:10px">        
        <div class="col-md-6 col-xs-12">
            <span style="font-family:Calibri; font-weight:bold; text-transform:uppercase; color:#337AB7; margin-left:15px; padding:0; font-size:18px;">
                <i class="fa fa-key"></i>&nbsp;Cambiar mi clave de acceso
            </span>
        </div>

        <div class="col-md-6 col-xs-12">
            <a href="<?php echo site_url('users/miperfil')?>" class="btn btn-default pull-right" style="margin-right: 5px; margin-left:15px;"><i class="fa fa-arrow-circle-left"></i> Regresar</a>

            <a href="javascript:void(0)" onclick="guardar();" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Guardar</a>
        </div>
    </div>
</div>

<hr />

<div id="dv_notificacion" class="alert alert-danger alert-dismissable" style="display:none;">
    <button type="button" class="close" aria-hidden="true" onclick="$('#dv_notificacion').fadeOut();">&times;</button>
    <span id="sp_mensaje_error"></span>
</div>

<div id="dv_notificacion_ok" class="alert alert-success alert-dismissable" style="display:none;">
    <button type="button" class="close" aria-hidden="true" onclick="$('#dv_notificacion_ok').fadeOut();">&times;</button>
    <span id="sp_mensaje_ok" style="font-weight: bold; font-family: Calibri; ">Contrase&ntilde;a cambiada correctamente!!!</span>
</div>

<div class="col-lg-8">
    <div class="panel panel-primary">
        <div class="panel-heading" style="font-family: Calibri; font-size: 18px">
            Modificar mi clave de acceso
        </div>
        <div class="panel-body" style="padding:0; margin:0">
            <div style="margin:0; padding:0;">
                <table class="register-table" style="margin-left:0; border-collapse:collapse">
                    <tr>
                        <th class="title">Contrase&ntilde;a actual:</th>
                        <td class="campo">
                            <?php echo form_password($clave_anterior); ?>
                        </td>
                    </tr>

                    <tr>
                        <th class="title">Nueva contrase&ntilde;a:</th>
                        <td class="campo">
                            <?php echo form_password($nueva_clave1); ?>
                        </td>
                    </tr>

                    <tr>
                        <th class="title">Repita contrase&ntilde;a:</th>
                        <td class="campo">
                            <?php echo form_password($nueva_clave2); ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="panel-footer">
            <span style="font-size:11px; text-transform:uppercase; color:gray; font-family:Calibri;">* Todos los campos son requeridos</span>
        </div>
    </div>
</div>

<script type="text/javascript">
    function guardar()
    {
        var clave_anterior = $("#clave_anterior").val();
        var nueva_clave1 = $("#nueva_clave1").val();
        var nueva_clave2 = $("#nueva_clave2").val();

        if ((clave_anterior != "") && (nueva_clave1 != "") && (nueva_clave2 != "")) 
        {
            if(nueva_clave1 == nueva_clave2)
            {
                $.ajax({
                    url: '<?php echo site_url('users/cambiar_miclave_action'); ?>',
                    type: 'POST',
                    data: 
                    {
                        clave_actual: clave_anterior, 
                        nueva_clave: nueva_clave1
                    },
                    error: function(xhr, textStatus, error) 
                    {
                        $("#dv_notificacion").fadeIn();
                        $("#sp_mensaje_error").html("Ocurrio un error al guardar el registro..::.." + xhr.statusText);
                        return false;
                    },
                    success: function(data) 
                    {
                        var id = parseInt(data);
                        if(id == 1)
                        {
                            setTimeout(function () {
                                $("#dv_notificacion_ok").fadeIn();
                                var url = '<?php echo site_url('users/miperfil'); ?>';
                                $(location).attr("href", url);
                            }, 2000);
                            
                        }
                        else
                        {
                            $("#dv_notificacion").fadeIn();
                            $("#sp_mensaje_error").html("La contrase&ntilde;a actual es incorrecta.");
                            return false;
                        }
                    }
                });
            }
            else
            {
                $("#dv_notificacion").fadeIn();
                $("#sp_mensaje_error").html("Las contraseñas no coinciden.");
                return false;
            }
            
        }
        else
        {
            $("#dv_notificacion").fadeIn();
            $("#sp_mensaje_error").html("Todos los campos son requeridos.");
            return false;            
        }
    }

    function seleccionar_perfil(id)
    {   
        //Si es coordinador
        if(id == 2)
        {
            $("#tr_areas").show();
            $("#tr_coordinadores").hide();
        }
        //Si es analista
        else if(id == 3)
        {
            $("#tr_coordinadores").show();
            $("#tr_areas").hide();
        }
        else
        {
            $("#tr_areas").hide();
            $("#tr_coordinadores").hide();
        }
    }

</script>