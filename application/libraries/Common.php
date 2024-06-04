<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common{ 
	public $uid = '';
	
	function __Construct(){
		$this->CI = get_instance(); 
		if(isset($_SESSION['user_id']) )
			$this->uid  = $_SESSION['user_id'];
	}
	
	
	function showResponce($data=''){
		if(empty($data)){
			$data = array('status' => 0 , 'msg' => 'Something went wrong');
		}
		echo json_encode($data , JSON_UNESCAPED_SLASHES);	
	}

	function getStripeData(){
		$this->CI = get_instance();
		$a = $this->CI->Qdb->select_data('value', 'payment_integration', array('key' => 3) );
		if( isset( $a[0]['value'] ) )
			return json_decode($a[0]['value'], true);
		return false;
	}
	
	function deleteDirectory($path) {
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
	
	
	function upload_image($upPath , $name , $postFix = NULL , $doRename=true){
		$this->CI = get_instance();
		$basePath = explode('application',dirname(__FILE__))[0];
		$uploadPath = $basePath.$upPath; 
		$config['upload_path'] = $uploadPath;
		$config['allowed_types'] = '*';
		$this->CI->load->library('upload', $config);
		if ($this->CI->upload->do_upload($name)){
			$uploaddata = $this->CI->upload->data();
			$imgName = $uploaddata['raw_name'];
			$imgExt = $uploaddata['file_ext'];
			$randomstr = substr(md5(microtime()), 0, 10);
			$uploadedImage = $randomstr.$postFix.$imgExt;
			if($doRename){
			  rename($uploadPath.$imgName.$imgExt, $uploadPath.$uploadedImage);
			  return $uploadedImage;
			}else{
				return $imgName.$imgExt;
			}
			
		}else{ 
			return '';
		}
	}
	
	
	function checkValidAJAX(){
		$ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '' ;
		if( strpos($ref,base_url()) === false )
			die('Unauthorize Access!!');
		if( !isset($_POST) )
			die('Unauthorize Access!!');
		
		$postData = array();
		foreach( $_POST as $key=>$value ){
			$temp = $this->CI->input->post($key,TRUE);
			$postData[$key] = $temp;
        }
        $outputResponse = array('type'=>'error','msg'=>'Please, try again.','action'=>'');
		return json_encode($postData);
    }
	
	function getListofResponder($responder)
	{
		$message = $data = $redirect = '';
        if( $responder != '' ){
            $userID = $this->uid;
            $where = array( 'mkey' => 'autoresponder', 'user_id' => $userID );
            $result = $this->CI->Qdb->select_data('*','autoresponder', $where);
            $data = array();
            if(!empty($result)){
                $data = json_decode( $result[0]['value'], true );
            }
    
            $key = searchKey( $responder, $responder, $data );
    
            $api = $data[$key];
    
            require_once APPPATH.'controllers/subscriber/subscriber.php';	
            $subscriber = new subscriber();
            $list = $subscriber->switch_responder($api, 'getList', $responder);
            
            if(!empty($list['list'])){
                $listarray = array();
                foreach($list['list'] as $k=>$v){
                    $listarray[] = array( 'list_name' => $v, 'list_value' => $k );		
                }
                $status  = 'success';
                $message = '';
                $data    = $listarray;
            }else{
                
                if(isset($list['message']) && $list['message'] == 'Plan not available'){
                    $status  = 'error';
                    $message = 'Your sendlane billing plan may be end, look your account';
                }else{
                    $status  = 'error';
                    $message = 'There is no list in this autoresponder.';
                }
            }
        } 
        return json_encode( array( 'status' => $status, 'message' => $message, 'data' => $data, 'redirect' => $redirect ) );
	}
	
	function subscribeResponder($responder, $userID)
	{
		$message = $data = $redirect = '';
        if( $responder != '' ){
            // $userID = $this->uid;
            $where = array( 'mkey' => 'autoresponder', 'user_id' => $userID );
            $result = $this->CI->Qdb->select_data('*','autoresponder', $where);
            $data = array();
            if(!empty($result)){
                $data = json_decode( $result[0]['value'], true );
            }
    
            $key = searchKey( $responder, $responder, $data );
    
            $api = $data[$key];
    
            require_once APPPATH.'controllers/subscriber/subscriber.php';	
            $subscriber = new subscriber();
            $resp = $subscriber->switch_responder($api, 'subsCribe', $responder);

            if(isset($resp['success'])){
                $status  = 'success';
                if( $this->CI->session->userdata('is_logged_in') )
                $message = "Email added to list";
                else
                $message = "We've received your message! We'll get back to you soon.";
            }else{
                $status  = 'error';
                $message = isset($resp['error'])? $resp['error'] : 'Something went wrong! Please try again.';
            }
        } 
        return json_encode( array( 'status' => $status, 'message' => $message, 'data' => $data, 'redirect' => $redirect, 'resp' => $resp ) );
	}

	function dfyTempElementUser($value){
		$html = '<div class="pxg_template_content">
					<div class="pxg_template_wrapper">
						<div class="pxg_temp_preview_wrapper">
							<a href="'.base_url('dfy-template/preview/'.$value['id']).'" target="_blank" class="pxg_btn">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488.85 488.85" xmlns:v="https://vecta.io/nano"><path d="M244.425 98.725c-93.4 0-178.1 51.1-240.6 134.1-5.1 6.8-5.1 16.3 0 23.1 62.5 83.1 147.2 134.2 240.6 134.2s178.1-51.1 240.6-134.1c5.1-6.8 5.1-16.3 0-23.1-62.5-83.1-147.2-134.2-240.6-134.2zm6.7 248.3c-62 3.9-113.2-47.2-109.3-109.3 3.2-51.2 44.7-92.7 95.9-95.9 62-3.9 113.2 47.2 109.3 109.3-3.3 51.1-44.8 92.6-95.9 95.9zm-3.1-47.4c-33.4 2.1-61-25.4-58.8-58.8 1.7-27.6 24.1-49.9 51.7-51.7 33.4-2.1 61 25.4 58.8 58.8-1.8 27.7-24.2 50-51.7 51.7z"></path></svg>
							</a>
						</div>
						<img class="pxg_template_thumbnail" src="'. (( $value['thumbnail_path'] != '' )? base_url( $value['thumbnail_path'] ): base_url('assets/images/image-preview.jpg')) .'" alt="'. html_escape($this->CI->lang->line('ltr_user_templates_alt_2')) .'">
						'. ( in_array( $value['id'], $_SESSION['plan_templates'] ) ? 
							'<div class="premium-temp-tagline">
								<span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xmlns:v="https://vecta.io/nano"><path d="M2.8 5.2 7 8l4.186-5.86a1 1 0 0 1 1.628 0L17 8l4.2-2.8a1 1 0 0 1 1.547.95l-1.643 13.967a1 1 0 0 1-.993.883H3.889a1 1 0 0 1-.993-.883L1.253 6.149A1 1 0 0 1 2.8 5.2zM12 15a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path></svg></span>
								ACCESS
							</div>' 
							: '' ) 
						.
						'<a href="javascript:void(0);" class="pxg_setting_icn">
							<img src="'. base_url() .'assets/images/svg/dots.svg" alt="'. html_escape($this->CI->lang->line('ltr_user_templates_alt_3')).'">
						</a>
						<div class="pxg_setting_dropdown">
							<ul>
								<li class="active">
									<a href="javascript:;" class="ppd_add_to_templates" data-dfy-id="'. $value['id'] .'" >
										<span class="pxg_dropdown_ic">
											<svg xmlns="http://www.w3.org/2000/svg" width="13" height="15" fill="#7d809d" xmlns:v="https://vecta.io/nano"><path d="M2.964 3.212h-1a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1v-1h-7v-9zm6-3v4h4l-4-4zm-1 5v-5h-3a1 1 0 0 0-1 1v10h8a1 1 0 0 0 1-1v-5h-5z"/></svg>
										</span>
										'. html_escape($this->CI->lang->line('ltr_user_templates_txt_1')).'
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="pxg_template_title">
						<h6>'. $value['template_name'] .'</h6>
						<!-- <p>'. html_escape($this->CI->lang->line('ltr_user_templates_txt_2')) .' - '.date('M d, Y', strtotime($value['date_created'])) .'</p> -->
					</div>
				</div>';
		return $html;
	}

	function dfyTempElementAdmin($value){
		$html = '<div class="pxg_template_content">
					<div class="pxg_template_wrapper">
						<div class="pxg_temp_preview_wrapper">
							<a href="'.base_url('admin/preview/'.$value['id']).'" target="_blank" class="pxg_btn">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488.85 488.85" xmlns:v="https://vecta.io/nano"><path d="M244.425 98.725c-93.4 0-178.1 51.1-240.6 134.1-5.1 6.8-5.1 16.3 0 23.1 62.5 83.1 147.2 134.2 240.6 134.2s178.1-51.1 240.6-134.1c5.1-6.8 5.1-16.3 0-23.1-62.5-83.1-147.2-134.2-240.6-134.2zm6.7 248.3c-62 3.9-113.2-47.2-109.3-109.3 3.2-51.2 44.7-92.7 95.9-95.9 62-3.9 113.2 47.2 109.3 109.3-3.3 51.1-44.8 92.6-95.9 95.9zm-3.1-47.4c-33.4 2.1-61-25.4-58.8-58.8 1.7-27.6 24.1-49.9 51.7-51.7 33.4-2.1 61 25.4 58.8 58.8-1.8 27.7-24.2 50-51.7 51.7z"></path></svg>
							</a>
						</div>
						<img class="pxg_template_thumbnail" src="'. (( $value['thumbnail_path'] != '' )? base_url( $value['thumbnail_path'] ): base_url('assets/images/image-preview.jpg')) .'" alt="'. html_escape($this->CI->lang->line('ltr_admin_templates_alt_2')) .'">
						<a href="javascript:void(0);" class="pxg_setting_icn">
							<img src="'. base_url() .'assets/images/svg/dots.svg" alt="'. html_escape($this->CI->lang->line('ltr_admin_templates_alt_3')) .'">
						</a>
						<div class="pxg_setting_dropdown">
							<ul>
								<li class="active">
									<a href="'. base_url('admin/editor/'.$value['id']) .'" >
										<span class="pxg_dropdown_ic">
											<svg xmlns="http://www.w3.org/2000/svg" width="12" height="15" fill="none" xmlns:v="https://vecta.io/nano"><path d="M10.879 12.863H1.051a.7.7 0 0 0-.702.702.7.7 0 0 0 .702.702h9.828a.7.7 0 0 0 .702-.702.7.7 0 0 0-.702-.702zm-9.828-1.404h.063l2.927-.267c.321-.032.621-.173.849-.4l6.318-6.318a1.35 1.35 0 0 0-.049-1.903L9.236.647c-.251-.236-.58-.371-.924-.38s-.68.109-.943.331L1.051 6.916c-.227.229-.368.529-.4.849l-.302 2.927a.7.7 0 0 0 .204.562c.066.065.143.117.229.152s.177.053.27.052zm7.21-9.828l1.917 1.917-1.404 1.369-1.881-1.881L8.261 1.63z" fill="#7d809d"/></svg>
										</span>
										'. html_escape($this->CI->lang->line('ltr_admin_templates_txt_3')) .'
									</a>
								</li>
								<li class="active">
									<a href="javascript:;" class="ppd_edit_template" data-uniq_id="'. $value['id'] .'" > 
										<span class="pxg_dropdown_ic">
										<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="#7D809D" viewBox="0 0 512 512" xmlns:v="https://vecta.io/nano"><path d="M408.404 292.029l-20.019-11.558C390.157 271.85 391 263.885 391 256s-.843-15.85-2.614-24.472l20.019-11.558a15.005 15.005 0 0 0 5.49-20.49l-30-51.961a15 15 0 0 0-20.49-5.49l-19.837 11.453c-12.434-10.548-26.865-18.791-42.567-24.313V106c0-8.284-6.716-15-15-15h-60c-8.284 0-15 6.716-15 15v23.169c-15.702 5.522-30.134 13.766-42.567 24.313l-19.837-11.453a15 15 0 0 0-20.49 5.49l-30 51.961a15.002 15.002 0 0 0 5.49 20.49l20.019 11.558C121.843 240.15 121 248.115 121 256s.843 15.85 2.614 24.472l-20.019 11.558a15.005 15.005 0 0 0-5.49 20.49l30 51.961a15 15 0 0 0 20.49 5.49l19.837-11.453c12.434 10.548 26.865 18.791 42.567 24.313V406c0 8.284 6.716 15 15 15h60c8.284 0 15-6.716 15-15v-23.169c15.702-5.522 30.134-13.766 42.567-24.313l19.837 11.453c7.174 4.143 16.347 1.684 20.49-5.49l30-51.961a14.998 14.998 0 0 0-5.489-20.491zM256 301c-24.813 0-45-20.187-45-45s20.187-45 45-45 45 20.187 45 45-20.187 45-45 45zm205.149-198.235l-21.213-63.64c-2.62-7.859-11.115-12.108-18.974-9.487s-12.106 11.114-9.487 18.974l1.803 5.409a268.476 268.476 0 0 0-43.235-26.849C334.205 9.396 294.77 0 256 0 187.99 0 123.806 26.73 75.269 75.269S0 187.991 0 256c0 31.41 6.599 63.589 19.611 95.643 2.366 5.828 7.979 9.361 13.903 9.361 1.879 0 3.79-.355 5.638-1.105 7.676-3.116 11.372-11.865 8.256-19.541C35.856 311.905 30 283.523 30 256 30 131.383 131.383 30 256 30c45.74 0 91.914 15.216 130.277 41.606a15 15 0 0 0-17.228 9.944c-2.619 7.858 1.628 16.354 9.487 18.974l63.64 21.214a15.001 15.001 0 0 0 18.973-18.973zm31.24 57.592c-3.117-7.677-11.867-11.37-19.541-8.256s-11.372 11.865-8.256 19.541C476.144 200.095 482 228.477 482 256c0 124.617-101.383 226-226 226-45.74 0-91.914-15.216-130.277-41.606 7.332 1.504 14.801-2.664 17.228-9.944 2.619-7.858-1.628-16.354-9.487-18.974l-63.64-21.214a14.999 14.999 0 0 0-18.974 18.974l21.213 63.64c2.096 6.286 7.947 10.262 14.229 10.261 1.572 0 3.172-.249 4.745-.773 7.859-2.62 12.106-11.114 9.487-18.974l-1.803-5.409a268.476 268.476 0 0 0 43.235 26.849C177.795 502.604 217.23 512 256 512c68.01 0 132.194-26.73 180.731-75.269S512 324.009 512 256c0-31.41-6.599-63.589-19.611-95.643z"/></svg>
										</span>
										'. html_escape($this->CI->lang->line('ltr_admin_templates_txt_4')) .'
									</a>
								</li>
								<li class="active">
									<a href="javascript:;" class="ppd_delete_template" data-uniq_id="'. $value['id'] .'" data-bs-toggle="modal" data-bs-target="#pxg_delete_templt_modal">
										<span class="pxg_dropdown_ic">
											<svg xmlns="http://www.w3.org/2000/svg" width="12" height="15" fill="none" xmlns:v="https://vecta.io/nano"><path d="M10.033 4.74H1.917c-.076 0-.15.014-.22.043s-.133.072-.186.126-.094.119-.121.19-.04.146-.037.222l.225 6.831c.022.583.269 1.135.689 1.54s.981.631 1.565.63h4.283c.584 0 1.146-.226 1.567-.632s.667-.959.688-1.543l.225-6.825c.003-.076-.01-.151-.037-.222s-.068-.135-.121-.19-.116-.097-.186-.126-.145-.044-.22-.043zM5.18 11.627c0 .15-.059.293-.165.399s-.249.165-.399.165-.293-.059-.399-.165-.165-.249-.165-.399V6.825c0-.149.059-.293.165-.399s.249-.165.399-.165.293.059.399.165.165.249.165.399v4.802zm2.717 0c0 .15-.059.293-.165.399s-.249.165-.399.165-.293-.059-.399-.165-.165-.249-.165-.399V6.825c0-.149.059-.293.165-.399s.249-.165.399-.165.293.059.399.165.165.249.165.399v4.802zm2.88-9.142H9.03c-.179.001-.351-.065-.484-.185s-.215-.285-.232-.463A1.69 1.69 0 0 0 6.623.321H5.315a1.69 1.69 0 0 0-1.691 1.516c-.017.178-.1.343-.232.463s-.305.186-.484.185H1.173c-.149 0-.293.059-.399.165s-.165.249-.165.399.059.293.165.399.249.165.399.165h9.581c.149 0 .293-.059.398-.165s.165-.249.165-.399-.059-.293-.165-.399-.249-.165-.398-.165h.022zm-6.019-.53c.014-.14.08-.269.184-.363s.24-.145.38-.145H6.64c.14-.001.276.051.38.145s.17.223.184.363c.02.183.068.361.141.53H4.616c.073-.169.121-.347.141-.53z" fill="#7d809d"/></svg>
										</span>
										'. html_escape($this->CI->lang->line('ltr_admin_templates_txt_5')) .'  
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="pxg_template_title">
						<h6>'. $value['template_name'] .'</h6>
						<p>'. html_escape($this->CI->lang->line('ltr_admin_templates_txt_6')) .' - '. date('M d, Y', strtotime($value['date_created'])) .'</p>
					</div>
				</div>';
		return $html;
	}

	function dfyTempElementAdminForPlan($value, $checked){

		$html = '<div class="pxg_template_content">
					<div class="pxg_template_wrapper">
						<div class="pxg_temp_preview_wrapper">
							<a href="'. base_url() .'admin/preview/'.$value['id'].'" target="_blank" class="pxg_btn">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488.85 488.85" xmlns:v="https://vecta.io/nano"><path d="M244.425 98.725c-93.4 0-178.1 51.1-240.6 134.1-5.1 6.8-5.1 16.3 0 23.1 62.5 83.1 147.2 134.2 240.6 134.2s178.1-51.1 240.6-134.1c5.1-6.8 5.1-16.3 0-23.1-62.5-83.1-147.2-134.2-240.6-134.2zm6.7 248.3c-62 3.9-113.2-47.2-109.3-109.3 3.2-51.2 44.7-92.7 95.9-95.9 62-3.9 113.2 47.2 109.3 109.3-3.3 51.1-44.8 92.6-95.9 95.9zm-3.1-47.4c-33.4 2.1-61-25.4-58.8-58.8 1.7-27.6 24.1-49.9 51.7-51.7 33.4-2.1 61 25.4 58.8 58.8-1.8 27.7-24.2 50-51.7 51.7z"></path></svg>
							</a>
						</div>
						<div class="checkbox">
							<input id="checkbox-id'.$value['id'].'" class="tempid_for_plan" data-id="'.$value['id'].'" type="checkbox" '.($checked ? 'checked' : '').' >
							<label for="checkbox-id'.$value['id'].'"></label>
						</div>
						<img class="pxg_template_thumbnail" src="'. (( $value['thumbnail_path'] != '' )? base_url( $value['thumbnail_path'] ): base_url('assets/images/image-preview.jpg')) .'" alt="template-thumbnail">
					</div>
					<div class="pxg_template_title">
						<h6>'.$value['template_name'].'</h6>
						<p>'. html_escape($this->CI->lang->line('ltr_admin_templates_txt_6')) .' - '. date('M d, Y', strtotime($value['date_created'])) .'</p>
					</div>
				</div>';

		return $html;
	}

	function plansTemplatesShowElement($value){

		$html = '<div class="pxg_template_content">
					<div class="pxg_template_wrapper">
						<div class="pxg_temp_preview_wrapper">
							<a href="'. base_url() .'dfy-template/preview/'.$value['id'].'" target="_blank" class="pxg_btn">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488.85 488.85" xmlns:v="https://vecta.io/nano"><path d="M244.425 98.725c-93.4 0-178.1 51.1-240.6 134.1-5.1 6.8-5.1 16.3 0 23.1 62.5 83.1 147.2 134.2 240.6 134.2s178.1-51.1 240.6-134.1c5.1-6.8 5.1-16.3 0-23.1-62.5-83.1-147.2-134.2-240.6-134.2zm6.7 248.3c-62 3.9-113.2-47.2-109.3-109.3 3.2-51.2 44.7-92.7 95.9-95.9 62-3.9 113.2 47.2 109.3 109.3-3.3 51.1-44.8 92.6-95.9 95.9zm-3.1-47.4c-33.4 2.1-61-25.4-58.8-58.8 1.7-27.6 24.1-49.9 51.7-51.7 33.4-2.1 61 25.4 58.8 58.8-1.8 27.7-24.2 50-51.7 51.7z"></path></svg>
							</a>
						</div>
						<img class="pxg_template_thumbnail" src="'. (( $value['thumbnail_path'] != '' )? base_url( $value['thumbnail_path'] ): base_url('assets/images/image-preview.jpg')) .'" alt="template-thumbnail">
					</div>
					<div class="pxg_template_title">
						<h6>'.$value['template_name'].'</h6>
						<p>'. html_escape($this->CI->lang->line('ltr_admin_templates_txt_6')) .' - '. date('M d, Y', strtotime($value['date_created'])) .'</p>
					</div>
				</div>';

		return $html;
	}

	function userSiteElement($value){

		$download_option = '';
		if( $value['is_downloadable'] == 1 ){
			$download_option = '<li class="active">
									<a href="javascript:;" class="download_site" data-site-id="'.$value['id'] .'" >
										<span class="pxg_dropdown_ic">
											<svg xmlns="http://www.w3.org/2000/svg" fill="#7d809d" viewBox="0 0 512 512" xmlns:v="https://vecta.io/nano"><path d="M382.56 233.376A15.96 15.96 0 0 0 368 224h-64V16a16.01 16.01 0 0 0-16-16h-64a16.01 16.01 0 0 0-16 16v208h-64a16.013 16.013 0 0 0-14.56 9.376c-2.624 5.728-1.6 12.416 2.528 17.152l112 128A15.946 15.946 0 0 0 256 384c4.608 0 8.992-2.016 12.032-5.472l112-128c4.16-4.704 5.12-11.424 2.528-17.152zM432 352v96H80v-96H16v128c0 17.696 14.336 32 32 32h416c17.696 0 32-14.304 32-32V352h-64z"></path></svg>	
										</span>
										Download
									</a>
								</li>';
		}

		$meta = '<a href="'. base_url('e/'.$value['campaign_host_name']) .'" target="_blank" class="">
					<div class="tooltip_icon">
						Site link
					</div>
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 514 514 " xmlns:v="https://vecta.io/nano"><path d="M243.762 455.68h-119.73c-20.046 0-37.05-6.396-49.14-18.486s-18.486-29.172-18.486-49.296v-239.46c0-20.046 6.474-37.05 18.642-49.062s29.172-18.408 49.296-18.408h79.56c9.75 0 17.706 2.886 23.088 8.346 4.836 4.836 7.332 11.544 7.254 19.344-.156 16.536-11.856 27.144-29.952 27.222h-79.638c-10.92 0-13.494 2.574-13.494 13.65v237.744c0 10.998 2.574 13.494 13.572 13.494h237.744c10.998 0 13.572-2.496 13.572-13.572v-79.56c0-18.096 10.764-29.874 27.3-29.952h.156c16.614 0 27.378 11.622 27.378 29.64v7.488 74.49c-.078 19.266-6.552 35.802-18.72 47.814s-28.704 18.408-48.048 18.486H243.762zM229.41 308.104c-9.282 0-18.408-6.162-22.698-15.288-5.304-11.31-3.042-23.556 6.084-32.838l34.398-34.398 12.012-11.934 38.766-38.532 62.322-62.088c.39-.39.78-.78 1.17-1.248l-55.224-.468c-8.658 0-15.99-2.808-21.138-8.112-4.914-4.992-7.488-11.856-7.41-19.734.156-16.146 11.622-26.988 28.47-27.066l62.01-.078 59.436.078c16.926 0 27.924 10.842 28.002 27.534v123.006c-.078 16.068-11.31 27.378-27.3 27.378s-27.222-11.232-27.378-27.222l-.234-33.228-.156-23.478a34.83 34.83 0 0 0-1.716 1.638l-36.036 36.192L254.604 296.56c-5.616 5.46-12.636 9.282-20.202 11.076-1.716.312-3.354.468-4.992.468z"></path></svg>
				</a>
				<a href="javascript:;" onclick="copyText1(\''. base_url('e/'.$value['campaign_host_name']) .'\')" class="">
					<div class="tooltip_icon">
						Copy link
					</div>
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" xmlns:v="https://vecta.io/nano"><path d="M492.983 104.96L407.04 19.017a50 50 0 0 0-35.597-14.75H230.827c-55.587.059-100.634 45.106-100.694 100.693H104.96c-55.587.059-100.634 45.106-100.693 100.693V407.04c.059 55.587 45.106 100.634 100.693 100.693h176.213c55.587-.059 100.634-45.106 100.694-100.693h25.173c55.587-.059 100.634-45.106 100.693-100.693v-165.79a50.66 50.66 0 0 0-14.75-35.597zM381.867 65.037l65.096 65.096h-33.249c-17.578-.016-31.825-14.258-31.847-31.835zm-100.694 392.35H104.96c-27.793-.032-50.315-22.554-50.347-50.347V205.653c.032-27.793 22.555-50.315 50.347-50.346h25.173v151.04c.06 55.587 45.107 100.634 100.694 100.693H331.52c-.032 27.793-22.554 50.315-50.347 50.347zM407.04 356.693H230.827c-27.793-.031-50.315-22.553-50.347-50.346V104.96c.032-27.793 22.554-50.315 50.347-50.347H331.52v43.685c.059 45.368 36.826 82.13 82.194 82.182h43.673v125.867c-.032 27.793-22.555 50.315-50.347 50.346z"></path></svg>
				</a>';

		$html = '<div class="pxg_template_content pxg_my_site_temp_content">
					<div class="pxg_template_wrapper">
						<div class="pxg_temp_preview_wrapper">
							<a href="'.base_url('template/preview/'.$value['id']) .'" target="_blank" class="">
							<div class="tooltip_icon">
									Preview
							</div>
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488.85 488.85" xmlns:v="https://vecta.io/nano"><path d="M244.425 98.725c-93.4 0-178.1 51.1-240.6 134.1-5.1 6.8-5.1 16.3 0 23.1 62.5 83.1 147.2 134.2 240.6 134.2s178.1-51.1 240.6-134.1c5.1-6.8 5.1-16.3 0-23.1-62.5-83.1-147.2-134.2-240.6-134.2zm6.7 248.3c-62 3.9-113.2-47.2-109.3-109.3 3.2-51.2 44.7-92.7 95.9-95.9 62-3.9 113.2 47.2 109.3 109.3-3.3 51.1-44.8 92.6-95.9 95.9zm-3.1-47.4c-33.4 2.1-61-25.4-58.8-58.8 1.7-27.6 24.1-49.9 51.7-51.7 33.4-2.1 61 25.4 58.8 58.8-1.8 27.7-24.2 50-51.7 51.7z"></path></svg>
							</a>
							'.(!empty($value['campaign_host_name']) ? $meta: '') .'
						</div>
						<img class="pxg_template_thumbnail" src="'.(( $value['template_thumbnail'] != '' )? base_url( $value['template_thumbnail'] ): base_url('assets/images/image-preview.jpg')) .'" alt="template-thumbnail">
						<a href="javascript:void(0);" class="pxg_setting_icn">
							<img src="'.base_url() .'assets/images/svg/dots.svg" alt="dropdown-dots">
						</a>
						<div class="pxg_setting_dropdown">
							<ul>
								<li class="active">
									<a href="'.base_url('template/edit/'.$value['id']) .'" > 
										<span class="pxg_dropdown_ic">
											<svg xmlns="http://www.w3.org/2000/svg" width="12" height="15" fill="none" xmlns:v="https://vecta.io/nano"><path d="M10.879 12.863H1.051a.7.7 0 0 0-.702.702.7.7 0 0 0 .702.702h9.828a.7.7 0 0 0 .702-.702.7.7 0 0 0-.702-.702zm-9.828-1.404h.063l2.927-.267c.321-.032.621-.173.849-.4l6.318-6.318a1.35 1.35 0 0 0-.049-1.903L9.236.647c-.251-.236-.58-.371-.924-.38s-.68.109-.943.331L1.051 6.916c-.227.229-.368.529-.4.849l-.302 2.927a.7.7 0 0 0 .204.562c.066.065.143.117.229.152s.177.053.27.052zm7.21-9.828l1.917 1.917-1.404 1.369-1.881-1.881L8.261 1.63z" fill="#7d809d"/></svg>
										</span>
										'. html_escape($this->CI->lang->line('ltr_campaigns_list_txt_1')) .'
									</a>
								</li>
								<li class="active">
									<a href="javascript:;" class="ppd_clone_template" data-uniq_id="'.$value['id'] .'" >
										<span class="pxg_dropdown_ic">
											<svg xmlns="http://www.w3.org/2000/svg" width="13" height="15" fill="#7d809d" xmlns:v="https://vecta.io/nano"><path d="M2.964 3.212h-1a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1v-1h-7v-9zm6-3v4h4l-4-4zm-1 5v-5h-3a1 1 0 0 0-1 1v10h8a1 1 0 0 0 1-1v-5h-5z"/></svg>
										</span>
										'. html_escape($this->CI->lang->line('ltr_campaigns_list_txt_2')) .'
									</a>
								</li>
								<li class="active">
									<a href="javascript:;" class="ppd_edit_template" data-uniq_id="'.$value['id'] .'" > 
										<span class="pxg_dropdown_ic">
										<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="#7D809D" viewBox="0 0 512 512" xmlns:v="https://vecta.io/nano"><path d="M408.404 292.029l-20.019-11.558C390.157 271.85 391 263.885 391 256s-.843-15.85-2.614-24.472l20.019-11.558a15.005 15.005 0 0 0 5.49-20.49l-30-51.961a15 15 0 0 0-20.49-5.49l-19.837 11.453c-12.434-10.548-26.865-18.791-42.567-24.313V106c0-8.284-6.716-15-15-15h-60c-8.284 0-15 6.716-15 15v23.169c-15.702 5.522-30.134 13.766-42.567 24.313l-19.837-11.453a15 15 0 0 0-20.49 5.49l-30 51.961a15.002 15.002 0 0 0 5.49 20.49l20.019 11.558C121.843 240.15 121 248.115 121 256s.843 15.85 2.614 24.472l-20.019 11.558a15.005 15.005 0 0 0-5.49 20.49l30 51.961a15 15 0 0 0 20.49 5.49l19.837-11.453c12.434 10.548 26.865 18.791 42.567 24.313V406c0 8.284 6.716 15 15 15h60c8.284 0 15-6.716 15-15v-23.169c15.702-5.522 30.134-13.766 42.567-24.313l19.837 11.453c7.174 4.143 16.347 1.684 20.49-5.49l30-51.961a14.998 14.998 0 0 0-5.489-20.491zM256 301c-24.813 0-45-20.187-45-45s20.187-45 45-45 45 20.187 45 45-20.187 45-45 45zm205.149-198.235l-21.213-63.64c-2.62-7.859-11.115-12.108-18.974-9.487s-12.106 11.114-9.487 18.974l1.803 5.409a268.476 268.476 0 0 0-43.235-26.849C334.205 9.396 294.77 0 256 0 187.99 0 123.806 26.73 75.269 75.269S0 187.991 0 256c0 31.41 6.599 63.589 19.611 95.643 2.366 5.828 7.979 9.361 13.903 9.361 1.879 0 3.79-.355 5.638-1.105 7.676-3.116 11.372-11.865 8.256-19.541C35.856 311.905 30 283.523 30 256 30 131.383 131.383 30 256 30c45.74 0 91.914 15.216 130.277 41.606a15 15 0 0 0-17.228 9.944c-2.619 7.858 1.628 16.354 9.487 18.974l63.64 21.214a15.001 15.001 0 0 0 18.973-18.973zm31.24 57.592c-3.117-7.677-11.867-11.37-19.541-8.256s-11.372 11.865-8.256 19.541C476.144 200.095 482 228.477 482 256c0 124.617-101.383 226-226 226-45.74 0-91.914-15.216-130.277-41.606 7.332 1.504 14.801-2.664 17.228-9.944 2.619-7.858-1.628-16.354-9.487-18.974l-63.64-21.214a14.999 14.999 0 0 0-18.974 18.974l21.213 63.64c2.096 6.286 7.947 10.262 14.229 10.261 1.572 0 3.172-.249 4.745-.773 7.859-2.62 12.106-11.114 9.487-18.974l-1.803-5.409a268.476 268.476 0 0 0 43.235 26.849C177.795 502.604 217.23 512 256 512c68.01 0 132.194-26.73 180.731-75.269S512 324.009 512 256c0-31.41-6.599-63.589-19.611-95.643z"/></svg>
										</span>
										'. html_escape($this->CI->lang->line('ltr_campaigns_list_txt_3')) .'
									</a>
								</li>

								' .$download_option. '
								<li class="active">
									<a href="javascript:;" class="ppd_delete_template" data-uniq_id="'.$value['id'] .'" >
										<span class="pxg_dropdown_ic">
											<svg xmlns="http://www.w3.org/2000/svg" width="12" height="15" fill="none" xmlns:v="https://vecta.io/nano"><path d="M10.033 4.74H1.917c-.076 0-.15.014-.22.043s-.133.072-.186.126-.094.119-.121.19-.04.146-.037.222l.225 6.831c.022.583.269 1.135.689 1.54s.981.631 1.565.63h4.283c.584 0 1.146-.226 1.567-.632s.667-.959.688-1.543l.225-6.825c.003-.076-.01-.151-.037-.222s-.068-.135-.121-.19-.116-.097-.186-.126-.145-.044-.22-.043zM5.18 11.627c0 .15-.059.293-.165.399s-.249.165-.399.165-.293-.059-.399-.165-.165-.249-.165-.399V6.825c0-.149.059-.293.165-.399s.249-.165.399-.165.293.059.399.165.165.249.165.399v4.802zm2.717 0c0 .15-.059.293-.165.399s-.249.165-.399.165-.293-.059-.399-.165-.165-.249-.165-.399V6.825c0-.149.059-.293.165-.399s.249-.165.399-.165.293.059.399.165.165.249.165.399v4.802zm2.88-9.142H9.03c-.179.001-.351-.065-.484-.185s-.215-.285-.232-.463A1.69 1.69 0 0 0 6.623.321H5.315a1.69 1.69 0 0 0-1.691 1.516c-.017.178-.1.343-.232.463s-.305.186-.484.185H1.173c-.149 0-.293.059-.399.165s-.165.249-.165.399.059.293.165.399.249.165.399.165h9.581c.149 0 .293-.059.398-.165s.165-.249.165-.399-.059-.293-.165-.399-.249-.165-.398-.165h.022zm-6.019-.53c.014-.14.08-.269.184-.363s.24-.145.38-.145H6.64c.14-.001.276.051.38.145s.17.223.184.363c.02.183.068.361.141.53H4.616c.073-.169.121-.347.141-.53z" fill="#7d809d"/></svg>
										</span>
										'. html_escape($this->CI->lang->line('ltr_campaigns_list_txt_4')) .'
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="pxg_template_title">
						<h6>'.$value['template_name'] .'</h6>
						<p>'. html_escape($this->CI->lang->line('ltr_campaigns_list_txt_5')) .' - '.date('M d, Y', strtotime($value['created_date'])) .'</p>
					</div>
				</div>';
		return $html;
	}
	
}
