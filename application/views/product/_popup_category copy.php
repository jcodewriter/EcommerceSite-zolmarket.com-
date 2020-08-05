<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="hkm_messages_navCatDownMobile">
	<div class="cat-header">
        <div class="mobile-header-back">
            <a href="javascript:void(0)" name="category-back-link" class="btn-back-mobile-nav"> <i class="icon-arrow-left"></i> <?php echo trans("back"); ?></a>
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
                                <div class="nav-link" name="category-link" category-link="<?php echo lang_base_url(); ?>products" show-product="1" style="display: table;width: 100%;height:50px;">
                            <?php else:?>
                                <div class="nav-link" name="category-link" category-link="<?php echo generate_category_url($category); ?>" show-product="<?php echo $category->id;?>" style="display: table;width: 100%;height:50px;">
                            <?php endif;?>
                                <div class="link-icon" style="display: table-cell;vertical-align: middle">
                                    <!-- <div style="width: 60px;"> -->
                                        <i class="fa fa-th-large float-none fa-fw fa-lg" aria-hidden="true" style="width: 45px;color:#fd7e14;text-align: left;margin-left:10px"></i>
                                    <!-- </div> -->
                                    <span class="titre"><?php echo trans('all')?></span>
                                </div>
                                <div style="display: table-cell;vertical-align: middle;text-align:right">
                                    <i class="icon-arrow-right"></i>
                                </div>
                            </div>
                        </li>
                        <?php foreach ($subcategories as $item):?>
                            <li class="nav-item" style="border-bottom: 1px solid #e9ecef;">
                                <div class="nav-link" name="category-link" category-link="<?php echo generate_category_url($item)?>" show-product="<?php echo $item->subcategory_num>1?0:$item->id;?>" style="display: table;width: 100%;height: 50px;">
                                    <div class="link-icon" style="display: table-cell;vertical-align: middle">
                                        <!-- <div style="width: 50px;"> -->
                                            <img src="<?php echo get_category_image_url($item, 'icon'); ?>" alt="" style="height: 50px;width:50px;">
                                        <!-- </div> -->
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