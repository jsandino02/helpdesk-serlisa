<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
    .panel-default > .panel-heading-custom {
        background: #939191;
        color: #fff;
    }

    .panel-info > .panel-heading-custom {
        background: #24b0c5;
        color: #fff;
    }

    .panel-primary > .panel-heading-custom {
        background: #939191;
        color: #fff;
    }
</style>

<input type="hidden" value="<?php echo site_url('incidentes'); ?>" id="hfurl">
<input type="hidden" value="<?php echo $this->session->userdata('mostrar'); ?>" id="hfidtipo">

<div class="row">
    <div class="col-lg-pull-12" style="margin-top:10px">        
        <div class="col-md-6 col-xs-12">
            <span style="font-family:Calibri; font-weight:bold; text-transform:uppercase; color:#337AB7; margin-left:15px; padding:0; font-size:20px;">
                <i class="fa fa-home fa-fw"></i> Inicio <?php //echo (int) $this->session->userdata('mostrar'); ?>
            </span>
        </div>
        
        <?php if ($this->session->userdata('perfil') == '4') { ?>
            <!-- <div class="col-md-6 col-xs-12" style="margin-top:10px">
                <a href="<?php //echo site_url('incidentes/create'); ?>" class="btn btn-primary pull-right" style="margin-right: 5px"><i class="fa fa-plus-circle"></i> Registrar nuevo caso </a>
            </div> -->
        <?php }  else { ?>
            <div class="col-md-6 col-xs-12" style="margin-top:10px">
                <div class="pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" style="padding: 7px 3px 7px 7px">
                            <span id ="btnDash"><?php if ((int) $this->session->userdata('mostrar') == 1) { echo "Casos reportados por mi"; } else { echo "Casos activos"; } ?></span>
                            <span class="caret" style="margin: 0 5px 0 5px"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="javascript:void(0)" id="btnOpDash1" onclick="tipo_casos(2)" style="<?php if ((int) $this->session->userdata('mostrar') != 1) { echo "display none;"; } else { echo "Casos reportados por mi"; } ?>">Casos activos</a>
                            </li>
                            <li><a href="javascript:void(0)" id="btnOpDash2" onclick="tipo_casos(1)" <?php if ((int) $this->session->userdata('mostrar') != 2) { echo "display none;"; } else { echo "Casos reportados por mi"; } ?>>Casos reportados por m&iacute;</a>
                            </li>
                            <!-- <li class="divider"></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<hr />

<div class="row" id="dvTiles"></div>

<?php if ($resumen != null ) { ?>
<div class="row">
	<div class="col-lg-12" style="padding-left:15px">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <i class="fa fa-comments fa-fw"></i>&nbsp;<span id="panel_titulo" style="font-family: Calibri; font-size: 18px">Casos asignados por analista</span>
            </div>
            
            <!-- Tabla de usuarios -->
            <div class="panel-body">
                <div class="row">
                    <div class="table-responsive" id="tbl_usuarios">
                        <table class="table table-bordered table-hover table-striped table-condensed" style="font-family:Calibri">
                            <thead id="tbh_header">
                                <tr>
                                    <th>Asignado a</th>
                                    <th>En Proceso</th>                                    
                                    <th>Resuelto</th>
                                    <th>Notificado</th>
                                    <th>Revision</th>
                                </tr>
                            </thead>
                            <tbody id="tby_casos">
                            	<?php foreach ($resumen as $r) { ?>
                            		<tr>
                            		<td><?php echo $r->nombre_usuario; ?></td>
                            		<td><?php echo $r->en_proceso; ?></td>
                            		<td><?php echo $r->resuelto; ?></td>
                            		<td><?php echo $r->notificado; ?></td>
                            		<td><?php echo $r->revision; ?></td>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-8">
                        <div id="morris-bar-chart"></div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>

<a href="<?php echo site_url('incidentes/create'); ?>" class="btn-flotante"><i class="fa fa-plus-circle"></i> Registrar nuevo caso</a>

<script>
    $(document).ready(function()
    {
        getDashBoard();
    });

    function tipo_casos(op)
    {
        $("#hfidtipo").val(op);
        if (op == 1) {
            $("#btnDash").html("Casos reportados por mi");
            $("#btnOpDash1").show();
            $("#btnOpDash2").hide();
        }
        else
        {
           $("#btnDash").html("Casos activos");
            $("#btnOpDash1").hide();
            $("#btnOpDash2").show();
        }

        $.ajax({
            url: '<?php echo site_url('account/set_var_session_action'); ?>',
            type: 'POST',
            data: {
                key : "mostrar",
                value: op
            },
            error: function(xhr, textStatus, error) {
               alert(xhr.statusText);
                return false;
            },
            success: function(data) {
                //alert(JSON.stringify(data));
                getDashBoard();
            }
        });
    }

    function getDashBoard()
    {
        // let params = {
        //     mostrar: "1"
        // };

        $.getJSON("<?php echo site_url('home/getdashboard');?>", function(result) 
        {
            let tiles = result.tiles;
            let htmlT = "";
            let url = $("#hfurl").val();
            let tip = $("#hfidtipo").val();

            if (tip == 1)
            {
                url = `${url}/asignados/`;
            }
            else
            {
                url = `${url}/index/`;
            }

            //alert(url);

            $.each(tiles, function (i, val) {
                htmlT += `<div class="${val.tamano}">
                    <div class="panel ${val.color}">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="${val.icono} fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">${val.total}</div>
                                    <div>${val.titulo}</div>
                                </div>
                            </div>
                        </div>
                        <a href="${url}${val.estado_id}">
                            <div class="panel-footer">
                                <span class="pull-left">Ver detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>`;
            });

            $("#dvTiles").html(htmlT);
        });   
    }
</script>