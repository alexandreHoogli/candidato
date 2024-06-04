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
            <h4><?php echo html_escape($this->lang->line('ltr_admin_users_txt_1')); ?></h4>
        </div>
        <div class="pxg_hdr_right_content">
            <div class="pxg_hdr_rgt_inner_content">
                <div class="search_wrapper">
                    <input class="ad_datatableSearch" type="text" placeholder="Pesquise o item aqui">
                    <span class="search_icn">
                    <img src="<?= base_url() ?>assets/images/svg/search.svg" alt="<?php echo html_escape($this->lang->line('ltr_admin_users_alt_1')); ?>">
                    </span>
                </div>
                <a href="javascript:;" class="pxg_btn ppa_add_user" data-bs-toggle="modal" data-bs-target="#pxg_create_update_user_model" >
                    <?php echo html_escape($this->lang->line('ltr_admin_users_txt_2')); ?>
                </a>
            </div>
        </div>
    </header>
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
                                            <?php echo html_escape($this->lang->line('ltr_admin_users_txt_3')); ?>   
                                            </th>
                                            <th class="tb_name">
                                            <?php echo html_escape($this->lang->line('ltr_admin_users_txt_4')); ?>  
                                            </th>
                                            <th class="tb_email">
                                            <?php echo html_escape($this->lang->line('ltr_admin_users_txt_5')); ?>   
                                            </th>
                                            <th class="tb_email">
                                            Plano de usuário 
                                            </th>
                                            <th class="pxg_tb_date">
                                            <?php echo html_escape($this->lang->line('ltr_admin_users_txt_6')); ?>   
                                            </th>
                                            <th class="pxg_tb_date">
                                            <?php echo html_escape($this->lang->line('ltr_admin_users_txt_7')); ?>   
                                            </th>
                                            <th class="tb_action">
                                            <?php echo html_escape($this->lang->line('ltr_admin_users_txt_8')); ?>  
                                            </th>
                                        </tr>
                                        <!-- Table Th Row End -->
                                    </thead>
                                    <tbody>
                                    <?php $i =0; foreach ($page_info['data']['users_list'] as $key => $value) { ?>
                                        <!-- Table Row Start -->
                                        <tr>
                                            <td class="tb_sn">
                                                <?= ++$i ?>
                                            </td>
                                            <td>
                                                <p class="tb_name">
                                                    <?= $value['u_name'] ?>
                                                </p>
                                            </td>
                                            <td class="tb_email">
                                                <p>
                                                    <?= $value['u_email'] ?>
                                                </p>
                                            </td>
                                            <td class="tb_email">
                                                <p>
                                                    <?php $plan = checkPlanDetails($value['u_id']);
                                                    if( $plan['status'] != 0 ) { ?>
                                                        <span class="pxg_tb_plan">
                                                            <?= $plan['Plans_info'][0]['p_name'] ?>
                                                        </span>
                                                    <?php } else { ?>
                                                        -
                                                    <?php } ?>
                                                </p>
                                            </td>
                                            <td class="pxg_tb_date">
                                                <p><?= date('M d, Y', strtotime($value['u_purchaseddate'])) ?></p>
                                            </td>
                                            <td class="pxg_tb_switch">
                                                <label class="pxg_switch_toggle">
                                                    <input type="checkbox" class="pxg_switch_inpt" <?= $value['u_status'] == 1 ? 'checked' : '' ?> >
                                                    <span class="pxg_switch_slider ppa_active_inactive_user" data-uniq_id="<?= $value['u_id'] ?>" ></span>
                                                </label>
                                            </td>
                                            <td class="tb_action">
                                                <ul class="pxg_table_action">
                                                    <li>
                                                        <a class="pxg_edit_user ppa_edit_user" href="javascript:;" data-uniq_id="<?= $value['u_id'] ?>" >
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="#112650" xmlns:v="https://vecta.io/nano"><path d="M13.88.355a.77.77 0 0 0-1.094 0L6.908 6.233c-.093.088-.155.201-.196.325l-.96 3.205a.77.77 0 0 0 .196.769.76.76 0 0 0 .547.227.81.81 0 0 0 .222-.031l3.205-.96c.124-.041.237-.103.325-.196l5.878-5.878a.77.77 0 0 0 0-1.094L13.88.355zm1.698 6.998c-.428 0-.774.347-.774.774v5.161a1.29 1.29 0 0 1-1.29 1.29H3.192a1.29 1.29 0 0 1-1.29-1.29V2.966a1.29 1.29 0 0 1 1.29-1.29h5.161c.428 0 .774-.347.774-.774S8.781.128 8.353.128H3.192A2.84 2.84 0 0 0 .354 2.966v10.322c0 1.565 1.273 2.839 2.838 2.839h10.322c1.565 0 2.839-1.274 2.839-2.838V8.127c0-.427-.346-.774-.774-.774z"/></svg>
                                                                
                                                            <div class="tooltip_icon">
                                                            <?php echo html_escape($this->lang->line('ltr_admin_users_txt_9')); ?>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="pxg_delete_user pxg_circle_ad_list ppa_delete_user" href="javascript:;" data-uniq_id="<?= $value['u_id'] ?>" >
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="17" fill="none" xmlns:v="https://vecta.io/nano"><path d="M11.122 5.177H1.846c-.086 0-.172.016-.252.05s-.152.082-.212.144-.107.136-.138.217-.045.167-.042.253l.258 7.807c.025.667.307 1.297.788 1.76s1.122.721 1.789.72h4.895c.668 0 1.31-.259 1.791-.723s.762-1.096.786-1.764l.258-7.8c.003-.086-.011-.173-.042-.253s-.078-.154-.138-.217-.133-.111-.212-.144-.165-.05-.252-.05zm-5.546 7.871c0 .171-.068.335-.189.455s-.285.189-.455.189-.335-.068-.455-.189-.189-.285-.189-.455V7.56c0-.171.068-.335.189-.455s.285-.189.455-.189.335.068.455.189.189.285.189.455v5.488zm3.105 0c0 .171-.068.335-.189.455s-.285.189-.455.189-.335-.068-.455-.189-.189-.285-.189-.455V7.56c0-.171.068-.335.189-.455s.285-.189.455-.189.335.068.455.189.189.285.189.455v5.488zM11.972 2.6H9.975a.82.82 0 0 1-.818-.741A1.93 1.93 0 0 0 7.225.127H5.73a1.93 1.93 0 0 0-1.932 1.733.82.82 0 0 1-.818.741H.996c-.171 0-.335.068-.455.189s-.189.285-.189.455.068.335.189.455.285.189.455.189h10.95c.171 0 .335-.068.456-.189s.189-.285.189-.455-.068-.335-.189-.455-.285-.189-.456-.189h.026zm-6.879-.605c.016-.159.091-.307.21-.414s.274-.166.434-.165h1.507c.16-.001.315.058.434.165s.194.255.21.414a2.1 2.1 0 0 0 .161.605H4.932a2.1 2.1 0 0 0 .161-.605z" fill="#112650"/></svg>
                                                            <div class="tooltip_icon">
                                                            <?php echo html_escape($this->lang->line('ltr_admin_users_txt_10')); ?>  
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
            <!-- Pagination Start -->
                <div class="row">
                    <div class="col-lg-12">
                            <div class="pxg_table_pagination">
                            <div class="pxg_pagination_entries">
                                <p>Mostrando 01 de 10 de 100 entradas </p>
                            </div>
                            <div class="wpa_pagination_button">
                                <ul class="pagination">
                                    <li class=""><a href="#" class="page-link">Anterior</a></li>
                                    <li class=" page-item active"><a href="#" class="page-link">1</a></li>
                                    <li class=" page-item "><a href="#" class="page-link">2</a></li>
                                    <li class=" page-item "><a href="#" class="page-link">3</a></li>
                                    <li class=" page-item "><a href="#" class="page-link">4</a></li>
                                    <li class=" page-item "><a href="#" class="page-link">5</a></li>
                                    <li class=" page-item next disabled"><a href="#" class="page-link">Próximo</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- Pagination End -->
        </div>
        <!-- User Section End -->
    </div>
    <!-- Inner Content  End -->
</div>