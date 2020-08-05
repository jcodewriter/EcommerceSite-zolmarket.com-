<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if (!empty($ad_space)):
    $ad_codes_300 = get_ad_data($ad_space, 'ad_code_300');
    $ad_codes_250 = get_ad_data($ad_space, 'ad_code_250');

    if (!empty($ad_codes_300)) : 
        $ad_code_300 = $ad_codes_300[array_rand($ad_codes_300)];
        if ($ad_space == "products_sidebar" || $ad_space == "profile_sidebar") :?>
            <div class="bn-sidebar-160 <?php echo(isset($class) ? $class : ''); ?>">
                <a href="<?php echo $ad_code_300->site_url;?>" target="_blank">
                    <img src="<?php echo $ad_code_300->img_url;?>" class="ad-image-sidebar-160" alt="">
                </a>
            </div>
        <?php else: ?>
            <div class="bn-lg-sidebar <?php echo(isset($class) ? $class : ''); ?>">
                <a href="<?php echo $ad_code_300->site_url;?>" target="_blank">
                    <img src="<?php echo $ad_code_300->img_url;?>" class="ad-image-sidebar-250" alt="">
                </a>
            </div>
        <?php endif;
    endif;
    if (!empty($ad_codes_250)) : 
        $ad_code_250 = $ad_codes_250[array_rand($ad_codes_250)];?>
        <div class="bn-sm-sidebar <?php echo(isset($class) ? $class : ''); ?>">
            <a href="<?php echo $ad_code_250->site_url;?>" target="_blank">
                <img src="<?php echo $ad_code_250->img_url;?>" class="ad-image-sidebar-250" alt="">
            </a>
        </div>
    <?php endif;
endif; ?>




