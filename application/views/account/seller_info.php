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
                    <div class="seller-info__wrapper">
                        <div class="seller-info__item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                <path id="member-since" d="M11,3A3.667,3.667,0,0,0,7,7a3.972,3.972,0,0,0,.352,1.475.78.78,0,0,0-.315.8c.109.855.48,1.073.716,1.091A3.48,3.48,0,0,0,9,12.335v1.333c-.667,2-6,.667-6,5.334h7.965a5.982,5.982,0,0,1,3.186-8.252,1.781,1.781,0,0,0,.1-.383c.236-.018.607-.236.716-1.091a.779.779,0,0,0-.315-.8A3.526,3.526,0,0,0,15,7c0-1.619-.635-3-2-3A2.121,2.121,0,0,0,11,3Zm5.333,8.666A4.667,4.667,0,1,0,21,16.335,4.667,4.667,0,0,0,16.333,11.668Zm2,2.667a.667.667,0,0,1,.471,1.138L16.138,18.14a.666.666,0,0,1-.943,0l-1.333-1.333a.667.667,0,0,1,.943-.943l.862.862,2.2-2.2A.664.664,0,0,1,18.333,14.335Z" transform="translate(-3 -3.002)" fill="#696969" />
                            </svg>
                            <span><?php echo trans("member_since"); ?>&nbsp;<?php echo helper_date_format($user->created_at); ?></span>
                        </div>
                        <?php if (!empty($user->email)) : ?>
                            <div class="seller-info__item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14">
                                    <path id="email_2" data-name="email 2" d="M0,3V5.649l9,4.667,9-4.667V3ZM0,7.132V17H18V7.132L9,11.8Z" transform="translate(0 -3)" fill="#696969" />
                                </svg>
                                <span><?php echo html_escape($user->email); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty(get_location($user)) && $user->show_location == 1) : ?>
                            <div class="seller-info__item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="21" viewBox="0 0 17 21">
                                    <path id="pin" d="M13.5,2C8.806,2,5,5.291,5,9.35,5,14.6,13.5,23,13.5,23S22,14.6,22,9.35C22,5.291,18.194,2,13.5,2Zm0,9.975A2.852,2.852,0,0,1,10.464,9.35,2.852,2.852,0,0,1,13.5,6.725,2.852,2.852,0,0,1,16.536,9.35,2.852,2.852,0,0,1,13.5,11.975Z" transform="translate(-5 -2)" fill="#696969" />
                                </svg>
                                <span><?php echo get_location($user); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($user->phone_number) && $user->show_phone == 1) : ?>
                            <div class="seller-info__item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18.707" viewBox="0 0 18 18.707">
                                    <path id="call" d="M17.743,21.7h-.019c-3.075-.1-6.677-3.2-9.159-5.782S3.1,9.6,3,6.417C2.968,5.3,5.6,3.316,5.631,3.3a1.235,1.235,0,0,1,1.755.13c.211.3,2.209,3.449,2.426,3.806a1.549,1.549,0,0,1-.089,1.475c-.155.307-.67,1.247-.911,1.686A22.129,22.129,0,0,0,11.183,13.2a21.794,21.794,0,0,0,2.7,2.466c.422-.251,1.326-.786,1.622-.947a1.4,1.4,0,0,1,1.411-.1c.368.234,3.386,2.32,3.665,2.521a1.1,1.1,0,0,1,.414.8,1.618,1.618,0,0,1-.286,1.025C20.695,19,18.807,21.7,17.743,21.7Z" transform="translate(-3.003 -2.998)" fill="#696969" />
                                </svg>
                                <span>
                                    <a href="javascript:void(0)" id="show_phone_number"><?php echo trans("show"); ?></a>
                                    <a href="tel:<?php echo html_escape($user->phone_number); ?>" class="display-none phone_number"><?php echo html_escape($user->phone_number); ?></a>
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($user->about_me)) : ?>
                            <div class="seller-info__item">
                                Description :
                            </div>
                            <span style="color: #888;"><?php echo html_escape($user->about_me); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Wrapper End-->

<!-- include send message modal -->
<?php $this->load->view("partials/_modal_send_message", ["subject" => null]); ?>