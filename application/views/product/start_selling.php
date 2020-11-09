<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="hkm_messages_navCatDownMobile">
	<div class="cat-header">
		<div class="mobile-header-back">
			<a href="javascript:history.go(-1)" class="btn-back-mobile-nav ads_preview_btn"> <i class="icon-arrow-left"></i> <?php echo trans("back"); ?> </a>
		</div>
		<div class="mobile-header-title">
			<span class="text-white textcat-header text-center"><?php echo trans("start_selling"); ?></span>
		</div>
		<div class="mobilde-header-cart">
		</div>
	</div>
</div>
<br><br>
<!-- Wrapper -->
<div id="wrapper">
	<div class="container">
		<div class="row">
			<div id="content" class="col-12">
				<nav class="nav-breadcrumb" aria-label="breadcrumb">
					<ol class="breadcrumb"></ol>
				</nav>
				<h1 class="page-title page-title-product m-b-15 page_title_hidden_on_mobile"><?php echo trans("start_selling"); ?></h1>
				<div class="form-add-product">
					<div class="row justify-content-center">
						<div class="col-12 col-md-12 col-lg-10">


							<?php if ($this->auth_check) :
								if (user()->role == "vendor" && !user()->is_active_shop_request) : ?>
									<div class="page-confirm" style="padding-top:50px !important">
										<div class="circle-loader">
											<div class="checkmark draw"></div>
										</div>
										<h1 class="title">
											<?php echo trans("add_post_exp"); ?>
										</h1>
										<a href="<?php echo lang_base_url() . '/add-post'; ?>" class="btn btn-md btn-custom m-t-30"><?php echo trans("add_post_ex"); ?></a>
									</div>
								<?php else : ?>
									<div class="row">
										<div class="col-12">
											<!-- include message block -->
											<?php $this->load->view('product/_messages'); ?>
										</div>
									</div>
									<?php if ($this->auth_user->is_active_shop_request == 1) : ?>
										<div class="row">
											<div class="col-12">
												<div class="alert alert-info" role="alert">
													<?php echo trans("msg_shop_opening_requests"); ?>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-12">
												<p class="start-selling-description"><?php echo trans("start_selling_exp"); ?></p>
											</div>
										</div>
									<?php elseif ($this->auth_user->is_active_shop_request == 2) : ?>
										<div class="row">
											<div class="col-12">
												<div class="alert alert-secondary" role="alert">
													<?php echo trans("msg_shop_request_declined"); ?>
													<i class="fa fa-ban" aria-hidden="true" style="color: red;font-weight: 600;transform: rotate(90deg);position: absolute;right: 5px;bottom: 8px;"></i>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-12">
												<p class="start-selling-description" style="margin-bottom: 20px;"><?php echo trans("start_selling_exp"); ?></p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-12 order-1 order-lg-0">
												<h2 class="page-title page-title-product m-b-15" style="font-size: 22px !important;"><?php echo trans("please_contact_us"); ?></h2>
												<!-- form start -->
												<?php echo form_open('home_controller/contact_post', ['id' => 'form_validate', 'class' => 'validate_terms']); ?>
												<div class="form-group">
													<input type="text" class="form-control form-input" name="name" placeholder="<?php echo trans("name"); ?>" maxlength="199" minlength="1" pattern=".*\S+.*" value="<?php echo old('name'); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?> required>
												</div>
												<div class="form-group">
													<input type="email" class="form-control form-input" name="email" maxlength="199" placeholder="<?php echo trans("email_address"); ?>" value="<?php echo old('email'); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?> required>
												</div>
												<div class="form-group">
													<textarea class="form-control form-input form-textarea" name="message" placeholder="<?php echo trans("message"); ?>" maxlength="4970" minlength="5" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?> required><?php echo old('message'); ?></textarea>
												</div>
												<div class="form-group">
													<div class="custom-control custom-checkbox custom-control-validate-input" style="text-align: center;">
														<input type="checkbox" class="custom-control-input" name="terms_conditions" id="terms_conditions" value="1" required>
														<label for="terms_conditions" class="custom-control-label custom-check" style="font-size:13px; padding-top: 9px;">&nbsp;&nbsp;<?php echo trans("terms_conditions_exp"); ?>&nbsp;<a href="<?php echo lang_base_url(); ?>terms-conditions" class="link-terms" target="_blank"><strong><?php echo trans("terms_conditions"); ?></strong></a></label>
													</div>
												</div>
												<div style="margin-left: 20px;">
													<?php generate_recaptcha(); ?>
												</div>

												<div class="form-group">
													<div class="form-group" style="text-align: center; margin-top:-15px;">
														<button type="submit" class="btn btn-lg btn-custom" style="padding: 12px 45px !important;"><?php echo trans("submit"); ?></button>
													</div>
												</div>

												<?php echo form_close(); ?>
											</div>
										</div>
									<?php else : ?>
										<div class="row">
											<div class="col-12">
												<p class="start-selling-description"><?php echo trans("start_selling_exp"); ?></p>
											</div>
										</div>
										<div class="row">
											<div class="col-12">
												<?php echo form_open_multipart('product_controller/start_selling_post', ['id' => 'form_validate', 'class' => 'validate_terms', 'name' => 'start_selling', 'onkeypress' => "return event.keyCode != 13;"]); ?>
												<input type="hidden" name="id" value="<?php echo $this->auth_user->id; ?>">

												<div class="form-box m-b-15">
													<div class="form-box-head text-center">
														<h4 class="title title-start-selling-box"><?php echo trans('tell_us_about_shop'); ?></h4>
													</div>
													<div class="form-box-body">

														<div class="form-group">
															<label class="control-label"><?php echo trans("shop_name"); ?></label>
															<input type="text" name="shop_name" class="form-control form-input" value="<?php echo $this->auth_user->username; ?>" placeholder="<?php echo trans("shop_name"); ?>" maxlength="<?php echo $this->username_maxlength; ?>" required>
														</div>

														<div class="form-group">
															<div class="row hidden-row">
																<div class="col-12 col-sm-4 m-b-15">
																	<label class="control-label"><?php echo trans('country'); ?></label>
																	<?php if ($this->general_settings->default_product_location == 0) : ?>
																		<div class="selectdiv">
																			<select id="countries" name="country_id" class="form-control" onchange="get_states(this.value);" required>
																				<option value=""><?php echo trans('select'); ?></option>
																				<?php foreach ($countries as $item) : ?>
																					<option value="<?php echo $item->id; ?>" <?php echo ($item->id == $this->auth_user->country_id) ? 'selected' : ''; ?>><?php echo html_escape($item->name); ?></option>
																				<?php endforeach; ?>
																			</select>
																		</div>
																	<?php else : ?>
																		<div class="selectdiv">
																			<select id="countries" name="country_id" class="form-control" onchange="get_states(this.value);" required>
																				<?php foreach ($countries as $item) : ?>
																					<?php if ($item->id == $this->general_settings->default_product_location) : ?>
																						<option value="<?php echo $item->id; ?>" selected><?php echo html_escape($item->name); ?></option>
																					<?php endif; ?>
																				<?php endforeach; ?>
																			</select>
																		</div>
																	<?php endif; ?>
																</div>

																<div class="col-12 col-sm-4 m-b-15">
																	<label class="control-label"><?php echo trans('state'); ?></label>
																	<div class="selectdiv">
																		<select id="states" name="state_id" class="form-control" onchange="get_cities(this.value);" required>
																			<option value=""><?php echo trans('select'); ?></option>
																			<?php
																			if (!empty($this->auth_user->country_id)) {
																				$states = get_states_by_country($this->auth_user->country_id);
																			}
																			if (!empty($states)) :
																				foreach ($states as $item) : ?>
																					<option value="<?php echo $item->id; ?>" <?php echo ($item->id == $this->auth_user->state_id) ? 'selected' : ''; ?>><?php echo html_escape($item->name); ?></option>
																			<?php endforeach;
																			endif; ?>
																		</select>
																	</div>
																</div>
																<div class="col-12 col-sm-4 m-b-15">
																	<label class="control-label"><?php echo trans('city'); ?></label>
																	<div class="selectdiv">
																		<select id="cities" name="city_id" class="form-control">
																			<option value=""><?php echo trans('city'); ?></option>
																			<?php
																			if (!empty($cities)) :
																				foreach ($cities as $item) : ?>
																					<option value="<?php echo $item->id; ?>" <?php echo ($item->id == $user->city_id) ? 'selected' : ''; ?>><?php echo html_escape($item->name); ?></option>
																			<?php endforeach;
																			endif; ?>
																		</select>
																	</div>
																</div>
															</div>
															<div id="mobile_listcategories" class="mobile_selectdiv">
																<?php if ($general_settings->default_product_location == 0) : ?>
																	<label class="control-label"><?php echo trans('country'); ?></label>
																	<button class="filter-btn text-truncate has-menu d-flex mobile-popup__button m-b-15" type="button" name="country" data-ajax="0" data-type="country_id" data-url="country_location">
																	<?php endif; ?>
																	<?php if ($general_settings->default_product_location == 0) : ?>
																		<i class="fa fa-map-marker  fa-lg align-self-center mr-1 ml-1" aria-hidden="true"></i>
																		<?php if ($btn_string) : ?>
																			<span class="flex-fill text-truncate text-left special-cagetory" id="country_button"><?php echo html_escape($btn_string); ?></span>
																		<?php else : ?>
																			<span class="flex-fill text-truncate text-left special-cagetory" id="country_button"><?php echo trans('country'); ?></span>
																		<?php endif; ?>

																	<?php endif; ?>
																	<?php if ($general_settings->default_product_location == 0) : ?>
																		<i class="icon-arrow-right"></i>
																	<?php endif; ?>
																	</button>
																	<label class="control-label"><?php echo trans('state') . "/" . trans('city'); ?></label>
																	<?php if ($general_settings->default_product_location == 0) : ?>
																		<button class="filter-btn text-truncate has-menu d-flex mobile-popup__button" type="button" name="state" data-ajax="0" data-type="state_id" data-url="custom_location">
																		<?php else : ?>
																			<button class="filter-btn text-truncate has-menu d-flex mobile-popup__button" type="button" name="state" data-ajax="<?php echo $general_settings->default_product_location; ?>" data-type="state_id" data-url="custom_location">
																			<?php endif; ?>
																			<i class="fa fa-map-marker  fa-lg align-self-center mr-1 ml-1" aria-hidden="true"></i>
																			<?php if ($state_button) : ?>
																				<span class="flex-fill text-truncate text-left special-cagetory" id="city_button"><?php echo html_escape($state_button); ?></span>
																			<?php else : ?>
																				<span class="flex-fill text-truncate text-left special-cagetory" id="city_button"><?php echo trans('state') . ' / ' . trans('city'); ?></span>
																			<?php endif; ?>
																			<i class="icon-arrow-right"></i>
																			</button>
															</div>
														</div>

														<div class="form-group">
															<label class="control-label"><?php echo trans("full_name"); ?></label>
															<input type="text" name="fullname" class="form-control form-input" value="<?php echo $this->auth_user->fullname; ?>" placeholder="<?php echo trans("full_name"); ?>" maxlength="<?php echo $this->username_maxlength; ?>" required>
														</div>

														<div class="form-group">
															<label class="control-label"><?php echo trans("phone_number"); ?></label>
															<input type="text" id="intl_phone_number" name="phone_number" class="form-control form-input" value="<?php echo html_escape($this->auth_user->phone_number); ?>" placeholder="<?php echo trans("phone_number"); ?>" required>
														</div>


														<div class="form-group">
															<div class="row">
																<div class="col-12 col-sm-6 m-b-15">
																	<label class="control-label"><?php echo trans("shop_description"); ?></label>
																	<textarea name="about_me" class="form-control form-textarea" placeholder="<?php echo trans("shop_description"); ?>"><?php echo old('about_me'); ?></textarea>
																</div>
																<div class="col-12 col-sm-6">
																	<label class="control-label"><?php echo trans("upload_your_shop"); ?></label>
																	<div class="upload-image-container">
																		<div style="width: 100%; height: 180px;">
																			<?php if ($this->auth_user->avatar) : ?>
																				<img src="<?php echo get_user_avatar($this->auth_user); ?>" alt="<?php echo $this->auth_user->username; ?>" id="imgadshoww" style="width:100%;height: 100%;border-radius: 5px;" class="valid">
																			<?php else : ?>
																				<img src="<?php echo get_product_image(0, "small"); ?>" alt="<?php echo $this->auth_user->username; ?>" id="imgadshoww" style="width:100%;height: 100%;border-radius: 5px;">
																			<?php endif; ?>
																		</div>
																		<div style="position: absolute; top: 40px; right: 10px">
																			<a class='btn btn-md btn-secondary btn-file-upload' style="background-color: #495057d1;">
																				<span><i class="far fa-image"></i><?php echo trans('select_image'); ?></span>
																				<input type="file" name="file" id="imgUploader" size="40" accept=".png, .jpg, .jpeg, .gif" onchange="$('#upload-file-info').html($(this).val().replace(/.*[\/\\]/, ''));$('.upload-image-container').css('border-color', '#999');$('#imgadshoww').addClass('valid')">
																			</a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="form-group m-t-15" style="text-align: center">
													<div class="custom-control custom-checkbox custom-control-validate-input">
														<input type="checkbox" class="custom-control-input" name="terms_conditions" id="terms_conditions" value="1" required>
														<label for="terms_conditions" class="custom-control-label custom-check" style="font-size:13px; padding-top: 9px;">&nbsp;&nbsp;<?php echo trans("terms_conditions_exp"); ?>&nbsp;<a href="<?php echo lang_base_url(); ?>terms-conditions" class="link-terms" target="_blank"><strong><?php echo trans("terms_conditions"); ?></strong></a></label>
													</div>
												</div>
												<div class="form-group m-t-15" style="text-align: center">
													<button type="submit" class="btn btn-lg btn-custom" style="padding: 12px 45px !important;"><?php echo trans("submit"); ?></button>
												</div>

												<?php echo form_close(); ?>

											</div>
										</div>
							<?php endif;
								endif;
							endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="ajax-filter-menu">
		<div class="navCatDownMobile nav-mobile" id="filter1" style="margin-left: 105%;">
			<div class="form-group cat-header">
				<a href="javascript:void(0)" data-back="normal" class="btn-back-mobile-nav"><i class="icon-arrow-left"></i> <?= trans('back') ?></a>
				<span href="javascript:void(0)" class="text-white textcat-header text-center"><?= trans('filter') ?></span>
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
</div>
<!-- Wrapper End-->
<style>
	.circle-loader {
		margin-bottom: 3.5em;
		border: 1px solid rgba(0, 0, 0, 0.2);
		border-left-color: #5cb85c;
		animation: loader-spin 1.2s infinite linear;
		position: relative;
		display: inline-block;
		vertical-align: top;
		border-radius: 50%;
		width: 7em;
		height: 7em
	}

	.load-complete {
		-webkit-animation: none;
		animation: none;
		border-color: #5cb85c;
		transition: border 500ms ease-out
	}

	.checkmark {
		display: none
	}

	.checkmark.draw:after {
		animation-duration: 800ms;
		animation-timing-function: ease;
		animation-name: checkmark;
		transform: scaleX(-1) rotate(135deg)
	}

	.checkmark:after {
		opacity: 1;
		height: 3.5em;
		width: 1.75em;
		transform-origin: left top;
		border-right: 3px solid #5cb85c;
		border-top: 3px solid #5cb85c;
		content: '';
		left: 1.75em;
		top: 3.5em;
		position: absolute
	}

	@keyframes loader-spin {
		0% {
			transform: rotate(0deg)
		}

		100% {
			transform: rotate(360deg)
		}
	}

	@keyframes checkmark {
		0% {
			height: 0;
			width: 0;
			opacity: 1
		}

		20% {
			height: 0;
			width: 1.75em;
			opacity: 1
		}

		40% {
			height: 3.5em;
			width: 1.75em;
			opacity: 1
		}

		100% {
			height: 3.5em;
			width: 1.75em;
			opacity: 1
		}
	}

	.error-circle {
		margin-bottom: 3.5em;
		border: 1px solid #dc3545;
		position: relative;
		display: inline-block;
		vertical-align: top;
		border-radius: 50%;
		width: 7em;
		height: 7em;
		line-height: 7em;
		color: #dc3545
	}

	.error-circle i {
		font-size: 30px
	}
</style>
<script>
	$(document).ready(function() {
		$('.circle-loader').toggleClass('load-complete');
		$('.checkmark').toggle();
		if ($(this).width() < 500) {
			$("form[name=start_selling]").submit(function(e) {
				if (!$('#countries').val() || !$('#states').val() || $('#imgadshoww').attr('class') != 'valid') {
					if (!$('#countries').val())
						$('button[name=country]').css({
							'border-width': '1px',
							'border-color': 'rgba(220, 53, 69, 0.40)'
						})
					if (!$('#states').val())
						$('button[name=state]').css({
							'border-width': '1px',
							'border-color': 'rgba(220, 53, 69, 0.40)'
						})
					if ($('#imgadshoww').attr('class') != 'valid') {
						$('.upload-image-container').css('border-color', '#dc354566');
					}
					e.preventDefault();
				}
			})
		}
		$('.form-input').on('keypress', function() {
			var el = this;
			setTimeout(function() {
				if (!$(el).val()) el.style.setProperty('border-color', '#dc354566', 'important');
				else el.style.setProperty('border-color', '#999', 'important');
			}, 50);
		});
		$('.form-input').on('keydown', function(e) {
			var el = this;
			setTimeout(function() {
				if (!$(el).val()) el.style.setProperty('border-color', '#dc354566', 'important');
			}, 50);
		});
		$('.form-input').focus(function() {
			if (!$(this).val()) {
				this.style.setProperty('border-color', '#dc354566', 'important');
			}
		})
		$('.form-input').blur(function() {
			$(this).css('border-color', '#dfe0e6');
		})
	});
</script>