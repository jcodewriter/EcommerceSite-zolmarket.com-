<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Extractor_controller extends CI_Controller
{
	const EN_LANG_ID = 1;
	const AR_LANG_ID = 2;
	const USERNAME = 'admin';
	const PASSWORD = '$2y$10$lqsbNE0H2ezQiZbcMM4XmurQHqPZiSU8SDgn5o8uW79Gi.zE1JBKG';
	public function __construct()
	{
		parent::__construct();		
		if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] != self::USERNAME || !password_verify($_SERVER['PHP_AUTH_PW'],self::PASSWORD)) {
			header('WWW-Authenticate: Basic realm="MyProject"');
			header('HTTP/1.0 401 Unauthorized');
			die('Access Denied');
		}
		if (!property_exists($this, 'selected_lang')) {

			$selected_lang = new stdClass();
			$selected_lang->id = 1;

			$this->selected_lang = $selected_lang;
		}	
		$this->load->model('extractor_model');
	}

	public function index()
	{
		$this->load->model('category_model');
		$data = [];
		$data['categories']= $this->category_model->get_all_categories();
		
		$this->load->view('extractor/index-jtree.php', $data);


	}
	public function save()
	{
		if (($errors = $this->validate()) !== TRUE) {
			$this->json_response([
				'status' => 'error',
				'data' => $errors
			]);
		}

		if ($this->input->server('REQUEST_METHOD') !== 'POST' || !$this->input->is_ajax_request()) {
			die('Invalid Request');
		}
		$this->load->model('field_model');
		$custom_field_id = null;
		if ($this->input->post('export_action') === 'create') {

			$custom_field_id = $this->create_custom_field();

//			if ($this->field_model->add_remove_custom_field_filters($custom_field_id)) {
//
//			}

		} elseif ($this->input->post('export_action') === 'merge') {

			$custom_field_id = $this->merge_custom_field();
		}


		$options_ar = explode('|', $this->input->post('options_ar'));
		$options_en = explode('|', $this->input->post('options_en'));

		$this->add_custom_fields_options($custom_field_id, self::AR_LANG_ID, $options_ar, $options_en);

		$categories = explode('|', $this->input->post('categories'));
		foreach ($categories as $category) {
			if(is_numeric($category)){
				$this->field_model->add_category_to_field($custom_field_id, $category);
			}
		}
		$this->json_response([
			'status' => 'success',
			'data' => []
		]);
	}

	private function json_response($data)
	{
		$data[$this->security->get_csrf_token_name()] = $this->security->get_csrf_hash();
		$this->output
			->set_status_header(200)
			->set_content_type('application/json')
			->set_output(json_encode($data))
			->_display();
		exit;
	}

	private function merge_custom_field()
	{
		$fields = $this->extractor_model->get_custom_fields([
			'id' => $this->input->post('merge_with')
		]);
		if (count($fields) < 1) {
			$this->json_response([
				'status' => 'error',
				'data' => 'Invalid Data'
			]);
			exit();
		}
		return $fields[0]->id;
	}

	private function create_custom_field()
	{
		//add_custom_fields_lang
		$custom_field_data = $this->input->post(['row_width', 'is_required', 'status', 'field_type', 'is_product_filter']);

		$custom_field_id = $this->extractor_model->add_field($custom_field_data);

		#english
		$custom_fields_lang_data_en = [
			'field_id' => $custom_field_id,
			'lang_id' => self::EN_LANG_ID,
			'name' => $this->input->post('name_lang_1')
		];
		$this->extractor_model->add_custom_fields_lang($custom_fields_lang_data_en);

		#arabic
		$custom_fields_lang_data_ar = [
			'field_id' => $custom_field_id,
			'lang_id' => self::AR_LANG_ID,
			'name' => $this->input->post('name_lang_2')
		];
		$this->extractor_model->add_custom_fields_lang($custom_fields_lang_data_ar);

		return $custom_field_id;
	}

	private function add_custom_fields_options($field_id, $lang_id, array $ar_options, array $en_options)
	{
		foreach ($ar_options as $index => $xOption) {
			$ar_custom_fields_options_data = [
				'lang_id' => $lang_id,
				'field_id' => $field_id,
				'field_option' => $xOption
			];
			$en_custom_fields_options_data = [
				'lang_id' => $lang_id,
				'field_id' => $field_id,
				'field_option' => $en_options[$index],
			];
			$this->extractor_model->add_custom_fields_options_both_lang($ar_custom_fields_options_data, $en_custom_fields_options_data);
		}

	}

	private function validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('field_type', 'field_type', 'required');
//		$this->form_validation->set_rules('product_filter_key', 'product_filter_key', 'required');

		$this->form_validation->set_rules('options_ar', 'Arabic options', 'required|callback_options_len_check');
		$this->form_validation->set_rules('options_en', 'English options', 'required');

		if ($this->input->post('export_action') === 'create') {
			$this->form_validation->set_rules('row_width', 'Row Width', 'required|in_list[half,full]');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[1,0]');
			$this->form_validation->set_rules('is_required', 'Required', 'required|in_list[1,0]');
			$this->form_validation->set_rules('is_product_filter', 'Product Filter', 'required|in_list[1,0]');
			$this->form_validation->set_rules('field_type', 'Type', 'required|in_list[text,textarea,number,checkbox,radio_button,dropdown,popup,date]');
			$this->form_validation->set_rules('name_lang_1', 'Field Name (English)', 'required');
			$this->form_validation->set_rules('name_lang_2', 'Field Name (العربية)', 'required');

		} elseif ($this->input->post('export_action') === 'merge') {

			$this->form_validation->set_rules('merge_with', 'Merge With Custom Field', 'required|numeric');
		}

		if ($this->form_validation->run() == FALSE) {
			return $this->form_validation->error_array();

		} else {
			return TRUE;
		}
	}

	public function options_len_check()
	{
		$xOptions_ar_input = $this->input->post('options_ar');
		$xOptions_en_input = $this->input->post('options_en');
		if (isset($xOptions_ar_input, $xOptions_en_input)) {
			$options_ar = explode('|', $xOptions_ar_input);
			$options_en = explode('|', $xOptions_en_input);

			if (!empty($options_ar) && !empty($options_en) && count($options_ar) == count($options_en)) {
				return TRUE;
			}
		}
		$this->form_validation->set_message('options_len_check', 'Arabic options count is not matched by English options count.');

		return FALSE;
	}

	public function get_custom_fields()
	{
		$data = $this->extractor_model->get_custom_fields();
		$this->json_response([
			'status' => 'success',
			'data' => $data
		]);
	}
}
