<div id="menu_visitas" class="container-fluid">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-info">
                <div class="panel-heading"><h2 class="text-center">Usuarios</h2></div>
                <div class="panel-body">

                    <?php
                    echo form_open(uri_string());
                    $style = "class='form-control'";
                    ?>

                    <p>
                        <?php echo lang('edit_user_fname_label', 'nombre_completo'); ?> <br />
                        <?php echo form_input($nombre_completo, 'nombre_completo', $style); ?>
                    </p>





                    <p>
                        <?php echo lang('edit_user_password_label', 'password'); ?> <br />
                        <?php echo form_input($password, 'password', $style); ?>
                    </p>

                    <p>
                        <?php echo lang('edit_user_password_confirm_label', 'password_confirm'); ?><br />
                        <?php echo form_input($password_confirm, 'password_confirm', $style); ?>
                    </p>

                    <?php if ($this->ion_auth->is_admin()): ?>

                        <h3><?php echo lang('edit_user_groups_heading'); ?></h3>
                        <div class="btn-group" data-toggle="buttons">                       
                            <?php foreach ($groups as $group): ?>
                                <?php
                                $gID = $group['id'];
                                $checked = null;
                                $active = null;
                                $item = null;
                                foreach ($currentGroups as $grp) {
                                    if ($gID == $grp->id) {
                                        $checked = 'checked';
                                        $active = 'active';
                                        break;
                                    }
                                }
                                ?>
                                <label class="btn btn-default <?php echo $active; ?>">

                                    <input type="checkbox" name="groups[]" value="<?php echo $group['id']; ?>"<?php echo $checked; ?>/>
                                    <?php echo $group['name']; ?></label>

                            <?php endforeach ?>
                        </div>

                    <?php endif ?>

                    <?php echo form_hidden('id', $user->id); ?>
                    <?php echo form_hidden($csrf); ?>

                    <p><?php echo form_submit('submit', lang('edit_user_submit_btn'), "class='btn btn-success'"); ?></p>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
