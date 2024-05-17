<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QuestionModel extends CI_Model{
    
    public function create($data){
        $this->db->insert('questions', $data);
    }

    public function getAll_questions(){
        $questions = $this->db->get('questions')->result_array();
        return $questions;
    }
}