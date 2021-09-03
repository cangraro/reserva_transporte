
<div id="menu_visitas" class="container-fluid">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading"><h2 class="text-center">Usuarios</h2></div>
                <div class="panel-body"> 
                    <div class="table-responsive ">
                        <table id="tabla_users" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered ">
                            <thead>
                                <tr>
                                    <th><?php echo lang('index_fname_th'); ?></th>

                                    <th><?php echo lang('index_email_th'); ?></th>
                                    <th><?php echo lang('index_groups_th'); ?></th>
                                    <th><?php echo lang('index_status_th'); ?></th>
                                    <th><?php echo lang('index_action_th'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        
                                        <td><?php echo $user->nombres; ?></td>

                                        <td><?php echo $user->email; ?></td>
                                        <td>
                                            <?php foreach ($user->groups as $group): ?>
                                                <?php echo anchor("auth/edit_group/" . $group->id, $group->name); ?><br />
                                            <?php endforeach ?>
                                        </td>
                                        <td><?php echo ($user->active) ? anchor("auth/deactivate/" . $user->id, lang('index_active_link')) : anchor("auth/activate/" . $user->id, lang('index_inactive_link')); ?></td>
                                        <td><?php echo anchor("auth/edit_user/" . $user->id, 'Edit'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table></div>
                </div>
            </div>
        </div>
    </div>

    <p><?php echo anchor('auth/create_user', lang('index_create_user_link')) ?> | <?php echo anchor('auth/create_group', lang('index_create_group_link')) ?>| <?php echo anchor('auth/actualizacion_users_usuarios', 'Sincronizar Usuarios', 'rel="sync"') ?></p>
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
        $('#tabla_users').dataTable();



        $("a[rel=sync]").on('click', function() {
            $("#loader_ajax_contacto").fadeIn('fast');
            $("#respuesta").fadeOut('fast');
            // $("#dialog-message-contacto").modal('hide');
            //var datastring = $(this).serialize();
            var url = $(this).attr('href');
            ////console.log(url);
            $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                success: function(data) {
                    ////console.log(data);
                    // $("#mensaje_modal").html('<h3>' + data['mensaje'] + '</h3>');

                    var respuesta = "<h4 class='text-center'>Usuarios Nuevos: " + data['activos'] + "</h4>";

                    //$("#mensaje_modal").html('Empresa actualizada correctamente');
                    $("#respuesta").html(respuesta);

                    $("#loader_ajax_contacto").fadeOut('fast');
                    $("#respuesta").fadeIn('fast');

                    // ////console.log(data);
                    //var obj = jQuery.parseJSON(data); if the dataType is not specified as json uncomment this
                    // do what ever you want with the server response
                }
            });
            return false;
        });
    });





</script>

