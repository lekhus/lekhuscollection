<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Item extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->load->model('admin/master_model', 'master_model');
		$this->load->library('datatable'); // loaded my custom serverside datatable library
		$this->load->library('ciqrcode');
	}

	public function index(){
	    
		$data['title'] = 'Item List';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/item/item_list');
		$this->load->view('admin/includes/_footer');
	}
	
	public function datatable_json(){				   					   
		$records = $this->master_model->get_all_items();
		$data = array();
		$i=0;
		foreach ($records['data']  as $row) 
		{  
			$brand=$this->master_model->get_brand_by_id($row['brand']);
			$category=$this->master_model->get_category_by_id($row['category']);
			$design=$this->master_model->get_design_by_id($row['design']);
			$size=$this->master_model->get_size_by_id($row['size']);
			$color=$this->master_model->get_color_by_id($row['color']);
			$sets=$this->master_model->get_sets_by_id($row['sets']);
			
			$data[]= array(
				++$i,
				$row['Name'],
				$brand['Name'],
				$category['Name'],
				$design['Name'],
				$size['Name'],
				$color['Name'],
				$sets['Name'],
				$row['price'],
				'<a href="'.$row['qradd'].'" data-toggle="lightbox" data-footer='.$row['code'].'><img src="'.$row['qradd'].'" width=40px height=40px/></a>
				
				<a title="Print" class="update btn btn-sm btn-warning" href="'.base_url('admin/item/printqr/'.$row['id']).'"> <i class="fa fa-print"></i></a>
				',
				date_time($row['created_at']),	
				'<a title="View" class="view btn btn-sm btn-info" href="'.base_url('admin/item/edit/'.$row['id']).'"> <i class="fa fa-eye"></i></a>
				<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/item/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("admin/item/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}


	//-----------------------------------------------------------
	public function add(){

		if($this->input->post('submit')){
		
			$this->form_validation->set_rules('brand', 'Brand', 'trim|required');
			$this->form_validation->set_rules('category', 'Category', 'trim|required');
			$this->form_validation->set_rules('design', 'Design', 'trim|required');
			$this->form_validation->set_rules('color', 'Color', 'trim|required');
			$this->form_validation->set_rules('size', 'Size', 'trim|required');
			$this->form_validation->set_rules('sets', 'Sets', 'trim|required');
		
			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/item/add'),'refresh');
			}
			else
			{
			 $brand=$this->master_model->get_brand_by_id($this->input->post('brand'));
			$category=$this->master_model->get_category_by_id($this->input->post('category'));
			$design=$this->master_model->get_design_by_id($this->input->post('design'));
			$size=$this->master_model->get_size_by_id($this->input->post('size'));
			$color=$this->master_model->get_color_by_id($this->input->post('color'));
			$sets=$this->master_model->get_sets_by_id($this->input->post('sets'));
			
			    
				$data = array(
					'Name' =>"",
					'brand' => $this->input->post('brand'),
					'category' => $this->input->post('category'),
					'design' => $this->input->post('design'),
					'size' => $this->input->post('size'),
					'color' => $this->input->post('color'),
					'sets' => $this->input->post('sets'),
					'price' => $this->input->post('price'),
					 'code'=>"",
				    'qradd'=>"",
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->master_model->add_item($data);
				
				    $id=$this->db->insert_id();
				    $item_id = strval($id);
				    $qrcode= $item_id."-".$brand['Name']."-".$category['Name']."-".$design['Name']."-".$size['Name']."-".$color['Name']."-".$sets['Name'];
			    
			    $code=$design['Name']."-".$size['Name'].$color['Name']."-".$sets['Name'].$this->input->post('price');
			    
			    $fileaddr="../uploads/qrcode/".$design['Name'].$brand['Name'].".png";
			    $Serversv=FCPATH."/uploads/qrcode/".$design['Name'].$brand['Name'].".png";;
			    
			    $params['data'] = $qrcode;
                $params['level'] = 'H';
                $params['size'] = 10;
                $params['savename'] = $Serversv;
                $this->ciqrcode->generate($params);
                
				    
				    $nnd=$id.$design['Name'].$sets['Name'];
				    
				    $data=array(
				        'Name' =>$nnd,
				        'code'=>$code,
				        'qradd'=>$fileaddr,
				        );
				        
				    $result = $this->master_model->edit_item($data, $id);
				    
				    if($result){
					$this->session->set_flashdata('success', 'Item has been added successfully!');
					redirect(base_url('admin/item'));
				}
			}
		}
		else{

			$data['title'] = 'Add Item';
			$data['brand'] = $this->master_model->get_all_brands_for_select();
			$data['category'] = $this->master_model->get_all_categorys_for_select();
			$data['size'] = $this->master_model->get_all_sizes_for_select();
			$data['design'] = $this->master_model->get_all_designs_for_select();
			$data['sets'] = $this->master_model->get_all_sets_for_select();
			$data['color'] = $this->master_model->get_all_colors_for_select();
			
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/item/item_add');
			$this->load->view('admin/includes/_footer');
		}
		
	}

	//-----------------------------------------------------------
	public function edit($id = 0){

		if($this->input->post('submit')){
			$this->form_validation->set_rules('name', 'name', 'trim|required');
			
			if ($this->form_validation->run() == FALSE) {
				$data['item'] = $this->master_model->get_item_by_id($id);
				$data['view'] = 'admin/item/item_edit';
				$this->load->view('layout', $data);
			}
			else{
			    
			    $brand=$this->master_model->get_brand_by_id($this->input->post('brand'));
			$category=$this->master_model->get_category_by_id($this->input->post('category'));
			$design=$this->master_model->get_design_by_id($this->input->post('design'));
			$size=$this->master_model->get_size_by_id($this->input->post('size'));
			$color=$this->master_model->get_color_by_id($this->input->post('color'));
			$sets=$this->master_model->get_sets_by_id($this->input->post('sets'));
			
$qrcode=$id."-".$brand['Name']."-".$category['Name']."-".$design['Name']."-".$size['Name']."-".$color['Name']."-".$sets['Name'];
			    
			    $code=$design['Name']."-".$size['Name']."-".$sets['Name'].$this->input->post('price');
			    $fileaddr="../uploads/qrcode/".$design['Name'].$brand['Name'].".png";
			    $Serversv=FCPATH."/uploads/qrcode/".$design['Name'].$brand['Name'].".png";;
			    
			    $params['data'] = $qrcode;
                $params['level'] = 'H';
                $params['size'] = 10;
                $params['savename'] = $Serversv;
                $this->ciqrcode->generate($params);
                $nnd=$id.$design['Name'].$sets['Name'];
                
				$data = array(
					'name' => $nnd,
						'brand' => $this->input->post('brand'),
					'category' => $this->input->post('category'),
					'design' => $this->input->post('design'),
					'size' => $this->input->post('size'),
					'color' => $this->input->post('color'),
					'sets' => $this->input->post('sets'),
					'price' => $this->input->post('price'),
					'code'=>$code,
					'qradd'=>$fileaddr,
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->master_model->edit_item($data, $id);
				if($result){
					$this->session->set_flashdata('success', 'Item has been updated successfully!');
					redirect(base_url('admin/item'));
				}
			}
		}
		else{
			$data['title'] = 'Edit Item';
			$data['item'] = $this->master_model->get_item_by_id($id);
			
			$data['brand'] = $this->master_model->get_all_brands_for_select();
			$data['category'] = $this->master_model->get_all_categorys_for_select();
			$data['size'] = $this->master_model->get_all_sizes_for_select();
			$data['design'] = $this->master_model->get_all_designs_for_select();
			$data['sets'] = $this->master_model->get_all_sets_for_select();
			$data['color'] = $this->master_model->get_all_colors_for_select();
			
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/item/item_edit', $data);
			$this->load->view('admin/includes/_footer');
		}
	}

	//-----------------------------------------------------------
	public function delete($id = 0)
	{
		
		$this->db->delete('item', array('id' => $id));
		$this->session->set_flashdata('success', 'Item has been deleted successfully!');
		redirect(base_url('admin/item'));
	}

	//---------------------------------------------------------------
	//  Export Users PDF 
	public function create_item_pdf(){

		$this->load->helper('pdf_helper'); // loaded pdf helper
		$data['all_items'] = $this->master_model->get_items_for_export();
		$this->load->view('admin/item/items_pdf', $data);
	}

	//---------------------------------------------------------------	
	// Export data in CSV format 
	public function export_csv(){ 

	   // file name 
		$filename = 'items_'.date('Y-m-d').'.csv'; 
		header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/csv; ");

	   // get data 
		$user_data = $this->master_model->get_items_for_export();

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

//---------------------------------------------------------------
	//  Export Users PDF 
	public function printqr($id = 0){
	    $data['title']="print Item Qr";
			$data['item'] = $this->master_model->get_item_by_id($id);
				$this->load->view('admin/includes/_header');
		$this->load->view('admin/item/printitemqr', $data);
			$this->load->view('admin/includes/_footer');
	}
	
	
		public function getItemById($id = 0){

			$item_details = $this->master_model->get_item_by_id($id);
			
			 $brand_details = $this->master_model->get_brand_by_id($item_details['brand']);
            $item_details['brand']=$brand_details['Name'];
                     
            $category_details = $this->master_model->get_category_by_id($item_details['category']);
            $item_details['category']=$category_details['Name'];
            
            $design_details = $this->master_model->get_design_by_id($item_details['design']);
            $item_details['design']=$design_details['Name'];
		
		$size_details = $this->master_model->get_size_by_id($item_details['size']);
            $item_details['size']=$size_details['Name'];
		
		
			$sets_details = $this->master_model->get_sets_by_id($item_details['sets']);
            $item_details['sets']=$sets_details['Name'];
		
				$color_details = $this->master_model->get_color_by_id($item_details['color']);
            $item_details['color']=$color_details['Name'];
		
			
		
			 
		echo json_encode($item_details);
	}
	
	

}


	?>