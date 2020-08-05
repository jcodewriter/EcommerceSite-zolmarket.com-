<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if (auth_check()): ?>
    <div class="row">
        <div class="col-12">
            <form id="make_comment_registered">
                <input type="hidden" name="parent_id" value="0">
                <input type="hidden" name="user_id" value="<?php echo user()->id; ?>">
                <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                <input type="hidden" name="name" id="comment_name" value="">
                <input type="hidden" name="email" id="comment_email" value="">
                <div class="form-group">
                    <textarea name="comment" id="comment_text" class="form-control form-input form-textarea" placeholder="<?php echo trans("comment"); ?>"></textarea>
                </div>
                <button type="submit" class="btn btn-md btn-custom"><?php echo trans("submit"); ?></button>
            </form>
        </div>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-12">
            <!--<form id="make_comment_registered">-->
                <div class="form-group">
                    <textarea name="comment" id="comment_text" class="form-control form-input form-textarea" placeholder="<?php echo trans("comment"); ?>"></textarea>
                </div>
                <button type="submit" class="btn btn-md btn-custom" data-toggle="modal" data-target="#loginModal"><?php echo trans("submit"); ?></button>
            <!--</form>-->
        </div>
    </div>
<?php endif; ?>
