<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
if (auth_check()) {
    $profile = $this->auth_user;
}
?>



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
        <!-- load profile details -->
        <?php
        if ($user->is_private) {
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
                    <div id="user-review-result" class="user-reviews">
                        <?php $this->load->view('account/_user_reviews'); ?>
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