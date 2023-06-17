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
          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Customer Orders List</h3>
        </div>
        <div class="d-inline-block float-right">
          <div class="btn-group margin-bottom-20"> 
            <a href="<?= base_url() ?>admin/users/create_users_pdf" class="btn btn-secondary">Export as PDF</a>
            <a href="<?= base_url() ?>admin/users/export_csv" class="btn btn-secondary">Export as CSV</a>
          </div>
          <!--<a href="<?php //echo base_url('admin/customerOrder/printAllCustomerOrders').'?c_id='.$customer_id; ?>" class="btn btn-dark"><i class="fa fa-print" aria-hidden="true"></i> Print All Orders</a>-->
        </div>
        
        <!--search form starts-->
        <div class="">

            <h5 class="mt-4">Customer Details: </h5>
            <table class="table">
                <tr>
                    <th>Name: </th>
                    <td><?php echo $c_data['Name']; ?></td>
                </tr>
                
                <tr>
                    <th>Mobile No.: </th>
                    <td><?php echo $c_data['mobile']; ?></td>
                </tr>
                
                <tr>
                    <th>Address: </th>
                    <td><?php echo $c_data['address']; ?></td>
                </tr>
                


            </table>
            
        </div>
        <!-- search form ends-->
      </div>
    </div>
    <div class="card">
     
      <div class="card-body table-responsive">
        
       <div class="accordion" id="accordionExample"> 
       

        <?php 
        if(!empty($order_data)){
        $i=0;
                
        ?>
        
       
  <div class="card">
    <div class="card-header bg-success" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link text-white" style="width:100%; text-align:left;" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapseOne">
          <b>Order: </b><?php echo $order_no; ?>
          <a href="<?php echo base_url('admin/customerOrder/printCustomerOrder').'?c_id='.$customer_id.'&o_id='.$order_no; ?>" class="btn btn-dark"><i class="fa fa-print" aria-hidden="true"></i> Print this order</a>
          
          <i class="fa fa-plus float-right" style="margin-top:5px;" aria-hidden="true"></i>
        </button>
        
      </h5>
    </div>
    
    
    <div id="collapse<?php echo $i; ?>" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
            <table class="table responsive-table">
                <thead>
                    <th>Item Id</th>
                    <th>Stock Item Name</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Design</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Quantity</th>
                    <th>Sets</th>
                    <th>Total Pcs.</th>
                </thead>
                
                <tbody>
                
        <?php 
        
            $item_data = $order_data;
            
            
            
            foreach($item_data as $item){    
                
                $item_details = $this->master_model->get_item_by_id($item['item_id']);
                
        ?>
        
            <tr>
                <td><?php echo $item_details['id']; ?></td>
                <td><?php echo $item_details['Name']; ?></td>
                <td><?php
                    $brand_details = $this->master_model->get_brand_by_id($item_details['brand']);
                    echo $brand_details['Name']; ?></td>
                <td><?php
                    $category_details = $this->master_model->get_category_by_id($item_details['category']);
                    echo $category_details['Name'];?></td>
                     <td><?php
                    $design_details = $this->master_model->get_design_by_id($item_details['design']);
                    echo $design_details['Name'];?></td>
                     <td><?php
                    $size_details = $this->master_model->get_size_by_id($item_details['size']);
                    echo $size_details['Name'];?></td>
                     <td><?php
                    $color_details = $this->master_model->get_color_by_id($item_details['color']);
                    echo $color_details['Name'];?></td>
                     <td><?php
                     
                    $set_details = $this->master_model->get_sets_by_id($item_details['sets']);
                    echo $set_details['Name'];?></td>
                     <td><?php echo $item['qty'] ; ?></td>
                     <td><?php echo $item['qty'] * $set_details['Name']; ; ?></td>
                    
                
                
            </tr>
        
            
            <?php
            }
            ?>
        
            </tbody>
            </table>
        
      </div>
    </div>
  </div>
    <?php
        
        
        }
        
        else {
                echo '<h3 class="text-center"> No orders is placed yet! </h3>';
        }
    ?>
    </div>
      </div>
    </div>
  </section>  
</div>


<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>





