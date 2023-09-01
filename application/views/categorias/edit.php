<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
    $txtcategoria = array(
        'id'                => 'txtcategoria',
        'name'              => 'txtcategoria',
        'class'             => 'form-control',
        'placeholder'       => 'Categorias',
        'style'             => 'width: 80%',
        'value'             => set_value('txtcategoria', $categoria[0]->descripcion)
    );    
?>

<div class="row">
    <div class="col-lg-pull-12" style="margin-top:10px">        
        <div class="col-md-6 col-xs-12">
            <span style="font-family:Calibri; font-weight:bold; text-transform:uppercase; color:#337AB7; margin-left:15px; padding:0; font-size:18px;">
                Modificar categor&iacute;a
            </span>
        </div>

        <div class="col-md-6 col-xs-12">
            <a href="<?php echo site_url('categorias/detail/'). $categoria[0]->id; ?>" class="btn btn-default pull-right" style="margin-right: 5px"><i class="fa fa-arrow-circle-left"></i> Regresar</a>

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
            Detalle de la categor&iacute;a
        </div>
        <div class="panel-body" style="padding:0; margin:0">
            <div style="margin:0; padding:0;">
                <table class="register-table" style="margin-left:0; border-collapse:collapse">
                    <tr>
                        <th class="title">Nombre categor&iacute;a:</th>
                        <td class="campo">
                            <?php echo form_input($txtcategoria); ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="panel-footer">&nbsp;</div>
    </div>
</div>

<script type="text/javascript">
    function guardar()
    {
        var id = '<?php echo $categoria[0]->id; ?>';
        var nombre = $("#txtcategoria").val();

        if (nombre != "") 
        {
            $.ajax({
                url: '<?php echo site_url('categorias/edit_action'); ?>',
                type: 'POST',
                data: {
                    id: id,
                    nombre: nombre
                },
                error: function(xhr, textStatus, error) {
                    $("#dv_notificacion").fadeIn();
                    $("#sp_mensaje_error").html("Ocurrio un error al guardar el registro..::.." + xhr.statusText);
                    return false;
                },
                success: function(data) {
                    var url = '<?php echo site_url('categorias/detail'); ?>'+'/'+ id;
                    $(location).attr("href", url);
                }
            });
        }
        else
        {
            $("#dv_notificacion").fadeIn();
            $("#sp_mensaje_error").html("Error: Campos requeridos");
            return false;
        }
    }
</script>