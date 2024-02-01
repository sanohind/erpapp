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
                        <h1><?= $title ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <!-- <h5 class="mb-3">Sales Aging Status</h5> -->
            <div class="row">
                <div class="col-lg-12 col-6">
                    <!-- small card -->
                    <div class="small-box bg-danger text-white">
                        <div class="inner text-white text-center">
                            <h4 class="text-bold"><i class="fas fa-greater-than-equal"></i> <?= $aging_summary[4]->age_group ?> Days</h4>
                            <h3>Amount : Rp. <?= number_format($aging_summary[4]->amount, 0, ',', '.') ?></h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <!-- <a href="#" class="small-box-footer">
                            Details <i class="fas fa-arrow-circle-right"></i>
                        </a> -->
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-warning text-white text-center">
                        <div class="inner text-white">
                            <h4 class="text-bold"><i class="fas fa-greater-than-equal"></i> <?= $aging_summary[3]->age_group ?> Days</h4>
                            <h3>Amount : Rp. <?= number_format($aging_summary[3]->amount, 0, ',', '.') ?></h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <!-- <a href="" class="small-box-footer">
                            Details <i class="fas fa-arrow-circle-right"></i>
                        </a> -->
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-info text-center">
                        <div class="inner">
                            <h4 class="text-bold"><i class="fas fa-greater-than-equal"></i> <?= $aging_summary[2]->age_group ?> Days</h4>
                            <h3>Amount : Rp. <?= number_format($aging_summary[2]->amount, 0, ',', '.') ?></h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-exclamation"></i>
                        </div>
                        <!-- <a href="" class="small-box-footer">
                            Details <i class="fas fa-arrow-circle-right"></i>
                        </a> -->
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-primary text-center">
                        <div class="inner">
                            <h4 class="text-bold"><i class="fas fa-greater-than-equal"></i> <?= $aging_summary[1]->age_group ?> Days</h4>
                            <h3>Amount : Rp. <?= number_format($aging_summary[1]->amount, 0, ',', '.') ?></h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-double"></i>
                        </div>
                        <!-- <a href="" class="small-box-footer">
                            Details <i class="fas fa-arrow-circle-right"></i>
                        </a> -->
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-success text-center">
                        <div class="inner">
                            <h4 class="text-bold"> Current</h4>
                            <h3>Amount : Rp. <?= number_format($aging_summary[0]->amount, 0, ',', '.') ?></h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <!-- <a href="" class="small-box-footer">
                            Details <i class="fas fa-arrow-circle-right"></i>
                        </a> -->
                    </div>
                </div>


                <div class="col-md-12 col-6">
                    <div class="card card-teal">
                        <div class="card-header">
                            <h4 class="card-title">Summary Aging by Customer</h4>
                            <div class="card-tools">
                                <i class="fas fa-money-check"></i>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-striped" id="tbDetail">
                                <thead class="bg-secondary">
                                    <tr>
                                        <th rowspan="2">Customer Name</th>
                                        <th colspan="5" class="text-center">Aging</th>
                                    </tr>
                                    <tr>
                                        <th>Current</th>
                                        <th><i class="fas fa-greater-than-equal"></i> 30 Days</th>
                                        <th><i class="fas fa-greater-than-equal"></i> 60 Days</th>
                                        <th><i class="fas fa-greater-than-equal"></i> 90 Days</th>
                                        <th><i class="fas fa-greater-than-equal"></i> 120 Days</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($aging_detail as $row) :
                                    ?>
                                        <tr>
                                            <td><a href="#" onclick="showDetail('<?= $row->cust_id ?>')" data-id="<?= $row->cust_id ?>"><?= $row->customer ?></a></td>
                                            <td class="text-right"><?= number_format($row->D0, 0, ',', '.') ?></td>
                                            <td class="text-right"><?= number_format($row->D30, 0, ',', '.') ?></td>
                                            <td class="text-right"><?= number_format($row->D60, 0, ',', '.') ?></td>
                                            <td class="text-right"><?= number_format($row->D90, 0, ',', '.') ?></td>
                                            <td class="text-right"><?= number_format($row->D120, 0, ',', '.') ?></td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </section>
        <!-- /.content -->

        <div class="modal fade" id="modal-detail">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="detailTitle">--</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- <div class="table-responsive"> -->
                        <table class="table table-striped table-hover display " id="tableAgingDetail" width="100%">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Doc. Type</th>
                                    <th>Doc. No</th>
                                    <th>Doc. Date</th>
                                    <th>Due Date</th>
                                    <th>Currency</th>
                                    <th>Amount</th>
                                    <th>Balance</th>
                                    <th>Balance (HC)</th>
                                    <th>Aging</th>
                                </tr>
                            </thead>
                            <tbody>
                                <div class="overlay" id="olTableDetail"><i class="fas fa-3x fa-sync-alt fa-spin"> </i>
                                    <div class="text-bold pt-2"> Loading...</div>
                                </div>
                            </tbody>
                        </table>
                        <!-- </div> -->
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('jscustom') ?>
<script src="<?= base_url('assets/adminlte/plugin/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugin/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugin/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugin/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugin/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugin/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
<!-- component -->
<script type="text/javascript">
    $('#tbDetail').DataTable({
        dom: 'Bfrtip',
        buttons: [{
            extend: 'excelHtml5'
        }],
        paging: false,
        scrollCollapse: true,
        scrollY: '275px'
        // order: [
        //     [0, "asc"]
        // ],
        // "pageLength": 15,
    });

    function showDetail(cust) {
       //$("#modal-detail").modal("show");
        const dtTitle = document.getElementById("detailTitle");
        dtTitle.innerText = cust;
        $("#tableAgingDetail").DataTable().destroy();
        fetch(`${api_url}/aging-detail/?customer=${cust}`, {
                mode: "no-cors",
            })
            .then((response) => {
                if (response.ok) {
                    return Promise.resolve(response);
                } else {
                    return Promise.reject(new Error("Failed to load"));
                }
            })
            .then((response) => response.json()) // parse response as JSON
            .then((data) => {
                console.log(data.data);
                const result = data.data;
                
            })
            .catch(function(error) {
                console.log(`Error: ${error.message}`);
                alert(`Error: ${error.message}`);
                // Swal.fire({
                //     icon: "error",
                //     title: "Oops...",
                //     text: `${error.message}. Please contact administrator!!`,
                // });
            });
        //dtTable.columns.adjust().draw();
        $("#modal-detail").modal("show");
    }
</script>
<?= $this->endSection() ?>