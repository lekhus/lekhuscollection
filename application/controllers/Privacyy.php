<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privacyy extends CI_Controller {

	public function index()
	{
	
	
	    
		$data['title'] = 'Privacy Policy';
	
		$this->load->view('privacy');

	
	}
	
	
}
