<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    protected $browserResponse;
    protected $data;

    public function __construct(){
        parent::__construct();
        $this->browserResponse = array('status'=>'error','message'=>'','redirect'=>'');
        $this->data = array('header_meta_data' => [], 'page_info' => ['page_title' => '', 'page_name' => ''], 'csrf' => $this->csrf_token);
        checkLogin();
        checkIsAdmin();
    }

    public function index(){
		redirect('admin/dashboard');
	}

    // Admin dashboard view
    public function dashboard(){

        $data = $this->data;

        $data['page_info'] = array('page_title' => 'Painel Administrativo', 'page_name' => 'admin_dashboard');
        
        $data['dfy_templates_count']  = $this->Qdb->aggregate_data('dfy_templates', 'id', 'COUNT');
        $data['user_sites_count']     = $this->Qdb->aggregate_data('user_campaigns', 'id', 'COUNT');
        $data['plans_sales']          = $this->Qdb->aggregate_data('payment_info', 'id', 'COUNT', array('type !='=> 4));

        $this->load->view('common/header', $data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('admin/dashboard_view', $data);
        $this->load->view('common/footer', $data);
    }

    // Admin users list view
    public function users(){

        $data['users_list'] = $this->Qdb->select_data( 'u_id,u_name,u_email,u_password,u_type,u_status,u_purchaseddate' , 'usertbl', array('u_type' => 2),'' , '', array('u_id', 'desc'));
        
        $data['plans_list'] = [];
        // $payment_integration = $this->Qdb->select_data( 'id' , 'payment_integration');
        // if( !empty( $payment_integration ) )
            $data['plans_list'] = $this->Qdb->select_data( '*' , 'plans_list', array('p_status' => 1),'' , '', array('id', 'desc'));
        
        $this->data['page_info'] = array('page_title' => 'Users List', 'page_name' => 'admin_userslist', 'data' => $data);
        
        $this->load->view('common/header', $this->data);
        $this->load->view('common/sidebar', $this->data);
        $this->load->view('admin/users_list', $this->data);
        $this->load->view('common/footer', $this->data);
    }

    // Admin plans view
    public function plans(){
        $data = $this->data;

        $data['plans_list'] = $this->Qdb->select_data( '*' , 'plans_list', '','' , '', array('id', 'desc'));
        $data['currency_list'] = $this->Qdb->select_data( '*' , 'currencies');
        $data['templates_list'] = $this->Qdb->select_data( '*' , 'dfy_templates');

        $data['page_info'] = array('page_title' => 'Lista de Planos', 'page_name' => 'admin_plans');

        $this->load->view('common/header', $data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('admin/admin_plans', $data);
        $this->load->view('common/footer', $data);
    }

    // Admin settings view
    public function settings(){

        $this->data['page_info'] = array('page_title' => 'Configurações de administrador', 'page_name' => 'admin_settings');
        
        $res = $this->Qdb->select_data( '*' , 'autoresponder', array('user_id' => $this->session->userdata('user_id'), 'mkey' => 'autoresponder') );
		$aur_nm = [];
		$na = [];
		if(!empty($res)){
            $a = (array) json_decode( $res[0]['value'] );
		    foreach($a as $k=>$v){
                $v = (array) $v;
				$na[$k] = $v;
				$aur_nm[] = $k;
			}
		}
        $this->data['autoresponders'] = $aur_nm;        
        
        $resp = $this->Qdb->select_data( '*' , 'payment_integration', array('user_id' => $this->session->userdata('user_id')) );
		
		$payment = [];
		if(!empty($resp)){
            foreach($resp as $k => $v){
				$payment[] = $v['key'];
			}
		}

		$currentSiteData = $this->Qdb->select_data( 'id,mandrill_settings,smtp_settings' , 'site_settings', array( 'user_id' => $this->session->userdata('user_id') ));
        $this->data['mandrill_settings'] = isset( $currentSiteData[0]['mandrill_settings'] ) ? json_decode($currentSiteData[0]['mandrill_settings'], true) : [];
        $this->data['smtp_settings']     = isset( $currentSiteData[0]['smtp_settings'] ) ? json_decode($currentSiteData[0]['smtp_settings'], true) : [];

        $this->data['payment_gateway'] = $payment; 
        $this->data['currency_list'] = $this->Qdb->select_data( '*' , 'currencies');
        $this->load->view('common/header', $this->data);
        $this->load->view('common/sidebar', $this->data);
        $this->load->view('admin/admin_settings', $this->data);
        $this->load->view('common/footer', $this->data);
    }

    // Admin Profile View
    public function profile(){
        

        $user_info = $this->Qdb->select_data( 'u_id,u_name,u_pic,u_email,u_profile_details' , 'usertbl', array('u_id' => $this->session->userdata('user_id')));
        $countries = $this->Qdb->select_data( '*' , 'tbl_countries' );

        if( isset($user_info[0]) && empty($user_info[0]['u_profile_details']) ){
            $user_info = ['ppa_uname' => '', 'ppa_number' => '', 'ppa_address' => '', 'ppa_city' => '', 'ppa_state' => '', 'ppa_zipcode' => '', 'ppa_country' => ''];
        }else{
            $user_info = json_decode($user_info[0]['u_profile_details'], true);
        }
        
        $this->data['page_info'] = array('page_title' => 'Perfil de administrador', 'page_name' => 'admin_profile', 'data' => $user_info, 'countries_list' => $countries);
        
        $this->load->view('common/header', $this->data);
        $this->load->view('common/sidebar', $this->data);
        $this->load->view('admin/admin_profile', $this->data);
        $this->load->view('common/footer', $this->data);
    }

    // Admin Templates View
    public function templates(){
        $data = $this->data;
        $data['search'] = $search_data = '';
        if( isset($_GET['search']) && !empty($_GET['search'])  ){
            $search_data = array('template_name', $_GET['search']);
            $data['search'] = $_GET['search'];
        }
        
        $data['templates_list'] = $this->Qdb->select_data( '*' , 'dfy_templates', '', array(15, 0), '', array('id','desc'), $search_data);
        $data['count'] = count( $data['templates_list'] );

        $templates_list = $this->Qdb->select_data( '*' , 'dfy_templates', '', '', '', array( 'template_name', 'asc' ));
        $data['page_info'] = array('page_title' => 'Modelos de administração', 'page_name' => 'admin_templates', 'data' => $data);
        
        $this->load->view('common/header', $data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('admin/templates_list', $data);
        $this->load->view('common/footer', $data);
    }

    // Admin Templates view
    public function preview($template_id){
        $resultSet = $this->Qdb->select_data( '*' , 'dfy_templates', array('id' => $template_id) );
        $file_contents = file_get_contents( getcwd().'/'.$resultSet[0]['zip_path'].'/index.html' );
        $file_contents = str_replace("assets", base_url( $resultSet[0]['zip_path'].'/assets') , $file_contents );
        echo $file_contents;
    }

    // Admin Templates View in editor
    public function editor( $template_id ){

        $this->load->library('Common_icon');
        $resultSet = $this->Qdb->select_data( '*' , 'dfy_templates', array('id' => $template_id) );
        
        if(empty($resultSet))
    		redirect('admin/templates');

        $this->data['pageTitle'] = $resultSet[0]['template_name'];
        $this->data['templateName'] = $resultSet[0]['template_name'];
        $this->data['back_link'] = base_url('admin/templates');
        $this->data['admin'] = true;
        $resultSet[0]['custom_css'] = '';
        $resultSet[0]['custom_js'] = '';
        $resultSet[0]['email_setting'] = '{"auto_email":{"confirmation":"YES","welcome":"YES"},"autoresponder":{"visible":"NO","name":"","list":""}}';
        $resultSet[0]['campaign_type'] = '';
        $this->data['cData'] = $resultSet;
		$this->data['connectedArList'] = [];
        $this->data['template_id'] = $template_id;
        $this->data['prev_url'] = base_url('admin/preview/' . $template_id);

        $this->load->view('frontend/editor/header', $this->data);
        $this->load->view('frontend/editor/editing_screen_1', $this->data);
        $this->load->view('frontend/editor/footer', $this->data);
    }
	
}
