<div id="contenido_reserva" class="container-fluid">


    <div class="panel panel-default">
        <div class="panel-heading"><h2 class="text-center">Mi reserva</h2></div>



        <div class="panel-body">


            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">información reserva</div>
                            <div class="panel-body">

                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label  for="reserva" value="<?php echo $mireserva->id_reserva; ?>">Reserva No:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <p for="reserva" ><?php echo $mireserva->id_reserva; ?></p>
                                            <input class="hidden" id="reserva_id" name="reserva_id" for="reserva" value="<?php echo $mireserva->id_reserva; ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="estado">Estado reserva:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <p id="estado"><?php echo $mireserva->estado; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="fecha">Fecha y hora reserva:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <p id="fecha"><?php echo $mireserva->horario; ?></p>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">Datos vehiculo</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="vehiculo">Vehiculo :</label>
                                        </div>
                                        <div class="col-md-4">
                                            <p id="vehiculo" ><?php echo $mireserva->placa; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="tipo">Tipo vehiculo:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <p id="tipo"><?php echo $mireserva->desc_tipo; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="ruta">Ruta Asignada</label>
                                        </div>
                                        <div class="col-md-4">
                                            <p id="ruta"><?php echo $mireserva->descripcion; ?></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">Datos Conductor</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="nombre">Conductor :</label>
                                        </div>
                                        <div class="col-md-4">
                                            <p id="vehiculo"><?php echo $mireserva->nombres; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="celular">Celular:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <p id="celular"><?php echo $mireserva->celular; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>                        
                            <button id="btn_cancelar" type="button" class="btn btn-success navbar-btn" >Declinar</button>


                            <p></p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><?php echo $mireserva->descripcion ; ?></div>
                            <div class="panel-body">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="<?php echo $mireserva->mapa; ?>" width="600" height="450" frameborder="0" style="border:0"></iframe>  
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $("#btn_cancelar").click(function () {
            var data = {
                reserva: $("#reserva_id").val(),
                estado: '2'                
            }
            console.log(data);
            var url = "<?php echo base_url(); ?>mireserva/declinar_reser";
            $.ajax({
                async: 'False',
                type: 'POST',
                dataType: 'json',
                url: url,
                data: data,
                success: function (data) {
                    $("#contenido_reserva").fadeOut('fast', function () {
                        $("#contenido_reserva").html(data['mensaje']);
                        $("#contenido_reserva").fadeIn('fast');
                    });
                }
            });
        });
    });
</script>
