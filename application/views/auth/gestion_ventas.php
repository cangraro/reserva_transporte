<div id="contenido_venta" class="container-fluid">


    <div class="panel panel-default">
        <div class="panel-heading"><h2 class="text-center">Consulta Venta Móvil</h2></div>



        <div class="panel-body">


            <div class="panel panel-default">
                <div class="panel-body">
                   

                    <div class="row">
                        <div class="col-md-3">                   
                            <h4>Numero de Venta: </h4>
                        </div>
                        <div class="col-md-5">
                            <input name="id_venta" id="id_venta" type="text" class="form-control" />
                        </div>
                        <div class="col-md-4">
                            <a href="#" id="boton_aceptacion_venta" class="btn btn-danger form-control" style="color:#FFF;">Descargar Aceptacion</a>
                        </div>
                    </div>
                </div>
            </div>









        </div>
    </div>

    <div class="row">
        <div id="consulta_contenido" style="display:none;"></div>
    </div>
    <div class="modal fade" id="consulta_contenido_resumen" tabindex="-1" role="dialog" aria-labelledby="resumen_venta" aria-hidden="true">  
    </div>

    <div id="panel_descarga" > 
        <div id="ventas_contenido">
        </div>
    </div>
</div> 

<div id="dialog-message" style="display:none; " title="Gestion Ventas">
</div>

<script type="text/javascript">
    $(function() {

        $("#boton_aceptacion_venta").on('click', function() {

            if ($("#id_venta").val() == '') {
                $("#id_venta").addClass('form-error');
            } else {
                var loader_ajax = "<div style=text-align:center><img src='<?php echo base_url(); ?>assets/images/loader.png'align='middle' /></div>";
                $("#ventas_contenido").fadeOut('fast', function() {
                    $("#ventas_contenido").html(loader_ajax);
                    $("#ventas_contenido").fadeIn('fast', function() {

                    });
                });
                var dato_enviar = {
                    id: $("#id_venta").val()
                };
                var url = "<?php echo base_url(); ?>auth/generar_aceptacion_venta";
                $.ajax({
                    async: 'False',
                    type: 'POST',
                    dataType: 'html',
                    url: url,
                    data: dato_enviar,
                    success: function(data) {
                        $("#ventas_contenido").fadeOut('fast', function() {
                        $("#ventas_contenido").html(data);
                        $("#ventas_contenido").fadeIn('fast');
                    });
                    },
                    statusCode: {
                        500: function() {
                            $("#consulta_contenido").fadeOut('fast', function() {
                                $("#consulta_contenido").html("<h1>Error Interno! si el problema persiste favor informar al administrador</h1>");
                                $("#consulta_contenido").fadeIn('fast');
                            });
                        },
                        502: function() {
                            $("#consulta_contenido").fadeOut('fast', function() {
                                $("#consulta_contenido").html("<h1>Error de conexion por favor intentar en unos segundos</h1>");
                                $("#consulta_contenido").fadeIn('fast');
                            });
                        }
                    }
                });
            }


            return false;
        });


        $("#boton_descargar").on('click', function() {
            var loader_ajax = "<div style=text-align:center><img src='<?php echo base_url(); ?>assets/images/loader.png'align='middle' /></div>";
            $("#ventas_contenido").html(loader_ajax);
            $("#ventas_contenido").fadeIn('fast');
            var data = {
                tipo: $("#drop_tipo").val(),
                mes: $("#drop_mes").val(),
                anio: $("#drop_anio").val()
            };
            var url = "<?php echo base_url(); ?>consultavm/descargar_informe";
            $.ajax({
                type: 'POST',
                data: data,
                url: url,
                success: function(data) {

                    $("#ventas_contenido").fadeOut('fast', function() {
                        $("#ventas_contenido").html(data);
                        $("#ventas_contenido").fadeIn('fast');
                    });
                },
                statusCode: {
                    500: function() {
                        $("#descarga_contenido").fadeOut('fast', function() {
                            $("#descarga_contenido").html("<h1>Error Interno! si el problema persiste favor informar al administrador</h1>");
                            $("#descarga_contenido").fadeIn('fast');
                        });
                    },
                    502: function() {
                        $("#descarga_contenido").fadeOut('fast', function() {
                            $("#descarga_contenido").html("<h1>Error de conexion por favor intentar en unos segundos</h1>");
                            $("#descarga_contenido").fadeIn('fast');
                        });
                    }
                }
            });
            return false;
        });


    });
</script>
