<?php 

class Search_controller extends Home_Core_Controller{
  
    public function __construct()
    {
        parent::__construct();
        $this->review_limit = 5;
        $this->comment_limit = 5;
        $this->product_per_page = 15;
    }
  
    public function index(){
	  
	 $data['products'] = $this->product_model->get_products();
       $data['categories_hkm'] = $this->categoryhkm_model->get_categories();
		if ($this->input->post('ysfhkm_slc_country')) {
                $country = $this->input->post('ysfhkm_slc_country');
                if($country != 'ts0' && !empty($country) && $country != null){
                    $data['state_hkm'] = $this->locationhkm_model->get_states_of_country($country);
                    $data['cities_hkm'] = $this->locationhkm_model->get_cities_of_country($country);
                }else{
                    $data['state_hkm'] = $this->locationhkm_model->get_states();
                    $data['cities_hkm'] = $this->locationhkm_model->get_cities();
                }
            }
            else{
               $data['state_hkm'] = $this->locationhkm_model->get_states_of_sudan();
                $data['cities_hkm'] = $this->locationhkm_model->get_cities_of_sudan();
            }
	   
       $data['countiers_hkm'] = $this->locationhkm_model->get_countries();
	 
	   
    }
  

   

    public function GetCitiesOfState(){
	  
        if($this->input->post('state_val') && $this->input->post('country_id')){
            $postData = $this->input->post('state_val');
            $country_id = $this->input->post('country_id');
            
            $this->load->model('locationhkm_model');
            $data = $this->locationhkm_model->getUserCitiesOfState($postData,$country_id);
            echo json_encode($data);
        }  
    }

    public function GetStatesOfCountry(){
	  
        if($this->input->post('country_val')){
            $postData = $this->input->post('country_val');
            $this->load->model('locationhkm_model');
            $data = $this->locationhkm_model->getUserStatesOfCounrty($postData);
            echo json_encode($data);
        }
 
    }
  
  public function searching(){
	     $data['title'] = trans("products");
        $data['description'] = trans("products") . " - " . $this->app_name;
        $data['keywords'] = trans("products") . "," . $this->app_name;

        //get paginated posts
        $link = lang_base_url() . 'products';
        $pagination = $this->paginate($link, $this->product_model->get_paginated_filtered_products_count(null, null, null), $this->product_per_page);
        $data['products'] = $this->product_model->get_paginated_filtered_products(null, null, null, $pagination['per_page'], $pagination['offset']);
        $data["categories"] = $this->category_model->get_parent_categories();
		$data["site_settings"] = get_site_settings();
		$data["page"] = 'product';

        $data['show_location_filter'] = false;
        if (!empty($data['products'])) {
            foreach ($data['products'] as $item) {
                if ($item->product_type == 'physical') {
                    $data['show_location_filter'] = true;
                    break;
                }
            }
        }else{
            $data['show_location_filter'] = true;
        }

        $this->load->view('partials/_header', $data);
        $this->load->view('product/products', $data);
        $this->load->view('partials/_footer');
  }
 	
  
  //get sub categories Childs
  	public function get_sub_categories(){
        if($this->input->post('category_val')){
            $category = $this->input->post('category_val');
		  	$lang_id = $this->input->post('lang_id'); 
	  		
            $this->load->model('Categoryhkm_model');
            if($this->Categoryhkm_model->is_parent_cat($category)){
                $data = $this->Categoryhkm_model->GetChildsOfCategory($category,$lang_id);
                echo json_encode($data);
            }
		  	elseif( $category == 'ts1' || $category == null || empty($category) ){
			  $data = $this->Categoryhkm_model->GetChildsOfCategory('ts1',$lang_id);
              echo json_encode($data);
		  	}
		  	else{
			  /*
			  $data = $this->Categoryhkm_model->Custom_fields_of_category_Ajax($category,$lang_id);
              echo json_encode($data);
			  */

			  /* hkm  */
			  $this->load->model('Categoryofcustomfields_model');
			  $data = $this->Categoryhkm_model->get_custom_fields_hkm($category,$lang_id);
			  echo json_encode($data);

		  	}
        }
       
    }
  
  
  
  	

   
}


?>