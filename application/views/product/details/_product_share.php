<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row-custom product-share social-tabs">
    <div class="social-tab-item">
        <a href="javascript:void(0)" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo generate_product_url($product); ?>', 'Share This Post', 'width=640,height=450');return false"
            class="btn btn-md btn-share facebook">
            <i class="icon-facebook"></i>
            <span>Facebook</span>
        </a>
    </div>
    <div class="social-tab-item">
        <a href="javascript:void(0)" onclick="window.open('https://twitter.com/share?url=<?php echo generate_product_url($product); ?>&amp;text=<?php echo html_escape($product->title); ?>', 'Share This Post', 'width=640,height=450');return false"
            class="btn btn-md btn-share twitter">
            <i class="icon-twitter"></i>
            <span>Twitter</span>
        </a>
    </div>
    <div class="social-tab-item">
        <a href="https://api.whatsapp.com/send?text=<?php echo html_escape($product->title); ?> - <?php echo generate_product_url($product); ?>" target="_blank"
            class="btn btn-md btn-share whatsapp">
            <i class="icon-whatsapp"></i>
            <span>Whatsapp</span>
        </a>
    </div>
    <div class="social-tab-item">
        <a href="javascript:void(0)" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php echo generate_product_url($product); ?>&amp;media=<?php echo get_product_image($product->id, 'image_default'); ?>', 'Share This Post', 'width=640,height=450');return false"
            class="btn btn-md btn-share pinterest">
            <i class="icon-pinterest"></i>
            <span>Pinterest</span>
        </a>
    </div>
</div>


