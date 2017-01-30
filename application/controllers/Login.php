<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('admin_model');
    }

    function check_password($password, $username)
    {
        $result = $this->admin_model->valid(array('username' => $username, 'password' => $password));
		
        if ($result->code == 200)
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('check_password', 'Wrong Username or Password');
            return FALSE;
        }
    }
	
	function index()
	{
		if ($this->session->userdata('is_login') == TRUE) { redirect($this->config->item('link_dashboard')); }
		
		$data = array();
		if ($this->input->post('submit') == TRUE)
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required|callback_check_password['.$this->input->post('username').']');
			
			if ($this->form_validation->run() == FALSE)
			{
				$data['error'] = validation_errors();
			}
			else
			{
				$param = array();
				$param['username'] = $this->input->post('username');
				
				$query = $this->admin_model->info($param);
				
				if ($query->code == 200)
				{
					$result = $query->result;
					$code_admin_role = $this->config->item('code_admin_role');
					
					$session = array(
						'id_admin'=> $result->id_admin,
						'username'=> $result->username,
						'email'=> $result->email,
						'name'=> $result->name,
						'photo'=> $result->photo,
						'job_title'=> $result->job_title,
						'role'=> $result->role,
						'role_desc'=> $code_admin_role[$result->role],
						'is_login' => TRUE
					);
					
					$this->session->set_userdata($session);
					
					redirect($this->config->item('link_dashboard'));
				}
				else
				{
					$data['error'] = 'Username atau Password salah';
				}
			}
		}
		
		$this->load->view('login/index', $data);
	}

    function logout()
    {
		$this->session->unset_userdata('id_admin');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role');
		$this->session->unset_userdata('role_desc');
		$this->session->unset_userdata('job_title');
		$this->session->unset_userdata('photo');
		$this->session->unset_userdata('is_login');
		$this->session->sess_destroy();
		
        redirect($this->config->item('link_login'), 'refresh');
    }
}
