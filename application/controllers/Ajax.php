<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 

    This is the "COMMON AJAX"

*/
class Ajax extends CI_Controller {

    protected $browserResponse;
    protected $user_id;
    
	public function __construct(){

        parent::__construct();
        checkLogin();
        $this->user_id = $this->session->userdata('user_id');
		$this->browserResponse = array('status'=>'error','message'=>'Algo deu errado! Por favor, tente novamente','redirect'=>'');
    
    }

	private function checkValidAJAX(){
		if( !$this->input->is_ajax_request() )
			die('Unauthorize Access!!');
	}

    /* Analytics Ajax Starts */
    public function showAnaylyticsGraph(){
        $data = [];
        
            $site_id = $this->input->post('site_id');

            // $start_date     =   date('Y-m-d',strtotime($_POST['startDate']));
            // $end_date       =   date('Y-m-d', strtotime($_POST['endDate']. ' + 1 days'));
            
            $start_date     =   date('Y-m-d', strtotime('-7 days'));
            $end_date       =   date('Y-m-d', strtotime('+1 days'));
            
            $cond           =   ' 1 ' ;

            if(isset($_POST['site_id']) && !empty($_POST['site_id'])){
                $cond          .=  " AND analytics.site_id = ".$_POST['site_id'];
            }
           
            $cond          .=  " AND date >= '{$start_date}' AND  date <=  '{$end_date}'";
            
            $join           = array('site_analytics', 'site_analytics.site_id = user_campaigns.id');

            $analytics      = $this->Qdb->select_data('SUM(visit_count) as visit_count, date' , 'user_campaigns' , array('user_campaigns.user_id' => $this->user_id, 'user_campaigns.id' => $site_id) , '', $join, array('site_analytics.date', 'asc'), '','site_analytics.date' );

           
            $cateDate       = [];
            $visit_count    = [];

            $total_views    = 0;
            $day_diff = 1;
            
            if(isset($analytics[0])){
                if($start_date != $end_date){
                    $date1  =   date_create("{$start_date}");
                    $date2  =   date_create("{$end_date}");
                    $diff   =   date_diff($date1,$date2);
                    
                    $day_diff =  $diff->format('%d');
        
                    for($i = 0;$i < $day_diff;$i++){
                        $cdate          =   date('Y-m-d', strtotime($start_date. ' + '.$i.' days'));
                        
                        $a              =   $this->searchForDate($cdate, $analytics);
                        $visit_count[$i]=   $a ? $a['visit_count']   : 0;
                        $cateDate[$i]   =   date('d-M',strtotime($cdate));

                        $total_views    +=  $visit_count[$i];
                    }
                }else{
                    $cateDate[0]    = date('d-M',strtotime($analytics[0]['datetime']));
                    $total_views    = $visit_count[0]      = $analytics[0]['visit_count'];
                }
            }
           
            $data['last_visit']     = $cateDate;
            $data['site_visits']    = $visit_count;

            $data['sum']['views']      = $total_views;

            if( empty( $analytics ) ){
                $data = ['site_visits' => [0,0,0,0,0,0,0], 'last_visit' => get7DaysDates(7 , 'd-M')];
            }
           
            echo json_encode($data);	
        
        
    }

    function searchForDate($date, $analytics) {
        foreach ($analytics as $key => $val) {
            if ($val['date'] === $date) {
                return $val;
            }
        }
        return null;
    }

    /* Analytics Ajax Ends   */
	
    /* Users Ajax starts */
    public function addDfyTemplateDataToMyTemplates(){
        $this->checkValidAJAX();

        $plans_data = checkPlanDetails();
        if( $plans_data['status'] == 0 ){
            echo json_encode( ['status' => 'error', 'message' => $plans_data['message'], 'redirect' => ''] );
            die;
        }

        $dfy_id = $this->input->post('dfy_temp_id');
        checkPlanTemplates( $dfy_id );
        checkSitesCount();

		$dfy_temp_data = $this->Qdb->select_data( 'id,template_name,thumbnail_path,zip_path' , 'dfy_templates', array('id' => $dfy_id));
        if( !empty( $dfy_temp_data ) ){

            // check name exist or not
		    $user_existing_temp = $this->Qdb->select_data( 'COUNT(id) as existing' , 'user_campaigns', '', '' , '' , '' , array( 'template_name' , $dfy_temp_data[0]['template_name'] ));
            $copy_suffix = isset($user_existing_temp[0]['existing']) && $user_existing_temp[0]['existing'] != 0 ? ' - Copy('. $user_existing_temp[0]['existing'] .')' : '';

            $file_contents = file_get_contents( getcwd().'/'.$dfy_temp_data[0]['zip_path'].'/index.html' );
            $file_contents = str_replace("assets/", base_url( $dfy_temp_data[0]['zip_path'].'/assets/') , $file_contents );
            
            $upload_path = createTemplateDirectory();
            $p = $upload_path.time().'.html';
            file_put_contents( getcwd().$p, $file_contents );

            $iArray = array( 
                'user_id'            => $this->user_id,
                'temp_id'            => $dfy_id,
                'template_name'      => $dfy_temp_data[0]['template_name']. $copy_suffix ,
                'template_thumbnail' => $dfy_temp_data[0]['thumbnail_path'],
                'template_html'      => $p,
            );
    
            $insertId = $this->Qdb->insert_data('user_campaigns' , $iArray);
            if( !empty( $insertId ) ){
                $this->browserResponse['message'] = 'Adicionado com sucesso';
                $this->browserResponse['status']  = 'success';
                $this->browserResponse['redirect']  = '/template/edit/'.$insertId;
            }
        }
        echo json_encode( $this->browserResponse );
    }

    public function cloneUserTemplate(){
        $this->checkValidAJAX();

        $plans_data = checkPlanDetails();
        if( $plans_data['status'] == 0 ){
            echo json_encode( ['status' => 'error', 'message' => $plans_data['message'], 'redirect' => ''] );
            die;
        }

        $usr_temp_id = $this->input->post('usr_temp_id');
		$usr_temp_data = $this->Qdb->select_data( '*' , 'user_campaigns', array('id' => $usr_temp_id));

        
        if( !empty( $usr_temp_data ) ){
            
            checkPlanTemplates( $usr_temp_data[0]['temp_id'] );
            checkSitesCount();
            
            // check name exist or not
		    $user_existing_temp = $this->Qdb->select_data( 'COUNT(id) as existing' , 'user_campaigns', '', '' , '' , '' , array( 'template_name,template_name' , $usr_temp_data[0]['template_name'].',', $usr_temp_data[0]['template_name'].' - Clone(' ));
            $copy_suffix = isset($user_existing_temp[0]['existing']) && $user_existing_temp[0]['existing'] != 0 ? ' - Clone('. $user_existing_temp[0]['existing'] .')' : '';
            
            if( file_exists( getcwd().'/'.$usr_temp_data[0]['template_html'] ) ){
                $upload_path = createTemplateDirectory();
                $p = $upload_path.time().'.html';
                file_put_contents( getcwd().$p,  file_get_contents( getcwd().'/'.$usr_temp_data[0]['template_html'] ) );
                $usr_temp_data[0]['template_html'] = $p;
            }else{
                
                $upload_path = createTemplateDirectory();
                $p = $upload_path.time().'.html';
                file_put_contents( getcwd().$p, $usr_temp_data[0]['template_html'] );
                $usr_temp_data[0]['template_html'] = $p;
            }

            $iArray = array( 
                'user_id'            => $this->user_id,
                'temp_id'            => $usr_temp_data[0]['temp_id'],
                'template_name'      => $usr_temp_data[0]['template_name']. $copy_suffix ,
                'template_thumbnail' => $usr_temp_data[0]['template_thumbnail'],
                'email_setting'      => $usr_temp_data[0]['email_setting'],
                'custom_css'         => $usr_temp_data[0]['custom_css'],
                'custom_js'          => $usr_temp_data[0]['custom_js'],
                'template_html'      => $usr_temp_data[0]['template_html'],
                'created_date'       => date('Y-m-d H:i:s'),
                'status'             => $usr_temp_data[0]['status'],
                'template_settings'  => $usr_temp_data[0]['template_settings'],
            );
    
            $insertId = $this->Qdb->insert_data('user_campaigns' , $iArray);
            if( !empty( $insertId ) ){
                $this->browserResponse['message'] = 'Modelo clonado com sucesso';
                $this->browserResponse['status']  = 'success';
                $this->browserResponse['redirect']= 'reload';
            }
        }
        echo json_encode( $this->browserResponse );
    }

    public function addUpdateMyTemplate(){
        $this->checkValidAJAX();

        $plans_data = checkPlanDetails();
        if( $plans_data['status'] == 0 ){
            echo json_encode( ['status' => 'error', 'message' => $plans_data['message'], 'redirect' => ''] );
            die;
        }

        if( !empty( $this->input->post('ppd_uniq_id') ) ){

            $dfy_data = $this->Qdb->select_data( 'temp_id' , 'user_campaigns', array('id' => $this->input->post('ppd_uniq_id')));
            checkPlanTemplates( (isset($dfy_data[0]['temp_id'])? $dfy_data[0]['temp_id']: 0) );

            $hosting_name = trim( $this->input->post('ppd_template_hostingname') );
            if( !empty( $hosting_name ) ){
                $checkHosting = $this->Qdb->select_data( '*' , 'user_campaigns', array('campaign_host_name' => $hosting_name, 'id !=' => $this->input->post('ppd_uniq_id')));
                if( empty( $checkHosting ) ){
                    $uArray['campaign_host_name'] =  $hosting_name;
                }else{
                    $this->browserResponse['message'] = 'O nome do host já foi usado, tente outro nome';
                    echo json_encode($this->browserResponse);die; 
                }
            }else{
                $uArray['campaign_host_name'] =  '';
            }
            

            $uArray['template_name'] = $this->input->post('ppd_template_name'); 

            $res = $this->Qdb->update_data('user_campaigns', $uArray, array('id' => $this->input->post('ppd_uniq_id'), 'user_id' => $this->user_id));
            $this->browserResponse['message'] = 'Atualizado com sucesso';
            $this->browserResponse['status']  = 'success';
            $this->browserResponse['redirect']  = 'reload';

        }
        echo json_encode($this->browserResponse);
    }

    public function getMyTemplateById(){
        $this->checkValidAJAX();

        if(!empty($this->input->post('template_id'))){
			$tempzip_id = $this->input->post('template_id');
			$tempzip_info = $this->Qdb->select_data( '*' , 'user_campaigns', array('id' => $tempzip_id));

			if( !empty($tempzip_info) ){

				$output['ppd_template_name'] = $tempzip_info[0]['template_name'];
				$output['ppd_template_hostingname'] = $tempzip_info[0]['campaign_host_name'];
				$output['ppd_uniq_id'] = $tempzip_info[0]['id'];

				$this->browserResponse['status'] = 'success';
				$this->browserResponse['message'] = '';
				$this->browserResponse['formData'] = json_encode($output) ;
				$this->browserResponse['form'] = "#createupdatetemp_form" ;
				$this->browserResponse['openModal'] = "#pxg_create_update_template_model" ;
			}
		}
        echo json_encode($this->browserResponse);
    }

    public function deleteMyTemplate(){
        $this->checkValidAJAX();

        $plans_data = checkPlanDetails();
        if( $plans_data['status'] == 0 ){
            echo json_encode( ['status' => 'error', 'message' => $plans_data['message'], 'redirect' => ''] );
            die;
        }

        if( !empty( $this->input->post('uniq_id') ) ){
			$template_id = $this->input->post('uniq_id');
            $temp_data = $this->Qdb->select_data( 'template_html' , 'user_campaigns', array('id' => $template_id, 'user_id' => $this->user_id));
            $file_location = getcwd().'/'.$temp_data[0]['template_html'];
            if( file_exists( $file_location ) )
                unlink( $file_location );

            $res = $this->Qdb->delete_data('user_campaigns', array('id' => $template_id, 'user_id' => $this->user_id));
            $res = $this->Qdb->delete_data('ar_form_data', array('campaign_id' => $template_id));
            $res = $this->Qdb->delete_data('site_analytics', array('site_id' => $template_id, 'user_id' => $this->user_id));

			$this->browserResponse['status'] = 'success';
			$this->browserResponse['message'] = 'Modelo excluído com sucesso';
			$this->browserResponse['redirect'] = 'reload';
		}
		echo json_encode($this->browserResponse);
    }

    public function addUpdateUserProfile(){
		$this->checkValidAJAX();
		
		if( !empty($_FILES['profile_pic']['name']) ){

			$config['upload_path']          = 'uploads/profile_img/';
			$config['allowed_types']        = 'jpg|png|JPG|PNG|jpeg|JPEG';
			$config['max_size']             = 5000;
			$config['file_name'] 			= 'profile_'.$this->session->userdata('user_id');
	
			$this->load->library('upload', $config);
	
			if ( !$this->upload->do_upload('profile_pic')){
				$this->browserResponse['message'] = strip_tags( $this->upload->display_errors() ) ;
				echo json_encode($this->browserResponse);die;
			}
			else{
                $this->load->library('image_lib');
                $image_data =   $this->upload->data();

                $configer =  array(
                    'image_library'   => 'gd2',
                    'source_image'    =>  $image_data['full_path'],
                    'maintain_ratio'  =>  TRUE,
                    'width'           =>  250,
                    'height'          =>  250,
                );
                $this->image_lib->clear();
                $this->image_lib->initialize($configer);
                $this->image_lib->resize();

				$upload_data = $this->upload->data();
				$profile_pic = $config['upload_path'] . $upload_data['file_name'];
				$uSession 	 = array('profile_pic' => base_url() . $profile_pic);
				$uArray      = array('u_pic' => $profile_pic);

    			$currentUser = $this->Qdb->select_data( 'u_pic' , 'usertbl' , array('u_id'=> $this->user_id));
                if( !empty( $currentUser ) ){
                    $u_pic = getcwd(). '/' . $currentUser[0]['u_pic'];
                    if( file_exists( $u_pic ) )
                        unlink( $u_pic );
                }
			}
		}

        $current_pass = $this->input->post('old_password');
		$new_pass     = $this->input->post('new_password');

		if( !empty($current_pass)  ){
			if( empty($new_pass) ){
				echo json_encode( ['status' => 'error', 'message' => 'A nova senha não pode estar vazia! ', 'redirect' => ''] );die;
			}
            if( strlen($new_pass) < 8 ){
				echo json_encode( ['status' => 'error', 'message' => 'A nova senha não pode ter menos de 8 caracteres', 'redirect' => ''] );die;
			}
			$currentUser = $this->Qdb->select_data( 'u_id' , 'usertbl' , array('u_id'=> $this->user_id, 'u_password' => md5($current_pass)));
			if( !empty($currentUser) ){
				$uArray['u_password'] = md5($new_pass);
			}else{
				echo json_encode( ['status' => 'error', 'message' => 'A senha atual não corresponde! ', 'redirect' => ''] );die;
			}
		}
		
		$jsonArr = array(
			'ppa_uname' 	=> $this->input->post('ppa_uname'),
			'ppa_number' 	=> $this->input->post('ppa_number'),
			'ppa_address' 	=> $this->input->post('ppa_address'),
			'ppa_city' 		=> $this->input->post('ppa_city'),
			'ppa_state' 	=> $this->input->post('ppa_state'),
			'ppa_zipcode' 	=> $this->input->post('ppa_zipcode'),
			'ppa_country' 	=> $this->input->post('ppa_country'),
		);

        if( $this->session->userdata('u_type') == 1 ){
            
            if( isset( $_FILES['site_logo'] ) && !empty($_FILES['site_logo']['name']) ){
                $uploadPath = 'assets/images/';
                $uploaded_logo = $this->common->upload_image($uploadPath , 'site_logo' , '_'.$this->user_id);
            }
            if( isset( $_FILES['site_favicon'] ) && !empty($_FILES['site_favicon']['name']) ){
                $uploadPath = 'assets/images/';
                $uploaded_favicon = $this->common->upload_image($uploadPath , 'site_favicon' , '_'.$this->user_id);
            }
                $currentSiteData = $this->Qdb->select_data( 'id,site_logo' , 'site_settings', array( 'user_id' => $this->user_id ));

                $data = [];
                if( !empty($this->input->post('site_name')) )
                    $data['site_name'] = $_SESSION['site_name']  = $this->input->post('site_name');

                if( isset( $uploaded_logo ) && $uploaded_logo != '')
                    $data['site_logo'] = $_SESSION['site_logo']  = $uploadPath.$uploaded_logo;
                
                if( isset( $uploaded_favicon ) && $uploaded_favicon != '')
                    $data['site_favicon'] = $_SESSION['site_favicon']  = $uploadPath.$uploaded_favicon;

                if( !empty($this->input->post('support_mail')) )
                    $data['support_email'] = $_SESSION['support_mail'] = $this->input->post('support_mail');

                if( !empty( $data ) ){
                    
                    if( empty( $currentSiteData ) ){
                        $data['user_id'] = $this->user_id;
                        $this->Qdb->insert_data('site_settings' , $data);
                    }
                    else{
                        $current_logo =  getcwd().'/'.$currentSiteData[0]['site_logo'];
                        if( file_exists( $current_logo ) && isset( $data['site_logo'] ) )
                            unlink( $current_logo );
                        $data['date_updated'] = date('Y-m-d H:i:s');
                        $this->Qdb->update_data('site_settings' , $data, array( 'user_id' => $this->user_id ));
                    }
                }

            
        }


		$uArray['u_profile_details'] = json_encode($jsonArr, true);
		$uArray['u_name'] 			 = $jsonArr['ppa_uname'];

		$res = $this->Qdb->update_data('usertbl', $uArray, array('u_id' => $this->session->userdata('user_id')));
		
		if( $res == 1 ){
			$uSession['username'] = $jsonArr['ppa_uname'];
			$this->session->set_userdata($uSession);
		}

		$this->browserResponse['status'] = 'success';
		$this->browserResponse['message'] = 'Perfil de usuário atualizado com sucesso';
		$this->browserResponse['redirect'] = 'reload';

		echo json_encode($this->browserResponse);
	}

    public function loadDfyTemplates(){
        $this->checkValidAJAX();

        $offset = $this->input->post('offset');
        $search = $this->input->post('search');
        $limit = $this->input->post('limit');
        $type = $this->input->post('type');

        $search_data = $html  = $where = '';
        if( !empty( $search ) )
            $search_data = array('template_name', $search);

        if( !empty( $type ) ){
            $user_temps = !empty($this->session->userdata('plan_templates')) ? $this->session->userdata('plan_templates'): [0];
            $where = ' id IN ('. implode( ',', $user_temps ) .')';
        }
        
        $templates_list = $this->Qdb->select_data( '*' , 'dfy_templates', $where, array($limit, $offset), '', array('template_name','asc'), $search_data);

        foreach ($templates_list as $key => $value) {
            if( $this->session->userdata('u_type') == 1 )
                $html .= $this->common->dfyTempElementAdmin($value);
            else
                $html .= $this->common->dfyTempElementUser($value);
            $offset ++;
        }
        
       $this->browserResponse['status']  = 'success';
       $this->browserResponse['count']  = count( $templates_list );
       $this->browserResponse['html']    = $html;
       $this->browserResponse['message'] = '';
       $this->browserResponse['offset']  = $offset;
       echo json_encode( $this->browserResponse );die;
    }

    public function loadMyTemplates(){
        $this->checkValidAJAX();

        $offset = $this->input->post('offset');
        $search = $this->input->post('search');
        $limit = $this->input->post('limit');

        $search_data = $html  = '';
        if( !empty( $search ) )
            $search_data = array('template_name', $search);
        
        // $templates_list = $this->Qdb->select_data( '*' , 'user_campaigns', array('user_id' => $this->user_id), array($limit, $offset), '', array('id','desc'), $search_data);
        $templates_list = $this->Qdb->select_data( 'user_campaigns.*,dfy_templates.is_downloadable' , 'user_campaigns', array('user_campaigns.user_id' => $this->user_id), array($limit, $offset), array('dfy_templates', 'dfy_templates.id = user_campaigns.temp_id'), array('user_campaigns.id','desc'), $search_data);

        foreach ($templates_list as $key => $value) {
            $html .= $this->common->userSiteElement($value);
            $offset ++;
        }
        
       $this->browserResponse['status']  = 'success';
       $this->browserResponse['count']  = count( $templates_list );
       $this->browserResponse['html']    = $html;
       $this->browserResponse['message'] = '';
       $this->browserResponse['offset']  = $offset;
       echo json_encode( $this->browserResponse );die;
    }
    /* Users Ajax ends   */

    /* Editor Ajax Starts */
    public function saveMyTemplate(){ // update my-template data
        $this->checkValidAJAX();

        $plans_data = checkPlanDetails();
        if( $plans_data['status'] == 0 ){
            echo json_encode( ['status' => 'error', 'message' => $plans_data['message'], 'redirect' => ''] );
            die;
        }

        $template_id      = $this->input->post('template_id');
        $template_content = $this->input->post('template_content');
        

        $temp_data = $this->Qdb->select_data( 'template_html,temp_id' , 'user_campaigns', array('id' => $template_id, 'user_id' => $this->user_id));
        if( !empty( $temp_data ) ){

            checkPlanTemplates( $temp_data[0]['temp_id'] );
            
            $template_content = '<!DOCTYPE html><html lang="en">'.$template_content.'</html>';

            $file_location = getcwd().'/'.$temp_data[0]['template_html'];
                
            if( file_exists( $file_location ) ){
                file_put_contents( $file_location, $template_content );
                $this->browserResponse['message']  = 'Modelo atualizado com sucesso';
                $this->browserResponse['status']   = 'success';
            }else{
                $upload_path = createTemplateDirectory();
                $p = $upload_path.time().'.html';
                file_put_contents( getcwd().$p, $file_contents );

                $uArray  = array( 'template_html' => $p );
                $res     = $this->Qdb->update_data('user_campaigns', $uArray, array( 'user_id' => $this->user_id, 'id' => $template_id ));
                $this->browserResponse['status']   = 'success';
                $this->browserResponse['message']  = 'Modelo atualizado com sucesso';
            }
        }
        echo json_encode( $this->browserResponse );
    }

    function load_media_library_img(){
        $this->checkValidAJAX();

        $resData = array();
        $uid = $this->common->uid;  
        //$uid = 2;  
        $UploadPath = base_url().'uploads/medialibrary/';
        $offSet = (isset($_POST['offset']))?($_POST['offset']*6):0; 
        $offSet = ($offSet < 0)?0:$offSet;
        $limit = array(6 , $offSet);
        $Cond = "uid = $uid  ";//AND source = 'custom'
        if(isset($_POST['searchTerm']) && $_POST['searchTerm']!=''){
                $campaign_name=$_POST['searchTerm'];
                $Cond .= " AND title LIKE '%$campaign_name%'";
        }
        $imgLibrary = $this->Qdb->select_data('id,url,source,title' , 'imagelibrary' , $Cond , $limit , '',array('id' , 'DESC'));
        $imglibMsg = ($offSet > 0)?'No more images in your Image Library':'There is not any images in your Library';
        $libData = '';
        if($imgLibrary){
            foreach($imgLibrary as $imgData){
                $UploadPath = ($imgData['source'] == 'custom') ? 'uploads/medialibrary/' : 'uploads/pixaimages/';
                $libData .= '<li><a href="javascript:;"><img src="'.base_url().$UploadPath.$imgData['url'].'" alt="'.$imgData['title'].'"/ class="mt_use_img" data-type="'.$_POST['img_container_id'].'" ></a></li>'; 
            }
        }else{
            $libData .= '<li>'.$imglibMsg.'</li>';
        }
        $checkNext = $this->Qdb->select_data('id' , 'imagelibrary' , $Cond , array(6 , $offSet+1));
        $resData = array('status' => 1 , 'data' => $libData , 'pagination' => (!empty($checkNext))?1:0);
        $this->common->showResponce($resData);
    }

    function load_api_img(){

        $this->checkValidAJAX();

        $resData = array();
        
        $offSet = (isset($_POST['offset']))?($_POST['offset']):1; 
        $offSet = ($offSet < 1)?1:$offSet;
        
        $keyword = '';
        if(isset($_POST['searchTerm']) && $_POST['searchTerm']!=''){
                $keyword=$_POST['searchTerm'];
        }
        
        if( $_POST['api'] == 'pixabay' ){
            $results = $this->search_keyword_on_pixabay($keyword,$offSet);
            $img_container_id = str_replace("pix","",$_POST['img_container_id']);
            
        }
        else if( $_POST['api'] == 'unsplash' ){
            $results = $this->search_keyword_on_unsplash($keyword,$offSet);
            $img_container_id = str_replace("uns","",$_POST['img_container_id']);
        }
        
        $libData = '';
        if(isset($results['status']) && $results['status'] == 'error'){
            $libData .= '<li>'.$results['msg'].'</li>';
        }else{
            if($results){
                foreach($results as $imgData){
                $libData .= '<li><a href="javascript:;"><img src="'.$imgData['img'].'" alt="'.$imgData['tags'].'"/ class="mt_upload_imgurl" data-type="'.$img_container_id.'" ></a></li>'; 
                }   
                
            }else{
                $libData = ($offSet > 1)?'<li>No more images in found</li>':'<li>There is not any images with this keyword</li>';
            }
            
        }
        $resData = array('status' => 1 , 'data' => $libData , 'pagination' => (!empty($results))?1:0);
        echo json_encode($resData);
    }

    private function search_keyword_on_pixabay($keyword=null, $page = 1 , $maxLimit = 10){
		
        $pixabay_auth_key = PIXABAY_KEY; 

        if(empty($pixabay_auth_key)){
            return array('status'=>'error','msg'=>'Please update your pixabay Auth key in settings.');die;
        }

        $output_data = array();
        $url = "https://pixabay.com/api/?key=".$pixabay_auth_key."&q=".urlencode($keyword)."&image_type=photo&pretty=true&per_page=".$maxLimit."&page=".$page;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response,true);
		
		
		
        $verify = 'TRUE';
        if(strpos($response,"[ERROR 400]") !== false){
            $verify = 'FALSE';
            return array('status'=>'error','msg'=>"Invalid or missing API key\nPlease check your api key and try again.");die;
        }
        
        if(isset($data['hits']) && !empty($data['hits'])){
            foreach ($data['hits'] as $key => $value) {
                if($value['type'] == 'photo'){                
                    $output_data[$key]['img'] = $value['webformatURL'];
                    $output_data[$key]['tags'] = $value['tags'];
                }
            }
        }
        return $output_data;
    }

    private function search_keyword_on_unsplash($keyword=null, $page = 1 , $maxLimit = 10){
		
        $pixabay_auth_key = UNSPLASH_KEY; 

        if(empty($pixabay_auth_key)){
            return array('status'=>'error','msg'=>'Please update your pixabay Auth key in settings.');die;
        }

        $output_data = array();
        $url = "https://api.unsplash.com/search/photos?client_id=".$pixabay_auth_key."&query=".urlencode($keyword)."&per_page=".$maxLimit."&page=".$page;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response,true);
		
		
		
        $verify = 'TRUE';
        if(strpos($response,"[ERROR 400]") !== false){
            $verify = 'FALSE';
            return array('status'=>'error','msg'=>"Invalid or missing API key\nPlease check your api key and try again.");die;
        }
        // echo '<pre>';
        // print_r($data);
        // die;
        if(isset($data['results']) && !empty($data['results'])){
            foreach ($data['results'] as $key => $value) {
                            
                    $output_data[$key]['img'] = $value['urls']['full'];
                    $output_data[$key]['tags'] = $value['description'];
    
            }
        }
        return $output_data;
    }

    public function uploadImageUrl(){
        $this->checkValidAJAX();

		$resData = array();
		if(isset($_POST['imageUrl'])){
			$path=dirname(__FILE__);
			$abs_path=explode('application',$path);
			$pathToImages = $abs_path[0].'/repo/images/';
			
			
			$imageUrl 	= $this->input->post('imageUrl');
			$BaseUploadPath = base_url().'uploads/pixaimages/';
			$userId = $this->common->uid;
			$name 		= uniqid() .'_'.$userId.'.jpg';
			$pathToImages 	= $abs_path[0] .'uploads/pixaimages/'.$name;
			if(file_put_contents($pathToImages, file_get_contents($imageUrl))){
				$image_data = array(
				'uid' => $userId,
				'url' => $name,
				'title' => $name,
				'source' => 'pixabay',
				);		
			    $lastId	 = $this->Qdb->insert_data('imagelibrary' , $image_data);
			  	$resData = array('status' => 1 , 'data' => $BaseUploadPath.$name , 'title'=>$name,'id' =>$lastId);
			}
		}
		$this->common->showResponce($resData);
	}	

    function upload_image(){
        $this->checkValidAJAX();
        
	   
		$resData = array();
		$uid = $this->common->uid;
		$BaseUploadPath = $UploadPath = base_url().'uploads/medialibrary/';
		$uploadPath = '/uploads/medialibrary/';
		if(isset($_FILES['upload_file'])){
			$uploaded_image = $this->common->upload_image($uploadPath , 'upload_file' , '_'.$uid);
			if($uploaded_image != ''){
				$image_data = array(
								'uid' => $uid,
								'url' => $uploaded_image,
								'title' => $_FILES['upload_file']['name'],
								'source' => 'custom',
								);
								
			$lastId	 = $this->Qdb->insert_data('imagelibrary' , $image_data);
				$resData = array('status' => 1 , 'data' => $BaseUploadPath.$uploaded_image , 'title'=>$_FILES['upload_file']['name'] , 'id' =>$lastId);
			}
		
		}
		
		//$resData = array('status' => 1 , 'data' => 'https://mighteee.app/uploads/medialibrary/4ef4c9a2de_2.png' , 'title'=>'favicon.png' , 'id' =>8);
		$this->common->showResponce($resData);
	}
	
    public function custom_css_js(){

	   $css = json_encode($_POST['css']);
	   $js  = json_encode($_POST['js']);

	   $updateData = array('custom_css'=>$css,'custom_js'=>$js);
	   
	   $where = array('id'=>$this->input->post('campId'),'user_id'=>$this->user_id);
	   $this->Qdb->update_data('user_campaigns', $updateData, $where);
	   
    }

    /* Editor Ajax Ends  */

    /* Zip for templates Ajax starts */
    public function addUpdateTemplateZip(){
        checkIsAdmin();
        $this->checkValidAJAX();
        
        if( !empty($_FILES['ppa_template_thumbnail']['name']) ){
			
			$old_data = $this->Qdb->select_data( 'id,thumbnail_path' , 'dfy_templates', array('id' => $this->input->post('ppd_uniq_id')));
            
			$config['upload_path']          = 'uploads/template_zips/template_thumnails/';
			$config['allowed_types']        = 'jpg|png';
			$config['max_size']             = 2500;
			$config['max_width']            = 260;
			$config['max_height']           = 180;
			$config['file_name'] 			= time().'_thumbnail_'.$this->input->post('ppd_uniq_id');
	
			$this->load->library('upload', $config);
            $this->upload->initialize($config);
	
			if ( !$this->upload->do_upload('ppa_template_thumbnail')){
				$this->browserResponse['message'] = strip_tags( $this->upload->display_errors() );
				echo json_encode($this->browserResponse);die;
			}
			else{
				$upload_data = $this->upload->data();
				$thumnail_path = $config['upload_path'] . $upload_data['file_name'];
				// $uArray      = array('thumbnail_path' => $thumnail_path);

				if( !empty($old_data) )
					if( $old_data[0]['thumbnail_path'] != '' && file_exists( getcwd().'/'.$old_data[0]['thumbnail_path'] ) )
						unlink( getcwd().'/'.$old_data[0]['thumbnail_path']);

			}
		}

        if( !empty($_FILES['ppd_template_zip']['name']) ){
           
            $config1['upload_path']          = 'uploads/template_zips/';
            $config1['allowed_types']        = 'zip';
            $config1['max_size']             = 0;
            $config1['encrypt_name'] = TRUE;
    
            $this->load->library('upload', $config1);
            $this->upload->initialize($config1);
    
            if ( !$this->upload->do_upload('ppd_template_zip')){
                $this->browserResponse['message'] = strip_tags( $this->upload->display_errors() );
                echo json_encode($this->browserResponse);die;
            }
            else{
                $zip_upload_data = $this->upload->data();
                $zip_path = $config1['upload_path'] . $zip_upload_data['file_name'];
                $this_folder_name = time().'_'.$_POST['ppd_template_name'];
                $extract_path = 'uploads/template_zips/extracted_zip/'.$this_folder_name.'/';
                $zip_folder = $this->zipExtract( getcwd().'/'.$zip_path, $extract_path);
                unlink( $zip_path );
                $uArray      = array('zip_path' => $extract_path.$zip_folder, 'zip_name' => $zip_upload_data['orig_name']);
                
            }
        }


        if( empty( $_POST['ppd_uniq_id'] ) ){
            if( isset($uArray) ){
                $uArray['template_name'] = $_POST['ppd_template_name']; 
                $uArray['user_id'] = $this->session->userdata('user_id'); 
                $uArray['date_created'] = date('Y-m-d H:i:s'); 
                $uArray['date_updated'] = date('Y-m-d H:i:s');

                $uArray['is_downloadable'] = 0; 
                if( isset( $_POST['ppd_template_downloadable'] ) )
                    $uArray['is_downloadable'] = 1; 

                if( isset($thumnail_path) )
				    $uArray['thumbnail_path'] = $thumnail_path;

				$res = $this->Qdb->insert_data('dfy_templates', $uArray);
                $this->browserResponse['message'] = 'Enviado com sucesso';
                $this->browserResponse['status']  = 'success';
                $this->browserResponse['redirect']  = 'reload';
            }else{
                $this->browserResponse['message'] = 'zip é obrigatório';
                echo json_encode($this->browserResponse);die;
            }

        }else{
            if( isset($uArray) ){
                $previous_zip = $this->Qdb->select_data( 'id,zip_path,template_name' , 'dfy_templates', array('id' => $this->input->post('ppd_uniq_id')));
                // if update than transfer updated folder data to existing folder data
                if(!empty($previous_zip)){
                    $path = getcwd().'/'.$previous_zip[0]['zip_path'];

                    if( $path != '' && $path != getcwd().'/' && $previous_zip[0]['zip_path'] != '') {
                        $this->deleteDirectory( $path, false );
                        if( isset($uArray['zip_path'])){

                            rcopy(getcwd().'/'.$uArray['zip_path'], $path);
                            if( isset( $extract_path ) && !empty( $extract_path ) )
                                $this->deleteDirectory(getcwd().'/'.$extract_path );
                            $uArray['zip_path'] = $previous_zip[0]['zip_path'];
                        }
                    }
                }
                
            }

            if( isset($thumnail_path) )
				$uArray['thumbnail_path'] = $thumnail_path;

            $uArray['template_name'] = $_POST['ppd_template_name']; 
            $uArray['date_updated'] = date('Y-m-d H:i:s');
            $uArray['is_downloadable'] = 0; 
            if( isset( $_POST['ppd_template_downloadable'] ) )
                $uArray['is_downloadable'] = 1; 

            $res = $this->Qdb->update_data('dfy_templates', $uArray, array('id' => $this->input->post('ppd_uniq_id')));
            $this->browserResponse['message'] = 'Atualizado com sucesso';
            $this->browserResponse['status']  = 'success';
            $this->browserResponse['redirect']  = 'reload';

        }
        echo json_encode($this->browserResponse);
    }

    public function getTemplateZipById(){
        checkIsAdmin();
        $this->checkValidAJAX();

        if(!empty($this->input->post('template_id'))){
			$tempzip_id = $this->input->post('template_id');
			$tempzip_info = $this->Qdb->select_data( '*' , 'dfy_templates', array('id' => $tempzip_id));

			if( !empty($tempzip_info) ){

				$output['ppd_template_name'] = $tempzip_info[0]['template_name'];
				$output['ppd_uniq_id'] = $tempzip_info[0]['id'];
				$output['ppd_template_downloadable'] = $tempzip_info[0]['is_downloadable'];

				$this->browserResponse['status'] = 'success';
				$this->browserResponse['message'] = '';
				$this->browserResponse['formData'] = json_encode($output) ;
				$this->browserResponse['form'] = "#createupdatetemp_form" ;
				$this->browserResponse['openModal'] = "#pxg_create_update_template_model" ;
			}
		}
        echo json_encode($this->browserResponse);
    }

    private function zipExtract($zip_path, $extract_path){
        $zip = new ZipArchive;

        if ($zip->open($zip_path) === TRUE) {
            // $extractedFolderName = basename($zip->getNameIndex(0));
            
            $path_info = pathinfo( $zip->getNameIndex(0) );
            if( $path_info['dirname'] == '.' )
                $extractedFolderName = $path_info['basename'];
            else
                $extractedFolderName = $path_info['dirname'];
            
            if($_SESSION['user_id'] == 5){
                // print_r($extractedFolderName);
                // print_r($path_info);exit;
            }

            if( $extractedFolderName == '' ){
                echo json_encode($this->browserResponse);exit;
            }
            $zip->extractTo($extract_path);
            $zip->close();


            return $extractedFolderName;
        }else{
            $this->browserResponse['message']  = 'Arquivo zip inválido';
            echo json_encode($this->browserResponse);exit;
        }

    }

    public function deleteTemplate(){
        checkIsAdmin();
        $this->checkValidAJAX();

        if( !empty( $this->input->post('uniq_id') ) ){
			$template_id = $this->input->post('uniq_id');
            $this_zip = $this->Qdb->select_data( 'id,zip_path,template_name' , 'dfy_templates', array('id' => $template_id));
            
            if(!empty($this_zip)){
                $path = getcwd().'/'.$this_zip[0]['zip_path'];
                $newPath = $path;
                $lastSlashPosition = strrpos($path, '/');
                if ($lastSlashPosition !== false) {
                    $newPath = substr($path, 0, $lastSlashPosition);
                } 
                $path = $newPath;
                if( $path != '' && $path != getcwd().'/' && $this_zip[0]['zip_path'] != '' && strpos($path, $this_zip[0]['template_name']) )
                    $this->deleteDirectory( $path );
            }

            $condition = array('id' => $template_id, 'user_id' => $this->session->userdata('user_id'));
            if( $this->session->userdata('u_type') == 1 )
                $condition = array('id' => $template_id);

            $res = $this->Qdb->delete_data('dfy_templates', $condition);

			$this->browserResponse['status'] = 'success';
			$this->browserResponse['message'] = 'Modelo excluído com sucesso';
			$this->browserResponse['redirect'] = 'reload';
		}
		echo json_encode($this->browserResponse);
    }
    // use this function carefully
    private function deleteDirectory($path) {
        if (is_dir($path)) {
            $files = scandir($path);
    
            foreach ($files as $file) {
                if ($file != '.' && $file != '..') {
                    $filePath = $path . '/' . $file;
    
                    if (is_dir($filePath)) {
                        // Recursively delete subfolder and its contents
                        $this->deleteDirectory($filePath);
                    } else {
                        // Delete file
                        unlink($filePath);
                    }
                }
            }
    
            // Delete the folder itself
            rmdir($path);
        }
    }
    /* Zip for templates Ajax ends */
    
    /* AR starts */
    public function autoresponder($responder=''){
        $this->checkValidAJAX();
        // echo"<pre>";print_r($list);die;
        $memberId = $this->session->userdata('user_id');
        
        if(empty($responder)){
            $this->browserResponse['message'] = 'Ocorrer um erro pode ser algo errado.';
            echo json_encode($this->browserResponse);die();
        }
        require_once 'subscriber/subscriber.php';
        $objlist = new subscriber();
        $list = $objlist->switch_responder($_POST['apikey'], 'getList', $responder);
        
        if(!isset($list['error'])){ 
            $where = [ 'user_id' => $memberId, 'mkey' => 'autoresponder' ];
            $res = $this->Qdb->select_data('*' , 'autoresponder' , $where);

            if(empty($res)){
                $data = array();
                if($responder != 'Aweber'){
                    $data[$responder] = $_POST['apikey'];
                }else{
                    $data[$responder] = $list['data'];
                }

                $array = [
                    'user_id' => $memberId,
                    'mkey' => 'autoresponder',
                    'value' =>  json_encode($data) 
                ];

                $this->Qdb->insert_data('autoresponder', $array);
            }else{
                $data = (array) json_decode( $res[0]['value'] );
                if($responder != 'Aweber'){
                    $data[$responder] = $_POST['apikey'];
                }else{
                    $data[$responder] = $list['data'];
                }
                
                $array = array(
                    'user_id' => $memberId,
                    'mkey' => 'autoresponder',
                    'value' =>  json_encode($data) 
                );

                $this->Qdb->update_data('autoresponder',$array,$where);
            }

			$this->browserResponse['status'] = 'success';
            $this->browserResponse['message'] = 'Auto responder conectado com sucesso!';
			$this->browserResponse['redirect'] = 'reload';
        }else{
            $this->browserResponse['message'] = 'Ocorreu um erro ao obter sua lista.';
        }
        echo json_encode($this->browserResponse);
    }

    public function disconnect_autoresponder($responder=''){
        $memberId = $this->session->userdata('user_id');
        if(empty($responder)){
            $this->browserResponse['message'] = 'Ocorrer um erro pode ser algo errado.';
            echo json_encode($this->browserResponse);die();
        }        
        $where = [ 'user_id' => $memberId, 'mkey' => 'autoresponder' ];
        $res = $this->Qdb->select_data('*' , 'autoresponder' , $where);
        
        $data = (array) json_decode( $res[0]['value'] );
        
        unset( $data[$responder] );
        $array = [
            'user_id' => $memberId,
            'mkey' => 'autoresponder',
            'value' =>  json_encode($data) 
        ];

        $update = $this->Qdb->update_data('autoresponder',$array,$where);
        
        if($update){
            $this->browserResponse['status'] = 'success';
            $this->browserResponse['message'] = 'Auto responder desconectado com sucesso!';
            $this->browserResponse['redirect'] = 'reload';
        }
        echo json_encode($this->browserResponse);
    } 

    public function getListOfResponder($responder=''){  
        $this->checkValidAJAX();
        $this->browserResponse['message'] = $this->browserResponse['data'] = '';
        if( $responder != '' ){
            $data = $this->common->getListofResponder($responder);
            echo $data;die;
        } 
        echo json_encode($this->browserResponse);
    }

    public function email_settings(){
        $this->checkValidAJAX();
	    $data = array('auto_email'=>
					array(
							'confirmation' => ($_POST['email_confirmation'] != '')?'YES':'NO',
							'welcome' => ($_POST['welcome_email'] != '')?'YES':'NO',
					),
					'autoresponder' => array( 'visible' => ($_POST['autoresponder'] != '')?'YES':'NO',
							'name' => $_POST['autoresponder_name'],
							'list' => $_POST['autoresponder_list_id'],
					)
				);
				   
	   $updateData = array('email_setting'=>json_encode($data));
	   $where = array( 'id'=>$_POST['campId'],'user_id'=>$this->user_id );
	   $this->Qdb->update_data('user_campaigns', $updateData, $where);
	   echo "Email Setting Updated";
   }
   /* AR Ends */

    public function paymentIntegration($type= ''){
        $this->checkValidAJAX();
        checkIsAdmin();
        
        if(isset($type)){
            // $title = '';
            if($type == '1' ){
                // $title = $_POST['paypal_title'];
                $values = [
                    'paypalid' =>  $_POST['paypalid'],
                    'client_id' =>  $_POST['client_id'],
                    'client_secret' =>  $_POST['client_secret']
                ];                    
            }
            if($type == '2' ){
                // $title = $_POST['razorpay_title'];
                $values = [
                    'razorpaykey' => $_POST['razorpaykey'],                            
                    'razorpay_secretkey' => $_POST['razorpay_secretkey'],                            
                ];
            }
            if($type == '3' ){
                // $title = $_POST['stripe_title'];
                $values = [
                    'stripe_publishKey' => $_POST['stripe_publishKey'],                            
                    'stripe_secretkey' => $_POST['stripe_secretkey'],                            
                    'stripe_currency' => $_POST['stripe_currency'],                            
                ];
            }

            $memberId = $this->session->userdata('user_id');
            $date = date('Y-m-d H:i:s');

            if(isset($_POST['id']) && !empty($_POST['id'])){
                $where = ['id' => $_POST['id']];
                $data = [
                    'user_id' => $this->session->userdata('user_id'),
                    // 'title' => $title,
                    'key' => $type,
                    'value' => json_encode( $values ),
                    'isUpdated' => $date,
                    'status' => 1                    
                ];

                $this->Qdb->update_data('payment_integration', $data, $where);
                if($updateData){                            
                    $this->respStatus = 1;
                    $this->respMessage = 'Atualização de conexão de integração com sucesso.';
                    $this->respData = [
                        'url' => base_url('user/settings')
                    ];
                }

            }else{
                $data = [
                    'user_id' => $this->session->userdata('user_id'),
                    // 'title' => $title,
                    'key' => $type,
                    'value' => json_encode( $values ),
                    'isCreated' => $date,
                    'isUpdated' => $date,
                    'status' => 1                     
                ];

                $addPayInte = $this->Qdb->insert_data('payment_integration', $data);

                if($addPayInte){
                    $this->browserResponse['status'] = 'success';
                    $this->browserResponse['message'] = 'Integração conectada com sucesso!';
                    $this->browserResponse['redirect'] = 'reload';
                }
            }
            echo json_encode($this->browserResponse);
        }
    }

    public function disconnect_paymentGateway($type=''){
        checkIsAdmin();
        $memberId = $this->session->userdata('user_id');
        if(empty($type)){
            $this->browserResponse['message'] = 'Ocorrer um erro pode ser algo errado.';
            echo json_encode($this->browserResponse);die();
        }        
        $where = [ 'user_id' => $memberId, 'key' => $type ];
        $res = $this->Qdb->select_data('*' , 'payment_integration' , $where);

        if($res){
            $update = $this->Qdb->delete_data('payment_integration', $where);
            
            if($update){
                $this->browserResponse['status'] = 'success';
                $this->browserResponse['message'] = 'Gateway de pagamento desconectado com sucesso!';
                $this->browserResponse['redirect'] = 'reload';
            }
        }
        echo json_encode($this->browserResponse);
    } 

    public function downloadMySiteTemplate(){
        $this->checkValidAJAX();
        
        $plans_data = checkPlanDetails();
        if( $plans_data['status'] == 0 ){
            echo json_encode( ['status' => 'error', 'message' => $plans_data['message'], 'redirect' => ''] );
            die;
        }
        
        $site_id = $this->input->post('site_id');
        $template_data = $this->Qdb->select_data( 'dfy_templates.zip_path, dfy_templates.id, user_campaigns.template_name as camp_name, user_campaigns.template_html' , 'user_campaigns', array('user_campaigns.id' => $site_id, 'user_campaigns.user_id' => $this->user_id), '', array('dfy_templates', 'dfy_templates.id = user_campaigns.temp_id'));
        if( !empty($template_data) ){

            checkPlanTemplates( $template_data[0]['id'] );

            $folder_structure = $this->getDirContents( getcwd().'/'.$template_data[0]['zip_path'], 'folder');

            if( !file_exists( getcwd().$template_data[0]['template_html'] ) ){
                
                $upload_path = createTemplateDirectory();
                $p           = $upload_path.time().'.html';
                file_put_contents( getcwd().$p, $template_data[0]['template_html'] );
                $res         = $this->Qdb->update_data('user_campaigns', array( 'template_html' => $p ), array( 'user_id' => $this->user_id, 'id' => $site_id ));
                $html_       = $template_data[0]['template_html'];

            }else{
                $html_ = file_get_contents(  getcwd().$template_data[0]['template_html'] );
            }

            $keyword1 = base_url('uploads/medialibrary');
            $keyword2 = base_url('uploads/pixaimages');

            preg_match_all('/<img[^>]+src=["\']([^"\']+)["\'][^>]*>/i', $html_, $matches);

            $matching_src = array();

            foreach ($matches[1] as $src) {
                if (strpos($src, $keyword1) !== false) {
                    $matching_src[] = $src;
                }
                if (strpos($src, $keyword2) !== false) {
                    $matching_src[] = $src;
                }
            }
            

            $this->browserResponse['meta']['site_html'] = $html_;
            $this->browserResponse['meta']['upload_images'] = $matching_src;
            $this->browserResponse['meta']['site_name'] = $template_data[0]['camp_name'];
            $this->browserResponse['meta']['replace_path'] = base_url( $template_data[0]['zip_path'].'/' );
            $this->browserResponse['status'] = 'success';
            $this->browserResponse['message'] = 'Gerando zip...';
            $this->browserResponse['meta']['folder_structure'] = $folder_structure;
            $this->browserResponse['meta']['folder_structure'] = $folder_structure;
        }
        echo json_encode($this->browserResponse);
    }
    private function getDirContents($dir, $name, $results = array()) {
        $files = scandir($dir);
        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results['files'][] = base_url( str_replace("\\",'/', str_replace(getcwd(),'',$path) ) );
                // $results['files'][] = 'http://localhost/ppages/pixelpages.v2/uploads/template_zips/template_thumnails/1693809378_thumbnail_.jpg';
            } else if ($value != "." && $value != "..") {
                $results[basename($path)] = $this->getDirContents($path, basename( $path ));
                // $results['folder_name'] = basename($path);
            }
        }
        return $results;
    }

    /* Site response Ajax starts */
    public function deleteSiteResponse(){
        $this->checkValidAJAX();
        $res_id  = $this->input->post('uniq_id');
        $site_id = $this->input->post('meta_data');

        $res = $this->Qdb->delete_data('ar_form_data', array('id' => $res_id, 'campaign_id' => $site_id, 'user_id' => $this->user_id ));
        $res = $this->Qdb->delete_data('site_analytics', array('site_id' => $res_id, 'user_id' => $this->user_id ));
        
        $this->browserResponse['status']   = 'success';
		$this->browserResponse['message']  = 'Registro excluído com sucesso';
		$this->browserResponse['redirect'] = 'reload';
        echo json_encode($this->browserResponse);

    }

    public function addLeadsToAR(){
        $this->checkValidAJAX();

        $ar_name = $this->input->post('autoresponder_name');
        $ar_list = $this->input->post('autoresponder_list');
        $rec_ids = explode( ',', base64_decode($this->input->post('record_ids')));

        $leads_list = $this->Qdb->access_database('ar_form_data', 'wherein', $rec_ids, array('user_id' => $this->user_id), "id");

        $_POST['listid'] = $ar_list;
        foreach ($leads_list as $key => $value) {
            $_POST['email']  = $value['user_email'];
            $_POST['name']  = $ar_name;
            $res = $this->common->subscribeResponder($ar_name, $this->user_id);
        }
        $res = json_decode($res, true);
        if( $res['status'] == 'success' ) 
            $res['message']  = 'Registro '.( (count($rec_ids) > 1) ? 's':'' ).' adicionado à resposta automática';
        $res['redirect'] = '';
        echo json_encode($res);

    }

    /* Site response Ajax ends   */

    /* Plans page Ajax starts   */
    public function loadTemplatesOfPlan(){
        $this->checkValidAJAX();
        $offset 		= $this->input->post('offset');
        $limit 			= $this->input->post('limit');
        $plan_id 		= $this->input->post('plan_id');
		$p_templates 	= $this->Qdb->select_data( 'id,p_templates' , 'plans_list', array('id' => $plan_id));
		$selected_temps = !empty( $p_templates[0]['p_templates'] )? json_decode($p_templates[0]['p_templates'], true): [];

        $where_in       = 'id IN ('.implode(',', (!empty($selected_temps)? $selected_temps : [0]) ).')';
        $templates_list = $this->Qdb->select_data( '*' , 'dfy_templates', $where_in, array($limit, $offset), '', array('id','desc'));
        
        $html  = '';
        foreach ($templates_list as $key => $value) {
			$html .= $this->common->plansTemplatesShowElement($value);
            $offset ++;
        }
        
       $this->browserResponse['status']  = 'success';
       $this->browserResponse['count']  = count( $templates_list );
       $this->browserResponse['html']    = $html;
       $this->browserResponse['message'] = '';
       $this->browserResponse['offset']  = $offset;
       echo json_encode( $this->browserResponse );die;
    }
    /* Plans page Ajax ends     */

    
}
