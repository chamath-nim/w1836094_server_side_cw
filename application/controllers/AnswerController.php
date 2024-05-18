<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class AnswerController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('AnswerModel');
    }

    public function index($id) {
        $data['question'] = $this->QuestionModel->get_question_byId($id);
        $this->load->view( 'answer',$data );
    }

    public function add_answer(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                // Parse the incoming JSON data
                $data = json_decode(file_get_contents("php://input"), true);
                
                // Check if the data is properly parsed
                if ($data) {
                   
                    $auth_user_details = $this->session->userdata('auth_user');
                    $username = $auth_user_details['username'];
                    $data['username'] = $username;
                    
                    // Insert the data into the database
                    $this->AnswerModel->create($data);

                    // If the data is not properly parsed, send an error response
                    $response = array('status' => 'success', 'message' => 'Answer successfully added');
                    echo json_encode($response);
                    exit;
                   
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

    public function get_answers_byId($id){
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            
           
            // Insert the data into the database
            $answers = $this->AnswerModel->get_answers_byId($id);

            echo json_encode($answers);
            exit;
            }        
            
         else {
            // If the request method is not POST, send an error response
            $response = array('status' => 'error', 'message' => 'Invalid request method');
            echo json_encode($response);
            exit;
        }
    }

    public function update_vote_count(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                // Parse the incoming JSON data
                $data = json_decode(file_get_contents("php://input"), true);
                
                // Check if the data is properly parsed
                if ($data) {
                   
                    $auth_user_details = $this->session->userdata('auth_user');
                    $username = $auth_user_details['username'];
                    $owner = $data['owner'];

                    // Check if the user details exist in the session
                    if ($auth_user_details && ($username == $owner)) {
                        
                        $response = array('status' => 'error', 'message' => "Welcome, $username! ,you can't vote your own answer");
                        echo json_encode($response);
                        exit;
                        
                    } else {

                        if($this->AnswerModel->update_vote_count($data)){
                   
                            $response = array('status' => 'success', 'message' => 'Data received successfully, vote updated.');
                            echo json_encode($response);
                            exit;
                        }

                        else {
                            $response = array('status' => 'error', 'message' => 'Data received successfully, vote not updated.');
                            echo json_encode($response);
                            exit;
                        }
                    }
                    
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
}