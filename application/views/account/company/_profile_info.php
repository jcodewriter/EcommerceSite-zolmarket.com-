<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!--user profile info-->
<div class="row align-items-center">
    <div class="profile-details__company_left col-sm-3 col-md-3">
        <div class="profile__image" style="position: relative">
            <img src="<?php echo get_user_avatar($user); ?>" alt="<?php echo get_shop_name($user); ?>" class="sys-border sys-shadow">
            <div class="profile-company__info hidden-md-up">
                <span class="last-seen <?php echo (is_user_online($user->last_seen)) ? 'last-seen-online' : ''; ?>"> <i class="icon-circle"></i> <?php echo trans("last_seen"); ?>&nbsp;<?php echo time_ago($user->last_seen); ?></span>
                <div class="company__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="33.464" height="28.316" viewBox="0 0 33.464 28.316">
                        <defs>
                            <linearGradient id="linear-gradient" x1="0.5" y1="0.046" x2="0.5" y2="1.01" gradientUnits="objectBoundingBox">
                                <stop offset="0" stop-color="#ea2251" />
                                <stop offset="1" stop-color="#e6abff" />
                            </linearGradient>
                            <linearGradient id="linear-gradient-4" y1="-8.5" y2="2.64" xlink:href="#linear-gradient" />
                            <linearGradient id="linear-gradient-5" y1="-2" y2="1.713" xlink:href="#linear-gradient" />
                        </defs>
                        <g id="Store" transform="translate(-6 -10)">
                            <path id="Path_49" data-name="Path 49" d="M33.435,11v8.366a3.218,3.218,0,0,1-6.435,0V11Z" transform="translate(-7.486 -0.356)" fill="url(#linear-gradient)" />
                            <path id="Path_50" data-name="Path 50" d="M47,19.366a3.221,3.221,0,0,0,3.866,3.154,3.308,3.308,0,0,0,2.569-3.292v-.033a5.159,5.159,0,0,0-.461-2.131L50.9,12.508A2.575,2.575,0,0,0,48.561,11H47Z" transform="translate(-14.615 -0.356)" fill="url(#linear-gradient)" />
                            <path id="Path_51" data-name="Path 51" d="M13.435,11H11.875a2.575,2.575,0,0,0-2.343,1.508l-2.07,4.554A5.162,5.162,0,0,0,7,19.195v.033a3.311,3.311,0,0,0,2.9,3.341,3.219,3.219,0,0,0,3.534-3.2Z" transform="translate(-0.356 -0.356)" fill="url(#linear-gradient)" />
                            <path id="Path_52" data-name="Path 52" d="M24,44h1.287v2.574H24Z" transform="translate(-6.416 -12.12)" fill="url(#linear-gradient-4)" />
                            <path id="Path_53" data-name="Path 53" d="M33.287,41.722H42.3a1.288,1.288,0,0,0,1.287-1.287V35.287A1.288,1.288,0,0,0,42.3,34h-9.01A1.288,1.288,0,0,0,32,35.287v5.148A1.288,1.288,0,0,0,33.287,41.722Zm0-6.435H42.3v5.148h-9.01Z" transform="translate(-9.268 -8.555)" fill="url(#linear-gradient-5)" />
                            <path id="Path_54" data-name="Path 54" d="M36.89,36.385V22.644a3.986,3.986,0,0,0,2.574-3.806,5.735,5.735,0,0,0-.52-2.4l-2.07-4.554A3.221,3.221,0,0,0,33.946,10H11.518A3.223,3.223,0,0,0,8.59,11.886l-2.07,4.554A5.784,5.784,0,0,0,6,18.871,4.022,4.022,0,0,0,8.574,22.64V36.385a1.909,1.909,0,0,0,.118.644H8v1.287H37.464V37.029h-.693A1.909,1.909,0,0,0,36.89,36.385ZM20.158,28.019H15.01V26.732h5.148Zm0-2.574H15.01a1.288,1.288,0,0,0-1.287,1.287v7.722H9.861V22.869a3.813,3.813,0,0,0,3.216-1.732,3.856,3.856,0,0,0,6.437,0,3.856,3.856,0,0,0,6.435,0,3.855,3.855,0,0,0,6.436,0A3.83,3.83,0,0,0,35.6,22.87V34.454H21.445V26.732A1.288,1.288,0,0,0,20.158,25.445ZM35.7,12.419l2.07,4.554a4.506,4.506,0,0,1,.4,1.9,2.651,2.651,0,0,1-2.049,2.661,2.578,2.578,0,0,1-3.1-2.523V11.287h.917A1.932,1.932,0,0,1,35.7,12.419Zm-3.961-1.132V19.01a2.574,2.574,0,0,1-5.148,0V11.287ZM25.306,19.01a2.574,2.574,0,0,1-5.148,0V11.287h5.148Zm-6.435-7.722V19.01a2.574,2.574,0,0,1-5.148,0V11.287ZM7.287,18.838a4.463,4.463,0,0,1,.4-1.864l2.07-4.555a1.933,1.933,0,0,1,1.757-1.131h.917V19.01a2.575,2.575,0,0,1-2.83,2.563A2.681,2.681,0,0,1,7.287,18.838ZM10.5,37.029a.644.644,0,0,1-.644-.644v-.644h3.861v1.287Zm4.5,0V29.306h5.148v7.722Zm6.435,0V35.741H35.6v.644a.644.644,0,0,1-.644.644Z" fill="#f4f4f4" />
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <div class="profile-details__company_right col-sm-9 col-md-9">
        <div class="row-custom profile__name">
            <h1 class="username" style="white-space: nowrap;text-overflow: ellipsis;max-width: 95% !important;display: block;overflow: hidden;"><?php echo get_shop_name($user); ?></h1>
            <?php if ($user->email_status || $user->role == 'admin') : ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24.645" height="27.897" viewBox="0 0 24.645 27.897" style="height: 18px;">
                    <g id="verified" transform="translate(-94.196 -255.805)">
                        <path id="icons8-shield" d="M15.334,27.9l-.245-.114C14.966,27.728,3,22,3,4.943V4.492l.44-.1a30.311,30.311,0,0,0,8.382-3.14A7.83,7.83,0,0,1,15.323,0a7.83,7.83,0,0,1,3.5,1.256A30.311,30.311,0,0,0,27.206,4.4l.44.1v.451c0,16.5-11.949,22.768-12.069,22.832Z" transform="translate(91.196 255.805)" fill="#18a94c" />
                        <path id="Path_45" data-name="Path 45" d="M55.761,48.434a1.453,1.453,0,0,1-.416,1.012l-4.01,4.01-1.016,1.016a1.435,1.435,0,0,1-2.029,0l-1.016-1.016L45.416,51.6a1.436,1.436,0,1,1,2.03-2.03L49.3,51.425l4.01-4.01a1.431,1.431,0,0,1,2.446,1.019Z" transform="translate(56.766 218.301)" fill="#fff" />
                    </g>
                </svg>
            <?php endif; ?>
        </div>
        <div class="row-custom hidden-md-down">
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