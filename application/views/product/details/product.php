<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php

$firstcat = reset($categories);
$endcat = end($categories);
$prevcat = prev($categories);

?>

<style>
	.btn-shadow {
		box-shadow: 0px 0px 0.2px 0.3px #00000040 !important;
	}

	.cat-header a.text-white.textcat-header.text-center {
		color: white;
		line-height: 2.7;
		font-size: 23px;
		display: inline-block;
		width: 100%;
		text-indent: -60px;
	}

	.cat-header {
		height: 58px;
		color: white !important;
		background: #f5f5f5;
		/* margin-bottom: 86px; */
		float: none;
	}


	.ads_preview_btn {
		font-size: 16px;
		color: #222 !important;
		font-weight: bold
	}

	.top-search-bar .left {
		vertical-align: middle;
	}

	@media (max-width: 992px) {
		#wrapper {
			padding-top: 0;
		}
	}
</style>


<div class="d-none">

	<?php
	$data = array(
		'method' => 'get',
		'id' => 'formsearchzolmarket'
	);
	echo form_open(lang_base_url() . 'products', $data);
	?>
	<?php $search = trim($this->input->get('search', TRUE)); ?>
	<input type="search" value="<?php echo html_escape($search); ?>" name="search" id="ysfhkm_search" placeholder="<?php echo trans("search"); ?>....">

	<?php echo form_close(); ?>
</div>

<div class="top-search-bar mobile-search-form cat-header" style="padding: 5px !important;">
	<?php
	$placeholder = trans("search");
	if ($this->agent->referrer() ==  base_url()) {
		if (isset($categories) && !empty($categories) && $page != "product") :
	?>
			<div class="left" style="text-align: left">
				<?php $placeholder = trans("search");
				if ($firstcat->id != $endcat->id) : $placeholder = $product->title; ?>
					<a href="javascript:void(0)" class="ads_preview_btn"><i class="icon-arrow-left"></i> <?php echo trans("back"); ?>
					</a>
				<?php else : $placeholder = $product->title; ?>
					<a href="javascript:void(0)" class="ads_preview_btn"><i class="icon-arrow-left"></i> <?php echo trans("back"); ?>
					</a>
				<?php endif; ?>

			</div>
		<?php
		else : ?>
			<div class="left" style="text-align: left">
				<a href="javascript:void(0)" class="ads_preview_btn"><i class="icon-arrow-left"></i> <?php echo trans("back"); ?>
				</a>

			</div>
		<?php
		endif;
	} else { ?>
		<div class="left" style="text-align: left">
			<a href="javascript:void(0)" class="ads_preview_btn"><i class="icon-arrow-left"></i> <?php echo trans("back"); ?>
			</a>
		</div>
	<?php
	}
	?>
	<div class="right " style="padding-right: 20px;">
		<input type="text" oninput="this.form.search.value = this.value" form="formsearchzolmarket" autocomplete="off" maxlength="300" data-url="menu_search" data-query="" pattern=".*\S+.*" data-window="SearchWindowFilter" class="form-control input-search w-100 has-search-product" value="<?php echo (!empty($filter_search)) ? $filter_search : ''; ?>" placeholder="<?php echo html_escape($placeholder); ?>" style="padding-top:10px">
		<button type="submit" form="form-product-filters" class="btn btn-default btn-search" style="right: 15px"><i class="icon-search"></i></button>
	</div>
</div>

<!-- Wrapper -->
<div id="wrapper" style="padding-top: 66px;">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<nav class="nav-breadcrumb" aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo lang_base_url(); ?>"><?php echo trans("home"); ?></a></li>
						<?php if ($page != "product") : ?>
							<?php foreach ($categories as $category) : ?>
								<?php if ($category->id != $endcat->id) : ?>
									<li class="breadcrumb-item"><a href="<?php echo generate_category_url($category); ?>">
											<?php echo html_escape($category->name); ?></a>
									</li>

								<?php else : ?>
									<li class="breadcrumb-item">
										<?php echo html_escape($category->name); ?>
									</li>
								<?php endif; ?>
							<?php endforeach; ?>
						<?php else : ?>
							<li class="breadcrumb-item active" aria-current="page"><?php echo trans("products"); ?></li>
						<?php endif; ?>
					</ol>
				</nav>
			</div>
		</div>

		<div class="row">
			<div class="col-12">

				<div class="row row-product-details">
					<div class="col-12 col-sm-12 col-md-7 col-lg-8">
						<div class="product-content-left">
							<div class="row">
								<!-- <div class="col-12"> -->
								<?php $this->load->view("product/details/_preview"); ?>
								<!-- </div> -->
							</div>

							<div class="row">
								<div class="col-12">
									<div class="product-content-details product-content-details-mobile" style="display: none">
										<?php $this->load->view("product/details/_product_details_mobile"); ?>
									</div>
								</div>
							</div>
							<div class="row hidden-row">
								<div class="col-12">
									<div style="display: flex;">
										<div class="" style="flex: 1">
											<?php if ($general_settings->product_reviews == 1) : ?>
												<div class="row-custom review-link" style="display: flex">
													<label class="label-review" style="margin-right: 5px;"><?php echo trans("reviews"); ?></label>
													<!--stars-->
													<?php $this->load->view('partials/_review_stars', ['review' => $product->rating]); ?>
													<?php if ($review_count > 0) : ?>
														<span style="margin-top: 1px">(<?php echo $review_count; ?>)</span>
													<?php else : ?>
														<span style="margin-top: 1px">(0)</span>
													<?php endif; ?>
												</div>
											<?php endif; ?>
										</div>
										<div class="" style="flex-direction: row; align-items: flex-end">
											<?php if ($general_settings->product_comments == 1) : ?>
												<div class="row-custom comment-link">
													<?php if ($comment_count > 0) : ?>
														<span>(<?php echo $comment_count; ?>)</span>
													<?php else : ?>
														<span>(0)</span>
													<?php endif; ?>
													<label class="label-comment"><?php echo trans("comments"); ?></label>
												</div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
							<div class="product-description-container hidden-row">
								<?php $this->load->view("product/details/_description"); ?>
							</div>

							<div class="row">
								<div class="col-12">
									<?php if ($general_settings->product_reviews == 1 || $general_settings->product_comments == 1 || $general_settings->facebook_comment_status == 1) : ?>
										<div class="product-reviews">
											<!-- Nav tabs -->
											<ul class="nav nav-tabs" id="review-comment">
												<?php if ($general_settings->product_reviews == 1) : ?>
													<li class="nav-item">
														<a class="nav-link review-nav-link active" data-toggle="tab" href="#reviews"><?php echo trans("reviews"); ?></a>
													</li>
												<?php endif; ?>
												<?php if ($general_settings->product_comments == 1) : ?>
													<li class="nav-item">
														<a class="nav-link comment-nav-link <?php echo ($general_settings->product_reviews != 1) ? 'active' : ''; ?>" data-toggle="tab" href="#comments">
															<?php echo trans("comments"); ?>
														</a>
													</li>
												<?php endif; ?>
												<?php if ($general_settings->facebook_comment_status == 1) : ?>
													<li class="nav-item">
														<a class="nav-link <?php echo ($general_settings->product_reviews != 1 && $general_settings->product_comments != 1) ? 'active' : ''; ?>" data-toggle="tab" href="#facebook_comments">
															<?php echo trans("facebook_comments"); ?>
														</a>
													</li>
												<?php endif; ?>
											</ul>
											<!-- Tab panes -->
											<div class="tab-content">
												<?php if ($general_settings->product_reviews == 1) : ?>
													<div class="tab-pane container active" id="reviews">
														<!-- include reviews -->
														<div id="review-result">
															<?php $this->load->view('product/details/_make_review'); ?>
														</div>
													</div>
												<?php endif; ?>
												<?php if ($general_settings->product_comments == 1) : ?>
													<div class="tab-pane container <?php echo ($general_settings->product_reviews != 1) ? 'active' : 'fade'; ?>" id="comments">
														<!-- include comments -->
														<?php $this->load->view('product/details/_make_comment'); ?>
														<div id="comment-result">
															<?php $this->load->view('product/details/_comments'); ?>
														</div>
													</div>
												<?php endif; ?>
												<?php if ($general_settings->facebook_comment_status == 1) : ?>
													<div class="tab-pane container <?php echo ($general_settings->product_reviews != 1 && $general_settings->product_comments != 1) ? 'active' : 'fade'; ?>" id="facebook_comments">
														<div class="fb-comments" data-href="<?php echo current_url(); ?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
													</div>
												<?php endif; ?>
											</div>
										</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>

					<div class="col-12 col-sm-12 col-md-5 col-lg-4">
						<div class="product-content-right">
							<div class="row">
								<div class="col-12">
									<div class="product-content-details">
										<?php $this->load->view("product/details/_product_details"); ?>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-12">
									<?php $this->load->view("product/details/_seller"); ?>
								</div>
							</div>

							<div class="row">
								<div class="col-12">
									<?php if (!empty($product->country_id)) : ?>
										<div class="widget-location">
											<h4 class="sidebar-title"><?php echo trans("location"); ?></h4>
											<div class="sidebar-map">
												<!--load map-->
												<iframe src="https://maps.google.com/maps?width=100%&height=600&hl=en&q=<?php echo get_location($product); ?>&ie=UTF8&t=&z=8&iwloc=B&output=embed&disableDefaultUI=true" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
											</div>
										</div>
									<?php endif; ?>
								</div>
							</div>

							<div class="row">
								<div class="col-12">
									<div class="row-custom">
										<!--Include banner-->
										<?php $this->load->view("partials/_ad_spaces_sidebar", ["ad_space" => "product_sidebar", "class" => "m-b-5"]); ?>
									</div>
								</div>
							</div>


						</div>

					</div>
				</div>
			</div>

			<div class="col-12">
				<div class="related-products">
					<h4 class="section-title"><?php echo trans("related_products"); ?></h4>
					<div class="row row-product">
						<!--print related posts-->
						<?php
						$count = 0;
						foreach ($related_products as $item) :
							if ($count < 4) :
								$item = @(object)$item;
								if (!empty($item)) : ?>
									<?php $this->load->view('product/_product_item', ['product' => $item]); ?>
						<?php endif;
							endif;
							$count++;
						endforeach; ?>
					</div>
				</div>
			</div>

		</div>

		<!-- filter and menu -->
		<div class="ajax-filter-menu">
			<div class="navCatDownMobile nav-mobile" id="SearchWindowFilter" style="margin-left: 105%;top:60px;height: calc(100% - 58px - 60px);">
				<div class="nav-mobile-inner">
					<ul class="navbar-nav top-search-bar mobile-search-form">

					</ul>
				</div>
			</div>

		</div>

	</div>
</div>
<!-- Wrapper End-->

<!-- include send message modal -->
<?php $this->load->view("partials/_modal_send_message", ["subject" => $product->title, "slug" => $product->slug]); ?>
<?php $this->load->view("partials/_modal_image_preview", ["images" => $product_images]); ?>
<script>
	$(".fb-comments").attr("data-href", window.location.href);
</script>
<?php
if ($general_settings->facebook_comment_status == 1) {
	echo $general_settings->facebook_comment;
} ?>

<script src="<?php echo base_url(); ?>assets/vendor/touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script>
	$("#quantity_touchspin").TouchSpin({
		min: 1,
		max: <?php echo $product->quantity; ?>,
		verticalbuttons: true,
		verticalupclass: 'icon-arrow-up',
		verticaldownclass: 'icon-arrow-down'
	});
	$("#quantity_touchspin").change(function() {
		var count = $(this).val();
		$("#form_add_cart input[name='product_quantity']").val(count);
	});
	$("#quantity_touchspin_mobile").TouchSpin({
		min: 1,
		max: <?php echo $product->quantity; ?>,
		verticalbuttons: true,
		verticalupclass: 'icon-arrow-up',
		verticaldownclass: 'icon-arrow-down'
	});
	$("#quantity_touchspin_mobile").change(function() {
		var count = $(this).val();
		$("#form_add_cart_mobile input[name='product_quantity']").val(count);
	});
</script>

<!-- Plyr JS-->
<script src="<?php echo base_url(); ?>assets/vendor/plyr/plyr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/plyr/plyr.polyfilled.min.js"></script>
<script>
	const player = new Plyr('#player');
	$(document).ajaxStop(function() {
		const player = new Plyr('#player');
	});
	const audio_player = new Plyr('#audio_player');
	$(document).ajaxStop(function() {
		const player = new Plyr('#audio_player');
	});
	$(document).ready(function() {
		let link = localStorage.getItem("view_link");
		setTimeout(function() {
			if (link == "add_comment")
				$(".comment-link").trigger("click");
			else if (link == "add_review")
				$(".review-link").trigger("click");
		}, 100)
	})
</script>

<script>
	$(function() {
		$('.product-description iframe').wrap('<div class="embed-responsive embed-responsive-16by9"></div>');
		$('.product-description iframe').addClass('embed-responsive-item');
	});
</script>