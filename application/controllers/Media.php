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
	
	function media_album_create()
	{
		$data = array();
		
		if ($this->input->post('submit') == TRUE)
		{
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('media[]', 'Media', 'callback_check_media');
			
			if ($this->form_validation->run() == FALSE)
			{
				validation_errors();
			}
			else
			{
				$url_title = url_title(strtolower($this->input->post('name')));
				
				if ($this->check_slug($url_title) == FALSE)
				{
					$counter = random_string('numeric',5);
					$slug = url_title(strtolower(''.$this->input->post('name').'-'.$counter.''));
				}
				else
				{
					$slug = $url_title;
				}
				
				// save media album
				$param = array();
				$param['name'] = $this->input->post('name');
				$param['slug'] = $slug;
				$param['created_date'] = date('Y-m-d H:i:s');
				$param['updated_date'] = date('Y-m-d H:i:s');
				$query = $this->media_album_model->create($param);
				
				if ($query != 0 || $query != '')
				{
					// save media
					foreach ($this->processMedia as $key => $val)
					{
						$param2 = array();
						$param2['id_media_album'] = $query;
						$param2['media_url'] = $val;
						$param2['created_date'] = date('Y-m-d H:i:s');
						$param2['updated_date'] = date('Y-m-d H:i:s');
						$query2 = $this->media_model->create($param2);
					}
					
					redirect($this->config->item('link_media_album_lists'));
				}
				else
				{
					$data['error_save'] = 'Failed Create Data';
				}
			}
		}
		
		$data['view_content'] = 'media/media_album_create';
		$this->load->view('templates/frame', $data);
	}
	
	function media_create()
	{
		$data = array();
		
		if ($this->input->post('submit') == TRUE)
		{
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('media_album', 'Media Album', 'required');
			$this->form_validation->set_rules('content', 'Content', 'required');
			$this->form_validation->set_rules('tags', 'Tags', 'required');
			$this->form_validation->set_rules('media', 'Media', 'callback_check_media');
			
			if ($this->form_validation->run() == FALSE)
			{
				validation_errors();
			}
			else
			{
				$url_title = url_title(strtolower($this->input->post('title')));
				
				if ($this->check_slug($url_title) == FALSE)
				{
					$counter = random_string('numeric',5);
					$slug = url_title(strtolower(''.$title.'-'.$counter.''));
				}
				else
				{
					$slug = $url_title;
				}
				
				$param = array();
				$param['title'] = $this->input->post('title');
				$param['slug'] = $slug;
				$param['content'] = $this->input->post('content');
				$param['media'] = $this->processMedia;
				$param['tags'] = $this->input->post('tags');
				$query = $this->media_model->create($param);
				
				if ($query > 0)
				{
					redirect($this->config->item('link_media_lists'));
				}
				else
				{
					$data['error_save'] = 'Failed Create Data';
				}
			}
		}
		
		$data['view_content'] = 'media/media_create';
		$this->load->view('templates/frame', $data);
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
            $action = '<a title="View Media" href="program_sub_lists?id='.$row->id_media_album.'"><i class="fa fa-external-link font16 text-success"></i></a>&nbsp;
						<a title="Edit" href="program_edit?id='.$row->id_media_album.'"><i class="fa fa-pencil font16 text-warning"></i></a>&nbsp;
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
		$data['view_content'] = 'media/media_album_lists';
		$this->load->view('templates/frame', $data);
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
				
				$photo = upload_image($temp, TRUE);
				
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
	
	function check_slug($param)
	{
		$query = $this->media_album_model->info(array('slug' => $param));
		
		if ($query->code == 200)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}
