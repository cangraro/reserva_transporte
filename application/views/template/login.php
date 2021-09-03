<!DOCTYPE HTML>
<html>
    <head>
        <title>Portal reserva de transporte</title>
        <meta charset="UTF-8" />
        <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/reset.css">-->
        <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/structure.css">-->
        <link rel='shortcut icon' type='image/x-icon' href='<?php echo base_url(); ?>favicon2.ico' />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-theme.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/login.css" type="text/css">


    </head>

    <body>




        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

        <div class="container">
            <?php if ($this->session->flashdata('message')) { ?>
                <div class="alert alert-success" role="alert"><h5 class="text-center"><?php echo $this->session->flashdata('message'); ?></h5></div>
            <?php } ?>
            <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-success" role="alert"><h5 class="text-center"><?php echo $this->session->flashdata('error'); ?></h5></div>
            <?php } ?>
            <div class="row">

                <div class="col-md-12 col-lg-4 col-lg-offset-4">
                    <h1 class="text-center login-title">Identificate para ingresar al aplicativo</h1>

                    <?php // echo validation_errors(); ?>
                    <!--        <form class="box login" action="">-->
                    <?php //echo form_open('menu/login', "class= 'form-control'"); ?>
                    <!--                    <fieldset class="boxBody">
                                            <label for="usuario">Usuario</label>
                                            <input name="usuario" id="usuario" type="text" tabindex="1" placeholder="Digite su Usuario" required>
                                            <label for="clave">Clave</label>
                                            <input name="clave" id="clave" type="password" placeholder="Digite su Clave" tabindex="2" required>
                                        </fieldset>
                                        <footer>
                                            <input type="submit" class="btnLogin" value="Entrar" tabindex="4">
                                        </footer>
                                        </form>-->

                    <div class="account-wall">
                        <img class="profile-img" src="<?php echo base_url() ?>assets/images/SRWRAT.png" alt="">
                        <!--<img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120" alt="">-->
                        <?php echo form_open('menu/login', "class= 'form-signin'"); ?>

                        <!--                        <form class="form-signin" action>-->
                        <input type="text" name="usuario" class="form-control" placeholder="Cedula" required autofocus>
                        <input type="password" name="clave" class="form-control" placeholder="Clave" required>
                        <button class="btn btn-lg btn-danger btn-block" type="submit">Entrar</button>
                        <label class="checkbox pull-left">
<!--                            <input type="checkbox" value="remember-me">
                            Recuerdame-->
<!--                        </label>
                        <a href="<?php //echo base_url() ?>menu/recuperar_clave" class="pull-right need-help">Olvidaste tu clave? </a><span class="clearfix"></span>
                        </form>-->
                    </div>
                    <!--<a href="#" class="text-center new-account">Olvidaste tu Clave??</a>-->
                </div>

            </div>
        </div>
        <footer id="main">
        </footer>
    </body>
</html>


