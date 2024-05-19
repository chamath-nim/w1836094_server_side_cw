<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommentModel extends CI_Model{
    
    public function create($data){
        $this->db->insert('comments', $data);
    }

    public function get_comments_by_answer_id($id){
        $query = $this->db->get_where('comments', array('answer_id' => $id));
        
        if ($query->num_rows() > 0) {
            return $query->result(); 
        } else {
            return null;
        }
    }
}