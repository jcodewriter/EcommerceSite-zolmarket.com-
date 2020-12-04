<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="navCatDownMobile nav-mobile" id="MenuMobileModel">
    <div class="form-group cat-header">
        <a href="javascript:void(0)" class="btn-back-mobile-nav"><i class="icon-arrow-left"></i> <?= trans('back') ?></a>
        <span href="javascript:void(0)" class="text-white textcat-header text-center" style="width: 250px;overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"></span>
    </div>
    <div class="nav-mobile-inner">
        <ul class="navbar-nav top-search-bar mobile-search-form">


        </ul>
    </div>
</div>
<div class="mobile-footer-filter">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <button type="submit" form="form-product-filters" class="btn btn-lg btn-custom float-center" style="width: 100%">Filter</button>
            </div>
        </div>
    </div>
</div>
<!-- Popper JS-->
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/popper.min.js"></script>
<!-- Bootstrap JS-->
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- Plugins JS-->
<script src="<?php echo base_url(); ?>assets/js/plugins-1.7.js"></script>
<script>
    var base_url = '<?php echo base_url(); ?>';
    var lang_base_url = '<?php echo lang_base_url(); ?>';
    var csfr_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var csfr_cookie_name = '<?php echo $this->config->item('csrf_cookie_name'); ?>'
    var slider_fade_effect = "<?php echo ($this->general_settings->slider_effect == "fade") ? 1 : 0; ?>";
</script>

<script src="<?php echo base_url(); ?>assets/js/script.js"></script>
<style>
    i,
    span[class*='icon'] {
        visibility: visible;
    }
</style>
</body>

</html>