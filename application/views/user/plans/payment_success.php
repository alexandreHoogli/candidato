<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $_SESSION['site_name'] ?></title>
        <!-- favicon -->
        <link rel="shortcut icon" href="<?= base_url($_SESSION['site_favicon']) ?>" type="image/x-icon">
        <!-- stylesheet -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/responsive.css">

        <style>
            /*Payment Page*/
            .pxg_payment_header {
                position: relative;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 25px 0;
                margin-top: 50px;
            }

            .pxg_payment_notification_wrapper {
                background-color: var(--pxg-white-color);
                border-radius: 20px;
                padding: 44px 48px;
                max-width: 850px;
                margin: 0 auto;
                position: relative;
                text-align: center;
            }

            .pxg_payment_notification_wrapper h2 {
                font-weight: 700;
                margin-bottom: 5px;
                line-height: 1.4;
                color: #36d786;
            }

            .pxg_payment_notification_wrapper h6 {
                font-size: 18px;
                margin-bottom: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 6px;
                line-height: 1.4;
            }

            .pxg_payment_notification_wrapper p {
                margin-bottom: 20px;
            }

            .pxg_payment_notification_wrapper .pxg_btn {
                height: 50px;
                line-height: 50px;
                background: #36d786;
            }

            .pxg_payment_notification_wrapper .pxg_btn:after{
                display: none;
            }
            .pxg_payment_notification_wrapper h6 svg circle {
                fill: #36d786;
            }


            .pxg_payment_notification_wrapper.payment_failed h6 svg circle {
                fill: #f42650;
            }
            .pxg_payment_notification_wrapper.payment_failed h6 svg {
                fill: #f42650;
            }

            .pxg_payment_notification_wrapper.payment_failed .pxg_btn {
                background: #f42650;
            }

            .pxg_payment_notification_wrapper.payment_failed h2 {
                color: #f42650;
            }

    </style>

    </head>
    <body>
        <!--//========Preloader Start=========//-->
        <div class="pxg_preloader ">
            <div class="pxg_loader_container">
                <div class="pxg_loader_icon">
                    <img src="<?= base_url($_SESSION['site_favicon']) ?>" alt="loader-icon">
                </div>
            </div>
        </div>
        <!--//========Preloader End=========//-->
    <!--//========Payment success Section Start=========//-->
        <div class="pxg_main_wrapper">
            <div class="pxg_payment_mode_main" style="color: #112650;">
            <!--//========Sidebar Start=========//-->
            <div class="pxg_payment_header">
                <div class="pxg_payment_logo">
                    <a href=""><img src="<?= base_url($_SESSION['site_logo'] ) ?>" alt=""></a>
                </div>
            </div>
            <div class="pxg_payment_banner">
                <div class="pxg_payment_banner_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 512 512" xmlns:v="https://vecta.io/nano"><path d="M344.265 255.139H214.283a15.027 15.027 0 0 1-7.645-27.967c56.633-33.464 86.05-72.5 89.93-119.338 1.353-16.255 15.831-29.239 32.266-29.024 16.77.268 32.481 6.99 44.248 18.93 11.776 11.951 18.266 27.777 18.272 44.561v5.055c0 41-12.144 67.142-34.551 101.04a15.03 15.03 0 0 1-12.538 6.743z" fill="#ffc380"/><path d="M503.562 272.171c0-25.964-21.123-47.088-47.088-47.088H214.283c-2.691 0-5.333.722-7.648 2.092-17.001 10.052-34.167 18.327-47.96 24.978l-13.488 6.576a15.029 15.029 0 0 0-8.307 13.442V464.53a15.029 15.029 0 0 0 8.307 13.442C205.91 508.329 256.386 512 315.247 512l28.023-.178 33.055-.204h47.509c25.964 0 47.088-21.123 47.088-47.088 0-8.73-2.387-16.912-6.545-23.929 13.529-8.282 22.575-23.199 22.575-40.191 0-8.73-2.387-16.912-6.545-23.929 13.529-8.282 22.575-23.199 22.575-40.191 0-12.212-4.673-23.353-12.324-31.728 8.332-8.781 12.904-20.234 12.904-32.391z" fill="#ffcf99"/><use xlink:href="#B" fill="#29ccb1"/><use xlink:href="#C" fill="#73c3ff"/><use xlink:href="#B" fill="#29ccb1"/><use xlink:href="#C" fill="#73c3ff"/><path d="M151.705 225.083H23.466c-8.295 0-15.028 6.733-15.028 15.028v256.478c0 8.305 6.733 15.028 15.028 15.218h96.179c18.424-.19 34.404-10.82 42.129-26.269a46.686 46.686 0 0 0 4.959-21.009V240.111c0-8.296-6.733-15.028-15.028-15.028z" fill="#44a4ec"/><path d="M102.613 431.658v80.15H72.557v-80.15c0-8.295 6.733-15.028 15.028-15.028s15.028 6.733 15.028 15.028z" fill="#73c3ff"/><defs ><path id="B" d="M472.303 141.117h-32.06c-8.299 0-15.028-6.729-15.028-15.028s6.729-15.028 15.028-15.028h32.06c8.299 0 15.028 6.729 15.028 15.028a15.03 15.03 0 0 1-15.028 15.028zm-224.419 0h-32.06c-8.299 0-15.028-6.729-15.028-15.028s6.729-15.028 15.028-15.028h32.06c8.299 0 15.028 6.729 15.028 15.028a15.03 15.03 0 0 1-15.028 15.028zm48.105-83.291c-5.195 0-10.245-2.695-13.028-7.516l-16.03-27.765a15.03 15.03 0 0 1 5.5-20.528 15.03 15.03 0 0 1 20.528 5.5l16.03 27.765a15.03 15.03 0 0 1-5.5 20.528 14.953 14.953 0 0 1-7.5 2.016zm96.15 0a14.95 14.95 0 0 1-7.5-2.016 15.03 15.03 0 0 1-5.5-20.528l16.03-27.765a15.03 15.03 0 0 1 20.528-5.5 15.03 15.03 0 0 1 5.5 20.528l-16.03 27.765c-2.781 4.821-7.834 7.516-13.028 7.516z"/><path id="C" d="M102.613 432.66v79.148H72.557V432.66c0-8.295 6.733-15.028 15.028-15.028s15.028 6.733 15.028 15.028z"/></defs></svg>
                </div>
            </div>
            <!--//========Sidebar End=========//-->
                    <div class="pxg_payment_notification_wrapper">
                        <h2>Obrigado !!</h2>
                       <h6><span><svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 2.54 2.54" fill-rule="evenodd" xmlns:v="https://vecta.io/nano"><circle cx="1.27" cy="1.27" r="1.27" fill="#00ba00"/><path fill="#fff" d="M.873 1.89L.41 1.391a.17.17 0 0 1 .008-.24.17.17 0 0 1 .24.009l.358.383.567-.53A.17.17 0 0 1 1.599 1l.266-.249a.17.17 0 0 1 .24.008.17.17 0 0 1-.008.24l-.815.76-.283.263-.125-.134z"/></svg></span>Pagamento realizado com sucesso</h6>
                       <p>O plano foi adquirido <br>
                        <?= (isset($chargeJson['id'])?'Transaction id: '.$chargeJson['id']: '') ?></p>
                       <div class="pxg_btn_wrapper">
                            <a href="<?= base_url('plans') ?>" class="pxg_btn">
                                Voltar aos planos
                            </a>
                       </div>
                    </div>
                </div>
        </div>
   <!--//========Payment Section End=========//-->
        <script src="<?= base_url() ?>assets/js/jquery.min.js"></script> 
        <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script> 
        <script src="<?= base_url() ?>assets/js/custom.js"></script> 
    </body>
</html>
