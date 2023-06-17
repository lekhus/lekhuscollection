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
          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Stock item List</h3>
        </div>
        <div class="d-inline-block float-right">
          <div class="btn-group margin-bottom-20">
            <a href="<?= base_url() ?>admin/users/create_users_pdf" class="btn btn-secondary">Export as PDF</a>
            <a href="<?= base_url() ?>admin/users/export_csv" class="btn btn-secondary">Export as CSV</a>
          </div>
           <a href="<?= base_url() ?>uploads/download/item.csv" download="item.csv" class="btn btn-info">Download Sample CSV</a>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Import CSV</button>
             
          <a href="<?= base_url('admin/item/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Stock item</a>
        </div>
        <!--search form starts-->
        <div class="d-block col-md-6 mt-4">
             <?php echo form_open(base_url('admin/item/search'), ['method' => 'get'], 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <input type="text" class="form-control" name="design-name" id="design-name" placeholder="Search by design">
              </div>
              
              <button type="submit" class="btn btn-primary">Search</button>
            <?php echo form_close(); ?>
        </div>       
        <!--search form ends-->
      </div>
    </div>
    <div class="card">
      <div class="card-body table-responsive">
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
        </table>
      </div>
    </div>
  </section>  
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Import Items CSV File</h4>
      </div>
      <div class="modal-body">
           <?php echo form_open_multipart(base_url('admin/item/uploadcsv'), 'class="form-horizontal"');  ?> 
     <input type='file' name='file' class="form-control">
     <input type='submit' value='Upload' name='upload' class="btn btn-success">
   <?php echo form_close(); ?>
   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js" integrity="sha512-YibiFIKqwi6sZFfPm5HNHQYemJwFbyyYHjrr3UT+VobMt/YBo1kBxgui5RWc4C3B4RJMYCdCAJkbXHt+irKfSA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  //---------------------------------------------------
  var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": "<?=base_url('admin/item/datatable_json')?>",
    "order": [[0,'desc']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "name", 'searchable':true, 'orderable':true},
    { "targets": 2, "name": "brand", 'searchable':true, 'orderable':true},
    { "targets": 3, "name": "category", 'searchable':true, 'orderable':true},
    { "targets": 4, "name": "design", 'searchable':true, 'orderable':true},
    { "targets": 5, "name": "size", 'searchable':true, 'orderable':true},
    { "targets": 6, "name": "color", 'searchable':true, 'orderable':true},
    { "targets": 7, "name": "sets", 'searchable':true, 'orderable':true},
    { "targets": 8, "name": "price", 'searchable':true, 'orderable':true},
    { "targets": 9, "name": "qradd", 'searchable':false, 'orderable':false},
    { "targets": 10, "name": "created_at", 'searchable':false, 'orderable':false},
    { "targets": 11, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });
</script>
<script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });
</script>


