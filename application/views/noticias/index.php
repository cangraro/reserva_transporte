
<div id="menu_visitas" class="container-fluid">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading"><h2 class="text-center">Noticias</h2></div>
                <div class="panel-body"> 
                    <div class="table-responsive ">
                        <table id="tabla_noticias" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered ">
                            <thead>
                                <tr>
                                    <th>Titulo</th>
                                    <th>Autor</th>
                                    <th>Fecha de Creacion</th>
                                    <th>Fecha de Publicacion</th>
                                    <th>Publicado</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($noticias as $noticia): ?>
                                    <tr>
                                        <td><?php echo $noticia->titulo; ?></td>

                                        <td><?php echo $noticia->autor; ?></td>
                                        <td>
                                            <?php echo $noticia->fecha_creacion; ?>
                                        </td>
                                        <td>
                                            <?php echo $noticia->fecha_publicacion; ?>
                                        </td>
                                        <td>
                                            <?php
                                            if($noticia->publicado==1){
                                                echo 'Si';
                                            }else{
                                                echo 'no';
                                            }
                                           ?>
                                        </td>
                                        <td><?php echo anchor("noticias/editar/" . $noticia->id, 'Editar'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table></div>
                </div>
            </div>
        </div>
    </div>

    <p><?php echo anchor('noticias/crear', 'Nueva') ?> </p>
    <div class="row">
        <div class="col-md-12">
            <div id="loader_ajax_contacto" style="display: none;">
                <div style="text-align:center"><img src='<?php echo base_url(); ?>assets/images/loader.png' align='middle'></div>
            </div>
        </div>
        <div class="col-md-12">
            <div id="respuesta">

            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    $(function() {
        $('#tabla_noticias').dataTable();




    });





</script>

