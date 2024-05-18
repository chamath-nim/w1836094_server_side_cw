<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AnswerModel extends CI_Model{
    
    public function create($data){
        $this->db->insert('answers', $data);
    }

    public function get_answers_byId($id){
        $query = $this->db->get_where('answers', array('question_id' => $id));
        
        if ($query->num_rows() > 0) {
            return $query->result(); 
        } else {
            return null;
        }
    }

    public function update_vote_count($data){
        $vote_count = array(
            'votes' => $data['votes']
        );
        
        $this->db->set($vote_count);
        $this->db->where('answer_id', $data['answer_id']);
        return $this->db->update('answers'); 
    }
}