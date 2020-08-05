<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoryofcustomfields_model extends CI_Model
{
    public function get_category_of_custom_fields(){
	  	$this->db->select('*');
		$this->db->from('categories AS A');
	  	$this->db->join('custom_fields_category AS C', 'A.id = C.category_id', 'INNER');
		$this->db->join('custom_fields AS B', 'B.id = C.field_id', 'INNER');
        $query = $this->db->get();
        return $query->result();
    }
    
    
    
}

?>