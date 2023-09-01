<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<link href="<?php echo base_url(); ?>assets/vendor/daterangepicker/css/daterangepicker.css" rel="stylesheet">

<style>
    .table thead th {
        background-color: rgba(51, 122, 183, 0.86);
        color: white;
    }

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 4px;
        height: 35px;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 35px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 30px;
        position: absolute;
        top: 1px;
        right: 6px;
        width: 20px;
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

    .center {
        text-align: center;
    }
</style>

<div class="row">   
    <div class="col-lg-pull-12" style="margin-top:10px">
        <div class="col-md-6 col-xs-12">
            <span style="font-family:Calibri; font-weight:bold; text-transform:uppercase; color:#337AB7; padding:0; font-size:20px;">
                <i class="fa fa-users fa-fw"></i>&nbsp;<?php echo $title; ?>
            </span>
        </div>

        <div class="col-md-6 col-xs-12">
            <button type="button" class="btn btn-primary pull-right" onclick="nuevo();">
                <i class="fa fa-plus-circle"></i> Crear usuario
            </button>
        </div>
    </div>
</div>

<hr />

<div class="row">
    <div class="col-lg-12" style="margin-top:10px; padding-left:0">        
        <div class="col-md-4">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-comment"></i>
                </div>
                <input type="text" id="txtNombre" class="form-control" placeholder="Nombre de usuario">
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa  fa-flag"></i>
                </div>
                <select id="cmbPerfiles" class="form-control">
                    <option value="general">Todos los perfiles</option>
                    <?php foreach ($perfiles as $l) { ?>
                        <option value="<?php echo $l->id; ?>" <?php //if($estado_id == $e->id) echo "selected"; ?>><?php echo $l->descripcion; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa  fa-flag"></i>
                </div>
                <select id="cmbAreas" class="form-control">
                    <option value="general">Todos las areas</option>
                    <?php foreach ($areas as $l) { ?>
                        <option value="<?php echo $l->id; ?>" <?php //if($estado_id == $e->id) echo "selected"; ?>><?php echo $l->descripcion; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-primary" id="btnBuscar">
                <i class="fa fa-search fa-fw"></i>&nbsp;
            </button>
        </div>
    </div>
</div>

<hr />

<div class="col-lg-12" style="padding-left:0">
    <div class="row">
        <table id="tblUsuarios" class="display responsive nowrap table-hover table table-striped table-bordered" style="font-family:Calibri; font-size: 14px; width: 100%">
            <thead>
                <tr>
                    <th>CREADO</th>
                    <th>NOMBRE</th>
                    <th>ACCESO</th>              	
                    <th>CORREO</th>
                    <th>PERFIL</th>
                    <th>AREA</th>
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

<script src="<?php echo base_url(); ?>assets/select2/js/select2.js" type="text/javascript" ></script>

<script type="text/javascript">
 
$(document).ready(function()
{
    var oTable = $('#tblUsuarios').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "pageLength": 5,
        "lengthMenu": [[5, 10, 50], [5, 10, 50]],
        "language": {
            processing: "<span style=\"font-family: Calibri\"><i class='fa fa-spinner fa-spin fa-fw'></i> Cargando registros. Espere...</span>",
            search: '<span>Buscar:</span> _INPUT_',
            lengthMenu: '<span>Mostrar:</span> _MENU_',
            paginate: { 'first': 'Primero', 'last': 'Ultimo', 'next': '>', 'previous': '<' },
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando _START_ - _END_ de _TOTAL_ registros",
            //infoFiltered: "(filtrado de un total de _MAX_ registros)",
            infoFiltered: "",
            infoEmpty: ""
        },
        "order": [],
        "ajax": {
            "url": "<?php echo site_url('users/ajax_list') ?>",
            "type": "POST",
            "data": function(data) {
                let nombre = $("#txtNombre").val();
                let perfil = $("#cmbPerfiles").val();
                let area = $("#cmbAreas").val();

                data.searchNombre = nombre;
                data.searchPerfil = perfil;
                data.searchArea = area;
            }
        },
        "columnDefs": [
	        { 
	            "targets": [0,1,2,3,4,5],
	            "orderable": false
	        },
            {
                "targets": [0], //creado
                width: '15%'
            },
            {
                "targets": [1], //nombre
                width: '25%'
            },
            {
                "targets": [2], //acceso
                width: '13%'
            },
            {
                "targets": [3], //correo
                width: '20%'
            },
            {
                "targets": [4], //perfil
                width: '10%'
            },
            {
                "targets": [5], //area
                width: '12%'
            },
        ], 
        "dom": "<'row'<'col-sm-3'i> <'col-sm-3'> <'col-sm-6'>>" + "<'row'<'col-sm-12't>"+ "<'col-sm-6'l><'col-sm-6'p>>"
    }); 

    //Boton de busqueda
    $('#btnBuscar').click(function () {
        oTable.draw();
    });

    $('input#txtNombre').keypress(function (e) {
        if (e.which == '13' && $('#txtNombre').val() != "") {
            e.preventDefault();
            oTable.draw();
        }
    });

    //Combos con select2
    $("#cmbPerfiles").select2();

    $('#cmbPerfiles').on('select2:select', function (e) {
        oTable.draw();
    });

    $("#cmbAreas").select2();

    $('#cmbAreas').on('select2:select', function (e) {
        oTable.draw();
    });
});

function nuevo()
{
	var url = '<?php echo site_url('users/create'); ?>';
    $(location).attr("href", url);
}
</script>