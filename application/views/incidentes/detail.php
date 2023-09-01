<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style type="text/css">
    thead th {
        background-color: rgba(51, 122, 183, 0.86);
        color: white;
    }
</style>

<input type="hidden" id="hfINCID" value="<?php echo $incidente->id; ?>" />
<input type="hidden" id="hfEstadoID" value="<?php echo $incidente->estado_id; ?>" />
<input type="hidden" id="hfEstado" value="<?php echo strtoupper($incidente->estado); ?>" />

<div class="row">
    <div class="col-lg-pull-12" style="margin-top:10px">        
        <div class="col-md-6 col-xs-12">
            <span style="font-family:Calibri; font-weight:bold; text-transform:uppercase; color:#337AB7; margin-left:15px; padding:0; font-size:18px;">
                <i class="fa fa-list-alt fa-fw"></i>&nbsp;Detalle del caso  
            </span>
        </div>

        <div class="col-md-6 col-xs-12">
            <a href="<?php if($incidente->cerrado == 0) echo site_url('incidentes/index'); else echo site_url('incidentes/cerrados'); ?>" class="btn btn-default pull-right" style="margin-right: 5px"><i class="fa fa-arrow-circle-left"></i> Regresar</a>
            <?php if($incidente->cerrado == 0) { ?>
                <?php if($this->session->userdata('perfil') == 1 || $this->session->userdata('perfil') == 2 || $this->session->userdata('perfil') == 3) { ?>
                <a href="javascript:void(0)" onclick="cerrarcaso_popup()" class="btn btn-danger pull-right" style="margin-right: 5px"><i class="fa fa-edit"></i> Cerrar caso</a>
                <?php } ?>

                <a href="<?php echo site_url('incidentes/add/').$incidente->id; ?>" class="btn btn-primary pull-right" style="margin-right: 5px"><i class="fa fa-edit"></i> Seguimiento</a>
            <?php } ?>
        </div>
    </div>
</div>

<hr />

<div id="dv_notificacion" class="alert alert-danger alert-dismissable" style="display:none;">
    <button type="button" class="close" aria-hidden="true" onclick="$('#dv_notificacion').fadeOut();">&times;</button>
    <span id="sp_mensaje_error"></span>
</div>

<?php if ($incidente->cerrado > 0) { ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-info">
                <strong>Este caso fue cerrado el <?php $date = new DateTime($incidente->fecha_cierre);
                                    echo $date->format('d/m/Y h:i:s a'); ?> por <?php echo $incidente->cerrado_por; ?> , Observaciones: <?php echo $incidente->observacion_cierre; ?></strong>
            </div>
        </div>
    </div>
<?php } ?>

<div class="row">
    <div class="col-lg-9">
        <div class="panel panel-primary">
            <div class="panel-heading">
                TICKET # <?php echo $incidente->id; ?>
            </div>
            <div class="panel-body" style="padding:0; margin:0">
                <table class="register-table table-condensed" style="margin-left:0; border-collapse:collapse">
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

                    <!-- <tr>
                        <th class="title">Area asignada:</th>
                        <td class="campo"><?php //echo $incidente->area; ?></td>
                    </tr> -->

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
                        <td class="campo"><?php echo $incidente->id_asignado_a != "" ? $incidente->asignado_a : "-- Sin asignar --"; ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="title">Area asignada:</th>
                        <td class="campo"><?php echo $incidente->area_id != "" ? $incidente->area : "-"; ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="title">Prioridad:</th>
                        <td class="campo"><?php echo $incidente->prioridad; ?>
                        </td>
                    </tr>               
                </table>
            </div>
            <div class="panel-footer">
                &nbsp;
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="mdlCerrarCaso" tabindex="-1" role="dialog" aria-labelledby="mdlCerrarCasoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel" style="font-family:Calibri"></h4>
                    </div>
                    <div class="modal-body" id="mensaje_popup">
                        <label style="font-family:Calibri; font-size:14px;">AGREGAR OBSERVACION</label>
                        <textarea id="txtobservacion" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button id="btnCerrarIncidente" type="button" class="btn btn-primary" data-dismiss="modal" onclick="cerrar_caso()"><i class="fa fa-power-off"></i> Cerrar caso</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="mdlError" tabindex="-1" role="dialog" aria-labelledby="mdlCerrarCasoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel1" style="font-family:Calibri">Error al cerrar caso</h4>
                    </div>
                    <div class="modal-body" id="mensaje_popup">
                        <label style="font-family:Calibri; font-size:14px;">No se puede cerrar un caso Helpdesk que esta en estado EN PROCESO, primero debe pasar el caso a estado RESUELTO o NOTIFICADO</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-9" style="margin-top:10px; margin-bottom: 10px; text-align:center">
        <span style="font-family:Calibri; font-weight:bold; text-transform:uppercase; color:#337ab7; margin:0; padding:0; font-size:16px;">
            ...::: Seguimiento del caso :::...
        </span>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <table width="100%" id="tblIncidentesDetalles" class="table-hover table table-striped table-condensed" style="font-family:Calibri; font-size: 15px;" cellspacing="0">
            <thead>
                <tr>
                    <th>FECHA</th>
                    <th>MODIFICADO&nbsp;POR</th>
                    <th>ESTADO</th>
                    <th>ASIGNADO&nbsp;A</th>
                    <th>COMENTARIO</th>
                    <th>ADJUNTO</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inc_detalles as $inc) { ?>
                    <tr>
                        <td>
                            <?php 
                                $date = new DateTime($inc->modificado);
                                echo $date->format('d/m/Y h:i:s a'); 
                            ?>
                        </td>
                        <td><?php echo $inc->modificado_por; ?></td>
                        <td>
                            <?php echo strtoupper($inc->estado); ?>
                        </td>
                        <td><?php echo $inc->asignado != "0" ? $inc->asignado : "Sin asignar"; ?></td>
                        <td><?php echo $inc->comentario; ?></td>
                        <td>
                            <?php if($inc->adjunto != '') { ?>
                            <a href="<?php echo site_url('uploads/'). $inc->adjunto; ?>">
                                <i class="fa fa-download"></i>
                            </a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>            
        </table>   
    </div>
</div>

<!-- DataTables JavaScript -->
<script src="<?php echo base_url(); ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.js"></script>

<script type="text/javascript">
    $(document).ready(function()
    {
        $('#tblIncidentesDetalles').DataTable({
            "responsive": true,
            "ordering": false
        }); 
    });

    function cerrarcaso_popup() {
        var est = $("#hfEstadoID").val();

        if (est < 3) {
            $('#mdlError').modal();
        }
        else {        
            $("#myModalLabel").html("Se procede a cerrar el caso: #" + $('#hfINCID').val() + ", con estado: " + $("#hfEstado").val());
            $('#mdlCerrarCaso').modal();
        }
    }

    function cerrar_caso()
    {
        $.ajax({
            url: '<?php echo site_url('incidentes/cerrarcaso_action'); ?>',
            type: 'POST',
            data: {
                inc_id : '<?php echo $incidente->id; ?>',
                observacion: $("#txtobservacion").val()
            },
            error: function(xhr, textStatus, error) {
                $("#dv_notificacion").fadeIn();
                $("#sp_mensaje_error").html("Ocurrio un error al guardar el registro..::.." + xhr.statusText);
                return false;
            },
            success: function(data) {
                var url = '<?php echo site_url('incidentes/detail/'); ?>'+ <?php echo $incidente->id; ?>;
                $(location).attr("href", url);
            }
        });
    }
</script>