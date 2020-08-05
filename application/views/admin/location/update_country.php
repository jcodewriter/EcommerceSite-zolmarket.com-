<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans("update_country"); ?></h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open('admin_controller/update_country_post'); ?>
            <input type="hidden" name="id" value="<?php echo $country->id; ?>">
            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>
                <?php foreach ($languages as $key=>$language): ?>
                    <div class="form-group">
                        <label><?php echo trans("name"); ?>(<?php echo $language->name;?>)</label>
                        <?php if($key):
                                $col = $language->short_form.'_name';
                            ?>
                            <input type="text" class="form-control" name="<?php echo $language->short_form;?>_name" value="<?php echo $country->$col; ?>" placeholder="<?php echo trans("name"); ?>" maxlength="200" required>
                        <?php else:?>
                            <input type="text" class="form-control" name="name" value="<?php echo $country->name; ?>" placeholder="<?php echo trans("name"); ?>" maxlength="200" required>
                        <?php endif;?>    
                    </div>
                <?php endforeach;?>
            </div>

            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><?php echo trans('update_country'); ?></button>
            </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
        <!-- /.box -->
    </div>
</div>
