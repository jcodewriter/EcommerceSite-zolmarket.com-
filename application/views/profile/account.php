<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
 if (auth_check()){
$profile = $this->auth_user;
}
?>





<?php $this->load->view("profile/_menu_account"); ?>

<!-- Wrapper -->
<div id="wrapper">
    <div class="container pt-2">
        <div class="row">
            <div class="col-12">
                <nav class="nav-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a
                                    href="<?php echo lang_base_url(); ?>"><?php echo trans("home"); ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo trans("profile"); ?></li>
                    </ol>

                </nav>
            </div>
        </div>
        <!--Check auth-->
        <?php if (auth_check()): ?>
            <div class="row d-none d-md-block">
                <?php /*
                <div class="col-12">
                    <nav class="profile-nav navbar navbar-expand-sm mr-auto">
                        <div class="container">
                            <ul class="navbar-nav">

                                <?php if ($this->auth_user->role == "admin"): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo admin_url(); ?>" class="nav-link">
                                            <i class="icon-dashboard"></i>
                                            <?php echo trans("admin_panel"); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <li class="nav-item">
                                    <a href="<?php echo lang_base_url(); ?>profile/<?php echo $this->auth_user->slug; ?>"
                                       class="nav-link">
                                        <i class="icon-user"></i>
                                        <?php echo trans("view_profile"); ?>
                                    </a>
                                </li>
                                <?php if (is_marketplace_active()): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo lang_base_url(); ?>orders" class="nav-link">
                                            <i class="icon-shopping-basket"></i>
                                            <?php echo trans("orders"); ?>
                                        </a>
                                    </li>
                                    <?php if (is_user_vendor()): ?>
                                        <li class="nav-item">
                                            <a href="<?php echo lang_base_url(); ?>sales" class="nav-link">
                                                <i class="icon-shopping-bag"></i>
                                                <?php echo trans("sales"); ?>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo lang_base_url(); ?>earnings" class="nav-link">
                                                <i class="icon-wallet"></i>
                                                <?php echo trans("earnings"); ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <li class="nav-item">
                                        <a href="<?php echo lang_base_url(); ?>downloads" class="nav-link">
                                            <i class="icon-download"></i>
                                            <?php echo trans("downloads"); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <li class="nav-item">
                                    <a href="<?php echo lang_base_url(); ?>messages" class="nav-link">
                                        <i class="icon-mail"></i>
                                        <?php echo trans("messages"); ?>
                                        <?php if ($unread_message_count > 0): ?>
                                            <span class="span-message-count"><?php echo $unread_message_count; ?></span>
                                        <?php endif; ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo lang_base_url(); ?>settings/update-profile" class="nav-link">
                                        <i class="icon-settings"></i>
                                        <?php echo trans("settings"); ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url(); ?>logout" class="logout nav-link">
                                        <i class="icon-logout"></i>
                                        <?php echo trans("logout"); ?>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </nav>


                </div>
                */ ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-12">
                <div class="profile-page-top">
                    <!-- load profile details -->
                    <?php $this->load->view("profile/_profile_user_info"); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-3">
                <!-- load profile nav -->
                <?php $this->load->view("profile/_account_tabs"); ?>
            </div>

            <div class="col-sm-12 col-md-9">
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


