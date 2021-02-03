<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php $image_count = 0;
if (!empty($product_images)) {
	$image_count = count($product_images);
} ?>

<?php if ($image_count == 0) :

	if (!empty($video)) : ?>
		<div class="product-video-preview">
			<video id="player" playsinline controls>
				<source src="<?php echo get_product_video_url($video); ?>" type="video/mp4">
			</video>
		</div>
	<?php endif;

	if (!empty($audio)) :
		$this->load->view('product/details/_audio_player');
	endif; ?>

<?php elseif ($image_count == 1) : ?>

	<?php if (!empty($video)) : ?>
		<div class="product-video-preview">
			<video id="player" playsinline controls>
				<source src="<?php echo get_product_video_url($video); ?>" type="video/mp4">
			</video>
		</div>

		<?php if (!empty($audio)) :
			$this->load->view('product/details/_audio_player');
		endif; ?>
	<?php else : ?>
		<?php if (!empty($audio)) :
			$this->load->view('product/details/_audio_player');
		else : ?>
			<?php foreach ($product_images as $image) : ?>
				<div class="product-slider-container">
					<div class="swiper-container">
						
						<?php if(auth_check()): ?>
							<div class="zolmarket-favorite">
								<a data-toggle="tooltip"data-placement="left"  title="<?php echo trans("wishlist"); ?>"  class="item-favorite-button item-favorite-enable <?php echo (is_product_in_favorites($product->id) == true) ? 'item-favorited' : ''; ?>" data-product-id="<?php echo $product->id; ?>"></a>
							</div>
						<?php endif; ?>
						<div class="swiper-slide" style="background-image:url(<?php echo get_product_image_url($image, 'image_default'); ?>"></div>
					</div>
					<?php if (auth_check()) : ?>
						<?php if (user()->id == $product->user_id) : ?>
							<a href="<?= lang_base_url() . '/sell-now/edit-product/' . $product->id; ?>" class="edit-product__button">
								<i class="fa fa-edit  fa-lg align-self-center mr-1 ml-1" aria-hidden="true" style="color: #fd7e14;"></i><?= trans('edit'); ?>
							</a>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			<?php break;
			endforeach; ?>
		<?php endif; ?>

	<?php endif; ?>

<?php else : ?>

	<div class="product-slider-container">
		<div class="swiper-container">
					<?php if(auth_check()): ?>
						<div class="zolmarket-favorite">
							<a data-toggle="tooltip"data-placement="left"  title="<?php echo trans("wishlist"); ?>"  class="item-favorite-button item-favorite-enable <?php echo (is_product_in_favorites($product->id) == true) ? 'item-favorited' : ''; ?>" data-product-id="<?php echo $product->id; ?>"></a>
						</div>
					<?php endif; ?>
			<div class="swiper-wrapper">
				<?php if (!empty($product_images)) :
					foreach ($product_images as $image) : ?>
						<div class="swiper-slide" style="background-image:url(<?php echo get_product_image_url($image, 'image_default'); ?>)"></div>
				<?php endforeach;
				endif; ?>
			</div>
			<!-- Add Arrows -->
			<div style="display: flex;justify-content: center;position: absolute;bottom: 0;right: 0;left: 0;margin: 0 16px 8px;color: #fff;">
				<div class="swiper-pagination"></div>
			</div>

			<!-- Add Arrows -->
			<div class="swiper-button-next" style="padding: 23px;background-color: rgba(0,0,0,0.6);border-radius: 50%;top: 46%;outline: none !important;"></div>
			<div class="swiper-button-prev" style="padding: 23px;background-color: rgba(0,0,0,0.6);border-radius: 50%;top: 46%;outline: none !important;"></div>
		</div>
		<?php if (auth_check()) : ?>
			<?php if (user()->id == $product->user_id) : ?>
				<a href="<?= lang_base_url() . '/sell-now/edit-product/' . $product->id; ?>" class="edit-product__button">
					<i class="fa fa-edit  fa-lg align-self-center mr-1 ml-1" aria-hidden="true" style="color: #fd7e14;"></i><?= trans('edit'); ?>
				</a>
			<?php endif; ?>
		<?php endif; ?>
	</div>

<?php if (!empty($audio)) :
		$this->load->view('product/details/_audio_player');
	endif;
endif; ?>

<script>
	$(document).ready(function() {
		setTimeout(function() {
			$(".product-video-preview").css("opacity", "1");
		}, 300);
		setTimeout(function() {
			$(".product-audio-preview").css("opacity", "1");
		}, 300);
	});
</script>