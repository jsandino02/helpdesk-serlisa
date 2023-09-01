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

    .center {
        text-align: center;
    }
</style>

<div class="row">   
    <div class="col-lg-pull-12" style="margin-top:10px">
        <div class="col-md-6 col-xs-12">
            <span style="font-family:Calibri; font-weight:bold; text-transform:uppercase; color:#337AB7; padding:0; font-size:20px;">
                <i class="fa fa-folder-open fa-fw"></i>&nbsp;<?php echo $title; ?>
            </span>
        </div>        

        <div class="col-md-6 col-xs-12">
            <button type="button" class="btn btn-primary pull-right" onclick="nuevo();">
                <i class="fa fa-plus-circle"></i> Registrar caso
            </button>
        </div>
    </div>
</div>

<hr />  

<div class="row">
    <div class="col-lg-12" style="margin-top:10px; padding-left:0">
        <div class="col-md-2">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-ticket"></i>
                </div>
                <input type="text" id="txtTicket" class="form-control" placeholder="No Ticket">
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control" autocomplete="off" placeholder="Fecha de creaci&oacute;n" id="dtpCreado" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-comment"></i>
                </div>
                <input type="text" id="txtAsunto" class="form-control" placeholder="Asunto">
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa  fa-flag"></i>
                </div>
                <select id="cmbEstados" class="form-control">
                    <option value="general">Todos los estados</option>
                    <?php foreach ($estados as $e) { ?>
                        <option value="<?php echo $e->id; ?>" <?php if($estado_id == $e->id) echo "selected"; ?>><?php echo $e->descripcion; ?></option>
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
        <table id="tblIncidentes" class="display responsive nowrap table-hover table table-striped" style="font-family:Calibri; font-size: 15px; width: 100%" cellspacing="1">
            <thead>
                <tr>
                    <th>TICKET</th>
                	<th>CREADO</th>
                    <th>ASUNTO</th>
                    <th>CREADO&nbsp;POR</th>
                    <th>ESTADO</th>
                    <!--<th>Area</th>
                     <th>Asignado</th>                    
                    <th>Descripci&oacute;n</th> -->
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

<script src="<?php echo base_url(); ?>assets/vendor/daterangepicker/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/daterangepicker/js/daterangepicker.js" type="text/javascript" ></script>

<script src="<?php echo base_url(); ?>assets/select2/js/select2.js" type="text/javascript" ></script>

<script type="text/javascript">
 
$(document).ready(function()
{
    var oTable = $('#tblIncidentes').DataTable({ 
        "processing": true,
        "serverSide": true,
        "responsive": true,
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
            "url": "<?php echo site_url('incidentes/ajax_list'); ?>",
            "type": "POST",
            "data": function(data) {
                var ticket = $("#txtTicket").val();
                var creado = $("#dtpCreado").val();
                var asucli = $("#txtAsunto").val();
                var estado = $("#cmbEstados").val();

                data.searchTicket = ticket;
                data.searchCreado = creado;
                data.searchAsunto = asucli;
                data.searchEstado = estado;
                data.tiposDeCasos = "ASIGNADOS";
            }
        },
        // "columnDefs": [{ 
        //     "targets": [0,1,2,3,4,5,6,7],
        //     "orderable": false
        // }],
        "columnDefs": [
            { 
                "targets": [0,1,2,3,4],
                "orderable": false
            },
            {
                "targets": [0],
                width: '5%',
                className: 'center'
            },
            {
                "targets": [1],
                width: '18%'
            },
            {
                "targets": [2],
                width: '40%'
            },
            {
                "targets": [3],
                width: '27%'
            },
            {
                "targets": [4],
                width: '10%'
            }
        ],
        //"oSearch": {"sSearch": '<?php //echo $estado; ?>' }
        "dom": "<'row'<'col-sm-3'i> <'col-sm-3'> <'col-sm-6'>>" + "<'row'<'col-sm-12't>"+ "<'col-sm-6'l><'col-sm-6'p>>"
    });

    //Boton de busqueda
    $('#btnBuscar').click(function () {
        oTable.draw();
    });

    $('#dtpCreado').daterangepicker({
        "autoApply": false,
        "autoUpdateInput": true,
        "locale": {
            "format": "DD/MM/YYYY",
            "applyLabel": "Aplicar",
            "cancelLabel": "Limpiar",
            "showDropdowns": true,
            "daysOfWeek": ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
            "monthNames": ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"]
        }
    });

    $('#dtpCreado').on('cancel.daterangepicker', function(ev, picker) {
      $("#dtpCreado").val('');
    });

    $("#dtpCreado").val('');

    //Combos con select2
    $("#cmbEstados").select2();

    $('#cmbEstados').on('select2:select', function (e) {
        oTable.draw();
    });

    //Los enter de las cajas de texto
    $('input#txtTicket').keypress(function (e) {
        if (e.which == '13' && $('#txtTicket').val() != "") {
            e.preventDefault();
            oTable.draw();
        }
    });

    //Los enter de las cajas de texto
    $('input#txtAsunto').keypress(function (e) {
        if (e.which == '13' && $('#txtAsunto').val() != "") {
            e.preventDefault();
            oTable.draw();
        }
    });
});

function nuevo()
{
	var url = '<?php echo site_url('incidentes/create'); ?>';
    $(location).attr("href", url);
}
</script>