
<!-- Content Wrapper. Contains page content -->

 <body onLoad="window.print();">
     <style>
        .card-title {
            text-align: center;
            font-size: 32px;
        }
        
        .sec-title{
            font-size:24px;
        }
        
        .customer-details table {
            
            text-align: left;
            width: 100%;
        }
        
        .two-tables {
            display: flex;
            justify-content: flex-start;
            width: 100%;
            align-items:top;
            
            
        }
        
        .customer-details{
            padding-bottom:15px;
            border-bottom:2px solid #000;
        }
        
        body{
            padding:30px 40px;    
        
        }
        
        @print {
            @page :footer {
                display: none
            }
         
            @page :header {
                display: none
            }
        }
        
        table{
            width:100%;
        }
        
        .items-data th {
            text-align: left;
        }
        
        .items-data td, .items-data th{
            border:1px solid black;
            padding:5px 8px;
            
        }
        
        .items-data table{
            border-collapse:collapse;
        }
        
        
        @media print{
            .content-wrapper{
                height:100%;
            }
        }
        
     </style>
     <?php 
        if(!empty($order_data)){
        $i=0;
            foreach($order_data as $order){
                $i++;
                
                
                
            
        ?>
<div class="content-wrapper">
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card">
      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Customer Orders List</h3>
        </div>
        <!--<div class="d-inline-block float-right">-->
        <!--  <div class="btn-group margin-bottom-20"> -->
        <!--    <a href="<?= base_url() ?>admin/users/create_users_pdf" class="btn btn-secondary">Export as PDF</a>-->
        <!--    <a href="<?= base_url() ?>admin/users/export_csv" class="btn btn-secondary">Export as CSV</a>-->
        <!--  </div>-->
        <!--  <a href="<?= base_url('admin/orders/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Customer Orders</a>-->
        <!--</div>-->
        
        <!--search form starts-->
        <div class="customer-details">
            <h5 class="mt-4 sec-title">Customer Details: </h5>
            
            <div class="two-tables">
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
                        <th>Brand </th>
                        <td><?php
                            $first_order_data = $this->master_model->get_order_item_by_order_id($order['order_no'])[0];
                            $first_item_data = $this->master_model->get_item_by_id($first_order_data['item_id']);
                            $first_brand_details = $this->master_model->get_brand_by_id($first_item_data['brand']);
                            echo $first_brand_details['Name'];
                             ?>
                        </td>
                    </tr>
                    
                    
                </table>
                
                <table class="table float-right">
                    
                    <tr>
                        <th>Address: </th>
                        <td><?php echo $c_data['address']; ?></td>
                    </tr>
                    
                    
                </table>
            </div>
            
        </div>
        <!-- search form ends-->
      </div>
    </div>
    <div class="card items-data">
        <!--<?php var_dump($order_data); ?>-->
      <div class="card-body table-responsive">
        
       <div class="accordion" id="accordionExample"> 
       
       <h5 class="sec-title">Orders: </h5>
        <?php 
        // if(!empty($order_data)){
        // $i=0;
        //     foreach($order_data as $order){
        //         $i++;
                
                
                
            
        ?>
        
       
  <div class="card">
    <div class="card-header bg-success" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link text-white" style="width:100%; text-align:left;" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapseOne">
          <b>Order: </b><?php echo $order['order_no']; ?>
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
        
            $item_data = $this->master_model->get_order_item_by_order_id($order['order_no']);
        
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
    
    </div>
      </div>
    </div>
  </section>  
</div>
<?php
        }
        
        }
        
        else {
                echo '<h3 class="text-center"> No orders is placed yet! </h3>';
        }
    ?>
</body>



