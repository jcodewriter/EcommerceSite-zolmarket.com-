<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="<?php echo $this->selected_lang->short_form ?>">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, height=device-height, shrink-to-fit=yes, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <title><?php echo html_escape($title); ?> - <?php echo html_escape($settings->site_title); ?></title>
    <meta name="description" content="<?php echo html_escape($description); ?>" />
    <meta name="keywords" content="<?php echo html_escape($keywords); ?>" />
    <meta name="author" content="Codingest" />
    <link rel="shortcut icon" type="image/png" href="<?php echo get_favicon($general_settings); ?>" />
    <meta property="og:locale" content="en-US" />
    <meta property="og:site_name" content="<?php echo html_escape($general_settings->application_name); ?>" />
    <?php if (isset($show_og_tags)) : ?>
        <meta property="og:type" content="<?php echo $og_type; ?>" />
        <meta property="og:title" content="<?php echo $og_title; ?>" />
        <meta property="og:description" content="<?php echo $og_description; ?>" />
        <meta property="og:url" content="<?php echo $og_url; ?>" />
        <meta property="og:image" content="<?php echo $og_image; ?>" />
        <meta property="og:image:width" content="<?php echo $og_width; ?>" />
        <meta property="og:image:height" content="<?php echo $og_height; ?>" />
        <meta property="article:author" content="<?php echo $og_author; ?>" />
        <meta property="fb:app_id" content="<?php echo $this->general_settings->facebook_app_id; ?>" />
        <?php if (!empty($og_tags)) : foreach ($og_tags as $tag) : ?>
                <meta property="article:tag" content="<?php echo $tag->tag; ?>" />
        <?php endforeach;
        endif; ?>
        <meta property="article:published_time" content="<?php echo $og_published_time; ?>" />
        <meta property="article:modified_time" content="<?php echo $og_modified_time; ?>" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="@<?php echo html_escape($general_settings->application_name); ?>" />
        <meta name="twitter:creator" content="@<?php echo html_escape($og_creator); ?>" />
        <meta name="twitter:title" content="<?php echo html_escape($og_title); ?>" />
        <meta name="twitter:description" content="<?php echo html_escape($og_description); ?>" />
        <meta name="twitter:image" content="<?php echo $og_image; ?>" />
    <?php else : ?>
        <meta property="og:image" content="<?php echo get_logo($general_settings); ?>" />
        <meta property="og:image:width" content="160" />
        <meta property="og:image:height" content="60" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="<?php echo html_escape($title); ?> - <?php echo html_escape($settings->site_title); ?>" />
        <meta property="og:description" content="<?php echo html_escape($description); ?>" />
        <meta property="og:url" content="<?php echo base_url(); ?>" />
        <meta property="fb:app_id" content="<?php echo $this->general_settings->facebook_app_id; ?>" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="@<?php echo html_escape($general_settings->application_name); ?>" />
        <meta name="twitter:title" content="<?php echo html_escape($title); ?> - <?php echo html_escape($settings->site_title); ?>" />
        <meta name="twitter:description" content="<?php echo html_escape($description); ?>" />
    <?php endif; ?>
    <link rel="canonical" href="<?php echo current_url(); ?>" />
    <style>
        i,
        span[class*='icon'] {
            visibility: hidden;
        }
    </style>
    <?php if ($general_settings->multilingual_system == 1) :
        foreach ($languages as $language) :
            if ($language->id == $site_lang->id) : ?>
                <link rel="alternate" href="<?php echo base_url(); ?>" hreflang="<?php echo $language->language_code ?>" />
            <?php else : ?>
                <link rel="alternate" href="<?php echo base_url() . $language->short_form . "/"; ?>" hreflang="<?php echo $language->language_code ?>" />
    <?php endif;
        endforeach;
    endif; ?>
    <!-- Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css">
    <?php echo !empty($this->fonts->font_url) ? $this->fonts->font_url : ''; ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-awesome/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-icons/css/font-icons.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" />
    <!-- intlTelInput -->
    <link href="<?php echo base_url(); ?>assets/vendor/telinput/css/intlTelInput.css" rel="stylesheet" />
    <!-- swiper Carousel -->
    <link href="<?php echo base_url(); ?>assets/vendor/swiper/swiper.min.css" rel="stylesheet" />
    <!-- smartphoto -->
    <link href="<?php echo base_url(); ?>assets/vendor/smartphoto/smartphoto.css" rel="stylesheet" />
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/plugins-1.7.css" />
    <!-- Style CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/newstyle.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/costum_style.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/loading.css" />

    <?php if (!empty($general_settings->site_color)) : ?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/colors/<?php echo $general_settings->site_color; ?>.min.css" />
    <?php else : ?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/colors/default.min.css" />
    <?php endif; ?>
    <?php $this->load->view("partials/_css_header"); ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>

    <?php echo $general_settings->head_code; ?>

</head>

<body>
    <?php if ($this->is_webview == "web") : ?>
        <?php if (isset($is_mobile_header) && !isset($_COOKIE['is_app_suggest'])) : ?>
            <div id="app-suggest" class="deep-linked">
                <div href="" class="app-close">
                    <i class="fa fa-times" style="background: #dee2e6;border-radius: 50%;padding: 2px 3px;"></i>
                </div>
                <a href="<?php echo $this->is_AndroidOS ? 'https://play.google.com/store/apps/details?id=com.app.zolmarket&hl=en_US' : 'https://apps.apple.com/se/app/zolmarket/id1493982231?l=en'; ?>" class="app-icon">
                    <img src="<?php echo get_favicon($general_settings); ?>" alt="payments" class="img-fluid" style="height: 50px;">
                </a>
                <div href="" class="app-details">
                    <h6 style="font-weight: 700;font-size: .8125rem;color: #030a17;margin-bottom:0 !important"><?php echo trans("za"); ?></h6>
                    <span style="color: #ffa500"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i></span>
                    <div style="color: #555;font-size: .675rem;"><?php echo trans("za_description"); ?></div>
                </div>
                <div class="app-download" style="width: 115px;">
                    <a href="<?php echo $this->is_AndroidOS ? 'https://play.google.com/store/apps/details?id=com.app.zolmarket&hl=en_US' : 'https://apps.apple.com/se/app/zolmarket/id1493982231?l=en'; ?>" class="btn btn-primary" style="color:#fff;font-size: .75rem;"><span><?php echo trans("download_app"); ?></span></a>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <header id="header">
        <div class="main-menu">
            <div class="container-fluid">
                <div class="row">
                    <div class="nav-top">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-md-2 nav-top-left" style="padding: 0 3px;">
                                    <div class="row-align-items-center">
                                        <div class="logo">
                                            <a href="<?php echo lang_base_url(); ?>"><img src="<?php echo get_logo($general_settings); ?>" alt="logo"></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-5 nav-top-center">

                                    <ul class="nav align-items-center">

                                        <li class="nav-item li-main-nav-right mr-3 ml-3"><a href="<?php echo lang_base_url(); ?>blog"><i class="fa fa-rss"></i><span><?php echo trans("blog"); ?></span></a></li>

                                        <li class="nav-item li-main-nav-right mr-3 ml-3"><a href="<?php echo lang_base_url(); ?>contact"><i class="icon-mail"></i><span><?php echo trans("contact"); ?></span></a></li>

                                        <li class="nav-item li-main-nav-right mr-3 ml-3">
                                            <?php if ($general_settings->multilingual_system == 1 && count($languages) > 1) : ?>
                                                <div class="row-custom">
                                                    <div class="dropdown language-dropdown">
                                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                            <i class="icon-language"></i>
                                                            <?php echo html_escape($selected_lang->name); ?>&nbsp;<span class="icon-arrow-down"></span>
                                                        </button>

                                                        <div class="dropdown-menu">
                                                            <?php foreach ($languages as $language) : ?>
                                                                <a href="<?php echo get_language_dropdown_option($language); ?>" class="<?php echo ($language->id == $selected_lang->id) ? 'selected' : ''; ?> " class="dropdown-item">
                                                                    <?php echo $language->name; ?>
                                                                </a>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-5 nav-top-right" style="padding: 0;">
                                    <ul class="nav align-items-center">
                                        <?php if (is_marketplace_active()) : ?>
                                            <li class="nav-item nav-item-cart li-main-nav-right">
                                                <a href="<?php echo lang_base_url(); ?>cart">
                                                    <i class="icon-cart"></i><span><?php echo trans("cart"); ?></span>
                                                    <?php $cart_product_count = get_cart_product_count();
                                                    if ($cart_product_count > 0) : ?>
                                                        <span class="notification"><?php echo $cart_product_count; ?></span>
                                                    <?php endif; ?>
                                                </a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if ($this->auth_check) : ?>
                                            <li class="nav-item li-main-nav-right">
                                                <a href="<?php echo lang_base_url(); ?>favorites/<?php echo $this->auth_user->slug; ?>">
                                                    <i class="icon-heart-o fa-lg"></i><?php echo trans("favorites"); ?>
                                                </a>
                                            </li>
                                        <?php else : ?>
                                            <li class="nav-item li-main-nav-right">
                                                <a href="<?php echo lang_base_url(); ?>favorites">
                                                    <i class="icon-heart-o fa-lg"></i><?php echo trans("favorites"); ?>
                                                </a>
                                            </li>
                                        <?php endif; ?>



                                        <!--Check auth-->
                                        <?php if (auth_check()) : ?>
                                            <li class="dropdown profile-dropdown">
                                                <a class="dropdown-toggle a-profile" data-toggle="dropdown" href="javascript:void(0)" aria-expanded="false" style="width: 150px">
                                                    <?php if ($unread_message_count > 0) : ?>
                                                        <span class="notification"><?php echo $unread_message_count; ?></span>
                                                    <?php endif; ?>
                                                    <img src="<?php echo get_user_avatar($this->auth_user); ?>" alt="<?php echo get_shop_name($this->auth_user); ?>">
                                                    <span class="username" style=" white-space: nowrap; text-overflow: ellipsis; width: 60% !important; overflow: hidden; top: 5px;"><?php echo get_shop_name($this->auth_user); ?></span>
                                                    <span class="icon-arrow-down" style="top: -2px"></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <?php if ($this->auth_user->role == "admin") : ?>
                                                        <li>
                                                            <a href="<?php echo admin_url(); ?>">
                                                                <i class="icon-dashboard"></i>
                                                                <?php echo trans("admin_panel"); ?>
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                    <li>
                                                        <a href="<?php echo lang_base_url(); ?>account/<?php echo $this->auth_user->slug; ?>">
                                                            <i class="icon-user"></i>
                                                            <?php echo trans("view_profile"); ?>
                                                        </a>
                                                    </li>
                                                    <?php if (is_sale_active()) : ?>
                                                        <li>
                                                            <a href="<?php echo lang_base_url(); ?>orders">
                                                                <i class="icon-shopping-basket"></i>
                                                                <?php echo trans("orders"); ?>
                                                            </a>
                                                        </li>
                                                        <?php if (is_user_vendor()) : ?>
                                                            <li>
                                                                <a href="<?php echo lang_base_url(); ?>sales">
                                                                    <i class="icon-shopping-bag"></i>
                                                                    <?php echo trans("sales"); ?>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo lang_base_url(); ?>earnings">
                                                                    <i class="icon-wallet"></i>
                                                                    <?php echo trans("earnings"); ?>
                                                                </a>
                                                            </li>
                                                        <?php endif; ?>
                                                        <?php if (is_bidding_system_active()) : ?>
                                                            <li>
                                                                <a href="<?php echo lang_base_url(); ?>quote-requests">
                                                                    <i class="icon-price-tag-o"></i>
                                                                    <?php echo trans("quote_requests"); ?>
                                                                </a>
                                                            </li>
                                                        <?php endif; ?>
                                                        <?php if ($general_settings->digital_products_system == 1) : ?>
                                                            <li>
                                                                <a href="<?php echo lang_base_url(); ?>downloads">
                                                                    <i class="icon-download"></i>
                                                                    <?php echo trans("downloads"); ?>
                                                                </a>
                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <li>
                                                        <a href="<?php echo lang_base_url(); ?>messages">
                                                            <i class="icon-mail"></i>
                                                            <?php echo trans("messages"); ?>
                                                            <?php if ($unread_message_count > 0) : ?>
                                                                <span class="span-message-count"><?php echo $unread_message_count; ?></span>
                                                            <?php endif; ?>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo lang_base_url(); ?>settings/update-profile">
                                                            <i class="icon-settings"></i>
                                                            <?php echo trans("settings"); ?>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo base_url(); ?>logout" class="logout">
                                                            <i class="icon-logout"></i>
                                                            <?php echo trans("logout"); ?>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>

                                            <?php if (is_multi_vendor_active()) : ?>
                                                <li class="nav-item"><a href="<?php echo lang_base_url(); ?>sell-now" class="btn btn-md btn-custom btn-sell-now"><?php echo trans("sell_now"); ?></a></li>
                                            <?php endif; ?>

                                        <?php else : ?>
                                            <li class="nav-item"><a href="<?php echo lang_base_url() . 'login'; ?>"><?php echo trans("login"); ?></a></li>
                                            <li class="nav-item"><a href="<?php echo lang_base_url(); ?>register"><?php echo trans("register"); ?></a></li>
                                            <?php if (is_multi_vendor_active()) : ?>
                                                <li class="nav-item"><a href="<?php echo lang_base_url() . 'login'; ?>" class="btn btn-md btn-custom btn-sell-now"><?php echo trans("sell_now"); ?></a></li>
                                            <?php endif; ?>
                                        <?php endif; ?>


                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="nav-main">
                        <!--main navigation-->
                        <?php /* $this->load->view("partials/_main_nav");  */ ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if (isset($is_mobile_header)) : ?>
            <div class="mobile-menu">
                <div class="mobile-header-item mobile-header-item-logo  pl-2">
                    <a href="<?php echo lang_base_url(); ?>" class="mobile-logo"><img src="<?php echo get_logo($general_settings); ?>" alt="logo"></a>
                </div>
                <div class="mobile-header-item mobile-header-item-logo text-right">

                    <div class="d-inline-block mr-1">
                        <?php if ($general_settings->multilingual_system == 1 && count($languages) > 1) : ?>
                            <div class="dropdown language-dropdown">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-language" style="margin-right: 1px;"></i>
                                    <?php echo html_escape(ucfirst($selected_lang->short_form)); ?><span class="icon-arrow-down"></span>
                                </button>
                                <div class="dropdown-menu">
                                    <?php foreach ($languages as $language) :
                                        $lang_url = base_url() . $language->short_form . "/";
                                        if ($language->id == $this->general_settings->site_lang) {
                                            $lang_url = base_url();
                                        } ?>
                                        <a href="<?php echo $lang_url; ?>" class="<?php echo ($language->id == $selected_lang->id) ? 'selected' : ''; ?> " class="dropdown-item">
                                            <?php echo $language->name; ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                        <?php endif; ?>
                    </div>
                    <div class="d-inline-block mr-2">
                        <a href="<?php echo lang_base_url(); ?>contact" style="font-size: 18px"><i class="icon-mail"></i></a>
                    </div>
                    <?php if ($this->auth_check) : ?>
                        <div class="d-inline-block mr-2 text-center">
                            <!-- <div class="cart-link-mobile header-cart"> -->
                            <a class="cart-link-mobile header-cart" href="<?php echo lang_base_url(); ?>cart">
                                <span>
                                    <i class="fa icon-cart"></i>
                                </span>
                                <?php $cart_product_count = get_cart_product_count();
                                if ($cart_product_count > 0) : ?>
                                    <span class="notification" style="top:2px;left:12px;font-size:13px;"><?php echo $cart_product_count; ?></span>
                                <?php endif; ?>
                            </a>
                            <!-- </div> -->
                        </div>
                    <?php else : ?>
                        <div class="d-inline-block mr-2 text-center">
                            <a href="<?php echo lang_base_url() . 'login'; ?>" class="cart-link-mobile header-cart" redirect_url="cart">
                                <i class="fa icon-cart"></i>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->auth_check) : ?>
                        <div class="cart-icon-mobile d-inline-block mr-2 text-center">
                            <a href="<?php echo lang_base_url() . 'favorites/' . $this->auth_user->slug; ?>" class="cart-link-mobile">
                                <i class="icon-heart-o fa-lg"></i>
                            </a>
                        </div>
                    <?php else : ?>
                        <div class="cart-icon-mobile d-inline-block mr-2 text-center">
                            <a href="<?php echo lang_base_url() . 'login'; ?>" class="cart-link-mobile" redirect_url="favorites">
                                <i class="icon-heart-o fa-lg"></i>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="btn-sell-now-mobile-container d-inline-block mr-2 text-center">
                        <?php if (is_multi_vendor_active()) :
                            if ($this->auth_check) : ?>
                                <a href="<?php echo lang_base_url(); ?>sell-now" class="btn btn-md btn-custom btn-sell-now-mobile"><?php echo trans("sell_now"); ?></a>
                            <?php else : ?>
                                <a href="<?php echo lang_base_url() . 'login'; ?>" class="btn btn-sm btn-custom btn-sell-now-mobile"><?php echo trans("sell_now"); ?></a>
                        <?php endif;
                        endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </header>

    <!--include mobile menu-->
    <?php $this->load->view("partials/_mobile_nav"); ?>

    <style>
        .custom-control-input.is-valid~.custom-control-label,
        .was-validated .custom-control-input:valid~.custom-control-label {
            color: #222;
        }

        .custom-control-input.is-valid:checked~.custom-control-label::before,
        .was-validated .custom-control-input:valid:checked~.custom-control-label::before {
            border-color: #1abc9c;
            background-color: #1abc9c;
        }
    </style>