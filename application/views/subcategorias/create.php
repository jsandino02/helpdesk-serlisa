<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
    $nombre_subcat = array(
        'id'                => 'nombre_subcategoria',
        'name'              => 'nombre_subcategoria',
        'class'             => 'form-control',
        'placeholder'       => 'Nombre de la subcategoria',
        'style'             => 'width: 60%'
    );
?>

<div class="row">
    <div class="col-lg-pull-12" style="margin-top:10px">        
        <div class="col-md-6 col-xs-12">
            <span style="font-family:Calibri; font-weight:bold; text-transform:uppercase; color:#337AB7; margin-left:15px; padding:0; font-size:18px;">
                <i class="fa fa-book fa-fw"></i> Crear nueva subcategor&iacute;a
            </span>
        </div>

        <div class="col-md-6 col-xs-12">
            <a href="<?php echo site_url('subcategorias/index'); ?>" class="btn btn-default pull-right" style="margin-right: 5px"><i class="fa fa-arrow-circle-left"></i> Regresar</a>

            <a href="javascript:void(0)" onclick="guardar();" class="btn btn-primary pull-right" style="margin-right: 5px"><i class="fa fa-save"></i> Guardar</a>
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
            Informaci&oacute;n de la categor&iacute;a
        </div>
        <div class="panel-body" style="padding:0; margin:0">
            <div style="margin:0; padding:0;">
                <table class="register-table" style="margin-left:0; border-collapse:collapse">
                    <tr>
                        <th class="title">Categor&iacute;a: *</th>
                        <td>
                            <div id="dv_cmbcategorias">
                                <select id="cmbcategorias" class="form-control" style="width: 60%">
                                    <option value="0">Seleccione categor&iacute;a</option>
                                    <?php foreach ($categorias as $cat) { ?>
                                        <option value="<?php echo $cat->id; ?>"><?php echo $cat->descripcion; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="title">Descripci&oacute;n: *</th>
                        <td class="campo">
                            <?php echo form_input($nombre_subcat); ?>
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
        var nombre = $("#nombre_subcategoria").val();
        var cateid = $("#cmbcategorias").val();

        if (nombre != "" && cateid > 0) 
        {
            $.ajax({
                url: '<?php echo site_url('subcategorias/create_action'); ?>',
                type: 'POST',
                data: {
                    descripcion: nombre,
                    categoria_id: cateid
                },
                error: function(xhr, textStatus, error) {
                    $("#dv_notificacion").fadeIn();
                    $("#sp_mensaje_error").html("Ocurrio un error al guardar el registro..::.." + xhr.statusText);
                    return false;
                },
                success: function(data) {
                    var id = parseInt(data);

                    if(id > 0)
                    {
                        var url = '<?php echo site_url('subcategorias/detail'); ?>'+'/'+ id;
                        $(location).attr("href", url);
                    }
                    else
                    {
                        $("#dv_notificacion").fadeIn();
                        $("#sp_mensaje_error").html("Ha ocurrido un error al guardar. Intente nuevamente.");
                        return false;
                    }  
                }
            });
        }
        else
        {
            $("#dv_notificacion").fadeIn();
            $("#sp_mensaje_error").html("Todos los campos son requeridos. Revise e intente nuevamente.");
            return false;
        }
    }
</script>