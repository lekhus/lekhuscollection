<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card">
      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Color List</h3>
        </div>
        <div class="d-inline-block float-right">
          <div class="btn-group margin-bottom-20"> 
            <a href="<?= base_url() ?>admin/users/create_users_pdf" class="btn btn-secondary">Export as PDF</a>
            <a href="<?= base_url() ?>admin/users/export_csv" class="btn btn-secondary">Export as CSV</a>
          </div>
          <a href="<?= base_url('admin/color/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Color</a>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body table-responsive">
        <table id="na_datatable" class="table table-bordered table-striped" width="100%">
          <thead>
            <tr>
              <th>#ID</th>
              <th>Color Name</th>
              <th>Created Date</th>
              <th width="100" class="text-right">Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>  
</div>


<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>
  //---------------------------------------------------
  var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": "<?=base_url('admin/color/datatable_json')?>",
    "order": [[0,'desc']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "name", 'searchable':true, 'orderable':true},
    { "targets": 2, "name": "created_at", 'searchable':false, 'orderable':false},
    { "targets": 3, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });
</script>



