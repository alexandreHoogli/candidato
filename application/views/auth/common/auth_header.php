<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $_SESSION['site_name'].' | '.$page_info['page_title'] ?></title>
        <!-- favicon -->
        <link rel="shortcut icon" href="<?= base_url($_SESSION['site_favicon']) ?>" type="image/x-icon">
        <!-- stylesheet -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url() ?>assets/plugin/animation/css/animate.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/login-style.css">
    </head>
    <body>