<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="hkm_messages_navCatDownMobile">
    <div class="cat-header">
        <div class="mobile-header-back">
            <a href="javascript:history.go(-1)" class="btn-back-mobile-nav ads_preview_btn"> <i class="icon-arrow-left"></i> <?php echo trans("back"); ?> </a>
        </div>
        <div class="mobile-header-title">
            <span class="text-white textcat-header text-center"><?php echo html_escape($title); ?></span>
        </div>
        <div class="mobilde-header-cart">
        </div>
    </div>
</div>
<br>
<!-- Wrapper -->
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div id="content" class="col-12">
                <nav class="nav-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb"></ol>
                </nav>
                <h1 class="page-title page-title-product m-b-15 page_title_hidden_on_mobile"><?= html_escape($title); ?></h1>
                <div class="form-add-product">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-12">
                            <div class="row">
                                <div class="col-12">
                                    <p class="start-selling-description text-muted"><?= trans("select_your_plan_exp"); ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <!-- include message block -->
                                    <?php $this->load->view('product/_messages'); ?>
                                </div>
                            </div>
                            <?php echo form_open('profile_controller/renew_membership_plan_post'); ?>
                            <?php if (!empty($membership_plans)) :
                                if (!empty($user_current_plan)) : ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="price-box-container">
                                                <?php foreach ($membership_plans as $plan) :?>
                                                        <div class="price-box">
                                                            <?php if ($plan->is_popular == 1) : ?>
                                                                <div class="ribbon ribbon-top-right"><span><?= trans("popular"); ?></span></div>
                                                            <?php endif; ?>
                                                            <div class="price-box-inner">
                                                                <div class="pricing-name text-center">
                                                                    <h4 class="name font-600"><?= get_membership_plan_name($plan->title_array, $this->selected_lang->id); ?></h4>
                                                                </div>
                                                                <div class="plan-price text-center">
                                                                    <h3><strong class="price font-600">
                                                                            <?php if ($plan->price == 0) :
                                                                                echo trans("free");
                                                                            else :
                                                                                echo price_formatted($plan->price, $this->payment_settings->default_product_currency);
                                                                            endif; ?>
                                                                        </strong>
                                                                    </h3>
                                                                </div>
                                                                <div class="price-features">
                                                                    <?php $features = get_membership_plan_features($plan->features_array, $this->selected_lang->id);
                                                                    if (!empty($features)) :
                                                                        foreach ($features as $feature) : ?>
                                                                            <p>
                                                                                <i class="icon-check-thin"></i>
                                                                                <?= html_escape($feature); ?>
                                                                            </p>
                                                                    <?php endforeach;
                                                                    endif; ?>
                                                                </div>
                                                                <div class="text-center btn-plan-pricing-container">
                                                                    <?php if ($request_type == "renew") : ?>
                                                                        <button type="submit" name="plan_id" value="<?= $plan->id; ?>" class="btn btn-md btn-pricing-table"><?= trans("choose_plan"); ?></button>
                                                                    <?php elseif ($request_type == "new") : ?>
                                                                        <a href="<?= lang_base_url() . 'start_selling'; ?>?plan=<?= $plan->id; ?>" class="btn btn-md btn-pricing-table"><?= trans("choose_plan"); ?></a>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="price-box-container">
                                                <?php foreach ($membership_plans as $plan) :?>
                                                        <div class="price-box">
                                                            <?php if ($plan->is_popular == 1) : ?>
                                                                <div class="ribbon ribbon-top-right"><span><?= trans("popular"); ?></span></div>
                                                            <?php endif; ?>
                                                            <div class="price-box-inner">
                                                                <div class="pricing-name text-center">
                                                                    <h4 class="name font-600"><?= get_membership_plan_name($plan->title_array, $this->selected_lang->id); ?></h4>
                                                                </div>
                                                                <div class="plan-price text-center">
                                                                    <h3><strong class="price font-600">
                                                                            <?php if ($plan->price == 0) :
                                                                                echo trans("free");
                                                                            else :
                                                                                echo price_formatted($plan->price, $this->payment_settings->default_product_currency);
                                                                            endif; ?>
                                                                        </strong>
                                                                    </h3>
                                                                </div>
                                                                <div class="price-features">
                                                                    <?php $features = get_membership_plan_features($plan->features_array, $this->selected_lang->id);
                                                                    if (!empty($features)) :
                                                                        foreach ($features as $feature) : ?>
                                                                            <p>
                                                                                <i class="icon-check-thin"></i>
                                                                                <?= html_escape($feature); ?>
                                                                            </p>
                                                                    <?php endforeach;
                                                                    endif; ?>
                                                                </div>
                                                                <div class="text-center btn-plan-pricing-container">
                                                                    <?php if ($request_type == "renew") : ?>
                                                                        <button type="submit" name="plan_id" value="<?= $plan->id; ?>" class="btn btn-md btn-pricing-table"><?= trans("choose_plan"); ?></button>
                                                                    <?php elseif ($request_type == "new") : ?>
                                                                        <a href="<?= lang_base_url() . 'start_selling'; ?>?plan=<?= $plan->id; ?>" class="btn btn-md btn-pricing-table"><?= trans("choose_plan"); ?></a>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                            <?php endif;
                            endif; ?>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Wrapper End-->