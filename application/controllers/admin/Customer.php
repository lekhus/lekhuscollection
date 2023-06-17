<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Customer extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->load->model('admin/master_model', 'master_model');
		$this->load->library('datatable'); // loaded my custom serverside datatable library
		$this->load->library('ciqrcode');
    	$this->load->library("EscPos.php");

		
	}

	public function index(){
	    
		$data['title'] = 'Customer List';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/customer/customer_list');
		$this->load->view('admin/includes/_footer');
	}
	
	public function datatable_json(){				   					   
		$records = $this->master_model->get_all_customers();
// 		var_dump($records); die;
		$data = array();
		$i=0;
		foreach ($records['data']  as $row) 
		{  
			
			$data[]= array(
				$row['id'],
				$row['Name'],
				$row['mobile'],
				$row['address'],
				'<a href="'.$row['qrcode'].'" data-toggle="lightbox" data-footer='.$row['id']."-".$row['Name'].'><img src="'.$row['qrcode'].'" width=40px height=40px/></a>
				<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/customer/printqr/'.$row['id']).'"> <i class="fa fa-print"></i></a>
				',
				date_time($row['created_at']),	
				'<a title="View" class="view btn btn-sm btn-info" href="'.base_url('admin/customer/edit/'.$row['id']).'"> <i class="fa fa-eye"></i></a>
				<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/customer/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("admin/customer/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
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
				redirect(base_url('admin/customer/add'),'refresh');
			}
			else
			{
			   
			    
				$data = array(
					'name' => $this->input->post('name'),
					'mobile' => $this->input->post('mobile'),
					'address' => $this->input->post('address'),
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->master_model->add_customer($data);
				
				$id=$this->db->insert_id();
				    
				 $qrcode=$id."-".$this->input->post('name')."-".$this->input->post('mobile')."-".$this->input->post('address');
			    $fileaddr="../uploads/customer/".$id.".png";
			    $Serversv=FCPATH."/uploads/customer/".$id.".png";
			    
			    $params['data'] = $qrcode;
                $params['level'] = 'H';
                $params['size'] = 10;
                $params['savename'] = $Serversv;
                $this->ciqrcode->generate($params);
                
                	 $data=array(
				        'qrcode' =>$fileaddr,
				        );
				        
				    $result = $this->master_model->edit_customer($data, $id);
                
				if($result){
					$this->session->set_flashdata('success', 'Customer has been added successfully!');
					redirect(base_url('admin/customer'));
				}
			}
		}
		else{

			$data['title'] = 'Add Customer';

			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/customer/customer_add');
			$this->load->view('admin/includes/_footer');
		}
		
	}

	//-----------------------------------------------------------
	public function edit($id = 0){

		if($this->input->post('submit')){
			$this->form_validation->set_rules('name', 'name', 'trim|required');
			
			if ($this->form_validation->run() == FALSE) {
				$data['customer'] = $this->master_model->get_customer_by_id($id);
				$data['view'] = 'admin/customer/customer_edit';
				$this->load->view('layout', $data);
			}
			else{
			    
			        
				 $qrcode=$id."-".$this->input->post('name')."-".$this->input->post('mobile')."-".$this->input->post('address');
			    $fileaddr="../uploads/customer/".$id.".png";
			    $Serversv=FCPATH."/uploads/customer/".$id.".png";
			    
			    
			    $params['data'] = $qrcode;
                $params['level'] = 'H';
                $params['size'] = 10;
                $params['savename'] = $Serversv;
                $this->ciqrcode->generate($params);
			    
				$data = array(
					'name' => $this->input->post('name'),
					'mobile' => $this->input->post('mobile'),
					'address' => $this->input->post('address'),
					'qrcode' =>$fileaddr,
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->master_model->edit_customer($data, $id);
				if($result){
					$this->session->set_flashdata('success', 'Customer has been updated successfully!');
					redirect(base_url('admin/customer'));
				}
			}
		}
		else{
			$data['title'] = 'Edit Customer';
			$data['customer'] = $this->master_model->get_customer_by_id($id);
			
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/customer/customer_edit', $data);
			$this->load->view('admin/includes/_footer');
		}
	}

	//-----------------------------------------------------------
	public function delete($id = 0)
	{
		
		$this->db->delete('customer', array('id' => $id));
		$this->session->set_flashdata('success', 'Customer has been deleted successfully!');
		redirect(base_url('admin/customer'));
	}

	//---------------------------------------------------------------
	//  Export Users PDF 
	public function create_customer_pdf(){

		$this->load->helper('pdf_helper'); // loaded pdf helper
		$data['all_customers'] = $this->master_model->get_customers_for_export();
		$this->load->view('admin/customer/customers_pdf', $data);
	}



	//---------------------------------------------------------------	
	// Export data in CSV format 
	public function export_csv(){ 

	   // file name 
		$filename = 'customers_'.date('Y-m-d').'.csv'; 
		header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/csv; ");

	   // get data 
		$user_data = $this->master_model->get_customers_for_export();

	   // file creation 
		$file = fopen('php://output', 'w');

		$header = array("id", "Name","mobile","address"); 

		fputcsv($file, $header);
		foreach ($user_data as $key=>$line){ 
			fputcsv($file,$line); 
		}
		fclose($file); 
		exit; 
	}


	//---------------------------------------------------------------
	//  Export Users PDF 
	public function printqr($id = 0){
	    $data['title']="print Customer Qr";
			$data['customer'] = $this->master_model->get_customer_by_id($id);
				$this->load->view('admin/includes/_header');
		$this->load->view('admin/customer/printqr', $data);
			$this->load->view('admin/includes/_footer');
	}
	
// 	public function printqrnow($id=0)
// 	{
// 	  try {
// 	// Enter the share name for your USB printer here
// 	$connector = new Escpos\PrintConnectors\WindowsPrintConnector("T244");
// 	$printer = new Escpos\Printer($connector);

// 	/* Print a "Hello world" receipt" */
// 	$printer -> text("Hello World!\n");
// 	$printer -> cut();
	
// 	/* Close printer */
// 	$printer -> close();
// } catch(Exception $e) {
// 	echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
// }
	   
// 		//	$customer = $this->master_model->get_customer_by_id($id);
				
			
// 	}
}


	?>