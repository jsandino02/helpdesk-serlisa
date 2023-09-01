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
                <i class="fa fa-plus-circle"></i> Agregar subcategor&iacute;a
            </button>
        </div>
    </div>
</div>

<hr />

<div class="row">
    <div class="col-md-9">
        <table width="100%" id="tblSubcategorias" class="table-hover table table-striped table-bordered" style="font-family:Calibri; font-size: 15px;" cellspacing="0">
            <thead>
                <tr>
                    <th>SUBCATEGORIA</th>
                    <th>CATEGORIA</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($subcategorias as $s) { ?>
                    <tr>
                        <td>
                            <a href="<?php echo site_url('subcategorias/detail/').$s->id; ?>"><?php echo $s->descripcion; ?></a>
                        </td>
                        <td>
                            <?php echo $s->categoria; ?>
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
    $('#tblSubcategorias').DataTable({
        "responsive": true,
        "ordering": false,
        "language": {
            processing: "<span style=\"font-family: Calibri\"><i class='fa fa-spinner fa-spin fa-fw'></i> Cargando registros. Espere...</span>",
            search: '<span>Buscar:</span> _INPUT_',
            lengthMenu: '<span>Mostrar:</span> _MENU_',
            paginate: { 'first': 'Primero', 'last': 'Ultimo', 'next': '>', 'previous': '<' },
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando _START_ de _END_ de un total de _TOTAL_ registros",
            //infoFiltered: "(filtrado de un total de _MAX_ registros)",
            infoFiltered: "",
            infoEmpty: ""
        },
    }); 
});

function nuevo()
{
	var url = '<?php echo site_url('subcategorias/create'); ?>';
    $(location).attr("href", url);
}

</script>