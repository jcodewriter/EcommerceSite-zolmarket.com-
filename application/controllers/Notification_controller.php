<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_controller extends Home_Core_Controller
{
    /*
     * Payment Types
     *
     * 1. sale: Product purchases
     * 2. promote: Promote purchases
     *
     */

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Cart
     */
    public function index() {
        $data["title"] = trans("notification");
        $data["description"] = trans("notification") . " - " . $this->app_name;
        $data["keywords"] = trans("notification") . "," . $this->app_name;
        $data["notifications"] = $this->notification_model->get_notifications();
        // print_r($data); exit;

        $this->load->view('partials/_header', $data);
        $this->load->view('notification/index', $data);
        $this->load->view('partials/_footer');
    }
    /**
     * visible method
     **/
    public function show($notification_id) {
        $data = $this->notification_model->is_look($notification_id);
        if ($data->ads_id) {
            $product = $this->product_model->get_product_by_id($data->ads_id);
            redirect(lang_base_url().$product->slug);
        }else {
            redirect(lang_base_url()."sell-now");
        }
    }
    /**
     * delete notification
     **/
    public function unfollow() {
        $item_id = $this->input->post("item_id", true);
        $this->notification_model->unfollow($item_id);
        return true;
    }
    /**
     * delete notification
     **/
    public function delete_notification() {
        $item_id = $this->input->post("item_id", true);
        $this->notification_model->delete_notification($item_id);
        return true;
    }
}
