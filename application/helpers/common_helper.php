<?php

function checkLogin(){
    $CI =& get_instance();
    $CI->load->helper('url');
    $CI->load->model('Qdb');
    if( !isset($_SESSION['site_logo'])  && !isset($_SESSION['site_name']) && !isset($_SESSION['site_favicon'] ) )
        unset( $_SESSION['logged_in']);

    if( !isset($_SESSION['logged_in']) ){
        redirect( 'login' );
        exit;
    }else{
        checkSiteSettings();
        $user_info = $CI->Qdb->select_data( 'u_id' , 'usertbl', array('u_id' =>  $_SESSION['user_id']));
        if( empty($user_info) ){
            unset( $_SESSION['logged_in']);
            redirect( 'login' );
            exit;
        }
    }
}

function createTemplateDirectory(){
    $user_id     = $_SESSION['user_id'];
    $upload_path = '/uploads/sites/user_'.$user_id.'/';
    $checkPath   = 'uploads/sites/user_'.$user_id.'/';

    if (!is_dir($checkPath)) {
        mkdir('.'.$upload_path, 0777, TRUE);
    }
    return $upload_path;
}

function checkSiteSettings(){
    $CI =& get_instance();
    $CI->load->model('Qdb');

    if( !isset( $_SESSION['site_logo'] ) || empty( $_SESSION['site_logo'] ) )
        $_SESSION['site_logo']    = 'assets/images/Logo.png';
    if( !isset( $_SESSION['site_name'] ) || empty( $_SESSION['site_name'] ) )
        $_SESSION['site_name']    = SITE_NAME;
    if( !isset( $_SESSION['site_favicon'] ) || empty( $_SESSION['site_favicon'] ) )
        $_SESSION['site_favicon'] = 'assets/images/favicon.png';
    if( !isset( $_SESSION['support_mail'] ) || empty( $_SESSION['support_mail'] ) )
        $_SESSION['support_mail'] = 'support@example.com';
    
    $site_settings = $CI->Qdb->select_data( 'site_logo,site_name,site_favicon,date_updated,mandrill_settings,smtp_settings,support_email' , 'site_settings', '', 1);
    if( !empty($site_settings) ){
        // set any session settings update date if not set 
        if( !isset( $_SESSION['date_update'] ) ) 
            $_SESSION['date_update'] = date('Y-m-d H:i:s');
        
        $site_data = $site_settings[0];
        
        // If session update date time is not same update the site settings in session
        if( $site_data['date_updated'] != $_SESSION['date_update'] ){
            $_SESSION['date_update']  = $site_data['date_updated'];
            $_SESSION['site_logo']    = empty($site_data['site_logo']) ? 'assets/images/Logo.png' : $site_data['site_logo'] ;
            $_SESSION['site_name']    = empty($site_data['site_name']) ? SITE_NAME : $site_data['site_name'] ;
            $_SESSION['site_favicon'] = empty($site_data['site_favicon']) ? 'assets/images/favicon.png' : $site_data['site_favicon'] ;
            $_SESSION['support_mail'] = empty($site_data['support_email']) ? '' : $site_data['support_email'] ;
            
            $mandrill = !empty($site_data['mandrill_settings']) ? json_decode($site_data['mandrill_settings'], true) : false;
            $_SESSION['mandrill_data'] = array( 
                'status'  => $mandrill, 
                'm_email' => isset( $mandrill['m_email'] ) ? $mandrill['m_email']: false, 
                'm_key'   => isset( $mandrill['m_key'] )   ? $mandrill['m_key']  : false
            );
            
            $smtp = !empty($site_data['smtp_settings']) ? json_decode($site_data['smtp_settings'], true) : false;
            $_SESSION['smtp_data'] = array( 
                'status'       => $smtp, 
                's_host'       => isset( $smtp['s_host'] )     ? $smtp['s_host']    : false,
                's_port'       => isset( $smtp['s_port'] )     ? $smtp['s_port']    : false,
                's_username'   => isset( $smtp['s_username'] ) ? $smtp['s_username']: false,
                's_password'   => isset( $smtp['s_password'] ) ? $smtp['s_password']: false,
                's_encryption' => isset( $smtp['s_encryption'] ) ? $smtp['s_encryption']: false,
            );

        }
    }
}

function sendEmailToUser($to, $subject, $body){

    if( isset( $_SESSION['mandrill_data'] ) && $_SESSION['mandrill_data']['status'] != false ){
        sendUserEmailMandrill($to, $subject, $body);
    }
    else if( isset( $_SESSION['smtp_data'] ) && $_SESSION['smtp_data']['status'] != false ){
        $data = $_SESSION['smtp_data'];
        sendUserEmailSmtp($body, ['email' => $to, 'subject' => $subject], $data);
    }
}

function sendUserEmailSmtp($htmldata, $mail, $data, $test = false, $attachments = array(), $replaces = array()){
    try{
        
        $config['protocol']     = 'mail';
        $config['smtp_user']    = $data['s_username'];
        $config['smtp_pass']    = $data['s_password'];
        $config['smtp_crypto']  = $data['s_encryption'];
        $config['smtp_host']    = $data['s_host'];
        $config['smtp_port']    = $data['s_port'];
        $config['mailtype']     ="html";
        $config['charset']      = "utf-8";
        $config['newline']      = "\r\n";
        $config['smtp_timeout'] = 30;
        $config['wordwrap']     = TRUE;
        $config['validate']     = FALSE;
    
    
        if(!empty($replaces)){
            foreach($replaces as $k=>$v){
                $htmldata = str_replace( $k, $v, $htmldata );
            }
        }

        $CI = get_instance();
        $CI->load->library('email');
        $CI->email->initialize($config);
        $CI->email->set_newline("\r\n");  
        $CI->email->from($data['s_username'], $_SESSION['site_name']);
        $CI->email->to($mail['email']);
        $CI->email->subject($mail['subject']);
        $CI->email->message($htmldata);
        
        if(!empty($attachments)){
                
            foreach($attachments as $attachment){
                $CI->email->attach($attachment['url']);
            }
        }
        
            $CI->email->send();	

        if( $test ){
            $msg = $CI->email->print_debugger();
            $status = empty( $msg )? 'success' : 'error';
            echo json_encode( ['status' => $status, 'message' => $msg, 'redirect' => ''] );exit;
        }
        return $CI->email->print_debugger();exit;
    }catch(Exception $e){
        return 'false';	
    }
    
}


function sendUserEmailMandrill($to='', $subject = '', $body = '', $test = false ){
    $tos[] = array(
        'email' => $to,
        'name' => '',
        'type' => 'to'
    );

    $message = array(
        'html' => $body,	
        'subject' => $subject,
        'from_email' => $_SESSION['mandrill_data']['m_email'],
        'from_name' => $_SESSION['site_name'],
        'to' =>$tos,
    ); 	   

    $POSTFIELDS = array(
        'key' => $_SESSION['mandrill_data']['m_key'],
        'message' => $message
    );
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://mandrillapp.com/api/1.0/messages/send.json');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POSTFIELDS));

    $headers = array();
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    curl_close($ch);

    if( $test ){
        echo $result;exit;
    }

    return $result;
}

function checkIsAdmin(){
    if($_SESSION['u_type'] != 1){
        $CI =& get_instance();
        $CI->load->helper('url');
        redirect( 'login' );
        exit;
    }
}

function checkIsDesigner(){
    if($_SESSION['u_type'] != 7){
        $CI =& get_instance();
        $CI->load->helper('url');
        redirect( 'login' );
        exit;
    }
}

function redirectLoggedInUser(){
    $u_type = $_SESSION['u_type'];
    $CI =& get_instance();
    $CI->load->helper('url');
    switch ($u_type) {
        case 1:
            redirect( 'admin/dashboard' );
            exit;
        case 2:
            redirect( 'dashboard' );
            exit;
        case 7:
            redirect( 'designer/templates' );
            exit;
        
        default:
            break;
    }
}


function checkPlanDetails( $user_id = '' ){
    $CI =& get_instance();
    $CI->load->helper('url');
    $CI->load->model('Qdb');

    if( $user_id == '' )
        $user_id =  $_SESSION['user_id'];

    $_SESSION['plan_templates']   = [];
    $_SESSION['plan_sites_count'] = 0;

    $get_plan = $CI->Qdb->select_data( 'plans_list.id,plans_list.p_name,p_interval,created_on,p_templates,p_sites' , 'payment_info', array('payment_info.customer_id' =>  $user_id, 'payment_info.payment_status' => 1, 'payment_info.status' => 1), 1, array( 'plans_list', 'plans_list.id = payment_info.plan_id' ), array('created_on', 'desc'));
    
    if( empty($get_plan) )
        return [ 'status' => 0, 'message' => 'Please purchase a plan to continue'];
    
    $get_days_passed = getDaysBetweenDates( date_create( $get_plan[0]['created_on'] ) , date_create( date('Y-m-d H:i:s') )  );
    
    if( $get_days_passed <= $get_plan[0]['p_interval'] ){
        $_SESSION['plan_templates']   = empty( $get_plan[0]['p_templates'] )? [] : json_decode( $get_plan[0]['p_templates'], true );
        $_SESSION['plan_sites_count'] = $get_plan[0]['p_sites'];
        return [ 'status' => 1, 'message' => 'Plan Exist', 'Plans_info' => $get_plan, 'remaining_days' => $get_plan[0]['p_interval'] - $get_days_passed, 'plan_id' => $get_plan[0]['id'] ];
    }
    else
        return [ 'status' => 0, 'message' => 'Plan Expired', 'Plans_info' => $get_plan ];
}

function checkPlanTemplates( $template_id ){
    if( in_array( $template_id, $_SESSION['plan_templates'] ) )
        return true;
    echo json_encode( ['status' => 'error', 'message' => 'This template is not available in your current plan.', 'redirect' => ''] );exit;
}

function checkSitesCount( $user_id = '' ){
    $CI =& get_instance();
    $CI->load->model('Qdb');
    
    if( $user_id == '' )
        $user_id = $_SESSION['user_id'];

    $user_sites = $CI->Qdb->aggregate_data( 'user_campaigns' , 'id', 'COUNT',array('user_id' =>  $user_id ));
    
    if( $user_sites < $_SESSION['plan_sites_count'] )
        return true;

    echo json_encode( ['status' => 'error', 'message' => 'Sites limit exceeded. You cannot create sites more than '.$_SESSION['plan_sites_count'], 'redirect' => ''] );exit;
}

/* function checkPlanTemplates( $template_id ){
    if( !isset( $_SESSION['plan_templates'] ) )
        return false;
    if( in_array( $template_id, $_SESSION['plan_templates'] ) )
        return true;
    return false;
} */

function getDaysBetweenDates( $date1, $date2 ){
    $diff=date_diff($date1,$date2);
    return $diff->format("%a");
}

function get7DaysDates($days, $format = 'd/m'){
    $m = date("m"); $de= date("d"); $y= date("Y");
    $dateArray = array();
    for($i=0; $i<=$days-1; $i++){
        $dateArray[] =  date($format, mktime(0,0,0,$m,($de-$i),$y)) ; 
    }
    return array_reverse($dateArray);
}

// Function to remove folders and files 
function rrmdir($dir) {
    if (is_dir($dir)) {
        $files = scandir($dir);
        foreach ($files as $file)
            if ($file != "." && $file != "..") rrmdir("$dir/$file");
        rmdir($dir);
    }
    else if (file_exists($dir)) unlink($dir);
}

// Function to Copy folders and files       
function rcopy($src, $dst) {
    if (file_exists ( $dst ))
        rrmdir ( $dst );
    if (is_dir ( $src )) {
        mkdir ( $dst );
        $files = scandir ( $src );
        foreach ( $files as $file )
            if ($file != "." && $file != "..")
                rcopy ( "$src/$file", "$dst/$file" );
    } else if (file_exists ( $src ))
        copy ( $src, $dst );
}

function copy_and_rename_folder($source, $destination, $newName) {
    if (is_dir($source)) {
        if (!is_dir($destination)) {
            mkdir($destination, 0777, true);
        }

        $files = scandir($source);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                $srcFile = $source . '/' . $file;
                $dstFile = $destination . '/' . $file;

                if (is_dir($srcFile)) {
                    copy_and_rename_folder($srcFile, $dstFile, $newName);
                } else {
                    copy($srcFile, $dstFile);
                }
            }
        }

        rename($destination, $newName);
        return true;
    }
    return false;
}

function searchKey($id, $index, $array) {
    foreach ($array as $key => $val) {
        if ($key === $id) {
            return $key;
        }
    }
    return null;
 }

 

?>