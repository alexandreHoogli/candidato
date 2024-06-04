<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    protected $browserResponse;
    protected $user_id;
    
    public function __construct(){

      parent::__construct();
      checkLogin();
      $plans_data = checkPlanDetails();
      
      $this->user_id = $this->session->userdata('user_id');
      $this->browserResponse = array('status'=>'error','message'=>'','redirect'=>'');
      $this->data = array('header_meta_data' => [], 'page_info' => ['page_title' => '', 'page_name' => ''], 'csrf' => $this->csrf_token, 'plans_data' => $plans_data);
      
    }

    public function index(){
      redirectLoggedInUser();
    }

    // User dashboard
    public function dashboard(){
        
        $data = $this->data;
        $data['page_info'] = array('page_title' => 'Dashboard', 'page_name' => 'u_dashboard');

        $data['dfy_templates_count']  = $this->Qdb->aggregate_data('dfy_templates', 'id', 'COUNT');
        $data['user_sites_count'] = $this->Qdb->aggregate_data('user_campaigns', 'id', 'COUNT', ['user_id' => $this->user_id]);
        $data['site_visit_count'] = $this->Qdb->aggregate_data('site_analytics', 'visit_count', 'SUM', ['user_id' => $this->user_id]);
        $data['hosted_site_count'] = $this->Qdb->aggregate_data('user_campaigns', 'id', 'COUNT', ['user_id' => $this->user_id, 'campaign_host_name !=' => '']);

        $data['sites_list'] = $this->Qdb->select_data( '*' , 'user_campaigns', array('user_id' => $this->user_id, 'campaign_host_name !=' => ''), '', '', array('id','desc'));

        $this->load->view('common/header', $data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('user/dashboard_view', $data);
        $this->load->view('common/footer', $data);
    }
    
    // Build-in Templates view
    public function dfyTemplates(){
      $data = $this->data;
      $data['search'] = $search_data = $where = '';
      if( isset($_GET['search']) && !empty($_GET['search'])  ){
        $search_data = array('template_name', $_GET['search']);
        $data['search'] = $_GET['search'];
      }
      $data['type'] = 0;
      if( isset($_GET['type']) && !empty($_GET['type'])  ){
        $data['type'] = base64_decode($_GET['type']);
        if( $data['type'] == 1 ){
          $user_temps = !empty($this->session->userdata('plan_templates')) ? $this->session->userdata('plan_templates'): [0];
          $where = ' id IN ('. implode( ',', $user_temps ) .')';
        }
      }
      
      $data['templates_list'] = $this->Qdb->select_data( '*' , 'dfy_templates', $where, array(15, 0), '', array('template_name','asc'), $search_data);
      
      $data['count'] = count( $data['templates_list'] );
      $data['page_info'] = array('page_title' => 'Templates', 'page_name' => 'u_dfytemplates');
      
      $this->load->view('common/header', $data);
      $this->load->view('common/sidebar', $data);
      $this->load->view('user/templates_list', $data);
      $this->load->view('common/footer', $data);
    }
    
    // Users sites list view
    public function userSites(){
      $data = $this->data;
      $data = $this->data;
      $data['search'] = $search_data = '';
      if( isset($_GET['search']) && !empty($_GET['search'])  ){
        $search_data = array('user_campaigns.template_name', $_GET['search']);
        $data['search'] = $_GET['search'];
      }
      
      $data['templates_list'] = $this->Qdb->select_data( 'user_campaigns.*,dfy_templates.is_downloadable' , 'user_campaigns', array('user_campaigns.user_id' => $this->user_id), array(15, 0), array('dfy_templates', 'dfy_templates.id = user_campaigns.temp_id'), array('user_campaigns.id','desc'), $search_data);
      $data['count'] = count( $data['templates_list'] );
      $data['page_info'] = array('page_title' => 'My Sites', 'page_name' => 'u_sites');

      $this->load->view('common/header', $data);
      $this->load->view('common/sidebar', $data);
      $this->load->view('user/campaigns_list', $data);
      $this->load->view('common/footer', $data);
    }
    
    // Users settings view
    public function userSettings(){

      $data = $this->data;

      $data['page_info'] = array('page_title' => 'Settings', 'page_name' => 'u_settings');
        
      $res = $this->Qdb->select_data( '*' , 'autoresponder', array('user_id' => $this->user_id, 'mkey' => 'autoresponder') );
      $aur_nm = $payment = $na = [];

      if(!empty($res)){
              $a = (array) json_decode( $res[0]['value'] );
          foreach($a as $k=>$v){
                  $v = (array) $v;
          $na[$k] = $v;
          $aur_nm[] = $k;
        }
      }
      $data['autoresponders'] = $aur_nm;        

      $resp = $this->Qdb->select_data( '*' , 'payment_integration', array('user_id' => $this->user_id) );
      if(!empty($resp)){
              foreach($resp as $k => $v){
          $payment[] = $v['key'];
        }
      }
      $data['payment_gateway'] = $payment; 
          
      $this->load->view('common/header', $data);
      $this->load->view('common/sidebar', $data);
      $this->load->view('admin/admin_settings', $data);
      $this->load->view('common/footer', $data);
    }
    
    // User profile view
    public function userProfile(){

      $data = $this->data;

      $user_info = $this->Qdb->select_data( 'u_id,u_name,u_pic,u_email,u_profile_details' , 'usertbl', array('u_id' => $this->user_id));
      $countries = $this->Qdb->select_data( '*' , 'tbl_countries' );

      if( isset($user_info[0]) && empty($user_info[0]['u_profile_details']) ){
          $user_info = ['ppa_uname' => '', 'ppa_number' => '', 'ppa_address' => '', 'ppa_city' => '', 'ppa_state' => '', 'ppa_zipcode' => '', 'ppa_country' => ''];
      }else{
          $user_info = json_decode($user_info[0]['u_profile_details'], true);
      }
      
      $data['page_info'] = array('page_title' => 'Profile', 'page_name' => 'u_profile');
      $data['user_info']      = $user_info;
      $data['countries_list'] = $countries;

      $this->load->view('common/header', $data);
      $this->load->view('common/sidebar', $data);
      $this->load->view('user/user_profile', $data);
      $this->load->view('common/footer', $data);
    }
    
    // Users templates preview view
    public function previewTemplate($id = 0){
      if( $id != 0 ){
        $template_data = $this->Qdb->select_data( '*' , 'user_campaigns', array('id' => $id,'user_id' => $this->user_id));
        if( !empty($template_data) ){
          $css = json_decode($template_data[0]['custom_css']);
          $js  = json_decode($template_data[0]['custom_js']);

          if( file_exists( getcwd().'/'.$template_data[0]['template_html'] ) ){
            $template_html = file_get_contents( getcwd().'/'.$template_data[0]['template_html'] );
            $template_html = str_replace(["</title>", 'custom.js"></script>'],['</title><style>'.$css.'</style>', 'custom.js"></script><script>'.$js."</script><script src='".base_url('assets/js/page_js/hosted_template.js')."'></script> <script type='text/javascript'>window.baseurl = '".base_url()."';</script><input id='temp_id' type='hidden' value='".$id."' /><input id='csrf_token' type='hidden' name='".$this->csrf_token['name']."' value='".$this->csrf_token['hash']."' />"], $template_html );
            echo $template_html;
          }
          else{
            $template_html = $template_data[0]['template_html'];

            $upload_path  = createTemplateDirectory();
            $p            = $upload_path.time().'.html';
            file_put_contents( getcwd().$p, $template_data[0]['template_html'] );
            $res          = $this->Qdb->update_data('user_campaigns', array( 'template_html' => $p ), array( 'user_id' => $this->user_id, 'id' => $id ));

            $template_html = str_replace(["</title>", 'custom.js"></script>'],['</title><style>'.$css.'</style>', 'custom.js"></script><script>'.$js."</script><script src='".base_url('assets/js/page_js/hosted_template.js')."'></script> <script type='text/javascript'>window.baseurl = '".base_url()."';</script><input id='temp_id' type='hidden' value='".$id."' /><input id='csrf_token' type='hidden' name='".$this->csrf_token['name']."' value='".$this->csrf_token['hash']."' />"], $template_html );
            echo $template_html;
          }
        }
        else
          redirect(''); 
      }
      else
        redirect('');
    }

    // Preview of build in template
    public function previewDfyTemplate($template_id = 0){
      if( $template_id != 0 ){
        $resultSet = $this->Qdb->select_data( '*' , 'dfy_templates', array('id' => $template_id) );
        if( !empty($resultSet) ){
          $file_contents = file_get_contents( getcwd().'/'.$resultSet[0]['zip_path'].'/index.html' );
          $file_contents = str_replace("assets/", base_url( $resultSet[0]['zip_path'].'/assets/') , $file_contents );
          echo $file_contents;
        }
        else
          redirect('dfy-templates');
      }
      else
        redirect('dfy-templates');
    }

    // Edit user site view
    public function editTemplate( $template_id ){
      $data = $this->data;

      $this->load->library('Common_icon');
      $resultSet = $this->Qdb->select_data( '*' , 'user_campaigns', array('id' => $template_id, 'user_id' => $this->user_id) );
      
      if(empty($resultSet))
        redirect('my-sites');

      $data['pageTitle']    = $resultSet[0]['template_name'];
      $data['templateName'] = $resultSet[0]['template_name'];
      $data['back_link']    = base_url('my-sites');
      $resultSet[0]['email_setting'] = !empty($resultSet[0]['email_setting'])? $resultSet[0]['email_setting'] : '{"auto_email":{"confirmation":"NO","welcome":"NO"},"autoresponder":{"visible":"NO","name":"","list":""}}';
      $resultSet[0]['campaign_type'] = '';
      $data['cData']           = $resultSet;
      $data['connectedArList'] = $this->connectedArList();
      $data['template_id'] = $template_id;
      $data['prev_url'] = base_url('template/preview/' . $template_id);

      $this->load->view('frontend/editor/header', $data);
      $this->load->view('frontend/editor/editing_screen_1', $data);
      $this->load->view('frontend/editor/footer', $data);
    }

    // AR list get function
    private function connectedArList(){

      $user_id = $this->user_id;
      
      $res = $this->Qdb->select_data('value', 'autoresponder', array( 'user_id' => $user_id, 'mkey' => 'autoresponder' ) );
      
      $aur_nm = array();
      $na = array();
      $customHTMlVal = array();
      if(!empty($res)){
        $a = (array) json_decode( $res[0]['value'] );
          foreach($a as $k=>$v){
          if($k == 'CustomHTML'){
            array_push($customHTMlVal,$v);
              } 
          $v = (array) $v;
          $na[$k] = $v;
          $aur_nm[] = $k;
        }
      }
      $data['connect_autoresponder'] = $aur_nm;
      return $data;

    }

    //  Get plans list for user
    public function plansList(){
      $data = $this->data;
      
      $data['plans_list'] = $this->Qdb->select_data( '*' , 'plans_list', array('p_status' => 1), '', '', array('id','desc'));
      $resp = $this->Qdb->select_data( '*' , 'payment_integration' );
      if( empty($resp) ){
          $data['plans_list'] = [];
      }
      
      $data['page_info'] = array('page_title' => 'Plans', 'page_name' => 'u_allplans');
      
      $this->load->helper('currency_helper'); 
      $data['symbol_ar'] = getCurrencySymbols();

      $this->load->view('common/header', $data);
      $this->load->view('common/sidebar', $data);
      $this->load->view('user/plans/plans_list', $data);
      $this->load->view('common/footer', $data);
    }

    // Sites response
    public function sitesResponse(){
        $data  = $this->data;
        $where = array('ar_form_data.user_id' => $this->user_id );
        $data['search'] = $data['site_id'] = $data['form_type'] = $search = '';
        $data['connectedArList'] = $this->connectedArList();
  
        if( isset( $_GET['site_id'] ) && $_GET['site_id'] != 'all' ){
          if( empty( $_GET['site_id'] ) )
            redirect( 'sites-response' );
  
          $data['site_id'] = base64_decode( $_GET['site_id'] );
          $where['ar_form_data.campaign_id'] = $data['site_id']; 
        }
        if( isset( $_GET['form_type'] ) && $_GET['form_type'] != 'all' ){
          if( empty( $_GET['form_type'] ) )
            redirect( 'sites-response' );
  
          $data['form_type'] = base64_decode( $_GET['form_type'] );
          $where['ar_form_data.form_type'] = $data['form_type']; 
        }
        if( isset( $_GET['search'] ) )
          if( !empty( $_GET['search'] ) ){
            $search = array('ar_form_data.all_details', $_GET['search']);
            $data['search'] = $_GET['search'];
          }
        $this->db->query('SET SESSION sql_mode = ""');
        $data['data_list'] = $this->Qdb->select_data( 'ar_form_data.*,site_analytics.visit_count,user_campaigns.template_name,user_campaigns.campaign_host_name' , 'ar_form_data', $where, '', array( 'multiple', array( array('user_campaigns', 'user_campaigns.id = ar_form_data.campaign_id'), array('site_analytics', 'site_analytics.site_id = ar_form_data.campaign_id') ) ), '', $search, 'ar_form_data.all_details');
        // echo $this->db->last_query();die;
        $data['site_list'] = $this->Qdb->select_data( 'user_campaigns.id,user_campaigns.template_name,user_campaigns.campaign_host_name', 'user_campaigns', array('ar_form_data.user_id' => $this->user_id, 'user_campaigns.campaign_host_name != ' => ''), '' , array( 'ar_form_data', 'ar_form_data.campaign_id = user_campaigns.id' ), '', '', 'user_campaigns.id');
        
        
        $data['page_info'] = array('page_title' => 'Sites Response', 'page_name' => 'u_sites_response');
        
        $this->load->view('common/header', $data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('user/sites_response', $data);
        $this->load->view('common/footer', $data);
      }
	
}
