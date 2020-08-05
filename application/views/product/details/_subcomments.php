<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $subcomments = get_subcomments($parent_comment->id); ?>
<?php if (!empty($subcomments)): ?>
    <div class="row">
        <div class="col-12">
            <div class="comments">
                <ul class="comment-list">
                    <?php foreach ($subcomments as $subcomment): ?>
                        <li>
                            <div class="left" style="width: 50px !important;">
                                <a href="<?php echo lang_base_url() . 'profile' . '/' . $subcomment->user_slug; ?>" name="profile_link" >
                                    <img src="<?php echo get_user_avatar_by_id($subcomment->user_id); ?>" alt="<?php echo html_escape($subcomment->name); ?>">
                                </a>    
                            </div>
                            <div class="right">
                                <div style="background-color: #eff2f5;padding: 5px 15px;border-radius: 15px;width: fit-content;max-width: 90%;">
                                    <a href="<?php echo lang_base_url() . 'profile' . '/' . $subcomment->user_slug; ?>" name="profile_link" >
                                        <span class="username" style="display: block;width: 100%;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;">
                                            <?php echo html_escape($subcomment->name); ?>
                                        </span>
                                    </a>    
                                    <br/>
                                    <?php if(is_arabic($subcomment->comment)):?>
                                        <span class="" style="display: block;word-break: break-word;">
                                    <?php else:?>
                                        <span class="" style="display: block;word-break: break-word; direction: rtl">
                                    <?php endif;?>
                                       <span style="font-weight: 600"><?php echo html_escape($subcomment->parent_user_name)?></span> <?php echo html_escape($subcomment->comment); ?>
                                    </span>        
                                </div>
                                <div class="row-custom" style="display: flex;">
                                    <span class="date" style="display: flex; margin-left: 10px;"><?php echo time_ago($subcomment->created_at); ?></span>
                                    <?php if (auth_check()):
                                        if($subcomment->user_id != user()->id):?>
                                            <a href="javascript:void(0)" class="btn-reply" onclick="show_comment_box('<?php echo $subcomment->id; ?>');" style="color: #6e6f72;font-weight: 700;"> <?php echo trans('reply'); ?></a>
                                        <?php endif;
                                        if ($subcomment->user_id == user()->id || user()->role == "admin"): ?>
                                            <a href="javascript:void(0)" class="btn-delete-comment" onclick="delete_comment('<?php echo $subcomment->id; ?>','<?php echo $subcomment->product_id; ?>','<?php echo trans("confirm_comment"); ?>');" style="color: #6e6f72 !important;font-weight: 700;"><?php echo trans("delete"); ?></a>
                                        <?php endif;
                                    endif; ?>
                                </div>
                                <div id="sub_comment_form_<?php echo $subcomment->id; ?>" class="row-custom row-sub-comment visible-sub-comment"></div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
<?php endif; ?>
