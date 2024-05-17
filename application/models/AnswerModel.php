<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AnswerModel extends CI_Model{
    
    public function create($data){
        $this->db->insert('answers', $data);
    }

    
}