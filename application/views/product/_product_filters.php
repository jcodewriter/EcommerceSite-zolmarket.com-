<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php 
$query_string = ""; 
if (!empty($_SERVER["QUERY_STRING"])) {
	$query_string = "?" . $_SERVER["QUERY_STRING"];
}

if ($page != 'product') {
	$firstcat = reset($parent_categories);
	$endcat = end($parent_categories);
	$prevcat = prev($parent_categories);
}

?>

<!--product filters-->
<div class="product-filters d-flex justify-content-around">
	<?php
	if ($show_location_filter == true) :?>
		<?php if ($this->form_settings->product_conditions == 1) : ?>
		<div class="filter-item">
			<h4 class="title"><?php echo trans("condition"); ?></h4>
			<div class="filter-list-container">
				<ul class="filter-list filter-custom-scrollbar">
					<?php
					$get_condition = get_filter_query_string_key_value('condition');
					$product_conditions = get_active_product_conditions($selected_lang->id);
					
					// print_r($custom_product_conditions); exit;
					if (!empty($product_conditions)) : ?>
						<?php foreach ($product_conditions as $option) : ?>
							<li>
								<div class="left">
									<div class="custom-control custom-checkbox">
										<input type="radio" name="condition" value="<?php echo $option->option_key; ?>"
											   id="condition_<?php echo $option->id; ?>" class="custom-control-input"
											   onchange="this.form.submit();" <?php echo ($get_condition == $option->option_key) ? 'checked' : ''; ?>>
											   
										<label for="condition_<?php echo $option->id; ?>"
											   class="custom-control-label"></label>
									</div>
								</div>
								<div class="rigt">
									<label for="condition_<?php echo $option->id; ?>"
										   class="checkbox-list-item-label"><?php echo $option->option_label; ?></label>
								</div>
							</li>
						<?php endforeach; ?>
					<?php endif;
					if (!empty($custom_product_conditions)) : ?>
						<?php foreach ($custom_product_conditions as $option) : 
							// echo $option->name; exit;
						endforeach; ?>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	<?php endif;
	endif; ?>

	<?php
	if($page != "product"):
		$custom_filters = get_custom_product_conditions($endcat->id);
	// $custom_filters = get_custom_filters($firstcat->id);
	// print_r($custom_filters); exit;
	if (!empty($custom_filters)) :
		// print_r($custom_filters); exit;
		foreach ($custom_filters as $custom_filter) : 
			if ($custom_filter->field_type == 'dropdown' || $custom_filter->field_type == 'popup') : ?>
				<div class="filter-item">
					<h4 class="title"><?php echo $custom_filter->name; ?></h4>
					<div class="filter-list-container">
						<ul class="filter-list filter-custom-scrollbar">
						<?php $options = get_custom_field_options_by_lang($custom_filter->id, $this->selected_lang->id);?>
							<div class="selectdiv" style="width:85%">
								<select id="select_<?php echo $custom_filter->product_filter_key; ?>" name="<?php echo $custom_filter->product_filter_key; ?>" class="form-control" onchange="this.form.submit()">
								<?php $get_option_value = get_filter_query_string_key_value($custom_filter->product_filter_key);?>
									<option value=""><?php echo trans('select_option'); ?></option>
									<?php if (!empty($options)):
										foreach ($options as $option): ?>
											<option value="<?php echo html_escape($option->field_option); ?>" <?php echo ($get_option_value == $option->field_option) ? 'selected' : ''; ?>><?php echo html_escape($option->field_option); ?></option>
										<?php endforeach;
									endif; ?>
								</select>
							</div>
						</ul>
					</div>	
				</div>
				<?php elseif ($custom_filter->field_type == 'radio_button'):?>
				<div class="filter-item">
					<h4 class="title"><?php echo $custom_filter->name; ?></h4>
					<div class="filter-list-container">
						<ul class="filter-list filter-custom-scrollbar">
							<?php $options = get_custom_field_options_by_lang($custom_filter->id, $this->selected_lang->id);?>
							<?php if (!empty($options)) :
								foreach ($options as $option) :
									$get_option_value = get_filter_query_string_key_value($custom_filter->product_filter_key); ?>
									<li>
										<div class="left">
											<div class="custom-control custom-radio">
												<input type="radio" name="<?php echo $custom_filter->product_filter_key; ?>"
													id="filter_option_<?php echo $custom_filter->id . '-' . $option->id ?>"
													value="<?php echo $option->field_option; ?>"
													class="custom-control-input"
													onchange="this.form.submit();" <?php echo ($get_option_value == $option->field_option) ? 'checked="true"' : ''; ?>>
												<label
													for="filter_option_<?php echo $custom_filter->id . '-' . $option->id ?>"
													class="custom-control-label"></label>
											</div>
										</div>
										<div class="rigt">
											<label for="filter_option_<?php echo $custom_filter->id . '-' . $option->id ?>"
												class="radio-list-item-label"><?php echo $option->field_option; ?></label>
										</div>
									</li>
								<?php
								endforeach;
							endif; ?>
						</ul>
					</div>
				</div>
			<?php else:?>
				<div class="filter-item">
					<h4 class="title"><?php echo $custom_filter->name; ?></h4>
					<div class="filter-list-container">
						<ul class="filter-list filter-custom-scrollbar">
							<?php $options = get_custom_field_options_by_lang($custom_filter->id, $this->selected_lang->id); ?>
							<?php if (!empty($options)) :
								foreach ($options as $option) :
									$get_option_value = get_filter_query_string_key_value($custom_filter->product_filter_key.'shift'.$option->common_id);?>
									<li>
										<div class="left">
											<div class="custom-control custom-checkbox">
												<input type="radio" name="<?php echo $custom_filter->product_filter_key.'shift'.$option->common_id; ?>"
													id="filter_option_<?php echo $custom_filter->id . '-' . $option->id ?>"
													value="<?php echo $option->field_option; ?>"
													class="custom-control-input"
													onchange="this.form.submit();" <?php echo ($get_option_value == $option->field_option) ? 'checked="true"' : ''; ?>>
												<label
													for="filter_option_<?php echo $custom_filter->id . '-' . $option->id ?>"
													class="custom-control-label"></label>
											</div>
										</div>
										<div class="rigt">
											<label for="filter_option_<?php echo $custom_filter->id . '-' . $option->id ?>"
												class="checkbox-list-item-label"><?php echo $option->field_option; ?></label>
										</div>
									</li>
								<?php
								endforeach;
							endif; ?>
						</ul>
					</div>
				</div>
			<?php endif;
		endforeach;
	endif;endif; ?>


    <?php if ($this->form_settings->price == 1) :
		$filter_p_max = @(float)get_filter_query_string_key_value('p_max');
		$filter_p_min = @(float)get_filter_query_string_key_value('p_min'); ?>
		<div class="filter-item">
			<h4 class="title"><?php echo trans("price"); ?></h4>
			<div class="price-filter-inputs">
				<div class="row align-items-baseline row-price-inputs">
					<div class="col-4 col-md-4 col-lg-5 col-price-inputs">
						<span><?php echo trans("min"); ?></span>
						<input type="input"
							   name="<?php echo (get_filter_query_string_key_value('p_min')) ? 'p_min' : ''; ?>"
							   id="price_min" value="<?php echo ($filter_p_min != 0) ? $filter_p_min : ''; ?>"
							   class="form-control price-filter-input" placeholder="<?php echo trans("min"); ?>"
							   onchange="this.name='p_min'"
							   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
					</div>
					<div class="col-4 col-md-4 col-lg-5 col-price-inputs">
						<span><?php echo trans("max"); ?></span>
						<input type="input"
							   name="<?php echo (get_filter_query_string_key_value('p_max')) ? 'p_max' : ''; ?>"
							   id="price_max" value="<?php echo ($filter_p_max != 0) ? $filter_p_max : ''; ?>"
							   class="form-control price-filter-input" placeholder="<?php echo trans("max"); ?>"
							   onchange="this.name='p_max'"
							   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
					</div>
					<div class="col-4 col-md-4 col-lg-2 col-price-inputs text-left">
						<button class="btn btn-sm btn-default btn-filter-price float-left"><i
								class="icon-arrow-right"></i></button>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
</div>

<div class="row-custom">
	<!--Include banner-->
</div>
