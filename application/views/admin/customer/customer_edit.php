  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default color-palette-bo">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-edit"></i>
              &nbsp; Edit Customer </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/customer'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Customers List</a>
          </div>
        </div>
        <div class="card-body">   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
           
            <?php echo form_open(base_url('admin/customer/edit/'.$customer['id']), 'class="form-horizontal"' )?> 
              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Customer Id</label>

                <div class="col-md-12">
                  <input type="text" name="name" value="<?= $customer['id']; ?>" class="form-control" id="name" placeholder="" readonly>
                </div>
              </div>
              
                <div class="form-group">

                <label for="name" class="col-sm-2 control-label">Customer Name</label>

                <div class="col-12">

                  <input type="text" name="name" class="form-control" id="name" placeholder="" value="<?= $customer['Name']; ?>">

                </div>

              </div>
                 <div class="form-group">

                <label for="name" class="col-sm-2 control-label">Mobile Number</label>

                <div class="col-12">

                  <input type="text" name="mobile" class="form-control" maxlength=10 id="mobile" placeholder="XXXXXXXXX" pattern="[6-9]{1}[0-9]{9}" value="<?= $customer['mobile']; ?>">
               

                </div>

              </div>
              
              <div class="form-group">

                <label for="name" class="col-sm-2 control-label">Address</label>

                <div class="col-12">

                  <textarea name="address" class="form-control"><?php echo $customer['address']; ?>"</textarea>
               
                </div>

              </div>
              
              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Update Customer" class="btn btn-info pull-right">
                </div>
              </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.box-body -->
      </div>
    </section>
  </div> 