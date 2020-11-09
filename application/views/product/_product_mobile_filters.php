<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="hkm_messages_navCatDownMobile">
	<div class="cat-header">
		<div class="mobile-header-back">
			<a href="javascript:history.go(-1)" class="btn-back-mobile-nav"> <i class="icon-arrow-left"></i> <?php echo trans("back"); ?> </a>
		</div>
		<div class="mobile-header-title">
			<span class="text-white textcat-header text-center"><?php echo trans("filter"); ?></span>
		</div>
		<div class="mobilde-header-cart">
		</div>
	</div>
</div>
<br><br>
<div id="wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php echo form_open($url, ['id' => 'form-product-filters', 'method' => 'get']); ?>
				<?php
				if ($is_hkm_one_country)
					$country_id = $is_hkm_one_country_value;
				else
					$country_id = @$country;

				$state_id = @$state;
				$city_id = @$city;
				if (!$is_hkm_one_country)
					$filter_location = get_location_input(@$country, @$state, @$city);
				else
					$filter_location = get_location_input(null, @$state, @$city);
				$filter_location = trim($filter_location, ", ");
				if (empty($filter_location)) {
					if ($is_hkm_one_country) $filter_location = trans('all_states_cities');
					else $filter_location = trans('country') . ',' . trans('state') . ',' . trans('city');
				}
				?>
				<!--product filters-->
				<div class="product-filters d-block" style="margin-bottom: 75px;">
					<div class="row d-block text-left m-b-15">
						<h4 class="col-md-12 title"><?= trans('category'); ?></h4>
						<div class="col-md-12 filter-list-container">
							<div class="mobile-filter-list">
								<div class="mobile_selectdiv" style="width: 100%">
									<button class="filter-btn text-truncate has-menu d-flex mobile-popup__button" type="button" data-ajax="0" data-type="" data-query="" data-url="filter_categories">
										<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 298 298" style="width: 18px" xml:space="preserve">
											<path d="M117.5,0h-101c-8.822,0-16,7.178-16,16v101c0,8.822,7.178,16,16,16h101c8.822,0,16-7.178,16-16V16 C133.5,7.178,126.322,0,117.5,0z" />
											<path d="M281.5,0h-101c-8.822,0-16,7.178-16,16v101c0,8.822,7.178,16,16,16h101c8.822,0,16-7.178,16-16V16 C297.5,7.178,290.322,0,281.5,0z" />
											<path d="M117.5,165h-101c-8.822,0-16,7.178-16,16v101c0,8.822,7.178,16,16,16h101c8.822,0,16-7.178,16-16V181 C133.5,172.178,126.322,165,117.5,165z" />
											<path d="M281.5,165h-101c-8.822,0-16,7.178-16,16v101c0,8.822,7.178,16,16,16h101c8.822,0,16-7.178,16-16V181 C297.5,172.178,290.322,165,281.5,165z" />
										</svg>
										<?php if (!isset($category)) : ?>
											<span class="flex-fill text-truncate text-left catgegory-name"><?= trans('category') ?></span>
										<?php else : ?>
											<?php if (!empty($subcategory)) : ?>
												<span class="flex-fill text-truncate text-left catgegory-name"><?= trans('all') . ' ' . htmlspecialchars($category->name) ?></span>
											<?php else : ?>
												<span class="flex-fill text-truncate text-left catgegory-name"><?= htmlspecialchars($category->name) ?></span>
											<?php endif; ?>
										<?php endif; ?>
										<i class="icon-arrow-right"></i>
									</button>
								</div>
								<input type="hidden" name="" value="" onchange="this.form.submit();" />
							</div>
						</div>
					</div>
					<div class="row d-block text-left m-b-15">
						<h4 class="col-md-12 title"><?php echo trans('location'); ?></h4>
						<div class="col-md-12 filter-list-container">
							<div class="mobile-filter-list">
								<div class="mobile_selectdiv" style="width: 100%">
									<button class="filter-btn text-truncate has-menu d-flex mobile-popup__button" header-text="<?php echo $is_hkm_one_country ? trans('states') : trans('countries'); ?>" type="button" <?php if ($is_hkm_one_country) { ?> data-ajax="<?= $is_hkm_one_country_value ?>" <?php } ?> data-type="<?= $is_hkm_one_country ? ('state') : ('country') ?>" data-query="" data-url="filter_location">
										<i class="fa fa-map-marker  fa-lg align-self-center mr-1 ml-1" aria-hidden="true"></i>
										<span class="flex-fill text-truncate text-left location-name"><?= $filter_location ?></span>
										<i class="icon-arrow-right"></i>
									</button>
								</div>
							</div>
						</div>
						<input type="hidden" name="country" value="<?= $country_id ?>" />
						<input type="hidden" name="state" value="<?= $state_id ?>" />
						<input type="hidden" name="city" value="<?= $city_id ?>" />
					</div>

					<?php if ($form_settings->product_conditions == 1) : ?>
						<div class="row d-block text-left m-b-15">
							<h4 class="col-md-12 title"><?php echo trans("condition"); ?></h4>
							<div class="col-md-12 filter-list-container">
								<?php
								$product_conditions = get_active_product_conditions($selected_lang->id);
								if (!empty($product_conditions)) : ?>
									<?php foreach ($product_conditions as $option) : ?>
										<div class="mobile-filter-list">
											<div class="custom-control custom-radio">
												<input type="radio" name="condition" value="<?php echo $option->option_key; ?>" id="condition_<?php echo $option->id; ?>" class="custom-control-input" <?php echo (@$condition == $option->option_key) ? 'checked' : ''; ?>>
												<label for="condition_<?php echo $option->id; ?>" class="custom-control-label"><?php echo $option->option_label; ?></label>
											</div>
										</div>
									<?php endforeach; ?>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>
					<div class="custom-field-container">
						<?php
						if (!empty($custom_filters)) :
							foreach ($custom_filters as $custom_filter) :
								if ($custom_filter->field_type == 'popup') : ?>
									<div class="row d-block text-left m-b-15">
										<h4 class="col-md-12 title"><?php echo $custom_filter->name; ?></h4>
										<div class="col-md-12 filter-list-container">
											<div class="mobile-filter-list">
												<div class="mobile_selectdiv" style="width: 100%">
													<button class="filter-btn text-truncate has-menu d-flex mobile-popup__button" type="button" data-ajax="0" data-type="<?php echo $custom_filter->product_filter_key; ?>" data-query="lang_id=<?php echo $this->selected_lang->id; ?> and field_id=<?php echo $custom_filter->id; ?>&input" data-url="mobile_filter">
														<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 298 298" style="width: 18px" xml:space="preserve">
															<path d="M117.5,0h-101c-8.822,0-16,7.178-16,16v101c0,8.822,7.178,16,16,16h101c8.822,0,16-7.178,16-16V16 C133.5,7.178,126.322,0,117.5,0z" />
															<path d="M281.5,0h-101c-8.822,0-16,7.178-16,16v101c0,8.822,7.178,16,16,16h101c8.822,0,16-7.178,16-16V16 C297.5,7.178,290.322,0,281.5,0z" />
															<path d="M117.5,165h-101c-8.822,0-16,7.178-16,16v101c0,8.822,7.178,16,16,16h101c8.822,0,16-7.178,16-16V181 C133.5,172.178,126.322,165,117.5,165z" />
															<path d="M281.5,165h-101c-8.822,0-16,7.178-16,16v101c0,8.822,7.178,16,16,16h101c8.822,0,16-7.178,16-16V181 C297.5,172.178,290.322,165,281.5,165z" />
														</svg>
														<div class="flex-fill text-truncate text-left special-cagetory">
															<span name="<?php echo $custom_filter->product_filter_key; ?>">
																<?php echo @${$custom_filter->product_filter_key} ? @${$custom_filter->product_filter_key} : $custom_filter->name; ?>
															</span>
														</div>
														<i class="icon-arrow-right"></i>
													</button>
												</div>
												<input type="hidden" name="<?php echo $custom_filter->product_filter_key; ?>" value="<?php echo @${$custom_filter->product_filter_key}; ?>" />
											</div>
										</div>
									</div>
								<?php elseif ($custom_filter->field_type == 'dropdown') : ?>
									<div class="row d-block text-left m-b-15">
										<h4 class="col-md-12 title"><?php echo $custom_filter->name; ?></h4>
										<div class="col-md-12 filter-list-container">
											<div class="mobile-filter-list">
												<?php $options = get_custom_field_options_by_lang($custom_filter->id, $this->selected_lang->id); ?>
												<div class="selectdiv">
													<select id="<?php echo $custom_filter->product_filter_key; ?>" name="<?php echo $custom_filter->product_filter_key; ?>" class="form-control">
														<option value=""><?php echo trans('select_option'); ?></option>
														<?php if (!empty($options)) :
															foreach ($options as $option) : ?>
																<option value="<?php echo html_escape($option->field_option); ?>" <?php echo (@${$custom_filter->product_filter_key} == $option->field_option) ? 'selected' : ''; ?>><?php echo html_escape($option->field_option); ?></option>
														<?php endforeach;
														endif; ?>
													</select>
												</div>
											</div>
										</div>
									</div>
								<?php elseif ($custom_filter->field_type == 'radio_button') : ?>
									<div class="row  d-block text-left m-b-15">
										<h4 class="col-md-12 title"><?php echo $custom_filter->name; ?></h4>
										<div class="col-md-12 filter-list-container">
											<?php $options = get_custom_field_options_by_lang($custom_filter->id, $this->selected_lang->id); ?>
											<?php if (!empty($options)) :
												foreach ($options as $option) : ?>
													<div class="mobile-filter-list">
														<div class="custom-control custom-radio">
															<input type="radio" name="<?php echo $custom_filter->product_filter_key; ?>" id="filter_option_<?php echo $custom_filter->id . '-' . $option->id ?>" value="<?php echo $option->field_option; ?>" class="custom-control-input" <?php echo (@${$custom_filter->product_filter_key} == $option->field_option) ? 'checked="true"' : ''; ?>>
															<label for="filter_option_<?php echo $custom_filter->id . '-' . $option->id ?>" class="custom-control-label"><?php echo $option->field_option; ?></label>
														</div>
													</div>
											<?php
												endforeach;
											endif; ?>
										</div>
									</div>
								<?php else : ?>
									<div class="row d-block text-left m-b-15">
										<h4 class="col-md-12 title"><?php echo $custom_filter->name; ?></h4>
										<div class="col-md-12 filter-list-container">
											<?php $options = get_custom_field_options_by_lang($custom_filter->id, $this->selected_lang->id); ?>
											<?php if (!empty($options)) :
												foreach ($options as $option) : ?>
													<div class="mobile-filter-list">
														<div class="custom-control custom-checkbox">
															<input type="radio" name="<?php echo $custom_filter->product_filter_key . 'shift' . $option->common_id; ?>" id="filter_option_<?php echo $custom_filter->id . '-' . $option->id ?>" value="<?php echo $option->field_option; ?>" class="custom-control-input" <?php echo (@${$custom_filter->product_filter_key . 'shift' . $option->common_id} == $option->field_option) ? 'checked="true"' : ''; ?>>
															<label for="filter_option_<?php echo $custom_filter->id . '-' . $option->id ?>" class="custom-control-label"><?php echo $option->field_option; ?></label>
														</div>
													</div>
											<?php
												endforeach;
											endif; ?>
										</div>
									</div>
						<?php endif;
							endforeach;
						endif; ?>

					</div>
					<?php if ($form_settings->price == 1) :
						$filter_p_max = @(float) get_filter_query_string_key_value('p_max');
						$filter_p_min = @(float) get_filter_query_string_key_value('p_min'); ?>
						<div class="row d-block text-left">
							<h4 class="col-md-12 title"><?php echo trans("price"); ?></h4>
							<div class="price-filter-inputs">
								<div class="price-input-row" style="display: flex">
									<div class="col-md-6 col-price-inputs">
										<span><?php echo trans("min"); ?></span>
										<input type="input" style="padding: 1.375rem .75rem;" name="<?php echo (get_filter_query_string_key_value('p_min')) ? 'p_min' : ''; ?>" id="price_min" value="<?php echo (@$p_min != 0) ? @$p_min : ''; ?>" class="form-control price-filter-input" placeholder="<?php echo trans("min"); ?>" onchange="this.name='p_min'" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
									</div>
									<div class="col-md-6 col-price-inputs">
										<span><?php echo trans("max"); ?></span>
										<input type="input" style="padding: 1.375rem .75rem;" name="<?php echo (get_filter_query_string_key_value('p_max')) ? 'p_max' : ''; ?>" id="price_max" value="<?php echo (@$p_max != 0) ? @$p_max : ''; ?>" class="form-control price-filter-input" placeholder="<?php echo trans("max"); ?>" onchange="this.name='p_max'" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
									</div>
								</div>
							</div>
						</div>
					<?php endif; ?>
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

				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>