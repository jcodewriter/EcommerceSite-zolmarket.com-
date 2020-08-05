<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="profile-tabs">
    <?php if($this->is_mobile): ?>
        <?php if($is_show): ?>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" id="hkmorders_active" href="<?php echo lang_base_url(); ?>orders/active-orders">
                    <i class="icon-shopping-basket" style="display: inline;"></i>
                    <?php echo trans('active_orders');?>
                    <span class="count hidden-sm-up" style="width:auto;">
                    <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </li>
                <li class="nav-item">
                <a class="nav-link" id="hkmorders_completed" href="<?php echo lang_base_url(); ?>orders/completed-orders">
                    <i class="icon-shopping-basket" style="display: inline;"></i>
                    <?php echo trans('completed_orders');?>
                    <span class="count hidden-sm-up" style="width:auto;">
                    <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </li>
        </ul>
        <?php endif;?>
    <?php else:?>
        <ul class="nav">
            <li class="nav-item <?php echo ($active_tab == 'active_orders') ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo lang_base_url(); ?>orders">
                    <span><?php echo trans("active_orders"); ?></span>
                </a>
            </li>
            <li class="nav-item <?php echo ($active_tab == 'completed_orders') ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo lang_base_url(); ?>orders/completed-orders">
                    <span><?php echo trans("completed_orders"); ?></span>
                </a>
            </li>
        </ul>
    <?php endif;?>
</div>