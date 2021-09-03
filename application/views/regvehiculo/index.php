<div id="contenido_reserva" class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="text-center">Registro Vehiculo</h2>
        </div>
        <div class="panel-body">

            <div class="col-md-5">

                <div  class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Datos Vehiculo</h3>
                    </div>
                    <div class="panel-body">
                        <form id="ingresar_usuario" method="POST" action="<?php echo base_url(); ?>regvehiculo/insertar_vehiculo">
                            <div class="row">

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="nombre">Placa :</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input id="placa"  name="placa" type="text" maxlength="6" minlength="6" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="nombre">Marca :</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input id="marca"  name="marca" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="modelo">Modelo :</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input id="modelo" name="modelo" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="tipo">Tipo Vehiculo:</label>
                                    </div>
                                    <div class="col-md-5">
                                        <select id="tipo"  name="tipo" type="text" class="form-control" required> 
                                            <option value="">--Seleccione uno--</option>
                                            <option value="1">Buseta</option>
                                            <option value="2">Microbus</option>
                                            <option value="3">Minivan</option>
                                            <option value="4">Van</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="modelo">Capacidad :</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input id="capacidad" name="capacidad" type="number" min="12" max="30" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="tipo">Conductor:</label>
                                    </div>
                                    <div class="col-md-5">
                                        <select id="conductor" name="conductor" type="text" class="form-control" required>
                                            <?php
                                            foreach ($conductores as $clave => $value) {
                                                echo "<option value=\"$clave\">$value</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div>                        
                                <button class="form-control btn-danger" value="Validar" type="submit" id="validar_todo"><span class="glyphicon"></span>Ingresar</button>
                            </div>
                        </form>
                    </div>
                </div>                

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {


    }

</script>
