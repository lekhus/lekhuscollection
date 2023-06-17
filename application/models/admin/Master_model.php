<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_model extends CI_Model{
    
    //--------------------Brands CRUD ----------
 
		public function add_brand($data){
			$this->db->insert('brand', $data);
			return true;
		}

		//---------------------------------------------------
		
		public function get_all_brands(){
			$wh =array();
			$SQL ='SELECT * FROM brand';
			$wh= array(); 
			if(count($wh)>0)
			{
				$WHERE = implode(' and ',$wh);
				return $this->datatable->LoadJson($SQL,$WHERE);
			}
			else
			{
				return $this->datatable->LoadJson($SQL);
			}
		}
		
		//---------------------------------------------------
		
		public function get_all_brands_for_select(){
			$this->db->select('id, Name');
			$this->db->from('brand');
			$query = $this->db->get();
			return $query->result_array();
			
		}


		//---------------------------------------------------
		
		public function get_brand_by_id($id){
			$query = $this->db->get_where('brand', array('id' => $id));
			return $result = $query->row_array();
		}
		
		public function get_brand_by_name($name){
			$query = $this->db->get_where('brand', array('Name' => $name));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
	
		public function edit_brand($data, $id){
			$this->db->where('id', $id);
			$this->db->update('brand', $data);
			return true;
		}

		

		//---------------------------------------------------
		
		public function get_brands_for_export(){
			
			$this->db->select('id, Name, created_at');
			$this->db->from('brand');
			$query = $this->db->get();
			return $result = $query->result_array();
		}
		
		
		//--------------------Category CRUD ----------

		public function add_category($data){
			$this->db->insert('category', $data);
			return true;
		}

		//---------------------------------------------------
		
		public function get_all_categorys(){
			$wh =array();
			$SQL ='SELECT * FROM category';
			$wh= array(); 
			if(count($wh)>0)
			{
				$WHERE = implode(' and ',$wh);
				return $this->datatable->LoadJson($SQL,$WHERE);
			}
			else
			{
				return $this->datatable->LoadJson($SQL);
			}
		}

	        //---------------------------------------------------
            public function get_all_categorys_for_select(){
            			$this->db->select('id, Name');
            			$this->db->from('category');
            			$query = $this->db->get();
            			return $query->result_array();
            			
            		}

		//---------------------------------------------------
		
		public function get_category_by_id($id){
			$query = $this->db->get_where('category', array('id' => $id));
			return $result = $query->row_array();
		}
		
		public function get_category_by_name($name){
			$query = $this->db->get_where('category', array('Name' => $name));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
	
		public function edit_category($data, $id){
			$this->db->where('id', $id);
			$this->db->update('category', $data);
			return true;
		}

		

		//---------------------------------------------------
		
		public function get_categorys_for_export(){
			
			$this->db->select('id, Name, created_at');
			$this->db->from('category');
			$query = $this->db->get();
			return $result = $query->result_array();
		}
		
		
			//--------------------Size CRUD ----------

		public function add_size($data){
			$this->db->insert('size', $data);
			return true;
		}

		//---------------------------------------------------
		
		public function get_all_sizes(){
			$wh =array();
			$SQL ='SELECT * FROM size';
			$wh= array(); 
			if(count($wh)>0)
			{
				$WHERE = implode(' and ',$wh);
				return $this->datatable->LoadJson($SQL,$WHERE);
			}
			else
			{
				return $this->datatable->LoadJson($SQL);
			}
		}


            //---------------------------------------------------
            public function get_all_sizes_for_select(){
            			$this->db->select('id, Name');
            			$this->db->from('size');
            			$query = $this->db->get();
            			return $query->result_array();
            			
            		}

		//---------------------------------------------------
		
		public function get_size_by_id($id){
			$query = $this->db->get_where('size', array('id' => $id));
			return $result = $query->row_array();
		}
		
			public function get_size_by_name($name){
			$query = $this->db->get_where('size', array('Name' => $name));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
	
		public function edit_size($data, $id){
			$this->db->where('id', $id);
			$this->db->update('size', $data);
			return true;
		}

		

		//---------------------------------------------------
		
		public function get_sizes_for_export(){
			
			$this->db->select('id, Name, created_at');
			$this->db->from('size');
			$query = $this->db->get();
			return $result = $query->result_array();
		}
		
			//--------------------Color CRUD ----------

		public function add_color($data){
			$this->db->insert('color', $data);
			return true;
		}

		//---------------------------------------------------
		
		public function get_all_colors(){
			$wh =array();
			$SQL ='SELECT * FROM color';
			$wh= array(); 
			if(count($wh)>0)
			{
				$WHERE = implode(' and ',$wh);
				return $this->datatable->LoadJson($SQL,$WHERE);
			}
			else
			{
				return $this->datatable->LoadJson($SQL);
			}
		}


            //---------------------------------------------------
            public function get_all_colors_for_select(){
            			$this->db->select('id, Name');
            			$this->db->from('color');
            			$query = $this->db->get();
            			return $query->result_array();
            			
            		}

		//---------------------------------------------------
		
		public function get_color_by_id($id){
			$query = $this->db->get_where('color', array('id' => $id));
			return $result = $query->row_array();
		}
		
		public function get_color_by_name($name){
			$query = $this->db->get_where('color', array('Name' => $name));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
	
		public function edit_color($data, $id){
			$this->db->where('id', $id);
			$this->db->update('color', $data);
			return true;
		}

		

		//---------------------------------------------------
		
		public function get_colors_for_export(){
			
			$this->db->select('id, Name, created_at');
			$this->db->from('color');
			$query = $this->db->get();
			return $result = $query->result_array();
		}
		
					//--------------------Set CRUD ----------

		public function add_sets($data){
			$this->db->insert('sets', $data);
			return true;
		}

		//---------------------------------------------------
		
		public function get_all_setss(){
			$wh =array();
			$SQL ='SELECT * FROM sets';
			$wh= array(); 
			if(count($wh)>0)
			{
				$WHERE = implode(' and ',$wh);
				return $this->datatable->LoadJson($SQL,$WHERE);
			}
			else
			{
				return $this->datatable->LoadJson($SQL);
			}
		}

            //---------------------------------------------------
            public function get_all_sets_for_select(){
            			$this->db->select('id, Name');
            			$this->db->from('sets');
            			$query = $this->db->get();
            			return $query->result_array();
            			
            		}
		//---------------------------------------------------
		
		public function get_sets_by_id($id){
			$query = $this->db->get_where('sets', array('id' => $id));
			return $result = $query->row_array();
		}
		
		public function get_sets_by_name($name){
			$query = $this->db->get_where('sets', array('Name' => $name));
			return $result = $query->row_array();
		}
		//---------------------------------------------------
	
		public function edit_sets($data, $id){
			$this->db->where('id', $id);
			$this->db->update('sets', $data);
			return true;
		}

		

		//---------------------------------------------------
		
		public function get_setss_for_export(){
			
			$this->db->select('id, Name, created_at');
			$this->db->from('sets');
			$query = $this->db->get();
			return $result = $query->result_array();
		}
		
		
		//--------------------Designs CRUD ----------

		public function add_design($data){
			$this->db->insert('design', $data);
			return true;
		}

		//---------------------------------------------------
		
		public function get_all_designs(){
			$wh =array();
			$SQL ='SELECT * FROM design';
			$wh= array(); 
			if(count($wh)>0)
			{
				$WHERE = implode(' and ',$wh);
				return $this->datatable->LoadJson($SQL,$WHERE);
			}
			else
			{
				return $this->datatable->LoadJson($SQL);
			}
		}


            //---------------------------------------------------
            public function get_all_designs_for_select(){
            			$this->db->select('id, Name');
            			$this->db->from('design');
            			$query = $this->db->get();
            			return $query->result_array();
            			
            		}
            		
		//---------------------------------------------------
		
		public function get_design_by_id($id){
			$query = $this->db->get_where('design', array('id' => $id));
			return $result = $query->row_array();
		}
		
		public function get_design_by_name($name){
			$query = $this->db->get_where('design', array('Name' => $name));
			return $result = $query->row_array();
		}
		//---------------------------------------------------
		
		public function get_design_id_by_name($dname){
			$query = $this->db->get_where('design', array('Name' => $dname));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
	
		public function edit_design($data, $id){
			$this->db->where('id', $id);
			$this->db->update('design', $data);
			return true;
		}

		

		//---------------------------------------------------
		
		public function get_designs_for_export(){
			
			$this->db->select('id, Name, created_at');
			$this->db->from('design');
			$query = $this->db->get();
			return $result = $query->result_array();
		}
		
				//--------------------Item CRUD ----------

		public function add_item($data){
			$this->db->insert('item', $data);
			return true;
		}
		

		//---------------------------------------------------
		
		public function get_all_items(){
			$SQL ='SELECT * FROM item';
			$wh= array(); 
			if(count($wh)>0)
			{
				$WHERE = implode(' and ',$wh);
				return $this->datatable->LoadJson($SQL,$WHERE);
			}
			else
			{
				return $this->datatable->LoadJson($SQL);
			}
		}
		
		
		
		public function get_all_items_as_raw(){
			$this->db->select('*');
			$this->db->from('item');
			$query = $this->db->get();
			return $query->result_array();
			
		}
		
		public function get_all_items_by_design_id($id){
		    
			$query = $this->db->get_where('item', array('design' => $id));
			return $query->result_array();
			
		}


		//---------------------------------------------------
		
		public function get_item_by_id($id){
			$query = $this->db->get_where('item', array('id' => $id));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
	
		public function edit_item($data, $id){
			$this->db->where('id', $id);
			$this->db->update('item', $data);
			return true;
		}

		

		//---------------------------------------------------
		
		public function get_items_for_export(){
			
			$this->db->select('id, Name, created_at');
			$this->db->from('item');
			$query = $this->db->get();
			return $result = $query->result_array();
		}
		
				
				//--------------------Customer CRUD ----------

		public function add_customer($data){
			$this->db->insert('customer', $data);
			return true;
		}

		//---------------------------------------------------
		
		public function get_all_customers(){
			$wh =array();
			$SQL ='SELECT * FROM customer';
			$wh= array(); 
			if(count($wh)>0)
			{
				$WHERE = implode(' and ',$wh);
				return $this->datatable->LoadJson($SQL,$WHERE);
			}
			else
			{
				return $this->datatable->LoadJson($SQL);
			}
		}


		//---------------------------------------------------
		
		public function get_customer_by_id($id){
			$query = $this->db->get_where('customer', array('id' => $id));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
	
		public function edit_customer($data, $id){
			$this->db->where('id', $id);
			$this->db->update('customer', $data);
			return true;
		}
        
        //---------------------------------------------------
		
		 public function get_similar_customer_by_name($name){
            $this->db->select('*');
            $this->db->like('Name', $name);
            $this->db->or_like('Name', $name, 'before');
            $this->db->or_like('Name', $name, 'after');
            
			$query = $this->db->get('customer');
			return $result = $query->result_array();
			
		}
		

		//---------------------------------------------------
		
		public function get_customers_for_export(){
			
			$this->db->select('id, Name, mobile,address');
			$this->db->from('customer');
			$query = $this->db->get();
			return $result = $query->result_array();
		}
		
		
		//--------------------Orders CRUD ----------
 
		public function add_orders($data){
			$this->db->insert('orders', $data);
			return true;
		}

		//---------------------------------------------------
		
		public function get_all_orderss(){
			$wh =array();
			$SQL ='SELECT * FROM orders';
			$wh= array(); 
			if(count($wh)>0)
			{
				$WHERE = implode(' and ',$wh);
				return $this->datatable->LoadJson($SQL,$WHERE);
			}
			else
			{
				return $this->datatable->LoadJson($SQL);
			}
		}
		//--------------------------------------------
		public function get_all_today_order($adminid)
		{
		    $this->db->select("*");
			$this->db->from('orders');
			$this->db->where('admin_id',$adminid);
			$this->db->where('DATE(created_at) = CURDATE()');
			$query = $this->db->get();
			return $query->result_array();
		}
		//---------------------------------------------------
		
		public function get_all_orderss_for_select(){
			$this->db->select('id, Name');
			$this->db->from('orders');
			$query = $this->db->get();
			return $query->result_array();
			
		}

        //---------------------------------------------------
		
		public function get_all_orderss_of_user($adminid){
			$this->db->select("*");
			$this->db->where('admin_id',$adminid);
			$this->db->from('orders');
			$query = $this->db->get();
			return $query->result_array();
			
		}

		//---------------------------------------------------
		
		public function get_orders_by_id($id){
			$query = $this->db->get_where('orders', array('id' => $id));
			return $result = $query->row_array();
		}
		
		
		public function get_orders_by_order_no($order_no){
			$query = $this->db->get_where('orders', array('order_no' => $order_no));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
	
		public function edit_orders($data, $id){
			$this->db->where('id', $id);
			$this->db->update('orders', $data);
			return true;
		}

		//---------------------------------------------------
	
		public function edit_orders_by_order_no($data, $orderno){
			$this->db->where('order_no', $orderno);
			$this->db->update('orders', $data);
			return true;
		}


		//---------------------------------------------------
		
		public function get_orderss_for_export(){
			
			$this->db->select('id, Name, created_at');
			$this->db->from('orders');
			$query = $this->db->get();
			return $result = $query->result_array();
		}
		
		
		//-------------------- Customer order CRUD ----------
		
        // to get all cutomzer orders
        public function get_all_orders_of_customer($id){
            
            $this->db->select('*');
            $this->db->where('customer_id',$id);
            $this->db->where('DATE(created_at) = CURDATE()');
			$this->db->from('orders');
			
			$query = $this->db->get();
			return $result = $query->result_array();
        
        }
        
        
        public function get_order_item_by_order_id($o_id){
            
            $this->db->select('*');
            $this->db->where('order_no',$o_id);
			$this->db->from('order_products');
			
			$query = $this->db->get();
			$result = $query->result_array();
			
// 			$data = '';
			
// 			foreach($result as $r){
			        
// 			    $item_id = $r['item_id'];
			    
//     			$this->db->select('*');
//                 $this->db->where('id',$item_id);
//     			$this->db->from('item');
    			
//     			$query = $this->db->get();
//     			$item = $query->result_array();
    			
			    
// 			}
			
			
			return $result;
            
        }
        
        
         public function get_order_details_by_order_id($o_id){
            
            $this->db->select('*');
            $this->db->where('order_no',$o_id);
			$this->db->from('report');
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;
        }
        
        public function get_totalitem_group_by_item_brand($admin_id,$brand){
			$this->db->select('*,SUM(qty) as total');
          //  $this->db->where('admin_id',$admin_id);
            $this->db->where('brand',$brand);
           // $this->db->group_by('brand'); 
			$this->db->from('report');
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;
        }
        
        
        public function get_order_details_group_by_item_brand($admin_id){
            
//            $this->db->select('item_name,brand,category,design,size,color,sets,qty, COUNT(item_name) as total');
			$this->db->select('item_name,brand,category,design,size,color,sets,qty, SUM(qty) as total');
          // $this->db->where('DATE(created_at) = CURDATE()');
            $this->db->where('admin_id',$admin_id);
            $this->db->group_by('item_name'); 
			$this->db->from('report');
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;
        }
        	
		//--------------------Order Producrts CRUD ----------
		
		public function add_order_products($data){
			$this->db->insert('order_products', $data);
			return true;
		}
		
		public function delete_order_products_of_order($orderno){
		    $this->db->where('order_no',$orderno);
			$this->db->delete('order_products');
			return true;
		}
		
		public function delete_order_products_of_report($orderno){
		    $this->db->where('order_no',$orderno);
			$this->db->delete('report');
			return true;
		}
        
        
        
        //--------------------Report Generation CRUD ----------
        
        public function add_report_data($data){
			$this->db->insert('report', $data);
			return true;
		}
		
		public function delete_report_data($orderno){
		    $this->db->where('order_no',$orderno);
			$this->db->delete('report');
			return true;
		}
		
		
		//---------------------------------------------------
            public function get_order_report_data(){
            			$this->db->select('*');
            			$this->db->order_by("brand", "asc");
            			$this->db->from('report');
            			$query = $this->db->get();
            			return $query->result_array();
            			
            		}
            		
		//---------------------------------------------------
         public function get_order_report_data_by_brand_name($name){
    			$this->db->select('*');
    			$this->db->order_by("design", "asc");
    			
    			$query = $this->db->get_where('report', ['brand'=>$name]);
    			return $query->result_array();
    			
    		}
        
        
        
		
	}