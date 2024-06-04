<!--Sign-Up Page Start-->
<div class="pxg_login_main">
            <div class="pxg_auth_login_box">
                <div class="pxg_letf_auth_bg">
                    <div class="pxg_letf_auth">
                        <h3 class="wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms"><?php echo html_escape($this->lang->line('ltr_sign_up_txt_1')); ?>
                        </h3>
                        <img src="<?= base_url() ?>assets/images/login-clip.png" alt="ltr_sign_up_alt_1">
                    </div>
                </div>
                <form id="signup_form" data-posturl="authenticate/verifySignUp" autocomplete="off" >
                    <div class="pxg_login_wrapper pxg_signup">
                        <a href="<?= base_url() ?>" class="pxg_logo_ wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms"><img src="<?= base_url($_SESSION['site_logo'] ) ?>" alt="ltr_sign_up_alt_2"></a>
                        <h3 class="wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms"><?php echo html_escape($this->lang->line('ltr_sign_up_txt_2')); ?></h3>
                        <p class="wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <?php echo html_escape($this->lang->line('ltr_sign_up_txt_3')); ?>
                        </p>
                        <div style="overflow: hidden;">
                            <div class="pxg_auth_input_wrapper wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                                <div class="pxg_auth_input " >
                                    <label><?php echo html_escape($this->lang->line('ltr_sign_up_txt_4')); ?></label>
                                    <input class="require valid" type="text" name="pps_name" value="" placeholder="Digite o nome aqui" data-error="Por favor insira o nome completo" autocomplete="off">
                                    <div class="pxg_login_ic">
                                        <img src="<?= base_url() ?>assets/images/user.svg" alt="ltr_sign_up_alt_3">
                                    </div>
                                </div>
                                <div class="pxg_auth_input " >
                                    <label><?php echo html_escape($this->lang->line('ltr_sign_up_txt_5')); ?></label>
                                    <input class="require valid valid_email" type="email" name="pps_email" value="" placeholder="Digite o e-mail aqui" data-error="Por favor insira o e-mail" autocomplete="off">
                                    <div class="pxg_login_ic">
                                        <img src="<?= base_url() ?>assets/images/envelope.svg" alt="ltr_sign_up_alt_4">
                                    </div>
                                </div>
                                <div class="pxg_auth_input">
                                    <label><?php echo html_escape($this->lang->line('ltr_sign_up_txt_6')); ?></label>
                                    <input class="require m_length_n" data-min_l="8" type="password" name="pps_password" value="" data-fieldname="Password" placeholder="Coloque sua senha" data-error="Por favor digite a senha" autocomplete="new-password" >
                                    <div class="pxg_login_ic">
                                        <img src="<?= base_url() ?>assets/images/lock.svg" alt="ltr_sign_up_alt_5">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pxg_btn_area wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <button data-action="submitMe" data-form="signup_form" class="pxg_btn">
                                <?php echo html_escape($this->lang->line('ltr_sign_up_txt_7')); ?>
                            </button>
                        </div>
                        <p class="get_start wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms"><?php echo html_escape($this->lang->line('ltr_sign_up_txt_8')); ?><b> <a href="<?= base_url('login') ?>"><?php echo html_escape($this->lang->line('ltr_sign_up_txt_9')); ?> </a></b></p>
                    </div>
                </form>
                <!--Vectors Start-->
                <div class="pxg_shap vector-1">
                    <img src="<?= base_url() ?>assets/images/Vector-1.png" alt="ltr_sign_up_alt_6">
                </div>
                <div class="pxg_shap vector-2">
                    <img src="<?= base_url() ?>assets/images/Vector-2.png" alt="ltr_sign_up_alt_7">
                </div>
                <div class="pxg_shap vector-3">
                    <img src="<?= base_url() ?>assets/images/Vector-3.png" alt="ltr_sign_up_alt_8">
                </div>
                <div class="pxg_shap vector-5">
                    <img src="<?= base_url() ?>assets/images/vector-5.png" alt="ltr_sign_up_alt_9">
                </div>
                <div class="pxg_shap vector-4">
                    <img src="<?= base_url() ?>assets/images/Vector-4.png" alt="ltr_sign_up_alt_10">
                </div>
                <!--Vectors End-->
            </div>
        </div>
        <!--Sign-Up Page End-->