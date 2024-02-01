<?= $this->extend('layout/layout') ?>

<?= $this->section('stylecustom') ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugin/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugin/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugin/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
<!-- Date Range Picker -->
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugin/daterangepicker/daterangepicker.css') ?>" />
<style>
    .font-table {
        font-size: 12px;
    }
    thead input {
        width: 100%;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Billable Line Data</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Billable Line</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><?= $title ?></h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tbBillable" class="table table-hover display">
                        <thead>
                            <tr class="bg-secondary">
                                <th>Source Type</th>
                                <th>SO No</th>
                                <th>SO Line</th>
                                <th>Shipment</th>
                                <th>Customer</th>
                                <th>Status</th>
                                <th>DN Reference</th>
                                <th>Delivery Date</th>
                                <th>Customer Order</th>
                                <th>Part No</th>
                                <th>Description</th>
                                <th>Qty</th>
                                <th>Unit</th>
                                <th>Price</th>
                                <th>Amount</th>
                                <th>Currency</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($billable == null) {
                            ?>
                                <tr class="text-center">
                                    <td colspan="16">"No data found..."</td>
                                </tr>
                                <?php
                            } else {
                                foreach ($billable as $row) {
                                ?>
                                    <tr>
                                        <td><?= $row->source_type ?></td>
                                        <td><?= $row->nomor_so ?></td>
                                        <td><?= $row->so_line ?></td>
                                        <td><?= $row->shipment ?></td>
                                        <td><?= $row->business_patner ?></td>
                                        <td><?= $row->invoice_status ?></td>
                                        <td><?= $row->references ?></td>
                                        <td><?= $row->planned_delivery_date ?></td>
                                        <td><?= $row->customer_order ?></td>
                                        <td><?= $row->partno ?></td>
                                        <td><?= $row->descripton ?></td>
                                        <td><?= $row->delivered_qty ?></td>
                                        <td><?= $row->unit ?></td>
                                        <td><?= number_format($row->price) ?></td>
                                        <td><?= number_format($row->billable_amount) ?></td>
                                        <td><?= $row->currency ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<?= $this->endSection() ?>

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

<script>
    // $('#tbBillable').DataTable({
    //     dom: 'Bfrtip',
    //     buttons: [{
    //         extend: 'excelHtml5'
    //     }],
    //     // order: [
    //     //     [0, "asc"]
    //     // ],
    //     // "pageLength": 15,
    // });
    $('#tbBillable thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#tbBillable thead');
 
    var table = $('#tbBillable').DataTable({
        dom: 'Bfrtip',
        buttons: [{
             extend: 'excelHtml5'
         }],
        orderCellsTop: true,
        fixedHeader: true,
        paging: false,
        scrollCollapse: true,
        scrollY: '530px',
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('change', function (e) {
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
                        })
                        .on('keyup', function (e) {
                            e.stopPropagation();
 
                            $(this).trigger('change');
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
    });
</script>
<?= $this->endSection() ?>