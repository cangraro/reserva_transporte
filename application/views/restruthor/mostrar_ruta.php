<div id="mostrar_ruta" class="panel panel-default">
    <div class="panel-body">
        <div id="alert" class="alert alert-warning hidden" align="center" role="alert"><h3>Debe seleccionar una ruta</h3></div>
        <div class="col-md-4">
            <?php foreach ($restruthor as $lista) { ?>
                <div class="panel panel-default">
                    <div class="panel-heading"><?php echo $lista->descripcion; ?></div>
                    <div class="panel-body">
                        <div class="row">                                
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="vehiculo">Vehiculo</label>
                                </div>
                                <div class="col-md-4">
                                    <p id="vehiculo"><?php echo $lista->placa; ?></p>
                                </div>
                            </div>                                    
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="disponibilidad">Disponibilidad</label>
                                </div>
                                <div class="col-md-4">
                                    <p id="disponibilidad"><?php echo $lista->disponibles; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="horario">Horario</label>
                                </div>
                                <div class="col-md-4">
                                    <p id="horario"><?php echo $lista->horario; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="seleccion"></label>
                                </div>
                                <div class="col-md-4">
                                    <label class="radio-inline"><input type="radio" value="<?php echo $lista->id_viaje; ?>" name="seleccion" id="seleccion">Seleccionar</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div>                        
                <button id="btn_reservar" type="button" class="btn btn-danger navbar-btn" >Reservar</button>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $lista->descripcion; ?></div>
                <div class="panel-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="<?php echo $lista->mapa; ?>" width="600" height="450" frameborder="0" style="border:0"></iframe>  
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $("input[id^='seleccion']").change(function () {
            $("#alert").fadeOut('fast');            
        });
    $("#btn_reservar").on('click', function () {
        if ($("input:checked").val() != null) {
            var data = {
                viaje: $("input:checked").val()
            }
            console.log(data);
            var url = "<?php echo base_url(); ?>restruthor/reservar";
            $.ajax({
                async: 'False',
                type: 'POST',
                dataType: 'json',
                url: url,
                data: data,
                success: function (data) {
                    $("#mostrar_ruta").fadeOut('fast', function () {
                        $("#mostrar_ruta").html(data['mensaje']);
                        $("#mostrar_ruta").fadeIn('fast');
                        $("#rutas_dispo").fadeOut('fast');

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
</script>
