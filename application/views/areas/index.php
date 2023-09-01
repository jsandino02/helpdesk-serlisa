<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
    thead th {
        background-color: rgba(51, 122, 183, 0.86);
        color: white;
    }
</style>

<div class="row">   
    <div class="col-lg-pull-12" style="margin-top:10px">
        <div class="col-md-6 col-xs-12">
            <span style="font-family:Calibri; font-weight:bold; text-transform:uppercase; color:#337AB7; padding:0; font-size:20px;">
                <i class="fa fa-book fa-fw"></i>&nbsp;<?php echo $title; ?>
            </span>
        </div>

        <div class="col-md-6 col-xs-12">
            <button type="button" class="btn btn-primary pull-right" onclick="nuevo();">
                <i class="fa fa-plus-circle"></i> Agregar area
            </button>
        </div>
    </div>
</div>

<hr />

<div class="row">
    <div class="col-md-8">
        <table width="100%" id="tblAreas" class="table-hover table table-striped" style="font-family:Calibri; font-size: 15px;" cellspacing="0">
            <thead>
                <tr>
                    <th>NOMBRE DEL AREA</th>
                    <th>CREADO</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($areas as $area) { ?>
                    <tr>
                        <td>
                            <a href="<?php echo site_url('areas/detail/').$area->id; ?>"><?php echo $area->descripcion; ?></a>
                        </td>
                        <td>
                            <?php 
                                $date = new DateTime($area->creado);
                                echo $date->format('d/m/Y h:i:s a'); 
                            ?>
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
    $('#tblAreas').DataTable({
        "responsive": true,
        "ordering": false
    }); 
});

function nuevo()
{
	var url = '<?php echo site_url('areas/create'); ?>';
    $(location).attr("href", url);
}

</script>