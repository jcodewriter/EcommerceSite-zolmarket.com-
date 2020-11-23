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
								<div class="col-12 m-b-30">
									<label class="control-label font-600"><?php echo trans("images"); ?></label>
									<?php $this->load->view("product/_image_upload_box"); ?>
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
											<div class="form-group">
												<label class="control-label"><?php echo trans("title"); ?></label>
												<input type="text" style="height:50px" name="title" class="form-control form-input" placeholder="<?php echo trans("title"); ?>" required>
											</div>

											<div class="form-group">
												<label class="control-label"><?php echo trans("category"); ?></label>
												<div class="hidden-row">
													<div id="listcategories" class="selectdiv">

														<select id="cat_0" name="second_parent_id[0]" class="form-control" onchange="get_subcategories(this,0);" required>
															<option value=""><?php echo trans('select_category'); ?></option>
															<?php foreach ($parent_categories as $item) : ?>
																<option value="<?php echo html_escape($item->id); ?>"><?php echo html_escape($item->name); ?></option>
															<?php endforeach; ?>
														</select>
													</div>
												</div>
												<div id="mobile_listcategories" class="mobile_selectdiv">
													<button class="filter-btn text-truncate has-menu d-flex mobile-popup__button" type="button" data-ajax="0" data-type="mobilecat" data-url="special_categories">
														<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 298 298" style="width: 18px" xml:space="preserve">
															<path d="M117.5,0h-101c-8.822,0-16,7.178-16,16v101c0,8.822,7.178,16,16,16h101c8.822,0,16-7.178,16-16V16 C133.5,7.178,126.322,0,117.5,0z" />
															<path d="M281.5,0h-101c-8.822,0-16,7.178-16,16v101c0,8.822,7.178,16,16,16h101c8.822,0,16-7.178,16-16V16 C297.5,7.178,290.322,0,281.5,0z" />
															<path d="M117.5,165h-101c-8.822,0-16,7.178-16,16v101c0,8.822,7.178,16,16,16h101c8.822,0,16-7.178,16-16V181 C133.5,172.178,126.322,165,117.5,165z" />
															<path d="M281.5,165h-101c-8.822,0-16,7.178-16,16v101c0,8.822,7.178,16,16,16h101c8.822,0,16-7.178,16-16V181 C297.5,172.178,290.322,165,281.5,165z" />
														</svg>
														<span class="flex-fill text-truncate text-left special-cagetory" style="padding-left:5px"><?php echo trans('select_category'); ?></span>
														<i class="icon-arrow-right"></i>
													</button>
												</div>
												<input type="hidden" name="custom_id" class="form-control form-input" id="category_id" value="" />
											</div>

											<div class="form-group">
												<label class="control-label"><?php echo trans("description"); ?></label>
												<!-- <div class="row">
													<div class="col-sm-12 m-b-5">
														<button type="button" class="btn btn-sm btn-secondary color-white btn_ck_add_image m-b-5"><i class="icon-image"></i><?php echo trans("add_image"); ?></button>
														<button type="button" class="btn btn-sm btn-info color-white btn_ck_add_video m-b-5"><i class="icon-image"></i><?php echo trans("add_video"); ?></button>
														<button type="button" class="btn btn-sm btn-warning color-white btn_ck_add_iframe m-b-5"><i class="icon-image"></i><?php echo trans("add_iframe"); ?></button>
													</div>
												</div> -->
												<textarea name="description" placeholder="<?php echo trans("description"); ?>" id="form-textarea" class="text-editor" style="border: 1px solid #d1d1d1; height:200px; width:100%; max-height:200px;min-height:200px;padding:20px;color:#494949;"></textarea>
											</div>

										</div>
									</div>

									<div class="form-group">
										<button type="submit" class="btn btn-lg btn-custom float-right"><?php echo trans("save_and_continue"); ?></button>
									</div>

									<div class="ajax-filter-menu">
										<div class="navCatDownMobile nav-mobile" id="filter1" style="margin-left: 105%;">
											<div class="form-group cat-header">
												<a href="javascript:void(0)" data-back="normal" class="btn-back-mobile-nav"><i class="icon-arrow-left"></i> <?= trans('back') ?></a>
												<a href="javascript:void(0)" class="text-white textcat-header text-center"><?= trans('filter') ?></a>
											</div>
											<div class="nav-mobile-inner">
											</div>
										</div>
										<div class="navCatDownMobile nav-mobile" id="SearchWindowFilter" style="margin-left: 105%;top:58px;height: calc(100% - 58px - 60px);">
											<div class="nav-mobile-inner">
												<ul class="navbar-nav top-search-bar mobile-search-form">

												</ul>
											</div>
										</div>

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
<?php $this->load->view("product/_file_manager_ckeditor"); ?>

<!-- Ckeditor -->
<script>
	var ckEditor = document.getElementById('ckEditor');
	if (ckEditor != undefined && ckEditor != null) {
		CKEDITOR.replace('ckEditor', {
			language: '<?php echo $this->selected_lang->ckeditor_lang; ?>',
			filebrowserBrowseUrl: 'path',
			removeButtons: 'Save',
			allowedContent: true,
			extraPlugins: 'videoembed,oembed'
		});
	}

	function selectFile(fileUrl) {
		window.opener.CKEDITOR.tools.callFunction(1, fileUrl);
	}

	CKEDITOR.on('dialogDefinition', function(ev) {
		var editor = ev.editor;
		var dialogDefinition = ev.data.definition;

		// This function will be called when the user will pick a file in file manager
		var cleanUpFuncRef = CKEDITOR.tools.addFunction(function(a) {
			$('#ckFileManagerModal').modal('hide');
			CKEDITOR.tools.callFunction(1, a, "");
		});
		var tabCount = dialogDefinition.contents.length;
		for (var i = 0; i < tabCount; i++) {
			var browseButton = dialogDefinition.contents[i].get('browse');
			if (browseButton !== null) {
				browseButton.onClick = function(dialog, i) {
					editor._.filebrowserSe = this;
					var iframe = $('#ckFileManagerModal').find('iframe').attr({
						src: editor.config.filebrowserBrowseUrl + '&CKEditor=body&CKEditorFuncNum=' + cleanUpFuncRef + '&langCode=en'
					});
					$('#ckFileManagerModal').appendTo('body').modal('show');
				}
			}
		}
	});

	CKEDITOR.on('instanceReady', function(evt) {
		$(document).on('click', '.btn_ck_add_image', function() {
			if (evt.editor.name != undefined) {
				evt.editor.execCommand('image');
			}
		});
		$(document).on('click', '.btn_ck_add_video', function() {
			if (evt.editor.name != undefined) {
				evt.editor.execCommand('videoembed');
			}
		});
		$(document).on('click', '.btn_ck_add_iframe', function() {
			if (evt.editor.name != undefined) {
				evt.editor.execCommand('iframe');
			}
		});
	});
	$(document).ready(function() {
		if ($(this).width() < 500) {
			$("form").submit(function(e) {
				if (!$('#category_id').val()) {
					$('.filter-btn').css({
						'border-width': '1px',
						'border-color': 'rgba(220, 53, 69, 0.40)'
					})
					e.preventDefault();
				} else {
					$('.filter-btn').css({
						'border-width': '1px',
						'border-color': '#404041'
					})
				}
			})
		}
	})
</script>