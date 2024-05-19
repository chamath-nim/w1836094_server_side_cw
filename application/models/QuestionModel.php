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

    public function get_question_byId($id){
        $query = $this->db->get_where('questions', array('question_id' => $id));
        
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    public function update_vote_count($data){
        $vote_count = array(
            'votes' => $data['votes']
        );
        
        $this->db->set($vote_count);
        $this->db->where('question_id', $data['id']);
        return $this->db->update('questions'); 
    }

    public function getAll_myquestions($username){
        $query = $this->db->get_where('questions', array('username' => $username));
        
        if ($query->num_rows() > 0) {
            return $query->result(); 
        } else {
            return null;
        }
    }

    public function delete_question($question_id) {
        $this->db->where('question_id', $question_id);
        return $this->db->delete('questions');
    }

    public function search_by_tags($tags) {
        $query = $this->db->get_where('questions', array('tags' => $tags));
        
        if ($query->num_rows() > 0) {
            return $query->result(); 
        } else {
            return [];
        }
    }
}