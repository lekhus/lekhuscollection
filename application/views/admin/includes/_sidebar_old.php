<?php 
$cur_tab = $this->uri->segment(2)==''?'dashboard': $this->uri->segment(2);  
?>  

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?= base_url('admin'); ?>" class="brand-link">
    <img src="<?= base_url($this->general_settings['favicon']); ?>" alt="Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light"><?= $this->general_settings['application_name']; ?></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= base_url()?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?= ucwords($this->session->userdata('username')); ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

        <li id="profile" class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-user"></i>
            <p>
              Profile
              <i class="right fa fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('admin/profile'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Change Profile</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/profile/change_pwd'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Change Password</p>
              </a>
            </li>
          </ul>
        </li>

        <li id="dashboard" class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-dashboard"></i>
            <p>
              Dashboard
              <i class="right fa fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('admin/dashboard'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Dashboard v1</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/dashboard/index_2'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Dashboard v2</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/dashboard/index_3'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Dashboard v3</p>
              </a>
            </li>
          </ul>
        </li>
      
        <li id="users" class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-user"></i>
            <p>
              Users
              <i class="right fa fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('admin/users'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Users List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/users/add'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Add New User</p>
              </a>
            </li>
          </ul>
        </li>
    

        <li id="export" class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-life-ring"></i>
            <p>
              Backup & Export
              <i class="right fa fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('admin/export'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Database Backup</p>
              </a>
            </li>
          </ul>
        </li>
        
        <li id="general_settings" class="nav-item">
          <a href="<?= base_url('admin/general_settings'); ?>" class="nav-link">
            <i class="nav-icon fa fa-cogs"></i>
            <p>
              General Settings
            </p>
          </a>
        </li>


        <li id="widgets" class="nav-item">
          <a href="<?= base_url('admin/widgets'); ?>" class="nav-link">
            <i class="nav-icon fa fa-th"></i>
            <p>
              Widgets
              <span class="right badge badge-danger">New</span>
            </p>
          </a>
        </li>

        <li id="charts" class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-pie-chart"></i>
            <p>
              Charts
              <i class="right fa fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('admin/charts/chartjs'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>ChartJS</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/charts/flot'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Flot</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/charts/inline'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Inline</p>
              </a>
            </li>
          </ul>
        </li>

        <li id="ui" class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-tree"></i>
            <p>
              UI Elements
              <i class="fa fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('admin/ui/general'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>General</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/ui/icons'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Icons</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/ui/buttons'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Buttons</p>
              </a>
            </li>
          </ul>
        </li>

        <li id="forms" class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-edit"></i>
            <p>
              Forms
              <i class="fa fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('admin/forms/general'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>General Elements</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/forms/advanced'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Advanced Elements</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/forms/editors'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Editors</p>
              </a>
            </li>
          </ul>
        </li>

        <li id="tables" class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-table"></i>
              <p>
                Tables
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('admin/tables/simple'); ?>" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Simple Tables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/tables/data'); ?>" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Data Tables</p>
                </a>
              </li>
            </ul>
        </li>

        <li class="nav-header">EXAMPLES</li>
        <li id="calender" class="nav-item">
          <a href="<?= base_url('admin/calendar'); ?>" class="nav-link">
            <i class="nav-icon fa fa-calendar"></i>
            <p>
              Calendar
              <span class="badge badge-info right">2</span>
            </p>
          </a>
        </li>

        <li id="mailbox" class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-envelope-o"></i>
            <p>
              Mailbox
              <i class="fa fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('admin/mailbox/inbox'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Inbox</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/mailbox/compose'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Compose</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/mailbox/read_mail'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Read</p>
              </a>
            </li>
          </ul>
        </li>

        <li id="pages" class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-book"></i>
            <p>
              Pages
              <i class="fa fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('admin/pages/invoice'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Invoice</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/pages/profile'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Profile</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/pages/login'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Login</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/pages/register'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Register</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/pages/lockscreen'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Lockscreen</p>
              </a>
            </li>
          </ul>
        </li>

        <li id="extras" class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-plus-square-o"></i>
            <p>
              Extras
              <i class="fa fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('admin/extras/error404'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Error 404</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/extras/errro500'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Error 500</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/extras/blank'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Blank Page</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/extras/starter'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Starter Page</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-header">MISCELLANEOUS</li>
        <li class="nav-item">
          <a href="https://adminlte.io/docs" class="nav-link">
            <i class="nav-icon fa fa-file"></i>
            <p>Documentation</p>
          </a>
        </li>

        <li class="nav-header">LABELS</li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-circle-o text-danger"></i>
            <p class="text">Important</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-circle-o text-warning"></i>
            <p>Warning</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-circle-o text-info"></i>
            <p>Informational</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<script>
  $("#<?= $cur_tab ?>").addClass('menu-open');
  $("#<?= $cur_tab ?> > a").addClass('active');
</script>