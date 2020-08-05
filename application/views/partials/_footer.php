<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="navCatDownMobile nav-mobile" id="MenuMobileModel">
    <div class="form-group cat-header">
        <a href="javascript:void(0)" class="btn-back-mobile-nav"><i class="icon-arrow-left"></i> <?= trans('back') ?></a>
        <span href="javascript:void(0)" class="text-white textcat-header text-center" style="width: 250px;overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"></span>
    </div>
    <div class="nav-mobile-inner">
        <ul class="navbar-nav top-search-bar mobile-search-form">


        </ul>
    </div>
</div>

<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="footer-top <?php echo (!isset($is_exist)?'mobile-footer-top':'');?>">
                    <div class="row">
                        <div class="col-12 col-md-3 footer-widget">
                            <div class="row-custom">
                                <div class="footer-logo">
                                    <a href="<?php echo lang_base_url(); ?>"><img
                                                src="<?php echo get_logo($general_settings); ?>" alt="logo"></a>
                                </div>
                            </div>
                            <div class="row-custom">
                                <div class="footer-about">
                                    <?php echo html_escape($settings->about_footer); ?>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-12 col-md-3 footer-widget">
                            <div class="nav-footer">
                                <div class="row-custom">
                                    <h4 class="footer-title"><?php echo trans("footer_quick_links"); ?></h4>
                                </div>
                                <div class="row-custom profile-tabs">
                                    <ul class="nav">
                                        <li><a href="<?php echo lang_base_url(); ?>"><?php echo trans("home"); ?></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo lang_base_url(); ?>blog"><?php echo trans("blog"); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a id="hkmcontactus" class="nav-link" href="<?php echo lang_base_url(); ?>contact"><?php echo trans("contact"); ?></a>
                                        </li>
                                        <?php foreach ($footer_quick_links as $item): ?>
                                            <li>
                                                <a href="<?php echo lang_base_url() . $item->slug; ?>"><?php echo html_escape($item->title); ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 footer-widget">
                            <div class="nav-footer">
                                <div class="row-custom">
                                    <h4 class="footer-title"><?php echo trans("footer_information"); ?></h4>
                                </div>
                                <div class="row-custom">
                                    <ul>
                                        <?php foreach ($footer_information_links as $item): ?>
                                            <li>
                                                <a href="<?php echo lang_base_url() . $item->slug; ?>"><?php echo html_escape($item->title); ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="nav-footer">
                                <div class="row-custom">
                                    <h4 class="footer-title"><?php echo trans("download"); ?></h4>
                                </div>
                                <div class="row-custom profile-tabs" style="display: block;">
                                    <a href="https://apps.apple.com/se/app/zolmarket/id1493982231?l=en"><img src="https://cdn.oreillystatic.com/oreilly/images/app-store-logo.png" alt="Apple app store" style="height: 44px;"></a>
                                    <a href="https://play.google.com/store/apps/details?id=com.app.zolmarket&hl=en_US"><img src="https://cdn.oreillystatic.com/oreilly/images/google-play-logo.png" alt="Google play store" style="height: 44px; width: 130.5px"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 footer-widget">
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="footer-title"><?php echo trans("follow_us"); ?></h4>
                                    <div class="footer-social-links">
                                        <!--include social links-->
                                        <?php $this->load->view('partials/_social_links', ['show_rss' => true]); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="newsletter">
                                        <h4 class="footer-title"><?php echo trans("newsletter"); ?></h4>
                                        <?php echo form_open('home_controller/add_to_subscribers', ['id' => 'form_validate_newsletter']); ?>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="newsletter-inner">
                                                    <div class="d-table-cell">
                                                        <input type="email" class="form-control" name="email"
                                                               placeholder="<?php echo trans("enter_email"); ?>"
                                                               required>
                                                    </div>
                                                    <div class="d-table-cell align-middle">
                                                        <button class="btn btn-default"><?php echo trans("subscribe"); ?></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php echo form_close(); ?>

                                        <div class="row">
                                            <div class="col-12">
                                                <div id="newsletter" class="m-t-5">
                                                    <?php
                                                    if ($this->session->flashdata('news_error')):
                                                        echo '<span class="text-danger">' . $this->session->flashdata('news_error') . '</span>';
                                                    endif;

                                                    if ($this->session->flashdata('news_success')):
                                                        echo '<span class="text-success">' . $this->session->flashdata('news_success') . '</span>';
                                                    endif;
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-region">
                                <div class="col-12">
                                    <?php if ($general_settings->default_product_location == 0): ?>
                                        <div class="region-left">
                                            <div class="row-custom footer-location">
                                                <div class="icon-text">
                                                    <i class="icon-map-marker"></i>
                                                </div>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                                            data-toggle="dropdown">
                                                        <?php echo $default_location; ?>&nbsp;<span
                                                                class="icon-arrow-down"></span>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                           onclick="set_default_location('all');"><?php echo trans("all"); ?></a>
                                                        <?php if (!empty($countries)): foreach ($countries as $item): ?>
                                                            <a class="dropdown-item" href="javascript:void(0)"
                                                               onclick="set_default_location('<?php echo $item->id; ?>');"><?php echo html_escape($item->name); ?></a>
                                                        <?php endforeach;
                                                        endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="region-right">
                                        <?php if ($general_settings->multilingual_system == 1 && count($languages) > 1): ?>
                                            <div class="row-custom">
                                                <div class="dropdown language-dropdown">
                                                    <button type="button" class="btn dropdown-toggle"
                                                            data-toggle="dropdown">
                                                        <i class="icon-language"></i>
                                                        <?php echo html_escape($selected_lang->name); ?>&nbsp;<span
                                                                class="icon-arrow-down"></span>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <?php foreach ($languages as $language):
                                                            $lang_url = base_url() . $language->short_form . "/";
                                                            if ($language->id == $this->general_settings->site_lang) {
                                                                $lang_url = base_url();
                                                            } ?>
                                                            <a href="<?php echo $lang_url; ?>"
                                                               class="<?php echo ($language->id == $selected_lang->id) ? 'selected' : ''; ?> "
                                                               class="dropdown-item">
                                                                <?php echo $language->name; ?>
                                                            </a>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="footer-bottom">
                <div class="container">
                    <div class="copyright">
                        <?php echo html_escape($settings->copyright); ?>
                    </div>
                    <div class="payments text-right">
                        <img src="<?php echo base_url(); ?>assets/img/payments.png" alt="payments" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="mobile-footer text-center d-md-none <?php echo $this->is_webview == 'web'? 'is_web': 'is_mobile';?>">
    <div class="container">
        <div class="row">
            <div style="max-width: 20%; width: 20%">
                <a href="<?php echo lang_base_url(); ?>">
                    <div style="height: 22px;">
                        <i class="fa fa-home"></i>
                    </div>
                    <div>
                        <span class="<?php if ($this->selected_lang->ckeditor_lang == 'ar'): echo "mobile-footer-font"; endif; ?>"><?php echo trans("main"); ?></span>
                    </div>
                </a>
            </div>
            <!-- message -->
            <?php if (auth_check()): ?>
            <div style="max-width: 20%; width: 20%">
                    <a href="<?php echo lang_base_url(); ?>messages">
                        <div style="height: 22px;">
                            <i class="fa fa-comment-o"></i>
                        </div>
                        <div>
                            <span class="<?php if ($this->selected_lang->ckeditor_lang == 'ar'): echo "mobile-footer-font"; endif; ?>"><?php echo trans("chat"); ?></span>
                        </div>
                        <?php if ($unread_message_count > 0): ?>
                            <span class="span-message-count"
                                    style="position:absolute;left:9px;top:-50px"><?php echo $unread_message_count; ?></span>
                        <?php endif; ?>
                    </a>
                </div>
            <?php else: ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal">
                        <div style="height: 22px;">
                            <i class="fa fa-comment-o"></i>
                        </div>
                        <div>
                            <span class="<?php if ($this->selected_lang->ckeditor_lang == 'ar'): echo "mobile-footer-font"; endif; ?>"><?php echo trans("chat"); ?></span>
                        </div>
                    </a>
                </div>
            <?php endif; ?>            
            <!-- sellnow -->
            <?php if (auth_check()): ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="<?php echo lang_base_url(); ?>sell-now">
                        <div style="height: 22px;">
                            <i class="fa fa-plus-square-o"></i>
                        </div>
                        <div>
                            <span class="<?php if ($this->selected_lang->ckeditor_lang == 'ar'): echo "mobile-footer-font"; endif; ?>"><?php echo trans("post"); ?></span>
                        </div>
                    </a>
                </div>
            <?php else: ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal">
                        <div style="height: 22px;">
                            <i class="fa fa-plus-square-o"></i>
                        </div>
                        <div>
                            <span class="<?php if ($this->selected_lang->ckeditor_lang == 'ar'): echo "mobile-footer-font"; endif; ?>"><?php echo trans("post"); ?></span>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
            <!-- notifications -->
            <?php if (auth_check()): ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="<?php echo lang_base_url(); ?>notifications">
                        <div style="height: 22px;">
                            <i class="far fa-bell" style="font-size: 17px;"></i>
                        </div>
                        <div>
                            <span class="<?php if ($this->selected_lang->ckeditor_lang == 'ar'): echo "mobile-footer-font"; endif; ?>"><?php echo trans("notification"); ?></span>
                        </div>
                        <?php $notification_count = get_notification_count();
                        if ($notification_count > 0): ?>
                            <span class="notification"><?php echo $notification_count; ?></span>
                        <?php endif; ?>
                    </a>
                </div>
            <?php else: ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal">
                        <div style="height: 22px;">
                            <i class="far fa-bell" style="font-size: 17px;"></i>
                        </div>
                        <div>
                            <span class="<?php if ($this->selected_lang->ckeditor_lang == 'ar'): echo "mobile-footer-font"; endif; ?>"><?php echo trans("notification"); ?></span>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
             <!-- account -->
            <?php if (auth_check()): ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="<?php echo lang_base_url(); ?>account/<?php echo $this->auth_user->slug; ?>">
                        <div style="height: 22px;">
                            <?php $profile=get_user($this->auth_user->id); ?>
                            <img src="<?php echo get_user_avatar($profile); ?>" alt="User" style="width: 25px;border-radius: 50%;height: 23px;margin-top: -3px;">
                        </div>
                        <div>
                            <span class="<?php if ($this->selected_lang->ckeditor_lang == 'ar'): echo "mobile-footer-font"; endif; ?>"><?php echo trans("profile"); ?></span>
                        </div>
                    </a>
                </div>
            <?php else: ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal">
                        <div style="height: 22px;">
                            <i class="fa fa-user-o"></i>
                        </div>
                        <div>
                            <span class="<?php if ($this->selected_lang->ckeditor_lang == 'ar'): echo "mobile-footer-font"; endif; ?>"><?php echo trans("login"); ?></span>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
 <!-- ==== Contact us ===== --->
     <div class="navCatDownMobile nav-mobile hkmcontactus">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans("contact"); ?></span>
        </div>
        <div  class="text-left"  style="padding-top: 85px;">
            <div class="col-12">
				<div class="page-contact">

					<div class="row contact-text">
						<div class="col-12">
							<?php echo trans("please_contact_us"); ?>
						</div>
					</div>

					<div class="row">
						<div class="col-12">
							<h2 class="contact-leave-message"><?php echo trans("leave_message"); ?></h2>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 col-12 order-1 order-lg-0">
							<!-- include message block -->
							<?php $this->load->view('partials/_messages'); ?>

							<!-- form start -->
							<?php echo form_open('home_controller/contact_post', ['id' => 'form_validate', 'class' => 'validate_terms']); ?>
							<div class="form-group">
								<input type="text" class="form-control form-input" name="name" placeholder="<?php echo trans("name"); ?>" maxlength="199" minlength="1" pattern=".*\S+.*" value="<?php echo old('name'); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?> required>
							</div>
							<div class="form-group">
								<input type="email" class="form-control form-input" name="email" maxlength="199" placeholder="<?php echo trans("email_address"); ?>" value="<?php echo old('email'); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?> required>
							</div>
							<div class="form-group">
								<textarea class="form-control form-input form-textarea" name="message" placeholder="<?php echo trans("message"); ?>" maxlength="4970" minlength="5" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?> required><?php echo old('message'); ?></textarea>
							</div>
							<div class="form-group">
								<div class="custom-control custom-checkbox custom-control-validate-input">
									<input type="checkbox" class="custom-control-input" name="terms" id="checkbox_terms" required>
									<label for="checkbox_terms" class="custom-control-label"><?php echo trans("terms_conditions_exp"); ?>&nbsp;<a href="<?php echo lang_base_url(); ?>terms-conditions" class="link-terms" target="_blank"><strong><?php echo trans("terms_conditions"); ?></strong></a></label>
								</div>
							</div>

							<?php generate_recaptcha(); ?>

							<div class="form-group">
								<button type="submit" class="btn btn-md btn-custom">
									<?php echo trans("submit"); ?>
								</button>
							</div>

							<?php echo form_close(); ?>
						</div>

						<div class="col-md-6 col-12 order-0 order-lg-1 contact-right">

							<?php if ($settings->contact_phone): ?>
								<div class="col-12 contact-item">
									<i class="icon-phone" aria-hidden="true"></i>
									<?php echo html_escape($settings->contact_phone); ?>
								</div>
							<?php endif; ?>

							<?php if ($settings->contact_email): ?>
								<div class="col-12 contact-item">
									<i class="icon-envelope" aria-hidden="true"></i>
									<?php echo html_escape($settings->contact_email); ?>
								</div>
							<?php endif; ?>

							<?php if ($settings->contact_address): ?>
								<div class="col-12 contact-item">
									<i class="icon-map-marker" aria-hidden="true"></i>
									<?php echo html_escape($settings->contact_address); ?>
								</div>
							<?php endif; ?>


							<div class="col-sm-12 contact-social">
								<!--Include social media links-->
								<?php $this->load->view('partials/_social_links', ['show_rss' => null]); ?>
							</div>


						</div>
					</div>

				</div>
			</div>
        </div>
    </div>

<?php if (!isset($_COOKIE["modesy_cookies_warning"]) && $settings->cookies_warning): ?>
    <div class="cookies-warning">
        <div class="text"><?php echo $this->settings->cookies_warning_text; ?></div>
        <a href="javascript:void(0)" onclick="hide_cookies_warning();" class="icon-cl"> <i class="icon-close"></i></a>
    </div>
<?php endif; ?>
<!-- Scroll Up Link -->
<div class="profile-tabs">
   <div class="nav">
    <div class="nav-item">
        <a href="javascript:void(0)" id="hkmcontactus" class="scrollup"><i class="icon-arrow-up"></i></a>
    </div>  
   </div> 
</div>


<?php if (!empty($this->session->userdata('mds_send_email_data'))): ?>
    <script>
        $(document).ready(function () {
            var data = JSON.parse(<?php echo json_encode($this->session->userdata("mds_send_email_data"));?>);
            if (data) {
                data[csfr_token_name] = $.cookie(csfr_cookie_name);
                data['lang_folder'] = lang_folder;
                data['form_lang_base_url'] = '<?php echo lang_base_url(); ?>';
                $.ajax({
                    type: "POST",
                    url: base_url + "ajax_controller/send_email",
                    data: data,
                    success: function (response) {
                    }
                });
            }
        });
    </script>
<?php endif;
$this->session->unset_userdata('mds_send_email_data'); ?>

<?php if (!empty($this->session->userdata('mds_send_email_to_user'))): ?>
    <script>
        $(document).ready(function () {
            var data = JSON.parse(<?php echo json_encode($this->session->userdata("mds_send_email_to_user"));?>);
            if (data) {
                data[csfr_token_name] = $.cookie(csfr_cookie_name);
                data['lang_folder'] = lang_folder;
                data['form_lang_base_url'] = '<?php echo lang_base_url(); ?>';
                $.ajax({
                    type: "POST",
                    url: base_url + "ajax_controller/send_email",
                    data: data,
                    success: function (response) {
                    }
                });
            }
        });
    </script>
<?php endif;
$this->session->unset_userdata('mds_send_email_to_user'); ?>

<!-- Popper JS-->
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/popper.min.js"></script>
<!-- Bootstrap JS-->
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- intlTelInput JS-->
<script src="<?php echo base_url(); ?>assets/vendor/telinput/js/intlTelInput.js"></script>
<!-- Owl-carousel -->
<script src="<?php echo base_url(); ?>assets/vendor/owl-carousel/owl.carousel.min.js"></script>
<!-- swiper-carousel -->
<script src="<?php echo base_url(); ?>assets/vendor/swiper/swiper.min.js"></script>
<!-- Plugins JS-->
<script src="<?php echo base_url(); ?>assets/js/plugins-1.4.js"></script>


<script>$('<input>').attr({type: 'hidden', name: 'form_lang_base_url', value: '<?php echo lang_base_url(); ?>'}).appendTo('form');</script>
<script>$('<input>').attr({type: 'hidden', name: 'lang_folder', value: '<?php echo $this->selected_lang->folder_name; ?>'}).appendTo('form');</script>
<script>
    var base_url = '<?php echo base_url(); ?>';var lang_base_url = '<?php echo lang_base_url(); ?>';
    var thousands_separator = '<?php echo $this->thousands_separator; ?>';
    var lang_folder = '<?php echo $this->selected_lang->folder_name; ?>';
    var fb_app_id = '<?php echo $this->general_settings->facebook_app_id; ?>';
    var csfr_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var csfr_cookie_name = '<?php echo $this->config->item('csrf_cookie_name'); ?>';
    var is_hkm_one_country = '<?php echo @$is_hkm_one_country; ?>';
    var is_recaptcha_enabled = false;var txt_processing = '<?php echo trans("processing"); ?>';var sweetalert_ok = '<?php echo trans("ok"); ?>';var sweetalert_cancel = '<?php echo trans("cancel"); ?>';<?php if ($recaptcha_status == true): ?>is_recaptcha_enabled = true;<?php endif; ?>
    $('#form-product-filters input[name=form_lang_base_url]').remove();
    $('#form-product-filters input[name=lang_folder]').remove();
    $('#formsearchzolmarket input[name=form_lang_base_url]').remove();
    $('#formsearchzolmarket input[name=lang_folder]').remove();
</script>
<script>
    window.swiper = new Swiper('.product-slider-container .swiper-container', {
      pagination: {
        el: '.swiper-pagination',
        type: 'fraction',
      },
      loop:true,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
</script>
<?php echo $general_settings->google_adsense_code; ?>
<?php echo $general_settings->google_analytics; ?>

<script src="<?php echo base_url(); ?>assets/js/script.js"></script>
<script type="text/javascript">
  var onloadCallback = function() {
    console.log("grecaptcha is ready!");
  };
  
  function recaptcha_callback(){
      console.log("grecaptcha isee ready!");
  }
</script>

<style>
    i,span[class*='icon']{
        visibility: visible;
    }
</style>
</body>
</html>
