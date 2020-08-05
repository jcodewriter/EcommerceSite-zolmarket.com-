<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view("account/_menu_account"); ?>
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
            <!-- ==== products ===== --->
            <div class="navCatDownMobile nav-mobile hkmproducts">
                <div class="form-group cat-header">
            		<a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
            		<span  class="text-white textcat-header text-center"><?php echo trans('products');?></span>
            	</div>
            	<br>
            	 <div  class="col-md-12" >
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
            	<br>
            	<div class="col-sm-12">
                    <div class="profile-tab-content">
                        <?php if (auth_check() && user()->id == $user->id):
                            foreach ($pending_products as $product):
                                $this->load->view('product/_product_item_profile', ['product' => $product, 'promoted_badge' => true]);
                            endforeach;
                        else: ?>
                            <div class="row row-product-items">
                                <!--print products-->
                                <?php foreach ($pending_products as $product): ?>
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
            	<br>
            	<div class="col-sm-12">
                    <div class="profile-tab-content">
                        <?php if (auth_check() && user()->id == $user->id):
                            foreach ($hidden_products as $product):
                                $this->load->view('product/_product_item_profile', ['product' => $product, 'promoted_badge' => true]);
                            endforeach;
                        else: ?>
                            <div class="row row-product-items">
                                <!--print products-->
                                <?php foreach ($hidden_products as $product): ?>
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
            	<br>
            	 <div class="col-sm-12">
                    <div class="profile-tab-content">
                        <?php foreach ($draft_products as $product):
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
            	<br>
            	<div class="col-sm-12">
                    <div class="profile-tab-content">
                        <div class="row row-product-items row-product">
                            <!--print products-->
                            <?php foreach ($favorites_products as $product): ?>
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
                <div class="col-sm-12 col-md-9">
                    <div class="profile-tab-content">
                    <?php
                    if (!empty($items)):
                        foreach ($items as $item):
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
            	<br>
            	 <div class="col-sm-12">
                <div class="profile-tab-content">
                    <div class="row">
                        <?php foreach ($followers as $item): ?>
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
            	<br>
            	<div class="col-sm-12">
                    <div class="profile-tab-content">
                        <div class="row">
                            <?php foreach ($following_users as $item): ?>
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
            	<br>
            	 <div class="col-sm-12">
                <div class="profile-tab-content">

                    <div id="user-review-result" class="user-reviews">
                        <?php $this->load->view('profile/_user_reviews'); ?>
                    </div>

                    <div class="row-custom">
                        <!--Include banner-->
                        <?php $this->load->view("partials/_ad_spaces", ["ad_space" => "profile", "class" => "m-t-30"]); ?>
                    </div>
                </div>
            </div>
            </div>
            
          
            
          
            <div id="showindesktophkm" class="d-none d-sm-block col-md-9">
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
                    <!--Include banner -->
                    <?php $this->load->view("partials/_ad_spaces", ["ad_space" => "profile", "class" => "m-t-30"]); ?>
                </div>
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

<!-- include send message modal -->
<?php $this->load->view("partials/_modal_send_message", ["subject" => null]); ?>


