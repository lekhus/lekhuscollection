<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Orders extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->load->model('admin/master_model', 'master_model');
		$this->load->library('datatable'); // loaded my custom serverside datatable library
	}

	public function index(){
	    
		$data['title'] = 'Orders List';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/orders/orders_list');
		$this->load->view('admin/includes/_footer');
	}
	
	public function datatable_json(){				   					   
		$records = $this->master_model->get_all_orderss();
// 		var_dump($records); die;
		$data = array();
		$i=0;
		foreach ($records['data']  as $row) 
		{  
			$customer=$this->master_model->get_customer_by_id($row['customer_id']);
			$data[]= array(
				++$i,
				$row['order_no'],
				'ID :'.$customer['id'].'<br>'.'Name :'.$customer['Name'].'<br>'.'Mobile :'.$customer['mobile'].'<br>'.
				$customer['address'],
				date_time($row['created_at']),	
				'<a title="View" class="view btn btn-sm btn-info" href="'.base_url('admin/orders/view?o_id='.$row['order_no']). '&c_id='.$customer['id'] .'"> <i class="fa fa-eye"></i></a>
				<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/orders/edit/?o_id='.$row['order_no']). '&c_id='.$customer['id'] .'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("admin/orders/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}


	//-----------------------------------------------------------
	public function add(){

		if($this->input->post('submit')){
			$this->form_validation->set_rules('name', 'name', 'trim|required');
		
			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/orders/add'),'refresh');
			}
			else
			{
			    $qrcode=$this->input->post('name')."-".$this->input->post('mobile')."-".$this->input->post('address');
			    $fileaddr="../uploads/orders/".$this->input->post('mobile').".png";
			    $Serversv=FCPATH."/uploads/orders/".$this->input->post('mobile').".png";
			    
			    $params['data'] = $qrcode;
                $params['level'] = 'H';
                $params['size'] = 10;
                $params['savename'] = $Serversv;
                $this->ciqrcode->generate($params);
			    
				$data = array(
					'name' => $this->input->post('name'),
					'mobile' => $this->input->post('mobile'),
					'address' => $this->input->post('address'),
					'qrcode' => $fileaddr,
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->master_model->add_orders($data);
				if($result){
					$this->session->set_flashdata('success', 'Orders has been added successfully!');
					redirect(base_url('admin/orders'));
				}
			}
		}
		else{

			$data['title'] = 'Add Orders';

			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/orders/orders_add');
			$this->load->view('admin/includes/_footer');
		}
		
	}

	//-----------------------------------------------------------
	
	
	    public function view(){
        
        
        $data['title'] = 'Customer Orders List';
	    $c_id = $this->input->get('c_id');
	    $o_id = $this->input->get('o_id');
	    $c_data = $this->master_model->get_customer_by_id($c_id);
	    $o_data =  $this->master_model->get_order_item_by_order_id($o_id);	   	     
	    
	    $main_data['customer_id'] = $c_id;
	     $main_data['order_no'] = $o_id;
	    $main_data['c_data'] = $c_data;
	    $main_data['order_data'] = $o_data;
	    

		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin//orders/order_view', $main_data);
		$this->load->view('admin/includes/_footer');
		

        
    }
	
	
	//-----------------------------------------------------------
	
	
	
	public function edit(){
    
        
		if($this->input->post('submit')){
 		
 		$order_no=$this->input->post('orderid');
 		
 		 $customer_id=$this->input->post('customerid');
 		 
  		$r=$this->master_model->delete_order_products_of_order($order_no);
  		$this->master_model->delete_report_data($order_no);
 		$order_items=$this->input->post('item_id');

$qty=$this->input->post('qty');


				for($i=0;$i<sizeof($order_items);$i++)
				{

				    $itemdata = array(
					'order_no' => $order_no,
					'item_id' => $order_items[$i],
					'qty' => $qty[$i],
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s')
				);
				
				
 				$itemdata = $this->security->xss_clean($itemdata);
 			
 				$result = $this->master_model->add_order_products($itemdata);
 				
 			// 	report edit starts
 			
 			
 			 $item_id = $order_items[$i];
				    
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
				    $item_qty = $qty[$i];
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
				        'qty' => $item_qty,
				        'code' => $code,
				        'created_at' => $created_at,
				        'updated_at' => $updated_at
				        ];
				        
				        $this->master_model->add_report_data($report_data);
 			
 			// report edit ends
				    
                    
				}
        
        
				if($result){
					$this->session->set_flashdata('success', 'Orders has been updated successfully!');
					redirect(base_url('admin/orders'));
				}
				else
				{
				    	$this->session->set_flashdata('error', 'Error in Updating Order! Please Contact Administrator');
				    	$uurl='admin/orders/edit/?o_id='.$order_no.'&c_id='.$customer_id;
					redirect(base_url($uurl));
				}

               
		}
		else{
		    
		    
		$data['title'] = 'Edit Order';
	    $c_id = $this->input->get('c_id');
	    $o_id = $this->input->get('o_id');
	    $c_data = $this->master_model->get_customer_by_id($c_id);
	    $o_data =  $this->master_model->get_order_item_by_order_id($o_id);	   	     
	    
	    $main_data['order_id'] = $o_id;
	    $main_data['customer_id'] = $c_id;
	    $main_data['c_data'] = $c_data;
	    $main_data['order_data'] = $o_data;
	    
	    
	   // getting item details
	   $item_data =  $this->master_model->get_all_items_as_raw();
	   $brands_data = $this->master_model->get_all_brands_for_select();
	   $category_data = $this->master_model->get_all_categorys_for_select();
	   $design_data = $this->master_model->get_all_designs_for_select();
	   $size_data = $this->master_model->get_all_sizes_for_select();
	   $color_data = $this->master_model->get_all_colors_for_select();
	   $sets_data = $this->master_model->get_all_sets_for_select();
	   
	    $main_data['item_data'] = $item_data;
	    $main_data['brand_data'] = $brands_data;
	    $main_data['category_data'] = $category_data;
	    $main_data['design_data'] = $design_data;
	    $main_data['size_data'] = $size_data;
	    $main_data['color_data'] = $color_data;
	    $main_data['sets_data'] = $sets_data;
	    

		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin//orders/order_edit', $main_data);
		$this->load->view('admin/includes/_footer');
		}
	}
	
	
	

	//-----------------------------------------------------------
	public function delete($id = 0)
	{
		
		$this->db->delete('orders', array('id' => $id));
		$this->session->set_flashdata('success', 'Orders has been deleted successfully!');
		redirect(base_url('admin/orders'));
	}

	//---------------------------------------------------------------
	//  Export Users PDF 
	public function create_orders_pdf(){

		$this->load->helper('pdf_helper'); // loaded pdf helper
		$data['all_orderss'] = $this->master_model->get_orderss_for_export();
		$this->load->view('admin/orders/orderss_pdf', $data);
	}



	//---------------------------------------------------------------	
	// Export data in CSV format 
	public function export_csv(){ 

	   // file name 
		$filename = 'orderss_'.date('Y-m-d').'.csv'; 
		header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/csv; ");

	   // get data 
		$user_data = $this->master_model->get_orderss_for_export();

	   // file creation 
		$file = fopen('php://output', 'w');

		$header = array("ID", "Name","Created Date"); 

		fputcsv($file, $header);
		foreach ($user_data as $key=>$line){ 
			fputcsv($file,$line); 
		}
		fclose($file); 
		exit; 
	}
	
	
	

}


	?>