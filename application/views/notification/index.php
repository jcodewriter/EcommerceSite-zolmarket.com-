<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="hkm_messages_navCatDownMobile">
    <div class="cat-header">
        <div class="mobile-header-back">
            <a href="<?php echo lang_base_url(); ?>" class="btn-back-mobile-nav"> <i class="icon-arrow-left"></i> <?php echo trans("back"); ?> </a>
        </div>
        <div class="mobile-header-title">
            <span class="text-white textcat-header text-center"><?php echo trans("notification"); ?></span>
        </div>
        <div class="mobilde-header-cart">
            <a href="<?php echo lang_base_url(); ?>cart">
                <span style="font-size: 18px;">
                    <i class="fa icon-cart"></i>
                </span>
                <?php $cart_product_count = get_cart_product_count();
                if ($cart_product_count > 0) : ?>
                    <span class="notification"><?php echo $cart_product_count; ?></span>
                <?php endif; ?>
            </a>
        </div>
    </div>
</div>
<!-- Wrapper -->
<div id="wrapper" style="margin-top: 0px !important">
    <div class="container" style="margin-bottom: 100px;">
        <div class="row" style="justify-content: center">
            <!-- <div class="col-12"> -->
            <?php if (!empty($notifications)) : ?>
                <?php foreach ($notifications as $key => $data) : ?>
                    <div class="notification-item <?php echo $data->is_see ? '' : 'is-see'; ?>" key="<?php echo $data->id; ?>">
                        <a href="<?php echo lang_base_url() . 'notifications/' . $data->id; ?>" name="ads_link" view_link="<?php echo $data->notification_type; ?>" class="<?php echo $data->notification_type == "someone_follow" || $data->notification_type == "add_profile_review"?'profile_link':'' ?>">
                            <div class="avatar-item" url="<?php echo lang_base_url() . $data->slug; ?>">
                                <?php if ($data->avatar) : ?>
                                    <img src="<?php echo base_url() . $data->avatar; ?>" alt="User">
                                <?php else : ?>
                                    <img src="<?php echo base_url() . 'assets/img/user.png' ?>" alt="User">
                                <?php endif; ?>
                                <?php if ($data->notification_type == "add_comment") : ?>
                                    <div class="notification-icon comment">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="comment-alt" class="svg-inline--fa fa-comment-alt fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor" d="M448 0H64C28.7 0 0 28.7 0 64v288c0 35.3 28.7 64 64 64h96v84c0 9.8 11.2 15.5 19.1 9.7L304 416h144c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64z"></path>
                                        </svg>
                                    </div>
                                <?php elseif ($data->notification_type == "add_review") : ?>
                                    <div class="notification-icon review">
                                        <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="star" class="svg-inline--fa fa-star fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                            <path fill="currentColor" d="M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4L288 385.4l-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z"></path>
                                        </svg>
                                    </div>
                                <?php elseif ($data->notification_type == "add_ads") : ?>
                                    <div class="notification-icon ads">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bell" class="svg-inline--fa fa-bell fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path fill="currentColor" d="M224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64zm215.39-149.71c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71z"></path>
                                        </svg>
                                    </div>
                                <?php elseif ($data->notification_type == "open_shop") : ?>
                                    <div class="notification-icon open_shop">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="store" class="svg-inline--fa fa-store fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 616 512">
                                            <path fill="currentColor" d="M602 118.6L537.1 15C531.3 5.7 521 0 510 0H106C95 0 84.7 5.7 78.9 15L14 118.6c-33.5 53.5-3.8 127.9 58.8 136.4 4.5.6 9.1.9 13.7.9 29.6 0 55.8-13 73.8-33.1 18 20.1 44.3 33.1 73.8 33.1 29.6 0 55.8-13 73.8-33.1 18 20.1 44.3 33.1 73.8 33.1 29.6 0 55.8-13 73.8-33.1 18.1 20.1 44.3 33.1 73.8 33.1 4.7 0 9.2-.3 13.7-.9 62.8-8.4 92.6-82.8 59-136.4zM529.5 288c-10 0-19.9-1.5-29.5-3.8V384H116v-99.8c-9.6 2.2-19.5 3.8-29.5 3.8-6 0-12.1-.4-18-1.2-5.6-.8-11.1-2.1-16.4-3.6V480c0 17.7 14.3 32 32 32h448c17.7 0 32-14.3 32-32V283.2c-5.4 1.6-10.8 2.9-16.4 3.6-6.1.8-12.1 1.2-18.2 1.2z"></path>
                                        </svg>
                                    </div>
                                <?php elseif ($data->notification_type == "close_shop") : ?>
                                    <div class="notification-icon close_shop">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="store-slash" class="svg-inline--fa fa-store-slash fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                            <path fill="currentColor" d="M121.51,384V284.2a119.43,119.43,0,0,1-28,3.8,123.46,123.46,0,0,1-17.1-1.2,114.88,114.88,0,0,1-15.58-3.6V480c0,17.7,13.59,32,30.4,32H505.75L348.42,384Zm-28-128.09c25.1,0,47.29-10.72,64-27.24L24,120.05c-30.52,53.39-2.45,126.53,56.49,135A95.68,95.68,0,0,0,93.48,255.91ZM602.13,458.09,547.2,413.41V283.2a93.5,93.5,0,0,1-15.57,3.6,127.31,127.31,0,0,1-17.29,1.2,114.89,114.89,0,0,1-28-3.8v79.68L348.52,251.77a88.06,88.06,0,0,0,25.41,4.14c28.11,0,53-13,70.11-33.11,17.19,20.11,42.08,33.11,70.11,33.11a94.31,94.31,0,0,0,13-.91c59.66-8.41,88-82.8,56.06-136.4L521.55,15A30.1,30.1,0,0,0,495.81,0H112A30.11,30.11,0,0,0,86.27,15L76.88,30.78,43.19,3.38A14.68,14.68,0,0,0,21.86,6.19L3.2,31.45A16.58,16.58,0,0,0,5.87,53.91L564.81,508.63a14.69,14.69,0,0,0,21.33-2.82l18.66-25.26A16.58,16.58,0,0,0,602.13,458.09Z"></path>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="content-item">
                                <div class="content-title">
                                    <?php if (is_arabic($data->username)) : ?>
                                        <span class="n-user span-warp-text"><?php echo $data->username; ?></span>
                                    <?php else : ?>
                                        <span class="n-user span-warp-text" style="direction: rtl"><?php echo $data->username; ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="content-subject" style="<?php echo ($data->notification_type == "add_review"||$data->notification_type == "add_profile_review")?'':'display: flex' ?>">
                                    <?php if ($data->notification_type == "add_comment") : ?>
                                        <span class="" style="direction: rtl"><?php echo trans("add_a_new_comment"); ?></span>
                                    <?php elseif ($data->notification_type == "add_review") : ?>
                                        <span class="" style="direction: rtl"><?php echo trans("add_a_new_review"); ?></span>
                                        <?php $this->load->view('partials/_review_stars', ['review' => $data->rating]); ?>
                                    <?php elseif ($data->notification_type == "someone_follow") : ?>
                                        <span class="" style="direction: rtl"><?php echo trans("followed_user"); ?></span>
                                    <?php elseif ($data->notification_type == "add_profile_review") : ?>
                                        <span class="" style="direction: rtl"><?php echo trans("add_a_new_profile_review"); ?></span>
                                        <?php $this->load->view('partials/_review_stars', ['review' => $data->rating]); ?>
                                    <?php endif; ?>
                                </div>
                                <div class="content-body">
                                    <?php if ($data->notification_type == "open_shop") : ?>
                                        <span class="" style="direction: rtl"><?php echo trans("your_shop_opened"); ?></span>
                                    <?php elseif ($data->notification_type == "close_shop") : ?>
                                        <span class="" style="direction: rtl"><?php echo trans("your_shop_closed"); ?></span>
                                    <?php elseif ($data->notification_type == "add_ads") : ?>
                                        <span class="" style="direction: rtl"><?php echo trans("add_new_product"); ?></span>
                                    <?php else : ?>
                                        <?php if (is_arabic($data->content)) : ?>
                                            <span class="n-user span-warp-text"><?php echo $data->content ?></span>
                                        <?php else : ?>
                                            <span class="n-user span-warp-text" style="direction: rtl"><?php echo $data->content; ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="content-time">
                                    <span><?php echo time_ago($data->action_time); ?></span>
                                </div>
                            </div>
                        </a>
                            <div class="detail-item">
                                <div class="follow">
                                    <?php echo form_open('profile_controller/follow_unfollow_user', ['class' => 'form-inline']); ?>
                                    <input type="hidden" name="following_id" value="<?php echo $data->relation_user_id; ?>">
                                    <input type="hidden" name="follower_id" value="<?php echo $data->user_id; ?>">
                                    <?php if (is_user_follows($data->relation_user_id, $data->user_id)) : ?>
                                        <button class="btn btn-outline-gray" style="display: flex;background-color:#fff!important;padding: .2rem .5rem !important;font-size: 12px;"><i class="icon-user-minus"></i><?php echo trans("unfollow"); ?></button>
                                    <?php else : ?>
                                        <button class="btn btn-outline-gray" style="display: flex;background-color:#fff!important;padding: .2rem .5rem !important;font-size: 12px;"><i class="icon-user-plus"></i><?php echo trans("follow"); ?></button>
                                    <?php endif; ?>
                                    <?php echo form_close(); ?>
                                    
                                </div>
                                <?php if($data->notification_type != "someone_follow"&&$data->notification_type != "add_profile_review"): ?>
                                    <div class="ads-img">
                                        <img src="<?php echo get_product_image($data->ads_id, 'image_small'); ?>" style="width: 50px; height: 30px !important; border-radius: 3px; object-fit: cover">
                                    </div>
                                <?php endif; ?>
                            </div>
                        <div class="action-item" onclick="delete_notification(<?php echo $data->id; ?>)">
                            <i class="fa fa-trash-o"></i>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="no-alarm" style="text-align: center; margin-top: 50px;">
                    <img src="<?php echo base_url() ?>assets/img/no-alarm.png">
                    <div class="no-text-content">
                        <span style="font-size: 18px; font-weight: 600; color: #ccc"><?php echo trans("no_notifications") ?></span>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $(".profile_link").click(function() {
            let url = decodeURIComponent($(location).attr("href"));
            localStorage.setItem('chat_profile_url', url)
        })
    })
    function unfollow(relation_user_id) {
        var data = {
            "item_id": relation_user_id
        };
        data[csfr_token_name] = $.cookie(csfr_cookie_name);
        $.ajax({
            type: "POST",
            url: base_url + "notification_controller/unfollow",
            data: data,
            success: function() {
                window.location.reload();
            }
        });
    }

    function delete_notification(item_id) {
        var data = {
            "item_id": item_id
        };
        data[csfr_token_name] = $.cookie(csfr_cookie_name);
        $.ajax({
            type: "POST",
            url: base_url + "notification_controller/delete_notification",
            data: data,
            success: function() {
                window.location.reload();
            }
        });
    }
</script>