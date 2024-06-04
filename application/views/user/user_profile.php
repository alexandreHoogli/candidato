<div class="pxg_admin_content">
    <!--Header Start-->
    <header class="pxg_header_wrapper">
        <div class="toggle-btn">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="pxg_header_heading">
            <h4><?php echo html_escape($this->lang->line('ltr_user_profile_txt_1')); ?></h4>
        </div>
    </header>
    <!--Header End-->
    <!--Inner Content Start-->
    <div class="pxg__inner_content pxg_profile_main">
        <!--Profile Section Start-->
        <div class="pxg_profile_wrapper_main">
        <form id="addupdateuserprofile_form" data-posturl="ajax/addUpdateUserProfile" >
            <div class="pxg_profile_banner">
                    <div class="pxg_user_profile">
                        <div class="profile_pic_wrapper">
                            <img class="profile_pic" id="display_profile_pic" src="<?= $this->session->userdata('profile_pic') ?>" alt="<?php echo html_escape($this->lang->line('ltr_user_profile_alt_1')); ?>">
                        </div>
                        <div class="p_image profile_img_upload d-none">
                            <label class="upload_button">
                                <span> <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="#fff" xmlns:v="https://vecta.io/nano"><path d="M10.162.887a.58.58 0 0 0-.821 0L4.932 5.295a.58.58 0 0 0-.147.244l-.72 2.404a.58.58 0 0 0 .147.577.57.57 0 0 0 .41.17c.054 0 .112-.008.166-.023l2.404-.72a.58.58 0 0 0 .244-.147l4.409-4.409a.58.58 0 0 0 0-.821L10.162.887zm1.273 5.248a.58.58 0 0 0-.581.581v3.871a.97.97 0 0 1-.968.968H2.145a.97.97 0 0 1-.968-.968V2.845a.97.97 0 0 1 .968-.968h3.871a.58.58 0 1 0 0-1.161H2.145A2.13 2.13 0 0 0 .017 2.845v7.741a2.13 2.13 0 0 0 2.129 2.129h7.741a2.13 2.13 0 0 0 2.129-2.129v-3.87a.58.58 0 0 0-.581-.581z"/></svg>
                                </span>
                                <input name="profile_pic" class="file_upload editable" type="file" onchange="validateImage(this, 10000, 10000)" accept="image/*" disabled="true" >
                            </label>
                        </div>
                    </div>
                    
                    <div class="profile_pic_button">
                        <h5><?php echo html_escape($this->lang->line('ltr_user_profile_txt_2')); ?></h5>
                        <a href="javascript:" class="profile_btn ppa_editProfileBtn"><?php echo html_escape($this->lang->line('ltr_user_profile_txt_3')); ?></a>
                    </div>
            </div>
            <div class="pxg_profile_details">
            
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="pxg_main_input">
                            <label><?php echo html_escape($this->lang->line('ltr_user_profile_txt_4')); ?></label>
                            <input class="pxg_custom_input require editable" data-error="Name is required" type="text" placeholder="Full Name" name="ppa_uname" value="<?= $this->session->userdata('username') ?>" autocomplete="off" disabled="true">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="pxg_main_input">
                            <label><?php echo html_escape($this->lang->line('ltr_user_profile_txt_5')); ?></label>
                            <input class="pxg_custom_input" type="text" placeholder="Email Address" name="name" value="<?= $this->session->userdata('email') ?>" autocomplete="off" disabled="true" >
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="pxg_main_input">
                            <label>Senha atual</label>
                            <input class="pxg_custom_input editable" type="password" placeholder="Senha atual" name="old_password" value="" autocomplete="off" disabled="true" >
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="pxg_main_input">
                            <label>Nova senha</label>
                            <input class="pxg_custom_input editable" type="password" placeholder="Nova senha" name="new_password" value="" autocomplete="off" disabled="true" >
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="pxg_main_input">
                            <label><?php echo html_escape($this->lang->line('ltr_user_profile_txt_6')); ?></label>
                            <input class="pxg_custom_input require editable" data-error="O número de contato é obrigatório" type="text" placeholder="Digite o número aqui" name="ppa_number" value="<?= $user_info['ppa_number'] ?>" autocomplete="off" disabled="true" >
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="pxg_main_input">
                            <label><?php echo html_escape($this->lang->line('ltr_user_profile_txt_7')); ?></label>
                            <input class="pxg_custom_input require editable"  data-error="Endereço é necessário" type="text" placeholder="Endereço aqui" name="ppa_address" value="<?= $user_info['ppa_address'] ?>" autocomplete="off" disabled="true" >
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                        <div class="pxg_main_input">
                            <label><?php echo html_escape($this->lang->line('ltr_user_profile_txt_8')); ?></label>
                            <input class="pxg_custom_input require editable" data-error="A cidade é obrigatória" type="text" placeholder="Cidade aqui" name="ppa_city" value="<?= $user_info['ppa_city'] ?>" autocomplete="off" disabled="true" >
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                        <div class="pxg_main_input">
                            <label><?php echo html_escape($this->lang->line('ltr_user_profile_txt_9')); ?></label>
                            <input class="pxg_custom_input require editable" data-error="O estado é obrigatório" type="text" placeholder="Estado aqui" name="ppa_state" value="<?= $user_info['ppa_state'] ?>" autocomplete="off" disabled="true" >
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                        <div class="pxg_main_input">
                            <label><?php echo html_escape($this->lang->line('ltr_user_profile_txt_10')); ?></label>
                            <input class="pxg_custom_input require editable" data-error="O CEP é obrigatório" type="text" placeholder="CEP aqui" name="ppa_zipcode" value="<?= $user_info['ppa_zipcode'] ?>" autocomplete="off" disabled="true" >
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                        <div class="pxg_select pxg_select_style_2">
                            <label><?php echo html_escape($this->lang->line('ltr_user_profile_txt_11')); ?></label>
                            <div class="select ">
                                <select class="pxg_custom_select js-select2 require"  data-error="O país é obrigatório" data-placeholder="Selecione o pais" id="ppa_profileCountrySelect2" data-disabled="true" name="ppa_country" disabled="true" >
                                    <option></option>
                                    <?php foreach ($countries_list as $key => $value) { ?>
                                        <option <?= $user_info['ppa_country'] == $value['name']? ' selecionado ' : '' ?> value="<?= $value['name'] ?>" ><?= $value['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 col-12 ppa_saveProfileBtn d-none">
                        <a href="javascript:" data-action="submitMe" data-form="addupdateuserprofile_form" class="pxg_btn">
                            <?php echo html_escape($this->lang->line('ltr_user_profile_txt_12')); ?>
                        </a>
                    </div>
                </div>
            </form>
            </div>
        </div>
        <!--Profile Section End-->
    </div>
    <!--Inner Content  End-->
</div>