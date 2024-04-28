<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model{
    
   public function register($data){
        $this->db->insert('user', $data);
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