<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {

	private $processMedia;
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('article_model');
		
		if ($this->session->userdata('is_login') == FALSE) { redirect($this->config->item('link_login')); }
    }
	
	function article_create()
	{
		$data = array();
		
		if ($this->input->post('submit') == TRUE)
		{
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('title', 'Title', 'required');
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
				$param['created_date'] = date('Y-m-d H:i:s');
				$param['updated_date'] = date('Y-m-d H:i:s');
				$query = $this->article_model->create($param);
				
				if ($query > 0)
				{
					redirect($this->config->item('link_article_lists'));
				}
				else
				{
					$data['error_save'] = 'Failed Create Data';
				}
			}
		}
		
		$data['view_content'] = 'article/article_create';
		$this->load->view('templates/frame', $data);
	}
	
	function article_delete()
	{
		$data = array();
        $data['id'] = $this->input->post('id');
        $data['action'] = $this->input->post('action');
        $data['grid'] = $this->input->post('grid');

        $get = $this->article_model->info(array('id_article' => $data['id']));

        if ($get->code == 200)
        {
            if ($this->input->post('delete') == TRUE)
            {
                $query = $this->article_model->delete($data['id']);

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

    function article_get()
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

        $query = $this->article_model->lists(array('limit' => $pageSize, 'offset' => $offset, 'order' => $order, 'sort' => $sort));
        $total = $this->article_model->lists_count(array());
		$jsonData = array('total' => $total, 'results' => array());

        foreach ($query->result as $row)
        {
            $action = '<a title="View" id="'.$row->id_article.'" class="view '.$row->id_article.'-view" href="#"><i class="fa fa-file-text font16"></i></a>&nbsp;
						<a title="Edit" href="article_edit?id='.$row->id_article.'"><i class="fa fa-pencil font16 text-warning"></i></a>&nbsp;
                        <a title="Delete" id="'.$row->id_article.'" class="delete '.$row->id_article.'-delete" href="#"><i class="fa fa-times font16 text-danger"></i></a>';
			
			$strip = strip_tags($row->content);
            $content = substr($strip, 0, 200);
            
            if (strlen($strip) >= 200)
            {
				$content = substr($strip, 0, 200).' ...';
			}
			
            $entry = array(
                'No' => $i,
                'Title' => $row->title,
                'Content' => $content,
                'Action' => $action
            );

            $jsonData['results'][] = $entry;
            $i++;
        }

        echo json_encode($jsonData);
    }
	
	function article_lists()
	{
		$data = array();
		$data['view_content'] = 'article/article_lists';
		$this->load->view('templates/frame', $data);
	}
	
	function check_media()
	{
		if ($_FILES["media"]["error"] == 0)
		{
			$this->load->helper('my');
			$photo = upload_image($_FILES["media"], TRUE);
			
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
	
	function check_slug($param)
	{
		$query = $this->article_model->info(array('slug' => $param));
		
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
