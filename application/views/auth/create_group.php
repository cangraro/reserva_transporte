
<div id="menu_visitas" class="container-fluid">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-info">
                <div class="panel-heading"><h2 class="text-center">Crear Grupo</h2></div>
                <div class="panel-body"> 

                    <div id="infoMessage"><?php echo $message; ?></div>

                    <?php echo form_open("auth/create_group"); ?>

                    <p>
                        <?php echo lang('create_group_name_label', 'group_name'); ?> <br />
                        <?php echo form_input($group_name); ?>
                    </p>

                    <p>
                        <?php echo lang('create_group_desc_label', 'description'); ?> <br />
                        <?php echo form_input($description); ?>
                    </p>

                    <p><?php echo form_submit('submit', lang('create_group_submit_btn')); ?></p>

                    <?php echo form_close(); ?>

                </div>
            </div>
        </div>
    </div>
</div>