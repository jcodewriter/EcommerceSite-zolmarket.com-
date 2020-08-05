<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<input type="hidden" value="<?php echo $comment_limit; ?>" id="product_comment_limit">
<div class="row">
    <div class="col-12">
        <div class="row-custom error-own-product">
            <p><?php echo trans("review_own_error"); ?></p>
        </div>
        <div class="comments">
            <?php if ($comment_count > 0): ?>
                <div class="row-custom comment-total">
                    <label class="label-comment"><?php echo trans("comments"); ?></label>
                    <span>(<?php echo $comment_count; ?>)</span>
                </div>
            <?php endif; ?>
            <ul class="comment-list">
                <?php foreach ($comments as $comment): ?>
                    <li>
                        <div class="left" style="width: 50px !important;">
                            <a href="<?php echo lang_base_url() . 'profile' . '/' . $comment->user_slug; ?>" name="profile_link" >
                                <img src="<?php echo get_user_avatar_by_id($comment->user_id); ?>" alt="<?php echo html_escape($comment->name); ?>">
                            </a>    
                        </div>
                        <div class="right">
                            <div style="background-color: #eff2f5;padding: 5px 15px;border-radius: 15px;width: fit-content;max-width: 90%;">
                                <a href="<?php echo lang_base_url() . 'profile' . '/' . $comment->user_slug; ?>" name="profile_link" >
                                <span class="username" style="display: block;width: 100%;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;">
                                    <?php if (!empty($comment->user_id)) {
                                        echo get_shop_name_by_user_id($comment->user_id);
                                    } else {
                                        echo html_escape($comment->name);
                                    } ?>
                                </span>
                                </a>
                                <br/>
                                <?php if(is_arabic($comment->comment)):?>
                                    <span class="" style="display: block;word-break: break-word;">
                                <?php else:?>
                                    <span class="" style="display: block;word-break: break-word; direction: rtl">
                                <?php endif;?>
                                    <?php echo html_escape($comment->comment); ?>
                                </span>        
                            </div>
                            <div class="row-custom" style="display: flex !important">
                                <span class="date" style="display: flex; margin-left: 10px;"><?php echo time_ago($comment->created_at); ?></span>
                                <?php if (auth_check()):
                                    if($comment->user_id != user()->id):?>
                                        <a href="javascript:void(0)" class="btn-reply" onclick="show_comment_box('<?php echo $comment->id; ?>');" style="color: #6e6f72;font-weight: 700;"> <?php echo trans('reply'); ?></a>
                                    <?php endif;
                                    if ($comment->user_id == user()->id || user()->role == "admin"): ?>
                                        <a href="javascript:void(0)" class="btn-delete-comment" onclick="delete_comment('<?php echo $comment->id; ?>','<?php echo $product->id; ?>','<?php echo trans("confirm_comment"); ?>');"  style="color: #6e6f72 !important;font-weight: 700;"><?php echo trans("delete"); ?></a>
                                    <?php endif;
                                endif; ?>
                            </div>
                            <div id="sub_comment_form_<?php echo $comment->id; ?>" class="row-custom row-sub-comment visible-sub-comment">

                            </div>
                            <div class="row-custom row-sub-comment">
                                <!-- include subcomments -->
                                <?php $this->load->view('product/details/_subcomments', ['parent_comment' => $comment]); ?>
                            </div>

                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <?php if ($comment_count > $comment_limit): ?>
        <div id="load_comment_spinner" class="col-12 load-more-spinner">
            <div class="row">
                <div class="spinner">
                    <div class="bounce1"></div>
                    <div class="bounce2"></div>
                    <div class="bounce3"></div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <button type="button" class="btn-load-more" onclick="load_more_comment('<?php echo $product->id; ?>');">
                <?php echo trans("load_more"); ?>
            </button>
        </div>
    <?php endif; ?>
</div>
