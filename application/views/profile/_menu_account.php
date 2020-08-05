<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
if (auth_check()){
    $profile = $this->auth_user;
}
?>
<div class="hkm_messages_navCatDownMobile">
	<div class="cat-header">
        <div class="mobile-header-back">
            <a href="<?php echo lang_base_url();?>" class="btn-back-mobile-nav"> <i class="icon-arrow-left"></i> <?php echo trans("back"); ?>  </a>
        </div>
        <div class="mobile-header-title">
            <span  class="text-white textcat-header text-center">
                <?php if(auth_check() && $profile->id == $user->id): ?>
                    <?= trans("profile") ?>
                <?php else: ?>
                    <?= get_shop_name($user)?>
                <?php endif; ?>
            </span>
        </div>
        <div class="mobilde-header-cart">
            <a href="<?php echo lang_base_url(); ?>cart">
                <span style="font-size: 18px;">
                    <i class="fa icon-cart"></i>
                </span>
                <?php $cart_product_count = get_cart_product_count();
                if ($cart_product_count > 0): ?>
                    <span class="notification"><?php echo $cart_product_count; ?></span>
                <?php endif; ?>
            </a>
        </div>
	</div>   
</div>
<br/>