<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="hkm_messages_navCatDownMobile">
	<div class="cat-header">
        <div class="mobile-header-back">
            <a href="javascript:history.go(-1)"class="btn-back-mobile-nav"> <i class="icon-arrow-left"></i> <?php echo trans("back"); ?></a>
        </div>
        <div class="mobile-header-title">
            <?php if (empty($category)):?>
                <span  class="text-white textcat-header text-center"><?php echo trans("category"); ?></span>
            <?php else:?>
                <span  class="text-white textcat-header text-center"><?php echo html_escape($category->name); ?></span>
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
                        <li class="nav-item" style="border-bottom: 1px solid #e9ecef;">
                            <?php if (empty($parent_category) && empty($category)):?>
                                <a class="nav-link" href="<?php echo lang_base_url(); ?>products" style="display: table;width: 100%;height:50px;">
                            <?php else:?>
                                <a class="nav-link" href="<?php echo generate_category_url($category); ?>" style="display: table;width: 100%;height:50px;">
                            <?php endif;?>
                                <div class="link-icon" style="display: table-cell;vertical-align: middle">
                                    <i class="fa fa-th-large float-none fa-fw fa-lg" aria-hidden="true" style="width: 45px;color:#fd7e14;text-align: left;margin-left:10px"></i>
                                    <span class="titre"><?php echo trans('all')?></span>
                                </div>
                                <div style="display: table-cell;vertical-align: middle;text-align:right">
                                    <i class="icon-arrow-right"></i>
                                </div>
                            </a>
                        </li>
                        <?php foreach ($subcategories as $item):?>
                            <li class="nav-item" style="border-bottom: 1px solid #e9ecef;">
                                <?php if ($item->subcategory_num > 1):?>
                                    <a class="nav-link" href="<?php echo generate_popup_category_url($item)?>" style="display: table;width: 100%;height: 50px;">
                                <?php else:?>    
                                    <a class="nav-link" href="<?php echo generate_category_url($item)?>" style="display: table;width: 100%;height: 50px;">
                                <?php endif;?>    
                                    <div class="link-icon" style="display: table-cell;vertical-align: middle">
                                        <img src="<?php echo get_category_image_url($item, 'icon'); ?>" alt="" style="height: 50px;width:50px;">
                                        <span class="titre" style="padding-left: 10px;"><?php echo $item->name?></span>
                                    </div>
                                    <div style="display: table-cell;vertical-align: middle;text-align:right">
                                        <i class="icon-arrow-right"></i>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach;?>
                    </ul>    
                </div>
			</div>
		</div>
	</div>
</div>