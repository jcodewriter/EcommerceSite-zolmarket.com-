<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message_model extends CI_Model
{
    //add conversation
    public function add_conversation()
    {
        $data = array(
            'sender_id' => $this->input->post('sender_id', true),
            'receiver_id' => $this->input->post('receiver_id', true),
            'subject' => $this->input->post('subject', true),
            'slug' => $this->input->post('slug', true),
            'created_at' => date("Y-m-d H:i:s")
        );

        //check conversation exists
        $this->db->where('sender_id', $data['sender_id']);
        $this->db->where('receiver_id', $data['receiver_id']);
        $this->db->where('subject', $data['subject']);
        $this->db->where('slug', $data['slug']);
        $query = $this->db->get('conversations');
        $row = $query->row();

        if (!empty($row)) {
            return $row->id;
        } else {
            if ($this->db->insert('conversations', $data)) {
                return $this->db->insert_id();
            } else {
                return false;
            }
        }
    }

    //add message
    public function add_message($conversation_id)
    {
        $conversation_id = clean_number($conversation_id);
        $data = array(
            'conversation_id' => $conversation_id,
            'sender_id' => $this->input->post('sender_id', true),
            'receiver_id' => $this->input->post('receiver_id', true),
            'message' => ($this->input->post('message', true)),
            'is_read' => 0,
            'deleted_user_id' => 0,
            'created_at' => date("Y-m-d H:i:s")
        );
        
        if (!empty($data['message'])) {
            return $this->db->insert('conversation_messages', $data);
        }
        return false;
    }
    
    //add first message
    public function add_first_message($conversation_id)
    {
        $conversation_id = clean_number($conversation_id);
        $data = array(
            'conversation_id' => $conversation_id,
            'sender_id' => $this->input->post('sender_id', true),
            'receiver_id' => $this->input->post('receiver_id', true),
            'message' => ($this->input->post('message', true)),
            'is_read' => 1,
            'deleted_user_id' => 0,
            'created_at' => date("Y-m-d H:i:s")
        );
        
        if (!empty($data['message'])) {
            return $this->db->insert('conversation_messages', $data);
        }
        return false;
    }

    //get unread conversations
    public function get_unread_conversations($user_id)
    {
        $user_id = clean_number($user_id);
        $sql = "SELECT t1.*, t0.m_created_at, t0.unread_num FROM 
                (SELECT *, SUM(IF(receiver_id = $user_id AND is_read = 0, 1, 0)) AS unread_num, MAX(created_at) AS m_created_at 
                    FROM conversation_messages WHERE (receiver_id = $user_id) AND deleted_user_id != $user_id GROUP BY conversation_id ORDER BY m_created_at DESC) AS t0
                JOIN conversations AS t1 ON t0.conversation_id = t1.id WHERE t0.unread_num > 0 ORDER BY t0.m_created_at DESC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //get read_conversations
    public function get_read_conversations($user_id)
    {
        $user_id = clean_number($user_id);
        $query_unread_conversations = $this->get_user_unread_conversation_ids_query($user_id);
        $query_read_conversations = $this->get_user_read_conversation_ids_query($user_id);
        $this->db->where("conversations.id IN ($query_read_conversations)", NULL, FALSE);
        $this->db->where("conversations.id NOT IN ($query_unread_conversations)", NULL, FALSE);
        $this->db->order_by('conversations.created_at', 'DESC');
        $this->db->distinct();
        $query = $this->db->get('conversations');
        return $query->result();
    }
    
    // get first conversations
    public function get_first_conversations($user_id){
        $user_id = clean_number($user_id);
        $select = "SELECT t0.id, t0.sender_id, t0.receiver_id, t0.subject, t0.slug, t0.created_at FROM (SELECT t0.*, t1.is_read, SUM(t1.is_read) AS cnt FROM conversations AS t0
                    JOIN conversation_messages AS t1 ON t0.id = t1.conversation_id
                    WHERE t0.sender_id = $user_id GROUP BY t0.id HAVING cnt < 2) AS t0
                    WHERE t0.is_read = 0";
        $query = $this->db->query($select);
        return $query->result();
    }

    //get user latest conversation
    public function get_user_latest_conversation($user_id)
    {
        $user_id = clean_number($user_id);
        $this->db->join('conversation_messages', 'conversation_messages.conversation_id = conversations.id');
        $this->db->select('conversations.*, conversation_messages.is_read as is_read');
        $this->db->where('conversations.sender_id', $user_id);
        $this->db->or_where('conversations.receiver_id', $user_id);
        $this->db->order_by('conversations.created_at', 'DESC');
        $query = $this->db->get('conversations');
        return $query->row();
    }

    //get conversation
    public function get_conversation($id)
    {
        $id = clean_number($id);
        $this->db->where('id', $id);
        $query = $this->db->get('conversations');
        return $query->row();
    }

    //get messages
    public function get_messages($conversation_id)
    {
        $conversation_id = clean_number($conversation_id);
        $this->db->where('conversation_id', $conversation_id);
        $this->db->where('dlt_by_recived', 0);
        $this->db->where('dlt_by_sender', 0);
        // $this->db->where('deleted_user_id', 0);
        $query = $this->db->get('conversation_messages');
        return $query->result();
    }

    //get unread conversation count
    public function get_unread_conversations_count($receiver_id)
    {
        $receiver_id = clean_number($receiver_id);
        $sql = 'SELECT *FROM conversations AS t0
                JOIN conversation_messages AS t1 ON t0.id = t1.conversation_id
                JOIN users AS t2 ON t0.sender_id = t2.id
                WHERE t1.receiver_id = '.$receiver_id.' AND t1.is_read = 0 GROUP BY t0.id';
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    //set conversation messages as read
    public function set_conversation_messages_as_read($conversation_id)
    {
        $conversation_id = clean_number($conversation_id);
        $messages = $this->get_unread_messages($conversation_id);
        if (!empty($messages)) {
            foreach ($messages as $message) {
                if ($message->receiver_id == $this->auth_user->id) {
                    $data = array(
                        'is_read' => 1
                    );
                    $this->db->where('id', $message->id);
                    $this->db->update('conversation_messages', $data);
                }
            }
        }
    }

    //get unread messages
    public function get_unread_messages($conversation_id)
    {
        $conversation_id = clean_number($conversation_id);
        $this->db->where('conversation_id', $conversation_id);
        $this->db->where('receiver_id', $this->auth_user->id);
        $this->db->where('is_read', 0);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('conversation_messages');
        return $query->result();
    }

    //get conversation unread messages count
    public function get_conversation_unread_messages_count($conversation_id)
    {
        $conversation_id = clean_number($conversation_id);
        // $this->db->where('conversation_id', $conversation_id);
        // $this->db->where('receiver_id', $this->auth_user->id);
        // $this->db->where('is_read', 0);
        // $query = $this->db->get('conversation_messages');
        $sql = 'SELECT *FROM conversations AS t0
                JOIN conversation_messages AS t1 ON t0.id = '.$conversation_id.' AND t0.id = t1.conversation_id
                JOIN users AS t2 ON t0.sender_id = t2.id
                WHERE t1.receiver_id = '.($this->auth_user->id).' t1.is_read = 0';
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    //get user unread conversation ids
    public function get_user_unread_conversation_ids_query($user_id)
    {
        $user_id = clean_number($user_id);
        $this->db->select('conversation_id');
        $this->db->where('receiver_id', $user_id);
        $this->db->where('deleted_user_id !=', $user_id);
        $this->db->where('is_read', 0);
        $this->db->distinct();
        $this->db->from('conversation_messages');
        $query = $this->db->get_compiled_select();
        $this->db->reset_query();
        return $query;
    }

    //get user read conversation ids
    public function get_user_read_conversation_ids_query($user_id)
    {
        $user_id = clean_number($user_id);
        $this->db->select('conversation_id');
        $this->db->group_start();
        $this->db->where('sender_id', $user_id);
        $this->db->or_where('receiver_id', $user_id);
        $this->db->group_end();
        $this->db->where('deleted_user_id !=', $user_id);
        $this->db->where('is_read', 1);
        $this->db->distinct();
        $this->db->from('conversation_messages');
        $query = $this->db->get_compiled_select();
        $this->db->reset_query();
        return $query;
    }

    //delete conversation
    public function delete_conversation($id)
    {
        $id = clean_number($id);
        $conversation = $this->get_conversation($id);
        if (!empty($conversation)) {
            $messages = $this->get_messages($conversation->id);

            if (!empty($messages)) {
                foreach ($messages as $message) {
                    if ($message->sender_id == $this->auth_user->id || $message->receiver_id == $this->auth_user->id) {
                        if ($message->deleted_user_id == 0) {
                            $data = array(
                                'deleted_user_id' => $this->auth_user->id
                            );
                            $this->db->where('id', $message->id);
                            $this->db->update('conversation_messages', $data);
                        } else {
                            $this->db->where('id', $message->id);
                            $this->db->delete('conversation_messages');
                        }
                    }
                }
            }

            //delete conversation if does not have messages
            $messages = $this->get_messages($conversation->id);
            // if (empty($messages)) {
            //     $this->db->where('id', $conversation->id);
            //     $this->db->delete('conversations');
            // }
        }
    }
    
    //block_user_conversation conversation
    public function block_user_conversation($block_by,$block_in)
    {
        $block_by = clean_number($block_by);
        $block_in = clean_number($block_in);
        
        if (!empty($block_by) && !empty($block_in)) {
            $data = array(
                'block_by' => $block_by,
                'block_in' => $block_in,
            );
            $this->db->insert('chatts_block', $data);
        }
    }
    
    // un block_user_conversation
    public function un_block_user_conversation($block_by,$block_in)
    {
        $block_by = clean_number($block_by);
        $block_in = clean_number($block_in);
        
        if (!empty($block_by) && !empty($block_in)) {
            $data = array(
                'block_by' => $block_by,
                'block_in' => $block_in,
            );
            $this->db->delete('chatts_block', $data);
        }
    }
    
    //get_blocked_users conversation
    public function get_blocked_users($id)
    {
        $id = clean_number($id);

        $this->db->where('chatts_block.block_by', $id);
        $this->db->order_by('chatts_block.created_at', 'DESC');
        $query = $this->db->get('chatts_block');
        return $query->result();
    }
   
    
    public function getproduct_by_title_hkm($slug){
        $this->db->where('products.slug', $slug);
        $this->db->order_by('products.created_at', 'DESC');
        $query = $this->db->get('products');
        return $query->result();
    }
    
    //get_blocked_users conversation
    public function check_is_blocked($annonncer,$contacter)
    {
        $annonncer = clean_number($annonncer);
        $contacter = clean_number($contacter);
        $this->db->where('chatts_block.block_by', $annonncer);
        $this->db->where('chatts_block.block_in', $contacter);
        $this->db->order_by('chatts_block.created_at', 'DESC');
        $query = $this->db->get('chatts_block');
        $count =  $query->num_rows();
        if($count > 0){
            return true;
        }else{
            return false;
        }
        
    }
    
     //get my ads conversations
    public function get_myads_conversations($user_id)
    {
        $user_id = clean_number($user_id);
        $sql = "SELECT t1.*, t0.m_created_at, t0.unread_num FROM 
                (SELECT *, SUM(IF(receiver_id = $user_id AND is_read = 0, 1, 0)) AS unread_num, MAX(created_at) AS m_created_at 
                    FROM conversation_messages WHERE (receiver_id = $user_id) AND deleted_user_id != $user_id GROUP BY conversation_id ORDER BY m_created_at DESC) AS t0
                JOIN conversations AS t1 ON t0.conversation_id = t1.id ORDER BY t0.m_created_at DESC";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //add image message
    public function add_image_message($conversation_id,$image_name)
    {
        $conversation_id = clean_number($conversation_id);
        $data = array(
            'conversation_id' => $conversation_id,
            'sender_id' => $this->input->post('sender_id', true),
            'receiver_id' => $this->input->post('receiver_id', true),
            'message' => $image_name,
            'msg_type' => 'img',
            'is_read' => 0,
            'deleted_user_id' => 0,
            'created_at' => date("Y-m-d H:i:s")
        );
        if (!empty($data['message'])) {
            return $this->db->insert('conversation_messages', $data);
        }
        return false;
    }
    
     //delete_message_in_chat
    public function delete_message_in_chat($message_id)
    {
        $message_id = clean_number($message_id);
        $this->db->where('conversation_messages.id', $message_id);
        $query = $this->db->get('conversation_messages');
        $message = $query->row();

        if (!empty($message) && $message->receiver_id == $this->auth_user->id) {
            $data = array(
                'dlt_by_recived' => 1
            );
            $this->db->where('id', $message->id);
            $this->db->update('conversation_messages', $data);
        }
        elseif(!empty($message) && $message->sender_id == $this->auth_user->id) {
             $data = array(
                'dlt_by_sender' => 1
            );
            $this->db->where('id', $message->id);
            $this->db->update('conversation_messages', $data);
        }

        
    }
    
    public function get_image_path ($conversation_id) {
        $conversation_id = clean_number($conversation_id);
        $select = 'select t1.* from (select *from products where slug in (select slug from conversations where id = '.$conversation_id.')) as t0 
                    join images as t1 on t0.id = t1.product_id';
        $query = $this->db->query($select);
        return $query->row();
    }

    //get all_conversations
    public function get_all_conversations($user_id)
    {
        $user_id = clean_number($user_id);
        $sql = "SELECT t1.*, t0.m_created_at, t0.unread_num FROM 
                (SELECT *, SUM(IF(receiver_id = $user_id AND is_read = 0, 1, 0)) AS unread_num, MAX(created_at) AS m_created_at 
                    FROM conversation_messages WHERE (sender_id = $user_id OR receiver_id = $user_id) AND deleted_user_id != $user_id GROUP BY conversation_id ORDER BY m_created_at DESC) AS t0
                JOIN conversations AS t1 ON t0.conversation_id = t1.id ORDER BY t0.m_created_at DESC";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_last_message ($conversation_id) {
        $conversation_id = clean_number($conversation_id);
        $sql = "select *from conversation_messages where conversation_id = $conversation_id order by created_at desc";
        $query = $this->db->query($sql);
        return $query->row();
    }
}