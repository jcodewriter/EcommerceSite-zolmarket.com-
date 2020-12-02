<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php $this->load->view("account/_profile_header"); ?>
<!-- Wrapper -->
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="nav-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo lang_base_url(); ?>"><?php echo trans("home"); ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo trans("followers"); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <?php
        if ($user->is_private && $user->role != 'admin') {
            $this->load->view("account/private/_profile_info");
        } else {
            $this->load->view("account/company/_profile_info");
        }
        ?>

        <div class="row">
            <div class="col-sm-12 col-md-3">
                <!-- load profile nav -->

            </div>
            <div class="col-sm-12 col-md-9">
                <div class="profile-tab-content">
                    <div class="profile-item__wrapper">
                        <div class="row">
                            <?php foreach ($followers as $key => $item) : ?>
                                <div class="col-sm-12 col-md-12">
                                    <a href="<?php echo generate_profile_url($item); ?>" class="follower-item" style="<?php echo sizeof($followers) > ($key + 1) ? 'border-bottom: 1px solid #dee2e6;' : ''; ?>">
                                        <div class="d-flex align-items-center">
                                            <img src="<?php echo get_user_avatar($item); ?>" alt="<?php echo get_shop_name($item); ?>" class="img-fluid img-profile lazyload">
                                            <span class="ml-2"><?php echo get_shop_name($item); ?></span>
                                        </div>
                                        <div>
                                            <button class="btn btn-md btn-orange"><i class="icon-user-plus"></i><?php echo trans("follow"); ?></button>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="row-custom">
                        <!--Include banner-->
                        <?php $this->load->view("partials/_ad_spaces", ["ad_space" => "profile", "class" => "m-t-30"]); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Wrapper End-->

<!-- include send message modal -->
<?php $this->load->view("partials/_modal_send_message", ["subject" => null]); ?>