<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo html_escape($title); ?> - <?php echo html_escape($general_settings->application_name); ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" type="image/png" href="<?php echo get_favicon($general_settings); ?>" />
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/vendor/bootstrap/css/bootstrap.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/vendor/icheck/square/purple.css">
    <!-- Datatables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/vendor/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/vendor/datatables/jquery.dataTables_themeroller.css">
    <!-- Tags Input -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/vendor/tagsinput/jquery.tagsinput.min.css">
    <!-- Bootstrap Toggle -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-toggle.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/vendor/pace/pace.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/vendor/magnific-popup/magnific-popup.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/_all-skins.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/custom.css">
    <!-- jQuery 3 -->
    <script src="<?php echo base_url(); ?>assets/admin/js/jquery.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        var base_url = '<?php echo base_url(); ?>';
        var csfr_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
        var csfr_cookie_name = '<?php echo $this->config->item('csrf_cookie_name'); ?>';
    </script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="<?php echo admin_url(); ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b><?php echo html_escape($general_settings->application_name); ?></b> <?php echo trans("panel"); ?></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <a class="btn btn-sm btn-success pull-left btn-site-prev" target="_blank" href="<?php echo base_url(); ?>"><i class="fa fa-eye"></i> <?php echo trans("view_site"); ?></a>
                        </li>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <img src="<?php echo get_user_avatar(user()); ?>" class="user-image" alt="">
                                <span class="hidden-xs"><?php echo user()->username; ?> <i class="fa fa-caret-down"></i> </span>
                            </a>

                            <ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
                                <li>
                                    <a href="<?php echo base_url(); ?>account/<?php echo user()->slug; ?>"><i class="fa fa-user"></i> <?php echo trans("profile"); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>settings"><i class="fa fa-cog"></i> <?php echo trans("update_profile"); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>settings/change-password"><i class="fa fa-lock"></i> <?php echo trans("change_password"); ?></a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="<?php echo base_url(); ?>logout"><i class="fa fa-sign-out"></i> <?php echo trans("logout"); ?></a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar" style="background-color: #343B4A;">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar sidebar-scrollbar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo get_user_avatar(user()); ?>" class="img-circle" alt="">
                    </div>
                    <div class="pull-left info">
                        <p><?php echo user()->username; ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>

                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header"><?php echo trans("navigation"); ?></li>
                    <li class="nav-home">
                        <a href="<?php echo admin_url(); ?>">
                            <i class="fa fa-home"></i> <span><?php echo trans("home"); ?></span>
                        </a>
                    </li>
                    <li class="nav-navigation">
                        <a href="<?php echo admin_url(); ?>navigation">
                            <i class="fa fa-th"></i>
                            <span><?php echo trans("navigation"); ?></span>
                        </a>
                    </li>
                    <li class="nav-slider">
                        <a href="<?php echo admin_url(); ?>slider">
                            <i class="fa fa-sliders"></i>
                            <span><?php echo trans("slider"); ?></span>
                        </a>
                    </li>
                    <li class="header"><?php echo trans("orders"); ?></li>
                    <li class="treeview<?php is_admin_nav_active(['orders', 'transactions', 'order-bank-transfers']); ?>">
                        <a href="#" style="display: flex">
                            <i class="fa fa-shopping-cart"></i>
                            <span><?php echo trans("orders"); ?></span>
                            <?php $total = admin_total_notifcations(".001");
                            if ($total) : ?>
                                <div class="admin_notification">
                                    <span><?= $total ?></span>
                                </div>
                            <?php endif; ?>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-orders">
                                <a href="<?php echo admin_url(); ?>orders">
                                    <?php echo trans("orders"); ?>
                                    <?php $result = admin_notifcations(".001.001");
                                    if ($result) : ?>
                                        <div class="admin_notification">
                                            <span><?= $result ?></span>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <li class="nav-transactions">
                                <a href="<?php echo admin_url(); ?>transactions">
                                    <?php echo trans("transactions"); ?>
                                    <?php $result = admin_notifcations(".001.002");
                                    if ($result) : ?>
                                        <div class="admin_notification">
                                            <span><?= $result ?></span>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <li class="nav-order-bank-transfers">
                                <a href="<?php echo admin_url(); ?>order-bank-transfers">
                                    <?php echo trans("bank_transfer_notifications"); ?>
                                    <?php $result = admin_notifcations(".001.003");
                                    if ($result) : ?>
                                        <div class="admin_notification">
                                            <span><?= $result ?></span>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-digital-sales">
                        <a href="<?php echo admin_url(); ?>digital-sales" style="display: flex">
                            <i class="fa fa-shopping-bag"></i>
                            <span><?php echo trans("digital_sales"); ?></span>
                            <?php $result = admin_notifcations(".002.001");
                            if ($result) : ?>
                                <div class="admin_notification">
                                    <span><?= $result ?></span>
                                </div>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="treeview<?php is_admin_nav_active(['earnings', 'seller-balances']); ?>">
                        <a href="#" style="display: flex">
                            <i class="fa fa-money" aria-hidden="true"></i>
                            <span><?php echo trans("earnings"); ?></span>
                            <?php $total = admin_total_notifcations(".005");
                            if ($total) : ?>
                                <div class="admin_notification">
                                    <span><?= $total ?></span>
                                </div>
                            <?php endif; ?>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-earnings">
                                <a href="<?php echo admin_url(); ?>earnings">
                                    <?php echo trans("earnings"); ?>
                                    <?php $result = admin_notifcations(".005.001");
                                    if ($result) : ?>
                                        <div class="admin_notification">
                                            <span><?= $result ?></span>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <li class="nav-seller-balances">
                                <a href="<?php echo admin_url(); ?>seller-balances">
                                    <?php echo trans("seller_balances"); ?>
                                    <?php $result = admin_notifcations(".005.002");
                                    if ($result) : ?>
                                        <div class="admin_notification">
                                            <span><?= $result ?></span>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview<?php is_admin_nav_active(['add-payout', 'payout-requests', 'completed-payouts', 'payout-settings']); ?>">
                        <a href="#" style="display: flex">
                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                            <span><?php echo trans("payouts"); ?></span>
                            <?php $total = admin_total_notifcations(".006");
                            if ($total) : ?>
                                <div class="admin_notification">
                                    <span><?= $total ?></span>
                                </div>
                            <?php endif; ?>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-add-payout"><a href="<?php echo admin_url(); ?>add-payout"> <?php echo trans("add_payout"); ?></a></li>
                            <li class="nav-payout-requests">
                                <a href="<?php echo admin_url(); ?>payout-requests">
                                    <?php echo trans("payout_requests"); ?>
                                    <?php $result = admin_notifcations(".006.001");
                                    if ($result) : ?>
                                        <div class="admin_notification">
                                            <span><?= $result ?></span>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <li class="nav-completed-payouts">
                                <a href="<?php echo admin_url(); ?>completed-payouts">
                                    <?php echo trans("completed_payouts"); ?>
                                    <?php $result = admin_notifcations(".006.002");
                                    if ($result) : ?>
                                        <div class="admin_notification">
                                            <span><?= $result ?></span>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <li class="nav-payout-settings"><a href="<?php echo admin_url(); ?>payout-settings"> <?php echo trans("payout_settings"); ?></a></li>
                        </ul>
                    </li>
                    <li class="header"><?php echo trans("products"); ?></li>
                    <li class="treeview<?php is_admin_nav_active(['products', 'pending-products', 'hidden-products', 'drafts', 'deleted-products', 'sold-products']); ?>">
                        <a href="#" style="display: flex">
                            <i class="fa fa-shopping-basket angle-left" aria-hidden="true"></i>
                            <span><?php echo trans("products"); ?></span>
                            <?php $total = admin_total_notifcations(".003");
                            if ($total) : ?>
                                <div class="admin_notification">
                                    <span><?= $total ?></span>
                                </div>
                            <?php endif; ?>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-products">
                                <a href="<?php echo admin_url(); ?>products">
                                    <?php echo trans("products"); ?>
                                    <?php $result = admin_notifcations(".003.001");
                                    if ($result) : ?>
                                        <div class="admin_notification">
                                            <span><?= $result ?></span>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <li class="nav-pending-products">
                                <a href="<?php echo admin_url(); ?>pending-products">
                                    <?php echo trans("pending_products"); ?>
                                    <?php $result = admin_notifcations(".003.002");
                                    if ($result) : ?>
                                        <div class="admin_notification">
                                            <span><?= $result ?></span>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <li class="nav-hidden-products">
                                <a href="<?php echo admin_url(); ?>hidden-products">
                                    <?php echo trans("hidden_products"); ?>
                                    <?php $result = admin_notifcations(".003.003");
                                    if ($result) : ?>
                                        <div class="admin_notification">
                                            <span><?= $result ?></span>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <li class="nav-sold-products">
                                <a href="<?php echo admin_url(); ?>sold-products">
                                    <?php echo trans("sold_products"); ?>
                                    <?php $result = admin_notifcations(".003.004");
                                    if ($result) : ?>
                                        <div class="admin_notification">
                                            <span><?= $result ?></span>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <li class="nav-drafts">
                                <a href="<?php echo admin_url(); ?>drafts">
                                    <?php echo trans("drafts"); ?>
                                    <?php $result = admin_notifcations(".003.005");
                                    if ($result) : ?>
                                        <div class="admin_notification">
                                            <span><?= $result ?></span>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <li class="nav-deleted-products">
                                <a href="<?php echo admin_url(); ?>deleted-products">
                                    <?php echo trans("deleted_products"); ?>
                                    <?php $result = admin_notifcations(".003.006");
                                    if ($result) : ?>
                                        <div class="admin_notification">
                                            <span><?= $result ?></span>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview<?php is_admin_nav_active(['promoted-products', 'promoted-products-pricing', 'promoted-products-transactions']); ?>">
                        <a href="#" style="display: flex">
                            <i class="fa fa-dollar" aria-hidden="true"></i>
                            <span><?php echo trans("promoted_products"); ?></span>
                            <?php $total = admin_total_notifcations(".004");
                            if ($total) : ?>
                                <div class="admin_notification">
                                    <span><?= $total ?></span>
                                </div>
                            <?php endif; ?>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-promoted-products"><a href="<?php echo admin_url(); ?>promoted-products"> <?php echo trans("products"); ?></a></li>
                            <li class="nav-promoted-products-pricing"><a href="<?php echo admin_url(); ?>promoted-products-pricing"> <?php echo trans("pricing"); ?></a></li>
                            <li class="nav-promoted-products-transactions">
                                <a href="<?php echo admin_url(); ?>promoted-products-transactions">
                                    <?php echo trans("transactions"); ?>
                                    <?php $result = admin_notifcations(".004.001");
                                    if ($result) : ?>
                                        <div class="admin_notification">
                                            <span><?= $result ?></span>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-quote-requests">
                        <a href="<?php echo admin_url(); ?>quote-requests">
                            <i class="fa fa-tag"></i> <span><?php echo trans("quote_requests"); ?></span>
                        </a>
                    </li>
                    <li class="treeview<?php is_admin_nav_active(['add-category', 'categories']); ?>">
                        <a href="#">
                            <i class="fa fa-folder-open"></i>
                            <span><?php echo trans("categories"); ?></span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-add-category"><a href="<?php echo admin_url(); ?>add-category"> <?php echo trans("add_category"); ?></a></li>
                            <li class="nav-categories"><a href="<?php echo admin_url(); ?>categories"> <?php echo trans("categories"); ?></a></li>
                        </ul>
                    </li>
                    <li class="treeview<?php is_admin_nav_active(['add-custom-field', 'custom-fields']); ?>">
                        <a href="#">
                            <i class="fa fa-plus-square-o"></i>
                            <span><?php echo trans("custom_fields"); ?></span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-add-custom-field"><a href="<?php echo admin_url(); ?>add-custom-field"> <?php echo trans("add_custom_field"); ?></a></li>
                            <li class="nav-custom-fields"><a href="<?php echo admin_url(); ?>custom-fields"> <?php echo trans("custom_fields"); ?></a></li>
                        </ul>
                    </li>
                    <li class="header"><?php echo trans("content"); ?></li>
                    <li class="treeview<?php is_admin_nav_active(['add-page', 'pages']); ?>">
                        <a href="#">
                            <i class="fa fa-file"></i>
                            <span><?php echo trans("pages"); ?></span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-add-page"><a href="<?php echo admin_url(); ?>add-page"> <?php echo trans("add_page"); ?></a></li>
                            <li class="nav-pages"><a href="<?php echo admin_url(); ?>pages"> <?php echo trans("pages"); ?></a></li>
                        </ul>
                    </li>
                    <li class="treeview<?php is_admin_nav_active(['blog-add-post', 'blog-posts', 'blog-categories']); ?>">
                        <a href="#">
                            <i class="fa fa-file"></i>
                            <span><?php echo trans("blog"); ?></span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-blog-add-post"><a href="<?php echo admin_url(); ?>blog-add-post"> <?php echo trans("add_post"); ?></a></li>
                            <li class="nav-blog-posts"><a href="<?php echo admin_url(); ?>blog-posts"> <?php echo trans("posts"); ?></a></li>
                            <li class="nav-blog-categories"><a href="<?php echo admin_url(); ?>blog-categories"> <?php echo trans("categories"); ?></a></li>
                        </ul>
                    </li>
                    <li class="treeview<?php is_admin_nav_active(['countries', 'states', 'cities', 'location-settings']); ?>">
                        <a href="#">
                            <i class="fa fa-map-marker"></i>
                            <span><?php echo trans("location"); ?></span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-countries"><a href="<?php echo admin_url(); ?>countries"> <?php echo trans("countries"); ?></a></li>
                            <li class="nav-states"><a href="<?php echo admin_url(); ?>states"> <?php echo trans("states"); ?></a></li>
                            <li class="nav-cities"><a href="<?php echo admin_url(); ?>cities"> <?php echo trans("cities"); ?></a></li>
                            <li class="nav-location-settings"><a href="<?php echo admin_url(); ?>location-settings"> <?php echo trans("location_settings"); ?></a></li>
                        </ul>
                    </li>
                    <li class="header"><?php echo trans("membership"); ?></li>
                    <li class="treeview<?php is_admin_nav_active(['membership-plans', 'transactions-membership']); ?>">
                        <a href="#" style="display:flex">
                            <i class="fa fa-adjust"></i>
                            <span><?php echo trans("membership"); ?></span>
                            <?php $total = admin_total_notifcations(".010");
                            if ($total) : ?>
                                <div class="admin_notification">
                                    <span><?= $total ?></span>
                                </div>
                            <?php endif; ?>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-membership-plans"><a href="<?php echo admin_url(); ?>membership-plans"> <?php echo trans("membership_plans"); ?></a></li>
                            <li class="nav-transactions-membership">
                            <a href="<?php echo admin_url(); ?>transactions-membership"> <?php echo trans("transactions"); ?>
                            
                            <?php $result = admin_notifcations(".010.001");
                                    if ($result) : ?>
                                        <div class="admin_notification">
                                            <span><?= $result ?></span>
                                        </div>
                                    <?php endif; ?>
                            </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-shop-opening-requests">
                        <a href="<?php echo admin_url(); ?>shop-opening-requests" style="display:flex">
                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                            <span><?php echo trans("shop_opening_requests"); ?></span>
                            <?php $result = admin_notifcations(".009.001");
                                    if ($result) : ?>
                                        <div class="admin_notification">
                                            <span><?= $result ?></span>
                                        </div>
                                    <?php endif; ?>
                        </a>
                    </li>
                    <li class="treeview<?php is_admin_nav_active(['add-administrator', 'administrators', 'companies', 'vendors', 'members', 'edit-user']); ?>">
                        <a href="#" style="display:flex">
                            <i class="fa fa-users"></i>
                            <span><?php echo trans("users"); ?></span>
                            <?php $total = admin_total_notifcations(".007");
                            if ($total) : ?>
                                <div class="admin_notification">
                                    <span><?= $total ?></span>
                                </div>
                            <?php endif; ?>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-add-administrator"><a href="<?php echo admin_url(); ?>add-administrator"> <?php echo trans("add_administrator"); ?></a></li>
                            <li class="nav-administrators"><a href="<?php echo admin_url(); ?>administrators"> <?php echo trans("administrators"); ?></a></li>
                            <li class="nav-companies"><a href="<?php echo admin_url(); ?>companies"> <?php echo trans("companies"); ?></a></li>
                            <li class="nav-vendors">
                                <a href="<?php echo admin_url(); ?>vendors">
                                    <?php echo trans("vendors"); ?>
                                    <?php $result = admin_notifcations(".007.001");
                                    if ($result) : ?>
                                        <div class="admin_notification">
                                            <span><?= $result ?></span>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <li class="nav-members">
                                <a href="<?php echo admin_url(); ?>members">
                                    <?php echo trans("members"); ?>
                                    <?php $result = admin_notifcations(".007.002");
                                    if ($result) : ?>
                                        <div class="admin_notification">
                                            <span><?= $result ?></span>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="header"><?php echo trans("management_tools"); ?></li>
                    <li class="nav-contact-messages">
                        <a href="<?php echo admin_url(); ?>contact-messages">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                            <span><?php echo trans("contact_messages"); ?></span>
                        </a>
                    </li>
                    <li class="treeview<?php is_admin_nav_active(['send-email-subscribers', 'subscribers']); ?>">
                        <a href="#">
                            <i class="fa fa-envelope"></i> <span><?php echo trans("newsletter"); ?></span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-send-email-subscribers">
                                <a href="<?php echo admin_url(); ?>send-email-subscribers"><?php echo trans("send_email_subscribers"); ?></a>
                            </li>
                            <li class="nav-subscribers">
                                <a href="<?php echo admin_url(); ?>subscribers"><?php echo trans("subscribers"); ?></a>
                            </li>
                        </ul>
                    </li>

                    <li class="treeview<?php is_admin_nav_active(['product-reviews', 'user-reviews']); ?>">
                        <a href="#">
                            <i class="fa fa-star"></i>
                            <span><?php echo trans("reviews"); ?></span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-product-reviews"><a href="<?php echo admin_url(); ?>product-reviews"> <?php echo trans("product_reviews"); ?></a></li>
                            <li class="nav-user-reviews"><a href="<?php echo admin_url(); ?>user-reviews"> <?php echo trans("user_reviews"); ?></a></li>
                        </ul>
                    </li>
                    <li class="treeview<?php is_admin_nav_active(['product-comments', 'blog-comments']); ?>">
                        <a href="#">
                            <i class="fa fa-comments"></i>
                            <span><?php echo trans("comments"); ?></span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-product-comments"><a href="<?php echo admin_url(); ?>product-comments"> <?php echo trans("product_comments"); ?></a></li>
                            <li class="nav-blog-comments"><a href="<?php echo admin_url(); ?>blog-comments"> <?php echo trans("blog_comments"); ?></a></li>
                        </ul>
                    </li>
                    <li class="nav-storage">
                        <a href="<?php echo admin_url(); ?>storage">
                            <i class="fa fa-cloud-upload"></i>
                            <span><?php echo trans("storage"); ?></span>
                        </a>
                    </li>
                    <li class="nav-cache-system">
                        <a href="<?php echo admin_url(); ?>cache-system">
                            <i class="fa fa-database"></i>
                            <span><?php echo trans("cache_system"); ?></span>
                        </a>
                    </li>
                    <li class="nav-seo-tools">
                        <a href="<?php echo admin_url(); ?>seo-tools">
                            <i class="fa fa-wrench"></i> <span><?php echo trans("seo_tools"); ?></span>
                        </a>
                    </li>
                    <li class="nav-ad-spaces">
                        <a href="<?php echo admin_url(); ?>ad-spaces">
                            <i class="fa fa-dollar"></i> <span><?php echo trans("ad_spaces"); ?></span>
                        </a>
                    </li>


                    <li class="header text-uppercase"><?php echo trans("settings"); ?></li>
                    <li class="nav-preferences">
                        <a href="<?php echo admin_url(); ?>preferences">
                            <i class="fa fa-check-square-o"></i>
                            <span><?php echo trans("preferences"); ?></span>
                        </a>
                    </li>
                    <li class="nav-social-login">
                        <a href="<?php echo admin_url(); ?>social-login">
                            <i class="fa fa-share-alt"></i> <span><?php echo trans("social_login"); ?></span>
                        </a>
                    </li>
                    <li class="treeview<?php is_admin_nav_active(['form-settings', 'form-settings/shipping-options', 'form-settings/product-conditions']); ?>">
                        <a href="#">
                            <i class="fa fa-cogs"></i>
                            <span><?php echo trans("form_settings"); ?></span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-form-settings"><a href="<?php echo admin_url(); ?>form-settings"> <?php echo trans("form_settings"); ?></a></li>
                            <li><a href="<?php echo admin_url(); ?>form-settings/shipping-options"> <?php echo trans("shipping_options"); ?></a></li>
                            <li><a href="<?php echo admin_url(); ?>form-settings/product-conditions"> <?php echo trans("product_conditions"); ?></a></li>
                        </ul>
                    </li>
                    <li class="nav-payment-settings">
                        <a href="<?php echo admin_url(); ?>payment-settings">
                            <i class="fa fa-credit-card-alt" aria-hidden="true"></i> <span><?php echo trans("payment_settings"); ?></span>
                        </a>
                    </li>
                    <li class="nav-currency-settings">
                        <a href="<?php echo admin_url(); ?>currency-settings">
                            <i class="fa fa-money"></i> <span><?php echo trans("currency_settings"); ?></span>
                        </a>
                    </li>

                    <li class="nav-languages">
                        <a href="<?php echo admin_url(); ?>languages">
                            <i class="fa fa-language"></i> <span><?php echo trans("language_settings"); ?></span>
                        </a>
                    </li>
                    <li class="nav-email-settings">
                        <a href="<?php echo admin_url(); ?>email-settings">
                            <i class="fa fa-cog"></i> <span><?php echo trans("email_settings"); ?></span>
                        </a>
                    </li>
                    <li class="treeview<?php is_admin_nav_active(['visual-settings', 'font-settings']); ?>">
                        <a href="#">
                            <i class="fa fa-paint-brush"></i>
                            <span><?php echo trans("visual_settings"); ?></span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-visual-settings"><a href="<?php echo admin_url(); ?>visual-settings"> <?php echo trans("visual_settings"); ?></a></li>
                            <li class="nav-font-settings"><a href="<?php echo admin_url(); ?>font-settings"> <?php echo trans("font_settings"); ?></a></li>
                        </ul>
                    </li>
                    <li class="nav-system-settings">
                        <a href="<?php echo admin_url(); ?>system-settings">
                            <i class="fa fa-cogs"></i> <span><?php echo trans("system_settings"); ?></span>
                        </a>
                    </li>
                    <li class="nav-settings">
                        <a href="<?php echo admin_url(); ?>settings">
                            <i class="fa fa-cogs"></i> <span><?php echo trans("general_settings"); ?></span>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
        <?php
        $segment2 = @$this->uri->segment(2);
        $segment3 = @$this->uri->segment(3);

        $uri_string = $segment2;
        if (!empty($segment3)) {
            $uri_string .= '-' . $segment3;
        } ?>
        <style>
            <?php if (!empty($uri_string)) :
                echo '.nav-' . $uri_string . ' > a{color: #fff !important;}';
            else :
                echo '.nav-home > a{color: #fff !important;}';
            endif; ?>
        </style>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">