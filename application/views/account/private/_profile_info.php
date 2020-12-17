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
            <div class="profile-row__left">
                <?php $rew_count = get_user_review_count($user->id); ?>
                <!--stars-->
                <?php $this->load->view('partials/_review_stars', ['review' => get_user_rating($user->id)]); ?>
                &nbsp;<span>(<?php echo $rew_count; ?>)</span>
            </div>
            <?php if (auth_check()) : ?>
                <?php if (user()->id != $user->id) : ?>
                    <div class="profile-row__right">
                        <button class="btn btn-md btn-orange" data-toggle="modal" data-target="#messageModal"><i class="icon-envelope"></i><?php echo trans("ask_question") ?></button>
                        <?php echo form_open('profile_controller/follow_unfollow_user', ['class' => 'form-inline']); ?>
                        <input type="hidden" name="following_id" value="<?php echo $user->id; ?>">
                        <input type="hidden" name="follower_id" value="<?php echo user()->id; ?>">
                        <?php if (is_user_follows($user->id, user()->id)) : ?>
                            <button class="btn btn-md btn-orange"><i class="icon-user-minus"></i><?php echo trans("unfollow"); ?></button>
                        <?php else : ?>
                            <button class="btn btn-md btn-orange"><i class="icon-user-plus"></i><?php echo trans("follow"); ?></button>
                        <?php endif; ?>
                        <?php echo form_close(); ?>
                    </div>
                <?php endif; ?>
            <?php else : ?>
                <div class="profile-row__right">
                    <a href="<?php echo lang_base_url() . 'login'; ?>" class="btn btn-md btn-orange"><i class="icon-envelope"></i><?php echo trans("ask_question") ?></a>
                    <a href="<?php echo lang_base_url() . 'login'; ?>" class="btn btn-md btn-orange"><i class="icon-user-plus"></i><?php echo trans("follow"); ?></a>
                </div>
            <?php endif; ?>
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

        <div class="profile-mobile-tabs">
            <?php if (is_multi_vendor_active()) : ?>
                <?php if ($user->role == 'admin' || $user->role == 'vendor') : ?>
                    <a class="btn-outline-gray <?php echo ($active_tab == 'products') ? 'active' : ''; ?>" href="<?php echo lang_base_url() . "profile/" . $user->slug; ?>">
                        <div class="count">&nbsp;(<?php echo get_user_products_count($user->slug); ?>)</div>
                        <span><?php echo trans("products"); ?></span>
                    </a>
                <?php endif; ?>
            <?php endif; ?>
            <a class="btn-outline-gray <?php echo ($active_tab == 'followers') ? 'active' : ''; ?>" href="<?php echo lang_base_url() . "profile/followers/" . $user->slug; ?>">
                <div class="count">&nbsp;(<?php echo get_followers_count($user->id); ?>)</div>
                <span><?php echo trans("followers"); ?></span>
            </a>
            <?php if (is_multi_vendor_active()) : ?>
                <?php if ($user->role == 'admin' || $user->role == 'vendor') : ?>
                    <a class="btn-outline-gray <?php echo ($active_tab == 'reviews') ? 'active' : ''; ?>" href="<?php echo lang_base_url() . "profile/reviews/" . $user->slug; ?>">
                        <div class="count">&nbsp;(<?php echo get_user_review_count($user->id); ?>)</div>
                        <span><?php echo trans("reviews"); ?></span>
                    </a>
                <?php endif; ?>
            <?php endif; ?>
            <a class="btn-outline-gray <?php echo ($active_tab == 'seller_info') ? 'active' : ''; ?>" href="<?php echo lang_base_url() . "profile/seller_info/" . $user->slug; ?>">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                        <path fill="currentColor" id="info" d="M10,2a8,8,0,1,0,8,8A8.012,8.012,0,0,0,10,2Zm0,1.6A6.4,6.4,0,1,1,3.6,10,6.388,6.388,0,0,1,10,3.6ZM9.2,6V7.6h1.6V6Zm0,3.2V14h1.6V9.2Z" transform="translate(-2 -2)" />
                    </svg>
                </div>
                <span><?php echo trans("seller_info"); ?></span>
            </a>
        </div>
    </div>
</div>