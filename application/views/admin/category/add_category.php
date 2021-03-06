<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-7 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?php echo trans('add_category'); ?></h3>
                </div>
                <div class="right">
                    <a href="<?php echo admin_url(); ?>categories" class="btn btn-success btn-add-new">
                        <i class="fa fa-list-ul"></i>&nbsp;&nbsp;<?php echo trans('categories'); ?>
                    </a>
                </div>
            </div><!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open_multipart('category_controller/add_category_post'); ?>

            <input type="hidden" name="parent_id" value="0">

            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages_form'); ?>

                <?php foreach ($languages as $language): ?>
                    <div class="form-group">
                        <label><?php echo trans("category_name"); ?> (<?php echo $language->name; ?>)</label>
                        <input type="text" class="form-control" name="name_lang_<?php echo $language->id; ?>" placeholder="<?php echo trans("category_name"); ?>" maxlength="255" required>
                    </div>
                <?php endforeach; ?>
                <?php foreach ($languages as $language): ?>
                    <div class="form-group" style="margin-bottom: 10px;">
                        <label class="control-label"><?php echo trans("slug"); ?>(<?php echo $language->name; ?>)
                            <small>(<?php echo trans("slug_exp"); ?>)</small>
                        </label>
                        <input type="text" class="form-control" name="slug_lang_<?php echo $language->id; ?>" placeholder="<?php echo trans("slug"); ?>">
                    </div>
                    <div class="form-group">
                        <label for="main_slug_<?php echo $language->id;?>" class="control-label cursor-pointer" style="margin-right: 10px;"><?php echo trans("choose_slug"); ?></label>
                        <input type="radio" name="main_slug" id="main_slug_<?php echo $language->id;?>" value="main_slug_<?php echo $language->id;?>" class="square-purple">
                    </div>
                <?php endforeach; ?>
                
                <?php /*
                <div class="form-group d-none">
                    <label class="control-label"><?php echo trans("slug"); ?> AR
                        <small>(<?php echo trans("slug_exp"); ?>)</small>
                    </label>
                    <input type="text" class="form-control" name="slug_ar" placeholder="<?php echo trans("slug"); ?>">
                </div>
 */ ?>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('title'); ?> (<?php echo trans('meta_tag'); ?>)</label>
                    <input type="text" class="form-control" name="title_meta_tag"
                           placeholder="<?php echo trans('title'); ?> (<?php echo trans('meta_tag'); ?>)" value="<?php echo old('title_meta_tag'); ?>">
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('description'); ?> (<?php echo trans('meta_tag'); ?>)</label>
                    <input type="text" class="form-control" name="description"
                           placeholder="<?php echo trans('description'); ?> (<?php echo trans('meta_tag'); ?>)" value="<?php echo old('description'); ?>">
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('keywords'); ?> (<?php echo trans('meta_tag'); ?>)</label>
                    <input type="text" class="form-control" name="keywords"
                           placeholder="<?php echo trans('keywords'); ?> (<?php echo trans('meta_tag'); ?>)" value="<?php echo old('keywords'); ?>">
                </div>

                <div class="form-group">
                    <label><?php echo trans('order'); ?></label>
                    <input type="number" class="form-control" name="category_order" placeholder="<?php echo trans('order'); ?>"
                           value="<?php echo old('category_order'); ?>" min="1" max="99999" required>
                </div>

                <div class="form-group">
                    <label><?php echo trans('homepage_order'); ?></label>
                    <input type="number" class="form-control" name="homepage_order" placeholder="<?php echo trans('homepage_order'); ?>"
                           value="<?php echo old('homepage_order'); ?>" min="1" max="99999" required>
                </div>

              
                <div class="form-group">
                    <label class="control-label"><?php echo trans("category"); ?></label>
                    <div id="listcategories" class="selectdiv">
    
                        <select id="cat_0" name="second_parent_id[0]" class="form-control" onchange="get_subcategories(this,0);" >
                            <option value=""><?php echo trans('select_category'); ?></option>
                            <?php foreach ($categories as $item): ?>
                                <option value="<?php echo html_escape($item->id); ?>"><?php echo html_escape($item->name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <label><?php echo trans('visibility'); ?></label>
                        </div>
                        <div class="col-sm-4 col-xs-12 col-option">
                            <input type="radio" name="visibility" value="1" id="visibility_1" class="square-purple" checked>
                            <label for="visibility_1" class="option-label"><?php echo trans('show'); ?></label>
                        </div>
                        <div class="col-sm-4 col-xs-12 col-option">
                            <input type="radio" name="visibility" value="0" id="visibility_2" class="square-purple">
                            <label for="visibility_2" class="option-label"><?php echo trans('hide'); ?></label>
                        </div>
                    </div>
                </div>
                
                
                
                

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <label><?php echo trans('show_on_homepage'); ?></label>
                        </div>
                        <div class="col-sm-4 col-xs-12 col-option">
                            <input type="radio" name="show_on_homepage" value="1" id="show_on_homepage_1" class="square-purple">
                            <label for="show_on_homepage_1" class="option-label"><?php echo trans('yes'); ?></label>
                        </div>
                        <div class="col-sm-4 col-xs-12 col-option">
                            <input type="radio" name="show_on_homepage" value="0" id="show_on_homepage_2" class="square-purple" checked>
                            <label for="show_on_homepage_2" class="option-label"><?php echo trans('no'); ?></label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <label><?php echo trans('show_image_on_navigation'); ?></label>
                        </div>
                        <div class="col-sm-4 col-xs-12 col-option">
                            <input type="radio" name="show_image_on_navigation" value="1" id="show_image_on_navigation_1" class="square-purple" checked>
                            <label for="show_image_on_navigation_1" class="option-label"><?php echo trans('yes'); ?></label>
                        </div>
                        <div class="col-sm-4 col-xs-12 col-option">
                            <input type="radio" name="show_image_on_navigation" value="0" id="show_image_on_navigation_2" class="square-purple">
                            <label for="show_image_on_navigation_2" class="option-label"><?php echo trans('no'); ?></label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('image'); ?></label>
                    <div class="display-block">
                        <a class='btn btn-success btn-sm btn-file-upload'>
                            <?php echo trans('select_image'); ?>
                            <input type="file" id="Multifileupload" name="file" size="40" accept=".png, .jpg, .jpeg, .gif">
                        </a>
                    </div>

                    <div id="MultidvPreview" class="image-preview"></div>
                </div>


                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <label><?php echo trans('visibility') . ' '. trans('icon'); ?></label>
                        </div>
                        <div class="col-sm-4 col-xs-12 col-option">
                            <input type="radio" name="visibility_icon" value="1" id="visibility_icon_1" class="square-purple" checked>
                            <label for="visibility_icon_1" class="option-label"><?php echo trans('show'); ?> On Desktop</label>
                        </div>
                        <div class="col-sm-4 col-xs-12 col-option">
                            <input type="radio" name="visibility_icon" value="0" id="visibility_icon_2" class="square-purple">
                            <label for="visibility_icon_2" class="option-label"><?php echo trans('hide'); ?> On Desktop</label>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label"><?php echo trans('icon'); ?></label>
                    <div class="display-block">
                        <a class='btn btn-success btn-sm btn-file-upload'>
                            <?php echo trans('select_icon'); ?>
                            <input type="file" id="FileIconUpload" data-show="IconPreview" data-id="IconSmallPreview" name="icon" size="40" accept=".png, .jpg, .jpeg, .gif">
                        </a>
                    </div>

                    <div id="IconPreview" class="icon-preview"></div>
                </div>

            </div>

            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><?php echo trans('add_category'); ?></button>
            </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
        <!-- /.box -->
    </div>
</div>
