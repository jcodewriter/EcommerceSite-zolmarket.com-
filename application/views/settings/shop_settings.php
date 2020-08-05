<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
if (auth_check()){
    $profile = $this->auth_user;
}
?>


<style>
    .btn-shadow {
        box-shadow: 0px 0px 0.2px 0.3px #00000040 !important;
    }

    .hkm_messages_navCatDownMobile  .cat-header a.text-white.textcat-header.text-center {
        color: white;
        line-height: 3.3;
        font-size: 15px;
        display: inline-block;
        display: table-cell;
        width: 100%;
        text-indent: 15px;
    }

    .hkm_messages_navCatDownMobile  .cat-header {
        height: 58px;
        color: white !important;
        background: #f5f5f5;
        /* margin-bottom: 86px; */
        float: none;
        display: table;
    }


    .hkm_messages_navCatDownMobile .btn-back-mobile-nav {
        font-size: 18px;
        color: #222 !important;
        display: table-cell;
        width: 25%;
    }

    .top-search-bar .left {
        vertical-align: middle;
    }

    @media (max-width: 992px) {
        #wrapper {
            padding-top: 0;
        }
    }
</style>

<div class="hkm_messages_navCatDownMobile">
    <div class="form-group cat-header">
        <a href="<?= $_SERVER['HTTP_REFERER'] ?>" class="btn-back-mobile-nav"><i class="icon-arrow-left"></i> <?php echo trans("back"); ?></a>
        <a href="javascript:void(0)" class="text-white textcat-header text-center">
            <?php if(auth_check() && $profile->id == $user->id): ?>
                <?= trans("my_account") ?>
            <?php else: ?>
                <?= substr(ucfirst(get_shop_name($user)),0,10) . ' ' . trans("account") ?>
            <?php endif; ?>
        </a>
    </div>
</div>

<!-- Wrapper -->
<div id="wrapper">
    <div class="container">
        <div class="row">
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
                    <?php $this->load->view("settings/_setting_tabs"); ?>
                </div>
            </div>

            <div class="col-sm-12 col-md-9">
                <div class="row-custom">
                    <div class="profile-tab-content">
                        <!-- include message block -->
                        <?php $this->load->view('partials/_messages'); ?>

                        <?php echo form_open_multipart("profile_controller/shop_settings_post"); ?>
                        <div class="form-group">
                            <label class="control-label"><?php echo trans("shop_name"); ?></label>
                            <input type="text" name="shop_name" class="form-control form-input" value="<?php echo html_escape($user->shop_name); ?>" placeholder="<?php echo trans("shop_name"); ?>" maxlength="<?php echo $this->username_maxlength; ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label"><?php echo trans("shop_description"); ?></label>
                            <textarea name="about_me" class="form-control form-textarea" placeholder="<?php echo trans("shop_description"); ?>"><?php echo html_escape($user->about_me); ?></textarea>
                        </div>
                        <?php if ($this->general_settings->rss_system == 1): ?>
                            <div class="form-group m-t-10">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="control-label"><?php echo trans('rss_feeds'); ?></label>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-12 col-option">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="show_rss_feeds" value="1" id="rss_system_1" class="custom-control-input" <?php echo ($user->show_rss_feeds == 1) ? 'checked' : ''; ?>>
                                            <label for="rss_system_1" class="custom-control-label"><?php echo trans("enable"); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-12 col-option">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="show_rss_feeds" value="0" id="rss_system_2" class="custom-control-input" <?php echo ($user->show_rss_feeds != 1) ? 'checked' : ''; ?>>
                                            <label for="rss_system_2" class="custom-control-label"><?php echo trans("disable"); ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <input type="hidden" name="show_rss_feeds" value="<?php echo $user->show_rss_feeds; ?>">
                        <?php endif; ?>

                        <div class="form-group m-t-10">
                            <div class="row">
                                <div class="col-12">
                                    <label class="control-label"><?php echo trans('send_email_item_sold'); ?></label>
                                </div>
                                <div class="col-md-3 col-sm-4 col-12 col-option">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="send_email_when_item_sold" value="1" id="send_email_when_item_sold_1" class="custom-control-input" <?php echo ($user->send_email_when_item_sold == 1) ? 'checked' : ''; ?>>
                                        <label for="send_email_when_item_sold_1" class="custom-control-label"><?php echo trans("enable"); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-12 col-option">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="send_email_when_item_sold" value="0" id="send_email_when_item_sold_2" class="custom-control-input" <?php echo ($user->send_email_when_item_sold != 1) ? 'checked' : ''; ?>>
                                        <label for="send_email_when_item_sold_2" class="custom-control-label"><?php echo trans("disable"); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" name="submit" value="update" class="btn btn-md btn-custom"><?php echo trans("save_changes") ?></button>
                        <?php echo form_close(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Wrapper End-->



<div class="hidden-md-up">
    <!-- ==== profile update ===== --->
    <div class="navCatDownMobile nav-mobile hkmprofileupdate">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('update_profile');?></span>
        </div>
        <div  class="nav-mobile-inner">
            <div class="profile-tab-content">
                <!-- include message block -->
                <?php $this->load->view('partials/_messages'); ?>

                <?php echo form_open_multipart("profile_controller/update_profile_post", ['id' => 'form_validate']); ?>
                <div class="form-group">
                    <p>
                        <img src="<?php echo get_user_avatar($user); ?>" alt="<?php echo $user->username; ?>" class="form-avatar rounded-circle">
                    </p>
                    <p>
                        <a class='btn btn-md btn-secondary btn-file-upload'>
                            <?php echo trans('select_image'); ?>
                            <input type="file" name="file" size="40" accept=".png, .jpg, .jpeg, .gif" onchange="$('#upload-file-info').html($(this).val().replace(/.*[\/\\]/, ''));">
                        </a>
                        <span class='badge badge-info' id="upload-file-info"></span>
                    </p>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans("email_address"); ?></label>
                    <?php if ($this->general_settings->email_verification == 1): ?>
                        <?php if ($user->email_status == 1): ?>
                            &nbsp;
                            <small class="text-success">(<?php echo trans("confirmed"); ?>)</small>
                        <?php else: ?>
                            &nbsp;
                            <small class="text-danger">(<?php echo trans("unconfirmed"); ?>)</small>
                            <button type="submit" name="submit" value="resend_activation_email" class="btn float-right btn-resend-email"><?php echo trans("resend_activation_email"); ?></button>
                        <?php endif; ?>
                    <?php endif; ?>

                    <input type="email" name="email" class="form-control form-input" value="<?php echo html_escape($user->email); ?>" placeholder="<?php echo trans("email_address"); ?>" required>
                </div>
                <div class="form-group">
                    <label class="control-label"><?php echo trans("username"); ?></label>
                    <input type="text" name="username" class="form-control form-input" value="<?php echo html_escape($user->username); ?>" placeholder="<?php echo trans("username"); ?>" maxlength="<?php echo $this->username_maxlength; ?>" required>
                </div>
                <div class="form-group">
                    <label class="control-label"><?php echo trans("slug"); ?></label>
                    <input type="text" name="slug" class="form-control form-input" value="<?php echo html_escape($user->slug); ?>" placeholder="<?php echo trans("slug"); ?>" required>
                </div>

                <div class="form-group m-t-10">
                    <div class="row">
                        <div class="col-12">
                            <label class="control-label"><?php echo trans('email_option_send_email_new_message'); ?></label>
                        </div>
                        <div class="col-md-3 col-sm-4 col-12 col-option">
                            <div class="custom-control custom-radio">
                                <input type="radio" name="send_email_new_message" value="1" id="send_email_new_message_1" class="custom-control-input" <?php echo ($user->send_email_new_message == 1) ? 'checked' : ''; ?>>
                                <label for="send_email_new_message_1" class="custom-control-label"><?php echo trans("yes"); ?></label>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-12 col-option">
                            <div class="custom-control custom-radio">
                                <input type="radio" name="send_email_new_message" value="0" id="send_email_new_message_2" class="custom-control-input" <?php echo ($user->send_email_new_message != 1) ? 'checked' : ''; ?>>
                                <label for="send_email_new_message_2" class="custom-control-label"><?php echo trans("no"); ?></label>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" name="submit" value="update" class="btn btn-md btn-custom"><?php echo trans("save_changes") ?></button>
                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
    <!-- ==== shop settings ===== --->
    <div class="navCatDownMobile nav-mobile hkmshopsettings">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('shop_settings');?></span>
        </div>
        <div  class="nav-mobile-inner">
            <div class="profile-tab-content">
                <!-- include message block -->
                <?php $this->load->view('partials/_messages'); ?>

                <?php echo form_open_multipart("profile_controller/shop_settings_post"); ?>
                <div class="form-group">
                    <label class="control-label"><?php echo trans("shop_name"); ?></label>
                    <input type="text" name="shop_name" class="form-control form-input" value="<?php echo html_escape($user->shop_name); ?>" placeholder="<?php echo trans("shop_name"); ?>" maxlength="<?php echo $this->username_maxlength; ?>">
                </div>
                <div class="form-group">
                    <label class="control-label"><?php echo trans("shop_description"); ?></label>
                    <textarea name="about_me" class="form-control form-textarea" placeholder="<?php echo trans("shop_description"); ?>"><?php echo html_escape($user->about_me); ?></textarea>
                </div>
                <?php if ($this->general_settings->rss_system == 1): ?>
                    <div class="form-group m-t-10">
                        <div class="row">
                            <div class="col-12">
                                <label class="control-label"><?php echo trans('rss_feeds'); ?></label>
                            </div>
                            <div class="col-md-3 col-sm-4 col-12 col-option">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="show_rss_feeds" value="1" id="rss_system_1" class="custom-control-input" <?php echo ($user->show_rss_feeds == 1) ? 'checked' : ''; ?>>
                                    <label for="rss_system_1" class="custom-control-label"><?php echo trans("enable"); ?></label>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4 col-12 col-option">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="show_rss_feeds" value="0" id="rss_system_2" class="custom-control-input" <?php echo ($user->show_rss_feeds != 1) ? 'checked' : ''; ?>>
                                    <label for="rss_system_2" class="custom-control-label"><?php echo trans("disable"); ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <input type="hidden" name="show_rss_feeds" value="<?php echo $user->show_rss_feeds; ?>">
                <?php endif; ?>

                <div class="form-group m-t-10">
                    <div class="row">
                        <div class="col-12">
                            <label class="control-label"><?php echo trans('send_email_item_sold'); ?></label>
                        </div>
                        <div class="col-md-3 col-sm-4 col-12 col-option">
                            <div class="custom-control custom-radio">
                                <input type="radio" name="send_email_when_item_sold" value="1" id="send_email_when_item_sold_1" class="custom-control-input" <?php echo ($user->send_email_when_item_sold == 1) ? 'checked' : ''; ?>>
                                <label for="send_email_when_item_sold_1" class="custom-control-label"><?php echo trans("enable"); ?></label>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-12 col-option">
                            <div class="custom-control custom-radio">
                                <input type="radio" name="send_email_when_item_sold" value="0" id="send_email_when_item_sold_2" class="custom-control-input" <?php echo ($user->send_email_when_item_sold != 1) ? 'checked' : ''; ?>>
                                <label for="send_email_when_item_sold_2" class="custom-control-label"><?php echo trans("disable"); ?></label>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" name="submit" value="update" class="btn btn-md btn-custom"><?php echo trans("save_changes") ?></button>
                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
    <!-- ==== shipping address update ===== --->
    <div class="navCatDownMobile nav-mobile hkmshippingadresse">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('shipping_address');?></span>
        </div>
        <div  class="nav-mobile-inner">
            <div class="profile-tab-content">
                <!-- include message block -->
                <?php $this->load->view('partials/_messages'); ?>

                <?php echo form_open("profile_controller/shipping_address_post", ['id' => 'form_validate']); ?>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-6 m-b-sm-15">
                            <label class="control-label"><?php echo trans("first_name"); ?>*</label>
                            <input type="text" name="shipping_first_name" class="form-control form-input" value="<?php echo $user->shipping_first_name; ?>" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="control-label"><?php echo trans("last_name"); ?>*</label>
                            <input type="text" name="shipping_last_name" class="form-control form-input" value="<?php echo $user->shipping_last_name; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-6 m-b-sm-15">
                            <label class="control-label"><?php echo trans("email"); ?>*</label>
                            <input type="email" name="shipping_email" class="form-control form-input" value="<?php echo $user->shipping_email; ?>" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="control-label"><?php echo trans("phone_number"); ?>*</label>
                            <input type="text" name="shipping_phone_number" class="form-control form-input" value="<?php echo $user->shipping_phone_number; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label"><?php echo trans("address"); ?> 1*</label>
                    <input type="text" name="shipping_address_1" class="form-control form-input" value="<?php echo $user->shipping_address_1; ?>" required>
                </div>
                <div class="form-group">
                    <label class="control-label"><?php echo trans("address"); ?> 2 (<?php echo trans("optional"); ?>)</label>
                    <input type="text" name="shipping_address_2" class="form-control form-input" value="<?php echo $user->shipping_address_2; ?>">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-6 m-b-sm-15">
                            <label class="control-label"><?php echo trans("country"); ?>*</label>
                            <div class="selectdiv">
                                <select id="countries" name="shipping_country_id" class="form-control" required>
                                    <option value="" selected><?php echo trans("select_country"); ?></option>
                                    <?php foreach ($countries as $item): ?>
                                        <option value="<?php echo $item->id; ?>" <?php echo ($user->shipping_country_id == $item->id) ? 'selected' : ''; ?>><?php echo html_escape($item->name); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="control-label"><?php echo trans("state"); ?>*</label>
                            <input type="text" name="shipping_state" class="form-control form-input" value="<?php echo $user->shipping_state; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-6 m-b-sm-15">
                            <label class="control-label"><?php echo trans("city"); ?>*</label>
                            <input type="text" name="shipping_city" class="form-control form-input" value="<?php echo $user->shipping_city; ?>" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="control-label"><?php echo trans("zip_code"); ?>*</label>
                            <input type="text" name="shipping_zip_code" class="form-control form-input" value="<?php echo $user->shipping_zip_code; ?>" required>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-md btn-custom"><?php echo trans("save_changes") ?></button>
                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
    <!-- ==== Contact Information  ===== --->
    <div class="navCatDownMobile nav-mobile hkmcontactinformation">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('contact_informations');?></span>
        </div>
        <div  class="nav-mobile-inner">
            <div class="profile-tab-content">
                <!-- include message block -->
                <?php $this->load->view('partials/_messages'); ?>

                <?php echo form_open("profile_controller/contact_informations_post", ['id' => 'form_validate']); ?>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('location'); ?></label>
                    <div class="row">
                        <div class="col-12 col-sm-4 m-b-15">
                            <div class="selectdiv">
                                <select id="countries" name="country_id" class="form-control" onchange="get_states(this.value);">
                                    <option value=""><?php echo trans('country'); ?></option>
                                    <?php foreach ($countries as $item): ?>
                                        <option value="<?php echo $item->id; ?>" <?php echo ($item->id == $user->country_id) ? 'selected' : ''; ?>><?php echo html_escape($item->name); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-4 m-b-15">
                            <div class="selectdiv">
                                <select id="states" name="state_id" class="form-control" onchange="get_cities(this.value);">
                                    <option value=""><?php echo trans('state'); ?></option>
                                    <?php
                                    if (!empty($states)):
                                        foreach ($states as $item): ?>
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
                                    if (!empty($cities)):
                                        foreach ($cities as $item): ?>
                                            <option value="<?php echo $item->id; ?>" <?php echo ($item->id == $user->city_id) ? 'selected' : ''; ?>><?php echo html_escape($item->name); ?></option>
                                        <?php endforeach;
                                    endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6 m-b-sm-15">
                            <input type="text" name="address" class="form-control form-input" value="<?php echo html_escape($user->address); ?>" placeholder="<?php echo trans("address") ?>">
                        </div>

                        <div class="col-12 col-sm-3">
                            <input type="text" name="zip_code" class="form-control form-input" value="<?php echo html_escape($user->zip_code); ?>" placeholder="<?php echo trans("zip_code") ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans("phone_number"); ?></label>
                    <input type="text" name="phone_number" class="form-control form-input" value="<?php echo html_escape($user->phone_number); ?>" placeholder="<?php echo trans("phone_number"); ?>">
                </div>
                <div class="form-group m-t-15">
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
                <button type="submit" class="btn btn-md btn-custom"><?php echo trans("save_changes") ?></button>
                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
    <!-- ==== Chnage Password  ===== --->
    <div class="navCatDownMobile nav-mobile hkmchangepassword">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('change_password');?></span>
        </div>
        <div  class="nav-mobile-inner">
            <div class="profile-tab-content">
                <!-- include message block -->
                <?php $this->load->view('partials/_messages'); ?>

                <?php echo form_open_multipart("profile_controller/change_password_post", ['id' => 'form_validate']); ?>
                <?php if (!empty($user->password)): ?>
                    <div class="form-group">
                        <label class="control-label"><?php echo trans("old_password"); ?></label>
                        <input type="password" name="old_password" class="form-control form-input" value="<?php echo old("old_password"); ?>" placeholder="<?php echo trans("old_password"); ?>" required>
                    </div>
                    <input type="hidden" name="old_password_exists" value="1">
                <?php else: ?>
                    <input type="hidden" name="old_password_exists" value="0">
                <?php endif; ?>
                <div class="form-group">
                    <label class="control-label"><?php echo trans("password"); ?></label>
                    <input type="password" name="password" class="form-control form-input" value="<?php echo old("password"); ?>" placeholder="<?php echo trans("password"); ?>" required>
                </div>
                <div class="form-group">
                    <label class="control-label"><?php echo trans("password_confirm"); ?></label>
                    <input type="password" name="password_confirm" class="form-control form-input" value="<?php echo old("password_confirm"); ?>" placeholder="<?php echo trans("password_confirm"); ?>" required>
                </div>

                <button type="submit" class="btn btn-md btn-custom"><?php echo trans("change_password") ?></button>
                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>