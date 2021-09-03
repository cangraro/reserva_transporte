<div id="contenido_reserva" class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="text-center">Gestor Viaje</h2>
        </div>
        <div class="panel-body">

            <div class="col-md-5">

                <div  class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Datos Viaje</h3>
                    </div>
                    <div class="panel-body">
                        <form id="ingresar_viaje" method="POST" action="<?php echo base_url(); ?>regviaje/insertar_viaje"> 
                            <div class="row">

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="tipo">Placa:</label>
                                    </div>
                                    <div class="col-md-5">
                                        <select id="placa" name="placa" type="text" class="form-control" required>
                                            <?php
                                            foreach ($placa as $clave => $value) {
                                                echo "<option value=\"$clave\">$value</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="tipo">Ruta:</label>
                                    </div>
                                    <div class="col-md-5">
                                        <select id="ruta" name="ruta" type="text" class="form-control" required>
                                            <?php
                                            foreach ($ruta as $clave => $value) {
                                                echo "<option value=\"$clave\">$value</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="fecha">Horario :</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input  id="fecha" type="datetime-local" min="<?php echo date('Y') . '-' . date('m') . '-' . date('d') . 'T05:00:00.00'; ?>"  name="fecha" class="form-control" required />
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
