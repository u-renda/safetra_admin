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
			$this->form_validation->set_message('required', '%s harus diisi');
			$this->form_validation->set_message('min_length', '%s minimal 6 karakter');
			$this->form_validation->set_message('valid_email', 'Format %s salah');
			$this->form_validation->set_rules('name', 'nama', 'required');
			$this->form_validation->set_rules('username', 'username', 'required|callback_check_username');
			$this->form_validation->set_rules('password', 'password', 'required|min_length[6]');
			$this->form_validation->set_rules('email', 'email', 'required|valid_email|callback_check_email');
			$this->form_validation->set_rules('role', 'peran di admin', 'required');
			$this->form_validation->set_rules('job_title', 'jabatan kerja', 'required');
			$this->form_validation->set_rules('photo', 'foto', 'callback_check_media');
			
			if ($this->form_validation->run() == FALSE)
			{
				validation_errors();
			}
			else
			{
				$param = array();
				$param['name'] = $this->input->post('name');
				$param['username'] = $this->input->post('username');
				$param['password'] = $this->input->post('password');
				$param['email'] = $this->input->post('email');
				$param['photo'] = $this->processMedia;
				$param['status'] = 1;
				$param['role'] = $this->input->post('role');
				$param['job_title'] = $this->input->post('job_title');
				$query = $this->admin_model->create($param);
				
				if ($query->code == 200)
				{
					redirect($this->config->item('link_admin_lists').'?msg=success&type=create');
				}
				else
				{
					redirect($this->config->item('link_admin_lists').'?msg=error&type=create');
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
                $query = $this->admin_model->delete(array('id_admin' => $data['id']));

                if ($query->code == 200)
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

    function admin_edit()
    {
        $id = $this->input->get_post('id');
        $get = $this->admin_model->info(array('id_admin' => $id));

        if ($get->code == 200)
        {
            if ($this->input->post('submit'))
            {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('name', 'name', 'required');
                $this->form_validation->set_rules('email', 'email', 'required|valid_email|callback_check_admin_email');
                $this->form_validation->set_rules('username', 'username', 'required');

                if ($this->form_validation->run() == TRUE)
                {
                    $param = array();
                    if ($this->input->post('password') != '')
                    {
                        $data['password'] = $this->input->post('password');
                    }

                    $param['id_admin'] = $id;
                    $param['username'] = $this->input->post('username');
                    $param['name'] = $this->input->post('name');
                    $param['email'] = $this->input->post('email');
                    $param['admin_role'] = 1;
                    $query = $this->admin_model->update($param);

                    if ($query->code == 200)
                    {
                        redirect($this->config->item('link_admin_lists'));
                    }
                    else
                    {
                        $data['error'] = $query->result;
                    }
                }
            }

            $data['admin'] = $get->result;
            $data['view_content'] = 'admin/admin_edit';
            $this->load->view('templates/frame', $data);
        }
        else
        {
            echo "Data not found";
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
		$jsonData = array('total' => $query->total, 'results' => array());

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
		$data['type'] = $this->input->get('type');
		$data['msg'] = $this->input->get('msg');
		$data['view_content'] = 'admin/admin_lists';
		$this->load->view('templates/frame', $data);
	}
	
	function admin_view()
	{
		$id = $this->input->post('id');
		$get = $this->admin_model->info(array('id_admin' => $id));
		
		if ($get->code == 200)
		{
			$result = $get->result;
            $code_admin_status = $this->config->item('code_admin_status');
            $code_admin_role = $this->config->item('code_admin_role');
			
            $data = array();
            $data['username'] = $result->username;
            $data['email'] = $result->email;
            $data['name'] = $result->name;
            $data['photo'] = $result->photo;
            $data['status'] = $code_admin_status[$result->status];
            $data['role'] = $code_admin_role[$result->role];
            $data['job_title'] = $result->job_title;
			$this->load->view('admin/admin_view', $data);
		}
		else
		{
			echo "Data Not Found";
		}
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
