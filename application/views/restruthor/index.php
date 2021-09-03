<div id="contenido_reserva" class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading"><h2 class="text-center">Generar reserva</h2></div>
        <div class="panel-body">
            <div id="rutas_dispo">
                <label for="rutas">Rutas disponibles</label>
                <select id="ruta" name="ruta" class="form-control" required>
                    <?php
                    foreach ($rutas as $clave => $value) {
                        echo "<option value=\"$clave\">$value</option>";
                    }
                    ?>
                </select>
                <p></p>
            </div>
            <div id="mostrar_ruta" class="panel panel-default">
                
            </div>
        </div>  
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $("#ruta").on('change', function () {
            var data = {
                ruta: $(this).val()
            }
            console.log(data);
            var url = "<?php echo base_url(); ?>restruthor/mostrar_ruta";
            $.ajax({
                async: 'False',
                type: 'POST',
                dataType: 'json',
                url: url,
                data: data,
                success: function (data) {
                    $("#mostrar_ruta").fadeOut('fast', function () {
                        $("#mostrar_ruta").html(data['restruthor']);
                        $("#mostrar_ruta").fadeIn('fast');
                    });
                }
            });
        });
    });
</script>
