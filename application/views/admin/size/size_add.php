  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Main content -->

    <section class="content">

      <div class="card card-default color-palette-bo">

        <div class="card-header">

          <div class="d-inline-block">

              <h3 class="card-title"> <i class="fa fa-plus"></i>

              Add New Size </h3>

          </div>

          <div class="d-inline-block float-right">

            <a href="<?= base_url('admin/size'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Sizes List</a>

          </div>

        </div>

        <div class="card-body">   

           <!-- For Messages -->

            <?php $this->load->view('admin/includes/_messages.php') ?>



            <?php echo form_open(base_url('admin/size/add'), 'class="form-horizontal"');  ?> 

              <div class="form-group">

                <label for="name" class="col-sm-2 control-label">Size Name</label>

                <div class="col-12">

                  <input type="text" name="name" class="form-control" id="name" placeholder="">

                </div>

              </div>


              <div class="form-group">

                <div class="col-md-12">

                  <input type="submit" name="submit" value="Add Size" class="btn btn-info pull-right">

                </div>

              </div>

            <?php echo form_close( ); ?>

          <!-- /.box-body -->

        </div>

    </section> 

  </div>