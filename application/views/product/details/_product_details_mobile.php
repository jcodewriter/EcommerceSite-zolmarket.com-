<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php if ($product->product_type == 'digital') :
	if ($product->is_free_product == 1) :
		if ($this->auth_check) : ?>
			<div class="row-custom m-t-10">
				<?php echo form_open('file_controller/download_free_digital_file'); ?>
				<input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
				<button class="btn btn-instant-download"><i class="icon-download-solid"></i><?php echo trans("download") ?></button>
				<?php echo form_close(); ?>
			</div>
		<?php else : ?>
			<div class="row-custom m-t-10">
				<button class="btn btn-instant-download" data-toggle="modal" data-target="#loginModal"><i class="icon-download-solid"></i><?php echo trans("download") ?></button>
			</div>
		<?php endif; ?>
	<?php else : ?>
		<?php if (!empty($digital_sale)) : ?>
			<div class="row-custom m-t-10">
				<?php echo form_open('file_controller/download_purchased_digital_file'); ?>
				<input type="hidden" name="sale_id" value="<?php echo $digital_sale->id; ?>">
				<button class="btn btn-instant-download"><i class="icon-download-solid"></i><?php echo trans("download") ?></button>
				<?php echo form_close(); ?>
			</div>
		<?php else : ?>
			<label class="label-instant-download"><i class="icon-download-solid"></i><?php echo trans("instant_download"); ?></label>
<?php endif;
	endif;
endif; ?>
<div style="display: flex;">
	<div class="" style="flex: 1">
		<?php if ($general_settings->product_reviews == 1) : ?>
			<div class="row-custom review-link" style="display: flex">
				<label class="label-review" style="margin-right: 5px;"><?php echo trans("reviews"); ?></label>
				<!--stars-->
				<?php $this->load->view('partials/_review_stars', ['review' => $product->rating]); ?>
				<?php if ($review_count > 0) : ?>
					<span style="margin-top: 1px">(<?php echo $review_count; ?>)</span>
				<?php else : ?>
					<span style="margin-top: 1px">(0)</span>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="" style="flex-direction: row; align-items: flex-end">
		<?php if ($general_settings->product_comments == 1) : ?>
			<div class="row-custom comment-link">
				<?php if ($comment_count > 0) : ?>
					<span>(<?php echo $comment_count; ?>)</span>
				<?php else : ?>
					<span>(0)</span>
				<?php endif; ?>
				<label class="label-comment"><?php echo trans("comments"); ?></label>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php if (is_arabic($product->title)) : ?>
	<h2 style="white-space: nowrap;text-overflow: ellipsis;width: 100% !important;display: block;overflow: hidden;font-weight: 600;font-size: 16px;margin-top: 10px;"> <?php echo html_escape($product->title); ?> </h2>
<?php else : ?>
	<h2 style="white-space: nowrap;text-overflow: ellipsis;width: 100% !important;display: block;overflow: hidden;font-weight: 600;font-size: 16px;margin-top: 10px;direction: rtl"> <?php echo html_escape($product->title); ?> </h2>
<?php endif; ?>
<div class="row-custom price" style="margin-bottom: 0px;">
	<?php if ($product->listing_type != 'bidding') : ?>
		<?php if ($product->is_sold == 1) : ?>
			<strong class="lbl-price" style="color: #9a9a9a;"><?php echo print_price($product->price, $product->currency); ?><span class="price-line"></span></strong>
			<strong class="lbl-sold"><?php echo trans("sold"); ?></strong>
		<?php elseif ($product->is_free_product == 1) : ?>
			<strong class="lbl-free"><?php echo trans("free"); ?></strong>
		<?php else : ?>
			<strong class="lbl-price"><?php echo print_price($product->price, $product->currency); ?></strong>
		<?php endif; ?>
	<?php endif; ?>
</div>
<?php if ($product->status == 0) : ?>
	<label class="badge badge-warning badge-product-status"><?php echo trans("pending"); ?></label>
<?php elseif ($product->visibility == 0) : ?>
	<label class="badge badge-danger badge-product-status"><?php echo trans("hidden"); ?></label>
<?php endif; ?>
<?php $user = get_user($product->user_id); ?>
<div class="row-custom meta" style="margin-bottom: 15px;    margin-top: -15px;">
	<div class="product-details-left" style="white-space: nowrap; text-overflow: clip; width: 90% !important; display: flex; overflow: hidden;">
		<?php if (is_arabic(get_shop_name_product($product))) : ?>
			<a href="<?php echo lang_base_url() . 'profile' . '/' . $product->user_slug; ?>" style="display: block" name="profile_link">
				<img src="<?php echo base_url() . $user->avatar; ?>" style="width:50px; height:50px; border-radius: 50%;" />
				<span class="online-state last_seen_hkm signle_msgsd last-seen <?php echo (is_user_online($user->last_seen)) ? 'last-seen-online' : ''; ?>" style="top: 34px; left: 33px"><i class="icon-circle"></i></span>
			</a>
			<div style="margin-top: 15px;">
				&nbsp;<a href="<?php echo lang_base_url() . 'profile' . '/' . $product->user_slug; ?>" name="profile_link"><?php echo get_shop_name_product($product); ?></a>
			</div>
		<?php else : ?>
			<a href="<?php echo lang_base_url() . 'profile' . '/' . $product->user_slug; ?>" style="display: block" name="profile_link">
				<img src="<?php echo base_url() . $user->avatar; ?>" style="width:50px; height:50px; border-radius: 50%;" />
				<span class="online-state last_seen_hkm signle_msgsd last-seen <?php echo (is_user_online($user->last_seen)) ? 'last-seen-online' : ''; ?>" style="top: 34px; left: 33px"><i class="icon-circle"></i></span>
			</a>
			<div style="margin-top: 15px;">
				&nbsp;<a href="<?php echo lang_base_url() . 'profile' . '/' . $product->user_slug; ?>" style="direction: rtl" name="profile_link"><?php echo get_shop_name_product($product); ?></a>
			</div>
		<?php endif; ?>
	</div>

</div>
<div class="row-custom meta" style="margin-bottom: 5px;">
	<div class="product-details" style="margin-top: -3px; margin-bottom: 8px;">
		<?php if ($general_settings->product_reviews == 1) : ?>
			<span><i class="icon-comment"></i><?php echo html_escape($comment_count); ?></span>
		<?php endif; ?>
		<span><i class="icon-heart"></i><?php echo get_product_favorited_count($product->id); ?></span>
		<span><i class="icon-eye"></i><?php echo html_escape($product->hit); ?></span>
	</div>
	<div class="product-details-right" style="flex: 1;margin-top: -15px;">
		<?php if (auth_check()) : ?>
			<button class="btn btn-contact-seller" data-toggle="modal" data-target="#messageModal"><i class="icon-envelope"></i> <?php echo trans("ask_question") ?></button>
		<?php else : ?>
			<button class="btn btn-contact-seller" data-toggle="modal" data-target="#loginModal"><i class="icon-envelope"></i> <?php echo trans("ask_question") ?></button>
		<?php endif; ?>
	</div>
</div>
<!--<div class="row" style="border: 1px solid red; width: 100%"></div>-->
<div class="row-custom details">
	<div class="item-details" style="border-top: 1px solid #e9ecef;">
		<div class="product-details-left">
			<label><?php echo trans("uploaded"); ?></label>
		</div>
		<div class="product-details-right">
			<span><?php echo time_ago($product->created_at); ?></span>
		</div>
	</div>
	<?php if (!empty($product->quantity)) : ?>
		<div class="item-details">
			<div class="product-details-left">
				<label><?php echo trans("quantity"); ?></label>
			</div>
			<div class="product-details-right">
				<span><?php echo html_escape($product->quantity); ?></span>
			</div>
		</div>
	<?php endif; ?>
	<?php if (!empty($product->quantity)) : ?>
		<div class="item-details">
			<div class="product-details-left">
				<label><?php echo trans("category"); ?></label>
			</div>
			<div class="product-details-right">
				<?php $category = get_category_joined($product->third_category_id);
				if (!empty($category)) : ?>
					<span><?php echo html_escape($category->name); ?></span>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
	<?php if (!empty($product->product_condition)) : ?>
		<div class="item-details">
			<div class="product-details-left">
				<label><?php echo trans("condition"); ?></label>
			</div>
			<div class="product-details-right">
				<?php $product_condition = get_product_condition_by_key($product->product_condition, $selected_lang->id);
				if (!empty($product_condition)) : ?>
					<span><?php echo html_escape($product_condition->option_label); ?></span>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
	<?php if ($product->product_type == 'digital') : ?>
		<div class="item-details">
			<div class="product-details-left">
				<label><?php echo trans("files_included"); ?></label>
			</div>
			<div class="product-details-right">
				<span><?php echo html_escape($product->files_included); ?></span>
			</div>
		</div>
	<?php endif; ?>
	<?php if ($product->product_type == 'physical' && $product->country_id != 0) : ?>
		<div class="item-details">
			<div class="product-details-left">
				<label><?php echo trans("location"); ?></label>
			</div>
			<div class="product-details-right">
				<span><?php echo get_location_input($product->country_id, $product->state_id, $product->city_id); ?></span>
			</div>
		</div>
	<?php endif; ?>
	<?php if (!empty($custom_fields)) : ?>
		<?php foreach ($custom_fields as $custom_field) :
			if (!empty($custom_field->field_value) || !empty($custom_field->field_common_ids)) : ?>
				<div class="item-details">
					<div class="product-details-left">
						<strong><?php echo html_escape($custom_field->name); ?></strong>
					</div>
					<div class="product-details-right">
						<span><?php echo get_custom_field_value($custom_field); ?></span>
					</div>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>
	<?php if (!empty($product->shipping_cost_type)) : ?>
		<div class="item-details">
			<div class="product-details-left">
				<strong><?php echo trans("shipping"); ?></strong>
			</div>
			<div class="product-details-right">
				<span><?php echo trans($product->shipping_time); ?></span>
			</div>
		</div>
		<div class="item-details">
			<div class="product-details-left">
				<strong><?php echo trans("shipping_cost"); ?></strong>
			</div>
			<div class="product-details-right">
				<?php $shipping_cost_type = get_shipping_option_by_key($product->shipping_cost_type, $selected_lang->id);
				if (!empty($shipping_cost_type)) :
					if ($shipping_cost_type->shipping_cost != 1) : ?>
						<span><?php echo $shipping_cost_type->option_label; ?></span>
					<?php else : ?>
						<span><?php echo print_price($product->shipping_cost, $product->currency); ?></span>
				<?php endif;
				endif; ?>
			</div>
		</div>
	<?php endif; ?>
	<div class="product-description-container" style="margin-top: 15px;">
		<?php $this->load->view("product/details/_description"); ?>
	</div>
</div>

<!--Include buttons-->
<?php $this->load->view("product/details/_buttons", ['input_id_suffix' => 'mb', 'input_form_suffix' => 'mobile']); ?>

<!--Include social share-->
<?php $this->load->view("product/details/_product_share"); ?>

<script>
	$(document).ready(function() {
		$("a[name=profile_link]").click(function() {
			let url = decodeURIComponent($(location).attr("href"));
			localStorage.setItem('chat_profile_url', url)
		})
	})
</script>