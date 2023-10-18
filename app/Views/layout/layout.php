<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ERP | PT. Sanoh Indonesia</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugin/fontawesome-free/css/all.min.css') ?>" />
  <?= $this->renderSection('stylecustom') ?>
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/css/adminlte.css') ?>" />
  <style>
    body {
      font-size: 12px;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini sidebar-collapse layout-navbar-fixed">
  <!-- Site wrapper -->
  <div class="wrapper">
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="<?= base_url('assets/img/sanoh1.jpg') ?>" alt="Sanoh Logo" height="200" width="150">
      <br/>
      <div class="overlay text-center" id="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"> </i>
            <div class="text-bold pt-2"> Mohon tunggu, selagi kami persiapkan datanya... Terima kasih..</div>
        </div>
    </div>
    <!-- Navbar -->
    <?= $this->include('layout/navbar') ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?= $this->include('layout/sidebar') ?>

    <!-- Content Wrapper. Contains page content -->
    <?= $this->renderSection('content') ?>

    <!-- /.content-wrapper -->
    <?= $this->include('layout/footer') ?>


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?= base_url('assets/adminlte/plugin/jquery/jquery.min.js') ?>"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('assets/adminlte/plugin/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <!-- Data -->
  <script src="<?= base_url('assets/js/component/data.js') ?>"></script>
  <!-- customjs -->
  <?= $this->renderSection('jscustom') ?>
  <!-- AdminLTE App -->
  <script src="<?= base_url('assets/adminlte/js/adminlte.min.js') ?>"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url('assets/adminlte//js/demo.js') ?>"></script>
</body>

</html>