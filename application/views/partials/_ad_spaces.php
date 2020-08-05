<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--print banner-->
<?php if (!empty($ad_space)):
    $ad_codes_728 = get_ad_data($ad_space, 'ad_code_728');
    $ad_codes_468 = get_ad_data($ad_space, 'ad_code_468');
    $ad_codes_250 = get_ad_data($ad_space, 'ad_code_250');

    // print_r($ad_code_250); exit;
    if (!empty($ad_codes_728)) : 
        $ad_code_728 = $ad_codes_728[array_rand($ad_codes_728)];?>
        <div class="bn-lg <?php echo(isset($class) ? $class : ''); ?>">
            <a href="<?php echo $ad_code_728->site_url;?>" target="_blank">
                <img src="<?php echo $ad_code_728->img_url;?>" class="ad-image-xlg" alt="">
            </a>
        </div>
    <?php endif;
    if (!empty($ad_codes_468)) : 
        $ad_code_468 = $ad_codes_468[array_rand($ad_codes_468)];?>
        <div class="bn-md <?php echo(isset($class) ? $class : ''); ?>">
            <a href="<?php echo $ad_code_468->site_url;?>" target="_blank">
                <img src="<?php echo $ad_code_468->img_url;?>" class="ad-image-lg" alt="">
            </a>
        </div>
    <?php endif;
    if (!empty($ad_codes_250)) : 
        $ad_code_250 = $ad_codes_250[array_rand($ad_codes_250)];?>
        <div class="bn-sm <?php echo(isset($class) ? $class : ''); ?>">
            <a href="<?php echo $ad_code_250->site_url;?>" target="_blank">
                <img src="<?php echo $ad_code_250->img_url;?>" class="ad-image-sm" alt="">
            </a>
        </div>
    <?php endif;
endif; ?>


