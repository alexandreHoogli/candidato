<div class="pxg_admin_content">
                <!-- Header Start -->
                <header class="pxg_header_wrapper">
                    <div class="toggle-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="pxg_header_heading">
                        <h4><?php echo html_escape($this->lang->line('ltr_admin_profile_txt_1')); ?></h4>
                    </div>
                </header>
                <!-- Header End -->
                <!-- Inner Content Start -->
                <div class="pxg__inner_content pxg_profile_main">
                    <!-- Profile Section Start -->
                    <div class="pxg_profile_wrapper_main">
                    <form id="addupdateuserprofile_form" data-posturl="ajax/addUpdateUserProfile" >
                        <div class="pxg_profile_banner">
                                <div class="pxg_user_profile">
                                    <div class="profile_pic_wrapper">
                                        <img class="profile_pic" id="display_profile_pic" src="<?= $this->session->userdata('profile_pic') ?>" alt="<?php echo html_escape($this->lang->line('ltr_admin_profile_alt_1')); ?>">
                                    </div>
                                    <div class="p_image profile_img_upload d-none">
                                        <label class="upload_button">
                                            <span> <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="#fff" xmlns:v="https://vecta.io/nano"><path d="M10.162.887a.58.58 0 0 0-.821 0L4.932 5.295a.58.58 0 0 0-.147.244l-.72 2.404a.58.58 0 0 0 .147.577.57.57 0 0 0 .41.17c.054 0 .112-.008.166-.023l2.404-.72a.58.58 0 0 0 .244-.147l4.409-4.409a.58.58 0 0 0 0-.821L10.162.887zm1.273 5.248a.58.58 0 0 0-.581.581v3.871a.97.97 0 0 1-.968.968H2.145a.97.97 0 0 1-.968-.968V2.845a.97.97 0 0 1 .968-.968h3.871a.58.58 0 1 0 0-1.161H2.145A2.13 2.13 0 0 0 .017 2.845v7.741a2.13 2.13 0 0 0 2.129 2.129h7.741a2.13 2.13 0 0 0 2.129-2.129v-3.87a.58.58 0 0 0-.581-.581z"/></svg>
                                            </span>
                                            <input name="profile_pic" class="file_upload editable" type="file" onchange="validateImage(this, 300, 300)" accept="image/*" disabled="true" >
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="profile_pic_button">
                                    <h5><?php echo html_escape($this->lang->line('ltr_admin_profile_txt_2')); ?></h5>
                                    <a href="javascript:" class="profile_btn ppa_editProfileBtn"><?php echo html_escape($this->lang->line('ltr_admin_profile_txt_3')); ?></a>
                                </div>
                        </div>
                        <div class="pxg_profile_details">
                        
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="pxg_main_input">
                                        <label><?php echo html_escape($this->lang->line('ltr_admin_profile_txt_4')); ?></label>
                                        <input class="pxg_custom_input require editable" data-error="O nome é obrigatório" type="text" placeholder="Nome completo" name="ppa_uname" value="<?= $this->session->userdata('username') ?>" autocomplete="off" disabled="true">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="pxg_main_input">
                                        <label><?php echo html_escape($this->lang->line('ltr_admin_profile_txt_5')); ?></label>
                                        <input class="pxg_custom_input" type="text" placeholder="Endereço de email" name="name" value="<?= $this->session->userdata('email') ?>" autocomplete="off" disabled="true" >
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
                                        <label>Nova Senha</label>
                                        <input class="pxg_custom_input editable" type="password" placeholder="Nova Senha" name="new_password" value="" autocomplete="off" disabled="true" >
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="pxg_main_input">
                                        <label>Nome do site</label>
                                        <input class="pxg_custom_input editable"  data-error="O nome do site é obrigatório " type="text" placeholder="Nome do site aqui" name="site_name" value="<?= $_SESSION['site_name'] ?>" autocomplete="off" disabled="true" >
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="pxg_main_input">
                                        <label>Email de suporte</label>
                                        <input class="pxg_custom_input editable valid_email"  data-error="Email Obrigatório" type="email" placeholder="Insira o e-mail de suporte aqui" name="support_mail" value="<?= $_SESSION['support_mail'] ?>" autocomplete="off" disabled="true" >
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="pxg_main_input">
                                        <label>Logo do site</label>
                                        <label class="pxg_upload">
                                            <input data-error="site logo" type="file" onchange="$(this).siblings('p').text( $(this)[0].files[0].name )" name="site_logo"  class="d-none editable" disabled="true" >
                                            <span><?php echo html_escape($this->lang->line('ltr_admin_templates_txt_16')); ?></span>
                                            <p><?php echo html_escape($this->lang->line('ltr_admin_templates_txt_17')); ?></p>
                                        </label>
                                      </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="pxg_main_input">
                                        <label>Favicon do site</label>
                                        <label class="pxg_upload">
                                            <input data-error="site logo" type="file" onchange="$(this).siblings('p').text( $(this)[0].files[0].name )" name="site_favicon"  class="d-none editable" disabled="true" >
                                            <span><?php echo html_escape($this->lang->line('ltr_admin_templates_txt_16')); ?></span>
                                            <p><?php echo html_escape($this->lang->line('ltr_admin_templates_txt_17')); ?></p>
                                        </label>
                                      </div>
                                </div>
                                
                                
                                <div class="col-lg-12 col-12 ppa_saveProfileBtn d-none">
                                    <a href="javascript:" data-action="submitMe" data-form="addupdateuserprofile_form" class="pxg_btn">
                                    <?php echo html_escape($this->lang->line('ltr_admin_profile_txt_12')); ?>
                                    </a>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                    <!-- Profile Section End -->
                </div>
                <!-- Inner Content  End -->
            </div>