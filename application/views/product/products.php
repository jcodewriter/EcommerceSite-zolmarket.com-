<?php defined('BASEPATH') or exit('No direct script access allowed');


$query_string = "";
if (!empty($_SERVER["QUERY_STRING"])) {
    $query_string = "?" . $_SERVER["QUERY_STRING"];
}

if ($page != 'product') {
    $firstcat = reset($parent_categories);
    $endcat = end($parent_categories);
    $prevcat = prev($parent_categories);
}


?>

<style>
    .mobile-search-header {
        width: 100%;
        height: 66px !important;
        display: none;
        background-color: #f5f5f5;
        border-bottom: 1px solid #9e9e9e63;
        position: fixed !important;
        top: 0;
        z-index: 5;
    }

    @media (max-width: 992px) {
        #wrapper {
            padding-top: 0;
        }
    }

    @media (max-width: 992px) {
        .mobile-search-header {
            display: block;
        }
    }
</style>


<div class="top-search-bar mobile-search-form mobile-search-header">
    <div class="mobile-header-bar">
        <?php
        $placeholder = trans("search");
        if (isset($categories) && $page != "product") :
        ?>
            <div class="back-container">
                <?php $placeholder = trans("search"); ?>
                <a href="javascript:history.go(-1)" class="btn-back-mobile-nav"><i class="icon-arrow-left"></i> <?php echo trans('back'); ?></a>
            </div>
        <?php
        else : ?>
            <div class="back-container">
                <a href="javascript:history.go(-1)" class="btn-back-mobile-nav"><i class="icon-arrow-left"></i> <?php echo trans('back'); ?></a>
            </div>
        <?php
        endif; ?>
        <div class="search-container">
            <div class="mobile-search-input">
                <input type="text" oninput="this.form.search.value = this.value" form="form-product-filters" autocomplete="off" maxlength="300" data-url="menu_search" data-query="<?= htmlspecialchars($query_string) ?>" pattern=".*\S+.*" data-window="SearchWindowFilter" class="has-search-product" value="<?php echo (!empty($filter_search)) ? $filter_search : ''; ?>" placeholder="<?php echo html_escape($placeholder); ?>" style="padding-top:10px">
            </div>
            <div class="mobile-search-submit">
                <button type="submit" form="form-product-filters" class="icon-search" style="background-color: #fff;"></button>
            </div>
        </div>
    </div>
    <div class="clearable-content"></div>
</div>


<!-- Wrapper -->
<div id="wrapper" style="padding-top: 0;">


    <!-- i remove some codes here  --->

    <div class="container confiltermenu">

        <style>
            .confiltermenu {
                margin-top: 117px !important;
            }

            .hidden-md-up.filtermenu {
                position: fixed;
                width: 100%;
                top: 58px;
                z-index: 4;
                background: white;
            }

            @media (min-width: 768px) {
                .confiltermenu {
                    margin-top: unset !important;
                }
            }
        </style>
        <!-- form start -->
        <?php echo form_open(current_url(), ['id' => 'form-product-filters', 'method' => 'get']); ?>
        <?php


        if ($is_hkm_one_country)
            $country_id = null;
        else
            $country_id = $this->input->get('country', true);

        $state_id = $this->input->get('state', true);
        $city_id = $this->input->get('city', true);
        $filter_location = get_location_input($country_id, $state_id, 0);

        ?>


        <div class="ysfhkm_granddiv hidden-sm-down">
            <div class="container">

                <div class="ysfhkm_adv_srh">
                    <div class="ysfhkm_fisrnv d-flex">
                        <?php $search = trim($this->input->get('search', TRUE)); ?>
                        <input type="search" class="flex-fill" value="<?php echo html_escape($search); ?>" name="search" id="ysfhkm_search" placeholder="<?php echo trans("search"); ?>....">

                        <div id="ysfhkm_slc_ctg">
                            <span class="span_icon">
                                <i class="fas fa-tag"></i>
                            </span>
                            <select>
                                <option value="<?= lang_base_url() . 'products' ?>" selected><?php echo trans("categories_all"); ?></option>
                                <?php $id_last = $category->id; ?>
                                <?php foreach ($categories as $row) {
                                    if ($row->parent_id == null || $row->parent_id == 0) { ?>
                                        <option style="background-color: #f0f0f0;font-weight: bold;color: #797979;" value="<?= generate_category_url($row); ?>" <?= $row->id == $category->id ? 'selected' : '' ?>><?php echo ucfirst($row->name); ?></option>
                                        <?php
                                        $id_last = $row->id;
                                        foreach ($categories as $row) {
                                            if ($row->parent_id == $id_last) {
                                        ?>
                                                <option style="" value="<?= generate_category_url(get_category($row->id)); ?>" <?= $row->id == $category->id ? 'selected' : '' ?>><?php echo ucfirst($row->name); ?> </option>
                                <?php
                                            }
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div id="ysfhkm_slc_country" class="<?= $is_hkm_one_country ? 'd-none' : '' ?>">
                            <span class="span_icon">
                                <i class="fas fa-flag"></i>
                            </span>
                            <select id="select_country" name="country">
                                <option value=""><?php echo trans("countries_all"); ?></option>
                                <?php foreach ($countries as $row) { ?>
                                    <?php $country = $this->input->get('country') ?>
                                    <?php if (strtolower(trim($row->name)) == strtolower(trim($default_location))) { ?>

                                        <option value="<?php echo $row->id; ?>" <?php echo set_select('country', $row->id, TRUE); ?>><?php echo ucfirst(strtolower($row->name)); ?> </option>
                                        <?php } else {
                                        if (($country_id) != null) :
                                        ?>
                                            <option value="<?php echo $row->id; ?>" <?= $row->id == $country_id ? 'selected' : '' ?>><?php echo ucfirst(strtolower($row->name)); ?> </option>
                                        <?php
                                        else :
                                        ?>
                                            <option value="<?php echo $row->id; ?>" <?= $row->is_default ? 'selected' : '' ?>><?php echo ucfirst(strtolower($row->name)); ?> </option>
                                        <?php
                                        endif;
                                        ?>
                                <?php }
                                } ?>
                            </select>
                        </div>

                        <div id="ysfhkm_slc_negh">
                            <span class="span_icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </span>
                            <select id="select_state" name="state">
                                <option value=""><?php echo trans("states_all"); ?></option>
                                <?php foreach ($states as $row) {
                                    if (($state_id) != null) :
                                ?>
                                        <option style="" value="<?php echo $row->id; ?>" <?= $row->id == $state_id ? 'selected' : '' ?>><?php echo $row->name; ?> </option>
                                    <?php
                                    else :
                                    ?>
                                        <option style="" value="<?php echo $row->id; ?>" <?= $row->is_capital ? 'selected' : '' ?>><?php echo $row->name; ?> </option>
                                    <?php
                                    endif;
                                    ?>
                                <?php } ?>
                            </select>
                        </div>

                        <div id="ysfhkm_slc_city">
                            <span class="span_icon">
                                <i class="fas fa-street-view"></i>
                            </span>
                            <select id="select_city" name="city">
                                <option value=""><?php echo trans("cities_all"); ?></option>
                                <?php foreach ($cities as $row) {
                                    if (($city_id) != null) :
                                ?>
                                        <option style="" value="<?php echo $row->id; ?>" <?= $row->id == $city_id ? 'selected' : '' ?>><?php echo $row->name; ?> </option>
                                    <?php
                                    else :
                                    ?>
                                        <option style="" value="<?php echo $row->id; ?>" <?= $row->is_default ? 'selected' : '' ?>><?php echo $row->name; ?> </option>
                                    <?php
                                    endif;
                                    ?>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="search-span search-button ml-1 mr-1">
                            <button id="searchbutton" class="btn btn-block" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <nav class="nav-breadcrumb pt-1 pb-1" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo lang_base_url(); ?>"><?php echo trans("home"); ?></a></li>
                                <?php if ($page != "product") : ?>
                                    <?php foreach ($parent_categories as $category) : ?>
                                        <?php if ($category->id != $endcat->id) : ?>
                                            <li class="breadcrumb-item"><a href="<?php echo generate_category_url($category); ?>">
                                                    <?php echo html_escape($category->name); ?></a>
                                            </li>

                                        <?php else : ?>
                                            <li class="breadcrumb-item">
                                                <?php echo html_escape($category->name); ?>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo trans("products"); ?></li>
                                <?php endif; ?>
                            </ol>
                        </nav>
                    </div>
                </div>


                <?php if (count($subcategories) > 0) : ?>
                    <div class="row mb-2  ">
                        <div class="col-md-12 text-left p-0">
                            <div class="form-group">
                                <?php $i = 0;
                                foreach ($subcategories as $subcat) :
                                    $i++; ?>
                                    <?php if ($i == 22) : ?>
                                        <div class="collapseIcon collapse" id="moreSubCatogries" data-icon="icon1" style="height: 0px;">
                                        <?php endif; ?>
                                        <a class="d-inline-block pl-2 pr-2 mb-2 mt-2 text-info" data-popup="toltip" title="<?= htmlspecialchars($subcat->name) ?>" style="<?= count($subcategories) > 10 ? 'width:155px;' : '' ?>" href="<?= generate_category_url($subcat) . $query_string; ?>">
                                            <?php if ($subcat->icon != '' && $subcat->visibility_icon == '1') : ?>
                                                <img src="<?= get_category_image_url($subcat, 'icon') ?>" class="d-inline-block" style="width:30px;height:30px;" />
                                            <?php else : ?>
                                                <i class="icon-arrow-right"></i>
                                            <?php endif; ?>
                                            <span class="d-inline-block"><?= htmlspecialchars($subcat->name) ?></span>
                                        </a>

                                    <?php endforeach; ?>

                                    <?php if ($i > 21) : ?>
                                        </div>
                                    <?php endif; ?>

                            </div>
                        </div>

                        <?php if ($i > 21) : ?>
                            <div class="col-md-12 text-left sm-center clearfix mrb2 p-0">
                                <a href="#moreSubCatogries" data-toggle="collapse" rel="nofollow" class="btn btn-sm  btn-default collapsed">
                                    <i class="fa fa-chevron-down" id="icon1"></i>
                                    All sub Categories
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>

                <?php endif; ?>
            </div>
        </div>

        <div class="row hidden-md-up filtermenu">
            <div class="d-flex align-items-center justify-content-between p-1" style="width: 100%;">
                <div style="width: 36%;">
                    <a class="filter-btn text-truncate d-flex justify-content-between" href="<?php echo $this->general_settings->default_product_location ? lang_base_url() . "location?country=" . $this->general_settings->default_product_location . "&state=0&current_url=" . current_url() : "location?country=0&current_url=" . current_url(); ?>">
                        <div class="d-flex justify-content-center align-items-center" style="flex: 1; max-width: 115px !important">
                            <i class="fa fa-map-marker  fa-lg mr-1 ml-1" aria-hidden="true" style="color: #fd7e14;"></i>
                            <?php if (empty($filter_location)) : ?>
                                <span class="titre m-0 flex-fill  text-truncate text-left h-100">
                                    <?= $is_hkm_one_country ? '' : ($capital_country ? $capital_country->name : (trans('country') . ' , ')) ?>
                                    <?= $capital_state ? $capital_state->name : trans('state') . ' ' ?>
                                </span>
                            <?php else : ?>
                                <span class="titre m-0 flex-fill  text-truncate text-left h-100" style="text-overflow: clip !important;"><?= $filter_location ?></span>
                            <?php endif; ?>
                        </div>
                        <i class="fas fa-angle-down align-self-center"></i>
                    </a>
                    <!-- <button type="button" name="location-link" location-type="<?php echo $this->general_settings->default_product_location ? "state" : "country"; ?>" location-link="<?php echo current_url() . '?' . $_SERVER['QUERY_STRING']; ?>" show-product="0" class='filter-btn text-truncate d-flex'>
                </button> -->
                </div>
                <div style="width: 37%;">
                    <a href="<?php echo lang_base_url(); ?>popup-category/all" class='filter-btn text-truncate d-flex justify-content-between'>
                        <div class="d-flex justify-content-center align-items-center" style="flex: 1; max-width: 115px !important">
                            <i class="fa fa-th-large  fa-lg mr-1 ml-1" aria-hidden="true" style="line-height: 15px !important;color: #fd7e14;"></i>
                            <?php if (!isset($category)) : ?>
                                <span class="titre  m-0 flex-fill  h-100 text-truncate" style="text-overflow: clip !important;"><?= trans('category') ?></span>
                            <?php else : ?>
                                <span class="titre  m-0 flex-fill  h-100 text-truncate" style="text-overflow: clip !important;"><?= htmlspecialchars($category->name) ?></span>
                            <?php endif; ?>
                        </div>
                        <i class="fas fa-angle-down align-self-center"></i>
                    </a>
                </div>
                <div style="width: 25%;">
                    <?php if ($category->id) : ?>
                        <a href="<?php echo lang_base_url(); ?>filter/<?php echo $category->id; ?>" class='filter-btn text-truncate d-flex'>
                            <div class="d-flex justify-content-center align-items-center" style="flex: 1;">
                                <i class="fa fa-filter  fa-lg align-self-center mr-1 ml-1" aria-hidden="true" style="color: #fd7e14;"></i>
                                <span class="titre  m-0 flex-fill h-100"><?= trans('filter') ?></span>
                            </div>
                            <i class="fas fa-angle-down align-self-center"></i>
                        </a>
                    <?php else : ?>
                        <a href="<?php echo lang_base_url(); ?>filter/0" class='filter-btn text-truncate d-flex'>
                            <div class="d-flex justify-content-center align-items-center" style="flex: 1;">
                                <i class="fa fa-filter  fa-lg align-self-center mr-1 ml-1" aria-hidden="true" style="color: #fd7e14;"></i>
                                <span class="titre  m-0 flex-fill h-100"><?= trans('filter') ?></span>
                            </div>
                            <i class="fas fa-angle-down align-self-center"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <hr>

        <div class="row hidden-md-up">
            <div class="col-12 col-lg-12">
                <?php if (sizeof($cities) > 0) : ?>
                    <span class="ads_filter_name"><?php echo trans("all_cities") ?></span>
                    <div class="location-scroll-wrapper">
                        <?php foreach ($cities as $row) : ?>
                            <?php if ($city_id == $row->id) : ?>
                                <div class="location-scroll-item btn-block" data_id="<?php echo $row->id; ?>" data_target="select_city" data_submit_type="click"><?php echo $row->name; ?></div>
                            <?php else : ?>
                                <div class="location-scroll-item" data_id="<?php echo $row->id; ?>" data_target="select_city" data_submit_type="click"><?php echo $row->name; ?></div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <?php else :
                    if (!$state_id) : ?>
                        <span class="ads_filter_name"><?php echo trans("all_states") ?></span>
                        <div class="location-scroll-wrapper">
                            <?php foreach ($states as $row) : ?>
                                <div class="location-scroll-item" data_id="<?php echo $row->id; ?>" data_target="select_state" data_submit_type="click"><?php echo $row->name; ?></div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="col-12 col-lg-12">
                <?php
                $filters = get_filters_query_string_array();
                foreach ($custom_field_data as $row) :
                    $custom_data = $row["data"]; ?>
                    <span class="ads_filter_name"><?php echo $row["name"]; ?></span>
                    <div class="location-scroll-wrapper">
                        <?php foreach ($custom_data as $custom_data_row) :
                            if (array_key_exists($row["product_filter_key"], $filters) && array_search($custom_data_row["field_option"], $filters)) : ?>
                                <div class="location-scroll-item btn-block" data_id="<?php echo $custom_data_row["field_option"]; ?>" data_target="select_<?php echo $row["product_filter_key"]; ?>" data_submit_type="change"><?php echo $custom_data_row["field_option"]; ?></div>
                            <?php else : ?>
                                <div class="location-scroll-item" data_id="<?php echo $custom_data_row["field_option"]; ?>" data_target="select_<?php echo $row["product_filter_key"]; ?>" data_submit_type="change"><?php echo $custom_data_row["field_option"]; ?></div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="row">

            <div class="col-12 col-lg-12 sidebar-products">
                <div class="hidden-sm-down ">
                    <?php $this->load->view('product/_product_filters');
                    ?>
                </div>
            </div>

            <div class="col-12 col-lg-12">
                <div class="filter-reset-tag-container">
                    <?php if (!empty(get_location_input($country_id, 0, $city_id))) : ?>
                        <div class="filter-reset-tag">
                            <div class="left">
                                <a href="<?php echo remove_filter_from_query_string('location'); ?>"><i class="icon-close"></i></a>
                            </div>
                            <div class="right">
                                <span class="reset-tag-title"><?php echo trans("location"); ?></span>
                                <span class="rest-tag-value"><?php echo get_location_input($country_id, 0, $city_id); ?></span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php $filters = get_filters_query_string_array();
                    $custom_filters = get_custom_product_conditions($endcat->id);
                    if (!empty($filters)) :
                        foreach ($filters as $key => $value) :
                            if (!empty($value) && $key != 'sort' && $key != 'condition' && $key != 'country' && $key != 'state' && $key != 'city' && $key != 'p_min' && $key != 'p_max' && $key != 'page') : ?>
                                <div class="filter-reset-tag">
                                    <div class="left">
                                        <a href="<?php echo remove_filter_from_query_string($key); ?>"><i class="icon-close"></i></a>
                                    </div>
                                    <div class="right">
                                        <span class="reset-tag-title">
                                            <?php foreach ($custom_filters as $row) :
                                                if ($key == $row->product_filter_key) :
                                                    echo $row->name;
                                                endif;
                                            endforeach; ?>
                                        </span>
                                        <span><?php echo html_escape($value); ?></span>
                                    </div>
                                </div>
                            <?php endif;
                        endforeach;
                    endif;

                    $filter_condition = get_filter_query_string_key_value('condition');
                    if (!empty($filter_condition)) :
                        $product_condition = get_product_condition_by_key($filter_condition, $selected_lang->id);
                        if (!empty($product_condition)) : ?>
                            <div class="filter-reset-tag">
                                <div class="left">
                                    <a href="<?php echo remove_filter_from_query_string('condition'); ?>"><i class="icon-close"></i></a>
                                </div>
                                <div class="right">
                                    <span class="reset-tag-title"><?php echo trans("condition"); ?></span>
                                    <span><?php echo html_escape($product_condition->option_label); ?></span>
                                </div>
                            </div>
                        <?php endif;
                    endif;

                    $filter_p_max = @(float) get_filter_query_string_key_value('p_max');
                    $filter_p_min = @(float) get_filter_query_string_key_value('p_min');
                    if (!empty($filter_p_max) || !empty($filter_p_min)) : ?>
                        <div class="filter-reset-tag">
                            <div class="left">
                                <a href="<?php echo remove_filter_from_query_string('price'); ?>"><i class="icon-close"></i></a>
                            </div>
                            <div class="right">
                                <span class="reset-tag-title"><?php echo trans('price') . '(' . get_currency($this->payment_settings->default_product_currency) . ')'; ?></span>
                                <span>
                                    <?php if ($filter_p_min != 0) :
                                        echo trans('min') . ': ' . $filter_p_min;
                                    endif; ?>&nbsp;&nbsp;
                                    <?php if ($filter_p_max != 0) :
                                        echo trans('max') . ': ' . $filter_p_max;
                                    endif; ?>
                                </span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="product-list-content" style="display: flex">
                    <!-- <div class="row row-product"> -->
                    <div class="product-col">
                        <div class="row">
                            <div class="col-12 col-lg-12" style="background-color:transparent!important;float: right!important;">
                                <div class="product-sort-by">
                                    <span class="span-sort-by"><?php echo trans("sort_by"); ?></span>
                                    <div class="dropdown sort-select">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            <?php $filter_sort = get_filter_query_string_key_value('sort');
                                            if ($filter_sort == 'most_recent' || $filter_sort == 'lowest_price' || $filter_sort == 'highest_price') {
                                                echo trans($filter_sort);
                                            } else {
                                                echo trans('most_recent');
                                            } ?>
                                        </button>
                                        <div class="dropdown-menu">
                                            <button type="submit" name="sort" value="most_recent" class="dropdown-item"><?php echo trans("most_recent"); ?></button>
                                            <button type="submit" name="sort" value="lowest_price" class="dropdown-item"><?php echo trans("lowest_price"); ?></button>
                                            <button type="submit" name="sort" value="highest_price" class="dropdown-item"><?php echo trans("highest_price"); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="product-filter-results-area">
                                    <div class="product-filter-results">
                                        <span style="padding: 4px 0"><?php echo trans('results'); ?>: </span>
                                        <span style="background-color: #e9ecef;border-radius: 10px;padding: 4px 10px;margin-left: 5px;"><?php echo $total_products_num; ?></span>
                                    </div>
                                    <div class="product-view-method mobile">
                                        <?php if ($this->session->userdata('mds_product_view_method')) : ?>
                                            <div class="view-icon <?php echo ($this->session->userdata('mds_product_view_method') == 1) ? 'active' : ''; ?>" mobile-image-id="1">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="th-list" class="svg-inline--fa fa-th-list fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path fill="currentColor" d="M149.333 216v80c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24v-80c0-13.255 10.745-24 24-24h101.333c13.255 0 24 10.745 24 24zM0 376v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zM125.333 32H24C10.745 32 0 42.745 0 56v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zm80 448H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24zm-24-424v80c0 13.255 10.745 24 24 24H488c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24zm24 264H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24z"></path>
                                                </svg>
                                            </div>
                                            <div class="view-icon <?php echo ($this->session->userdata('mds_product_view_method') == 2) ? 'active' : ''; ?>" mobile-image-id="2">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="square" class="svg-inline--fa fa-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                    <path fill="currentColor" d="M400 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48z"></path>
                                                </svg>
                                            </div>
                                            <div class="view-icon <?php echo ($this->session->userdata('mds_product_view_method') == 3) ? 'active' : ''; ?>" mobile-image-id="3">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="th-large" class="svg-inline--fa fa-th-large fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path fill="currentColor" d="M296 32h192c13.255 0 24 10.745 24 24v160c0 13.255-10.745 24-24 24H296c-13.255 0-24-10.745-24-24V56c0-13.255 10.745-24 24-24zm-80 0H24C10.745 32 0 42.745 0 56v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zM0 296v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zm296 184h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H296c-13.255 0-24 10.745-24 24v160c0 13.255 10.745 24 24 24z"></path>
                                                </svg>
                                            </div>
                                        <?php else : ?>
                                            <div class="view-icon <?php echo ($general_settings->choose_image_view_mobile == 1) ? 'active' : ''; ?>" mobile-image-id="1">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="th-list" class="svg-inline--fa fa-th-list fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path fill="currentColor" d="M149.333 216v80c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24v-80c0-13.255 10.745-24 24-24h101.333c13.255 0 24 10.745 24 24zM0 376v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zM125.333 32H24C10.745 32 0 42.745 0 56v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zm80 448H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24zm-24-424v80c0 13.255 10.745 24 24 24H488c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24zm24 264H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24z"></path>
                                                </svg>
                                            </div>
                                            <div class="view-icon <?php echo ($general_settings->choose_image_view_mobile == 2) ? 'active' : ''; ?>" mobile-image-id="2">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="square" class="svg-inline--fa fa-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                    <path fill="currentColor" d="M400 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48z"></path>
                                                </svg>
                                            </div>
                                            <div class="view-icon <?php echo ($general_settings->choose_image_view_mobile == 3) ? 'active' : ''; ?>" mobile-image-id="3">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="th-large" class="svg-inline--fa fa-th-large fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path fill="currentColor" d="M296 32h192c13.255 0 24 10.745 24 24v160c0 13.255-10.745 24-24 24H296c-13.255 0-24-10.745-24-24V56c0-13.255 10.745-24 24-24zm-80 0H24C10.745 32 0 42.745 0 56v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zM0 296v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zm296 184h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H296c-13.255 0-24 10.745-24 24v160c0 13.255 10.745 24 24 24z"></path>
                                                </svg>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="product-view-method desktop">
                                        <?php if ($this->session->userdata('mds_product_view_method')) : ?>
                                            <div class="view-icon <?php echo ($this->session->userdata('mds_product_view_method') == 1) ? 'active' : ''; ?>" desktop-image-id="1">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="th-list" class="svg-inline--fa fa-th-list fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path fill="currentColor" d="M149.333 216v80c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24v-80c0-13.255 10.745-24 24-24h101.333c13.255 0 24 10.745 24 24zM0 376v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zM125.333 32H24C10.745 32 0 42.745 0 56v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zm80 448H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24zm-24-424v80c0 13.255 10.745 24 24 24H488c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24zm24 264H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24z"></path>
                                                </svg>
                                            </div>
                                            <div class="view-icon <?php echo ($this->session->userdata('mds_product_view_method') == 2) ? 'active' : ''; ?>" desktop-image-id="2">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="square" class="svg-inline--fa fa-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                    <path fill="currentColor" d="M400 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48z"></path>
                                                </svg>
                                            </div>
                                            <div class="view-icon <?php echo ($this->session->userdata('mds_product_view_method') == 3) ? 'active' : ''; ?>" desktop-image-id="3">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="th-large" class="svg-inline--fa fa-th-large fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path fill="currentColor" d="M296 32h192c13.255 0 24 10.745 24 24v160c0 13.255-10.745 24-24 24H296c-13.255 0-24-10.745-24-24V56c0-13.255 10.745-24 24-24zm-80 0H24C10.745 32 0 42.745 0 56v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zM0 296v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zm296 184h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H296c-13.255 0-24 10.745-24 24v160c0 13.255 10.745 24 24 24z"></path>
                                                </svg>
                                            </div>
                                        <?php else : ?>
                                            <div class="view-icon <?php echo ($general_settings->choose_image_view_desktop == 1) ? 'active' : ''; ?>" desktop-image-id="1">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="th-list" class="svg-inline--fa fa-th-list fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path fill="currentColor" d="M149.333 216v80c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24v-80c0-13.255 10.745-24 24-24h101.333c13.255 0 24 10.745 24 24zM0 376v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zM125.333 32H24C10.745 32 0 42.745 0 56v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zm80 448H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24zm-24-424v80c0 13.255 10.745 24 24 24H488c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24zm24 264H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24z"></path>
                                                </svg>
                                            </div>
                                            <div class="view-icon <?php echo ($general_settings->choose_image_view_desktop == 2) ? 'active' : ''; ?>" desktop-image-id="2">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="square" class="svg-inline--fa fa-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                    <path fill="currentColor" d="M400 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48z"></path>
                                                </svg>
                                            </div>
                                            <div class="view-icon <?php echo ($general_settings->choose_image_view_desktop == 3) ? 'active' : ''; ?>" desktop-image-id="3">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="th-large" class="svg-inline--fa fa-th-large fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path fill="currentColor" d="M296 32h192c13.255 0 24 10.745 24 24v160c0 13.255-10.745 24-24 24H296c-13.255 0-24-10.745-24-24V56c0-13.255 10.745-24 24-24zm-80 0H24C10.745 32 0 42.745 0 56v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zM0 296v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zm296 184h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H296c-13.255 0-24 10.745-24 24v160c0 13.255 10.745 24 24 24z"></path>
                                                </svg>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-product">
                            <?php foreach ($products as $key => $product) : ?>
                                <?php if ($this->session->userdata('mds_product_view_method') == 1) : ?>
                                    <?php $this->load->view('product/_product_item_th_list', ['product' => $product, 'promoted_badge' => true]); ?>
                                <?php elseif ($this->session->userdata('mds_product_view_method') == 2) : ?>
                                    <?php $this->load->view('product/_product_item_solid', ['product' => $product, 'promoted_badge' => true]); ?>
                                <?php elseif ($this->session->userdata('mds_product_view_method') == 3) : ?>
                                    <?php $this->load->view('product/_product_item', ['product' => $product, 'promoted_badge' => true]); ?>
                                <?php else : ?>
                                    <?php $this->load->view('product/_product_item_th_list', ['product' => $product, 'promoted_badge' => true]); ?>
                                <?php endif; ?>
                                <?php if (!(($key + 1) % 8)) : ?>
                                    <div class="col-12">
                                        <!--Include banner-->
                                        <?php $this->load->view("partials/_ad_spaces", ["ad_space" => "products", "class" => "m-b-20"]); ?>
                                    </div>
                            <?php endif;
                            endforeach; ?>
                            <?php if (empty($products)) : ?>
                                <div class="col-12">
                                    <p class="no-records-found"><?php echo trans("no_products_found"); ?></p>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                    <div class="sidebar-col" style="float: right">
                        <?php if (!empty($products)) :
                            $cnt = ceil(sizeof($products) / 8);
                            for ($i = 0; $i < $cnt; $i++) :
                                $this->load->view("partials/_ad_spaces_sidebar", ["ad_space" => "products_sidebar", "class" => "m-b-15"]);
                            endfor;
                        endif
                        ?>
                    </div>
                    <!--print products-->
                    <!-- </div> -->
                </div>

                <div class="product-list-pagination">
                    <?php if ($Platform == 'Mobile') : ?>
                        <div class="loadingio-spinner-rolling-9x1ye48f16e" style="display: none;">
                            <div class="ldio-xhxf2f3v5o">
                                <div></div>
                            </div>
                        </div>
                    <?php elseif ($Platform == 'Browser') : ?>
                        <div class="d-flex justify-content-center" style="width: 100%;">
                            <?php echo $this->pagination->create_links(); ?>
                        </div>
                    <?php endif; ?>
                </div>


            </div>
        </div>

        <!-- filter and menu -->
        <div class="ajax-filter-menu">
            <div class="navCatDownMobile nav-mobile" id="filter1" style="margin-left: 105%;">
                <div class="form-group cat-header">
                    <a href="javascript:void(0)" data-back="normal" class="btn-back-mobile-nav"><i class="icon-arrow-left"></i> <?= trans('back') ?></a>
                    <span href="javascript:void(0)" class="text-white textcat-header text-center" style="width: 250px;overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?= trans('filter') ?></span>
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
            <div class="navCatDownMobile nav-mobile" id="SearchWindowFilter" style="margin-left: 105%;top:66px;height: 100%;">
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
<!-- Wrapper End-->
<script>
    function view_method(item_id) {
        var data = {
            "item_id": item_id
        };
        data[csfr_token_name] = $.cookie(csfr_cookie_name);
        $.ajax({
            type: "POST",
            url: base_url + "product_controller/view_method",
            data: data,
            success: function() {
                window.location.reload();
            }
        });
    }
    $(".mobile .view-icon").click(function() {
        $(".mobile .view-icon").removeClass("active");
        $(this).addClass("active");
        var id = $(this).attr("mobile-image-id");
        view_method(id);
    });

    $(".desktop .view-icon").click(function() {
        $(".desktop .view-icon").removeClass("active");
        $(this).addClass("active");
        var id = $(this).attr("desktop-image-id");
        view_method(id);
    });

    $(".location-scroll-item").on("click", function() {
        let data_id = $(this).attr("data_id");
        let data_target = $(this).attr("data_target");
        let data_submit_type = $(this).attr("data_submit_type");
        if (data_submit_type == "click") {
            $(`#${data_target}`).val(data_id);
            $("#searchbutton").trigger("click");
        } else if (data_submit_type == "change") {
            $(`#${data_target}`).val(data_id);
            $(`#${data_target}`).trigger("onchange");
        }
    })

    // $(".location-scroll-item").on("click", function() {
    //     let location_id = $(this).attr("location_id")
    //     let target = $(this).attr("target")
    //     if (target == "state") {
    //         $("select[name=state]").val(location_id)
    //     } else {
    //         $("select[name=city]").val(location_id)
    //     }
    //     $("#searchbutton").trigger("click")
    // })
</script>
<?php if ($Platform == 'Mobile') : ?>
    <script>
        $('.product-user.text-truncate a').click(function() {
            let url = decodeURIComponent($(location).attr("href"));
            localStorage.setItem('chat_profile_url', url)
        })

        let loading = false;
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);

        $(window).scroll(function() {
            console.log("here")
            let scrollHeight = $(document).height();
            let scrollPosition = $(this).scrollTop() + $(this).height();
            let scrollTop = $(this).scrollTop();

            let slugs = window.location.pathname.split('/');
            let slug = slugs[slugs.length - 1];
            if (scrollTop > 1500 && !loading) {
                let data = {
                    'slug': slug,
                    'country': urlParams.get('country'),
                    'state': urlParams.get('state'),
                    'city': urlParams.get('city'),
                    'sort': urlParams.get('sort'),
                    'search': urlParams.get('search'),
                    'p_min': urlParams.get('p_min'),
                    'p_max': urlParams.get('p_max'),
                    'condition': urlParams.get('condition')
                }
                loading = true;
                $.ajax({
                    type: "GET",
                    url: base_url + "Product_controller/scroll_show_more",
                    data: data,
                    cache: false,
                    success: function(response) {
                        if (response != "not found") {
                            $('.product-col .row-product').append(response);
                            loading = false;
                        } else {
                            loading = true;
                        }
                    }
                });
            }
        });
    </script>
<?php endif; ?>