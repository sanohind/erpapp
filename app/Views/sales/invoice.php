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
    .font-table {
        font-size: 12px;
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
                    <h1>Sales Amount Chart</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Sales Report</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Monthly Sales Amount</h3>
                        <div class="card-tools">
                            <a href="<?= site_url('/sales-detail-report') ?>" class="btn btn-tool btn-sm text-primary"> Details
                                <i class="fas fa-sign-out-alt"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9" id="displayChart">
                                <canvas id="myChart" height="135px"></canvas>
                            </div>
                            <div class="col-md-3">
                                <table id="tbChart" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td>ID</td>
                                            <td>Month</td>
                                            <td>Amount</td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
    <!-- /.content -->
</div>

<?= $this->endSection() ?>



<?= $this->section('jscustom') ?>
<!-- sweet alert 2-->
<script src="<?= base_url('assets/adminlte/plugin/sweetalert2/sweetalert2.min.js') ?>"></script>

<script src="<?= base_url('assets/adminlte/plugin/chartjs/dist1/chart.min.js') ?>"></script>

<script src="<?= base_url('assets/adminlte/plugin/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugin/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugin/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugin/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugin/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugin/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
<!-- component -->
<script>
    renderChart();


    function renderChart(datefrom = '', dateto = '') {
        fetch(`${api_url}/get-sales-monthly/`, {
                mode: "no-cors"
            })
            .then(response => {
                if (response.ok) {
                    return Promise.resolve(response);
                } else {
                    return Promise.reject(new Error('Failed to load'));
                }
            })
            .then(response => response.json()) // parse response as JSON
            .then(data => {
                const result = data.data;
                if (Object.keys(result).length > 0) {
                    console.log(result);
                    const label = [];
                    const data = [];
                    for (res of result) {
                        label.push(res.month2);
                        data.push(res.total_amount);
                    }
                    //console.log(label);
                    drawChart('Sales Amount - FY2023', label, data);
                    drawTbChart(result);
                } else {
                    document.getElementById('overlay').style.display = "none";
                    //alert("No Data, please change filter");
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'No data display, please change filter..'
                    })
                }
            })
            .catch(function(error) {
                console.log(`Error: ${error.message}`);
                //alert(`Error: ${error.message}`);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: `${error.message}. Please contact administrator!!`
                })
            });
    }

    function drawChart(title, label, data) {
        var ctx = document.getElementById('myChart').getContext('2d');
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
                }
            }
        });
    }

    function drawTbChart(data) {
        console.log(data)
        $("#tbChart").DataTable({
            //dom: "Bfrtip",
            responsive: true,
            autoWidth: false,
            "searching": false,
            "paging": false,
            data: data,
            columnDefs: [{
                targets: [2],
                render: function(data, type, row, meta) {
                    if (type === "display") {
                        data = new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(data);
                    }
                    return data;
                },
            }, ],
            columns: [{
                    data: "month",
                },
                {
                    data: "month2",
                },
                {
                    data: "total_amount",
                },

            ],
            order: [
                [0, "asc"]
            ],
        });
    }
</script>
<?= $this->endSection() ?>