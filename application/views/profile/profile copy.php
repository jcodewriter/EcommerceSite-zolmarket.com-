<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
 if (auth_check()){
$profile = $this->auth_user;
}
?>



<?php $this->load->view("profile/_menu_account"); ?>


<!-- Wrapper -->
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="nav-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a
                                    href="<?php echo lang_base_url(); ?>"><?php echo trans("home"); ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo trans("account"); ?></li>
                    </ol>

                </nav>
            </div>
        </div>
        <!--Check auth-->
        <?php if (auth_check()): ?>
            <div class="row d-none d-md-block">
               
            </div>
        <?php endif; ?>
        <div class="row hkmnone_userinfo">
            <div class="col-12">
                <div class="profile-page-top">
                    <!-- load profile details -->
                    <?php $this->load->view("profile/_profile_user_info"); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-3 hkmnone_tabs">
                <!-- load profile nav -->
                <?php $this->load->view("profile/_profile_tabs"); ?>
            </div>
            <div class="col-sm-12 col-md-9 hidden-sm-down">
                <div class="profile-tab-content">
                    <?php if (auth_check() && user()->id == $user->id):
                        foreach ($products as $product):
                            $this->load->view('product/_product_item_profile', ['product' => $product, 'promoted_badge' => true]);
                        endforeach;
                    else: ?>
                        <div class="row row-product-items row-product">
                            <!--print products-->
                            <?php foreach ($products as $product): ?>
                                <!-- <div class="col-6 col-sm-6 col-md-6 col-lg-4 col-product"> -->
                                    <?php $this->load->view('product/_product_item', ['product' => $product, 'promoted_badge' => true]); ?>
                                <!-- </div> -->
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="product-list-pagination">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
                <div class="row-custom">
                    <!--Include banner-->
                    <?php $this->load->view("partials/_ad_spaces", ["ad_space" => "profile", "class" => "m-t-30"]); ?>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Wrapper End-->
<div class="hidden-md-up">
    <!-- ==== products ===== --->
    <div class="navCatDownMobile nav-mobile hkmproducts">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('products');?></span>
        </div>
        <div  class="nav-mobile-inner">
            <div class="profile-tab-content">
                <?php if (auth_check() && user()->id == $user->id):
                    foreach ($mproducts as $product):
                        $this->load->view('product/_product_item_profile', ['product' => $product, 'promoted_badge' => true]);
                    endforeach;
                else: ?>
                    <div class="row row-product-items row-product">
                        <!--print products-->
                        <?php foreach ($mproducts as $product): ?>
                            <!-- <div class="col-6 col-sm-6 col-md-6 col-lg-4 col-product"> -->
                                <?php $this->load->view('product/_product_item', ['product' => $product, 'promoted_badge' => true]); ?>
                            <!-- </div> -->
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php
            /*
             <div class="product-list-pagination">
                 <?php echo $this->pagination->create_links(); ?>
             </div>
            */
            ?>
            <div class="row-custom">
                <!--Include banner -->
                <?php $this->load->view("partials/_ad_spaces", ["ad_space" => "profile", "class" => "m-t-30"]); ?>
            </div>
        </div>
    </div>
    <!-- ==== pending products ===== --->
    <div class="navCatDownMobile nav-mobile hkmpending_products">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('pending_products');?></span>
        </div>
        <div  class="nav-mobile-inner">
            <div class="profile-tab-content">
                <?php if (auth_check() && user()->id == $user->id):
                    foreach ($mpending_products as $product):
                        $this->load->view('product/_product_item_profile', ['product' => $product, 'promoted_badge' => true]);
                    endforeach;
                else: ?>
                    <div class="row row-product-items">
                        <!--print products-->
                        <?php foreach ($mpending_products as $product): ?>
                            <!-- <div class="col-12 col-sm-6 col-md-6 col-lg-4"> -->
                                <?php $this->load->view('product/_product_item', ['product' => $product, 'promoted_badge' => true]); ?>
                            <!-- </div> -->
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>


            <div class="row-custom">
                <!--Include banner-->
                <?php $this->load->view("partials/_ad_spaces", ["ad_space" => "profile", "class" => "m-t-30"]); ?>
            </div>
        </div>
    </div>
    <!-- ==== hidden products ===== --->
    <div class="navCatDownMobile nav-mobile hkmhidden_products">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('hidden_products');?></span>
        </div>
        <div  class="nav-mobile-inner">
            <div class="profile-tab-content">
                <?php if (auth_check() && user()->id == $user->id):
                    foreach ($mhidden_products as $product):
                        $this->load->view('product/_product_item_profile', ['product' => $product, 'promoted_badge' => true]);
                    endforeach;
                else: ?>
                    <div class="row row-product-items">
                        <!--print products-->
                        <?php foreach ($mhidden_products as $product): ?>
                            <!-- <div class="col-12 col-sm-6 col-md-6 col-lg-4"> -->
                                <?php $this->load->view('product/_product_item', ['product' => $product, 'promoted_badge' => true]); ?>
                            <!-- </div> -->
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>


            <div class="row-custom">
                <!--Include banner-->
                <?php $this->load->view("partials/_ad_spaces", ["ad_space" => "profile", "class" => "m-t-30"]); ?>
            </div>
        </div>
    </div>
    <!-- ==== drafts ===== --->
    <div class="navCatDownMobile nav-mobile hkmdrafts">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('drafts');?></span>
        </div>
        <div  class="nav-mobile-inner">
            <div class="profile-tab-content">
                <?php foreach ($mdraft_products as $product):
                    $this->load->view('product/_product_item_draft', ['product' => $product]);
                endforeach; ?>
            </div>

            <div class="row-custom">
                <!--Include banner-->
                <?php $this->load->view("partials/_ad_spaces", ["ad_space" => "profile", "class" => "m-t-30"]); ?>
            </div>
        </div>
    </div>
    <!-- ==== favorites ===== --->
    <div class="navCatDownMobile nav-mobile hkmfavorites">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('favorites');?></span>
        </div>
        <div  class="nav-mobile-inner">
            <div class="profile-tab-content">
                <div class="row row-product-items row-product">
                    <!--print products-->
                    <?php foreach ($mfavorites_products as $product): ?>
                        <!-- <div class="col-6 col-sm-6 col-md-6 col-lg-4 col-product"> -->
                            <?php $this->load->view('product/_product_item', ['product' => $product, 'promoted_badge' => true]); ?>
                        <!-- </div> -->
                    <?php endforeach; ?>
                </div>
                <div class="row-custom">
                    <!--Include banner-->
                    <?php $this->load->view("partials/_ad_spaces", ["ad_space" => "profile", "class" => "m-t-30"]); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- ==== downloads ===== --->
    <div class="navCatDownMobile nav-mobile hkmdownloads">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('downloads');?></span>
        </div>
        <br>
        <div class="nav-mobile-inner">
            <div class="profile-tab-content">
                <?php
                if (!empty($mitems)):
                    foreach ($mitems as $item):
                        $product = get_available_product($item->product_id);
                        if (!empty($product)):?>
                            <div class="product-item product-item-horizontal">
                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <div class="item-image">
                                            <a href="<?php echo generate_product_url($product); ?>">
                                                <div class="img-product-container">
                                                    <img src="<?php echo $img_bg_product_small; ?>" data-src="<?php echo get_product_image($product->id, 'image_small'); ?>" alt="<?php echo html_escape($product->title); ?>" class="lazyload img-fluid img-product" onerror="this.src='<?php echo $img_bg_product_small; ?>'">
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-8">
                                        <div class="row-custom item-details">
                                            <h3 class="product-title">
                                                <a href="<?php echo generate_product_url($product); ?>">
                                                    <?php echo html_escape($product->title); ?>
                                                </a>
                                            </h3>
                                            <p class="product-user text-truncate">
                                                <a href="<?php echo lang_base_url() . "profile" . '/' . html_escape($product->user_slug); ?>">
                                                    <?php echo get_shop_name_product($product); ?>
                                                </a>
                                            </p>
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
                                        <div class="row-custom m-t-10">
                                            <?php echo form_open('file_controller/download_purchased_digital_file'); ?>
                                            <input type="hidden" name="sale_id" value="<?php echo $item->id; ?>">
                                            <div class="dm-uploaded-digital-file">
                                                <button type="submit" class="btn btn-md btn-custom">
                                                    <i class="icon-download-solid"></i>&nbsp;&nbsp;<?php echo trans("download"); ?>
                                                </button>
                                            </div>
                                            <?php echo form_close(); ?>
                                        </div>
                                        <div class="row-custom m-t-20">
                                            <p class="item-purchase-code"><span><?php echo trans("purchase_code"); ?>:</span><span><?php echo $item->purchase_code; ?></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif;
                    endforeach;
                endif; ?>
            </div>
        </div>
    </div>
    <!-- ==== followers ===== --->
    <div class="navCatDownMobile nav-mobile hkmfollowers">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('followers');?></span>
        </div>
        <div  class="nav-mobile-inner">
            <div class="profile-tab-content">
                <div class="row">
                    <?php foreach ($mfollowers as $item): ?>
                        <div class="col-4 col-sm-2">
                            <div class="follower-item">
                                <a href="<?php echo generate_profile_url($item); ?>">
                                    <img src="<?php echo get_user_avatar($item); ?>" alt="<?php echo get_shop_name($item); ?>" class="img-fluid img-profile lazyload">
                                    <p class="username">
                                        <?php echo get_shop_name($item); ?>
                                    </p>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="row-custom">
                    <!--Include banner-->
                    <?php $this->load->view("partials/_ad_spaces", ["ad_space" => "profile", "class" => "m-t-30"]); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- ==== following ===== --->
    <div class="navCatDownMobile nav-mobile hkmfollowing">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('following');?></span>
        </div>
        <div  class="nav-mobile-inner">
            <div class="profile-tab-content">
                <div class="row">
                    <?php foreach ($mfollowing_users as $item): ?>
                        <div class="col-4 col-sm-2">
                            <div class="follower-item">
                                <a href="<?php echo generate_profile_url($item); ?>">
                                    <img src="<?php echo get_user_avatar($item); ?>" alt="<?php echo get_shop_name($item); ?>" class="img-fluid img-profile lazyload">
                                    <p class="username">
                                        <?php echo get_shop_name($item); ?>
                                    </p>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="row-custom">
                    <!--Include banner-->
                    <?php $this->load->view("partials/_ad_spaces", ["ad_space" => "profile", "class" => "m-t-30"]); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- ==== Reviews ===== --->
    <div class="navCatDownMobile nav-mobile hkmreviews">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('reviews');?></span>
        </div>
        <div  class="nav-mobile-inner">
            <div class="profile-tab-content">

                <div id="user-review-result" class="user-reviews">
                    <?php $this->load->view('profile/_muser_reviews'); ?>
                </div>

                <div class="row-custom">
                    <!--Include banner-->
                    <?php $this->load->view("partials/_ad_spaces", ["ad_space" => "profile", "class" => "m-t-30"]); ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- ==== Orders ===== --->
    <div class="navCatDownMobile nav-mobile hkmorders">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('orders');?></span>
        </div>
        <div  class="nav-mobile-inner">
            <div class="profile-tab-content">
                 <div class="row">
                    <div class="col-sm-12 col-md-9" style="margin-top: 30px;">
                        <h5> <span><?php echo trans('orders');?></span> </h5> <br/>
                        <div class="profile-tabs">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" id="hkmorders_active" href="<?php echo lang_base_url(); ?>orders">
                                        <i class="icon-shopping-basket" style="display: inline;"></i>
                                        <?php echo trans('active_orders');?>
                                        <span class="count hidden-sm-up" style="width:auto;">
                                        <i class="fas fa-angle-right"></i>
                                        </span>
                                    </a>
                                </li>
                                 <li class="nav-item">
                                    <a class="nav-link" id="hkmorders_completed" href="<?php echo lang_base_url(); ?>orders">
                                        <i class="icon-shopping-basket" style="display: inline;"></i>
                                        <?php echo trans('completed_orders');?>
                                        <span class="count hidden-sm-up" style="width:auto;">
                                        <i class="fas fa-angle-right"></i>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ==== Active Orders ===== --->
    <div class="navCatDownMobile nav-mobile hkmorders_active">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('active_orders');?></span>
        </div>
        <div  class="nav-mobile-inner">
            <div class="profile-tab-content">
                 <div class="row">
                    <div class="col-sm-12 col-md-9" style="margin-top: 30px;">
                        <h5> <span><?php echo trans('active_orders');?></span> </h5> <br/>
                        <div class="row-custom">
                            <div class="" style="margin-bottom: 70px;">
                                <!-- include message block -->
                                <?php $this->load->view('partials/_messages'); ?>
                                <div class="table-responsive">
                                    <table class="table table-orders">
                                        <thead>
                                        <tr>
                                            <th scope="col"><?php echo trans("order"); ?></th>
                                            <th scope="col"><?php echo trans("total"); ?></th>
                                            <th scope="col"><?php echo trans("payment"); ?></th>
                                            <th scope="col"><?php echo trans("status"); ?></th>
                                            <th scope="col"><?php echo trans("date"); ?></th>
                                            <th scope="col"><?php echo trans("options"); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($orders)): ?>
                                            <?php foreach ($orders as $order): ?>
                                                <tr>
                                                    <td>#<?php echo $order->order_number; ?></td>
                                                    <td><?php echo print_price($order->price_total, $order->price_currency); ?></td>
                                                    <td>
                                                        <?php if ($order->payment_status == 'payment_received'):
                                                            echo trans("payment_received");
                                                        else:
                                                            echo trans("awaiting_payment");
                                                        endif; ?>
                                                    </td>
                                                    <td>
                                                        <strong>
                                                            <?php if ($order->payment_status == 'awaiting_payment'):
                                                                echo trans("awaiting_payment");
                                                            else:
                                                                if ($order->status == 1):
                                                                    echo trans("completed");
                                                                else:
                                                                    echo trans("order_processing");
                                                                endif;
                                                            endif; ?>
                                                        </strong>
                                                    </td>
                                                    <td><?php echo date("Y-m-d / h:i", strtotime($order->created_at)); ?></td>
                                                    <td>
                                                        <a href="<?php echo lang_base_url(); ?>order/<?php echo $order->order_number; ?>" class="btn btn-sm btn-custom"><?php echo trans("details"); ?></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
        
        
                                <?php if (empty($orders)): ?>
                                    <p class="text-center">
                                        <?php echo trans("no_records_found"); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ==== Completed Orders ===== --->
    <div class="navCatDownMobile nav-mobile hkmorders_completed">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('completed_orders');?></span>
        </div>
        <div  class="nav-mobile-inner">
            <div class="profile-tab-content">
                 <div class="row">
                    <div class="col-sm-12 col-md-9" style="margin-top: 30px;">
                        <h5> <span><?php echo trans('completed_orders');?></span> </h5> <br/>
                        <div class="row-custom">
                            <div class="" style="margin-bottom: 70px;">
                                <!-- include message block -->
                                <?php $this->load->view('partials/_messages'); ?>
                                <div class="table-responsive">
                                    <table class="table table-orders">
                                        <thead>
                                        <tr>
                                            <th scope="col"><?php echo trans("order"); ?></th>
                                            <th scope="col"><?php echo trans("total"); ?></th>
                                            <th scope="col"><?php echo trans("payment"); ?></th>
                                            <th scope="col"><?php echo trans("status"); ?></th>
                                            <th scope="col"><?php echo trans("date"); ?></th>
                                            <th scope="col"><?php echo trans("options"); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($compelte_orders)): ?>
                                            <?php foreach ($compelte_orders as $order): ?>
                                                <tr>
                                                    <td>#<?php echo $order->order_number; ?></td>
                                                    <td><?php echo print_price($order->price_total, $order->price_currency); ?></td>
                                                    <td>
                                                        <?php if ($order->payment_status == 'payment_received'):
                                                            echo trans("payment_received");
                                                        else:
                                                            echo trans("awaiting_payment");
                                                        endif; ?>
                                                    </td>
                                                    <td>
                                                        <strong>
                                                            <?php if ($order->payment_status == 'awaiting_payment'):
                                                                echo trans("awaiting_payment");
                                                            else:
                                                                if ($order->status == 1):
                                                                    echo trans("completed");
                                                                else:
                                                                    echo trans("order_processing");
                                                                endif;
                                                            endif; ?>
                                                        </strong>
                                                    </td>
                                                    <td><?php echo date("Y-m-d / h:i", strtotime($order->created_at)); ?></td>
                                                    <td>
                                                        <a href="<?php echo lang_base_url(); ?>order/<?php echo $order->order_number; ?>" class="btn btn-sm btn-custom"><?php echo trans("details"); ?></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
        
        
                                <?php if (empty($compelte_orders)): ?>
                                    <p class="text-center">
                                        <?php echo trans("no_records_found"); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- ==== Sales ===== --->
    <div class="navCatDownMobile nav-mobile hkmsales">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('sales');?></span>
        </div>
        <div  class="nav-mobile-inner">
            <div class="profile-tab-content">
                 <div class="row">
                    <div class="col-sm-12 col-md-9" style="margin-top: 30px;">
                         <h5> <span> <?php echo trans('sales');?></span> </h5> <br/>
                        <div class="profile-tabs">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" id="hkmsales_active" href="<?php echo lang_base_url(); ?>orders">
                                        <i class="icon-shopping-bag" style="display: inline;"></i>
                                        <?php echo trans('active_sales');?>
                                        <span class="count hidden-sm-up" style="width:auto;">
                                        <i class="fas fa-angle-right"></i>
                                        </span>
                                    </a>
                                </li>
                                 <li class="nav-item">
                                    <a class="nav-link" id="hkmsales_completed" href="<?php echo lang_base_url(); ?>orders">
                                        <i class="icon-shopping-bag" style="display: inline;"></i>
                                        <?php echo trans('completed_sales');?>
                                        <span class="count hidden-sm-up" style="width:auto;">
                                        <i class="fas fa-angle-right"></i>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ==== Active Sales ===== --->
    <div class="navCatDownMobile nav-mobile hkmsales_active">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('active_sales');?></span>
        </div>
        <div  class="nav-mobile-inner">
            <div class="profile-tab-content">
                 <div class="row">
                    <div class="col-sm-12 col-md-9" style="margin-top: 30px;">
                        <h5> <span><?php echo trans('active_sales');?></span> </h5> <br/>
                        <div class="row-custom">
                            <div class="" style="margin-bottom: 70px;">
                                <!-- include message block -->
                                <?php $this->load->view('partials/_messages'); ?>
                                <div class="table-responsive">
                                        <table class="table table-orders">
                                            <thead>
                                            <tr>
                                                <th scope="col"><?php echo trans("order"); ?></th>
                                                <th scope="col"><?php echo trans("total"); ?></th>
                                                <th scope="col"><?php echo trans("payment"); ?></th>
                                                <th scope="col"><?php echo trans("status"); ?></th>
                                                <th scope="col"><?php echo trans("date"); ?></th>
                                                <th scope="col"><?php echo trans("options"); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if (!empty($sales)): ?>
                                                <?php foreach ($sales as $order):
                                                    $sale = get_order($order->id);
                                                    $total = $this->order_model->get_seller_total_price($order->id);
                                                    if (!empty($sale)):?>
                                                        <tr>
                                                            <td>#<?php echo $sale->order_number; ?></td>
                                                            <td><?php echo print_price($total, $sale->price_currency); ?></td>
                                                            <td>
                                                                <?php if ($sale->payment_status == 'payment_received'):
                                                                    echo trans("payment_received");
                                                                else:
                                                                    echo trans("awaiting_payment");
                                                                endif; ?>
                                                            </td>
                                                            <td>
                                                                <strong>
                                                                    <?php if ($sale->payment_status == 'awaiting_payment'):
                                                                        echo trans("awaiting_payment");
                                                                    else:
                                                                        if ($active_tab == "active_sales"):
                                                                            echo trans("order_processing");
                                                                        else:
                                                                            echo trans("completed");
                                                                        endif;
                                                                    endif; ?>
                                                                </strong>
                                                            </td>
                                                            <td><?php echo date("Y-m-d / h:i", strtotime($sale->created_at)); ?></td>
                                                            <td>
                                                                <a href="<?php echo lang_base_url(); ?>sale/<?php echo $sale->order_number; ?>" class="btn btn-sm btn-custom"><?php echo trans("details"); ?></a>
                                                            </td>
                                                        </tr>
                                                    <?php endif;
                                                endforeach; ?>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
        
                                <?php if (empty($sales)): ?>
                                    <p class="text-center">
                                        <?php echo trans("no_records_found"); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ==== Completed Sales ===== --->
    <div class="navCatDownMobile nav-mobile hkmsales_completed">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('completed_sales');?></span>
        </div>
        <div  class="nav-mobile-inner">
            <div class="profile-tab-content">
                 <div class="row">
                    <div class="col-sm-12 col-md-9" style="margin-top: 30px;">
                        <h5> <span><?php echo trans('completed_sales');?></span> </h5> <br/>
                       <div class="row-custom">
                            <div class="profile-tab-content">
                                <!-- include message block -->
                                <?php $this->load->view('partials/_messages'); ?>
                                <div class="table-responsive">
                                        <table class="table table-orders">
                                            <thead>
                                            <tr>
                                                <th scope="col"><?php echo trans("order"); ?></th>
                                                <th scope="col"><?php echo trans("total"); ?></th>
                                                <th scope="col"><?php echo trans("payment"); ?></th>
                                                <th scope="col"><?php echo trans("status"); ?></th>
                                                <th scope="col"><?php echo trans("date"); ?></th>
                                                <th scope="col"><?php echo trans("options"); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if (!empty($compelte_sales)): ?>
                                                <?php foreach ($compelte_sales as $order):
                                                    $sale = get_order($order->id);
                                                    $total = $this->order_model->get_seller_total_price($order->id);
                                                    if (!empty($sale)):?>
                                                        <tr>
                                                            <td>#<?php echo $sale->order_number; ?></td>
                                                            <td><?php echo print_price($total, $sale->price_currency); ?></td>
                                                            <td>
                                                                <?php if ($sale->payment_status == 'payment_received'):
                                                                    echo trans("payment_received");
                                                                else:
                                                                    echo trans("awaiting_payment");
                                                                endif; ?>
                                                            </td>
                                                            <td>
                                                                <strong>
                                                                    <?php if ($sale->payment_status == 'awaiting_payment'):
                                                                        echo trans("awaiting_payment");
                                                                    else:
                                                                        if ($active_tab == "active_sales"):
                                                                            echo trans("order_processing");
                                                                        else:
                                                                            echo trans("completed");
                                                                        endif;
                                                                    endif; ?>
                                                                </strong>
                                                            </td>
                                                            <td><?php echo date("Y-m-d / h:i", strtotime($sale->created_at)); ?></td>
                                                            <td>
                                                                <a href="<?php echo lang_base_url(); ?>sale/<?php echo $sale->order_number; ?>" class="btn btn-sm btn-custom"><?php echo trans("details"); ?></a>
                                                            </td>
                                                        </tr>
                                                    <?php endif;
                                                endforeach; ?>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
        
                                <?php if (empty($compelte_sales)): ?>
                                    <p class="text-center">
                                        <?php echo trans("no_records_found"); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
     <!-- ==== Earnings ===== --->
    <div class="navCatDownMobile nav-mobile hkmearnings">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('earnings');?></span>
        </div>
        <div  class="nav-mobile-inner">
            <div class="profile-tab-content">
                 <div class="row">
                    <div class="col-sm-12 col-md-9" style="margin-top: 30px;">
                         <h5> <span><?php echo trans('earnings');?></span> </h5> <br/>
                        <div class="profile-tabs">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" id="hkmearnings_hkmearnings" href="<?php echo lang_base_url(); ?>orders">
                                        <i class="icon-wallet" style="display: inline;"></i>
                                        <?php echo trans('earnings');?>
                                        <span class="count hidden-sm-up" style="width:auto;">
                                        <i class="fas fa-angle-right"></i>
                                        </span>
                                    </a>
                                </li>
                                 <li class="nav-item">
                                    <a class="nav-link" id="hkmearnings_payouts" href="<?php echo lang_base_url(); ?>orders">
                                        <i class="icon-wallet" style="display: inline;"></i>
                                        <?php echo trans('payouts');?>
                                        <span class="count hidden-sm-up" style="width:auto;">
                                        <i class="fas fa-angle-right"></i>
                                        </span>
                                    </a>
                                </li>
                                 <li class="nav-item">
                                    <a class="nav-link" id="hkmearnings_setpayoutaccount" href="<?php echo lang_base_url(); ?>orders">
                                        <i class="icon-wallet" style="display: inline;"></i>
                                        <?php echo trans('set_payout_account');?>
                                        <span class="count hidden-sm-up" style="width:auto;">
                                        <i class="fas fa-angle-right"></i>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- ==== Earnings Earnings ===== --->
    <div class="navCatDownMobile nav-mobile hkmearnings_hkmearnings">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('earnings');?></span>
        </div>
        <div  class="nav-mobile-inner">
            <div class="profile-tab-content">
                 <div class="row">
                    <div class="col-sm-12 col-md-9" style="margin-top: 30px;">
                        <h5> <span><?php echo trans('earnings');?></span> </h5> <br/>
                       
                         <div class="row-custom">
                    <div class="earnings-boxes">
                        <div class="row justify-content-center">
                            <div class="col-12 col-sm-6 m-b-sm-15">
                                <div class="earnings-box">
                                    <p class="title"><?php echo trans("sales"); ?></p>
                                    <p class="price"><?php echo $user->number_of_sales; ?></p>
                                    <p class="description"><?php echo trans("number_of_total_sales"); ?></p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="earnings-box">
                                    <p class="title"><?php echo trans("balance"); ?></p>
                                    <p class="price"><?php echo print_price($user->balance, $this->payment_settings->default_product_currency); ?></p>
                                    <p class="description"><?php echo trans("balance_exp"); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-custom table-earnings-container">
                    <div class="table-responsive">
                        <table class="table table-orders">
                            <thead>
                            <tr>
                                <th scope="col"><?php echo trans("order"); ?></th>
                                <th scope="col"><?php echo trans("price"); ?></th>
                                <th scope="col"><?php echo trans("commission_rate"); ?></th>
                                <th scope="col"><?php echo trans("shipping_cost"); ?></th>
                                <th scope="col"><?php echo trans("earned_amount"); ?></th>
                                <th scope="col"><?php echo trans("date"); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($earnings as $earning): ?>
                                <tr>
                                    <td>#<?php echo $earning->order_number; ?></td>
                                    <td><?php echo print_price($earning->price, $earning->currency); ?></td>
                                    <td><?php echo $earning->commission_rate; ?>%</td>
                                    <td><?php echo print_price($earning->shipping_cost, $earning->currency); ?></td>
                                    <td><?php echo print_price($earning->earned_amount, $earning->currency); ?></td>
                                    <td><?php echo date("Y-m-d / h:i", strtotime($earning->created_at)); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if (empty($earnings)): ?>
                        <p class="text-center">
                            <?php echo trans("no_records_found"); ?>
                        </p>
                    <?php endif; ?>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- ==== Earnings Payouts ===== --->
    <div class="navCatDownMobile nav-mobile hkmearnings_payouts">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('payouts');?></span>
        </div>
        <div  class="nav-mobile-inner">
            <div class="profile-tab-content">
                 <div class="row">
                    <div class="col-sm-12 col-md-9" style="margin-top: 30px;">
                        <h5> <span><?php echo trans('payouts');?></span> </h5> <br/>
                       
                         <div class="row">
                            <div class="col-12 col-md-7">
                                <div class="withdraw-money-container">
                                    <h2 class="title"><?php echo trans("withdraw_money"); ?></h2>
                                    <?php echo form_open('earnings_controller/withdraw_money_post', ['id' => 'form_validate_payout_1', 'class' => 'validate_price',]); ?>
                                    <div class="form-group">
                                        <label><?php echo trans("withdraw_amount"); ?></label>
                                        <?php
                                        $min_value = 0;
                                        if ($payment_settings->payout_paypal_enabled) {
                                            $min_value = $payment_settings->min_payout_paypal;
                                        } elseif ($payment_settings->payout_iban_enabled) {
                                            $min_value = $payment_settings->min_payout_iban;
                                        } elseif ($payment_settings->payout_swift_enabled) {
                                            $min_value = $payment_settings->min_payout_swift;
                                        } ?>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text input-group-text-currency" id="basic-addon2"><?php echo get_currency($payment_settings->default_product_currency); ?></span>
                                                <input type="hidden" name="currency" value="<?php echo $payment_settings->default_product_currency; ?>">
                                            </div>
                                            <input type="text" name="amount" id="product_price_input" aria-describedby="basic-addon2" class="form-control form-input price-input validate-price-input " placeholder="<?php echo $this->input_initial_price; ?>" onpaste="return false;" maxlength="32" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo trans("withdraw_method"); ?></label>
                                        <div class="selectdiv">
                                            <select name="payout_method" class="form-control" onchange="update_payout_input(this.value);" required>
                                                <?php if ($payment_settings->payout_paypal_enabled): ?>
                                                    <option value="paypal"><?php echo trans("paypal"); ?></option>
                                                <?php endif; ?>
                                                <?php if ($payment_settings->payout_iban_enabled): ?>
                                                    <option value="iban"><?php echo trans("iban"); ?></option>
                                                <?php endif; ?>
                                                <?php if ($payment_settings->payout_swift_enabled): ?>
                                                    <option value="swift"><?php echo trans("swift"); ?></option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-md btn-custom"><?php echo trans("submit"); ?></button>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="minimum-payout-container">
                                    <h2 class="title"><?php echo trans("min_poyout_amounts"); ?></h2>
                                    <?php if ($payment_settings->payout_paypal_enabled): ?>
                                        <p><span><?php echo trans("paypal"); ?></span>:<strong><?php echo print_price($payment_settings->min_payout_paypal, $payment_settings->default_product_currency) ?></strong></p>
                                    <?php endif; ?>
                                    <?php if ($payment_settings->payout_iban_enabled): ?>
                                        <p><span><?php echo trans("iban"); ?></span>:<strong><?php echo print_price($payment_settings->min_payout_iban, $payment_settings->default_product_currency) ?></strong></p>
                                    <?php endif; ?>
                                    <?php if ($payment_settings->payout_swift_enabled): ?>
                                        <p><span><?php echo trans("swift"); ?></span>:<strong><?php echo print_price($payment_settings->min_payout_swift, $payment_settings->default_product_currency) ?></strong></p>
                                    <?php endif; ?>
                                    <hr>
                                    <?php if (auth_check()): ?>
                                        <p><?php echo trans("your_balance"); ?>:<strong><?php echo print_price(user()->balance, $payment_settings->default_product_currency) ?></strong></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
        
                        <div class="row-custom table-earnings-container">
                            <div class="table-responsive">
                                <table class="table table-orders">
                                    <thead>
                                    <tr>
                                        <th scope="col"><?php echo trans("withdraw_method"); ?></th>
                                        <th scope="col"><?php echo trans("withdraw_amount"); ?></th>
                                        <th scope="col"><?php echo trans("status"); ?></th>
                                        <th scope="col"><?php echo trans("date"); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($payouts as $payout): ?>
                                        <tr>
                                            <td><?php echo trans($payout->payout_method); ?></td>
                                            <td><?php echo print_price($payout->amount, $payout->currency); ?></td>
                                            <td>
                                                <?php if ($payout->status == 1) {
                                                    echo trans("completed");
                                                } else {
                                                    echo trans("pending");
                                                } ?>
                                            </td>
                                            <td><?php echo date("Y-m-d / h:i", strtotime($payout->created_at)); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php if (empty($payouts)): ?>
                                <p class="text-center">
                                    <?php echo trans("no_records_found"); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- ==== Earnings Set Payout Account ===== --->
    <div class="navCatDownMobile nav-mobile hkmearnings_setpayoutaccount">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('set_payout_account');?></span>
        </div>
        <div  class="nav-mobile-inner">
            <div class="profile-tab-content">
                 <div class="row">
                    <div class="col-sm-12 col-md-9" style="margin-top: 30px;">
                        <h5> <span><?php echo trans('set_payout_account');?></span> </h5> <br/>
                       
                         <div class="col-sm-12 col-md-9">
                <?php
                $active_tab = $this->session->flashdata('msg_payout');
                if (empty($active_tab)) {
                    $active_tab = "paypal";
                }
                $show_all_tabs = false;
                ?>
                <!-- Nav pills -->
                <ul class="nav nav-pills nav-payout-accounts justify-content-center">
                    <?php if ($payment_settings->payout_paypal_enabled): $show_all_tabs = true; ?>
                        <li class="nav-item">
                            <a class="nav-link nav-link-paypal <?php echo ($active_tab == 'paypal') ? 'active' : ''; ?>" data-toggle="pill" href="#tab_paypal"><?php echo trans("paypal"); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if ($payment_settings->payout_iban_enabled): $show_all_tabs = true; ?>
                        <li class="nav-item">
                            <a class="nav-link nav-link-bank <?php echo ($active_tab == 'iban') ? 'active' : ''; ?>" data-toggle="pill" href="#tab_iban"><?php echo trans("iban"); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if ($payment_settings->payout_swift_enabled): $show_all_tabs = true; ?>
                        <li class="nav-item">
                            <a class="nav-link nav-link-swift <?php echo ($active_tab == 'swift') ? 'active' : ''; ?>" data-toggle="pill" href="#tab_swift"><?php echo trans("swift"); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
                <?php $active_tab_content = 'paypal'; ?>
                <!-- Tab panes -->
                <?php if ($show_all_tabs): ?>
                    <div class="tab-content">
                        <div class="tab-pane container <?php echo ($active_tab == 'paypal') ? 'active' : 'fade'; ?>" id="tab_paypal">

                            <?php if ($active_tab == "paypal"):
                                $this->load->view('partials/_messages');
                            endif; ?>

                            <?php echo form_open('earnings_controller/set_paypal_payout_account_post', ['id' => 'form_validate_payout_1']); ?>
                            <div class="form-group">
                                <label><?php echo trans("paypal_email_address"); ?>*</label>
                                <input type="email" name="payout_paypal_email" class="form-control form-input" value="<?php echo html_escape($user_payout->payout_paypal_email); ?>" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-md btn-custom"><?php echo trans("save_changes"); ?></button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                        <div class="tab-pane container <?php echo ($active_tab == 'iban') ? 'active' : 'fade'; ?>" id="tab_iban">

                            <?php if ($active_tab == "iban"):
                                $this->load->view('partials/_messages');
                            endif; ?>

                            <?php echo form_open('earnings_controller/set_iban_payout_account_post', ['id' => 'form_validate_payout_2']); ?>
                            <div class="form-group">
                                <label><?php echo trans("full_name"); ?>*</label>
                                <input type="text" name="iban_full_name" class="form-control form-input" value="<?php echo html_escape($user_payout->iban_full_name); ?>" required>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-6 m-b-sm-15">
                                        <label><?php echo trans("country"); ?>*</label>
                                        <div class="selectdiv">
                                            <select name="iban_country_id" class="form-control" required>
                                                <option value="" selected><?php echo trans("select_country"); ?></option>
                                                <?php foreach ($countries as $item): ?>
                                                    <option value="<?php echo $item->id; ?>" <?php echo ($user_payout->iban_country_id == $item->id) ? 'selected' : ''; ?>><?php echo html_escape($item->name); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label><?php echo trans("bank_name"); ?>*</label>
                                        <input type="text" name="iban_bank_name" class="form-control form-input" value="<?php echo html_escape($user_payout->iban_bank_name); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><?php echo trans("iban_long"); ?>(<?php echo trans("iban"); ?>)*</label>
                                <input type="text" name="iban_number" class="form-control form-input" value="<?php echo html_escape($user_payout->iban_number); ?>" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-md btn-custom"><?php echo trans("save_changes"); ?></button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                        <div class="tab-pane container <?php echo ($active_tab == 'swift') ? 'active' : 'fade'; ?>" id="tab_swift">

                            <?php if ($active_tab == "swift"):
                                $this->load->view('partials/_messages');
                            endif; ?>

                            <?php echo form_open('earnings_controller/set_swift_payout_account_post', ['id' => 'form_validate_payout_3']); ?>
                            <div class="form-group">
                                <label><?php echo trans("full_name"); ?>*</label>
                                <input type="text" name="swift_full_name" class="form-control form-input" value="<?php echo html_escape($user_payout->swift_full_name); ?>" required>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-6 m-b-sm-15">
                                        <label><?php echo trans("country"); ?>*</label>
                                        <div class="selectdiv">
                                            <select name="swift_country_id" class="form-control" required>
                                                <option value="" selected><?php echo trans("select_country"); ?></option>
                                                <?php foreach ($countries as $item): ?>
                                                    <option value="<?php echo $item->id; ?>" <?php echo ($user_payout->swift_country_id == $item->id) ? 'selected' : ''; ?>><?php echo html_escape($item->name); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label><?php echo trans("state"); ?>*</label>
                                        <input type="text" name="swift_state" class="form-control form-input" value="<?php echo html_escape($user_payout->swift_state); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-6 m-b-sm-15">
                                        <label><?php echo trans("city"); ?>*</label>
                                        <input type="text" name="swift_city" class="form-control form-input" value="<?php echo html_escape($user_payout->swift_city); ?>" required>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label><?php echo trans("postcode"); ?>*</label>
                                        <input type="text" name="swift_postcode" class="form-control form-input" value="<?php echo html_escape($user_payout->swift_postcode); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><?php echo trans("address"); ?>*</label>
                                <input type="text" name="swift_address" class="form-control form-input" value="<?php echo html_escape($user_payout->swift_address); ?>" required>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-6 m-b-sm-15">
                                        <label><?php echo trans("bank_account_holder_name"); ?>*</label>
                                        <input type="text" name="swift_bank_account_holder_name" class="form-control form-input" value="<?php echo html_escape($user_payout->swift_bank_account_holder_name); ?>" required>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label><?php echo trans("bank_name"); ?>*</label>
                                        <input type="text" name="swift_bank_name" class="form-control form-input" value="<?php echo html_escape($user_payout->swift_bank_name); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-6 m-b-sm-15">
                                        <label><?php echo trans("bank_branch_country"); ?>*</label>
                                        <div class="selectdiv">
                                            <select name="swift_bank_branch_country_id" class="form-control" required>
                                                <option value="" selected><?php echo trans("select_country"); ?></option>
                                                <?php foreach ($countries as $item): ?>
                                                    <option value="<?php echo $item->id; ?>" <?php echo ($user_payout->swift_bank_branch_country_id == $item->id) ? 'selected' : ''; ?>><?php echo html_escape($item->name); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label><?php echo trans("bank_branch_city"); ?>*</label>
                                        <input type="text" name="swift_bank_branch_city" class="form-control form-input" value="<?php echo html_escape($user_payout->swift_bank_branch_city); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><?php echo trans("swift_iban"); ?>*</label>
                                <input type="text" name="swift_iban" class="form-control form-input" value="<?php echo html_escape($user_payout->swift_iban); ?>" required>
                            </div>
                            <div class="form-group">
                                <label><?php echo trans("swift_code"); ?>*</label>
                                <input type="text" name="swift_code" class="form-control form-input" value="<?php echo html_escape($user_payout->swift_code); ?>" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-md btn-custom"><?php echo trans("save_changes"); ?></button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- ==== Quote requests ===== --->
    <div class="navCatDownMobile nav-mobile hkmquoterequests">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('quote_requests');?></span>
        </div>
        <div  class="nav-mobile-inner">
            <div class="profile-tab-content">
                 <div class="row">
                    <div class="col-sm-12 col-md-9" style="margin-top: 30px;">
                         <h5> <span><?php echo trans('quote_requests');?></span> </h5> <br/>
                        <div class="profile-tabs">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" id="hkmquoterequests_recieved" href="<?php echo lang_base_url(); ?>orders">
                                        <i class="icon-wallet" style="display: inline;"></i>
                                        <?php echo trans('received_quote_requests');?>
                                        <span class="count hidden-sm-up" style="width:auto;">
                                        <i class="fas fa-angle-right"></i>
                                        </span>
                                    </a>
                                </li>
                                 <li class="nav-item">
                                    <a class="nav-link" id="hkmquoterequests_sent" href="<?php echo lang_base_url(); ?>orders">
                                        <i class="icon-wallet" style="display: inline;"></i>
                                        <?php echo trans('sent_quote_requests');?>
                                        <span class="count hidden-sm-up" style="width:auto;">
                                        <i class="fas fa-angle-right"></i>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- ==== Received Quote requests ===== --->
    <div class="navCatDownMobile nav-mobile hkmquoterequests_recieved">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('received_quote_requests');?></span>
        </div>
        <div  class="nav-mobile-inner">
            <div class="profile-tab-content">
                 <div class="row">
                    <div class="col-sm-12 col-md-9" style="margin-top: 30px;">
                        <h5> <span><?php echo trans('received_quote_requests');?></span> </h5> <br/>
                        
                        <div class="row-custom">
        					<div class="profile-tab-content">
        						<!-- include message block -->
        						<?php $this->load->view('partials/_messages'); ?>
        						<div class="table-responsive">
        							<table class="table table-quote_requests table-striped">
        								<thead>
        								<tr>
        									<th scope="col"><?php echo trans("quote"); ?></th>
        									<th scope="col"><?php echo trans("product"); ?></th>
        									<th scope="col"><?php echo trans("buyer"); ?></th>
        									<th scope="col"><?php echo trans("status"); ?></th>
        									<th scope="col"><?php echo trans("sellers_bid"); ?></th>
        									<th scope="col"><?php echo trans("updated"); ?></th>
        									<th scope="col"><?php echo trans("options"); ?></th>
        								</tr>
        								</thead>
        								<tbody>
        								<?php if (!empty($quote_requests)): ?>
        									<?php foreach ($quote_requests as $quote_request):
        										$quote_product = get_product($quote_request->product_id); ?>
        										<tr>
        											<td>#<?php echo $quote_request->id; ?></td>
        											<td>
        												<?php if (!empty($quote_product)): ?>
        													<div class="table-item-product">
        														<div class="left">
        															<div class="img-table">
        																<a href="<?php echo base_url() . $quote_product->slug; ?>" target="_blank">
        																	<img src="<?php echo get_product_image($quote_product->id, 'image_small'); ?>" data-src="" alt="" class="lazyload img-responsive post-image"/>
        																</a>
        															</div>
        														</div>
        														<div class="right">
        															<a href="<?php echo base_url() . $quote_product->slug; ?>" target="_blank">
        																<h3 class="table-product-title"><?php echo $quote_request->product_title; ?></h3>
        															</a>
        															<?php echo trans("quantity") . ": " . $quote_request->product_quantity; ?>
        														</div>
        													</div>
        												<?php else: ?>
        													<h3 class="table-product-title"><?php echo $quote_request->product_title; ?></h3>
        												<?php endif; ?>
        											</td>
        											<td>
        												<?php $buyer = get_user($quote_request->buyer_id);
        												if (!empty($buyer)): ?>
        													<a href="<?php echo generate_profile_url($buyer); ?>" target="_blank" class="font-600">
        														<?php echo html_escape($buyer->username); ?>
        													</a>
        												<?php endif; ?>
        											</td>
        											<td><?php echo trans($quote_request->status); ?></td>
        											<td>
        												<?php if ($quote_request->status != 'new_quote_request' && $quote_request->price_offered != 0): ?>
        													<div class="table-seller-bid">
        														<p><b><?php echo trans("price"); ?>:&nbsp;</b><strong><?php echo print_price($quote_request->price_offered, $quote_request->price_currency); ?></strong></p>
        														<?php if (!empty($quote_product) && $quote_product->product_type == 'digital'): ?>
        															<p><b><?php echo trans("shipping"); ?>:&nbsp;</b><strong><?php echo trans("no_shipping"); ?></strong></p>
        														<?php else: ?>
        															<p><b><?php echo trans("shipping"); ?>:&nbsp;</b><strong><?php echo print_price($quote_request->shipping_cost, $quote_request->price_currency); ?></strong></p>
        														<?php endif; ?>
        														<p><b><?php echo trans("total"); ?>:&nbsp;</b><strong><?php echo print_price($quote_request->price_offered + $quote_request->shipping_cost, $quote_request->price_currency); ?></strong></p>
        													</div>
        												<?php endif; ?>
        											</td>
        											<td><?php echo time_ago($quote_request->updated_at); ?></td>
        											<td>
        												<?php if ($quote_request->status == 'new_quote_request'): ?>
        													<button type="button" class="btn btn-sm btn-info btn-table-option btn_submit_quote" data-toggle="modal" data-target="#modalSubmitQuote<?php echo $quote_request->id; ?>"><?php echo trans("submit_a_quote"); ?></button>
        												<?php elseif ($quote_request->status == 'pending_quote'): ?>
        													<button type="button" class="btn btn-sm btn-info btn-table-option btn_update_quote" data-toggle="modal" data-target="#modalSubmitQuote<?php echo $quote_request->id; ?>"><?php echo trans("update_quote"); ?></button>
        												<?php elseif ($quote_request->status == 'rejected_quote'): ?>
        													<button type="button" class="btn btn-sm btn-info btn-table-option btn_submit_quote" data-toggle="modal" data-target="#modalSubmitQuote<?php echo $quote_request->id; ?>"><?php echo trans("submit_a_new_quote"); ?></button>
        												<?php endif; ?>
        												<button type="button" class="btn btn-sm btn-danger btn-table-option" onclick="delete_quote_request(<?php echo $quote_request->id; ?>,'<?php echo trans("confirm_quote_request"); ?>');"><?php echo trans("delete_quote"); ?></button>
        											</td>
        										</tr>
        									<?php endforeach; ?>
        								<?php endif; ?>
        								</tbody>
        							</table>
        						</div>
        
        
        						<?php if (empty($quote_requests)): ?>
        							<p class="text-center">
        								<?php echo trans("no_records_found"); ?>
        							</p>
        						<?php endif; ?>
        					</div>
        				</div>
        				<!-- Modal -->
<?php if (!empty($quote_requests)):
	foreach ($quote_requests as $quote_request):
		$quote_product = get_product($quote_request->product_id); ?>
		<div class="modal fade" id="modalSubmitQuote<?php echo $quote_request->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content modal-custom">
					<!-- form start -->
					<?php echo form_open_multipart('bidding_controller/submit_quote'); ?>
					<div class="modal-header">
						<h5 class="modal-title"><?php echo trans("submit_a_quote"); ?></h5>
						<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true"><i class="icon-close"></i> </span>
						</button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="id" class="form-control" value="<?php echo $quote_request->id; ?>">

						<div class="form-group">
							<label class="control-label"><?php echo trans('price'); ?></label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text input-group-text-currency" id="basic-addon1"><?php echo get_currency($payment_settings->default_product_currency); ?></span>
									<input type="hidden" name="currency" value="<?php echo $payment_settings->default_product_currency; ?>">
								</div>
								<input type="text" name="price" aria-describedby="basic-addon1" class="form-control form-input price-input validate-price-input" data-item-id="<?php echo $quote_request->id; ?>" data-product-quantity="<?php echo $quote_request->product_quantity; ?>"
									   placeholder="<?php echo $this->input_initial_price; ?>" onpaste="return false;" maxlength="32" required>
							</div>
						</div>
						<?php if (!empty($quote_product) && $quote_product->product_type == 'digital'): ?>
							<input type="hidden" name="shipping_cost" value="0">
							<input type="hidden" name="currency" value="<?php echo $payment_settings->default_product_currency; ?>">
						<?php else: ?>
							<div class="form-group">
								<label class="control-label"><?php echo trans('shipping_cost'); ?></label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text input-group-text-currency" id="basic-addon1"><?php echo get_currency($payment_settings->default_product_currency); ?></span>
										<input type="hidden" name="currency" value="<?php echo $payment_settings->default_product_currency; ?>">
									</div>
									<input type="text" name="shipping_cost" aria-describedby="basic-addon1" class="form-control form-input price-input validate-price-input" placeholder="<?php echo $this->input_initial_price; ?>" onpaste="return false;" maxlength="32" required>
								</div>
							</div>
						<?php endif; ?>
						<div class="form-group">
							<p class="calculated-price">
								<strong><?php echo trans("unit_price"); ?> (<?php echo get_currency($payment_settings->default_product_currency); ?>):&nbsp;&nbsp;
									<i id="unit_price_<?php echo $quote_request->id; ?>" class="earned-price">
										<?php echo number_format(0, 2, '.', ''); ?>
									</i>
								</strong><br>
								<strong><?php echo trans("you_will_earn"); ?> (<?php echo get_currency($payment_settings->default_product_currency); ?>):&nbsp;&nbsp;
									<i id="earned_price_<?php echo $quote_request->id; ?>" class="earned-price">
										<?php $earned_price = $quote_product->price - (($quote_product->price * $general_settings->commission_rate) / 100);
										$earned_price = number_format($earned_price, 2, '.', '');
										echo price_format_input($earned_price); ?>
									</i>
								</strong>&nbsp;&nbsp;&nbsp;
								<small> (<?php echo trans("commission_rate"); ?>:&nbsp;&nbsp;<?php echo $general_settings->commission_rate; ?>%)</small>
							</p>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-md btn-red" data-dismiss="modal"><?php echo trans("close"); ?></button>
						<button type="submit" class="btn btn-md btn-custom"><?php echo trans("submit"); ?></button>
					</div>
					<?php echo form_close(); ?><!-- form end -->
				</div>
			</div>
		</div>
	<?php endforeach;
endif; ?>


<script>
    //calculate product earned value
    var thousands_separator = '<?php echo $this->thousands_separator; ?>';
    var commission_rate = '<?php echo $this->general_settings->commission_rate; ?>';
    $(document).on("input keyup paste change", ".price-input", function () {
        var input_val = $(this).val();
        var data_item_id = $(this).attr('data-item-id');
        var data_product_quantity = $(this).attr('data-product-quantity');
        input_val = input_val.replace(',', '.');
        var price = parseFloat(input_val);
        commission_rate = parseInt(commission_rate);
        //calculate earned price
        if (!Number.isNaN(price)) {
            var earned_price = price - ((price * commission_rate) / 100);
            earned_price = earned_price.toFixed(2);
            if (thousands_separator == ',') {
                earned_price = earned_price.replace('.', ',');
            }
        } else {
            earned_price = '0' + thousands_separator + '00';
        }

        //calculate unit price
        if (!Number.isNaN(price)) {
            var unit_price = price / data_product_quantity;
            unit_price = unit_price.toFixed(2);
            if (thousands_separator == ',') {
                unit_price = unit_price.replace('.', ',');
            }
        } else {
            unit_price = '0' + thousands_separator + '00';
        }

        $("#earned_price_" + data_item_id).html(earned_price);
        $("#unit_price_" + data_item_id).html(unit_price);
    });

    $(document).on("click", ".btn_submit_quote", function () {
        $('.modal-title').text("<?php echo trans("submit_a_quote"); ?>");
    });
    $(document).on("click", ".btn_update_quote", function () {
        $('.modal-title').text("<?php echo trans("update_quote"); ?>");
    });
</script>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ==== Sent Quote requests ===== --->
    <div class="navCatDownMobile nav-mobile hkmquoterequests_sent">
        <div class="form-group cat-header">
            <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            <span  class="text-white textcat-header text-center"><?php echo trans('sent_quote_requests');?></span>
        </div>
        <div  class="nav-mobile-inner">
            <div class="profile-tab-content">
                 <div class="row">
                    <div class="col-sm-12 col-md-9" style="margin-top: 30px;">
                        <h5> <span><?php echo trans('sent_quote_requests');?></span> </h5> <br/>
                        
                        	<div class="row-custom">
					<div class="profile-tab-content">
						<!-- include message block -->
						<?php $this->load->view('partials/_messages'); ?>
						<div class="table-responsive">
							<table class="table table-quote_requests table-striped">
								<thead>
								<tr>
									<th scope="col"><?php echo trans("quote"); ?></th>
									<th scope="col"><?php echo trans("product"); ?></th>
									<th scope="col"><?php echo trans("seller"); ?></th>
									<th scope="col"><?php echo trans("status"); ?></th>
									<th scope="col"><?php echo trans("sellers_bid"); ?></th>
									<th scope="col"><?php echo trans("updated"); ?></th>
									<th scope="col"><?php echo trans("options"); ?></th>
								</tr>
								</thead>
								<tbody>
								<?php if (!empty($quote_requests)): ?>
									<?php foreach ($quote_requests as $quote_request): ?>
										<tr>
											<td>#<?php echo $quote_request->id; ?></td>
											<td>
												<?php $product = get_product($quote_request->product_id);
												if (!empty($product)): ?>
													<div class="table-item-product">
														<div class="left">
															<div class="img-table">
																<a href="<?php echo base_url() . $product->slug; ?>" target="_blank">
																	<img src="<?php echo get_product_image($product->id, 'image_small'); ?>" data-src="" alt="" class="lazyload img-responsive post-image"/>
																</a>
															</div>
														</div>
														<div class="right">
															<a href="<?php echo base_url() . $product->slug; ?>" target="_blank">
																<h3 class="table-product-title"><?php echo $quote_request->product_title; ?></h3>
															</a>
															<?php echo trans("quantity") . ": " . $quote_request->product_quantity; ?>
														</div>
													</div>
												<?php else: ?>
													<h3 class="table-product-title"><?php echo $quote_request->product_title; ?></h3>
												<?php endif; ?>
											</td>
											<td>
												<?php $seller = get_user($quote_request->seller_id);
												if (!empty($seller)): ?>
													<a href="<?php echo generate_profile_url($seller); ?>" target="_blank" class="font-600">
														<?php echo html_escape($seller->username); ?>
													</a>
												<?php endif; ?>
											</td>
											<td><?php echo trans($quote_request->status); ?></td>
											<td>
												<?php if ($quote_request->status != 'new_quote_request' && $quote_request->price_offered != 0): ?>
													<div class="table-seller-bid">
														<p><b><?php echo trans("price"); ?>:&nbsp;</b><strong><?php echo print_price($quote_request->price_offered, $quote_request->price_currency); ?></strong></p>
														<p><b><?php echo trans("shipping"); ?>:&nbsp;</b><strong><?php echo print_price($quote_request->shipping_cost, $quote_request->price_currency); ?></strong></p>
														<p><b><?php echo trans("total"); ?>:&nbsp;</b><strong><?php echo print_price($quote_request->price_offered + $quote_request->shipping_cost, $quote_request->price_currency); ?></strong></p>
													</div>
												<?php endif; ?>
											</td>
											<td><?php echo time_ago($quote_request->updated_at); ?></td>
											<td>
												<?php if ($quote_request->status == 'pending_quote'): ?>
													<?php echo form_open('bidding_controller/accept_quote'); ?>
													<input type="hidden" name="id" class="form-control" value="<?php echo $quote_request->id; ?>">
													<button type="submit" class="btn btn-sm btn-info btn-table-option"><?php echo trans("accept_quote"); ?></button>
													<?php echo form_close(); ?>

													<?php echo form_open('bidding_controller/reject_quote'); ?>
													<input type="hidden" name="id" class="form-control" value="<?php echo $quote_request->id; ?>">
													<button type="submit" class="btn btn-sm btn-secondary btn-table-option"><?php echo trans("reject_quote"); ?></button>
													<?php echo form_close(); ?>

												<?php elseif ($quote_request->status == 'pending_payment'): ?>
													<?php echo form_open(lang_base_url() . 'add-to-cart-quote'); ?>
													<input type="hidden" name="id" class="form-control" value="<?php echo $quote_request->id; ?>">
													<button type="submit" class="btn btn-sm btn-info btn-table-option"><i class="icon-cart"></i>&nbsp;<?php echo trans("add_to_cart"); ?></button>
													<?php echo form_close(); ?>
												<?php endif; ?>
												<button type="button" class="btn btn-sm btn-danger btn-table-option" onclick="delete_quote_request(<?php echo $quote_request->id; ?>,'<?php echo trans("confirm_quote_request"); ?>');"><?php echo trans("delete_quote"); ?></button>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
								</tbody>
							</table>
						</div>


						<?php if (empty($quote_requests)): ?>
							<p class="text-center">
								<?php echo trans("no_records_found"); ?>
							</p>
						<?php endif; ?>
					</div>
				</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
   
    
</div>

<!-- include send message modal -->
<?php $this->load->view("partials/_modal_send_message", ["subject" => null]); ?>

<script>
    $(document).ready(function(){
        if (localStorage.getItem("product_link")){
            $("#hkmproducts").trigger("click")
            localStorage.removeItem("product_link");
        }
    })
</script>

