<?php
    $nombre_usuario = array(
        'id'                => 'nombre_acceso',
        'name'              => 'nombre_acceso',
        'class'             => 'form-control',
        'data-val'          => 'true',
        'data-val-required' => 'Campo requerido',
        'placeholder'       => 'Nombre de usuario',
    );

    $clave_usuario = array(
        'id'                => 'clave_acceso',
        'name'              => 'clave_acceso',
        'class'             => 'form-control',
        'placeholder'       => 'Clave de acceso',
    );

    $recordar = array(
        'id'                => 'recordarme',
        'name'              => 'recordarme'
    );
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Inicio de sesi&oacute;n</title>

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?php echo base_url(); ?>assets/dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <!-- <div class="panel-heading" style="text-align:center">
                            <span class="panel-title" style="font-size: 20px">Helpdesk</span>
                        </div> -->
                        <div style="text-align:center; padding-top:25px; margin-bottom:5px;">
                            <img src="<?php echo base_url(); ?>assets/images/logo_serlisa.png" />
                        </div>

                        <div></div>
                        
                        <div class="panel-body">
                            <form role="form" method="post" action="<?php echo site_url('account/login_action'); ?>">
                                <fieldset>
                                    <div class="form-group">
                                        <?php echo form_input($nombre_usuario); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_password($clave_usuario); ?>
                                    </div>
                                    <div class="form-group checkbox">
                                        <label>
                                            <?php echo form_checkbox($recordar, 'Recordarme', FALSE); ?>
                                            <?php echo form_label('Recordarme','recordarme','style="padding-left:0"'); ?>
                                        </label>
                                    </div>

                                    <input type="submit" name="btnIngresar" value="Ingresar" class="btn btn-lg btn-success btn-block" />

                                </fieldset>

                                <br />
                                
                                <?php if( $login_failed ) { ?>
                                    <div style="font-family:Calibri; font-size:15px; color:red; font-weight:bold;">
                                        Error al ingresar
                                        <ul>
                                            <li>Credenciales inv&aacute;lidas</li>
                                        </ul>
                                    </div>
                                <?php } ?>
                            </form>
                        </div>
                        <div class="panel-footer" style="text-align: center; font-size:12px; font-family: calibri; color: gray">
                            Helpdesk - Cifnic 2023
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>

    </body>

</html>