<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" integrity="sha512-Velp0ebMKjcd9RiCoaHhLXkR1sFoCCWXNp6w4zj1hfMifYB5441C+sKeBl/T/Ka6NjBiRfBBQRaQq65ekYz3UQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Content Wrapper. Contains page content -->
<style>
    .modal-footer {
   justify-content: center;
   font-weight:600;
}
</style>
<div class="content-wrapper">
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card">
      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Stock item Search By design</h3>
        </div>
        <div class="d-inline-block float-right">
          <div class="btn-group margin-bottom-20"> 
            <a href="<?= base_url() ?>admin/users/create_users_pdf" class="btn btn-secondary">Export as PDF</a>
            <a href="<?= base_url() ?>admin/users/export_csv" class="btn btn-secondary">Export as CSV</a>
          </div>
          <a href="<?= base_url('admin/item/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Stock item</a>
        </div>
        <!--search form starts-->
        <div class="d-block col-md-6 mt-4">
             <?php echo form_open(base_url('admin/item/search'), ['method' => 'get'], 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <input type="text" class="form-control" name="design-name" value="<?php echo $query; ?>" id="design-name" placeholder="Search by design">
              </div>
              
              <button type="submit" class="btn btn-primary">Search</button>
            <?php echo form_close(); ?>
        </div>       
        <!--search form ends-->
      </div>
    </div>
    <div class="card">
      <div class="card-body table-responsive">
          
          <?php //var_dump($item_data); 
            
          ?>
        <table id="na_datatable" class="table table-bordered table-striped" width="100%">
          <thead>
              
            <tr>
              <th>#ID</th>
              <th>Stock item Name</th>
              <th>Brand</th>
              <th>Category</th>
              <th>Design</th>
              <th>Size</th>
              <th>Color</th>
              <th>Sets</th>
              <th>price</th>
              <th>Qrcode</th>
              <th>Created Date</th>
              <th width="100" class="text-right">Action</th>
            </tr>
          </thead>
          <tbody>
              
              <?php 
                $i=0;
                if(!empty($item_data)){
                    foreach($item_data as $item){
                    $i++;
                
              ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $item['Name']; ?></td>
                <td>
                    <?php
                        $brand = $this->master_model->get_brand_by_id($item['brand']);
                        echo $brand['Name']; 
                    ?>
                </td>
                <td>
                    <?php
                        $category = $this->master_model->get_category_by_id($item['category']);
                        echo $category['Name']; 
                    ?>
                </td>
                <td>
                    <?php
                        $design = $this->master_model->get_design_by_id($item['design']);
                        echo $design['Name']; 
                    ?>
                </td>
                <td>
                    <?php
                        $size = $this->master_model->get_size_by_id($item['size']);
                        echo $size['Name']; 
                    ?>
                </td>
                <td>
                    <?php
                        $color = $this->master_model->get_color_by_id($item['color']);
                        echo $color['Name']; 
                    ?>
                </td>
                <td>
                    <?php
                        
                        echo $item['sets'];
                    ?>
                </td>
                <td>
                    <?php
                        echo $item['price'];
                    ?>
                </td>
                <td>
                    <a href="<?php echo base_url().$item['qradd']; ?>" data-toggle="lightbox" data-footer="<?php echo $item['code']; ?>">
                        <img src="<?php echo base_url().$item['qradd']; ?>" width="40px" height="40px" />
                        </a>
                    <a title="Print" class="update btn btn-sm btn-warning" href="<?php echo base_url('/admin/item/printqr/').$item['id']; ?>"> <i class="fa fa-print"></i></a>
                </td>
                <td><?php echo date('M d, Y', strtotime($item['created_at'])); ?></td>
                <td>
                    <a title="View" class="view btn btn-sm btn-info" href="<?php echo base_url('/admin/item/edit/').$item['id'] ?>"> <i class="fa fa-eye"></i></a>
				<a title="Edit" class="update btn btn-sm btn-warning" href="<?php echo base_url('/admin/item/edit/').$item['id'] ?>"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href="<?php echo base_url('/admin/item/delete/').$item['id'] ?>" onclick="return confirm('Do you want to delete ?')"> <i class="fa fa-trash-o"></i></a>
				</td>
            </tr>
            <?php 
                    }
                }
                
                else {
                    
                    echo '<tr class="text-center"><td colspan="12"><h3>No result found of: </h3><b>'.$query. "</b></tr></td>";
                
                }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>  
</div>


<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js" integrity="sha512-YibiFIKqwi6sZFfPm5HNHQYemJwFbyyYHjrr3UT+VobMt/YBo1kBxgui5RWc4C3B4RJMYCdCAJkbXHt+irKfSA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  //---------------------------------------------------
//   var table = $('#na_datatable').DataTable( {
//     "processing": true,
//     "serverSide": true,
//     "ajax": "<?=base_url('admin/item/datatable_json')?>",
//     "order": [[0,'desc']],
//     "columnDefs": [
//     { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
//     { "targets": 1, "name": "name", 'searchable':true, 'orderable':true},
//     { "targets": 2, "name": "brand", 'searchable':true, 'orderable':true},
//     { "targets": 3, "name": "category", 'searchable':true, 'orderable':true},
//     { "targets": 4, "name": "design", 'searchable':true, 'orderable':true},
//     { "targets": 5, "name": "size", 'searchable':true, 'orderable':true},
//     { "targets": 6, "name": "color", 'searchable':true, 'orderable':true},
//     { "targets": 7, "name": "sets", 'searchable':true, 'orderable':true},
//     { "targets": 8, "name": "price", 'searchable':true, 'orderable':true},
//     { "targets": 9, "name": "qradd", 'searchable':true, 'orderable':true},
//     { "targets": 10, "name": "created_at", 'searchable':false, 'orderable':false},
//     { "targets": 11, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
//     ]
//   });
</script>
<script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });
</script>


