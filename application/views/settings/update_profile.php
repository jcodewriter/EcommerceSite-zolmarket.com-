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
<br />
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
                    <?php $this->load->view("settings/_setting_tabs"); ?>
                </div>
            </div>

            <div class="col-sm-12 col-md-9">
                <div class="row-custom">
                    <div class="profile-tab-content">
                        <!-- include message block -->
                        <?php $this->load->view('partials/_messages'); ?>

                        <?php echo form_open_multipart("profile_controller/update_profile_post", ['id' => 'form_validate']); ?>
                        <div class="form-box-body-other">
                            <div class="form-group">
                                <label class="control-label"><?php echo trans("upload_your_shop"); ?></label>
                                <div class="upload-image-container">
                                    <div style="width: 100%; height: 180px;">
                                        <?php if ($this->auth_user->avatar) : ?>
                                            <img src="<?php echo get_user_avatar($this->auth_user); ?>" alt="<?php echo $this->auth_user->username; ?>" id="imgadshoww" style="width:100%;height: 100%;border-radius: 5px;">
                                        <?php else : ?>
                                            <img src="<?php echo get_product_image(0, "small"); ?>" alt="<?php echo $this->auth_user->username; ?>" id="imgadshoww" style="width:100%;height: 100%;border-radius: 5px;">
                                        <?php endif; ?>
                                    </div>
                                    <div style="position: absolute; top: 10px; right: 5px">
                                        <a class='btn btn-md btn-secondary btn-file-upload' style="background-color: #495057d1;">
                                            <span><i class="far fa-image"></i><?php echo trans('select_image'); ?></span>
                                            <input type="file" name="file" id="imgUploader" size="40" accept=".png, .jpg, .jpeg, .gif" onchange="$('#upload-file-info').html($(this).val().replace(/.*[\/\\]/, ''));">
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="text-align: left">
                                <label class="control-label"><?php echo trans("email_address"); ?></label>
                                <?php if ($this->general_settings->email_verification == 1) : ?>
                                    <?php if ($user->email_status == 1) : ?>
                                        &nbsp;
                                        <small class="text-success" style="font-size: 12px">(<?php echo trans("confirmed"); ?>)</small>
                                        <img src="<?php echo base_url(); ?>assets/img/confirm.png" style="width:15px; margin: 3px 0 0 0" />
                                    <?php else : ?>
                                        &nbsp;
                                        <small class="text-danger">(<?php echo trans("unconfirmed"); ?>)</small>
                                        <button type="submit" name="submit" value="resend_activation_email" class="btn float-right btn-resend-email"><?php echo trans("resend_activation_email"); ?></button>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <input type="email" name="email" class="form-control form-input" value="<?php echo html_escape($user->email); ?>" placeholder="<?php echo trans("email_address"); ?>" required>
                            </div>
                            <div class="form-group" style="text-align: left">
                                <label class="control-label"><?php echo trans("username"); ?></label>
                                <input type="text" name="username" class="form-control form-input" value="<?php echo html_escape($user->username); ?>" placeholder="<?php echo trans("username"); ?>" maxlength="<?php echo $this->username_maxlength; ?>" required>
                            </div>
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