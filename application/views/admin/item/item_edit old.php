  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default color-palette-bo">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-edit"></i>
              &nbsp; Edit Stock Item </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/item'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Stock Items List</a>
          </div>
        </div>
        <div class="card-body">   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
           
            <?php echo form_open(base_url('admin/item/edit/'.$item['id']), 'class="form-horizontal"' )?> 
            
            <div class="form-group">

                <label for="name" class="col-sm-2 control-label">Name</label>

                <div class="col-12">

                  <input type="text" name="name" class="form-control" id="" readonly value="<?php 
                  echo $item['Name'];
                  
                  ?>">

                </div>

              </div>
            
                <div class="form-group">
                    <label>Brand</label>
                    <select class="form-control" name="brand">
                        <?php foreach($brand as $b){ ?>
                      <option value=<?php echo $b['id']; ?> 
                      <?php 
                      if($item['brand']==$b['id'])
                      {
                       echo "selected";
                      }
                      ?>
                      ><?php echo $b['Name']; ?></option>
                     <?php } ?>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label>Category</label>
                        <select class="form-control" name="category">
                        <?php foreach($category as $b){ ?>
                      <option value=<?php echo $b['id']; ?> 
                      <?php 
                      if($item['category']==$b['id'])
                      {
                       echo "selected";
                      }
                      ?>
                      ><?php echo $b['Name']; ?></option>
                     <?php } ?>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label>Design</label>
                   <select class="form-control" name="design">
                        <?php foreach($design as $b){ ?>
                      <option value=<?php echo $b['id']; ?>
                      <?php 
                      if($item['design']==$b['id'])
                      {
                       echo "selected";
                      }
                      ?>
                      ><?php echo $b['Name']; ?></option>
                     <?php } ?>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label>Color</label>
                    <select class="form-control" name="color">
                        <?php foreach($color as $b){ ?>
                      <option value=<?php echo $b['id']; ?> 
                      <?php 
                      if($item['color']==$b['id'])
                      {
                       echo "selected";
                      }
                      ?>
                      ><?php echo $b['Name']; ?></option>
                     <?php } ?>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label>Size</label>
                    <select class="form-control" name="size">
                        <?php foreach($size as $b){ ?>
                      <option value=<?php echo $b['id']; ?> 
                      <?php 
                      if($item['size']==$b['id'])
                      {
                       echo "selected";
                      }
                      ?>
                      ><?php echo $b['Name']; ?></option>
                     <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Set</label>
                    <select class="form-control" name="sets">
                        <?php foreach($sets as $b){ ?>
                      <option value=<?php echo $b['id']; ?> 
                      <?php 
                      if($item['sets']==$b['id'])
                      {
                       echo "selected";
                      }
                      ?>
                      ><?php echo $b['Name']; ?></option>
                     <?php } ?>
                    </select>
                  </div>
                  
            <div class="form-group">

                <label for="name" class="col-sm-2 control-label">Price</label>

                <div class="col-12">

                  <input type="text" name="price" class="form-control" id="price" placeholder="" value="<?php 
                  echo $item['price'];
                  ?>">

                </div>

              </div>
              
              <div class="form-group">

                <div class="col-md-12">

                  <input type="submit" name="submit" value="Update Stock Item" class="btn btn-info pull-right">

                </div>

              </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.box-body -->
      </div>
    </section>
  </div> 