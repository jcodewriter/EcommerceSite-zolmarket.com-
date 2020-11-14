<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-9 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans("update_category"); ?></h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open_multipart('category_controller/update_category_post'); ?>

            <input type="hidden" name="id" value="<?php echo html_escape($category->id); ?>">
            <input type="hidden" name="parent_id" value="0">

            <div class="box-body">

                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>
                <?php foreach ($languages as $language) : ?>
                    <div class="form-group">
                        <label><?php echo trans("category_name"); ?> (<?php echo $language->name; ?>)</label>
                        <input type="text" class="form-control" name="name_lang_<?php echo $language->id; ?>" placeholder="<?php echo trans("category_name"); ?>" value="<?php echo get_category_name_by_lang($category->id, $language->id); ?>" maxlength="255" required>
                    </div>
                <?php endforeach; ?>

                <?php foreach ($languages as $language) : ?>
                    <div class="form-group" style="margin-bottom: 10px;">
                        <label class="control-label"><?php echo trans("slug"); ?>(<?php echo $language->name; ?>)
                            <small>(<?php echo trans("slug_exp"); ?>)</small>
                        </label>
                        <input type="text" class="form-control" name="slug_lang_<?php echo $language->id; ?>" value="<?php echo get_category_slug_by_lang($category->id, $language->id); ?>" placeholder="<?php echo trans("slug"); ?>">
                    </div>
                    <div class="form-group">
                        <label for="main_slug_<?php echo $language->id; ?>" class="control-label cursor-pointer" style="margin-right: 10px;"><?php echo trans("choose_slug"); ?></label>
                        <input type="radio" name="main_slug" id="main_slug_<?php echo $language->id; ?>" value="main_slug_<?php echo $language->id; ?>" class="square-purple" <?php $main_slug = get_category_main_slug_by_lang($category->id, $language->id);
                                                                                                                                                                                echo $main_slug == 1 ? 'checked' : ''; ?>>
                    </div>
                <?php endforeach; ?>

                <!-- <div class="form-group">
                    <label class="control-label"><?php echo trans("slug"); ?>
                        <small>(<?php echo trans("slug_exp"); ?>)</small>
                    </label>
                    <input type="text" class="form-control" name="slug" value="<?php echo html_escape($category->slug); ?>" placeholder="<?php echo trans("slug"); ?>">
                </div> -->

                <?php /*
                <div class="form-group d-none">
                    <label class="control-label"><?php echo trans("slug"); ?>
                        <small>(<?php echo trans("slug_exp"); ?>)</small>
                    </label>
                    <input type="text" class="form-control" name="slug_ar" value="<?php echo html_escape($category->slug_ar); ?>" placeholder="<?php echo trans("slug"); ?>">
                </div> */ ?>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('title'); ?> (<?php echo trans('meta_tag'); ?>)</label>
                    <input type="text" class="form-control" name="title_meta_tag" placeholder="<?php echo trans('title'); ?> (<?php echo trans('meta_tag'); ?>)" value="<?php echo html_escape($category->title_meta_tag); ?>">
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('description'); ?> (<?php echo trans('meta_tag'); ?>)</label>
                    <input type="text" class="form-control" name="description" placeholder="<?php echo trans('description'); ?> (<?php echo trans('meta_tag'); ?>)" value="<?php echo html_escape($category->description); ?>">
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('keywords'); ?> (<?php echo trans('meta_tag'); ?>)</label>
                    <input type="text" class="form-control" name="keywords" placeholder="<?php echo trans('keywords'); ?> (<?php echo trans('meta_tag'); ?>)" value="<?php echo html_escape($category->keywords); ?>">
                </div>


                <div class="form-group">
                    <label><?php echo trans('order'); ?></label>
                    <input type="number" class="form-control" name="category_order" placeholder="<?php echo trans('order'); ?>" value="<?php echo html_escape($category->category_order); ?>" min="1" max="99999" required>
                </div>

                <div class="form-group">
                    <label><?php echo trans('homepage_order'); ?></label>
                    <input type="number" class="form-control" name="homepage_order" placeholder="<?php echo trans('homepage_order'); ?>" value="<?php echo html_escape($category->homepage_order); ?>" min="1" max="99999" required>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('category'); ?></label>

                    <div id="listcategories" class="selectdiv">
                        <select id="cat_0" name="second_parent_id[0]" class="form-control" onchange="get_subcategories(this,0);">
                            <option value=""><?php echo trans('select_category'); ?></option>
                            <?php if (!empty($parent_categories)) :
                                foreach ($parent_categories as $item) : ?>
                                    <option value="<?php echo html_escape($item->id); ?>" <?php echo (!empty($product_categories) && $item->id != $category->id  && $item->id == $product_categories[0]->id) ? 'selected' : ''; ?>><?php echo html_escape($item->name); ?></option>
                            <?php endforeach;
                            endif; ?>
                        </select>
                        <?php
                        for ($key = 0; $key < count($product_categories) - 1; $key++) :
                            $product_category = $product_categories[$key];
                            $has_subcat = has_subcategories_by_parent_id($product_category->id);
                            if ($has_subcat) {
                                $subcats = get_subcategories_by_parent_id($product_category->id);
                        ?>
                                <select class="form-control" style="margin-top: 15px;" onchange="get_subcategories(this,<?= $key + 1 ?>)" name="second_parent_id[<?= $key + 1 ?>]" id="cat_<?= $product_category->id ?>">
                                    <option value=""><?php echo trans('select_category'); ?></option>
                                    <?php
                                    foreach ($subcats as $item) : ?>
                                        <option value="<?php echo html_escape($item->id); ?>" <?php echo (isset($product_categories[$key + 1]) && $item->id != $category->id  && $item->id == $product_categories[$key + 1]->id) ? 'selected' : ''; ?>>
                                            <?php echo html_escape($item->name); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                        <?php  }
                        endfor; ?>
                    </div>
                </div>



                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <label><?php echo trans('visibility'); ?></label>
                        </div>
                        <div class="col-sm-4 col-xs-12 col-option">
                            <input type="radio" name="visibility" value="1" id="visibility_1" class="square-purple" <?php echo ($category->visibility == '1') ? 'checked' : ''; ?>>
                            <label for="visibility_1" class="option-label cursor-pointer"><?php echo trans('show'); ?></label>
                        </div>
                        <div class="col-sm-4 col-xs-12 col-option">
                            <input type="radio" name="visibility" value="0" id="visibility_2" class="square-purple" <?php echo ($category->visibility == '0') ? 'checked' : ''; ?>>
                            <label for="visibility_2" class="option-label cursor-pointer"><?php echo trans('hide'); ?></label>
                        </div>
                    </div>
                </div>




                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <label><?php echo trans('show_on_homepage'); ?></label>
                        </div>
                        <div class="col-sm-4 col-xs-12 col-option">
                            <input type="radio" name="show_on_homepage" value="1" id="show_on_homepage_1" class="square-purple" <?php echo ($category->show_on_homepage == '1') ? 'checked' : ''; ?>>
                            <label for="show_on_homepage_1" class="option-label"><?php echo trans('yes'); ?></label>
                        </div>
                        <div class="col-sm-4 col-xs-12 col-option">
                            <input type="radio" name="show_on_homepage" value="0" id="show_on_homepage_2" class="square-purple" <?php echo ($category->show_on_homepage == '0') ? 'checked' : ''; ?>>
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
                            <input type="radio" name="show_image_on_navigation" value="1" id="show_image_on_navigation_1" class="square-purple" <?php echo ($category->show_image_on_navigation == '1') ? 'checked' : ''; ?>>
                            <label for="show_image_on_navigation_1" class="option-label"><?php echo trans('yes'); ?></label>
                        </div>
                        <div class="col-sm-4 col-xs-12 col-option">
                            <input type="radio" name="show_image_on_navigation" value="0" id="show_image_on_navigation_2" class="square-purple" <?php echo ($category->show_image_on_navigation == '0') ? 'checked' : ''; ?>>
                            <label for="show_image_on_navigation_2" class="option-label"><?php echo trans('no'); ?></label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('image'); ?></label>
                    <?php if (!empty($category->image_1)) : ?>
                        <div class="display-block m-b-15">
                            <img src="<?php echo get_category_image_url($category, 'image_1'); ?>" alt="" style="height: 200px;">
                        </div>
                    <?php endif; ?>
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
                            <label><?php echo trans('visibility') . ' ' . trans('icon'); ?></label>
                        </div>
                        <div class="col-sm-4 col-xs-12 col-option">
                            <input type="radio" name="visibility_icon" value="1" id="visibility_icon_1" class="square-purple" <?php echo ($category->visibility_icon == '1') ? 'checked' : ''; ?>>
                            <label for="visibility_icon_1" class="option-label cursor-pointer"><?php echo trans('show'); ?> On Desktop</label>
                        </div>
                        <div class="col-sm-4 col-xs-12 col-option">
                            <input type="radio" name="visibility_icon" value="0" id="visibility_icon_2" class="square-purple" <?php echo ($category->visibility_icon == '0') ? 'checked' : ''; ?>>
                            <label for="visibility_icon_2" class="option-label cursor-pointer"><?php echo trans('hide'); ?> On Desktop</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label mr-5" style="margin-right:5px;"><?php echo trans('icon'); ?>: </label>
                    <?php if (!empty($category->icon)) : ?>
                        <img src="<?php echo get_category_image_url($category, 'icon'); ?>" alt="" style="height: 20px;">

                    <?php endif; ?>
                    <div class="display-block">
                        <a class='btn btn-success btn-sm btn-file-upload'>
                            <?php echo trans('select_icon'); ?>
                            <input type="file" id="FileIconUpload" data-id="IconSmallPreview" data-show="IconPreview" name="icon" size="40" accept=".png, .jpg, .jpeg, .gif">
                        </a>
                    </div>

                    <div id="IconPreview" class="icon-preview"></div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label mr-5" style="margin-right:5px;"><?php echo trans('category_ads_view'); ?>: </label>
                            <div class="ads-view__wrapper">
                                <label for="category_ads_view_1" class="cursor-pointer ads-view__item">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="th-list" class="svg-inline--fa fa-th-list fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor" d="M149.333 216v80c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24v-80c0-13.255 10.745-24 24-24h101.333c13.255 0 24 10.745 24 24zM0 376v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zM125.333 32H24C10.745 32 0 42.745 0 56v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zm80 448H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24zm-24-424v80c0 13.255 10.745 24 24 24H488c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24zm24 264H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24z"></path>
                                    </svg>
                                </label>
                                <input type="radio" name="category_ads_view" value="0" id="category_ads_view_1" class="square-purple" <?php echo ($category->category_ads_view == '0') ? 'checked' : ''; ?>>
                            </div>
                            <div class="ads-view__wrapper">
                                <label for="category_ads_view_2" class="cursor-pointer ads-view__item">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="th-large" class="svg-inline--fa fa-th-large fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor" d="M296 32h192c13.255 0 24 10.745 24 24v160c0 13.255-10.745 24-24 24H296c-13.255 0-24-10.745-24-24V56c0-13.255 10.745-24 24-24zm-80 0H24C10.745 32 0 42.745 0 56v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zM0 296v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zm296 184h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H296c-13.255 0-24 10.745-24 24v160c0 13.255 10.745 24 24 24z"></path>
                                    </svg>
                                </label>
                                <input type="radio" name="category_ads_view" value="1" id="category_ads_view_2" class="square-purple" <?php echo ($category->category_ads_view == '1') ? 'checked' : ''; ?>>
                            </div>
                            <div class="ads-view__wrapper">
                                <label for="category_ads_view_3" class="cursor-pointer ads-view__item">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="th" class="svg-inline--fa fa-th fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor" d="M149.333 56v80c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24V56c0-13.255 10.745-24 24-24h101.333c13.255 0 24 10.745 24 24zm181.334 240v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24h101.333c13.256 0 24.001-10.745 24.001-24zm32-240v80c0 13.255 10.745 24 24 24H488c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24H386.667c-13.255 0-24 10.745-24 24zm-32 80V56c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24h101.333c13.256 0 24.001-10.745 24.001-24zm-205.334 56H24c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24zM0 376v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zm386.667-56H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H386.667c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24zm0 160H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H386.667c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24zM181.333 376v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24z"></path>
                                    </svg>
                                </label>
                                <input type="radio" name="category_ads_view" value="2" id="category_ads_view_3" class="square-purple" <?php echo ($category->category_ads_view == '2') ? 'checked' : ''; ?>>
                            </div>
                        </div>
                        <div class="col-md-6 ads-mobile__style">
                            <label class="control-label mr-5" style="margin-right:5px;"><?php echo trans('ads_category_view'); ?>: </label>
                            <div class="ads-view__wrapper">
                                <label for="ads_category_view_1" class="cursor-pointer ads-view__item">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="th-list" class="svg-inline--fa fa-th-list fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor" d="M149.333 216v80c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24v-80c0-13.255 10.745-24 24-24h101.333c13.255 0 24 10.745 24 24zM0 376v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zM125.333 32H24C10.745 32 0 42.745 0 56v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zm80 448H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24zm-24-424v80c0 13.255 10.745 24 24 24H488c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24zm24 264H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24z"></path>
                                    </svg>
                                </label>
                                <input type="radio" name="ads_category_view" value="0" id="ads_category_view_1" class="square-purple" <?php echo ($category->ads_category_view == '0') ? 'checked' : ''; ?>>
                            </div>
                            <div class="ads-view__wrapper">
                                <label for="ads_category_view_2" class="cursor-pointer ads-view__item">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="th-large" class="svg-inline--fa fa-th-large fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor" d="M296 32h192c13.255 0 24 10.745 24 24v160c0 13.255-10.745 24-24 24H296c-13.255 0-24-10.745-24-24V56c0-13.255 10.745-24 24-24zm-80 0H24C10.745 32 0 42.745 0 56v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zM0 296v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zm296 184h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H296c-13.255 0-24 10.745-24 24v160c0 13.255 10.745 24 24 24z"></path>
                                    </svg>
                                </label>
                                <input type="radio" name="ads_category_view" value="1" id="ads_category_view_2" class="square-purple" <?php echo ($category->ads_category_view == '1') ? 'checked' : ''; ?>>
                            </div>
                            <div class="ads-view__wrapper">
                                <label for="ads_category_view_3" class="cursor-pointer ads-view__item">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="th" class="svg-inline--fa fa-th fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor" d="M149.333 56v80c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24V56c0-13.255 10.745-24 24-24h101.333c13.255 0 24 10.745 24 24zm181.334 240v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24h101.333c13.256 0 24.001-10.745 24.001-24zm32-240v80c0 13.255 10.745 24 24 24H488c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24H386.667c-13.255 0-24 10.745-24 24zm-32 80V56c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24h101.333c13.256 0 24.001-10.745 24.001-24zm-205.334 56H24c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24zM0 376v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zm386.667-56H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H386.667c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24zm0 160H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H386.667c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24zM181.333 376v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24z"></path>
                                    </svg>
                                </label>
                                <input type="radio" name="ads_category_view" value="2" id="ads_category_view_3" class="square-purple" <?php echo ($category->ads_category_view == '2') ? 'checked' : ''; ?>>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><?php echo trans('save_changes'); ?> </button>
            </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?>
            <!-- form end -->
        </div>
        <!-- /.box -->
    </div>
</div>