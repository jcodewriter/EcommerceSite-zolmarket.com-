<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="hkm_messages_navCatDownMobile">
    <div class="cat-header">
        <div class="mobile-header-back">
            <a href="javascript:history.go(-1)" class="btn-back-mobile-nav"> <i class="icon-arrow-left"></i> <?php echo trans("back"); ?> </a>
        </div>
        <div class="mobile-header-title">
            <span class="text-white textcat-header text-center"><?php echo trans("reset_password"); ?></span>
        </div>
        <div class="mobilde-header-cart">
        </div>
    </div>
</div>
<br><br>
<!-- Wrapper -->
<div id="wrapper">
    <div class="container">
        <div class="auth-container">
            <div class="auth-box">
                <div class="row">
                    <div class="col-12">
                        <h1 class="title"><?php echo trans("reset_password"); ?></h1>
                        <!-- form start -->
                        <?php echo form_open('auth_controller/forgot_password_post', ['id' => 'form_validate']); ?>

                        <div class="form-group">
                            <p class="p-social-media m-0"><?php echo trans("reset_password_subtitle"); ?></p>
                        </div>
                        <!-- include message block -->
                        <?php $this->load->view('partials/_messages'); ?>

                        <div class="form-group m-b-30">
                            <input type="email" id="email" name="email" class="form-control auth-form-input" placeholder="<?php echo trans("email_address"); ?>" value="<?php echo old("email"); ?>" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-md btn-custom btn-block"><?php echo trans("submit"); ?></button>
                        </div>

                        <?php echo form_close(); ?>
                        <!-- form end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $("#email").keyup(function(){
        if($(this).val() != ""){
            $(this).css({'font-size':'16px','font-weight':'bold'});
        }
        else{
            $(this).css({'font-size':'13px','font-weight':'normal'});
        }
    })
})
</script>
<!-- Wrapper End-->