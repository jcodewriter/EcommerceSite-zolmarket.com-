<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/popup_dialog.css">
<div class="row">
    <div class="col-sm-12 form-header">
        <h1 class="form-title"><?php echo trans('custom_field_options'); ?></h1>
    </div>
</div>
<div class="callout" style="margin-top: 10px;background-color: #fff; border-color:#00c0ef;max-width: 600px;">
    <h4><?php echo trans("custom_field"); ?></h4>
    <p><?php echo trans('field_name'); ?>:&nbsp;<strong><?php echo $field_name; ?></strong></p>
    <p>
        <?php echo trans('type'); ?>:&nbsp;
        <strong>
            <?php echo trans($field->field_type); ?>
        </strong>
    </p>
</div>

<div class="row">
    <?php if ($field->field_type == "checkbox" || $field->field_type == "radio_button" || $field->field_type == "dropdown" || $field->field_type == "popup"): ?>
        <div class="col-sm-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo trans("options"); ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php if (!empty($options)): ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="custom-field-options" style="max-height: 600px; overflow: auto">
                                        <?php $count = 0;
                                        $last_common_id = "";
                                        foreach ($options as $option):?>
                                            <?php if ($last_common_id != $option->common_id):
                                                $count++; ?>
                                                <div class="field-option-item">
                                                    <?php echo form_open_multipart('category_controller/update_custom_field_option_post', ['onkeypress' => 'return event.keyCode != 13;']); ?>
                                                    <input type="hidden" name="common_id" value="<?php echo $option->common_id; ?>">
                                                    <div class="option-title">
                                                        <strong><?php echo trans("option") . " " . $count; ?></strong>
                                                    </div>
                                                    <?php $options_answers = $this->field_model->get_field_option_by_common_id($option->common_id);
                                                    if (!empty($options_answers)):
                                                        foreach ($options_answers as $options_answer): ?>
                                                            <p>
                                                                <?php
                                                                $answers = $this->field_model->get_field_option($options_answer->id);
                                                                if (!empty($answers)):
                                                                    $language = get_language($options_answer->lang_id); ?>
                                                                    <input type='text' class="form-control" name="option_lang_<?php echo $options_answer->lang_id; ?>" value='<?php echo html_escape($answers->field_option); ?>' placeholder="Option (<?php echo @$language->name; ?>)" style='width: 100%;padding: 0 5px; bottom: 0 !important;box-shadow: none !important;height: 26px;' required>
                                                                <?php endif; ?>
                                                            </p>
                                                        <?php endforeach;
                                                    endif; ?>
                                                    <div>
                                                        <button type="button" class="btn btn-xs btn-danger pull-right" onclick="delete_custom_field_option('<?php echo trans("confirm_delete"); ?>','<?php echo $option->common_id; ?>');"><?php echo trans("delete"); ?></button>
                                                        <button type="submit" class="btn btn-xs btn-success pull-right m-r-5"><?php echo trans("save_changes"); ?></button>
                                                    </div>
                                                    <?php echo form_close(); ?>
                                                </div>
                                            <?php endif;
                                            $last_common_id = $option->common_id;
                                        endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- form start -->
                    <?php echo form_open_multipart('category_controller/add_custom_field_option_post', ['onkeypress' => 'return event.keyCode != 13;']); ?>
                    <input type="hidden" name="field_id" value="<?php echo $field->id; ?>">
                    <div class="form-group m-b-10">
                        <label><?php echo trans("add_option"); ?></label>
                        <?php foreach ($languages as $language): ?>
                            <input type="text" class="form-control option-input m-b-5" name="option_lang_<?php echo $language->id; ?>" placeholder="Option (<?php echo $language->name; ?>)" required>
                        <?php endforeach; ?>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary pull-right"><?php echo trans('add_option'); ?></button>
                    </div>
                    <?php echo form_close(); ?><!-- form end -->
                </div>
            </div>
            <!-- /.box -->
        </div>
    <?php endif; ?>

    <div class="col-sm-6">
        <div class="box box-primary" style="min-height: 252px;">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans("categories"); ?></h3>
                <small>(<?php echo trans("show_under_these_categories"); ?>)</small>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php echo form_open_multipart('category_controller/add_category_to_custom_field', ['onkeypress' => 'return event.keyCode != 13;']); ?>
            <input type="hidden" name="field_id" value="<?php echo $field->id; ?>">
            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('select_category'); ?></label>
                    <select id="select_field_add_category" class="form-control hidden-row" name="category_id" onchange="this.form.submit()" requiredhidden-row>
                        <option value="0"><?php echo trans('none'); ?></option>
                        <?php foreach ($categories as $category):?>
                            <option value="<?php echo $category->id; ?>"><?php echo html_escape(trim($category->classname, "/")); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div id="mobile_listcategories" class="mobile_selectdiv">
                        <button class="filter-btn text-truncate has-menu d-flex" type="button" data-ajax="0" data-type="mobilecat" data-url="admin_categories" style="height:45px;width:100%;padding: 0 10px 0 10px;text-align: left" >
                            <img src="https://image.flaticon.com/icons/svg/95/95090.svg" class="align-self-center mr-1 ml-1" alt="Menu" style="width: 15px; filter:invert(47%) sepia(1%) saturate(8%) hue-rotate(87deg) brightness(119%) contrast(119%);">
                            <span class="m-0 flex-fill  h-100 text-truncate  text-left special-cagetory" style="padding-left:5px"><?php echo trans('select_category'); ?></span>
                            <i class="fa fa-angle-right pull-right" style="margin-top: 4px;"></i>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-striped" role="grid">
                            <tbody>
                            <?php if (!empty($field_categories)):
                                foreach ($field_categories as $item):
                                    foreach ($categories as $category):
                                        if ($item->category_id == $category->id): ?>
                                            <tr>
                                                <td>
                                                    <?php echo html_escape(trim($category->classname, "/")); ?>
                                                    <button type="button" class="btn btn-xs btn-danger pull-right" onclick="delete_custom_field_category('<?php echo trans("confirm_delete"); ?>',<?php echo $field->id; ?>,<?php echo $category->id; ?>);"><?php echo trans("delete"); ?></button>
                                                </td>
                                            </tr>
                                        <?php break;
                                            endif;
                                    endforeach;
                                endforeach;
                            endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.box-footer -->
                <div class="ajax-filter-menu">
                    <div class="navCatDownMobile nav-mobile" id="filter1" style="margin-left: 105%;">
                        <div class="form-group cat-header">
                            <a href="javascript:void(0)" data-back="normal" class="btn-back-mobile-nav"><i class="fa fa-angle-left"></i> <?= trans('back') ?></a>
                            <a href="javascript:void(0)" class="text-white textcat-header text-center"><?= trans('filter') ?></a>
                        </div>
                        <div class="nav-mobile-inner">
                        </div>
                    </div>
                    <div class="navCatDownMobile nav-mobile" id="SearchWindowFilter"
                        style="margin-left: 105%;top:58px;height: calc(100% - 58px - 60px);">
                        <div class="nav-mobile-inner">
                            <ul class="navbar-nav top-search-bar mobile-search-form">
                            </ul>
                        </div>
                    </div>
            
                </div>
                <?php echo form_close(); ?><!-- form end -->
            </div>
            <!-- /.box -->
        </div>
        <div class="navCatDownMobile nav-mobile" id="MenuMobileModel">
            <div class="form-group cat-header">
                <a href="javascript:void(0)" class="btn-back-mobile-nav"><i class="fa fa-angle-left"></i> <?= trans('back') ?></a>
                <span href="javascript:void(0)" class="text-white textcat-header text-center" style="width: 250px;overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"></span>
            </div>
            <div class="nav-mobile-inner">
                <ul class="navbar-nav top-search-bar mobile-search-form" style="list-style: none; padding-left:20px">
                </ul>
            </div>
        </div>
</div>