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

    public function register(){

        // Validation rules
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Load registration view
            $this->load->view('register');
        } else {
            // Insert user into database
            $data = array(
                'username' => $this->input->post('username'),
                'email'=> $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            );

            $this->UserModel->register($data);
            // Redirect to login page
            redirect('login');
        }
    }

    public function login(){

        // Validation rules
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            // Load login view
            $this->load->view('login');
        } else {
            // Authenticate user
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user = $this->UserModel->login($username, $password);
            
            if ($user) {
                // Set session data
                $this->session->set_userdata('user_id', $user['id']);
                $user_id = $this->session->userdata('user_id');

                // Redirect to dashboard or any other page
                redirect('session_details');
            } else {
                // Display error message
                $data['error'] = 'Invalid username or password';
                $this->load->view('login', $data);
            }
        }
    }   

    public function getSessionDetails() {
        // Get session creation time
        $creation_time = $this->session->userdata('session_creation_time');
        // Get last activity time
        $last_activity = $this->session->userdata('last_activity');
        // Get expiration time
        $expiration_time = $this->session->userdata('session_expiration');
        
        // Convert Unix timestamps to readable format
        $creation_time_formatted = date('Y-m-d H:i:s', $creation_time);
        $last_activity_time_formatted = date('Y-m-d H:i:s', $last_activity);
        $expiration_time_formatted = date('Y-m-d H:i:s', $expiration_time);
        
        // Display session time details
        echo "Session Creation Time: " . $creation_time_formatted . "<br>";
        echo "Last Activity Time: " . $last_activity_time_formatted . "<br>";
        echo "Expiration Time: " . $expiration_time_formatted . "<br>";
    }
    

    public function logout() {
        // Destroy session
        $this->session->sess_destroy();
        // Redirect to login page
        redirect('auth/login');
    }

}