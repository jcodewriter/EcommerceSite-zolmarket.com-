<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="hkm_messages_navCatDownMobile">
	<div class="cat-header">
        <div class="mobile-header-back">
            <a href="<?php echo lang_base_url();?>" class="btn-back-mobile-nav"> <i class="icon-arrow-left"></i> <?php echo trans("back"); ?>  </a>
        </div>
        <div class="mobile-header-title">
            <span  class="text-white textcat-header text-center"><?php echo trans("success_add_product"); ?></span>
        </div>
        <div class="mobilde-header-cart">
        </div>
	</div>  
</div>
<!-- Wrapper -->
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-confirm" style="padding-top: 50px !important;">
                    <?php if (!empty($success)): ?>
                        <div class="circle-loader">
                            <div class="checkmark draw"></div>
                        </div>
                        <h1 class="title">
                            <?php echo $success; ?>
                        </h1>
                        <a href="<?php echo lang_base_url() . 'product/' . $product->slug; ?>" class="btn btn-md btn-custom m-t-30"><?php echo trans("watch_ad"); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Wrapper End-->

<style>
    .circle-loader{margin-bottom:3.5em;border:1px solid rgba(0,0,0,0.2);border-left-color:#5cb85c;animation:loader-spin 1.2s infinite linear;position:relative;display:inline-block;vertical-align:top;border-radius:50%;width:7em;height:7em}.load-complete{-webkit-animation:none;animation:none;border-color:#5cb85c;transition:border 500ms ease-out}.checkmark{display:none}.checkmark.draw:after{animation-duration:800ms;animation-timing-function:ease;animation-name:checkmark;transform:scaleX(-1) rotate(135deg)}.checkmark:after{opacity:1;height:3.5em;width:1.75em;transform-origin:left top;border-right:3px solid #5cb85c;border-top:3px solid #5cb85c;content:'';left:1.75em;top:3.5em;position:absolute}@keyframes loader-spin{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}@keyframes checkmark{0%{height:0;width:0;opacity:1}20%{height:0;width:1.75em;opacity:1}40%{height:3.5em;width:1.75em;opacity:1}100%{height:3.5em;width:1.75em;opacity:1}}.error-circle{margin-bottom:3.5em;border:1px solid #dc3545;position:relative;display:inline-block;vertical-align:top;border-radius:50%;width:7em;height:7em;line-height:7em;color:#dc3545}.error-circle i{font-size:30px}
</style>
<script>
    $(document).ready(function () {
        $('.circle-loader').toggleClass('load-complete');
        $('.checkmark').toggle();
    });
</script>
