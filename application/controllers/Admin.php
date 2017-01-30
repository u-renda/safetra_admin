<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	private $processMedia;
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('admin_model');
		
		if ($this->session->userdata('is_login') == FALSE) { redirect($this->config->item('link_login')); }
    }
	
	function admin_create()
	{
		$data = array();
		
		if ($this->input->post('submit') == TRUE)
		{
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email');
			$this->form_validation->set_rules('role', 'Role', 'required');
			$this->form_validation->set_rules('job_title', 'Job Title', 'required');
			$this->form_validation->set_rules('photo', 'Photo', 'callback_check_media');
			
			if ($this->form_validation->run() == FALSE)
			{
				validation_errors();
			}
			else
			{
				$param = array();
				$param['name'] = $this->input->post('name');
				$param['username'] = $this->input->post('username');
				$param['password'] = md5($this->input->post('password'));
				$param['email'] = $this->input->post('email');
				$param['photo'] = $this->processMedia;
				$param['status'] = 1;
				$param['role'] = $this->input->post('role');
				$param['job_title'] = $this->input->post('job_title');
				$param['created_date'] = date('Y-m-d H:i:s');
				$param['updated_date'] = date('Y-m-d H:i:s');
				$query = $this->admin_model->create($param);
				
				if ($query > 0)
				{
					redirect($this->config->item('link_admin_lists'));
				}
				else
				{
					$data['error_save'] = 'Failed Create Data';
				}
			}
		}
		
		$data['code_admin_role'] = $this->config->item('code_admin_role');
		$data['view_content'] = 'admin/admin_create';
		$this->load->view('templates/frame', $data);
	}
	
	function admin_delete()
	{
		$data = array();
        $data['id'] = $this->input->post('id');
        $data['action'] = $this->input->post('action');
        $data['grid'] = $this->input->post('grid');

        $get = $this->admin_model->info(array('id_admin' => $data['id']));

        if ($get->code == 200)
        {
            if ($this->input->post('delete') == TRUE)
            {
                $query = $this->admin_model->delete($data['id']);

                if ($query > 0)
                {
                    $response =  array('msg' => 'Delete data success', 'type' => 'success');
                }
                else
                {
                    $response =  array('msg' => 'Delete data failed', 'type' => 'error');
                }

                echo json_encode($response);
                exit();
            }
            else
            {
                $this->load->view('delete_confirm', $data);
            }
        }
        else
        {
            echo "Data Not Found";
        }
	}

    function admin_get()
    {
        $page = $this->input->post('page') ? $this->input->post('page') : 1;
        $pageSize = $this->input->post('pageSize') ? $this->input->post('pageSize') : 20;
        $offset = ($page - 1) * $pageSize;
        $i = $offset * 1 + 1;
        $order = 'created_date';
        $sort = 'desc';
        $sort_post = $this->input->post('sort');
        $filter = $this->input->post('filter');

        if ($sort_post)
        {
            $order = $sort_post[0]['field'];
            $sort = $sort_post[0]['dir'];
        }

        $query = $this->admin_model->lists(array('limit' => $pageSize, 'offset' => $offset, 'order' => $order, 'sort' => $sort));
        $total = $this->admin_model->lists_count(array());
		$jsonData = array('total' => $total, 'results' => array());

        foreach ($query->result as $row)
        {
            $action = '<a title="View" id="'.$row->id_admin.'" class="view '.$row->id_admin.'-view" href="#"><i class="fa fa-file-text font16"></i></a>&nbsp;
						<a title="Edit" href="admin_edit?id='.$row->id_admin.'"><i class="fa fa-pencil font16 text-warning"></i></a>&nbsp;
                        <a title="Delete" id="'.$row->id_admin.'" class="delete '.$row->id_admin.'-delete" href="#"><i class="fa fa-times font16 text-danger"></i></a>';
			
			$code_admin_role = $this->config->item('code_admin_role');
			
			$entry = array(
                'No' => $i,
                'Name' => ucwords($row->name),
                'Username' => $row->username,
                'Email' => $row->email,
                'Role' => $code_admin_role[$row->role],
                'Action' => $action
            );

            $jsonData['results'][] = $entry;
            $i++;
        }

        echo json_encode($jsonData);
    }
	
	function admin_lists()
	{
		$data = array();
		$data['view_content'] = 'admin/admin_lists';
		$this->load->view('templates/frame', $data);
	}
	
	function check_email()
	{
		$query = $this->admin_model->info(array('email' => $this->input->post('email')));
		
		if ($query->code == 200)
		{
			$this->form_validation->set_message('check_email', 'Email sudah terdaftar');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function check_media()
	{
		if ($_FILES["photo"]["error"] == 0)
		{
			$this->load->helper('my');
			$photo = upload_image($_FILES["photo"]);
			
			if (is_array($photo) == FALSE)
			{
				$this->processMedia = $photo;
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('check_media', $photo[0]);
				return FALSE;
			}
		}
		else
		{
			$this->processMedia = '';
			return TRUE;
		}
	}
	
	function check_username()
	{
		$query = $this->admin_model->info(array('username' => $this->input->post('username')));
		
		if ($query->code == 200)
		{
			$this->form_validation->set_message('check_username', 'Username sudah terdaftar');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}
