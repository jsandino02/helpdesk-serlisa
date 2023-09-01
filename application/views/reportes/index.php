<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<link href="<?php echo base_url(); ?>assets/vendor/daterangepicker/css/daterangepicker.css" rel="stylesheet">

<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>

<script src="<?php echo base_url(); ?>assets/vendor/daterangepicker/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/daterangepicker/js/daterangepicker.js" type="text/javascript" ></script>

<div class="row">
    <div class="col-lg-pull-12" style="margin-top:15px">
        <div class="col-md-6 col-xs-12">
            <span style="font-family:Calibri; font-weight:bold; text-transform:uppercase; color:#337AB7; margin-left:15px; padding:0; font-size:18px;">
                <i class="fa fa-bar-chart-o fa-fw"></i>&nbsp;Reportes de incidentes
            </span>
        </div>

        <div class="col-md-6 col-xs-12">
            <a href="<?php echo site_url('reportes/index')?>" class="btn btn-default pull-right" style="margin-right: 5px"><i class="fa fa-arrow-circle-left"></i> Regresar</a>
        </div>
    </div>
</div>

<hr />

<div class="row">
    <div class="col-lg-6" style="margin-top:10px">
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-th fa-fw"></i>
                </div>
                <input type="text" class="form-control" autocomplete="off" placeholder="Desde" id="fecha_consulta" />
            </div>
        </div>

        <div class="col-md-6">
            <button type="button" class="btn btn-primary" onclick="exportar();">
                <i class="fa fa-download fa-fw"></i>&nbsp;Exportar
            </button>
        </div>
    </div>
</div>

<hr />

<script type="text/javascript">
    $(document).ready(function () {
        $('#fecha_consulta').daterangepicker({
            "autoApply": true,
            "locale": {
                "format": "DD/MM/YYYY",
                "showDropdowns": false,
                "daysOfWeek": ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                "monthNames": ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"]
            }
        });
    });

    function exportar()
    {
        var fechas = $("#fecha_consulta").val();

        var f = fechas.replace(new RegExp(' - ', 'g'), '_');
        f2 = f.replace(new RegExp('/', 'g'), '-');
   
        var url = '<?php echo site_url('reportes/exportar_incidentes/'); ?>' + f2
        $(location).attr("href", url);
    }
</script>