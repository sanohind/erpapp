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
            <h5 class="mb-2">Billable Line Status</h5>
            <div class="row">
                <div class="col-lg-4 col-8">
                    <!-- small card -->
                    <div class="small-box bg-warning text-white">
                        <div class="inner text-white">
                            <h4 class="text-bold">Status : ON HOLD</h4>
                            <h4>Amount : Rp. <?= number_format($billable[0]->total_amount, 2, ',', '.') ?></h4>
                            <h5>Total Data : <?= number_format($billable[0]->total_row) ?> Row</h5>
                        </div>
                        <div class="icon">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Details <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-8">
                    <!-- small card -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h4 class="text-bold">Status : CONFIRMED</h4>
                            <h4>Amount : Rp. <?= number_format($billable[1]->total_amount, 2, ',', '.') ?></h4>
                            <h5>Total Data : <?= number_format($billable[1]->total_row) ?> Row</h5>
                        </div>
                        <div class="icon">
                            <i class="far fa-check-circle"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Details <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-8">
                    <!-- small card -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h4 class="text-bold">Status : READY TO PRINT</h4>
                            <h4>Amount : Rp. <?php if(isset($billable[2]->total_amount)) echo number_format($billable[2]->total_amount, 2, ',', '.')   ?></h4>
                            <h5>Total Data : <?php if(isset($billable[2]->total_row)) echo  number_format($billable[2]->total_row) ?> &nbsp;Row</h5>
                        </div>
                        <div class="icon">
                            <i class="fas fa-print"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Details <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>


                <div class="col-md-12 col-6">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h5 class="card-title">Total Sales by Period <small><i>Last 6 Month</i></small></h5>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <!-- Sales Chart Canvas -->
                                <canvas id="salesChart" height="85px"></canvas>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <a href="#">
                                Details <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
</div>

<?= $this->endSection(); ?>

<?php
$label = array();
$data = array();

foreach ($sales as $graph) {
    array_push($label, $graph->month2 . " " . $graph->year);
    array_push($data, $graph->total_amount);
}
?>


<?= $this->section('jscustom') ?>
<!-- autoscroll -->
<script src="<?= base_url('assets/js/jquery.autoscroll.js') ?>"></script>
<!-- sweet alert 2-->
<script src="<?= base_url('assets/adminlte/plugin/sweetalert2/sweetalert2.min.js') ?>"></script>

<script src="<?= base_url('assets/adminlte/plugin/chartjs/dist1/chart.min.js') ?>"></script>
<!-- component -->
<script type="text/javascript">
    var label = <?= json_encode($label); ?>;
    var data = <?= json_encode($data); ?>;
    //console.log(label);
    drawChart('Total Sales Per Period', label, data);

    function drawChart(title, label, data) {
        var ctx = document.getElementById('salesChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: label,
                datasets: [{
                    label: title,
                    data: data,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: 'rgb(255, 99, 132)'
                        }
                    }
                }
            }
        });
    }
</script>
<?= $this->endSection() ?>