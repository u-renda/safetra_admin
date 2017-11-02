<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

	private $processMedia;
	
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
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('client_model');
		
		if ($this->session->userdata('is_login') == FALSE) { redirect($this->config->item('link_login')); }
    }
	
	function client_create()
	{
		$data = array();
		
		if ($this->input->post('submit') == TRUE)
		{
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_message('required', '%s harus diisi');
			$this->form_validation->set_rules('name', 'nama', 'required');
			$this->form_validation->set_rules('logo', 'logo', 'callback_check_media');
			
			if ($this->form_validation->run() == TRUE)
			{
				$param = array();
				$param['name'] = $this->input->post('name');
				$param['client_url'] = $this->input->post('client_url');
				$param['logo'] = $this->processMedia;
				$query = $this->client_model->create($param);
				
				if ($query->code == 200)
				{
					redirect($this->config->item('link_client_lists').'?msg=success&type=create');
				}
				else
				{
					redirect($this->config->item('link_client_lists').'?msg=error&type=create');
				}
			}
		}
		
		$data['view_content'] = 'client/client_create';
		$this->load->view('templates/frame', $data);
	}
	
	function client_delete()
	{
		$data = array();
        $data['id'] = $this->input->post('id');
        $data['action'] = $this->input->post('action');
        $data['grid'] = $this->input->post('grid');

        $get = $this->client_model->info(array('id_client' => $data['id']));

        if ($get->code == 200)
        {
            if ($this->input->post('delete') == TRUE)
            {
                $query = $this->client_model->delete(array('id_client' => $data['id']));

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

    function client_edit()
    {
        $data = array();
		$data['id'] = $this->input->get_post('id');
        $get = $this->client_model->info(array('id_client' => $data['id']));

        if ($get->code == 200)
        {
            if ($this->input->post('submit') == TRUE)
            {
                $this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
				$this->form_validation->set_message('required', '%s harus diisi');
				$this->form_validation->set_rules('name', 'nama', 'required');
				$this->form_validation->set_rules('logo', 'logo', 'callback_check_media');

                if ($this->form_validation->run() == TRUE)
                {
					$param = array();
					if ($this->processMedia != '')
					{
						$param['logo'] = $this->processMedia;
					}
					
					$param['id_client'] = $data['id'];
					$param['name'] = $this->input->post('name');
					$param['client_url'] = $this->input->post('client_url');
					$query = $this->client_model->update($param);
					
					if ($query->code == 200)
					{
						redirect($this->config->item('link_client_lists').'?msg=success&type=edit');
					}
					else
					{
						redirect($this->config->item('link_client_lists').'?msg=error&type=edit');
					}
				}
            }

            $data['result'] = $get->result;
            $data['view_content'] = 'client/client_edit';
        }
        else
        {
            $data['view_content'] = 'errors/data_not_found';
        }
		
		$this->load->view('templates/frame', $data);
    }

    function client_get()
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

        $query = $this->client_model->lists(array('limit' => $pageSize, 'offset' => $offset, 'order' => $order, 'sort' => $sort));
        $jsonData = array('total' => $query->total, 'results' => array());

        foreach ($query->result as $row)
        {
            $action = '<a title="View" id="'.$row->id_client.'" class="view '.$row->id_client.'-view" href="#"><i class="fa fa-file-text font16"></i></a>&nbsp;
						<a title="Edit" href="client_edit?id='.$row->id_client.'"><i class="fa fa-pencil font16 text-warning"></i></a>&nbsp;
                        <a title="Delete" id="'.$row->id_client.'" class="delete '.$row->id_client.'-delete" href="#"><i class="fa fa-times font16 text-danger"></i></a>';
			
            $entry = array(
                'No' => $i,
                'Name' => $row->name,
                'ClientURL' => $row->client_url,
                'Action' => $action
            );

            $jsonData['results'][] = $entry;
            $i++;
        }

        echo json_encode($jsonData);
    }
	
	function client_lists()
	{
		$data = array();
		$data['type'] = $this->input->get('type');
		$data['msg'] = $this->input->get('msg');
		$data['view_content'] = 'client/client_lists';
		$this->load->view('templates/frame', $data);
	}
    
    function client_view()
    {
		$id = $this->input->post('id');
		$get = $this->client_model->info(array('id_client' => $id));
		
		if ($get->code == 200)
		{
            $result = $get->result;
			
            $data = array();
            $data['result'] = $result;
			$this->load->view('client/client_view', $data);
		}
		else
		{
			echo "Data Not Found";
		}
    }
}
