<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?= $header ?>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="padding: 0" href="<?php echo site_url('home/index'); ?>">
                    <!-- <i class="fa fa-user-md fa-fw" style="font-size: 25px; color: #337ab7"></i> -->
                    <img src="<?php echo base_url(); ?>assets/images/logo_serlisa.png" style="width: 120px; margin-left:50px" />
                    <!-- <span style="font-family: Calibri; color: #337ab7; font-size: 15px;">HELPDESK</span> -->
                </a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="font-family: Calibri;">
                        <i class="fa fa-user fa-fw"></i>
                        &nbsp;<?php echo $this->session->userdata('nombre_usuario')." - ". $this->session->userdata('nombre_perfil'); ?>&nbsp;
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo site_url('users/miperfil')?>">
                            <i class="fa fa-user fa-fw"></i> Mi perfil</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo site_url('account/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> Cerrar sesi&oacute;n
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Side bar -->
            <?= $sidebar ?>

        </nav>

        <div id="page-wrapper">

            <!-- content (subview) -->
            <?= $subview ?>

        </div>
        <!-- /#page-wrapper -->

        <!-- <footer class="main-footer">
            <div class="hidden-xs" style="text-align: center; padding-top: 10px;">
                <span style="font-family:Calibri; font-size:14px;">Copyright todos los derechos reservados. Doc Helpdesk Version 1.0.1</span> 
            </div>
        </footer> -->
    </div>
     <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <!-- <script src="<?php echo base_url(); ?>assets/vendor/raphael/raphael.min.js"></script> -->
    
    <!--
    <script src="<?php echo base_url(); ?>assets/vendor/morrisjs/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/data/morris-data.js"></script>
    -->

</body>

</html>