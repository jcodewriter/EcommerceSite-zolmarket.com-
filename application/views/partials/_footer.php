<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
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
                <div class="footer-top <?php echo (!isset($is_exist) ? 'mobile-footer-top' : ''); ?>">
                    <div class="row">
                        <div class="col-12 col-md-3 footer-widget">
                            <div class="row-custom">
                                <div class="footer-logo">
                                    <a href="<?php echo lang_base_url(); ?>"><img src="<?php echo get_logo($general_settings); ?>" alt="logo"></a>
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
                                        <?php foreach ($footer_quick_links as $item) : ?>
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
                                        <?php foreach ($footer_information_links as $item) : ?>
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
                                                        <input type="email" class="form-control" name="email" placeholder="<?php echo trans("enter_email"); ?>" required>
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
                                                    if ($this->session->flashdata('news_error')) :
                                                        echo '<span class="text-danger">' . $this->session->flashdata('news_error') . '</span>';
                                                    endif;

                                                    if ($this->session->flashdata('news_success')) :
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
                                    <?php if ($general_settings->default_product_location == 0) : ?>
                                        <div class="region-left">
                                            <div class="row-custom footer-location">
                                                <div class="icon-text">
                                                    <i class="icon-map-marker"></i>
                                                </div>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                        <?php echo $default_location; ?>&nbsp;<span class="icon-arrow-down"></span>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="set_default_location('all');"><?php echo trans("all"); ?></a>
                                                        <?php if (!empty($countries)) : foreach ($countries as $item) : ?>
                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="set_default_location('<?php echo $item->id; ?>');"><?php echo html_escape($item->name); ?></a>
                                                        <?php endforeach;
                                                        endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="region-right">
                                        <?php if ($general_settings->multilingual_system == 1 && count($languages) > 1) : ?>
                                            <div class="row-custom">
                                                <div class="dropdown language-dropdown">
                                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                        <i class="icon-language"></i>
                                                        <?php echo html_escape($selected_lang->name); ?>&nbsp;<span class="icon-arrow-down"></span>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <?php foreach ($languages as $language) :
                                                            $lang_url = base_url() . $language->short_form . "/";
                                                            if ($language->id == $this->general_settings->site_lang) {
                                                                $lang_url = base_url();
                                                            } ?>
                                                            <a href="<?php echo $lang_url; ?>" class="<?php echo ($language->id == $selected_lang->id) ? 'selected' : ''; ?> " class="dropdown-item">
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
<div class="mobile-footer text-center d-md-none <?php echo $this->is_webview == 'web' ? 'is_web' : 'is_mobile'; ?>">
    <div class="container">
        <div class="row">
            <div style="max-width: 20%; width: 20%">
                <a href="<?php echo lang_base_url(); ?>" class="f-btn <?php echo $this->selected_btn == "f-btn-home" ? "f-btn-selected" : ""; ?>" name="f-btn-home">
                    <div class="f-btn-icon">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.867 477.867" style="enable-background:new 0 0 477.867 477.867;" xml:space="preserve">
                            <path d="M476.996,114.074l-34.133-102.4C440.541,4.701,434.016-0.002,426.667,0H51.2c-7.349-0.002-13.874,4.701-16.196,11.674
			L0.87,114.074c-0.526,1.594-0.82,3.255-0.87,4.932c0,0.171,0,0.29,0,0.461v17.067c0.062,26.74,12.707,51.892,34.133,67.891
			c0,0.137,0,0.239,0,0.375v221.867c0,28.277,22.923,51.2,51.2,51.2h307.2c28.277,0,51.2-22.923,51.2-51.2V204.8
			c0-0.137,0-0.239,0-0.375c21.426-15.999,34.072-41.151,34.133-67.891v-17.067c0-0.171,0-0.29,0-0.461
			C477.816,117.328,477.523,115.667,476.996,114.074z M358.4,34.133h55.962l22.767,68.267H358.4V34.133z M256,34.133h68.267V102.4
			H256V34.133z M153.6,34.133h68.267V102.4H153.6V34.133z M63.505,34.133h55.962V102.4H40.738L63.505,34.133z M273.067,443.733
			H204.8V307.2h68.267V443.733z M409.6,426.667c0,9.426-7.641,17.067-17.067,17.067H307.2v-153.6
			c0-9.426-7.641-17.067-17.067-17.067h-102.4c-9.426,0-17.067,7.641-17.067,17.067v153.6H85.333
			c-9.426,0-17.067-7.641-17.067-17.067V220.16c23.951,4.917,48.857-0.799,68.267-15.667c30.466,22.376,71.934,22.376,102.4,0
			c30.466,22.376,71.934,22.376,102.4,0c19.41,14.869,44.316,20.584,68.267,15.667V426.667z M392.533,187.733
			c-14.759-0.009-28.774-6.483-38.349-17.715c-6.202-7.097-16.984-7.823-24.081-1.621c-0.576,0.503-1.118,1.045-1.621,1.621
			c-18.977,21.18-51.529,22.965-72.709,3.989c-1.401-1.256-2.733-2.587-3.989-3.989c-6.679-7.097-17.847-7.437-24.945-0.757
			c-0.26,0.245-0.513,0.497-0.757,0.757c-18.976,21.18-51.529,22.965-72.709,3.989c-1.402-1.256-2.733-2.587-3.989-3.989
			c-6.679-7.097-17.848-7.437-24.945-0.757c-0.26,0.245-0.513,0.497-0.757,0.757c-9.575,11.232-23.589,17.706-38.349,17.715
			c-28.277,0-51.2-22.923-51.2-51.2h409.6C443.733,164.81,420.81,187.733,392.533,187.733z" />
                        </svg>
                    </div>
                    <span class="f-btn-text"><?php echo trans("main"); ?></span>
                </a>
            </div>
            <!-- message -->
            <?php if (auth_check()) : ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="<?php echo lang_base_url(); ?>messages" class="f-btn <?php echo $this->selected_btn == "f-btn-message" ? "f-btn-selected" : ""; ?>" name="f-btn-message">
                        <div class="f-btn-icon" style="position: relative">
                            <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="comment-dots" class="svg-inline--fa fa-comment-dots fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M144 208c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.3-32-32-32zm112 0c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.3-32-32-32zm112 0c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.3-32-32-32zM256 32C114.6 32 0 125.1 0 240c0 47.6 19.9 91.2 52.9 126.3C38 405.7 7 439.1 6.5 439.5c-6.6 7-8.4 17.2-4.6 26S14.4 480 24 480c61.5 0 110-25.7 139.1-46.3C192 442.8 223.2 448 256 448c141.4 0 256-93.1 256-208S397.4 32 256 32zm0 368c-26.7 0-53.1-4.1-78.4-12.1l-22.7-7.2-19.5 13.8c-14.3 10.1-33.9 21.4-57.5 29 7.3-12.1 14.4-25.7 19.9-40.2l10.6-28.1-20.6-21.8C69.7 314.1 48 282.2 48 240c0-88.2 93.3-160 208-160s208 71.8 208 160-93.3 160-208 160z"></path>
                            </svg>
                            <?php if ($unread_message_count > 0) : ?>
                                <span class="span-message-count" style="position:absolute;right:20px;top:-5px"><?php echo $unread_message_count; ?></span>
                            <?php endif; ?>
                        </div>
                        <span class="f-btn-text"><?php echo trans("chat"); ?></span>
                    </a>
                </div>
            <?php else : ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal" class="f-btn <?php echo $this->selected_btn == "f-btn-message" ? "f-btn-selected" : ""; ?>" name="f-btn-message">
                        <div class="f-btn-icon">
                            <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="comment-dots" class="svg-inline--fa fa-comment-dots fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M144 208c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.3-32-32-32zm112 0c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.3-32-32-32zm112 0c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.3-32-32-32zM256 32C114.6 32 0 125.1 0 240c0 47.6 19.9 91.2 52.9 126.3C38 405.7 7 439.1 6.5 439.5c-6.6 7-8.4 17.2-4.6 26S14.4 480 24 480c61.5 0 110-25.7 139.1-46.3C192 442.8 223.2 448 256 448c141.4 0 256-93.1 256-208S397.4 32 256 32zm0 368c-26.7 0-53.1-4.1-78.4-12.1l-22.7-7.2-19.5 13.8c-14.3 10.1-33.9 21.4-57.5 29 7.3-12.1 14.4-25.7 19.9-40.2l10.6-28.1-20.6-21.8C69.7 314.1 48 282.2 48 240c0-88.2 93.3-160 208-160s208 71.8 208 160-93.3 160-208 160z"></path>
                            </svg>
                        </div>
                        <span class="f-btn-text"><?php echo trans("chat"); ?></span>
                    </a>
                </div>
            <?php endif; ?>
            <!-- sellnow -->
            <?php if (auth_check()) : ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="<?php echo lang_base_url(); ?>sell-now" class="f-btn <?php echo $this->selected_btn == "f-btn-add" ? "f-btn-selected" : ""; ?>" name="f-btn-add">
                        <div class="f-btn-icon">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 214.2 214.2" style="enable-background:new 0 0 214.2 214.2;" xml:space="preserve">
                                <path d="M194.39,55.534h-39.024l-8.733-32.756c-0.463-1.735-2.036-2.944-3.833-2.944H71.4c-1.797,0-3.37,1.209-3.833,2.944
				l-8.733,32.756H19.81C8.886,55.534,0,64.425,0,75.355v99.19c0,10.929,8.886,19.821,19.81,19.821h174.58
				c10.924,0,19.81-8.892,19.81-19.822v-99.19C214.2,64.425,205.314,55.534,194.39,55.534z M194.39,186.434H19.81
				c-6.548,0-11.877-5.332-11.877-11.889v-99.19c0-6.557,5.328-11.888,11.877-11.888h42.07c1.797,0,3.37-1.209,3.833-2.944
				l8.733-32.756h65.307l8.733,32.756c0.463,1.735,2.035,2.944,3.833,2.944h42.07c6.548,0,11.877,5.332,11.877,11.888v99.19h0.001
				C206.267,181.102,200.939,186.434,194.39,186.434z" />
                                <rect x="83.3" y="35.701" width="47.6" height="7.933" />
                                <path d="M107.1,71.401c-28.435,0-51.567,23.132-51.567,51.567s23.132,51.567,51.567,51.567c28.435,0,51.567-23.132,51.567-51.567
				S135.535,71.401,107.1,71.401z M107.1,166.6c-24.059,0-43.633-19.574-43.633-43.633c0-24.059,19.574-43.634,43.633-43.634
				c24.059,0,43.633,19.574,43.633,43.633S131.159,166.6,107.1,166.6z" />
                                <path d="M130.9,119h-19.833V99.167c0-2.19-1.776-3.967-3.967-3.967c-2.19,0-3.967,1.776-3.967,3.967V119H83.3
				c-2.19,0-3.967,1.776-3.967,3.967c0,2.191,1.776,3.967,3.967,3.967h19.833v19.833c0,2.19,1.776,3.967,3.967,3.967
				c2.19,0,3.967-1.776,3.967-3.967v-19.833H130.9c2.19,0,3.967-1.776,3.967-3.967C134.867,120.776,133.09,119,130.9,119z" />
                            </svg>
                        </div>
                        <span class="f-btn-text"><?php echo trans("post"); ?></span>
                    </a>
                </div>
            <?php else : ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal" class="f-btn <?php echo $this->selected_btn == "f-btn-add" ? "f-btn-selected" : ""; ?>" name="f-btn-add">
                        <div class="f-btn-icon">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 214.2 214.2" style="enable-background:new 0 0 214.2 214.2;" xml:space="preserve">
                                <path d="M194.39,55.534h-39.024l-8.733-32.756c-0.463-1.735-2.036-2.944-3.833-2.944H71.4c-1.797,0-3.37,1.209-3.833,2.944
				l-8.733,32.756H19.81C8.886,55.534,0,64.425,0,75.355v99.19c0,10.929,8.886,19.821,19.81,19.821h174.58
				c10.924,0,19.81-8.892,19.81-19.822v-99.19C214.2,64.425,205.314,55.534,194.39,55.534z M194.39,186.434H19.81
				c-6.548,0-11.877-5.332-11.877-11.889v-99.19c0-6.557,5.328-11.888,11.877-11.888h42.07c1.797,0,3.37-1.209,3.833-2.944
				l8.733-32.756h65.307l8.733,32.756c0.463,1.735,2.035,2.944,3.833,2.944h42.07c6.548,0,11.877,5.332,11.877,11.888v99.19h0.001
				C206.267,181.102,200.939,186.434,194.39,186.434z" />
                                <rect x="83.3" y="35.701" width="47.6" height="7.933" />
                                <path d="M107.1,71.401c-28.435,0-51.567,23.132-51.567,51.567s23.132,51.567,51.567,51.567c28.435,0,51.567-23.132,51.567-51.567
				S135.535,71.401,107.1,71.401z M107.1,166.6c-24.059,0-43.633-19.574-43.633-43.633c0-24.059,19.574-43.634,43.633-43.634
				c24.059,0,43.633,19.574,43.633,43.633S131.159,166.6,107.1,166.6z" />
                                <path d="M130.9,119h-19.833V99.167c0-2.19-1.776-3.967-3.967-3.967c-2.19,0-3.967,1.776-3.967,3.967V119H83.3
				c-2.19,0-3.967,1.776-3.967,3.967c0,2.191,1.776,3.967,3.967,3.967h19.833v19.833c0,2.19,1.776,3.967,3.967,3.967
				c2.19,0,3.967-1.776,3.967-3.967v-19.833H130.9c2.19,0,3.967-1.776,3.967-3.967C134.867,120.776,133.09,119,130.9,119z" />
                            </svg>
                        </div>
                        <span class="f-btn-text"><?php echo trans("post"); ?></span>
                    </a>
                </div>
            <?php endif; ?>
            <!-- notifications -->
            <?php if (auth_check()) : ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="<?php echo lang_base_url(); ?>notifications" class="f-btn <?php echo $this->selected_btn == "f-btn-notification" ? "f-btn-selected" : ""; ?>" name="f-btn-notification">
                        <div class="f-btn-icon" style="postion: relative">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 479.619 479.619" style="enable-background:new 0 0 479.619 479.619;" xml:space="preserve">
                                <path d="M475.855,336.376c-0.441-2.809-1.116-5.577-2.017-8.275c-8.621-23.991-33.203-38.346-58.334-34.065
			c-8.313,1.309-16.114-4.368-17.425-12.681l-12.646-80.913c-10.379-68.459-59.835-124.522-126.464-143.36
			c-6.06-37.088-41.038-62.242-78.127-56.182c-36.598,5.98-61.669,40.163-56.376,76.867
			c-57.432,36.346-87.748,103.365-77.124,170.496l13.551,86.118c1.241,8.297-4.405,16.054-12.68,17.425
			c-25.234,3.641-44.226,24.849-45.073,50.33c-0.292,28.275,22.393,51.434,50.668,51.726c0.177,0.002,0.355,0.003,0.532,0.003
			c2.669-0.002,5.333-0.207,7.97-0.614l52.531-8.26c18.274,32.622,59.533,44.254,92.155,25.98
			c17.231-9.652,29.388-26.347,33.285-45.709L433.22,394.9C461.154,390.513,480.243,364.311,475.855,336.376z M186.777,36.313
			c1.779-0.277,3.576-0.42,5.376-0.427c11.441,0.061,22.098,5.822,28.416,15.36h-0.819c-6.365-0.192-12.737-0.009-19.081,0.546
			c-6.681,0.638-13.32,1.664-19.883,3.072c-1.417,0.29-2.816,0.7-4.216,1.041c-5.376,1.263-10.65,2.748-15.821,4.506
			c-0.512,0.154-1.041,0.239-1.553,0.427C162.797,47.969,173.576,38.384,186.777,36.313z M173.806,445.486
			c-7.233,0.008-14.277-2.314-20.087-6.622l47.787-7.492C195.075,440.252,184.77,445.503,173.806,445.486z M439.824,353.207
			c-2.613,4.291-6.983,7.213-11.947,7.987L222.31,393.518l-99.891,15.718l-65.365,10.24c-4.952,0.808-10.006-0.63-13.79-3.925
			c-3.862-3.293-6.057-8.135-5.99-13.21c0.739-8.753,7.526-15.782,16.247-16.828c26.88-4.309,45.234-29.518,41.079-56.422
			l-13.534-86.118c-8.864-56.814,18.723-113.111,69.052-140.919c0.296-0.099,0.586-0.213,0.87-0.341
			c16.334-8.85,34.302-14.275,52.804-15.94c5.607-0.493,11.24-0.601,16.862-0.324l2.799,0.137
			c5.816,0.352,11.602,1.081,17.323,2.185c0.188,0,0.358,0,0.546,0c57.748,12.493,101.701,59.479,110.319,117.931l12.732,80.913
			c4.232,26.931,29.49,45.336,56.422,41.114c8.608-1.681,17.214,2.907,20.617,10.991
            C443.075,343.541,442.493,348.857,439.824,353.207z" /></svg>
		                    <?php $notification_count = get_notification_count();
                            if ($notification_count > 0) : ?>
                                <span class="notification"><?php echo $notification_count; ?></span>
                            <?php endif; ?>
                        </div>
                        <span class="f-btn-text"><?php echo trans("notification"); ?></span>
                    </a>
                </div>
            <?php else : ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal" class="f-btn <?php echo $this->selected_btn == "f-btn-notification" ? "f-btn-selected" : ""; ?>" name="f-btn-notification">
                        <div class="f-btn-icon">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 479.619 479.619" style="enable-background:new 0 0 479.619 479.619;" xml:space="preserve">
                                <path d="M475.855,336.376c-0.441-2.809-1.116-5.577-2.017-8.275c-8.621-23.991-33.203-38.346-58.334-34.065
			c-8.313,1.309-16.114-4.368-17.425-12.681l-12.646-80.913c-10.379-68.459-59.835-124.522-126.464-143.36
			c-6.06-37.088-41.038-62.242-78.127-56.182c-36.598,5.98-61.669,40.163-56.376,76.867
			c-57.432,36.346-87.748,103.365-77.124,170.496l13.551,86.118c1.241,8.297-4.405,16.054-12.68,17.425
			c-25.234,3.641-44.226,24.849-45.073,50.33c-0.292,28.275,22.393,51.434,50.668,51.726c0.177,0.002,0.355,0.003,0.532,0.003
			c2.669-0.002,5.333-0.207,7.97-0.614l52.531-8.26c18.274,32.622,59.533,44.254,92.155,25.98
			c17.231-9.652,29.388-26.347,33.285-45.709L433.22,394.9C461.154,390.513,480.243,364.311,475.855,336.376z M186.777,36.313
			c1.779-0.277,3.576-0.42,5.376-0.427c11.441,0.061,22.098,5.822,28.416,15.36h-0.819c-6.365-0.192-12.737-0.009-19.081,0.546
			c-6.681,0.638-13.32,1.664-19.883,3.072c-1.417,0.29-2.816,0.7-4.216,1.041c-5.376,1.263-10.65,2.748-15.821,4.506
			c-0.512,0.154-1.041,0.239-1.553,0.427C162.797,47.969,173.576,38.384,186.777,36.313z M173.806,445.486
			c-7.233,0.008-14.277-2.314-20.087-6.622l47.787-7.492C195.075,440.252,184.77,445.503,173.806,445.486z M439.824,353.207
			c-2.613,4.291-6.983,7.213-11.947,7.987L222.31,393.518l-99.891,15.718l-65.365,10.24c-4.952,0.808-10.006-0.63-13.79-3.925
			c-3.862-3.293-6.057-8.135-5.99-13.21c0.739-8.753,7.526-15.782,16.247-16.828c26.88-4.309,45.234-29.518,41.079-56.422
			l-13.534-86.118c-8.864-56.814,18.723-113.111,69.052-140.919c0.296-0.099,0.586-0.213,0.87-0.341
			c16.334-8.85,34.302-14.275,52.804-15.94c5.607-0.493,11.24-0.601,16.862-0.324l2.799,0.137
			c5.816,0.352,11.602,1.081,17.323,2.185c0.188,0,0.358,0,0.546,0c57.748,12.493,101.701,59.479,110.319,117.931l12.732,80.913
			c4.232,26.931,29.49,45.336,56.422,41.114c8.608-1.681,17.214,2.907,20.617,10.991
			C443.075,343.541,442.493,348.857,439.824,353.207z" /></svg>
                        </div>
                        <span class="f-btn-text"><?php echo trans("notification"); ?></span>
                    </a>
                </div>
            <?php endif; ?>
            <!-- account -->
            <?php if (auth_check()) : ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="<?php echo lang_base_url(); ?>account/<?php echo $this->auth_user->slug; ?>" class="f-btn <?php echo $this->selected_btn == "f-btn-account" ? "f-btn-selected" : ""; ?>" name="f-btn-account">
                        <div style="height: 22px;">
                            <?php $profile = get_user($this->auth_user->id); ?>
                            <img src="<?php echo get_user_avatar($profile); ?>" alt="User" style="width: 25px;border-radius: 50%;height: 23px;margin-top: -3px;">
                        </div>
                        <span class="f-btn-text"><?php echo trans("profile"); ?></span>
                    </a>
                </div>
            <?php else : ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal" class="f-btn <?php echo $this->selected_btn == "f-btn-account" ? "f-btn-selected" : ""; ?>" name="f-btn-account">
                        <div class="f-btn-icon">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                <path d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256c2.581,0,5.099-0.32,7.68-0.384l0.896,0.171
                                    c0.704,0.128,1.387,0.213,2.091,0.213c0.981,0,1.984-0.128,2.923-0.405l1.195-0.341C405.056,503.509,512,392.171,512,256
                                    C512,114.837,397.163,0,256,0z M408.149,434.325c-1.003-3.264-3.264-6.016-6.549-7.104l-56.149-18.688
                                    c-19.605-8.171-28.736-39.552-30.869-52.139c14.528-13.504,27.947-33.621,27.947-51.797c0-6.187,1.749-8.555,1.408-8.619
                                    c3.328-0.832,6.037-3.2,7.317-6.379c1.045-2.624,10.24-26.069,10.24-41.877c0-0.875-0.107-1.749-0.32-2.581
                                    c-1.344-5.355-4.48-10.752-9.173-14.123v-49.664c0-30.699-9.344-43.563-19.243-51.008c-2.219-15.275-18.581-44.992-76.757-44.992
                                    c-59.477,0-96,55.915-96,96v49.664c-4.693,3.371-7.829,8.768-9.173,14.123c-0.213,0.853-0.32,1.728-0.32,2.581
                                    c0,15.808,9.195,39.253,10.24,41.877c1.28,3.179,2.965,5.205,6.293,6.037c0.683,0.405,2.432,2.795,2.432,8.96
                                    c0,18.176,13.419,38.293,27.947,51.797c-2.112,12.565-11.157,43.925-30.144,51.861l-56.896,18.965
                                    c-3.264,1.088-5.611,3.776-6.635,7.04C53.376,391.189,21.291,327.317,21.291,256c0-129.387,105.28-234.667,234.667-234.667
                                    S490.624,126.613,490.624,256C490.667,327.339,458.56,391.253,408.149,434.325z" />
                            </svg>
                        </div>
                        <span class="f-btn-text"><?php echo trans("login"); ?></span>
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
        <span class="text-white textcat-header text-center"><?php echo trans("contact"); ?></span>
    </div>
    <div class="text-left" style="padding-top: 85px;">
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

                        <?php if ($settings->contact_phone) : ?>
                            <div class="col-12 contact-item">
                                <i class="icon-phone" aria-hidden="true"></i>
                                <?php echo html_escape($settings->contact_phone); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($settings->contact_email) : ?>
                            <div class="col-12 contact-item">
                                <i class="icon-envelope" aria-hidden="true"></i>
                                <?php echo html_escape($settings->contact_email); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($settings->contact_address) : ?>
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

<?php if (!isset($_COOKIE["modesy_cookies_warning"]) && $settings->cookies_warning) : ?>
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


<?php if (!empty($this->session->userdata('mds_send_email_data'))) : ?>
    <script>
        $(document).ready(function() {
            var data = JSON.parse(<?php echo json_encode($this->session->userdata("mds_send_email_data")); ?>);
            if (data) {
                data[csfr_token_name] = $.cookie(csfr_cookie_name);
                data['lang_folder'] = lang_folder;
                data['form_lang_base_url'] = '<?php echo lang_base_url(); ?>';
                $.ajax({
                    type: "POST",
                    url: base_url + "ajax_controller/send_email",
                    data: data,
                    success: function(response) {}
                });
            }
        });
    </script>
<?php endif;
$this->session->unset_userdata('mds_send_email_data'); ?>

<?php if (!empty($this->session->userdata('mds_send_email_to_user'))) : ?>
    <script>
        $(document).ready(function() {
            var data = JSON.parse(<?php echo json_encode($this->session->userdata("mds_send_email_to_user")); ?>);
            if (data) {
                data[csfr_token_name] = $.cookie(csfr_cookie_name);
                data['lang_folder'] = lang_folder;
                data['form_lang_base_url'] = '<?php echo lang_base_url(); ?>';
                $.ajax({
                    type: "POST",
                    url: base_url + "ajax_controller/send_email",
                    data: data,
                    success: function(response) {}
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


<script>
    $('<input>').attr({
        type: 'hidden',
        name: 'form_lang_base_url',
        value: '<?php echo lang_base_url(); ?>'
    }).appendTo('form');
</script>
<script>
    $('<input>').attr({
        type: 'hidden',
        name: 'lang_folder',
        value: '<?php echo $this->selected_lang->folder_name; ?>'
    }).appendTo('form');
</script>
<script>
    var base_url = '<?php echo base_url(); ?>';
    var lang_base_url = '<?php echo lang_base_url(); ?>';
    var thousands_separator = '<?php echo $this->thousands_separator; ?>';
    var lang_folder = '<?php echo $this->selected_lang->folder_name; ?>';
    var lang_id = '<?php echo $this->selected_lang->id; ?>';
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
<script>
    window.swiper = new Swiper('.product-slider-container .swiper-container', {
        pagination: {
            el: '.swiper-pagination',
            type: 'fraction',
        },
        loop: true,
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

    function recaptcha_callback() {
        console.log("grecaptcha isee ready!");
    }
</script>

<style>
    i,
    span[class*='icon'] {
        visibility: visible;
    }
</style>
</body>

</html>