<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="hkm_messages_navCatDownMobile">
	<div class="cat-header">
		<div class="mobile-header-back">
			<a href="<?php echo lang_base_url(); ?>" class="btn-back-mobile-nav ads_preview_btn"> <i class="icon-arrow-left"></i> <?php echo trans("back"); ?> </a>
		</div>
		<div class="mobile-header-title">
			<span class="text-white textcat-header text-center"><?php echo trans("sell_now"); ?></span>
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
<div id="wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-sm-offset-12 m-t-30">
				<div class="alert alert-danger alert-large">
					<?php if (empty($this->membership_model->get_user_plan_by_user_id($this->auth_user->id))) : ?>
						<strong><?php echo trans("warning"); ?>!</strong>&nbsp;&nbsp;<?= trans("do_not_have_membership_plan"); ?>
					<?php else : ?>
						<strong><?php echo trans("warning"); ?>!</strong>&nbsp;&nbsp;<?= trans("msg_reached_ads_limit"); ?>
					<?php endif; ?>
				</div>
				<a href="<?= lang_base_url(); ?>settings/membership-plan" class="btn btn-md btn-block btn-slate m-t-30" style="padding: 10px 12px;"><?php echo trans("select_your_plan") ?></a>
			</div>
		</div>
	</div>
</div>