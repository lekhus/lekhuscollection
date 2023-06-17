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
					    $orderdd=$this->master_model->get_all_orderss_of_user($result['admin_id']);
					    $orderscount=count($orderdd);
					    
						$admin_data = array(
							'admin_id' => $result['admin_id'],
							'username' => $result['username'],
							'ordernostart' => $orderscount,
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
				    
				}
				
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
				    
				}
				
		    $data['updated']="true";
		    
		    echo json_encode($data);
		}

	}  // end class


?>