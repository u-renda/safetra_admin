<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends CI_Controller {

	private $processMedia;
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('media_album_model');
		$this->load->model('media_model');
		
		if ($this->session->userdata('is_login') == FALSE) { redirect($this->config->item('link_login')); }
    }
	
	function check_media()
	{
		$media = array();
		$total = count($_FILES['media']['name']);
		
		for ($i=0; $i<$total; $i++)
		{
			if ($_FILES["media"]["error"][$i] == 0)
			{
				$this->load->helper('my');
				
				$temp = array();
				$temp['name'] = $_FILES['media']['name'][$i];
				$temp['type'] = $_FILES['media']['type'][$i];
				$temp['tmp_name'] = $_FILES['media']['tmp_name'][$i];
				$temp['error'] = $_FILES['media']['error'][$i];
				$temp['size'] = $_FILES['media']['size'][$i];
				
				$photo = upload_image($temp);
				
				if (is_array($photo) == FALSE)
				{
					$media[$i] = $photo;
				}
				else
				{
					$this->form_validation->set_message('check_media', $photo[0]);
					return FALSE;
				}
			}
		}
		
		if (count($media) == 0)
		{
			$this->form_validation->set_message('check_media', $photo[0]);
			return FALSE;
		}
		else
		{
			$this->processMedia = $media;
			return TRUE;
		}
	}
	
	function media_album_create()
	{
		$data = array();
		
		if ($this->input->post('submit') == TRUE)
		{
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_message('required', '%s harus diisi');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('media[]', 'Media', 'callback_check_media');
			
			if ($this->form_validation->run() == FALSE)
			{
				validation_errors();
			}
			else
			{
				// save media album
				$param = array();
				$param['name'] = $this->input->post('name');
				$query = $this->media_album_model->create($param);
				
				if ($query->code == 200)
				{
					// save media
					foreach ($this->processMedia as $key => $val)
					{
						$param2 = array();
						$param2['id_media_album'] = $query->result->id_media_album;
						$param2['media_url'] = $val;
						$query2 = $this->media_model->create($param2);
					}
					
					redirect($this->config->item('link_media_album_lists').'?msg=success&type=create');
				}
				else
				{
					redirect($this->config->item('link_media_album_lists').'?msg=error&type=create');
				}
			}
		}
		
		$data['view_content'] = 'media/media_album_create';
		$this->load->view('templates/frame', $data);
	}
	
	function media_album_delete()
	{
		$data = array();
        $data['id'] = $this->input->post('id');
        $data['action'] = $this->input->post('action');
        $data['grid'] = $this->input->post('grid');

        $get = $this->media_album_model->info(array('id_media_album' => $data['id']));

        if ($get->code == 200)
        {
            if ($this->input->post('delete') == TRUE)
            {
                $query = $this->media_album_model->delete(array('id_media_album' => $data['id']));

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

    function media_album_get()
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

        $query = $this->media_album_model->lists(array('limit' => $pageSize, 'offset' => $offset, 'order' => $order, 'sort' => $sort));
		$jsonData = array('total' => $query->total, 'results' => array());

        foreach ($query->result as $row)
        {
            $action = '<a title="View Media" href="media_lists?id='.$row->id_media_album.'"><i class="fa fa-external-link font16 text-success"></i></a>&nbsp;
                        <a title="Delete" id="'.$row->id_media_album.'" class="delete '.$row->id_media_album.'-delete" href="#"><i class="fa fa-times font16 text-danger"></i></a>';
			
			$entry = array(
                'No' => $i,
                'Name' => ucwords($row->name),
                'Action' => $action
            );

            $jsonData['results'][] = $entry;
            $i++;
        }

        echo json_encode($jsonData);
    }
	
	function media_album_lists()
	{
		$data = array();
		$data['type'] = $this->input->get('type');
		$data['msg'] = $this->input->get('msg');
		$data['view_content'] = 'media/media_album_lists';
		$this->load->view('templates/frame', $data);
	}
	
	function media_create()
	{
		$data = array();
		$id_media_album = $this->input->get('id');
		
		if ($this->input->post('submit') == TRUE)
		{
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_message('required', '%s harus diisi');
			$this->form_validation->set_rules('media[]', 'Media', 'callback_check_media');
			
			if ($this->form_validation->run() == TRUE)
			{
				foreach ($this->processMedia as $key => $val)
				{
					$param = array();
					$param['id_media_album'] = $id_media_album;
					$param['media_url'] = $val;
					$query = $this->media_model->create($param);
				}
				
				redirect($this->config->item('link_media_lists').'?id='.$id_media_album.'&msg=success&type=create');
			}
			else
			{
				redirect($this->config->item('link_media_lists').'?id='.$id_media_album.'&msg=error&type=create');
			}
		}
		
		$query2 = $this->media_album_model->info(array('id_media_album' => $id_media_album));
		
		if ($query2->code == 200)
		{
			$data['media_album'] = $query2->result;
		}
		
		$data['view_content'] = 'media/media_create';
		$this->load->view('templates/frame', $data);
	}
	
	function media_delete()
	{
		$data = array();
        $data['id'] = $this->input->post('id');
        $data['action'] = $this->input->post('action');
        $data['grid'] = $this->input->post('grid');

        $get = $this->media_model->info(array('id_media' => $data['id']));

        if ($get->code == 200)
        {
            if ($this->input->post('delete') == TRUE)
            {
                $query = $this->media_model->delete(array('id_media' => $data['id']));

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

    function media_get()
    {
        $page = $this->input->post('page') ? $this->input->post('page') : 1;
        $pageSize = $this->input->post('pageSize') ? $this->input->post('pageSize') : 20;
        $offset = ($page - 1) * $pageSize;
        $i = $offset * 1 + 1;
        $order = 'created_date';
        $sort = 'desc';
        $sort_post = $this->input->post('sort');
        $filter = $this->input->post('filter');
        $id_media_album = $this->input->get_post('id');

        if ($sort_post)
        {
            $order = $sort_post[0]['field'];
            $sort = $sort_post[0]['dir'];
        }

        $query = $this->media_model->lists(array('id_media_album' => $id_media_album, 'limit' => $pageSize, 'offset' => $offset, 'order' => $order, 'sort' => $sort));
		$jsonData = array('total' => $query->total, 'results' => array());

        foreach ($query->result as $row)
        {
            $action = '<a title="Delete" id="'.$row->id_media.'" class="delete '.$row->id_media.'-delete" href="#"><i class="fa fa-times font16 text-danger"></i></a>';
			
			$entry = array(
                'No' => $i,
                'Image' => '<img src="'.$row->media_url.'" height="20%">',
                'URL' => '<span style="word-wrap: break-word;">'.$row->media_url.'</span>',
                'Action' => $action
            );

            $jsonData['results'][] = $entry;
            $i++;
        }

        echo json_encode($jsonData);
    }
	
	function media_lists()
	{
		if ($this->input->get_post('id') == FALSE) { redirect($this->config->item('link_media_album_lists')); }
		
		$data = array();
		$data['id_media_album'] = $this->input->get_post('id');
		
		$query2 = $this->media_album_model->info(array('id_media_album' => $data['id_media_album']));
		
		if ($query2->code == 200)
		{
			$data['media_album'] = $query2->result;
		}
		
		$data['type'] = $this->input->get('type');
		$data['msg'] = $this->input->get('msg');
		$data['view_content'] = 'media/media_lists';
		$this->load->view('templates/frame', $data);
	}
}
