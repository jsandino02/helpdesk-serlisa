<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
    $nombre_usuario = array(
        'id'                => 'nombre_usuario',
        'name'              => 'nombre_usuario',
        'class'             => 'form-control',
        'placeholder'       => 'Nombre de usuario',
        'style'             => 'width: 80%',
        'value'             => set_value('nombre_usuario',$usuario->nombre_usuario)
    );

    $telefono = array(
        'id'                => 'telefono',
        'name'              => 'telefono',
        'class'             => 'form-control',
        'placeholder'       => 'Telefonos de contacto',
        'style'             => 'width: 80%',
        'value'             => set_value('telefono',$usuario->telefono)
    );

    $correo = array(
        'id'                => 'correo_electronico',
        'name'              => 'correo_electronico',
        'class'             => 'form-control',
        'placeholder'       => 'Correo electronico',
        'style'             => 'width: 80%',
        'value'             => set_value('correo_electronico',$usuario->correo)
    );

    $cargo = array(
        'id'                => 'cargo',
        'name'              => 'cargo',
        'class'             => 'form-control',
        'placeholder'       => 'Cargo asignado',
        'style'             => 'width: 80%',
        'value'             => set_value('cargo',$usuario->cargo)
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
                Modificar usuario
            </span>
        </div>

        <div class="col-md-6 col-xs-12">
            <a href="<?php echo site_url('users/detail/').$usuario->id; ?>" class="btn btn-default pull-right" style="margin-right: 5px"><i class="fa fa-arrow-circle-left"></i> Regresar</a>

            <a id="btnGuardar" href="javascript:void(0)" onclick="guardar();" class="btn btn-primary pull-right" style="margin-right: 5px"><i class="fa fa-save"></i> Guardar</a>

            <a id="btnGuardando" href="javascript:void(0)" disabled class="btn btn-default pull-right" style="margin-right: 5px; display: none"><i class="fa fa-spinner fa-spin"></i> Guardando</a>
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
                           <label style="color: #337ab7; margin-left: 5px;">&nbsp;<?php echo $usuario->nombre_acceso; ?></label> 
                        </td>
                    </tr>

                    <tr>
                        <th class="title">Usuario:</th>
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
                            <select id="cmbPerfiles" class="form-control" style="width: 80%" onchange="sel_perfil(this.value)">
                                <?php foreach ($perfiles as $p) { ?>
                                <option value="<?php echo $p->id; ?>" <?php if($p->id == $usuario->perfil_id) echo "selected"; ?> ><?php echo $p->descripcion; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>

                    <tr id="tr_areas" style="<?php if ($usuario->perfil_id == 2 || $usuario->perfil_id == 3) echo ""; else echo "display: none"; ?>">
                        <th class="title">Area:</th>
                        <td class="campo">
                            <select id="cmbAreas" placeholder="Seleccione el area" class="form-control" style="width: 80%">
                                <option value="">Seleccione area</option>
                                <?php foreach ($areas as $l) { ?>
                                <option value="<?php echo $l->id; ?>" <?php if($l->id == $usuario->area_id) echo "selected"; ?> ><?php echo $l->descripcion; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="panel-footer">
            <span style="font-size:11px; text-transform:uppercase; color:gray; font-family:Calibri;">* Se crear&aacute; como contraseña la palabra</span>
            <span style="font-size:12px; font-weight:bold; color:black; font-family:Calibri; padding:0; margin:0">temporal</span>
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
        let id = '<?php echo $usuario->id; ?>';
        let nombre = $("#nombre_usuario").val();
        let telefo = $("#telefono").val();
        let cargo  = $("#cargo").val();
        let correo = $("#correo_electronico").val();
        let perfil = $("#cmbPerfiles").val();
        let area   = $("#cmbAreas").val();

        if ((nombre != "") && (correo != "") && (perfil > 0)) 
        {
            if(perfil == 3) {
                if(!(area != "")) {
                    alert("Debe seleccionar el area si el perfil es analista");
                    return false;
                }
            }

            $("#btnGuardar").hide();
            $("#btnGuardando").show();

            $.ajax({
                url: '<?php echo site_url('users/edit_action'); ?>',
                type: 'POST',
                data: {
                    id: id,
                    nombre: nombre,
                    telefono: telefo, 
                    cargo: cargo,
                    correo: correo, 
                    perfil: perfil,
                    area: area
                },
                error: function(xhr, textStatus, error) {
                    $("#dv_notificacion").fadeIn();
                    $("#sp_mensaje_error").html("Ocurrio un error al guardar el registro..::.." + xhr.statusText);

                    $("#btnGuardar").show();
                    $("#btnGuardando").hide();
                    return false;
                },
                success: function(data) {
                    var rst = parseInt(data);
                    if(rst == 1)
                    {
                        var url = '<?php echo site_url('users/detail'); ?>'+'/'+ id;
                        $(location).attr("href", url);
                    }
                    else
                    {
                        $("#dv_notificacion").fadeIn();
                        $("#sp_mensaje_error").html("Error: Todos los campos son requeridos");
                        return false;
                    }
                    $("#btnGuardar").show();
                    $("#btnGuardando").hide();
                }
            });
        }
    }

    function sel_perfil(val)
    {
        if( val == 3 )
        {
            $("#tr_areas").show();
        }
        else
        {
            $("#tr_areas").hide();
        }
    }
</script>