<?php
class subscriber{
	
	public function switch_responder( $apikey, $action, $responder ){
		switch($responder){
			case 'ConstantContact':
				return $this->ConstantContact( $apikey, $action );
			break;
			case 'Mailchimp':
				return $this->Mailchimp( $apikey, $action );
			break;
			case 'SendReach':
				return $this->SendReach( $apikey, $action );
			break;
			case 'iContact':
				return $this->iContact( $apikey, $action );
			break;
			case 'Infusionsoft':
				return $this->Infusionsoft( $apikey, $action );
			break;
			/*case 'Hubspot':
				return $this->Hubspot( $apikey, $action );
			break;*/
			case 'Aweber':
				return $this->Aweber( $apikey, $action, $responder );
			break;
			case 'GetResponse':
				return $this->GetResponse( $apikey, $action );
			break;
			case 'CampaignMonitor':
				return $this->CampaignMonitor( $apikey, $action );
			break;
			case 'GoToWebinar':
				return $this->GoToWebinar( $apikey, $action );
			break;
			case 'ActiveCampaign':
				return $this->ActiveCampaign( $apikey, $action );
			break;
			case 'Sendlane':
				return $this->Sendlane( $apikey, $action );
			break;
			case 'Mailpoet':
				return $this->Mailpoet( $apikey, $action );
			break;
			case 'Sendy':
				return $this->Sendy( $apikey, $action );
			break;
			case 'Sendinblue':
				return $this->Sendinblue( $apikey, $action );
			break;
			case 'Verticalresponse':
				return $this->Verticalresponse( $apikey, $action );
			break;
			case 'ConvertKit':
				return $this->ConvertKit( $apikey, $action );
			break;
			case 'MailerLite':
				return $this->MailerLite( $apikey, $action );
			break;
			case 'Drip':
				return $this->Drip( $apikey, $action );
			break;
			case 'MarketHero':
				return $this->MarketHero( $apikey, $action );
			break;
			case 'CustomHTML':
				return $this->CustomHTML( $apikey, $action );
			break;
			case 'Sharpspring':
				return $this->Sharpspring( $apikey, $action );
			break;
			case 'Sendiio':
				return $this->Sendiio( $apikey, $action );
			break;
			case 'SendFox':
			    return $this->SendFox( $apikey, $action);
			break;
		}
	}
	

	public function Sendiio( $apikey, $action ){
		if($action == 'getList'){
		    	
			$url = 'https://sendiio.com/api/v1/lists/email';
		    $headers = array('Content-Type: text/html','token:'.$apikey['api_token'],'secret:'.$apikey['api_secret']);
		    $ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
			curl_setopt($ch, CURLOPT_POST, 0);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$server_output = curl_exec($ch);
			curl_close ($ch);
	
			$data=json_decode($server_output,true);
			if($data['error']==0){
				$list = array();
			foreach($data['data']['lists'] as $group){
				$list[$group['encrypted_id']] = $group['name'];
			}
			$result['list'] = $list;
				//$result['list'] =$data['data']['lists'];
			}else{
				$result['list'] = "";
				}
			
		}
		if($action == 'subsCribe'){	
			$listID = $_POST['listid'];
			$url = 'https://sendiio.com/api/v1/lists/subscribe/json';
	        $headers = array('Content-Type: text/html');
	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL,$url);
	        curl_setopt($ch, CURLOPT_POST, 1);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, "email_list_id=".$listID."&email=".$_POST['email']);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	        $server_output = curl_exec($ch);
	        curl_close ($ch);
	        $result=json_decode($server_output,true);
			
			if($result['error']==0){
				$result = array('success'=>'We\'ve received your message! We\'ll get back to you soon.');	
			}else{
				$result = array('error'=>'Subscribe was unsuccessful. Please try again in 15 minutes...');
			}
			
		}
		return $result;
	}

	public function Sharpspring( $apikey, $action ){
		$secret_key = $apikey['secret_key'];
		$account_id = $apikey['account_id'];
		
		if($action == 'getList'){
			$limit = 500;                                                                         
			$offset = 0;                                                                          
																								  
			$method = 'getCampaigns';                                                                 
			$params = array('where' => array(), 'limit' => $limit, 'offset' => $offset);          
			$requestID = session_id();       
			$accountID = $account_id; //31550
			$secretKey = $secret_key;                                                     

			$data = array(                                                                                
			   'method' => $method,                                                                      
			   'params' => $params,                                                                      
			   'id' => $requestID,                                                                       
			);                                                                                            
																										 
			$queryString = http_build_query(array('accountID' => $accountID, 'secretKey' => $secretKey)); 
			$url = "http://api.sharpspring.com/pubapi/v1/?$queryString";                             
																										 
			$data = json_encode($data);                                                                   
			$ch = curl_init($url);                                                                        
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                              
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);                                                  
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                               
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                   
			   'Content-Type: application/json',                                                         
			   'Content-Length: ' . strlen($data)                                                        
			));                                                                                           
																										 
			$res = curl_exec($ch);                                                                     
			curl_close($ch);                                                                              
																										 
			$r = json_decode($res, true);
			
			if (is_array($r) && isset($r['result']['campaign']) && !empty($r['result']['campaign'])){
				$list = array();
				$c = $r['result']['campaign'];
				for($i=0;$i<count($c);$i++){
					$list[$c[$i]['id']] = $c[$i]['campaignName'];
				}
				$result['list'] = $list;
			}else{
				$result = array( 'error'=> 'An error occurred while getting your list.' );
			}
		}
		
		if($action == 'subsCribe'){
			$email = $_POST['email'];
			$campaignID = $_POST['listid'];
			//$method = 'createLeads';                                                                 
			$method = 'updateLeads';                                                                 
			$params[] = array('emailAddress' => $email, 'campaignID' => $campaignID);
			$requestID = session_id();       
			$accountID = $account_id; //31550
			$secretKey = $secret_key;

			if (isset($_COOKIE['__ss_tk'])) {
				$params[0]['trackingID'] = $_COOKIE['__ss_tk'];
			}	

			$data = array(                                                                                
			   'method' => $method,                                                                      
			   'params' => array( 'objects' => $params ),
			   'id' => $requestID,                                                                       
			);                                                                                            
																										 
			$queryString = http_build_query(array('accountID' => $accountID, 'secretKey' => $secretKey)); 
			$url = "http://api.sharpspring.com/pubapi/v1/?$queryString";                             
																										 
			$data = json_encode($data);                                                                   
			$ch = curl_init($url);                                                                        
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                              
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);                                                  
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                               
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                   
			   'Content-Type: application/json',                                                         
			   'Content-Length: ' . strlen($data)                                                        
			));                                                                                           
																										 
			$res = curl_exec($ch);                                                                     
			curl_close($ch);  
			
			$r = json_decode($res, true);
			if(isset($r['result']['updates'][0]['success']) && $r['result']['updates'][0]['success']){
				$result = array('success'=>'We\'ve received your message! We\'ll get back to you soon.');	
			}else{
				$method = 'createLeads';  
				$data = array(                                                                                
				   'method' => $method,                                                                      
				   'params' => array( 'objects' => $params ),
				   'id' => $requestID,                                                                       
				);                                                                                            
																											 
				$queryString = http_build_query(array('accountID' => $accountID, 'secretKey' => $secretKey)); 
				$url = "http://api.sharpspring.com/pubapi/v1/?$queryString";                             
																											 
				$data = json_encode($data);                                                                   
				$ch = curl_init($url);                                                                        
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                              
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);                                                  
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                               
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                   
				   'Content-Type: application/json',                                                         
				   'Content-Length: ' . strlen($data)                                                        
				));                                                                                           
																											 
				$res = curl_exec($ch);                                                                     
				curl_close($ch);  
				
				$r = json_decode($res, true);
				
				if(isset($r['result']['creates'][0]['success']) && $r['result']['creates'][0]['success']){
					$result = array('success'=>'We\'ve received your message! We\'ll get back to you soon.');	
				}
			}			
		}
		
		return $result;
	}
	
	public function MarketHero( $apikey, $action ){
		
		$api_key = $apikey['api_key'];
		
		if($action == 'getList'){
			$apiURL = 'http://api.markethero.io/v1/api/tags?apiKey='.$api_key;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$apiURL);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$responseJson = curl_exec($ch);
			curl_close($ch);
			
			$responseArray = json_decode($responseJson, true);
			
			if( isset($responseArray['error']) ){
				$result = array( 'error'=> 'An error occurred while getting your list.' );
			}else {
				if (!empty($responseArray)){
					$list = array();
					for($i=0;$i<count($tag);$i++){
						$list[$tag[$i]] = $tag[$i];
					}
					$result['list'] = $list;
				}else{
					$result = array( 'error'=> 'An error occurred while getting your list.' );
				}
			}		
		}
		
		if($action == 'subsCribe'){	
			$listID = $_POST['listid'];
			$email = $_POST['email'];
			$markethero_data=array();
			$markethero_data['apiKey']=$api_key;
			$markethero_data['email']=$email;
			$markethero_data['tags']=array($listID);     
			$postmarkethero_data= json_encode($markethero_data);
			$apiURL = 'https://api.markethero.io/v1/api/tag-lead';
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$apiURL);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postmarkethero_data);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
			$response = curl_exec($ch);
			curl_close($ch);
			
			$resp = json_decode($resp,true);
			
			if(isset($resp['result'])){
				$result = array('success'=>'We\'ve received your message! We\'ll get back to you soon.');	
			}else{
				$result = array('error'=>'Subscribe was unsuccessful. Please try again in 15 minutes...');
			}
			
		}
		
		return $result;
	}
	
	public function Drip( $apikey, $action ){
		
		$api_token = $apikey['api_token'];
		$account_id = $apikey['account_id'];
		
		$header = array(
			'Accept: application/vnd.api+json',
			'Content-Type: application/vnd.api+json',
			'Authorization: Basic '.base64_encode($api_token)
		);
		
		if($action == 'getList'){
			
			$Url = 'https://api.getdrip.com/v2/'.$account_id.'/campaigns/';
			
			$curl = curl_init();
			// Set some options - we are passing in a useragent too here
			curl_setopt_array($curl, array(
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_URL => $Url,
				CURLOPT_HTTPHEADER => $header
			));
			// Send the request & save response to $resp
			$resp = curl_exec($curl);
			// Close request to clear up some resources
			curl_close($curl);

			$resp = json_decode($resp,true);
		
			if(isset($resp['error'])){
				$result = array( 'error'=> 'An error occurred while getting your list.' );
			}elseif(isset($resp['campaigns']) && !empty($resp['campaigns'])){
				$list = array();
				foreach($resp['campaigns'] as $campaign){
					$list[$campaign['id']] = $campaign['name'];
				}
				$result['list'] = $list;
			}else{
				$result = array( 'error'=> 'An error occurred while getting your list.' );
			}
		
		}
		
		if($action == 'subsCribe'){	
			$campaign_id = $_POST['listid'];
			$email = $_POST['email'];
		
			$Url = 'https://api.getdrip.com/v2/'.$account_id.'/campaigns/'.$campaign_id.'/subscribers/';
			
			$a = json_encode( array('subscribers'=>array(
				array(
					'email' => $email
				)
			)) );
			
			$curl = curl_init();
			// Set some options - we are passing in a useragent too here
			curl_setopt_array($curl, array(
				CURLOPT_URL => $Url,
				CURLOPT_HTTPHEADER => $header,
				CURLOPT_SSL_VERIFYPEER => true,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => $a
			));
			// Send the request & save response to $resp
			$resp = curl_exec($curl);
			// Close request to clear up some resources
			curl_close($curl);

			$resp = json_decode($resp,true);
			
			if(isset($resp['subscribers'])){
				$result = array('success'=>'We\'ve received your message! We\'ll get back to you soon.');	
			}else{
				$result = array('error'=>'Subscribe was unsuccessful. Please try again in 15 minutes...');
			}
			
		}
		
		return $result;
	}
	
	public function MailerLite( $apikey, $action ){
		
		$apiKey = $apikey['api_key'];
		if($action == 'getList'){
			$Url = "https://api.mailerlite.com/api/v1/lists/?apiKey=".$apiKey;
			$cSession = curl_init(); 
			curl_setopt($cSession, CURLOPT_URL, $Url);
			curl_setopt($cSession, CURLOPT_RETURNTRANSFER,true);
			curl_setopt($cSession, CURLOPT_HEADER, false); 
			$groups = curl_exec($cSession);
			curl_close($cSession);
			
			$groups = (array) json_decode( $groups );
			
			if(isset($groups['error'])){
				$result = array( 'error'=> $groups['error']->message );
			}elseif(isset($groups['Results']) && !empty($groups['Results'])){
				$list = array();
				foreach($groups['Results'] as $group){
					$list[$group->id] = $group->name;
				}
				$result['list'] = $list;
			}else{
				$result = array( 'error'=> 'An error occurred while getting your list.' );
			}
		}
		if($action == 'subsCribe'){			
			$groupID = $_POST['listid'];			
			$email = $_POST['email'];
			
			$postData = 'apiKey='.$apiKey.'&email='.$email.'&id='.$groupID;
			$Url = "https://api.mailerlite.com/api/v1/subscribers/".$groupID;
			
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,$Url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$data = curl_exec($ch);
			curl_close($ch);
			$data = json_decode($data, true);
			
			if(isset($data['email'])){
				$result = array('success'=>'We\'ve received your message! We\'ll get back to you soon.');	
			}else{
				$result = array('error'=>'Subscribe was unsuccessful. Please try again in 15 minutes...');
			}
			
		}
		return $result;
	}
	
	public function ConvertKit( $apikey, $action ){
		
		$apiKey = $apikey['api_key'];
		$api_secret = $apikey['api_secret'];
		if($action == 'getList'){
			$cSession = curl_init(); 
			$Url = "https://api.convertkit.com/v3/forms?api_key=".$apiKey;
			curl_setopt($cSession, CURLOPT_URL, $Url);
			curl_setopt($cSession, CURLOPT_RETURNTRANSFER,true);
			curl_setopt($cSession, CURLOPT_HEADER, false); 
			$forms = curl_exec($cSession);
			curl_close($cSession);
			
			$forms = (array) json_decode( $forms );
			
			if(isset($forms['error'])){
				$result = array( 'error'=> $forms['message'] );
			}elseif(isset($forms['forms']) && !empty($forms['forms'])){
				$list = array();
				foreach($forms['forms'] as $form){
					$list[$form->id] = $form->name;
				}
				$result['list'] = $list;
			}else{
				$result = array( 'error'=> 'An error occurred while getting your list.' );
			}
			
		}
		if($action == 'subsCribe'){			
			$formId = $_POST['listid'];			
			$email = $_POST['email'];			
			$Url = "https://api.convertkit.com/v3/forms/".$formId."/subscribe";
			
			$postData = 'api_secret='.$api_secret.'&email='.$email;
			
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,$Url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$data = curl_exec($ch);
			curl_close($ch);
			$data = json_decode($data, true);
			
			if(isset($data['subscription'])){
				$result = array('success'=>'We\'ve received your message! We\'ll get back to you soon.');	
			}else{
				$result = array('error'=>'Subscribe was unsuccessful. Please try again in 15 minutes...');
			}
			
		}
		
		return $result;
	}
	
	public function CustomHTML( $apikey, $action ){
		return array( 'success' => 1 );
	}
	
	public function Verticalresponse( $apikey, $action ){
		
		if($action == 'getList'){
			$access_token = $apikey['accesstoken'];
			$params = array('access_token'=>$access_token);
			$ch = curl_init();
			$url ='';
			if ($params)
			{
				$url =  ( strpos( $url, '?' ) ? '&' : '?' ) . http_build_query($params, '', '&');
			}

			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_URL, 'https://vrapi.verticalresponse.com/api/v1/lists' . $url);
			$headers = array('Authorization: Bearer ' . $access_token);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$data = curl_exec($ch);
			curl_close($ch);
			$retvals = json_decode($data, true);

			$lists = array();

			if ($retvals){
				if(isset($retvals['items'])) {
					if(count($retvals['items']) > 0) {
						$list = array();
						foreach($retvals['items'] as $retval){
							$list[$retval['attributes']['id']] = $retval['attributes']['name'];
						}
						$result['list'] = $list;
					}else {
						$result = array('error'=>'Error occur may be somethig wrong.');
					}
				}else {
					$result = array('error'=>'Error occur may be somethig wrong.');
				}

			} else {
				$result = array('error'=>'Error occur may be somethig wrong.');
			}
		}
		
		if($action == 'subsCribe'){
			$Verticalresponse_accesstoken = $apikey['accesstoken'];

			$email = $_POST['email'];

			if (!empty($_POST['name'])){
				$fname = $_POST['name'];
			}else {
				$fname = '';
			}
			$listID = $_POST['listid'];

			try{

			   $postData = '';
			   $params = array('email'=>$email);
			   //create name value pairs seperated by &
			   foreach($params as $k => $v)
			   {
				  $postData .= $k . '='.$v.'&';
			   }
			   $postData = rtrim($postData, '&');

				$ch = curl_init();
				curl_setopt($ch,CURLOPT_URL,'https://vrapi.verticalresponse.com/api/v1/lists/'.$listID.'/contacts');
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$headers = array('Authorization: Bearer ' . $Verticalresponse_accesstoken);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				$data = curl_exec($ch);
				curl_close($ch);
				$data = json_decode($data, true);
				//print_r($data);
				if(isset($data['success'])){
					$result = array('success'=>'We\'ve received your message! We\'ll get back to you soon.');	
				}else{
					$result = array('error'=>'Subscribe was unsuccessful. Please try again in 15 minutes...');
				}

			} catch (Exception $e){
				$result = array('error'=>'Subscribe was unsuccessful. Please try again in 15 minutes...');
			}
		}
		
		return $result;
	}
	
	public function Sendinblue( $apikey, $action ){
		require_once  'Sendinblue/Mailin.php';
		if($action == 'getList'){
			$key = $apikey['api_key'];
			
			$mailin = new Mailin('https://api.sendinblue.com/v2.0',$key);

			$data = array(
			  "page" => 1,
			  "page_limit" => 50
			);
			$retvals = $mailin->get_lists($data);
			
			if( $retvals['code'] == 'success' ) {
				if( count($retvals['data']['lists']) > 0 ) {
					$list = array();
					foreach($retvals['data']['lists'] as $retval){
						$list[$retval['id']] = $retval['name'];
					}
					$result['list'] = $list;
				}else {
					$result = array('error'=>'Error occur may be somethig wrong.');
				}
			}else {
				$result = array('error'=>'Error occur may be somethig wrong.');
			}
		}
		
		if($action == 'subsCribe'){
			$key = $apikey['api_key'];
			$listID = $_POST['listid'];
			$email = $_POST['email'];
			if (!empty($_POST['name'])){
				$fname = $_POST['name'];
			}else {
				$fname = '';
			}

			try{
				$mailin = new Mailin('https://api.sendinblue.com/v2.0',$key);

				try {

					$data = array( "email" => $email,
						"attributes" => array("NAME"=>$fname, "SURNAME"=>''),
						"listid" => array($listID)
					);

					$res = $mailin->create_update_user($data);
					$result = array('success'=>'We\'ve received your message! We\'ll get back to you soon.');	
				} catch(Emma_Invalid_Response_Exception $e) {
					$result = array('error'=>'Subscribe was unsuccessful. Please try again in 15 minutes...');
				}

			} catch (Exception $e){
				$result = array('error'=>'Subscribe was unsuccessful. Please try again in 15 minutes...');
			}
		}
		
		return $result;
	}
	
	public function Sendy( $apikey, $action ){
		if($action == 'getList'){
			$result['list'] = array($apikey['list_id'] => $apikey['list_nm']);
		}
		
		if($action == 'subsCribe'){
			$sendyapi = $apikey['api_key'];
			$sendyurl = 'http://domainname.com/codeapis/success/';
			$email = $_POST['email'];
			$listID = $_POST['listid'];

			if (!empty($_POST['name'])){
				$fname = $_POST['name'];
			}else {
				$fname = '';
			}
			require_once  'Sendy/SendyPHP.php';
			$config = array(
				'api_key' => $sendyapi, //your API key is available in Settings
				'installation_url' => $sendyurl,  //Your Sendy installation
				'list_id' => $listID
			);
			try{
				$sendy = new \SendyPHP\SendyPHP($config);
				$result = $sendy->subscribe(array(
					'name'=>$fname,
					'email' => $email
				));
			}catch(Exception $e){
				return $e;
			}
			
			$result = array('success'=>'We\'ve received your message! We\'ll get back to you soon.');
		}
		
		return $result;
	}
	
	public function Mailpoet( $apikey, $action ){
		if($action == 'getList' && class_exists('WYSIJA')){
			$lists = $result = array();
			//this will return an array of results with the name and list_id of each mailing list
			$model_list = WYSIJA::get('list','model');
			$mailpoet_lists = $model_list->get(array('name','list_id'),array('is_enabled'=>1));
			 
			//this loop will just echo the information selected for each list
			if(!empty($mailpoet_lists)){
				foreach($mailpoet_lists as $list){
					$lists[$list['list_id']] = $list['name'];
				}
				$result['list'] = $lists;
			}else{
				$result = array('error'=>'Error occur may be somethig wrong.');
			}			
		}
		
		if($action === 'subsCribe'  && class_exists('WYSIJA')){
			$my_email_variable = $_POST['email'];
			$my_list_id1 = $_POST['listid'];
			
			if (!empty($_POST['name'])){
				$fname = $_POST['name'];
			}else {
				$fname = '';
			}
		 
			//in this array firstname and lastname are optional
			$user_data = array(
				'email' => $my_email_variable,
				'firstname' => $fname
			);
		 
			$data_subscriber = array(
			  'user' => $user_data,
			  'user_list' => array('list_ids' => array($my_list_id1))
			);
		 
			$helper_user = WYSIJA::get('user','helper');
			$helper_user->addSubscriber($data_subscriber);
			$result = array('success'=>'We\'ve received your message! We\'ll get back to you soon.');
		}else{
			$result = array('error'=>'Subscribe was unsuccessful. Please try again in 15 minutes...');
		}
		
		return $result;
	}
	
	public function Sendlane( $apikey, $action ){
		
		if($action == 'getList'){
			$url = $apikey['api_url'];
			$url = 'https://sendlane.com';
			$api = $url . '/api/v1/lists';

			$post = array(
				'api'    => $apikey['api_key'],
				'hash'   => $apikey['hash_key']
			);

			$data = "";
			foreach( $post as $key => $value ) $data .= $key . '=' . urlencode($value) . '&';
			$data = rtrim($data, '& ');

			$request = curl_init($api);
			curl_setopt($request, CURLOPT_HEADER, 0);
			curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($request, CURLOPT_POSTFIELDS, $data);
			curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

			$response = (string)curl_exec($request);
			curl_close($request);


			if( $response == '' ) {
				$result = array('error'=>'Error occur may be somethig wrong.');
			}else {
				$result = json_decode($response);
				if( isset ($result->error) ) {
					$result = array('error'=>'Error occur may be somethig wrong.');
				}else {
					if ( !isset($result[0]->list_id)) {
						$result = array('error'=>'Error occur may be somethig wrong.');
					}else {
						$list = array();
						foreach ($result as $solo_list){
							$list_key = $solo_list->list_key;
							$list_name = $solo_list->list_name;
							$list[$list_key] = $list_name;
						}
						$result['list'] = $list;
					}
				}
			}
		}
		
		if($action === 'subsCribe'){
			$result = array('error'=>'Subscribe was unsuccessful. Please try again in 15 minutes...');
		
			$url = $apikey['api_url'];
			$url = 'https://sendlane.com';
			$api = $url . '/api/v1/list-subscriber-add';

			$email = $_POST['email'];
			$listID = trim( $_POST['listid'] );

			if (!empty($_POST['name'])){
				$fname = $_POST['name'];
			}else {
				$fname = '';
			}

			$post = array(
				'api'    => $apikey['api_key'],
				'hash'   => $apikey['hash_key'],
				'email'   => $email,
				'list_id' => $listID
			);

			$data = "";
			foreach( $post as $key => $value ) $data .= $key . '=' . urlencode($value) . '&';
			$data = rtrim($data, '& ');

			$request = curl_init($api);
			curl_setopt($request, CURLOPT_HEADER, 0);
			curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($request, CURLOPT_POSTFIELDS, $post);
			curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

			$response = (string)curl_exec($request);
			curl_close($request);
			
			$res = json_decode($response, true);
			if( isset($res['error']) ){
			    $msg = [];
			    if( isset( $res['error']['messages'] ) && is_array( $res['error']['messages'] ) )
    			    foreach( $res['error']['messages'] as $key => $value ){
    			        $msg[] = $value;
    			    }
    			else
    			    $msg = $res['error']['messages'];
			    return array( 'error'=> $msg );
			}
			

			if ($response != ''){
				$result = array('success'=>'We\'ve received your message! We\'ll get back to you soon.');
			}
		}
		
		return $result;
	}
	
	public function ActiveCampaign( $apikey, $action ){
		if($action === 'getList'){
			$url = $apikey['api_url'];
			$api_key = $apikey['api_key'];

			$params = array(

				'api_key'      => $api_key,
				'api_action'   => 'list_paginator',
				'api_output'   => 'json',
				'somethingthatwillneverbeused' => '',
				'sort' => '',
				'offset' => 0,
				'limit' => 20,
				'filter' => 0,
				'public' => 0,

			);

			$query = "";
			foreach( $params as $key => $value ) $query .= $key . '=' . urlencode($value) . '&';
			$query = rtrim($query, '& ');
			$url = rtrim($url, '/ ');

			if ( !function_exists('curl_init') ) { $result = array('error'=>'Error occur may be somethig wrong.'); }

			if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
				$result = array('error'=>'Error occur may be somethig wrong.');
			}
			$api = $url . '/admin/api.php?' . $query;

			$request = curl_init($api);
			curl_setopt($request, CURLOPT_HEADER, 0);
			curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);
			$response = (string)curl_exec($request);
			curl_close($request);

			if ( !$response ) {
			   $result = array('error'=>'Error occur may be somethig wrong.');
			}

			$results = json_decode($response);
        
			if(empty($results) || $results->result_code == 0 ) {
				$result = array('error'=>'Error occur may be somethig wrong.');
			}else {
				if ( $results->cnt == 0 ) {
					$result = array('error'=>'There is no list in your account.');
				}
				else {

					foreach ($results->rows as $solo_list){
						$list_key = $solo_list->id;
						$list_name = $solo_list->name;
						$list[$list_key] = $list_name;
					}
					$result['list'] = $list;
				}
			}
		}
		
		if($action === 'subsCribe'){
			$result = array('error'=>'Subscribe was unsuccessful. Please try again in 15 minutes...');
			$url = $apikey['api_url'];
			$api_key = $apikey['api_key'];
			$listID = $_POST['listid'];

			$params = array(
				'api_key'      => $api_key,
				'api_action'   => 'contact_add',
				'api_output'   => 'json'
			);

			if (!empty($_POST['name']))
			{
				$fname = $_POST['name'];
			}
			else {
				$fname = '';
			}

			$post = array(
				'email'                    => $_POST['email'],
				'first_name'               => $fname,
				'tags'                     => 'api',
				'p[1]'                   => $listID,
				'status[1]'              => 1,
				'instantresponders[123]' => 1
			);

			$query = "";
			foreach( $params as $key => $value ) $query .= $key . '=' . urlencode($value) . '&';
			$query = rtrim($query, '& ');

			$data = "";
			foreach( $post as $key => $value ) $data .= $key . '=' . urlencode($value) . '&';
			$data = rtrim($data, '& ');

			$url = rtrim($url, '/ ');

			$api = $url . '/admin/api.php?' . $query;

			$request = curl_init($api);
			curl_setopt($request, CURLOPT_HEADER, 0);
			curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($request, CURLOPT_POSTFIELDS, $data);
			curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);
			$response = (string)curl_exec($request);
			curl_close($request);

			if ( $response ) {
				$results = json_decode($response);
				if( $results->result_code != 0) {
					$result = array('success'=>'We\'ve received your message! We\'ll get back to you soon.');
				}
			}
		}
		
		return $result;
	}
	
	public function GoToWebinar( $apikey, $action ){
		require_once  'GoToWebinar/citrix.php';
		
		if($action === 'getList'){
			$citrix = new Citrix($apikey['consumer_key']);
			$params = array();
			$params['consumer_key'] = $apikey['consumer_key'];
			$params['consumer_secret'] = $apikey['consumer_secret'];
			$params['user_id'] = $apikey['user_id'];
			$params['password'] = $apikey['password'];
			$organizer_key = '';
			
			if(!$organizer_key){

				$url = 'https://api.citrixonline.com/oauth/access_token?grant_type=password&user_id='.$params['user_id'].'&password='.$params['password'].'&client_id='.$params['consumer_key'];
				$results = file_get_contents($url);
				if($results){
					$res = json_decode($results,true);

					$citrix->set_organizer_key($res['organizer_key']);
					$citrix->set_access_token($res['access_token']);

					$webinars = $citrix->citrixonline_get_list_of_webinars(1) ;

					$webinar_list = array();

					if(!isset($webinars['upcoming']['webinars']['errorCode'])){
						
						foreach($webinars['upcoming']['webinars'] as $webinar){
							$list[$webinar['webinarID']] = $webinar['subject'];
						}
						$result['list'] = $list;

					}else{
						$result = array('error'=>'There is no list in your account.');
					}

				}else{
					$result = array('error'=>'Error occur may be somethig wrong.');
				}
				
			}
		}
		
		if($action === 'subsCribe'){
			$citrix = new Citrix($apikey['consumer_key']);
			$params = array();
			$params['consumer_key'] = $apikey['consumer_key'];
			$params['consumer_secret'] = $apikey['consumer_secret'];
			$params['user_id'] = $apikey['user_id'];
			$params['password'] = $apikey['password'];
			
			try{
				$email = $_POST['email'];
				if (!empty($_POST['name']['fname'])){
					$fname = $_POST['fname'];
					$lname = $_POST['lname'];
				}else {
					$fname = '';
					$lname = '';
				}
				$listID = $_POST['listid'];
				$response = $citrix->citrixonline_create_registrant_of_webinar( $listID, array('first_name' => $fname, 'last_name' => $lname, 'email'=>$email));
				
				$result = array('success'=>'We\'ve received your message! We\'ll get back to you soon.');

			}catch (Exception $e) {
				$result = array('error'=>'Subscribe was unsuccessful. Please try again in 15 minutes...');
			}
		}
		
		return $result;
	}
	
	public function CampaignMonitor( $apikey, $action ){
		
		if($action === 'getList'){
			require_once  'CampaignMonitor/csrest_clients.php';
			$list = array();

			$wrap = new CS_REST_Clients($apikey["client_id"], $apikey["api_key"]);
			$cm_res = $wrap->get_lists();

			if ($cm_res->http_status_code != '200'){
				$result = array('error'=>'Error occur may be somethig wrong.');
			}else{

				if( count($cm_res->response) != 0 ){

					foreach ($cm_res->response as $solo_list){
						$list[$solo_list->ListID] = $solo_list->Name;
					}
					$result['list'] = $list;
					
				}
				else {
					$result = array('error'=>'There is no list in your account.');
				}

			}
		}
		
		if($action == 'subsCribe'){
			require_once  'CampaignMonitor/csrest_subscribers.php';
			$key = $apikey["api_key"];
			$listID = $_POST['listid'];

			if(!empty($listID)){
				$wrap = new CS_REST_Subscribers($listID, $key);
			}

			$args = array(
				'EmailAddress' => $_POST['email'],
				'Resubscribe' => true
			);

			if (!empty($_POST['name'])){
				$args['name'] = $_POST['name'];
			}

			$res = $wrap->add($args);
			
			$result = array('success'=>'We\'ve received your message! We\'ll get back to you soon.');
		}
		
		return $result;
	}
	
	public function GetResponse( $apikey, $action ){
		
		//require_once  'GetResponse/jsonRPCClient.php';
		
		if($action === 'getList'){
			$list = array();
			
			//$api = new jsonRPCClient('http://api2.getresponse.com');
			$cURLConnection = curl_init();
			
			try{
				//$results = $api->get_campaigns($apikey["api_key"]);
				curl_setopt($cURLConnection, CURLOPT_URL, 'https://api.getresponse.com/v3/campaigns');
				curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, array(
					'X-Auth-Token:api-key '.$apikey["api_key"],
				));
				$alllists = curl_exec($cURLConnection);
				$list = json_decode($alllists,true);
				// print_r($list);die;
				if(isset($list['code']) && ($list['code'] == '1014' || $list['code'] == '1023') ){
					$result = array('error'=>$list['message']);
				}else{
					if( count($list) > 0 ) {
						foreach ($list as $v){
							$listData[$v['campaignId']] = $v['name'];
						}
						$result['list'] = $listData;
					}else {
						$result = array('error'=>'There is no list in your account.'); // When no list found
					}
				}
			}catch (Exception $e){
			   $result = array('error'=>'Error occur may be something wrong.'); // Invalid API key
			}
			curl_close($cURLConnection);
		}
		
		if($action == 'subsCribe'){
			try{
				$listID = $_POST['listid'];
				if(!empty($listID)){
					$args = array(
						'campaign' => array('campaignId'=>$listID),
						'email' => $_POST['email'],
						'dayOfCycle'=>0,
					);
				}

				if (!empty($_POST['name'])){
					$args['name'] = $_POST['name'];
				}
				                                                           
				$data_string = json_encode($args);                                                                                   
				$ch = curl_init('https://api.getresponse.com/v3/contacts');   
		                                                                                                                     
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(    
					'X-Auth-Token:api-key '.$apikey["api_key"],                                                                      
		    		'Content-Type: application/json',                                                                                
		    		'Content-Length: ' . strlen($data_string))                                                                       
				);                                                                                                                   
		                                                                                                                     
				$result = curl_exec($ch);
				$result = array('success'=>'We\'ve received your message! We\'ll get back to you soon.');

			}catch (Exception $e){ 
				//$result = $e;
				$result = array('error'=>'Subscribe was unsuccessful. Please try again in 15 minutes...');
			}
		}
		
		return $result;

		/* $api = new jsonRPCClient('http://api2.getresponse.com');
			try{
				$listID = $_POST['listid'];
				if(!empty($listID)){
					$args = array(
						'campaign' => $listID,
						'email' => $_POST['email'],
						'cycle_day'=>0,
					);
				}

				if (!empty($_POST['name'])){
					$args['name'] = $_POST['name'];
				}

				$api->add_contact($apikey["api_key"], $args);
				
				$result = array('success'=>'We\'ve received your message! We\'ll get back to you soon.');

			}catch (Exception $e){ 
				//$result = $e;
				$result = array('error'=>'Subscribe was unsuccessful. Please try again in 15 minutes...');
			}
		}
		
		return $result;*/
		
	}
	

	
	public function Aweber($apiDetail, $action){
	   // echo"<pre>";print_r($apiDetail);
	   // echo"<pre>";print_r($action);
	   // echo"<pre>";print_r($responder);
	   // die;
	    $clientID = $_SESSION['aw_clientid'];
	    $clientSecret = $_SESSION['aw_secret'];
	    $refreshToken = $_SESSION['refresh_token'];
	    
	    $result = $lists = [];
		$base64Token = base64_encode($clientID.':'.$clientSecret);
        // $refreshToken = $apiDetail['refresh_token'];
        $redirectUrl = base_url('auth/aweber_response');
        $query = "grant_type=refresh_token&refresh_token=$refreshToken&redirect_url=$redirectUrl";
        $response = curlRequest([
            "url" => "https://auth.aweber.com/oauth2/token?".$query,
            "method" => "POST",
            "header" => [
                "Authorization: Basic $base64Token"
            ]
        ]);
	    $resp = json_decode($response ,true);
    
        if(isset($resp['error'])){
            $result = array('error'=> $resp['error_description']);
        }else if(isset($resp['refresh_token'])){
            $refreshToken = $resp['refresh_token'];
            $access_token = $resp['access_token'];
			$getAccount = curlRequest([
				"url" => "https://api.aweber.com/1.0/accounts",
				"method" => "GET",
				"header" => [
					"accept: application/json",
					"authorization: Bearer $access_token"
				]
			]);
            
            $accountData = json_decode($getAccount, true);
            
            if(isset($accountData['error'])){
                $result = array('error'=> $accountData['error']['message']);
            }else{
                $accountId = $accountData['entries'][0]['id'];
			
				if($action == 'getList'){
					$getList = curlRequest([
						"url" => "https://api.aweber.com/1.0/accounts/".$accountId."/lists/",
						"method" => "GET",
						"header" => [
							"accept: application/json",
							"authorization: Bearer $access_token"
						]
					]);
					
					$getLists = json_decode($getList, true);
					if(isset($getLists['entries']) && !empty($getLists['entries'])){
						for($i=0; $i<sizeof($getLists['entries']); $i++){
							$lists[$getLists['entries'][$i]['id']] = $getLists['entries'][$i]['name'];
							$result['list'] = $lists;
						}
					}else {
						$result = array('error'=>'There is no list in your account.');
					}
				}

				if($action === "subsCribe") {
					$email = $_POST['email'];
					$listID = $_POST['listid'];
					$postdata = [
						"name" => $_POST['name'],
						"email" => $_POST['email'],
						"strict_custom_fields" => true,
						"tags" => [
							'slow',
							'fast',
							'lightspeed'
						]
					];
					
					// print_r(json_encode($postdata))
					$subscribed = curlRequest([
						"url" => "https://api.aweber.com/1.0/accounts/".$accountId."/lists/".$listID."/subscribers",
						"method" => "POST",
						"header" => [
							"Content-Type: application/json",
							"accept: application/json",
							"authorization: Bearer $access_token"
						],
						'data' => $postdata
					]);
                    
					$subscriber = json_decode($subscribed, true);
					
					if(isset($subscriber['error'])){
						$result = array('error'=>'Subscription was unsuccessful. Please try again in 15 minutes...');
					}else{
						$result = array('success'=>'We\'ve received your message! We\'ll get back to you soon.');
					}					
				}
				
				if(isset($result['error'])){
					return $result;
				}

				$CI = &get_instance();
				$checkAr = $CI->my_model->select_data([
					'field'=>'*',
					'table'=>'autoresponder use INDEX(m_id)', 
					'where'=> [
						'm_id' => $_SESSION['id'], 
						'mkey' => 'autoresponder'
					],
					'limit' => 1
				]);
				
				if(!empty($checkAr)){
					$data = $checkAr[0]['value'] != '' ? (array) json_decode( $checkAr[0]['value'] ):[];
					$data['AWeber'] = [
						'refresh_token' => $refreshToken
					];
				
					$checkUpdate = $CI->my_model->update_data([
						'table'=>'autoresponder use INDEX(m_id)', 
						'data'=> [
							'value' =>  json_encode($data) 
						], 
						'where'=> [
							'm_id' => $_SESSION['id'],
						],
						'limit' => 1
					]);
				}
            }
        }else{
            $result = array('error'=> 'Error occurred, Something went wrong.');
        }
		return $result;
	}
	
	public function iContact( $apikey, $action ){
		require_once   'iContact/iContactApi.php';
		
		$list = $result = array();
		
		if($action === 'getList'){
			iContactApi::getInstance()->setConfig(array(
				'appId' => $apikey['app_id'],
				'apiPassword' => $apikey['app_password'],
				'apiUsername' => $apikey['login_email']
			));
			$oiContact = iContactApi::getInstance();
			
			try{
				$icontact_res = $oiContact->getLists();

				if( count($icontact_res) > 0 ) {
					foreach ($icontact_res as $solo_list){
						$list[$solo_list->listId] = $solo_list->name;
					}
				}else{
					$result = array('error'=>'There is no list in your account.');
				}

			}catch (Exception $oException){
				$result = array('error'=>'Error occur may be somethig wrong.');
			}
			
			$result['list'] = $list;
		}
		
		if($action == 'subsCribe'){
			$result = array('error'=>'Subscribe was unsuccessful. Please try again in 15 minutes...');
			
			iContactApi::getInstance()->setConfig(array(
				'appId' => $apikey['app_id'],
				'apiPassword' => $apikey['app_password'],
				'apiUsername' => $apikey['login_email']
			));
			
			$email = $_POST['email'];
			$listID = $_POST['listid'];
			$oiContact = iContactApi::getInstance();

			if (!empty($_POST['name'])){
				$fname = $_POST['name'];
			}else {
				$fname = '';
			}

			$res1 = $oiContact->addContact($email, null, null, $fname , '' , null, null, null, null, null, null, null, null, null);
			if ($res1->contactId){
				if ($oiContact->subscribeContactToList($res1->contactId, $listID, 'normal')){
					$result = array('success'=>'We\'ve received your message! We\'ll get back to you soon.');
				}
			}
		}
		
		return $result;
	}
	
	public function SendReach( $apikey, $action ){
		$result = array();
		define('publicKey',$apikey['public_key']);
		define('privateKey',$apikey['private_key']);
		
		require_once  'SendReach/setup.php';
		
		if($action === 'getList'){
			$endpoint = new MailWizzApi_Endpoint_Lists();

			$response = $endpoint->getLists($pageNumber = 1, $perPage = 10);
			$body = $response->body;
			
			$list = array();
			$bool = false;

			foreach($body as $key=>$val) {
				if( $val != 'success' ) {
					if( $val['count'] > 0 ) {

						foreach( $val['records'] as $solo_rec ) {
							$list[$solo_rec['general']['list_uid']] = $solo_rec['general']['name'];
							$bool = true;
						}
						
					}
				}
			}
			
			if($bool == true){
				$result['list'] = $list;
			}else{
				$result = array('error'=>'There is no list in your account.');
			}			
		}
		
		if($action == 'subsCribe'){

			$email = $_POST['email'];
			$listID = $_POST['listid'];
			$fname = '';
			if (!empty($_POST['name'])){
				$fname = $_POST['name'];
			}
			$endpoint   = new MailWizzApi_Endpoint_ListSubscribers();
			$response   = $endpoint->create($listID, array(
				'EMAIL' => $email,
				'FNAME' => $fname,
				'LNAME' => '',
			));
			$response   = $response->body;
			//print_r($response);
			if ($response->itemAt('status') == 'success') {
				$result = array('success'=>'We\'ve received your message! We\'ll get back to you soon.');
			}elseif($response->itemAt('status') == 'error'){
				$er = $response->itemAt('error');
				$msg = 'Subscribe was unsuccessful. Please try again in 15 minutes...';
				if(!empty($er)){
					$msg = '';
					foreach($er as $k=>$v){
						$msg .= $k.' -- '.$v;
					}
				}
				$result = array('error'=>$msg);
			}
		}
		
		return $result;
	}
	
	public function ConstantContact( $apikey, $action ){
		require_once  'ConstantContact/class.cc.php';
		
		if($action === 'getList'){
			$cc = new cc($apikey['username'], $apikey['password']);

            $resultofcc = $cc->get_lists('lists');

            if ($resultofcc){
				
				if( count($resultofcc) > 0  ){
					
					foreach($resultofcc as $v){
						$list[$v['id']] = $v['Name'];
					}
					
					$result['list'] = $list;
					
				}else{
					$result = array('error'=>'There is no list in your account.');
				}
				
			}else{
				$result = array('error'=>'Error occur may be somethig wrong.');
			}
			
			return $result;
		}
		
		if($action == 'subsCribe'){
			$result = array('error'=>'Subscribe was unsuccessful. Please try again in 15 minutes...');
			$cc = new cc($apikey['username'], $apikey['password']);
			
			$email = $_POST['email'];
			$listID = $_POST['listid'];

			$contact_list = $_POST['listid'];
			$extra_fields = array();
			if (!empty($_POST['name'])){
				$extra_fields['FirstName'] = $_POST['name'];
			}

			$contact = $cc->query_contacts($email);
			//print_r($_POST);			
			if (!$contact){
				//print_r($_POST);
				$new_id = $cc->create_contact($email, $contact_list, $extra_fields);
				if ($new_id){
					$result = array('success'=>'We\'ve received your message! We\'ll get back to you soon.');
				}
			}
			
			return $result;
		}
	}
	
	public function Mailchimp( $apikey, $action ){
		
		require_once  'Mailchimp/MCAPI.class.php';
		
		if($action === 'getList'){
			$key = $apikey['api_key'];
			
			$MailChimp = new MailChimp($key);
			$retval = $MailChimp->get('lists', array('count'=>100));
			
			if(isset($retval['lists'])){
				if(!empty($retval['lists'])){
					for($i=count($retval['lists'])-1;$i>=0;$i--){
						$list[$retval['lists'][$i]['id']] = $retval['lists'][$i]['name'];
					}
					$result['list'] = $list;
				}else{
					$result = array('error'=>'There is no list in your account.');
				}
			}else{
				$result = array('error'=>'Error occur may be somethig wrong.');
			}
			
			return $result;
		}
		
		if($action == 'subsCribe'){
			$key = $apikey['api_key'];
			
			$MailChimp = new MailChimp($key);
			$listID = $_POST['listid'];
			
			// print_r($_POST);
			
			if($_POST['name']){
				$args = array('FNAME' => $_POST['name']);
			}else{
				$args = array();
			}
			
			if(!empty($listID)){
				$mdata = $MailChimp->post("lists/$listID/members", [
					'email_address' => $_POST['email'],
					'status'        => 'subscribed',
				]);
			}
			
			if ($MailChimp->success()) {
				if(!empty($args)){
					$subscriber_hash = $MailChimp->subscriberHash( $_POST['email'] );
					$MailChimp->patch("lists/$listID/members/$subscriber_hash", [
						'merge_fields' => $args
					]);
				}
				$result = array('success'=>'We\'ve received your message! We\'ll get back to you soon.');
			}elseif ($mdata['status'] == 400){
				if(!empty($args)){
					$subscriber_hash = $MailChimp->subscriberHash( $_POST['email'] );
					$mdata = $MailChimp->put("lists/$listID/members/$subscriber_hash", [
						'merge_fields' => $args
					]);
				}
				$result = array( 'error' => 'We\'ve received your message! We\'ll get back to you soon','status'=>'12' );
			}else{
				$result = array('error'=>$MailChimp->getLastError());
			}
						
			return $result;
			
		}
		
	}
	
	public function SendFox( $apikey, $action ){
	   // print_r($apikey);die;
		if($action === 'getList'){
			$list = array();
			$cURLConnection = curl_init();

			try{
				curl_setopt($cURLConnection, CURLOPT_URL, 'https://api.sendfox.com/lists');
				curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, array(
                    'Authorization: Bearer '.$apikey["access_token"]
				));
				$alllists = curl_exec($cURLConnection);
                $list = json_decode($alllists,true);
                if($list == ''){
					$result = array('error'=> 'Access Token is wrong, please check your access token to get list.');
				}else{
				    if( count($list['data']) > 0 ) {
					    foreach($list['data'] as $v){
							$listData[$v['id']] = $v['name'];
						}
						$result['list'] = $listData;
					}else {
						$result = array('error'=>'There is no list in your account.'); // When no list found
					}
				}
			}catch (Exception $e){
			   $result = array('error'=>$e->getMessage()); 
			   // Invalid API key
			}
			curl_close($cURLConnection);
		}
		
		if($action == 'subsCribe'){
			try{
				$listID = $_POST['listid'];
				$args = 'lists[]='.$listID.'&email='.$_POST['email'];
				if (!empty($_POST['name'])){
					$args .= '&first_name='.$_POST['name'];
				}
				                                                           
				// $data_string = json_encode($args);                                                                                   
				$ch = curl_init('https://api.sendfox.com/contacts');  
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");    
				curl_setopt($ch, CURLOPT_POSTFIELDS, $args);         
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                 
				curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Authorization: Bearer '.$apikey["access_token"] )
				);                                                                                                              
				$result = curl_exec($ch);
				$result = array('success'=>'We\'ve received your message! We\'ll get back to you soon.');

			}catch (Exception $e){ 
				//$result = $e;
				$result = array('error'=>'Subscribe was unsuccessful. Please try again in 15 minutes...');
			}
		}
		
		return $result;
	}
}