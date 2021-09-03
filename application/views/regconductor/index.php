<div id="gestor_usuarios" class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="text-center">Registro usuarios</h2>
        </div>
        <div class="panel-body">

            <div class="col-md-5">

                <div  class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Datos Usuario</h3>
                    </div>
                    <div class="panel-body">
                        <form id="ingresar_usuario" method="POST" action="<?php echo base_url(); ?>regconductor/insertar_usuarios">
                            <div class="row">

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="nombre">Cedula :</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input id="cedula" onkeypress="return isNumberKey(event)" name="cedula" type="text" maxlength="10" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="nombre">Nombre :</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input id="nombre"  name="nombre"type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="fecha_nacimiento">Fecha de nacimiento :</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input id="fecha_nacimiento"  name="fecha_nacimiento" type="date" class="form-control" max="1995-12-31" min="1950-01-01" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="telefono">Telefono :</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input id="telefono" onkeypress="return isNumberKey(event)" name="telefono" maxlength="7" minlength='7' type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="email">Email:</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input id="email" name="email" type="email"class="form-control" required> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="celular">Celular:</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input id="celular" onkeypress="return isNumberKey(event)" name="celular" type="text" maxlength="10" minlength='10' class="form-control" required> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="tipo">Perfil:</label>
                                    </div>
                                    <div class="col-md-5">
                                        <select id="tipo" name="tipo" type="text" class="form-control" required> 
                                            <option value="">--Seleccione uno--</option>
                                            <option value="2">Estudiante</option>
                                            <option value="3">Conductor</option>                                  
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <button class="form-control btn-danger" value="Validar" type="submit" id="validar_todo"><span class="glyphicon"></span>Ingresar</button>
                        </form>
                    </div>
                </div>                
                <div id='mensaje'>                        

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(function () {
        
    })
    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
</script>
