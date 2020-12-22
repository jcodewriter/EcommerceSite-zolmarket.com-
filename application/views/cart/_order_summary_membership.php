<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-sm-12 col-lg-5 order-summary-container">
	<h2 class="cart-section-title"><?= trans("order_summary"); ?></h2>
	<div class="right">
		<?php if (!empty($plan)) : ?>
			<div class="cart-order-details">
				<div class="item">
					<div class="item-right">
						<div class="list-item m-t-15">
							<label><?= trans("membership_plan"); ?>:</label>
							<strong class="lbl-price"><?= get_membership_plan_name($plan->title_array, $this->selected_lang->id); ?></strong>
						</div>
						<div class="list-item">
							<label><?= trans("price"); ?>:</label>
							<strong class="lbl-price"><?= price_formatted($plan->price, $this->payment_settings->default_product_currency); ?></strong>
						</div>
					</div>
				</div>
			</div>
			<p class="m-t-30">
				<strong><?= trans("subtotal"); ?><span class="float-right"><?= price_formatted($plan->price, $this->payment_settings->default_product_currency); ?></span></strong>
			</p>
			<p class="line-seperator"></p>
			<p>
				<strong><?= trans("total"); ?><span class="float-right"><?= price_formatted($plan->price, $this->payment_settings->default_product_currency); ?></span></strong>
			</p>
		<?php endif; ?>
	</div>
</div>