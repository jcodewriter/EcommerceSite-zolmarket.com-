<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="hkm_messages_navCatDownMobile">
    <div class="cat-header">
        <div class="mobile-header-back">
            <a href="<?php echo lang_base_url(); ?>" class="btn-back-mobile-nav"> <i class="icon-arrow-left"></i> <?php echo trans("back"); ?> </a>
        </div>
        <div class="mobile-header-title">
            <span class="text-white textcat-header text-center"><?php echo trans("register"); ?></span>
        </div>
        <div class="mobilde-header-cart">
        </div>
    </div>
</div>
<!-- Wrapper -->
<div id="wrapper" style="padding-top: 0 !important;height: 900px;">
    <div class="container">
        <div class="auth-container">
            <div class="auth-box">
                <div class="row">
                    <div class="col-12">
                        <h1 class="title"><?php echo trans("register"); ?></h1>
                        <!-- form start -->
                        <?php
                        if ($recaptcha_status) {
                            echo form_opform_open_multiparten('auth_controller/register_post', [
                                'id' => 'form_validate', 'class' => 'validate_terms',
                                'onsubmit' => "var serializedData = $(this).serializeArray();var recaptcha = ''; $.each(serializedData, function (i, field) { if (field.name == 'g-recaptcha-response') {recaptcha = field.value;}});if (recaptcha.length < 5) { $('.g-recaptcha>div').addClass('is-invalid');return false;} else { $('.g-recaptcha>div').removeClass('is-invalid');}"
                            ]);
                        } else {
                            echo form_open_multipart('auth_controller/register_post', ['id' => 'form_validate', 'class' => 'validate_terms']);
                        }
                        ?>
                        <p class="p-social-media m-0 m-b-10"><?php echo trans("have_account"); ?>&nbsp;<a href="<?php echo lang_base_url() . 'login'; ?>" class="link"><?php echo trans("login"); ?></a></p>

                        <div class="social-login-cnt">
                            <?php $this->load->view("partials/_social_login", ['or_text' => trans("register_with_email")]); ?>
                        </div>
                        <!-- include message block -->
                        <?php $this->load->view('partials/_messages'); ?>
                            <div class="form-group" style="text-align: center;">
                                <label class="control-label"><?php echo trans("upload_your_shop"); ?></label>
                                <div class="row">
                                    <div class="col-sm-12 col-profile">
                                        <img alt="avatar" id="imgadshoww" class="thumbnail img-responsive img-update" style="max-width: 400px; height: 200px;display:none; width: 200px; border-radius: 50%;margin:auto">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-profile mt-1">
                                        <a class="btn btn-success btn-sm btn-file-upload">
                                            <?php echo trans('select_image'); ?>
                                            <input id="imgUploader" name="file" size="40" accept=".png, .jpg, .jpeg" onchange="$('#upload-file-info').html($(this).val().replace(/.*[\/\\]/, ''));$('#imgadshoww').css('display','block')" type="file">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <div class="form-group" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>">
                            <div class="d-flex justify-content-between" style="width: 100%">
                                <div style="width: 48%;<?= $this->selected_lang->id == 2 ? 'order: 1' : ''; ?>">
                                    <label for="password" style="font-weight: 600"><?php echo trans("first_name"); ?></label>
                                    <input autocomplete="off" type="text" name="firstname" class="form-control auth-form-input required" message="<?php echo trans('please_enter_firstname'); ?>" placeholder="<?php echo trans("first_name"); ?>" maxlength="<?php echo $this->username_maxlength; ?>" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>" required>
                                </div>
                                <div style="width: 48%;">
                                    <label for="password" style="font-weight: 600"><?php echo trans("last_name"); ?></label>
                                    <input autocomplete="off" type="text" name="lastname" class="form-control auth-form-input required" message="<?php echo trans('please_enter_lastname'); ?>" placeholder="<?php echo trans("last_name"); ?>" maxlength="<?php echo $this->username_maxlength; ?>" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>">
                            <label for="password" style="font-weight: 600"><?php echo trans("email_address"); ?></label>
                            <input autocomplete="off" type="email" id="email" name="email" class="form-control auth-form-input required" message="<?php echo trans('please_enter_email'); ?>" placeholder="<?php echo trans("email_address"); ?>" style="<?= $this->selected_lang->id == 2 ? 'text-align: right;' : ''; ?>" required>
                        </div>
                        <div class="form-group" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>">
                            <label for="password" style="font-weight: 600"><?php echo trans("password"); ?></label>
                            <input type="password" id="password" name="password" class="form-control auth-form-input required" message="<?php echo trans('please_enter_password'); ?>" placeholder="<?php echo trans("password"); ?>" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>" required>
                            <i class="far fa-eye" id="registerTogglePassword" style="position: absolute; top: 45px; <?= $this->selected_lang->id == 2 ? 'left: 10px' : 'right: 10px;'; ?>"></i>
                        </div>
                        <div class="form-group" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>">
                            <label for="password" style="font-weight: 600"><?php echo trans("password_confirm"); ?></label>
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control auth-form-input required" message="<?php echo trans('please_confirm'); ?>" placeholder="<?php echo trans("password_confirm"); ?>" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>" required>
                            <i class="far fa-eye" id="confirmTogglePassword" style="position: absolute; top: 45px; <?= $this->selected_lang->id == 2 ? 'left: 10px' : 'right: 10px;'; ?>"></i>
                        </div>
                        <div class="form-group m-t-5 m-b-20">
                            <div class="custom-control custom-checkbox custom-control-validate-input">
                                <input type="checkbox" class="custom-control-input" name="terms" id="checkbox_terms" required>
                                <label for="checkbox_terms" class="custom-control-label"><?php echo trans("terms_conditions_exp"); ?>&nbsp;<a href="<?php echo lang_base_url(); ?>terms-conditions" class="link-terms" target="_blank"><strong><?php echo trans("terms_conditions"); ?></strong></a></label>
                            </div>
                        </div>
                        <?php if ($recaptcha_status) : ?>
                            <div class="recaptcha-cnt">
                                <?php generate_recaptcha(); ?>
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <button type="submit" class="btn btn-md btn-custom btn-block"><?php echo trans("register"); ?></button>
                        </div>

                        <?php echo form_close(); ?>
                        <!-- form end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $("#email").keyup(function(){
        if($(this).val() != ""){
            $(this).css({'font-size':'16px','font-weight':'bold'});
        }
        else{
            $(this).css({'font-size':'13px','font-weight':'normal'});
        }
    })
})
</script>
<style>
    .custom-control-label::before {
        width: 1.2rem;
        height: 1.2rem;
    }

    .custom-control-label::after {
        top: .23rem;
    }

    .custom-control-label::after {
        width: 1.2rem;
        height: 1.2rem;
    }
</style>
<!-- Wrapper End-->