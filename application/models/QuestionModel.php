<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QuestionModel extends CI_Model{
    
    public function create($data){
            $this->db->insert('questions', $data);
    }

    public function login($username, $password) {
        $user = $this->db->get_where('user', array('username' => $username))->row_array();
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }
}