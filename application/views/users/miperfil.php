<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-pull-12" style="margin-top:10px">        
        <div class="col-md-6 col-xs-12">
            <span style="font-family:Calibri; font-weight:bold; text-transform:uppercase; color:#337AB7; margin-left:15px; padding:0; font-size:18px;">
                Mi perfil de usuario
            </span>
        </div>

        <div class="col-md-6 col-xs-12">
            <a href="<?php echo site_url('users/index')?>" class="btn btn-default pull-right" style="margin-right: 5px"><i class="fa fa-arrow-circle-left"></i> Regresar</a>            

            <a href="<?php echo site_url('users/cambiar_miclave/'); ?>" class="btn btn-danger pull-right" style="margin-right: 5px"><i class="fa fa-key"></i> Cambiar mi contrase&ntilde;a</a>

            <a href="<?php echo site_url('users/editarperfil/').$usuario->id; ?>" class="btn btn-primary pull-right" style="margin-right: 5px"><i class="fa fa-edit"></i> Modificar</a>
        </div>
    </div>
</div>

<hr />

<div id="dv_notificacion" class="alert alert-success alert-dismissable" style="display:none;">
    <button type="button" class="close" aria-hidden="true" onclick="$('#dv_notificacion').fadeOut();">&times;</button>
    ¡Se reestableci&oacute; la contrase&ntilde;a del usuario correctamente!
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Informaci&oacute;n de usuario
            </div>
            <div class="panel-body" style="padding:0; margin:0">
                <div style="margin:0; padding:0;">
                    <table class="register-table" style="margin-left:0; border-collapse:collapse">
                        <tr>
                            <th class="title">Nombre completo:</th>
                            <td class="campo">
                                <?php echo $usuario->nombre_usuario; ?>
                            </td>
                        </tr>

                        <tr>
                            <th class="title">Fecha de creaci&oacute;n:</th>
                            <td class="campo">
                                <?php 
                                        $date = new DateTime($usuario->fecha_creacion);
                                        echo $date->format('d/m/Y h:i:s a');
                                    ?>
                            </td>
                        </tr>

                        <tr>
                            <th class="title">Nombre de acceso:</th>
                            <td class="campo2"><?php echo $usuario->nombre_acceso; ?></td>
                        </tr>

                        <tr>
                            <th class="title">Telefono:</th>
                            <td class="campo"><?php echo $usuario->telefono; ?></td>

                        </tr>

                        <tr>
                            <th class="title">Correo electronico:</th>
                            <td class="campo2"><?php echo $usuario->correo; ?></td>
                        </tr>

                        <tr>
                            <th class="title">Cargo asignado:</th>
                            <td class="campo"><?php echo $usuario->cargo; ?></td>
                        </tr>

                        <tr>
                            <th class="title">Perfil de usuario:</th>
                            <td class="campo"><?php echo $usuario->perfil; ?></td>
                        </tr>
                        
                        <?php if ($usuario->perfil_id == 2) { ?>
                        <tr>
                            <th class="title">Area:</th>
                            <td class="campo"><?php echo $usuario->area; ?></td>
                        </tr>
                        <?php } ?>

                        <?php if ($usuario->perfil_id == 3) { ?>
                        <tr>
                            <th class="title">Coordinador:</th>
                            <td class="campo"><?php echo $usuario->coordinador; ?></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Restablacer contrase&ntilde;a</h4>
                        </div>
                        <div class="modal-body" id="mensaje_popup">
                            ¿Desea reiniciar la contrase&ntilde;a para este usuario?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="cambiarpass()">Cambiar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cerrar">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                &nbsp;
            </div>
        </div>
    </div>
</div>

<script>
    function cambiarpass() {
        var id = $("#hfUID").val();
        datos = {
            UID: id
        };

        $.ajax({
           url: "Url.Action("ResetPassword")",
           type: "POST",
           dataType: "json",
           data: datos,
           success: function (data) {
               $("#mensaje_popup").html(data.message);
               if (data.success) {
                   $("#dv_notificacion").show();
                   return false;
               }
               else {
                   return false;
               }
           },
           error: function () {
               alert("Error");
               return false;
           }
        });
    }
</script>