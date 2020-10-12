<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Vinder">
    <meta name="keywords" content="Vinder">
    <meta name="robots" content="noindex, nofollow">
    <title>Vinder - <?= isset($title) ? $title : $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>

    <!-- FONTS CSS -->
    <?= $this->Html->css('../vendor/fontawesome/css/all.min.css') ?>
    <!-- VENDOR CSS  -->
    <?= $this->Html->css('../vendor/bootstrap/bootstrap.min.css') ?>
    <?= $this->Html->css('../vendor/sweetalert2/bootstrap-4.css') ?>
    <?= $this->Html->css('../vendor/wow/animate.css') ?>
    <?= $this->Html->css('../vendor/slick/slick.css') ?>
    <?= $this->Html->css('../vendor/select2/select2.min.css') ?>
    <?= $this->Html->css('../vendor/daterange-picker/daterangepicker.css') ?>
    <!-- CUSTOM CSS -->
    <?= $this->Html->css('custom.css') ?>
    <?= $this->fetch('css') ?>

    <!-- Jquery JS -->
    <?= $this->Html->script('../vendor/jquery-3.2.1.min.js'); ?>
    <!-- Bootstrap JS -->
    <?= $this->Html->script('../vendor/bootstrap/popper.min.js'); ?>
    <?= $this->Html->script('../vendor/bootstrap/bootstrap.min.js'); ?>
    <!-- Vendor JS -->
    <?= $this->Html->script('../vendor/sweetalert2/sweetalert2.min.js'); ?>
    <?= $this->Html->script('../vendor/slick/slick.min.js'); ?>
    <?= $this->Html->script('../vendor/wow/wow.min.js'); ?>
    <?= $this->Html->script('../vendor/circle-progress/circle-progress.min.js'); ?>
    <?= $this->Html->script('../vendor/chartjs/Chart.bundle.min.js'); ?>
    <?= $this->Html->script('../vendor/select2/select2.min.js'); ?>
    <?= $this->Html->script('../vendor/tinymce/tinymce.min.js'); ?>
    <?= $this->Html->script('../vendor/inputmask/jquery.inputmask.js'); ?>
    <?= $this->Html->script('../vendor/inputmask/inputmask.binding.js'); ?>
    <?= $this->Html->script('../vendor/daterange-picker/moment.min.js'); ?>
    <?= $this->Html->script('../vendor/daterange-picker/daterangepicker.js'); ?>
    <?= $this->Html->script('resizable.js') ?>
    <!-- Main JS -->
    <?= $this->Html->script('main.js'); ?>
    <!-- CUSTOM JS -->
    <?= $this->Html->script('custom.js'); ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div class="main">
        <!-- HEADER -->
        <?= $this->element('Common/header') ?>
        <!-- HEADER -->
        <!-- CONTENT -->
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
        <!-- FOOTER -->
        <?= $this->element('Common/footer') ?>
        <!-- FOOTER -->
    </div>
</body>
</html>
