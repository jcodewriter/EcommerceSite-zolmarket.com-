<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="hkm_messages_navCatDownMobile">
    <div class="cat-header">
        <div class="mobile-header-back">
            <a href="<?php echo lang_base_url() . 'account/' . $this->auth_user->slug; ?>" class="btn-back-mobile-nav"> <i class="icon-arrow-left"></i> <?php echo trans("back"); ?> </a>
        </div>
        <div class="mobile-header-title">
            <span class="text-white textcat-header text-center"><?php echo $title; ?></span>
        </div>
        <div class="mobilde-header-cart">
        </div>
    </div>
</div>
<br />
<!-- Wrapper -->
<div id="wrapper">
    <div class="container">
        <div class="row hidden-sm-down">
            <div class="col-12">
                <nav class="nav-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo lang_base_url(); ?>"><?php echo trans("home"); ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                    </ol>
                </nav>

                <h1 class="page-title"><?php echo trans("settings"); ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-3 hidden-sm-down">
                <div class="row-custom">
                    <!-- load profile nav -->
                    <?php $this->load->view("settings/_setting_tabs", ["user_plan" => $user_plan, "days_left" => $days_left]); ?>
                </div>
            </div>
            <div class="col-sm-12 col-md-9">

                <div class="membership__box">
                    <div class="membership__box-body">
                        <?php if (!empty($user_plan)) : ?>
                            <div class="form-group">
                                <label class="control-label"><?= trans("current_plan"); ?></label><br>
                                <p class="label label-success label-user-plan"><?= $user_plan->plan_title; ?></p>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?= trans("plan_expiration_date"); ?></label><br>
                                <?php if ($user_plan->is_unlimited_time) : ?>
                                    <p class="text-success"><?= trans("unlimited"); ?></p>
                                <?php else : ?>
                                    <p><?= formatted_date($user_plan->plan_end_date); ?>&nbsp;<span class="text-danger">(<?= ucfirst(trans("days_left")); ?>:&nbsp;<?= $days_left < 0 ? 0 : $days_left; ?>)</span></p>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?= trans("number_remaining_ads"); ?></label><br>
                                <?php if ($user_plan->is_unlimited_time) : ?>
                                    <p class="text-success"><?= trans("unlimited"); ?></p>
                                <?php else : ?>
                                    <p><?= $ads_left; ?></p>
                                <?php endif; ?>
                            </div>
                            <?php if ($this->auth_user->is_membership_plan_expired == 1) : ?>
                                <div class="form-group text-center">
                                    <p class="label label-danger label-user-plan"><?= trans("msg_plan_expired"); ?></p>
                                </div>
                            <?php endif; ?>
                            <div class="form-group text-center">
                                <a href="<?= lang_base_url(); ?>settings/renew-membership-plan" class="btn btn-md btn-block btn-slate m-t-30" style="padding: 10px 12px;"><?php echo trans("renew_your_plan") ?></a>
                            </div>
                        <?php else : ?>
                            <div class="form-group alert alert-danger alert-large">
                                <strong><?php echo trans("warning"); ?>!</strong>&nbsp;&nbsp;<?= trans("do_not_have_membership_plan"); ?>
                            </div>
                            <div class="form-group text-center">
                                <a href="<?= lang_base_url(); ?>settings/renew-membership-plan" class="btn btn-md btn-block btn-slate m-t-30" style="padding: 10px 12px;"><?php echo trans("select_your_plan") ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if (!empty($user_plan) && $user_plan->is_unlimited_time != 1) : ?>
                    <div class="alert alert-info alert-large">
                        <strong><?php echo trans("warning"); ?>!</strong>&nbsp;&nbsp;<?php echo trans("msg_expired_plan"); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>