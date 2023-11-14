<?php

use PhpParser\Node\Expr\AssignOp\Concat;
?>
<?= $this->extend('layout/layout') ?>

<?= $this->section('stylecustom') ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugin/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugin/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugin/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
<!-- Date Range Picker -->
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugin/daterangepicker/daterangepicker.css') ?>" />
<!-- sweet alert 2-->
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugin/sweetalert2/sweetalert2.min.css') ?>" />
<style>
    /* hide-scrollbar::-webkit-scrollbar {
     display: none;
    } */

    .data-list {
        height: 650px;
        overflow-y: hidden;

    }
</style>
<?= $this->endSection() ?>



<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><?= $kanban_title ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Kanban</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h2 class="card-title"><?= $columnA ?></h2>
                        </div>
                        <div class="card-body data-list" data-autoscroll>

                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                <li class="item">
                                    <div class="product-img text-center">
                                        <i class="h4 text-info"></i>
                                    </div>
                                    <div class="product-info">
                                        <a href="javascript:void(0)" class="product-title text-info">
                                            <span class="badge badge-info float-right">Actual</span></a>
                                        <span class="product-description">


                                        </span>
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-4 col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h2 class="card-title">In Progress</h2>
                    </div>
                </div>
            </div> -->
                <div class="col-lg-4 col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h2 class="card-title"><?= $columnB ?></h2>
                        </div>

                        <div class="card-body data-list" data-autoscroll>

                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                <li class="item">
                                    <div class="product-img text-center">
                                        <i class="h4 text-primary"></i>
                                    </div>
                                    <div class="product-info">
                                        <a href="javascript:void(0)" class="product-title text-primary">
                                            <span class="badge badge-primary float-right"></span></a>
                                        <span class="product-description">

                                        </span>
                                    </div>
                                </li>
                            </ul>

                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h2 class="card-title"><?= $columnC ?></h2>
                        </div>

                        <div class="card-body data-list" data-autoscroll>

                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                <li class="item">
                                    <div class="product-img text-center">
                                        <i class="h4 text-success"></i>
                                    </div>
                                    <div class="product-info">
                                        <a href="javascript:void(0)" class="product-title text-success">
                                            <span class="badge badge-success float-right"></span></a>
                                        <span class="product-description">

                                        </span>
                                    </div>
                                </li>
                            </ul>

                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
</div>

<?= $this->endSection() ?>



<?= $this->section('jscustom') ?>
<!-- autoscroll -->
<script src="<?= base_url('assets/js/jquery.autoscroll.js') ?>"></script>
<!-- sweet alert 2-->
<script src="<?= base_url('assets/adminlte/plugin/sweetalert2/sweetalert2.min.js') ?>"></script>

<script src="<?= base_url('assets/adminlte/plugin/chartjs/dist1/chart.min.js') ?>"></script>
<!-- component -->
<script>
    var minutes, seconds, count, counter, timer;
    count = 300; //seconds
    counter = setInterval(timer, 1000);

    function checklength(i) {
        "use strict";
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }

    function timer() {
        "use strict";
        count = count - 1;
        minutes = checklength(Math.floor(count / 60));
        seconds = checklength(count - minutes * 60);
        if (count < 0) {
            clearInterval(counter);
            return;
        }
        // document.getElementById("timer").innerHTML =
        //     "Refresh in " + minutes + ":" + seconds + " ";
        if (count === 0) {
            location.reload();
        }
    }
</script>
<?= $this->endSection() ?>