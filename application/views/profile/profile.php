<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
if (auth_check()) {
    $profile = $this->auth_user;
}
?>



<?php $this->load->view("profile/_menu_account"); ?>


<!-- Wrapper -->
<div id="wrapper" style="padding-top: 59px;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="nav-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo lang_base_url(); ?>"><?php echo trans("home"); ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo trans("account"); ?></li>
                    </ol>

                </nav>
            </div>
        </div>
        <!--Check auth-->
        <?php if (auth_check()) : ?>
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


<script>
    //calculate product earned value
    var thousands_separator = '<?php echo $this->thousands_separator; ?>';
    var commission_rate = '<?php echo $this->general_settings->commission_rate; ?>';
    $(document).on("input keyup paste change", ".price-input", function() {
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

    $(document).on("click", ".btn_submit_quote", function() {
        $('.modal-title').text("<?php echo trans("submit_a_quote"); ?>");
    });
    $(document).on("click", ".btn_update_quote", function() {
        $('.modal-title').text("<?php echo trans("update_quote"); ?>");
    });
</script>

<!-- include send message modal -->
<?php $this->load->view("partials/_modal_send_message", ["subject" => null]); ?>

<script>
    $(document).ready(function() {
        if (localStorage.getItem("product_link")) {
            $("#hkmproducts").trigger("click")
            localStorage.removeItem("product_link");
        }
    })
</script>