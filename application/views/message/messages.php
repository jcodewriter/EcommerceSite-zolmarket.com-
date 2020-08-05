<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="hkm_messages_navCatDownMobile">
    <div class="cat-header" style="border-bottom: 0 !important;">
        <div class="mobile-header-back">
            <a href="<?php echo lang_base_url();?>" class="btn-back-mobile-nav"> <i class="icon-arrow-left"></i> <?php echo trans("back"); ?>  </a>
        </div>
        <div class="mobile-header-title">
            <span  class="text-white textcat-header text-center"><?php echo trans("messages"); ?></span>
        </div>
        <div class="mobilde-header-cart">
            <a href="<?php echo lang_base_url(); ?>cart">
                <span style="font-size: 18px">
                    <i class="fa icon-cart"></i>
                </span>
                <?php $cart_product_count = get_cart_product_count();
                if ($cart_product_count > 0): ?>
                    <span class="notification"><?php echo $cart_product_count; ?></span>
                <?php endif; ?>
            </a>
        </div>
	</div>   
    <div class="container">
        <div class="row">
            <div id="hkm_msg_all" class="col-3 acteieive">
                <?php echo trans("all"); ?>
            </div>
            <div id="hkm_msg_myads" class="col-3">
                <?php echo trans("my_ads"); ?>
            </div>
            <div id="hkm_msg_unread" class="col-3">
                <?php echo trans("unread"); ?>
            </div>
            <div id="hkm_msg_block" class="col-3 noborder">
                <?php echo trans("block"); ?>
            </div>
            <!--<div id="marker"></div>-->
        </div>
    </div>
</div>
<br><br>

<!-- Wrapper -->
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="nav-breadcrumb" aria-label="breadcrumb" style="margin-top: -57px;margin-bottom: -27px;padding: 0;">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo lang_base_url(); ?>"><?php echo trans("home"); ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo trans("messages"); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row row_disktop_headr_chat" style="padding-top: -27px;">
            <div class="col-sm-12 col-md-4" style="padding:0;position:relative">
                <nav class="nav-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="activeee" id="eafara_all">  <?php echo trans("all"); ?> </li>
                        <li id="eafara_myads"> <?php echo trans("my_ads"); ?> </li>
                        <li class="" id="eafara_unread"><?php echo trans("unread"); ?></li>
                        <li class="" id="eafara_block"><?php echo trans("block"); ?></li>
                    </ol>
                </nav>
            <div id="marker"></div> 
            </div>
             <div class="col-md-8 d-none d-md-block d-lg-block partright_header_chat_disktop" style="">
                <h5 style="margin-top: -6px;"><?php echo trans("choose_user"); ?> </h5>
                <p style="margin-bottom:0"><?php echo trans("select_any_user"); ?> </p>
            </div>
        </div>
        <!-- start all messages -->
        <div id="hkm_msg_all_content" class="row row-col-messages">
            <?php if (empty($all_conversations)): ?>
                <div class="col-12">
                    <p class="text-center"><?php echo trans("no_messages_found"); ?></p>
                </div>
            <?php else: ?>

                <div class="col-sm-12 col-md-4 col-lg-4 col-message-sidebar">
                    <div id="oop_descto_alll" class="message-sidebar-custom-scrollbar">
                        <div class="row-custom messages-sidebar">
                            <?php foreach ($all_conversations as $item):
                                $user_id = 0;
                                if ($item->receiver_id != $this->auth_user->id) {
                                    $user_id = $item->receiver_id;
                                } else {
                                    $user_id = $item->sender_id;
                                }
                                $user = get_user($user_id);
                                if (!empty($user)):?>
                                    <div class="conversation-item <?php echo ($item->id == $conversation->id) ? 'active-conversation-item' : ''; ?>">
                                        <a href="javascript:void(0)" class="delete-conversation-link hkm_deleteconversation delete-conversation_mbl" onclick="delete_conversation(<?php echo $item->id;?>, &quot;<?php echo trans('delete_conversation_message'); ?>&quot;);" style="top:12px;right:-15px;color: #9b9b9b;"><i class="fa fa-trash-o"></i></a>
                                        <a href="<?php echo lang_base_url(); ?>messages/conversation/<?php echo $item->id; ?>" class="conversation-item-link">
                                            <div class="middle avatar-contain">
                                                <img src="<?php echo get_user_avatar($user); ?>" alt="<?php echo html_escape($user->username); ?>">
                                                <span class="last-seen last_seen_hkm <?php echo (is_user_online($user->last_seen)) ? 'last-seen-online' : ''; ?>"> <i class="icon-circle"></i></span> </span>
                                            </div>
                                            <div class="right message-detail">
                                                <div class="row-custom">
                                                    <?php if (is_arabic($user->username)): ?>
                                                        <strong class="username"><?php echo html_escape($user->username); ?></strong> 
                                                    <?php else:?>
                                                        <strong class="username" style="direction: rtl"><?php echo html_escape($user->username); ?></strong> 
                                                    <?php endif;?>
                                                </div>
                                                <div class="row-custom m-b-0" style="display:flex;line-height: 130%">
                                                    <?php $products = getproduct_by_title_hkm($item->slug);
                                                        $messageObj = get_last_message($item->id);
                                                        if (!(empty($products))): ?>
                                                        <?php foreach($products as $product){  ?>
                                                            <img src="<?php echo $img_bg_product_small; ?>" data-src="<?php echo get_product_image($product->id, 'image_small'); ?>" alt="<?php echo html_escape($product->title); ?>" style="width:32px;margin:0;height: 32px;float:left;margin-right: 5px;" class="lazyload img-fluid img-product" onerror="this.src='<?php echo $img_bg_product_small; ?>'">
                                                        <?php } ?>
                                                        <div style="width:200px">
                                                            <?php if(is_arabic($item->subject)):?>
                                                                <p class="subject" style="color: #000;overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;white-space: nowrap;text-overflow: ellipsis;display: block;overflow: hidden;"><?php echo html_escape($item->subject); ?></p>
                                                            <?php else:?>
                                                                <p class="subject" style="color: #000;overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;white-space: nowrap;text-overflow: ellipsis;display: block;overflow: hidden;direction:rtl"><?php echo html_escape($item->subject); ?></p>
                                                            <?php endif;
                                                            if (is_arabic($messageObj->message)):?>    
                                                                <p class="subject" style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;white-space: nowrap;text-overflow: ellipsis;display: block;overflow: hidden;"><?php echo html_escape($messageObj->message); ?></p>
                                                            <?php else:?>
                                                                <p class="subject" style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;white-space: nowrap;text-overflow: ellipsis;display: block;overflow: hidden;direction:rtl"><?php echo html_escape($messageObj->message); ?></p>
                                                            <?php endif;?>
                                                        </div>
                                                    <?php else:?>
                                                        <?php if (is_arabic($messageObj->message)):?>    
                                                            <p class="subject" style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;white-space: nowrap;text-overflow: ellipsis;display: block;overflow: hidden;"><?php echo html_escape($messageObj->message); ?></p>
                                                        <?php else:?>
                                                            <p class="subject" style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;white-space: nowrap;text-overflow: ellipsis;display: block;overflow: hidden;direction:rtl"><?php echo html_escape($messageObj->message); ?></p>
                                                        <?php endif;?>
                                                    <?php endif?>       
                                                </div>
                                            </div>
                                            <div class="action-details">
                                                <div class="message-date"><?php echo date("d-m-Y", strtotime($item->m_created_at)); ?></div>
                                                <div class="message-badge">
                                                    <?php if ($item->unread_num > 0): ?>
                                                        <label class="badge badge-success badge-new"><?php echo trans("new_message"); ?></label>
                                                        <span class="span-message-count"> <?php echo $item->unread_num; ?></span>
                                                    <?php else: ?>
                                                        <span style="color: #9b9b9b;"><i class="fas fa-angle-right"></i></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php endif;
                            endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-8 d-none d-sm-none d-md-block  hkm_one_conversation"></div>
            

            <?php endif; ?>
        </div>
        
        <!-- end all messages -->
        
         <!-- start my ads messages -->
        
        <div id="hkm_msg_myads_content" class="row row-col-messages">
            <?php if (empty($myads_conversations)): ?>
                <div class="col-12">
                    <p class="text-center"><?php echo trans("no_messages_found"); ?></p>
                </div>
            <?php else: ?>

                <div class="col-sm-12 col-md-12 col-lg-3 col-message-sidebar">
                    <div class="message-sidebar-custom-scrollbar">
                        <div class="row-custom messages-sidebar">
                            <?php foreach ($myads_conversations as $item):
                                $user_id = 0;
                                if ($item->receiver_id != $this->auth_user->id) {
                                    $user_id = $item->receiver_id;
                                } else {
                                    $user_id = $item->sender_id;
                                }
                                $user = get_user($user_id);
                                if (!empty($user)): ?>
                                    <div class="conversation-item <?php echo ($item->id == $conversation->id) ? 'active-conversation-item' : ''; ?>">
                                        <a href="javascript:void(0)" class="delete-conversation-link hkm_deleteconversation delete-conversation_mbl" onclick="delete_conversation(<?php echo $item->id;?>,&quot;Are you sure you want to delete this conversation?&quot;);" style="top:12px;right:-15px;color: #9b9b9b;"><i class="fa fa-trash-o"></i></a>
                                        <a href="<?php echo lang_base_url(); ?>messages/conversation/<?php echo $item->id; ?>" class="conversation-item-link">
                                            <div class="middle avatar-contain">
                                                <img src="<?php echo get_user_avatar($user); ?>" alt="<?php echo html_escape($user->username); ?>">
                                                <span class="last-seen last_seen_hkm <?php echo (is_user_online($user->last_seen)) ? 'last-seen-online' : ''; ?>"> <i class="icon-circle"></i></span> </span>
                                            </div>
                                            <div class="right message-detail">
                                                <div class="row-custom">
                                                    <?php if (is_arabic($user->username)): ?>
                                                        <strong class="username"><?php echo html_escape($user->username); ?></strong> 
                                                    <?php else:?>
                                                        <strong class="username" style="direction: rtl"><?php echo html_escape($user->username); ?></strong> 
                                                    <?php endif;?>
                                                </div>
                                                <div class="row-custom m-b-0" style="display:flex;line-height: 130%">
                                                    <?php $products = getproduct_by_title_hkm($item->slug);
                                                        $messageObj = get_last_message($item->id);
                                                        if (!(empty($products))): ?>
                                                        <?php foreach($products as $product){  ?>
                                                            <img src="<?php echo $img_bg_product_small; ?>" data-src="<?php echo get_product_image($product->id, 'image_small'); ?>" alt="<?php echo html_escape($product->title); ?>" style="width:32px;margin:0;height: 32px;float:left;margin-right: 5px;" class="lazyload img-fluid img-product" onerror="this.src='<?php echo $img_bg_product_small; ?>'">
                                                        <?php } ?>
                                                        <div style="width:200px">
                                                            <?php if(is_arabic($item->subject)):?>
                                                                <p class="subject" style="color: #000;overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;white-space: nowrap;text-overflow: ellipsis;display: block;overflow: hidden;"><?php echo html_escape($item->subject); ?></p>
                                                            <?php else:?>
                                                                <p class="subject" style="color: #000;overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;white-space: nowrap;text-overflow: ellipsis;display: block;overflow: hidden;direction:rtl"><?php echo html_escape($item->subject); ?></p>
                                                            <?php endif;
                                                            if (is_arabic($messageObj->message)):?>    
                                                                <p class="subject" style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;white-space: nowrap;text-overflow: ellipsis;display: block;overflow: hidden;"><?php echo html_escape($messageObj->message); ?></p>
                                                            <?php else:?>
                                                                <p class="subject" style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;white-space: nowrap;text-overflow: ellipsis;display: block;overflow: hidden;direction:rtl"><?php echo html_escape($messageObj->message); ?></p>
                                                            <?php endif;?>
                                                        </div>
                                                    <?php else:?>
                                                        <?php if (is_arabic($messageObj->message)):?>    
                                                            <p class="subject" style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;white-space: nowrap;text-overflow: ellipsis;display: block;overflow: hidden;"><?php echo html_escape($messageObj->message); ?></p>
                                                        <?php else:?>
                                                            <p class="subject" style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;white-space: nowrap;text-overflow: ellipsis;display: block;overflow: hidden;direction:rtl"><?php echo html_escape($messageObj->message); ?></p>
                                                        <?php endif;?>
                                                    <?php endif?>    
                                                </div>
                                            </div>
                                            <div class="action-details">
                                                <div class="message-date"><?php echo date("d-m-Y", strtotime($item->m_created_at)); ?></div>
                                                <div class="message-badge">
                                                    <?php if ($item->unread_num > 0): ?>
                                                        <label class="badge badge-success badge-new"><?php echo trans("new_message"); ?></label>
                                                        <span class="span-message-count"> <?php echo $item->unread_num; ?></span>
                                                    <?php else: ?>
                                                        <span style="color: #9b9b9b;"><i class="fas fa-angle-right"></i></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                               <?php endif;
                            endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- end my ads messages -->
        <!-- start unread messages -->
        
        <div id="hkm_msg_unread_content" class="row row-col-messages">
            <?php if (empty($unread_conversations)): ?>
                <div class="col-12">
                    <p class="text-center"><?php echo trans("no_messages_found"); ?></p>
                </div>
            <?php else: ?>

                <div class="col-sm-12 col-md-12 col-lg-3 col-message-sidebar">
                    <div class="message-sidebar-custom-scrollbar">
                        <div class="row-custom messages-sidebar">
                            <?php foreach ($unread_conversations as $item):
                                $user_id = 0;
                                if ($item->receiver_id != $this->auth_user->id) {
                                    $user_id = $item->receiver_id;
                                } else {
                                    $user_id = $item->sender_id;
                                }
                                $user = get_user($user_id);
                                if (!empty($user)): ?>
                                    <div class="conversation-item <?php echo ($item->id == $conversation->id) ? 'active-conversation-item' : ''; ?>">
                                        <a href="javascript:void(0)" class="delete-conversation-link hkm_deleteconversation delete-conversation_mbl" onclick="delete_conversation(<?php echo $item->id;?>,&quot;Are you sure you want to delete this conversation?&quot;);" style="top:12px;right:-15px;color: #9b9b9b;"><i class="fa fa-trash-o"></i></a>
                                        <a href="<?php echo lang_base_url(); ?>messages/conversation/<?php echo $item->id; ?>" class="conversation-item-link">
                                            <div class="middle avatar-contain">
                                                <img src="<?php echo get_user_avatar($user); ?>" alt="<?php echo html_escape($user->username); ?>">
                                                <span class="last-seen last_seen_hkm <?php echo (is_user_online($user->last_seen)) ? 'last-seen-online' : ''; ?>"> <i class="icon-circle"></i></span> </span>
                                            </div>
                                            <div class="right message-detail">
                                                <div class="row-custom">
                                                    <?php if (is_arabic($user->username)): ?>
                                                        <strong class="username"><?php echo html_escape($user->username); ?></strong> 
                                                    <?php else:?>
                                                        <strong class="username" style="direction: rtl"><?php echo html_escape($user->username); ?></strong> 
                                                    <?php endif;?>
                                                </div>
                                                <div class="row-custom m-b-0" style="display:flex;line-height: 130%">
                                                    <?php $products = getproduct_by_title_hkm($item->slug);
                                                        $messageObj = get_last_message($item->id);
                                                        if (!(empty($products))): ?>
                                                        <?php foreach($products as $product){  ?>
                                                            <img src="<?php echo $img_bg_product_small; ?>" data-src="<?php echo get_product_image($product->id, 'image_small'); ?>" alt="<?php echo html_escape($product->title); ?>" style="width:32px;margin:0;height: 32px;float:left;margin-right: 5px;" class="lazyload img-fluid img-product" onerror="this.src='<?php echo $img_bg_product_small; ?>'">
                                                        <?php } ?>
                                                        <div style="width:200px">
                                                            <?php if(is_arabic($item->subject)):?>
                                                                <p class="subject" style="color: #000;overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;white-space: nowrap;text-overflow: ellipsis;display: block;overflow: hidden;"><?php echo html_escape($item->subject); ?></p>
                                                            <?php else:?>
                                                                <p class="subject" style="color: #000;overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;white-space: nowrap;text-overflow: ellipsis;display: block;overflow: hidden;direction:rtl"><?php echo html_escape($item->subject); ?></p>
                                                            <?php endif;
                                                            if (is_arabic($messageObj->message)):?>    
                                                                <p class="subject" style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;white-space: nowrap;text-overflow: ellipsis;display: block;overflow: hidden;"><?php echo html_escape($messageObj->message); ?></p>
                                                            <?php else:?>
                                                                <p class="subject" style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;white-space: nowrap;text-overflow: ellipsis;display: block;overflow: hidden;direction:rtl"><?php echo html_escape($messageObj->message); ?></p>
                                                            <?php endif;?>
                                                        </div>
                                                    <?php else:?>
                                                        <?php if (is_arabic($messageObj->message)):?>    
                                                            <p class="subject" style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;white-space: nowrap;text-overflow: ellipsis;display: block;overflow: hidden;"><?php echo html_escape($messageObj->message); ?></p>
                                                        <?php else:?>
                                                            <p class="subject" style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;white-space: nowrap;text-overflow: ellipsis;display: block;overflow: hidden;direction:rtl"><?php echo html_escape($messageObj->message); ?></p>
                                                        <?php endif;?>
                                                    <?php endif?>       
                                                </div>
                                            </div>
                                            <div class="action-details">
                                                <div class="message-date"><?php echo date("d-m-Y", strtotime($item->m_created_at)); ?></div>
                                                <div class="message-badge">
                                                    <?php if ($item->unread_num > 0): ?>
                                                        <label class="badge badge-success badge-new"><?php echo trans("new_message"); ?></label>
                                                        <span class="span-message-count"> <?php echo $item->unread_num; ?></span>
                                                    <?php else: ?>
                                                        <span style="color: #9b9b9b;"><i class="fas fa-angle-right"></i></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                               <?php endif;
                            endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- end unread messages -->
        
         
        <!-- start block users -->
        
        <div id="hkm_block_users_content" class="row row-col-messages">
            <?php if (empty($block_users)): ?>
                <div class="col-12 d-md-none d-lg-none d-sm-block d-xs-block ">
                   <p class="text-center"> <?php echo trans("no_found_block"); ?> </p>
                </div>
            <?php else: ?>

                <div class="col-sm-12 col-md-12 col-lg-3 col-message-sidebar">
                    <div class="message-sidebar-custom-scrollbar">
                        <div class="row-custom messages-sidebar">
                            <?php foreach ($block_users as $item): ?>
                             <?php
                                $profile=get_user($item->block_in);
                             ?>
                                <div class="div_block_user">
                                    <img src="<?php echo get_user_avatar($profile); ?>" style="width:24px;border-radius: 50%;position:relative">
                                    <span  class="textcat-header text-center"> <?php echo html_escape($profile->username); ?> </span>
                                    <button type="button" class="btn btn-primary btn-sm text-white" style="float: right;background:#28aae8;border: none;" onclick='un_block_user_conversation(<?php echo $this->auth_user->id; ?>,<?php echo $profile->id; ?>);' > <?php echo trans("unblock"); ?> </button>
                                </div>

                            <?php  endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <!-- end block users -->

    </div>
</div>
<!-- Wrapper End-->

<?php if (!empty($this->session->userdata('mds_send_email_new_message'))): ?>
    <script>
        $(document).ready(function () {
            var data = {
                "receiver_id": '<?php echo $this->session->userdata('mds_send_email_new_message_send_to'); ?>',
                "message_subject": '<?php echo html_escape($conversation->subject); ?>',
                "message_text": '<?php echo $this->session->userdata('mds_send_email_new_message_text'); ?>',
                'lang_folder': lang_folder,
                'form_lang_base_url': '<?php echo lang_base_url(); ?>'
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                type: "POST",
                url: base_url + "ajax_controller/send_email_new_message",
                data: data,
                success: function (response) {
                }
            });
        });
    </script>
    <?php
    $this->session->unset_userdata('mds_send_email_new_message');
    $this->session->unset_userdata('mds_send_email_new_message_send_to');
    $this->session->unset_userdata('mds_send_email_new_message_text');
endif; ?>

