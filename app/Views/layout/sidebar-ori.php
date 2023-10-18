<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?= base_url('assets/img/sanoh1-2.jpg') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">ERP</span> 
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> -->

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?= site_url('/');?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt text-primary"></i>
              <p>
                Dashboard
                
              </p>
            </a>
            <!-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon text-primary"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
            </ul> -->
          </li>
          <li class="nav-header">TRANSACTION</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart text-primary"></i>
              <p>
                Sales
                <i class="fas fa-angle-left right text-primary"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= site_url('invoice-print');?>" class="nav-link">
                  <i class="far fa-circle nav-icon text-primary"></i>
                  <p>Print Invoice Export</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon text-primary"></i>
                  <p> -- / --</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-home text-primary"></i>
              <p>
                Warehouse
                <i class="fas fa-angle-left right text-primary"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= site_url('stock-scan');?>" class="nav-link">
                  <i class="far fa-circle nav-icon text-primary"></i>
                  <p>Scan Stock Opname</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon text-primary"></i>
                  <p> -- / --</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-balance-scale text-primary"></i>
              <p>
                Accounting
                <i class="fas fa-angle-left right text-primary"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= site_url('stock-opname');?>" class="nav-link">
                  <i class="fas fa-circle nav-icon text-primary"></i>
                  <p>Stock Opname</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon text-primary"></i>
                  <p> -- / --</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">REPORT</li>
          <li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-file text-primary"></i>
              <p>
                Report
                <i class="fas fa-angle-left right text-primary"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= site_url('shipment-report');?>" class="nav-link">
                  <i class="far fa-circle nav-icon text-primary"></i>
                  <p>Shipment Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('sales-report');?>" class="nav-link">
                  <i class="far fa-circle nav-icon text-primary"></i>
                  <p>Sales Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('receipt-report');?>" class="nav-link">
                  <i class="far fa-circle nav-icon text-primary"></i>
                  <p>Receipt Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('planned-load');?>" class="nav-link">
                  <i class="far fa-circle nav-icon text-primary"></i>
                  <p>Planned Load</p>
                </a>
              </li>
            </ul>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>