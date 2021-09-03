<link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<div id="menu_visitas" class="container-fluid">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading"><h2 class="text-center">Creacion de Articulos</h2></div>
                <div class="panel-body"> 
                    <?php echo form_open('noticias/crear', 'id="form_crear"'); ?>

                    <p>   
                        <input id="titulo" name="titulo" type="text" class="form-control"
                               size="75" value=""  placeholder="Titulo del Articulo" />
                    </p>


                    <div id="txt_content">  
                    </div>

                    <p>
                        <label for="publicado">Publicar?</label>
                        <input id='publicado' name="publicado" type="checkbox"  />
                    </p>
                    <p>
                        <input type="submit" class="btn btn-danger" />
                    </p>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        $("#txt_content").summernote({
        height: 200,
        tabsize: 2,
       
        toolbar: [
  		    ['style', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
  		    ['fontsize', ['fontsize']],
  		    ['color', ['color']],
  		    ['para', ['ul', 'ol', 'paragraph']],
  		    ['height', ['height']]
  		  ]
      });

        $('#form_crear').on('submit', function() {
             var datos= {
                usuario : $("#usuario").val(),
                contenido: $("#txt_content").code(),
                titulo:$("#titulo").val(),
                publicado:$("#publicado").is(':checked') ? 1 : 0
             };


           // var datos = $(this).serialize() + "&contenido=" + $("#txt_content").code();

            var url = $(this).attr('action');

            $.ajax({
                type: 'POST',
                dataType: 'html',
                url: url,
                data: datos,
                async: false,
                success: function(data) {
                    console.log(data);
                    if(data=="correcto"){
                        window.location.replace("<?php echo base_url();?>noticias");
                    }else{
                         window.location.replace("<?php echo base_url();?>noticias/crear");
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