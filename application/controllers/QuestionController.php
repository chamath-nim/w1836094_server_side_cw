<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class QuestionController extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->model('QuestionModel');
    }
    
    public function index(){
        // $this->load->view( 'header' );
        // $this->load->view( 'sidebar' );
        $this->load->view( 'view_home' );
  
    }

    public function create_question(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                // Parse the incoming JSON data
                $data = json_decode(file_get_contents("php://input"), true);
                
                // Check if the data is properly parsed
                if ($data) {
                   
                    $auth_user_details = $this->session->userdata('auth_user');

                    // Check if the user details exist in the session
                    if ($auth_user_details) {
                        // Retrieve the username from the user details
                        $username = $auth_user_details['username'];
                        $data['username'] = $username;
                                                // Send a response back to the client
                        $response = array('status' => 'success', 'message' => "Welcome, $username! ,Data received successfully");
                        echo json_encode($response);
                        
                    } else {
                        // Handle the case where the user is not authenticated
                        $response = array('status' => 'error', 'message' => 'Data received successfully, You are not authenticated.');
                        echo json_encode($response);
                        exit;
                    }

                    // Insert the data into the database
                    $this->QuestionModel->create($data);
                   
                } else {
                    // If the data is not properly parsed, send an error response
                    $response = array('status' => 'error', 'message' => 'Failed to parse data');
                    echo json_encode($response);
                    exit;
                }
            } else {
                // If the request is not sent via AJAX, send an error response
                $response = array('status' => 'error', 'message' => 'Invalid request');
                echo json_encode($response);
                exit;
            }
        } else {
            // If the request method is not POST, send an error response
            $response = array('status' => 'error', 'message' => 'Invalid request method');
            echo json_encode($response);
            exit;
        }
    }

    public function getAll_questions(){
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            
            $questions = $this->QuestionModel->getAll_questions();
            echo json_encode($questions);
        }
        else {
            // If the request method is not POST, send an error response
            $response = array('status' => 'error', 'message' => 'Invalid request method');
            echo json_encode($response);
            exit;
        }
    }
}