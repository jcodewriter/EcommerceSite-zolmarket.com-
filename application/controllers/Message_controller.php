<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message_controller extends Home_Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }
    }

    /**
     * Messages
     */
    public function messages()
    {
        $data['title'] = trans("messages");
        $data['description'] = trans("messages") . " - " . $this->app_name;
        $data['keywords'] = trans("messages") . "," . $this->app_name;

        $data['conversation'] = $this->message_model->get_user_latest_conversation($this->auth_user->id);
        $data['user_session'] = get_user_session();

        if (!empty($data['conversation'])) {
            $data['unread_conversations'] = $this->message_model->get_unread_conversations($this->auth_user->id);
            $data['all_conversations'] = $this->message_model->get_all_conversations($this->auth_user->id);
            $data['read_conversations'] = $this->message_model->get_read_conversations($this->auth_user->id);
            $result = $this->message_model->get_first_conversations($this->auth_user->id);
            $data['read_conversations'] = array_merge($result, $data['read_conversations']);
            $data['myads_conversations'] = $this->message_model->get_myads_conversations($this->auth_user->id);
            $data['messages'] = $this->message_model->get_messages($data['conversation']->id);
            $data['block_users'] = $this->message_model->get_blocked_users($this->auth_user->id);
        }

        $this->load->view('partials/_header', $data);
        $this->load->view('message/messages', $data);
        $this->load->view('partials/_footer');
    }
    
    

    /**
     * Conversation
     */
    public function conversation($id)
    {
       $data['title'] = trans("messages");
        $data['description'] = trans("messages") . " - " . $this->app_name;
        $data['keywords'] = trans("messages") . "," . $this->app_name;

        $data['conversation'] = $this->message_model->get_conversation($id);
        $data['user_session'] = get_user_session();
        //check message
        if (empty($data['conversation'])) {
            redirect(lang_base_url() . "messages");
        }
        //check message owner
        if ($this->auth_user->id != $data['conversation']->sender_id && $this->auth_user->id != $data['conversation']->receiver_id) {
            redirect(lang_base_url() . "messages");
        }
        
       $this->message_model->set_conversation_messages_as_read($data['conversation']->id); /* sa read hkm */
        
        if ($this->auth_user->id == $data['conversation']->receiver_id) {
            $annonncer = $data['conversation']->sender_id;
            $contacter =  $data['conversation']->receiver_id;
            $data['resulttt'] =  $this->message_model->check_is_blocked($annonncer,$contacter);
        }
        elseif($this->auth_user->id == $data['conversation']->sender_id){
            $annonncer = $data['conversation']->receiver_id;
            $contacter =  $data['conversation']->sender_id;
            $data['resulttt'] =  $this->message_model->check_is_blocked($annonncer,$contacter);
        }
        
        if ($this->auth_user->id == $data['conversation']->sender_id) {
            $annonncer = $data['conversation']->sender_id;
            $contacter =  $data['conversation']->receiver_id;
            $data['resulttt_block'] =  $this->message_model->check_is_blocked($annonncer,$contacter);
        }
        elseif($this->auth_user->id == $data['conversation']->receiver_id){
            $annonncer = $data['conversation']->receiver_id;
            $contacter =  $data['conversation']->sender_id;
            $data['resulttt_block'] =  $this->message_model->check_is_blocked($annonncer,$contacter);
        }
        
        
       

        $data['unread_conversations'] = $this->message_model->get_unread_conversations($this->auth_user->id);
        $data['all_conversations'] = $this->message_model->get_all_conversations($this->auth_user->id);
        $data['read_conversations'] = $this->message_model->get_read_conversations($this->auth_user->id);
        $result = $this->message_model->get_first_conversations($this->auth_user->id);
        $data['read_conversations'] = array_merge($result, $data['read_conversations']);
        $data['messages'] = $this->message_model->get_messages($data['conversation']->id);
        $data['myads_conversations'] = $this->message_model->get_myads_conversations($this->auth_user->id);
        $data['unread_message_count'] = $this->message_model->get_unread_conversations_count($this->auth_user->id);
        
        $this->load->view('partials/_header', $data);
        $this->load->view('message/message__one_hkm', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Send Message
     */
    public function send_message()
    {
        $image_file = $this->input->post('userfile', true);
        if(empty($image_file)){
            $receiver_id = $this->input->post('receiver_id', true);
            $sender_id = $this->input->post('sender_id', true);
            $resulttt =  $this->message_model->check_is_blocked($receiver_id, $sender_id);
            if($resulttt == false){
                $conversation_id = $this->input->post('conversation_id', true);
                if ($this->message_model->add_message($conversation_id)) {
                    //send email
                    $message = $this->input->post('message', true);
                    $receiver = get_user($receiver_id);
                    if (!empty($receiver)) {
                        if ($receiver->send_email_new_message == 1) {
                            $this->send_email($conversation_id, $receiver_id, $sender_id, $message);
                        }
                    }
                }
            }
        }
        redirect($this->agent->referrer());
    }
    
    public function send_email ($conversation_id, $receiver_id, $sender_id, $message){
        $conversation = $this->message_model->get_conversation($conversation_id);
        $product = $this->product_model->get_product_by_slug($conversation->slug);
        $img_object = $this->message_model->get_image_path($conversation_id);
        $img_path = '';
        if (!(empty($img_object))) $img_path = base_url() . "uploads/images/" . $img_object->image_small;
        $receiver = get_user($receiver_id);
        if (!empty($receiver) && !empty($sender_id)) {
            $email_data = array(
                'subject' => trans("you_have_new_message"),
                'to' => $receiver->email,
                'template_path' => "email/email_new_ads_message",
                'message_sender' => "",
                'img_src' => $img_path,
                'conversation_id' => $conversation_id,
                'message_subject' => $conversation->subject,
                'product' => $product,
                'message_text' => $message
            );
            $sender = get_user($sender_id);
            if (!empty($sender)) {
                $email_data['message_sender'] = $sender->username;
            }
            $this->load->model("email_model");
            $this->email_model->send_email($email_data);
        }
    }

    /**
     * Add Conversation
     */
    public function add_conversation()
    {
        if ($this->auth_user->id == $this->input->post('receiver_id', true)) {
            $this->session->set_flashdata('error', trans("msg_message_sent_error"));
            $this->load->view('partials/_messages');
            reset_flash_data();
        } else {
            $conversation_id = $this->message_model->add_conversation();
            if ($conversation_id) {
                if ($this->message_model->add_message($conversation_id)) {
                    $this->session->set_flashdata('success', trans("msg_message_sent"));
                    $this->load->view('partials/_messages');
                    reset_flash_data();
                } else {
                    $this->session->set_flashdata('error', trans("msg_error"));
                    $this->load->view('partials/_messages');
                    reset_flash_data();
                }
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
                $this->load->view('partials/_messages');
                reset_flash_data();
            }
        }
    }

    /**
     * Delete Conversation
     */
    public function delete_conversation()
    {
        $conversation_id = $this->input->post('conversation_id', true);
        $this->message_model->delete_conversation($conversation_id);
    }
    
    /**
     * Block User Chating
     */
    public function block_user_conversation()
    {
        $block_by = $this->input->post('block_by', true);
        $block_in = $this->input->post('block_in', true);
        $this->message_model->block_user_conversation($block_by,$block_in);
    }
    
    public function un_block_user_conversation()
    {
        $block_by = $this->input->post('block_by', true);
        $block_in = $this->input->post('block_in', true);
        $this->message_model->un_block_user_conversation($block_by,$block_in);
    }
    
    public function check_is_blocked()
    {
        $annonncer = $this->input->post('annonncer', true);
        $contacter = $this->input->post('contacter', true);
        $data['is_blocked'] =  $this->message_model->check_is_blocked($annonncer,$contacter);
        echo json_encode($data);
    }
    
    public function send_image_chat(){
        $this->load->model('upload_model');
        $temp_path = $this->upload_model->upload_temp_image('userfile');
        if (!empty($temp_path)) {
            $file_name  = $this->upload_model->chat_image_upload($temp_path);
            $this->upload_model->delete_temp_image($temp_path);
        }
        
        $conversation_id = $this->input->post('conversation_id', true);
        if ($this->message_model->add_image_message($conversation_id, $file_name)) {
            $receiver_id = $this->input->post('receiver_id', true);
            $sender_id = $this->input->post('sender_id', true);
            $message = 'send you a image';
            $user = get_user($receiver_id);
            if (!empty($user)) {
                if ($user->send_email_new_message == 1) {
                    $this->send_email($conversation_id, $receiver_id, $sender_id, $message);
                }
            }
        }
        
    }
    
    public function send_image_chat_mobile(){
        $this->load->model('upload_model');
        $temp_path = $this->upload_model->upload_temp_image('userfile_mobile');
        if (!empty($temp_path)) {
            $file_name  = $this->upload_model->chat_image_upload($temp_path);
            $this->upload_model->delete_temp_image($temp_path);
        }
        
        $sender_id = $this->input->post('sender_id', true);
        $receiver_id = $this->input->post('receiver_id', true);
        $conversation_id = $this->input->post('conversation_id', true);
        if ($this->message_model->add_image_message($conversation_id, $file_name,  $sender_id, $receiver_id)) {
            $message = 'send you a image';
            $user = get_user($receiver_id);
            if (!empty($user)) {
                if ($user->send_email_new_message == 1) {
                    $this->send_email($conversation_id, $receiver_id, $sender_id, $message);
                }
            }
        }
        
    }
    
    public function send_imogi_chat_mobile(){
        $image_name = $this->input->post('inmogi_name', true);
        if( substr( $image_name, 0, 25 ) === "https://www.zolmarket.com"){
            $array_image_name = explode("https://www.zolmarket.com/uploads/profile/",$image_name);
            $image_name = $array_image_name[1];
            $conversation_id = $this->input->post('conversation_id', true);
            $sender_id = $this->input->post('sender_id', true);
            $receiver_id = $this->input->post('receiver_id', true);
            if ($this->message_model->add_image_message($conversation_id, $image_name, $sender_id, $receiver_id)) {
                $message = 'send you a emoji';
                $user = get_user($receiver_id);
                if (!empty($user)) {
                    if ($user->send_email_new_message == 1) {
                        $this->send_email($conversation_id, $receiver_id, $sender_id, $message);
                    }
                }
            }
        }
    }
    
    public function delete_message_in_chat(){
        $message_id = $this->input->post('message_id', true);
        if(is_numeric($message_id)){
            $this->message_model->delete_message_in_chat($message_id);
        }
        
    }


}