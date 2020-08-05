<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
if (auth_check()){
    $profile = $this->auth_user;
}
?>

<style>
    .cat-header a.text-white.textcat-header.text-center {
        color: #222 !important;
        line-height: 4;
        font-size: 15px;
        display: table-cell;
        /* width: 100%; */
        text-indent: -75px;
    }

    .cat-header {
        height: 58px;
        color: #222 !important;
        background: #f5f5f5;
        /* margin-bottom: 86px; */
        float: none;
        position:fixed;
        top:0;
        display: none;
        z-index: 3;
        font-weight: bold
    }


    .btn-back-mobile-nav {
        font-size: 18px;
        color: #222 !important;
        display: table-cell;
        width: 80px;
        padding-left: 7px;
    }

    .top-search-bar .left {
        vertical-align: middle;
    }

    @media (max-width: 992px) {
        #wrapper {
            padding-top: 0;
        }
        .cat-header {
            display: table;
            border-bottom: 1px solid #eeeeee;
        }
    }
</style>

<div class="form-group mobile-profile-form  cat-header">
    <a href="javascript:history.go(-1)" class="btn-back-mobile-nav"><i class="icon-arrow-left"></i> <?php echo trans("back"); ?></a>
    <a href="javascript:void(0)" class="text-white textcat-header text-center">
        <?php if(auth_check() && $profile->id == $user->id): ?>
            <?= trans("my_account") ?>
        <?php else: ?>
            <?= mb_substr(ucfirst(get_shop_name($user)),0,28,'utf-8') ?>
        <?php endif; ?>
    </a>
</div>