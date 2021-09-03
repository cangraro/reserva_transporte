<link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<div id="menu_visitas" class="container-fluid">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading"><h2 class="text-center">Creacion de Articulos</h2></div>
                <div class="panel-body"> 
                    <?php echo form_open('noticias/editar', 'id="form_editar"'); ?>

                    <p>   
                        <input type="hidden" value="<?php echo $noticia->id; ?>" id='id' name="id"/>
                        <input type="hidden" value="<?php echo $noticia->fecha_publicacion; ?>" id='fecha_publicacion' name="fecha_publicacion"/>
                        

                        <input id="titulo" name="titulo" type="text" class="form-control"
                               size="75" value="<?php echo $noticia->titulo;?>"  placeholder="Titulo del Articulo" />
                    </p>


                    <div id="txt_content">  <?php echo $noticia->contenido;?>
                    </div>

                    <p>
                        <label for="publicado">Publicar?</label>
                        <input id="publicado" name="publicado" type="checkbox" <?php if($noticia->publicado==1) echo 'checked'; ?>  />
                    </p>
                    <p>
                        <input type="submit" class="btn btn-info" />
                    </p>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        $("#txt_content").summernote({height: 200});

        $('#form_editar').on('submit', function() {

            //var datos = $(this).serialize() + "&contenido=" + $("#txt_content").code();
            
             var datos= {
                usuario : $("#usuario").val(),
                id : $("#id").val(),
                contenido: $("#txt_content").code(),
                titulo:$("#titulo").val(),
                publicado:$("#publicado").is(':checked') ? 1 : 0,
                fecha_publicacion: $("#fecha_publicacion").val()
             };

            var url = $(this).attr('action');

            $.ajax({
                type: 'POST',
                dataType: 'html',
                url: url,
                data: datos,
                async: false,
                success: function(data) {
                    if(data=="correcto"){
                       // console.log(datos);
                    window.location.replace("<?php echo base_url();?>noticias");
                    }else{
                        window.location.replace("<?php echo base_url();?>noticias/editar");
                    }
                }
                ,
                statusCode: {
                    500: function() {
                        $("#descarga_contenido").fadeOut('fast', function() {
                            $("#descarga_contenido").html("<h1>Error de Interno! si el problema persiste favor informar al administrador!!</h1>");
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

       //  console.log(datos);
            return false;
        });

    });
</script>