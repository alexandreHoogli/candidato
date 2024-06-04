<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Host extends CI_Controller {
    
    public function __construct(){
      parent::__construct();
    }

    public function index(){
      echo 'Nothing is here';
    }

    // get user site by keywords or hosting name
    public function getSite( $siteUniqName = '' ){
        if( $siteUniqName != '' ){
            $campaign_data = $this->Qdb->select_data( 'id,user_id,temp_id,custom_css,custom_js,template_html' , 'user_campaigns', array( 'campaign_host_name' => $siteUniqName ), 1 );
            if( !empty($campaign_data) ){
              checkPlanDetails( $campaign_data[0]['user_id'] );
              if( !in_array( $campaign_data[0]['temp_id'], $_SESSION['plan_templates'] ) )
                redirect('four-zero-four');
              
                $css = json_decode($campaign_data[0]['custom_css']);
                $js  = json_decode($campaign_data[0]['custom_js']);
                $id  = $campaign_data[0]['id'];

                if( file_exists( getcwd().'/'.$campaign_data[0]['template_html'] ) ){
									$template_html = file_get_contents( getcwd().'/'.$campaign_data[0]['template_html'] );
                  $template_html = str_replace(["</title>", 'custom.js"></script>'],['</title><style>'.$css.'</style>', 'custom.js"></script><script>'.$js."</script><script src='".base_url('assets/js/page_js/hosted_template.js')."'></script> <script type='text/javascript'>window.baseurl = '".base_url()."';</script><input id='temp_id' type='hidden' value='".$id."' /><input id='csrf_token' type='hidden' name='".$this->csrf_token['name']."' value='".$this->csrf_token['hash']."' />"], $template_html );
                  echo $template_html;
                }
								else{
                  $template_html = $campaign_data[0]['template_html'];
                  $template_html = str_replace(["</title>", 'custom.js"></script>'],['</title><style>'.$css.'</style>', 'custom.js"></script><script>'.$js."</script><script src='".base_url('assets/js/page_js/hosted_template.js')."'></script> <script type='text/javascript'>window.baseurl = '".base_url()."';</script><input id='temp_id' type='hidden' value='".$id."' /><input id='csrf_token' type='hidden' name='".$this->csrf_token['name']."' value='".$this->csrf_token['hash']."' />"], $template_html );
                  echo $template_html;
                }
            }
            else
              redirect('four-zero-four');
        }
        else
          redirect('four-zero-four');
  
    }

    public function fourZeroFour(){
      $this->load->view('auth/404_page');
    }

}