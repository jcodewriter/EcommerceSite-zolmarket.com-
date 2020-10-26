<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    $current_url = $this->session->userdata('mds_current_url_session');
    $urls = explode("/", $current_url);
?>

<div class="hkm_messages_navCatDownMobile">
	<div class="cat-header">
        <div class="mobile-header-back">
            <?php if(@$location_type == "country"): ?>
                <a href="<?php echo $current_url;?>" class="btn-back-mobile-nav"> <i class="icon-arrow-left"></i> <?php echo trans("back"); ?></a>
            <?php elseif(@$location_type == "state"): ?>
                <?php if($this->general_settings->default_product_location != 0): ?>
                    <a href="<?php echo $current_url;?>" class="btn-back-mobile-nav"> <i class="icon-arrow-left"></i> <?php echo trans("back"); ?></a>
                <?php else:?>
                    <a href="location?country=0" class="btn-back-mobile-nav"> <i class="icon-arrow-left"></i> <?php echo trans("back"); ?></a>
                <?php endif;?>
            <?php endif; ?>
        </div>
        <div class="mobile-header-title">
            <?php if(@$location_type == "country"): ?>
                <span class="text-white textcat-header text-center"><?php echo trans("country"); ?></span>
            <?php elseif(@$location_type == "state"): ?>
                <span class="text-white textcat-header text-center"><?php echo trans("state"); ?></span>
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
                <div class="nav-mobile-inner">
                    <ul class="navbar-nav mobile-search-form">
                        <li class="nav-item">
                            <input type="text" oninput="filterMenuItems(this)" maxlength="300" class="form-control input-search m-0" placeholder="<?php echo trans('search')?>" style="height: 45px;background-color: #f9f9f9;">
                        </li>
                        <li class="nav-item" style="margin-top: 5px;border-top: 1px solid #e9ecef;border-bottom: 1px solid #e9ecef;">
                            <?php if (sizeof($urls) > 4):?>
                                <a href="<?php echo $current_url;?>?country=<?php echo $country;?>&state=<?php echo $state;?>" class="nav-link" style="display: table;width: 100%;height:60px;">
                            <?php else:?>
                                <a href="products?country=<?php echo $country;?>&state=<?php echo $state;?>" class="nav-link" style="display: table;width: 100%;height:60px;">
                            <?php endif;?>
                                <div class="link-icon" style="display: table-cell;vertical-align: middle">
                                    <i class="fa fa-th-large float-none fa-fw fa-lg" aria-hidden="true" style="color:#fd7e14;text-align: left;margin-left:5px"></i>
                                    <span class="titre"><?php echo trans('all')?></span>
                                </div>
                                <div style="display: table-cell;vertical-align: middle;text-align:right">
                                    <i class="icon-arrow-right"></i>
                                </div>
                            </a>
                        </li>
                        <?php foreach ($locations as $item):?>
                            <li class="nav-item" style="border-bottom: 1px solid #e9ecef;">
                                <?php if ($location_type == "state"): ?>
                                    <?php if (sizeof($urls) > 4):?>
                                        <a href="<?php echo $current_url;?>?country=<?php echo $country;?>&state=<?php echo $item->id;?>" class="nav-link" style="display: table;width: 100%;height: 60px;">
                                    <?php else:?>
                                        <a href="products?country=<?php echo $country;?>&state=<?php echo $item->id;?>" class="nav-link" style="display: table;width: 100%;height: 60px;">
                                    <?php endif;?>
                                        <div class="link-icon" style="display: table-cell;vertical-align: middle">
                                            <span class="titre" style="padding-left: 10px;"><?php echo $item->name?></span>
                                        </div>
                                        <div style="display: table-cell;vertical-align: middle;text-align:right">
                                            <i class="icon-arrow-right"></i>
                                        </div>
                                    </a>
                                <?php endif;?>
                            </li>
                        <?php endforeach;?>
                    </ul>    
                </div>
			</div>
		</div>
	</div>
</div>
