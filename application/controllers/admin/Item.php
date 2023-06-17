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
			
			      $code=$design['Name']."-".$size['Name'].$color['Name']."-".$sets['Name'].$this->input->post('price');
			      
			     // image uploading
			     if($_FILES['icon']['name']){
			         
			         
			    $config['upload_path']          = 'uploads/item';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 0;
                $config['max_width']            = 0;
                $config['max_height']           = 0;
                $config['file_name']           = 'item_'.time();

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('icon'))
                {
                        $error = $this->upload->display_errors();
                        
                        
                        
				$this->session->set_flashdata('errors', $error);
				redirect(base_url('admin/item/add'),'refresh');
                        
                }
                else
                {
                        $img = $this->upload->data();
                        
                        
                }
			         
			         
			     }
			      
			     
			      
				$data = array(
					'Name' =>"",
					'brand' => $this->input->post('brand'),
					'category' => $this->input->post('category'),
					'design' => $this->input->post('design'),
					'size' => $this->input->post('size'),
					'color' => $this->input->post('color'),
					'sets' => $this->input->post('sets'),
					'price' => $this->input->post('price'),
					 'code'=>$code,
				    'qradd'=>"",
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
					'img' => $_FILES['icon']['name']?$config['upload_path'].'/'.$img['file_name']:null
				);
				$data = $this->security->xss_clean($data);
				$result = $this->master_model->add_item($data);
				
				    $id=$this->db->insert_id();
				    $item_id = strval($id);
				    $qrcode= $item_id."-".$brand['Name']."-".$category['Name']."-".$design['Name']."-".$size['Name']."-".$color['Name']."-".$sets['Name'];
			    
			  
			    $filen=time().".png";
			    $fileaddr="../uploads/qrcode/".$filen;
			    $Serversv=FCPATH."/uploads/qrcode/".$filen;
			    
			    $params['data'] = $qrcode;
                $params['level'] = 'H';
                $params['size'] = 10;
                $params['savename'] = $Serversv;
                $this->ciqrcode->generate($params);
                
                   $code=$item_id."-".$design['Name']."-".$size['Name'].$color['Name']."-".$sets['Name'].$this->input->post('price');
				    
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
			
			$code=$design['Name']."-".$size['Name']."-".$sets['Name'].$this->input->post('price'); 
			
$qrcode=$id."-".$brand['Name']."-".$category['Name']."-".$design['Name']."-".$size['Name']."-".$color['Name']."-".$sets['Name'];
			    
			    
			    $filen=time().".png";
			    $fileaddr="../uploads/qrcode/".$filen;
			    $Serversv=FCPATH."/uploads/qrcode/".$filen;
			    
			    $params['data'] = $qrcode;
                $params['level'] = 'H';
                $params['size'] = 10;
                $params['savename'] = $Serversv;
                $this->ciqrcode->generate($params);
                $nnd=$id.$design['Name'].$sets['Name'];
                
                
                // image uploading
			     if($_FILES['icon']['name']){
			         
			         
			    $config['upload_path']          = 'uploads/item';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 0;
                $config['max_width']            = 0;
                $config['max_height']           = 0;
                $config['file_name']           = 'item_'.time();

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('icon'))
                {
                        $error = $this->upload->display_errors();
                        
                        
                        
				$this->session->set_flashdata('errors', $error);
				redirect(base_url('admin/item/edit'.$id),'refresh');
                        
                }
                else
                {
                        $img = $this->upload->data();
                        
                        
                }
			         
			         
			     }
			     
			     
			     //image uploading finish
                
                
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
					'img' => $_FILES['icon']['name']?$config['upload_path'].'/'.$img['file_name']:null,
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
	    $item = $this->master_model->get_item_by_id($id);
	    unlink($item['img']);
		
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
	
	// --------------------------------------------------
	
	public function search(){
	    
	    $design_name = $this->input->get('design-name');
	    $design_data = $this->master_model->get_design_id_by_name($design_name);
	    echo $design_data['id'];
	    $items = $this->master_model->get_all_items_by_design_id($design_data['id']);
	    
	    
	    $data['title'] = 'Search by Design';
	    
	    $res_data['item_data'] = $items;
	    $res_data['query'] = $design_name;
	    
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/item/item_search_result', $res_data);
		$this->load->view('admin/includes/_footer');
	    
	}
	
	
	// ------------------------Getting item report---------------------------------------
	// ------------------------Getting item report---------------------------------------
	public function report(){
	    
	   $data = $this->master_model->get_order_report_data();
	   //var_dump($data);
	   
	   $this->load->helper('csv');
        $export_arr = array();
        
        $title = array("Brand","OrderId", "Customer Id", "Customer Name" ,  "Mobile No", "Customer Address",
                        "Order No.", "Item Id", "Item name", "Category", "Design", "Size", "color", "sets",
                        "Quantity", "Code");
                        
        array_push($export_arr, $title);
        
        if (!empty($data)) {
            foreach ($data as $d) {
                $i=1;
                array_push($export_arr, array($d['brand'],$i, $d['customer_id'], $d['customer_name'], $d['customer_mobile'], $d['customer_address'],
                $d['order_no'], $d['item_id'], $d['item_name'],  $d['category'], $d['design'], $d['size'], $d['color'], $d['qty'], $d['sets'] ));
                $i++;
            }
        }
        convert_to_csv($export_arr, 'Order Report-' . date('F d Y') . '.csv', ',');
    }
	
	public function uploadcsv()
	{
	
	if($this->input->post('upload') != NULL )
	{ 
       $data = array(); 
       if(!empty($_FILES['file']['name']))
       { 
         // Set preference 
         $config['upload_path'] = 'uploads/download/'; 
         $config['allowed_types'] = 'csv'; 
         $config['max_size'] = '10000'; // max_size in kb 
         $config['file_name'] = $_FILES['file']['name'];
         // Load upload library 
         $this->load->library('upload',$config); 
         // File upload
         if($this->upload->do_upload('file'))
         { 
            // Get data about the file
            $uploadData = $this->upload->data(); 
            $filename = $uploadData['file_name'];

            // Reading file
            $file = fopen("uploads/download/".$filename,"r");
            $i = 0;
            $numberOfFields = 7; // Total number of fields
            $importData_arr = array();
 
            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
               $num = count($filedata );
               if($numberOfFields == $num){
                  for ($c=0; $c < $num; $c++) {
                     $importData_arr[$i][] = $filedata [$c];
                  }
               }
               $i++;
            }
            fclose($file);

            $skip = 0;

            // insert import data
            foreach($importData_arr as $userdata){
               // Skip first row
               if($skip != 0){
                  //var_dump($userdata); die;               
                    
            $brand=$this->master_model->get_brand_by_name($userdata[0]);
			$category=$this->master_model->get_category_by_name($userdata[1]);
			$design=$this->master_model->get_design_by_name($userdata[2]);
			$size=$this->master_model->get_size_by_name($userdata[3]);
			$color=$this->master_model->get_color_by_name($userdata[4]);
			$sets=$this->master_model->get_sets_by_name($userdata[5]);
			$pr=$userdata[6];
			
			if($brand!=null&&$category!=null&&$design!=null&&$size!=null&&$color!=null&&$sets!=null)
		{
			$code=$design['Name']."-".$size['Name'].$color['Name']."-".$sets['Name'].$pr;
				$data = array(
					'Name' =>"",
					'brand' => $brand['id'],
					'category' => $category['id'],
					'design' => $design['id'],
					'size' => $size['id'],
					'color' => $color['id'],
					'sets' => $sets['id'],
					'price' => $pr,
					 'code'=>$code,
				    'qradd'=>"",
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->master_model->add_item($data);
				    $id=$this->db->insert_id();
				    $item_id = strval($id);
				    $qrcode= $item_id."-".$brand['Name']."-".$category['Name']."-".$design['Name']."-".$size['Name']."-".$color['Name']."-".$sets['Name'];
			    $filen=time().$id.".png";
			    $fileaddr="../uploads/qrcode/".$filen;
			    $Serversv=FCPATH."/uploads/qrcode/".$filen;
			    
			    $params['data'] = $qrcode;
                $params['level'] = 'H';
                $params['size'] = 10;
                $params['savename'] = $Serversv;
                $this->ciqrcode->generate($params);
    $code=$item_id."-".$design['Name']."-".$size['Name'].$color['Name']."-".$sets['Name'].$pr;
				    $nnd=$id.$design['Name'].$sets['Name'];
				    $data=array(
				        'Name' =>$nnd,
				         'code'=>$code,
				        'qradd'=>$fileaddr,
				        );
				    $result = $this->master_model->edit_item($data, $id);
				
		}         
                  
               }
               $skip ++;
            }
            $this->session->set_flashdata('success', "File upload successfully");
	        redirect(base_url('admin/item'),'refresh');
         }
         else
         { 
             $this->session->set_flashdata('errors', "File upload library failed");
	        redirect(base_url('admin/item'),'refresh');
         } 
      }
      else
      { 
          $this->session->set_flashdata('errors', "File not Uploaded");
	        redirect(base_url('admin/item'),'refresh');
      } 
      
    }
    else
    {
     $this->session->set_flashdata('errors', "File not Found");
	redirect(base_url('admin/item'),'refresh');
    }
	
	}
	

}


	?>