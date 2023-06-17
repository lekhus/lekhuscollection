<?php
	class User_model extends CI_Model{

		public function add_user($data){
			$this->db->insert('ci_admin', $data);
			return true;
		}

		//---------------------------------------------------
		// get all admin for server-side datatable processing (ajax based)
		public function get_all_users(){
			$wh =array();
			$SQL ='SELECT * FROM ci_admin';
			$wh[] = "";
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
		// Get user detial by ID
		public function get_user_by_id($id){
			$query = $this->db->get_where('ci_admin', array('admin_id' => $id));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Edit user Record
		public function edit_user($data, $id){
			$this->db->where('admin_id', $id);
			$this->db->update('ci_admin', $data);
			return true;
		}

		//---------------------------------------------------
		// Change user status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('admin_id', $this->input->post('id'));
			$this->db->update('ci_admin');
		} 

		//---------------------------------------------------
		// get users for csv export
		public function get_users_for_export(){
			
			$this->db->where('is_admin', 0);
			$this->db->select('admin_id, username, created_at');
			$this->db->from('ci_admin');
			$query = $this->db->get();
			return $result = $query->result_array();
		}

	}

?>