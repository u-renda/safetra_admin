<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Extra extends CI_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->model('admin_model');
    }
	
	function check_admin_email()
	{
		$self = $this->input->post('selfemail');
		$input = $this->input->post('email');
		
		$result = $this->admin_model->info(array('email' => $input));
	
		if ($result->code == 200 && $self != $input)
		{
			echo 'false';
		}
		else
		{
            echo 'true';
        }
	}
	
	function check_admin_username()
	{
		$self = $this->input->post('selfusername');
		$input = $this->input->post('username');
		
		$result = $this->admin_model->info(array('username' => $input));
	
		if ($result->code == 200 && $self != $input)
		{
			echo 'false';
		}
		else
		{
            echo 'true';
        }
	}
}
