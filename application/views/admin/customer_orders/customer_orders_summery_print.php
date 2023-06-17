
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
                page-break-after: always;
            }
        }
        
     </style>
    
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
       
       <h5 class="sec-title">Brands </h5>
       
  <div class="card">

    <div id="collapse<?php echo $i; ?>" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
            <table class="table responsive-table">
                <thead>
                    <th>Brand</th>
                    <th>Total Pcs.</th>
                </thead>
                
                <tbody>
                
        <?php 
            foreach($brands as $brand){    
                
              
        ?>
        
            <tr>
                <td><?php echo $brand['Name']; ?></td>
                <td><?php 
                $total=$this->master_model->get_totalitem_group_by_item_brand($c_data['id'],$brand['Name']);
               // var_dump($total);
                if($total[0]['total']==null)
                echo 0;
                else
                echo $total[0]['total']; ?></td>
                
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

</body>



