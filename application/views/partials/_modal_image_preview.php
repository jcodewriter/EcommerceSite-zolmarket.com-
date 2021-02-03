<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Send Message Modal -->
<div class="modal fade" id="imageModal" tabindex="-2" role="dialog" style="padding-left: 0px !important; padding-right: 0px !important">
    <div class="modal-dialog modal-dialog-centered modal-preview-image" role="document" style="margin: 0 auto; transform: translate(0,-65px) !important;">
        <div class="modal-content image-modal-content" style="padding: 0; background-color: #80808000; border: 0;">
            <div class="modal-header" style="border: 0">
                <div style="display: flex;justify-content: flex-end;position: absolute;top:-20px;right: -25px;left: 0;margin: 0 16px 8px;color: #fff;">
                    <span class="image-preview-close" style="color: #fff;font-size: 20px;padding: 8px 17px;border-radius: 50%;"><i class="fas fa-times"></i></span>
                </div>
            </div>
            <div class="modal-body" style="padding: 0">
                <div class="swiper-container">
					<?php if(auth_check()&&($general_settings->favorite_icon_status == "1")): ?>
						<div class="zolmarket-favorite">
							<a data-toggle="tooltip"data-placement="left"  title="<?php echo trans("wishlist"); ?>"  class="item-favorite-button item-favorite-enable <?php echo (is_product_in_favorites($product->id) == true) ? 'item-favorited' : ''; ?>" data-product-id="<?php echo $product->id; ?>"></a>
						</div>
					<?php endif; ?>
                    <div class="swiper-wrapper">
                    <?php if (!empty($images)):
                        foreach ($images as $image): ?>
                            <div class="swiper-slide">
                                <div class="swiper-zoom-container">
                                    <!-- custom zoomable element -->
                                    <div class="swiper-zoom-target" 
                                        style="
                                            width: 100%;
                                            height: 100%;
                                            background-image: url(<?php echo get_product_image_url($image, 'image_default'); ?>);
                                            background-size: contain;
                                            background-position: center;
                                            background-repeat: no-repeat;"
                                    >
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;
                    endif; ?>
                    </div>
                    <!-- Add Arrows -->
                </div>
            </div>
            <div class="modal-footer" style="border: 0">
                <div style="display: flex;justify-content: center;position: absolute;right: 0;left: 0;bottom: 30px;color: #fff;">
                    <div class="swiper-pagination"></div>    
                </div>
            </div>
        </div>
    </div>
</div>