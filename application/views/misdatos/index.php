<div id="contenido_reserva" class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="text-center">Mi Datos</h2>
        </div>
        <div class="panel-body">
            <form id="actualizar_datos" method="POST" action="<?php echo base_url(); ?>misdatos/actualizar_datos">
                <div class="col-md-5">

                    <div  class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Datos personales</h3>
                        </div>
                        <div class="panel-body">

                            <div class="row">

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="nombre">Cedula :</label>
                                    </div>
                                    <div class="col-md-5">
                                        <p id="cedula"><?php echo $datos->id_usuario; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="nombre">Nombre :</label>
                                    </div>
                                    <div class="col-md-5">
                                        <p for="vehiculo" ><?php echo $datos->nombres; ?></p>
                                    </div>
                                </div>                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <p id="empresa"></p>
                                    </div>
                                    <div class="col-md-5">
                                        <p id="empresa"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($datos->tipo_usuario == 3) { ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Datos Vehiculo</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="nombre">Placa :</label>
                                        </div>
                                        <div class="col-md-5">
                                            <p id="placa"><?php echo $datos->placa; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="nombre">Tipo :</label>
                                        </div>
                                        <div class="col-md-5">
                                            <p id="vehiculo"><?php echo $datos->desc_tipo; ?></p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-md-5">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Datos Actualizar</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="celular">Celular:</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input id="celular" onkeypress="return isNumberKey(event)" name="celular"  minlength="10" maxlength="10" type="text" class="form-control" value="<?php echo $datos->celular; ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="celular">Email:</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input id="mail" name="mail" type="email" class="form-control" value="<?php echo $datos->email; ?>" required>
                                    </div>
                                </div>                                

                            </div>
                        </div>

                    </div>
                    <div >                        
                        <button class="form-control btn-danger" value="Validar" type="submit" id="validar_todo"><span class="glyphicon"></span> Actualizar</button>
                    </div>
                    <div class="row">
                        <div id="mensaje">

                        </div>
                    </div>
                </div>
            </form> 
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        var isMobile = {
            Android: function () {
                return navigator.userAgent.match(/Android/i);
            },
            BlackBerry: function () {
                return navigator.userAgent.match(/BlackBerry/i);
            },
            iOS: function () {
                return navigator.userAgent.match(/iPhone|iPad|iPod/i);
            },
            Opera: function () {
                return navigator.userAgent.match(/Opera Mini/i);
            },
            Windows: function () {
                return navigator.userAgent.match(/IEMobile/i);
            },
            any: function () {
                return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
            }
        };
    })
    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
    $("#actualizar_datos").on('submit', function () {
        var loader_ajax = "<div style=text-align:center><img src='<?php echo base_url(); ?>assets/images/loader.png'align='middle' /></div>";
        $("#actualizar").fadeOut('fast', function () {
            $("#actualizar").html(loader_ajax);
            $("#actualizar").fadeIn('fast', function () {
            });
        });
        var dato_enviar = {
            celular: $('#celular').val(),
            mail: $('#mail').val()
        };
        // console.log(dato_enviar);
        //console.log(dato_enviar);
        var url = "<?php echo base_url(); ?>misdatos/actualizar_datos";
        $.ajax({
            //async: 'False',
            type: 'POST',
            dataType: 'html',
            url: url,
            data: dato_enviar,
            success: function (data) {
                //var data = $(data).find('#contenido_vista');                    
                $("#mensaje").fadeOut('fast', function () {
                    $("#mensaje").html(data['mensaje']);
                    $("#mensaje").fadeIn('fast');
                });
            },
            statusCode: {
                500: function () {
                    $("#dialog-message").html("<p>Error de Interno! si el problema persiste favor informar al administrador!!</p>");
                    $("#dialog:ui-dialog").dialog("destroy");
                    $("#dialog-message").dialog({
                        modal: true,
                        buttons: {
                            Ok: function () {

                                $(this).dialog("close");
                            }
                        }
                    });
                },
                502: function () {
                    $("#descarga_contenido").fadeOut('fast', function () {
                        $("#descarga_contenido").html("<h1>Error de conexion por favor intentar en unos segundos</h1>");
                        $("#descarga_contenido").fadeIn('fast');
                    });
                }
            }
        });
    });

</script>
