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
		
		public function get_customers_for_export(){
			
			$this->db->select('id, Name, created_at');
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
		//	$this->db->where('created_at BETWEEN DATE_SUB(NOW(), INTERVAL 1 DAY) AND NOW()');
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
		
		public function get_orders_by_id($id){
			$query = $this->db->get_where('orders', array('id' => $id));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
	
		public function edit_orders($data, $id){
			$this->db->where('id', $id);
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
		
		//---------------------------------------------------
        
       
		
	}