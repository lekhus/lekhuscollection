  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Main content -->

    <section class="content">

      <div class="card card-default color-palette-bo">

        <div class="card-header">

          <div class="d-inline-block">

              <h3 class="card-title"> <i class="fa fa-plus"></i>

              Add New Stock Item </h3>

          </div>

          <div class="d-inline-block float-right">

            <a href="<?= base_url('admin/item'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Stock Items List</a>

          </div>

        </div>

        <div class="card-body">   

           <!-- For Messages -->

            <?php $this->load->view('admin/includes/_messages.php') ?>



            <?php echo form_open_multipart(base_url('admin/item/add'), 'class="form-horizontal"');  ?> 

              
                <div class="form-group">
                    <label>Brand</label>
                    <select class="form-control" name="brand">
                        <?php foreach($brand as $b){ ?>
                      <option value=<?php echo $b['id']; ?> ><?php echo $b['Name']; ?></option>
                     <?php } ?>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label>Category</label>
                        <select class="form-control" name="category">
                        <?php foreach($category as $b){ ?>
                      <option value=<?php echo $b['id']; ?> ><?php echo $b['Name']; ?></option>
                     <?php } ?>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label>Design</label>
                   <select class="form-control" name="design">
                        <?php foreach($design as $b){ ?>
                      <option value=<?php echo $b['id']; ?> ><?php echo $b['Name']; ?></option>
                     <?php } ?>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label>Color</label>
                    <select class="form-control" name="color">
                        <?php foreach($color as $b){ ?>
                      <option value=<?php echo $b['id']; ?> ><?php echo $b['Name']; ?></option>
                     <?php } ?>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label>Size</label>
                    <select class="form-control" name="size">
                        <?php foreach($size as $b){ ?>
                      <option value=<?php echo $b['id']; ?> ><?php echo $b['Name']; ?></option>
                     <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Set</label>
                    <select class="form-control" name="sets">
                        <?php foreach($sets as $b){ ?>
                      <option value=<?php echo $b['id']; ?> ><?php echo $b['Name']; ?></option>
                     <?php } ?>
                    </select>
                  </div>
                  
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Price</label>
                <div class="col-12">
                  <input type="text" name="price" class="form-control" id="price" placeholder="">
                </div>
              </div>
              
              
              
              
              <div class="form-group">
            <label for="icon">Image:</label>
            <input type="file" class="form-control-file" onchange="previewImage(this)" name="icon" id="icon" />
            <img src="#" id="icon-preview" alt="image" style="width:100px; height:auto;" />
          </div>
              
              <div class="form-group">

                <div class="col-md-12">

                  <input type="submit" name="submit" value="Add Stock Item" class="btn btn-info pull-right">

                </div>

              </div>

            <?php echo form_close( ); ?>

          <!-- /.box-body -->

        </div>

    </section> 

  </div>
  <script>
  
  $(document).ready(function(){
      
      $('#icon-preview').hide();
      
  });
  
  
  function previewImage(input) {

    if (input.files && input.files[0]) {

      $('#icon-preview').show();

      var reader = new FileReader();

      reader.onload = function(e) {
        $('#icon-preview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }else{
      $('#icon-preview').hide();
    }

  }
  
  </script>