<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model{
    
    public function register($data){
        $user = $this->db->insert('users', $data);
        if ($user) {
            return $user;
        } else {
            return false;
        }
    }

    public function login($username, $password) {
        $user = $this->db->get_where('users', array('username' => $username))->row_array();
        if ($user && ($password == $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }

    public function get_user_by_id($user_id){
        $query = $this->db->get_where('users', array('user_id' => $user_id));
        
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }
}