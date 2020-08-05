<?php

use Stripe\Terminal\Location;

defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php 
    $mds_location_type_session = $this->session->userdata('mds_location_type_session');
    $current_type = end($mds_location_type_session);
    $prev_type = prev($mds_location_type_session);
    $mds_location_data_session = $this->session->userdata('mds_location_data_session');
    $current_data = end($mds_location_data_session);
    $prev_data = prev($mds_location_data_session);
?>
<div class="hkm_messages_navCatDownMobile">
	<div class="cat-header">
        <div class="mobile-header-back">
            <a href="javascript:void(0)" name="location-link"
                location-type="<?php echo $prev_type;?>" 
                location-data="<?php echo $prev_data;?>"
                location-link="<?php 
                    echo generate_category_url($category);
                ?>"
                show-product="<?php echo @$prev_type?0:1;?>" back-type="1" class="btn-back-mobile-nav"> <i class="icon-arrow-left"></i> <?php echo trans("back"); ?>  </a>
        </div>
        <div class="mobile-header-title">
            <?php if ($this->general_settings->default_product_location != 0):?>
                <?php if(@$location_type == "city"): ?>
                    <span class="text-white textcat-header text-center"><?php echo trans("state"); ?></span>
                <?php else: ?>
                    <span class="text-white textcat-header text-center"><?php echo trans("city"); ?></span>
                <?php endif; ?>
            <?php else:?>
                <?php if(@$location_type == "state"): ?>
                    <span class="text-white textcat-header text-center"><?php echo trans("country"); ?></span>
                <?php elseif(@$location_type == "state"): ?>
                    <span class="text-white textcat-header text-center"><?php echo trans("state"); ?></span>
                <?php else: ?>
                    <span class="text-white textcat-header text-center"><?php echo trans("city"); ?></span>
                <?php endif; ?>
            <?php endif;?>
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
                <div class="nav-mobile-inner">
                    <ul class="navbar-nav mobile-search-form">
                        <li class="nav-item">
                            <input type="text" oninput="filterMenuItems(this)" maxlength="300" class="form-control input-search m-0" placeholder="<?php echo trans('search')?>" style="background-color: #f9f9f9;height:45px">
                        </li>
                        <li class="nav-item" style="margin-top: 5px;border-top: 1px solid #e9ecef;border-bottom: 1px solid #e9ecef;">
                            <?php if (empty($parent_category) && empty($category)):?>
                                <div class="nav-link" name="location-link" location-link="<?php echo lang_base_url(); ?>products" show-product="1" style="display: table;width: 100%;height:60px;">
                            <?php else:?>
                                <div class="nav-link" name="location-link" 
                                    location-link="<?php 
                                            if (!(@$location_type)){
                                                if ($_SERVER["QUERY_STRING"]) {
                                                    parse_str($_SERVER["QUERY_STRING"], $params);
                                                } else {
                                                    $params = array(
                                                        "country" => "",
                                                        "state" => "",
                                                        "city" => "",
                                                    );
                                                }

                                                unset($params["city"]);
                                                $url = http_build_query($params);
                                                echo generate_category_url($category).'?'.$url; 
                                            }else {
                                                echo generate_category_url($category);
                                            }
                                        ?>" 
                                    show-product="<?php echo $category->id;?>" style="display: table;width: 100%;height:60px;">
                            <?php endif;?>
                                <div class="link-icon" style="display: table-cell;vertical-align: middle">
                                    <i class="fa fa-th-large float-none fa-fw fa-lg" aria-hidden="true" style="color:#fd7e14;text-align: left;margin-left:5px"></i>
                                    <span class="titre"><?php echo trans('all')?></span>
                                </div>
                                <div style="display: table-cell;vertical-align: middle;text-align:right">
                                    <i class="icon-arrow-right"></i>
                                </div>
                            </div>
                        </li>
                        <?php foreach ($locations as $item):?>
                            <li class="nav-item" style="border-bottom: 1px solid #e9ecef;">
                                <div class="nav-link" name="location-link" 
                                    location-type="<?php echo @$location_type;?>" 
                                    location-data="<?php echo $item->id;?>" 
                                    location-link="<?php 
                                        if ($_SERVER["QUERY_STRING"]) {
                                            parse_str($_SERVER["QUERY_STRING"], $params);
                                        } else {
                                            $params = array(
                                                "country" => "",
                                                "state" => "",
                                                "city" => "",
                                            );
                                        }
                                    
                                        if ($this->general_settings->default_product_location != 0) {
                                            $params["country"] = $this->general_settings->default_product_location;
                                            if(@$location_type == "city") $params["state"] = $item->id;
                                            else $params["city"] = $item->id;
                                        } else {
                                            if (@$location_type == "state") $params["country"] = $item->id;
                                            else if(@$location_type == "city") $params["state"] = $item->id;
                                            else $params["city"] = $item->id;
                                        }
                                        $url = http_build_query($params);
                                        echo generate_category_url($category).'?'.$url; 
                                    ?>"
                                    show-product="<?php echo @$location_type?0:1;?>" style="display: table;width: 100%;height: 60px;">
                                    <div class="link-icon" style="display: table-cell;vertical-align: middle">
                                        <span class="titre" style="padding-left: 10px;"><?php echo $item->name?></span>
                                    </div>
                                    <div style="display: table-cell;vertical-align: middle;text-align:right">
                                        <i class="icon-arrow-right"></i>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach;?>
                    </ul>    
                </div>
			</div>
		</div>
	</div>
</div>
