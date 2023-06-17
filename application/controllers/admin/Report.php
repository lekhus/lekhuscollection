<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Report extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->load->model('admin/master_model', 'master_model');

		
	}
	
	// ---------------------- Report ---------------------------------

	public function index(){
	    
	    
	    $data['title'] = 'Report Generation';

        
        $brands['brands'] = $this->master_model->get_all_brands_for_select();
        

		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/report/search_for_report', $brands);
		$this->load->view('admin/includes/_footer');
	}
	
	
	// --------------------------------------
	
public function orderReport(){
    
    $brand = $this->input->get('brand-name');

    $data = $this->master_model->get_order_report_data_by_brand_name($brand);
    
    
    $this->load->helper('csv');
        $export_arr = array();
        
        $title = array("Design", "Size", "Color", "Total Sets");
                        
        array_push($export_arr, $title);
        
        if (!empty($data)) {
            foreach ($data as $d) {
                $i=1;
                array_push($export_arr, array($d['design'], $d['size'], $d['color'], $d['sets'] * $d['qty']));
                $i++;
            }
        }
        convert_to_csv($export_arr, 'Order Report-' . date('F d Y') . '.csv', ',');
    
    
}

	// --------------------------------------
	
public function salesReport(){
    
    
    
    $brand = $this->input->get('brand-name');

    $data = $this->master_model->get_order_report_data_by_brand_name($brand);
    
    // var_dump($data);
    
    // die();
    
    $this->load->helper('csv');
        $export_arr = array();
        
        $title = array("ID", "Customer Name", "Place", "Order No.", "Date", "Brand", "Desgin", "Color", "Size", "Set");
                        
        array_push($export_arr, $title);
        
        if (!empty($data)) {
            foreach ($data as $d) {
                $i=1;
                array_push($export_arr, array($d['item_id'], $d['customer_name'], $d['customer_address'], $d['order_no'], date('d M, Y', strtotime($d['created_at'])), $d['brand'], $d['design'],
                    $d['color'], $d['size'], $d['qty']));
                $i++;
            }
        }
        convert_to_csv($export_arr, 'Sales Report-' . date('F d Y') . '.csv', ',');
    
    
}
	
	
    
//     public function printAllCustomerOrders(){
        
//           $data['title'] = 'Customer Orders List';
// 	    $id = $this->input->get('c_id');
// 	    $c_data = $this->master_model->get_customer_by_id($id);
// 	    $o_data =  $this->master_model->get_all_orders_of_customer($id);	     
	    
// 	    $main_data['customer_id'] = $id;
// 	    $main_data['c_data'] = $c_data;
// 	    $main_data['order_data'] = $o_data;

// 		$this->load->view('admin/customer_orders/customer_orders_list_print', $main_data);
//     }
    
    
//     public function printCustomerOrder(){
        
//           $data['title'] = 'Customer Order List';
// 	    $c_id = $this->input->get('c_id');
// 	    $o_id = $this->input->get('o_id');
	    
	    
// 	    $c_data = $this->master_model->get_customer_by_id($c_id);
// 	    $o_data =  $this->master_model->get_order_item_by_order_id($o_id);	     
	    
	    
// 	     $main_data['order_no'] = $o_id;
// 	    $main_data['customer_id'] = $c_id;
// 	    $main_data['c_data'] = $c_data;
// 	    $main_data['order_data'] = $o_data;


// 		$this->load->view('admin/customer_orders/customer_single_order_print', $main_data);
		

        
//     }
    
   
}


	?>