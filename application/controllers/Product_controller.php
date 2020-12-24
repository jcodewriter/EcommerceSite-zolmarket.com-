<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_controller extends Home_Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->review_limit = 5;
        $this->comment_limit = 5;
        $this->product_per_page = 16;

        $slug = @end(explode('/', current_url()));
        $category = $this->category_model->get_category_by_slug($slug);
        if (!empty($category)) {
            $top_parent_category_id = top_parent_category_id($category->id);
            $this->form_settings = $this->settings_model->get_form_settings($top_parent_category_id);
        }
    }

    /**
     * Select Membership Plan
     */
    public function select_membership_plan()
    {
        $this->selected_btn = "f-btn-add";
        get_method();
        if ($this->general_settings->membership_plans_system != 1) {
            redirect(lang_base_url());
            exit();
        }
        //check auth
        if (!$this->auth_check) {
            redirect(lang_base_url());
        }
        if ($this->general_settings->email_verification == 1 && $this->auth_user->email_status != 1) {
            $this->session->set_flashdata('error', trans("msg_confirmed_required"));
            redirect(lang_base_url() . "settings/update-profile");
        }
        if ($this->auth_user->is_active_shop_request == 1) {
            redirect(lang_base_url() . "start_selling");
        }
        $data['title'] = trans("select_your_plan");
        $data['description'] = trans("select_your_plan") . " - " . $this->app_name;
        $data['keywords'] = trans("select_your_plan") . "," . $this->app_name;
        $data['request_type'] = "new";
        $data["membership_plans"] = $this->membership_model->get_plans();
        // $data["index_settings"] = get_index_settings();
        $data['user_current_plan'] = $this->membership_model->get_user_plan_by_user_id($this->auth_user->id);
        $data['user_ads_count'] = $this->membership_model->get_user_ads_count($this->auth_user->id);

        $this->load->view('partials/_header', $data);
        $this->load->view('product/select_membership_plan', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Start Selling
     */
    public function start_selling()
    {
        $this->selected_btn = "f-btn-add";
        //check auth
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        if (is_user_vendor() && user()->is_approval == 2) {
            redirect(lang_base_url());
        }

        if ($this->general_settings->email_verification == 1 && user()->email_status != 1) {
            $this->session->set_flashdata('error', trans("msg_confirmed_required"));
            redirect(lang_base_url() . "settings/update-profile");
        }

        $data['title'] = trans("start_selling");
        $data['description'] = trans("start_selling") . " - " . $this->app_name;
        $data['keywords'] = trans("start_selling") . "," . $this->app_name;
        $data["site_settings"] = get_site_settings();

        if ($this->general_settings->membership_plans_system == 1) {
            if ($this->auth_user->is_active_shop_request != 1) {
                $plan_id = clean_number(input_get('plan'));
                if (empty($plan_id)) {
                    redirect(lang_base_url("select_membership_plan"));
                    exit();
                }
                $data['plan'] = $this->membership_model->get_plan($plan_id);
                if (empty($data['plan'])) {
                    redirect(lang_base_url("select_membership_plan"));
                    exit();
                }
            }
        }

        $data['btn_string'] = '';
        $data['state_button'] = '';
        $data["user"] = user();
        $data["countries"] = $this->location_model->get_countries();
        $data["states"] = $this->location_model->get_states_by_country($data["user"]->country_id);
        $data["cities"] = $this->location_model->get_cities_by_state($data["user"]->state_id);
        if ($data['user']->country_id) {
            $data['btn_string'] = $this->location_model->get_btn_string($data['user']);
            $data['state_button'] = $this->location_model->get_state_button_string($data['user']);
        }
        if ($this->general_settings->default_product_location) {
            $data["states"] = $this->location_model->get_states_by_country($this->general_settings->default_product_location);
        }

        $this->load->view('partials/_header', $data);
        $this->load->view('product/start_selling', $data);
        $this->load->view('partials/_footer');
    }


    /**
     * Start Selling Post
     */
    public function start_selling_post()
    {
        $this->selected_btn = "f-btn-add";
        //check auth
        if (!auth_check()) {
            redirect(lang_base_url());
        }

        $user_id = $this->input->post('id', true);
        $firstname = $this->input->post('firstname', true);
        $lastname = $this->input->post('lastname', true);

        $data = array(
            'is_active_shop_request' => 1,
            'shop_name' => $this->input->post('is_private', true) == 0 ? remove_special_characters($this->input->post('shop_name', true)) : $firstname . ' ' . $lastname,
            'is_private' => $this->input->post('is_private', true),
            'country_id' => $this->input->post('country_id', true),
            'state_id' => $this->input->post('state_id', true),
            'city_id' => $this->input->post('city_id', true),
            'phone_number' => $this->input->post('phone_number', true),
            'address' => $this->input->post('address', true),
            'zip_code' => $this->input->post('zip_code', true),
            'about_me' => $this->input->post('about_me', true)
        );

        $this->profile_model->update_profile($data, $user_id);
        //is shop name unique
        if (!$this->auth_model->is_unique_shop_name($data['shop_name'], $user_id)) {
            $this->session->set_flashdata('form_data', $data);
            $this->session->set_flashdata('error', trans("msg_shop_name_unique_error"));
            redirect($this->agent->referrer());
            exit();
        }
        if ($this->general_settings->membership_plans_system == 1) {
            $plan_id = clean_number($this->input->post('plan_id', true));
            if (empty($plan_id)) {
                redirect(lang_base_url() . "select_membership_plan");
                exit();
            }
            $plan = $this->membership_model->get_plan($plan_id);

            if (empty($plan)) {
                redirect(lang_base_url() . "select_membership_plan");
                exit();
            }
            if ($plan->is_free == 1) {
                // print_r($plan); exit;
                if ($this->auth_model->add_shop_opening_requests($data)) {
                    $this->membership_model->add_user_free_plan($plan, $this->auth_user->id);
                    redirect(lang_base_url() . "start_selling");
                    exit();
                } else {
                    $this->session->set_flashdata('error', trans("msg_error"));
                    redirect($this->agent->referrer());
                    exit();
                }
            } else {
                $data['is_active_shop_request'] = 0;
                if ($this->auth_model->add_shop_opening_requests($data)) {
                    //go to checkout
                    $this->session->set_userdata('modesy_selected_membership_plan_id', $plan->id);
                    $this->session->set_userdata('modesy_membership_request_type', "new");
                    redirect(lang_base_url() . "cart/payment-method?payment_type=membership");
                } else {
                    $this->session->set_flashdata('error', trans("msg_error"));
                    redirect($this->agent->referrer());
                    exit();
                }
            }
        } else {
            if ($this->auth_model->add_shop_opening_requests($data)) {
                //send email
                $user = get_user($user_id);
                if (!empty($user) && $this->general_settings->send_email_shop_opening_request == 1) {
                    $email_data = array(
                        'email_type' => 'email_shop_request',
                        'to' => $this->general_settings->mail_options_account,
                        'subject' => trans("shop_opening_request"),
                        'email_link' => admin_url() . "shop-opening-requests",
                        'email_button_text' => trans("view_details")
                    );
                    $this->session->set_userdata('mds_send_email_data', json_encode($email_data));
                }
                // language 
                $idiom = $this->session->userdata('modesy_selected_lang');
                if ($idiom == 2) {
                    $this->config->set_item('language', 'العربية');
                    $this->lang->load('site', 'العربية');
                    $oops = $this->lang->line('msg_start_selling');
                    $this->session->set_flashdata('success', $oops);
                } else {
                    $this->config->set_item('language', 'default');
                    $this->lang->load('site', 'default');
                    $oops = $this->lang->line('msg_start_selling');
                    $this->session->set_flashdata('success', $oops);
                }
                redirect($this->agent->referrer());
                exit();
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
                exit();
            }
        }
    }

    public function add_post()
    {
        $this->selected_btn = "f-btn-add";
        $this->auth_model->is_approval();
        redirect(lang_base_url() . '/sell-now');
    }

    /**
     * Add Product
     */
    public function add_product()
    {
        //check auth
        $this->selected_btn = "f-btn-add";
        if (!auth_check()) {
            redirect(lang_base_url());
        }

        if (!is_user_vendor() || !user()->is_approval) {
            if ($this->general_settings->membership_plans_system == 1) {
                redirect(lang_base_url() . "start_selling/select_membership_plan");
                exit();
            }
            if (!user()->is_approval) {
                redirect(lang_base_url() . "start_selling");
                exit();
            }
        }

        if (user()->is_approval == 1) {
            $this->auth_model->is_approval();
            redirect(lang_base_url() . 'sell-now');
        }

        if ($this->general_settings->email_verification == 1 && user()->email_status != 1) {
            $this->session->set_flashdata('error', trans('msg_confirmed_required'));
            redirect(lang_base_url() . "settings/update-profile");
        }

        $data['title'] = trans("sell_now");
        $data['description'] = trans("sell_now") . " - " . $this->app_name;
        $data['keywords'] = trans("sell_now") . "," . $this->app_name;
        $data["site_settings"] = get_site_settings();
        $data['modesy_images'] = $this->file_model->get_sess_product_images_array();
        $data['all_categories'] = $this->category_model->get_categories_ordered_by_name();
        $data["file_manager_images"] = $this->file_model->get_user_file_manager_images();
        $data["active_product_system_array"] = $this->get_activated_product_system();

        $view = 'plan_expired';
        if (user()->role == "admin")
            $view = 'add_product';
        else
            $view = !$this->membership_model->is_allowed_adding_product() ? 'plan_expired' : 'add_product';
// echo $view; exit;
        $this->load->view('partials/_header', $data);
        $this->load->view('product/' . $view, $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Add Product Post
     */
    public function add_product_post()
    {
        $this->selected_btn = "f-btn-add";
        $post = $this->input->post();
        if (!$post['custom_id'] && !end($post['second_parent_id']))
            redirect(lang_base_url() . 'sell-now');
        // print_r($post); exit;
        //check auth
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        if (!is_user_vendor()) {
            redirect(lang_base_url());
        }
        if ($this->general_settings->email_verification == 1 && user()->email_status != 1) {
            $this->session->set_flashdata('error', trans("msg_confirmed_required"));
            redirect(lang_base_url() . "settings/update-profile");
        }
        //add product
        if ($this->product_model->add_product()) {
            //last id
            $last_id = $this->db->insert_id();
            //update slug
            $this->product_model->update_slug($last_id);
            //add product images
            $this->file_model->add_product_images($last_id);
            // add notification page

            redirect(lang_base_url() . 'sell-now/product-details/' . $last_id);
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Edit Draft
     */
    public function edit_draft($id)
    {
        $this->selected_btn = "f-btn-add";
        //check auth
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        if (!is_user_vendor()) {
            redirect(lang_base_url());
        }
        $data["product"] = $this->product_admin_model->get_product($id);
        if (empty($data["product"])) {
            redirect($this->agent->referrer());
        }
        if ($data["product"]->is_draft != 1) {
            redirect($this->agent->referrer());
        }
        if ($data["product"]->user_id != user()->id && user()->role != "admin") {
            redirect($this->agent->referrer());
        }

        $data['category'] = get_category($data["product"]->category_id);
        $data['title'] = trans("edit_product");
        $data['description'] = trans("edit_product") . " - " . $this->app_name;
        $data['keywords'] = trans("edit_product") . "," . $this->app_name;
        $data["site_settings"] = get_site_settings();
        $data['modesy_images'] = $this->file_model->get_product_images_uncached($data["product"]->id);
        $data["page"] = "detail_product";
        $data["product_categories"] = $this->category_model->get_all_parent_categories($data["product"]->category_id);
        $data['parent_categories'] = $this->category_model->get_parent_categories();
        $data["file_manager_images"] = $this->file_model->get_user_file_manager_images();
        $data["active_product_system_array"] = $this->get_activated_product_system();
        $this->load->view('partials/_header', $data);
        $this->load->view('product/edit_product');
        $this->load->view('partials/_footer');
    }


    /**
     * Edit Product
     */
    public function edit_product($id)
    {
        $this->selected_btn = "f-btn-add";
        //check auth
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        if (!is_user_vendor()) {
            redirect(lang_base_url());
        }
        $data["product"] = $this->product_admin_model->get_product($id);
        if (empty($data["product"])) {
            redirect($this->agent->referrer());
        }
        if ($data["product"]->is_deleted == 1) {
            if (user()->role != "admin") {
                redirect($this->agent->referrer());
            }
        }
        if ($data["product"]->user_id != user()->id && user()->role != "admin") {
            redirect($this->agent->referrer());
        }

        $data['category'] = get_category($data["product"]->category_id);
        $data['title'] = trans("edit_product");
        $data['description'] = trans("edit_product") . " - " . $this->app_name;
        $data['keywords'] = trans("edit_product") . "," . $this->app_name;
        $data["site_settings"] = get_site_settings();
        $data['modesy_images'] = $this->file_model->get_product_images_uncached($data["product"]->id);
        $data["page"] = "detail_product";
        $data["product_categories"] = $this->category_model->get_all_parent_categories($data["product"]->category_id);
        $data['parent_categories'] = $this->category_model->get_parent_categories();
        $data["file_manager_images"] = $this->file_model->get_user_file_manager_images();
        $data["active_product_system_array"] = $this->get_activated_product_system();
        // $aa = end($data['product_categories']);
        // print_r($aa->name); exit;
        $this->load->view('partials/_header', $data);
        $this->load->view('product/edit_product');
        $this->load->view('partials/_footer');
    }

    /**
     * Edit Product Post
     */
    public function edit_product_post()
    {
        $this->selected_btn = "f-btn-add";
        //check auth
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        if (!is_user_vendor()) {
            redirect(lang_base_url());
        }


        //validate inputs
        $this->form_validation->set_rules('title', trans("title"), 'required|xss_clean|max_length[500]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect($this->agent->referrer());
        } else {
            //product id
            $product_id = $this->input->post('id', true);
            //user id
            $user_id = 0;
            $product = $this->product_admin_model->get_product($product_id);
            if (!empty($product)) {
                $user_id = $product->user_id;
            }
            if ($product->user_id != user()->id && user()->role != "admin") {
                redirect($this->agent->referrer());
            }

            if ($this->product_model->edit_product($product_id)) {
                //edit slug
                $this->product_model->update_slug($product_id);

                if ($product->is_draft == 1) {
                    redirect(lang_base_url() . 'sell-now/product-details/' . $product_id);
                } else {
                    //reset cache
                    reset_cache_data_on_change();
                    reset_user_cache_data($user_id);
                    reset_product_img_cache_data($product_id);

                    // $this->session->set_flashdata('success', trans("msg_updated"));
                    redirect(lang_base_url() . 'sell-now/product-details/' . $product_id);
                    // redirect($this->agent->referrer());
                }
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }

    /**
     * Edit Product Details
     */
    // ddddd
    public function edit_product_details($id)
    {

        $this->selected_btn = "f-btn-add";
        //check auth
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        if (!is_user_vendor()) {
            redirect(lang_base_url());
        }
        if ($this->general_settings->email_verification == 1 && user()->email_status != 1) {


            // language 
            $idiom = $this->session->userdata('modesy_selected_lang');
            if ($idiom == 2) {
                $this->config->set_item('language', 'العربية');
                $this->lang->load('site', 'العربية');
                $oops = $this->lang->line('msg_confirmed_required');
                $this->session->set_flashdata('error', $oops);
                redirect(lang_base_url() . "settings/update-profile");
            } else {
                $this->config->set_item('language', 'default');
                $this->lang->load('site', 'default');
                $oops = $this->lang->line('msg_confirmed_required');
                $this->session->set_flashdata('error', $oops);
                redirect(lang_base_url() . "settings/update-profile");
            }
        }

        $data['btn_string'] = '';
        $data['state_button'] = '';
        $data['product'] = $this->product_admin_model->get_product($id);
        if (empty($data['product'])) {
            redirect($this->agent->referrer());
        }
        if (user()->role != 'admin' && user()->id != $data['product']->user_id) {
            redirect($this->agent->referrer());
            exit();
        }

        if ($data['product']->is_draft == 1) {
            $data['title'] = trans("sell_now");
            $data['description'] = trans("sell_now") . " - " . $this->app_name;
            $data['keywords'] = trans("sell_now") . "," . $this->app_name;
        } else {
            $data['title'] = trans("edit_product");
            $data['description'] = trans("edit_product") . " - " . $this->app_name;
            $data['keywords'] = trans("edit_product") . "," . $this->app_name;
        }


        if ($this->general_settings->default_product_location == 0) {
            if ($data["product"]->country_id == 0) {
                $data["states"] = $this->location_model->get_states_by_country($this->auth_user->country_id);
            } else {
                $data["states"] = $this->location_model->get_states_by_country($data["product"]->country_id);
            }
        } else {
            $data["states"] = $this->location_model->get_states_by_country($this->general_settings->default_product_location);
            // $data['btn_string'] = $this->location_model->get_btn_string($this->auth_user);
            // $data['state_button'] = $this->location_model->get_state_button_string($this->auth_user);
        }
        if ($data["product"]->country_id == 0) {
            $data["cities"] = $this->location_model->get_cities_by_state($this->auth_user->state_id);
        } else {
            $data["cities"] = $this->location_model->get_cities_by_state($data["product"]->state_id);
            $data['btn_string'] = $this->location_model->get_btn_string($data['product']);
            $data['state_button'] = $this->location_model->get_state_button_string($data['product']);
        }


        $data["custom_field_array"] = $this->field_model->generate_custom_fields_array($data["product"]->category_id, $data["product"]->id);
        $data["product_variations"] = $this->variation_model->get_product_variations($data["product"]->id);
        $data["user_variations"] = $this->variation_model->get_variation_by_user_id($data["product"]->user_id);
        $top_parent_category_id = top_parent_category_id($data["product"]->category_id);
        $data['form_settings'] = $this->settings_model->get_form_settings($top_parent_category_id);
        $data['license_keys'] = $this->product_model->get_license_keys($data["product"]->id);
        $data["site_settings"] = get_site_settings();
        $this->load->view('partials/_header', $data);
        $this->load->view('product/edit_product_details');
        $this->load->view('partials/_footer');
    }

    /**
     * Edit Product Details Post
     */
    public function edit_product_details_post()
    {
        $this->selected_btn = "f-btn-add";
        //check auth
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        if (!is_user_vendor()) {
            redirect(lang_base_url());
        }
        $product_id = $this->input->post('id', true);
        $product = $this->product_admin_model->get_product($product_id);
        if (empty($product)) {
            redirect($this->agent->referrer());
            exit();
        }
        if (user()->role != 'admin' && user()->id != $product->user_id) {
            redirect($this->agent->referrer());
            exit();
        }
        if ($this->product_model->edit_product_details($product_id)) {
            $this->notification_model->product($product_id, $this->auth_user->id);
            //edit custom fields
            $this->product_model->update_product_custom_fields($product_id);

            //reset cache
            reset_cache_data_on_change();
            reset_user_cache_data(user()->id);

            if ($product->is_draft != 1) {
                $this->session->set_flashdata('success', trans("msg_updated"));
                redirect($this->agent->referrer());
            } else {
                //send email
                if ($this->general_settings->send_email_new_product == 1) {
                    $email_data = array(
                        'email_type' => 'new_product',
                        'product_id' => $product->id
                    );
                    $this->session->set_userdata('mds_send_email_data', json_encode($email_data));
                }

                if ($this->general_settings->user_send_email_new_product == 1) {
                    $email_data = array(
                        'email_type' => 'new_product_to_user',
                        'product_id' => $product->id
                    );
                    $this->session->set_userdata('mds_send_email_to_user', json_encode($email_data));
                }

                //if draft
                if ($this->input->post('submit', true) == 'save_as_draft') {
                    redirect(lang_base_url() . 'drafts');
                    exit();
                }
                redirect(lang_base_url() . "add-product-success/" . $product_id);
            }
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    public function add_product_success($product_id)
    {
        $this->selected_btn = "f-btn-add";
        $data['title'] = trans("confirm_your_email");
        $data['description'] = trans("confirm_your_email") . " - " . $this->app_name;
        $data['keywords'] = trans("confirm_your_email") . "," . $this->app_name;

        $token = trim($this->input->get("token", true));
        $data["user"] = $this->auth_model->get_user_by_token($token);
        $data["product"] = $this->product_model->get_product_by_id($product_id);
        $data["success"] = trans("msg_add_post_success");

        $this->load->view('partials/_header', $data);
        $this->load->view('product/add_product_success', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Products
     */
    public function products()
    {
        $data['title'] = trans("products");
        $data['description'] = trans("products") . " - " . $this->app_name;
        $data['keywords'] = trans("products") . "," . $this->app_name;
        /* hkm */
        if ($this->general_settings->default_product_location != 0) {
            $data["is_hkm_one_country"] = true;
            $data["is_hkm_one_country_value"] = $this->general_settings->default_product_location;
        } else {
            $data["is_hkm_one_country"] = false;
        }

        /*hkm */

        //get paginated posts
        $link = lang_base_url() . 'products';
        $pagination = $this->paginate($link, $this->product_model->get_paginated_filtered_products_count(null, null, null), $this->product_per_page);
        $data['products'] = $this->product_model->get_paginated_filtered_products(null, $pagination['per_page'], $pagination['offset']);
        $data["categories"] = $this->category_model->get_categories_all();

        if ($data["is_hkm_one_country"])
            $data["states"] =  get_states_by_country($this->default_location_id);
        else {
            $country = clean_number($this->input->get("country", true));
            $data["states"] =  get_states_by_country($country);
        }


        $state = clean_number($this->input->get("state", true));
        if ($state)
            $data["cities"] =  get_cities_by_state($state);
        $data["site_settings"] = get_site_settings();
        $data["page"] = 'product';

        $data['show_location_filter'] = false;
        if (!empty($data['products'])) {
            foreach ($data['products'] as $item) {
                if ($item->product_type == 'physical') {
                    $data['show_location_filter'] = true;
                    break;
                }
            }
        } else {
            $data['show_location_filter'] = true;
        }

        if ($this->is_mobile)  $data['Platform'] = 'Mobile';
        else $data['Platform'] = 'Browser';
        $_SESSION['page'] = 0;


        $this->load->view('partials/_header', $data);
        $this->load->view('product/products', $data);
        $this->load->view('partials/_footer');
    }

    public function get_product_json()
    {
        $slug = $this->input->get('slug');
        $data = [];
        $_SESSION['page'] += 1;
        if ($slug == 'products') {
            $rows = $this->product_model->get_scroll_filtered_products(null, $this->product_per_page, $_SESSION['page'] * $this->product_per_page);
        } else {
            $category = $this->category_model->get_category_by_slug($slug);
            $slugs[] = $category->id;
            $rows = $this->product_model->get_scroll_filtered_products($slugs, $this->product_per_page, $_SESSION['page'] * $this->product_per_page);
        }
        foreach ($rows as $row) {
            // print_r($this->load->view('product/_product_item_th_list', ['product' => $row, 'promoted_badge' => true])); exit;
            // $row->product_url =  generate_product_url($row);
            // $row->product_favorited_count =  get_product_favorited_count($row->id);
            // $row->product_comment_count =  get_product_comment_count($row->id);
            // $row->shop_name_product =  get_shop_name_product($row);
            // $row->product_image =  get_product_image($row->id, 'image_small');
            // $row->lang_base_url =  lang_base_url();
            // if ($row->is_promoted == 1 && $this->promoted_products_enabled == 1) $row->is_promoted = 1;
            // else $row->is_promoted = 0;
            // $row->price = $this->get_price($row->price);
            // $row->currency = get_currency($row->currency);
            // $row->currency_symbol_format = $this->payment_settings->currency_symbol_format;
            // $data[] = $row;
        }
        // $ad_spaces = get_ad_data('products', 'ad_code_250');
        // $ad_space = $ad_spaces[array_rand($ad_spaces)];
        // echo json_encode(array($data, $ad_space));
    }

    public function get_price($price)
    {
        $price = $price / 100;
        $dec_point = '.';
        $thousands_sep = ',';

        if ($this->thousands_separator != '.') {
            $dec_point = ',';
            $thousands_sep = '.';
        }
        if (is_int($price)) {
            $price = number_format($price, 0, $dec_point, $thousands_sep);
        } else {
            $price = number_format($price, 2, $dec_point, $thousands_sep);
        }
        return $price;
    }

    public function error_404()
    {
        $data['title'] = "Error 404";
        $data['description'] = "Error 404";
        $data['keywords'] = "error,404";
        $this->load->view('partials/_header', $data);
        $this->load->view('errors/error_404');
        $this->load->view('partials/_footer');
    }

    /**
     * Category
     */
    public function category()
    {
        $slug = @end(func_get_args());
        $valide = true;

        $category = $this->category_model->get_category_by_slug($slug);
        if (empty($category) || $category == null) {
            $this->error_404();
            $valide  = false;
        }

        if ($valide) {

            if ($this->is_mobile) {
                $data['Platform'] = 'Mobile';
            } else {
                $data['Platform'] = 'Browser';
            }

            if ($this->general_settings->default_product_location != 0) {
                $data["is_hkm_one_country"] = true;
                $data["is_hkm_one_country_value"] = $this->general_settings->default_product_location;
            } else {
                $data["is_hkm_one_country"] = false;
            }

            $data["custom_field_data"] = $this->category_model->ads_result_custom_field_data($category->id);
            $data["parent_categories"] = $this->category_model->get_all_parent_categories($category->id);
            $endcat = end($data["parent_categories"]);
            $subcats = get_allsubcategories_by_parent_id($endcat->id);
            $subcats[] = $endcat->id;
            $data["page"] = 'category';
            $data["category"] = end($data["parent_categories"]);
            $data["subcategories"] = $this->category_model->get_subcategories_by_parent_id($data["category"]->id);
            $data['title'] = !empty($data["category"]->title_meta_tag) ? $data["category"]->title_meta_tag : $data["category"]->name;
            $data['description'] = $data["category"]->description;
            $data['keywords'] = $data["category"]->keywords;
            //get paginated posts
            $link = lang_base_url() . 'category/' . $data["category"]->slug;
            $pagination = $this->paginate($link, $this->product_model->get_paginated_filtered_products_count($subcats), $this->product_per_page);
            $data['products'] = $this->product_model->get_paginated_filtered_products($subcats, $pagination['per_page'], $pagination['offset']);
            $data["site_settings"] = get_site_settings();
            $data['show_location_filter'] = false;

            $data["categories"] = $this->category_model->get_categories_all();
            if ($data["is_hkm_one_country"])
                $data["states"] =  get_states_by_country($this->default_location_id);
            else if ($this->input->get("country", true) != null) {
                $country = clean_number($this->input->get("country", true));
                $data["states"] =  get_states_by_country($country);
            } else {

                $data["states"] =  get_states_by_country($this->location_model->default_country());
            }
            $capitalstate = array_filter($data["states"], function ($item) {
                return $item->is_capital;
            });
            $capitalstate = reset($capitalstate);
            $data["capital_state"] = $capitalstate;
            if ($capitalstate) {
                $data["cities"] = get_cities_by_state($capitalstate->id);
            } else {
                $data["cities"] = array();
            }

            $state = clean_number($this->input->get("state", true));

            if ($state)
                $data["cities"] =  get_cities_by_state($state);

            $capitalcity = array_filter($data["cities"], function ($item) {
                return $item->is_default;
            });
            $capitalcity = reset($capitalcity);
            $data["capital_city"] = $capitalcity;

            if (!empty($data['products'])) {
                foreach ($data['products'] as $item) {
                    if ($item->product_type == 'physical') {
                        $data['show_location_filter'] = true;
                        break;
                    }
                }
            } else {
                $data['show_location_filter'] = true;
            }

            $this->load->view('partials/_header', $data);
            $this->load->view('product/products', $data);
            $this->load->view('partials/_footer');
        }
    }
    /**
     * Popup Category
     */
    public function popup_category()
    {
        $this->selected_btn = "f-btn-home";
        $slug = @end(func_get_args());
        $valide = true;
        $category = $this->category_model->get_category_by_slug($slug);
        if ($slug != "all") {
            if (empty($category) || $category == null) {
                $this->error_404();
                $valide  = false;
            }
        } else {
            $category = new StdClass();
            $category->id = 0;
        }
        if ($valide) {
            $data["parent_categories"] = $this->category_model->get_all_parent_categories($category->id);
            if (!empty($data["parent_categories"])) {
                $endcat = end($data["parent_categories"]);
                $subcats = get_allsubcategories_by_parent_id($endcat->id);
                $subcats[] = $endcat->id;
            }
            $data["page"] = 'category';
            $data["category"] = end($data["parent_categories"]);
            $data["parent_category"] = prev($data["parent_categories"]);
            if (empty($data["parent_categories"]))
                $data["subcategories"] = $this->category_model->get_subcategories_by_parent_id(0);
            else
                $data["subcategories"] = $this->category_model->get_subcategories_by_parent_id($data["category"]->id);

            if ($this->is_mobile) {
                $data['Platform'] = 'Mobile';
            } else {
                $data['Platform'] = 'Browser';
            }

            if ($this->is_mobile) {
                $data['title'] = $this->settings->homepage_title;
                $data['description'] = $this->settings->site_description;
                $data['keywords'] = $this->settings->keywords;

                $this->load->view('partials/_header', $data);
                if ($data["category"]) {
                    if ($data["category"]->category_ads_view == '0')
                        $this->load->view('product/_popup_category', $data);
                    else if ($data["category"]->category_ads_view == '1')
                        $this->load->view('product/_popup_category_cell_two', $data);
                    else if ($data["category"]->category_ads_view == '2')
                        $this->load->view('product/_popup_category_cell_three', $data);
                } else {
                    $this->load->view('product/_popup_category', $data);
                }
                $this->load->view('partials/_footer_category');
            }
        }
    }
    /**
     * Delete Product
     */
    public function delete_product()
    {
        //check auth
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        if (!is_user_vendor()) {
            redirect(lang_base_url());
        }
        $id = $this->input->post('id', true);

        //user id
        $user_id = 0;
        $product = $this->product_admin_model->get_product($id);
        if (!empty($product)) {
            $user_id = $product->user_id;
        }

        if (user()->role == "admin" || user()->id == $user_id) {
            if ($this->product_model->delete_product($id)) {
                $this->session->set_flashdata('success', trans("msg_product_deleted"));
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
            }

            //reset cache
            reset_cache_data_on_change();
            reset_user_cache_data($user_id);
        }
    }

    /**
     * Delete Draft
     */
    public function delete_draft()
    {
        //check auth
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        if (!is_user_vendor()) {
            redirect(lang_base_url());
        }
        $id = $this->input->post('id', true);

        //user id
        $user_id = 0;
        $product = $this->product_admin_model->get_product($id);
        if (!empty($product)) {
            $user_id = $product->user_id;
        }

        if (user()->role == "admin" || user()->id == $user_id) {
            $this->product_admin_model->delete_product_permanently($id);
            //reset cache
            reset_cache_data_on_change();
            reset_user_cache_data($user_id);
        }
    }

    /*
    *------------------------------------------------------------------------------------------
    * PRODUCT VARIATIONS
    *------------------------------------------------------------------------------------------
    */

    //add product variation
    public function add_product_variation()
    {
        if ($this->auth_check) {
            $product_id = $this->input->post('product_id', true);
            $this->variation_model->add_variation();
            $data["product_variations"] = $this->variation_model->get_product_variations($product_id);
            $this->load->view('product/variation/_response_variations', $data);
        }
    }

    //edit product variation
    public function edit_product_variation()
    {
        if ($this->auth_check) {
            $common_id = $this->input->post('common_id', true);
            $product_id = $this->input->post('product_id', true);
            $lang_id = $this->input->post('lang_id', true);

            $data["product_id"] = $product_id;
            $data["variation"] = $this->variation_model->get_variation_by_common_id($common_id);
            $data["main_variation"] = $this->variation_model->get_variation($common_id, $lang_id);
            $this->load->view('product/variation/_response_variation_edit', $data);
        }
    }

    //edit product variation
    public function edit_product_variation_post()
    {
        if ($this->auth_check) {
            $common_id = $this->input->post('common_id', true);
            $product_id = $this->input->post('product_id', true);
            $this->variation_model->edit_variation($common_id);
            $data["product_variations"] = $this->variation_model->get_product_variations($product_id);
            $this->load->view('product/variation/_response_variations', $data);
        }
    }

    //delete product variation
    public function delete_product_variation()
    {
        if ($this->auth_check) {
            $common_id = $this->input->post('common_id', true);
            $product_id = $this->input->post('product_id', true);
            $this->variation_model->delete_variation($common_id);
            $data["product_variations"] = $this->variation_model->get_product_variations($product_id);
            $this->load->view('product/variation/_response_variations', $data);
        }
    }

    //add product variation option
    public function add_product_variation_option()
    {
        if ($this->auth_check) {
            $variation_common_id = $this->input->post('variation_common_id', true);
            $lang_id = $this->input->post('lang_id', true);
            $this->variation_model->add_variation_option($variation_common_id, $lang_id);
            $data["main_variation"] = $this->variation_model->get_variation($variation_common_id, $lang_id);
            $this->load->view('product/variation/_response_variation_options_edit', $data);
        }
    }

    //edit product variation options
    public function edit_product_variation_options()
    {
        if ($this->auth_check) {
            $common_id = $this->input->post('common_id', true);
            $product_id = $this->input->post('product_id', true);
            $lang_id = $this->input->post('lang_id', true);
            $data["product_id"] = $product_id;
            $data["main_variation"] = $this->variation_model->get_variation($common_id, $lang_id);
            $this->load->view('product/variation/_response_variation_options_edit', $data);
        }
    }

    //edit product variation options post
    public function edit_product_variation_options_post()
    {
        if ($this->auth_check) {
            $variation_common_id = $this->input->post('variation_common_id', true);
            $lang_id = $this->input->post('lang_id', true);
            $this->variation_model->edit_variation_options($variation_common_id);
            $data["main_variation"] = $this->variation_model->get_variation($variation_common_id, $lang_id);
            $this->load->view('product/variation/_response_variation_options_edit', $data);
        }
    }

    //delete product variation option
    public function delete_product_variation_option()
    {
        if ($this->auth_check) {
            $option_common_id = $this->input->post('option_common_id', true);
            $variation_common_id = $this->input->post('variation_common_id', true);
            $lang_id = $this->input->post('lang_id', true);
            $this->variation_model->delete_variation_option($option_common_id);
            $data["main_variation"] = $this->variation_model->get_variation($variation_common_id, $lang_id);
            $this->load->view('product/variation/_response_variation_options_edit', $data);
        }
    }

    //select product variation
    public function select_product_variation()
    {
        if ($this->auth_check) {
            $common_id = $this->input->post('common_id', true);
            $product_id = $this->input->post('product_id', true);
            $this->variation_model->select_variation($common_id, $product_id);
            $data["product_variations"] = $this->variation_model->get_product_variations($product_id);
            $this->load->view('product/variation/_response_variations', $data);
        }
    }

    //make review
    public function make_review()
    {
        if (!$this->auth_check) {
            exit();
        }
        if ($this->general_settings->product_reviews != 1) {
            exit();
        }
        $limit = $this->input->post('limit', true);
        $product_id = $this->input->post('product_id', true);
        $review = $this->review_model->get_review($product_id, user()->id);
        $data["product"] = $this->product_model->get_product_by_id($product_id);

        if (!empty($review)) {
            echo "voted_error";
        } elseif ($data["product"]->user_id == user()->id) {
            echo "error_own_product";
        } else {
            $this->review_model->add_review();
            $data["reviews"] = $this->review_model->get_limited_reviews($product_id, $limit);
            $data['review_count'] = $this->review_model->get_review_count($data["product"]->id);
            $data['review_limit'] = $limit;
            $data["product"] = $this->product_model->get_product_by_id($product_id);

            if ($this->general_settings->send_review_email) {
                $img_object = $this->product_model->get_image_by_id($product_id);
                $img_path = '';
                if (!(empty($img_object))) $img_path = base_url() . "uploads/images/" . $img_object->image_small;
                $receiver = get_user($data["product"]->user_id);

                $email_data = array(
                    'subject' => trans("email_new_product_review"),
                    'to' => $receiver->email,
                    'message_subject' => $data["product"]->title,
                    'img_src' => $img_path,
                    'rating' => $this->input->post('rating', true),
                    'reviews' => $this->input->post('review', true),
                    'sender_name' => $this->auth_user->username,
                    'sender_avatar' => $this->auth_user->avatar,
                    'product' => $data["product"],
                    'template_path' => "email/email_new_review"
                );

                $this->load->model("email_model");
                $this->email_model->send_email($email_data);
            }
            $this->load->view('product/details/_make_review', $data);
        }
    }

    //load more review
    public function load_more_review()
    {
        $product_id = $this->input->post('product_id', true);
        $limit = $this->input->post('limit', true);
        $new_limit = $limit + $this->review_limit;
        $data["product"] = $this->product_model->get_product_by_id($product_id);
        $data["reviews"] = $this->review_model->get_limited_reviews($product_id, $new_limit);
        $data['review_count'] = $this->review_model->get_review_count($data["product"]->id);
        $data['review_limit'] = $new_limit;

        $this->load->view('product/details/_make_review', $data);
    }

    //delete review
    public function delete_review()
    {
        $id = $this->input->post('id', true);
        $product_id = $this->input->post('product_id', true);
        $user_id = $this->input->post('user_id', true);
        $limit = $this->input->post('limit', true);

        $review = $this->review_model->get_review($product_id, $user_id);
        if (auth_check() && !empty($review)) {
            if (user()->role == "admin" || user()->id == $review->user_id) {
                $this->review_model->delete_review($id, $product_id);
            }
        }

        $data["product"] = $this->product_model->get_product_by_id($product_id);
        $data["reviews"] = $this->review_model->get_limited_reviews($product_id, $limit);
        $data['review_count'] = $this->review_model->get_review_count($data["product"]->id);
        $data['review_limit'] = $limit;

        $this->load->view('product/details/_make_review', $data);
    }

    //make comment
    public function make_comment()
    {
        if ($this->general_settings->product_comments != 1) {
            exit();
        }
        $limit = $this->input->post('limit', true);
        $product_id = $this->input->post('product_id', true);
        $data["product"] = $this->product_model->get_product_by_id($product_id);

        // if (user()->id == $data["product"]->user_id){
        //     echo "error_own_product";
        // }else{
        if (auth_check()) {
            $this->comment_model->add_comment();
        } else {
            if ($this->recaptcha_verify_request()) {
                $this->comment_model->add_comment();
            }
        }
        $data['comment_count'] = $this->comment_model->get_product_comment_count($product_id);
        $data['comments'] = $this->comment_model->get_comments($product_id, $limit);
        $data['comment_limit'] = $limit;
        if ($this->general_settings->send_comment_email) {
            $this->load->model("email_model");
            $img_object = $this->product_model->get_image_by_id($product_id);
            $img_path = '';
            if (!(empty($img_object))) $img_path = base_url() . "uploads/images/" . $img_object->image_small;

            if (!$this->input->post('parent_id', true) && $this->input->post('user_id', true) == $data['product']->user_id) {
                $all_users = $this->comment_model->get_all_comment_users($this->input->post('user_id', true), $data["product"]->id);
                if (sizeof($all_users) > 0) {
                    foreach ($all_users as $user) {
                        $all_recievers[] = $user->email;
                    }
                    $email_data = array(
                        'subject' => trans("email_new_product_comment"),
                        'to' => $all_recievers,
                        'message_subject' => $data["product"]->title,
                        'img_src' => $img_path,
                        'comment' => $this->input->post('comment', true),
                        'sender_name' => $this->auth_user->username,
                        'sender_avatar' => $this->auth_user->avatar,
                        'product' => $data["product"],
                        'template_path' => "email/email_new_comment"
                    );
                    $this->email_model->send_email($email_data);
                }
            }


            if ($this->input->post('user_id', true) != $data['product']->user_id) {
                $owner = get_user($data["product"]->user_id);
                $owner_email_data = array(
                    'subject' => trans("email_new_product_comment"),
                    'to' => $owner->email,
                    'message_subject' => $data["product"]->title,
                    'img_src' => $img_path,
                    'comment' => $this->input->post('comment', true),
                    'sender_name' => $this->auth_user->username,
                    'sender_avatar' => $this->auth_user->avatar,
                    'product' => $data["product"],
                    'template_path' => "email/email_new_comment"
                );

                $this->email_model->send_email($owner_email_data);
            }
            $result = $this->comment_model->get_comment($this->input->post('parent_id', true));
            if ($this->input->post('parent_id', true) && $result->user_id != $data['product']->user_id) {
                $adder = get_user($result->user_id);
                $adder_email_data = array(
                    'subject' => trans("email_new_product_comment"),
                    'to' => $adder->email,
                    'message_subject' => $data["product"]->title,
                    'img_src' => $img_path,
                    'comment' => $this->input->post('comment', true),
                    'sender_name' => $this->auth_user->username,
                    'sender_avatar' => $this->auth_user->avatar,
                    'product' => $data["product"],
                    'template_path' => "email/email_new_comment"
                );
                $this->email_model->send_email($adder_email_data);
            }
        }
        $this->load->view('product/details/_comments', $data);
        // }
    }

    //load more comment
    public function load_more_comment()
    {
        $product_id = $this->input->post('product_id', true);
        $limit = $this->input->post('limit', true);
        $new_limit = $limit + $this->comment_limit;
        $data["product"] = $this->product_model->get_product_by_id($product_id);
        $data["comments"] = $this->comment_model->get_comments($product_id, $new_limit);
        $data['comment_count'] = $this->comment_model->get_product_comment_count($data["product"]->id);
        $data['comment_limit'] = $new_limit;

        $this->load->view('product/details/_comments', $data);
    }

    //delete comment
    public function delete_comment()
    {
        $id = $this->input->post('id', true);
        $product_id = $this->input->post('product_id', true);
        $limit = $this->input->post('limit', true);

        $comment = $this->comment_model->get_comment($id);
        if (auth_check() && !empty($comment)) {
            if (user()->role == "admin" || user()->id == $comment->user_id) {
                $this->comment_model->delete_comment($id);
            }
        }

        $data["product"] = $this->product_model->get_product_by_id($product_id);
        $data["comments"] = $this->comment_model->get_comments($product_id, $limit);
        $data['comment_count'] = $this->comment_model->get_product_comment_count($data["product"]->id);
        $data['comment_limit'] = $limit;

        $this->load->view('product/details/_comments', $data);
    }

    //delete comment
    public function load_subcomment_box()
    {
        $comment_id = $this->input->post('comment_id', true);
        $limit = $this->input->post('limit', true);
        $data["parent_comment"] = $this->comment_model->get_comment($comment_id);
        $data["comment_limit"] = $limit;
        $this->load->view('product/details/_make_subcomment', $data);
    }

    //set product as sold
    public function set_product_as_sold()
    {
        $product_id = $this->input->post('product_id', true);
        if (auth_check()) {
            $this->product_model->set_product_as_sold($product_id);
        }
    }

    //add or remove favorites
    public function add_remove_favorites()
    {
        $product_id = $this->input->post('product_id', true);
        $this->product_model->add_remove_favorites($product_id);
        redirect($this->agent->referrer());
    }

    //add or remove favorites
    public function add_remove_favorite_ajax()
    {
        $product_id = $this->input->post('product_id', true);
        $this->product_model->add_remove_favorites($product_id);
    }

    //get states
    public function get_states()
    {
        $country_id = $this->input->post('country_id', true);
        $states = $this->location_model->get_states_by_country($country_id);
        foreach ($states as $item) {
            echo '<option value="' . $item->id . '">' . $item->name . '</option>';
        }
    }

    //get cities
    public function get_cities()
    {
        $state_id = $this->input->post('state_id', true);
        $cities = $this->location_model->get_cities_by_state($state_id);
        foreach ($cities as $item) {
            echo '<option value="' . $item->id . '">' . $item->name . '</option>';
        }
    }

    //show address on map
    public function show_address_on_map()
    {
        $country_text = $this->input->post('country_text', true);
        $country_val = $this->input->post('country_val', true);
        $state_text = $this->input->post('state_text', true);
        $state_val = $this->input->post('state_val', true);
        $address = $this->input->post('address', true);
        $zip_code = $this->input->post('zip_code', true);

        $adress_details = $address . " " . $zip_code;
        $data["map_address"] = "";
        if (!empty($adress_details)) {
            $data["map_address"] = $adress_details . " ";
        }
        if (!empty($state_val)) {
            $data["map_address"] = $data["map_address"] . $state_text . " ";
        }
        if (!empty($country_val)) {
            $data["map_address"] = $data["map_address"] . $country_text;
        }

        $this->load->view('product/_load_map', $data);
    }



    //get activated product system
    public function get_activated_product_system()
    {
        $array = array(
            'active_system_count' => 0,
            'active_system_value' => "",
        );
        if ($this->general_settings->marketplace_system == 1) {
            $array['active_system_count'] = $array['active_system_count'] + 1;
            $array['active_system_value'] = "sell_on_site";
        }
        if ($this->general_settings->classified_ads_system == 1) {
            $array['active_system_count'] = $array['active_system_count'] + 1;
            $array['active_system_value'] = "ordinary_listing";
        }
        if ($this->general_settings->bidding_system == 1) {
            $array['active_system_count'] = $array['active_system_count'] + 1;
            $array['active_system_value'] = "bidding";
        }
        return $array;
    }

    /*
	*------------------------------------------------------------------------------------------
	* LICENSE KEYS
	*------------------------------------------------------------------------------------------
	*/
    //add license keys
    public function add_license_keys()
    {
        post_method();
        $product_id = $this->input->post('product_id', true);
        $product = $this->product_model->get_product_by_id($product_id);

        if (!empty($product)) {
            if ($this->auth_user->id == $product->user_id || $this->auth_user->role == 'admin') {
                $this->product_model->add_license_keys($product_id);
                $this->session->set_flashdata('success', trans("msg_add_license_keys"));
                $data = array(
                    'result' => 1,
                    'success_message' => $this->load->view('partials/_messages', '', true)
                );
                echo json_encode($data);
                reset_flash_data();
            }
        }
    }

    //delete license key
    public function delete_license_key()
    {
        post_method();
        $id = $this->input->post('id', true);
        $product_id = $this->input->post('product_id', true);
        $product = $this->product_model->get_product_by_id($product_id);
        if (!empty($product)) {
            if ($this->auth_user->id == $product->user_id || $this->auth_user->role == 'admin') {
                $this->product_model->delete_license_key($id);
            }
        }
    }

    //refresh license keys list
    public function refresh_license_keys_list()
    {
        post_method();
        $product_id = $this->input->post('product_id', true);
        $data['product'] = $this->product_model->get_product_by_id($product_id);
        if (!empty($data['product'])) {
            if ($this->auth_user->id == $data['product']->user_id || $this->auth_user->role == 'admin') {
                $data['license_keys'] = $this->product_model->get_license_keys($product_id);
                $this->load->view("product/license/_license_keys_list", $data);
            }
        }
    }

    public function view_method()
    {
        $item_id = $this->input->post("item_id", true);
        $this->session->set_userdata('mds_product_view_method', $item_id);
    }

    public function set_link_session()
    {
        $visible = $this->input->post("visible", true);
        $link_type = $this->input->post("link_type", true);
        $back_type = $this->input->post("back_type", true);
        $location_type = $this->input->post("location_type", true);
        $location_data = $this->input->post("location_data", true);

        if ($location_type != "undefined" && $back_type == "undefined") {
            $location_types = $this->session->userdata('mds_location_type_session');
            if (!is_array($location_types)) $location_types = array();
            $location_types[] = $location_type;
            $this->session->set_userdata('mds_location_type_session', $location_types);

            $location_datas = $this->session->userdata('mds_location_data_session');
            if (!is_array($location_datas)) $location_datas = array();
            $location_datas[] = $location_data;
            $this->session->set_userdata('mds_location_data_session', $location_datas);
        }

        if ($back_type == 1) {
            $mds_location_type_session = $this->session->userdata('mds_location_type_session');
            $mds_location_data_session = $this->session->userdata('mds_location_data_session');

            $this->session->set_userdata("mds_location_type_session", array_splice($mds_location_type_session, 0, -1));
            $this->session->set_userdata("mds_location_data_session", array_splice($mds_location_data_session, 0, -1));
        }

        $this->session->set_userdata('mds_link_session', $visible);
        $this->session->set_userdata('mds_link_type_session', $link_type);
        $json_data = array("result", "success");
        echo json_encode($json_data);
    }

    public function custom_field_data()
    {
        $id = $this->input->post("id", true);

        $data = $this->category_model->custom_field_data($id);
        echo json_encode($data);
    }

    public function products_filter($category_id)
    {
        // echo $category_id; exit;
        $data = [];
        $product_url = $this->agent->referrer();
        $param_str = parse_url($product_url);
        if (!empty($param_str['query'])) {
            $params = explode("&", $param_str['query']);
            foreach ($params as $param) {
                $ret = explode("=", $param);
                $data[$ret[0]] = $ret[1];
            }
            $data['page_param'] = true;
        } else {
            $data['page_param'] = false;
        }

        if ($category_id)
            $data['category'] = $this->category_model->get_full_category($category_id);
        else {
            $obj = new stdClass();
            $obj->name = trans("all");
            $obj->description = "";
            $obj->keywords = "";
            $data['category'] = $obj;
        }

        if ($data['category']) {

            if ($category_id)
                $data['subcategory'] = $this->category_model->get_subcategories_by_parent_id($category_id);
            else
                $data['subcategory'] = [];

            $data['title'] = !empty($data["category"]->title_meta_tag) ? $data["category"]->title_meta_tag : @$data["category"]->name;
            $data['description'] = @$data["category"]->description;
            $data['keywords'] = @$data["category"]->keywords;

            if ($category_id)
                $data['custom_filters'] = $this->settings_model->get_custom_product_conditions($category_id);
            else
                $data['custom_filters'] = [];

            $data['url'] = $product_url;

            if ($this->general_settings->default_product_location != 0) {
                $data["is_hkm_one_country"] = true;
                $data["is_hkm_one_country_value"] = $this->general_settings->default_product_location;
            } else {
                $data["is_hkm_one_country"] = false;
            }

            if ($category_id) {
                $top_parent_category_id = top_parent_category_id($category_id);
                $data['form_settings'] = $this->settings_model->get_form_settings($top_parent_category_id);
            } else {
                $obj = new stdClass();
                $obj->price = 1;
                $obj->product_conditions = 0;
                $data['form_settings'] = $obj;
            }

            $this->load->view('partials/_header', $data);
            $this->load->view('product/_product_mobile_filters', $data);
            $this->load->view('partials/_footer_mobile');
        } else {
            redirect(lang_base_url());
        }
    }
}
