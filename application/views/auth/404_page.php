<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>404 - Página não encontrada</title>
        <!-- favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
        <!-- stylesheet -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
    </head>
    <body>
        <!--//========404 Error Page Start=========//-->
        <div class="error_main_wrapper">
            <div class="error_page_content">
                <div class="container">
                    <div class="error_inner_content">
                        <img src="<?= base_url($_SESSION['site_logo'] ) ?>" alt="404" class="img-fluid">
                        <h1>404</h1>
                            <p>Ops... A página que você procura não foi encontrada. Não se preocupe, volte para a página anterior</p>
                            <a href="javascript:;" onclick="window.history.go(-1); return false;" class="pxg_btn"><span>Volte</span></a>
                    </div>
                </div>
            </div>
        </div>
        <!--//========404 Error Page End=========//-->
        <script src="assets/js/jquery.min.js"></script> 
        <script src="assets/js/bootstrap.min.js"></script> 
        <script src="assets/js/custom.js"></script> 
    </body>
</html>
