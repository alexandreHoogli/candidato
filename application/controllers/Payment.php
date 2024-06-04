<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

    protected $browserResponse;
    protected $data;
    protected $user_id;

    public function __construct(){

        parent::__construct();
        checkLogin();
        $this->user_id = $this->session->userdata('user_id');
        $this->browserResponse = array('status'=>'error','message'=>'','redirect'=>'');
        $this->data = array('header_data' => [], 'footer_data' => [], 'page_info' => [], 'csrf' => $this->csrf_token);
    }

    function order_payment( $plan_id = '' ){

        if( $plan_id != '' ){
            
            $plan_id = base64_decode( $plan_id );

            $user_id = $this->session->userdata('user_id');
            $user_name = $this->session->userdata('username');
            $user_mail = $this->session->userdata('email');
    
            $user_phone = '';
    
            $get_plan = $this->Qdb->select_data('*', 'plans_list', array( 'id' => $plan_id ));
            $PaymentDetails = $this->Qdb->select_data('*', 'payment_integration' );

            if( !empty($get_plan) && !empty($PaymentDetails) ){

                $finalItemAmount = $get_plan[0]['p_price'];
                $CurrencyType    = $get_plan[0]['p_currency'];
                $item_number     = $get_plan[0]['id'];
                $plan_name       = $get_plan[0]['p_name'];
                $plan_description= $get_plan[0]['p_description'];
                $data_paypal = $data_rpay = $data_stripe = '';


                foreach ($PaymentDetails as $key => $value) {
                    $payData = json_decode($value['value'], true);
                    
                    if($value['key'] == '1'){

                        $Paypal_clientId          = $payData['client_id'];
                        $token                    = array('time' => time()+300, 'user_id' => $user_id ,'currency' => $CurrencyType, 'plan_id' => $item_number, 'amount' => $finalItemAmount);
                        $_SESSION['paypal_token'] = base64_encode(json_encode($token));
                        $data['paypal_currency']  = 'USD';

                        $data_paypal = '<script src="https://www.paypal.com/sdk/js?client-id='.$Paypal_clientId.'"></script>
                        <div id="paypal-button-container"></div>
                    
                        <script>
                            const baseurl = "'.base_url().'";
                            // Render the PayPal button using PayPal SDK
                            paypal.Buttons({
                                createOrder: function(data, actions) {
                                    // This function sets up the details of the transaction
                                    return actions.order.create({
                                        purchase_units: [{
                                            amount: {
                                                value: "'.$finalItemAmount.'" // Set the payment amount
                                            }
                                        }]
                                    });
                                },
                                onApprove: function(data, actions) {
                                    // This function captures the funds from the approved payment
                                    return actions.order.capture().then(function(details) {
                                        processStatus(true)
                                        $.ajax({
                                            url: baseurl+"payment/paypal_payment",
                                            type: "post",
                                            data: {
                                                resp: btoa(JSON.stringify(details)) , '.$this->data['csrf']['name'].': "'.$this->data['csrf']['hash'].'"'.'
                                            },
                                            success: function(results) {
                                                handleResponse(results)
                                            }
                                        });
                                    });
                                },
                                onError: function(err) {
                                    // Handle errors or failed transactions
                                    console.error("Error occurred:", err);
                                },
                                style: {
                                    layout: "vertical",
                                    tagline: "false", // Hides the PayPal tagline
                                    fundingicons: "false" // Hides the funding icons, including cards
                                }
                            }).render("#paypal-button-container"); // Render the PayPal button in the specified container
                        </script>';
                    }

                    elseif($value['key'] == '2'){
                        $razorpaykey        = $payData['razorpaykey'];
                        $razorpay_secretkey = $payData['razorpay_secretkey'];
                        $totalAmount        = $finalItemAmount;

                        if( $CurrencyType != 'INR' )
                            continue;

                        $order_data = $this->create_razorpay_order( $totalAmount, $razorpaykey, $razorpay_secretkey, $CurrencyType );

                        if( !$order_data )
                            continue;
                            
                        $data_rpay = '<script>const baseurl = "'.base_url().'"</script>
                            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                            <script>
                                $(document).on("click", "#razorpay_payment", function(){
                                    let options = {
                                        "key": "'.$razorpaykey.'",
                                        "amount": '.$totalAmount.',
                                        "name": "'.$user_name.'",
                                        "callback_url": "'.base_url('plans').'",
                                        "order_id": "'.$order_data['orderId'].'",
                                        "currency" : "'.$CurrencyType.'",
                                        "description" : "'.( trim(preg_replace('/\s+/', ' ', $plan_description)) ).'",
                                        "handler": function (response){ processStatus(true);  $.ajax({ url: baseurl+"payment/razorpay_payment", type: "post", data: { razorpay_payment_id: response.razorpay_payment_id , totalAmount : '.$totalAmount.' ,product_id : "'.$item_number.'", name : name, email :"'.$user_mail.'", user_id :"'.$user_id.'", mobile :"'.$user_phone.'", '.$this->data['csrf']['name'].': "'.$this->data['csrf']['hash'].'"'.'}, success: function(results) { handleResponse(results) } });},
                                        "theme": { "color": "#8fce35" }, 
                                        "prefill": { "name": "'.$user_name.'", "email": "'.$user_mail.'", "contact": "91"+"'.$user_phone.'" },
                                    };
                                    let rzp1 = new Razorpay(options);
                                    rzp1.open();
                                });
                            </script>';    
                        $data['rpay_currency'] = $CurrencyType;          
                         
                    }elseif($value['key'] == '3'){
                        $stripe_publishKey = $payData['stripe_publishKey'];
                        $stripe_secretkey  = $payData['stripe_secretkey'];
                        $stripe_currency   = isset($payData['stripe_currency'])? $payData['stripe_currency'] : 'USD';
                        $data['stripe_currency']   = $stripe_currency;
                        $_SESSION['stripeSession'] = $plan_name.'@#'.$finalItemAmount.'@#'.$item_number;
                        $data_stripe =
                        '<form action="'.base_url().'payment/stripe_checkout" method="POST" name="stripe_form" id="stripe_form">
                            <input type="hidden" name="'.$this->data['csrf']['name'].'" value="'.$this->data['csrf']['hash'].'" />
                            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="'.$stripe_publishKey.'" data-image="" data-name="'.$plan_name.'" data-description="'.$plan_description.'" data-amount="'.$finalItemAmount * 100 .'"data-locale="auto" data-currency="'.$stripe_currency.'" /></script>
                            <script>
                                document.getElementsByClassName("stripe-button-el")[0].style.display = \'none\';
                            </script>
                            <input type="submit" id="" class="checkout-btn raz-btn" value="Pay with Stripe" >
                        </form>';
                    }
                }
                
                $data['data_paypal'] = $data_paypal;
                $data['data_rpay']   = $data_rpay;
                $data['data_stripe'] = $data_stripe;

                if( empty( $data_paypal ) && empty( $data_rpay ) && empty( $data_stripe ) ){
                    redirect('plans');
                }

                $data['plan_detail'] = $get_plan[0];
                $this->load->helper('currency_helper'); 
                $cur_symbol = getCurrencySymbols();
                $data['display_price'] = (isset($cur_symbol[ $get_plan[0]['p_currency'] ])? $cur_symbol[ $get_plan[0]['p_currency'] ]: '') . $get_plan[0]['p_price']. '.00' ;

                $this->load->view('user/plans/checkout', $data);
            }
        }
    }

    /* Paypal response handle starts */
    function paypal_payment_status(){
        if( isset( $_SESSION['paypal_success'] ) ){
            $data['chargeJson'] =  $_SESSION['paypal_success'];   
            unset( $_SESSION['paypal_success'] );
            $this->load->view('user/plans/payment_success', $data);
        }else{
            $data['message'] = 'Session Expired!';
            $this->load->view('user/plans/payment_session_expired', $data);
        }
    }

    function paypal_payment(){
        $paypal_data = $this->input->post('resp');
        $paypal_data = json_decode( base64_decode( $paypal_data ), true );
        
        if( !isset($_SESSION['paypal_token']) )
            redirect('plans');

        // pixelpages created paypal token verification
        $token  = $_SESSION['paypal_token'];
        $token  = json_decode( base64_decode( $token ), true );
        $res_   = $this->checkPayPalToken( $token );
        unset( $_SESSION['paypal_token'] );
        
        // redirect url
        $this->browserResponse['redirect'] = '/payment/paypal_payment_status';

        if( !empty( $paypal_data ) ){
            // verify paypal returned data
            if( isset($paypal_data['id']) && isset( $paypal_data['status']) && isset($paypal_data['purchase_units'] ) ){
                if( $res_['status'] == 'success' ){

                    // verify paypal order id 
                    $checkOrderId = $this->verifyPaypalPayment( $paypal_data['id'] );
                    
                    if( $checkOrderId['status'] == 'success' ){
                        $date = date('Y-m-d H:i:s');
                        $post_data = json_encode($paypal_data);
                        
                        $addPayInte = $this->Qdb->insert_data(
                            'payment_info', [
                                'type'          => 0,
                                'customer_id'   => $token['user_id'],
                                'plan_id'       => $token['plan_id'],
                                'payment_data'  => $post_data,
                                'order_id'      => $token['plan_id'], 
                                'payment_status'=> (($paypal_data['status'] == 'COMPLETED')?  1 : 2), 
                                'created_on'    => $date,
                                'updated_on'    => $date,
                                'status'        => 1
                            ]
                        );
                        if($addPayInte && $paypal_data['status'] == 'COMPLETED'){
                            $this->browserResponse['status']    = 'success';
                            $this->browserResponse['message']   = 'Payment successfull';
                            $_SESSION['paypal_success']         = $paypal_data['id'];
                            $this->paymentConfirmationEmail( $token['plan_id'] ); 
                        }else{
                            $this->browserResponse['message'] = '. Payment status : '.$paypal_data['status'];
                        }
                    }else{
                        $this->browserResponse['message'] = $checkOrderId['message'];
                    }

                }else{
                    $this->browserResponse['message'] = '. '.$res_['message'];
                }
            }
        }else{
            $this->browserResponse['message'] .= '. Payment was not initiated!';
        }
        echo json_encode( $this->browserResponse );die();
    }

    private function verifyPaypalPayment($paypalOrderID){
        
        // get paypal client id and secret 
        $PaymentDetails = $this->Qdb->select_data('value', 'payment_integration', array('key' => 1, 'user_id' => 1) );
        if( empty( $PaymentDetails ) ){
            if( empty($PaymentDetails[0]['value']) )
                { return ['status' => 'error', 'message' => 'Order verification failed']; }
        }
            
        // Paypal Client Id and Secret
        $payData      = json_decode($PaymentDetails[0]['value'], true);
        $clientId     = isset($payData['client_id']) ? $payData['client_id'] : '';
        $clientSecret = isset($payData['client_secret']) ? $payData['client_secret'] : '';

        // Set up PayPal API credentials and endpoint
        $apiEndpointLive    = 'https://api.paypal.com';
        $apiEndpointSandbox = 'https://api-m.sandbox.paypal.com';
        $tokenEndpoint = '/v1/oauth2/token';
        $orderEndpoint = '/v2/checkout/orders/' . $paypalOrderID;

        $apiEndpoint = $apiEndpointLive;

        // Obtain an access token for PayPal API
        $auth = base64_encode($clientId . ':' . $clientSecret);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $apiEndpoint . $tokenEndpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept: application/json',
            'Accept-Language: en_US',
            'Authorization: Basic ' . $auth
        ));

        $response = curl_exec($ch);
        $resp = json_decode($response);

        if( !isset( $resp->access_token ) ){

            $apiEndpoint = $apiEndpointSandbox;
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $apiEndpoint . $tokenEndpoint);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Accept: application/json',
                'Accept-Language: en_US',
                'Authorization: Basic ' . $auth
            ));

            $response = curl_exec($ch);
        }
        
        $accessToken = json_decode($response)->access_token;

        // Verify the order using PayPal API
        curl_setopt($ch, CURLOPT_URL, $apiEndpoint . $orderEndpoint);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $accessToken
        ));

        $response = curl_exec($ch);
        $orderDetails = json_decode($response, true);

        // Process $orderDetails to verify the payment status and other details
        if ($orderDetails['status'] === 'COMPLETED') {
            // Order is completed, proceed with your logic
            return ['status' => 'success', 'message' => 'Order verified'];
        } else {
            // Order is not completed or has an issue
            return ['status' => 'error', 'message' => 'Order verification failed'];
        }

        curl_close($ch);
    }

    private function checkPayPalToken($token, $player_id = ''){
        if( isset( $token['time'] ) && isset( $token['currency'] ) && isset( $token['plan_id'] ) && isset( $token['amount'] ) && isset( $token['user_id'] ) ){
            $this->browserResponse['status'] = 'success';
            $this->browserResponse['message'] = 'Payment successfull';
        }
        else{
            // token expired
            $this->browserResponse['status'] = 'error';
            $this->browserResponse['message'] = 'Session was not set correctly';
        }
        return $this->browserResponse;
    }
    /* Paypal response handle ends */

    function cancelled_payment(){
        echo 'Transaction failed please try again !';
                
    } 
    
    /* Razorpay response handle starts */
    private function create_razorpay_order($amount, $keyId, $keySecret, $currency){
        // Load Razorpay API library
        require_once APPPATH. "third_party/razor-pay/Razorpay.php";

        // Create an instance of Razorpay API with your key ID and key secret
        $api = new \Razorpay\Api\Api($keyId, $keySecret);

        // Create an order
        $order = $api->order->create(array(
            'amount' => $amount * 100, // Convert amount to paise (currency's smallest unit)
            'currency' => $currency, // Change currency as per your requirement
            'receipt' => 'receipt_'.$amount.'_'.time(), // Unique receipt identifier
            // Add other required parameters
        ));

        // Get the order ID
        if( !isset( $order['id'] ) )
            return false;

        $orderId = $order['id'];

        // Load payment form view with necessary data
        $data['orderId'] = $orderId;
        $data['keyId'] = $keyId;
        $data['amount'] = $amount * 100;

        return $data;
    }

    public function razorpay_payment(){
     
        if(isset($_POST['razorpay_payment_id'])) {
            $this->browserResponse['redirect'] = '/payment/payment_status';;

            $status = $this->verifyRazorPayId( $_POST['razorpay_payment_id'] );
            if( $status ){
                $date = date('Y-m-d H:i:s');
                $addPayInte = $this->Qdb->insert_data(
                    'payment_info', [
                        'type'          => '1',
                        'customer_id'   => $_POST['user_id'],
                        'plan_id'       => $_POST['product_id'],
                        'payment_data'  => json_encode($_POST),
                        'order_id'      => $_POST['product_id'], 
                        'payment_status'=> '1', 
                        'created_on'    => $date,
                        'updated_on'    => $date,
                        'status'        => 1
                    ]
                );
                
                if($addPayInte){
                    $this->paymentConfirmationEmail($_POST['product_id']); 
                    $this->browserResponse['status']   = 'success';
                    $this->browserResponse['message']  = $_SESSION['razorpay_success'] = 'Payment successfull';
                }
            }else{
                $this->browserResponse['status'] = 'error';
                $this->browserResponse['message'] = 'Invalid Payment'; 
            }

        }else{
            $this->browserResponse['status'] = 'error';
            $this->browserResponse['message'] = 'Payment cancelled';
        }
        echo json_encode($this->browserResponse);
    }

    public function payment_status(){
        if( isset( $_SESSION['razorpay_success'] ) ){
            $data['chargeJson'] =  $_SESSION['razorpay_success'];   
            unset( $_SESSION['razorpay_success'] );
            $this->load->view('user/plans/payment_success', $data);
        }else{
            $data['message'] = 'Session Expired!';
            $this->load->view('user/plans/payment_session_expired', $data);
        }
    }

    private function verifyRazorPayId($razorpayPaymentID){

        $rpay_data = $this->Qdb->select_data('value', 'payment_integration', array( 'key' => 2, 'user_id' => 1 ));
        if( empty($rpay_data) )
            return false;
        $rpay_data = json_decode($rpay_data[0]['value'], true);

        $keyId = $rpay_data['razorpaykey'];
        $keySecret = $rpay_data['razorpay_secretkey'];

        $apiEndpoint = 'https://api.razorpay.com/v1/payments/' . $razorpayPaymentID;

        // Set up authentication
        $auth = base64_encode($keyId . ':' . $keySecret);

        $ch = curl_init();

        // Verify the payment using Razorpay API
        curl_setopt($ch, CURLOPT_URL, $apiEndpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Basic ' . $auth,
        ]);

        $response = curl_exec($ch);
        $paymentDetails = json_decode($response);
        // Process $paymentDetails to verify the payment status and other details
        if ($paymentDetails->status === 'captured') {
            // Payment is captured and successful
            return true;
        } else {
            // Payment is not captured or has an issue
            return false;
        }

        curl_close($ch);
    }
    /* Paypal response handle ends */

    /* Stripe response handle starts */
    public function stripe_checkout(){
        require_once APPPATH. "third_party/stripe-php-master/init.php";
        try {
            if($_POST['stripeToken']){

                if(isset($_SESSION['stripeSession'])) {
                    $stripeSessionArr = explode('@#',$_SESSION['stripeSession']);

                    $a = $this->common->getStripeData(); 
                    
                    \Stripe\Stripe::setApiKey($a['stripe_secretkey']);
					
					$charge = \Stripe\Charge::create ([
						"amount" => $stripeSessionArr[1] * 100,
						"currency" => isset($a['stripe_currency'])?$a['stripe_currency']:'USD',
						"source" => $this->input->post('stripeToken'),
						"description" => "Payment for Plan ".$stripeSessionArr[0] ,
					]);
					
					$chargeJson = $charge->jsonSerialize();

                    if($chargeJson){

                        $name  =  $stripeSessionArr[0];
                        $price =  $stripeSessionArr[1];
                        $plan_id =  $stripeSessionArr[2];

                        $date = date('Y-m-d H:i:s');
                        $addPayInte = $this->Qdb->insert_data(
                            'payment_info',
                                [
                                'type'          => '3',
                                'customer_id'   => $this->user_id,
                                'payment_data'  => json_encode($chargeJson),
                                'order_id'      => $plan_id, 
                                'plan_id'       => $plan_id, 
                                'payment_status'=> '1', 
                                'created_on'    => $date,  
                                'updated_on'    => $date,
                                'status'    => 1
                                ]
                        );       
                        $this->paymentConfirmationEmail($plan_id);     
                        $data['chargeJson'] =  $chargeJson;   
                        $this->load->view('user/plans/payment_success', $data);
                    }
                }else {
                    $data['message'] = 'Session was not set correctly!';
                    $this->load->view('user/plans/payment_session_expired', $data);
                }
            }
            else {
                $data['message'] = 'Session was not set correctly!';
                $this->load->view('user/plans/payment_session_expired', $data);
            }
        }
        catch(Stripe_CardError $e) {
            $data['message'] = $e->getMessage() . '(a)';
            $this->load->view('user/plans/payment_session_expired', $data);
        }
        catch (Stripe_InvalidRequestError $e) {
            $data['message'] = $e->getMessage() . '(b)';
            $this->load->view('user/plans/payment_session_expired', $data);
        } catch (Stripe_AuthenticationError $e) {
            $data['message'] = $e->getMessage() . '(c)';
            $this->load->view('user/plans/payment_session_expired', $data);
        } catch (Stripe_ApiConnectionError $e) {
            $data['message'] = $e->getMessage() . '(d)';
            $this->load->view('user/plans/payment_session_expired', $data);
        } catch (Stripe_Error $e) {
            $data['message'] = $e->getMessage() . '(e)';
            $this->load->view('user/plans/payment_session_expired', $data);
        } catch (Exception $e) {
            $data['message'] = $e->getMessage() . '(f)';
            $this->load->view('user/plans/payment_session_expired', $data);
        }

    }
    /* Paypal response handle ends   */

    private function paymentConfirmationEmail($plan_id){

        
        $get_plan = $this->Qdb->select_data('*', 'plans_list', array( 'id' => $plan_id ));
        if( !empty( $get_plan ) ){
            
            $body = '<h1>Thank You for Your Purchase!</h1>';
    
            $body .='<p>Dear '.$this->session->userdata('u_name') .',</p>';
          
            $body .= '<p>We are thrilled to confirm your recent purchase of our subscription plan. Here are the details:</p>';
          
            $body .= '<table cellspacing="0" cellpadding="0" border="1">
                        <tr>
                            <th style="padding: 8px;">Plan</th>
                            <th style="padding: 8px;">Price</th>
                            <th style="padding: 8px;">Duration</th>
                        </tr>
                        <tr>
                            <td style="padding: 8px;">'.$get_plan[0]['p_name'].'</td>
                            <td style="padding: 8px;">'.$get_plan[0]['p_price']. ' '. $get_plan[0]['p_currency'].'</td>
                            <td style="padding: 8px;">'.$get_plan[0]['p_description'].'</td>
                        </tr>
                    </table>';
          
            $body .= '<p>Your payment has been successfully processed, and your subscription is now active.</p>';
          
            $body .= '<p>If you have any questions or need further assistance, feel free to contact our support team at '.$_SESSION['support_mail'].'.</p>';
          
            $body .= '<p>Thank you again for choosing our service!</p>';
          
            $body .= '<p>Best Regards,<br> '.$_SESSION['site_name'].'</p>';
    
            sendEmailToUser($this->session->userdata('u_email'),'Purchase Confirmation ( '.$get_plan[0]['p_name'].' ) - ['.$_SESSION['site_name'].']',$body);
        }
    }


}