<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
    $txtdescripcion = array(
        'id'                => 'txtdescripcion',
        'name'              => 'txtdescripcion',
        'class'             => 'form-control',
        'placeholder'       => 'Comentario',
        'style'             => 'width: 80%',
        'rows'              => '3'
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
                <i class="fa fa-list-alt fa-fw"></i>&nbsp;Detalle del caso
            </span>
        </div>
        <div class="col-md-6 col-xs-12">
            <a href="<?php echo site_url('incidentes/detail/').$incidente->id; ?>" class="btn btn-default pull-right" style="margin-right: 5px"><i class="fa fa-arrow-circle-left"></i> Regresar</a>
            <a id="btnGuardar" href="javascript:void(0)" onclick="cargar_guardar();" class="btn btn-primary pull-right" style="margin-right: 5px"><i class="fa fa-save"></i> Guardar</a>
            <a id="btnGuardando" href="javascript:void(0)" class="btn btn-default pull-right" style="margin-right: 5px; display: none" disabled><i class="fa fa-save"></i> Guardando...</a>
        </div>
    </div>
</div>

<hr />

<div class="row">
    <div class="col-lg-9">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <b>TICKET # <?php echo $incidente->id; ?></b>
            </div>
            <div class="panel-body" style="padding:0; margin:0">
                <div style="margin:0; padding:0;">
                    <table class="register-table" style="margin-left:0; border-collapse:collapse; border: 2px solid #ddd;">
                        <tr>
                            <th class="title">Asunto:</th>
                            <td class="campo">
                                <?php echo $incidente->asunto; ?>
                            </td>
                        </tr>

                        <tr>
                            <th class="title">Creado:</th>
                            <td class="campo2">
                                <?php 
                                    $date = new DateTime($incidente->fecha_creacion);
                                    echo $date->format('d/m/Y h:i:s a');
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <th class="title">Creado por:</th>
                            <td class="campo"><?php echo $incidente->creado_por; ?></td>

                        </tr>

                        <tr>
                            <th class="title">Area asignada:</th>
                            <td class="campo"><?php echo $incidente->area; ?></td>
                        </tr>

                        <tr>
                            <th class="title">Estado actual:</th>
                            <td class="campo"><?php echo $incidente->estado; ?></td>
                        </tr>

                        <tr>
                            <th class="title">Categor&iacute;a:</th>
                            <td class="campo"><?php echo $incidente->categoria . " - " .$incidente->subcategoria; ?></td>
                        </tr>
                        
                        <tr>
                            <th class="title">Descripci&oacute;n:</th>
                            <td class="campo"><?php echo $incidente->descripcion; ?></td>
                        </tr>

                        <tr>
                            <th class="title">Asignado a:</th>
                            <td class="campo"><?php echo $incidente->id_asignado_a != '' ? $incidente->asignado_a : "-- Sin asignar --"; ?>
                            </td>
                        </tr>

                        <?php if($this->session->userdata('perfil') == 1 || $this->session->userdata('perfil') == 2) { ?>
                        <tr>
                            <th class="title">Asignar a:</th>
                            <td class="campo">
                                <select id="cmbUsuarios" class="form-control" style="width: 80%; font-family: calibri; font-size: 14px">
                                    <option value="">Seleccione usuario</option>
                                    <?php foreach ($analistas as $u) { ?>
                                        <option value="<?php echo $u->id; ?>" <?php if($u->id == $incidente->id_asignado_a) echo "selected"; ?>><?php echo strtoupper($u->nombre_usuario)." | ".$u->area; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <th class="title">Prioridad:</th>
                            <td class="campo">
                                <select id="cmbPrioridades" class="form-control" style="width: 60%">
                                    <option value="0">Seleccione prioridad</option>
                                    <?php foreach ($prioridades as $p) { ?>
                                        <option value="<?php echo $p->id; ?>" <?php if($p->id == $incidente->prioridad_id) echo "selected"; ?>><?php echo $p->descripcion; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr> 
                        <?php } ?>

                        <?php if( count($estados) > 0 ) { ?>
                            <tr>
                            <th class="title">Estado:</th>
                            <td class="campo" id="td_cmbestados">
                                <select id="cmdEstados" class="form-control" style="width: 60%">
                                    <option value="0">Seleccione estado</option>
                                    <?php foreach ($estados as $e) { ?>
                                        <option value="<?php echo $e->id; ?>" <?php if($e->id == $incidente->estado_id) echo "selected"; ?>><?php echo strtoupper($e->descripcion); ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <?php } else {  ?>
                        <tr style="display: none;">
                            <th class="title">Estado:</th>
                            <td class="campo" id="td_cmbestados">
                                <select id="cmdEstados" class="form-control" style="width: 60%">
                                    <option value="0">Seleccione estado</option>
                                </select>
                            </td>
                        </tr>
                        <?php } ?>

                        <tr>
                            <th class="title">Adj.&nbsp;archivo:</th>
                            <td class="campo"><input type="file" id="file" name="file" multiple /></td>
                        </tr>
                        <tr>
                            <th class="title">Comentario:</th>
                            <td class="campo">
                                <?php echo form_textarea($txtdescripcion); ?>
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

<script type="text/javascript">
    $(document).ready(function()
    {
        $('#cmbUsuarios').select2({
            placeholder: "seleccione analista"
        });

        $('#cmbPrioridades').select2({
            placeholder: "seleccione prioridad",
            minimumResultsForSearch: -1
        });

        $('#cmdEstados').select2({
            placeholder: "seleccione estado",
            minimumResultsForSearch: -1
        });        
    });

    function guardar(archivo)
    {
        var asignar_a = "";
     
        if( $("#cmbUsuarios").val() != "")
        {
            asignar_a = $("#cmbUsuarios").val();
        }

        var prioridad_id = $("#cmbPrioridades").val();
        var descripci = $("#txtdescripcion").val();
        var estadoid = $("#cmdEstados").val();

        $("#btnGuardar").hide();
        $("#btnGuardando").show();

        $.ajax({
            url: '<?php echo site_url('incidentes/add_action'); ?>',
            type: 'POST',
            data: {
                inc_id : '<?php echo $incidente->id; ?>',
                asignado: asignar_a, 
                prioridad: prioridad_id,
                descripcion: descripci,
                estado: estadoid,
                adjunto: archivo
            },
            error: function(xhr, textStatus, error) {
                $("#dv_notificacion").fadeIn();
                $("#sp_mensaje_error").html("Ocurrio un error al guardar el registro..::.." + xhr.statusText);
                $("btnGuardar").show();
                $("btnGuardando").hide();
                return false;
            },
            success: function(data) {
                var url = '<?php echo site_url('incidentes/detail/'); ?>'+ <?php echo $incidente->id; ?>;
                $(location).attr("href", url);
            }
        });
    }

    function cargar_guardar()
    {
        if ($('#file').val()) 
        { 
            var file_data = $('#file').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            $.ajax({
                url: '<?php echo site_url('upload/upload_file'); ?>', // point to server-side controller method
                dataType: 'text', // what to expect back from the server
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) { 
                    //$('#msg').html(response);// display success response from the server
                    guardar(response);
                },
                error: function (response) {
                    $('#msg').html(response); // display error response from the server
                }
            });
        }
        else
        {
            guardar('');
        }
    }

</script>