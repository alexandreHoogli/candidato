<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Response extends CI_Controller {

    protected $browserResponse;
    protected $user_id;
    
    public function __construct(){

      parent::__construct();
      $this->browserResponse = array('status'=>'error','message'=>'','redirect'=>'');
      $this->data = array('header_meta_data' => [], 'page_info' => ['page_title' => '', 'page_name' => ''], 'csrf' => $this->csrf_token);
      
    }
    
	private function checkValidAJAX(){
		if( !$this->input->is_ajax_request() )
			die('Unauthorize Access!!');
	}

    public function is_scriptValid($id){
        $where = array("id" => $id, "status" => 1);
        $check_script = $this->Qdb->select_data('' , 'user_campaigns', $where , $limit = '1' );
        return $check_script;
    }

    // get response of form submitted on hosted template
    public function submitResponse(){
        $postData = $_POST;
    
        $check_script = $this->is_scriptValid($postData['auth_code']);
        if( !empty ($check_script)){

            $email_setting = json_decode($check_script[0]['email_setting'],true);
            $keys   = array_keys($_POST);
            $result = preg_grep('/email/', $keys);
            $field  = array_values($result);
            if( !empty( $field ) ){
                $email = $this->input->post( $field[0] );
            }else{
                $email = 'NA';
            }

            $form_type  = 1;
            if( count( $_POST) > 3 )
                $form_type  = 2;

            $checkemail = $this->Qdb->select_data( 'id' , 'ar_form_data', array('campaign_id' => $postData['auth_code'], 'user_email' => $email, 'form_type' => $form_type), 1);
            if( empty( $checkemail ) ){
                // save record
                
                $iArray['user_id']     = $check_script[0]['user_id']; 
                $iArray['campaign_id'] = $this->input->post('auth_code');
                $iArray['user_email']  = $email;
                $iArray['all_details'] = json_encode( $_POST );
                $iArray['date_added']  = date("Y-m-d H:i:s");
                $iArray['form_type']   = $form_type;
                
    
                $lastId	 = $this->Qdb->insert_data('ar_form_data' , $iArray);
                if( $email != 'NA' && $form_type == 1 ){
                    $this->addEmailToAR(array('contestants_id'=>$lastId,'user'=>'new','check_script'=>$check_script,'email' => $email));
                }
                echo json_encode(['status' => 'success', 'message' => 'Your response has been submitted']);
            }else{
                // already submitted response
                echo json_encode(['status' => 'success', 'message' => 'Response with this email already submitted']);
            }

        }
    }

    // add email in connected autoresponder
    public function addEmailToAR($data=''){
        $contestants_id = $data['contestants_id'];
        $email = $data['email'];
        $where = array('id'=>$contestants_id, 'form_type' => 1);
        $checkContestent = $this->Qdb->select_data('' , 'ar_form_data', $where , $limit = '1' , $join_array = '',$order_array='');
        $check_script = $data['check_script'];

        $formSettings = json_decode($check_script[0]['email_setting'],true);


        if($checkContestent && isset($email) ){

            // ADD EMAIL TO AUTORESPONDER LIST
            if($data['user'] == 'new'){
                if(isset($formSettings['autoresponder']) && $formSettings['autoresponder']['visible'] == 'YES'){
                    if(!empty($formSettings['autoresponder']['name']) && !empty($formSettings['autoresponder']['list'])){
                        
                        // Load Autoresponder Library
                        $_POST['listid'] = $formSettings['autoresponder']['list'];
                        $_POST['email']  = $email;

                        $res = $this->common->subscribeResponder($formSettings['autoresponder']['name'], $check_script[0]['user_id']);
                        echo json_encode($res);die;
                    }
                }
            }

        }
    }

    // add analytics of site
    public function addAnalytics(){
        $this->checkValidAJAX();
        $this->browserResponse['message'] = '';
        $site_id = $this->input->post('site_id');
        if( !empty($site_id) ){
            $site_detail = $this->Qdb->select_data( 'user_id, id' , 'user_campaigns', array('id' => $site_id), 1);
    
            $analytics_date = $this->Qdb->select_data( 'id,visit_count' , 'site_analytics', array('site_id' => $site_id, 'date' => date('Y-m-d')), 1);
            if( !empty( $analytics_date ) ){
                $uArray = array( 'visit_count' => $analytics_date[0]['visit_count'] + 1 );
                $res = $this->Qdb->update_data('site_analytics', $uArray, array('id' => $analytics_date[0]['id']));
                $this->browserResponse['status'] = 'success';
            }else{
                if( !empty( $site_detail ) ){
                    $lastId	 = $this->Qdb->insert_data('site_analytics' , array( 'visit_count' => 1, 'date' => date('Y-m-d'), 'user_id' => $site_detail[0]['user_id'], 'site_id' => $site_detail[0]['id'] ));
                    $this->browserResponse['status'] = 'success';
                }
            }
        }
        echo json_encode($this->browserResponse);
    }

}