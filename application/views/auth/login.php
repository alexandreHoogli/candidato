       <!--Login Page Start-->
        <div class="pxg_login_main">
            <div class="pxg_auth_login_box">
                <div class="pxg_letf_auth_bg">
                    <div class="pxg_letf_auth">
                        <h3 class="wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms"><?php echo html_escape($this->lang->line('ltr_login_txt_1')); ?>
                        </h3>
                        <img src="<?= base_url() ?>assets/images/login-clip.png" alt="<?php echo html_escape($this->lang->line('ltr_login_alt_1')); ?>">
                    </div>
                </div>
                <form id="login_form" data-posturl="authenticate/verifyLogin" >
                    <div class="pxg_login_wrapper">
                        <a href="<?= base_url() ?>" class="pxg_logo_ wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms"><img src="<?= base_url($_SESSION['site_logo'] ) ?>" alt="<?php echo html_escape($this->lang->line('ltr_login_alt_2')); ?>"></a>
                        <h3 class="wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms"><?php echo html_escape($this->lang->line('ltr_login_txt_2')); ?></h3>
                        <p class="wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms"><?php echo html_escape($this->lang->line('ltr_login_txt_3')); ?></p>
                        <div style="overflow: hidden;">
                            <div class="pxg_auth_input_wrapper wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                                <div class="pxg_auth_input " >
                                    <label><?php echo html_escape($this->lang->line('ltr_login_txt_4')); ?></label>
                                    <input class="require valid valid_email" data-error="O campo de e-mail não pode ficar vazio" type="email" name="ppl_email" value="<?= get_cookie('u_em') ?>" placeholder="Digite o e-mail aqui">
                                    <div class="pxg_login_ic">
                                        <img src="<?= base_url() ?>assets/images/envelope.svg" alt="<?php echo html_escape($this->lang->line('ltr_login_alt_3')); ?>">
                                    </div>
                                </div>
                                <div class="pxg_auth_input">
                                    <label><?php echo html_escape($this->lang->line('ltr_login_txt_5')); ?></label>
                                    <input class="require" data-error="O campo de senha não pode ficar vazio" type="password" name="ppl_pass" value="<?= get_cookie('u_ps') ?>" placeholder="Digite sua senha">
                                    <div class="pxg_login_ic">
                                        <img src="<?= base_url() ?>assets/images/lock.svg" alt="<?php echo html_escape($this->lang->line('ltr_login_alt_4')); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pxg_remember wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <label class="pxg_switch_toggle">
                                <input type="checkbox" name="ppl_rememberme" class="pxg_switch_inpt">
                                <span class="pxg_switch_slider"></span>
                                <p><?php echo html_escape($this->lang->line('ltr_login_txt_6')); ?></p>
                            </label>
                            <a href="<?= base_url('forgot-password') ?>"><?php echo html_escape($this->lang->line('ltr_login_txt_7')); ?></a>
                        </div>
                        <div class="pxg_btn_area wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <button data-action="submitMe" data-form="login_form" class="pxg_btn">
                            <?php echo html_escape($this->lang->line('ltr_login_txt_8')); ?>
                            </button>
                        </div>
                        <p class="get_start wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms"><?php echo html_escape($this->lang->line('ltr_login_txt_9')); ?><b> <a href="<?= base_url('signup') ?>"><?php echo html_escape($this->lang->line('ltr_login_txt_10')); ?> </a></b></p>
                    </div>
                </form>
                <!--Vectors Start-->
                <div class="pxg_shap vector-1">
                    <img src="<?= base_url() ?>assets/images/Vector-1.png" alt="<?php echo html_escape($this->lang->line('ltr_login_alt_5')); ?>">
                </div>
                <div class="pxg_shap vector-2">
                    <img src="<?= base_url() ?>assets/images/Vector-2.png" alt="<?php echo html_escape($this->lang->line('ltr_login_alt_6')); ?>">
                </div>
                <div class="pxg_shap vector-3">
                    <img src="<?= base_url() ?>assets/images/Vector-3.png" alt="<?php echo html_escape($this->lang->line('ltr_login_alt_7')); ?>">
                </div>
                <div class="pxg_shap vector-5">
                    <img src="<?= base_url() ?>assets/images/vector-5.png" alt="<?php echo html_escape($this->lang->line('ltr_login_alt_8')); ?>">
                </div>
                <div class="pxg_shap vector-4">
                    <img src="<?= base_url() ?>assets/images/Vector-4.png" alt="<?php echo html_escape($this->lang->line('ltr_login_alt_9')); ?>">
                </div>
                <!--Vectors End-->
            </div>
        </div>
        <!--Login Page End-->
        
