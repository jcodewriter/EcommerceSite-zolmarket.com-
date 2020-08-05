<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment_model extends CI_Model
{

    /*
    *-------------------------------------------------------------------------------------------------
    * PRODUCT COMMENTS
    *-------------------------------------------------------------------------------------------------
    */

    //add comment
    public function add_comment()
    {
        $parent_id = $this->input->post('parent_id', true);
        $data = array(
            'parent_id' => $parent_id,
            'product_id' => $this->input->post('product_id', true),
            'user_id' => $this->input->post('user_id', true),
            'name' => $this->input->post('name', true),
            'email' => $this->input->post('email', true),
            'comment' => $this->input->post('comment', true),
            'created_at' => date("Y-m-d H:i:s"),

        );
        
        if ($data['product_id'] && trim($data['comment'])) {
            if ($data['user_id'] != 0) {
                $user = $this->auth_model->get_user($data['user_id']);
                if (!empty($user)) {
                    $data['name'] = $user->username;
                    $data['email'] = $user->email;
                }
            }
            $this->db->insert('comments', $data);

            $new_id = $this->db->insert_id();
            if (!$parent_id){
                $update_data = array(
                    'comment_class' => str_pad($new_id, 6, ".00000", STR_PAD_LEFT)
                );
            } else {
                $new_row = $this->db->where('id', $parent_id)->get('comments')->row();
                $update_data = array(
                    'comment_class' => $new_row->comment_class.str_pad($new_id, 6, ".00000", STR_PAD_LEFT)
                );
            }
            // echo $new_id; exit;
            $this->db->where('id', $new_id);
            $this->db->update('comments', $update_data);
            $this->notification_model->comment($data);
        }

        // $product = $this->product_model->get_product_by_id($data["product_id"]);
        // if ($product->user_id != $data["user_id"]){
        //     $row = $this->db->where('id', $new_id)->get('comments')->row();
        //     $this->notification_model->comment($row);
        // }
    }

    //all comments
    public function get_all_comments()
    {
        $this->db->order_by('comments.created_at', 'DESC');
        $query = $this->db->get('comments');
        return $query->result();
    }

    //latest comments
    public function get_latest_comments($limit)
    {
        $limit = clean_number($limit);
        $this->db->order_by('comments.created_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get('comments');
        return $query->result();
    }

    //comments
    public function get_comments($product_id, $limit)
    {
        $product_id = clean_number($product_id);
        $limit = clean_number($limit);
        // $this->db->where('parent_id', 0);
        // $this->db->where('product_id', $product_id);
        // $this->db->order_by('comments.created_at', 'DESC');
        // $this->db->limit($limit);
        // $query = $this->db->get('comments');
        $this->db->join('users', 'users.id = comments.user_id');
        $this->db->select('comments.*, users.slug as user_slug');
        $this->db->where('comments.parent_id', 0);
        $this->db->where('comments.product_id', $product_id);
        $this->db->order_by('comments.created_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get('comments');
        return $query->result();
    }

    //subomments
    public function get_subcomments($parent_id)
    {
        $parent_id = clean_number($parent_id);
        $parent_class = str_pad($parent_id, 6, ".00000", STR_PAD_LEFT);
        // $this->db->like('comment_class', $parent_class, 'both');
        // $this->db->where('parent_id != ', 0);
        // $this->db->order_by('comments.comment_class', 'ASC');
        // $query = $this->db->get('comments');
        // $select = "SELECT t0.*, t1.slug as user_slug FROM comments AS t0
        //             JOIN users AS t1 ON t0.user_id = t1.id WHERE comment_class LIKE '%$parent_class%' AND parent_id != 0 ORDER BY t0.created_at";
        $select = "SELECT t0.*, t1.username AS parent_user_name, t2.slug AS user_slug FROM 
                	(SELECT t0. user_id AS parent_user_id, t1.* FROM comments AS t0
                	JOIN comments AS t1 ON t0.id = t1.parent_id) AS t0
                	LEFT JOIN users AS t1 ON t0.parent_user_id = t1.id
                	LEFT JOIN users AS t2 ON t0.user_id = t2.id WHERE t0.comment_class LIKE '%$parent_class%' ORDER BY t0.created_at";
        $query = $this->db->query($select);
        return $query->result();
    }

    //comment
    public function get_comment($comment_id)
    {
        $comment_id = clean_number($comment_id);
        $this->db->where('id', $comment_id);
        $query = $this->db->get('comments');
        return $query->row();
    }

    //product comment count
    public function get_product_comment_count($product_id)
    {
        $product_id = clean_number($product_id);
        // $this->db->where('parent_id', 0);
        $this->db->where('product_id', $product_id);
        $query = $this->db->get('comments');
        return $query->num_rows();
    }

    //delete comment
    public function delete_comment($id)
    {
        $id = clean_number($id);
        $comment = $this->get_comment($id);
        if (!empty($comment)) {
            //delete subcomments
            $this->delete_subcomments($id);

            $this->db->where('id', $id);
            return $this->db->delete('comments');
        } else {
            return false;
        }
    }

    //delete multi comments
    public function delete_multi_comments($comment_ids)
    {
        if (!empty($comment_ids)) {
            foreach ($comment_ids as $id) {
                //delete subcomments
                $this->delete_subcomments($id);

                $this->db->where('id', $id);
                $this->db->delete('comments');
            }
        }
    }

    //delete sub comments
    public function delete_subcomments($id)
    {
        $id = clean_number($id);
        $subcomments = $this->get_subcomments($id);
        if (!empty($subcomments)) {
            foreach ($subcomments as $comment) {
                $this->db->where('id', $comment->id);
                $this->db->delete('comments');
            }
        }
    }


    /*
    *-------------------------------------------------------------------------------------------------
    * BLOG COMMENTS
    *-------------------------------------------------------------------------------------------------
    */

    //add comment
    public function add_blog_comment()
    {
        $data = array(
            'post_id' => $this->input->post('post_id', true),
            'user_id' => $this->input->post('user_id', true),
            'name' => $this->input->post('name', true),
            'email' => $this->input->post('email', true),
            'comment' => $this->input->post('comment', true),
            'created_at' => date("Y-m-d H:i:s")
        );

        if ($data['post_id'] && trim($data['comment'])) {
            if ($data['user_id'] != 0) {
                $user = $this->auth_model->get_user($data['user_id']);
                if (!empty($user)) {
                    $data['name'] = $user->username;
                    $data['email'] = $user->email;
                }
            }
            $this->db->insert('blog_comments', $data);
        }
    }

    //all comments
    public function get_all_blog_comments()
    {
        $this->db->order_by('blog_comments.created_at', 'DESC');
        $query = $this->db->get('blog_comments');
        return $query->result();
    }

    //comments
    public function get_blog_comments($post_id, $limit)
    {
        $post_id = clean_number($post_id);
        $limit = clean_number($limit);
        $this->db->where('post_id', $post_id);
        $this->db->order_by('blog_comments.created_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get('blog_comments');
        return $query->result();
    }

    //comment
    public function get_blog_comment($comment_id)
    {
        $comment_id = clean_number($comment_id);
        $this->db->where('id', $comment_id);
        $query = $this->db->get('blog_comments');
        return $query->row();
    }

    //post comment count
    public function get_post_comment_count($post_id)
    {
        $post_id = clean_number($post_id);
        $this->db->where('post_id', $post_id);
        $query = $this->db->get('blog_comments');
        return $query->num_rows();
    }

    //delete comment
    public function delete_blog_comment($id)
    {
        $id = clean_number($id);
        $comment = $this->get_blog_comment($id);
        if (!empty($comment)) {
            $this->db->where('id', $id);
            return $this->db->delete('blog_comments');
        } else {
            return false;
        }
    }

    //delete multi comments
    public function delete_multi_blog_comments($comment_ids)
    {
        if (!empty($comment_ids)) {
            foreach ($comment_ids as $id) {
                $this->db->where('id', $id);
                $this->db->delete('blog_comments');
            }
        }
    }

    public function get_all_comment_users($user_id, $product_id){
        $this->db->select('email');
        $this->db->where('user_id !=', $user_id);
        $this->db->where('product_id', $product_id);
        $this->db->group_by("user_id");
        $query = $this->db->get('comments');
        return $query->result();
    }
}