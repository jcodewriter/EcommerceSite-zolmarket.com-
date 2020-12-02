<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php $this->load->view("account/_profile_header"); ?>
<!-- Wrapper -->
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="nav-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo lang_base_url(); ?>"><?php echo trans("home"); ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo trans("profile"); ?></li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- load profile details -->
        <?php
        if ($user->is_private) {
            $this->load->view("account/private/_profile_info");
        } else {
            $this->load->view("account/company/_profile_info");
        }
        ?>

        <div class="row">
            <div class="col-sm-12 col-md-3">
                <!-- load profile nav -->
            </div>

            <div class="col-sm-12 col-md-9">
                <div class="profile-tab-content">
                    <?php if (auth_check() && user()->id == $user->id) :
                        foreach ($products as $product) :
                            $this->load->view('product/_product_item_profile', ['product' => $product, 'promoted_badge' => true]);
                        endforeach;
                    else : ?>
                        <div class="row row-product-items row-product">
                            <!--print products-->
                            <?php foreach ($products as $product) : ?>
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