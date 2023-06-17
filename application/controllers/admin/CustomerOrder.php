<?php defined('BASEPATH') OR exit('No direct script access allowed');
class CustomerOrder extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->load->model('admin/master_model', 'master_model');

	}
	
	// ---------------------- Customer order SEARCH---------------------------------

	public function index(){
	    
	    $data['title'] = 'Customer Orders List';
	    $id = $this->input->get('c_id');
	    $c_data = $this->master_model->get_customer_by_id($id);
	    $o_data =  $this->master_model->get_all_orders_of_customer($id);	     
	    
	    $main_data['customer_id'] = $id;
	    $main_data['c_data'] = $c_data;
	    $main_data['order_data'] = $o_data;

		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/customer_orders/customer_orders_list', $main_data);
		$this->load->view('admin/includes/_footer');
	}
	
	
	// --------------------------------------
	
	public function getAllCustomersByName(){
	    
	    $customer_name = $this->input->get('c_name');
	    $customers_list = $this->master_model->get_similar_customer_by_name($customer_name);
	    
	    $data['title'] = 'Customer search results';
	    	     
	    $main_data['query'] = $customer_name;
	    $main_data['customers_list'] = $customers_list;
	    


		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/customer_orders/customer_name_search_results', $main_data);
		$this->load->view('admin/includes/_footer');
	}
	
	
    
    public function printAllCustomerOrders(){
        
          $data['title'] = 'Customer Orders List';
	    $id = $this->input->get('c_id');
	    $c_data = $this->master_model->get_customer_by_id($id);
	    $o_data =  $this->master_model->get_all_orders_of_customer($id);	     
	    
	    $main_data['customer_id'] = $id;
	    $main_data['c_data'] = $c_data;
	    $main_data['order_data'] = $o_data;

		$this->load->view('admin/customer_orders/customer_orders_list_print', $main_data);
    }
    
    public function printSummeryCustomerOrders(){
        
//           $data['title'] = 'Customer Orders List';
// 	    $id = $this->input->get('c_id');
// 	    $c_data = $this->master_model->get_customer_by_id($id);
// 	    $brands	= $this->master_model->get_all_brands();    
	    
// 	    $main_data['customer_id'] = $id;
// 	    $main_data['c_data'] = $c_data;
// 	    

// 		$this->load->view('admin/customer_orders/customer_orders_summery_print', $main_data);

    $data['title'] = 'Customer Orders Summery List';
	    $id = $this->input->get('c_id');
	    $c_data = $this->master_model->get_customer_by_id($id);
	    $brands	= $this->master_model->get_all_brands_for_select(); 
	    
	    $main_data['customer_id'] = $id;
	    $main_data['c_data'] = $c_data;
	   $main_data['brands'] = $brands;

		$this->load->view('admin/customer_orders/customer_orders_summery_print', $main_data);
    }
    
    public function printCustomerOrder(){
        
          $data['title'] = 'Customer Order List';
	    $c_id = $this->input->get('c_id');
	    $o_id = $this->input->get('o_id');
	    
	    
	    $c_data = $this->master_model->get_customer_by_id($c_id);
	    $o_data =  $this->master_model->get_order_item_by_order_id($o_id);	     
	    
	    
	     $main_data['order_no'] = $o_id;
	    $main_data['customer_id'] = $c_id;
	    $main_data['c_data'] = $c_data;
	    $main_data['order_data'] = $o_data;


		$this->load->view('admin/customer_orders/customer_single_order_print', $main_data);
		

        
    }
    
   
}


	?>