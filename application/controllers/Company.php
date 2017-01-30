<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

	private $processMedia;
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('company_model');
		
		if ($this->session->userdata('is_login') == FALSE) { redirect($this->config->item('link_login')); }
    }
	
	function company_create()
	{
		$data = array();
		
		if ($this->input->post('submit') == TRUE)
		{
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|callback_check_name');
			$this->form_validation->set_rules('pic_name', 'PIC Name', 'required');
			$this->form_validation->set_rules('phone_number', 'Phone Number', 'required|numeric');
			$this->form_validation->set_rules('logo', 'Logo', 'callback_check_media');
			
			if ($this->form_validation->run() == FALSE)
			{
				validation_errors();
			}
			else
			{
				$param = array();
				$param['name'] = $this->input->post('name');
				$param['pic_name'] = $this->input->post('pic_name');
				$param['logo'] = $this->processMedia;
				$param['phone_number'] = $this->input->post('phone_number');
				$param['created_date'] = date('Y-m-d H:i:s');
				$param['updated_date'] = date('Y-m-d H:i:s');
				$query = $this->company_model->create($param);
				
				if ($query > 0)
				{
					redirect($this->config->item('link_company_lists'));
				}
				else
				{
					$data['error_save'] = 'Failed Create Data';
				}
			}
		}
		
		$data['view_content'] = 'company/company_create';
		$this->load->view('templates/frame', $data);
	}
	
	function company_delete()
	{
		$data = array();
        $data['id'] = $this->input->post('id');
        $data['action'] = $this->input->post('action');
        $data['grid'] = $this->input->post('grid');

        $get = $this->company_model->info(array('id_company' => $data['id']));

        if ($get->num_rows() > 0)
        {
            if ($this->input->post('delete') == TRUE)
            {
                $query = $this->company_model->delete($data['id']);

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

    function company_get()
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

        $query = $this->company_model->lists(array('limit' => $pageSize, 'offset' => $offset, 'order' => $order, 'sort' => $sort));
        $total = $this->company_model->lists_count(array());
		$jsonData = array('total' => $total, 'results' => array());

        foreach ($query->result() as $row)
        {
            $action = '<a title="View" id="'.$row->id_company.'" class="view '.$row->id_company.'-view" href="#"><i class="fa fa-file-text font16"></i></a>&nbsp;
						<a title="Edit" href="company_edit?id='.$row->id_company.'"><i class="fa fa-pencil font16 text-warning"></i></a>&nbsp;
                        <a title="Delete" id="'.$row->id_company.'" class="delete '.$row->id_company.'-delete" href="#"><i class="fa fa-times font16 text-danger"></i></a>';
			
			$entry = array(
                'No' => $i,
                'Name' => ucwords($row->name),
                'PICname' => ucwords($row->pic_name),
                'Phone' => $row->phone_number,
                'Action' => $action
            );

            $jsonData['results'][] = $entry;
            $i++;
        }

        echo json_encode($jsonData);
    }
	
	function company_lists()
	{
		$data = array();
		$data['view_content'] = 'company/company_lists';
		$this->load->view('templates/frame', $data);
	}
	
	function check_media()
	{
		if ($_FILES["logo"]["error"] == 0)
		{
			$this->load->helper('my');
			$photo = upload_image($_FILES["logo"]);
			
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
	
	function check_name()
	{
		$query = $this->company_model->info(array('name' => $this->input->post('name')));
		
		if ($query->num_rows() > 0)
		{
			$this->form_validation->set_message('check_name', 'Nama sudah terdaftar');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}
