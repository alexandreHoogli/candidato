    </div>
        <!-- Main wrapper End -->
        <input id="csrf_token" type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
    
        <!-- Notification Start -->
        <div class="pxg_notification">
            <div class="pxg_notification_content">
                <div class="pxg_notification_icon ">
                    <img class="success d-none" src="<?= base_url() ?>assets/images/success.png">
                    <img class="error d-none" src="<?= base_url() ?>assets/images/oops.png">
                </div>
                <div class="pxg_notification_msg msg">
                    <h4></h4>
                    <p></p>
                </div>
                <div class="pxg_notification_close" onclick="$(this).closest('.pxg_notification').removeClass('success')" >
                    <a href="javascript:;"><img src="<?= base_url() ?>assets/images/cancel.svg"></a>
                </div>
            </div>
        </div>
        <!-- Notification End -->

        <!-- Modals Start -->
        <?php if( in_array($page_info['page_name'],array('admin_userslist')) ){ ?>
            <div class="modal pxg_common_model pxg_create_user_popup fade" id="pxg_create_update_user_model" data-bs-keyboard="false" tabindex="-1" aria-labelledby="basicModal" aria-hidden="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <form id="createupdateuser_form" data-posturl="AdminAjax/createUpdateUser">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title ppa_userAddUpdateModal" id="basicModal"><?php echo html_escape($this->lang->line('ltr_common_footer_txt_1')); ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <img src="<?= base_url() ?>assets/images/cancel-icon.svg" alt="<?php echo html_escape($this->lang->line('ltr_common_footer_alt_1')); ?>">
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="pxg_main_input">
                                    <label><?php echo html_escape($this->lang->line('ltr_common_footer_txt_2')); ?></label>
                                    <input class="pxg_custom_input require" data-error="Nome de usuário é requerido" type="text" placeholder="Digite o nome aqui" name="pps_name" value="" autocomplete="off">
                                </div>
                                <div class="pxg_main_input">
                                    <label><?php echo html_escape($this->lang->line('ltr_common_footer_txt_3')); ?></label>
                                    <input class="pxg_custom_input valid_email" data-error="O e-mail do usuário é obrigatório" type="email" placeholder="Digite o e-mail aqui" name="pps_email" value="" autocomplete="off">
                                </div>
                                <div class="pxg_main_input">
                                    <label><?php echo html_escape($this->lang->line('ltr_common_footer_txt_4')); ?></label>
                                    <input class="pxg_custom_input ppa_password_input" data-error="A senha do usuário é obrigatória" type="password" placeholder="Digite a senha aqui" name="pps_password_first" value="" autocomplete="new-password">
                                </div>
                                <div class="pxg_main_input ppa_confirm_pass_field">
                                    <label><?php echo html_escape($this->lang->line('ltr_common_footer_txt_5')); ?></label>
                                    <input class="pxg_custom_input ppa_password_input" data-error="A senha de confirmação do usuário é obrigatória" type="password" placeholder="Digite sua senha aqui" name="pps_password" value="" autocomplete="new-password">
                                </div>
                                <div class="pxg_main_input">
                                    <label>Planos de usuário</label>
                                    <select class="pxg_custom_select js-select2" data-placeholder="Selecione o plano" id="user_plan" name="user_plan" >
                                        <option value="0">Sem plano</option>
                                        <?php foreach ($page_info['data']['plans_list'] as $key => $value) { ?>
                                            <option value="<?= $value['id'] ?>"><?= $value['p_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="pxg_main_input">
                                    <label><?php echo html_escape($this->lang->line('ltr_common_footer_txt_6')); ?></label>
                                    <td class="pxg_tb_switch">
                                        <label class="pxg_switch_toggle">
                                            <input type="checkbox" name="ppa_send_creds" class="pxg_switch_inpt">
                                            <span class="pxg_switch_slider"></span>
                                        </label>
                                    </td>
                                </div>
                                <input type="hidden" name="pps_userid" value="" >
                                <div class="pxg_model_btn">
                                    <a class="pxg_btn" data-action="submitMe" data-form="createupdateuser_form"><?php echo html_escape($this->lang->line('ltr_common_footer_txt_7')); ?></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php } ?>
        <?php if( in_array($page_info['page_name'],array('admin_plans')) ){ ?>
            <div class="modal pxg_common_model pxg_create_user_popup fade" id="pxg_create_update_plan_model" data-bs-keyboard="false" tabindex="-1" aria-labelledby="basicModal" aria-hidden="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                            <form id="createupdateplan_form" data-posturl="AdminAjax/createUpdatePlan">
                            <div class="modal-header">
                                <h5 class="modal-title title_rename" id="basicModal"><?php echo html_escape($this->lang->line('ltr_common_footer_txt_8')); ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <img src="<?= base_url() ?>assets/images/cancel-icon.svg" alt="<?php echo html_escape($this->lang->line('ltr_common_footer_alt_2')); ?>">
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="pxg_main_input">
                                    <label><?php echo html_escape($this->lang->line('ltr_common_footer_txt_9')); ?></label>
                                    <input class="pxg_custom_input require" data-error="O nome do plano é obrigatório" type="text" placeholder="Digite o nome aqui" name="plan_name" value="" autocomplete="off">
                                </div>
                                <div class="pxg_main_input">
                                    <label><?php echo html_escape($this->lang->line('ltr_common_footer_txt_10')); ?></label>
                                    <select class="pxg_custom_select js-select2 require"  data-error="A moeda é obrigatória" data-placeholder="Escolha a moeda" id="plan_currency" name="plan_currency" >
                                        <?php foreach ($currency_list as $key => $value) { ?>
                                            <option value="<?= $value['short_code'] ?>"  ><?= $value['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="pxg_main_input">
                                    <label><?php echo html_escape($this->lang->line('ltr_common_footer_txt_11')); ?></label>
                                    <input class="pxg_custom_input ppa_password_input" data-error="O preço do plano é obrigatório" type="number" placeholder="Insira o preço aqui" name="plan_price" value="" autocomplete="new-price">
                                </div>
                                <div class="pxg_main_input">
                                    <label>Sites permitidos</label>
                                    <input class="pxg_custom_input require" data-error="O número de sites permitidos é obrigatório" type="number" placeholder="Número de sites permitidos no plano" name="sites_allowed" value="" autocomplete="sites-allowed">
                                </div>
                                <div class="pxg_main_input ppa_confirm_pass_field">
                                    <label><?php echo html_escape($this->lang->line('ltr_common_footer_txt_12')); ?></label>
                                    <select class="pxg_custom_select js-select2 require"  data-error="O intervalo é obrigatório" data-placeholder="Selecione Intervalo" id="plan_interval" name="plan_interval" >
                                        <option value="7" selected ><?php echo html_escape($this->lang->line('ltr_common_footer_txt_13')); ?></option>
                                        <option value="31"><?php echo html_escape($this->lang->line('ltr_common_footer_txt_14')); ?></option>
                                        <option value="365"><?php echo html_escape($this->lang->line('ltr_common_footer_txt_15')); ?></option>
                                    </select>
                                </div>
                                <div class="pxg_main_input">
                                    <label>Selecione modelos</label>
                                    <label class="pxg_upload select_templates_field">
                                        <div class="d-none pxg_main_input" >
                                            <select class="pxg_custom_select js-select2 notCloseOnSelect" multiple data-error="Selecione modelos para plano" data-placeholder="Selecione modelos" id="plan_t_select" name="plan_templates1[]" >
                                                <?php foreach ($templates_list as $key => $value) { ?>
                                                    <option value="<?= $value['id'] ?>"><?= $value['template_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <span>Navegar</span>
                                        <p id="selected_templates_num">Modelos selecionados - 0</p>
                                    </label>
                                </div>
                                <div class="pxg_main_input">
                                    <label><?php echo html_escape($this->lang->line('ltr_common_footer_txt_16')); ?></label>
                                    <textarea class="pxg_custom_input require" data-error="O campo de descrição é obrigatório" name="plan_description" ></textarea>
                                    <input type="hidden" name="plan_id" value="">
                                </div>
                                <input type="hidden" name="pps_userid" value="" >
                                <div class="pxg_model_btn">
                                    <a class="pxg_btn action_rename" data-action="submitMe" data-form="createupdateplan_form"><?php echo html_escape($this->lang->line('ltr_common_footer_txt_17')); ?></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>

        <!-- Confirm Modal Start -->
        <div class="modal pxg_common_model pxg_user_confirmation_modal fade" id="pxg_confirm_model" data-bs-keyboard="false" tabindex="-1" aria-labelledby="basicModal" aria-hidden="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <img src="<?= base_url() ?>assets/images/cancel-icon.svg" alt="<?php echo html_escape($this->lang->line('ltr_common_footer_alt_3')); ?>">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="pxg_delete_modal_section">
                                <div class="pxg_modal_img confirm_del_icon">
                                    <img src="<?= base_url() ?>assets/images/svg/delete.svg" alt="<?php echo html_escape($this->lang->line('ltr_common_footer_alt_4')); ?>">
                                </div>
                                <div class="pxg_delete_msg">
                                    <h4 id="conf_title" ></h4>
                                    <p id="conf_text" ></p>
                                    <div class="pxg_model_btn">
                                        <a id="conf_btn" class="pxg_btn"></a>
                                        <a class="pxg_btn pxg_btn_dark" data-bs-dismiss="modal"><?php echo html_escape($this->lang->line('ltr_common_footer_txt_18')); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Confrim Modal   End -->
        
        <!-- Modals End -->
    
        <script src="<?= base_url() ?>assets/js/jquery.min.js"></script> 
        <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script> 
        
        <?php if (in_array($page_info['page_name'],array())) {  ?>
            <script src="<?= base_url() ?>assets/plugin/animation/js/wow.min.js"></script>
        <?php } ?>
            
        <?php if (in_array($page_info['page_name'],array('admin_dashboard', 'admin_profile', 'admin_plans', 'u_dashboard', 'u_profile', 'admin_userslist', 'admin_settings', 'u_settings', 'u_sites_response', 'u_dfytemplates'))) {  ?>
            <script src='<?= base_url() ?>assets/plugin/select2/js/select2.full.js'></script>
        <?php } ?>

        <?php if (in_array($page_info['page_name'],array('admin_dashboard','u_dashboard'))) {  ?>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <?php } ?>

        <?php if (in_array($page_info['page_name'],array('admin_userslist', 'designer_templates', 'admin_plans', 'u_sites_response'))) {  ?>
            <script src="<?= base_url() ?>assets/plugin/datatable/datatables.min.js"></script>
            <script src="<?= base_url() ?>assets/plugin/datatable/responsive/dataTables.responsive.min.js"></script>
        <?php } ?>

        <?php if (in_array($page_info['page_name'],array('u_sites'))) {  ?>
            <script src="<?= base_url() ?>assets/plugin/jszip.min.js"></script>
            <script src="<?= base_url() ?>assets/plugin/FileSaver.js"></script>
        <?php } ?>
                
        <script src="<?= base_url() ?>assets/js/custom.js"></script> 
        
        <!-- ------------------- -->
        <?php if (in_array($page_info['page_name'],array('admin_userslist', 'admin_profile', 'admin_templates', 'admin_plans'))) {  ?>
            <script src="<?= base_url() ?>assets/js/page_js/admin.js"></script>
        <?php } ?>
        
        <?php if (in_array($page_info['page_name'],array('designer_templates', 'admin_templates'))) {  ?>
            <script src="<?= base_url() ?>assets/js/page_js/designer_zip.js"></script>
        <?php } ?>
        
        <?php if (in_array($page_info['page_name'],array('u_allplans'))) {  ?>
            <script src="<?= base_url() ?>assets/js/page_js/plans.js"></script>
        <?php } ?>
        
        <?php if (in_array($page_info['page_name'],array('u_dfytemplates', 'u_sites', 'u_sites_response'))) {  ?>
            <script src="<?= base_url() ?>assets/js/page_js/user_templates.js"></script>
        <?php } ?>
            
            
            
    </body>
</html>