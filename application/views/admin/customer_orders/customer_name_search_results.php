<!-- DataTables -->
<link rel="stylesheet" href="<?php echo  base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card">
      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Customer List</h3>
        </div>
        <div class="d-inline-block float-right">
          <div class="btn-group margin-bottom-20"> 
            <a href="<?php echo  base_url() ?>admin/users/create_users_pdf" class="btn btn-secondary">Export as PDF</a>
            <a href="<?php echo  base_url() ?>admin/users/export_csv" class="btn btn-secondary">Export as CSV</a>
          </div>
          
        </div>
        
       
      </div>
    </div>
    <div class="card">
        
      <div class="card-body table-responsive">
        
       <div class="accordion" id="accordionExample"> 
       
       <h5 class="">: </h5>
        
        
       
  <div class="card">
    <div class="card-header bg-success" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link text-white" style="width:100%; text-align:left;" type="button" data-toggle="collapse" data-target="#collapse" aria-expanded="true" aria-controls="collapseOne">
          <b>Search results for: <?php echo $query; ?> </b>
          
          
          <i class="fa fa-plus float-right" style="margin-top:5px;" aria-hidden="true"></i>
        </button>
        
      </h5>
    </div>
    
    
    <div id="collapse" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
            <table class="table responsive-table">
                <thead>
                    <th>Customer Id</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Get Order</th>
                </thead>
                
                <tbody>
                <?php 
                    if(!empty($customers_list)){
                    foreach($customers_list as $customer){
                ?>
                <tr>
                <td><?php echo $customer['id']; ?></td>
                <td><?php echo $customer['Name']; ?></td>
                <td><?php echo $customer['address']; ?></td>
                <td><a href="
                    <?php echo base_url('admin/customerOrder?').'c_id='.$customer['id']; ?>" class="btn btn-info">Get Today's Order</a></td>
                </tr>
                <?php 
                    }
                     }
                
                
                
                
                ?>
        
            </tbody>
            </table>
        
      </div>
    </div>
  </div>
        </div>
      </div>
    </div>
  </section>  
</div>


<!-- DataTables -->
<script src="<?php echo  base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo  base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>
  //---------------------------------------------------
  var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": "<?php echo base_url('admin/orders/datatable_json')?>",
    "order": [[0,'desc']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "order_no", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "customer", 'searchable':true, 'orderable':true},
    { "targets": 2, "name": "created_at", 'searchable':false, 'orderable':false},
    { "targets": 3, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });
</script>



