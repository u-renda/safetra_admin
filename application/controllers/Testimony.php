<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimony extends CI_Controller {

	private $processMedia;
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('testimony_model');
		
		if ($this->session->userdata('is_login') == FALSE) { redirect($this->config->item('link_login')); }
    }
	
	function testimony_create()
	{
		$data = array();
		
		if ($this->input->post('submit') == TRUE)
		{
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_message('required', '%s harus diisi');
			$this->form_validation->set_rules('name', 'nama', 'required');
			$this->form_validation->set_rules('job_title', 'perusahaan & jabatan', 'required');
			$this->form_validation->set_rules('testimony', 'testimoni', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				validation_errors();
			}
			else
			{
				$param = array();
				$param['name'] = $this->input->post('name');
				$param['job_title'] = $this->input->post('job_title');
				$param['testimony'] = $this->input->post('testimony');
				$query = $this->testimony_model->create($param);
				
				if ($query->code == 200)
				{
					redirect($this->config->item('link_testimony_lists').'?msg=success&type=create');
				}
				else
				{
					redirect($this->config->item('link_testimony_lists').'?msg=error&type=create');
				}
			}
		}
		
		$data['view_content'] = 'testimony/testimony_create';
		$this->load->view('templates/frame', $data);
	}
	
	function testimony_delete()
	{
		$data = array();
        $data['id'] = $this->input->post('id');
        $data['action'] = $this->input->post('action');
        $data['grid'] = $this->input->post('grid');

        $get = $this->testimony_model->info(array('id_testimony' => $data['id']));

        if ($get->code == 200)
        {
            if ($this->input->post('delete') == TRUE)
            {
                $query = $this->testimony_model->delete(array('id_testimony' => $data['id']));

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

    function testimony_get()
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

        $query = $this->testimony_model->lists(array('limit' => $pageSize, 'offset' => $offset, 'order' => $order, 'sort' => $sort));
        $jsonData = array('total' => $query->total, 'results' => array());

        foreach ($query->result as $row)
        {
            $action = '<a title="View" id="'.$row->id_testimony.'" class="view '.$row->id_testimony.'-view" href="#"><i class="fa fa-file-text font16"></i></a>&nbsp;
						<a title="Edit" href="testimony_edit?id='.$row->id_testimony.'"><i class="fa fa-pencil font16 text-warning"></i></a>&nbsp;
                        <a title="Delete" id="'.$row->id_testimony.'" class="delete '.$row->id_testimony.'-delete" href="#"><i class="fa fa-times font16 text-danger"></i></a>';
			
			$strip = strip_tags($row->testimony);
            $content = substr($strip, 0, 200);
            
            if (strlen($strip) >= 200)
            {
				$content = substr($strip, 0, 200).' ...';
			}
			
            $entry = array(
                'No' => $i,
                'Name' => $row->name,
                'JobTitle' => $row->job_title,
                'Testimony' => $content,
                'Action' => $action
            );

            $jsonData['results'][] = $entry;
            $i++;
        }

        echo json_encode($jsonData);
    }
	
	function testimony_lists()
	{
		$data = array();
		$data['type'] = $this->input->get('type');
		$data['msg'] = $this->input->get('msg');
		$data['view_content'] = 'testimony/testimony_lists';
		$this->load->view('templates/frame', $data);
	}
}
