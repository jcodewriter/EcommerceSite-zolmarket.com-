<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php
$back_url = lang_base_url() . "sell-now/edit-product/" . $product->id;
if ($product->is_draft == 1) {
    $back_url = lang_base_url() . "sell-now/" . $product->id;
}
?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/file-uploader/css/jquery.dm-uploader.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/file-uploader/css/styles.css" />
<script src="<?php echo base_url(); ?>assets/vendor/file-uploader/js/jquery.dm-uploader.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/file-uploader/js/demo-ui.js"></script>
<script type="text/javascript">
    history.pushState(null, null, '<?php echo $_SERVER["REQUEST_URI"]; ?>');
    window.addEventListener('popstate', function(event) {
        window.location.assign('<?php echo $back_url; ?>');
    });
</script>

<div class="hkm_messages_navCatDownMobile">
    <div class="cat-header">
        <div class="mobile-header-back">
            <a href="javascript:history.go(-1)" class="btn-back-mobile-nav"> <i class="icon-arrow-left"></i> <?php echo trans("back"); ?> </a>
        </div>
        <div class="mobile-header-title">
            <?php if ($product->is_draft == 1) : ?>
                <span class="text-white textcat-header text-center"><?php echo trans("sell_now"); ?></span>
            <?php else : ?>
                <span class="text-white textcat-header text-center"><?php echo trans("edit_product"); ?></span>
            <?php endif; ?>
        </div>
        <div class="mobilde-header-cart">
        </div>
    </div>
</div>
<!-- Wrapper -->
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div id="content" class="col-12">
                <nav class="nav-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb"></ol>
                </nav>
                <?php if ($product->is_draft == 1) : ?>
                    <h1 class="page-title page-title-product page_title_hidden_on_mobile"><?php echo trans("sell_now"); ?></h1>
                <?php else : ?>
                    <h1 class="page-title page-title-product page_title_hidden_on_mobile"><?php echo trans("edit_product"); ?></h1>
                <?php endif; ?>
                <div class="form-add-product">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-12 col-lg-11">
                            <div class="row">
                                <div class="col-12">
                                    <!-- include message block -->
                                    <?php $this->load->view('product/_messages'); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">

                                    <?php if ($product->product_type == 'digital') : ?>
                                        <div class="row-custom m-b-30">
                                            <div class="row">
                                                <div class="col-12" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>;">
                                                    <label class="control-label font-600"><?php echo trans("digital_files"); ?></label>
                                                    <small>(<?php echo trans("digital_files_exp"); ?>)</small>
                                                    <?php $this->load->view("product/_digital_files_upload_box"); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- form start -->
                                    <?php echo form_open('product_controller/edit_product_details_post', ['id' => 'form_validate', 'class' => 'validate_price', 'class' => 'validate_terms', 'onkeypress' => "return event.keyCode != 13;"]); ?>
                                    <input type="hidden" name="id" value="<?php echo $product->id; ?>">

                                    <?php if ($product->product_type == 'digital') : ?>
                                        <?php $this->load->view("product/license/_license_keys", ['product' => $product, 'license_keys' => $license_keys]); ?>
                                        <div class="form-box">
                                            <div class="form-box-head" style ="<?= $this->selected_lang->id == 2 ? 'text-align: right' : '' ?>;">
                                                <h4 class="title" ><?php echo trans('files_included'); ?></h4>
                                                <small><?php echo trans("files_included_ext"); ?></small>
                                            </div>
                                            <div class="form-box-body">
                                                <div class="form-group">
                                                    <input type="text" name="files_included" class="form-control form-input" value="<?php echo html_escape($product->files_included); ?>" placeholder="<?php echo trans("files_included"); ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($custom_field_array) || ($form_settings->product_conditions == 1 && $product->product_type == 'physical') || ($form_settings->quantity == 1) && $product->product_type == 'physical') : ?>
                                        <div class="form-box">
                                            <div class="form-box-head">
                                                <h4 class="title" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>;"><?php echo trans("details"); ?></h4>
                                            </div>
                                            <div class="form-box-body">
                                                <?php if ($product->product_type == 'physical') : ?>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <?php if ($form_settings->product_conditions == 1) : ?>
                                                                <div class="col-12 col-sm-6 m-b-sm-15" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>;">
                                                                    <label class="control-label"><?php echo trans('condition'); ?></label>
                                                                    <?php $product_conditions = get_grouped_product_conditions();
                                                                    if (!empty($product_conditions)) : ?>
                                                                        <div class="selectdiv">
                                                                            <select style = "<?= $this->selected_lang->id == 2 ? 'direction: rtl' : '' ?>" name="product_condition" class="form-control" <?php echo ($form_settings->product_conditions_required == 1) ? 'required' : ''; ?>>
                                                                                <option value=""><?php echo trans('select_option'); ?></option>
                                                                                <?php foreach ($product_conditions as $option) :
                                                                                    $product_condition = get_product_condition_by_lang($option->common_id, $selected_lang->id); ?>
                                                                                    <option value="<?php echo $product_condition->option_key; ?>" <?php echo ($product->product_condition == $product_condition->option_key) ? 'selected' : ''; ?>><?php echo $product_condition->option_label; ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php endif; ?>

                                                            <?php if ($form_settings->quantity == 1) : ?>
                                                                <div class="col-12 col-sm-6" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>;">
                                                                    <label class="control-label"><?php echo trans('quantity'); ?></label>
                                                                    <input type="number" name="quantity"  style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>;" class="form-control form-input" min="1" max="999999" value="<?php echo ($product->quantity > 0) ? html_escape($product->quantity) : ''; ?>" placeholder="<?php echo trans("quantity"); ?>" <?php echo ($form_settings->quantity_required == 1) ? 'required' : ''; ?>>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="form-group m-0">
                                                    <div class="row" id="custom_fields_container">
                                                        <?php if (isset($custom_field_array)) {
                                                            $this->load->view("product/_custom_fields", ["custom_fields" => $custom_field_array]);
                                                        } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($product->listing_type == 'sell_on_site' && $form_settings->price == 1) : ?>
                                        <div class="form-box">
                                            <div class="form-box-head">
                                                <h4 class="title" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>;"><?php echo trans('price'); ?></h4>
                                            </div>
                                            <div class="form-box-body">
                                                <div id="price_input_container" class="form-group">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6 m-b-sm-15">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text input-group-text-currency" id="basic-addon1"><?php echo get_currency($payment_settings->default_product_currency); ?></span>
                                                                    <input type="hidden" name="currency" value="<?php echo $payment_settings->default_product_currency; ?>">
                                                                </div>
                                                                <input type="text" name="price" id="product_price_input" aria-describedby="basic-addon1" class="form-control form-input price-input validate-price-input" value="<?php echo ($product->price != 0) ? price_format_input($product->price) : ''; ?>" placeholder="<?php echo $this->input_initial_price; ?>" onpaste="return false;" maxlength="32" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-6">
                                                            <p class="calculated-price">
                                                                <strong><?php echo trans("you_will_earn"); ?> (<?php echo get_currency($payment_settings->default_product_currency); ?>):&nbsp;&nbsp;
                                                                    <i id="earned_price" class="earned-price">
                                                                        <?php $earned_price = $product->price - (($product->price * $general_settings->commission_rate) / 100);
                                                                        $earned_price = number_format($earned_price, 2, '.', '');
                                                                        echo price_format_input($earned_price); ?>
                                                                    </i>
                                                                </strong>&nbsp;&nbsp;&nbsp;
                                                                <small> (<?php echo trans("commission_rate"); ?>:&nbsp;&nbsp;<?php echo $general_settings->commission_rate; ?>%)</small>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php if ($product->product_type == 'digital') : ?>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>;">
                                                            <input type="checkbox" class="custom-control-input" name="is_free_product" id="checkbox_free_product" <?php echo ($product->is_free_product == 1) ? 'checked' : ''; ?>>
                                                            <label for="checkbox_free_product" class="custom-control-label"><?php echo trans("free_product"); ?></label>
                                                        </div>
                                                    </div>
                                                    <script>
                                                        $(document).on('click', '#checkbox_free_product', function() {
                                                            if ($(this).is(':checked')) {
                                                                $('#price_input_container').hide();
                                                            } else {
                                                                $('#price_input_container').show();
                                                            }
                                                        });
                                                    </script>
                                                    <?php if ($product->is_free_product == 1) : ?>
                                                        <style>
                                                            #price_input_container {
                                                                display: none;
                                                                ;
                                                            }
                                                        </style>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <?php elseif ($product->listing_type == 'ordinary_listing') :
                                        if ($form_settings->price == 1) : ?>
                                            <div class="form-box">
                                                <div class="form-box-head">
                                                    <h4 class="title" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>;"><?php echo trans('price'); ?></h4>
                                                </div>
                                                <div class="form-box-body">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <?php if ($this->payment_settings->allow_all_currencies_for_classied == 1) : ?>
                                                                <div class="col-12 col-sm-4 m-b-sm-15">
                                                                    <div class="selectdiv">
                                                                        <select style = "<?= $this->selected_lang->id == 2 ? 'direction: rtl' : '' ?>" name="currency" class="form-control" required>
                                                                            <?php $currencies = get_currencies();
                                                                            if (!empty($currencies)) :
                                                                                foreach ($currencies as $key => $value) :
                                                                                    if ($key == $product->currency) : ?>
                                                                                        <option value="<?php echo $key; ?>" selected><?php echo $value["name"] . " (" . $value["hex"] . ")"; ?></option>
                                                                                    <?php else : ?>
                                                                                        <option value="<?php echo $key; ?>"><?php echo $value["name"] . " (" . $value["hex"] . ")"; ?></option>
                                                                                    <?php endif; ?>
                                                                                <?php endforeach; ?>
                                                                            <?php endif; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-4 m-b-sm-15">
                                                                    <input type="text" name="price" class="form-control form-input price-input validate-price-input" value="<?php echo ($product->price != 0) ? price_format_input($product->price) : ''; ?>" placeholder="<?php echo $this->input_initial_price; ?>" onpaste="return false;" maxlength="32" <?php echo ($form_settings->price_required == 1) ? 'required' : ''; ?>>
                                                                </div>
                                                            <?php else : ?>
                                                                <div class="col-12 col-sm-6 m-b-sm-15">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text input-group-text-currency" id="basic-addon2"><?php echo get_currency($payment_settings->default_product_currency); ?></span>
                                                                            <input type="hidden" name="currency" value="<?php echo $payment_settings->default_product_currency; ?>">
                                                                        </div>
                                                                        <input type="text" name="price" id="product_price_input" aria-describedby="basic-addon2" class="form-control form-input price-input validate-price-input" value="<?php echo ($product->price != 0) ? price_format_input($product->price) : ''; ?>" placeholder="<?php echo $this->input_initial_price; ?>" onpaste="return false;" maxlength="32" <?php echo ($form_settings->price_required == 1) ? 'required' : ''; ?>>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php elseif ($product->listing_type == 'bidding' || !$form_settings->price) : ?>
                                        <input type="hidden" name="currency" value="<?php echo $payment_settings->default_product_currency; ?>">
                                    <?php endif; ?>

                                    <?php if (($product->product_type == 'physical' && $form_settings->physical_demo_url == 1) || ($product->product_type == 'digital' && $form_settings->digital_demo_url == 1)) : ?>
                                        <div class="form-box">
                                            <div class="form-box-head">
                                                <h4 class="title" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>;"><?php echo trans('demo_url'); ?></h4>
                                                <small style ="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''?>;"><?php echo trans("demo_url_exp"); ?></small>
                                            </div>
                                            <div class="form-box-body">
                                                <div class="form-group">
                                                    <input type="text" name="demo_url" class="form-control form-input" value="<?php echo html_escape($product->demo_url); ?>" placeholder="<?php echo trans("demo_url"); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="row-custom">
                                        <div class="row">
                                            <?php if (($product->product_type == 'physical' && $form_settings->physical_video_preview == 1) || ($product->product_type == 'digital' && $form_settings->digital_video_preview == 1)) : ?>
                                                <div class="col-12 col-sm-6 m-b-30" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>;">
                                                    <label class="control-label font-600"><?php echo trans("video_preview"); ?></label>
                                                    <small>(<?php echo trans("video_preview_exp"); ?>)</small>
                                                    <?php $this->load->view("product/_video_upload_box"); ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (($product->product_type == 'physical' && $form_settings->physical_audio_preview == 1) || ($product->product_type == 'digital' && $form_settings->digital_audio_preview == 1)) : ?>
                                                <div class="col-12 col-sm-6 m-b-30" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>;">
                                                    <label class="control-label font-600"><?php echo trans("audio_preview"); ?></label>
                                                    <small>(<?php echo trans("audio_preview_exp"); ?>)</small>
                                                    <?php
                                                    $audio = $this->file_model->get_product_audio($product->id);
                                                    $this->load->view("product/_audio_upload_box", ['audio' => $audio]); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <?php if ($product->listing_type == 'ordinary_listing') : ?>
                                        <?php if ($form_settings->external_link == 1) : ?>
                                            <div class="form-box">
                                                <div class="form-box-head">
                                                    <h4 class="title" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>;"><?php echo trans('external_link'); ?></h4>
                                                    <small style ="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''?>;"><?php echo trans("external_link_exp"); ?></small>
                                                </div>
                                                <div class="form-box-body">
                                                    <div class="form-group">
                                                        <input type="text" name="external_link" class="form-control form-input" value="<?php echo html_escape($product->external_link); ?>" placeholder="<?php echo trans("external_link"); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if ($form_settings->variations == 1 && $product->product_type != 'digital') : ?>
                                        <div class="form-box">
                                            <div class="form-box-head" style ="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''?>;">
                                                <h4 class="title"><?php echo trans('variations'); ?></h4>
                                                <small><?php echo trans('variations_exp'); ?></small>
                                            </div>
                                            <div class="form-box-body">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div id="response_product_variations" class="col-12 m-b-30">
                                                            <?php $this->load->view("product/variation/_response_variations", ["product_variations" => $product_variations]); ?>
                                                        </div>
                                                        <div class="col-12">
                                                            <button type="button" class="btn btn-sm btn-secondary btn-variation" data-toggle="modal" data-target="#addVariationModal">
                                                                <?php echo trans("add_variation"); ?>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-secondary btn-variation" data-toggle="modal" data-target="#variationModalSelect">
                                                                <?php echo trans("select_existing_variation"); ?>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>


                                    <?php if ($form_settings->shipping == 1 && $product->product_type == 'physical') : ?>
                                        <div class="form-box">
                                            <div class="form-box-head">
                                                <h4 class="title" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>;"><?php echo trans('shipping'); ?></h4>
                                            </div>
                                            <div class="form-box-body">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <?php $shipping_options = get_grouped_shipping_options();
                                                        if (!empty($shipping_options)) : ?>
                                                            <div class="col-12 col-sm-6 m-b-sm-15" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>;">
                                                                <label class="control-label"><?php echo trans('shipping_cost'); ?></label>
                                                                <div class="selectdiv">
                                                                    <select style = "<?= $this->selected_lang->id == 2 ? 'direction: rtl' : '' ?>" name="shipping_cost_type" class="form-control" onchange="if($(this).find(':selected').attr('data-shipping-cost')==1){$('.shipping-cost-container').show();}else{$('.shipping-cost-container').hide();}" <?php echo ($form_settings->shipping_required == 1) ? 'required' : ''; ?>>
                                                                        <option value=""><?php echo trans("select_option"); ?></option>
                                                                        <?php foreach ($shipping_options as $option) :
                                                                            $shipping_option = get_shipping_option_by_lang($option->common_id, $selected_lang->id) ?>
                                                                            <option value="<?php echo $shipping_option->option_key; ?>" data-shipping-cost="<?php echo $shipping_option->shipping_cost; ?>" <?php echo ($product->shipping_cost_type == $shipping_option->option_key) ? 'selected' : ''; ?>><?php echo $shipping_option->option_label; ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                        <div class="col-12 col-sm-6" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>;">
                                                            <label class="control-label"><?php echo trans('shipping_time'); ?></label>
                                                            <div class="selectdiv">
                                                                <select style = "<?= $this->selected_lang->id == 2 ? 'direction: rtl' : '' ?>" name="shipping_time" class="form-control" <?php echo ($form_settings->shipping_required == 1) ? 'required' : ''; ?>>
                                                                    <option value=""><?php echo trans("select_option"); ?></option>
                                                                    <option value="1_business_day" <?php echo ($product->shipping_time == "1_business_day") ? 'selected' : ''; ?>><?php echo trans("1_business_day"); ?></option>
                                                                    <option value="2_3_business_days" <?php echo ($product->shipping_time == "2_3_business_days") ? 'selected' : ''; ?>><?php echo trans("2_3_business_days"); ?></option>
                                                                    <option value="4_7_business_days" <?php echo ($product->shipping_time == "4_7_business_days") ? 'selected' : ''; ?>><?php echo trans("4_7_business_days"); ?></option>
                                                                    <option value="8_15_business_days" <?php echo ($product->shipping_time == "8_15_business_days") ? 'selected' : ''; ?>><?php echo trans("8_15_business_days"); ?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-6 m-t-15 shipping-cost-container" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>;<?php echo ($this->settings_model->is_shipping_option_require_cost($product->shipping_cost_type) == 1) ? 'display:block;' : ''; ?>">
                                                            <label class="control-label"><?php echo trans('shipping_cost'); ?></label>
                                                            <div class="input-group">
                                                                <?php if ($this->payment_settings->default_product_currency != "all") : ?>
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text input-group-text-currency" id="basic-addon3"><?php echo get_currency($this->payment_settings->default_product_currency); ?></span>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <input type="text" name="shipping_cost" aria-describedby="basic-addon3" class="form-control form-input price-input" value="<?php echo ($product->shipping_cost != 0) ? price_format_input($product->shipping_cost) : ''; ?>" placeholder="<?php echo $this->input_initial_price; ?>" onpaste="return false;" maxlength="32" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($form_settings->product_location == 1 && $product->product_type == 'physical') :
                                        if ($product->country_id == 0) {
                                            // $country_id = $this->auth_user->country_id;
                                            // $state_id = $this->auth_user->state_id;
                                            // $city_id = $this->auth_user->city_id;
                                            // $address = $this->auth_user->address;
                                            // $zip_code = $this->auth_user->zip_code;
                                            $country_id = 0;
                                            $state_id = 0;
                                            $city_id = 0;
                                            $address = "";
                                            $zip_code = "";
                                        } else {
                                            $country_id = $product->country_id;
                                            $state_id = $product->state_id;
                                            $city_id = $product->city_id;
                                            $address = $product->address;
                                            $zip_code = $product->zip_code;
                                        }
                                    ?>
                                        <div class="form-box">
                                            <div class="form-box-head">
                                                <h4 class="title" style="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>;"><?php echo trans('location'); ?></h4>
                                            </div>
                                            <div class="form-box-body">
                                                <div class="form-group">
                                                    <div class="row hidden-row" style ="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''?>;">
                                                        <div class="col-12 col-sm-4 m-b-15">
                                                            <?php if ($general_settings->default_product_location == 0) : ?>
                                                                <div class="selectdiv" class="d-none">
                                                                    <select style = "<?= $this->selected_lang->id == 2 ? 'direction: rtl' : '' ?>" id="countries" name="country_id" class="form-control" onchange="get_states(this.value);" <?php echo ($form_settings->product_location_required == 1) ? 'required' : ''; ?>>
                                                                        <option value=""><?php echo trans('country'); ?></option>
                                                                        <?php foreach ($countries as $item) : ?>
                                                                            <option value="<?php echo $item->id; ?>" <?php echo ($item->id == $country_id) ? 'selected' : ''; ?>><?php echo html_escape($item->name); ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                            <?php else : ?>
                                                                <div class="selectdiv">
                                                                    <select style = "<?= $this->selected_lang->id == 2 ? 'direction: rtl' : '' ?>" id="countries" name="country_id" class="form-control" required>
                                                                        <?php foreach ($countries as $item) : ?>
                                                                            <?php if ($item->id == $general_settings->default_product_location) : ?>
                                                                                <option value="<?php echo $item->id; ?>" selected><?php echo html_escape($item->name); ?></option>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="col-12 col-sm-4 m-b-15">
                                                            <div class="selectdiv">
                                                                <select style = "<?= $this->selected_lang->id == 2 ? 'direction: rtl' : '' ?>" id="states" name="state_id" class="form-control" onchange="get_cities(this.value);" <?php echo ($form_settings->product_location_required == 1) ? 'required' : ''; ?>>
                                                                    <option value=""><?php echo trans('state'); ?></option>
                                                                    <?php
                                                                    if (!empty($states)) :
                                                                        foreach ($states as $item) : ?>
                                                                            <option value="<?php echo $item->id; ?>" <?php echo ($item->id == $state_id) ? 'selected' : ''; ?>><?php echo html_escape($item->name); ?></option>
                                                                    <?php endforeach;
                                                                    endif; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-4 m-b-15">
                                                            <div class="selectdiv">
                                                                <select style = "<?= $this->selected_lang->id == 2 ? 'direction: rtl' : '' ?>" id="cities" name="city_id" class="form-control" onchange="update_product_map();">
                                                                    <option value=""><?php echo trans('city'); ?></option>
                                                                    <?php
                                                                    if (!empty($cities)) :
                                                                        foreach ($cities as $item) : ?>
                                                                            <option value="<?php echo $item->id; ?>" <?php echo ($item->id == $city_id) ? 'selected' : ''; ?>><?php echo html_escape($item->name); ?></option>
                                                                    <?php endforeach;
                                                                    endif; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="mobile_listcategories" class="mobile_selectdiv" style="margin-bottom:15px;<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''; ?>;">
                                                        <?php if ($general_settings->default_product_location == 0) : ?>
                                                            <label class="control-label"><?php echo trans('country'); ?></label>
                                                            <label class="control-label"><?php echo trans('country'); ?></label>
                                                            <button class="filter-btn text-truncate has-menu d-flex mobile-popup__button country-btn" type="button" name="country" data-ajax="0" data-type="country_id" data-url="country_location">
                                                            <?php endif; ?>
                                                            <?php if ($general_settings->default_product_location == 0) : ?>
                                                                <i class="fa fa-map-marker  fa-lg align-self-center mr-1 ml-1" aria-hidden="true"></i>
                                                                <?php if ($btn_string) : ?>
                                                                    <span class="flex-fill text-truncate text-left special-cagetory" id="country_button"><?php echo html_escape($btn_string); ?></span>
                                                                <?php else : ?>
                                                                    <span class="flex-fill text-truncate text-left special-cagetory" id="country_button"><?php echo trans('country'); ?></span>
                                                                <?php endif; ?>

                                                            <?php endif; ?>
                                                            <?php if ($general_settings->default_product_location == 0) : ?>
                                                                <i class="icon-arrow-right"></i>
                                                            <?php endif; ?>
                                                            </button>
                                                            <label class="control-label"><?php echo trans('state') . ' / ' . trans('city'); ?></label>
                                                            <?php if ($general_settings->default_product_location == 0) : ?>
                                                                <button class="filter-btn text-truncate has-menu d-flex mobile-popup__button state__city-btn" type="button" name="state" data-ajax="0" data-type="state_id" data-url="custom_location">
                                                                <?php else : ?>
                                                                    <button class="filter-btn text-truncate has-menu d-flex mobile-popup__button" type="button" name="state" data-ajax="<?php echo $general_settings->default_product_location; ?>" data-type="state_id" data-url="custom_location">
                                                                    <?php endif; ?>
                                                                    <i class="fa fa-map-marker  fa-lg align-self-center mr-1 ml-1" aria-hidden="true"></i>
                                                                    <?php if ($state_button) : ?>
                                                                        <span class="flex-fill text-truncate text-left special-cagetory" id="city_button"><?php echo html_escape($state_button); ?></span>
                                                                    <?php else : ?>
                                                                        <span class="flex-fill text-truncate text-left special-cagetory" id="city_button"><?php echo trans('state') . ' / ' . trans('city'); ?></span>
                                                                    <?php endif; ?>
                                                                    <i class="icon-arrow-right"></i>
                                                                    </button>
                                                    </div>
                                                    <!-- <input type="hidden" name="custom_id" class="form-control form-input" id="category_id" value="<?php echo $product->category_id; ?>"/>
                                                    <input type="hidden" name="custom_id" class="form-control form-input" id="category_id" value="<?php echo $product->category_id; ?>"/>
                                                    <input type="hidden" name="custom_id" class="form-control form-input" id="category_id" value="<?php echo $product->category_id; ?>"/> -->

                                                    <div class="row" style ="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''?>;">
                                                        <div class="col-12 col-sm-6 m-b-sm-15" style ="<?= $this->selected_lang->id == 2 ? 'text-align: right' : ''?>;">
                                                            <label class="control-label"><?php echo trans('address'); ?></label>
                                                            <input type="text" name="address" id="address_input" class="form-control form-input" style ="<?= $this->selected_lang->id == 2 ? 'text-align: right' : '' ?>;" value="<?php echo html_escape($address); ?>" placeholder="<?php echo trans("address") ?>">
                                                        </div>
                                                        <div class="col-12 col-sm-3" style ="<?= $this->selected_lang->id == 2 ? 'text-align: right' : '' ?>;">
                                                            <label class="control-label"><?php echo trans('zip_code'); ?></label>
                                                            <input type="text" name="zip_code" id="zip_code_input" class="form-control form-input" style ="<?= $this->selected_lang->id == 2 ? 'text-align: right' : '' ?>;" value="<?php echo html_escape($zip_code); ?>" placeholder="<?php echo trans("zip_code") ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div id="map-result">
                                                        <!--load map-->
                                                        <?php
                                                        if ($product->country_id == 0) {
                                                            $this->load->view("product/_load_map", ["map_address" => get_location($this->auth_user)]);
                                                        } else {
                                                            $this->load->view("product/_load_map", ["map_address" => get_location($product)]);
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="form-group m-t-15" style="text-align: center">
                                        <div class="custom-control custom-checkbox custom-control-validate-input" style ="<?= $this->selected_lang->id == 2 ? 'text-align: right' : '' ?>;">
                                            <?php if ($product->is_draft == 1) : ?>
                                                <input type="checkbox" class="custom-control-input" name="terms_conditions" id="terms_conditions" value="1" required>
                                            <?php else : ?>
                                                <input type="checkbox" class="custom-control-input" name="terms_conditions" id="terms_conditions" value="1" checked>
                                            <?php endif; ?>
                                            <label for="terms_conditions" class="custom-control-label custom-check" style="font-size:13px; padding-top: 9px;">&nbsp;&nbsp;<?php echo trans("terms_conditions_exp"); ?>&nbsp;<a href="<?php echo lang_base_url(); ?>terms-conditions" class="link-terms" target="_blank"><strong><?php echo trans("terms_conditions"); ?></strong></a></label>
                                        </div>
                                    </div>

                                    <div class="form-group m-t-15">
                                        <?php if ($product->is_draft == 1) : ?>
                                            <a href="<?php echo lang_base_url(); ?>sell-now/<?php echo $product->id; ?>" class="btn btn-lg btn-custom float-left"><?php echo trans("back"); ?></a>
                                            <button type="submit" name="submit" value="submit" class="btn btn-lg btn-custom float-right"><?php echo trans("submit"); ?></button>
                                            <button type="submit" name="submit" value="save_as_draft" class="btn btn-lg btn-secondary color-white float-right m-r-10"><?php echo trans("save_as_draft"); ?></button>
                                        <?php else : ?>
                                            <a href="<?php echo lang_base_url(); ?>sell-now/edit-product/<?php echo $product->id; ?>" id="btn_tab_product_images" class="btn btn-lg btn-custom float-left"><?php echo trans("back"); ?></a>
                                            <button type="submit" name="submit" value="save_changes" class="btn btn-lg btn-custom float-right"><?php echo trans("save_changes"); ?></button>
                                        <?php endif; ?>
                                    </div>
                                    <div class="ajax-filter-menu">
                                        <div class="navCatDownMobile nav-mobile" id="filter1" style="margin-left: 105%;">
                                            <div class="form-group cat-header">
                                                <a href="javascript:void(0)" data-back="normal" class="btn-back-mobile-nav"><i class="icon-arrow-left"></i> <?= trans('back') ?></a>
                                                <span href="javascript:void(0)" class="text-white textcat-header text-center"><?= trans('filter') ?></span>
                                            </div>
                                            <div class="nav-mobile-inner">
                                            </div>
                                        </div>
                                        <div class="navCatDownMobile nav-mobile" id="" style="margin-left: 105%;top:58px;height: calc(100% - 58px - 60px);">
                                            <div class="nav-mobile-inner">
                                                <ul class="navbar-nav top-search-bar mobile-search-form">

                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                    <?php echo form_close(); ?>
                                    <!-- form end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Wrapper End-->

<?php $this->load->view("product/variation/_form_variations"); ?>

<!-- Datepicker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/datepicker/css/bootstrap-datepicker.standalone.css">
<script src="<?php echo base_url(); ?>assets/vendor/datepicker/js/bootstrap-datepicker.min.js"></script>

<!-- Plyr JS-->
<script src="<?php echo base_url(); ?>assets/vendor/plyr/plyr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/plyr/plyr.polyfilled.min.js"></script>
<script>
    const player = new Plyr('#player');
    $(document).ajaxStop(function() {
        const player = new Plyr('#player');
    });
    const audio_player = new Plyr('#audio_player');
    $(document).ajaxStop(function() {
        const player = new Plyr('#audio_player');
    });
</script>

<?php if ($product->listing_type == 'sell_on_site') : ?>
    <script>
        //calculate product earned value
        var thousands_separator = '<?php echo $this->thousands_separator; ?>';
        var commission_rate = '<?php echo $this->general_settings->commission_rate; ?>';
        $(document).on("input keyup paste change", "#product_price_input", function() {
            var input_val = $(this).val();
            input_val = input_val.replace(',', '.');
            var price = parseFloat(input_val);
            commission_rate = parseInt(commission_rate);
            //calculate
            if (!Number.isNaN(price)) {
                var earned_price = price - ((price * commission_rate) / 100);
                earned_price = earned_price.toFixed(2);
                if (thousands_separator == ',') {
                    earned_price = earned_price.replace('.', ',');
                }
            } else {
                earned_price = '0' + thousands_separator + '00';
            }
            $("#earned_price").html(earned_price);
        });
    </script>
<?php endif; ?>

<script>
    $.fn.datepicker.dates['en'] = {
        days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
        daysMin: ['<?php echo substr(trans("monday"), 0, 3); ?>',
            '<?php echo substr(trans("tuesday"), 0, 3); ?>',
            '<?php echo substr(trans("wednesday"), 0, 3); ?>',
            '<?php echo substr(trans("thursday"), 0, 3); ?>',
            '<?php echo substr(trans("friday"), 0, 3); ?>',
            '<?php echo substr(trans("saturday"), 0, 3); ?>',
            '<?php echo substr(trans("sunday"), 0, 3); ?>'
        ],
        months: ['<?php echo trans("january"); ?>',
            '<?php echo trans("february"); ?>',
            '<?php echo trans("march"); ?>',
            '<?php echo trans("april"); ?>',
            '<?php echo trans("may"); ?>',
            '<?php echo trans("june"); ?>',
            '<?php echo trans("july"); ?>',
            '<?php echo trans("august"); ?>',
            '<?php echo trans("september"); ?>',
            '<?php echo trans("october"); ?>',
            '<?php echo trans("november"); ?>',
            '<?php echo trans("december"); ?>'
        ],
        monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        today: "Today",
        clear: "Clear",
        format: "mm/dd/yyyy",
        titleFormat: "MM yyyy",
        /* Leverages same syntax as 'format' */
        weekStart: 0
    };

    $('.datepicker').datepicker({
        language: 'en'
    });

    $(document).ready(function() {
        if ($(this).width() < 500) {
            $("form").submit(function(e) {
                if (!$('#countries').val() || !$('#states').val()) {
                    if (!$('#countries').val())
                        $('button[name=country]').css({
                            'border-width': '1px',
                            'border-color': 'rgba(220, 53, 69, 0.40)'
                        })
                    if (!$('#states').val())
                        $('button[name=state]').css({
                            'border-width': '1px',
                            'border-color': 'rgba(220, 53, 69, 0.40)'
                        })
                    e.preventDefault();
                }
            })
        }
    })
</script>