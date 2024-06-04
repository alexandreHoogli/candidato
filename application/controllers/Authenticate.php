<?php
defined('BASEPATH') OR exit('Nenhum acesso direto ao script é permitido');
/* 

    This is the "Auth AJAX"

*/
class Authenticate extends CI_Controller {

    protected $browserResponse;
    
	public function __construct(){

        parent::__construct();
		$this->browserResponse = array('status'=>'error','message'=>'Algo deu errado! Por favor, tente novamente','redirect'=>'');
    
    }

	private function checkValidAJAX(){
		if( !$this->input->is_ajax_request() )
			die('Desautorizar acesso!!');
	}

    /* Verify User Login */
    public function verifyLogin(){

		$this->checkValidAJAX();
        
        $data['u_email']    = $this->input->post('ppl_email'); 
        $data['u_password'] = $this->input->post('ppl_pass'); 
        $remember_me = isset($_POST['ppl_rememberme'])? 1 : 0 ; 

        $res = $this->Qdb->select_data('u_id,u_name,u_password,u_email,u_pic,u_status,u_type,u_plan', 'usertbl', array('u_email' => $data['u_email'] ));

        if( !empty($res) ){
            $user_data = $res[0];
            
            if($user_data['u_password'] != md5($data['u_password'])){
				$this->browserResponse['message'] = 'Credenciais inválidas';
				echo json_encode($this->browserResponse);die();
			}
			if($user_data['u_status'] == 2 ){
				$this->browserResponse['message'] = 'Sua conta está inativa. Por favor, entre em contato com o suporte.';
				echo json_encode($this->browserResponse);die(); // InActive User
			}
			if($user_data['u_status'] == 3 ){
				$this->browserResponse['message'] = 'Sua conta está bloqueada. Por favor, entre em contato com o suporte.';
				echo json_encode($this->browserResponse);die();// Blocked User
			}
            if($user_data['u_type'] != 1){
                checkPlanDetails( $user_data['u_id'] );
            }


            // if passed above stages create session
            $session_data = array( 
                'username'  => $user_data['u_name'], 
                'email'     => $user_data['u_email'], 
                'u_type'    => $user_data['u_type'], 
                'plan_data' => $user_data['u_plan'], 
                'user_id'   => $user_data['u_id'], 
                'profile_pic'   => !empty($user_data['u_pic']) ? base_url() . $user_data['u_pic']: base_url() . DEFAULT_PIC, 
                'logged_in' => TRUE,
            );  
            $this->session->set_userdata($session_data);
            
            // set unset userdata cookie
            $cookie = array('u_email' => '', 'u_password' => '');
            if( $remember_me == 1 ){
                $cookie['u_email']    = $data['u_email'];
                $cookie['u_password'] = $data['u_password'];
            }

            set_cookie('u_em', $cookie['u_email'], time()+86400); 
            set_cookie('u_ps', $cookie['u_password'], time()+86400); 

            $this->browserResponse['status'] = 'sucesso';
            $this->browserResponse['message'] = 'Bem-vindo, você fez login com sucesso.';
            $this->browserResponse['redirect'] = $user_data['u_type'] == 1 ? '/admin' : ($user_data['u_type'] == 7 ? '/designer' : '/');
        }else{
            $this->browserResponse['message'] = 'Credenciais inválidas';
        }

        echo json_encode($this->browserResponse);

	
    }

    /* Verify and Sign Up User */
    public function verifySignUp(){

		$this->checkValidAJAX();

        $this->form_validation->set_rules(
            'pps_email', 'email',
            'required|is_unique[usertbl.u_email]',
            array(
                    'required'      => 'Você não forneceu %s.',
                    'is_unique'     => 'Esse %s já existe.'
            )
        );

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
                $this->browserResponse['status'] = 'sucesso';
                $this->browserResponse['message'] = 'Parabéns, sua conta foi criada com sucesso';
                $this->browserResponse['redirect'] = '/login';
            }

        }

        echo json_encode($this->browserResponse);
	
    }
    
    /* Recover User's Password */
    public function recoverYourPassword(){
		$this->checkValidAJAX();		
		$res = $this->Qdb->select_data( 'u_id,u_name,u_password,u_type,u_status' , 'usertbl' , array('u_email'=> $this->input->post('ppf_email')));
		if(!empty($res)){
            $user_data = $res[0];
			if($user_data['u_status'] == 2 ){
				$this->browserResponse['message'] = 'Sua conta está inativa. Por favor, entre em contato com o suporte.';
				echo json_encode($this->browserResponse);die(); // InActive User
			}
			if($user_data['u_status'] == 3 ){
				$this->browserResponse['message'] = 'Sua conta está bloqueada. Por favor, entre em contato com o suporte.';
				echo json_encode($this->browserResponse);die();// Blocked User
			}
			$pwd = substr(md5($user_data['u_password']),0,8);
			$this->Qdb->update_data( 'usertbl', array('u_password'=>md5($pwd)) , array('u_id'=>$user_data['u_id']) );
			
			$body  = '<p>Olá '.$user_data['u_name'].'</p>';
			$body .= '<p>Aqui está a nova senha do seu '.$_SESSION['site_name'].' conta.</p>';
			$body .= '<p>A senha é : '.$pwd.'</p><br/>';
			$body .= '<p>Para o seu sucesso.<br/>equipe, '.$_SESSION['site_name'].'</p>';
            sendEmailToUser($_POST['ppf_email'],'Nova Senha ['.$_SESSION['site_name'].']',$body);
			// sendUserEmailMandrill($_POST['ppf_email'],'New Password ['.$_SESSION['site_name'].']',$body , $_SESSION['site_name']);
			
			$this->browserResponse['message'] = 'Verifique seu e-mail para obter a nova senha.';
			$this->browserResponse['status'] = 'sucesso';
			$this->browserResponse['redirect'] = '/login';
		}
		else
			$this->browserResponse['message'] = 'Não conseguimos encontrar seu e-mail.';

		echo json_encode($this->browserResponse);die();
	}

}
