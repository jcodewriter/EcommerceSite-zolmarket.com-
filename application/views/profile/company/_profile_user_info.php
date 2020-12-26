<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!--user profile info-->
<div class="row-custom">
    <div class="profile-details">
        <div class="leftdesktop">
            <div class="only_on_mobile sys-border sys-shadow" style="width: calc(100% + 30px);height: 200px;margin-bottom: 10px;margin-left: -15px;background: url('<?php echo get_user_avatar($user); ?>');background-position: center;background-repeat: no-repeat;background-color: #282828;background-size: cover;">
                <?php
                $matches = explode("/", $_SERVER['REQUEST_URI']);
                $last_word = $matches[1];
                if ($this->auth_check && user()->id == $user->id) {
                ?>
                    <a href="<?php echo lang_base_url(); ?>settings" style="position: absolute;top: 14px;right: 0;background: #fff;padding: 3px 5px;border-radius: 10px;color: #000;">
                        <i class="icon-settings"></i> <?php echo trans("settings"); ?>
                    </a>
                <?php } ?>
            </div>
            <img class="img-fluid  only_on_dadeesktop sys-border sys-shadow" src="<?php echo get_user_avatar($user); ?>" style="width:400px;height:200px;object-fit:cover;border-radius:5px;">
            <div class="only_on_mobile">
                <div class="row-custom profile-buttons" style="position: absolute;bottom: 15px;right: -15px;">
                    <div class="buttons">
                        <?php if (auth_check()) : ?>
                            <?php if (user()->id != $user->id) : ?>
                                <button class="btn btn-md btn-outline-gray" data-toggle="modal" style="background-color:#fff!important" data-target="#messageModal"><i class="icon-envelope"></i><?php echo trans("ask_question") ?></button>

                                <!--form follow-->
                                <?php echo form_open('profile_controller/follow_unfollow_user', ['class' => 'form-inline']); ?>
                                <input type="hidden" name="following_id" value="<?php echo $user->id; ?>">
                                <input type="hidden" name="follower_id" value="<?php echo user()->id; ?>">
                                <?php if (is_user_follows($user->id, user()->id)) : ?>
                                    <button class="btn btn-md btn-outline-gray" style="background-color:#fff!important"><i class="icon-user-minus"></i><?php echo trans("unfollow"); ?></button>
                                <?php else : ?>
                                    <button class="btn btn-md btn-outline-gray" style="background-color:#fff!important"><i class="icon-user-plus"></i><?php echo trans("follow"); ?></button>
                                <?php endif; ?>
                                <?php echo form_close(); ?>
                            <?php endif; ?>
                        <?php else : ?>
                            <a href="<?php echo lang_base_url() . 'login'; ?>" class="btn btn-md btn-outline-gray" style="background-color:#fff!important"><i class="icon-envelope"></i><?php echo trans("ask_question") ?></a>
                            <a href="<?php echo lang_base_url() . 'login'; ?>" class="btn btn-md btn-outline-gray" style="background-color:#fff!important"><i class="icon-user-plus"></i><?php echo trans("follow"); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="right" style="position: relative;">
            <div class="row-custom row-profile-username">
                <?php if (is_arabic(get_shop_name($user))) : ?>
                    <h1 class="username" style="white-space: nowrap;text-overflow: ellipsis;max-width: 95% !important;display: block;overflow: hidden;"><?php echo get_shop_name($user); ?></h1>
                    <?php if ($user->email_status || $user->role == 'admin') : ?>
                        <img src="<?php echo base_url(); ?>assets/img/confirm.png" style="width:15px;margin: 3px 0 0 1px;" />
                    <?php endif; ?>
                <?php else : ?>
                    <?php if ($user->email_status || $user->role == 'admin') : ?>
                        <img src="<?php echo base_url(); ?>assets/img/confirm.png" style="width:15px;margin: 3px 15px 0 1px;" />
                    <?php endif; ?>
                    <h1 class="username" style="white-space: nowrap;font-size:19px;text-overflow: ellipsis;max-width: 89% !important;display: block;overflow: hidden;direction:rtl;"><?php echo get_shop_name($user); ?></h1>
                <?php endif; ?>
            </div>
            <?php if (empty($user_plan)) : ?>
                <?php if ($general_settings->user_reviews == 1) : ?>
                    <div class="row-custom only_on_mobile">
                        <p class="p-last-seen" style="position: absolute;bottom: -8px;right: 5px;top:7px">
                            <span class="last-seen <?php echo (is_user_online($user->last_seen)) ? 'last-seen-online' : ''; ?>"> <i class="icon-circle"></i> <?php echo trans("last_seen"); ?>&nbsp;<?php echo time_ago($user->last_seen); ?></span>
                        </p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <div class="row-custom only_on_dadeesktop">
                <p class="p-last-seen">
                    <span class="last-seen <?php echo (is_user_online($user->last_seen)) ? 'last-seen-online' : ''; ?>"> <i class="icon-circle"></i> <?php echo trans("last_seen"); ?>&nbsp;<?php echo time_ago($user->last_seen); ?></span>
                </p>
            </div>
            <?php if (!empty($user_plan)) : ?>
                <div style="font-size: 12px">
                    <p style="font-size: 12px;font-weight: 600; margin-bottom: 0"><?= trans("plan_expiration_date"); ?></p>
                    <?php if ($user_plan->is_unlimited_time) : ?>
                        <span class="text-success"><?= trans("unlimited"); ?></span>
                    <?php else : ?>
                        <span ><?= formatted_date($user_plan->plan_end_date); ?>&nbsp;<span class="text-danger">(<?= ucfirst(trans("days_left")); ?>:&nbsp;<?= $days_left < 0 ? 0 : $days_left; ?>)</span></span>
                    <?php endif; ?>
                </div>
            <?php else : ?>
                <div class="row-custom user-contact" style="margin-bottom: 0;">
                    <?php if ($this->selected_lang->ckeditor_lang == 'ar') : ?>
                        <span class="info"><img src="<?php echo base_url() . 'assets/img/user_confirm.png'; ?>" alt="" style="margin-right: 8px;" /><?php echo trans("member_since"); ?>&nbsp;<?php echo helper_date_format($user->created_at); ?></span>
                        <?php if (!empty($user->phone_number)) : ?>
                            <span class="info"><i class="icon-phone"></i>
                                <a href="javascript:void(0)" id="show_phone_number"><?php echo trans("show"); ?></a>
                                <a href="tel:<?php echo html_escape($user->phone_number); ?>" id="phone_number" class="display-none"><?php echo html_escape($user->phone_number); ?></a>
                            </span>
                        <?php endif; ?>
                        <?php if (!empty($user->email)) : ?>
                            <span class="info"><i class="icon-envelope"></i><?php echo html_escape($user->email); ?></span>
                        <?php endif; ?>
                        <?php if (!empty(get_location($user))) : ?>
                            <span class="info"><i class="icon-map-marker"></i><?php echo get_location($user); ?></span>
                        <?php endif; ?>
                    <?php else : ?>
                        <span class="info"><img src="<?php echo base_url() . 'assets/img/user_confirm.png'; ?>" alt="" style="margin-right: 8px;" /><?php echo trans("member_since"); ?>&nbsp;<?php echo helper_date_format($user->created_at); ?></span>
                        <?php if (!empty($user->email)) : ?>
                            <span class="info"><i class="icon-envelope"></i><?php echo html_escape($user->email); ?></span>
                        <?php endif; ?>
                        <?php if (!empty($user->phone_number)) : ?>
                            <span class="info only_on_dadeesktop">
                                <i class="icon-phone"></i>
                                <a href="javascript:void(0)" id="show_phone_number"><?php echo trans("show"); ?></a>
                                <a href="tel:<?php echo html_escape($user->phone_number); ?>" id="phone_number" class="display-none"><?php echo html_escape($user->phone_number); ?></a>
                            </span>
                            <span class="info only_on_mobile" style="position: absolute;right: -8px;text-align: right;top: 31px;">
                                <i class="icon-phone" style="margin-right: 0!important;"></i>
                                <a href="javascript:void(0)" id="show_phone_number2"><?php echo trans("show"); ?></a>
                                <a href="tel:<?php echo html_escape($user->phone_number); ?>" id="phone_number2" class="display-none"><?php echo html_escape($user->phone_number); ?></a>
                            </span>
                        <?php endif; ?>
                        <?php if (!empty(get_location($user))) : ?>
                            <span class="info" style="margin-bottom: -10px;"><i class="icon-map-marker"></i><?php echo trim(get_location($user)); ?></span>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($general_settings->user_reviews == 1) : ?>
                <div class="profile-rating only_on_mobile" style="position: absolute;top: 31px;left: 9px;">
                    <?php $rew_count = get_user_review_count($user->id); ?>
                    <!--stars-->
                    <?php $this->load->view('partials/_review_stars', ['review' => get_user_rating($user->id)]); ?>
                    &nbsp;<span>(<?php echo $rew_count; ?>)</span>
                </div>
                <div class="profile-rating only_on_dadeesktop">
                    <?php $rew_count = get_user_review_count($user->id);
                    if ($rew_count > 0) : ?>
                        <!--stars-->
                        <?php $this->load->view('partials/_review_stars', ['review' => get_user_rating($user->id)]); ?>
                        &nbsp;<span>(<?php echo $rew_count; ?>)</span>
                    <?php endif; ?>
                </div>
            <?php else : ?>
                <div class="row-custom only_on_mobile" style="position: absolute;top: 30px;left: 10px;">
                    <p class="p-last-seen">
                        <span class="last-seen <?php echo (is_user_online($user->last_seen)) ? 'last-seen-online' : ''; ?>"> <i class="icon-circle"></i> <?php echo trans("last_seen"); ?>&nbsp;<?php echo time_ago($user->last_seen); ?></span>
                    </p>
                </div>
            <?php endif; ?>

            <div class="row-custom profile-buttons">
                <div class="buttons only_on_dadeesktop">
                    <?php if (auth_check()) : ?>
                        <?php if (user()->id != $user->id) : ?>
                            <button class="btn btn-md btn-outline-gray" data-toggle="modal" data-target="#messageModal"><i class="icon-envelope"></i><?php echo trans("ask_question") ?></button>

                            <!--form follow-->
                            <?php echo form_open('profile_controller/follow_unfollow_user', ['class' => 'form-inline']); ?>
                            <input type="hidden" name="following_id" value="<?php echo $user->id; ?>">
                            <input type="hidden" name="follower_id" value="<?php echo user()->id; ?>">
                            <?php if (is_user_follows($user->id, user()->id)) : ?>
                                <button class="btn btn-md btn-outline-gray"><i class="icon-user-minus"></i><?php echo trans("unfollow"); ?></button>
                            <?php else : ?>
                                <button class="btn btn-md btn-outline-gray"><i class="icon-user-plus"></i><?php echo trans("follow"); ?></button>
                            <?php endif; ?>
                            <?php echo form_close(); ?>
                        <?php endif; ?>
                    <?php else : ?>
                        <a href="<?php echo lang_base_url() . 'login'; ?>" class="btn btn-md btn-outline-gray"><i class="icon-envelope"></i><?php echo trans("ask_question") ?></a>
                        <a href="<?php echo lang_base_url() . 'login'; ?>" class="btn btn-md btn-outline-gray"><i class="icon-user-plus"></i><?php echo trans("follow"); ?></a>
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
    </div>
</div>