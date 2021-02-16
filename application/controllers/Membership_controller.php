<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Membership_controller extends Admin_Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        //check user
        if (!is_admin()) {
            redirect(admin_url() . 'login');
        }
        $this->_user_session = get_user_session();
    }

    /*
    *------------------------------------------------------------------------------------------
    * MEMBERSHIP PLANS
    *------------------------------------------------------------------------------------------
    */

    /**
     * Membership Plans
     */
    public function membership_plans()
    {
        $data['title'] = trans("membership_plans");
        $data["membership_plans"] = $this->membership_model->get_plans();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/membership/membership_plans');
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Add Plan Post
     */
    public function add_plan_post()
    {
        if ($this->membership_model->add_plan()) {
            $this->session->set_flashdata('success', trans("msg_added"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        redirect($this->agent->referrer());
    }

    /**
     * Edit Plan
     */
    public function edit_plan($id)
    {
        $data['title'] = trans("edit_plan");
        $data['plan'] = $this->membership_model->get_plan($id);
        if (empty($data['plan'])) {
            redirect($this->agent->referrer());
            exit();
        }
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/membership/edit_plan');
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Edit Plan Post
     */
    public function edit_plan_post()
    {
        $id = $this->input->post('id', true);
        if ($this->membership_model->edit_plan($id)) {
            $this->session->set_flashdata('success', trans("msg_updated"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        redirect($this->agent->referrer());
    }

    /**
     * Settings Post
     */
    public function settings_post()
    {
        if ($this->membership_model->update_settings()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        $this->session->set_flashdata('msg_settings', 1);
        redirect($this->agent->referrer());
    }

    /**
     * Delete Plan Post
     */
    public function delete_plan_post()
    {
        $id = $this->input->post('id', true);
        $this->membership_model->delete_plan($id);
        redirect($this->agent->referrer());
    }

    /**
     * Edit User
     */
    public function edit_user($id)
    {
        $data['title'] = trans("edit_user");
        $data['user'] = $this->auth_model->get_user($id);
        if (empty($data['user'])) {
            redirect(admin_url() . "members");
        }
        $data["countries"] = $this->location_model->get_countries();
        $data["states"] = $this->location_model->get_states_by_country($data['user']->country_id);
        $data["cities"] = $this->location_model->get_cities_by_state($data['user']->state_id);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/users/edit_user');
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Edit User Post
     */
    public function edit_user_post()
    {
        //validate inputs
        $this->form_validation->set_rules('username', trans("username"), 'required|xss_clean|max_length[255]');
        $this->form_validation->set_rules('email', trans("email"), 'required|xss_clean');
        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect($this->agent->referrer());
        } else {
            $data = array(
                'id' => $this->input->post('id', true),
                'username' => $this->input->post('username', true),
                'slug' => $this->input->post('slug', true),
                'email' => $this->input->post('email', true)
            );
            //is email unique
            if (!$this->auth_model->is_unique_email($data["email"], $data["id"])) {
                $this->session->set_flashdata('error', trans("msg_email_unique_error"));
                redirect($this->agent->referrer());
                exit();
            }
            //is username unique
            if (!$this->auth_model->is_unique_username($data["username"], $data["id"])) {
                $this->session->set_flashdata('error', trans("msg_username_unique_error"));
                redirect($this->agent->referrer());
                exit();
            }
            //is slug unique
            if ($this->auth_model->check_is_slug_unique($data["slug"], $data["id"])) {
                $this->session->set_flashdata('error', trans("msg_slug_unique_error"));
                redirect($this->agent->referrer());
                exit();
            }

            if ($this->profile_model->edit_user($data["id"])) {
                $this->session->set_flashdata('success', trans("msg_updated"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }

    /**
     * Membership Transactions
     */
    public function transactions_membership()
    {
        $data['title'] = trans("membership_transactions");
        $data['description'] = trans("membership_transactions") . " - " . $this->app_name;
        $data['keywords'] = trans("membership_transactions") . "," . $this->app_name;

        $data['num_rows'] = $this->membership_model->get_membership_transactions_count(null);
        $pagination = $this->paginate(admin_url() . "membership-transactions", $data['num_rows']);
        $this->order_admin_model->show_notifications(".010.001");
        $data['transactions'] = $this->membership_model->get_paginated_membership_transactions(null, $pagination['per_page'], $pagination['offset']);
        
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/membership/transactions');
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Approve Payment Post
     */
    public function approve_payment_post()
    {
        $id = $this->input->post('id', true);
        $this->membership_model->approve_transaction_payment($id);
        $this->session->set_flashdata('success', trans("msg_updated"));
        redirect($this->agent->referrer());
    }

    /**
     * Delete Transactions Post
     */
    public function delete_transaction_post()
    {
        $id = $this->input->post('id', true);
        $this->membership_model->delete_transaction($id);
    }
}
