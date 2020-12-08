<?php defined('BASEPATH') or exit('No direct script access allowed');

?>
<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-product pr-2 pl-2" style="border-bottom: 1px solid #0000001a">
    <div class="product-item product-item-th-list">
        <div class="row-custom product-item-solid-image">
            <a class="item-favorite-button item-favorite-enable <?php echo (is_product_in_favorites($product->id) == true) ? 'item-favorited' : ''; ?>" data-product-id="<?php echo $product->id; ?>"></a>
            <a href="<?php echo lang_base_url() . $product->slug; ?>" name="ads_link">
                <div class="solid-img-container">
                    <img src="<?php echo $img_bg_product_small; ?>" data-src="<?php echo get_product_image($product->id, 'image_small'); ?>" alt="<?php echo html_escape($product->title); ?>" class="lazyload img-fluid img-product mb-0" onerror="this.src='<?php echo $img_bg_product_small; ?>'">
                </div>
            </a>
            <?php if ($product->is_promoted && $promoted_products_enabled == 1 && isset($promoted_badge) && $promoted_badge == true) : ?>
                <span class="badge badge-dark badge-promoted"><?php echo trans("promoted"); ?></span>
            <?php endif; ?>
        </div>
        <div class="row-custom item-details" style="padding-left:5px;padding-right:5px;">
            <h3 class="product-title">
                <?php if (is_arabic($product->title)) : ?>
                    <a href="<?php echo generate_product_url($product); ?>" name="">
                        <?php echo html_escape($product->title); ?>
                    </a>
                <?php else : ?>
                    <a href="<?php echo generate_product_url($product); ?>" name="" style="direction: rtl">
                        <?php echo html_escape($product->title); ?>
                    </a>
                <?php endif; ?>
            </h3>
            <!--stars-->
            <div class="product-moreinfo__wrapper">
                <div class="product-rating">
                    <?php if ($general_settings->product_reviews == 1) {
                        $this->load->view('partials/_review_stars', ['review' => $product->rating]);
                    } ?>
                </div>
                <div class="userinfo__wrapper">
                    <?php $user = get_user($product->user_id); ?>
                    <img src="<?php echo get_user_avatar($user); ?>" alt="User" style="width: 35px; height: 35px; border-radius: 50%" />
                    <span class="last-seen <?php echo (is_user_online($user->last_seen)) ? 'last-seen-online' : ''; ?>"> <i class="icon-circle"></i></span>
                </div>
            </div>
            <div class="item-meta">
                <?php $this->load->view('product/_price_product_item', ['product' => $product]); ?>
                <span style="float: right;"><?php echo time_ago($product->created_at); ?></span>
            </div>
        </div>
    </div>
</div>