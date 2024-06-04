<div class="pxg_admin_content">
        <header class="pxg_header_wrapper">
            <div class="toggle-btn">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="pxg_header_heading">
                <h4><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_1')); ?></h4>
            </div>
        </header>
        <div class="pxg__inner_content pxg_profile_main">
            <div class="pxg_setting_wrapper_main">
                <div class="pxg_settng_menu_main"> 
                    <ul>
                        <?php if( $page_info['page_name'] == "admin_settings" ) { ?>
                            <li ><a href="javascript:;" class="tablinks active" data-country="payment-settings"><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_2')); ?></a></li>
                            <li ><a href="javascript:;" class="tablinks" data-country="email-settings">Configurações de e-mail</a></li>
                        <?php }else{ ?>
                            <li class="active" ><a href="javascript:;" class="tablinks active" data-country="auto-responder"><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_3')); ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="pxg_settings_tab_items">
                <?php if( $page_info['page_name'] == "admin_settings" ) { ?>
                    <!-- Payment Setings Start -->
                    <div id="payment-settings" class="tabcontent pxg_tabcontent_data pxg_payment_setting active">
                        <div class="pxg_responder_box">
                            <div data-target="pxg_responder_paypal_model" data-type="1" class="pxg_responders <?= (in_array('1', $payment_gateway) ? 'pxg_disconnect_paymentGateway active' : 'pxg_paymentGateway');?>">
                                <img src="<?= base_url() ?>assets/images/paypal-logo.png" alt="paypal-img">
                                <div class="reponder_action">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="6" height="7" fill="none" xmlns:v="https://vecta.io/nano">
                                        <path d="M5.931 5.843L3.882 3.786l2.054-2.03c.084-.084.084-.222 0-.306L5.352.863C5.311.822 5.256.801 5.198.801s-.112.023-.153.062L3.001 2.887.954.865C.913.824.859.802.801.802S.688.826.648.865l-.583.587c-.084.084-.084.222 0 .306l2.054 2.03L.071 5.843c-.041.041-.064.095-.064.153a.21.21 0 0 0 .064.153l.584.587c.042.042.097.064.153.064s.111-.02.153-.064l2.04-2.049 2.041 2.047c.042.042.097.064.153.064s.111-.02.153-.064l.584-.587c.041-.041.064-.095.064-.153s-.025-.111-.066-.151z" fill="#fff"/>
                                    </svg>
                                </div>
                            </div>
                            <div data-target="pxg_responder_rzpay_model" data-type="2" class="pxg_responders <?= (in_array('2', $payment_gateway) ? 'pxg_disconnect_paymentGateway active' : 'pxg_paymentGateway');?>">
                                <img src="<?= base_url() ?>assets/images/razorpay-logo.png" alt="<?php echo html_escape($this->lang->line('ltr_admin_settings_alt_1')); ?>razorpay-img">
                                <div class="reponder_action">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="6" height="7" fill="none" xmlns:v="https://vecta.io/nano">
                                        <path d="M5.931 5.843L3.882 3.786l2.054-2.03c.084-.084.084-.222 0-.306L5.352.863C5.311.822 5.256.801 5.198.801s-.112.023-.153.062L3.001 2.887.954.865C.913.824.859.802.801.802S.688.826.648.865l-.583.587c-.084.084-.084.222 0 .306l2.054 2.03L.071 5.843c-.041.041-.064.095-.064.153a.21.21 0 0 0 .064.153l.584.587c.042.042.097.064.153.064s.111-.02.153-.064l2.04-2.049 2.041 2.047c.042.042.097.064.153.064s.111-.02.153-.064l.584-.587c.041-.041.064-.095.064-.153s-.025-.111-.066-.151z" fill="#fff"/>
                                    </svg>
                                </div>
                            </div>
                            <div data-target="pxg_responder_stripe_model" data-type="3" class="pxg_responders <?= (in_array('3', $payment_gateway) ? 'pxg_disconnect_paymentGateway active' : 'pxg_paymentGateway');?>">
                                <img src="<?= base_url() ?>assets/images/stripe-logo.png" alt="stripe-img">
                                <div class="reponder_action">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="6" height="7" fill="none" xmlns:v="https://vecta.io/nano">
                                        <path d="M5.931 5.843L3.882 3.786l2.054-2.03c.084-.084.084-.222 0-.306L5.352.863C5.311.822 5.256.801 5.198.801s-.112.023-.153.062L3.001 2.887.954.865C.913.824.859.802.801.802S.688.826.648.865l-.583.587c-.084.084-.084.222 0 .306l2.054 2.03L.071 5.843c-.041.041-.064.095-.064.153a.21.21 0 0 0 .064.153l.584.587c.042.042.097.064.153.064s.111-.02.153-.064l2.04-2.049 2.041 2.047c.042.042.097.064.153.064s.111-.02.153-.064l.584-.587c.041-.041.064-.095.064-.153s-.025-.111-.066-.151z" fill="#fff"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Payment Setings Section End -->
                    <!-- Email Settings starts -->
                    <div id="email-settings" class="tabcontent pxg_tabcontent_data ">
                        <div class="pxg_responder_box">
                            <div data-target="pxg_responder_mandrill_model" data-type="1" class="pxg_responders <?= (!empty($mandrill_settings) ? 'pxg_disconnect_emailsetting active' : 'pxg_email_settings');?>">
                                <img src="<?= base_url() ?>assets/images/mandrill.png" alt="mandrillapp-img">
                                <div class="reponder_action">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="6" height="7" fill="none" xmlns:v="https://vecta.io/nano">
                                        <path d="M5.931 5.843L3.882 3.786l2.054-2.03c.084-.084.084-.222 0-.306L5.352.863C5.311.822 5.256.801 5.198.801s-.112.023-.153.062L3.001 2.887.954.865C.913.824.859.802.801.802S.688.826.648.865l-.583.587c-.084.084-.084.222 0 .306l2.054 2.03L.071 5.843c-.041.041-.064.095-.064.153a.21.21 0 0 0 .064.153l.584.587c.042.042.097.064.153.064s.111-.02.153-.064l2.04-2.049 2.041 2.047c.042.042.097.064.153.064s.111-.02.153-.064l.584-.587c.041-.041.064-.095.064-.153s-.025-.111-.066-.151z" fill="#fff"/>
                                    </svg>
                                </div>
                            </div>
                            <div data-target="pxg_responder_smtp_model" data-type="2" class="pxg_responders <?= (!empty($smtp_settings) ? 'pxg_disconnect_emailsetting active' : 'pxg_email_settings');?>">
                                <img src="<?= base_url() ?>assets/images/smtp.png" alt="smtp-img">
                                <div class="reponder_action">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="6" height="7" fill="none" xmlns:v="https://vecta.io/nano">
                                        <path d="M5.931 5.843L3.882 3.786l2.054-2.03c.084-.084.084-.222 0-.306L5.352.863C5.311.822 5.256.801 5.198.801s-.112.023-.153.062L3.001 2.887.954.865C.913.824.859.802.801.802S.688.826.648.865l-.583.587c-.084.084-.084.222 0 .306l2.054 2.03L.071 5.843c-.041.041-.064.095-.064.153a.21.21 0 0 0 .064.153l.584.587c.042.042.097.064.153.064s.111-.02.153-.064l2.04-2.049 2.041 2.047c.042.042.097.064.153.064s.111-.02.153-.064l.584-.587c.041-.041.064-.095.064-.153s-.025-.111-.066-.151z" fill="#fff"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Email Settings Ends -->
                <?php } else {  ?>
                    <!-- Auto Responder Setings Start -->
                    <div id="auto-responder" class="tabcontent pxg_tabcontent_data pxg_auto_responder_setting active">
                        <h4 class="pxg_responder_heading"><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_4')); ?></h4>
                        <div class="pxg_responder_box">
                        <?php
                        // 'Aweber',
                            $a_array = ['GetResponse', 'Mailchimp', 'ActiveCampaign', 'Sendlane', 'Sendiio', 'ConvertKit', 'ConstantContact' ];
                            for($i=0; $i<count($a_array); $i++){    
                                $selected = (in_array($a_array[$i], $autoresponders) ? 'pxg_disconnect_autoresponders active' : 'pxg_autoresponders');
                        ?>
                            <div class="pxg_responders  <?= $selected;?>" id="<?= strtolower($a_array[$i]); ?>" value="<?= $a_array[$i]; ?>" >
                                <img src="<?= base_url('assets/images/'.strtolower($a_array[$i]).'.png') ?>">
                                <div class="reponder_action">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="6" height="7" fill="none" xmlns:v="https://vecta.io/nano">
                                        <path d="M5.931 5.843L3.882 3.786l2.054-2.03c.084-.084.084-.222 0-.306L5.352.863C5.311.822 5.256.801 5.198.801s-.112.023-.153.062L3.001 2.887.954.865C.913.824.859.802.801.802S.688.826.648.865l-.583.587c-.084.084-.084.222 0 .306l2.054 2.03L.071 5.843c-.041.041-.064.095-.064.153a.21.21 0 0 0 .064.153l.584.587c.042.042.097.064.153.064s.111-.02.153-.064l2.04-2.049 2.041 2.047c.042.042.097.064.153.064s.111-.02.153-.064l.584-.587c.041-.041.064-.095.064-.153s-.025-.111-.066-.151z" fill="#fff"/>
                                    </svg>
                                </div>
                            </div>
                        <?php } ?>                            
                        </div>
                    </div>
                    <!-- Auto Responder Setings Section End -->
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="modal pxg_common_model pxg_responder_model fade" id="autoresponderModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="basicModal" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="basicModal"><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_5')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <img src="<?= base_url() ?>assets/images/cancel-icon.svg" alt="<?php echo html_escape($this->lang->line('ltr_admin_settings_alt_2')); ?>">
                    </button>
                </div>
                <div class="modal-body">
                    <form class="d-none" id="Mailchimp" data-posturl="ajax/autoresponder/Mailchimp" >
                        <div class="pxg_main_input">
                            <label><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_6')); ?></label>
                            <input class="pxg_custom_input require" type="text" placeholder="Chave API" name="apikey[api_key]" value="" data-error="A chave de API é obrigatória." >
                        </div> 
                        <div class="pxg_model_btn">
                            <a class="pxg_btn" data-action="submitMe" data-form="Mailchimp"><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_7')); ?></a>
                            <a class="pxg_btn pxg_cancel_button" data-bs-dismiss="modal"><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_8')); ?></a>
                        </div>                   
                        <p class="tb_info" ><a href="http://admin.mailchimp.com/account/api" target="_blank"><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_9')); ?></a></p>
                    </form>

                    <form class="d-none" id="GetResponse" data-posturl="ajax/autoresponder/GetResponse" >
                        <div class="pxg_main_input">
                            <label><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_10')); ?></label>
                            <input class="pxg_custom_input require" type="text" placeholder="Chave API" name="apikey[api_key]" value="" data-error="A chave de API é obrigatória." >
                        </div> 
                        <div class="pxg_model_btn">
                            <a class="pxg_btn" data-action="submitMe" data-form="GetResponse"><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_11')); ?></a>
                            <a class="pxg_btn pxg_cancel_button" data-bs-dismiss="modal"><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_12')); ?></a>
                        </div>                   
                        <p class="tb_info" ><a href="https://support.getresponse.com/faq/where-i-find-api-key" target="_blank"><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_13')); ?></a></p>
                    </form>

                    <form class="d-none" id="ActiveCampaign" data-posturl="ajax/autoresponder/ActiveCampaign" >
                        <div class="pxg_main_input">
                            <label><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_14')); ?></label>
                            <input class="pxg_custom_input require" type="text" placeholder="URL API" name="apikey[api_url]" value="" data-error="A URL da API é obrigatório." >
                        </div> 
                        <div class="pxg_main_input">
                            <label><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_15')); ?></label>
                            <input class="pxg_custom_input require" type="text" placeholder="Chave API" name="apikey[api_key]" value="" data-error="A chave de API é obrigatória." >
                        </div> 
                        <div class="pxg_model_btn">
                            <a class="pxg_btn" data-action="submitMe" data-form="ActiveCampaign"><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_16')); ?></a>
                            <a class="pxg_btn pxg_cancel_button" data-bs-dismiss="modal"><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_17')); ?></a>
                        </div>                   
                        <p class="tb_info" ><a href="http://www.activecampaign.com/help/using-the-api/" target="_blank"><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_18')); ?></a></p>
                    </form>

                    <form class="d-none" id="Sendlane" data-posturl="ajax/autoresponder/Sendlane" >
                        <div class="pxg_main_input">
                            <label><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_19')); ?></label>
                            <input class="pxg_custom_input require" type="text" placeholder="URL API" name="apikey[api_url]" value="" data-error="A URL da API é obrigatório." >
                        </div> 
                        <div class="pxg_main_input">
                            <label><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_20')); ?></label>
                            <input class="pxg_custom_input require" type="text" placeholder="Chave API" name="apikey[api_key]" value="" data-error="A chave de API é obrigatória." >
                        </div> 
                        <div class="pxg_main_input">
                            <label><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_21')); ?></label>
                            <input class="pxg_custom_input require" type="text" placeholder="Chave Hash" name="apikey[hash_key]" value="" data-error="O hash da API é obrigatório." >
                        </div> 
                        <div class="pxg_model_btn">
                            <a class="pxg_btn" data-action="submitMe" data-form="Sendlane"><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_22')); ?></a>
                            <a class="pxg_btn pxg_cancel_button" data-bs-dismiss="modal"><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_23')); ?></a>
                        </div>                   
                        <p class="tb_info" ><a href="https://help.sendlane.com/article/71-how-to-find-your-api-key-api-hash-key-and-subdomain" target="_blank"><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_24')); ?></a></p>
                    </form>

                    <form class="d-none" id="Sendiio" data-posturl="ajax/autoresponder/Sendiio" >
                        <div class="pxg_main_input">
                            <label><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_25')); ?></label>
                            <input class="pxg_custom_input require" type="text" placeholder="Insira o token" name="apikey[api_token]" value="" data-error="O token é obrigatório." >
                        </div> 
                        <div class="pxg_main_input">
                            <label><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_26')); ?></label>
                            <input class="pxg_custom_input require" type="text" placeholder="Chave secreta" name="apikey[api_secret]" value="" data-error="O segredo da API é obrigatório." >
                        </div> 
                        <div class="pxg_model_btn">
                            <a class="pxg_btn" data-action="submitMe" data-form="Sendiio"><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_27')); ?></a>
                            <a class="pxg_btn pxg_cancel_button" data-bs-dismiss="modal"><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_28')); ?></a>
                        </div>                   
                    </form>

                    <form class="d-none" id="ConvertKit" data-posturl="ajax/autoresponder/ConvertKit" >
                        <div class="pxg_main_input">
                            <label><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_29')); ?></label>
                            <input class="pxg_custom_input require" type="text" placeholder="Chave API" name="apikey[api_key]" value="" data-error="A chave de API é obrigatória." >
                        </div> 
                        <div class="pxg_main_input">
                            <label><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_30')); ?></label>
                            <input class="pxg_custom_input require" type="text" placeholder="Chave secreta" name="apikey[api_secret]" value="" data-error="A chave segreta da API é obrigatório." >
                        </div> 
                        <div class="pxg_model_btn">
                            <a class="pxg_btn" data-action="submitMe" data-form="ConvertKit"><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_31')); ?></a>
                            <a class="pxg_btn pxg_cancel_button" data-bs-dismiss="modal"><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_32')); ?></a>
                        </div>                   
                    </form>

                    <form class="d-none" id="ConstantContact" data-posturl="ajax/autoresponder/ConstantContact" >
                        <div class="pxg_main_input">
                            <label><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_33')); ?></label>
                            <input class="pxg_custom_input require" type="text" placeholder="Insira nome de usuário" name="apikey[username]" value="" data-error="Nome de usuário é obrigatório." >
                        </div> 
                        <div class="pxg_main_input">
                            <label><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_34')); ?></label>
                            <input class="pxg_custom_input require" type="text" placeholder="Digite a senha" name="apikey[password]" value="" data-error="A senha é obrigatória." >
                        </div> 
                        <div class="pxg_model_btn">
                            <a class="pxg_btn" data-action="submitMe" data-form="ConstantContact"><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_35')); ?></a>
                            <a class="pxg_btn pxg_cancel_button" data-bs-dismiss="modal"><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_36')); ?></a>
                        </div>  
                        <p class="tb_info" ><a href="https://www.constantcontact.com/signup.jsp" target="_blank"><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_37')); ?></a></p>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Auto Responder Settings Models Start -->
    <!-- Razorpay Start -->
    <div class="modal pxg_common_model pxg_responder_model fade" id="pxg_responder_rzpay_model" data-bs-keyboard="false" tabindex="-1" aria-labelledby="basicModal" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="basicModal"><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_38')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <img src="<?= base_url() ?>assets/images/cancel-icon.svg" alt="<?php echo html_escape($this->lang->line('ltr_admin_settings_alt_3')); ?>">
                    </button>
                </div>
                <div class="modal-body">
                    <form id="Razorpay" data-posturl="ajax/paymentIntegration/2" >
                        <div class="pxg_main_input">
                            <label><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_39')); ?></label>
                            <input class="pxg_custom_input require" type="text" placeholder="Chave da API" name="razorpaykey" value="" >
                        </div>
                        <div class="pxg_main_input">
                            <label><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_40')); ?></label>
                            <input class="pxg_custom_input require" type="text" placeholder="Chave secreta" name="razorpay_secretkey" value="" >
                        </div>
                        <div class="pxg_model_btn">
                            <a class="pxg_btn" data-action="submitMe" data-form="Razorpay"><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_41')); ?></a>
                            <a class="pxg_btn pxg_cancel_button" data-bs-dismiss="modal"><?php echo html_escape($this->lang->line('ltr_admin_settings_txt_42')); ?></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Razorpay End -->
    <!-- Stripe Start -->
    <div class="modal pxg_common_model pxg_responder_model fade" id="pxg_responder_stripe_model" data-bs-keyboard="false" tabindex="-1" aria-labelledby="basicModal" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="basicModal">Stripe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <img src="<?= base_url() ?>assets/images/cancel-icon.svg" alt="cancel-icon">
                    </button>
                </div>
                <div class="modal-body">
                    <form id="Stripe" data-posturl="ajax/paymentIntegration/3" >
                        <div class="pxg_main_input">
                            <label>Insira a chave pública</label>
                            <input class="pxg_custom_input require" type="text" placeholder="Chave pública" name="stripe_publishKey" value="" >
                        </div>
                        <div class="pxg_main_input">
                            <label>Insira a chave secreta</label>
                            <input class="pxg_custom_input require" type="text" placeholder="Chave secreta" name="stripe_secretkey" value="" >
                        </div>
                        <div class="pxg_main_input">
                            <label>Escolha a moeda</label>
                            <select class="pxg_custom_select js-select2 require"  data-error="A moeda é obrigatória" data-placeholder="Escolha a moeda" id="stripe_currency" name="stripe_currency" >
                                <?php foreach ($currency_list as $key => $value) { ?>
                                    <option value="<?= $value['short_code'] ?>"  ><?= $value['name'] ?></option>
                                <?php } ?>
                            </select>
                            <p style="color:#112650;font-size: 13px;line-height: 1.6;"><strong>Nota:</strong> Certifique-se de fornecer a moeda que pode ser aceita em sua conta stripe</p>
                        </div>
                        <div class="pxg_model_btn">
                            <a class="pxg_btn" data-action="submitMe" data-form="Stripe">Crie um novo</a>
                            <a class="pxg_btn pxg_cancel_button" data-bs-dismiss="modal">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Stripe End -->
    <!-- Paypal Start -->
    <div class="modal pxg_common_model pxg_responder_model fade" id="pxg_responder_paypal_model" data-bs-keyboard="false" tabindex="-1" aria-labelledby="basicModal" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="basicModal">Paypal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <img src="<?= base_url() ?>assets/images/cancel-icon.svg" alt="cancel-icon">
                    </button>
                </div>
                <div class="modal-body">
                    <form id="Paypal" data-posturl="ajax/paymentIntegration/1" >
                        <!-- <div class="pxg_main_input">
                            <label>Enter Account Name</label>
                            <input class="pxg_custom_input require" type="text" placeholder="Account Name" name="paypal_title" value="" >
                        </div> -->
                        <div class="pxg_main_input">
                            <label>Insira o ID do PayPal</label>
                            <input class="pxg_custom_input require" type="text" placeholder="ID do Paypal" name="paypalid" value="" >
                        </div>
                        <div class="pxg_main_input">
                            <label>Insira o ID do cliente</label>
                            <input class="pxg_custom_input require" type="text" placeholder="ID do cliente" name="client_id" value="" >
                        </div>
                        <div class="pxg_main_input">
                            <label>Insira o segredo do cliente</label>
                            <input class="pxg_custom_input require" type="text" placeholder="Segredo do cliente" name="client_secret" value="" >
                        </div>
                        <div class="pxg_model_btn">
                            <a class="pxg_btn" data-action="submitMe" data-form="Paypal">Crie um novo</a>
                            <a class="pxg_btn pxg_cancel_button" data-bs-dismiss="modal">Cancelar</a>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
    <!-- Paypal End -->
    <!-- Auto Responder Settings Models End -->
    
    <!-- Email Settings Models Starts -->
    <!-- Mandrill Start -->
    <div class="modal pxg_common_model pxg_responder_model fade" id="pxg_responder_mandrill_model" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mandrillModal" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mandrillModal">Detalhes do Mandrill</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <img src="<?= base_url() ?>assets/images/cancel-icon.svg" alt="cancel-icon">
                    </button>
                </div>
                <div class="modal-body">
                    <form id="mandrill-form" data-posturl="AdminAjax/addMandrillSettings" >
                        <div class="pxg_main_input">
                            <label>Mandrill Email</label>
                            <input class="pxg_custom_input require valid_email" data-error="Por favor insira o e-mail do mandril" type="text" placeholder="Digite o e-mail do mandrill" name="m_email" value="<?= isset($mandrill_settings['m_email'])?$mandrill_settings['m_email']:'' ?>" >
                        </div>
                        <div class="pxg_main_input">
                            <label>Mandrill Chave</label>
                            <input class="pxg_custom_input require" data-error="Por favor insira a chave do mandril" type="text" placeholder="Insira a chave do mandrill" name="m_key" value="<?= isset($mandrill_settings['m_key'])?$mandrill_settings['m_key']:'' ?>" >
                        </div>
                        <div class="pxg_model_btn">
                            <a class="pxg_btn" data-action="submitMe" data-form="mandrill-form">Salvar</a>
                            <a class="pxg_btn pxg_cancel_button" data-bs-dismiss="modal">Cancelar</a>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
    <!-- Mandrill End -->
    <!-- Smtp Start -->
    <div class="modal pxg_common_model pxg_responder_model fade" id="pxg_responder_smtp_model" data-bs-keyboard="false" tabindex="-1" aria-labelledby="smtpModal" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smtpModal">Detalhes SMTP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <img src="<?= base_url() ?>assets/images/cancel-icon.svg" alt="cancel-icon">
                    </button>
                </div>
                <div class="modal-body">
                    <form id="smtp-form" data-posturl="AdminAjax/addSmtpSettings" >
                        <div class="pxg_main_input">
                            <label>SMTP Host</label>
                            <input class="pxg_custom_input require" data-error="Por favor insira o host smtp" type="text" placeholder="Digite o nome do host smtp" name="s_host" value="<?= isset($smtp_settings['s_host'])?$smtp_settings['s_host']:'' ?>" >
                        </div>
                        <div class="pxg_main_input">
                            <label>Porta</label>
                            <input class="pxg_custom_input require" data-error="Por favor insira a porta smtp" type="text" placeholder="Insira a porta smtp" name="s_port" value="<?= isset($smtp_settings['s_port'])?$smtp_settings['s_port']:'' ?>" >
                        </div>
                        <div class="pxg_main_input">
                            <label>Nome de usuário</label>
                            <input class="pxg_custom_input require" data-error="Por favor insira o nome de usuário smtp" type="text" placeholder="Digite o nome de usuário smtp" name="s_username" value="<?= isset($smtp_settings['s_username'])?$smtp_settings['s_username']:'' ?>" >
                        </div>
                        <div class="pxg_main_input">
                            <label>Senha</label>
                            <input class="pxg_custom_input require" data-error="Por favor insira a senha smtp" type="password" placeholder="Digite a senha smtp" name="s_password" value="<?= isset($smtp_settings['s_password'])?$smtp_settings['s_password']:'' ?>" >
                        </div>
                        <div class="pxg_main_input">
                            <label>Criptografia</label>
                            <select class="pxg_custom_select js-select2"  data-error="A criptografia é necessária" data-placeholder="Selecione o tipo de criptografia" name="s_encryption" >
                                    <option >Auto</option>
                                    <option <?= isset($smtp_settings['s_encryption']) && $smtp_settings['s_encryption'] == 'tls' ? 'selected':'' ?> value="tls"  >Tls</option>
                                    <option <?= isset($smtp_settings['s_encryption']) && $smtp_settings['s_encryption'] == 'ssl' ? 'selected':'' ?> value="ssl"  >Ssl</option>
                            </select>
                            <p style="color:#112650;font-size: 13px;line-height: 1.6;"><strong>Nota:</strong> Verifique se o seu servidor suporta envio de e-mails. </p>
                        </div>
                        <div class="pxg_model_btn">
                            <a class="pxg_btn" data-action="submitMe" data-form="smtp-form">Salvar</a>
                            <a class="pxg_btn pxg_cancel_button" data-bs-dismiss="modal">Cancelar</a>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
    <!-- Smtp End -->
    <!-- Email Settings Models End -->

<div> 