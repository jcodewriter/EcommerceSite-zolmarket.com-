<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="hkm_messages_navCatDownMobile">
    <div class="cat-header" style="position: fixed; top: 0;">
        <div class="mobile-header-back">
            <a href="<?php echo lang_base_url(); ?>" class="btn-back-mobile-nav"> <i class="icon-arrow-left"></i> <?php echo trans("back"); ?> </a>
        </div>
        <div class="mobile-header-title">
            <span class="text-white textcat-header text-center"><?php echo trans("login"); ?></span>
        </div>
        <div class="mobilde-header-cart">
        </div>
    </div>
</div>
<!-- Wrapper -->
<div id="wrapper" style="padding-top: 0 !important;">
    <div class="container">
        <div class="auth-container">
            <div class="auth-box">
                <div class="row">
                    <div class="col-12">
                        <h4 class="title"><?php echo trans("login"); ?></h4>
                        <!-- form start -->
                        <?php echo form_open('auth_controller/login_post', ['id' => 'form_validate', 'class' => 'validate_terms']); ?>
                        <p class="p-social-media m-0 m-b-10"><?php echo trans("dont_have_account"); ?>&nbsp;<a href="<?php echo lang_base_url(); ?>register" class="link"><?php echo trans("register"); ?></a></p>
                        <div class="social-login-cnt">
                            <?php $this->load->view("partials/_social_login", ["or_text" => trans("login_with_email")]); ?>
                        </div>
                        <!-- include message block -->
                        <?php $this->load->view('partials/_messages'); ?>
                        <div class="form-group" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>">
                            <label for="email" style="color: #777;"><?php echo trans("email_address"); ?></label>
                            <input type="email" id="email" name="email" class="form-control auth-form-input" placeholder="<?php echo trans("email_address"); ?>" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>" required>
                        </div>
                        <div class="form-group" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>">
                            <label for="password" style="color: #777;"><?php echo trans("password"); ?></label>
                            <input type="password" id="password" name="password" class="form-control auth-form-input" placeholder="<?php echo trans("password"); ?>" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>" minlength="4" required>
                            <i class="far fa-eye" id="togglePassword" style="position: absolute; bottom: 15px; <?= $this->selected_lang->id == 2 ? 'left: 10px' : 'right: 10px;'; ?>"></i>
                        </div>
                        <div class="form-group" style="display: flex; justify-content: space-between;">
                            <div class="custom-control custom-checkbox custom-control-validate-input" style="display: flex; align-items: center;">
                                <input type="checkbox" name="remember_me" value="" id="remember-me" class="custom-control-input" checked>
                                <label for="remember-me" class="custom-control-label"><?php echo trans("remember_me"); ?></label>
                            </div>
                            <a href="<?php echo lang_base_url(); ?>forgot-password" class="link-forgot-password text-right"><?php echo trans("forgot_password"); ?></a>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-md btn-custom btn-block"><?php echo trans("login"); ?></button>
                        </div>
                        <?php echo form_close(); ?>
                        <!-- form end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Wrapper End-->