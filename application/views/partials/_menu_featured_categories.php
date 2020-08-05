<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--featured categories-->


<?php // this code  for Generate Category 
 /* More description : 
if category has  subcategory it will be take id category and generate sub catgeories in second code 
but if not have  subcategory it will be like  link when click concerne url
 */
 ?>

<div class="row">
    <?php
    foreach ($parent_categories as $category): ?>
        <!--         --><?php // var_dump($category->id);exit();?>
        <div class="col-6 col-md-4 col-lg-3 col-xl-2 col-product pl-1 pr-1">
             <?php $hasmenu = count(get_subcategories_by_parent_id($category->id)) > 0; ?>
            <div class="item-box">
                <?php if(!$hasmenu): ?>
                <a href="<?php echo generate_popup_category_url($category); ?>">
                    <img src="<?php echo $img_bg_product_small; ?>"
                     data-src="<?php echo get_category_image_url($category, 'image_2'); ?>"
                      alt="<?php echo html_escape($category->name); ?>" class="lazyload img-fluid"
                       onerror="this.src='<?php echo $img_bg_product_small; ?>'">
                    <h4 ><?php echo html_escape($category->name); ?></h4>
                </a>
                <?php else: ?>

                <a href="<?php echo generate_popup_category_url($category); ?>">
                    <img src="<?php echo $img_bg_product_small; ?>"
                    data-src="<?php echo get_category_image_url($category, 'image_2'); ?>"
                     alt="<?php echo html_escape($category->name); ?>"
                      class="lazyload img-fluid" onerror="this.src='<?php echo $img_bg_product_small; ?>'">
                    <h4 ><?php echo html_escape($category->name); ?></h4>
                </a>
            <?php endif; ?>
            </div>
        </div>
<?php endforeach; ?>
</div>


<?php //correct code because in im closting tag exists in index.php and open other dont removed ?>