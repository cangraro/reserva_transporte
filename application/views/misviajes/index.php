<div id="contenido_vista" class="container-fluid">




    <div class="panel panel-default">
        <div class="panel-heading"><h2 class="text-center">Mis viajes</h2></div>
        <div id="alert" class="alert alert-warning hidden" align="center" role="alert"><h3>Debe seleccionar una ruta</h3></div>
        <div class="panel-body">            
            <div class="col-md-4">
                <?php foreach ($misviajes as $miviaje) { ?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><?php echo $miviaje->descripcion; ?></div>
                        <div class="panel-body">
                            <div class="row">                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="vehiculo">Vehiculo</label>
                                    </div>
                                    <div class="col-md-4">
                                        <p id="vehiculo"><?php echo $miviaje->placa; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="reservados">Reservados</label>
                                    </div>
                                    <div class="col-md-4">
                                        <p id="reservados"><?php echo $miviaje->reservas; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="disponibilidad">Disponibilidad</label>
                                    </div>
                                    <div class="col-md-4">
                                        <p id="disponibilidad"><?php echo $miviaje->disponibles; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="horario">Horario</label>
                                    </div>
                                    <div class="col-md-4">
                                        <p id="horario"><?php echo $miviaje->horario; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="seleccion"></label>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="radio-inline" ><input value="<?php echo $miviaje->id_viaje; ?>" type="radio" id="viaje" name="viaje" required>Seleccionar</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>                
                <button id="btn_encurso" type="button" class="btn btn-success navbar-btn" >En curso</button>
                <button id="btn_cancelar" type="button" class="btn btn-danger navbar-btn" >Cancelar</button>
                <p id='mensaje'> <p/>
            </div>
            <div id="mostrar_mapa" class="col-lg-6">

            </div>


        </div>
    </div>

</div>

<script type="text/javascript">
    $(function () {
        
        $("input[id^='viaje']").change(function () {
            $("#alert").fadeOut('fast');
            var data = {
                ruta: $(this).val()

            }
            console.log(data);
            var url = "<?php echo base_url(); ?>misviajes/mostrar_mapa";
            $.ajax({
                async: 'False',
                type: 'POST',
                dataType: 'json',
                url: url,
                data: data,
                success: function (data) {
                    $("#mostrar_mapa").fadeOut('fast', function () {
                        $("#mostrar_mapa").html(data['mapa']);
                        $("#mostrar_mapa").fadeIn('fast');
                    });
                }
            });
        });
        $("#btn_encurso").click(function () {
            if ($("input:checked").val() != null) {
                var data = {
                    viaje: $("input:checked").val(),
                    estado: '2',
                    estado_r: '3'
                }
                console.log(data);
                var url = "<?php echo base_url(); ?>misviajes/actualizar_estado";
                $.ajax({
                    async: 'False',
                    type: 'POST',
                    dataType: 'json',
                    url: url,
                    data: data,
                    success: function (data) {
                        $("#contenido_vista").fadeOut('fast', function () {
                            $("#contenido_vista").html(data['mensaje']);
                            $("#contenido_vista").fadeIn('fast');
                        });
                    }
                });
            } else {
                $("#contenido_vista").html();
                $("#alert").fadeIn('fast');
                $("#alert").removeClass('hidden');                
                return false;
            }
        });
        $("#btn_cancelar").click(function () {
            $("#alert").fadeOut('fast');
            if ($("input:checked").val() != null) {
                var data = {
                    viaje: $("input:checked").val(),
                    estado: '3',
                    estado_r: '2'
                }
                console.log(data);
                var url = "<?php echo base_url(); ?>misviajes/actualizar_estado";
                $.ajax({
                    async: 'False',
                    type: 'POST',
                    dataType: 'json',
                    url: url,
                    data: data,
                    success: function (data) {
                        $("#contenido_vista").fadeOut('fast', function () {
                            $("#contenido_vista").html(data['mensaje']);
                            $("#contenido_vista").fadeIn('fast');
                        });
                    }
                });
            } else {
                $("#contenido_vista").html();
                $("#alert").fadeIn('fast');
                $("#alert").removeClass('hidden');                
                return false;
            }
        });

    });
</script>
