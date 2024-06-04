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
            <h4><?php echo html_escape($this->lang->line('ltr_admin_plans_txt_1')); ?></h4>
        </div>
        <div class="pxg_hdr_right_content">
            <div class="pxg_hdr_rgt_inner_content">
                <div class="search_wrapper">
                    <input class="ad_datatableSearch" type="text" placeholder="Pesquise aqui">
                    <span class="search_icn">
                    <img src="<?= base_url() ?>assets/images/svg/search.svg" alt="<?php echo html_escape($this->lang->line('ltr_admin_plans_alt_1')); ?>">
                    </span>
                </div>
                <a href="javascript:;" class="pxg_btn ppa_add_plan" >
                <?php echo html_escape($this->lang->line('ltr_admin_plans_txt_2')); ?>
                </a>
            </div>
        </div>
    </header>
    <p style="color:#112650;font-size: 13px;line-height: 1.6;" >Nota: Não se esqueça de adicionar configurações de pagamento no menu Configurações.</p>
    <!-- Header End -->
    <!-- Inner Content Start -->
    <div class="pxg__inner_content">
        <!-- User Section Start -->
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
                                                <?php echo html_escape($this->lang->line('ltr_admin_plans_txt_3')); ?>
                                            </th>
                                            <th class="tb_name">
                                            <?php echo html_escape($this->lang->line('ltr_admin_plans_txt_4')); ?>
                                            </th>
                                            <th class="tb_email">
                                            <?php echo html_escape($this->lang->line('ltr_admin_plans_txt_5')); ?>
                                            </th>
                                            <th class="pxg_tb_status">
                                            <?php echo html_escape($this->lang->line('ltr_admin_plans_txt_6')); ?>
                                            </th>
                                            <th class="pxg_tb_date">
                                            <?php echo html_escape($this->lang->line('ltr_admin_plans_txt_7')); ?>
                                            </th>
                                            <th class="pxg_tb_date">
                                            <?php echo html_escape($this->lang->line('ltr_admin_plans_txt_8')); ?>
                                            </th>
                                            <th class="pxg_tb_date">
                                            <?php echo html_escape($this->lang->line('ltr_admin_plans_txt_9')); ?>
                                            </th>
                                            <th class="tb_action">
                                            <?php echo html_escape($this->lang->line('ltr_admin_plans_txt_10')); ?>
                                            </th>
                                        </tr>
                                        <!-- Table Th Row End -->
                                    </thead>
                                    <tbody>
                                    <?php $i =0; $interval = json_decode( PLANS_DURATION, true ); if( !empty($plans_list) ) foreach ($plans_list as $key => $value) { ?>
                                        <!-- Table Row Start -->
                                        <tr>
                                            <td class="tb_sn">
                                                <?= ++$i ?>
                                            </td>
                                            <td>
                                                <p class="tb_name">
                                                    <?= $value['p_name'] ?>
                                                </p>
                                            </td>
                                            <td class="tb_email">
                                                <p>
                                                    <?= $value['p_price'] ?>
                                                </p>
                                            </td>
                                            <td class="pxg_tb_status">
                                                <span class="pxg_tb_plan">
                                                    <?= $value['p_currency'] ?>
                                                </span>
                                            </td>
                                            <td class="tb_email">
                                                <p>
                                                    <?= $interval[ $value['p_interval'] ] ?>
                                                </p>
                                            </td>
                                            <td class="pxg_tb_switch">
                                                <label class="pxg_switch_toggle">
                                                    <input type="checkbox" class="pxg_switch_inpt" <?= $value['p_status'] == 1 ? 'checked' : '' ?> >
                                                    <span class="pxg_switch_slider ppa_active_inactive_plan" data-uniq_id="<?= $value['id'] ?>" ></span>
                                                </label>
                                            </td>
                                            <td class="pxg_tb_date">
                                                <p><?= date('d, m, Y', strtotime($value['date_created'])) ?></p>
                                            </td>
                                            <td class="tb_action">
                                                <ul class="pxg_table_action">
                                                    <li>
                                                        <a class="pxg_edit_user ppa_edit_plan" href="javascript:;" data-uniq_id="<?= $value['id'] ?>" >
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="#112650" xmlns:v="https://vecta.io/nano"><path d="M13.88.355a.77.77 0 0 0-1.094 0L6.908 6.233c-.093.088-.155.201-.196.325l-.96 3.205a.77.77 0 0 0 .196.769.76.76 0 0 0 .547.227.81.81 0 0 0 .222-.031l3.205-.96c.124-.041.237-.103.325-.196l5.878-5.878a.77.77 0 0 0 0-1.094L13.88.355zm1.698 6.998c-.428 0-.774.347-.774.774v5.161a1.29 1.29 0 0 1-1.29 1.29H3.192a1.29 1.29 0 0 1-1.29-1.29V2.966a1.29 1.29 0 0 1 1.29-1.29h5.161c.428 0 .774-.347.774-.774S8.781.128 8.353.128H3.192A2.84 2.84 0 0 0 .354 2.966v10.322c0 1.565 1.273 2.839 2.838 2.839h10.322c1.565 0 2.839-1.274 2.839-2.838V8.127c0-.427-.346-.774-.774-.774z"/></svg>
                                                                
                                                            <div class="tooltip_icon">
                                                                <?php echo html_escape($this->lang->line('ltr_admin_plans_txt_11')); ?>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="pxg_delete_user pxg_circle_ad_list ppa_delete_plan" href="javascript:;" data-uniq_id="<?= $value['id'] ?>" >
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="17" fill="none" xmlns:v="https://vecta.io/nano"><path d="M11.122 5.177H1.846c-.086 0-.172.016-.252.05s-.152.082-.212.144-.107.136-.138.217-.045.167-.042.253l.258 7.807c.025.667.307 1.297.788 1.76s1.122.721 1.789.72h4.895c.668 0 1.31-.259 1.791-.723s.762-1.096.786-1.764l.258-7.8c.003-.086-.011-.173-.042-.253s-.078-.154-.138-.217-.133-.111-.212-.144-.165-.05-.252-.05zm-5.546 7.871c0 .171-.068.335-.189.455s-.285.189-.455.189-.335-.068-.455-.189-.189-.285-.189-.455V7.56c0-.171.068-.335.189-.455s.285-.189.455-.189.335.068.455.189.189.285.189.455v5.488zm3.105 0c0 .171-.068.335-.189.455s-.285.189-.455.189-.335-.068-.455-.189-.189-.285-.189-.455V7.56c0-.171.068-.335.189-.455s.285-.189.455-.189.335.068.455.189.189.285.189.455v5.488zM11.972 2.6H9.975a.82.82 0 0 1-.818-.741A1.93 1.93 0 0 0 7.225.127H5.73a1.93 1.93 0 0 0-1.932 1.733.82.82 0 0 1-.818.741H.996c-.171 0-.335.068-.455.189s-.189.285-.189.455.068.335.189.455.285.189.455.189h10.95c.171 0 .335-.068.456-.189s.189-.285.189-.455-.068-.335-.189-.455-.285-.189-.456-.189h.026zm-6.879-.605c.016-.159.091-.307.21-.414s.274-.166.434-.165h1.507c.16-.001.315.058.434.165s.194.255.21.414a2.1 2.1 0 0 0 .161.605H4.932a2.1 2.1 0 0 0 .161-.605z" fill="#112650"/></svg>
                                                            <div class="tooltip_icon">
                                                                <?php echo html_escape($this->lang->line('ltr_admin_plans_txt_12')); ?>
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
            <!--//========Select Template According Plan Popup Start=========//-->
            <div class="modal pxg_common_model pxg_select_temp_according_plan fade" id="pxg_temp_plan_model" data-bs-keyboard="false" tabindex="-1" aria-labelledby="basicModal" aria-hidden="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="basicModal">Selecione modelos para o plano</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <img src="<?= base_url() ?>assets/images/cancel-icon.svg" alt="cancel-icon">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-body-filter">
                                <div class="filter_search_wrapper">
                                    <input type="text" id="search_temp_for_plan" placeholder="Pesquise o item aqui" autocomplete="off">
                                    <span class="filter_search_btn search_temp_in_popup">Procurar</span>
                                </div>
                                <div class="pxg_main_input">
                                    <label>Filtro</label>
                                    <select class="js-select2"  data-placeholder="Fitler templates" id="filter_plan_templates" >
                                        <option value="0"  >Todos os modelos</option>
                                        <option value="1"  >Atualmente em plano</option>
                                        <option value="2"  >Mostrar todos os selecionados</option>
                                    </select>
                                </div>
                                <div class="select-template-checkbox d-none">
                                    <div class="checkbox-card">
                                        <div class="checkbox">
                                            <input id="checkbox-id" class="" data-id="" type="checkbox">
                                            <label for="checkbox-id"></label>
                                        </div>
                                        <p>Selecionar tudo</p>
                                    </div>
                                </div>
                                <a class="pxg_btn "data-bs-dismiss="modal" aria-label="Close">Feito</a>
                            </div>

                            <div class="pxg_create_site nothing_found_elem_ d-none">
                                <div class="pxg_create_thumb">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.389in" height="1.278in">
                                        <path fill-rule="evenodd" opacity="0.8" fill="#7D809D" d="M94.994,83.269 L26.660,83.269 L19.820,90.122 C18.604,91.340 16.983,92.011 15.255,92.011 C13.528,92.011 11.906,91.340 10.691,90.122 C8.874,88.302 8.331,85.613 9.214,83.269 L5.006,83.269 C2.243,83.269 -0.004,81.017 -0.004,78.249 L-0.004,5.009 C-0.004,2.241 2.243,-0.011 5.006,-0.011 L47.751,-0.011 L56.423,5.781 L94.994,5.781 C97.757,5.781 100.004,8.033 100.004,10.801 L100.004,78.249 C100.004,81.017 97.757,83.269 94.994,83.269 ZM13.689,87.119 C14.104,87.535 14.660,87.764 15.255,87.764 C15.851,87.764 16.407,87.535 16.822,87.119 L34.820,69.085 C33.682,68.138 32.632,67.086 31.687,65.945 L13.689,83.978 C12.825,84.844 12.825,86.253 13.689,87.119 ZM50.000,69.675 C60.423,69.675 68.902,61.178 68.902,50.735 C68.902,40.292 60.423,31.795 50.000,31.795 C39.577,31.795 31.098,40.292 31.098,50.735 C31.098,61.178 39.577,69.675 50.000,69.675 ZM95.765,10.801 C95.765,10.375 95.419,10.029 94.994,10.029 L55.139,10.029 L46.468,4.236 L5.006,4.236 C4.581,4.236 4.235,4.583 4.235,5.009 L4.235,17.365 L95.765,17.366 L95.765,10.801 ZM95.765,21.613 L4.235,21.613 L4.235,78.249 C4.235,78.675 4.581,79.021 5.006,79.021 L12.641,79.021 L29.243,62.386 C27.252,58.837 26.202,54.820 26.202,50.735 C26.202,37.587 36.878,26.890 50.000,26.890 C63.122,26.890 73.798,37.587 73.798,50.735 C73.798,63.883 63.122,74.580 50.000,74.580 C45.923,74.580 41.914,73.528 38.372,71.533 L30.899,79.021 L94.994,79.021 C95.419,79.021 95.765,78.675 95.765,78.249 L95.765,21.613 ZM11.448,7.385 C13.453,7.385 15.084,9.019 15.084,11.028 C15.084,13.037 13.453,14.672 11.448,14.672 C9.443,14.672 7.811,13.037 7.811,11.028 C7.811,9.019 9.443,7.385 11.448,7.385 ZM21.425,7.385 C23.430,7.385 25.061,9.019 25.061,11.028 C25.061,13.037 23.430,14.672 21.425,14.672 C19.420,14.672 17.789,13.037 17.789,11.028 C17.789,9.019 19.420,7.385 21.425,7.385 ZM31.402,7.385 C33.407,7.385 35.039,9.019 35.039,11.028 C35.039,13.037 33.407,14.672 31.402,14.672 C29.397,14.672 27.766,13.037 27.766,11.028 C27.766,9.019 29.397,7.385 31.402,7.385 ZM84.920,11.942 C85.924,11.942 86.741,12.755 86.741,13.754 C86.741,14.753 85.924,15.566 84.920,15.566 C83.916,15.566 83.099,14.753 83.099,13.754 C83.099,12.755 83.916,11.942 84.920,11.942 ZM91.268,11.942 C92.272,11.942 93.089,12.755 93.089,13.754 C93.089,14.753 92.272,15.566 91.268,15.566 C90.264,15.566 89.447,14.753 89.447,13.754 C89.447,12.755 90.264,11.942 91.268,11.942 ZM50.000,40.042 C50.777,40.042 51.437,40.271 51.962,40.723 C52.508,41.194 52.797,41.850 52.797,42.620 L52.794,42.681 L52.766,42.989 L51.733,52.031 C51.677,52.555 51.491,52.969 51.177,53.268 C50.858,53.573 50.451,53.734 50.000,53.734 C49.549,53.734 49.142,53.573 48.823,53.267 C48.509,52.968 48.322,52.554 48.268,52.037 L48.267,52.031 L47.203,42.620 C47.203,41.850 47.492,41.194 48.038,40.723 C48.562,40.271 49.223,40.042 50.000,40.042 ZM50.000,55.880 C50.781,55.880 51.442,56.151 51.963,56.685 C52.479,57.216 52.741,57.878 52.741,58.654 C52.741,59.431 52.479,60.094 51.963,60.624 C51.442,61.158 50.782,61.429 50.000,61.429 C49.218,61.429 48.558,61.158 48.037,60.624 C47.521,60.094 47.259,59.431 47.259,58.654 C47.259,57.878 47.521,57.216 48.037,56.685 C48.559,56.151 49.219,55.880 50.000,55.880 Z"></path>
                                        </svg>
                                    </span>
                                </div>
                                <p>Nenhum modelo encontrado</p>
                            </div>
                            
                            <div class="pxg_template_list selct_temp_for_plan_container">
                                
                            </div>
                            <div class="pxg_model_btn">
                                <a class="pxg_btn load_more_temp_btn" data-offset="0" >Carregue mais</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--//========Select Template According Plan Popup End=========//-->
    <!-- Inner Content  End -->
</div>