<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ad_model extends CI_Model
{
    public function input_values()
    {
        $data = array(
            'ad_code_728' => $this->input->post('ad_code_728', false),
            'ad_code_468' => $this->input->post('ad_code_468', false),
            'ad_code_250' => $this->input->post('ad_code_250', false),
        );

        return $data;
    }

    public function input_id_values()
    {
        $data = array(
            'id_ad_code_728' => $this->input->post('id_ad_code_728', false),
            'id_ad_code_468' => $this->input->post('id_ad_code_468', false),
            'id_ad_code_250' => $this->input->post('id_ad_code_250', false),
        );

        return $data;
    }

    public function input_url_values()
    {
        $data = array(
            'url_ad_code_728' => $this->input->post('url_ad_code_728', false),
            'url_ad_code_468' => $this->input->post('url_ad_code_468', false),
            'url_ad_code_250' => $this->input->post('url_ad_code_250', false),
        );

        return $data;
    }

    public function update_ad_spaces($ad_space)
    {
        $data = $this->input_values();
        $data_id = $this->input_id_values();
        $data_url = $this->input_url_values();

        if ($ad_space == "product_sidebar" || $ad_space == "products_sidebar" || $ad_space == "blog_post_details_sidebar" || $ad_space == "profile_sidebar") {

            $data["ad_code_300"] = $this->input->post('ad_code_300', false);
            $url_ad_code_300 = $this->input->post('url_ad_code_300', false);
            $id_ad_code_300 = $this->input->post('id_ad_code_300', false);

            $this->load->model('upload_model');
            $file_path = $this->upload_model->ad_upload('file_ad_code_300');
            if (!empty($file_path) || $id_ad_code_300) {
                if ($id_ad_code_300)
                    $this->update_ad_code($url_ad_code_300, $file_path, $id_ad_code_300);
                else    
                    $this->create_ad_code($url_ad_code_300, $file_path, 'ad_code_300');
            }
        } else {

            $this->load->model('upload_model');
            $file_path = $this->upload_model->ad_upload('file_ad_code_728');
            if (!empty($file_path) || $data_id['id_ad_code_728']) {
                if ($data_id['id_ad_code_728'])
                    $this->update_ad_code($data_url["url_ad_code_728"], $file_path, $data_id['id_ad_code_728']);
                else    
                    $this->create_ad_code($data_url["url_ad_code_728"], $file_path, 'ad_code_728');
            }
            $file_path = $this->upload_model->ad_upload('file_ad_code_468');
            if (!empty($file_path) || $data_id['id_ad_code_468']) {
                if ($data_id['id_ad_code_468'])
                    $this->update_ad_code($data_url["url_ad_code_468"], $file_path, $data_id['id_ad_code_468']);
                else    
                    $this->create_ad_code($data_url["url_ad_code_468"], $file_path, 'ad_code_468');
            }
        }

        $this->load->model('upload_model');
        $file_path = $this->upload_model->ad_upload('file_ad_code_250');
        if (!empty($file_path) || $data_id['id_ad_code_250']) {
            if ($data_id['id_ad_code_250'])
                $this->update_ad_code($data_url["url_ad_code_250"], $file_path, $data_id['id_ad_code_250']);
            else    
                $this->create_ad_code($data_url["url_ad_code_250"], $file_path, 'ad_code_250');
        }
        return true;
    }

    //get ads
    public function get_ads()
    {
        $query = $this->db->get('ad_spaces');
        return $query->result();
    }

    // get ad codes
    public function get_ad_data($ad_space, $ad_banner)
    {
        $this->db->where('ad_category', $ad_space);
        $this->db->where('ad_banner', $ad_banner);
        $query = $this->db->get('ad_spaces');
        return $query->result();
    }

    public function get_ad_codes($ad_space)
    {
        $this->db->where('ad_category', $ad_space);
        $query = $this->db->get('ad_spaces');
        return $query->result();
    }

    // get ad category
    public function get_ad_category($ad_space)
    {
        $this->db->where('name', $ad_space);
        $query = $this->db->get('ad_category');
        return $query->row();
    }

    //create ad code
    public function create_ad_code($url, $image_path, $ad_banner)
    {
        $data = [
            "site_url" => $url,
            "img_url" => base_url() . $image_path,
            "ad_category" => $this->input->post("ad_space", false),
            "ad_banner" => $ad_banner
        ];
        $this->db->insert('ad_spaces', $data);
    }

    //update ad code
    public function update_ad_code($url, $image_path, $id)
    {
        if ($image_path){
            $data = [
                "site_url" => $url,
                "img_url" => base_url() . $image_path
            ];
        }else{
            $data = [
                "site_url" => $url
            ];
        }
        $this->db->update('ad_spaces', $data, 'id='.$id);
    }

    // delete ad code
    public function delete_ad_code($id)
    {
        $this->db->delete('ad_spaces', 'id='.$id);
    }

    //update google adsense code
    public function update_google_adsense_code()
    {
        $data = array(
            'google_adsense_code' => $this->input->post('google_adsense_code', false)
        );
        $this->db->where('id', 1);
        return $this->db->update('general_settings', $data);
    }

}
