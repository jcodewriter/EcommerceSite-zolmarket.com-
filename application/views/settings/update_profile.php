<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="hkm_messages_navCatDownMobile">
    <div class="cat-header">
        <div class="mobile-header-back">
            <a href="<?php echo lang_base_url(); ?>settings" class="btn-back-mobile-nav"> <i class="icon-arrow-left"></i> <?php echo trans("back"); ?> </a>
        </div>
        <div class="mobile-header-title">
            <span class="text-white textcat-header text-center"><?php echo trans("update_profile"); ?></span>
        </div>
        <div class="mobilde-header-cart">
        </div>
    </div>
</div>
<!-- Wrapper -->
<div id="wrapper">
    <div class="container">
        <div class="row hidden-sm-down">
            <div class="col-12">
                <nav class="nav-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo lang_base_url(); ?>"><?php echo trans("home"); ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                    </ol>
                </nav>

                <h1 class="page-title"><?php echo trans("settings"); ?></h1>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-3 hidden-sm-down">
                <div class="row-custom">
                    <!-- load profile nav -->
                    <?php $this->load->view("settings/_setting_tabs", ["user_plan" => $user_plan, "days_left" => $days_left]); ?>
                </div>
            </div>

            <div class="col-sm-12 col-md-9">
                <div class="row-custom">
                    <div class="profile-tab-content">
                        <!-- include message block -->
                        <?php $this->load->view('partials/_messages'); ?>

                        <?php echo form_open_multipart("profile_controller/update_profile_post", ['id' => 'form_validate']); ?>
                        <div class="form-box-body-other">
                            <div class="form-group hidden-md-up" style="text-align: center;">
                                <?php if ($this->general_settings->email_verification == 1) : ?>
                                    <?php if ($user->email_status != 1) : ?>
                                        <button type="submit" name="submit" value="resend_activation_email" class="btn resend-email__btn"><?php echo trans("resend_activation_email"); ?></button>
                                        <!-- <button type="submit" name="submit" value="resend_activation_email" class="btn float-right btn-resend-email"><?php echo trans("resend_activation_email"); ?></button> -->
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="form-group" style="text-align: center;">
                                <label class="control-label"><?php echo trans("upload_your_shop"); ?></label>
                                <div class="upload-image-container">
                                    <div class="<?php echo (!$this->auth_user->is_private || $this->auth_user->role == "admin") ? 'company-image__wrapper' : 'private-image__wrapper'; ?> profile-image__wrapper" style="<?php echo !$this->auth_user->avatar ? 'display: none;' : '' ?>">
                                        <img src="<?php echo get_user_avatar($this->auth_user); ?>" alt="<?php echo $this->auth_user->username; ?>" id="imgadshoww">
                                        <i class="fa fa-times delete-profile-image__btn"></i>
                                    </div>
                                    <span class='btn-file-upload far fa-image <?php echo (!$this->auth_user->is_private || $this->auth_user->role == "admin") ? 'company-upload-image__btn' : 'private-upload-image__btn'; ?> update-profile-image__btn ' style="<?php echo $this->auth_user->avatar ? 'display: none;' : '' ?>background-color: #a9a9a9;">
                                        <input type="file" name="file" id="imgUploader" size="40" accept=".png, .jpg, .jpeg, .gif" onchange="$('#upload-file-info').html($(this).val().replace(/.*[\/\\]/, ''));">
                                    </span>
                                </div>
                            </div>

                            <div class="form-group" style="text-align: left">
                                <div class="email-label__wrapper">
                                    <?php if ($this->general_settings->email_verification == 1) : ?>
                                        <?php if ($user->email_status == 1) : ?>
                                            <div class="label__wrapper">
                                                <label class="control-label"><?php echo trans("email_address"); ?></label>
                                                &nbsp;
                                                <small class="text-success" style="font-size: 12px">(<?php echo trans("confirmed"); ?>)</small>
                                                <img src="<?php echo base_url(); ?>assets/img/confirm.png" style="width:15px; margin: 3px 0 0 0" />
                                            </div>
                                        <?php else : ?>
                                            <div class="label__wrapper">
                                                <label class="control-label"><?php echo trans("email_address"); ?></label>
                                                &nbsp;
                                                <small class="text-danger">(<?php echo trans("unconfirmed"); ?>)</small>
                                            </div>
                                            <button type="submit" name="submit" value="resend_activation_email" class="btn float-right resend-email__btn hidden-sm-down"><?php echo trans("resend_activation_email"); ?></button>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <label class="control-label"><?php echo trans("email_address"); ?></label>
                                    <?php endif; ?>
                                </div>
                                <input type="email" name="email" class="form-control form-input" value="<?php echo html_escape($user->email); ?>" placeholder="<?php echo trans("email_address"); ?>" required>
                            </div>
                            <div class="form-group" style="text-align: left">
                                <div class="d-flex justify-content-between">
                                    <div class="pr-1" style="width: 100%;">
                                        <label class="control-label"><?php echo trans("first_name"); ?></label>
                                        <input type="text" name="firstname" class="form-control form-input" value="<?php echo html_escape($user->firstname); ?>" placeholder="<?php echo trans("first_name"); ?>" maxlength="<?php echo $this->username_maxlength; ?>" required>
                                    </div>
                                    <div class="pl-1" style="width: 100%;">
                                        <label class="control-label"><?php echo trans("last_name"); ?></label>
                                        <input type="text" name="lastname" class="form-control form-input" value="<?php echo html_escape($user->lastname); ?>" placeholder="<?php echo trans("last_name"); ?>" maxlength="<?php echo $this->username_maxlength; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <?php if (!$user->is_private || $user->role == "admin") : ?>
                                <div class="form-group">
                                    <label class="control-label"><?php echo trans("company_name"); ?></label>
                                    <input type="text" name="shop_name" class="form-control form-input" value="<?php echo $user->shop_name; ?>" placeholder="<?php echo trans("company_name"); ?>" maxlength="<?php echo $this->username_maxlength; ?>">
                                </div>
                            <?php endif; ?>
                            <div class="form-group" style="display: none">
                                <label class="control-label"><?php echo trans("slug"); ?></label>
                                <input type="text" name="slug" class="form-control form-input" value="<?php echo html_escape($user->slug); ?>" placeholder="<?php echo trans("slug"); ?>" required>
                            </div>
                            <?php if ($this->auth_user->role == 'vendor' || $this->auth_user->role == 'admin') : ?>
                                <div class="form-group" style="text-align: left">
                                    <label class="control-label"><?php echo trans("shop_description"); ?></label>
                                    <textarea name="about_me" class="form-control form-textarea" placeholder="<?php echo trans("shop_description"); ?>"><?php echo html_escape($user->about_me); ?></textarea>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label class="control-label"><?php echo trans('location'); ?></label>
                                <div class="row hidden-row">
                                    <div class="col-12 col-sm-4 m-b-15">
                                        <div class="selectdiv">
                                            <select id="countries" name="country_id" class="form-control" onchange="get_states(this.value);">
                                                <option value=""><?php echo trans('country'); ?></option>
                                                <?php foreach ($countries as $item) : ?>
                                                    <option value="<?php echo $item->id; ?>" <?php echo ($item->id == $general_settings->default_product_location) ? 'selected' : ''; ?>><?php echo html_escape($item->name); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4 m-b-15">
                                        <div class="selectdiv">
                                            <select id="states" name="state_id" class="form-control" onchange="get_cities(this.value);">
                                                <option value=""><?php echo trans('state'); ?></option>
                                                <?php
                                                if (!empty($states)) :
                                                    foreach ($states as $item) : ?>
                                                        <option value="<?php echo $item->id; ?>" <?php echo ($item->id == $user->state_id) ? 'selected' : ''; ?>><?php echo html_escape($item->name); ?></option>
                                                <?php endforeach;
                                                endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4 m-b-15">
                                        <div class="selectdiv">
                                            <select id="cities" name="city_id" class="form-control">
                                                <option value=""><?php echo trans('city'); ?></option>
                                                <?php
                                                if (!empty($cities)) :
                                                    foreach ($cities as $item) : ?>
                                                        <option value="<?php echo $item->id; ?>" <?php echo ($item->id == $user->city_id) ? 'selected' : ''; ?>><?php echo html_escape($item->name); ?></option>
                                                <?php endforeach;
                                                endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="mobile_listcategories" class="mobile_selectdiv m-b-15">
                                    <?php if ($general_settings->default_product_location == 0) : ?>
                                        <button class="filter-btn text-truncate has-menu d-flex mobile-popup__button" type="button" name="country" data-ajax="0" data-type="country_id" data-url="country_location">
                                        <?php endif; ?>
                                        <?php if ($general_settings->default_product_location == 0) : ?>
                                            <i class="fa fa-map-marker  fa-lg align-self-center mr-1 ml-1" aria-hidden="true"></i>
                                            <?php if ($btn_string) : ?>
                                                <span class="flex-fill text-truncate  text-left special-cagetory" id="country_button"><?php echo html_escape($btn_string); ?></span>
                                            <?php else : ?>
                                                <span class="flex-fill text-truncate  text-left special-cagetory" id="country_button"><?php echo trans('country'); ?></span>
                                            <?php endif; ?>

                                        <?php endif; ?>
                                        <?php if ($general_settings->default_product_location == 0) : ?>
                                            <i class="icon-arrow-right"></i>
                                        <?php endif; ?>
                                        </button>

                                        <?php if ($general_settings->default_product_location == 0) : ?>
                                            <button class="filter-btn text-truncate has-menu d-flex mobile-popup__button" type="button" name="state" data-ajax="0" data-type="state_id" data-url="custom_location">
                                            <?php else : ?>
                                                <button class="filter-btn text-truncate has-menu d-flex mobile-popup__button" type="button" name="state" data-ajax="<?php echo $general_settings->default_product_location; ?>" data-type="state_id" data-url="custom_location">
                                                <?php endif; ?>
                                                <i class="fa fa-map-marker  fa-lg align-self-center mr-1 ml-1" aria-hidden="true"></i>
                                                <?php if (@$state_button) : ?>
                                                    <span class="flex-fill text-truncate text-left special-cagetory" id="city_button"><?php echo html_escape($state_button); ?></span>
                                                <?php else : ?>
                                                    <span class="flex-fill text-truncate text-left special-cagetory" id="city_button"><?php echo trans('state') . ' / ' . trans('city'); ?></span>
                                                <?php endif; ?>
                                                <i class="icon-arrow-right"></i>
                                                </button>
                                </div>
                                <!-- HIHIHIHI -->

                                <div class="row">
                                    <div class="col-12 col-sm-6 m-b-15">
                                        <label class="control-label"><?php echo trans("address"); ?></label>
                                        <input type="text" name="address" class="form-control form-input" value="<?php echo html_escape($user->address); ?>" placeholder="<?php echo trans("address") ?>">
                                    </div>

                                    <div class="col-12 col-sm-3">
                                        <label class="control-label"><?php echo trans("zip_code"); ?></label>
                                        <input type="text" name="zip_code" class="form-control form-input" value="<?php echo html_escape($user->zip_code); ?>" placeholder="<?php echo trans("zip_code") ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?php echo trans("phone_number"); ?></label>
                                <input type="text" id="intl_phone_number" name="phone_number" class="form-control form-input" value="<?php echo $user->phone_number ? html_escape($user->phone_number) : "+249"; ?>" placeholder="<?php echo trans("phone_number"); ?>">
                            </div>
                            <div class="form-group m-t-15 d-none">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="show_email" value="1" id="checkbox_show_email" class="custom-control-input" <?php echo ($user->show_email == 1) ? 'checked' : ''; ?>>
                                    <label for="checkbox_show_email" class="custom-control-label"><?php echo trans("show_my_email"); ?></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="show_phone" value="1" id="checkbox_show_phone" class="custom-control-input" <?php echo ($user->show_phone == 1) ? 'checked' : ''; ?>>
                                    <label for="checkbox_show_phone" class="custom-control-label"><?php echo trans("show_my_phone"); ?></label>
                                </div>
                            </div>
                            <div class="form-group m-b-30">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="show_location" value="1" id="checkbox_show_location" class="custom-control-input" <?php echo ($user->show_location == 1) ? 'checked' : ''; ?>>
                                    <label for="checkbox_show_location" class="custom-control-label"><?php echo trans("show_my_location"); ?></label>
                                </div>
                            </div>
                            <div class="form-group m-t-10" style="text-align: center">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="control-label"><?php echo trans('email_option_send_email_new_message'); ?></label>
                                    </div>
                                    <div class="col-12 col-option" style="display: flex; justify-content: center">
                                        <div class="custom-control custom-radio" style="margin-right: 140px;">
                                            <input type="radio" name="send_email_new_message" value="1" id="send_email_new_message_1" class="custom-control-input" <?php echo ($user->send_email_new_message == 1) ? 'checked' : ''; ?>>
                                            <label for="send_email_new_message_1" class="custom-control-label"><?php echo trans("yes"); ?></label>
                                        </div>
                                        <div class="custom-control custom-radio" style="position: absolute; margin-left: 45px">
                                            <input type="radio" name="send_email_new_message" value="0" id="send_email_new_message_2" class="custom-control-input" <?php echo ($user->send_email_new_message != 1) ? 'checked' : ''; ?>>
                                            <label for="send_email_new_message_2" class="custom-control-label"><?php echo trans("no"); ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if ($this->auth_user->role == 'vendor' || $this->auth_user->role == 'admin') : ?>
                                <?php if ($this->general_settings->rss_system == 1) : ?>
                                    <div class="form-group m-t-10" style="text-align: center">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="control-label"><?php echo trans('rss_feeds'); ?></label>
                                            </div>
                                            <div class="col-12 col-option" style="display: flex; justify-content: center">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" name="show_rss_feeds" value="1" id="rss_system_1" class="custom-control-input" <?php echo ($user->show_rss_feeds == 1) ? 'checked' : ''; ?>>
                                                    <label for="rss_system_1" class="custom-control-label"><?php echo trans("enable"); ?></label>
                                                </div>
                                                <div class="custom-control custom-radio" style="margin-left: 50px;">
                                                    <input type="radio" name="show_rss_feeds" value="0" id="rss_system_2" class="custom-control-input" <?php echo ($user->show_rss_feeds != 1) ? 'checked' : ''; ?>>
                                                    <label for="rss_system_2" class="custom-control-label"><?php echo trans("disable"); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <input type="hidden" name="show_rss_feeds" value="<?php echo $user->show_rss_feeds; ?>">
                                <?php endif; ?>
                                <div class="form-group m-t-10" style="text-align: center">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="control-label"><?php echo trans('send_email_item_sold'); ?></label>
                                        </div>
                                        <div class="col-12 col-option" style="display: flex; justify-content: center;">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" name="send_email_when_item_sold" value="1" id="send_email_when_item_sold_1" class="custom-control-input" <?php echo ($user->send_email_when_item_sold == 1) ? 'checked' : ''; ?>>
                                                <label for="send_email_when_item_sold_1" class="custom-control-label"><?php echo trans("enable"); ?></label>
                                            </div>
                                            <div class="custom-control custom-radio" style="margin-left: 50px;">
                                                <input type="radio" name="send_email_when_item_sold" value="0" id="send_email_when_item_sold_2" class="custom-control-input" <?php echo ($user->send_email_when_item_sold != 1) ? 'checked' : ''; ?>>
                                                <label for="send_email_when_item_sold_2" class="custom-control-label"><?php echo trans("disable"); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="form-group" style="text-align: center">
                                <button type="submit" name="submit" value="update" class="btn btn-md btn-custom"><?php echo trans("save_changes") ?></button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ajax-filter-menu">
        <div class="navCatDownMobile nav-mobile" id="filter1" style="margin-left: 105%;">
            <div class="form-group cat-header">
                <a href="javascript:void(0)" data-back="normal" class="btn-back-mobile-nav"><i class="icon-arrow-left"></i> <?= trans('back') ?></a>
                <span href="javascript:void(0)" class="text-white textcat-header text-center"><?= trans('filter') ?></span>
            </div>
            <div class="nav-mobile-inner">
            </div>
        </div>
        <div class="navCatDownMobile nav-mobile" id="SearchWindowFilter" style="margin-left: 105%;top:58px;height: calc(100% - 58px - 60px);">
            <div class="nav-mobile-inner">
                <ul class="navbar-nav top-search-bar mobile-search-form">

                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Wrapper End-->


<script>
    $(document).ready(function() {
        let email_status = `<?= user()->email_status; ?>`;
        if (email_status === '0') {
            $(".hkmprofileupdate").css({
                'margin-left': '0%',
                'z-index': '2'
            });
        }
    })
</script>