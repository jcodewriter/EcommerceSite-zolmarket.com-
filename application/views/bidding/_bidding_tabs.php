<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="profile-tabs">
    <?php if($this->is_mobile): ?>
        <?php if($is_show): ?>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" id="hkmquoterequests_recieved" href="<?php echo lang_base_url(); ?>quote-requests/quote-requests">
                        <i class="icon-wallet" style="display: inline;"></i>
                        <?php echo trans('received_quote_requests');?>
                        <span class="count hidden-sm-up" style="width:auto;">
                        <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </li>
                    <li class="nav-item">
                    <a class="nav-link" id="hkmquoterequests_sent" href="<?php echo lang_base_url(); ?>sent-quote-requests">
                        <i class="icon-wallet" style="display: inline;"></i>
                        <?php echo trans('sent_quote_requests');?>
                        <span class="count hidden-sm-up" style="width:auto;">
                        <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </li>
            </ul>
        <?php endif;?>
    <?php else:?>
        <ul class="section-tab-links">
            <li class="<?php echo ($active_tab == 'received_quote_requests') ? 'active' : ''; ?>">
                <a href="<?php echo lang_base_url(); ?>quote-requests"><?php echo trans('received_quote_requests'); ?>&nbsp;(<?php echo $received_request_count; ?>)</a>
            </li>
            <?php if (is_user_vendor()): ?>
                <li class="<?php echo ($active_tab == 'sent_quote_requests') ? 'active' : ''; ?>">
                    <a href="<?php echo lang_base_url(); ?>sent-quote-requests"><?php echo trans('sent_quote_requests'); ?>&nbsp;(<?php echo $sent_request_count; ?>)</a>
                </li>
            <?php endif; ?>
        </ul>
    <?php endif;?>
</div>