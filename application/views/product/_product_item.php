<?php defined('BASEPATH') or exit('No direct script access allowed');

?>
<div class="col-6 col-sm-6 col-md-6 col-lg-3 col-product pr-1 pl-1">
    <div class="product-item">
        <div class="row-custom">
            <a class="item-favorite-button item-favorite-enable <?php echo (is_product_in_favorites($product->id) == true) ? 'item-favorited' : ''; ?>" data-product-id="<?php echo $product->id; ?>"></a>
            <a href="<?php echo lang_base_url() . $product->slug; ?>" name="ads_link">
                <div class="img-product-container">
                    <img src="<?php echo $img_bg_product_small; ?>" data-src="<?php echo get_product_image($product->id, 'image_small'); ?>" alt="<?php echo html_escape($product->title); ?>" class="lazyload img-fluid img-product mb-0" onerror="this.src='<?php echo $img_bg_product_small; ?>'">
                </div>
            </a>
            <?php if ($product->is_promoted && $promoted_products_enabled == 1 && isset($promoted_badge) && $promoted_badge == true) : ?>
                <span class="badge badge-dark badge-promoted"><?php echo trans("promoted"); ?></span>
            <?php endif; ?>
        </div>
        <div class="row-custom item-details">
            <?php $user = get_user($product->user_id); ?>
            <?php if (get_location($product)) : ?>
                <a href="<?php echo generate_product_url($product); ?>" name="ads_link" class="product-location">
                    <span class="location-icon">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="map-marker-alt" class="svg-inline--fa fa-map-marker-alt fa-w-12" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <path fill="currentColor" d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"></path>
                        </svg>
                    </span>
                    <span class="location-text">
                        <?php echo get_location($product); ?>
                    </span>
                </a>
            <?php endif; ?>
            <h3 class="product-title">
                <?php if (is_arabic($product->title)) : ?>
                    <a href="<?php echo generate_product_url($product); ?>" name="ads_link">
                        <?php echo html_escape($product->title); ?>
                    </a>
                <?php else : ?>
                    <a href="<?php echo generate_product_url($product); ?>" name="ads_link" style="direction: rtl">
                        <?php echo html_escape($product->title); ?>
                    </a>
                <?php endif; ?>
            </h3>
            <!--stars-->
            <div class="product-moreinfo__wrapper">
                <a href="<?php echo generate_product_url($product); ?>" name="ads_link" class="product-rating">
                    <?php if ($general_settings->product_reviews == 1) {
                        $this->load->view('partials/_review_stars', ['review' => $product->rating]);
                    } ?>
                </a>
                <?php if (!@$profile_avatar) : ?>
                    <div class="d-flex align-items-center">
                        <?php if (!$user->is_private) : ?>
                            <span class="store-mark">Store</span>
                        <?php endif; ?>
                        <a href="<?php echo lang_base_url() . 'profile/' . $user->slug; ?>" class="userinfo__wrapper">
                            <img src="<?php echo get_user_avatar($user); ?>" alt="User" style="width: 30px; height: 30px; border-radius: 50%" />
                            <span class="last-seen <?php echo (is_user_online($user->last_seen)) ? 'last-seen-online' : ''; ?>"> <i class="icon-circle"></i></span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <a href="<?php echo generate_product_url($product); ?>" name="ads_link" class="item-meta">
                <?php $this->load->view('product/_price_product_item', ['product' => $product]); ?>
                <span style="float: right;"><?php echo time_ago($product->created_at); ?></span>
            </a>
        </div>
    </div>
</div>