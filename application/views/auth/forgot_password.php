<!-- Forgot-Password Page Start -->
<div class="pxg_login_main">
            <div class="pxg_auth_login_box">
                <div class="pxg_letf_auth_bg">
                    <div class="pxg_letf_auth">
                        <h3 class="wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms"><?php echo html_escape($this->lang->line('ltr_forgot_txt_1')); ?>
                        </h3>
                        <img src="<?= base_url() ?>assets/images/login-clip.png" alt="<?php echo html_escape($this->lang->line('ltr_forgot_alt_1')); ?>">
                    </div>
                </div>
                <div class="pxg_login_wrapper">
                    <a href="<?= base_url() ?>" class="pxg_logo_ wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms"><img src="<?= base_url($_SESSION['site_logo'] ) ?>" alt="<?php echo html_escape($this->lang->line('ltr_forgot_alt_2')); ?>"></a>
                    <h3 class="wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms"><?php echo html_escape($this->lang->line('ltr_forgot_txt_2')); ?></h3>
                    <p class="wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms"><?php echo html_escape($this->lang->line('ltr_forgot_txt_3')); ?></p>
                    <form id="forgotpassword_form" data-posturl="authenticate/recoverYourPassword" >
                        <div style="overflow: hidden;">
                            <div class="pxg_auth_input_wrapper wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                                <div class="pxg_auth_input " >
                                    <label><?php echo html_escape($this->lang->line('ltr_forgot_txt_4')); ?></label>
                                    <input type="email" name="ppf_email" value="" placeholder="Digite o e-mail aqui">
                                    <div class="pxg_login_ic">
                                        <img src="<?= base_url() ?>assets/images/envelope.svg" alt="<?php echo html_escape($this->lang->line('ltr_forgot_alt_3')); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pxg_btn_area wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <button data-action="submitMe" data-form="forgotpassword_form" class="pxg_btn">
                                <?php echo html_escape($this->lang->line('ltr_forgot_txt_5')); ?>
                            </button>
                        </div>
                    </form>
                    <div class="pxg_back_btn wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <a href="<?= base_url('login') ?>">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" fill="none" xmlns:v="https://vecta.io/nano">
                                    <path d="M11.123 5.124c-.048-.008-.096-.011-.144-.011H2.752l.179-.083a1.67 1.67 0 0 0 .471-.334L5.71 2.39c.304-.29.355-.757.121-1.105-.272-.372-.794-.452-1.166-.18-.03.022-.059.046-.085.072L.408 5.347c-.326.326-.326.854-.001 1.18l4.172 4.172c.326.325.854.325 1.18-.002.026-.026.05-.053.072-.082.234-.349.183-.815-.121-1.105L3.407 7.199a1.67 1.67 0 0 0-.417-.305l-.25-.113h8.193c.426.016.8-.282.88-.701.074-.455-.235-.883-.69-.957z" fill="#252a56"/>
                                </svg>
                            </span>
                            <?php echo html_escape($this->lang->line('ltr_forgot_txt_6')); ?>
                        </a>
                    </div>
                </div>
                <!-- Vectors Start -->
                <div class="pxg_shap vector-1">
                    <img src="<?= base_url() ?>assets/images/Vector-1.png" alt="<?php echo html_escape($this->lang->line('ltr_forgot_alt_4')); ?>">
                </div>
                <div class="pxg_shap vector-2">
                    <img src="<?= base_url() ?>assets/images/Vector-2.png" alt="<?php echo html_escape($this->lang->line('ltr_forgot_alt_5')); ?>">
                </div>
                <div class="pxg_shap vector-3">
                    <img src="<?= base_url() ?>assets/images/Vector-3.png" alt="<?php echo html_escape($this->lang->line('ltr_forgot_alt_6')); ?>">
                </div>
                <div class="pxg_shap vector-5">
                    <img src="<?= base_url() ?>assets/images/vector-5.png" alt="<?php echo html_escape($this->lang->line('ltr_forgot_alt_7')); ?>">
                </div>
                <div class="pxg_shap vector-4">
                    <img src="<?= base_url() ?>assets/images/Vector-4.png" alt="<?php echo html_escape($this->lang->line('ltr_forgot_alt_8')); ?>">
                </div>
                <!-- Vectors End -->
            </div>
        </div>
        <!-- Forgot-Password Page End -->