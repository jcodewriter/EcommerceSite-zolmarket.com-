<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if (!empty($custom_fields)):
    foreach ($custom_fields as $custom_field):
        if (!empty($custom_field)):
            $category = get_category($custom_field->category_id);
            $field_common_ids_array = $custom_field->field_common_ids; ?>

            <?php if ($custom_field->field_type == "text"): ?>
            <div class="col-12 <?php echo ($custom_field->row_width == "half") ? "col-sm-6" : "col-sm-12"; ?> col-custom-field custom-field-type-<?php echo $category->category_level; ?>">
                <label class="control-label"><?php echo html_escape($custom_field->name); ?></label>
                <input type="text" name="field_<?php echo $custom_field->id; ?>" class="form-control form-input" value="<?php echo html_escape($custom_field->field_value); ?>"
                       placeholder="<?php echo html_escape($custom_field->name); ?>" <?php echo ($custom_field->is_required == 1) ? 'required' : ''; ?>>
            </div>
        <?php elseif ($custom_field->field_type == "number"): ?>
            <div class="col-12 <?php echo ($custom_field->row_width == "half") ? "col-sm-6" : "col-sm-12"; ?> col-custom-field custom-field-type-<?php echo $category->category_level; ?>">
                <label class="control-label"><?php echo html_escape($custom_field->name); ?></label>
                <input type="number" name="field_<?php echo $custom_field->id; ?>" class="form-control form-input" value="<?php echo html_escape($custom_field->field_value); ?>"
                       placeholder="<?php echo html_escape($custom_field->name); ?>" min="0" max="999999999" <?php echo ($custom_field->is_required == 1) ? 'required' : ''; ?>>
            </div>
        <?php elseif ($custom_field->field_type == "textarea"): ?>
            <div class="col-12 <?php echo ($custom_field->row_width == "half") ? "col-sm-6" : "col-sm-12"; ?> col-custom-field custom-field-type-<?php echo $category->category_level; ?>">
                <label class="control-label"><?php echo html_escape($custom_field->name); ?></label>
                <textarea class="form-control form-input custom-field-input" name="field_<?php echo $custom_field->id; ?>"
                          placeholder="<?php echo html_escape($custom_field->name); ?>" <?php echo ($custom_field->is_required == 1) ? 'required' : ''; ?>><?php echo html_escape($custom_field->field_value); ?></textarea>
            </div>
        <?php elseif ($custom_field->field_type == "date"): ?>
            <div class="col-12 <?php echo ($custom_field->row_width == "half") ? "col-sm-6" : "col-sm-12"; ?> col-custom-field custom-field-type-<?php echo $category->category_level; ?>">
                <label class="control-label"><?php echo html_escape($custom_field->name); ?></label>
                <div class="input-group date" data-provide="datepicker">
                    <input type="text" name="field_<?php echo $custom_field->id; ?>" value="<?php echo html_escape($custom_field->field_value); ?>" class="datepicker form-control form-input" placeholder="<?php echo html_escape($custom_field->name); ?>" <?php echo ($custom_field->is_required == 1) ? 'required' : ''; ?>>
                    <div class="input-group-append input-group-addon cursor-pointer">
                        <span class="input-group-text input-group-text-date"><i class="icon-calendar"></i> </span>
                    </div>
                </div>
            </div>
        <?php elseif ($custom_field->field_type == "dropdown"): ?>
            <?php $options = get_custom_field_options($custom_field->id); ?>
            <div class="col-12 <?php echo ($custom_field->row_width == "half") ? "col-sm-6" : "col-sm-12"; ?> col-custom-field custom-field-type-<?php echo $category->category_level; ?>">
                <label class="control-label"><?php echo html_escape($custom_field->name); ?></label>
                <div class="selectdiv">
                    <select name="field_<?php echo $custom_field->id; ?>" class="form-control" <?php echo ($custom_field->is_required == 1) ? 'required' : ''; ?>>
                        <option value=""><?php echo trans('select_option'); ?></option>
                        <?php if (!empty($options)):
                            foreach ($options as $option):?>
                                <option value="<?php echo html_escape($option->common_id); ?>" <?php echo (is_value_in_array($option->common_id, $field_common_ids_array)) ? 'selected' : ''; ?>><?php echo html_escape($option->field_option); ?></option>
                            <?php endforeach;
                        endif; ?>
                    </select>
                </div>
            </div>
        <?php elseif ($custom_field->field_type == "popup"): ?>
            <?php $options = get_custom_field_options($custom_field->id); ?>
            <div class="col-12 <?php echo ($custom_field->row_width == "half") ? "col-sm-6" : "col-sm-12"; ?> col-custom-field custom-field-type-<?php echo $category->category_level; ?>">
                <label class="control-label"><?php echo html_escape($custom_field->name); ?></label>
                <div class="selectdiv hidden-row">
                    <select name="field_<?php echo $custom_field->id; ?>" class="form-control" <?php echo ($custom_field->is_required == 1) ? 'required' : ''; ?>>
                        <option value=""><?php echo trans('select_option'); ?></option>
                        <?php if (!empty($options)):
                            foreach ($options as $option):?>
                                <option value="<?php echo html_escape($option->common_id); ?>" <?php echo (is_value_in_array($option->common_id, $field_common_ids_array)) ? 'selected' : ''; ?>><?php echo html_escape($option->field_option); ?></option>
                            <?php endforeach;
                        endif; ?>
                    </select>
                </div>
                <div class="mobile_selectdiv">
                    <button class="filter-btn text-truncate has-menu d-flex" type="button" data-ajax="0" data-type="<?php echo $custom_field->product_filter_key;?>" data-query="lang_id=<?php echo $this->selected_lang->id;?> and field_id=<?php echo $custom_field->id;?>&select" data-url="mobile_filter" style="height:50px;padding: 0 10px 0 10px" >
                        <img src="https://image.flaticon.com/icons/svg/95/95090.svg" class="align-self-center mr-1 ml-1" alt="Menu" style="width: 15px; filter:invert(47%) sepia(1%) saturate(8%) hue-rotate(87deg) brightness(119%) contrast(119%);">
                        <span name="field_<?php echo $custom_field->id; ?>" class="titre  m-0 flex-fill  h-100 text-truncate  text-left special-cagetory" style="padding-left:5px"><?php echo $custom_field->name; ?></span>
                        <i class="icon-arrow-right"></i>
                    </button>
                </div>
            </div>    
        <?php elseif ($custom_field->field_type == "radio_button"): ?>
            <div class="col-12 <?php echo ($custom_field->row_width == "half") ? "col-sm-6" : "col-sm-12"; ?> col-custom-field custom-field-type-<?php echo $category->category_level; ?>">
                <label class="control-label"><?php echo html_escape($custom_field->name); ?></label>
                <div class="row">
                    <?php $common_options = get_custom_field_options_by_lang($custom_field->id, $this->general_settings->site_lang); ?>
                    <?php $options = get_custom_field_options_by_lang($custom_field->id, $this->selected_lang->id); ?>
                    <?php if (!empty($common_options)):
                        $count = 0;
                        foreach ($common_options as $option):
                            $translated_option_name = $option->field_option;
                            $translated_option = get_field_option_by_lang($option->common_id, $this->selected_lang->id);
                            if (!empty($translated_option)) {
                                $translated_option_name = $translated_option->field_option;
                            } ?>
                            <div class="col-12 col-sm-3">
                                <div class="custom-control custom-radio custom-control-validate-input label_validate_field_<?php echo $custom_field->id; ?>">
                                    <?php if (is_value_in_array($option->common_id, $field_common_ids_array)): ?>
                                        <input type="radio" class="custom-control-input" id="form_radio_<?php echo $option->id; ?>" name="field_<?php echo $custom_field->id; ?>"
                                               value="<?php echo html_escape($option->common_id); ?>" <?php echo ($custom_field->is_required == 1) ? 'required' : ''; ?> checked>
                                    <?php else: ?>
                                        <input type="radio" class="custom-control-input" id="form_radio_<?php echo $option->id; ?>" name="field_<?php echo $custom_field->id; ?>"
                                               value="<?php echo html_escape($option->common_id); ?>" <?php echo ($custom_field->is_required == 1) ? 'required' : ''; ?> <?php echo (empty($field_common_ids_array) && $count == 0 && $custom_field->is_required == 1) ? 'checked' : ''; ?>>
                                    <?php endif; ?>

                                    <label class="custom-control-label label_validate_field_<?php echo $custom_field->id; ?>" for="form_radio_<?php echo $option->id; ?>"><?php echo html_escape($translated_option_name); ?></label>
                                </div>
                            </div>
                            <?php $count++;
                        endforeach;
                    endif; ?>
                </div>
            </div>
        <?php elseif ($custom_field->field_type == "checkbox"): ?>
            <div class="col-12 <?php echo ($custom_field->row_width == "half") ? "col-sm-6" : "col-sm-12"; ?> col-custom-field custom-field-type-<?php echo $category->category_level; ?>">
                <label class="control-label"><?php echo html_escape($custom_field->name); ?></label>
                <div class="row">
                    <?php $common_options = get_custom_field_options_by_lang($custom_field->id, $this->general_settings->site_lang); ?>
                    <?php if (!empty($common_options)):
                        foreach ($common_options as $option):
                            $translated_option_name = $option->field_option;
                            $translated_option = get_field_option_by_lang($option->common_id, $this->selected_lang->id);
                            if (!empty($translated_option)) {
                                $translated_option_name = $translated_option->field_option;
                            } ?>
                            <div class="col-12 col-sm-3">
                                <div class="custom-control custom-checkbox custom-control-validate-input label_validate_field_<?php echo $custom_field->id; ?>">
                                    <?php if (is_value_in_array($option->common_id, $field_common_ids_array)): ?>
                                        <input type="checkbox" class="custom-control-input" id="form_checkbox_<?php echo $option->id; ?>" name="field_<?php echo $custom_field->id; ?>[]"
                                               value="<?php echo html_escape($option->common_id); ?>" <?php echo ($custom_field->is_required == 1) ? 'required' : ''; ?> checked>
                                    <?php else: ?>
                                        <input type="checkbox" class="custom-control-input" id="form_checkbox_<?php echo $option->id; ?>" name="field_<?php echo $custom_field->id; ?>[]"
                                               value="<?php echo html_escape($option->common_id); ?>" <?php echo ($custom_field->is_required == 1) ? 'required' : ''; ?>>
                                    <?php endif; ?>
                                    <label class="custom-control-label" for="form_checkbox_<?php echo $option->id; ?>"><?php echo html_escape($translated_option_name); ?></label>
                                </div>
                            </div>
                        <?php endforeach;
                    endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php
        endif;
    endforeach;
endif; ?>