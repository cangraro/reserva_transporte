<div id="contenido_reserva" class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="text-center">Gestion Rutas</h2>
        </div>
        <div id="alert" class="alert alert-warning hidden" align="center" role="alert"><h3>Ruta de origen y destino deben ser diferentes</h3></div>
        <div class="panel-body">
            <form id='ingresar_ruta' method="POST" action="<?php echo base_url(); ?>regruta/insertar_ruta">
                <div class="col-md-5">
                    <div  class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Rutas</h3>
                        </div>
                        
                        <div class="panel-body">
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="nombre">Descripcion ruta :</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input id="desruta"  name="desruta" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="tipo">Inicio:</label>
                                    </div>
                                    <div class="col-md-5">
                                        <select id="tipo1" name="tipo1" type="text" class="form-control" required> 
                                            <option value="">--Seleccione uno--</option>
                                            <option value="1">Campus Robledo</option>
                                            <option value="2">Campus Poblado</option>
                                            <option value="3">Campus Laureles</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="tipo">Fin :</label>
                                    </div>
                                    <div class="col-md-5">
                                        <select id="tipo2" name="tipo2" type="text" class="form-control" required> 
                                            <option value="">--Seleccione uno--</option>
                                            <option value="1">Campus Robledo</option>
                                            <option value="2">Campus Poblado</option>
                                            <option value="3">Campus Laureles</option>
                                            <option value="4">Calazans</option>
                                            <option value="5">Estacion Floresta</option>
                                            <option value="6">Estacion Envigado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="tipo">URL mapa :</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input id="mapa" name="mapa" type="url" maxlength="2000" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <button class="form-control btn-danger" value="Validar" type="submit" id="validar_todo"><span class="glyphicon"></span>Ingresar</button>
                        </div>
                        
                    </div>
                    
                </div>
<!--                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Preview ruta:</div>
                        <div class="panel-body">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m20!1m8!1m3!1d7931.690501198279!2d-75.5766129648943!3d6.284063886660518!3m2!1i1024!2i768!4f13.1!4m9!3e0!4m3!3m2!1d6.2799368!2d-75.57856559999999!4m3!3m2!1d6.288873499999999!2d-75.57732109999999!5e0!3m2!1ses-419!2s!4v1433385935485" width="600" height="450" frameborder="0" style="border:0"></iframe>  
                            </div>
                        </div>
                    </div>
                </div>-->
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        
    })
    $("#ingresar_ruta").on('submit', function () {
        if ($("#tipo1").val()==$("#tipo2").val()) {
            $("#contenido_reserva").html();
                $("#alert").fadeIn('fast');
                $("#alert").removeClass('hidden');                
                return false;
        }else{
            
        }
    });
</script>
