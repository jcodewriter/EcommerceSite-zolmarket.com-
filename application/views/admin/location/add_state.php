<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans("add_state"); ?></h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open('admin_controller/add_state_post'); ?>

            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>
                <div class="form-group">
                    <label><?php echo trans('country'); ?></label>
                    <select name="country_id" class="form-control" required>
                        <option value=""><?php echo trans("select"); ?></option>
                        <?php
                        foreach ($countries as $item): ?>
                            <option value="<?php echo $item->id; ?>">
                                <?php echo html_escape($item->name); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php foreach ($languages as $key=>$language): ?>
                    <div class="form-group">
                        <label><?php echo trans("name"); ?>(<?php echo $language->name;?>)</label>
                        <?php if($key):?>
                            <input type="text" class="form-control" name="<?php echo $language->short_form;?>_name" placeholder="<?php echo trans("name"); ?>" maxlength="200" required>
                        <?php else:?>
                            <input type="text" class="form-control" name="name" placeholder="<?php echo trans("name"); ?>" maxlength="200" required>
                        <?php endif;?>    
                    </div>
                <?php endforeach;?>
            </div>

            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><?php echo trans('add_state'); ?></button>
            </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
        <!-- /.box -->
    </div>
</div>
