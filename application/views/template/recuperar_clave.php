<!DOCTYPE HTML>
<html>
    <head>
        <title>Portal de Ventas Pymes</title>
        <meta charset="UTF-8" />
        <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/reset.css">-->
        <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/structure.css">-->
        <link rel='shortcut icon' type='image/x-icon' href='<?php echo base_url(); ?>favicon.ico' />
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
                <div class="alert alert-danger" role="alert"><h5 class="text-center"><?php echo $this->session->flashdata('error'); ?></h5>
                    <h5 class="text-center"><?php echo validation_errors();?></h5></div>
            <?php } ?>

            <div class="row">

                <div class="col-md-12 col-lg-4 col-lg-offset-4">
                    <h1 class="text-center login-title">Identificate para enviarte una clave nueva</h1>

                   
                    <div class="account-wall">
                        <img class="profile-img" src="<?php echo base_url() ?>assets/images/srwrat.png" alt="">
                        <!--<img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120" alt="">-->
                        <?php echo form_open('menu/recuperar_clave', "class= 'form-signin'"); ?>

                        <!--                        <form class="form-signin" action>-->
                        <p>
                            <input type="text" name="usuario" class="form-control" placeholder="Codigo Asesor" required autofocus>
                        </p>
                        <p>
                            <?php echo $image; ?>
                        </p>

                        <p>

                            <input id="captcha" class="form-control" name="captcha" type="text" placeholder="Digite los caracteres de la imagen" required />

                        </p>

<!--<input type="password" name="clave" class="form-control" placeholder="Clave" required>-->
                        <button class="btn btn-lg btn-danger btn-block" type="submit">Enviar</button>

 <!--<a href="#" class="pull-right need-help">Olvidate tu clave? </a><span class="clearfix"></span>-->
                        <?php echo form_close(); ?>
                    </div>
                    <!--<a href="#" class="text-center new-account">Olvidaste tu Clave??</a>-->
                </div>

            </div>
        </div>
        <footer id="main">
        </footer>
    </body>
</html>


