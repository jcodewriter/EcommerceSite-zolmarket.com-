<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="profile-tabs">
    <?php if($this->is_mobile): ?>
        <?php if($is_show): ?>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" id="hkmearnings_hkmearnings" href="<?php echo lang_base_url(); ?>earnings/earnings">
                        <i class="icon-wallet" style="display: inline;"></i>
                        <?php echo trans('earnings');?>
                        <span class="count hidden-sm-up" style="width:auto;">
                        <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </li>
                    <li class="nav-item">
                    <a class="nav-link" id="hkmearnings_payouts" href="<?php echo lang_base_url(); ?>payouts">
                        <i class="icon-wallet" style="display: inline;"></i>
                        <?php echo trans('payouts');?>
                        <span class="count hidden-sm-up" style="width:auto;">
                        <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </li>
                    <li class="nav-item">
                    <a class="nav-link" id="hkmearnings_setpayoutaccount" href="<?php echo lang_base_url(); ?>set-payout-account">
                        <i class="icon-wallet" style="display: inline;"></i>
                        <?php echo trans('set_payout_account');?>
                        <span class="count hidden-sm-up" style="width:auto;">
                        <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </li>
            </ul>
        <?php endif;?>
    <?php else:?>
        <ul class="nav">
            <li class="nav-item <?php echo ($active_tab == 'earnings') ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo lang_base_url(); ?>earnings">
                    <span><?php echo trans("earnings"); ?></span>
                </a>
            </li>
            <li class="nav-item <?php echo ($active_tab == 'payouts') ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo lang_base_url(); ?>payouts">
                    <span><?php echo trans("payouts"); ?></span>
                </a>
            </li>
            <li class="nav-item <?php echo ($active_tab == 'set_payout_account') ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo lang_base_url(); ?>set-payout-account">
                    <span><?php echo trans("set_payout_account"); ?></span>
                </a>
            </li>
        </ul>
    <?php endif;?>
</div>