<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<script>
    var total_amount = '<?php echo price_format_decimal($promoted_plan->total_amount); ?>';
    var currency = '<?php echo $payment_settings->promoted_products_payment_currency; ?>';
    var paypal_mode = '<?php echo $payment_settings->paypal_mode; ?>';
    var paypal_client_id = '<?php echo $payment_settings->paypal_client_id; ?>';
    var stripe_key = '<?php echo $payment_settings->stripe_publishable_key; ?>';
    $(window).bind("load", function() {
        $("#payment-button-container").css("visibility", "visible");
    });
</script>
<div class="hkm_messages_navCatDownMobile">
    <div class="cat-header">
        <div class="mobile-header-back">
            <a href="javascript:history.go(-1)" class="btn-back-mobile-nav"> <i class="icon-arrow-left"></i> <?php echo trans("back"); ?> </a>
        </div>
        <div class="mobile-header-title">
            <span class="text-white textcat-header text-center"><?php echo trans("checkout"); ?></span>
        </div>
        <div class="mobilde-header-cart">
        </div>
    </div>
</div>
<!-- Wrapper -->
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="shopping-cart shopping-cart-shipping">
                    <div class="row">
                        <div class="col-sm-12 col-lg-7">
                            <div class="left">
                                <h1 class="cart-section-title page_title_hidden_on_mobile"><?php echo trans("checkout"); ?></h1>
                                <?php if (!auth_check()) : ?>
                                    <div class="row m-b-15">
                                        <div class="col-12 col-md-6">
                                            <p><?php echo trans("checking_out_as_guest"); ?></p>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <p class="text-right"><?php echo trans("have_account"); ?>&nbsp;<a href="<?php lang_base_url() . 'login'; ?>" class="link-underlined"><?php echo trans("login"); ?></a></p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="tab-checkout tab-checkout-closed">
                                    <a href="<?php echo lang_base_url(); ?>promote-product/payment-method">
                                        <h2 class=" title">1.&nbsp;&nbsp;<?php echo trans("payment_method"); ?></h2>
                                    </a>
                                    <a href="<?php echo lang_base_url(); ?>promote-product/payment-method" class="link-underlined"><?php echo trans("edit"); ?></a>
                                </div>

                                <div class="tab-checkout tab-checkout-open">
                                    <h2 class="title">2.&nbsp;&nbsp;<?php echo trans("payment"); ?></h2>

                                    <div class="row">
                                        <div class="col-12">
                                            <?php
                                            $this->load->view("promote/payment_methods/_paypal");
                                            $this->load->view("promote/payment_methods/_stripe");
                                            $this->load->view("promote/payment_methods/_iyzico");
                                            $this->load->view("promote/payment_methods/_bank_transfer");
                                            ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-sm-12 col-lg-5">
                            <h2 class="cart-section-title"><?php echo trans("order_summary"); ?> (1)</h2>
                            <div class="right">
                                <?php $this->load->view("promote/_order_summary"); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Wrapper End-->