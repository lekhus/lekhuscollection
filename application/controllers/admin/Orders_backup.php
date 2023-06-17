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
				'<a title="View" class="view btn btn-sm btn-info" href="'.base_url('admin/orders/edit/'.$row['id']).'"> <i class="fa fa-eye"></i></a>
				<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/orders/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
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
	public function edit($id = 0){

		if($this->input->post('submit')){
			$this->form_validation->set_rules('name', 'name', 'trim|required');
			
			if ($this->form_validation->run() == FALSE) {
				$data['orders'] = $this->master_model->get_orders_by_id($id);
				$data['view'] = 'admin/orders/orders_edit';
				$this->load->view('layout', $data);
			}
			else{
				$data = array(
					'name' => $this->input->post('name'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->master_model->edit_orders($data, $id);
				if($result){
					$this->session->set_flashdata('success', 'Orders has been updated successfully!');
					redirect(base_url('admin/orders'));
				}
			}
		}
		else{
			$data['title'] = 'Edit Orders';
			$data['orders'] = $this->master_model->get_orders_by_id($id);
			
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/orders/orders_edit', $data);
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