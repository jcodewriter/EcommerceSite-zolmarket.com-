<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="mobile-footer text-center d-md-none <?php echo $this->is_webview == 'web' ? 'is_web' : 'is_mobile'; ?>">
    <div class="container">
        <div class="row">
            <div style="max-width: 20%; width: 20%">
                <a href="<?php echo lang_base_url(); ?>">
                    <div style="height: 22px;">
                        <i class="fa fa-home"></i>
                    </div>
                    <div>
                        <span class="<?php if ($this->selected_lang->ckeditor_lang == 'ar') : echo "mobile-footer-font";
                                        endif; ?>"><?php echo trans("main"); ?></span>
                    </div>
                </a>
            </div>
            <!-- message -->
            <?php if (auth_check()) : ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="<?php echo lang_base_url(); ?>messages">
                        <div style="height: 22px;">
                            <i class="fa fa-comment-o"></i>
                        </div>
                        <div>
                            <span class="<?php if ($this->selected_lang->ckeditor_lang == 'ar') : echo "mobile-footer-font";
                                            endif; ?>"><?php echo trans("chat"); ?></span>
                        </div>
                        <?php if ($unread_message_count > 0) : ?>
                            <span class="span-message-count" style="position:absolute;left:9px;top:-50px"><?php echo $unread_message_count; ?></span>
                        <?php endif; ?>
                    </a>
                </div>
            <?php else : ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal">
                        <div style="height: 22px;">
                            <i class="fa fa-comment-o"></i>
                        </div>
                        <div>
                            <span class="<?php if ($this->selected_lang->ckeditor_lang == 'ar') : echo "mobile-footer-font";
                                            endif; ?>"><?php echo trans("chat"); ?></span>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
            <!-- sellnow -->
            <?php if (auth_check()) : ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="<?php echo lang_base_url(); ?>sell-now">
                        <div style="height: 22px;">
                            <i class="fa fa-plus-square-o"></i>
                        </div>
                        <div>
                            <span class="<?php if ($this->selected_lang->ckeditor_lang == 'ar') : echo "mobile-footer-font";
                                            endif; ?>"><?php echo trans("post"); ?></span>
                        </div>
                    </a>
                </div>
            <?php else : ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal">
                        <div style="height: 22px;">
                            <i class="fa fa-plus-square-o"></i>
                        </div>
                        <div>
                            <span class="<?php if ($this->selected_lang->ckeditor_lang == 'ar') : echo "mobile-footer-font";
                                            endif; ?>"><?php echo trans("post"); ?></span>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
            <!-- notifications -->
            <?php if (auth_check()) : ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="<?php echo lang_base_url(); ?>notifications">
                        <div style="height: 22px;">
                            <i class="far fa-bell" style="font-size: 17px;"></i>
                        </div>
                        <div>
                            <span class="<?php if ($this->selected_lang->ckeditor_lang == 'ar') : echo "mobile-footer-font";
                                            endif; ?>"><?php echo trans("notification"); ?></span>
                        </div>
                        <?php $notification_count = get_notification_count();
                        if ($notification_count > 0) : ?>
                            <span class="notification"><?php echo $notification_count; ?></span>
                        <?php endif; ?>
                    </a>
                </div>
            <?php else : ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal">
                        <div style="height: 22px;">
                            <i class="far fa-bell" style="font-size: 17px;"></i>
                        </div>
                        <div>
                            <span class="<?php if ($this->selected_lang->ckeditor_lang == 'ar') : echo "mobile-footer-font";
                                            endif; ?>"><?php echo trans("notification"); ?></span>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
            <!-- account -->
            <?php if (auth_check()) : ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="<?php echo lang_base_url(); ?>account/<?php echo $this->auth_user->slug; ?>">
                        <div style="height: 22px;">
                            <?php $profile = get_user($this->auth_user->id); ?>
                            <img src="<?php echo get_user_avatar($profile); ?>" alt="User" style="width: 25px;border-radius: 50%;height: 23px;margin-top: -3px;">
                        </div>
                        <div>
                            <span class="<?php if ($this->selected_lang->ckeditor_lang == 'ar') : echo "mobile-footer-font";
                                            endif; ?>"><?php echo trans("profile"); ?></span>
                        </div>
                    </a>
                </div>
            <?php else : ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal">
                        <div style="height: 22px;">
                            <i class="fa fa-user-o"></i>
                        </div>
                        <div>
                            <span class="<?php if ($this->selected_lang->ckeditor_lang == 'ar') : echo "mobile-footer-font";
                                            endif; ?>"><?php echo trans("login"); ?></span>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if (!isset($_COOKIE["modesy_cookies_warning"]) && $settings->cookies_warning) : ?>
    <div class="cookies-warning">
        <div class="text"><?php echo $this->settings->cookies_warning_text; ?></div>
        <a href="javascript:void(0)" onclick="hide_cookies_warning();" class="icon-cl"> <i class="icon-close"></i></a>
    </div>
<?php endif; ?>

<!-- Bootstrap JS-->
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- Owl-carousel -->
<script src="<?php echo base_url(); ?>assets/vendor/owl-carousel/owl.carousel.min.js"></script>
<!-- Plugins JS-->
<script src="<?php echo base_url(); ?>assets/js/plugins-1.4.js"></script>
<script>
    var base_url = '<?php echo base_url(); ?>';
    var lang_base_url = '<?php echo lang_base_url(); ?>';
    var thousands_separator = '<?php echo $this->thousands_separator; ?>';
    var lang_folder = '<?php echo $this->selected_lang->folder_name; ?>';
    var fb_app_id = '<?php echo $this->general_settings->facebook_app_id; ?>';
    var csfr_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var csfr_cookie_name = '<?php echo $this->config->item('csrf_cookie_name'); ?>';
    var is_hkm_one_country = '<?php echo @$is_hkm_one_country; ?>';
    var is_recaptcha_enabled = false;
    var txt_processing = '<?php echo trans("processing"); ?>';
    var sweetalert_ok = '<?php echo trans("ok"); ?>';
    var sweetalert_cancel = '<?php echo trans("cancel"); ?>';
    <?php if ($recaptcha_status == true) : ?>is_recaptcha_enabled = true;
    <?php endif; ?>
    $('#form-product-filters input[name=form_lang_base_url]').remove();
    $('#form-product-filters input[name=lang_folder]').remove();
    $('#formsearchzolmarket input[name=form_lang_base_url]').remove();
    $('#formsearchzolmarket input[name=lang_folder]').remove();
</script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

<style>
    i,
    span[class*='icon'] {
        visibility: visible;
    }
</style>
</body>

</html>