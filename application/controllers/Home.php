<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('admin_model');
		$this->load->model('article_model');
		
		if ($this->session->userdata('is_login') == FALSE) { redirect($this->config->item('link_login')); }
    }
	
	function dashboard()
	{
		$data = array();
		$data['total_article'] = $this->total_article();
		$data['view_content'] = 'home/dashboard';
		$this->load->view('templates/frame', $data);
	}
	
	function total_article()
	{
		$query = $this->article_model->lists(array())->count;
		return $query;		
	}
}
