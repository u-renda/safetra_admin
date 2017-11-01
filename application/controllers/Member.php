<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	private $processMedia;
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('company_model');
		$this->load->model('member_model');
		
		if ($this->session->userdata('is_login') == FALSE) { redirect($this->config->item('link_login')); }
    }
	
	function member_create()
	{
		$data = array();
		
		if ($this->input->post('submit') == TRUE)
		{
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_message('required', '%s harus diisi');
			$this->form_validation->set_message('valid_email', 'Format %s salah');
			$this->form_validation->set_message('numeric', 'Hanya diisi dengan angka');
			$this->form_validation->set_message('min_length', '%s minimal 5 karakter');
			$this->form_validation->set_rules('id_company', 'perusahaan', 'required');
			$this->form_validation->set_rules('name', 'nama', 'required');
			$this->form_validation->set_rules('email', 'email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'password', 'min_length[5]');
			$this->form_validation->set_rules('phone_number', 'telp', 'required|numeric');
			
			if ($this->form_validation->run() == FALSE)
			{
				validation_errors();
			}
			else
			{
				$param = array();
				$param['id_company'] = $this->input->post('id_company');
				$param['name'] = $this->input->post('name');
				$param['email'] = $this->input->post('email');
				$param['password'] = $this->input->post('password');
				$param['phone_number'] = $this->input->post('phone_number');
				$param['status'] = 1;
				$query = $this->member_model->create($param);
				
				if ($query->code == 200)
				{
					redirect($this->config->item('link_member_lists').'?msg=success&type=create');
				}
				else
				{
					redirect($this->config->item('link_member_lists').'?msg=error&type=create');
				}
			}
		}
		
		$query2 = $this->company_model->lists(array());
		$company = array();
		
		if ($query2->code == 200)
		{
			$company = $query2->result;
		}
		
		$data['company_lists'] = (object) $company;
		$data['view_content'] = 'member/member_create';
		$this->load->view('templates/frame', $data);
	}
	
	function member_delete()
	{
		$data = array();
        $data['id'] = $this->input->post('id');
        $data['action'] = $this->input->post('action');
        $data['grid'] = $this->input->post('grid');

        $get = $this->member_model->info(array('id_member' => $data['id']));

        if ($get->code == 200)
        {
            if ($this->input->post('delete') == TRUE)
            {
                $query = $this->member_model->delete(array('id_member' => $data['id']));

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
    function member_get()
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

        $query = $this->member_model->lists(array('limit' => $pageSize, 'offset' => $offset, 'order' => $order, 'sort' => $sort));
        $jsonData = array('total' => $query->total, 'results' => array());

        foreach ($query->result as $row)
        {
			$code_member_status = $this->config->item('code_member_status');
			
            $action = '<a title="View" id="'.$row->id_member.'" class="view '.$row->id_member.'-view" href="#"><i class="fa fa-file-text font16"></i></a>&nbsp;
						<a title="Edit" href="member_edit?id='.$row->id_member.'"><i class="fa fa-pencil font16 text-warning"></i></a>&nbsp;
                        <a title="Delete" id="'.$row->id_member.'" class="delete '.$row->id_member.'-delete" href="#"><i class="fa fa-times font16 text-danger"></i></a>';
			
			$entry = array(
                'No' => $i,
                'Name' => $row->name,
                'Email' => $row->email,
                'Phone' => $row->phone_number,
                'Action' => $action
            );

            $jsonData['results'][] = $entry;
            $i++;
        }

        echo json_encode($jsonData);
    }
	
	function member_lists()
	{
		$data = array();
		$data['type'] = $this->input->get('type');
		$data['msg'] = $this->input->get('msg');
		$data['view_content'] = 'member/member_lists';
		$this->load->view('templates/frame', $data);
	}
}
