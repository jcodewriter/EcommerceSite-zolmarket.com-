<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    //input values
    public function input_values()
    {

        $firstname = remove_special_characters($this->input->post('firstname', true));
        $lastname = remove_special_characters($this->input->post('lastname', true));

        $data = array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'username' => $firstname . '_' . $lastname,
            'email' => $this->input->post('email', true),
            'password' => $this->input->post('password', true)
        );
        return $data;
    }

    //login
    public function login()
    {
        $this->load->library('bcrypt');

        $data = $this->input_values();
        $user = $this->get_user_by_email($data['email']);

        if (!empty($user)) {
            //check password
            if (!$this->bcrypt->check_password($data['password'], $user->password)) {
                $this->session->set_flashdata('error', trans("login_error"));
                return false;
            }
            if ($user->banned == 1) {
                $this->session->set_flashdata('error', trans("msg_ban_error"));
                return false;
            }
            //set user data
            $user_data = array(
                'modesy_sess_user_id' => $user->id,
                'modesy_sess_user_email' => $user->email,
                'modesy_sess_user_role' => $user->role,
                'modesy_sess_logged_in' => true,
                'modesy_sess_app_key' => $this->config->item('app_key'),
            );
            $this->session->set_userdata($user_data);
            return true;
        } else {
            $this->session->set_flashdata('error', trans("login_error"));
            return false;
        }
    }

    //login direct
    public function login_direct($user)
    {
        //set user data
        $user_data = array(
            'modesy_sess_user_id' => $user->id,
            'modesy_sess_user_email' => $user->email,
            'modesy_sess_user_role' => $user->role,
            'modesy_sess_logged_in' => true,
            'modesy_sess_app_key' => $this->config->item('app_key'),
        );

        $this->session->set_userdata($user_data);
    }

    //login with facebook
    public function login_with_facebook($fb_user)
    {
        if (!empty($fb_user)) {
            $user = $this->get_user_by_email($fb_user->email);
            //check if user registered
            if (empty($user)) {
                if (empty($fb_user->name)) {
                    $fb_user->name = "user-" . uniqid();
                }
                $username = $this->generate_uniqe_username($fb_user->name);
                $slug = $this->generate_uniqe_slug($username);
                //add user to database
                $data = array(
                    'facebook_id' => $fb_user->id,
                    'email' => $fb_user->email,
                    'email_status' => 1,
                    'token' => generate_token(),
                    'username' => $username,
                    'slug' => $slug,
                    'avatar' => "https://graph.facebook.com/" . $fb_user->id . "/picture?type=large",
                    'user_type' => "facebook",
                    'created_at' => date('Y-m-d H:i:s')
                );
                if (!empty($data['email'])) {
                    $this->db->insert('users', $data);
                    $user = $this->get_user_by_email($fb_user->email);
                    $this->login_direct($user);
                }
            } else {
                //login
                $this->login_direct($user);
            }
        }
    }

    //login with google
    public function login_with_google($g_user)
    {
        if (!empty($g_user)) {
            $user = $this->get_user_by_email($g_user->email);
            //check if user registered
            if (empty($user)) {
                if (empty($g_user->name)) {
                    $g_user->name = "user-" . uniqid();
                }
                $username = $this->generate_uniqe_username($g_user->name);
                $slug = $this->generate_uniqe_slug($username);
                //add user to database
                $data = array(
                    'google_id' => $g_user->id,
                    'email' => $g_user->email,
                    'email_status' => 1,
                    'token' => generate_unique_id(),
                    'username' => $username,
                    'slug' => $slug,
                    'avatar' => $g_user->avatar,
                    'user_type' => "google",
                    'created_at' => date('Y-m-d H:i:s')
                );
                if (!empty($data['email'])) {
                    $this->db->insert('users', $data);
                    $user = $this->get_user_by_email($g_user->email);
                    $this->login_direct($user);
                }
            } else {
                //login
                $this->login_direct($user);
            }
        }
    }

    //generate uniqe username
    public function generate_uniqe_username($username)
    {
        $new_username = $username;
        if (!empty($this->get_user_by_username($new_username))) {
            $new_username = $username . " 1";
            if (!empty($this->get_user_by_username($new_username))) {
                $new_username = $username . " 2";
                if (!empty($this->get_user_by_username($new_username))) {
                    $new_username = $username . " 3";
                    if (!empty($this->get_user_by_username($new_username))) {
                        $new_username = $username . "-" . uniqid();
                    }
                }
            }
        }
        return $new_username;
    }

    //generate uniqe slug
    public function generate_uniqe_slug($username)
    {
        $slug = str_slug($username);
        if (!empty($this->get_user_by_slug($slug))) {
            $slug = str_slug($username . "-1");
            if (!empty($this->get_user_by_slug($slug))) {
                $slug = str_slug($username . "-2");
                if (!empty($this->get_user_by_slug($slug))) {
                    $slug = str_slug($username . "-3");
                    if (!empty($this->get_user_by_slug($slug))) {
                        $slug = str_slug($username . "-" . uniqid());
                    }
                }
            }
        }
        return $slug;
    }

    //register
    public function register()
    {
        $this->load->library('bcrypt');

        $data = $this->auth_model->input_values();
        // print_r($data); exit;
        $data['firstname'] = $data['firstname'];
        $data['lastname'] = $data['lastname'];
        $data['username'] = $data['firstname'] . '_' . $data['lastname'];
        //secure password
        $data['password'] = $this->bcrypt->hash_password($data['password']);
        $data['user_type'] = "registered";
        $data["slug"] = $this->generate_uniqe_slug($data["username"]);
        $data['banned'] = 0;
        $data['send_email_new_message'] = 1;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['token'] = generate_token();

        if ($this->db->insert('users', $data)) {
            $last_id = $this->db->insert_id();
            if ($this->general_settings->email_verification == 1) {
                $data['email_status'] = 0;
                $this->load->model("email_model");
                $this->email_model->send_email_activation($last_id);
            } else {
                $data['email_status'] = 1;
            }
            return $this->get_user($last_id);
        } else {
            return false;
        }
    }

    public function is_approval()
    {
        $data = ['is_approval' => 2];
        $this->db->where('id', user()->id);
        $this->db->update('users', $data);
    }

    //add administrator
    public function add_administrator()
    {
        $this->load->library('bcrypt');

        $data = $this->auth_model->input_values();
        //secure password
        $data['password'] = $this->bcrypt->hash_password($data['password']);
        $data['user_type'] = "registered";
        $data["slug"] = $this->generate_uniqe_slug($data["username"]);
        $data['role'] = "admin";
        $data['is_approval'] = 2;
        $data['banned'] = 0;
        $data['send_email_new_message'] = 1;
        $data['email_status'] = 1;
        $data['token'] = generate_token();
        $data['created_at'] = date('Y-m-d H:i:s');

        return $this->db->insert('users', $data);
    }

    //update slug
    public function update_slug($id)
    {
        $id = clean_number($id);
        $user = $this->get_user($id);

        if (empty($user->slug) || $user->slug == "-") {
            $data = array(
                'slug' => "user-" . $user->id,
            );
            $this->db->where('id', $id);
            $this->db->update('users', $data);
        } else {
            if ($this->check_is_slug_unique($user->slug, $id) == true) {
                $data = array(
                    'slug' => $user->slug . "-" . $user->id
                );

                $this->db->where('id', $id);
                $this->db->update('users', $data);
            }
        }
    }

    //logout
    public function logout()
    {
        //unset user data
        $this->session->unset_userdata('modesy_sess_user_id');
        $this->session->unset_userdata('modesy_sess_user_email');
        $this->session->unset_userdata('modesy_sess_user_role');
        $this->session->unset_userdata('modesy_sess_logged_in');
        $this->session->unset_userdata('modesy_sess_app_key');
    }

    //reset password
    public function reset_password($id)
    {
        $id = clean_number($id);
        $this->load->library('bcrypt');
        $new_password = $this->input->post('password', true);
        $data = array(
            'password' => $this->bcrypt->hash_password($new_password),
            'token' => generate_token()
        );
        //change password
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    //delete user
    public function delete_user($id)
    {
        $id = clean_number($id);
        $user = $this->get_user($id);
        if (!empty($user)) {
            // $select = "select *from comments where user_id = ".$id;

            $this->db->where('id', $id);
            return $this->db->delete('users');
        }
        return false;
    }

    //add shop opening requests
    public function add_shop_opening_requests($data)
    {
        if ($this->is_logged_in()) {
            $user = user();
            $this->db->where('id', $user->id);
            if (!$this->general_settings->vendor_verification_system) {
                $data['role'] = 'vendor';
                $data['is_approval'] = 1;
                $data['is_active_shop_request'] = 0;
            }
            $result = $this->db->update('users', $data);
            if (!$this->general_settings->vendor_verification_system) {
                if ($this->general_settings->email_option_store_added) {
                    $email_data = array(
                        'subject' => trans("add_post_exp"),
                        'icon_image' => "assets/img/success.png",
                        'to' => user()->email,
                        'shop_image' => user()->avatar,
                        'shop_name' => user()->username,
                        'slug' => "add-post",
                        'template_path' => "email/email_new_shop"
                    );
                    $this->load->model("email_model");
                    $this->email_model->send_email($email_data);
                }
            }
            return $result;
        }
    }

    //approve shop opening request
    public function approve_shop_opening_request($user_id)
    {
        $user_id = clean_number($user_id);
        if ($this->is_logged_in()) {
            //approve request
            if ($this->input->post('submit', true) == 1) {
                $data = array(
                    'role' => 'vendor',
                    'is_approval' => 1,
                    'is_active_shop_request' => 0,
                );
            } else {
                //decline request
                $data = array(
                    'is_active_shop_request' => 2,
                );
            }
            $this->db->where('id', $user_id);
            $result = $this->db->update('users', $data);
            $receiver = $this->get_user($user_id);
            if ($this->input->post('submit', true) == 1) {
                if ($this->general_settings->email_option_store_added) {
                    $email_data = array(
                        'subject' => trans("add_post_exp"),
                        'icon_image' => "assets/img/success.png",
                        'to' => $receiver->email,
                        'shop_image' => $receiver->avatar,
                        'shop_name' => $receiver->username,
                        'slug' => 'add-post',
                        'template_path' => "email/email_new_shop"
                    );
                    $this->load->model("email_model");
                    $this->email_model->send_email($email_data);
                }
            }
            return $result;
        }
    }

    //update last seen time
    public function update_last_seen()
    {
        if ($this->is_logged_in()) {
            $user = user();
            //update last seen
            $data = array(
                'last_seen' => date("Y-m-d H:i:s"),
            );
            $this->db->where('id', $user->id);
            $this->db->update('users', $data);
        }
    }

    //is logged in
    public function is_logged_in()
    {
        //check if user logged in
        if ($this->session->userdata('modesy_sess_logged_in') == true && $this->session->userdata('modesy_sess_app_key') == $this->config->item('app_key')) {
            $user = $this->get_user($this->session->userdata('modesy_sess_user_id'));
            if (!empty($user)) {
                if ($user->banned == 0) {
                    return true;
                }
            }
        }
        return false;
    }

    //function get user
    public function get_logged_user()
    {
        if ($this->is_logged_in()) {
            $user_id = $this->session->userdata('modesy_sess_user_id');
            $this->db->where('id', $user_id);
            $query = $this->db->get('users');
            return $query->row();
        }
    }

    //is admin
    public function is_admin()
    {
        //check logged in
        if ($this->is_logged_in()) {
            $user = $this->get_logged_user();
            if ($user->role == 'admin') {
                return true;
            }
        }
        return false;
    }

    //get user by id
    public function get_user($id)
    {
        $id = clean_number($id);
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row();
    }

    //get user by email
    public function get_user_by_email($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->row();
    }

    //get user by username
    public function get_user_by_username($username)
    {
        $username = remove_special_characters($username);
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        return $query->row();
    }

    //get user by shop name
    public function get_user_by_shop_name($shop_name)
    {
        $shop_name = remove_special_characters($shop_name);
        $this->db->where('shop_name', $shop_name);
        $query = $this->db->get('users');
        return $query->row();
    }

    //get user by slug
    public function get_user_by_slug($slug)
    {
        $slug = clean_slug($slug);
        $this->db->where('slug', $slug);
        $query = $this->db->get('users');
        return $query->row();
    }

    //get user by token
    public function get_user_by_token($token)
    {
        $token = remove_special_characters($token);
        $this->db->where('token', $token);
        $query = $this->db->get('users');
        return $query->row();
    }

    //get users
    public function get_users()
    {
        $query = $this->db->get('users');
        return $query->result();
    }

    //get users count
    public function get_users_count()
    {
        $query = $this->db->get('users');
        return $query->num_rows();
    }

    //get members
    public function get_members()
    {
        $this->db->where('role', "member");
        $query = $this->db->get('users');
        return $query->result();
    }

    //get vendors
    public function get_vendors()
    {
        $this->db->where('role', "vendor");
        $query = $this->db->get('users');
        return $query->result();
    }

    //get latest members
    public function get_latest_members($limit)
    {
        $limit = clean_number($limit);
        $this->db->limit($limit);
        $this->db->order_by('users.id', 'DESC');
        $query = $this->db->get('users');
        return $query->result();
    }

    //get members count
    public function get_members_count()
    {
        $this->db->where('role', "member");
        $query = $this->db->get('users');
        return $query->num_rows();
    }

    //get administrators
    public function get_administrators()
    {
        $this->db->where('role', "admin");
        $query = $this->db->get('users');
        return $query->result();
    }

    //get shop opening requests
    public function get_shop_opening_requests()
    {
        $this->db->where('is_active_shop_request', 1);
        $query = $this->db->get('users');
        return $query->result();
    }

    //get last users
    public function get_last_users()
    {
        $this->db->order_by('users.id', 'DESC');
        $this->db->limit(7);
        $query = $this->db->get('users');
        return $query->result();
    }

    //check slug
    public function check_is_slug_unique($slug, $id)
    {
        $slug = clean_slug($slug);
        $id = clean_number($id);
        $this->db->where('users.slug', $slug);
        $this->db->where('users.id !=', $id);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //check if email is unique
    public function is_unique_email($email, $user_id = 0)
    {
        $user_id = clean_number($user_id);
        $user = $this->auth_model->get_user_by_email($email);

        //if id doesnt exists
        if ($user_id == 0) {
            if (empty($user)) {
                return true;
            } else {
                return false;
            }
        }

        if ($user_id != 0) {
            if (!empty($user) && $user->id != $user_id) {
                //email taken
                return false;
            } else {
                return true;
            }
        }
    }

    //check if username is unique
    public function is_unique_username($username, $user_id = 0)
    {
        $user = $this->get_user_by_username($username);

        //if id doesnt exists
        if ($user_id == 0) {
            if (empty($user)) {
                return true;
            } else {
                return false;
            }
        }

        if ($user_id != 0) {
            if (!empty($user) && $user->id != $user_id) {
                //username taken
                return false;
            } else {
                return true;
            }
        }
    }

    //check if shop name is unique
    public function is_unique_shop_name($shop_name, $user_id = 0)
    {
        $user = $this->get_user_by_shop_name($shop_name);

        //if id doesnt exists
        if ($user_id == 0) {
            if (empty($user)) {
                return true;
            } else {
                return false;
            }
        }

        if ($user_id != 0) {
            if (!empty($user) && $user->id != $user_id) {
                //shop name taken
                return false;
            } else {
                return true;
            }
        }
    }

    //verify email
    public function verify_email($user)
    {
        if (!empty($user)) {
            $data = array(
                'email_status' => 1,
                'token' => generate_token()
            );
            $this->db->where('id', $user->id);
            return $this->db->update('users', $data);
        }
        return false;
    }

    //ban or remove user ban
    public function ban_remove_ban_user($id)
    {
        $id = clean_number($id);
        $user = $this->get_user($id);

        if (!empty($user)) {
            $data = array();
            if ($user->banned == 0) {
                $data['banned'] = 1;
            }
            if ($user->banned == 1) {
                $data['banned'] = 0;
            }

            $this->db->where('id', $id);
            return $this->db->update('users', $data);
        }

        return false;
    }

    //decline User
    public function decline_user($id)
    {
        $id = clean_number($id);
        $user = $this->get_user($id);

        if (!empty($user)) {
            $data = array();
            if ($user->is_active_shop_request == 0) {
                $data['is_active_shop_request'] = 2;
                if ($user->role == 'vendor') {
                    $data['is_approval'] = 0;
                }
                $this->notification_model->admin(1, $id, $this->auth_user->id);
            }
            if ($user->is_active_shop_request == 2) {
                $data['is_active_shop_request'] = 0;
                if ($user->country_id) {
                    $data['is_approval'] = 2;
                }
                $this->notification_model->admin(2, $id, $this->auth_user->id);
            }

            $this->db->where('id', $id);
            $result = $this->db->update('users', $data);

            $receiver = $this->get_user($id);
            if ($this->general_settings->email_option_store_added) {
                $email_data = array(
                    'subject' => !$receiver->is_active_shop_request ? trans("add_post_exp") : trans("your_shop_email_closed"),
                    'to' => $receiver->email,
                    'icon_image' => !$receiver->is_active_shop_request ? "assets/img/success.png" : "assets/img/decline.png",
                    'shop_image' => $receiver->avatar,
                    'shop_name' => $receiver->username,
                    'slug' => !$receiver->is_active_shop_request ? "add-post" : "contact",
                    'template_path' => "email/email_new_shop"
                );
                $this->load->model("email_model");
                $this->email_model->send_email($email_data);
            }
            return $result;
        }
        return false;
    }

    //open close user shop
    public function open_close_user_shop($id)
    {
        $id = clean_number($id);
        $user = $this->get_user($id);

        if (!empty($user)) {
            $data = array();
            if ($user->role == 'member') {
                $data['role'] = 'vendor';
                $data['is_approval'] = 2;
                $data['is_active_shop_request'] = 0;
            } else {
                $data['role'] = 'member';
                $data['is_approval'] = 0;
                $data['is_active_shop_request'] = 0;
            }
            $this->db->where('id', $id);
            $result = $this->db->update('users', $data);

            $receiver = $this->get_user($id);
            if ($this->general_settings->email_option_store_added && $receiver->role == "vendor") {
                $email_data = array(
                    'subject' => trans("add_post_exp"),
                    'icon_image' => "assets/img/success.png",
                    'to' => $receiver->email,
                    'shop_image' => $receiver->avatar,
                    'shop_name' => $receiver->username,
                    'slug' => "add-post",
                    'template_path' => "email/email_new_shop"
                );
                $this->load->model("email_model");
                $this->email_model->send_email($email_data);
            }
            return $result;
        }

        return false;
    }

    public function set_vendor_verification_system()
    {
        $data = [
            'is_active_shop_request' => 0,
            'role' => 'vendor',
            'is_approval' => 2
        ];
        $this->db->where('is_active_shop_request', 1);
        $this->db->where('role', 'member');
        return $this->db->update('users', $data);
    }
}
