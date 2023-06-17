<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Webcam extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->load->model('admin/master_model', 'master_model');
	}

	public function index(){
		$data['title'] = 'Webcam';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/webcam/showcam');
		$this->load->view('admin/includes/_footer');
	}
	
}
	?>