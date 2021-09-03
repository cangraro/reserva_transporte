<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>Reserva de transporte</title>
        <link rel='shortcut icon' type='image/x-icon' href='<?php echo base_url(); ?>favicon.ico' />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-theme.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datepicker3.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-filestyle.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/general.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-tagsinput.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/flipclock.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/picker/default.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/DateTimePicker.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/summernote.css" type="text/css">
<!--        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.structure.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.theme.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.theme.min.css" type="text/css">
        -->
    </head>
    <body>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/locales/bootstrap-datepicker.es.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.placeholder.js"></script>
        <!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>-->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/localization/messages_es.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-filestyle.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-migrate-1.2.1.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-tagsinput.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.countdown.min.js"></script>
        <!-- picker mobile -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/DateTimePicker.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/summernote.min.js"></script>







        <nav class="navbar navbar-custom" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-custom" style="padding-top: 13px;" href="<?php echo base_url(); ?>"><img src="<?php echo base_url() ?>assets/images/Logo.png" />Reserva de transporte</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <?php
                        if ($this->ion_auth->logged_in() && (
                                $this->ion_auth->logged_in() && ($this->ion_auth->in_group(2) ||
                                        $this->ion_auth->is_admin()))) {
                            ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Estudiante<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">

                                    <?php
                                    if ($this->ion_auth->logged_in() && ($this->ion_auth->in_group(2) 
                                            || $this->ion_auth->is_admin())) {
                                        ?>
                                        <li><a href="<?php echo base_url() . 'restruthor'; ?>">Reserva, rutas y horarios</a></li>

                                        <li class="divider"></li>
                                        
                                        <li><a href="<?php echo base_url() . 'mireserva'; ?>">Mis reservas</a></li>
                                        
                                        <li class="divider"></li>
                                        
                                        <li><a href="<?php echo base_url() . 'misdatos'; ?>">Mis datos</a></li>
                                    
                                    <?php } ?>
                                    
                                    <li class="divider"></li>

                                </ul>
                            </li>
                        <?php } ?>
                            <?php
                        if ($this->ion_auth->logged_in() && (
                                $this->ion_auth->logged_in() && ($this->ion_auth->in_group(3) ||
                                        $this->ion_auth->is_admin()))) {
                            ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Conductores<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <?php
                                if ($this->ion_auth->logged_in() && ($this->ion_auth->in_group(3)
                                        || $this->ion_auth->is_admin())) {
                                    ?>
                                    <li><a href="<?php echo base_url() . 'misdatos'; ?>">Mis datos</a></li>
                                    <li class="divider"></li>                                    
                                    
                                    <li><a href="<?php echo base_url() . 'misviajes'; ?>">Mis viajes</a></li>
                                    <li class="divider"></li>
                                    
                                    
                                <?php } ?>                                

                            </ul>
                        </li>
                        <?php } ?>
                        

                        <?php if ($this->ion_auth->is_admin()) { ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administración<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">

                                    <li><a href="<?php echo base_url() . 'auth'; ?>">Usuarios</a></li>
                                    <li class="divider"></li>

                                    <!--<li><a href="<?php //echo base_url() . 'auth/create_group'; ?>">Grupos</a></li>-->
                                    <!--<li class="divider"></li>-->
                                    
                                    <li><a href="<?php echo base_url() . 'regconductor'; ?>">Gestion usuarios</a></li>
                                    <li class="divider"></li>
                                    
                                    <li><a href="<?php echo base_url() . 'regruta'; ?>">Gestion rutas</a></li>
                                    <li class="divider"></li>
                                    
                                    <li><a href="<?php echo base_url() . 'regvehiculo'; ?>">Gestion Vehiculos</a></li>
                                    <li class="divider"></li>
                                    
                                    <li><a href="<?php echo base_url() . 'regviaje'; ?>">Gestion Viajes</a></li>
                                    <li class="divider"></li>
                                    
<!--                                    <li><a href="<?php //echo base_url() . 'noticias'; ?>">Noticias</a></li>
                                    <li class="divider"></li>-->

                                </ul>
                            </li>
                        <?php } ?>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo base_url(); ?>menu/cambiar_clave"><?php echo 'Cambiar clave'; ?></a></li>
                        <li><a  href="<?php echo base_url(); ?>menu/logout">Salir</a></li>        
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <?php if ($this->session->flashdata('message')) { ?>
            <div class="alert alert-success" role="alert"><h5 class="text-center"><?php echo $this->session->flashdata('message'); ?></h5></div>
        <?php } ?>
        <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-danger" role="alert"><h5 class="text-center"><?php echo $this->session->flashdata('error'); ?></h5></div>
            <?php } ?>






