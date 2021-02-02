<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="product-item product-item-horizontal">
    <div class="row row-product" style="flex-wrap: nowrap;">
        <div class="col-sm-4" style="width: 45% !important">
        <!-- <div class="col-12 col-sm-4"> -->
            <div class="item-image">
                <div class="zolmarket-favorite">
                    <a data-toggle="tooltip"data-placement="left"  title="<?php echo trans("wishlist"); ?>"  class="item-favorite-button item-favorite-enable <?php echo (is_product_in_favorites($product->id) == true) ? 'item-favorited' : ''; ?>" data-product-id="<?php echo $product->id; ?>"></a>
                </div>
                <a href="<?php echo generate_product_url($product); ?>">
                    <div class="img-product-container">
                        <img src="<?php echo $img_bg_product_small; ?>" data-src="<?php echo get_product_image($product->id, 'image_small'); ?>" alt="<?php echo html_escape($product->title); ?>" class="lazyload img-fluid img-product" onerror="this.src='<?php echo $img_bg_product_small; ?>'">
                    </div>
                </a>
            </div>
        </div>
        <div class="col-sm-6" style="width: 55% !important; padding-left: 0 !important">
            <div class="row-custom item-details">
                <?php if(is_arabic($product->title)):?>
                    <p class="text-truncate" style="text-align:left;text-overflow: clip !important;">
                        <a href="<?php echo generate_product_url($product); ?>"><?php echo html_escape($product->title); ?></a>
                    </p>
                <?php else:?>    
                    <p class="text-truncate" style="text-align:left;direction:rtl;text-overflow: clip !important;">
                        <a href="<?php echo generate_product_url($product); ?>"><?php echo html_escape($product->title); ?></a>
                    </p>
                <?php endif;?>
                <div>
                    <?php if ($product->is_promoted && $promoted_products_enabled == 1 && isset($promoted_badge) && $promoted_badge == true): ?>
                        <img src="<?php echo base_url()."/assets/img/earth.svg"  ?>" width="17px"><span class="badge badge-dark badge-promoted" style="position:unset"><?php echo trans("promoted"); ?>&nbsp;&nbsp;&nbsp;(<?php echo date_difference($product->promote_end_date, date('Y-m-d H:i:s')) . " " . trans("days_left"); ?>)</span>
                    <?php endif; ?>
                </div>
                <?php if(is_arabic(get_shop_name_product($product))):?>
                    <p class="product-user text-truncate" style="text-align:left;text-overflow: clip !important;">
                        <a href="<?php echo lang_base_url() . "profile" . '/' . html_escape($product->user_slug); ?>">
                            <?php echo get_shop_name_product($product); ?>
                        </a>
                    </p>
                <?php else:?>    
                    <p class="product-user text-truncate" style="text-align:left;direction:rtl;text-overflow: clip !important;">
                        <a href="<?php echo lang_base_url() . "profile" . '/' . html_escape($product->user_slug); ?>">
                            <?php echo get_shop_name_product($product); ?>
                        </a>
                    </p>
                <?php endif;?>    
                <!--stars-->
                <?php if ($general_settings->product_reviews == 1) {
                    $this->load->view('partials/_review_stars', ['review' => $product->rating]);
                } ?>
                <div class="item-meta">
                    <span class="price"><?php echo print_price($product->price, $product->currency); ?>
                        <?php if ($product->is_sold == 1): ?>
                            <span>(<?php echo trans("sold"); ?>)</span>
                        <?php endif; ?>
                    </span>
                    <?php if ($general_settings->product_reviews == 1): ?>
                        <span class="item-comments"><i class="icon-comment"></i>&nbsp;<?php echo get_product_comment_count($product->id); ?></span>
                    <?php endif; ?>
                    <span class="item-favorites"><i class="icon-heart-o"></i>&nbsp;<?php echo get_product_favorited_count($product->id); ?></span>
                </div>
            </div>
            <div class="row-custom m-t-10 m-t-10-hidden">
                <?php if (!$product->is_promoted && $promoted_products_enabled == 1): ?>
                    <a href="<?php echo lang_base_url() . "promote-product/pricing/" . $product->id; ?>?type=exist" class="btn btn-sm btn-outline-gray btn-profile-option"><i class="icon-plus"></i>&nbsp;<?php echo trans("promote"); ?></a>
                <?php endif; ?>
                <?php if ($product->is_sold == 1): ?>
                    <a href="javascript:void(0)" class="btn btn-sm btn-outline-gray btn-profile-option" onclick="set_product_as_sold(<?php echo $product->id; ?>);"><i class="icon-price-tag"></i>&nbsp;<?php echo trans("set_as_unsold"); ?></a>
                <?php else: ?>
                    <a href="javascript:void(0)" class="btn btn-sm btn-outline-gray btn-profile-option" onclick="set_product_as_sold(<?php echo $product->id; ?>);"><i class="icon-price-tag"></i>&nbsp;<?php echo trans("set_as_sold"); ?></a>
                <?php endif; ?>
                <a href="<?php echo lang_base_url() . "sell-now/edit-product/" . $product->id; ?>" class="btn btn-sm btn-outline-gray btn-profile-option"><i class="icon-edit"></i>&nbsp;<?php echo trans("edit"); ?></a>
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-gray btn-profile-option" onclick="delete_product(<?php echo $product->id; ?>,'<?php echo trans("confirm_product"); ?>');"><i class="icon-trash"></i>&nbsp;<?php echo trans("delete"); ?></a>
            </div>
        </div>
    </div>
    <div class="row m-t1-10 m-t-5">
        <div class="col-12">
            <?php if (!$product->is_promoted && $promoted_products_enabled == 1): ?>
                <a href="<?php echo lang_base_url() . "promote-product/pricing/" . $product->id; ?>?type=exist" style="float:none;margin-right:0px" class="btn btn-sm btn-outline-gray btn-profile-option blue-font"><i class="icon-plus" style="margin-right: 0px !important;"></i>&nbsp;<?php echo trans("promote"); ?></a>
            <?php endif; ?>
            <?php if ($product->is_sold == 1): ?>
                <a href="javascript:void(0)" style="float:none;margin-right:0px" class="btn btn-sm btn-outline-gray btn-profile-option blue-font" onclick="set_product_as_sold(<?php echo $product->id; ?>);"><i class="icon-price-tag" style="margin-right: 0px !important;"></i>&nbsp;<?php echo trans("set_as_unsold"); ?></a>
            <?php else: ?>
                <a href="javascript:void(0)" style="float:none;margin-right:0px" class="btn btn-sm btn-outline-gray btn-profile-option blue-font" onclick="set_product_as_sold(<?php echo $product->id; ?>);"><i class="icon-price-tag" style="margin-right: 0px !important;"></i>&nbsp;<?php echo trans("set_as_sold"); ?></a>
            <?php endif; ?>
            <a href="<?php echo lang_base_url() . "sell-now/edit-product/" . $product->id; ?>" style="float:none;margin-right:0px" class="btn btn-sm btn-outline-gray btn-profile-option blue-font"><i class="icon-edit" style="margin-right: 0px !important;"></i>&nbsp;<?php echo trans("edit"); ?></a>
            <a href="javascript:void(0)" style="float:none;margin-right:0px" class="btn btn-sm btn-outline-gray btn-profile-option blue-font" onclick="delete_product(<?php echo $product->id; ?>,'<?php echo trans("confirm_product"); ?>');"><i class="icon-trash" style="margin-right: 0px !important;"></i>&nbsp;<?php echo trans("delete"); ?></a>
        </div>    
    </div>
</div>
