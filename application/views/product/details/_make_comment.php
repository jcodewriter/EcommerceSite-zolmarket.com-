<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php if (auth_check()) : ?>
    <div class="row">
        <div class="col-12">
            <form id="make_comment_registered">
                <input type="hidden" name="parent_id" value="0">
                <input type="hidden" name="user_id" value="<?php echo user()->id; ?>">
                <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                <input type="hidden" name="name" id="comment_name" value="">
                <input type="hidden" name="email" id="comment_email" value="">
                <div class="form-group">
                    <textarea style="<?= $this->selected_lang->id == 2 ? 'text-align: right;' : '' ?>;" name="comment" id="comment_text" class="form-control form-input form-textarea" placeholder="<?php echo trans("comment"); ?>"></textarea>
                </div>
                <div style="<?= $this->selected_lang->id == 2 ? 'text-align: right;' : '' ?>;">
                    <button type="submit" class="btn btn-md btn-custom"><?php echo trans("submit"); ?></button>
                </div>
            </form>
        </div>
    </div>
<?php else : ?>
    <div class="row">
        <div class="col-12">
            <!--<form id="make_comment_registered">-->
            <div class="form-group">
                <textarea name="comment" id="comment_text" class="form-control form-input form-textarea" placeholder="<?php echo trans("comment"); ?>"></textarea>
            </div>
            <a href="<?php echo lang_base_url() . 'login'; ?>" class="btn btn-md btn-custom"><?php echo trans("submit"); ?></a>
            <!--</form>-->
        </div>
    </div>
<?php endif; ?>