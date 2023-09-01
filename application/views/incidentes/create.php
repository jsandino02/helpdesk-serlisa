<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
   $txtasunto = array(
      'id'          => 'txtasunto',
      'name'        => 'txtasunto',
      'class'       => 'form-control',
      'placeholder' => 'Asunto',
      'style'       => 'width: 90%'
   );

   $txtdescripcion = array(
      'id'            => 'txtdescripcion',
      'name'          => 'txtdescripcion',
      'class'         => 'form-control',
      'placeholder'   => 'Descripcion del caso',
      'style'         => 'width: 90%',
      'rows'          => '4'
   );    
?>

<style>
    .required {
        text-transform:uppercase; 
        color:#e73e3e; 
        font-family:Calibri; 
        font-weight: bold;
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
            <i class="fa fa-plus-circle"></i>&nbsp;Crear nuevo caso
         </span>
      </div>

      <div class="col-md-6 col-xs-12">
         <a href="<?php echo site_url('incidentes/index')?>" class="btn btn-default pull-right"><i class="fa fa-arrow-circle-left"></i> Regresar</a>
         <a id="btnGuardar" href="javascript:void(0)" onclick="cargar_guardar();" class="btn btn-primary pull-right" style="margin-right: 5px"><i class="fa fa-save"></i> Guardar</a>
         <a id="btnGuardando" href="javascript:void(0)" class="btn btn-default pull-right" style="margin-right: 5px; display: none" disabled><i class="fa fa-spinner fa-spin"></i> Guardando...</a>
      </div>
   </div>
</div>

<hr />

<div id="dv_notificacion" class="alert alert-danger alert-dismissable" style="display:none;">
    <button type="button" class="close" aria-hidden="true" onclick="$('#dv_notificacion').fadeOut();">&times;</button>
    <span id="sp_mensaje_error"></span>
</div>

<div class="col-lg-9">
    <div class="panel panel-primary">
        <div class="panel-heading">
           <i class="fa fa-list-alt"></i> Informaci&oacute;n del caso
        </div>
        <div class="panel-body" style="padding:0; margin:0">
            <div style="margin:0; padding:0;">
                <table class="register-table table-bordered" style="margin-left:0; border-collapse:collapse; border: 2px solid #ddd;">
                    <tr>
                        <th class="title" >Asunto: <span class="required">*</span></th>
                        <td class="campo">
                           <?php echo form_input($txtasunto); ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="title">Area: <span class="required">*</span></th>
                        <td class="campo">
                            <select id="cmbareas" class="form-control" style="width: 50%; font-family: Calibri;" onchange="cargar_analistas(this.value)">
                                <option value="">Seleccione el area</option>
                                <?php foreach ($areas as $l) { ?>
                                    <option value="<?php echo $l->id; ?>"><?php echo $l->descripcion; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="title">Analista:</th>
                        <td class="campo">
                            <select id="cmbanalistas" class="form-control" style="width: 50%; font-family: Calibri;" disabled>
                                <option value="">Seleccione el analista</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="title">Tipo de caso: <span class="required">*</span></th>
                        <td class="campo">
                            <select id="cmbtipo" class="form-control" style="width: 50%" onchange="cargar_categorias(this.value)">
                                <option value="">Seleccione tipo de caso</option>
                                <?php foreach ($tipo_casos as $list) { ?>
                                    <option value="<?php echo $list->id; ?>"><?php echo $list->descripcion; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>                    
                    <tr>
                        <th class="title">Categor&iacute;a:</th>
                        <td class="campo">
                            <select id="cmbcategorias" class="form-control" style="width: 50%" onchange="cargar_subcategorias(this.value)" disabled>
                                <option value="">Seleccione categoria</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="title">Subcategor&iacute;a: <span class="required">*</span></th>
                        <td class="campo">
                            <select class="form-control" style="width: 90%" id="cmbsubcategorias" disabled>
                                <option value="">Seleccione subcategoria</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="title" style="vertical-align:top">Descripci&oacute;n: <span class="required">*</span></th>
                        <td class="campo">
                            <?php echo form_textarea($txtdescripcion); ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="title">Adjuntar archivo:</th>
                        <td class="campo">
                            <input type="file" id="file" name="file" multiple />
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="panel-footer">
            <span style="font-size:11px;" class="required">* Campos requeridos</span>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function()
    {
        $('#cmbtipo').select2({
            placeholder: "seleccione tipo de caso",
            minimumResultsForSearch: -1
        });

        $('#cmbcategorias').select2({
            placeholder: "seleccione categoria",
            minimumResultsForSearch: -1
        });

        $('#cmbsubcategorias').select2({
            placeholder: "seleccione subcategoria"
        });

        $('#cmbareas').select2({
            placeholder: "seleccione area"
        });

        $('#cmbanalistas').select2({
            placeholder: "seleccione analista"
        });        
    });

    function cargar_analistas(id_area)
    {
        var controlador = '<?php echo site_url('catalogos/get_analistas_by_area'); ?>';

        if (id_area != "") {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: controlador,
                data: { 
                    id_area: id_area
                },
                success: function (data) 
                {
                    $("#cmbanalistas").attr("disabled", false);
                    var items = '<option value="">Seleccione analista</option>';
                    $.each(data, function (i, list) {
                        items += `<option value="${list.id}">${list.nombre_usuario}</option>`;
                    });

                    $('#cmbanalistas').html(items);
                },
                error: function (xhr, status, error) {
                    alert(error);
                }
            });
        }
        else
        {
            var items = '<option value="">Seleccionar subcategoria</option>';
            $('#cmbanalistas').html(items);
            $("#cmbanalistas").attr("disabled", true);
        }
    }

    function cargar_categorias(id_tipo_caso)
    {
        var controlador = '<?php echo site_url('categorias/get_categorias_by_tipocaso'); ?>';

        if (id_tipo_caso != "") {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: controlador,
                data: { id: id_tipo_caso },
                success: function (data) 
                {
                    var items = '<option value="">Seleccione categoria</option>';
                    $.each(data, function (i, list) {
                        items += "<option value='" + list.id + "'>" + list.descripcion + "</option>";
                    });

                    $("#cmbcategorias").attr("disabled", false);
                    $('#cmbcategorias').html(items);
                },
                error: function (xhr, status, error) {
                    alert(error);
                }
            });
        }
        else
        {
            var items = '<option value=0>Seleccionar subcategoria</option>';
            $('#cmbsubcategorias').html(items);
            $("#cmbcategorias").attr("disabled", true);
            $("#cmbsubcategorias").attr("disabled", true);
        }
    }

    function cargar_subcategorias(id_cat)
    {
        var controlador = '<?php echo site_url('subcategorias/get_subcategorias_by_categoria_id'); ?>';

        if (id_cat != "") {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: controlador,
                data: { id: id_cat },
                success: function (data) 
                {
                    var items = '<option value="">Seleccione subcategoria</option>';
                    $.each(data, function (i, subcategorias) {
                        items += "<option value='" + subcategorias.id + "'>" + subcategorias.descripcion + "</option>";
                    });

                    $('#cmbsubcategorias').html(items);
                    $("#cmbsubcategorias").attr("disabled", false);
                },
                error: function (xhr, status, error) {
                    alert(error);
                }
            });
        }
        else
        {
            var items = '<option value="">Seleccionar subcategoria</option>';
            $('#cmbsubcategorias').html(items);
            $("#cmbsubcategorias").attr("disabled", true);
        }
    }

    function guardar(archivo)
    {
        let asunto   = $("#txtasunto").val();
        let tipo     = $("#cmbtipo").val();
        let subcat   = $("#cmbsubcategorias").val();
        let descri   = $("#txtdescripcion").val();
        let area     = $("#cmbareas").val();
        let analista = $("#cmbanalistas").val();

        if ((asunto != "") && (tipo != "") && (descri != "") && (subcat != "") && (area != "")) 
        {
            $("#btnGuardar").hide();
            $("#btnGuardando").show();

            $.ajax({
                url: '<?php echo site_url('incidentes/create_action'); ?>',
                type: 'POST',
                data: {
                    asunto: asunto,
                    tipo_id: tipo, 
                    subcategoria_id: subcat,
                    descripcion: descri,
                    area: area,
                    analista: analista,
                    adjunto: archivo
                },
                error: function(xhr, textStatus, error) {
                  $("#dv_notificacion").fadeIn();
                  $("#sp_mensaje_error").html("Ocurrio un error al guardar el registro..::.." + xhr.statusText);
                  $("#btnGuardar").show();
                  $("#btnGuardando").hide();
                  return false;
                },
                success: function(data) {
                  let id = parseInt(data);
                  let url = '<?php echo site_url('incidentes/detail'); ?>'+'/'+ id;
                  $(location).attr("href", url);
                }
            });
        }
      else
      {
         $("#dv_notificacion").fadeIn();
         $("#sp_mensaje_error").html("Error: Campos requeridos");
         $("#btnGuardar").show();
         $("#btnGuardando").hide();
         return false;
      }
    }

    function cargar_guardar()
    {
        if ($('#file').val()) 
        { 
            $("#btnGuardar").hide();
            $("#btnGuardando").show();

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
                    //$('#msg').html(response); // display error response from the server
                    $("#dv_notificacion").fadeIn();
                    $("#sp_mensaje_error").html("Error:" + response);

                    $("#btnGuardar").show();
                    $("#btnGuardando").hide();
                    return false;
                }
            });
        }
        else
        {
            guardar('');
        }
    }
</script>