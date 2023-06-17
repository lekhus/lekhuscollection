<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MY_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->model('admin/auth_model', 'auth_model');
		$this->load->model('admin/master_model', 'master_model');
		
	}

	//--------------------------------------------------------------
	public function login(){
				$data = array(
					'username' => $this->input->get('username'),
					'password' => $this->input->get('password')
				);
				$result = $this->auth_model->login($data);
				if($result){

					if($result['is_active'] == 0){
						$response['errors']="Account is disabled by Admin!";
	                         echo json_encode($response);
					}
					else
					{
					if($result['is_admin'] == 1){
					   // $orderdd=$this->master_model->get_all_orderss_of_user($result['admin_id']);
					   // $orderscount=count($orderdd);
					    
						$admin_data = array(
							'admin_id' => $result['admin_id'],
							'username' => $result['username'],
							'ordernostart' => $result['token'],
							'is_admin_login' => TRUE
						);
						    $response['admin_data']=$admin_data;
	                         echo json_encode($response);
						}
					}
					}
					else{
					
							    $response['errors']="Invalid Username or Password!";
	                         echo json_encode($response);
					}
				
		
	    
		}
		
		public function orders()
		{
		    $admin_id= $this->input->get('adminid');
		    $result = $this->master_model->get_all_today_order($admin_id);
		    $data['orders']=$result;
		    echo json_encode($data);
		}
		
		public function saveorders()
		{
		    
		    $order_no= $this->input->get('order_id');
		    $customer_id = $this->input->get('customer_id');
		    $admin_id = $this->input->get('admin_id');
		     $order_products = $this->input->get('order_products');
		     $created_at = $this->input->get('created_at');
		    
			 
		   	$order = array(
					'order_no' => $order_no,
					'customer_id' => $customer_id,
					'admin_id' => $admin_id,
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s')
				);
				
				$order = $this->security->xss_clean($order);
				$result = $this->master_model->add_orders($order);
				
				$order_id=$this->db->insert_id();
				
				$order_items = explode("|", $order_products);
				
				for($i=0;$i<sizeof($order_items);$i++)
				{
				    $item_details = explode("-", $order_items[$i]);
				    
				    $itemdata = array(
					'order_no' => $order_no,
					'item_id' => $item_details[0],
					'qty' => $item_details[1],
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s')
				);
				
				    $result = $this->master_model->add_order_products($itemdata);
				    
				    // addding data to report starts
				    
				        
				    $item_id = $item_details[0];
				    
				    $customer_data = $this->master_model->get_customer_by_id($customer_id);
				    $item_data = $this->master_model->get_item_by_id($item_id);
				    $brand_data = $this->master_model->get_brand_by_id($item_data['brand']);
				    $category_data = $this->master_model->get_category_by_id($item_data['category']);
				    $design_data = $this->master_model->get_design_by_id($item_data['design']);
				    $size_data = $this->master_model->get_size_by_id($item_data['size']);
				    $color_data = $this->master_model->get_color_by_id($item_data['color']);
				    $set_data = $this->master_model->get_sets_by_id($item_data['sets']);
				    
				    
				    $customer_name = $customer_data['Name'];
				    $customer_mobile = $customer_data['mobile'];
				    $customer_address = $customer_data['address'];
				    
				    $item_name = $item_data['Name'];
				    $brand = $brand_data['Name'];
				    $category = $category_data['Name'];
				    $design = $design_data['Name'];
				    $size = $size_data['Name'];
				    $color = $color_data['Name'];
				    $sets = $set_data['Name'];
				    $qty = $qty[$i];
				    $code = $item_data['code'];
				    $created_at = date('Y-m-d : h:m:s');
				    $updated_at = date('Y-m-d : h:m:s');
 
				    $report_data = [
				       
				        'customer_name' => $customer_name,
				        'customer_mobile' => $customer_mobile,
				        'customer_address' => $customer_address,
				        'customer_id' => $customer_id,
				        'order_no' => $order_no,
				        'item_id' => $item_id,
				        'item_name' => $item_name,
				        'brand' => $brand,
				        'category' => $category,
				        'design' => $design,
				        'size' => $size,
				        'color' => $color,
				        'sets' => $sets,
				        'qty' => $item_details[1],
				        'code' => $code,
				        'created_at' => $created_at,
				        'updated_at' => $updated_at,
						'admin_id' => $this->input->get('admin_id'),
				        ];
				        
				        $this->master_model->add_report_data($report_data);				    
				    // adding data to report ends
				}
				
				 $tok=1;
    		    $result = $this->auth_model->get_token_no($admin_id);
				 $tok=$result['token']+1;
				$rr= $this->auth_model->update_order_no($tok, $admin_id);
				
		    $data['saved']="true";
		    
		    echo json_encode($data);
		}
		
		public function editorders()
		{
		    
		    $order_no= $this->input->get('order_id');
		    $customer_id = $this->input->get('customer_id');
		    $admin_id = $this->input->get('admin_id');
		     $order_products = $this->input->get('order_products');
		     $created_at = $this->input->get('created_at');
		    
		    $order_details=$this->master_model->get_orders_by_order_no($order_no);
		    
				 if(count($order_details))
		    {
		        $order = array(
					'order_no' => $order_no,
					'customer_id' => $customer_id,
					'admin_id' => $admin_id,
					'updated_at' => date('Y-m-d : h:m:s')
				);
				
				$order = $this->security->xss_clean($order);
		       $result = $this->master_model->edit_orders_by_order_no($order , $order_no);
		       	$r=$this->master_model->delete_order_products_of_order($order_no);
		       	$rt=$this->master_model->delete_order_products_of_report($order_no);
		       	
		    }
		    else
		    {
		        $order = array(
					'order_no' => $order_no,
					'customer_id' => $customer_id,
					'admin_id' => $admin_id,
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s')
				);
				
				$order = $this->security->xss_clean($order);
		        	$result = $this->master_model->add_orders($order);
		        
		    }

				$order_items = explode("|", $order_products);
				$this->master_model->delete_report_data($order_no);
				
				for($i=0;$i<sizeof($order_items);$i++)
				{
				    $item_details = explode("-", $order_items[$i]);
				    $itemdata = array(
					'order_no' => $order_no,
					'item_id' => $item_details[0],
					'qty' => $item_details[1],
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s')
				);
				
				    $result = $this->master_model->add_order_products($itemdata);
				    
				    // edit report starts
				    
				    $item_id = $item_details[0];
				    
				    $customer_data = $this->master_model->get_customer_by_id($customer_id);
				    $item_data = $this->master_model->get_item_by_id($item_id);
				    $brand_data = $this->master_model->get_brand_by_id($item_data['brand']);
				    $category_data = $this->master_model->get_category_by_id($item_data['category']);
				    $design_data = $this->master_model->get_design_by_id($item_data['design']);
				    $size_data = $this->master_model->get_size_by_id($item_data['size']);
				    $color_data = $this->master_model->get_color_by_id($item_data['color']);
				    $set_data = $this->master_model->get_sets_by_id($item_data['sets']);
				    
				    
				    $customer_name = $customer_data['Name'];
				    $customer_mobile = $customer_data['mobile'];
				    $customer_address = $customer_data['address'];
				    
				    $item_name = $item_data['Name'];
				    $brand = $brand_data['Name'];
				    $category = $category_data['Name'];
				    $design = $design_data['Name'];
				    $size = $size_data['Name'];
				    $color = $color_data['Name'];
				    $sets = $set_data['Name'];
				    $qty = $qty[$i];
				    $code = $item_data['code'];
				    $created_at = date('Y-m-d : h:m:s');
				    $updated_at = date('Y-m-d : h:m:s');
				    
				    $report_data = [
				       
				        'customer_name' => $customer_name,
				        'customer_mobile' => $customer_mobile,
				        'customer_address' => $customer_address,
				        'customer_id' => $customer_id,
				        'order_no' => $order_no,
				        'item_id' => $item_id,
				        'item_name' => $item_name,
				        'brand' => $brand,
				        'category' => $category,
				        'design' => $design,
				        'size' => $size,
				        'color' => $color,
				        'sets' => $sets,
				        'qty' => $item_details[1],
				        'code' => $code,
				        'created_at' => $created_at,
				        'updated_at' => $updated_at,
						'admin_id' => $this->input->get('admin_id'),
				        ];
				        
				        $this->master_model->add_report_data($report_data);
				    
				    // edit report ends
				    
				}
				
		    $data['updated']="true";
		    
		    echo json_encode($data);
		}
		
		// ----------------------------------------
		
		public function check_post(){
		    
    		    $orders = json_decode($this->input->post('orders'),true);
    		    
    		   for($i=0;$i<count($orders);$i++)
    		    {
    		     $order_no = $orders[$i]['order_no'];
    		      $customer_id = $orders[$i]['client_id'];
    		      $admin_id = $orders[$i]['admin_id'];
    		      $created_at = date('Y-m-d : h:m:s');
    		      $order_items = explode("|", $orders[$i]['items']);
    		      
    		      $order_details=$this->master_model->get_orders_by_order_no($order_no);
    		      
		     	 
    		       		     	//  if starts
    		     	if($order_details!=null)
        		    {
        		        $order = array(
        					'order_no' => $order_no,
        					'customer_id' => $customer_id,
        					'admin_id' => $admin_id,
        					'updated_at' => date('Y-m-d : h:m:s')
        				);
        				
        				$order = $this->security->xss_clean($order);
        		        $result = $this->master_model->edit_orders_by_order_no($order , $order_no);
        		       	$r=$this->master_model->delete_order_products_of_order($order_no);
        		        
        		    }
    		     	// if ends
    		     	
    		     	// else starts
    		     	
    		     	else
		    {
		        $order = array(
					'order_no' => $order_no,
					'customer_id' => $customer_id,
					'admin_id' => $admin_id,
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s')
				);
				
				$order = $this->security->xss_clean($order);
		        	$result = $this->master_model->add_orders($order);
		        	
				
		    
		    
		    $tok=1;
		        $resu = $this->auth_model->get_token_no($admin_id);
				 $tok=$resu['token']+1;
				// $po=$this->auth_model->update_order_no($tok, $admin_id);
		    }
		    
				$this->master_model->delete_report_data($order_no);
				
				for($j=0;$j<count($order_items);$j++){
                		        
            		 $item_details = explode("-", $order_items[$j]);
                		     	  
                    $itemdata = array(
    					'order_no' => $order_no,
    					'item_id' => $item_details[0],
    					'qty' => $item_details[1],
    					'created_at' => date('Y-m-d : h:m:s'),
    					'updated_at' => date('Y-m-d : h:m:s')
    				);
				
				
				    $result = $this->master_model->add_order_products($itemdata);
				    
				    // edit report starts
				    
				    $item_id = $item_details[0];
				    
				    $customer_data = $this->master_model->get_customer_by_id($customer_id);
				    $item_data = $this->master_model->get_item_by_id($item_id);
				    
				    
				    $brand_data = $this->master_model->get_brand_by_id($item_data['brand']);
				    $category_data = $this->master_model->get_category_by_id($item_data['category']);
				    $design_data = $this->master_model->get_design_by_id($item_data['design']);
				    $size_data = $this->master_model->get_size_by_id($item_data['size']);
				    $color_data = $this->master_model->get_color_by_id($item_data['color']);
				    $set_data = $this->master_model->get_sets_by_id($item_data['sets']);
				    
				     $customer_name = $customer_data['Name'];
				    $customer_mobile = $customer_data['mobile'];
				    $customer_address = $customer_data['address'];
				    
				    $item_name = $item_data['Name'];
				    $brand = $brand_data['Name'];
				    $category = $category_data['Name'];
				    $design = $design_data['Name'];
				    $size = $size_data['Name'];
				    $color = $color_data['Name'];
				    $sets = $set_data['Name'];
				    $itemQty = $item_details[1];
				   $code = $item_data['code'];
				    $created_at = date('Y-m-d : h:m:s');
				    $updated_at = date('Y-m-d : h:m:s');
				    
				    $report_data = array(
				        'customer_name' => $customer_name,
				        'customer_mobile' => $customer_mobile,
				        'customer_address' => $customer_address,
				        'customer_id' => $customer_id,
				        'order_no' => $order_no,
				        'item_id' => $item_id,
				        'item_name' => $item_name,
				        'brand' => $brand,
				        'category' => $category,
				        'design' => $design,
				        'size' => $size,
				        'color' => $color,
				        'sets' => $sets,
				        'qty' => $itemQty,
				        'code' => $code,
				        'created_at' => $created_at,
				        'updated_at' => $updated_at
				        );
				        $this->master_model->add_report_data($report_data);
				    // edit report ends
				}
				
		    
    		// for ends
    	
    		    }
    		    
    		    
    		    
    		 $data['updated']="Sync Successfully";
		    
		    echo json_encode($data);
		    
		}
		
		// -------------------------------------------
		
		public function itemlist(){
		    $result = $this->master_model->get_all_items_as_raw();
		    $data['items']=$result;
		    echo json_encode($data);
		}
		
		
			public function getsummery()
		{
		    $admin_id= $this->input->get('adminid');
		    $results = $this->master_model->get_order_details_group_by_item_brand($admin_id);
		    echo json_encode($results);
		}

	}  // end class


?>