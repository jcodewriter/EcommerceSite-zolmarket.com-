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
            <div class="col-4 p-1">
                <!-- aaa -->
                <a class="filter-btn text-truncate d-flex" href="<?php echo $this->general_settings->default_product_location ? lang_base_url() . "location?country=" . $this->general_settings->default_product_location . "&state=0&current_url=" . current_url() : "location?country=0&current_url=" . current_url(); ?>">
                    <i class="fa fa-map-marker  fa-lg align-self-center mr-1 ml-1" aria-hidden="true"></i>
                    <?php if (empty($filter_location)) : ?>
                        <span class="titre m-0 flex-fill  text-truncate text-left h-100">
                            <?= $is_hkm_one_country ? '' : ($capital_country ? $capital_country->name : (trans('country') . ' , ')) ?>
                            <?= $capital_state ? $capital_state->name : trans('state') . ' ' ?>
                        </span>
                    <?php else : ?>
                        <span class="titre m-0 flex-fill  text-truncate text-left h-100"><?= $filter_location ?></span>
                    <?php endif; ?>
                    <i class="fas fa-angle-down align-self-center"></i>
                </a>
                <!-- <button type="button" name="location-link" location-type="<?php echo $this->general_settings->default_product_location ? "state" : "country"; ?>" location-link="<?php echo current_url() . '?' . $_SERVER['QUERY_STRING']; ?>" show-product="0" class='filter-btn text-truncate d-flex'>
                </button> -->
            </div>
            <div class="col-4 p-1">
                <!-- <a type="button" name="category-link" category-link="<?php echo lang_base_url(); ?>popup-category/all" show-product="0" action-type="button" class='filter-btn text-truncate d-flex'> -->
                <a href="<?php echo lang_base_url(); ?>popup-category/all" class='filter-btn text-truncate d-flex'>
                    <img src="https://image.flaticon.com/icons/svg/95/95090.svg" class="align-self-center mr-1 ml-1" alt="Menu" style="width: 15px; filter:invert(47%) sepia(1%) saturate(8%) hue-rotate(87deg) brightness(119%) contrast(119%);">
                    <?php if (!isset($category)) : ?>
                        <span class="titre  m-0 flex-fill  h-100 text-truncate  text-center"><?= trans('category') ?></span>
                    <?php else : ?>
                        <span class="titre  m-0 flex-fill  h-100 text-truncate  text-center"><?= htmlspecialchars($category->name) ?></span>
                    <?php endif; ?>
                    <i class="fas fa-angle-down align-self-center"></i>
                </a>
            </div>
            <div class="col-4 p-1">
                <?php if ($category->id) : ?>
                    <a href="<?php echo lang_base_url(); ?>filter/<?php echo $category->id; ?>" class='filter-btn text-truncate d-flex'>
                        <i class="fa fa-sliders  fa-lg align-self-center mr-1 ml-1" aria-hidden="true"></i>
                        <span class="titre  m-0 flex-fill h-100 text-truncate  text-center"><?= trans('filter') ?></span>
                        <i class="fas fa-angle-down align-self-center"></i>
                    </a>
                <?php else : ?>
                    <a href="<?php echo lang_base_url(); ?>filter/0" class='filter-btn text-truncate d-flex'>
                        <i class="fa fa-sliders  fa-lg align-self-center mr-1 ml-1" aria-hidden="true"></i>
                        <span class="titre  m-0 flex-fill h-100 text-truncate  text-center"><?= trans('filter') ?></span>
                        <i class="fas fa-angle-down align-self-center"></i>
                    </a>
                <?php endif; ?>
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
                                        <span style="background-color: #e9ecef;border-radius: 10px;padding: 4px 10px;margin-left: 5px;"><?php echo sizeof($products); ?></span>
                                    </div>
                                    <div class="product-view-method mobile">
                                        <?php if ($this->session->userdata('mds_product_view_method')) : ?>
                                            <div class="view-icon <?php echo ($this->session->userdata('mds_product_view_method') == 1) ? 'active' : ''; ?>" mobile-image-id="1">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18.98 16.72">
                                                    <path fill="currentColor" d="M17.94.94A.09.09,0,0,1,18,1V3.74a.09.09,0,0,1-.09.09h-10a.09.09,0,0,1-.09-.09V1A.09.09,0,0,1,7.93.94h10m0-.94h-10a1,1,0,0,0-1,1V3.74a1,1,0,0,0,1,1h10a1,1,0,0,0,1-1V1a1,1,0,0,0-1-1Z" />
                                                    <path fill="currentColor" d="M4.46.94A.09.09,0,0,1,4.55,1V3.74a.09.09,0,0,1-.09.09H1a.09.09,0,0,1-.09-.09V1A.09.09,0,0,1,1,.94H4.46m0-.94H1A1,1,0,0,0,0,1V3.74a1,1,0,0,0,1,1H4.46a1,1,0,0,0,1-1V1a1,1,0,0,0-1-1Z" />
                                                    <path fill="currentColor" d="M17.94,6.91A.09.09,0,0,1,18,7V9.71a.09.09,0,0,1-.09.09h-10a.09.09,0,0,1-.09-.09V7a.09.09,0,0,1,.09-.09h10m0-.94h-10a1,1,0,0,0-1,1V9.71a1,1,0,0,0,1,1h10a1,1,0,0,0,1-1V7a1,1,0,0,0-1-1Z" />
                                                    <path fill="currentColor" d="M4.46,6.91A.09.09,0,0,1,4.55,7V9.71a.09.09,0,0,1-.09.09H1a.09.09,0,0,1-.09-.09V7A.09.09,0,0,1,1,6.91H4.46m0-.94H1A1,1,0,0,0,0,7V9.71a1,1,0,0,0,1,1H4.46a1,1,0,0,0,1-1V7a1,1,0,0,0-1-1Z" />
                                                    <path fill="currentColor" d="M17.94,12.88A.1.1,0,0,1,18,13v2.71a.1.1,0,0,1-.09.1h-10a.1.1,0,0,1-.09-.1V13a.1.1,0,0,1,.09-.09h10m0-.94h-10a1,1,0,0,0-1,1v2.71a1,1,0,0,0,1,1h10a1,1,0,0,0,1-1V13a1,1,0,0,0-1-1Z" />
                                                    <path fill="currentColor" d="M4.46,12.88a.1.1,0,0,1,.09.09v2.71a.1.1,0,0,1-.09.1H1a.1.1,0,0,1-.09-.1V13A.1.1,0,0,1,1,12.88H4.46m0-.94H1a1,1,0,0,0-1,1v2.71a1,1,0,0,0,1,1H4.46a1,1,0,0,0,1-1V13a1,1,0,0,0-1-1Z" /></svg>
                                            </div>
                                            <div class="view-icon <?php echo ($this->session->userdata('mds_product_view_method') == 2) ? 'active' : ''; ?>" mobile-image-id="2">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17.26 16.91">
                                                    <path fill="currentColor" d="M15.8,0H1.46A1.47,1.47,0,0,0,0,1.46v14a1.46,1.46,0,0,0,1.46,1.46H15.8a1.46,1.46,0,0,0,1.46-1.46v-14A1.47,1.47,0,0,0,15.8,0Zm.46,15.45a.47.47,0,0,1-.46.46H1.46A.47.47,0,0,1,1,15.45v-14A.47.47,0,0,1,1.46,1H15.8a.47.47,0,0,1,.46.46Z" /></svg>
                                            </div>
                                            <div class="view-icon <?php echo ($this->session->userdata('mds_product_view_method') == 3) ? 'active' : ''; ?>" mobile-image-id="3">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17.26 16.91">
                                                    <path fill="currentColor" d="M6.17,7.63H1.46A1.46,1.46,0,0,1,0,6.17V1.46A1.46,1.46,0,0,1,1.46,0H6.17A1.46,1.46,0,0,1,7.63,1.46V6.17A1.47,1.47,0,0,1,6.17,7.63ZM1.46,1A.47.47,0,0,0,1,1.46V6.17a.47.47,0,0,0,.46.46H6.17a.47.47,0,0,0,.46-.46V1.46A.47.47,0,0,0,6.17,1Z" />
                                                    <path fill="currentColor" d="M15.8,7.63H11.09A1.46,1.46,0,0,1,9.63,6.17V1.46A1.46,1.46,0,0,1,11.09,0H15.8a1.46,1.46,0,0,1,1.46,1.46V6.17A1.47,1.47,0,0,1,15.8,7.63ZM11.09,1a.46.46,0,0,0-.46.46V6.17a.46.46,0,0,0,.46.46H15.8a.47.47,0,0,0,.46-.46V1.46A.47.47,0,0,0,15.8,1Z" />
                                                    <path fill="currentColor" d="M6.17,16.91H1.46A1.46,1.46,0,0,1,0,15.45V10.74A1.46,1.46,0,0,1,1.46,9.28H6.17a1.46,1.46,0,0,1,1.46,1.46v4.71A1.47,1.47,0,0,1,6.17,16.91ZM1.46,10.28a.46.46,0,0,0-.46.46v4.71a.47.47,0,0,0,.46.46H6.17a.47.47,0,0,0,.46-.46V10.74a.46.46,0,0,0-.46-.46Z" />
                                                    <path fill="currentColor" d="M15.8,16.91H11.09a1.46,1.46,0,0,1-1.46-1.46V10.74a1.46,1.46,0,0,1,1.46-1.46H15.8a1.46,1.46,0,0,1,1.46,1.46v4.71A1.47,1.47,0,0,1,15.8,16.91Zm-4.71-6.63a.45.45,0,0,0-.46.46v4.71a.46.46,0,0,0,.46.46H15.8a.47.47,0,0,0,.46-.46V10.74a.46.46,0,0,0-.46-.46Z" /></svg>
                                            </div>
                                        <?php else : ?>
                                            <div class="view-icon <?php echo ($general_settings->choose_image_view_mobile == 1) ? 'active' : ''; ?>" mobile-image-id="1">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18.98 16.72">
                                                    <path fill="currentColor" d="M17.94.94A.09.09,0,0,1,18,1V3.74a.09.09,0,0,1-.09.09h-10a.09.09,0,0,1-.09-.09V1A.09.09,0,0,1,7.93.94h10m0-.94h-10a1,1,0,0,0-1,1V3.74a1,1,0,0,0,1,1h10a1,1,0,0,0,1-1V1a1,1,0,0,0-1-1Z" />
                                                    <path fill="currentColor" d="M4.46.94A.09.09,0,0,1,4.55,1V3.74a.09.09,0,0,1-.09.09H1a.09.09,0,0,1-.09-.09V1A.09.09,0,0,1,1,.94H4.46m0-.94H1A1,1,0,0,0,0,1V3.74a1,1,0,0,0,1,1H4.46a1,1,0,0,0,1-1V1a1,1,0,0,0-1-1Z" />
                                                    <path fill="currentColor" d="M17.94,6.91A.09.09,0,0,1,18,7V9.71a.09.09,0,0,1-.09.09h-10a.09.09,0,0,1-.09-.09V7a.09.09,0,0,1,.09-.09h10m0-.94h-10a1,1,0,0,0-1,1V9.71a1,1,0,0,0,1,1h10a1,1,0,0,0,1-1V7a1,1,0,0,0-1-1Z" />
                                                    <path fill="currentColor" d="M4.46,6.91A.09.09,0,0,1,4.55,7V9.71a.09.09,0,0,1-.09.09H1a.09.09,0,0,1-.09-.09V7A.09.09,0,0,1,1,6.91H4.46m0-.94H1A1,1,0,0,0,0,7V9.71a1,1,0,0,0,1,1H4.46a1,1,0,0,0,1-1V7a1,1,0,0,0-1-1Z" />
                                                    <path fill="currentColor" d="M17.94,12.88A.1.1,0,0,1,18,13v2.71a.1.1,0,0,1-.09.1h-10a.1.1,0,0,1-.09-.1V13a.1.1,0,0,1,.09-.09h10m0-.94h-10a1,1,0,0,0-1,1v2.71a1,1,0,0,0,1,1h10a1,1,0,0,0,1-1V13a1,1,0,0,0-1-1Z" />
                                                    <path fill="currentColor" d="M4.46,12.88a.1.1,0,0,1,.09.09v2.71a.1.1,0,0,1-.09.1H1a.1.1,0,0,1-.09-.1V13A.1.1,0,0,1,1,12.88H4.46m0-.94H1a1,1,0,0,0-1,1v2.71a1,1,0,0,0,1,1H4.46a1,1,0,0,0,1-1V13a1,1,0,0,0-1-1Z" /></svg>
                                            </div>
                                            <div class="view-icon <?php echo ($general_settings->choose_image_view_mobile == 2) ? 'active' : ''; ?>" mobile-image-id="2">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17.26 16.91">
                                                    <path fill="currentColor" d="M15.8,0H1.46A1.47,1.47,0,0,0,0,1.46v14a1.46,1.46,0,0,0,1.46,1.46H15.8a1.46,1.46,0,0,0,1.46-1.46v-14A1.47,1.47,0,0,0,15.8,0Zm.46,15.45a.47.47,0,0,1-.46.46H1.46A.47.47,0,0,1,1,15.45v-14A.47.47,0,0,1,1.46,1H15.8a.47.47,0,0,1,.46.46Z" /></svg>
                                            </div>
                                            <div class="view-icon <?php echo ($general_settings->choose_image_view_mobile == 3) ? 'active' : ''; ?>" mobile-image-id="3">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17.26 16.91">
                                                    <path fill="currentColor" d="M6.17,7.63H1.46A1.46,1.46,0,0,1,0,6.17V1.46A1.46,1.46,0,0,1,1.46,0H6.17A1.46,1.46,0,0,1,7.63,1.46V6.17A1.47,1.47,0,0,1,6.17,7.63ZM1.46,1A.47.47,0,0,0,1,1.46V6.17a.47.47,0,0,0,.46.46H6.17a.47.47,0,0,0,.46-.46V1.46A.47.47,0,0,0,6.17,1Z" />
                                                    <path fill="currentColor" d="M15.8,7.63H11.09A1.46,1.46,0,0,1,9.63,6.17V1.46A1.46,1.46,0,0,1,11.09,0H15.8a1.46,1.46,0,0,1,1.46,1.46V6.17A1.47,1.47,0,0,1,15.8,7.63ZM11.09,1a.46.46,0,0,0-.46.46V6.17a.46.46,0,0,0,.46.46H15.8a.47.47,0,0,0,.46-.46V1.46A.47.47,0,0,0,15.8,1Z" />
                                                    <path fill="currentColor" d="M6.17,16.91H1.46A1.46,1.46,0,0,1,0,15.45V10.74A1.46,1.46,0,0,1,1.46,9.28H6.17a1.46,1.46,0,0,1,1.46,1.46v4.71A1.47,1.47,0,0,1,6.17,16.91ZM1.46,10.28a.46.46,0,0,0-.46.46v4.71a.47.47,0,0,0,.46.46H6.17a.47.47,0,0,0,.46-.46V10.74a.46.46,0,0,0-.46-.46Z" />
                                                    <path fill="currentColor" d="M15.8,16.91H11.09a1.46,1.46,0,0,1-1.46-1.46V10.74a1.46,1.46,0,0,1,1.46-1.46H15.8a1.46,1.46,0,0,1,1.46,1.46v4.71A1.47,1.47,0,0,1,15.8,16.91Zm-4.71-6.63a.45.45,0,0,0-.46.46v4.71a.46.46,0,0,0,.46.46H15.8a.47.47,0,0,0,.46-.46V10.74a.46.46,0,0,0-.46-.46Z" /></svg>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="product-view-method desktop">
                                        <?php if ($this->session->userdata('mds_product_view_method')) : ?>
                                            <div class="view-icon <?php echo ($this->session->userdata('mds_product_view_method') == 1) ? 'active' : ''; ?>" desktop-image-id="1">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18.98 16.72">
                                                    <path fill="currentColor" d="M17.94.94A.09.09,0,0,1,18,1V3.74a.09.09,0,0,1-.09.09h-10a.09.09,0,0,1-.09-.09V1A.09.09,0,0,1,7.93.94h10m0-.94h-10a1,1,0,0,0-1,1V3.74a1,1,0,0,0,1,1h10a1,1,0,0,0,1-1V1a1,1,0,0,0-1-1Z" />
                                                    <path fill="currentColor" d="M4.46.94A.09.09,0,0,1,4.55,1V3.74a.09.09,0,0,1-.09.09H1a.09.09,0,0,1-.09-.09V1A.09.09,0,0,1,1,.94H4.46m0-.94H1A1,1,0,0,0,0,1V3.74a1,1,0,0,0,1,1H4.46a1,1,0,0,0,1-1V1a1,1,0,0,0-1-1Z" />
                                                    <path fill="currentColor" d="M17.94,6.91A.09.09,0,0,1,18,7V9.71a.09.09,0,0,1-.09.09h-10a.09.09,0,0,1-.09-.09V7a.09.09,0,0,1,.09-.09h10m0-.94h-10a1,1,0,0,0-1,1V9.71a1,1,0,0,0,1,1h10a1,1,0,0,0,1-1V7a1,1,0,0,0-1-1Z" />
                                                    <path fill="currentColor" d="M4.46,6.91A.09.09,0,0,1,4.55,7V9.71a.09.09,0,0,1-.09.09H1a.09.09,0,0,1-.09-.09V7A.09.09,0,0,1,1,6.91H4.46m0-.94H1A1,1,0,0,0,0,7V9.71a1,1,0,0,0,1,1H4.46a1,1,0,0,0,1-1V7a1,1,0,0,0-1-1Z" />
                                                    <path fill="currentColor" d="M17.94,12.88A.1.1,0,0,1,18,13v2.71a.1.1,0,0,1-.09.1h-10a.1.1,0,0,1-.09-.1V13a.1.1,0,0,1,.09-.09h10m0-.94h-10a1,1,0,0,0-1,1v2.71a1,1,0,0,0,1,1h10a1,1,0,0,0,1-1V13a1,1,0,0,0-1-1Z" />
                                                    <path fill="currentColor" d="M4.46,12.88a.1.1,0,0,1,.09.09v2.71a.1.1,0,0,1-.09.1H1a.1.1,0,0,1-.09-.1V13A.1.1,0,0,1,1,12.88H4.46m0-.94H1a1,1,0,0,0-1,1v2.71a1,1,0,0,0,1,1H4.46a1,1,0,0,0,1-1V13a1,1,0,0,0-1-1Z" /></svg>
                                            </div>
                                            <div class="view-icon <?php echo ($this->session->userdata('mds_product_view_method') == 2) ? 'active' : ''; ?>" desktop-image-id="2">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17.26 16.91">
                                                    <path fill="currentColor" d="M15.8,0H1.46A1.47,1.47,0,0,0,0,1.46v14a1.46,1.46,0,0,0,1.46,1.46H15.8a1.46,1.46,0,0,0,1.46-1.46v-14A1.47,1.47,0,0,0,15.8,0Zm.46,15.45a.47.47,0,0,1-.46.46H1.46A.47.47,0,0,1,1,15.45v-14A.47.47,0,0,1,1.46,1H15.8a.47.47,0,0,1,.46.46Z" /></svg>
                                            </div>
                                            <div class="view-icon <?php echo ($this->session->userdata('mds_product_view_method') == 3) ? 'active' : ''; ?>" desktop-image-id="3">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17.26 16.91">
                                                    <path fill="currentColor" d="M6.17,7.63H1.46A1.46,1.46,0,0,1,0,6.17V1.46A1.46,1.46,0,0,1,1.46,0H6.17A1.46,1.46,0,0,1,7.63,1.46V6.17A1.47,1.47,0,0,1,6.17,7.63ZM1.46,1A.47.47,0,0,0,1,1.46V6.17a.47.47,0,0,0,.46.46H6.17a.47.47,0,0,0,.46-.46V1.46A.47.47,0,0,0,6.17,1Z" />
                                                    <path fill="currentColor" d="M15.8,7.63H11.09A1.46,1.46,0,0,1,9.63,6.17V1.46A1.46,1.46,0,0,1,11.09,0H15.8a1.46,1.46,0,0,1,1.46,1.46V6.17A1.47,1.47,0,0,1,15.8,7.63ZM11.09,1a.46.46,0,0,0-.46.46V6.17a.46.46,0,0,0,.46.46H15.8a.47.47,0,0,0,.46-.46V1.46A.47.47,0,0,0,15.8,1Z" />
                                                    <path fill="currentColor" d="M6.17,16.91H1.46A1.46,1.46,0,0,1,0,15.45V10.74A1.46,1.46,0,0,1,1.46,9.28H6.17a1.46,1.46,0,0,1,1.46,1.46v4.71A1.47,1.47,0,0,1,6.17,16.91ZM1.46,10.28a.46.46,0,0,0-.46.46v4.71a.47.47,0,0,0,.46.46H6.17a.47.47,0,0,0,.46-.46V10.74a.46.46,0,0,0-.46-.46Z" />
                                                    <path fill="currentColor" d="M15.8,16.91H11.09a1.46,1.46,0,0,1-1.46-1.46V10.74a1.46,1.46,0,0,1,1.46-1.46H15.8a1.46,1.46,0,0,1,1.46,1.46v4.71A1.47,1.47,0,0,1,15.8,16.91Zm-4.71-6.63a.45.45,0,0,0-.46.46v4.71a.46.46,0,0,0,.46.46H15.8a.47.47,0,0,0,.46-.46V10.74a.46.46,0,0,0-.46-.46Z" /></svg>
                                            </div>
                                        <?php else : ?>
                                            <div class="view-icon <?php echo ($general_settings->choose_image_view_desktop == 1) ? 'active' : ''; ?>" desktop-image-id="1">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18.98 16.72">
                                                    <path fill="currentColor" d="M17.94.94A.09.09,0,0,1,18,1V3.74a.09.09,0,0,1-.09.09h-10a.09.09,0,0,1-.09-.09V1A.09.09,0,0,1,7.93.94h10m0-.94h-10a1,1,0,0,0-1,1V3.74a1,1,0,0,0,1,1h10a1,1,0,0,0,1-1V1a1,1,0,0,0-1-1Z" />
                                                    <path fill="currentColor" d="M4.46.94A.09.09,0,0,1,4.55,1V3.74a.09.09,0,0,1-.09.09H1a.09.09,0,0,1-.09-.09V1A.09.09,0,0,1,1,.94H4.46m0-.94H1A1,1,0,0,0,0,1V3.74a1,1,0,0,0,1,1H4.46a1,1,0,0,0,1-1V1a1,1,0,0,0-1-1Z" />
                                                    <path fill="currentColor" d="M17.94,6.91A.09.09,0,0,1,18,7V9.71a.09.09,0,0,1-.09.09h-10a.09.09,0,0,1-.09-.09V7a.09.09,0,0,1,.09-.09h10m0-.94h-10a1,1,0,0,0-1,1V9.71a1,1,0,0,0,1,1h10a1,1,0,0,0,1-1V7a1,1,0,0,0-1-1Z" />
                                                    <path fill="currentColor" d="M4.46,6.91A.09.09,0,0,1,4.55,7V9.71a.09.09,0,0,1-.09.09H1a.09.09,0,0,1-.09-.09V7A.09.09,0,0,1,1,6.91H4.46m0-.94H1A1,1,0,0,0,0,7V9.71a1,1,0,0,0,1,1H4.46a1,1,0,0,0,1-1V7a1,1,0,0,0-1-1Z" />
                                                    <path fill="currentColor" d="M17.94,12.88A.1.1,0,0,1,18,13v2.71a.1.1,0,0,1-.09.1h-10a.1.1,0,0,1-.09-.1V13a.1.1,0,0,1,.09-.09h10m0-.94h-10a1,1,0,0,0-1,1v2.71a1,1,0,0,0,1,1h10a1,1,0,0,0,1-1V13a1,1,0,0,0-1-1Z" />
                                                    <path fill="currentColor" d="M4.46,12.88a.1.1,0,0,1,.09.09v2.71a.1.1,0,0,1-.09.1H1a.1.1,0,0,1-.09-.1V13A.1.1,0,0,1,1,12.88H4.46m0-.94H1a1,1,0,0,0-1,1v2.71a1,1,0,0,0,1,1H4.46a1,1,0,0,0,1-1V13a1,1,0,0,0-1-1Z" /></svg>
                                            </div>
                                            <div class="view-icon <?php echo ($general_settings->choose_image_view_desktop == 2) ? 'active' : ''; ?>" desktop-image-id="2">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17.26 16.91">
                                                    <path fill="currentColor" d="M15.8,0H1.46A1.47,1.47,0,0,0,0,1.46v14a1.46,1.46,0,0,0,1.46,1.46H15.8a1.46,1.46,0,0,0,1.46-1.46v-14A1.47,1.47,0,0,0,15.8,0Zm.46,15.45a.47.47,0,0,1-.46.46H1.46A.47.47,0,0,1,1,15.45v-14A.47.47,0,0,1,1.46,1H15.8a.47.47,0,0,1,.46.46Z" /></svg>
                                            </div>
                                            <div class="view-icon <?php echo ($general_settings->choose_image_view_desktop == 3) ? 'active' : ''; ?>" desktop-image-id="3">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17.26 16.91">
                                                    <path fill="currentColor" d="M6.17,7.63H1.46A1.46,1.46,0,0,1,0,6.17V1.46A1.46,1.46,0,0,1,1.46,0H6.17A1.46,1.46,0,0,1,7.63,1.46V6.17A1.47,1.47,0,0,1,6.17,7.63ZM1.46,1A.47.47,0,0,0,1,1.46V6.17a.47.47,0,0,0,.46.46H6.17a.47.47,0,0,0,.46-.46V1.46A.47.47,0,0,0,6.17,1Z" />
                                                    <path fill="currentColor" d="M15.8,7.63H11.09A1.46,1.46,0,0,1,9.63,6.17V1.46A1.46,1.46,0,0,1,11.09,0H15.8a1.46,1.46,0,0,1,1.46,1.46V6.17A1.47,1.47,0,0,1,15.8,7.63ZM11.09,1a.46.46,0,0,0-.46.46V6.17a.46.46,0,0,0,.46.46H15.8a.47.47,0,0,0,.46-.46V1.46A.47.47,0,0,0,15.8,1Z" />
                                                    <path fill="currentColor" d="M6.17,16.91H1.46A1.46,1.46,0,0,1,0,15.45V10.74A1.46,1.46,0,0,1,1.46,9.28H6.17a1.46,1.46,0,0,1,1.46,1.46v4.71A1.47,1.47,0,0,1,6.17,16.91ZM1.46,10.28a.46.46,0,0,0-.46.46v4.71a.47.47,0,0,0,.46.46H6.17a.47.47,0,0,0,.46-.46V10.74a.46.46,0,0,0-.46-.46Z" />
                                                    <path fill="currentColor" d="M15.8,16.91H11.09a1.46,1.46,0,0,1-1.46-1.46V10.74a1.46,1.46,0,0,1,1.46-1.46H15.8a1.46,1.46,0,0,1,1.46,1.46v4.71A1.47,1.47,0,0,1,15.8,16.91Zm-4.71-6.63a.45.45,0,0,0-.46.46v4.71a.46.46,0,0,0,.46.46H15.8a.47.47,0,0,0,.46-.46V10.74a.46.46,0,0,0-.46-.46Z" /></svg>
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
                        <div class="float-right">
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
        $(window).scroll(function() {
            let scrollHeight = $(document).height();
            let scrollPosition = $(this).scrollTop() + $(this).height();
            let scrollTop = $(this).scrollTop();

            let slugs = window.location.pathname.split('/');
            let slug = slugs[slugs.length - 1];

            if (scrollTop > 1500 && !loading) {
                // if ((scrollHeight - scrollPosition) / scrollHeight === 0 && !loading) {
                loading = true;
                // $('.loadingio-spinner-rolling-9x1ye48f16e').css('display', 'block')
                let data = {
                    'slug': slug
                }
                $.ajax({
                    type: "GET",
                    url: base_url + "Product_controller/get_product_json",
                    data: data,
                    dataType: 'json',
                    contentType: 'application/json',
                    cache: false,
                    success: function(response) {
                        let data = response[0];
                        let ad_space = response[1];
                        // $('.loadingio-spinner-rolling-9x1ye48f16e').css('display', 'none')
                        let html = '';
                        if (data.length) {
                            for (let i in data) {
                                html = `<div class="col-6 col-sm-6 col-md-6 col-lg-3 col-product pr-1 pl-1">
                                        <div class="product-item">
                                            <div class="row-custom">
                                                <a class="item-favorite-button item-favorite-enable ${data[i].product_favorited_count ? 'item-favorited' : ''}" data-product-id="${data[i].id}"></a>
                                                <a href="${data[i].lang_base_url+data[i].slug}">
                                                    <div class="img-product-container">
                                                        <img src="${data[i].product_image}" data-src="${data[i].product_image}" alt="${data[i].title}" class="img-fluid img-product mb-0 lazyloaded" onerror="this.src='${data[i].lang_base_url}assets/img/img_bg_product_small.jpg'">
                                                    </div>
                                                </a>
                                                ${data[i].promoted ? `<span class="badge badge-dark badge-promoted"><?= trans("promoted"); ?></span>`: ''}
                                            </div>
                                            <div class="row-custom item-details">
                                                <h3 class="product-title">
                                                    <a href="${data[i].product_url}">${data[i].title}</a>
                                                </h3>
                                                <p class="product-user text-truncate">
                                                    <a href="${data[i].lang_base_url+'/profile'+data[i].user_slug}">${data[i].shop_name_product}</a>
                                                </p>
                                                <div class="rating">
                                                    <i class="${data[i].rating >= 1 ? 'icon-star' : 'icon-star-o'}"></i>
                                                    <i class="${data[i].rating >= 2 ? 'icon-star' : 'icon-star-o'}"></i>
                                                    <i class="${data[i].rating >= 3 ? 'icon-star' : 'icon-star-o'}"></i>
                                                    <i class="${data[i].rating >= 4 ? 'icon-star' : 'icon-star-o'}"></i>
                                                    <i class="${data[i].rating >= 5 ? 'icon-star' : 'icon-star-o'}"></i>
                                                </div>        
                                                <div class="item-meta">
                                                    ${data[i].is_free_product == 1
                                                        ?
                                                        `<span class="price-free"><?= trans("free"); ?></span>`
                                                        :
                                                        `${data[i].listing_type == 'bidding' 
                                                            ? 
                                                            `<a href="${data[i].product_url}" class="a-meta-request-quote"><?= trans("request_a_quote"); ?></a>`
                                                            :
                                                            `<span class="price"><span>${data[i].currency}</span>${data[i].price}
                                                                ${data[i].is_sold == 1 ? `<span>(<?= trans("sold"); ?>)</span>`: ''}
                                                            </span>`
                                                        }`
                                                    }
                                                    <span class="item-comments"><i class="icon-comment"></i>&nbsp;${data[i].product_comment_count}</span>
                                                    <span class="item-favorites"><i class="icon-heart-o"></i>&nbsp;${data[i].product_favorited_count}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                                $('.product-col .row').append(html);
                                if (!((parseInt(i) + 1) % 8)) {
                                    html = `<div class="col-12">
                                    <div class="bn-sm m-b-20">
                                        <a href="${ad_space.site_url}" target="_blank">
                                            <img src="${ad_space.img_url}" class="ad-image-sm" alt="">
                                        </a>
                                    </div>
                                </div>`;
                                    $('.product-col .row').append(html);
                                }
                            }
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