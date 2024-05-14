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

                echo 
                $auth_user_details = array(
                    'id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email
                );

                // Set session data
                $this->session->set_userdata('authenticated', 1);
                $this->session->set_userdata('auth_user', $auth_user_details);

                // Redirect to dashboard or any other page
                redirect('home');
            } else {
                // Display error message
                $data['error'] = 'Invalid username or password';
                $this->load->view('login', $data);
            }
        }
    }   
    

    public function logout() {
        // Destroy session
        $this->session->sess_destroy();
        // Redirect to login page
        redirect('auth/login');
    }

}