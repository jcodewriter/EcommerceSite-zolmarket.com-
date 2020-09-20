<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- File Manager -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/file-manager/file-manager.css">
<script src="<?php echo base_url(); ?>assets/vendor/file-manager/file-manager.js"></script>
<!-- Ckeditor js -->
<script src="<?php echo base_url(); ?>assets/vendor/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/ckeditor/lang/<?php echo $this->selected_lang->ckeditor_lang; ?>.js"></script>

<div class="hkm_messages_navCatDownMobile">
	<div class="cat-header">
		<div class="mobile-header-back">
			<a href="<?php echo lang_base_url(); ?>" class="btn-back-mobile-nav ads_preview_btn"> <i class="icon-arrow-left"></i> <?php echo trans("back"); ?> </a>
		</div>
		<div class="mobile-header-title">
			<span class="text-white textcat-header text-center"><?php echo trans("sell_now"); ?></span>
		</div>
		<div class="mobilde-header-cart">
			<a href="<?php echo lang_base_url(); ?>cart">
				<span style="font-size: 18px;">
					<i class="fa icon-cart"></i>
				</span>
				<?php $cart_product_count = get_cart_product_count();
				if ($cart_product_count > 0) : ?>
					<span class="notification"><?php echo $cart_product_count; ?></span>
				<?php endif; ?>
			</a>
		</div>
	</div>
</div>
<!-- Wrapper -->
<div id="wrapper">
	<div id="progressbar-wrapper">
		<div class="progressbar-valuetext">0%</div>
		<div class="progress">
			<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%"></div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div id="content" class="col-12">
				<nav class="nav-breadcrumb" aria-label="breadcrumb">
					<ol class="breadcrumb"></ol>
				</nav>
				<h1 class="page-title page-title-product page_title_hidden_on_mobile"><?php echo trans("sell_now"); ?></h1>
				<div class="form-add-product">
					<div class="row justify-content-center">
						<div class="col-12 col-md-12 col-lg-11">
							<div class="row">
								<div class="col-12">
									<!-- include message block -->
									<?php $this->load->view('product/_messages'); ?>
								</div>
							</div>

							<div class="row">
								<div class="col-12">
									<?php echo form_open('product_controller/add_product_post', ['id' => 'form_validate', 'onkeypress' => "return event.keyCode != 13;"]); ?>
									<input type="hidden" name="form_lang_base_url" value="<?= lang_base_url() ?>" />
									<?php if ($general_settings->physical_products_system == 1 && $general_settings->digital_products_system == 0) : ?>
										<input type="hidden" name="product_type" value="physical">
									<?php elseif ($general_settings->physical_products_system == 0 && $general_settings->digital_products_system == 1) : ?>
										<input type="hidden" name="product_type" value="digital">
									<?php else : ?>
										<div class="form-box">
											<div class="form-box-head">
												<h4 class="title"><?php echo trans('product_type'); ?></h4>
											</div>
											<div class="form-box-body">
												<div class="form-group">
													<div class="row">
														<?php if ($general_settings->physical_products_system == 1) : ?>
															<div class="col-12 col-sm-6 col-option">
																<div class="custom-control custom-radio">
																	<input type="radio" name="product_type" value="physical" id="product_type_1" class="custom-control-input" checked required>
																	<label for="product_type_1" class="custom-control-label"><?php echo trans('physical'); ?></label>
																	<p class="form-element-exp"><?php echo trans('physical_exp'); ?></p>
																</div>
															</div>
														<?php endif; ?>
														<?php if ($general_settings->digital_products_system == 1) : ?>
															<div class="col-12 col-sm-6 col-option">
																<div class="custom-control custom-radio">
																	<input type="radio" name="product_type" value="digital" id="product_type_2" class="custom-control-input" <?php echo ($general_settings->physical_products_system != 1) ? 'checked' : ''; ?> required>
																	<label for="product_type_2" class="custom-control-label"><?php echo trans('digital'); ?></label>
																	<p class="form-element-exp"><?php echo trans('digital_exp'); ?></p>
																</div>
															</div>
														<?php endif; ?>
													</div>
												</div>
											</div>
										</div>
									<?php endif; ?>

									<?php if ($active_product_system_array['active_system_count'] > 1) : ?>
										<div class="form-box">
											<div class="form-box-head">
												<h4 class="title"><?php echo trans('listing_type'); ?></h4>
											</div>
											<div class="form-box-body">
												<div class="form-group">
													<div class="row">
														<?php if ($general_settings->marketplace_system == 1) : ?>
															<div class="col-12 col-sm-6 col-option listing_sell_on_site">
																<div class="custom-control custom-radio">
																	<input type="radio" name="listing_type" value="sell_on_site" id="listing_type_1" class="custom-control-input" checked required>
																	<label for="listing_type_1" class="custom-control-label"><?php echo trans('add_product_for_sale'); ?></label>
																	<p class="form-element-exp"><?php echo trans('add_product_for_sale_exp'); ?></p>
																</div>
															</div>
														<?php endif; ?>
														<?php if ($general_settings->classified_ads_system == 1) : ?>
															<div class="col-12 col-sm-6 col-option listing_ordinary_listing">
																<div class="custom-control custom-radio">
																	<input type="radio" name="listing_type" value="ordinary_listing" id="listing_type_2" class="custom-control-input" <?php echo ($general_settings->marketplace_system != 1) ? 'checked' : ''; ?> required>
																	<label for="listing_type_2" class="custom-control-label"><?php echo trans('add_product_services_listing'); ?></label>
																	<p class="form-element-exp"><?php echo trans('add_product_services_listing_exp'); ?></p>
																</div>
															</div>
														<?php endif; ?>
														<?php if ($general_settings->bidding_system == 1) : ?>
															<div class="col-12 col-sm-6 col-option listing_bidding">
																<div class="custom-control custom-radio">
																	<input type="radio" name="listing_type" value="bidding" id="listing_type_3" class="custom-control-input" required>
																	<label for="listing_type_3" class="custom-control-label"><?php echo trans('add_product_get_price_requests'); ?></label>
																	<p class="form-element-exp"><?php echo trans('add_product_get_price_requests_exp'); ?></p>
																</div>
															</div>
														<?php endif; ?>
													</div>
												</div>
											</div>
										</div>
									<?php else : ?>
										<input type="hidden" name="listing_type" value="<?php echo $active_product_system_array['active_system_value']; ?>">
									<?php endif; ?>

									<div class="form-box">
										<div class="form-box-head">
											<h4 class="title"><?php echo trans('details'); ?></h4>
										</div>
										<div class="form-box-body">
											<div id="item-wrapper">
												<div class="item-head-wrapper"></div>
												<div class="item-body-wrapper">
													<div class="item-body-header hidden">
														<div class="btn btn-outline btn-back">Back</div>
														<div class="item-body-header-text"></div>
														<!-- <div class="btn btn-custom btn-next">Next</div> -->
													</div>
													<div class="item-body-content">

													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="form-group">
										<button type="submit" class="btn btn-lg btn-custom float-right"><?php echo trans("save_and_continue"); ?></button>
									</div>

									<?php echo form_close(); ?>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Wrapper End-->

<script>
	var categories = []
	var selectedValue = {}
	$(document).ready(function() {
		getData(0, -1, "category")
	})
	// maincategory
	$(document).on("click", '.item-body-content .main-category-item', function(event) {
		let cid = $(this).attr("key")
		let type = $(this).attr("type")
		let pid = $(this).attr("parent_id")
		$(this).clone().appendTo(".item-head-wrapper")
		$(".item-body-header-text").text("SubCategory")
		categories.push(pid)
		getData(cid, pid, type)
		$(".item-body-wrapper").css({
			boxShadow: "1px 1px 3px 1px #e4e4e4",
			borderRadius: "5px",
			padding: "10px",
		})
		$(".item-body-header").removeClass("hidden")
	})

	$(document).on("click", '.item-head-wrapper .main-category-item', function(event) {
		getData(0, 0, "category")
	})
	// subcategory
	$(document).on("click", '.item-body-content .sub-category-item', function(event) {
		let cid = $(this).attr("key")
		let type = $(this).attr("type")
		let pid = $(this).attr("parent_id")
		categories.push(pid)
		getData(cid, pid, type)
	})
	// back button
	$(document).on("click", '.btn-back', function(event) {
		let cid = $(this).attr("parent_id")
		let type = $(this).attr("type")
		if (type == "custom") {
			let selector = $(this).attr("back")
			$(this).parent().parent().addClass("hidden")
			$(`.${selector}`).removeClass("hidden")

			if (selector == "prev") {
				getData(categories[categories.length - 1], categories[categories.length - 2], "category")
				categories.splice(-1, 1)
				$(".item-body-header-text").text("SubCategory")
			}
			// delete selectedValue[selfSel];
		} else if (type == "category") {
			categories.splice(-1, 1)
			if (selectedValue["category_id"])
				delete selectedValue["category_id"]
			getData(cid, categories[categories.length - 1], type)
		}
	})
	// next button
	$(document).on("click", '.btn-next', function(event) {
		let selector = $(this).attr("next")
		$(this).parent().parent().addClass("hidden")
		$(`.${selector}`).removeClass("hidden")
		console.log(selector)
	})
	// customfield
	$(document).on("click", ".custom-field-wrapper .custom-field-item", function(event) {
		let selector = $(this).attr("next")
		$(this).parent().parent().parent().addClass("hidden")
		$(`.${selector}`).removeClass("hidden")

		if (selector == "end") {
			$('.progress-bar').attr('aria-valuenow', 40).css({
				width: '40%'
			})
			$('.progressbar-valuetext').text("40%")
		}

		selectedValue[selector] = $(this).attr("key")
	})

	function getData(cid, pid, type) {
		// let form_data = new FormData();
		// form_data.append("c_id", cid);
		// form_data.append("type", type);
		// form_data.append(csfr_token_name, $.cookie(csfr_cookie_name));
		// $.ajax({
		// 	type: "POST",
		// 	url: "Product_controller/get_choose_items",
		// 	data: form_data,
		// 	contentType: false,
		// 	cache: false,
		// 	processData: false,
		// 	success: function(response) {
		// 		let data = JSON.parse(response);
		// 		if (data.type == "category") {
		// 			if (cid > 0) {
		// 				makeSubCategory(pid, data.result)
		// 			} else {
		// 				$(".item-head-wrapper").children().remove()
		// 				categories = []
		// 				makeMainCategory(data.result)
		// 				$(".item-body-wrapper").css({
		// 					boxShadow: "none",
		// 					borderRadius: "none",
		// 					padding: 0
		// 				})
		// 			}
		// 		} else {
		// 			$('.progress-bar').attr('aria-valuenow', 20).css({
		// 				width: '20%'
		// 			})
		// 			$('.progressbar-valuetext').text("20%")
		// 			selectedValue["category_id"] = pid
		// 			makeCustomField(pid, data.result)
		// 		}
		// 	}
		// });

		$.ajax({
			type: "GET",
			url: "https://www.alsoug.com/en/adverts/get-search",
			success: function(response) {
				console.log(response)
			}
		});
	}

	function makeMainCategory(jsonData) {
		$(".item-body-wrapper").children().remove()
		let htmlItem = `<div class="item-body-header hidden">
						</div>
						<div class="item-body-content">`
		jsonData.map((item) => {
			htmlItem += `
								<div class="main-category-item" key="${item.id}" type="category" parent_id="${item.parent_id}" >
									<div class="item-icon">
										<img src="${item.image_2}" />
									</div>
									<div class="item-content">
										<span class="title">${item.name}</span>
										<span class="content">${item.description}</span>
									</div>
								</div>`
		})
		htmlItem += `</div>`
		$(".item-body-wrapper").append(htmlItem)
	}

	function makeSubCategory(pid, jsonData) {
		$(".item-body-wrapper").children().remove()
		let htmlItem = `<div class="item-body-header">
							<div class="btn btn-outline btn-back" type="category" parent_id="${pid}">Back</div>
							<div class="item-body-header-text">SubCategory</div>
						</div>
						<div class="item-body-content">`
		jsonData.map((item) => {
			htmlItem += `<div class="sub-category-item" key="${item.id}" type="category" parent_id="${item.parent_id}" >
							<div class="item-icon">
								<img src="${item.icon}" />
							</div>
							<div class="item-content">
								<span class="title">${item.name}</span>
							</div>
							<div class="item-arrow">
								<i class="fa fa-angle-right" aria-hidden="true"></i>
							</div>
						</div>`
		})
		htmlItem += `</div>`
		$(".item-body-wrapper").append(htmlItem)
	}

	function makeCustomField(pid, jsonData) {
		$(".item-body-wrapper").children().remove()
		jsonData.map((item, key) => {
			console.log(jsonData)
			let htmlItem = `<div class=" ${item.product_filter_key}_${item.id} ${key>0?"hidden":""}">`
			if (item.field_type == "textarea" || item.field_type == "text" || item.field_type == "number" || item.field_type == "date" || item.field_type == "checkbox") {
				htmlItem += `<div class="item-body-header">
					<div class="btn btn-outline btn-back" back="${jsonData[key-1]? jsonData[key-1].product_filter_key+"_"+jsonData[key-1].id: "prev"}" type="custom">Back</div>
					<div class="item-body-header-text">${item.name}</div>
					<div class="btn btn-custom btn-next" next="${jsonData[key+1]?jsonData[key+1].product_filter_key+"_"+jsonData[key+1].id:"next"}">Next</div>
				</div>`
			} else {
				if (item.is_required == 0) {
					htmlItem += `<div class="item-body-header">
						<div class="btn btn-outline btn-back" back="${jsonData[key-1]? jsonData[key-1].product_filter_key+"_"+jsonData[key-1].id: "prev"}" type="custom">Back</div>
						<div class="item-body-header-text">${item.name}</div>
						<div class="btn btn-custom btn-next" next="${jsonData[key+1]?jsonData[key+1].product_filter_key+"_"+jsonData[key+1].id:"next"}">Next</div>
					</div>`
				} else {
					htmlItem += `<div class="item-body-header">
						<div class="btn btn-outline btn-back" back="${jsonData[key-1]? jsonData[key-1].product_filter_key+"_"+jsonData[key-1].id: "prev"}" type="custom">Back</div>
						<div class="item-body-header-text">${item.name}</div>
					</div>`
				}
			}
			htmlItem += `<div class="item-body-content"><div class="custom-field-wrapper" title="${item.name}" custom-field-id="${item.id}">`
			if (item.field_type == "textarea") {
				htmlItem += `<textarea name="description" placeholder="Description" id="form-textarea" class="text-editor valid" style="border: 1px solid rgb(209, 209, 209); height: 209px; width: 100%; max-height: 200px; min-height: 200px; padding: 20px; color: rgb(73, 73, 73); margin-top: 0px; margin-bottom: 0px;" aria-invalid="false"></textarea>`
			} else if (item.field_type == "text" || item.field_type == "date") {
				htmlItem += `<input type="text" name="${item.product_filter_key}_${item.id}" class="form-control form-input" value="" placeholder="${item.name}">`
			} else if (item.field_type == "number") {
				htmlItem += `<input type="number" name="${item.product_filter_key}_${item.id}" class="form-control form-input" value="" placeholder="${item.name}" min="0" max="999999999">`
			} else if (item.field_type == "checkbox") {
				item.data.map((subItem) => {
					htmlItem += `<div class="custom-field-checkbox-item" key="${subItem.id}" type="category">
									<div class="item-content">
										<div class="custom-control custom-checkbox custom-control-validate-input label_validate_field_38">
											<input type="checkbox" class="custom-control-input" id="form_checkbox_${subItem.id}" name="field_38[]" value="${subItem.common_id}">
											<label class="custom-control-label" for="form_checkbox_${subItem.id}">${subItem.field_option}</label>
										</div>
									</div>
								</div>`
				})
			} else {
				item.data.map((subItem) => {
					htmlItem += `<div class="custom-field-item" key="${subItem.id}" type="category" next="${jsonData[key+1]?jsonData[key+1].product_filter_key+"_"+jsonData[key+1].id:"next"}">
									<div class="item-content">
										<span class="title">${subItem.field_option}</span>
									</div>
									<div class="item-arrow">
										<i class="fa fa-angle-right" aria-hidden="true"></i>
									</div>
								</div>`
				})
			}
			htmlItem += `</div></div></div>`

			$(".item-body-wrapper").append(htmlItem)
		})
	}

	$(document).scroll(function() {
		if ($(this).scrollTop()) {
			$("#progressbar-wrapper").css({
				position: "fixed",
				top: 60
			})
		} else {
			$("#progressbar-wrapper").css("position", "initial")
		}
	})
</script>