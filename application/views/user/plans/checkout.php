<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $_SESSION['site_name'] ?> | <?php echo html_escape($this->lang->line('ltr_user_checkout_txt_1')); ?></title>
        <!-- favicon -->
        <link rel="shortcut icon" href="<?= base_url($_SESSION['site_favicon']) ?>" type="image/x-icon">
        <!-- stylesheet -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/responsive.css">
    </head>
    <body>
        <!--Preloader Start-->
        <div class="pxg_preloader ">
            <div class="pxg_loader_container">
                <div class="pxg_loader_icon">
                    <img src="<?= base_url($_SESSION['site_favicon']) ?>" alt="<?php echo html_escape($this->lang->line('ltr_common_editor_header_alt_1')); ?>">
                </div>
            </div>
        </div>
        <!-- Processing  Start -->
        <div class="request_loader hidden_loader" id="preloader">
                <div class="loader loader-1">
                    <div class="loader_outter"></div>
                    <div class="loader_inner"></div>
                </div>
            </div>
        <!-- Processing Start -->

        <!--//========Main Start=========//-->
        <div class="pxg_main_wrapper">
            <header class="site-header">
                <div class="container">
                    <div class="site-header-menu">
                        <a href="<?= base_url() ?>" target="_blank"><img src="<?= base_url($_SESSION['site_logo'] ) ?>" class="img-fluid" alt="<?php echo html_escape($this->lang->line('ltr_user_checkout_alt_1')); ?>"></a>
                    </div>
                </div>
            </header>
            <div class="page-banner">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-sm-10 text-center">
                            <h1 class="pb-3"><?php echo html_escape($this->lang->line('ltr_user_checkout_txt_2')); ?></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="checkout-main">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-sm-12">
                            <div class="checkout-inner-card checkout-left">
                                <?php $plans = [7 => '1 Semana', 31 => '1 Mês', 365 => '1 Ano' ]; ?> 
                                <h5><?php echo html_escape($this->lang->line('ltr_user_checkout_txt_3')); ?>: <span><?= $plan_detail['p_name'] ?></span></h5>
                                <h5><?php echo html_escape($this->lang->line('ltr_user_checkout_txt_4')); ?>: <span> <?= $plans[ $plan_detail['p_interval'] ] ?> </span></h5>
                                <p><?= $plan_detail['p_description'] ?>
                                </p>
                                <div class="price-list">
                                    <div class="price-heading"><h6><?php echo html_escape($this->lang->line('ltr_user_checkout_txt_5')); ?></h6></div>
                                    <div class="mount"><p><?= $display_price ?></p></div>
                                </div>
                                <div class="price-list">
                                    <div class="price-heading"><h6><?php echo html_escape($this->lang->line('ltr_user_checkout_txt_6')); ?></h6>
                                    <p><?php echo html_escape($this->lang->line('ltr_user_checkout_txt_7')); ?></p>
                                    </div>
                                    <div class="mount"><p>0</p></div>
                                </div>
                                <div class="price-list price-total">
                                    <div class="price-heading"><h6><?php echo html_escape($this->lang->line('ltr_user_checkout_txt_8')); ?></h6></div>
                                    <div class="mount"><p><?= $display_price ?></p></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-sm-12">
                            <div class="checkout-inner-card checkout-left">
                                <div class="checkout-right-inner">
                                    <?php $payment_methods = false; ?>
                                    <?php if( !empty( $data_rpay)    && isset( $rpay_currency )   && $rpay_currency == $plan_detail['p_currency'] ) { echo '<input type="button" id="razorpay_payment" class="checkout-btn raz-btn" value="Pay with RazorPay" ><br>'; $payment_methods = true; } ?>
                                    <?php if( !empty( $data_stripe ) && isset( $stripe_currency ) && $stripe_currency == $plan_detail['p_currency'] )   { echo $data_stripe. '<br>'; $payment_methods = true; } ?>
                                    <?php if( !empty( $data_paypal ) && isset( $paypal_currency ) && $paypal_currency == $plan_detail['p_currency'] )   { echo $data_paypal; $payment_methods = true; } ?>
                                    <?= ( !$payment_methods ) ? '<p>Nenhum método de pagamento disponível</p>' : '' ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="site-footer">
                <div class="container">
                    <div class="site-footer-menu">
                            <span>© <?php echo html_escape($this->lang->line('ltr_user_checkout_txt_9')); ?> <?= date("Y") ?>,  </span>
                            <a href="#" target="_blank"><?= $_SESSION['site_name'] ?></a>. <br class="d-lg-none"><?php echo html_escape($this->lang->line('ltr_user_checkout_txt_10')); ?>.
                    </div>
                </div>
            </footer>
        </div>
        <!--//========Main wrapper End=========//-->

        <!--//========Notification Start=========//-->
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
        <!--//========Notification End=========//-->
         
     
        <script src="<?= base_url() ?>assets/js/jquery.min.js"></script> 
        <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script> 
        <script src="<?= base_url() ?>assets/js/custom.js"></script> 
        <?php if( !empty( $data_rpay ) ) { echo $data_rpay; } ?>
    </body>
</html>
