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
                        <div style="display:flex">
                            <div>
                                <span><i class="icon-cart" style=""></i> <?php echo trans("products"); ?>
                                </span>    
                            </div>
                            <div style="margin-top: 4px">
                                <span class="hidden-md-up"> &nbsp;&nbsp;(<?php echo get_user_products_count($user->slug); ?>)</span>    
                            </div>
                            <div style="flex: 1; float: right">
                                <span class="count hidden-sm-down"> &nbsp;&nbsp;(<?php echo get_user_products_count($user->slug); ?>)</span>    
                            </div>
                            <div style="margin-top: 2px;">
                                <span class="count hidden-sm-up"> <i class="fas fa-angle-right"></i> </span>            
                            </div>
                        </div>
                    </a>
                </li>
            <?php endif; ?>
            <!-- start here -->
            <?php if ($this->auth_check && $this->auth_user->id == $user->id && ($user->role == 'admin' || $user->role == 'vendor')): ?>
                <?php if ($this->auth_check && $this->auth_user->role == "admin"): ?>
                    <li class="nav-item <?php echo ($active_tab == 'adminpanel') ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?php echo admin_url(); ?>">
                            <i class="icon-dashboard"></i>
                            <?php echo trans("admin_panel"); ?>
                            <span class="count hidden-sm-up">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            <?php if (is_sale_active()): ?>
                <li class="nav-item <?php echo ($active_tab == 'orders') ? 'active' : ''; ?>">
                    <a class="nav-link" id="hkmorders" href="<?php echo lang_base_url(); ?>orders">
                        <i class="icon-shopping-basket"></i>
                        <?php echo trans("orders"); ?>
                        <span class="count hidden-sm-up">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </li>
            <?php endif; ?>
            <!-- end here -->
            <?php if ($this->auth_check && $this->auth_user->id == $user->id && ($user->role == 'admin' || $user->role == 'vendor')): ?>
                <li class="nav-item <?php echo ($active_tab == 'pending_products') ? 'active' : ''; ?>">
                    <a class="nav-link" id="hkmpending_products" href="<?php echo lang_base_url(); ?>pending-products">
                        <div style="display:flex">
                            <div>
                                <span><i class="icon-cart" ></i> <?php echo trans("pending_products"); ?></span>    
                            </div>
                            <div style="margin-top: 4px">
                                <span class="hidden-md-up"> &nbsp;&nbsp;(<?php echo get_user_pending_products_count($user->id); ?>)</span>    
                            </div>
                            <div style="flex: 1; float: right;">
                                <span class="count hidden-sm-down"> &nbsp;&nbsp;(<?php echo get_user_pending_products_count($user->id); ?>)</span>    
                            </div>
                            <div style="margin-top: 2px;">
                                <span class="count hidden-sm-up"> <i class="fas fa-angle-right"></i> </span>        
                            </div>
                        </div>
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($this->auth_check && $this->auth_user->id == $user->id && ($user->role == 'admin' || $user->role == 'vendor')): ?>
                <li class="nav-item <?php echo ($active_tab == 'hidden_products') ? 'active' : ''; ?>">
                    <a class="nav-link" id="hkmhidden_products" href="<?php echo lang_base_url(); ?>hidden-products">
                        <div style="display:flex">
                            <div>
                                <span><i class="icon-cart" ></i> <?php echo trans("hidden_products"); ?></span>  
                            </div>
                            <div style="margin-top: 4px">
                                <span class="hidden-md-up">&nbsp;&nbsp;(<?php echo get_user_hidden_products_count($user->id); ?>)</span>
                            </div>
                            <div style="flex: 1; float: right;">
                                <span class="count hidden-sm-down">&nbsp;&nbsp;(<?php echo get_user_hidden_products_count($user->id); ?>)</span>
                            </div>
                            <div style="margin-top: 2px;">
                                <span class="count hidden-sm-up"> <i class="fas fa-angle-right"></i> </span>
                            </div>
                        </div>
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($this->auth_check && $this->auth_user->id == $user->id && ($user->role == 'admin' || $user->role == 'vendor')): ?>
                <li class="nav-item <?php echo ($active_tab == 'drafts') ? 'active' : ''; ?>">
                    <a class="nav-link" id="hkmdrafts" href="<?php echo lang_base_url(); ?>drafts">
                        <div style="display:flex">
                            <div>
                                <span><i class="far fa-trash-alt" ></i> <?php echo trans("drafts"); ?></span>
                            </div>
                            <div style="margin-top: 4px">
                                <span class="hidden-md-up">&nbsp;&nbsp;(<?php echo get_user_drafts_count($user->id); ?>)</span>
                            </div>
                            <div style="flex: 1; float: right;">
                                <span class="count hidden-sm-down">&nbsp;&nbsp;(<?php echo get_user_drafts_count($user->id); ?>) </span>
                            </div>
                            <div style="margin-top: 2px;">
                                <span class="count hidden-sm-up"> <i class="fas fa-angle-right"></i> </span>
                            </div>
                        </div>
                    </a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
        <li class="nav-item <?php echo ($active_tab == 'favorites') ? 'active' : ''; ?>">
            <a class="nav-link" id="hkmfavorites" href="<?php echo lang_base_url() . "favorites/" . $user->slug; ?>">
                <div style="display:flex">
                    <div>
                        <span><i class="icon-heart-o" style="font-weight: bold;"></i> <?php echo trans("favorites"); ?></span>
                    </div>
                    <div style="margin-top: 4px">
                        <span class="hidden-md-up">&nbsp;&nbsp;(<?php echo get_user_favorited_products_count($user->id); ?>)</span>
                    </div>
                    <div style="flex: 1; float: right;">
                        <span class="count hidden-sm-down">&nbsp;&nbsp;(<?php echo get_user_favorited_products_count($user->id); ?>)</span>
                    </div>
                    <div style="margin-top: 2px;">
                        <span class="count hidden-sm-up"> <i class="fas fa-angle-right"></i> </span>
                    </div>
                </div>
            </a>
        </li>
        <?php if (is_multi_vendor_active()): ?>
            <?php if ($this->auth_check && $this->auth_user->id == $user->id && is_marketplace_active()): ?>
                <li class="nav-item <?php echo ($active_tab == 'downloads') ? 'active' : ''; ?>">
                    <a class="nav-link" id="hkmdownloads" href="<?php echo lang_base_url(); ?>downloads">
                        <div style="display:flex">
                            <div>
                                <span><i class="icon-download" style="font-weight:bold"></i> <?php echo trans("downloads"); ?></span>
                            </div>
                            <div style="margin-top: 4px">
                                <span class="hidden-md-up">&nbsp;&nbsp;(<?php echo get_user_downloads_count($user->id); ?>)</span>
                            </div>
                            <div style="flex: 1; float: right;">
                                <span class="count hidden-sm-down">&nbsp;&nbsp;(<?php echo get_user_downloads_count($user->id); ?>)</span>
                            </div>
                            <div style="margin-top: 2px;">
                                <span class="count hidden-sm-up"> <i class="fas fa-angle-right"></i> </span>
                            </div>
                        </div>
                    </a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
        <li class="nav-item <?php echo ($active_tab == 'followers') ? 'active' : ''; ?>">
            <a class="nav-link" id="hkmfollowers" href="<?php echo lang_base_url() . "followers/" . $user->slug; ?>">
                <div style="display:flex">
                    <div>
                        <span><i class="icon-user" style=""></i> <?php echo trans("followers"); ?></span>
                    </div>
                    <div style="margin-top: 4px">
                        <span class="hidden-md-up">&nbsp;&nbsp;(<?php echo get_followers_count($user->id); ?>)</span>
                    </div>
                    <div style="flex: 1; float: right;">
                        <span class="count hidden-sm-down">&nbsp;&nbsp;(<?php echo get_followers_count($user->id); ?>)</span>
                    </div>
                    <div style="margin-top: 2px;">
                        <span class="count hidden-sm-up"> <i class="fas fa-angle-right"></i> </span>
                    </div>
                </div>
            </a>
        </li>
        <li class="nav-item <?php echo ($active_tab == 'following') ? 'active' : ''; ?>">
            <a class="nav-link" id="hkmfollowing" href="<?php echo lang_base_url() . "following/" . $user->slug; ?>">
                <div style="display:flex">
                    <div>
                        <span><i class="icon-user" style=""></i> <?php echo trans("following"); ?></span>
                    </div>
                    <div style="margin-top: 4px">
                        <span class="hidden-md-up">&nbsp;&nbsp;(<?php echo get_following_users_count($user->id); ?>)</span>
                    </div>
                    <div style="flex: 1; float: right;">
                        <span class="count hidden-sm-down">&nbsp;&nbsp;(<?php echo get_following_users_count($user->id); ?>)</span>
                    </div>
                    <div style="margin-top: 2px;">
                        <span class="count hidden-sm-up"> <i class="fas fa-angle-right"></i> </span>
                    </div>
                </div>
            </a>
        </li>
        <?php if (($general_settings->user_reviews == 1) && ($user->role == 'admin' || $user->role == 'vendor') && is_multi_vendor_active()): ?>
            <li class="nav-item <?php echo ($active_tab == 'reviews') ? 'active' : ''; ?>">
                <a class="nav-link" id="hkmreviews" href="<?php echo lang_base_url() . "reviews/" . $user->slug; ?>">
                    <div style="display:flex">
                        <div>
                            <span><i class="icon-star-o" style="font-size: 16px;"></i> <?php echo trans("reviews"); ?></span>
                        </div>
                        <div style="margin-top: 4px">
                            <span class="hidden-md-up">&nbsp;&nbsp;(<?php echo get_user_review_count($user->id); ?>)</span>
                        </div>
                        <div style="flex: 1; float: right;">
                            <span class="count hidden-sm-down">&nbsp;&nbsp;(<?php echo get_user_review_count($user->id); ?>)</span>
                        </div>
                        <div style="margin-top: 2px;">
                            <span class="count hidden-sm-up"> <i class="fas fa-angle-right"></i> </span>
                        </div>
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
                                <i class="icon-shopping-bag"></i>
                                <?php echo trans("sales"); ?>
                                <span class="count hidden-sm-up">
                                    <i class="fas fa-angle-right"></i>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo ($active_tab == 'earnings') ? 'active' : ''; ?>">
                            <a class="nav-link" id="hkmearnings"  href="<?php echo lang_base_url(); ?>earnings">
                                <i class="icon-wallet"></i>
                                <?php echo trans("earnings"); ?>
                                <span class="count hidden-sm-up">
                                        <i class="fas fa-angle-right"></i>
                                </span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (is_bidding_system_active()): ?>
                        <li class="nav-item <?php echo ($active_tab == 'quote_requests') ? 'active' : ''; ?>">
                            <a class="nav-link" id="hkmquoterequests" href="<?php echo lang_base_url(); ?>quote-requests">
                                <i class="icon-price-tag-o"></i>
                                <?php echo trans("quote_requests"); ?>
                                <span class="count hidden-sm-up">
                                    <i class="fas fa-angle-right"></i>
                                </span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($this->auth_check  && $this->auth_user->id == $user->id): ?>
                <li class="nav-item <?php echo ($active_tab == 'messages') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo lang_base_url(); ?>messages">
                        <i class="icon-mail"></i>
                        <?php echo trans("messages"); ?>
                        <?php if ($unread_message_count > 0): ?>
                            <span class="span-message-count"><?php echo $unread_message_count; ?></span>
                        <?php endif; ?>
                        <span class="count hidden-sm-up">
                        <i class="fas fa-angle-right"></i>
                </span>
                    </a>
                </li>
                <li class="nav-item <?php echo ($active_tab == 'settings') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo lang_base_url(); ?>settings">
                        <i class="icon-settings"></i>
                        <?php echo trans("settings"); ?>
                        <span class="count hidden-sm-up">
                            <i class="fas fa-angle-right"></i>
                </span>
                    </a>
                </li>
                <li class="nav-item <?php echo ($active_tab == 'logout') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo lang_base_url(); ?>logout" class="logout">
                        <i class="icon-logout"></i>
                        <?php echo trans("logout"); ?>
                        <span class="count hidden-sm-up">
                    <i class="fas fa-angle-right"></i>
                </span>
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

