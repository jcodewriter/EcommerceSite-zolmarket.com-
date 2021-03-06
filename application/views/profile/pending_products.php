<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="hkm_messages_navCatDownMobile">
	<div class="cat-header">
        <div class="mobile-header-back">
            <a href="<?php echo lang_base_url().'account/'. $this->auth_user->slug;?>" class="btn-back-mobile-nav"> <i class="icon-arrow-left"></i> <?php echo trans("back"); ?>  </a>
        </div>
        <div class="mobile-header-title">
            <span  class="text-white textcat-header text-center"><?php echo $title;?></span>
        </div>
        <div class="mobilde-header-cart">
        </div>
	</div>   
</div>

<!-- Wrapper -->
<div id="wrapper" style="padding-top: 80px;">
    <div class="container">
        <div class="row page_title_hidden_on_mobile">
            <div class="col-12">
                <nav class="nav-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo lang_base_url(); ?>"><?php echo trans("home"); ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo trans("profile"); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row page_title_hidden_on_mobile">
            <div class="col-12">
                <div class="profile-page-top">
                    <!-- load profile details -->
                    <?php if (!$user->is_private || $user->role == "admin") : ?>
                        <?php $this->load->view("profile/company/_profile_user_info"); ?>
                    <?php else : ?>
                        <?php $this->load->view("profile/private/_profile_user_info"); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-3 hkmnone_tabs hidden-sm-down">
                <!-- load profile nav -->
                <?php $this->load->view("profile/_profile_tabs"); ?>
            </div>

            <div class="col-sm-12 col-md-9">
                <div class="profile-tab-content">
                    <?php if (auth_check() && user()->id == $user->id):
                        foreach ($products as $product):
                            $this->load->view('product/_product_item_profile', ['product' => $product, 'promoted_badge' => true]);
                        endforeach;
                    else: ?>
                        <div class="row row-product-items">
                            <!--print products-->
                            <?php foreach ($products as $product): ?>
                                <!-- <div class="col-12 col-sm-6 col-md-6 col-lg-4"> -->
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