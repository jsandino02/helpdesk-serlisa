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
                <i class="fa fa-folder fa-fw"></i>&nbsp;<?php echo $title; ?>
            </span>
        </div>
    </div>
</div>

<hr />

<div class="col-lg-12" style="padding-left:0">
    <div class="row">
        <table id="tblIncidentes" class="display responsive nowrap table-hover table table-striped" style="font-family:Calibri; font-size: 15px; width: 100%" cellspacing="1">
            <thead>
                <tr>
                    <th>TICKET</th>
                    <th>CREADO</th>
                    <th>ASUNTO</th>
                    <th>CREADO&nbsp;POR</th>
                    <th>ESTADO</th>
                    <th>ASIGNADO</th>
                    <th>DESCRIPCI&Oacute;N</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>

<!-- DataTables JavaScript -->
<script src="<?php echo base_url(); ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.js"></script>

<script type="text/javascript">
 
$(document).ready(function()
{
    $('#tblIncidentes').DataTable({  
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "language": {
            "processing": `<span style="font-family: Calibri"><i class="fa fa-spinner fa-spin fa-fw"></i> Cargando registros. Espere...</span>`
        },
        "order": [],
        "ajax": {
            "url": "<?php echo site_url('incidentes/ajax_list/2'); ?>",
            "type": "POST"
        },
        "columnDefs": [{ 
            "targets": [0,1,2,3,4,5,6],
            "orderable": false
        }], 
    }); 
});
</script>