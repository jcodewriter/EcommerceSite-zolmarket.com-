<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model{
    /**
     * open/close shop
     * */
    public function admin($type, $user_id, $relation_user_id) {
        try {
            if ($type == 1) {
                $content = "Your shop has been closed";
            }else {
                $content = "Your shop has been opened";
            }

            $sql = "INSERT INTO notifications (`user_id`, `relation_user_id`, `notification_type`, `ads_id`, `content`, `action_time`) 
                        SELECT $user_id, $relation_user_id AS relation_user_id, $type AS notification_type, 0 AS ads_id, '$content' AS content, '".date('Y-m-d H:i:s')."' AS action_time";
            $this->db->query($sql);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
    /**
     * add comment
     * */
    public function comment($data = array()) {
        try {
            if (!$data["parent_id"]) {
                $row = $this->product_model->get_product_by_id($data["product_id"]);
            } else {
                $row = $this->comment_model->get_comment($data["parent_id"]);
            }
            $user_id = $row->user_id;
            $product_id = $data["product_id"];
            $content = $data["comment"];
            $relation_user_id = $data["user_id"];
            if ($user_id != $relation_user_id) {
                $sql = "INSERT INTO notifications (`user_id`, `relation_user_id`, `notification_type`, `ads_id`, `content`, `action_time`) 
                        SELECT $user_id, $relation_user_id AS relation_user_id, 4 AS notification_type, $product_id AS ads_id, '$content' AS content, '".date('Y-m-d H:i:s')."' AS action_time";
                $this->db->query($sql);    
            }
            // $sql = "INSERT INTO notifications (`user_id`, `relation_user_id`, `notification_type`, `ads_id`, `content`, `action_time`) 
            //             SELECT $user_id, $relation_user_id AS relation_user_id, 4 AS notification_type, $product_id AS ads_id, '$content' AS content, '".date('Y-m-d H:i:s')."' AS action_time";
            // $this->db->query($sql);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
    /**
     * add review
     * */
    public function review($data = array()) {
        try {
            $product = $this->product_model->get_product_by_id($data["product_id"]);
            $user_id = $data["user_id"];
            $product_id = $data["product_id"];
            $content = $data["review"];
            $rating = $data["rating"];
            $id = $product->user_id;
            $sql = "INSERT INTO notifications (`user_id`, `relation_user_id`, `notification_type`, `ads_id`, `content`, `rating`, `action_time`) 
                        SELECT $id, $user_id AS relation_user_id, 5 AS notification_type, $product_id AS ads_id, '$content' AS content, '$rating' AS rating, '".date('Y-m-d H:i:s')."' AS action_time";
            $this->db->query($sql);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
    /**
     * add product
     * */
    public function product($product = 1, $user_id = 1) {
        try {
            $sql = "INSERT INTO notifications (`user_id`, `relation_user_id`, `notification_type`, `ads_id`, `content`, `action_time`) 
                        SELECT t0.id, $user_id AS relation_user_id, 3 AS notification_type, $product AS ads_id, 'One product has been added.' AS content, '".date('Y-m-d H:i:s')."' AS action_time FROM users AS t0
                            JOIN followers AS t1 ON t1.following_id = $user_id AND t0.id = t1.follower_id";
            // echo $sql; exit;                
            $this->db->query($sql);
        }catch  (Exception $e) {
            return false;
        }
        return true;
    }
    /**
     * get notifications
     */
    public function get_notifications() {
        $user_id = clean_number($this->auth_user->id);
        $sql = "SELECT t0.*, t1.username, t1.slug, t1.avatar, t2.title, t2.slug AS product_slug FROM notifications AS t0
                JOIN users AS t1 ON t0.relation_user_id = t1.id
                LEFT JOIN products AS t2 ON t0.ads_id = t2.id WHERE t0.user_id = $user_id ORDER BY is_see, action_time DESC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function is_look($item_id){
        $id = clean_number($item_id);
        $data = array(
            'is_see' => 1
        );
        $this->db->where('id', $id);
        $this->db->update('notifications', $data);
        
        $this->db->where("id", $id);
        $query = $this->db->get("notifications");
        return $query->row();
    }

    public function delete_notification($item_id) {
        $item_id = clean_number($item_id);
        $this->db->where('id', $item_id);
        $this->db->delete('notifications');
    }
    
    public function unfollow($item_id) {
        $item_id = clean_number($item_id);
        $this->db->where('user_id', $this->auth_user->id);
        $this->db->where('relation_user_id', $item_id);
        $this->db->where('notification_type', 'add_ads');
        $this->db->delete('notifications');
    }
    
    public function get_notification_count(){
        $user_id = clean_number($this->auth_user->id);
        $this->db->where('user_id', $user_id);
        $this->db->where('is_see', 0);
        $query = $this->db->get('notifications');
        return $query->num_rows();
    }
    public function is_look_by_product($product){
        $data = array(
            'is_see' => 1
        );
        $this->db->where('ads_id', $product->id);
        $this->db->where('user_id', $this->auth_user->id);
        $this->db->update('notifications', $data);
    }

}