<?php


class Extractor_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		if (!property_exists($this, 'selected_lang')) {

			$selected_lang = new stdClass();
			$selected_lang->id = 1;

			$this->selected_lang = $selected_lang;
		}
	}

	function is_exists_custom_field($product_filter_key)
	{
		$query = $this->db->select('id')
			->get_where('custom_fields', [
				'product_filter_key' => $product_filter_key
			], 1);
		if ($query->num_rows() > 0) {
			return $query->row()->id;
		}
		return FALSE;
	}

	function is_exits_custom_fields_lang($field_id, $lang_id)
	{
		$query = $this->db->select('id')
			->get_where('custom_fields_lang', [
				'field_id' => $field_id,
				'lang_id' => $lang_id
			], 1);
		if ($query->num_rows() > 0) {
			return $query->row()->id;
		}
		return FALSE;
	}

	function is_exits_custom_fields_options($field_id, $lang_id, $field_option)
	{
		$query = $this->db->select('id')
			->get_where('custom_fields_options', [
				'field_id' => $field_id,
				'lang_id' => $lang_id,
				'field_option' => $field_option,
			], 1);
		if ($query->num_rows() > 0) {
			return $query->row()->id;
		}
		return FALSE;
	}


	//add field
	public function add_field($data)
	{
		$data += array(
			'field_order' => 1,
		);
		//generate filter key
		$field_name = $this->input->post('name_lang_' . $this->selected_lang->id, true);
		$key = url_title(convert_accented_characters(trim($field_name)), "_", true);

		//check filter key exists
		$row = $this->get_field_by_filter_key($key);
		if (!empty($row)) {
			$key = 'q_' . $key;
			$row = $this->get_field_by_filter_key($key);
			if (!empty($row)) {
				$key = $key . rand(1, 999);
			}
		}
		$data['product_filter_key'] = $key;
//		$data['field_type'] = $this->input->post('field_type', true);

		$this->db->insert('custom_fields', $data);
		return $this->db->insert_id();
	}

	function add_custom_field($data)
	{
		$custom_field_id = $this->is_exists_custom_field($data['product_filter_key']);

		if ($custom_field_id !== FALSE) {
			return $custom_field_id;
		}
		$this->db->insert('custom_fields', $data);
		return $this->db->insert_id();
	}

	function add_custom_fields_lang($data)
	{
		$custom_fields_lang = $this->is_exits_custom_fields_lang($data['field_id'], $data['lang_id']);
		if ($custom_fields_lang !== FALSE) {
			return $custom_fields_lang;
		}
		$this->db->insert('custom_fields_lang', $data);
		return $this->db->insert_id();
	}


	function add_custom_fields_options_both_lang($ar_options_data, $en_options_data)
	{
		$common_id = generate_short_unique_id();

		$ar_options_data['common_id'] = $common_id;
		$this->add_custom_fields_options($ar_options_data);

		$en_options_data['common_id'] = $common_id;
		$this->add_custom_fields_options($en_options_data);
	}

	function add_custom_fields_options($data)
	{
		$custom_fields_option = $this->is_exits_custom_fields_options($data['field_id'], $data['lang_id'], $data['field_option']);
		if ($custom_fields_option !== FALSE) {
			return $custom_fields_option;
		}


		$this->db->insert('custom_fields_options', $data);
		return $this->db->insert_id();
	}

	function get_custom_fields_options_common_id($field_id)
	{
		$query = $this->db->select('lang_id,common_id')
			->get_where('custom_fields_options', ['field_id' => $field_id], 1);
		if ($query->num_rows() > 0) {
			return $query->row()->common_id;
		}
		return FALSE;
	}

	//get field by filter key
	public function get_field_by_filter_key($filter_key)
	{
		$this->db->where('product_filter_key', $filter_key);
		$query = $this->db->get('custom_fields');
		return $query->row();
	}

	public function get_custom_fields($where=[])
	{
		$custom_fields = $this->db->get_where('custom_fields', $where)->result();

		foreach ($custom_fields as &$row) {

			$custom_field_lang = $this->db->get_where('custom_fields_lang', ['field_id' => $row->id])->result();
			$row->langs_count = count($custom_field_lang);
			$row->langs = $custom_field_lang;
		}
		return $custom_fields;

	}

}
