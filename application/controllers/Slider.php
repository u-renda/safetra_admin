<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends CI_Controller {

	private $processMedia;
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('slider_model');
		
		if ($this->session->userdata('is_login') == FALSE) { redirect($this->config->item('link_login')); }
    }
	
	function check_media()
	{
		if ($_FILES["slider_url"]["error"] == 0)
		{
			$this->load->helper('my');
			$photo = upload_image($_FILES["slider_url"], TRUE);
			
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
	
	function slider_create()
	{
		$data = array();
		
		if ($this->input->post('submit') == TRUE)
		{
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('slider_url', 'foto', 'callback_check_media');
			
			if ($this->form_validation->run() == TRUE)
			{
				$param = array();
				$param['slider_url'] = $this->processMedia;
				$query = $this->slider_model->create($param);
				
				if ($query->code == 200)
				{
					redirect($this->config->item('link_slider_lists').'?msg=success&type=create');
				}
				else
				{
					redirect($this->config->item('link_slider_lists').'?msg=error&type=create');
				}
			}
		}
		
		$data['view_content'] = 'slider/slider_create';
		$this->load->view('templates/frame', $data);
	}
	
	function slider_delete()
	{
		$data = array();
        $data['id'] = $this->input->post('id');
        $data['action'] = $this->input->post('action');
        $data['grid'] = $this->input->post('grid');

        $get = $this->slider_model->info(array('id_slider' => $data['id']));

        if ($get->code == 200)
        {
            if ($this->input->post('delete') == TRUE)
            {
                $query = $this->slider_model->delete(array('id_slider' => $data['id']));

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

    function slider_edit()
    {
        $data = array();
		$data['id'] = $this->input->get_post('id');
        $get = $this->slider_model->info(array('id_slider' => $data['id']));

        if ($get->code == 200)
        {
            if ($this->input->post('submit') == TRUE)
            {
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
				$this->form_validation->set_rules('slider_url', 'foto', 'callback_check_media');

                if ($this->form_validation->run() == TRUE)
                {
					$param = array();
					if ($this->processMedia != '')
					{
						$param['slider_url'] = $this->processMedia;
					}
					
					$param['id_slider'] = $data['id'];
					$query = $this->slider_model->update($param);
					
					if ($query->code == 200)
					{
						redirect($this->config->item('link_slider_lists').'?msg=success&type=edit');
					}
					else
					{
						redirect($this->config->item('link_slider_lists').'?msg=error&type=edit');
					}
				}
            }
			
            $data['result'] = $get->result;
            $data['view_content'] = 'slider/slider_edit';
        }
        else
        {
            $data['view_content'] = 'errors/data_not_found';
        }
		
		$this->load->view('templates/frame', $data);
    }

    function slider_get()
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

        $query = $this->slider_model->lists(array('limit' => $pageSize, 'offset' => $offset, 'order' => $order, 'sort' => $sort));
        $jsonData = array('total' => $query->total, 'results' => array());

        foreach ($query->result as $row)
        {
            $action = '<a title="Edit" href="slider_edit?id='.$row->id_slider.'"><i class="fa fa-pencil font16 text-warning"></i></a>&nbsp;
                        <a title="Delete" id="'.$row->id_slider.'" class="delete '.$row->id_slider.'-delete" href="#"><i class="fa fa-times font16 text-danger"></i></a>';
			
			$image = '<img src="'.$row->slider_url.'" height="10%">';
			
			$entry = array(
                'No' => $i,
                'Image' => $image,
                'Action' => $action
            );

            $jsonData['results'][] = $entry;
            $i++;
        }

        echo json_encode($jsonData);
    }
	
	function slider_lists()
	{
		$data = array();
		$data['type'] = $this->input->get('type');
		$data['msg'] = $this->input->get('msg');
		$data['view_content'] = 'slider/slider_lists';
		$this->load->view('templates/frame', $data);
	}
}
