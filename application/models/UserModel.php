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
}