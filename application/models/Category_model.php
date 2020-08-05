<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Category_model extends CI_Model
{
    //input values
    public function input_values()
    {
        $data = array(
            'slug' => $this->input->post('slug', true),
            'title_meta_tag' => $this->input->post('title_meta_tag', true),
            'description' => $this->input->post('description', true),
            'keywords' => $this->input->post('keywords', true),
            'category_order' => $this->input->post('category_order', true),
            'homepage_order' => $this->input->post('homepage_order', true),
            'visibility' => $this->input->post('visibility', true),
            'visibility_icon' => $this->input->post('visibility_icon', true),
            'show_on_homepage' => $this->input->post('show_on_homepage', true),
            'show_image_on_navigation' => $this->input->post('show_image_on_navigation', true)
        );

        return $data;
    }

    //add category name
    public function add_category_name($category_id)
    {
        $category_id = clean_number($category_id);
        $data = array();
        $main_slug = $this->input->post('main_slug', true);
        foreach ($this->languages as $key => $language) {
            $data["category_id"] = $category_id;
            $data["lang_id"] = $language->id;
            $data["name"] = $this->input->post('name_lang_' . $language->id, true);
            if (empty($this->input->post('slug_lang_' . $language->id, true)))
                $data["slug"] = str_slug($this->input->post('name_lang_' . $language->id, true));
            else    
                $data["slug"] = str_slug($this->input->post('slug_lang_' . $language->id, true));
            
            if (empty($main_slug)) {
                if (!$key) $data["main_slug"] = 1;
            }else {
                if ($main_slug == "main_slug_".$language->id)
                    $data["main_slug"] = 1;
                else    
                    $data["main_slug"] = 0;
            }
            $this->db->insert('categories_lang', $data);
            
            if ($data["main_slug"]) {
                $this->db->set('slug', "'".$data['slug']."'", false);
                $this->db->where('id', $category_id);
                $this->db->update('categories');
            }
        }
    }

    //update category name
    public function update_category_name($category_id)
    {
        $category_id = clean_number($category_id);
        $data = array();
        $main_slug = $this->input->post('main_slug', true);
        foreach ($this->languages as $language) {
            $data["category_id"] = $category_id;
            $data["lang_id"] = $language->id;
            $data["name"] = $this->input->post('name_lang_' . $language->id, true);
            $data["slug"] = str_slug($this->input->post('slug_lang_' . $language->id, true));
            if ($main_slug == "main_slug_".$language->id)
                $data["main_slug"] = 1;
            else    
                $data["main_slug"] = 0;

            //check category name exists
            $this->db->where('category_id', $category_id);
            $this->db->where('lang_id', $language->id);
            $row = $this->db->get('categories_lang')->row();
            if (empty($row)) {
                $this->db->insert('categories_lang', $data);
            } else {
                $this->db->where('category_id', $category_id);
                $this->db->where('lang_id', $language->id);
                $this->db->update('categories_lang', $data);
            }

            if ($data["main_slug"]) {
                $this->db->set('slug', "'".$data['slug']."'", false);
                $this->db->where('id', $category_id);
                $this->db->update('categories');
            }
        }
    }

    //add category
    public function add_category()
    {
        $data = $this->input_values();
        //set parent id
        $level = $this->input->post('level', true);
        $parent_id = $this->input->post('parent_id', true);
        $second_parent_id = array_filter($this->input->post('second_parent_id', true));
        
            $data["parent_id"] = end($second_parent_id);
            $data["top_parent_id"] = reset($second_parent_id);
            $data["category_level"] = count($second_parent_id) +1 ;
        //set slug
        if (empty($data["slug"])) {
            //slug for title
            $data["slug"] = str_slug($this->input->post('name_lang_' . $this->general_settings->site_lang, true));
        }
        
              //set slug
        if (empty($data["slug_ar"])) {
            //slug ar for title
            $data["slug_ar"] = str_slug($this->input->post('name_lang_' . $this->general_settings->site_lang, true));
        }

        $this->load->model('upload_model');
        // set image category with defferent size 420 and 440
        $temp_path = $this->upload_model->upload_temp_image('file');
        if (!empty($temp_path)) {
            $data["image_1"] = $this->upload_model->category_image_upload($temp_path, 420, 312);
            $data["image_2"] = $this->upload_model->category_image_upload($temp_path, 440, 541);
            $this->upload_model->delete_temp_image($temp_path);
        } else {
            $data["image_1"] = "";
            $data["image_2"] = "";
        }

        // set icon category 
        $temp_path = $this->upload_model->upload_temp_image('icon');
        if (!empty($temp_path)) {
            $data["icon"] = $this->upload_model->category_image_upload($temp_path, 120, 120);
            $this->upload_model->delete_temp_image($temp_path);
        } else {
            $data["icon"] = "";
        }

        $data["storage"] = "local";
        //move to s3
        if ($this->storage_settings->storage == "aws_s3") {
            $this->load->model("aws_model");
            $data["storage"] = "aws_s3";
            //move image 1
            if ($data["image_1"] != "") {
                $this->aws_model->put_category_object($data["image_1"], FCPATH . $data["image_1"]);
                delete_file_from_server($data["image_1"]);
            }
            //move image 2
            if ($data["image_2"] != "") {
                $this->aws_model->put_category_object($data["image_2"], FCPATH . $data["image_2"]);
                delete_file_from_server($data["image_2"]);
            }

            //move icon
            if ($data["icon"] != "") {
                $this->aws_model->put_category_object($data["icon"], FCPATH . $data["icon"]);
                delete_file_from_server($data["icon"]);
            }
        }

        $data["parent_slug"] = $this->get_parent_category_slug($data["parent_id"]);
        $data["top_parent_slug"] = $this->get_parent_category_slug($data["top_parent_id"]);
        $data["created_at"] = date('Y-m-d H:i:s');
        // save all data in categories tables
        return $this->db->insert('categories', $data);
    }

    //update category
    public function update_category($id)
    {
        $id = clean_number($id);
        $data = $this->input_values();
        //set parent id
        $level = $this->input->post('level', true);
        $parent_id = $this->input->post('parent_id', true);
        $second_parent_id = array_filter($this->input->post('second_parent_id', true));
        
            $data["parent_id"] = end($second_parent_id);
            $data["top_parent_id"] = reset($second_parent_id);
            $data["category_level"] = count($second_parent_id) +1 ;
            
        //set slug
        if (empty($data["slug"])) {
            //slug for title
            $data["slug"] = str_slug($this->input->post('name_lang_' . $this->general_settings->site_lang, true));
        }
        
          //set slug
        if (empty($data["slug_ar"])) {
            //slug ar for title
            $data["slug_ar"] = str_slug($this->input->post('name_lang_' . $this->general_settings->site_lang, true));
        }
        
        $this->load->model('upload_model');

        // update image if has other file not empty
        $temp_path = $this->upload_model->upload_temp_image('file');
        if (!empty($temp_path)) {
            $data["image_1"] = $this->upload_model->category_image_upload($temp_path, 420, 312);
            $data["image_2"] = $this->upload_model->category_image_upload($temp_path, 440, 541);
            $this->upload_model->delete_temp_image($temp_path);
            $category = $this->get_category($id);
            $data["storage"] = "local";

            //move to s3
            if ($this->storage_settings->storage == "aws_s3") {
                $this->load->model("aws_model");
                $data["storage"] = "aws_s3";
                //move image 1
                $this->aws_model->put_category_object($data["image_1"], FCPATH . $data["image_1"]);
                delete_file_from_server($data["image_1"]);
                //move image 2
                $this->aws_model->put_category_object($data["image_2"], FCPATH . $data["image_2"]);
                delete_file_from_server($data["image_2"]);
            }
            //delete old images
            if ($category->storage == "aws_s3") {
                $this->load->model("aws_model");
                $this->aws_model->delete_category_object($category->image_1);
                $this->aws_model->delete_category_object($category->image_2);
            } else {
                delete_file_from_server($category->image_1);
                delete_file_from_server($category->image_2);
            }
        }

        // update icon if has other icon not empty
        $temp_path = $this->upload_model->upload_temp_image('icon');
        if (!empty($temp_path)) {
            $data["icon"] = $this->upload_model->category_image_upload($temp_path, 120, 120);
            $this->upload_model->delete_temp_image($temp_path);
            $category = $this->get_category($id);
            $data["storage"] = "local";

            //move to s3
            if ($this->storage_settings->storage == "aws_s3") {
                $this->load->model("aws_model");
                $data["storage"] = "aws_s3";
                //move icon
                $this->aws_model->put_category_object($data["icon"], FCPATH . $data["icon"]);
                delete_file_from_server($data["icon"]);
            }
            //delete old images
            if ($category->storage == "aws_s3") {
                $this->load->model("aws_model");
                $this->aws_model->delete_category_object($category->icon);
            } else {
                delete_file_from_server($category->icon);
            }
        }


        $this->update_subcategories_parent_slug($id, $data["slug"]);

        $this->db->where('id', $id);
        return $this->db->update('categories', $data);
    }

    //get parent category slug
    public function get_parent_category_slug($parent_id)
    {
        if ($parent_id != 0) {
            $category = $this->get_category($parent_id);
            if (!empty($category)) {
                return $category->slug;
            }
        }
        return "";
    }

    public function  get_all_parent_categories($cat_id)
	{
		$sql  ="SELECT c.*, categories_lang.lang_id as lang_id, categories_lang.name as name FROM (
        SELECT
            @r AS _id,
            (SELECT @r := parent_id FROM categories WHERE id = _id) AS parent_id,
            @l := @l + 1 AS level
        FROM
            (SELECT @r := " . ($this->db->escape($cat_id)) .", @l := 0) vars, categories m
        WHERE @r <> 0) d
    JOIN categories c
    ON d._id = c.id
    JOIN categories_lang  ON
    categories_lang.category_id = c.id
    where categories_lang.lang_id = ". ($this->db->escape($this->selected_lang->id)) ."
    and c.visibility = 1
    order by categories_lang.category_id 
    ";
		$query = $this->db->query($sql);
		return $query->result();
	}

    //update slug
    public function update_slug($id)
    {
        $id = clean_number($id);
        $category = $this->get_category($id);
        if (empty($category->slug) || $category->slug == "-") {
            $data = array(
                'slug' => $category->id
            );
            $this->db->where('id', $id);
            return $this->db->update('categories', $data);
        } else {
            if (!empty($this->check_category_slug($category->slug, $id))) {
                $data = array(
                    'slug' => $category->slug . "-" . $category->id
                );

                $this->db->where('id', $id);
                return $this->db->update('categories', $data);
            }
        }
    }

    //update subcategories parent slug
    public function update_subcategories_parent_slug($parent_id, $slug)
    {
        $parent_id = clean_number($parent_id);
        $slug = clean_slug($slug);
        $this->db->where('categories.parent_id', $parent_id);
        $query = $this->db->get('categories');
        $categories = $query->result();
        if (!empty($categories)) {
            foreach ($categories as $category) {
                $data = array(
                    'parent_slug' => $slug
                );
                $this->db->where('id', $category->id);
                $this->db->update('categories', $data);
            }
        }

        $this->db->where('categories.top_parent_id', $parent_id);
        $query = $this->db->get('categories');
        $categories = $query->result();
        if (!empty($categories)) {
            foreach ($categories as $category) {
                $data = array(
                    'top_parent_slug' => $slug
                );
                $this->db->where('id', $category->id);
                $this->db->update('categories', $data);
            }
        }
    }

    //check category slug
    public function check_category_slug($slug, $id)
    {
        $id = clean_number($id);
        $slug = clean_slug($slug);
        $this->db->where('slug', $slug);
        $this->db->where('id !=', $id);
        $query = $this->db->get('categories');
        return $query->row();
    }

    //get category
    public function get_category($id)
    {
        $id = clean_number($id);
        $this->db->where('id', $id);
        $query = $this->db->get('categories');
        return $query->row();
    }

    //get category joined
    public function get_category_joined($id)
    {
        $id = clean_number($id);
        $this->db->join('categories_lang', 'categories_lang.category_id = categories.id');
        $this->db->select('categories.*, categories_lang.lang_id as lang_id, categories_lang.name as name');
        $this->db->where('categories_lang.lang_id', $this->selected_lang->id);
        $this->db->where('categories.id', $id);
        $this->db->where('categories.visibility', 1);
        $query = $this->db->get('categories');
        return $query->row();
    }

    //get all categories
    public function get_categories_all()
    {
        $this->db->join('categories_lang', 'categories_lang.category_id = categories.id');
        $this->db->select('categories.*, categories_lang.lang_id as lang_id, categories_lang.name as name');
        $this->db->where('categories_lang.lang_id', $this->selected_lang->id);
        $this->db->order_by('category_order');
        $query = $this->db->get('categories');  
        return $query->result();
    }

    //get all categories
    public function get_parent_categories_all()
    {
        // $select = "SELECT *FROM (SELECT t0.*, COUNT(*) AS cnt FROM categories AS t0
        // JOIN categories AS t1 ON t0.id = t1.parent_id OR t0.id = t1.id GROUP BY t0.id HAVING cnt = 1) as t0
        // join categories_lang as t1 on t0.id = t1.category_id where t1.lang_id = ".$this->selected_lang->id;
        // $query = $this->db->query($select);
        $this->db->join('categories_lang', 'categories_lang.category_id = categories.id');
        $this->db->select('categories.*, categories_lang.lang_id as lang_id, categories_lang.name as name');
        $this->db->where('categories.parent_id', 0);
        $this->db->where('categories_lang.lang_id', $this->selected_lang->id);
        $this->db->order_by('category_order');
        $query = $this->db->get('categories');  
        return $query->result();
    }

    //get all categories ordered by name
    public function get_categories_ordered_by_name()
    {
        $this->db->join('categories_lang', 'categories_lang.category_id = categories.id');
        $this->db->select('categories.*, categories_lang.lang_id as lang_id, categories_lang.name as name');
        $this->db->where('categories_lang.lang_id', $this->selected_lang->id);
        $this->db->order_by('categories_lang.name');
        $query = $this->db->get('categories');
        return $query->result();
    }

    //get sitemap categories
    public function get_sitemap_categories()
    {
        $this->db->join('categories_lang', 'categories_lang.category_id = categories.id');
        $this->db->select('categories.*, categories_lang.lang_id as lang_id, categories_lang.name as name');
        $this->db->where('categories.visibility', 1);
        $this->db->order_by('category_order');
        $query = $this->db->get('categories');
        return $query->result();
    }

    //get parent categories
    public function get_parent_categories()
    {
        $this->db->join('categories_lang', 'categories_lang.category_id = categories.id');
        $this->db->select('categories.*, categories_lang.lang_id as lang_id, categories_lang.name as name, categories_lang.slug as slug_lang');
        $this->db->where('categories_lang.lang_id', $this->selected_lang->id);
        $this->db->where('category_level', 1);
        $this->db->where('categories.visibility', 1);
        $this->db->order_by('category_order');
        $query = $this->db->get('categories');
        return $query->result();
    }

	//get subcategories by parent id
	public function get_subcategories_by_parent_id($parent_id)
	{
		$parent_id = clean_number($parent_id);
		// $this->db->join('categories_lang', 'categories_lang.category_id = categories.id');
		// $this->db->select('categories.*, categories_lang.lang_id as lang_id, categories_lang.name as name');
		// $this->db->where('categories_lang.lang_id', $this->selected_lang->id);
		// $this->db->where('parent_id', $parent_id);
		// $this->db->where('categories.visibility', 1);
		// $this->db->order_by('category_order');
        // $query = $this->db->get('categories');
        // echo $this->db->get_compiled_select(); exit;
        $sql = "SELECT *, COUNT(*) AS subcategory_num FROM (SELECT `t0`.*, `t1`.`lang_id` AS `lang_id`, `t1`.`name` AS `name`, t1.slug AS slug_lang FROM categories AS t0 
                JOIN categories_lang AS t1 ON `t1`.`category_id` = `t0`.`id` 
                WHERE `t1`.`lang_id` = ".($this->selected_lang->id)." AND `parent_id` = $parent_id AND `visibility` = 1 ORDER BY `category_order`) AS t0
                JOIN categories AS t1 ON t0.id = t1.parent_id OR t0.id = t1.id GROUP BY t0.id ORDER BY t0.`category_order`";
        $query = $this->db->query($sql);
		return $query->result();
	}


	//has subcategories by parent id
	public function has_subcategories_by_parent_id($parent_id)
	{
		$parent_id = clean_number($parent_id);
		$this->db->where('parent_id', $parent_id);
		$this->db->where('categories.visibility', 1);
		$query = $this->db->count_all_results('categories');
		return $query>0;
	}


	//get subcategories by parent id by lang
    public function get_subcategories_by_parent_id_by_lang($parent_id, $lang_id)
    {
        $parent_id = clean_number($parent_id);
        $lang_id = clean_number($lang_id);
        $this->db->join('categories_lang', 'categories_lang.category_id = categories.id');
        $this->db->select('categories.*, categories_lang.lang_id as lang_id, categories_lang.name as name');
        $this->db->where('categories_lang.lang_id', $lang_id);
        $this->db->where('parent_id', $parent_id);
        $this->db->where('categories.visibility', 1);
        $this->db->order_by('category_order');
        $query = $this->db->get('categories');
        return $query->result();
    }

    //search products (AJAX search)
    public function search_categories($search)
    {
        $search = remove_special_characters($search);
        
        	$sql  ="SELECT c.*, categories_lang.lang_id as lang_id, categories_lang.name as name FROM (
        SELECT
            e.id as _id 
        FROM  categories e JOIN categories_lang b  ON b.category_id = e.id where name like '" . $search .   "%' ) d
    JOIN categories c
    ON d._id = c.id
    JOIN categories_lang  ON
    categories_lang.category_id = c.id
    where categories_lang.lang_id = ". ($this->db->escape($this->selected_lang->id)) ."
    and c.visibility = 1
    order by categories_lang.name asc
    ";
		$query = $this->db->query($sql);
		return $query->result();
    }



    //get category name by lang
    public function get_category_name_by_lang($category_id, $lang_id)
    {
        $category_id = clean_number($category_id);
        $lang_id = clean_slug($lang_id);
        $this->db->where('categories_lang.category_id', $category_id);
        $this->db->where('categories_lang.lang_id', $lang_id);
        $query = $this->db->get('categories_lang');
        $row = $query->row();
        if (!empty($row)) {
            return $row->name;
        } else {
            return "";
        }
    }

    //get category slug by lang
    public function get_category_slug_by_lang($category_id, $lang_id)
    {
        $category_id = clean_number($category_id);
        $lang_id = clean_slug($lang_id);
        $this->db->where('categories_lang.category_id', $category_id);
        $this->db->where('categories_lang.lang_id', $lang_id);
        $query = $this->db->get('categories_lang');
        $row = $query->row();
        if (!empty($row)) {
            return $row->slug;
        } else {
            return "";
        }
    }

    //get category main slug by lang
    public function get_category_main_slug_by_lang($category_id, $lang_id)
    {
        $category_id = clean_number($category_id);
        $lang_id = clean_slug($lang_id);
        $this->db->where('categories_lang.category_id', $category_id);
        $this->db->where('categories_lang.lang_id', $lang_id);
        $query = $this->db->get('categories_lang');
        $row = $query->row();
        return $row->main_slug;
    }
    
    
    //get category by slug
    public function get_category_by_slug($slug)
    {
        $slug = clean_slug($slug);
        $this->db->join('categories_lang', 'categories_lang.category_id = categories.id');
        $this->db->select('categories.*, categories_lang.lang_id as lang_id, categories_lang.name as name, categories_lang.slug as slug_lang');
        $this->db->where('categories_lang.lang_id', $this->selected_lang->id); 
        $this->db->where('categories.slug', $slug);
        $this->db->where('categories.visibility', 1);
        $query = $this->db->get('categories');
        return $query->row();
    }

    //get featured categories
    public function get_featured_categories()
    {
        $this->db->join('categories_lang', 'categories_lang.category_id = categories.id');
        $this->db->select('categories.*, categories_lang.lang_id as lang_id, categories_lang.name as name');
        $this->db->where('categories_lang.lang_id', $this->selected_lang->id);
        $this->db->where('show_on_homepage', 1);
        $this->db->where('categories.visibility', 1);
        $this->db->order_by('homepage_order');
        $query = $this->db->get('categories');
        return $query->result();
    }

    //get featured categories count
    public function get_featured_categories_count()
    {
        $this->db->join('categories_lang', 'categories_lang.category_id = categories.id');
        $this->db->select('categories.*, categories_lang.lang_id as lang_id, categories_lang.name as name');
        $this->db->where('categories_lang.lang_id', $this->selected_lang->id);
        $this->db->where('show_on_homepage', 1);
        $this->db->where('categories.visibility', 1);
        $query = $this->db->get('categories');
        return $query->num_rows();
    }

    //get featured category
    public function get_featured_category($count)
    {
        $count = clean_number($count);
        $categories = $this->get_featured_categories();
        if (!empty($categories)) {
            $i = 1;
            foreach ($categories as $category) {
                if ($i == $count) {
                    return $category;
                    break;
                }
                $i++;
            }
        }
        return false;
    }

    //delete category name
    public function delete_category_name($category_id)
    {
        $category_id = clean_number($category_id);
        $this->db->where('category_id', $category_id);
        $query = $this->db->get('categories_lang');
        $results = $query->result();
        if (!empty($results)) {
            foreach ($results as $result) {
                $this->db->where('id', $result->id);
                $this->db->delete('categories_lang');
            }
        }
    }

    //delete category
    public function delete_category($id)
    {
        $id = clean_number($id);
        $category = $this->get_category($id);

        if (!empty($category)) {
            //delete from s3
            if ($category->storage == "aws_s3") {
                $this->load->model("aws_model");
                if (!empty($category->image_1)) {
                    $this->aws_model->delete_category_object($category->image_1);
                }
                if (!empty($category->image_2)) {
                    $this->aws_model->delete_category_object($category->image_2);
                }
            } else {
                delete_file_from_server($category->image_1);
                delete_file_from_server($category->image_2);
            }
            //delete category name
            $this->delete_category_name($id);
            $this->db->where('id', $id);
            return $this->db->delete('categories');
        }
        return false;
    }

    // all categories
    public function get_all_categories() {
        $max_depth = $this->get_max_depth();
        $left_str = ' (SELECT t1.id, CONCAT(t0.class, IF(t0.id != t1.id, t1.class, "" )) AS class, CONCAT(t0.classname, IF(t0.id != t1.id, t1.classname, "" )) AS classname FROM ';
        $base_str = ' (SELECT t0.id, LPAD(t0.id, 6, ".00000") AS class, CONCAT("/", TRIM(t1.name)) AS classname FROM (SELECT *FROM categories) AS t0 JOIN (SELECT *FROM categories_lang WHERE lang_id = '.($this->selected_lang->id).') AS t1 ON t0.id = t1.category_id WHERE t0.parent_id = 0) AS t0';    
        $right_str = ' JOIN (SELECT t0.id, LPAD(t0.id, 6, ".00000") AS class, CONCAT("/", TRIM(t1.name)) AS classname, t0.parent_id FROM (SELECT *FROM categories) AS t0 JOIN (SELECT *FROM categories_lang WHERE lang_id = '.($this->selected_lang->id).') AS t1 ON t0.id = t1.category_id) AS t1 ON t0.id = t1.parent_id OR t0.id = t1.id GROUP BY t1.class) AS t0';
        
        $left_str = str_repeat($left_str, $max_depth);
        $right_str = str_repeat($right_str, $max_depth);
        $sql = $left_str.$base_str.$right_str;
        $sql = 'SELECT * FROM '.$sql.' ORDER BY t0.class';
        $query = $this->db->query($sql);

        return $query->result();
    }
    // get max depth
    public function get_max_depth(){
        $max_depth = 0;
        $parent_ids = 0;
        for ($i = 0;;$i++){
            $sql = 'select group_concat(id) as parent_ids from categories where parent_id IN ('.$parent_ids.')';
            $query = $this->db->query($sql);
            $row = $query->row();
            if ($row->parent_ids) $parent_ids = $row->parent_ids;
            else {
                $max_depth = $i; break;
            };
        }
        return $max_depth;
    }

    public function custom_field_data($id) {
        $select = "SELECT t0.category_id, t1.id, t1.field_type, t1.product_filter_key, t2.name FROM custom_fields_category AS t0
                    JOIN custom_fields AS t1 ON t0.category_id = $id AND t0.field_id = t1.id
                    JOIN custom_fields_lang AS t2 ON t1.id = t2.field_id AND t2.lang_id = ".$this->selected_lang->id;
        $query = $this->db->query($select);
        $rows = $query->result();
        $data = [];
        foreach ($rows as $key => $row){
            $data[$key]["id"] = $row->id;
            $data[$key]["name"] = $row->name;
            $data[$key]["field_type"] = $row->field_type;
            $data[$key]["category_id"] = $row->category_id;
            $data[$key]["product_filter_key"] = $row->product_filter_key;
            
            $this->db->where("field_id", $row->id);
            $this->db->where("lang_id", $this->selected_lang->id);
            $query = $this->db->get("custom_fields_options");
            $r_array = $query->result_array();
            $data[$key]["data"] = $r_array;
        }
        return $data;
    }

    public function get_filter_items($param) {
        $select = "select *from custom_fields_options where $param and lang_id = ".$this->selected_lang->id;
        $query = $this->db->query($select);
        return $query->result();
    }

    public function top_parent_category_id($category_id){
        $this->db->where('id', $category_id);
        $query = $this->db->get('categories');
        $row = $query->row();
        if ($row->category_level > 1){
            $parent_id = $row->parent_id;
            for ($i = $row->category_level; ; $i--){
                $this->db->where('id', $parent_id);
                $query = $this->db->get('categories');
                $row = $query->row();
                $parent_id = $row->parent_id;
                if ($row->category_level == 1){
                    $parent_id  = $row->id;
                    break;
                }
            }
        }else {
            return $row->id;
        }
        return $parent_id;
    }

    public function get_full_category($category_id) {
        $id = clean_number($category_id);
        $this->db->join('categories_lang', 'categories_lang.category_id = categories.id');
        $this->db->select('categories.*, categories_lang.lang_id as lang_id, categories_lang.name as name');
        $this->db->where('categories.id', $id);
        $this->db->where('categories_lang.lang_id', $this->selected_lang->id);
        $query = $this->db->get('categories');
        return $query->row();
    }
}