<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
    $profile_id=$conversation->sender_id;
    if($this->auth_user->id==$conversation->sender_id){
        $profile_id=$conversation->receiver_id;
    }

    $profile=get_user($profile_id);
?>
<div class="hkm_messages_navCatDownMobile withimgzgz" style="text-align: left">
    <div class="cat-header">
        <div class="mobile-header-back">
            <a href="<?php echo lang_base_url();?>messages" class="btn-back-mobile-nav"> <i class="icon-arrow-left"></i> <?php echo trans("back"); ?>  </a>
        </div>
        <div class="mobile-header-title" style="padding-left: 5px;">
            <a class="chat-profile-image" href="<?php echo lang_base_url();?>profile/<?php echo html_escape($profile->slug);?>" name="chat_profile">
                <img src="<?php echo get_user_avatar($profile); ?>" style="width: 45px;height: 45px;border-radius: 50%;">
                <span class="online-state last_seen_hkm signle_msgsd last-seen <?php echo (is_user_online($profile->last_seen)) ? 'last-seen-online' : ''; ?>" style="bottom: -1px;left: 30px"><i class="icon-circle"></i></span>
            </a>
            <div class="chat-profile-detail" style="text-align: left;padding-left:5px;">
                <a name="profile_link"  href="<?php echo lang_base_url();?>profile/<?php echo html_escape($profile->slug);?>" name="chat_profile">
                    <?php if (is_arabic($profile->username)): ?>
                        <p style="font-weight: 600;margin-bottom: 0px;white-space: nowrap;text-overflow: ellipsis;width: 190px !important;display: block;overflow: hidden;"> <?php echo html_escape($profile->username); ?> </p>
                    <?php else:?>
                        <p style="font-weight: 600;margin-bottom: 0px;white-space: nowrap;text-overflow: '.';width: 190px !important;display: block;overflow: hidden;direction: rtl"> <?php echo html_escape($profile->username); ?> </p>
                    <?php endif;?>
                </a>    
                <div style="font-size: 12px;"><span><?php echo trans("last_seen"); ?></span> <span><?php echo time_ago($profile->last_seen); ?></span></div>
            </div>    
        </div>
        <div class="mobilde-header-cart">
            <a data-toggle="modal" data-target="#blockuserr" class="last_seen_hkm block_msgd last-seen"> <i class="fas fa-user-slash"></i>  </a>    
        </div>
	</div>
</div>


<!-- Wrapper -->
<div id="wrapper" class="wrapper_of_one_msg nonaee_on_descktop">
                <!-- Modal -->
                 <?php if($resulttt_block == false){ ?>
                           
                        <div id="blockuserr" class="modal" tabindex="-1" role="dialog">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" style="color:#a8a2a2;text-align: center;width: 100%;"> <i class="fas fa-user"></i> <small><?php echo trans("do_block"); ?> <?php echo html_escape($profile->username); ?></small>  </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary text-white" data-dismiss="modal"><?php echo trans("close"); ?></button>
                                <button type="button" class="btn btn-danger text-white" onclick='block_user_conversation(<?php echo $this->auth_user->id; ?>,<?php echo $profile->id; ?>);' > <?php echo trans("do_block"); ?></button>
                              </div>
                            </div>
                          </div>
                        </div>
                   <?php } else { ?>
                     <div id="blockuserr" class="modal" tabindex="-1" role="dialog">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" style="color:#a8a2a2;text-align: center;width: 100%;"> <i class="fas fa-user"></i> <small> <?php echo trans("unblock"); ?> <?php echo html_escape($profile->username); ?></small>  </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary text-white" data-dismiss="modal"> <?php echo trans("close"); ?></button>
                                <button type="button" class="btn btn-primary text-white" onclick='un_block_user_conversation(<?php echo $this->auth_user->id; ?>,<?php echo $profile->id; ?>);' > <?php echo trans("unblock"); ?></button>
                              </div>
                            </div>
                          </div>
                        </div>
                   <?php } ?>

                        <!-- Modal -->
        <div class="container container_oeane_message">
         
            <?php $products = getproduct_by_title_hkm($conversation->slug);  ?>
                <?php foreach($products as $product){  ?>
                <a href="<?php echo lang_base_url() .  $product->slug ?>" style="display:flex" name="ads_link">
                    <img src="<?php echo $img_bg_product_small; ?>" data-src="<?php echo get_product_image($product->id, 'image_small'); ?>" alt="<?php echo html_escape($product->title); ?>" style="width:36px;margin:0;height: 36px;display: inline-block;float:left;margin-right: 5px;margin-top: 4px;" class="lazyload img-fluid img-product" onerror="this.src='<?php echo $img_bg_product_small; ?>'">
                    <div style="display: block">
                        <?php if (is_arabic($conversation->subject)): ?>
                            <span class="subject m-0" style="max-width:200px;color: #6c6c6c;padding-top: 3px;white-space: nowrap;text-overflow: '.';display: block;overflow: hidden;"><?php echo html_escape($conversation->subject); ?></span>
                        <?php else: ?>    
                            <span class="subject m-0" style="max-width:200px;color: #6c6c6c;padding-top: 3px;white-space: nowrap;text-overflow: '.';display: block;overflow: hidden;direction:rtl"><?php echo html_escape($conversation->subject); ?></span>
                        <?php endif; ?>
                        <?php if ($product->is_sold == 1): ?>
                			<strong class="lbl-price" style="color: #9a9a9a;font-weight: 600;text-decoration-line: line-through;"><?php echo print_price($product->price, $product->currency); ?></strong>
                			<strong class="lbl-sold" style="font-weight: 600; color: #555"><?php echo trans("sold"); ?></strong>
                		<?php elseif ($product->is_free_product == 1): ?>
                			<strong class="lbl-free"><?php echo trans("free"); ?></strong>
                		<?php else: ?>
                			<strong class="lbl-price" style="color: green;font-weight: 600;"><?php echo print_price($product->price, $product->currency); ?></strong>
                		<?php endif; ?> 
                    </div>
                </a>
                <?php } ?>
                <a href="javascript:void(0)" class="delete-conversation-link hkm_deleteconversation delete-conversation_mbl" onclick='delete_conversation(<?php echo $conversation->id; ?>,"<?php echo trans("confirm_message"); ?>");'><i class="fa fa-trash-o"></i></a>
                <a  data-toggle="modal" data-target="#blockuserr" class="last_seen_hkm block_msgd last-seen block_msgd-mobile"> <i class="fas fa-user-slash"></i>  </a>
        </div>
        <br>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="nav-breadcrumb" aria-label="breadcrumb" style="padding-top: -17px;padding: 0;">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo lang_base_url(); ?>"><?php echo trans("home"); ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo trans("messages"); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row row-col-messages">
            <?php if (empty($all_conversations)): ?>
                <div class="col-12">
                    <p class="text-center" style="margin-top:15px"><?php echo trans("no_messages_found"); ?></p>
                </div>
            <?php else: ?>

                

                <div class="col-sm-12 col-md-12 col-lg-9 col-message-content">
                    <?php
                    $profile_id=$conversation->sender_id;
                    if($this->auth_user->id==$conversation->sender_id){
                        $profile_id=$conversation->receiver_id;
                    }

                    $profile=get_user($profile_id);
                    if (!empty($profile)):?>
                        <div class="row-custom ">
                           
                        </div>
                    <?php endif; ?>
                    <div class="row-custom messages-content">
                        <div class="messages-list message-custom-scrollbar" style="min-height:370px;background:white;padding-top:60px;">
                                    <?php foreach ($messages as $item):
                                        if ($item->deleted_user_id != $this->auth_user->id): ?>
                                            <?php if ($this->auth_user->id == $item->receiver_id && $item->dlt_by_recived != 1): ?>
                                                <?php if ($item->msg_type == 'img'): /* img */ ?>
                                                    <div class="message-list-item">
                                                        <div class="message-list-item-row-received">
                                                            <div class="user-avatar">
                                                                <div class="message-user">
                                                                <a  name="profile_link"  href="<?php echo lang_base_url();?>profile/<?php echo html_escape($profile->slug);?>">
                                                                    <img src="<?php echo get_user_avatar_by_id($item->sender_id); ?>" alt="" class="img-profile">
                                                                </a>
                                                                </div>
                                                            </div>
                                                            <div class="user-message">
                                                                <?php if( substr(html_escape($item->message), 0, 10 ) === "emoticons/" ) { ?> 
                                                                <div class="message-text">
                                                                    <img src="https://www.zolmarket.com/uploads/profile/<?php echo html_escape($item->message); ?>" style="width:50px"  class="" >
                                                                </div>
                                                                <?php }else{ ?>
                                                                <div class="message-text">
                                                                    <img src="https://www.zolmarket.com/uploads/profile/<?php echo html_escape($item->message); ?>"   class="img-thumbnail" >
                                                                </div>
                                                                <?php } ?>
                                                                <span class="time" style="min-width: 55.8px;text-align: center;">
                                                                    <?php echo time_ago($item->created_at); ?>
                                                                </span>
                                                                    <button onclick="return delete_message_confirm(event,<?php echo $item->id ?>,'<?php echo trans("confirm_delete_msggs"); ?>')" class="btn_remove_imgghkkm" style="height:15px; width: 15px;" ><i class="fa fa-trash-o"></i></button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                 <div class="message-list-item">
                                                        <div class="message-list-item-row-received">
                                                            <div class="user-avatar">
                                                                <div class="message-user">
                                                                <a  name="profile_link"  href="<?php echo lang_base_url();?>profile/<?php echo html_escape($profile->slug);?>">
                                                                    <img src="<?php echo get_user_avatar_by_id($item->sender_id); ?>" alt="" class="img-profile">
                                                                </a>
                                                                </div>
                                                            </div>
                                                            <div class="user-message">
                                                                <div class="message-text">
                                                                    <?php echo html_escape($item->message); ?>
                                                                </div>
                                                                <span class="time" style="min-width: 55.8px;text-align: center;"><?php echo time_ago($item->created_at); ?></span>
                                                                <button onclick="return delete_message_confirm(event,<?php echo $item->id ?>,'<?php echo trans("confirm_delete_msggs"); ?>')" class="btn_remove_imgghkkm" style="height:15px; width: 15px;" ><i class="fa fa-trash-o"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; /* end img */ ?>  
                                            <?php elseif($item->dlt_by_sender != 1): ?>
                                             <?php if ($item->msg_type == 'img'): /* img */ ?>
                                                <div class="message-list-item">
                                                    <div class="message-list-item-row-sent">
                                                        <div class="user-message">
                                                            <?php if( substr(html_escape($item->message), 0, 10 ) === "emoticons/" ) { ?> 
                                                            <div class="message-text">
                                                                <img src="https://www.zolmarket.com/uploads/profile/<?php echo html_escape($item->message); ?>" style="width:50px"  class="" >
                                                            </div>
                                                            <?php }else{ ?>
                                                            <div class="message-text">
                                                                <img src="https://www.zolmarket.com/uploads/profile/<?php echo html_escape($item->message); ?>"   class="img-thumbnail" >
                                                            </div>
                                                            <?php } ?>
                                                            <span class="time" style="min-width: 55.8px;text-align: center;"><?php echo time_ago($item->created_at); ?>
                                                            </span>
                                                            <button onclick="return delete_message_confirm(event,<?php echo $item->id ?>,'<?php echo trans("confirm_delete_msggs"); ?>')"  class="btn_remove_imgghkkm" style="height:15px; width: 15px;"><i class="fa fa-trash-o"></i></button>
                                                        </div>
                                                        <div class="user-avatar">
                                                            <div class="message-user">
                                                                <img src="<?php echo get_user_avatar_by_id($item->sender_id); ?>" alt="" class="img-profile">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <?php else: ?>
                                                <div class="message-list-item">
                                                    <div class="message-list-item-row-sent">
                                                        <div class="user-message">
                                                            <div class="message-text">
                                                                <?php echo html_escape($item->message); ?>
                                                            </div>
                                                            <span class="time" style="min-width: 55.8px;text-align: center;"><?php echo time_ago($item->created_at); ?></span>
                                                            <button onclick="return delete_message_confirm(event,<?php echo $item->id ?>,'<?php echo trans("confirm_delete_msggs"); ?>')"  class="btn_remove_imgghkkm" style="height:15px; width: 15px;"><i class="fa fa-trash-o"></i></button>
                                                        </div>
                                                        <div class="user-avatar">
                                                            <div class="message-user">
                                                                <img src="<?php echo get_user_avatar_by_id($item->sender_id); ?>" alt="" class="img-profile">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endif; /* end img */ ?>  
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                        <?php if($resulttt == false){ ?>
                           <?php if($resulttt_block == false){ ?>
                        <div class="message-reply groupemodileuplaodimagtz">
                            <!-- form start -->
                            <?php echo form_open('message_controller/send_message', ['id' => 'form_validate']); ?>
                            <input type="hidden" name="conversation_id" value="<?php echo $conversation->id; ?>">
                            <input type="hidden" name="sender_id" value="<?php echo $this->auth_user->id; ?>">
                            <?php if ($this->auth_user->id == $conversation->sender_id): ?>
                                <input type="hidden" name="receiver_id" value="<?php echo $conversation->receiver_id; ?>">
                            <?php else: ?>
                                <input type="hidden" name="receiver_id" value="<?php echo $conversation->sender_id; ?>">
                            <?php endif; ?>
                            <div class="form-group">
                                <img id="img_showw" class="img-thumbnail" src="" style="max-width:100%">
                                <span id="remove_immdage"><i class="fas fa-times"></i></span>
                                <button type="submit" id="btn_sendd_imagee_mobile" class="btn btn-md btn-custom float-right btn_sendd_image"> <i class="icon-send"></i></button>
                                <textarea class="form-control" name="message" placeholder="<?php echo trans('write_a_message'); ?>" required></textarea>
                                <button type="button" class="btn btn-md float-right btn_imogi"> <i class="far fa-grin" style="margin: 0px;"></i> </button>
                                <div class="imogi_div_mobile">
                                    <?php 
                                           for($i = 1; $i<=78; $i++){
                                               if($i == 1){
                                                    for($y = 1; $y<=3; $y++){
                                                    echo '<img src="https://www.zolmarket.com/uploads/profile/emoticons/0'.$y.'.png">';
                                                    }
                                                }
                                                if($i != 18 && $i != 21 && $i != 22 ){
                                                    echo '<img src="https://www.zolmarket.com/uploads/profile/emoticons/'.$i.'.png">';
                                                }
                                           }
                                           ?>
                                </div>
                            </div>
                          
                            <div class="form-group form-group_uplado_images ">
                                <button type="submit" class="btn btn-md btn-custom float-right btn_send"><i class="icon-send"></i> <?php echo trans("send"); ?></button>
                                <input type="file" name="userfile_mobile" id="image_file_mobile" class="file_uplaod_inuptt" accept="image/x-png,image/gif,image/jpeg" >
                                <button type="button" class="choose-files__btn"><i class="fas fa-images"></i>&nbsp;<?php echo trans("choose_files");?></button>
                            </div>
                            <?php echo form_close(); ?>
                            <!-- form end -->
                        </div>
                        <?php }else{ ?>
                             <div class="message-reply text-center text-danger pt-3 border border-danger">
                               <p> <?php echo trans("you_blocked_this_user"); ?> </p>
                              </div>
                         <?php }}else{ ?>
                          <div class="message-reply text-center text-danger pt-3 border border-danger">
                              <p> <?php echo trans("you_can_replay"); ?> </p>
                              </div>
                         <?php } ?>
                    </div>

                </div>

            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Wrapper End-->


<!-- Wrapper hkm desktop -->
<div id="wrapper" class="nonaee_on_mobile hkm_desctopok_uaieua">
    <!-- Modal -->
                 <?php if($resulttt_block == false){ ?>
                        <div id="blockuserr_desk" class="modal" tabindex="-1" role="dialog">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" style="color:#a8a2a2;text-align: center;width: 100%;"> <i class="fas fa-user"></i> <small><?php echo trans("do_block"); ?> <?php echo html_escape($profile->username); ?></small>  </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary text-white" data-dismiss="modal"><?php echo trans("close"); ?></button>
                                <button type="button" class="btn btn-danger text-white" onclick='block_user_conversation(<?php echo $this->auth_user->id; ?>,<?php echo $profile->id; ?>,"<?php echo trans("are_you_sure_do_block") ?>");' ><?php echo trans("do_block"); ?></button>
                              </div>
                            </div>
                          </div>
                        </div>
                   <?php } else { ?>
                     <div id="blockuserr_desk" class="modal" tabindex="-1" role="dialog">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" style="color:#a8a2a2;text-align: center;width: 100%;"> <i class="fas fa-user"></i> <small> <?php echo trans("unblock"); ?> <?php echo html_escape($profile->username); ?></small>  </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary text-white" data-dismiss="modal"><?php echo trans("close"); ?></button>
                                <button type="button" class="btn btn-primary text-white" onclick='un_block_user_conversation(<?php echo $this->auth_user->id; ?>,<?php echo $profile->id; ?>);' > <?php echo trans("unblock"); ?></button>
                              </div>
                            </div>
                          </div>
                        </div>
                   <?php } ?>

                        <!-- Modal -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="nav-breadcrumb" aria-label="breadcrumb" style="margin-top:-15px;padding-bottom: 12px;">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo lang_base_url(); ?>"><?php echo trans("home"); ?></a></li>
                      <li class="breadcrumb-item"> <a href="<?php echo lang_base_url().'messages/'; ?>"><?php echo trans("messages"); ?></a> </li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo html_escape($profile->username); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row row_disktop_headr_chat">
            <div class="col-sm-12 col-md-4" style="padding:0" >
                <nav class="nav-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="activeee" id="eafara_all">  <?php echo trans("all"); ?> </li>
                        <li id="eafara_myads">  <?php echo trans("my_ads"); ?> </li>
                        <li class="" id="eafara_unread"> <?php echo trans("unread"); ?></li>
                        <li class="" id="eafara_block"> <?php echo trans("block"); ?></li>
                    </ol>
                </nav>
                <div id="marker"></div> 
            </div>
             <div class="col-md-8 d-none d-md-block d-lg-block partright_header_chat_disktop" style="">
                <div class="hkmaftainyaufdaead" style="display: flex">
                    <a name="profile_link"  href="<?php echo lang_base_url();?>profile/<?php echo html_escape($profile->slug); ?>" style="display:flex;vertical-align: top;">
                        <img src="<?php echo get_user_avatar($profile); ?>" style="width:30px; height:30px;border-radius: 50%;position:relative">
                        <?php if (is_arabic($profile->username)): ?>
                            &nbsp;<span style="font-weight: 600;margin-bottom: 0px;white-space: nowrap;text-overflow: ellipsis;width: 300px !important;display: block;overflow: hidden;"> <?php echo html_escape($profile->username); ?> </span>
                        <?php else:?>
                            &nbsp;<span style="font-weight: 600;margin-bottom: 0px;white-space: nowrap;text-overflow: ellipsis;width: 300px !important;display: block;overflow: hidden;direction: rtl"> <?php echo html_escape($profile->username); ?> </span>
                        <?php endif;?>
                    </a>
                    <?php $products = getproduct_by_title_hkm($conversation->slug);  ?>
                    <?php foreach($products as $product){  ?>
                        <a href="<?php echo lang_base_url() .  $product->slug ?>" target="_blank" style="display:inline-block;vertical-align: top;">
                            <img src="<?php echo $img_bg_product_small; ?>" data-src="<?php echo get_product_image($product->id, 'image_small'); ?>" alt="<?php echo html_escape($product->title); ?>" style="width:25px;margin:0;height: 25px;display: inline-block;float:left;margin-right: 5px;" class="lazyload img-fluid img-product" onerror="this.src='<?php echo $img_bg_product_small; ?>'">
                            <p class="subject m-0" style="max-width:79%;font-size: 11px;float:left;color: #6c6c6c;padding-top: 3px;"><?php echo html_escape($conversation->subject); ?></p>
                        </a>
                    <?php } ?>
                    <a href="javascript:void(0)" class="delete-conversation-link hkm_deleteconversation delete-conversation_mbl" onclick='delete_conversation(<?php echo $conversation->id; ?>,"<?php echo trans("confirm_message"); ?>");'><i class="fa fa-trash-o"></i></a>
                    <a  data-toggle="modal" data-target="#blockuserr_desk" class="last_seen_hkm block_msgd last-seen block_msgd-mobile"> <i class="fas fa-user-slash"></i>  </a>
                </div>

            </div>
        </div>
        <!-- start all messages -->
        <div id="hkm_msg_all_content" class="row row-col-messages">
            <?php if (empty($all_conversations)): ?>
                <div class="col-12">
                    <p class="text-center" style="margin-top:15px"><?php echo trans("no_messages_found"); ?></p>
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
                                                            <p class="subject" style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;"><?php echo html_escape($item->subject); ?></p>

                                                            <p class="subject" style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;"><?php echo html_escape($messageObj->message); ?></p>
                                                        </div>
                                                    <?php else:?>
                                                        <p class="subject" style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;"><?php echo html_escape($messageObj->message); ?></p>
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
                    <!--  start unread-->
                    <div id="oop_descto_unread">
                        <?php if (empty($unread_conversations)): ?>
                            <div class="col-12">
                                <p class="text-center" style="margin-top:15px"><?php echo trans("no_messages_found"); ?></p>
                            </div>
                        <?php else: ?>
            
                            <div class="col-sm-12 col-md-12">
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
                                                                        <p class="subject" style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;"><?php echo html_escape($item->subject); ?></p>
            
                                                                        <p class="subject" style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;"><?php echo html_escape($messageObj->message); ?></p>
                                                                    </div>
                                                                <?php else:?>
                                                                    <p class="subject" style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;"><?php echo html_escape($messageObj->message); ?></p>
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
                    <!-- end unread -->
                    <!--  start my ads-->
                    <div id="oop_descto_myads">
                        <?php if (empty($myads_conversations)): ?>
                            <div class="col-12">
                                <p class="text-center" style="margin-top:15px"><?php echo trans("no_messages_found"); ?></p>
                            </div>
                        <?php else: ?>
            
                            <div class="col-sm-12 col-md-12" style="padding: 0;" >
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
                                                                        <p class="subject" style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;"><?php echo html_escape($item->subject); ?></p>
            
                                                                        <p class="subject" style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;"><?php echo html_escape($messageObj->message); ?></p>
                                                                    </div>
                                                                <?php else:?>
                                                                    <p class="subject" style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;"><?php echo html_escape($messageObj->message); ?></p>
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
                    <!-- end my ads -->
                    <!--  start block-->
                    <div id="oop_descto_block">
                        <?php if (empty($block_users)): ?>
                            <div class="col-12">
                               <p class="text-center" style="margin-top:15px"> <?php echo trans("no_found_block"); ?> </p>
                            </div>
                        <?php else: ?>
            
                            <div class="col-sm-12 col-md-12">
                                <div class="message-sidebar-custom-scrollbar">
                                    <div class="row-custom messages-sidebar">
                                        <?php foreach ($block_users as $item): ?>
                                         <?php
                                            $profile=get_user($item->block_in);
                                         ?>
                                            <div class="div_block_user">
                                                <img src="<?php echo get_user_avatar($profile); ?>" style="width:24px;border-radius: 50%;position:relative">
                                                <span  class="textcat-header text-center"> <?php echo html_escape($profile->username); ?> </span>
                                                <button type="button" class="btn btn-primary btn-sm text-white" style="float: right;background:#28aae8;border: none;" onclick='un_block_user_conversation(<?php echo $this->auth_user->id; ?>,<?php echo $profile->id; ?>);' > <?php echo trans("unblock"); ?></button>
                                            </div>
            
                                        <?php  endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- end block -->
                </div>
                <div class="col-md-8 col-lg-8 d-none d-sm-none d-md-block  hkm_one_conversation">
                <!-- hkm conversation content --->
                 <!-- hkm start form --->
                        <?php echo form_open_multipart('message_controller/send_message', ['id' => 'form_validate']); ?> 
                                    <input type="hidden" name="conversation_id" value="<?php echo $conversation->id; ?>">
                                    <input type="hidden" name="sender_id" value="<?php echo $this->auth_user->id; ?>">
                                    <?php if ($this->auth_user->id == $conversation->sender_id): ?>
                                        <input type="hidden" name="receiver_id" value="<?php echo $conversation->receiver_id; ?>">
                                    <?php else: ?>
                                        <input type="hidden" name="receiver_id" value="<?php echo $conversation->sender_id; ?>">
                                    <?php endif; ?>
                                    <div class="form-group form_group_hkm_desctopok_uaieua ">
                                        <img id="img_showw" class="img-thumbnail" src="" style="max-width:100%">
                                        <span id="remove_immdage"><i class="fas fa-times"></i></span>
                                        <button type="button" id="btn_sendd_imagee" class="btn btn-md btn-custom float-right btn_sendd_image"> <i class="icon-send"></i></button>
                                        <textarea class="form-control" name="message" placeholder="<?php echo trans('write_a_message'); ?>" required></textarea>
                                        <button type="submit" class="btn btn-md btn-custom float-right btn_send"><i class="icon-send"></i> </button>
                                        <button type="button" class="btn btn-md float-right btn_imogi"> <i class="far fa-grin"></i> </button>
                                        <div class="imogi_div_desktop"> 
                                           <?php 
                                           for($i = 1; $i<=78; $i++){
                                                if($i == 1){
                                                    for($y = 1; $y<=3; $y++){
                                                    echo '<img src="https://www.zolmarket.com/uploads/profile/emoticons/0'.$y.'.png">';
                                                    }
                                                }
                                                if($i != 18 && $i != 21 && $i != 22 ){
                                                    echo '<img src="https://www.zolmarket.com/uploads/profile/emoticons/'.$i.'.png">';
                                                }                                           }
                                           ?>
                                        </div>
                                        <input type="file" name="userfile" id="image_file_desktop" class="file_uplaod_inuptt" accept="image/x-png,image/gif,image/jpeg" >
                                        <button type="submit" class="btn btn-md btn-custom float-right btn_uploadd"> <i class="fas fa-images"></i>   </button>
                                    </div>
                                
                                    <?php echo form_close(); ?>
                                     <!-- hkm end form --->
                    <div class="row row-col-messages">
                        <?php if (empty($all_conversations)): ?>
                            <div class="col-12">
                                <p class="text-center" style="margin-top:15px"><?php echo trans("no_messages_found"); ?></p>
                            </div>
                        <?php else: ?>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-message-content">
                            <?php
                            $profile_id=$conversation->sender_id;
                            if($this->auth_user->id==$conversation->sender_id){
                                $profile_id=$conversation->receiver_id;
                            }
        
                            $profile=get_user($profile_id);
                            if (!empty($profile)):?>
                                <div class="row-custom ">
                                   
                                </div>
                            <?php endif; ?>
                            <div class="row-custom messages-content messages_content_ondesktopaed">
                                <div class="messages-list message-custom-scrollbar" style="min-height:370px;padding-top:60px">
                                    <?php foreach ($messages as $item):
                                        if ($item->deleted_user_id != $this->auth_user->id ): ?>
                                            <?php if ($this->auth_user->id == $item->receiver_id && $item->dlt_by_recived != 1): ?>
                                                <?php if ($item->msg_type == 'img'): /* img */ ?>
                                                    <div class="message-list-item">
                                                        <div class="message-list-item-row-received">
                                                            <div class="user-avatar">
                                                                <div class="message-user">
                                                                <a  name="profile_link"  href="<?php echo lang_base_url();?>profile/<?php echo html_escape($profile->slug);?>">
                                                                    <img src="<?php echo get_user_avatar_by_id($item->sender_id); ?>" alt="" class="img-profile">
                                                                </a>
                                                                </div>
                                                            </div>
                                                            <div class="user-message">
                                                                <?php if( substr(html_escape($item->message), 0, 10 ) === "emoticons/" ) { ?> 
                                                                <div class="message-text" style="padding: 0 !important;">
                                                                    <img src="https://www.zolmarket.com/uploads/profile/<?php echo html_escape($item->message); ?>" style="width:50px"  class="" >
                                                                </div>
                                                                <?php }else{ ?>
                                                                <div class="message-text" style="padding: 0 !important;">
                                                                    <img src="https://www.zolmarket.com/uploads/profile/<?php echo html_escape($item->message); ?>"   class="img-thumbnail" >
                                                                </div>
                                                                <?php } ?>
                                                                <span class="time" style="min-width: 55.8px;text-align: center;">
                                                                <?php echo time_ago($item->created_at); ?>
                                                                </span>
                                                                <button onclick="return delete_message_confirm(event,<?php echo $item->id ?>,'<?php echo trans("confirm_delete_msggs"); ?>')" class="btn_remove_imgghkkm" style="height:15px; width: 15px;" ><i class="fa fa-trash-o"></i></button>
                                                                </div>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                 <div class="message-list-item">
                                                        <div class="message-list-item-row-received">
                                                            <div class="user-avatar">
                                                                <div class="message-user">
                                                                <a  name="profile_link"  href="<?php echo lang_base_url();?>profile/<?php echo html_escape($profile->slug);?>">
                                                                    <img src="<?php echo get_user_avatar_by_id($item->sender_id); ?>" alt="" class="img-profile">
                                                                </a>
                                                                </div>
                                                            </div>
                                                            <div class="user-message">
                                                                <div class="message-text">
                                                                    <?php echo html_escape($item->message); ?>
                                                                </div>
                                                                <span class="time" style="min-width: 55.8px;text-align: center;"><?php echo time_ago($item->created_at); ?></span>
                                                                <button onclick="return delete_message_confirm(event,<?php echo $item->id ?>,'<?php echo trans("confirm_delete_msggs"); ?>')" class="btn_remove_imgghkkm" style="height:15px; width: 15px;" ><i class="fa fa-trash-o"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; /* end img */ ?>  
                                            <?php elseif($item->dlt_by_sender != 1): ?>
                                                 <?php if ($item->msg_type == 'img'): /* img */ ?>
                                                <div class="message-list-item">
                                                    <div class="message-list-item-row-sent">
                                                        <div class="user-message">
                                                            <?php if( substr(html_escape($item->message), 0, 10 ) === "emoticons/" ) { ?> 
                                                            <div class="message-text">
                                                                <img src="https://www.zolmarket.com/uploads/profile/<?php echo html_escape($item->message); ?>" style="width:50px"  class="" >
                                                            </div>
                                                            <?php }else{ ?>
                                                            <div class="message-text">
                                                                <img src="https://www.zolmarket.com/uploads/profile/<?php echo html_escape($item->message); ?>"   class="img-thumbnail" >
                                                            </div>
                                                            <?php } ?>
                                                            <span class="time" style="min-width: 55.8px;text-align: center;"><?php echo time_ago($item->created_at); ?>
                                                            </span>
                                                            <button onclick="return delete_message_confirm(event,<?php echo $item->id ?>,'<?php echo trans("confirm_delete_msggs"); ?>')" class="btn_remove_imgghkkm" style="height:15px; width: 15px;" ><i class="fa fa-trash-o"></i></button>
                                                        </div>
                                                        <div class="user-avatar">
                                                            <div class="message-user">
                                                                <img src="<?php echo get_user_avatar_by_id($item->sender_id); ?>" alt="" class="img-profile">
                    </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <?php else: ?>
                                                 <div class="message-list-item">
                                                    <div class="message-list-item-row-sent">
                                                        <div class="user-message">
                                                            <div class="message-text">
                                                                <?php echo html_escape($item->message); ?>
                                                            </div>
                                                            <span class="time" style="min-width: 55.8px;text-align: center;"><?php echo time_ago($item->created_at); ?></span>
                                                            <button onclick="return delete_message_confirm(event,<?php echo $item->id ?>,'<?php echo trans("confirm_delete_msggs"); ?>')"  class="btn_remove_imgghkkm" style="height:15px; width: 15px;"><i class="fa fa-trash-o"></i></button>
                                                        </div>
                                                        <div class="user-avatar">
                                                            <div class="message-user">
                                                                <img src="<?php echo get_user_avatar_by_id($item->sender_id); ?>" alt="" class="img-profile">
                    </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endif; /* end img */ ?>  
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                                <?php if($resulttt == false){ ?>
                                   <?php if($resulttt_block == false){ ?>
                                <div class="message-reply">
                                    <!-- form start -->
                                    
                                    <br><br>
                                    <!-- form end -->
                                </div>
                                <?php }else{ ?>
                                     <div class="message-reply text-center text-danger pt-3 border border-danger">
                                       <p><?php echo trans("you_blocked_this_user"); ?> </p>
                                      </div>
                                 <?php }}else{ ?>
                                  <div class="message-reply text-center text-danger pt-3 border border-danger">
                                      <p><?php echo trans("you_can_replay"); ?></p>
                                      </div>
                                 <?php } ?>
                            </div>
        
                        </div>
                        <?php endif; ?>
                    </div>
                <!-- hkm conversation content --->
                </div>
          <?php endif; ?>
        </div>
        <!-- end all messages -->
     

    </div>
</div>
<!-- Wrapper hkm desktop End-->


<?php if (!empty($this->session->userdata('mds_send_email_new_message'))): ?>
    <script>
        $(document).ready(function () {
            var data = {
                "conversation_id": '<?php echo $conversation->id; ?>',
                "sender_id": '<?php echo $this->auth_user->id; ?>',
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


<script>
    $(document).ready(function(){
        $("a[name=chat_profile]").click(function(){
            let url = decodeURIComponent($(location).attr("href"));
            localStorage.setItem('chat_profile_url', url)
        });
        $("html, body").animate({
            scrollTop: 1000
        }, 700);
    })
</script>