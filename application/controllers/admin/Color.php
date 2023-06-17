<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Color extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->load->model('admin/master_model', 'master_model');
		$this->load->library('datatable'); // loaded my custom serverside datatable library
	}

	public function index(){
	    
		$data['title'] = 'Color List';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/color/color_list');
		$this->load->view('admin/includes/_footer');
	}
	
	public function datatable_json(){				   					   
		$records = $this->master_model->get_all_colors();
// 		var_dump($records); die;
		$data = array();
		$i=0;
		foreach ($records['data']  as $row) 
		{  
			
			$data[]= array(
				++$i,
				$row['Name'],
				date_time($row['created_at']),	
				'<a title="View" class="view btn btn-sm btn-info" href="'.base_url('admin/color/edit/'.$row['id']).'"> <i class="fa fa-eye"></i></a>
				<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/color/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("admin/color/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
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
				redirect(base_url('admin/color/add'),'refresh');
			}
			else
			{
				$data = array(
					'name' => $this->input->post('name'),
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->master_model->add_color($data);
				if($result){
					$this->session->set_flashdata('success', 'Color has been added successfully!');
					redirect(base_url('admin/color'));
				}
			}
		}
		else{

			$data['title'] = 'Add Color';

			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/color/color_add');
			$this->load->view('admin/includes/_footer');
		}
		
	}

	//-----------------------------------------------------------
	public function edit($id = 0){

		if($this->input->post('submit')){
			$this->form_validation->set_rules('name', 'name', 'trim|required');
			
			if ($this->form_validation->run() == FALSE) {
				$data['color'] = $this->master_model->get_color_by_id($id);
				$data['view'] = 'admin/color/color_edit';
				$this->load->view('layout', $data);
			}
			else{
				$data = array(
					'name' => $this->input->post('name'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->master_model->edit_color($data, $id);
				if($result){
					$this->session->set_flashdata('success', 'Color has been updated successfully!');
					redirect(base_url('admin/color'));
				}
			}
		}
		else{
			$data['title'] = 'Edit Color';
			$data['color'] = $this->master_model->get_color_by_id($id);
			
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/color/color_edit', $data);
			$this->load->view('admin/includes/_footer');
		}
	}

	//-----------------------------------------------------------
	public function delete($id = 0)
	{
		
		$this->db->delete('color', array('id' => $id));
		$this->session->set_flashdata('success', 'Color has been deleted successfully!');
		redirect(base_url('admin/color'));
	}

	//---------------------------------------------------------------
	//  Export Users PDF 
	public function create_color_pdf(){

		$this->load->helper('pdf_helper'); // loaded pdf helper
		$data['all_colors'] = $this->master_model->get_colors_for_export();
		$this->load->view('admin/color/color_pdf', $data);
	}

	//---------------------------------------------------------------	
	// Export data in CSV format 
	public function export_csv(){ 

	   // file name 
		$filename = 'colors_'.date('Y-m-d').'.csv'; 
		header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/csv; ");

	   // get data 
		$user_data = $this->master_model->get_colors_for_export();

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