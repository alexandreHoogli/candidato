<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

    protected $browserResponse;
    protected $data;

    public function __construct(){

        parent::__construct();
        checkSiteSettings();
        $this->browserResponse = array('status'=>'error','message'=>'','redirect'=>'');
        $this->data = array('header_data' => [], 'footer_data' => [], 'page_info' => [], 'csrf' => $this->csrf_token);
    }

    /* Login Page */
    public function login(){

        if(isset($_SESSION['logged_in'])) 
            redirect('');

        $this->data['page_info']   = array('page_name' => 'login_page', 'page_title' => 'Login');
  
        $this->load->view('auth/common/auth_header', $this->data);
        $this->load->view('auth/login', $this->data);
        $this->load->view('auth/common/auth_footer', $this->data);
    }
    
    /* Sign Up Page */
    public function signUp(){

        if(isset($_SESSION['logged_in'])) 
            redirect('');

        $this->data['page_info']   = array('page_name' => 'signup_page', 'page_title' => 'Sign Up');
  
        $this->load->view('auth/common/auth_header', $this->data);
        $this->load->view('auth/signup', $this->data);
        $this->load->view('auth/common/auth_footer', $this->data);
    }
    
    /* Forgot Password Page */
    public function forgotPassword(){

        if(isset($_SESSION['logged_in'])) 
            redirect('');

        $this->data['page_info']   = array('page_name' => 'forgot_password_page', 'page_title' => 'Forgot Password');
  
        $this->load->view('auth/common/auth_header', $this->data);
        $this->load->view('auth/forgot_password', $this->data);
        $this->load->view('auth/common/auth_footer', $this->data);
    }

    /* Logout User */
    public function logoutUser(){
        $this->session->sess_destroy();
        redirect('login');
    }
	
}
