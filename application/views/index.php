<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="top-search-bar mobile-search-form">
    <?php
    $placeholder = trans("search"); ?>
    <div style="padding: 5px;">
        <div class="clearable-parent">
            <div style="white-space: nowrap;color: #b0b3b6;font-size: 12px;font-weight: bold;">
                <button class=" has-menu" header-text="<?php echo trans('all_states');?>" type="button" data-ajax="<?php echo $general_settings->default_product_location;?>" data-type="<?= $is_hkm_one_country ? ('state') : ('country') ?>" data-url="search_location">
                    <i class="fas fa-map-marker-alt" style="font-size: 16px;"></i>
                    <span class="home-location-text"><?php echo trans('all_sudan'); ?></span>
                </button>
            </div>
            <input id="form-search" type="text" oninput="this.form.search.value = this.value" form="formsearchzolmarket" placeholder="<?php echo html_escape($placeholder); ?>" autocomplete="off" maxlength="300" data-window="SearchWindowFilter" class="has-search-product home-search-location" pattern=".*\S+.*" data-url="menu_search">
            <div><button onclick="this.form.submit();" form="formsearchzolmarket" class="icon-search"></button></div>
        </div>
    </div>
    <div class="clearable-content">
    </div>
</div>

<div class="ysfhkm_granddiv hidden-sm-down">
    <div class="container">
        <div class="ysfhkm_adv_srh">
            <div class="ysfhkm_fisrnv">
                <?php
                $data = array(
                    'method' => 'get',
                    'id' => 'formsearchzolmarket'
                );
                echo form_open(lang_base_url() . 'products', $data);
                ?>
                <input type="search" value="<?php echo set_value('search'); ?>" <?php if ($is_hkm_one_country == true) { ?> style="width:36%" <?php } ?> name="search" id="ysfhkm_search" placeholder="<?php echo trans("search"); ?>....">

                <div id="ysfhkm_slc_ctg" <?php if ($is_hkm_one_country == true) { ?> style="width:21%" <?php } ?>>
                    <span class="span_icon">
                        <i class="fas fa-tag"></i>
                    </span>
                    <select>
                        <option value="<?= lang_base_url() . 'products' ?>" selected><?php echo trans("categories_all"); ?></option>
                        <?php $id_last = '';  ?>
                        <?php foreach ($categories as $row) {
                            if ($row->parent_id == null || $row->parent_id == 0) { ?>
                                <option style="background-color: #f0f0f0;font-weight: bold;color: #797979;" value="<?= generate_category_url(get_category($row->id)); ?>" <?php echo set_select('ysfhkm_slc_ctg', $row->id, False); ?>><?php echo  ucfirst($row->name); ?></option>
                                <?php
                                $id_last = $row->id;
                                foreach ($categories as $row) {
                                    if ($row->parent_id == $id_last) {
                                ?>
                                        <option style="" value="<?= generate_category_url(get_category($row->id)); ?>" <?php echo set_select('ysfhkm_slc_ctg', $row->id, False); ?>><?php echo ucfirst($row->name); ?> </option>
                        <?php
                                    }
                                }
                            }
                        }
                        ?>
                    </select>
                </div>

                <div id="ysfhkm_slc_country" <?php if ($is_hkm_one_country == true) { ?> style="display:none" <?php } ?>>
                    <span class="span_icon">
                        <i class="fas fa-flag"></i>
                    </span>
                    <select name="country">
                        <option value=""><?php echo trans("countries_all"); ?></option>
                        <?php foreach ($countries as $row) {
                            if ($is_hkm_one_country == true) {
                                if ($is_hkm_one_country_value == $row->id) {
                        ?>
                                    <option value="<?php echo $row->id; ?>" selected>
                                        <?php echo ucfirst(strtolower($row->name)); ?> </option>
                                <?php
                                }
                            } elseif ($is_hkm_one_country == false) {
                                ?>
                                <?php $country = $this->input->get('country') ?>
                                <?php if (strtolower(trim($row->name)) == strtolower(trim($default_location))) { ?>
                                    <option value="<?php echo $row->id; ?>" <?= $row->is_default ? 'selected' : '' ?>><?php echo ucfirst(strtolower($row->name)); ?> </option>
                                <?php } else { ?>
                                    <option value="<?php echo $row->id; ?>" <?= $row->is_default ? 'selected' : '' ?>><?php echo ucfirst(strtolower($row->name)); ?> </option>
                        <?php }
                            }
                        } ?>
                    </select>
                </div>

                <div id="ysfhkm_slc_negh">
                    <span class="span_icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </span>
                    <select name="state">
                        <option value=""><?php echo trans("states_all"); ?></option>
                        <?php foreach ($states as $row) {  ?>
                            <option style="" value="<?php echo $row->id; ?>" <?= $row->is_capital ? 'selected' : '' ?>><?php echo $row->name; ?> </option>
                        <?php } ?>
                    </select>
                </div>

                <div id="ysfhkm_slc_city">
                    <span class="span_icon">
                        <i class="fas fa-street-view"></i>
                    </span>
                    <select name="city">
                        <option value=""><?php echo trans("cities_all"); ?></option>
                        <?php foreach ($cities as $row) {  ?>
                            <option style="" value="<?php echo $row->id; ?>" <?= $row->is_default ? 'selected' : '' ?>><?php echo $row->name; ?> </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="search-span search-button">
                    <button id="searchbutton" class="btn btn-block" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <?php
                echo form_close();
                ?>
            </div>
        </div>
    </div>
</div>



<!-- Wrapper -->
<div id="wrapper" class="index-wrapper">
    <div class="container container-slider">
        <?php if (!empty($slider_items) && $general_settings->index_slider == 1) : ?>
            <div class="section section-slider" style="">
                <!-- main slider -->
                <?php $this->load->view("partials/_main_slider"); ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="container">
        <div class="row">
            <h1 class="index-title"><?php echo html_escape($settings->site_title); ?></h1>
            <?php if ($featured_category_count > 0 && $general_settings->index_categories == 1) : ?>
                <div class="col-12 section section-categories hidden-sm-down">
                    <!-- featured categories -->
                    <?php $this->load->view("partials/_featured_categories"); ?>
                </div>
                <div class="col-12 section section-categories hidden-md-up">
                    <!-- menu featured categories -->
                    <?php $this->load->view("partials/_menu_featured_categories"); ?>
                </div>
            <?php endif; ?>
            <div class="col-12">
                <div class="row-custom row-bn">
                    <!--Include banner-->
                    <?php $this->load->view("partials/_ad_spaces", ["ad_space" => "index_1", "class" => ""]); ?>
                </div>
            </div>
            <?php if ($general_settings->index_promoted_products == 1 && $promoted_products_enabled == 1 && !empty($promoted_products)) : ?>
                <div class="col-12 section section-promoted">
                    <!-- promoted products -->
                    <?php $this->load->view("product/_promoted_products"); ?>
                </div>
            <?php endif; ?>
            <?php if ($general_settings->index_latest_products == 1 && !empty($latest_products)) : ?>
                <div class="col-12 section section-latest-products">
                    <h3 class="title"><?php echo trans("latest_products"); ?></h3>
                    <p class="title-exp"><?php echo trans("latest_products_exp"); ?></p>
                    <div class="row row-product">
                        <!--print products-->
                        <?php foreach ($latest_products as $product) : ?>
                            <!-- <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-product pr-1 pl-1"> -->
                            <?php $this->load->view('product/_product_item', ['product' => $product, 'promoted_badge' => false]); ?>
                            <!-- </div> -->
                        <?php endforeach; ?>
                    </div>

                    <div class="row-custom text-center">
                        <a href="<?php echo lang_base_url() . "products"; ?>" class="link-see-more"><span><?php echo trans("see_more"); ?>&nbsp;</span><i class="icon-arrow-right"></i></a>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-12">
                <div class="row-custom row-bn">
                    <!--Include banner-->
                    <?php $this->load->view("partials/_ad_spaces", ["ad_space" => "index_2", "class" => ""]); ?>
                </div>
            </div>
            <?php if ($general_settings->index_blog_slider == 1 && !empty($blog_slider_posts)) : ?>
                <div class="col-12 section section-blog m-0">
                    <h3 class="title"><?php echo trans("latest_blog_posts"); ?></h3>
                    <p class="title-exp"><?php echo trans("latest_blog_posts_exp"); ?></p>
                    <div class="row-custom">
                        <!-- main slider -->
                        <?php $this->load->view("blog/_blog_slider", ['blog_slider_posts' => $blog_slider_posts]); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Wrapper End-->

<!-- ==== favorites ===== --->
<div class="navCatDownMobile nav-mobile hkmfavorites">
    <div class="form-group cat-header">
        <a href="javascript:void(0)" class="btn-back-mobile-nav" data-back="normal"><i class="fas fa-chevron-left"></i> <?php echo trans("back"); ?></a>
        <span class="text-white textcat-header text-center"><?php echo trans('favorites'); ?></span>
    </div>
    <div class="nav-mobile-inner">
        <div class="profile-tab-content">
            <div class="row row-product-items row-product">
                <!--print products-->
                <?php foreach ($mfavorites_products as $product) : ?>
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

<!-- filter and menu -->
<div class="ajax-filter-menu xx">
    <div class="navCatDownMobile nav-mobile" id="SearchWindowFilter" style="margin-left: 105%;top:125px;height: 100%;">
        <div class="nav-mobile-inner">
            <ul class="navbar-nav top-search-bar mobile-search-form">

            </ul>
        </div>
    </div>
    <div class="navCatDownMobile nav-mobile" id="" style="display: none;top:58px;height: calc(100% - 58px - 60px);">
        <div class="nav-mobile-inner">
            <ul class="navbar-nav top-search-bar mobile-search-form">

            </ul>
        </div>
    </div>
</div>

<script>
    $('.product-user.text-truncate a').click(function() {
        let url = window.location.href;
        localStorage.setItem('chat_profile_url', url)
    })
</script>