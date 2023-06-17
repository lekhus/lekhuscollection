<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2/select2.min.css"> 
<script>
var product_data = {
    234234 : {
        name: 'name'
    }
}
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    
    <!--modal starts-->
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Fill item details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <div class="modal-body" style="max-height: 800px">
            <!--modal form starts-->
                
                  
                <div class="form-row">
                    
                  <div class="form-group col-md-6">
                    <label for="item-name">Item Name</label>
                    <select class="form-control" id="item-name">
                      <?php 
                        
                        foreach($item_data as $single_item){
                            
                        
                      ?>
                        
                        <option value="<?php echo $single_item['id']; ?>"><?php echo $single_item['id']; ?></option>
                      
                      <?php 
                        }
                      ?>
                        
                    </select>
                  </div>

                  
                  <div class="form-group col-md-6">
                    <label for="qty">Sets</label>
                    <input type="number" class="form-control" id="qty" placeholder="Sets" value=1>
                  </div>
                  
                </div>
                
            <!--modal form ends-->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="itemAddition" class="btn btn-primary">Add this Item</button>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_open(base_url('admin/orders/edit'), 'class="form-horizontal"');  ?> 
    <!--model ends-->
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
          <input type="submit" value="Save Order" class="btn btn-success" name="submit">
        </div>
        
        <!--search form starts-->
        <div class="">
            <input type="hidden" value="<?php echo $order_id; ?>" name="orderid" />
            <input type="hidden" value="<?php echo $customer_id; ?>" name="customerid" />
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
       
       <h5 class="mb-4">Orders: 
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-warning float-right" data-toggle="modal" data-target="#exampleModalCenter">
              Add Item
            </button>
       </h5>
        <?php 
        // var_dump($order_data);
        // echo "<hr>";
        // var_dump($order_data);
        if(!empty($order_data)){
        $i=0;
            // foreach($order_data as $order){
            $order = $order_data[0];
                $i++;
                
                
                
            
        ?>
        
       
  <div class="card">
    <div class="card-header bg-success" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link text-white" style="width:100%; text-align:left;" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapseOne">
          <b>Order: </b><?php echo $order['order_no']; ?>
          <a href="<?php echo base_url('admin/customerOrder/printCustomerOrder').'?c_id='.$customer_id.'&o_id='.$order['order_no']; ?>" class="btn btn-dark"><i class="fa fa-print" aria-hidden="true"></i> Print this order only</a>
          
          <i class="fa fa-plus float-right" style="margin-top:5px;" aria-hidden="true"></i>
        </button>
        
      </h5>
    </div>
    
    
    <div id="collapse<?php echo $i; ?>" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
            <table class="table responsive-table" id="ordertable">
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
                    <th>Delete</th>
                </thead>
                
                <tbody id="tbody">
               
                
        <?php 
        
            $item_data = $this->master_model->get_order_item_by_order_id($order['order_no']);
            
            $i = 0;
            foreach($item_data as $item){    
                $i++;
                $item_details = $this->master_model->get_item_by_id($item['item_id']);
                
                
        ?>
        
            <tr id="item-<?php echo $i; ?>" class="order-items">
                
                <td>
                    <input class="form-control" type="text" value="<?php echo $item_details['id']; ?>" name="item_id[]" readonly/>
                </td>
                <td><?php echo $item_details['Name']; ?>
                    
                </td>
                <td><?php
                    $brand_details = $this->master_model->get_brand_by_id($item_details['brand']);
                    echo $brand_details['Name']; ?>
                    
                    </td>
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
                     <td><input class="form-control" type="number" value="<?php echo $item['qty'] ; ?>" name="qty[]"/></td>
                    <td>
                        <button type="button" onclick="deleteItem('item-<?php echo $i; ?>');" class="btn btn-danger btn-sm">Delete Item</button>
                        
                    </td>
                    
                
            </tr>
        
            
            <?php
            }
            ?>
            <!--</form>-->
           
            </tbody>
            </table>
        
      </div>
    </div>
  </div>
    <?php
        //}
        
        }
        
        else {
                echo '<h3 class="text-center"> No orders is placed yet! </h3>';
        }
    ?>
    </div>
      </div>
    </div>
  </section>  
  <?php echo form_close( ); ?>
</div>


<script src="<?= base_url() ?>assets/plugins/select2/select2.min.js"></script>

<script>

// console.log(product_data);

function deleteItem(id){
    
    let total_item = $('.order-items').length;
    
    if(total_item<=1){
        alert('There must be at least one product!');
    }
    
    else{
        $('#'+id).fadeOut(function(){
            $('#'+id).remove()
        })
        ;    
    }
    
}



var rowIdx=<?php echo  $i; ?>;
// adding item
$('#itemAddition').click(function(){
    var item = $('#item-name option:selected').text();
    let itemid = $('#item-name').val();
    let qty = $('#qty').val();
    var urlr="<?=base_url('admin/item/getItemById/')?>"+itemid;
    
    $.ajax({url: urlr, 
                        success: function(result) {
                    console.log(result);
                    var obj = jQuery.parseJSON(result);
                    
$('#tbody').append('<tr id="item-'+ ++rowIdx +'"><td><input class="form-control" readonly type="text" value="'+itemid+'" name="item_id[]" readonly/> </td><td>'+item+'</td><td>'+obj.brand+'</td><td>'+obj.category+'</td><td>'+obj.design+'</td><td>'+obj.size+'</td><td>'+obj.color+'</td><td>'+obj.sets+'</td><td><input class="form-control" type="number" value="' + qty + '" name="qty[]"/></td><td><button type="button" onclick="deleteItem("item-${rowIdx}");" class="btn btn-danger btn-sm">Delete Item</button></td>    </tr>');
                }});

})

</script>

<script>
$(document).ready(function() {
    $('#item-name').select2({
dropdownParent: $("#exampleModalCenter")
});
});
</script>

