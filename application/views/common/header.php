<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $_SESSION['site_name'].' | '.$page_info['page_title'] ?></title>
        <!-- favicon -->
        <link rel="shortcut icon" href="<?= base_url($_SESSION['site_favicon']) ?>" type="image/x-icon">
        <!-- stylesheet -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">

        <?php if (in_array($page_info['page_name'],array('admin_dashboard', 'admin_profile', 'admin_plans', 'u_dashboard', 'u_profile', 'admin_userslist', 'admin_settings', 'u_settings', 'u_sites_response', 'u_dfytemplates'))) {  ?>
            <link rel='stylesheet' href='<?= base_url() ?>assets/plugin/select2/css/select2.min.css'>
        <?php } ?>

        <?php if (in_array($page_info['page_name'],array('admin_userslist', 'designer_templates', 'admin_plans', 'u_sites_response'))) {  ?>
            <link rel="stylesheet" href="<?= base_url() ?>assets/plugin/datatable/datatables.min.css">
            <link rel="stylesheet" href="<?= base_url() ?>assets/plugin/datatable/responsive/responsive.dataTables.min.css">
        <?php } ?>


        <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/responsive.css">
    </head>
    <body data-page="<?= $page_info['page_name'] ?>">
        <script>const baseurl = "<?= base_url() ?>";</script>
        <!-- Preloader Start -->
        <div class="pxg_preloader ">
            <div class="pxg_loader_container">
                <div class="pxg_loader_icon">
                    <img src="<?= base_url($_SESSION['site_favicon']) ?>" >
                </div>
            </div>
        </div>
        <!-- Dashboard Start -->
        <!-- Processing  Start -->
        <div class="request_loader hidden_loader" id="preloader">
                <div class="loader loader-1">
                    <div class="loader_outter"></div>
                    <div class="loader_inner"></div>
                </div>
            </div>
        <!-- Processing Start -->
        <div class="pxg_main_wrapper">