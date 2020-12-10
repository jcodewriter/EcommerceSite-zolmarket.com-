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
}
