<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!--user profile info-->
<div class="row align-items-center">
    <div class="profile-details__left col-sm-3 col-md-3">
        <div class="profile__image">
            <img src="<?php echo get_user_avatar($user); ?>" alt="<?php echo get_shop_name($user); ?>" class="sys-border sys-shadow">
        </div>
        <div class="profile-name__wrapper hidden-md-up">
            <div class="profile-name">
                <span class="text-truncate"><?php echo get_shop_name($user); ?></span>
                <?php if ($user->email_status || $user->role == 'admin') : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24.645" height="27.897" viewBox="0 0 24.645 27.897" style="height: 18px;">
                        <g id="verified" transform="translate(-94.196 -255.805)">
                            <path id="icons8-shield" d="M15.334,27.9l-.245-.114C14.966,27.728,3,22,3,4.943V4.492l.44-.1a30.311,30.311,0,0,0,8.382-3.14A7.83,7.83,0,0,1,15.323,0a7.83,7.83,0,0,1,3.5,1.256A30.311,30.311,0,0,0,27.206,4.4l.44.1v.451c0,16.5-11.949,22.768-12.069,22.832Z" transform="translate(91.196 255.805)" fill="#18a94c" />
                            <path id="Path_45" data-name="Path 45" d="M55.761,48.434a1.453,1.453,0,0,1-.416,1.012l-4.01,4.01-1.016,1.016a1.435,1.435,0,0,1-2.029,0l-1.016-1.016L45.416,51.6a1.436,1.436,0,1,1,2.03-2.03L49.3,51.425l4.01-4.01a1.431,1.431,0,0,1,2.446,1.019Z" transform="translate(56.766 218.301)" fill="#fff" />
                        </g>
                    </svg>
                <?php endif; ?>
            </div>
            <span class="last-seen <?php echo (is_user_online($user->last_seen)) ? 'last-seen-online' : ''; ?>"> <i class="icon-circle"></i> <?php echo trans("last_seen"); ?>&nbsp;<?php echo time_ago($user->last_seen); ?></span>
            <div class="row-custom">
                <?php $rew_count = get_user_review_count($user->id); ?>
                <!--stars-->
                <?php $this->load->view('partials/_review_stars', ['review' => get_user_rating($user->id)]); ?>
                &nbsp;<span>(<?php echo $rew_count; ?>)</span>
            </div>
            <?php if (!empty($user->email) && $user->show_email == 1) : ?>
                <div class="row-custom">
                    <span class="info"><i class="icon-envelope"></i>&nbsp;<?php echo html_escape($user->email); ?></span>
                </div>
            <?php endif; ?>
            <?php if (!empty(get_location($user)) && $user->show_location == 1) : ?>
                <div class="row-custom">
                    <span class="info"><i class="icon-map-marker"></i><?php echo get_location($user); ?></span>
                </div>
            <?php endif; ?>
            <div class="profile-details__row">
                <span class="info">
                    <?php if (!empty($user->phone_number) && $user->show_phone == 1) : ?>
                        <i class="icon-phone"></i>
                        <a href="tel:<?php echo html_escape($user->phone_number); ?>" class="phone_number"><?php echo html_escape($user->phone_number); ?></a>
                    <?php endif; ?>
                </span>
                <?php
                $matches = explode("/", $_SERVER['REQUEST_URI']);
                $last_word = $matches[1];
                if ($this->auth_check && user()->id == $user->id) {
                ?>
                    <a href="<?php echo lang_base_url(); ?>settings" style="background: #fff;padding: 3px 5px;border-radius: 10px;color: #000;">
                        <i class="icon-settings"></i> <?php echo trans("settings"); ?>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="profile-details__right col-sm-9 col-md-9">
        <div class="profile-name__wrapper">
            <div class="profile-name">
                <span><?php echo get_shop_name($user); ?></span>
                <?php if ($user->email_status || $user->role == 'admin') : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24.645" height="27.897" viewBox="0 0 24.645 27.897" style="height: 18px;">
                        <g id="verified" transform="translate(-94.196 -255.805)">
                            <path id="icons8-shield" d="M15.334,27.9l-.245-.114C14.966,27.728,3,22,3,4.943V4.492l.44-.1a30.311,30.311,0,0,0,8.382-3.14A7.83,7.83,0,0,1,15.323,0a7.83,7.83,0,0,1,3.5,1.256A30.311,30.311,0,0,0,27.206,4.4l.44.1v.451c0,16.5-11.949,22.768-12.069,22.832Z" transform="translate(91.196 255.805)" fill="#18a94c" />
                            <path id="Path_45" data-name="Path 45" d="M55.761,48.434a1.453,1.453,0,0,1-.416,1.012l-4.01,4.01-1.016,1.016a1.435,1.435,0,0,1-2.029,0l-1.016-1.016L45.416,51.6a1.436,1.436,0,1,1,2.03-2.03L49.3,51.425l4.01-4.01a1.431,1.431,0,0,1,2.446,1.019Z" transform="translate(56.766 218.301)" fill="#fff" />
                        </g>
                    </svg>
                <?php endif; ?>
            </div>
            <span class="last-seen <?php echo (is_user_online($user->last_seen)) ? 'last-seen-online' : ''; ?>"> <i class="icon-circle"></i> <?php echo trans("last_seen"); ?>&nbsp;<?php echo time_ago($user->last_seen); ?></span>
        </div>
        <div class="profile-details__row">
            <div class="profile-row__left hidden-md-down">
                <?php $rew_count = get_user_review_count($user->id); ?>
                <!--stars-->
                <?php $this->load->view('partials/_review_stars', ['review' => get_user_rating($user->id)]); ?>
                &nbsp;<span>(<?php echo $rew_count; ?>)</span>
            </div>
        </div>

        <div class="row-custom user-contact hidden-md-down">
            <span class="info"><?php echo trans("member_since"); ?>&nbsp;<?php echo helper_date_format($user->created_at); ?></span>
            <?php if (!empty($user->phone_number) && $user->show_phone == 1) : ?>
                <span class="info">
                    <i class="icon-phone"></i>
                    <a href="javascript:void(0)" id="show_phone_number"><?php echo trans("show"); ?></a>
                    <a href="tel:<?php echo html_escape($user->phone_number); ?>" class="display-none phone_number"><?php echo html_escape($user->phone_number); ?></a>
                </span>
            <?php endif; ?>
            <?php if (!empty($user->email) && $user->show_email == 1) : ?>
                <span class="info"><i class="icon-envelope"></i><?php echo html_escape($user->email); ?></span>
            <?php endif; ?>
            <?php if (!empty(get_location($user)) && $user->show_location == 1) : ?>
                <span class="info"><i class="icon-map-marker"></i><?php echo get_location($user); ?></span>
            <?php endif; ?>
        </div>
        <div class="social hidden-md-down">
            <ul>
                <?php if (!empty($user->facebook_url)) : ?>
                    <li><a href="<?php echo $user->facebook_url; ?>" target="_blank"><i class="icon-facebook"></i></a></li>
                <?php endif; ?>
                <?php if (!empty($user->twitter_url)) : ?>
                    <li><a href="<?php echo $user->twitter_url; ?>" target="_blank"><i class="icon-twitter"></i></a></li>
                <?php endif; ?>
                <?php if (!empty($user->instagram_url)) : ?>
                    <li><a href="<?php echo $user->instagram_url; ?>" target="_blank"><i class="icon-instagram"></i></a></li>
                <?php endif; ?>
                <?php if (!empty($user->pinterest_url)) : ?>
                    <li><a href="<?php echo $user->pinterest_url; ?>" target="_blank"><i class="icon-pinterest"></i></a></li>
                <?php endif; ?>
                <?php if (!empty($user->linkedin_url)) : ?>
                    <li><a href="<?php echo $user->linkedin_url; ?>" target="_blank"><i class="icon-linkedin"></i></a></li>
                <?php endif; ?>
                <?php if (!empty($user->vk_url)) : ?>
                    <li><a href="<?php echo $user->vk_url; ?>" target="_blank"><i class="icon-vk"></i></a></li>
                <?php endif; ?>
                <?php if (!empty($user->youtube_url)) : ?>
                    <li><a href="<?php echo $user->youtube_url; ?>" target="_blank"><i class="icon-youtube"></i></a></li>
                <?php endif; ?>
                <?php if ($this->general_settings->rss_system == 1 && $user->show_rss_feeds == 1 && get_user_products_count($user->slug) > 0) : ?>
                    <li><a href="<?php echo lang_base_url() . "rss/seller/" . $user->slug; ?>" target="_blank"><i class="icon-rss"></i></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>