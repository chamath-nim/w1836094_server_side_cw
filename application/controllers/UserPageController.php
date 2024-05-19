<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserPageController extends CI_Controller {


    public function index(){
        // $this->load->view( 'header' );
        // $this->load->view( 'sidebar' );

        if (!$this->session->userdata('authenticated')) {
            // Redirect to login page
            redirect('login');
        }
        // Load the home page view        
        $this->load->view( 'view_home' );
        
        
    }

    public function myProfile(){
        $this->load->view('profile');
    }

    public function myQuestion(){
        $this->load->view('myquestions');
    }

    
}