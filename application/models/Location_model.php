<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location_model extends CI_Model
{
    //add country
    public function add_country()
    {
        $data = array(
            'name' => $this->input->post('name', true)
        );
        $languages = $this->language_model->get_languages();
        foreach ($languages as $key=>$language){
            if ($key)
                $data = array_merge($data, [$language->short_form.'_name' => $this->input->post($language->short_form.'_name', true)]);
        }

        return $this->db->insert('countries', $data);
    }

    //update country
    public function update_country($id)
    {
        $data = array(
            'name' => $this->input->post('name', true)
        );
        $languages = $this->language_model->get_languages();
        foreach ($languages as $key=>$language){
            if ($key)
                $data = array_merge($data, [$language->short_form.'_name' => $this->input->post($language->short_form.'_name', true)]);
        }

        $this->db->where('id', $id);
        return $this->db->update('countries', $data);
    }

    //add state
    public function add_state()
    {
        $data = array(
            'name' => $this->input->post('name', true),
            'country_id' => $this->input->post('country_id', true)
        );
        $languages = $this->language_model->get_languages();
        foreach ($languages as $key=>$language){
            if ($key)
                $data = array_merge($data, [$language->short_form.'_name' => $this->input->post($language->short_form.'_name', true)]);
        }

        return $this->db->insert('states', $data);
    }

    //update state
    public function update_state($id)
    {
        $data = array(
            'name' => $this->input->post('name', true),
            'country_id' => $this->input->post('country_id', true)
        );
        $languages = $this->language_model->get_languages();
        foreach ($languages as $key=>$language){
            if ($key)
                $data = array_merge($data, [$language->short_form.'_name' => $this->input->post($language->short_form.'_name', true)]);
        }

        $this->db->where('id', $id);
        return $this->db->update('states', $data);
    }


    //get countries
    public function get_countries()
    {
        if ($this->session->userdata("modesy_selected_lang") == 1){
            $field = "name";
        }else{
            $field = "ar_name";
        }
        $this->db->select('id, sortname, '.$field.' as name, phonecode, is_default');
        $this->db->order_by('countries.id');
        $query = $this->db->get('countries');
        return $query->result();
    }

    public function get_country_data($id){
        $id = clean_number($id);
        $this->db->where('countries.id', $id);
        $query = $this->db->get('countries');
        return $query->result();
    }

    //get paginated countries
    public function get_paginated_countries($per_page, $offset)
    {
        $q = trim($this->input->get('q', true));
        if (!empty($q)) {
            $this->db->like('countries.name', $q);
        }
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('countries');
        return $query->result();
    }

    //get paginated countries count
    public function get_paginated_countries_count()
    {
        $q = trim($this->input->get('q', true));
        if (!empty($q)) {
            $this->db->like('countries.name', $q);
        }
        $query = $this->db->get('countries');
        return $query->num_rows();
    }

    //get country
    public function get_country($id)
    {
        $id = clean_number($id);
        $this->db->where('countries.id', $id);
        $this->db->limit(8);
        $query = $this->db->get('countries');
        return $query->row();
    }

    //delete country
    public function delete_country($id)
    {
        $id = clean_number($id);
        $country = $this->get_country($id);
        if (!empty($country)) {
            $this->db->where('id', $id);
            return $this->db->delete('countries');
        }
        return false;
    }

    //get states
    public function get_states()
    {
        $this->db->order_by('states.name');
        $query = $this->db->get('states');
        return $query->result();
    }

    //get paginated states
    public function get_paginated_states($per_page, $offset)
    {
        $country = $this->input->get('country', true);
        $q = trim($this->input->get('q', true));
        $this->db->join('countries', 'states.country_id = countries.id');
        $this->db->select('states.*, countries.name as country_name');
        if (!empty($country)) {
            $this->db->where('states.country_id', $country);
        }
        if (!empty($q)) {
            $this->db->group_start();
            $this->db->like('countries.name', $q);
            $this->db->or_like('states.name', $q);
            $this->db->group_end();
        }
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('states');
        return $query->result();
    }

    //get paginated states count
    public function get_paginated_states_count()
    {
        $country = $this->input->get('country', true);
        $q = trim($this->input->get('q', true));
        $this->db->join('countries', 'states.country_id = countries.id');
        $this->db->select('states.*, countries.name as country_name');
        if (!empty($country)) {
            $this->db->where('states.country_id', $country);
        }
        if (!empty($q)) {
            $this->db->group_start();
            $this->db->like('countries.name', $q);
            $this->db->or_like('states.name', $q);
            $this->db->group_end();
        }
        $query = $this->db->get('states');
        return $query->num_rows();
    }

    //get state
    public function get_state($id)
    {
        $id = clean_number($id);
        if ($this->session->userdata("modesy_selected_lang") == 1){
            $field = "name";
        }else{
            $field = "ar_name";
        }
        $this->db->select('id, '.$field.' as name, country_id, is_capital');
        $this->db->where('states.id', $id);
        $query = $this->db->get('states');
        return $query->row();
    }

    //get state
    public function default_country()
    {
        $this->db->where('countries.is_default', true);
        $query = $this->db->get('countries');
        $item = $query->row();
        if ($item != null)
            return $item->id;
        return 0;
    }


    public function set_state_capital()
    {
        try {
            $stateid = clean_number($this->input->post('state_id', true));
            $countryid = clean_number($this->input->post('country_id', true));
            $val = boolval($this->input->post('val', true));
            $this->db->where('states.country_id', $countryid);
            $this->db->update('states', [
                'is_capital' => false
            ]);
            if ($val) {
                $this->db->where('states.id', $stateid);
                $this->db->update('states', [
                    'is_capital' => $val
                ]);
            }
            return true;
        } catch (\Exception $e) {
        }

        return false;
    }


    public function set_country_default()
    {
        try {
            $countryid = clean_number($this->input->post('country_id', true));
            $val = boolval($this->input->post('val', true));
            $this->db->update('countries', [
                'is_default' => false
            ]);
            if ($val) {
                $this->db->where('countries.id', $countryid);
                $this->db->update('countries', [
                    'is_default' => $val
                ]);
            }
            return true;
        } catch (\Exception $e) {
        }

        return false;
    }


    public function set_city_default()
    {
        try {
            $stateid = clean_number($this->input->post('state_id', true));
            $city_id = clean_number($this->input->post('city_id', true));
            $val = boolval($this->input->post('val', true));
            $this->db->where('cities.state_id', $stateid);
            $this->db->update('cities', [
                'is_default' => false
            ]);
            if ($val) {
                $this->db->where('cities.id', $city_id);
                $this->db->update('cities', [
                    'is_default' => $val
                ]);
            }
            return true;
        } catch (\Exception $e) {
        }

        return false;
    }

    //get states by country
    public function get_states_by_country($country_id)
    {
        if ($this->session->userdata("modesy_selected_lang") == 1){
            $field = "name";
        }else{
            $field = "ar_name";
        }
        $this->db->select('id, '.$field.' as name, country_id, is_capital');
        $this->db->where('states.country_id', $country_id);
        $this->db->order_by('states.order_by');
        $query = $this->db->get('states');
        return $query->result();
    }

    public function get_states_by_country1($country_id){
        $country_id = clean_number($country_id);
        if ($this->session->userdata("modesy_selected_lang") == 1){
            $field = "name";
        }else{
            $field = "ar_name";
        }
        $select = 'select t0.*, t0.'.$field.' as name, count(*) as cnt
                    from states as t0
                    left join cities as t1 on t0.id = t1.state_id
                    where t0.country_id = '.$country_id.'
                    group by t0.id';
        $query = $this->db->query($select);
        return $query->result();
    }

    //set location settings
    public function set_location_settings()
    {
        $default_product_location = $this->input->post('default_product_location', true);
        $country_id = $this->input->post('country_id', true);

        $data = array(
            'default_product_location' => 0
        );

        if ($default_product_location == 1) {
            if (!empty($country_id)) {
                $data = array(
                    'default_product_location' => $country_id
                );
            }
        }

        $this->db->where('id', 1);
        return $this->db->update('general_settings', $data);
    }

    //delete state
    public function delete_state($id)
    {
        $id = clean_number($id);
        $state = $this->get_state($id);
        if (!empty($state)) {
            $this->db->where('id', $id);
            return $this->db->delete('states');
        }
        return false;
    }

    //add city
    public function add_city()
    {
        $data = array(
            'name' => $this->input->post('name', true),
            'country_id' => $this->input->post('country_id', true),
            'state_id' => $this->input->post('state_id', true)
        );

        $languages = $this->language_model->get_languages();
        foreach ($languages as $key=>$language){
            if ($key)
                $data = array_merge($data, [$language->short_form.'_name' => $this->input->post($language->short_form.'_name', true)]);
        }

        return $this->db->insert('cities', $data);
    }

    //update city
    public function update_city($id)
    {
        $data = array(
            'name' => $this->input->post('name', true),
            'country_id' => $this->input->post('country_id', true),
            'state_id' => $this->input->post('state_id', true)
        );
        $languages = $this->language_model->get_languages();
        foreach ($languages as $key=>$language){
            if ($key)
                $data = array_merge($data, [$language->short_form.'_name' => $this->input->post($language->short_form.'_name', true)]);
        }

        $this->db->where('id', $id);
        return $this->db->update('cities', $data);
    }

    //get cities
    public function get_cities()
    {
        $this->db->order_by('cities.name');
        $query = $this->db->get('cities');
        return $query->result();
    }

    //get paginated cities
    public function get_paginated_cities($per_page, $offset)
    {
        $country = $this->input->get('country', true);
        $state = $this->input->get('state', true);
        $q = trim($this->input->get('q', true));
        $this->db->join('countries', 'cities.country_id = countries.id');
        $this->db->join('states', 'cities.state_id = states.id');
        $this->db->select('cities.*, countries.name as country_name, states.name as state_name');
        if (!empty($country)) {
            $this->db->where('cities.country_id', $country);
        }
        if (!empty($state)) {
            $this->db->where('cities.state_id', $state);
        }
        if (!empty($q)) {
            $this->db->group_start();
            $this->db->like('countries.name', $q);
            $this->db->or_like('cities.name', $q);
            $this->db->group_end();
        }
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('cities');
        return $query->result();
    }

    //get paginated cities count
    public function get_paginated_cities_count()
    {
        $country = $this->input->get('country', true);
        $state = $this->input->get('state', true);
        $q = trim($this->input->get('q', true));
        $this->db->join('countries', 'cities.country_id = countries.id');
        $this->db->join('states', 'cities.state_id = states.id');
        $this->db->select('cities.*');
        if (!empty($country)) {
            $this->db->where('cities.country_id', $country);
        }
        if (!empty($state)) {
            $this->db->where('cities.state_id', $state);
        }
        if (!empty($q)) {
            $this->db->group_start();
            $this->db->like('countries.name', $q);
            $this->db->or_like('cities.name', $q);
            $this->db->group_end();
        }
        $query = $this->db->get('cities');
        return $query->num_rows();
    }

    //get city
    public function get_city($id)
    {
        $id = clean_number($id);
        if ($this->session->userdata("modesy_selected_lang") == 1){
            $filed = "name";
        }else{
            $filed = "ar_name";
        }
        $this->db->select('id, '.$filed.' as name, state_id, is_default');
        $this->db->where('cities.id', $id);
        $query = $this->db->get('cities');
        return $query->row();
    }

    //get cities by country
    public function get_cities_by_country($country_id)
    {
        $country_id = clean_number($country_id);
        $this->db->where('cities.country_id', $country_id);
        $this->db->order_by('cities.name');
        $query = $this->db->get('cities');
        return $query->result();
    }

    //get cities by state
    public function get_cities_by_state($state_id)
    {
        $state_id = clean_number($state_id);
        if ($this->session->userdata("modesy_selected_lang") == 1){
            $filed = "name";
        }else{
            $filed = "ar_name";
        }
        
        $this->db->select('id, '.$filed.' as name, state_id, is_default');
        $this->db->where('cities.state_id', $state_id);
        $this->db->order_by('cities.order_by');
        $query = $this->db->get('cities');
        return $query->result();
    }

    //delete city
    public function delete_city($id)
    {
        $id = clean_number($id);
        $city = $this->get_city($id);
        if (!empty($city)) {
            $this->db->where('id', $id);
            return $this->db->delete('cities');
        }
        return false;
    }

    //search countries
    public function search_countries($val)
    {
        $val = remove_special_characters($val);
        $this->db->like('countries.name', $val);
        $query = $this->db->get('countries');
        return $query->result();
    }

    //search states
    public function search_states($val)
    {
        $val = remove_special_characters($val);
        $this->db->join('countries', 'states.country_id = countries.id');
        $this->db->select('states.*, countries.name as country_name, countries.id as country_id');
        $this->db->like('countries.name', $val);
        $this->db->or_like('states.name', $val);
        $this->db->or_like('CONCAT(states.name, " ", countries.name)', $val);
        $this->db->limit(100);
        $query = $this->db->get('states');
        return $query->result();
    }

    //search cities
    public function search_cities($val)
    {
        $val = remove_special_characters($val);
        $this->db->join('countries', 'cities.country_id = countries.id');
        $this->db->join('states', 'cities.state_id = states.id');
        $this->db->select('cities.*, countries.id as country_id, countries.name as country_name, states.id as state_id, states.name as state_name');
        $this->db->like('countries.name', $val);
        $this->db->or_like('states.name', $val);
        $this->db->or_like('cities.name', $val);
        $this->db->or_like('CONCAT(cities.name, " ",states.name, " ", countries.name)', $val);
        $this->db->limit(200);
        $query = $this->db->get('cities');
        return $query->result();
    }

    //get location input
    public function get_location_input($country_id, $state_id, $city_id)
    {
        $country_id = clean_number($country_id);
        $state_id = clean_number($state_id);
        $city_id = clean_number($city_id);
        $str = "";
        if (!empty($country_id)) {
            $country = $this->get_country($country_id);
            if (!empty($country)) {
                $str = $country->name;
            }
        }
        if (!empty($state_id)) {
            $state = $this->get_state($state_id);
            if (!empty($state)) {
                $str = $state->name . ', ' . $str;
            }
        }
        if (!empty($city_id)) {
            $city = $this->get_city($city_id);
            if (!empty($city)) {
                $str = $city->name . ', ' . $str;
            }
        }
        return $str;
    }
    public function get_btn_string($data = array()){
        if ($this->session->userdata("modesy_selected_lang") == 1){
            $field = "name";
        }else{
            $field = "ar_name";
        }
        $this->db->where('countries.id', $data->country_id);
        $query = $this->db->get('countries');
        $country = $query->row();
        $str = $country->$field;
        return $str;
    }

    public function get_state_button_string($data = array()){
        if ($this->session->userdata("modesy_selected_lang") == 1){
            $field = "name";
        }else{
            $field = "ar_name";
        }
        $str = '';
        $this->db->where('states.id', $data->state_id);
        $query = $this->db->get('states');
        $state = $query->row();
        if ($state){
            $str = $state->$field;
        }else return $str;

        $this->db->where('cities.id', $data->city_id);
        $query = $this->db->get('cities');
        $city = $query->row();
        if ($city){
            $str = $city->$field;
            return $str;
        }else return $str;
    }

    public function get_mix_state_city($country_id){
        $sql = "select t0.id as state_id, t1.id as city_id, concat(t0.name, if(t1.id is null, '', ' / '), if(t1.id is null, '', t1.name)) as name 
                from states as t0
                left join cities as t1 on t0.id = t1.state_id
                where t0.country_id = ".$country_id;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    
    public function get_country_name($id){
        $id = clean_number($id);
        $this->db->where('id', $id);
        $query = $this->db->get('countries');
        $row = $query->row();
        return $row->name;
    }

    public function get_state_name($id){
        $id = clean_number($id);
        $this->db->where('id', $id);
        $query = $this->db->get('states');
        $row = $query->row();
        return $row->name;
    }

    public function get_city_name($id){
        $id = clean_number($id);
        $this->db->where('id', $id);
        $query = $this->db->get('cities');
        $row = $query->row();
        return $row->name;
    }
}