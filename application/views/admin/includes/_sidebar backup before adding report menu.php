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


                <li id="customer" class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-user"></i>
            <p>
              Orders
              <i class="right fa fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('admin/orders'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Orders LIST</p>
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
    

             <li id="masters" class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-user"></i>
            <p>
              Masters
              <i class="right fa fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('admin/brand'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Brand</p>
              </a>
            </li>
           <li class="nav-item">
              <a href="<?= base_url('admin/category'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Categories</p>
              </a>
            </li>
           <li class="nav-item">
              <a href="<?= base_url('admin/size'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Size</p>
              </a>
            </li>
           <li class="nav-item">
              <a href="<?= base_url('admin/color'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Color</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/set'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Set</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/design'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Design</p>
              </a>
            </li>
          </ul>
        </li>
        
                     <li id="masters" class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-user"></i>
            <p>
              Inventory
              <i class="right fa fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('admin/item'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Stock item</p>
              </a>
            </li>

          </ul>
        </li>
        
        <li id="customer" class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-user"></i>
            <p>
              Customers
              <i class="right fa fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('admin/customer'); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Customer LIST</p>
              </a>
            </li>

          </ul>
        </li>
        
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