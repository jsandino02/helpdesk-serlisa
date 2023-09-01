<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
    $nombre_usuario = array(
        'id'                => 'nombre_usuario',
        'name'              => 'nombre_usuario',
        'class'             => 'form-control',
        'placeholder'       => 'Nombre de usuario',
        'style'             => 'width: 80%'
    );

    $nombre_acceso = array(
        'id'                => 'nombre_acceso',
        'name'              => 'nombre_acceso',
        'class'             => 'form-control',
        'placeholder'       => 'Nombre de acceso',
        'style'             => 'width: 80%'
    );

    $telefono = array(
        'id'                => 'telefono',
        'name'              => 'telefono',
        'class'             => 'form-control',
        'placeholder'       => 'Telefonos de contacto',
        'style'             => 'width: 80%'
    );

    $correo = array(
        'id'                => 'correo_electronico',
        'name'              => 'correo_electronico',
        'class'             => 'form-control',
        'placeholder'       => 'Correo electronico',
        'style'             => 'width: 80%'
    );

    $cargo = array(
        'id'                => 'cargo',
        'name'              => 'cargo',
        'class'             => 'form-control',
        'placeholder'       => 'Cargo asignado',
        'style'             => 'width: 80%'
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

    .select2-container .select2-selection--single .select2-selection__rendered
    {
        font-size: 14px;
        font-family: calibri;
    }

    .select2-results
    {
        font-family: Calibri;
    }

    textarea {
        resize: none;
    }
</style>
<div class="row">
    <div class="col-lg-pull-12" style="margin-top:10px">        
        <div class="col-md-6 col-xs-12">
            <span style="font-family:Calibri; font-weight:bold; text-transform:uppercase; color:#337AB7; margin-left:15px; padding:0; font-size:18px;">
                <i class="fa fa-plus-circle"></i>&nbsp;Crear usuario
            </span>
        </div>

        <div class="col-md-6 col-xs-12">
            <a href="<?php echo site_url('users/index')?>" class="btn btn-default pull-right" style="margin-right: 5px; margin-left:15px;"><i class="fa fa-arrow-circle-left"></i> Regresar</a>

            <a id="btnGuardar" href="javascript:void(0)" onclick="guardar();" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Guardar</a>
            <a id="btnGuardando" href="javascript:void(0)" disabled class="btn btn-default pull-right" style="margin-right: 5px; display: none"><i class="fa fa-spinner fa-spin"></i> Guardando</a>
        </div>
    </div>
</div>

<hr />

<div id="dv_notificacion" class="alert alert-danger alert-dismissable" style="display:none;">
    <button type="button" class="close" aria-hidden="true" onclick="$('#dv_notificacion').fadeOut();">&times;</button>
    <span id="sp_mensaje_error"></span>
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
                        <th class="title">Usuario:</th>
                        <td class="campo">
                            <?php echo form_input($nombre_usuario); ?>
                        </td>
                    </tr>

                    <tr>
                        <th class="title">Acceso:</th>
                        <td class="campo">
                            <?php echo form_input($nombre_acceso); ?>
                        </td>
                    </tr>

                    <tr>
                        <th class="title">Telefonos:</th>
                        <td class="campo">
                            <?php echo form_input($telefono); ?>
                        </td>
                    </tr>

                    <tr>
                        <th class="title">Correo:</th>
                        <td class="campo">
                            <?php echo form_input($correo); ?>
                        </td>
                    </tr>

                    <tr>
                        <th class="title">Cargo:</th>
                        <td class="campo">
                            <?php echo form_input($cargo); ?>
                        </td>
                    </tr>

                    <tr>
                        <th class="title">Perfil:</th>
                        <td class="campo">
                            <select id="cmbPerfiles" class="form-control" style="width: 80%" onchange="seleccionar_perfil(this.value);">
                                <option value="">Seleccione perfil</option>
                                <?php foreach ($perfiles as $l) { ?>
                                <option value="<?php echo $l->id; ?>"><?php echo $l->descripcion; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>

                    <tr id="tr_areas" style="display: none;">
                        <th class="title">Area:</th>
                        <td class="campo">
                            <select id="cmbAreas" class="form-control" style="width: 80%">
                                <option value="">Seleccione area</option>
                                <?php foreach($areas as $l) { ?>
                                    <option value="<?php echo $l->id; ?>"><?php echo $l->descripcion; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>

                    <tr id="tr_coordinadores" style="display: none;">
                        <th class="title">Coordinador:</th>
                        <td class="campo">
                            <select id="cmbCoordinadores" class="form-control" style="width: 80%">
                                <option value="0">Seleccione coordinador</option>
                                <?php foreach($coordinadores as $coord) { ?>
                                    <option value="<?php echo $coord->id; ?>"><?php echo $coord->nombre_usuario; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="panel-footer">
            <span style="font-size:11px; text-transform:uppercase; color:gray; font-family:Calibri;">* Se crear&aacute; como contraseña la palabra</span>
            <span style="font-size:12px; font-weight:bold; color:black; font-family:Calibri; padding:0; margin:0">Cifnic20201010</span>
            <span style="font-size:11px; text-transform:uppercase; color:gray; font-family:Calibri;">la que debe cambiar en el primer inicio de sesi&oacute;n</span>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/select2/js/select2.js" type="text/javascript" ></script>

<script type="text/javascript">
    $(document).ready(function()
    {
        $("#cmbPerfiles").select2({
            minimumResultsForSearch: -1
        });

        $("#cmbAreas").select2({
            minimumResultsForSearch: -1
        });
    });

    function guardar()
    {
        let nombre = $("#nombre_usuario").val();
        let acceso = $("#nombre_acceso").val();
        let telefo = $("#telefono").val();
        let cargo  = $("#cargo").val();
        let correo = $("#correo_electronico").val();
        let perfil = $("#cmbPerfiles").val();
        let area   = $("#cmbAreas").val();
        
        let areaid = "";
        let userid = "";

        if(perfil == 2 || perfil == 3)
        {
            areaid = $("#cmbAreas").val();
        }

        // if(perfil == 3)
        // {
        //     userid = $("#cmbCoordinadores").val();
        // }

        if ((nombre != "") && (acceso != "") && (correo != "") && (perfil != "")) 
        {
            if(perfil == 2 || perfil == 3)
            {
                if(!(areaid != ""))
                {
                    $("#dv_notificacion").fadeIn();
                    $("#sp_mensaje_error").html("Si es analista debe seleccionar el area");
                    return false;
                }
            }

            // if(perfil == 3)
            // {
            //     if(userid > 0)
            //     {

            //     }
            //     else
            //     {
            //         $("#dv_notificacion").fadeIn();
            //         $("#sp_mensaje_error").html("Si es analista debe seleccionar el coordinador.");
            //         return false;
            //     }
            // }

            $("#btnGuardar").hide();
            $("#btnGuardando").show();

            $.ajax({
                url: '<?php echo site_url('users/create_action'); ?>',
                type: 'POST',
                data: {
                    nombre: nombre, 
                    acceso: acceso,
                    telefono: telefo, 
                    cargo: cargo,
                    correo: correo, 
                    perfil: perfil,
                    area_id: areaid,
                    user_id: userid
                },
                error: function(xhr, textStatus, error) {
                    $("#dv_notificacion").fadeIn();
                    $("#sp_mensaje_error").html("Ocurrio un error al guardar el registro..::.." + xhr.statusText);

                    $("#btnGuardar").show();
                    $("#btnGuardando").hide();
                    return false;
                },
                success: function(data) {
                    $("#btnGuardar").show();
                    $("#btnGuardando").hide();
                    var id = parseInt(data);
                    var url = '<?php echo site_url('users/detail'); ?>'+'/'+ id;
                    $(location).attr("href", url);
                }
            });
        }
        else
        {
            $("#dv_notificacion").fadeIn();
            $("#sp_mensaje_error").html("Todos los campos son requeridos. Intente nuevamente.");
            $("#btnGuardar").show();
                    $("#btnGuardando").hide();
            return false;            
        }
    }

    function seleccionar_perfil(id)
    {   
        //Si es coordinador
        // if(id == 2)
        // {
        //     $("#tr_areas").show();
        //     $("#tr_coordinadores").hide();
        // }
        //Si es analista
        if(id == 2 || id == 3)
        {
            //$("#tr_coordinadores").show();
            $("#tr_areas").show();
        }
        else
        {
            $("#tr_areas").hide();
            //$("#tr_coordinadores").hide();
        }
    }

</script>