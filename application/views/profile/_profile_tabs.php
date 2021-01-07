<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    .hkmnavCatDownMobile {
        -moz-transition: 0.2s all ease-in-out;
        -webkit-transition: 0.2s all ease-in-out;
        -o-transition: 0.2s all ease-in-out;
        -ms-transition: 0.2s all ease-in-out;
        transition: 0.2s all ease-in-out;
    }
    .profile-tabs .nav{
        display: unset !important;
    }
</style>
<!--profile page tabs-->
<div class="profile-tabs">
    <ul class="nav">
        <?php if ($this->general_settings->membership_plans_system == 1 && $user->role == 'vendor'):?>
            <li class="nav-item <?php echo ($active_tab == 'membershipplan') ? 'active' : ''; ?>  hidden-md-up">
            <?php if (!empty($user_plan)) :?>
                <div style="text-align: center;">
                    <p style="font-weight: 600; margin-bottom: 0"><?= trans("plan_expiration_date"); ?></p>
                    <?php if ($user_plan->is_unlimited_time) : ?>
                        <span class="text-success"><?= trans("unlimited"); ?></span>
                    <?php else : ?>
                        <span style=""><?= formatted_date($user_plan->plan_end_date); ?>&nbsp;<span class="text-danger">(<?= ucfirst(trans("days_left")); ?>:&nbsp;<?= $days_left < 0 ? 0 : $days_left; ?>)</span></span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
                <a class="nav-link" id="hkmmembershipplan" href="<?php echo lang_base_url(); ?>settings/membership-plan">
                    <div class="profile-tab-item">
                        <div style="display: inline-block; width: 40px; height: 40px; margin-right: 10px; border-radius: 5px; background-color: #683ab8; text-align: center">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                width="38.4px" height="38.4px" viewBox="0 0 159.436 159.436" style="width: 23px">
                                <path style="fill:#fff" d="M157.818,54.936c-1.45-1.097-3.448-1.087-4.878,0.016l-41.966,32.028L83.431,24.753c-1.308-2.933-6.109-2.933-7.417,0
                                    L48.149,87.707L6.55,54.988c-1.432-1.129-3.446-1.16-4.91-0.074c-1.469,1.084-2.025,3.017-1.366,4.72l28.901,74.664
                                    c0.604,1.561,2.104,2.584,3.773,2.584h93.54c1.683,0,3.169-1.018,3.775-2.584l28.898-74.664
                                    C159.817,57.941,159.268,56.019,157.818,54.936z M123.715,128.782h-87.99L13.157,70.486l34.085,26.797
                                    c0.983,0.78,2.257,1.044,3.483,0.76c1.216-0.312,2.22-1.149,2.729-2.3l26.27-59.342l25.919,58.557
                                    c0.512,1.134,1.497,1.978,2.7,2.283c1.218,0.301,2.479,0.042,3.475-0.701l34.626-26.438L123.715,128.782z"/>
                            </svg>
                        </div>
                        <span style="flex-grow: 1"><?php echo trans("membership_plan"); ?></span>
                        <span class="material-icons hidden-sm-up">keyboard_arrow_right</span>
                    </div>
                </a>
            </li>
        <?php endif;?>
        <?php if (is_multi_vendor_active()): ?>
            <?php if ($user->role == 'admin' || $user->role == 'vendor'): ?>
                <li class="nav-item <?php echo ($active_tab == 'products') ? 'active' : ''; ?>">
                    <a class="nav-link" id="hkmproducts" href="<?php echo lang_base_url() . "products/" . $user->slug; ?>">
                        <div class="profile-tab-item">
                            <div class="profile-tab-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.84 34.84" style="width: 40px; height: 40px;"><defs><style>.cls-1{fill:#fe590d;}.cls-2{fill:#fff;}</style></defs><title>Asset 19</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><rect class="cls-1" width="34.84" height="34.84" rx="4.03"/><path class="cls-2" d="M23.42,25.28a1.5,1.5,0,1,0,1.5,1.5A1.5,1.5,0,0,0,23.42,25.28Zm-10,0a1.5,1.5,0,1,0,1.5,1.5A1.5,1.5,0,0,0,13.42,25.28Zm8.52-6a1.5,1.5,0,0,0,1.31-.77L26.85,12a.5.5,0,0,0,0-.5.52.52,0,0,0-.44-.25H11.33l-.83-2-2.58,0v1h1.9l3.53,8.45L12,20.87a1.58,1.58,0,0,0,1.34,2.41H24.92v-1H13.06l-.35-.63,1.48-2.37Zm-10.19-7H25.57l-3.34,6h-8Z"/></g></g></svg>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.84 34.84" style="width: 40px; height: 40px;"><defs><style>.cls-3{fill:#46b440;}.cls-2{fill:#fff;}</style></defs><title>Asset 18</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><rect class="cls-3" width="34.84" height="34.84" rx="4.03"/><path class="cls-2" d="M26.44,24.78a3.85,3.85,0,0,0,.06-.66,4,4,0,0,0-.06-.67l-.06-.3.88-.66-.72-1.24-1,.44-.24-.21a3.41,3.41,0,0,0-1.14-.65l-.29-.11-.13-1.1H22.29l-.13,1.1-.3.11a3.41,3.41,0,0,0-1.14.65l-.23.21-1-.44-.71,1.24.88.65-.06.31a3.25,3.25,0,0,0-.07.67,3.09,3.09,0,0,0,.07.66l.06.31-.88.66L19.46,27l1-.44.23.2a3.62,3.62,0,0,0,1.14.66l.3.1.13,1.11h1.43l.13-1.11.29-.1a3.62,3.62,0,0,0,1.14-.66l.24-.2,1,.44.72-1.24-.88-.66ZM23,26.37a2.25,2.25,0,1,1,2.25-2.25A2.25,2.25,0,0,1,23,26.37Zm-7-6.75c-3,0-8.5,1.52-8.5,4v2h8.16a6.87,6.87,0,0,1-.14-1h-7v-1c0-1.45,4.4-3,7.5-3h.37a8.16,8.16,0,0,1,.61-1C16.63,19.63,16.31,19.62,16,19.62Zm0-11a3.5,3.5,0,1,0,3.5,3.5A3.5,3.5,0,0,0,16,8.62Zm0,6a2.5,2.5,0,1,1,2.5-2.5A2.48,2.48,0,0,1,16,14.62Z"/></g></g></svg>
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
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.84 34.84" style="width: 40px; height: 40px;"><defs><style>.cls-4{fill:#3950b6;}.cls-2{fill:#fff;}</style></defs><title>Asset 25</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><rect class="cls-4" width="34.84" height="34.84" rx="4.03"/><path class="cls-2" d="M26.58,20.12h-9a1.51,1.51,0,0,0-1.5,1.5v6a1.52,1.52,0,0,0,1.5,1.5h9a1.52,1.52,0,0,0,1.5-1.5v-6A1.52,1.52,0,0,0,26.58,20.12Zm.5,8h-10v-4h7v-1h-7v-2h10ZM27,15.31a.49.49,0,0,0-.39-.19H21.65L17,8.34a.5.5,0,0,0-.82,0l-4.69,6.79H6.58a.49.49,0,0,0-.4.2.47.47,0,0,0-.08.43L8.66,25a1.51,1.51,0,0,0,1.44,1.1h3v-1H9.72l-2.48-9H25.92l-.28,1h1l.38-1.37A.5.5,0,0,0,27,15.31Zm-14.25-.19L16.6,9.5l3.84,5.62Z"/></g></g></svg>
                            </div>
                            <span style="flex-grow: 1"><?php echo trans("orders"); ?></span>
                            <span class="material-icons hidden-sm-up">keyboard_arrow_right</span>
                        </div>
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($this->auth_check && $this->auth_user->id == $user->id && ($user->role == 'admin' || $user->role == 'vendor')): ?>
                <?php if (is_sale_active()): ?>
                    <?php if (is_user_vendor()): ?>
                        <li class="nav-item <?php echo ($active_tab == 'sales') ? 'active' : ''; ?>">
                            <a class="nav-link" id="hkmsales" href="<?php echo lang_base_url(); ?>sales">
                                <div class="profile-tab-item">
                                    <div class="profile-tab-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.84 34.84" style="width: 40px; height: 40px;"><defs><style>.cls-12{fill:#3950b6;}.cls-2{fill:#fff;}</style></defs><title>Asset 17</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><rect class="cls-12" width="34.84" height="34.84" rx="4.03"/><path class="cls-2" d="M16.07,24.94a1.5,1.5,0,1,0,1.5,1.5A1.5,1.5,0,0,0,16.07,24.94Zm10-6.36L15.58,21.87a1.49,1.49,0,0,1-1.88-1l-3.46-11-2.84.91.3.95,1.89-.6,3.16,10a2.49,2.49,0,0,0,3.14,1.63l10.44-3.28Zm-1.88-4L22.81,10A1.51,1.51,0,0,0,21.5,9h-.13a1.48,1.48,0,0,0-.46.08l-5.7,1.75a1.51,1.51,0,0,0-1,1.87l1.34,4.54a1.51,1.51,0,0,0,.75.88,1.53,1.53,0,0,0,1.15.09l5.7-1.76A1.5,1.5,0,0,0,24.15,14.53Zm-7.46,2.82-1.62-5.48L18,11l.57,1.82.95-.3-.57-1.82L21.23,10l.53-.27.1.6,1.47,5Z"/></g></g></svg>
                                    </div>
                                    <span style="flex-grow: 1"><?php echo trans("sales"); ?></span>
                                    <span class="material-icons hidden-sm-up">keyboard_arrow_right</span>
                                </div>
                            </a>
                        </li>
                    <?php endif;?>
                <?php endif;?>
            <?php endif;?>
            <!-- end here -->
            <?php if ($this->auth_check && $this->auth_user->id == $user->id && ($user->role == 'admin' || $user->role == 'vendor')): ?>
                <li class="nav-item <?php echo ($active_tab == 'pending_products') ? 'active' : ''; ?>">
                    <a class="nav-link" id="hkmpending_products" href="<?php echo lang_base_url(); ?>pending-products">
                        <div class="profile-tab-item">
                            <div class="profile-tab-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.84 34.84" style="width: 40px; height: 40px;"><defs><style>.cls-5{fill:#ee1561;}.cls-2{fill:#fff;}</style></defs><title>Asset 16</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><rect class="cls-5" width="34.84" height="34.84" rx="4.03"/><path class="cls-2" d="M22,22.73l1-1.93-.45-.23-1.19,2.25,1.48,1.49L23.2,24Zm0,0,1-1.93-.45-.23-1.19,2.25,1.48,1.49L23.2,24Zm0,0,1-1.93-.45-.23-1.19,2.25,1.48,1.49L23.2,24Zm0,0,1-1.93-.45-.23-1.19,2.25,1.48,1.49L23.2,24Zm0,0,1-1.93-.45-.23-1.19,2.25,1.48,1.49L23.2,24Zm0,0,1-1.93-.45-.23-1.19,2.25,1.48,1.49L23.2,24Zm0,0,1-1.93-.45-.23-1.19,2.25,1.48,1.49L23.2,24Zm0,0,1-1.93-.45-.23-1.19,2.25,1.48,1.49L23.2,24Zm0,0,1-1.93-.45-.23-1.19,2.25,1.48,1.49L23.2,24Zm0,0,1-1.93-.45-.23-1.19,2.25,1.48,1.49L23.2,24Zm0,0,1-1.93-.45-.23-1.19,2.25,1.48,1.49L23.2,24Zm0,0,1-1.93-.45-.23-1.19,2.25,1.48,1.49L23.2,24Zm-.06-5.45a5.5,5.5,0,1,0,5.5,5.5A5.5,5.5,0,0,0,21.92,17.28Zm0,10a4.5,4.5,0,1,1,4.5-4.5A4.51,4.51,0,0,1,21.92,27.28ZM23,20.8l-.45-.23-1.19,2.25,1.48,1.49L23.2,24,22,22.73Zm-1,1.93,1-1.93-.45-.23-1.19,2.25,1.48,1.49L23.2,24Zm0,0,1-1.93-.45-.23-1.19,2.25,1.48,1.49L23.2,24Zm0,0,1-1.93-.45-.23-1.19,2.25,1.48,1.49L23.2,24Zm0,0,1-1.93-.45-.23-1.19,2.25,1.48,1.49L23.2,24Zm0,0,1-1.93-.45-.23-1.19,2.25,1.48,1.49L23.2,24Zm0,0,1-1.93-.45-.23-1.19,2.25,1.48,1.49L23.2,24Zm0,0,1-1.93-.45-.23-1.19,2.25,1.48,1.49L23.2,24Zm0,0,1-1.93-.45-.23-1.19,2.25,1.48,1.49L23.2,24Zm0,0,1-1.93-.45-.23-1.19,2.25,1.48,1.49L23.2,24Zm0,0,1-1.93-.45-.23-1.19,2.25,1.48,1.49L23.2,24Zm.94-14.45h-5.5v.5a1.5,1.5,0,0,1-3,0v-.5H8.92a1.5,1.5,0,0,0-1.5,1.5v14a1.5,1.5,0,0,0,1.5,1.5H13.8a8.56,8.56,0,0,1-.24-1H8.42v-15h5l.12.33a2.5,2.5,0,0,0,4.71,0l.12-.33h5v5.14a8.56,8.56,0,0,1,1,.24V9.78A1.5,1.5,0,0,0,22.92,8.28Z"/></g></g></svg>
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
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.84 34.84" style="width: 40px; height: 40px;"><defs><style>.cls-6{fill:#ffc300;}.cls-2{fill:#fff;}</style></defs><title>Asset 15</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><rect class="cls-6" width="34.84" height="34.84" rx="4.03"/><path class="cls-2" d="M9.63,9.6l-.71.71,2.33,2.33-.44.35A14.37,14.37,0,0,0,7,17.9l-.09.2.09.2c.13.3,3.2,7.3,10.46,7.3a10.21,10.21,0,0,0,5-1.28l.33-.19,2.47,2.47.71-.7ZM15,17.46l.22-.83,3.67,3.66-.84.22a2.53,2.53,0,0,1-.64.09,2.5,2.5,0,0,1-2.5-2.5A2.53,2.53,0,0,1,15,17.46Zm6.37,6.26a9.27,9.27,0,0,1-4,.88c-5.68,0-8.58-4.79-9.34-6.27L8,18.1l.12-.23a13.4,13.4,0,0,1,3.55-4.24l.34-.27L14.61,16l-.2.34a3.41,3.41,0,0,0-.49,1.76,3.49,3.49,0,0,0,5.27,3l.33-.2,2.5,2.5Zm6.5-5.82c-.13-.29-3.2-7.3-10.46-7.3a10.1,10.1,0,0,0-2.33.27l.85.86a8.38,8.38,0,0,1,1.48-.13c5.68,0,8.58,4.8,9.33,6.27l.12.23-.12.23a13.88,13.88,0,0,1-1.7,2.5l.72.72a14.2,14.2,0,0,0,2.11-3.25l.08-.2Z"/></g></g></svg>
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
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.84 34.84" style="width: 40px; height: 40px;"><defs><style>.cls-7{fill:#9b1db3;}.cls-2{fill:#fff;}</style></defs><title>Asset 14</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><rect class="cls-7" width="34.84" height="34.84" rx="4.03"/><path class="cls-2" d="M12.92,17.44v1h4v-1Zm0-4v1h9v-1Zm0,0v1h9v-1Zm0,4v1h4v-1Zm0,0v1h4v-1Zm0-4v1h9v-1Zm0,0v1h9v-1Zm0,4v1h4v-1Zm0,0v1h4v-1Zm0-4v1h9v-1Zm0,0v1h9v-1Zm0,4v1h4v-1Zm0,0v1h4v-1Zm0-4v1h9v-1Zm0,0v1h9v-1Zm0,4v1h4v-1Zm0,0v1h4v-1Zm0-4v1h9v-1Zm0,0v1h9v-1Zm0,5h4v-1h-4Zm11.5-9h-14a1.5,1.5,0,0,0-1.5,1.5v14a1.5,1.5,0,0,0,1.5,1.5h9.79l5.71-5.71V10.94A1.5,1.5,0,0,0,24.42,9.44Zm.5,11h-5v5h-10v-15h15Zm-3-7h-9v1h9Zm-5,4h-4v1h4Zm-4,0v1h4v-1Zm0-4v1h9v-1Zm0,0v1h9v-1Zm0,4v1h4v-1Zm0,0v1h4v-1Zm0-4v1h9v-1Zm0,0v1h9v-1Zm0,4v1h4v-1Zm0,0v1h4v-1Zm0-4v1h9v-1Zm0,0v1h9v-1Zm0,4v1h4v-1Zm0,0v1h4v-1Zm0-4v1h9v-1Zm0,0v1h9v-1Zm0,4v1h4v-1Zm0,0v1h4v-1Zm0-4v1h9v-1Zm0,0v1h9v-1Zm0,4v1h4v-1Z"/></g></g></svg>
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
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.84 34.84" style="width: 40px; height: 40px;"><defs><style>.cls-8{fill:#6630ba;}.cls-2{fill:#fff;}</style></defs><title>Asset 13</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><rect class="cls-8" width="34.84" height="34.84" rx="4.03"/><path class="cls-2" d="M21.92,9.26a5.56,5.56,0,0,0-4.11,1.9l-.39.5-.4-.5a5.5,5.5,0,0,0-4.1-1.9,5,5,0,0,0-5,5c0,4.67,7.88,10.7,9.5,11.88,1.61-1.18,9.5-7.21,9.5-11.88A5,5,0,0,0,21.92,9.26Zm-4.2,15.42-.3.23-.31-.23c-3.78-2.9-8.19-7.37-8.19-10.42a4,4,0,0,1,4-4c2,0,3.74,1.73,4.5,2.61.77-.88,2.53-2.61,4.5-2.61a4,4,0,0,1,4,4C25.92,17.31,21.5,21.78,17.72,24.68Z"/></g></g></svg>
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
                            <div class="profile-tab-icon" style="background: #28aae8;">
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
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.84 34.84" style="width: 40px; height: 40px;"><defs><style>.cls-9{fill:#00b5d7;}.cls-2{fill:#fff;}</style></defs><title>Asset 12</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><rect class="cls-9" width="34.84" height="34.84" rx="4.03"/><path class="cls-2" d="M21.42,18.92a11.36,11.36,0,0,0-3.82.72l-.18.06-.17-.06a11.42,11.42,0,0,0-3.83-.72c-2.87,0-6.5,1.41-6.5,3v2h21v-2C27.92,20.33,24.28,18.92,21.42,18.92Zm-2.5,4h-11V21.87L8,21.74c.55-.82,3.09-1.82,5.42-1.82s4.87,1,5.42,1.82l.08.13Zm8,0h-7v-1a1.46,1.46,0,0,0-.48-1l-.63-.67.91-.17a10,10,0,0,1,1.7-.17c2.33,0,4.87,1,5.42,1.82l.08.13ZM7.52,15.53A2.35,2.35,0,0,0,7,16.89a2.35,2.35,0,0,0,1.36-.57A2.35,2.35,0,0,0,8.89,15,2.38,2.38,0,0,0,7.52,15.53Zm13.9-4.61a2.5,2.5,0,1,0,2.5,2.5A2.5,2.5,0,0,0,21.42,10.92Zm0,4a1.5,1.5,0,1,1,1.5-1.5A1.5,1.5,0,0,1,21.42,14.92Zm-8-4a2.5,2.5,0,1,0,2.5,2.5A2.5,2.5,0,0,0,13.42,10.92Zm0,4a1.5,1.5,0,1,1,1.5-1.5A1.5,1.5,0,0,1,13.42,14.92Z"/></g></g></svg>
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
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.84 34.84" style="width: 40px; height: 40px;"><defs><style>.cls-10{fill:#00cdd4;}.cls-2{fill:#fff;}</style></defs><title>Asset 11</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><rect class="cls-10" width="34.84" height="34.84" rx="4.03"/><path class="cls-2" d="M11.92,8.1a2.5,2.5,0,1,0,2.5,2.5A2.5,2.5,0,0,0,11.92,8.1Zm0,4a1.5,1.5,0,1,1,1.5-1.5A1.49,1.49,0,0,1,11.92,12.1Zm10-4a2.5,2.5,0,1,0,2.5,2.5A2.5,2.5,0,0,0,21.92,8.1Zm0,4a1.5,1.5,0,1,1,1.5-1.5A1.49,1.49,0,0,1,21.92,12.1Zm0,5H26.3L26.17,17a8.81,8.81,0,0,0-4.25-.92,7.78,7.78,0,0,0-4.68,1.23l-.31.25-.32-.26a4.21,4.21,0,0,0-1-.57,9.6,9.6,0,0,0-3.72-.65,9.57,9.57,0,0,0-3.72.65A3.82,3.82,0,0,0,7,17.57a1.84,1.84,0,0,0-.53,1.24V21.1h15v-1h-4V18.81C17.42,17.88,19.48,17.1,21.92,17.1Zm-5.5,3h-9V18.81a.76.76,0,0,1,.26-.55,3,3,0,0,1,.91-.59,10.54,10.54,0,0,1,6.66,0,3,3,0,0,1,.91.59.8.8,0,0,1,.26.55Zm9,3v-3h-1v3h-3v1h3v3h1v-3h3v-1Z"/></g></g></svg>
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
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.84 34.84" style="width: 40px; height: 40px;"><defs><style>.cls-11{fill:#46b440;}.cls-2{fill:#fff;}</style></defs><title>Asset 26</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><rect class="cls-11" width="34.84" height="34.84" rx="4.03"/><path class="cls-2" d="M12.58,18.28v1h6v-1Zm0-4v1h9v-1Zm0,0v1h9v-1Zm0,4v1h6v-1Zm0,0v1h6v-1Zm0-4v1h9v-1Zm0,0v1h9v-1Zm0,4v1h6v-1Zm0,0v1h6v-1Zm0-4v1h9v-1Zm0,0v1h9v-1Zm0,4v1h6v-1Zm0,0v1h6v-1Zm0-4v1h9v-1Zm0,0v1h9v-1Zm0,4v1h6v-1Zm0,0v1h6v-1Zm0-4v1h9v-1Zm0,0v1h9v-1Zm0,4v1h6v-1Zm0,0v1h6v-1Zm0-4v1h9v-1Zm0,0v1h9v-1Zm0,4v1h6v-1Zm0,0v1h6v-1Zm0-4v1h9v-1Zm0,0v1h9v-1Zm0,4v1h6v-1Zm0,0v1h6v-1Zm0-4v1h9v-1Zm0,0v1h9v-1Zm0,5h6v-1h-6Zm14-8.5a1.52,1.52,0,0,0-1.5-1.5h-16a1.52,1.52,0,0,0-1.5,1.5v12a1.51,1.51,0,0,0,1.5,1.5H23.29l3.29,3.29ZM23.7,23.28H8.58v-13h17V25.16Zm-11.12-8h9v-1h-9Zm0,4h6v-1h-6Zm0-1v1h6v-1Zm0-4v1h9v-1Zm0,0v1h9v-1Zm0,4v1h6v-1Zm0,0v1h6v-1Zm0-4v1h9v-1Zm0,0v1h9v-1Zm0,4v1h6v-1Zm0,0v1h6v-1Zm0-4v1h9v-1Zm0,0v1h9v-1Zm0,4v1h6v-1Zm0,0v1h6v-1Zm0-4v1h9v-1Zm0,0v1h9v-1Zm0,4v1h6v-1Zm0,0v1h6v-1Zm0-4v1h9v-1Zm0,0v1h9v-1Zm0,4v1h6v-1Zm0,0v1h6v-1Zm0-4v1h9v-1Zm0,0v1h9v-1Zm0,4v1h6v-1Zm0,0v1h6v-1Zm0-4v1h9v-1Zm0,0v1h9v-1Zm0,4v1h6v-1Z"/></g></g></svg>
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
                        <li class="nav-item <?php echo ($active_tab == 'earnings') ? 'active' : ''; ?>">
                            <a class="nav-link" id="hkmearnings"  href="<?php echo lang_base_url(); ?>earnings">
                                <div class="profile-tab-item">
                                    <div class="profile-tab-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.84 34.84" style="width: 40px; height: 40px;"><defs><style>.cls-13{fill:#fe590d;}.cls-2{fill:#fff;}</style></defs><title>Asset 23</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><rect class="cls-13" width="34.84" height="34.84" rx="4.03"/><path class="cls-2" d="M13.91,19.63H13a2.51,2.51,0,0,0,.62,1.48c.15-.24.31-.47.47-.68A2.6,2.6,0,0,1,13.91,19.63Zm9.17-.85a3.52,3.52,0,0,0-3,1.75l-.14.25h-.3A4,4,0,1,0,23.35,26l.09-.28.29-.05a3.5,3.5,0,0,0-.65-6.93Zm-3.5,9a3,3,0,1,1,3-3A3,3,0,0,1,19.58,27.78Zm4.65-3.29-.61.32-.11-.68a4,4,0,0,0-2-2.85L20.88,21l.49-.48a2.43,2.43,0,0,1,1.71-.7,2.49,2.49,0,0,1,1.15,4.71ZM15.54,12.8a3.32,3.32,0,0,0-1,.21,2,2,0,0,0-.78.65,2.44,2.44,0,0,0-.43,1.64,2.25,2.25,0,0,0,.46,1.25,4,4,0,0,0,1.39.95,3.28,3.28,0,0,1,1.33,1l.73-.3a4.3,4.3,0,0,0-1.5-1.16,2.91,2.91,0,0,1-1.37-1.29,2,2,0,0,1-.11-1.11,1.59,1.59,0,0,1,.53-1,1.13,1.13,0,0,1,1.05-.17,1.43,1.43,0,0,1,.69.62,2.49,2.49,0,0,1,.27.89h.86a2.15,2.15,0,0,0-.49-1.37,2,2,0,0,0-.68-.55,2.81,2.81,0,0,0-.9-.25m6.76-4.45a1.67,1.67,0,0,0-1.23-.57h-12a1.5,1.5,0,0,0-1.5,1.5v16a1.5,1.5,0,0,0,1.5,1.5h3.79a6.84,6.84,0,0,1-.21-1H8.58v-17h13V16a6,6,0,0,1,1-.16V9A.94.94,0,0,0,22.31,8.35Z"/></g></g></svg>
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
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.84 34.84" style="width: 40px; height: 40px;"><defs><style>.cls-14{fill:#0f95f8;}.cls-2{fill:#fff;}</style></defs><title>Asset 24</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><rect class="cls-14" width="34.84" height="34.84" rx="4.03"/><path class="cls-2" d="M25,16.71a10.21,10.21,0,0,1-.25,2A6.31,6.31,0,0,1,25,20.44a6.5,6.5,0,0,1-6.5,6.5,6.26,6.26,0,0,1-1.77-.25,10.32,10.32,0,0,1-2,.25A7.49,7.49,0,0,0,25,16.71ZM14.52,8.94a7.5,7.5,0,1,0,7.5,7.5A7.52,7.52,0,0,0,14.52,8.94Zm-.46,14a6.49,6.49,0,0,1,.15-13l.52,0v2L14.3,12a2,2,0,0,0-1.8,2.19c0,1.53.79,1.93,1.71,2.39S16,17.43,16,18.74a1.44,1.44,0,0,1-1.4,1.64,1.26,1.26,0,0,1-.93-.37,2,2,0,0,1-.53-1.26h-.89a2.13,2.13,0,0,0,1.93,2.16l.44.06v2Zm1.08,0L14.6,23V21l.43,0a2,2,0,0,0,1.82-2.19c0-1.5-.87-2-1.79-2.48s-1.67-.92-1.67-2.08.67-1.66,1.25-1.66c.12,0,1.12.05,1.3,1.59h.89A2.12,2.12,0,0,0,15.15,12l-.41-.08v-2l.56.06a6.5,6.5,0,0,1-.16,12.92Z"/></g></g></svg>
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
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.84 34.84" style="width: 40px; height: 40px;"><defs><style>.cls-15{fill:#ffc300;}.cls-2{fill:#fff;}</style></defs><title>Asset 20</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><rect class="cls-15" width="34.84" height="34.84" rx="4.03"/><path class="cls-2" d="M8.08,9.6a1.52,1.52,0,0,0-1.5,1.5V23.6h1v-13h16v-1Zm18,4h-14a1.52,1.52,0,0,0-1.5,1.5v10a1.51,1.51,0,0,0,1.5,1.5h14a1.52,1.52,0,0,0,1.5-1.5v-10A1.52,1.52,0,0,0,26.08,13.6Zm.5,12h-15V16.83l7.5,4.68,7.5-4.68Zm0-9.59-7.5,4.68L11.58,16V14.6h15Z"/></g></g></svg>
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
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.84 34.84" style="width: 40px; height: 40px;"><defs><style>.cls-16{fill:#9092a2;}.cls-2{fill:#fff;}</style></defs><title>Asset 22</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><rect class="cls-16" width="34.84" height="34.84" rx="4.03"/><path class="cls-2" d="M17.08,14.44a3.5,3.5,0,1,0,3.5,3.5A3.5,3.5,0,0,0,17.08,14.44Zm0,6a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,17.08,20.44Zm0-6a3.5,3.5,0,1,0,3.5,3.5A3.5,3.5,0,0,0,17.08,14.44Zm0,6a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,17.08,20.44Zm0-6a3.5,3.5,0,1,0,3.5,3.5A3.5,3.5,0,0,0,17.08,14.44Zm0,6a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,17.08,20.44Zm0-6a3.5,3.5,0,1,0,3.5,3.5A3.5,3.5,0,0,0,17.08,14.44Zm0,6a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,17.08,20.44Zm0-6a3.5,3.5,0,1,0,3.5,3.5A3.5,3.5,0,0,0,17.08,14.44Zm0,6a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,17.08,20.44Zm0-6a3.5,3.5,0,1,0,3.5,3.5A3.5,3.5,0,0,0,17.08,14.44Zm0,6a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,17.08,20.44Zm0-6a3.5,3.5,0,1,0,3.5,3.5A3.5,3.5,0,0,0,17.08,14.44Zm0,6a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,17.08,20.44Zm0-6a3.5,3.5,0,1,0,3.5,3.5A3.5,3.5,0,0,0,17.08,14.44Zm0,6a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,17.08,20.44Zm0-6a3.5,3.5,0,1,0,3.5,3.5A3.5,3.5,0,0,0,17.08,14.44Zm0,6a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,17.08,20.44Zm0-6a3.5,3.5,0,1,0,3.5,3.5A3.5,3.5,0,0,0,17.08,14.44Zm0,6a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,17.08,20.44Zm0-6a3.5,3.5,0,1,0,3.5,3.5A3.5,3.5,0,0,0,17.08,14.44Zm0,6a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,17.08,20.44Zm0-6a3.5,3.5,0,1,0,3.5,3.5A3.5,3.5,0,0,0,17.08,14.44Zm0,6a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,17.08,20.44Zm7.39-1.29a7.87,7.87,0,0,0,.11-1.21,7.76,7.76,0,0,0-.11-1.21l0-.28,1.84-1.6-1.93-3.33-2.29.79-.22-.17a7.29,7.29,0,0,0-2.1-1.21l-.27-.1L19,8.44H15.16l-.47,2.39-.26.1a7.42,7.42,0,0,0-2.1,1.21l-.22.17-2.3-.79L7.89,14.85l1.84,1.6-.05.28a7.49,7.49,0,0,0-.1,1.21,7.77,7.77,0,0,0,.1,1.21l.05.27L7.89,21l1.92,3.33,2.3-.79.22.18A7.39,7.39,0,0,0,14.43,25l.26.09.47,2.4H19l.46-2.4.27-.09a7.67,7.67,0,0,0,2.1-1.21l.22-.18,2.29.79L26.27,21l-1.84-1.6ZM25,21.24l-1.1,1.9-2.05-.71-.65.53A6.19,6.19,0,0,1,19.37,24l-.78.3-.42,2.13H16l-.41-2.13-.79-.3A6.45,6.45,0,0,1,13,23l-.65-.53-2,.71-1.1-1.9,1.64-1.43L10.67,19a7.08,7.08,0,0,1-.09-1,7,7,0,0,1,.09-1.06l.14-.82L9.17,14.64l1.1-1.9,2,.7.65-.53a6.7,6.7,0,0,1,1.82-1.05l.79-.29L16,9.44h2.2l.41,2.13.78.29a6.61,6.61,0,0,1,1.83,1.05l.64.53,2.05-.7L25,14.63l-1.64,1.43.13.82a5.62,5.62,0,0,1,0,2.11l-.13.82Zm-7.91-6.8a3.5,3.5,0,1,0,3.5,3.5A3.5,3.5,0,0,0,17.08,14.44Zm0,6a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,17.08,20.44Zm0-6a3.5,3.5,0,1,0,3.5,3.5A3.5,3.5,0,0,0,17.08,14.44Zm0,6a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,17.08,20.44Zm0-6a3.5,3.5,0,1,0,3.5,3.5A3.5,3.5,0,0,0,17.08,14.44Zm0,6a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,17.08,20.44Zm0-6a3.5,3.5,0,1,0,3.5,3.5A3.5,3.5,0,0,0,17.08,14.44Zm0,6a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,17.08,20.44Zm0-6a3.5,3.5,0,1,0,3.5,3.5A3.5,3.5,0,0,0,17.08,14.44Zm0,6a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,17.08,20.44Zm0-6a3.5,3.5,0,1,0,3.5,3.5A3.5,3.5,0,0,0,17.08,14.44Zm0,6a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,17.08,20.44Zm0-6a3.5,3.5,0,1,0,3.5,3.5A3.5,3.5,0,0,0,17.08,14.44Zm0,6a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,17.08,20.44Zm0-6a3.5,3.5,0,1,0,3.5,3.5A3.5,3.5,0,0,0,17.08,14.44Zm0,6a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,17.08,20.44Zm0-6a3.5,3.5,0,1,0,3.5,3.5A3.5,3.5,0,0,0,17.08,14.44Zm0,6a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,17.08,20.44Zm0-6a3.5,3.5,0,1,0,3.5,3.5A3.5,3.5,0,0,0,17.08,14.44Zm0,6a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,17.08,20.44Zm0-6a3.5,3.5,0,1,0,3.5,3.5A3.5,3.5,0,0,0,17.08,14.44Zm0,6a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,17.08,20.44Z"/></g></g></svg>
                            </div>
                            <span style="flex-grow: 1"><?php echo trans("settings"); ?></span>
                            <span class="material-icons hidden-sm-up">keyboard_arrow_right</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item <?php echo ($active_tab == 'logout') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo lang_base_url(); ?>logout" class="logout">
                        <div class="profile-tab-item">
                            <div class="profile-tab-icon" style="background: #dc3545 !important">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.84 34.84" style="width: 40px; height: 40px;"><defs><style>.cls-17{fill:#adafc5;}.cls-2{fill:#fff;}</style></defs><title>Asset 21</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><rect class="cls-17" width="34.84" height="34.84" rx="4.03"/><path class="cls-2" d="M20.58,8.93V10a8.5,8.5,0,1,1-7,0V8.93a9.5,9.5,0,1,0,7,0Zm-4-.67v9h1v-9Z"/></g></g></svg>
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

