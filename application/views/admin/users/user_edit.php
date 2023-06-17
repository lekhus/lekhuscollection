  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default color-palette-bo">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-edit"></i>
              &nbsp; Edit User </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/admin'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Users List</a>
          </div>
        </div>
        <div class="card-body">   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
           
            <?php echo form_open(base_url('admin/users/edit/'.$user['admin_id']), 'class="form-horizontal"' )?> 
            <div class="form-group">
                <label for="userid" class="col-sm-2 control-label">User ID</label>

                <div class="col-md-12">
                  <input type="text" name="user_id" value="<?= $user['admin_id']; ?>" class="form-control" id="user_id" placeholder="" readonly />
                </div>
              </div>
              
              <div class="form-group">
                <label for="username" class="col-sm-2 control-label">User Name</label>

                <div class="col-md-12">
                  <input type="text" name="username" value="<?= $user['username']; ?>" class="form-control" id="username" placeholder="">
                </div>
              </div>
         
              <div class="form-group">
                <label for="role" class="col-sm-2 control-label">Select Status</label>

                <div class="col-md-12">
                  <select name="status" class="form-control">
                    <option value="">Select Status</option>
                    <option value="1" <?= ($user['is_active'] == 1)?'selected': '' ?> >Active</option>
                    <option value="0" <?= ($user['is_active'] == 0)?'selected': '' ?>>Deactive</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Update User" class="btn btn-info pull-right">
                </div>
              </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.box-body -->
      </div>
    </section>
  </div> 