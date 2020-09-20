<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    .hkmnavCatDownMobile {
        -moz-transition: 0.2s all ease-in-out;
        -webkit-transition: 0.2s all ease-in-out;
        -o-transition: 0.2s all ease-in-out;
        -ms-transition: 0.2s all ease-in-out;
        transition: 0.2s all ease-in-out;
    }
</style>
<!--profile page tabs-->
<div class="profile-tabs">
    <ul class="nav">
        <?php if (is_multi_vendor_active()): ?>
            <?php if ($user->role == 'admin' || $user->role == 'vendor'): ?>
                <li class="nav-item <?php echo ($active_tab == 'products') ? 'active' : ''; ?>">
                    <a class="nav-link" id="hkmproducts"
                       href="<?php echo lang_base_url() . "product/" . $user->slug; ?>">
                        <div class="profile-tab-item">
                            <div class="profile-tab-icon">
                                <span class="material-icons">shopping_cart</span>
                            </div>
                            <span style="flex-grow: 1"><?php echo trans("products"); ?></span>
                            <span><?php echo get_user_products_count($user->slug); ?></span>
                            <span class="material-icons hidden-sm-up">keyboard_arrow_right</span>
                        </div>
                    </a>
                </li>
            <?php endif; ?>
            <!-- start here -->
            <?php if ($this->auth_check && $this->auth_user->id == $user->id && ($user->role == 'admin' || $user->role == 'vendor')): ?>
                <?php if ($this->auth_check && $this->auth_user->role == "admin"): ?>
                    <li class="nav-item <?php echo ($active_tab == 'adminpanel') ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?php echo admin_url(); ?>">
                            <div class="profile-tab-item">
                                <div class="profile-tab-icon">
                                    <span class="material-icons">admin_panel_settings</span>
                                </div>
                                <span style="flex-grow: 1"><?php echo trans("admin_panel"); ?></span>
                                <span class="material-icons hidden-sm-up">keyboard_arrow_right</span>
                            </div>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            <?php if (is_sale_active()): ?>
                <li class="nav-item <?php echo ($active_tab == 'orders') ? 'active' : ''; ?>">
                    <a class="nav-link" id="hkmorders" href="<?php echo lang_base_url(); ?>orders">
                        <div class="profile-tab-item">
                            <div class="profile-tab-icon">
                                <span class="material-icons">shopping_basket</span>
                            </div>
                            <span style="flex-grow: 1"><?php echo trans("orders"); ?></span>
                            <span class="material-icons hidden-sm-up">keyboard_arrow_right</span>
                        </div>
                    </a>
                </li>
            <?php endif; ?>
            <!-- end here -->
            <?php if ($this->auth_check && $this->auth_user->id == $user->id && ($user->role == 'admin' || $user->role == 'vendor')): ?>
                <li class="nav-item <?php echo ($active_tab == 'pending_products') ? 'active' : ''; ?>">
                    <a class="nav-link" id="hkmpending_products" href="<?php echo lang_base_url(); ?>pending-products">
                        <div class="profile-tab-item">
                            <div class="profile-tab-icon">
                                <span class="material-icons">pending</span>
                            </div>
                            <span style="flex-grow: 1"><?php echo trans("pending_products"); ?></span>
                            <span><?php echo get_user_pending_products_count($user->id); ?></span>
                            <span class="material-icons hidden-sm-up">keyboard_arrow_right</span>
                        </div>
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($this->auth_check && $this->auth_user->id == $user->id && ($user->role == 'admin' || $user->role == 'vendor')): ?>
                <li class="nav-item <?php echo ($active_tab == 'hidden_products') ? 'active' : ''; ?>">
                    <a class="nav-link" id="hkmhidden_products" href="<?php echo lang_base_url(); ?>hidden-products">
                        <div class="profile-tab-item">
                            <div class="profile-tab-icon">
                                <span class="material-icons">visibility_off</span>
                            </div>
                            <span style="flex-grow: 1"><?php echo trans("hidden_products"); ?></span>
                            <span><?php echo get_user_hidden_products_count($user->id); ?></span>
                            <span class="material-icons hidden-sm-up">keyboard_arrow_right</span>
                        </div>
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($this->auth_check && $this->auth_user->id == $user->id && ($user->role == 'admin' || $user->role == 'vendor')): ?>
                <li class="nav-item <?php echo ($active_tab == 'drafts') ? 'active' : ''; ?>">
                    <a class="nav-link" id="hkmdrafts" href="<?php echo lang_base_url(); ?>drafts">
                        <div class="profile-tab-item">
                            <div class="profile-tab-icon">
                                <span class="material-icons">assignment</span>
                            </div>
                            <span style="flex-grow: 1"><?php echo trans("drafts"); ?></span>
                            <span><?php echo get_user_drafts_count($user->id); ?></span>
                            <span class="material-icons hidden-sm-up">keyboard_arrow_right</span>
                        </div>
                    </a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
        <li class="nav-item <?php echo ($active_tab == 'favorites') ? 'active' : ''; ?>">
            <a class="nav-link" id="hkmfavorites" href="<?php echo lang_base_url() . "favorites/" . $user->slug; ?>">
                <div class="profile-tab-item">
                    <div class="profile-tab-icon">
                        <span class="material-icons">favorite</span>
                    </div>
                    <span style="flex-grow: 1"><?php echo trans("favorites"); ?></span>
                    <span><?php echo get_user_favorited_products_count($user->id); ?></span>
                    <span class="material-icons hidden-sm-up">keyboard_arrow_right</span>
                </div>
            </a>
        </li>
        <?php if (is_multi_vendor_active()): ?>
            <?php if ($this->auth_check && $this->auth_user->id == $user->id && is_marketplace_active()): ?>
                <li class="nav-item <?php echo ($active_tab == 'downloads') ? 'active' : ''; ?>">
                    <a class="nav-link" id="hkmdownloads" href="<?php echo lang_base_url(); ?>downloads">
                        <div class="profile-tab-item">
                            <div class="profile-tab-icon">
                                <span class="material-icons">cloud_download</span>
                            </div>
                            <span style="flex-grow: 1"><?php echo trans("downloads"); ?></span>
                            <span><?php echo get_user_downloads_count($user->id); ?></span>
                            <span class="material-icons hidden-sm-up">keyboard_arrow_right</span>
                        </div>
                    </a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
        <li class="nav-item <?php echo ($active_tab == 'followers') ? 'active' : ''; ?>">
            <a class="nav-link" id="hkmfollowers" href="<?php echo lang_base_url() . "followers/" . $user->slug; ?>">
                <div class="profile-tab-item">
                    <div class="profile-tab-icon">
                        <span class="material-icons">person_add_alt_1</span>
                    </div>
                    <span style="flex-grow: 1"><?php echo trans("followers"); ?></span>
                    <span><?php echo get_followers_count($user->id); ?></span>
                    <span class="material-icons hidden-sm-up">keyboard_arrow_right</span>
                </div>
            </a>
        </li>
        <li class="nav-item <?php echo ($active_tab == 'following') ? 'active' : ''; ?>">
            <a class="nav-link" id="hkmfollowing" href="<?php echo lang_base_url() . "following/" . $user->slug; ?>">
                <div class="profile-tab-item">
                    <div class="profile-tab-icon">
                        <span class="material-icons">people</span>
                    </div>
                    <span style="flex-grow: 1"><?php echo trans("following"); ?></span>
                    <span><?php echo get_following_users_count($user->id); ?></span>
                    <span class="material-icons hidden-sm-up">keyboard_arrow_right</span>
                </div>
            </a>
        </li>
        <?php if (($general_settings->user_reviews == 1) && ($user->role == 'admin' || $user->role == 'vendor') && is_multi_vendor_active()): ?>
            <li class="nav-item <?php echo ($active_tab == 'reviews') ? 'active' : ''; ?>">
                <a class="nav-link" id="hkmreviews" href="<?php echo lang_base_url() . "reviews/" . $user->slug; ?>">
                    <div class="profile-tab-item">
                        <div class="profile-tab-icon">
                            <span class="material-icons">rate_review</span>
                        </div>
                        <span style="flex-grow: 1"><?php echo trans("reviews"); ?></span>
                        <span><?php echo get_user_review_count($user->id); ?></span>
                        <span class="material-icons hidden-sm-up">keyboard_arrow_right</span>
                    </div>
                </a>
            </li>
        <?php endif; ?>

        <div class="d-sm-block d-block d-md-none d-lg-none" style="width: 100%;">
            <?php if ($this->auth_check && $this->auth_user->id == $user->id && ($user->role == 'admin' || $user->role == 'vendor')): ?>
                <?php if (is_sale_active()): ?>
                    <?php if (is_user_vendor()): ?>
                        <li class="nav-item <?php echo ($active_tab == 'sales') ? 'active' : ''; ?>">
                            <a class="nav-link" id="hkmsales" href="<?php echo lang_base_url(); ?>sales">
                                <div class="profile-tab-item">
                                    <div class="profile-tab-icon">
                                        <span class="material-icons">shopping_bag</span>
                                    </div>
                                    <span style="flex-grow: 1"><?php echo trans("sales"); ?></span>
                                    <span class="material-icons hidden-sm-up">keyboard_arrow_right</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item <?php echo ($active_tab == 'earnings') ? 'active' : ''; ?>">
                            <a class="nav-link" id="hkmearnings"  href="<?php echo lang_base_url(); ?>earnings">
                                <div class="profile-tab-item">
                                    <div class="profile-tab-icon">
                                        <span class="material-icons">account_balance_wallet</span>
                                    </div>
                                    <span style="flex-grow: 1"><?php echo trans("earnings"); ?></span>
                                    <span class="material-icons hidden-sm-up">keyboard_arrow_right</span>
                                </div>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (is_bidding_system_active()): ?>
                        <li class="nav-item <?php echo ($active_tab == 'quote_requests') ? 'active' : ''; ?>">
                            <a class="nav-link" id="hkmquoterequests" href="<?php echo lang_base_url(); ?>quote-requests">
                                <div class="profile-tab-item">
                                    <div class="profile-tab-icon">
                                        <span class="material-icons">request_quote</span>
                                    </div>
                                    <span style="flex-grow: 1"><?php echo trans("quote_requests"); ?></span>
                                    <span class="material-icons hidden-sm-up">keyboard_arrow_right</span>
                                </div>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($this->auth_check  && $this->auth_user->id == $user->id): ?>
                <li class="nav-item <?php echo ($active_tab == 'messages') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo lang_base_url(); ?>messages">
                        <div class="profile-tab-item">
                            <div class="profile-tab-icon">
                                <span class="material-icons">mark_email_unread</span>
                            </div>
                            <span style="flex-grow: 1"><?php echo trans("messages"); ?></span>
                            <?php if ($unread_message_count > 0): ?>
                                <span class="span-message-count"><?php echo $unread_message_count; ?></span>
                            <?php endif; ?>
                            <span class="material-icons hidden-sm-up">keyboard_arrow_right</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item <?php echo ($active_tab == 'settings') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo lang_base_url(); ?>settings">
                        <div class="profile-tab-item">
                            <div class="profile-tab-icon">
                                <span class="material-icons">settings</span>
                            </div>
                            <span style="flex-grow: 1"><?php echo trans("settings"); ?></span>
                            <span class="material-icons hidden-sm-up">keyboard_arrow_right</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item <?php echo ($active_tab == 'logout') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo lang_base_url(); ?>logout" class="logout">
                        <div class="profile-tab-item">
                            <div class="profile-tab-icon">
                                <span class="material-icons">power_settings_new</span>
                            </div>
                            <span style="flex-grow: 1"><?php echo trans("logout"); ?></span>
                            <span class="material-icons hidden-sm-up">keyboard_arrow_right</span>
                        </div>
                    </a>
                </li>
            <?php endif; ?>
        </div>
    </ul>
</div>
<div class="row-custom">
    <!--Include banner-->
    <?php $this->load->view("partials/_ad_spaces_sidebar", ["ad_space" => "profile_sidebar", "class" => "m-t-30"]); ?>
</div>

