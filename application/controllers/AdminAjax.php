<?php
defined('BASEPATH') OR exit('Nenhum acesso direto ao script é permitido');

class AdminAjax extends CI_Controller {

    protected $browserResponse;
    protected $user_id;
    
	public function __construct(){

        parent::__construct();
        checkLogin();
        checkIsAdmin();
		$this->browserResponse = array('status'=>'error','message'=>'Algo deu errado! Atualize e tente novamente','redirect'=>'');
		$this->user_id = $this->session->userdata('user_id');
    }

	private function checkValidAJAX(){
		if( !$this->input->is_ajax_request() )
			die('Desautorizar acesso!!');
	}

	// Admin Create Update Users
	public function createUpdateUser(){
		$this->checkValidAJAX();

		$user_id = $this->input->post('pps_userid');

		/* Create User data */
		if( empty($this->input->post('pps_userid')) ){

			$this->form_validation->set_rules('pps_email', 'email', 'required|is_unique[usertbl.u_email]', array( 'required' => 'Você não forneceu %s.','is_unique' => 'Esse %s já existe.') ); 
			$this->form_validation->set_rules('pps_password_first', 'Senha', 'required');
			$this->form_validation->set_rules('pps_password', 'Confirme sua senha', 'required|matches[pps_password_first]');
			
			if ($this->form_validation->run() == FALSE){
				$this->browserResponse['message'] = strip_tags(validation_errors()) ;
			}
			else{
				$data['u_name'] = $this->input->post('pps_name'); 
				$data['u_email'] = $this->input->post('pps_email'); 
				$data['u_password'] = md5($this->input->post('pps_password')); 
				$data['u_type'] = 2; 
				$data['u_status'] = 1; 
				$data['u_purchaseddate'] = date('Y-m-d H:i:s'); 

				$res = $this->Qdb->insert_data('usertbl', $data);

				if( !empty($res) ){
					$user_id = $res;
					$this->browserResponse['status'] = 'success';
					$this->browserResponse['message'] = 'A conta de usuário foi criada com sucesso';
					$this->browserResponse['redirect'] = 'reload';
				}
        	}

		}
		/* Update User data */
		else {

			$this->form_validation->set_rules('pps_password_first', 'Senha', 'trim');
			$this->form_validation->set_rules('pps_password', 'Confirme sua senha', 'trim|matches[pps_password_first]');
			
			if ($this->form_validation->run() == FALSE){
				$this->browserResponse['message'] = strip_tags(validation_errors()) ;
			}
			else{
				$data['u_name'] = $this->input->post('pps_name'); 
				$password = $this->input->post('pps_password');
				if( !empty( $password ) )
					$data['u_password'] = md5($this->input->post('pps_password')); 
				
				$res = $this->Qdb->update_data('usertbl', $data, array('u_id' => $this->input->post('pps_userid')));
				
				$this->browserResponse['status']   = 'success';
				$this->browserResponse['redirect'] = 'reload';
				$this->browserResponse['message']  = 'Usuário atualizado com sucesso';
				
			}
		}

		$plan_id = $this->input->post('user_plan');
		if( !empty( $plan_id ) ){
			$condition = true;
			$check_plan = checkPlanDetails( $user_id );
			if( $check_plan['status'] != 0 ){
				if($check_plan['plan_id'] == $plan_id)
					$condition = false;
			}

			if( $condition ){
				$date = date('Y-m-d H:i:s');
				$addPayInte = $this->Qdb->insert_data(
					'payment_info', [
						'type'          => '4',
						'customer_id'   => $user_id,
						'plan_id'       => $plan_id,
						'payment_data'  => 'Admin',
						'order_id'      => 'NA', 
						'payment_status'=> '1', 
						'created_on'    => $date,
						'updated_on'    => $date,
						'status'        => 1
					]
				);
			}
		}else{
			$res = $this->Qdb->update_data('payment_info', array( 'status' => 0 ), array('customer_id' => $user_id) );
		}

		if( isset($_POST['ppa_send_creds']) ){

			$supportEmail = 'support@example.com';
			$contact = 'contact@example.com';

			$body = "<p>Olá ". $this->input->post('pps_name') .",</p>";
			$body .= '<br>';
			$body .= "<p>Estamos entusiasmados em recebê-lo em ". $_SESSION['site_name'] ."! Obrigado por escolher fazer parte de nossa comunidade. </p>";
			$body .= "<p>Sua nova conta está configurada, estamos felizes em ter você a bordo.</p>";
			$body .= "<p>Para começar, basta fazer login em sua conta usando o seguinte link: ".base_url('login')."</p>";
			$body .= '<br>';
			$body .= "<p>As credenciais de login são</p>";
			$body .= "<p>Email: ". $this->input->post('pps_email') ."</p>";
			$body .= "<p>Senha: ". $this->input->post('pps_password') ."</p>";
			$body .= '<br>';
			$body .= "<p>Se você tiver alguma dúvida, encontrar algum problema ou precisar de assistência com qualquer coisa relacionada à sua conta, não hesite em entrar em contato com nossa equipe de suporte ao cliente em </p>";
			$body .= "<p>".$supportEmail.". </p>";
			$body .= '<br>';
			$body .= "<p>Obrigado por escolher ". $_SESSION['site_name'] .". Estamos ansiosos para atendê-lo e proporcionar-lhe uma experiência excepcional. </p>";
			$body .= '<br>';
			$body .= "<p>Atenciosamente,</p>";
			$body .= '<br>';
			$body .= "<p>". $_SESSION['site_name'] ."</p>";
			$body .= "<p>". base_url() ."</p>";
			$body .= "<p>". $contact ."</p>";
            sendEmailToUser($this->input->post('pps_email'),'Nova senha ['.$_SESSION['site_name'].']',$body);

			// $res = sendUserEmailMandrill($this->input->post('pps_email'),'Welcome to '.$_SESSION['site_name'].' - Your Account is Ready!',$body , $_SESSION['site_name']);

		}

        echo json_encode($this->browserResponse);
	}

	// Admin get user details by id
	public function getUserInfoById(){
		$this->checkValidAJAX();
		if(!empty($this->input->post('user_id'))){
			$user_id = $this->input->post('user_id');
			$user_info = $this->Qdb->select_data( 'u_id,u_name,u_email,u_password,u_type,u_status' , 'usertbl', array('u_id' => $user_id));

			if( !empty($user_info) ){

				$output['pps_name'] = $user_info[0]['u_name'];
				$output['pps_email'] = $user_info[0]['u_email'];
				$output['pps_userid'] = $user_info[0]['u_id'];
				$user_plan = checkPlanDetails( $user_info[0]['u_id'] );
				if( $user_plan['status'] != 0 )
					$output['user_plan'] =  $user_plan['plan_id'];

				$this->browserResponse['status'] = 'success';
				$this->browserResponse['message'] = '';
				$this->browserResponse['formData'] = json_encode($output) ;
				$this->browserResponse['form'] = "#createupdateuser_form" ;
				$this->browserResponse['openModal'] = "#pxg_create_update_user_model" ;
			}
		}
        echo json_encode($this->browserResponse);
	}

	// Admin delete user by id
	public function deleteUserById(){
		$this->checkValidAJAX();
		if( !empty( $this->input->post('uniq_id') ) ){
			$user_id = $this->input->post('uniq_id');
			$user_data = $this->Qdb->select_data( 'u_pic' , 'usertbl', array('u_id' => $user_id));

			$res = $this->Qdb->delete_data('usertbl', array('u_id' => $user_id));
			if( !empty( $res ) ){

				if( !empty( $user_data ) )
					if( !empty($user_data[0]['u_pic']) ){
						$profile_path = getcwd().'/'.$user_data[0]['u_pic'];
						if( file_exists( $profile_path ) )
							unlink( $profile_path );
					}
				

				$res = $this->Qdb->delete_data('ar_form_data', array('user_id' => $user_id));
				$res = $this->Qdb->delete_data('payment_info', array('customer_id' => $user_id));
	
				
				$media_data = $this->Qdb->select_data( 'id,url,source' , 'imagelibrary', array('uid' => $user_id));
				foreach ($media_data as $key => $value) {
					if( $value['source'] == 'custom' )
						$furl = getcwd().'/uploads/medialibrary/'.$value['url'];
					else
						$furl = getcwd().'/uploads/pixaimages/'.$value['url'];
					if( file_exists( $furl ) )
						unlink( $furl );
				}
				$this->common->deleteDirectory( getcwd().'/uploads/template/user_'.$user_id );

				$res = $this->Qdb->delete_data('imagelibrary', array('uid' => $user_id));
				$res = $this->Qdb->delete_data('site_analytics', array('user_id' => $user_id));
				$res = $this->Qdb->delete_data('site_settings', array('user_id' => $user_id));
				$res = $this->Qdb->delete_data('user_campaigns', array('user_id' => $user_id));

			}

			$this->browserResponse['status'] = 'success';
			$this->browserResponse['message'] = 'Usuário excluído com sucesso';
			$this->browserResponse['redirect'] = 'reload';
		}
		echo json_encode($this->browserResponse);
	}

	// Admin Change User status
	public function updateUserActiveStatus(){
		$this->checkValidAJAX();
		$user_id = $this->input->post('user_id');
		if( !empty( $user_id ) ){
			$u_status = $this->input->post('user_status');
			$res = $this->Qdb->update_data('usertbl', array('u_status' => ($u_status == 'true' ? 1 : 2) ) ,array('u_id' => $user_id));

			$this->browserResponse['status'] = 'success';
			$this->browserResponse['message'] = ($u_status == 'true') ? 'O usuário está ativo' : 'User is In-Active';
		}
		echo json_encode($this->browserResponse);
	}
	
	/* Plan Ajax Starts */
	public function createUpdatePlan(){
		$this->checkValidAJAX();
		
		$this->form_validation->set_rules('plan_currency', 'Plan Currency', 'required|trim');
		$this->form_validation->set_rules('plan_price', 'Plan Price', 'required|trim');
		$this->form_validation->set_rules('plan_interval', 'Plan Interval', 'required|trim');
		$this->form_validation->set_rules('plan_description', 'Plan Description', 'required|trim');


		if ($this->form_validation->run() == FALSE){
			$this->browserResponse['message'] = strip_tags(validation_errors()) ;
		}else{
			/* Create Plan */

			$data['p_name'] = $this->input->post('plan_name'); 
			$data['p_price'] = $this->input->post('plan_price'); 
			$data['p_currency'] = $this->input->post('plan_currency'); 
			$data['p_interval'] = $this->input->post('plan_interval');
			$data['p_description'] = $this->input->post('plan_description'); 
			$data['p_sites'] = $this->input->post('sites_allowed'); 
			// $data['p_templates'] =  base64_decode( $this->input->post('plan_templates') ); 
			$data['p_templates'] =  (empty( $this->input->post('plan_templates1[]') )? '[]': json_encode($this->input->post('plan_templates1[]'))); 

			if( empty($this->input->post('plan_id')) ){
	
				$this->form_validation->set_rules('plan_name', 'Plan Name', 'required|is_unique[plans_list.p_name]', array( 'required' => 'Você não forneceu %s.','is_unique' => 'Esse %s já existe.') ); 
				
				if ($this->form_validation->run() == FALSE){
					$this->browserResponse['message'] = strip_tags(validation_errors()) ;
				}
				else{
					$res = $this->Qdb->insert_data('plans_list', $data);
	
					if( !empty($res) ){
						$this->browserResponse['status'] = 'success';
						$this->browserResponse['message'] = 'O plano foi criado com sucesso';
						$this->browserResponse['redirect'] = 'reload';
					}
				}
			}
			/* Update Plan */
			else {
				
				$res = $this->Qdb->update_data('plans_list', $data, array('id' => $this->input->post('plan_id')));
				if( !empty($res) ){
					$this->browserResponse['status']   = 'success';
					$this->browserResponse['redirect'] = 'reload';
					$this->browserResponse['message']  = 'Plano atualizado com sucesso';
				}else{
					$this->browserResponse['status']   = 'success';
					$this->browserResponse['redirect'] = 'close';
					$this->browserResponse['message']  = 'Nenhuma alteração detectada';
				}
				
			}
		}

        echo json_encode($this->browserResponse);
	}

	public function getPlanInfoById(){
		$this->checkValidAJAX();
		$plan_id = $this->input->post('plan_id');
		if(!empty( $plan_id )){
			$plan = $this->Qdb->select_data( '*' , 'plans_list', array('id' => $plan_id));

			if( !empty($plan) ){
				
				$output['plan_name'] = $plan[0]['p_name'];
				$output['plan_price'] = $plan[0]['p_price'];
				$output['plan_currency'] = $plan[0]['p_currency'];
				$output['plan_interval'] = $plan[0]['p_interval'];
				$output['plan_description'] = $plan[0]['p_description'];
				$output['sites_allowed'] = $plan[0]['p_sites'];
				// $output['plan_templates'] = base64_encode( $plan[0]['p_templates']);
				$output['plan_templates1[]'] = json_decode($plan[0]['p_templates'], true);
				$output['plan_id'] = $plan[0]['id'];
				
				$this->browserResponse['data']['elm_'] = '#selected_templates_num';
				$this->browserResponse['data']['txt_'] = 'Selected Templates - '.count( json_decode( $plan[0]['p_templates'], true) );

				$this->browserResponse['status'] = 'success';
				$this->browserResponse['message'] = '';
				$this->browserResponse['formData'] = json_encode($output) ;
				$this->browserResponse['form'] = "#createupdateplan_form" ;
				$this->browserResponse['openModal'] = "#pxg_create_update_plan_model" ;
			}
		}
        echo json_encode($this->browserResponse);
	}
	
	public function updatePlanActiveStatus(){
		$this->checkValidAJAX();
		$plan_id = $this->input->post('plan_id');
		if( !empty( $plan_id ) ){
			$p_status = $this->input->post('plan_status');
			$res = $this->Qdb->update_data('plans_list', array('p_status' => ($p_status == 'true' ? 1 : 0) ) ,array('id' => $plan_id));

			$this->browserResponse['status'] = 'success';
			$this->browserResponse['message'] = ($p_status == 'true') ? 'O plano está visível para os usuários' : 'O plano não está visível para os usuários';
		}
		echo json_encode($this->browserResponse);
	}
	
	public function deletePlanById(){
		$this->checkValidAJAX();
		$plan_id = $this->input->post('uniq_id');
		if( !empty( $plan_id ) ){
			$res = $this->Qdb->delete_data('plans_list', array('id' => $plan_id));

			$this->browserResponse['status'] = 'success';
			$this->browserResponse['message'] = 'Plano removido com sucesso';
			$this->browserResponse['redirect'] = 'reload';
		}
		echo json_encode($this->browserResponse);
	}

	public function getTemplateByKeyword(){
		$keyword = $this->input->post('term');
		$templates = $this->Qdb->select_data( 'id,template_name' , 'dfy_templates', '', '', '', '', array('template_name', $keyword));
		echo json_encode($templates);

	}

	public function loadTemplatesForPlanAdd(){
		$this->checkValidAJAX();

        $offset 		= $this->input->post('offset');
        $search 		= $this->input->post('search');
        $limit 			= $this->input->post('limit');
        $filter 		= $this->input->post('filter');
        $plan_id 		= $this->input->post('plan_id');
        $selected 		= !empty( $this->input->post('selected') )? explode(',' ,$this->input->post('selected')): [];
		$p_templates 	= $this->Qdb->select_data( 'id,p_templates' , 'plans_list', array('id' => $plan_id));
		$selected_temps = !empty( $p_templates[0]['p_templates'] )? json_decode($p_templates[0]['p_templates'], true): [];

        $search_data = $html  = '';
        if( !empty( $search ) )
            $search_data = array('template_name', $search);

		if( $filter == 1 ){
			$where_in = 'id IN ('.implode(',', (!empty($selected_temps)? $selected_temps : [0]) ).')';
			$templates_list = $this->Qdb->select_data( '*' , 'dfy_templates', $where_in, array($limit, $offset), '', array('id','desc'), $search_data);
		}
		else if( $filter == 2 ){

			$where_in = 'id IN ('.implode(',', (!empty($selected)? $selected : [0]) ).')';
			$templates_list = $this->Qdb->select_data( '*' , 'dfy_templates', $where_in, array($limit, $offset), '', array('id','desc'), $search_data);
		}
		else{
			$templates_list = $this->Qdb->select_data( '*' , 'dfy_templates', '', array($limit, $offset), '', array('id','desc'), $search_data);
		}
        

        foreach ($templates_list as $key => $value) {
			$html .= $this->common->dfyTempElementAdminForPlan($value, in_array($value['id'], (empty($selected)? [] : $selected)));
			/* if( !$filter )
            	$html .= $this->common->dfyTempElementAdminForPlan($value, in_array($value['id'], (empty($selected)? [] : $selected)));
            else
				$html .= $this->common->dfyTempElementAdminForPlan($value, in_array($value['id'], (empty($selected_temps)? [] : $selected_temps))); */
            $offset ++;
        }
        
       $this->browserResponse['status']  = 'success';
       $this->browserResponse['count']  = count( $templates_list );
       $this->browserResponse['html']    = $html;
       $this->browserResponse['message'] = '';
       $this->browserResponse['offset']  = $offset;
       echo json_encode( $this->browserResponse );die;
	}
	/* Plan Ajax Ends   */

	/* Admin Template Ajax Starts   */
	public function updateAdminTemplate(){
		$this->checkValidAJAX();
		$template_id   = $this->input->post('template_id');
		$html          = $this->input->post('html');
		
		$template_data = $this->Qdb->select_data( '*' , 'dfy_templates', array('id' => $template_id));
		if( !empty( $template_data ) ){
			$temp_url = getcwd().'/'.$template_data[0]['zip_path'].'/index.html';
			$template_content = '<!DOCTYPE html><html lang="en">'.$html.'</html>';
			$res = file_put_contents($temp_url, $template_content);
			if( $res ){
				$this->browserResponse['status']  = 'success';
				$this->browserResponse['message'] = 'Modelo atualizado com sucesso';
			}
		}
		echo json_encode( $this->browserResponse );die;

	}
	/* Admin Template Ajax Ends   */

	/* Email Settings Ajax Starts */
	public function addMandrillSettings(){
		$this->checkValidAJAX();
		
		$data['m_email'] = $this->input->post('m_email');
		$data['m_key']   = $this->input->post('m_key');

		$currentSiteData = $this->Qdb->select_data( 'id,site_logo' , 'site_settings', array( 'user_id' => $this->user_id ));
		$data = json_encode($data);

        sendUserEmailMandrill('support@pixelpages.net', 'Checking Mandrill', 'test', true);

		if( empty( $currentSiteData ) )
			$res = $this->Qdb->insert_data('site_settings' , array('mandrill_settings' => $data, 'user_id' => $this->user_id));
		else
			$res = $this->Qdb->update_data('site_settings', array('mandrill_settings' => $data, 'date_updated' => date('Y-m-d H:i:s')), ['user_id' => $this->user_id]);

		$this->browserResponse['status'] = 'success';
		if( $res ){
			$this->browserResponse['message']  = 'Configurações salvas com sucesso';
			$this->browserResponse['redirect'] = 'reload';
		}
		else
			$this->browserResponse['message'] = 'Nenhuma alteração detectada';
		
		echo json_encode( $this->browserResponse );die;

	}
	public function addSmtpSettings(){
		$this->checkValidAJAX();

		$data['s_host']     = $this->input->post('s_host');
		$data['s_port']     = $this->input->post('s_port');
		$data['s_username'] = $this->input->post('s_username');
		$data['s_password'] = $this->input->post('s_password');
		$data['s_encryption'] = $this->input->post('s_encryption');

		$currentSiteData = $this->Qdb->select_data( 'id,site_logo' , 'site_settings', array( 'user_id' => $this->user_id ));
		$data_ar = $data;
		$data = json_encode($data);

		sendUserEmailSmtp( 'test', ['email' => 'support@pixelpages.net', 'subject' => 'Checking smtp'], $data_ar, true );

		if( empty( $currentSiteData ) )
			$res = $this->Qdb->insert_data('site_settings' , array('smtp_settings' => $data, 'user_id' => $this->user_id));
		else
			$res = $this->Qdb->update_data('site_settings', array('smtp_settings' => $data, 'date_updated' => date('Y-m-d H:i:s')), ['user_id' => $this->user_id]);
		
		$this->browserResponse['status'] = 'success';
		if( $res ){
			$this->browserResponse['message']  = 'Configurações salvas com sucesso';
			$this->browserResponse['redirect'] = 'reload';
		}
		else
			$this->browserResponse['message'] = 'Nenhuma alteração detectada';
		
		echo json_encode( $this->browserResponse );die;

	}

	public function disconnectEmailSetting($type){
		$this->checkValidAJAX();

		if( $type == 1 )
			$res = $this->Qdb->update_data('site_settings', array('mandrill_settings' => '', 'date_updated' => date('Y-m-d H:i:s')), ['user_id' => $this->user_id]);
		else if( $type == 2 )
			$res = $this->Qdb->update_data('site_settings', array('smtp_settings' => '', 'date_updated' => date('Y-m-d H:i:s')), ['user_id' => $this->user_id]);

		$this->browserResponse['status'] = 'success';
		if( $res ){
			$this->browserResponse['message']  = 'Configurações de e-mail desconectadas.';
			$this->browserResponse['redirect'] = 'reload';
		}
		else
			$this->browserResponse['message'] = 'Nenhuma alteração detectada';
		echo json_encode( $this->browserResponse );die;

	}
	/* Email Settings Ajax Ends   */
	

}