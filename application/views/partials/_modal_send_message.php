<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Send Message Modal -->
<?php if (auth_check()): ?>
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-send-message" role="document">

            <div class="modal-content">
                <!-- form start -->
                <form id="form_send_message" novalidate="novalidate" onsubmit="return validateblockMyForm();">
                    <input type="hidden" id="sender_id" name="sender_id" value="<?php echo $this->auth_user->id; ?>">
                    <input type="hidden" name="receiver_id" id="message_receiver_id" value="<?php echo $user->id; ?>">
                    <input type="hidden" id="message_send_em" value="<?php echo $user->send_email_new_message; ?>">

                    <div class="modal-header">
                        <h4 class="title"><?php echo trans("send_message"); ?></h4>
                        <button type="button" class="close" data-dismiss="modal"><i class="icon-close"></i></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div id="send-message-result"></div>
                                <div class="form-group m-b-sm-0">
                                    <div class="row justify-content-center m-0">
                                        <div class="user-contact-modal text-center">
                                            <img src="<?php echo get_user_avatar($user); ?>" alt="<?php echo get_shop_name($user); ?>">
                                            <p><?php echo get_shop_name($user); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php if(!empty($slug)):?>
                                    <?php $products = getproduct_by_title_hkm($slug);?>
                                    <?php foreach($products as $product){  ?>
                                        <input type="hidden" name="img_src" id="img_src" value="<?php echo get_product_image($product->id, 'image_small'); ?>" class="form-control form-input" required>
                                    <?php } ?>
                                <?php endif;?>    
                                <input type="hidden" name="slug" id="slug" value="<?php echo (!empty($slug)) ? html_escape($slug) : ''; ?>" class="form-control form-input" required>
                                <div class="form-group">
                                    <?php if(!empty($subject)) :?>
                                        <label class="control-label"><?php echo trans("subject"); ?></label>
                                        <input type="input" name="subject" id="message_subject" value="<?php echo html_escape($subject) ?>" class="form-control form-input" placeholder="<?php echo trans("subject"); ?>" readonly>
                                    <?php else: ?>
                                        <label class="control-label" style="display: none !important"><?php echo trans("subject"); ?></label>
                                        <input type="hidden" name="subject" id="message_subject" value class="form-control form-input" placeholder="<?php echo trans("subject"); ?>" >
                                    <?php endif;?>        
                                </div>
                                <div class="form-group m-b-sm-0">
                                    <label class="control-label"><?php echo trans("message"); ?></label>
                                    <textarea name="message" id="message_text" class="form-control form-textarea" placeholder="<?php echo trans("write_a_message"); ?>" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-md btn-red" data-dismiss="modal"><i class="icon-times"></i>&nbsp;<?php echo trans("close"); ?></button>
                        <button type="submit" class="btn btn-md btn-custom"><i class="icon-send"></i>&nbsp;<?php echo trans("send"); ?></button>
                    </div>
                </form>
                <!-- form end -->
            </div>

        </div>
    </div>
<?php endif; ?>
