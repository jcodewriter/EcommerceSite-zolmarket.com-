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

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-awesome/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-icons/css/font-icons.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" />
    <!-- Style CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/newstyle.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/costum_style.css" />

    <?php if (!empty($general_settings->site_color)) : ?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/colors/<?php echo $general_settings->site_color; ?>.min.css" />
    <?php else : ?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/colors/default.min.css" />
    <?php endif; ?>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>

    <?php echo $general_settings->head_code; ?>

</head>

<body>
    <!--include mobile menu-->
    <?php $this->load->view("partials/_mobile_nav"); ?>

    <?php if (!$this->auth_check) : ?>
        <!-- Login Modal -->
        <div class="modal fade" id="loginModal" role="dialog">
            <div class="modal-dialog modal-dialog-centered login-modal" role="document">
                <div class="modal-content">
                    <div class="auth-box">
                        <button type="button" class="close" data-dismiss="modal"><i class="icon-close"></i></button>
                        <h4 class="title"><?php echo trans("login"); ?></h4>
                        <!-- form start -->
                        <form id="form_login" novalidate="novalidate">
                            <p class="p-social-media m-0 m-b-10"><?php echo trans("dont_have_account"); ?>&nbsp;<a href="<?php echo lang_base_url(); ?>register" class="link"><?php echo trans("register"); ?></a></p>
                            <div class="social-login-cnt">
                                <?php $this->load->view("partials/_social_login", ["or_text" => trans("login_with_email")]); ?>
                            </div>
                            <!-- include message block -->
                            <div id="result-login"></div>

                            <div class="form-group">
                                <label for="email" style="color: #777;"><?php echo trans("email_address"); ?></label>
                                <input type="email" id="email" name="email" class="form-control auth-form-input" placeholder="<?php echo trans("email_address"); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="password" style="color: #777;"><?php echo trans("password"); ?></label>
                                <input type="password" id="password" name="password" class="form-control auth-form-input" placeholder="<?php echo trans("password"); ?>" minlength="4" required>
                            </div>
                            <div class="form-group" style="display: flex; flex-direction:row">
                                <div class="custom-control custom-checkbox" style="flex: 1">
                                    <input type="checkbox" name="remember_me" value="" id="remember-me" class="custom-control-input" onchange="">
                                    <label for="remember-me" class="custom-control-label"><?php echo trans("remember_me"); ?></label>
                                </div>
                                <div style="align-items:flex-end;">
                                    <a href="<?php echo lang_base_url(); ?>forgot-password" class="link-forgot-password text-right"><?php echo trans("forgot_password"); ?></a>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-md btn-custom btn-block"><?php echo trans("login"); ?></button>
                            </div>

                        </form>
                        <!-- form end -->
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>