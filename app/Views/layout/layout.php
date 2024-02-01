<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ERP Apps. | PT. Sanoh Indonesia</title>
  <link rel="icon" type="image/x-icon" href="<?= base_url('favicon.ico') ?>">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugin/fontawesome-free/css/all.min.css') ?>" />
  <?= $this->renderSection('stylecustom') ?>
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/css/adminlte.css') ?>" />
</head>

<body class="hold-transition sidebar-mini sidebar-collapse layout-navbar-fixed">
  <!-- Site wrapper -->
  <div class="wrapper">
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="<?= base_url('assets/img/snh.png') ?>" alt="Sanoh Logo" height="275" width="325">
      <br />
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

  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Application Info</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p><?= APP_NAME ?> Version. <?= APP_VERSION ?></p>
          <?= APP_COMPANY ?>
          <hr/>
          IT Section
          Ext. 161
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

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