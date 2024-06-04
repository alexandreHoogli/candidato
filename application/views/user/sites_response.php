<style>
.dataTables_info {
    display: none;
}    
</style>
<div class="pxg_admin_content">
    <!-- Header Start -->
    <header class="pxg_header_wrapper">
        <div class="toggle-btn">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="pxg_header_heading">
            <h4><?= $page_info['page_title'] ?></h4>
        </div>
        <div class="pxg_hdr_right_content">
            <div class="pxg_hdr_rgt_inner_content">
                <div class="search_wrapper">
                    <input class="ad_datatableSearch" type="text" placeholder="Pesquise aqui">
                    <span class="search_icn">
                    <img src="<?= base_url() ?>assets/images/svg/search.svg" alt="<?php echo html_escape($this->lang->line('ltr_admin_plans_alt_1')); ?>">
                    </span>
                </div>
            </div>
        </div>
    </header>
    <p class="d-none" style="color:#112650;font-size: 13px;line-height: 1.6;" >Nota: Não se esqueça de adicionar configurações de pagamento no menu Configurações.</p>
    <!-- Header End -->
    <!-- Inner Content Start -->
    <div class="pxg__inner_content">
        <!-- User Section Start -->
        <div class="pxg_table_filter_wrapper">
            <div class="row">
                <div class="col-md-8 col-sm-12 col-lg-8 col-xl-6">
                <div class="row">
                <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6">
                    <div class="pxg_select">
                        <h6 >Filtrar site</h6>
                        <div class="select ">
                            <select class="pxg_custom_select js-select2" id="select_site" data-placeholder="" >
                                        <option  value="all" >Todos</option>
                                        <?php foreach ($site_list as $key => $value) { ?>
                                            <option <?= ($site_id == $value['id']) ? 'selected': '' ?> value="<?= base64_encode( $value['id'] ) ?>" ><?= $value['campaign_host_name'] ?></option>
                                        <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6">
                    <div class="pxg_select">
                        <h6>Tipo de formulário de filtro</h6>
                        <div class="select ">
                            <select class="pxg_custom_select js-select2" id="select_form_type" data-placeholder="" >
                                <option  value="all" >Todos</option>
                                <option <?= ($form_type == 1) ? 'selected': '' ?> value="<?= base64_encode(1) ?>" >Inscrição</option>
                                <option <?= ($form_type == 2) ? 'selected': '' ?> value="<?= base64_encode(2) ?>" >Formulário de Contato</option>
                            </select>
                        </div>
                    </div>
                </div>
                </div>
                </div>
                <div class="col-md-4 col-sm-12 col-lg-4 col-xl-6 align-items-center row align-items-center pr-0" style="justify-content: flex-end; ">
                    <div class="pxg_right_table_filter chkLeads d-none">
                        <a href="javascript:;" class="pxg_btn generate_img">
                        Adicionar AR
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="pxg_user_table_main">
                <div class="row">
                    <div class="col-lg-12">
                    <!-- Table Start -->
                        <div class="pxg_table_wrapper">
                            <div class="table-responsive">
                                <table id="userTable" class="pxg_custom_table">
                                    <thead>
                                        <!-- Table Th Row Start -->
                                        <tr>
                                            <th class="tb_sn">
                                                <div class="checkbox ">
                                                    <input id="checkbox-one" class="aiw_select-all" type="checkbox">
                                                    <label for="checkbox-one"></label>
                                                </div>
                                            </th>
                                            <th class="tb_name">
                                                Nome do site
                                            </th>
                                            <th class="tb_email">
                                                Host
                                            </th>
                                            <th class="pxg_tb_status">
                                                E-mail do usuário
                                            </th>
                                            <th class="pxg_tb_date">
                                                Tipo de formulário
                                            </th>
                                            <th class="pxg_tb_date">
                                                Data de entrada
                                            </th>
                                            <th class="pxg_tb_date">
                                                Ações
                                            </th>
                                        </tr>
                                        <!-- Table Th Row End -->
                                    </thead>
                                    <tbody>
                                    <?php $i =0; if( !empty($data_list) ) foreach ($data_list as $key => $value) { $i++; ?>
                                        <!-- Table Row Start -->
                                        <tr>
                                            <td class="tb_sn">
                                                <div class="checkbox">
                                                    <input id="checkbox-two<?= $i ?>" class="leads_chk_box" data-id="<?= $value['id'] ?>" type="checkbox">
                                                    <label for="checkbox-two<?= $i ?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="tb_name">
                                                    <?= $value['template_name'] ?>
                                                </p>
                                            </td>
                                            <td class="tb_name">
                                                <p>
                                                    <?= $value['campaign_host_name'] ?>
                                                </p>
                                            </td>
                                            <td class="tb_name">
                                                <p>
                                                    <?= $value['user_email'] ?>
                                                </p>
                                            </td>
                                            <td class="tb_name">
                                                <?php if( $value['form_type'] == 1 ) { ?>
                                                    <span class="pxg_tb_plan ai_blog">
                                                        Solicitação de assinatura
                                                    </span>
                                                <?php }elseif( $value['form_type'] == 2 ){ ?>
                                                    <span class="pxg_tb_plan email_writer">
                                                        Requisição de contato
                                                    </span>
                                                <?php } ?>
                                            </td>
                                            <td class="pxg_tb_date">
                                                <p><?= date('d/m/Y', strtotime($value['date_added'])) ?></p>
                                            </td>
                                            <td class="tb_action">
                                                <ul class="pxg_table_action">
                                                    <li>
                                                        <a class="pxg_edit_user aiw_add_lead_to_ar" href="javascript:;" data-id="<?= $value['id'] ?>" >
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 512 512" xmlns:v="https://vecta.io/nano"><path d="M467 211H301V45c0-24.853-20.147-45-45-45s-45 20.147-45 45v166H45c-24.853 0-45 20.147-45 45s20.147 45 45 45h166v166c0 24.853 20.147 45 45 45s45-20.147 45-45V301h166c24.853 0 45-20.147 45-45s-20.147-45-45-45z"></path></svg>    
                                                            <div class="tooltip_icon">
                                                                Adicionar AR
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="pxg_delete_user pxg_circle_ad_list aiw_delete_record" href="javascript:;" data-id="<?= $value['id'] ?>" data-site-id="<?= $value['campaign_id'] ?>" >
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="17" fill="none" xmlns:v="https://vecta.io/nano"><path d="M11.122 5.177H1.846c-.086 0-.172.016-.252.05s-.152.082-.212.144-.107.136-.138.217-.045.167-.042.253l.258 7.807c.025.667.307 1.297.788 1.76s1.122.721 1.789.72h4.895c.668 0 1.31-.259 1.791-.723s.762-1.096.786-1.764l.258-7.8c.003-.086-.011-.173-.042-.253s-.078-.154-.138-.217-.133-.111-.212-.144-.165-.05-.252-.05zm-5.546 7.871c0 .171-.068.335-.189.455s-.285.189-.455.189-.335-.068-.455-.189-.189-.285-.189-.455V7.56c0-.171.068-.335.189-.455s.285-.189.455-.189.335.068.455.189.189.285.189.455v5.488zm3.105 0c0 .171-.068.335-.189.455s-.285.189-.455.189-.335-.068-.455-.189-.189-.285-.189-.455V7.56c0-.171.068-.335.189-.455s.285-.189.455-.189.335.068.455.189.189.285.189.455v5.488zM11.972 2.6H9.975a.82.82 0 0 1-.818-.741A1.93 1.93 0 0 0 7.225.127H5.73a1.93 1.93 0 0 0-1.932 1.733.82.82 0 0 1-.818.741H.996c-.171 0-.335.068-.455.189s-.189.285-.189.455.068.335.189.455.285.189.455.189h10.95c.171 0 .335-.068.456-.189s.189-.285.189-.455-.068-.335-.189-.455-.285-.189-.456-.189h.026zm-6.879-.605c.016-.159.091-.307.21-.414s.274-.166.434-.165h1.507c.16-.001.315.058.434.165s.194.255.21.414a2.1 2.1 0 0 0 .161.605H4.932a2.1 2.1 0 0 0 .161-.605z" fill="#112650"/></svg>
                                                            <div class="tooltip_icon">
                                                                Deletar
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="pxg_edit_user aiw_view_lead_response" data-resp="<?= base64_encode( $value['all_details'] ) ?>" href="javascript:;" >
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488.85 488.85" xmlns:v="https://vecta.io/nano"><path d="M244.425 98.725c-93.4 0-178.1 51.1-240.6 134.1-5.1 6.8-5.1 16.3 0 23.1 62.5 83.1 147.2 134.2 240.6 134.2s178.1-51.1 240.6-134.1c5.1-6.8 5.1-16.3 0-23.1-62.5-83.1-147.2-134.2-240.6-134.2zm6.7 248.3c-62 3.9-113.2-47.2-109.3-109.3 3.2-51.2 44.7-92.7 95.9-95.9 62-3.9 113.2 47.2 109.3 109.3-3.3 51.1-44.8 92.6-95.9 95.9zm-3.1-47.4c-33.4 2.1-61-25.4-58.8-58.8 1.7-27.6 24.1-49.9 51.7-51.7 33.4-2.1 61 25.4 58.8 58.8-1.8 27.7-24.2 50-51.7 51.7z"></path></svg>
                                                            <div class="tooltip_icon">
                                                                Ver resposta
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <!-- Table Row End -->
                                    <?php } ?>
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    <!-- Table End -->
                    </div>
                </div>
        </div>
        <!-- User Section End -->
    </div>
    <!-- Inner Content  End -->

    <!--//========Lead Response View Popup Start=========//-->
    <div class="modal pxg_common_model fade" id="pxg_response_view_model" data-bs-keyboard="false" tabindex="-1" aria-labelledby="basicModal" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="basicModal">Resposta do usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <img src="<?= base_url() ?>assets/images/cancel-icon.svg" alt="cancel-icon">
                    </button>
                </div>
                <div class="modal-body resp_container">
                        
                </div>
            </div>
        </div>
    </div>
    <!--//========Lead Response View  Popup End=========//-->
    
    <!--//======== AR Popup Start=========//-->
    <div class="modal pxg_common_model fade" id="pxg_add_lead_ar_model" data-bs-keyboard="false" tabindex="-1" aria-labelledby="basicModal" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="basicModal">Selecione Resposta automática</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <img src="<?= base_url() ?>assets/images/cancel-icon.svg" alt="cancel-icon">
                    </button>
                </div>
                <div class="modal-body">
                    <form id="ar_add_lead_form" data-posturl="Ajax/addLeadsToAR" >
                        <div class="pxg_main_input">
                            <select class="js-select2 fe_autoresponder_select require" data-error="Selecione qualquer AR" name="autoresponder_name">
                                <option value="">Selecione Resposta automática</option>
                                <?php if(!empty($connectedArList)){ foreach($connectedArList['connect_autoresponder'] as $soloconnectedAr){	?>
                                <option value="<?=$soloconnectedAr?>" > <?=$soloconnectedAr?></option>
                                <?php }} ?>
                            </select>
                        </div>
                        <div class="pxg_main_input">
                            <select class="js-select2 fe_autoresponderlist_select require" data-error="Selecione qualquer lista AR"  name="autoresponder_list">
                                <option value="">Selecione a lista</option>
                            </select>
                        </div>
                        <input type="hidden" id="rec_ids" name="record_ids" value="" >
                        <div class="pxg_model_btn">
                            <a class="pxg_btn" data-action="submitMe" data-form="ar_add_lead_form" >Adicionar AR</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--//======== AR Popup End=========//-->

</div>