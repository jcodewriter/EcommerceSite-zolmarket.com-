<?php
defined('BASEPATH') or exit('No direct script access allowed');


require_once APPPATH . "third_party/intervention-image/vendor/autoload.php";

use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;

use \Gumlet\ImageResize;
use \Gumlet\ImageResizeException;

class Upload_model extends CI_Model
{
    //upload temp image
    public function upload_temp_image($file_name)
    {
        if (isset($_FILES[$file_name])) {
            if (empty($_FILES[$file_name]['name'])) {
                return null;
            }
        }
        $config['upload_path'] = './uploads/temp/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['file_name'] = 'img_temp_' . generate_unique_id();
        $this->load->library('upload', $config);

        if ($this->upload->do_upload($file_name)) {
            $data = array('upload_data' => $this->upload->data());
            if (isset($data['upload_data']['full_path'])) {
                return $data['upload_data']['full_path'];
            }
            return null;
        } else {
            $error = $this->upload->display_errors();
            return $error;
        }
    }

    //product default image upload
    public function product_default_image_upload($path, $folder)
    {
        try {
            $image = new ImageResize($path);
            $image->quality_jpg = 85;
            $image->resizeToHeight(500);
            $new_name = 'img_x500_' . generate_unique_id() . '.jpg';
            $new_path = 'uploads/' . $folder . '/' . $new_name;
            $image->save(FCPATH . $new_path, IMAGETYPE_JPEG);
            //add watermark
            /* if ($this->general_settings->watermark_product_images == 1) {
                $this->add_watermark(FCPATH . $new_path, 'mid');
            }*/
            return $new_name;
        } catch (ImageResizeException $e) {
            return null;
        }
    }

    //product big image upload
    public function product_big_image_upload($path, $folder)
    {
        try {
            $image = new ImageResize($path);
            $image->quality_jpg = 85;
            $image->resizeToWidth(1920);
            $new_name = 'img_1920x_' . generate_unique_id() . '.jpg';
            $new_path = 'uploads/' . $folder . '/' . $new_name;
            $image->save(FCPATH . $new_path, IMAGETYPE_JPEG);
            //add watermark
            /*if ($this->general_settings->watermark_product_images == 1) {
                $this->add_watermark(FCPATH . $new_path, 'large');
            }*/
            return $new_name;
        } catch (ImageResizeException $e) {
            return null;
        }
    }

    //product small image upload
    public function product_small_image_upload($path, $folder)
    {
        try {
            $image = new ImageResize($path);
            $image->quality_jpg = 85;
            $image->resizeToHeight(300);
            $new_name = 'img_x300_' . generate_unique_id() . '.jpg';
            $new_path = 'uploads/' . $folder . '/' . $new_name;
            $image->save(FCPATH . $new_path, IMAGETYPE_JPEG);
            //add watermark
            /* if ($this->general_settings->watermark_product_images == 1 && $this->general_settings->watermark_thumbnail_images == 1) {
                $this->add_watermark(FCPATH . $new_path, 'small');
            }*/
            return $new_name;
        } catch (ImageResizeException $e) {
            return null;
        }
    }

    //file manager image upload
    public function file_manager_image_upload($path)
    {
        try {
            $image = new ImageResize($path);
            $image->quality_jpg = 85;
            $image->resizeToWidth(750);
            $new_name = 'img_' . generate_unique_id() . '.jpg';
            $new_path = 'uploads/images-file-manager/' . $new_name;
            $image->save(FCPATH . $new_path, IMAGETYPE_JPEG);
            //add watermark
            if ($this->general_settings->watermark_product_images == 1) {
                $this->add_watermark(FCPATH . $new_path, 'mid');
            }
            return $new_name;
        } catch (ImageResizeException $e) {
            return null;
        }
    }

    //blog image default upload
    public function blog_image_default_upload($path)
    {
        try {
            $image = new ImageResize($path);
            $image->quality_jpg = 85;
            $image->resizeToWidth(880);
            $new_path = 'uploads/blog/img_' . generate_unique_id() . '.jpg';
            $image->save(FCPATH . $new_path, IMAGETYPE_JPEG);
            //add watermark
            if ($this->general_settings->watermark_blog_images == 1) {
                $this->add_watermark(FCPATH . $new_path, 'mid');
            }
            return $new_path;
        } catch (ImageResizeException $e) {
            return null;
        }
    }

    //blog image default upload
    public function blog_image_small_upload($path)
    {
        try {
            $image = new ImageResize($path);
            $image->quality_jpg = 85;
            $image->crop(500, 332, true);
            $new_path = 'uploads/blog/img_thumb_' . generate_unique_id() . '.jpg';
            $image->save(FCPATH . $new_path, IMAGETYPE_JPEG);
            //add watermark
            if ($this->general_settings->watermark_product_images == 1 && $this->general_settings->watermark_thumbnail_images == 1) {
                $this->add_watermark(FCPATH . $new_path, 'mid');
            }
            return $new_path;
        } catch (ImageResizeException $e) {
            return null;
        }
    }

    //category image upload
    public function category_image_upload($path, $width, $height)
    {
        try {
            $image = new ImageResize($path);
            $image->quality_jpg = 85;
            $image->crop($width, $height, true);
            $new_path = 'uploads/category/category_' . $width . '-' . $height . '_' . generate_unique_id() . '.jpg';
            $image->save(FCPATH . $new_path, IMAGETYPE_JPEG);
            return $new_path;
        } catch (ImageResizeException $e) {
            return null;
        }
    }

    //slider image upload
    public function slider_image_upload($path)
    {
        $new_path = 'uploads/slider/slider_' . generate_unique_id() . '.jpg';
        $img = Image::make($path)->orientate();
        $img->fit(1920, 400);
        $img->save(FCPATH . $new_path, $this->quality);
        return $new_path;
    }

    //slider image mobile upload
    public function slider_image_mobile_upload($path)
    {
        $new_path = 'uploads/slider/slider_' . generate_unique_id() . '.jpg';
        $img = Image::make($path)->orientate();
        $img->fit(768, 300);
        $img->save(FCPATH . $new_path, $this->quality);
        return $new_path;
    }

    //avatar image upload
    public function avatar_upload($path)
    {
        try {
            $image = new ImageResize($path);
            //$image->quality_jpg = 85;
            //$image->crop(240, 240, true);
            $new_path = 'uploads/profile/avatar_' . generate_unique_id() . '.jpg';
            $image->save(FCPATH . $new_path, IMAGETYPE_JPEG);
            return $new_path;
        } catch (ImageResizeException $e) {
            return null;
        }
    }


    //logo image upload
    public function logo_upload($file_name)
    {
        $config['upload_path'] = './uploads/logo/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|svg';
        $config['file_name'] = 'logo_' . uniqid();
        $this->load->library('upload', $config);

        if ($this->upload->do_upload($file_name)) {
            $data = array('upload_data' => $this->upload->data());
            if (isset($data['upload_data']['full_path'])) {
                return 'uploads/logo/' . $data['upload_data']['file_name'];
            }
        }
        return null;
    }




    //favicon image upload
    public function favicon_upload($file_name)
    {
        $config['upload_path'] = './uploads/logo/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['file_name'] = 'favicon_' . uniqid();
        $this->load->library('upload', $config);

        if ($this->upload->do_upload($file_name)) {
            $data = array('upload_data' => $this->upload->data());
            if (isset($data['upload_data']['full_path'])) {
                return 'uploads/logo/' . $data['upload_data']['file_name'];
            }
        }
        return null;
    }



    //ad upload
    public function ad_upload($file_name)
    {
        $config['upload_path'] = './uploads/blocks/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['file_name'] = 'block_' . generate_unique_id();
        $this->load->library('upload', $config);

        if ($this->upload->do_upload($file_name)) {
            $data = array('upload_data' => $this->upload->data());
            if (isset($data['upload_data']['full_path'])) {
                return 'uploads/blocks/' . $data['upload_data']['file_name'];
            }
        }
        return null;
    }

    //receipt upload
    public function receipt_upload($file_name)
    {
        $config['upload_path'] = './uploads/receipts/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['file_name'] = 'receipt_' . generate_unique_id();
        $this->load->library('upload', $config);

        if ($this->upload->do_upload($file_name)) {
            $data = array('upload_data' => $this->upload->data());
            if (isset($data['upload_data']['full_path'])) {
                return 'uploads/receipts/' . $data['upload_data']['file_name'];
            }
        }
        return null;
    }

    //watermark upload
    public function watermark_upload($file_name)
    {
        $config['upload_path'] = './uploads/logo/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['file_name'] = 'watermark_' . generate_unique_id();
        $this->load->library('upload', $config);

        if ($this->upload->do_upload($file_name)) {
            $data = array('upload_data' => $this->upload->data());
            if (isset($data['upload_data']['full_path'])) {
                return 'uploads/logo/' . $data['upload_data']['file_name'];
            }
        }
        return null;
    }

    //resize watermark
    public function resize_watermark($path, $width, $height)
    {
        try {
            $image = new ImageResize($path);
            $image->resizeToWidth($width);
            $new_name = 'watermark_' . generate_unique_id() . '.png';
            $new_path = 'uploads/logo/' . $new_name;
            $image->save(FCPATH . $new_path, IMAGETYPE_PNG);
            return 'uploads/logo/' . $new_name;
        } catch (ImageResizeException $e) {
            return null;
        }
    }


    //resize watermark
    public function update_watermark($path, $watermark_size, $folder)
    {
        try {
            // if ($this->general_settings->watermark_product_images && $this->general_settings->watermark_blog_images && $this->general_settings->watermark_thumbnail_images) {
            if ($this->general_settings->watermark_product_images) {
                $watermark = $this->general_settings->watermark_image_mid;
                $settings = $watermark . $watermark_size . $this->general_settings->watermark_vrt_alignment . $this->general_settings->watermark_hor_alignment;
                $new_name = md5($path . $settings);
                $new_path = 'uploads/' . $folder . '/' . $new_name . '.png';
                if (file_exists(FCPATH . $new_path)) {
                    return $new_path;
                }

                $image = new ImageResize(FCPATH  . 'uploads/' . $folder . '/'  . $path);

                $image->save(FCPATH . $new_path, IMAGETYPE_PNG);
                $this->add_watermark($new_path, 'mid');
                return $new_path;
            } else {
                return 'uploads/' . $folder . '/' . $path;
            }
        } catch (ImageResizeException $e) {
            return "" . $e->getMessage();
        }
    }


    //digital file upload
    public function digital_file_upload($input_name, $file_name)
    {
        $allowed_types = array('zip', 'ZIP');
        if (!$this->check_file_mime_type($input_name, $allowed_types)) {
            return false;
        }
        $config['upload_path'] = './uploads/digital-files/';
        $config['allowed_types'] = '*';
        $config['file_name'] = $file_name;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload($input_name)) {
            $data = array('upload_data' => $this->upload->data());
            if (isset($data['upload_data']['full_path'])) {
                return true;
            }
            return null;
        } else {
            return null;
        }
    }

    //audio upload
    public function audio_upload($file_name)
    {
        $allowed_types = array('mp3', 'MP3', 'wav', 'WAV');
        if (!$this->check_file_mime_type($file_name, $allowed_types)) {
            return false;
        }
        $config['upload_path'] = './uploads/audios/';
        $config['allowed_types'] = '*';
        $config['file_name'] = 'audio_' . generate_unique_id();
        $this->load->library('upload', $config);

        if ($this->upload->do_upload($file_name)) {
            $data = array('upload_data' => $this->upload->data());
            if (isset($data['upload_data']['full_path'])) {
                return $data['upload_data']['file_name'];
            }
            return null;
        } else {
            return null;
        }
    }

    //video upload
    public function video_upload($file_name)
    {
        $allowed_types = array('mp4', 'MP4', 'webm', 'WEBM');
        if (!$this->check_file_mime_type($file_name, $allowed_types)) {
            return false;
        }
        $config['upload_path'] = './uploads/videos/';
        $config['allowed_types'] = '*';
        $config['file_name'] = 'video_' . generate_unique_id();
        $this->load->library('upload', $config);

        if ($this->upload->do_upload($file_name)) {
            $data = array('upload_data' => $this->upload->data());
            if (isset($data['upload_data']['full_path'])) {
                return $data['upload_data']['file_name'];
            }
            return null;
        } else {
            return null;
        }
    }

    //check file mime type
    public function check_file_mime_type($file_name, $allowed_types)
    {
        if (!isset($_FILES[$file_name])) {
            return false;
        }
        if (empty($_FILES[$file_name]['name'])) {
            return false;
        }
        $ext = pathinfo($_FILES[$file_name]['name'], PATHINFO_EXTENSION);
        if (in_array($ext, $allowed_types)) {
            return true;
        }
        return false;
    }

    //add watermark
    public function add_watermark($image_path, $watermark_size)
    {
        $watermark = $this->general_settings->watermark_image_large;
        if ($watermark_size == 'mid') {
            $watermark = $this->general_settings->watermark_image_mid;
        }
        if ($watermark_size == 'small') {
            $watermark = $this->general_settings->watermark_image_small;
        }
        if (file_exists($image_path) && file_exists($watermark)) {
            $this->load->library('image_lib');
            $config['source_image'] = $image_path;
            $config['wm_overlay_path'] = FCPATH . $watermark;
            $config['wm_type'] = 'overlay';
            $config['wm_vrt_alignment'] = $this->general_settings->watermark_vrt_alignment;
            $config['wm_hor_alignment'] = $this->general_settings->watermark_hor_alignment;
            $this->image_lib->initialize($config);
            $this->image_lib->watermark();
        }
    }

    //delete temp image
    public function delete_temp_image($path)
    {
        if (file_exists($path)) {
            @unlink($path);
        }
    }

    // hkm upload send img chat 
    public function chat_image_upload($path)
    {
        try {
            $image = new ImageResize($path);
            $image->quality_jpg = 85;
            $generate_id = generate_unique_id() . date("ljSYhisA");
            $new_path = 'uploads/profile/message__055_' . $generate_id . '.jpg';
            $image->save(FCPATH . $new_path, IMAGETYPE_JPEG);
            return 'message__055_' . $generate_id . '.jpg';
        } catch (ImageResizeException $e) {
            return null;
        }
    }
}
