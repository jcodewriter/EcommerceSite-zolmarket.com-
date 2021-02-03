<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php
if (auth_check())
    $profile = $this->auth_user;
?>
<div class="profile-mobile__header">
    <a href="javascript:history.go(-1)" class="btn-back-mobile-nav"><i class="icon-arrow-left" style="font-size: 18px !important;"></i> <?php echo trans("back"); ?></a>
    <span href="javascript:void(0)" class="text-white textcat-header text-center">
        <?php if (auth_check() && $profile->id == $user->id) : ?>
            <?= trans("my_account") ?>
            <?php else : ?>
                <?= mb_substr(ucfirst(get_shop_name($user)), 0, 20, 'utf-8') ?>
                <?php endif; ?>
            </span>
            
            <a href="https://api.whatsapp.com/send?text=<?php echo html_escape(get_shop_name($user)); ?> - <?php echo lang_base_url() . "profile/" . $user->slug; ?>" target="_blank" class="profile-mobile-header-watsapp"
            class="btn btn-md btn-share whatsapp">
            <img src="<?php echo lang_base_url() ?>assets/img/watsapp.WEBP" width="25px">
        </a>
    </div>