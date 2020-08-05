<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="profile-tabs">
    <?php if($this->is_mobile): ?>
        <?php if($is_show): ?>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" id="hkmsales_active" href="<?php echo lang_base_url(); ?>sales/active-sales">
                        <i class="icon-shopping-bag" style="display: inline;"></i>
                        <?php echo trans('active_sales');?>
                        <span class="count hidden-sm-up" style="width:auto;">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </li>
                    <li class="nav-item">
                    <a class="nav-link" id="hkmsales_completed" href="<?php echo lang_base_url(); ?>sales/completed-sales">
                        <i class="icon-shopping-bag" style="display: inline;"></i>
                        <?php echo trans('completed_sales');?>
                        <span class="count hidden-sm-up" style="width:auto;">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </li>
            </ul>
        <?php endif;?>
    <?php else:?>
        <ul class="nav">
            <li class="nav-item <?php echo ($active_tab == 'active_sales') ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo lang_base_url(); ?>sales">
                    <span><?php echo trans("active_sales"); ?></span>
                </a>
            </li>
            <li class="nav-item <?php echo ($active_tab == 'completed_sales') ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo lang_base_url(); ?>sales/completed-sales">
                    <span><?php echo trans("completed_sales"); ?></span>
                </a>
            </li>
        </ul>
    <?php endif;?>
</div>
