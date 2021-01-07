<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--profile page tabs-->
<div class="profile-tabs">
    <ul class="nav">
        <?php if (is_multi_vendor_active()): ?>
            <?php if ($user->role == 'admin' || $user->role == 'vendor'): ?>
                <li class="nav-item <?php echo ($active_tab == 'products') ? 'active' : ''; ?>">
                    <a class="nav-link" id="hkmproducts" href="<?php echo lang_base_url() . "products/" . $user->slug; ?>">
                        <span><?php echo trans("products"); ?> (<?php echo get_user_products_count($user->slug); ?>)</span>
                        <span class="count"> <i class="fas fa-angle-right"></i> </span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($this->auth_check && $this->auth_user->id == $user->id && ($user->role == 'admin' || $user->role == 'vendor')): ?>
                <li  class="nav-item <?php echo ($active_tab == 'pending_products') ? 'active' : ''; ?>">
                    <a class="nav-link" id="hkmpending_products" href="<?php echo lang_base_url(); ?>pending-products">
                        <span><?php echo trans("pending_products"); ?> (<?php echo get_user_pending_products_count($user->id); ?>)</span>
                        <span class="count"> <i class="fas fa-angle-right"></i> </span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($this->auth_check && $this->auth_user->id == $user->id && ($user->role == 'admin' || $user->role == 'vendor')): ?>
                <li class="nav-item <?php echo ($active_tab == 'hidden_products') ? 'active' : ''; ?>">
                    <a class="nav-link" id="hkmhidden_products" href="<?php echo lang_base_url(); ?>hidden-products">
                        <span><?php echo trans("hidden_products"); ?> (<?php echo get_user_hidden_products_count($user->id); ?>)</span>
                        <span class="count"> <i class="fas fa-angle-right"></i> </span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($this->auth_check && $this->auth_user->id == $user->id && ($user->role == 'admin' || $user->role == 'vendor')): ?>
                <li class="nav-item <?php echo ($active_tab == 'drafts') ? 'active' : ''; ?>">
                    <a class="nav-link" id="hkmdrafts" href="<?php echo lang_base_url(); ?>drafts">
                        <span><?php echo trans("drafts"); ?> (<?php echo get_user_drafts_count($user->id); ?>) </span>
                        <span class="count"> <i class="fas fa-angle-right"></i> </span>
                    </a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
        <li class="nav-item <?php echo ($active_tab == 'favorites') ? 'active' : ''; ?>">
            <a class="nav-link" id="hkmfavorites" href="<?php echo lang_base_url() . "favorites/" . $user->slug; ?>">
                <span><?php echo trans("favorites"); ?> (<?php echo get_user_favorited_products_count($user->id); ?>)</span>
                <span class="count"> <i class="fas fa-angle-right"></i> </span>
            </a>
        </li>
        <?php if (is_multi_vendor_active()): ?>
            <?php if ($this->auth_check && $this->auth_user->id == $user->id && is_marketplace_active()): ?>
                <li class="nav-item <?php echo ($active_tab == 'downloads') ? 'active' : ''; ?>">
                    <a class="nav-link" id="hkmdownloads" href="<?php echo lang_base_url(); ?>downloads">
                        <span><?php echo trans("downloads"); ?> (<?php echo get_user_downloads_count($user->id); ?>)</span>
                        <span class="count"> <i class="fas fa-angle-right"></i> </span>
                    </a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
        <li class="nav-item <?php echo ($active_tab == 'followers') ? 'active' : ''; ?>">
            <a class="nav-link" id="hkmfollowers" href="<?php echo lang_base_url() . "followers/" . $user->slug; ?>">
                <span><?php echo trans("followers"); ?> (<?php echo get_followers_count($user->id); ?>)</span>
                <span class="count"> <i class="fas fa-angle-right"></i>  </span>
            </a>
        </li>
        <li class="nav-item <?php echo ($active_tab == 'following') ? 'active' : ''; ?>">
            <a class="nav-link"  id="hkmfollowing" href="<?php echo lang_base_url() . "following/" . $user->slug; ?>">
                <span><?php echo trans("following"); ?> (<?php echo get_following_users_count($user->id); ?>)</span>
                <span class="count"> <i class="fas fa-angle-right"></i> </span>
            </a>
        </li>
        <?php if (($general_settings->user_reviews == 1) && ($user->role == 'admin' || $user->role == 'vendor') && is_multi_vendor_active()): ?>
            <li class="nav-item <?php echo ($active_tab == 'reviews') ? 'active' : ''; ?>">
                <a class="nav-link"  id="hkmreviews" href="<?php echo lang_base_url() . "reviews/" . $user->slug; ?>">
                    <span><?php echo trans("reviews"); ?> (<?php echo get_user_review_count($user->id); ?>)</span>
                    <span class="count"> <i class="fas fa-angle-right"></i> </span>
                </a>
            </li>
        <?php endif; ?>
        <div class="d-sm-block d-block d-md-none d-lg-none" style="width: 100%;">
            <?php if ($this->auth_user->role == "admin"): ?>
            <li  class="nav-item <?php echo ($active_tab == 'adminpanel') ? 'active' : ''; ?>">
                <a class="nav-link"  href="<?php echo admin_url(); ?>">
                    <i class="icon-dashboard"></i>
                    <?php echo trans("admin_panel"); ?>
                    <span class="count">
                            <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </li>
        <?php endif; ?>
        <?php if (is_sale_active()): ?>
            <li class="nav-item <?php echo ($active_tab == 'orders') ? 'active' : ''; ?>">
                <a class="nav-link"  href="<?php echo lang_base_url(); ?>orders">
                    <i class="icon-shopping-basket"></i>
                    <?php echo trans("orders"); ?>
                    <span class="count">
                            <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </li>
            <?php if (is_user_vendor()): ?>
                <li class="nav-item <?php echo ($active_tab == 'sales') ? 'active' : ''; ?>">
                    <a class="nav-link"  href="<?php echo lang_base_url(); ?>sales">
                        <i class="icon-shopping-bag"></i>
                        <?php echo trans("sales"); ?>
                        <span class="count">
                            <i class="fas fa-angle-right"></i>
                    </span>
                    </a>
                </li>
                <li class="nav-item <?php echo ($active_tab == 'earnings') ? 'active' : ''; ?>">
                    <a class="nav-link"  href="<?php echo lang_base_url(); ?>earnings">
                        <i class="icon-wallet"></i>
                        <?php echo trans("earnings"); ?>
                        <span class="count">
                            <i class="fas fa-angle-right"></i>
                    </span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (is_bidding_system_active()): ?>
                <li class="nav-item <?php echo ($active_tab == 'quote_requests') ? 'active' : ''; ?>">
                    <a class="nav-link"  href="<?php echo lang_base_url(); ?>quote-requests">
                        <i class="icon-price-tag-o"></i>
                        <?php echo trans("quote_requests"); ?>
                        <span class="count">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($general_settings->digital_products_system == 1): ?>
                <li class="nav-item <?php echo ($active_tab == 'downloads') ? 'active' : ''; ?>">
                    <a class="nav-link"  href="<?php echo lang_base_url(); ?>downloads">
                        <i class="icon-download"></i>
                        <?php echo trans("downloads"); ?>
                        <span class="count">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
        <li class="nav-item <?php echo ($active_tab == 'messages') ? 'active' : ''; ?>">
            <a class="nav-link"  href="<?php echo lang_base_url(); ?>messages">
                <i class="icon-mail"></i>
                <?php echo trans("messages"); ?>
                <?php if ($unread_message_count > 0): ?>
                    <span class="span-message-count"><?php echo $unread_message_count; ?></span>
                <?php endif; ?>
                <span class="count">
                        <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </li>
        <li class="nav-item <?php echo ($active_tab == 'settings') ? 'active' : ''; ?>">
            <a class="nav-link"  href="<?php echo lang_base_url(); ?>settings">
                <i class="icon-settings"></i>
                <?php echo trans("settings"); ?>
                <span class="count">
                            <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </li>
        <li class="nav-item <?php echo ($active_tab == 'logout') ? 'active' : ''; ?>">
            <a class="nav-link"  href="<?php echo base_url(); ?>logout" class="logout">
                <i class="icon-logout"></i>
                <?php echo trans("logout"); ?>
                <span class="count">
                    <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </li>
        </div>
        <?php /*
        <?php if (is_multi_vendor_active()): ?>
            <?php if ($user->role == 'admin' || $user->role == 'vendor'): ?>
                <li class="nav-item <?php echo ($active_tab == 'products') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo lang_base_url() . "profile/" . $user->slug; ?>">
                        <span><?php echo trans("products"); ?> (<?php echo get_user_products_count($user->slug); ?>)</span>
                        <span class="count">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($this->auth_check && $this->auth_user->id == $user->id && ($user->role == 'admin' || $user->role == 'vendor')): ?>
                <li class="nav-item <?php echo ($active_tab == 'pending_products') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo lang_base_url(); ?>pending-products">
                        <span><?php echo trans("pending_products"); ?> (<?php echo get_user_pending_products_count($user->id); ?>)</span>
                        <span class="count">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($this->auth_check && $this->auth_user->id == $user->id && ($user->role == 'admin' || $user->role == 'vendor')): ?>
                <li class="nav-item <?php echo ($active_tab == 'hidden_products') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo lang_base_url(); ?>hidden-products">
                        <span><?php echo trans("hidden_products"); ?> (<?php echo get_user_hidden_products_count($user->id); ?>)</span>
                        <span class="count">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($this->auth_check && $this->auth_user->id == $user->id && ($user->role == 'admin' || $user->role == 'vendor')): ?>
                <li class="nav-item <?php echo ($active_tab == 'drafts') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo lang_base_url(); ?>drafts">
                        <span><?php echo trans("drafts"); ?> (<?php echo get_user_drafts_count($user->id); ?>)</span>
                        <span class="count">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
        <li class="nav-item <?php echo ($active_tab == 'favorites') ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo lang_base_url() . "favorites/" . $user->slug; ?>">
                <span><?php echo trans("favorites"); ?> (<?php echo get_user_favorited_products_count($user->id); ?>)</span>
                <span class="count">
                            <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </li>
        <?php if (is_multi_vendor_active()): ?>
            <?php if ($this->auth_check && $this->auth_user->id == $user->id && is_marketplace_active()): ?>
                <li class="nav-item <?php echo ($active_tab == 'downloads') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo lang_base_url(); ?>downloads">
                        <span><?php echo trans("downloads"); ?> (<?php echo get_user_downloads_count($user->id); ?>)</span>
                        <span class="count">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
        <li class="nav-item <?php echo ($active_tab == 'followers') ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo lang_base_url() . "followers/" . $user->slug; ?>">
                <span><?php echo trans("followers"); ?> (<?php echo get_followers_count($user->id); ?>)</span>
                <span class="count">
                    <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </li>
        <li class="nav-item <?php echo ($active_tab == 'following') ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo lang_base_url() . "following/" . $user->slug; ?>">
                <span><?php echo trans("following"); ?> (<?php echo get_following_users_count($user->id); ?>)</span>
                <span class="count">
                            <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </li>
        <?php if (($general_settings->user_reviews == 1) && ($user->role == 'admin' || $user->role == 'vendor') && is_multi_vendor_active()): ?>
            <li class="nav-item <?php echo ($active_tab == 'reviews') ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo lang_base_url() . "reviews/" . $user->slug; ?>">
                    <span><?php echo trans("reviews"); ?> (<?php echo get_user_review_count($user->id); ?>)</span>
                    <span class="count">
                            <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </li>
        <?php endif; ?>
        */ ?>
       <?php 
       /*
        
       */
       ?>
    </ul>
</div>
<div class="row-custom">
    <!--Include banner-->
    <?php $this->load->view("partials/_ad_spaces_sidebar", ["ad_space" => "profile_sidebar", "class" => "m-t-30"]); ?>
</div>

