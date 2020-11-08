<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="profile-tabs">
    <ul class="nav">
        <li class="nav-item <?php echo ($active_tab == 'update_profile') ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo lang_base_url(); ?>settings/update-profile" id="hkmprofileupdate">
                <span style="font-weight: 600"><?php echo trans("update_profile"); ?></span>
                <span class="count hidden-sm-up"> <i class="fas fa-angle-right"></i> </span>
            </a>
        </li>
        <li class="nav-item <?php echo ($active_tab == 'shipping_address') ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo lang_base_url(); ?>settings/shipping-address" id="hkmshippingadresse">
                <span style="font-weight: 600"><?php echo trans("shipping_address"); ?></span>
                <span class="count hidden-sm-up"> <i class="fas fa-angle-right"></i> </span>
            </a>
        </li>
        <li class="nav-item <?php echo ($active_tab == 'contact_informations') ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo lang_base_url(); ?>settings/contact-informations" id="hkmcontactinformation">
                <span style="font-weight: 600"><?php echo trans("contact_informations"); ?></span>
                <span class="count hidden-sm-up"> <i class="fas fa-angle-right"></i> </span>
            </a>
        </li>
        <li class="d-none nav-item <?php echo ($active_tab == 'social_media') ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo lang_base_url(); ?>settings/social-media">
                <span style="font-weight: 600"><?php echo trans("social_media"); ?></span>
            </a>
        </li>
        <li class="nav-item <?php echo ($active_tab == 'change_password') ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo lang_base_url(); ?>settings/change-password" id="hkmchangepassword">
                <span style="font-weight: 600"><?php echo trans("change_password"); ?></span>
                <span class="count hidden-sm-up"> <i class="fas fa-angle-right"></i> </span>
            </a>
        </li>
    </ul>
</div>