<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--featured categories-->

<div class="row">


    <?php
    // print_r($parent_categories); exit;
    foreach ($parent_categories as $category): ?>
               <?php 
            //    var_dump($category);exit();
               ?>
        <!-- <div class="col-6 col-md-4 col-lg-3 col-xl-2  col-product pl-1 pr-1"> -->
            <div class="item-box">
                <a href="<?php echo generate_category_url($category); ?>">
                    <img src="<?php echo $img_bg_product_small; ?>" data-src="<?php echo get_category_image_url($category, 'image_1'); ?>" alt="<?php echo html_escape($category->name); ?>" class="lazyload img-fluid" onerror="this.src='<?php echo $img_bg_product_small; ?>'" width="420" height="312" />
                    <h4 ><?php echo html_escape($category->name); ?></h4>
                </a>
            </div>
        <!-- </div> -->
    <?php endforeach;

    ?>


</div>

