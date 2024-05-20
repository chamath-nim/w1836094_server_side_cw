<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel');
        // $this->load->library('form_validation');
        // $this->load->library('session');
    }

    public function index(){
        $this->load->view( 'register' );
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                // Parse the incoming JSON data
                $data = json_decode(file_get_contents("php://input"), true);
                
                // Check if the data is properly parsed
                if ($data) {
                
                    // Insert the data into the database
                    $user = $this->UserModel->register($data);

                    if ($user) echo json_encode(['success' => true]);
                     
                    else echo json_encode(['success' => false, 'message' => 'Failed to insert user data into the database']);
                    
                } else echo json_encode(['success' => false, 'error' => 'Failed to parse data']);
                
            } else echo json_encode(['success' => false, 'error' => 'Invalid request']);
            
        } else $this->load->view( 'register');
    }
    
    public function login(){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                // Parse the incoming JSON data
                $data = json_decode(file_get_contents("php://input"), true);
        
                if ($data) {
                    $username = $data['username'];
                    $password = $data['password'];
        
                    // Insert the data into the database
                    $user = $this->UserModel->login($username, $password);
        
                    if ($user) {
                        $auth_user_details = [
                            'id' => $user['user_id'],
                            'username' => $user['username']
                        ];
        
                        // Set session data
                        $this->session->set_userdata('authenticated', true);
                        $this->session->set_userdata('auth_user', $auth_user_details); 
                        
                        echo json_encode(['success' => true]);
                    } 
                    else echo json_encode(['success' => false]);
                    
                } 
                else echo json_encode(['success' => false, 'error' => 'Failed to parse data']);
            } 
            else echo json_encode(['success' => false, 'error' => 'Invalid request']);
            
        } 
        else  $this->load->view('login');
        
    }

    public function logout() {
        
        $this->session->sess_destroy();
        redirect('login');
    }

    public function get_userdata(){
        $auth_user_details = $this->session->userdata('auth_user');
        $user_id = $auth_user_details['id'];

        $user_details = $this->UserModel->get_user_by_id($user_id);

        echo json_encode($user_details);
    }
}