<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class CommentController extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('CommentModel');
    }

    public function add_comment(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                // Parse the incoming JSON data
                $data = json_decode(file_get_contents("php://input"), true);
                
                // Check if the data is properly parsed
                if ($data) {
                    $comment = array('comment' => $data['comment'], 'answer_id' => $data['answer_id']);
                    
                    // Insert the data into the database
                    $this->CommentModel->create($comment);

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

    public function get_comments_by_answer_id($id){
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            
            $comments = $this->CommentModel->get_comments_by_answer_id($id);

            echo json_encode($comments);
            exit;
            }        
            
         else {
            // If the request method is not POST, send an error response
            $response = array('status' => 'error', 'message' => 'Invalid request method');
            echo json_encode($response);
            exit;
        }
    }

}