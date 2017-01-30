<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program extends CI_Controller {

	private $processMedia;
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('program_model');
		$this->load->model('program_sub_model');
		
		if ($this->session->userdata('is_login') == FALSE) { redirect($this->config->item('link_login')); }
    }
	
	function check_slug($param)
	{
		$query = $this->program_sub_model->info(array('slug' => $param));
		
		if ($query->num_rows() > 0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function program_create()
	{
		$data = array();
		
		if ($this->input->post('submit') == TRUE)
		{
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('percentage', 'Percentage', 'required');
			
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
					$slug = url_title(strtolower(''.$title.'-'.$counter.''));
				}
				else
				{
					$slug = $url_title;
				}
				
				$param = array();
				$param['name'] = $this->input->post('name');
				$param['slug'] = $slug;
				$param['percentage'] = $this->input->post('percentage');
				$param['created_date'] = date('Y-m-d H:i:s');
				$param['updated_date'] = date('Y-m-d H:i:s');
				$query = $this->program_model->create($param);
				
				if ($query > 0)
				{
					redirect($this->config->item('link_program_lists'));
				}
				else
				{
					$data['error_save'] = 'Failed Create Data';
				}
			}
		}
		
		$data['view_content'] = 'program/program_create';
		$this->load->view('templates/frame', $data);
	}
	
	function program_delete()
	{
		$data = array();
        $data['id'] = $this->input->post('id');
        $data['action'] = $this->input->post('action');
        $data['grid'] = $this->input->post('grid');

        $get = $this->program_model->info(array('id_program' => $data['id']));

        if ($get->num_rows() > 0)
        {
            if ($this->input->post('delete') == TRUE)
            {
                $query = $this->program_model->delete($data['id']);

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

    function program_get()
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

        $query = $this->program_model->lists(array('limit' => $pageSize, 'offset' => $offset, 'order' => $order, 'sort' => $sort));
        $total = $this->program_model->lists_count(array());
		$jsonData = array('total' => $total, 'results' => array());

        foreach ($query->result() as $row)
        {
            $action = '<a title="Add Sub-program" href="program_sub_create?id='.$row->id_program.'"><i class="fa fa-plus font16"></i></a>&nbsp;
						<a title="View Sub Program" href="program_sub_lists?id='.$row->id_program.'"><i class="fa fa-external-link font16 text-success"></i></a>&nbsp;
						<a title="Edit" href="program_edit?id='.$row->id_program.'"><i class="fa fa-pencil font16 text-warning"></i></a>&nbsp;
                        <a title="Delete" id="'.$row->id_program.'" class="delete '.$row->id_program.'-delete" href="#"><i class="fa fa-times font16 text-danger"></i></a>';
			
			$entry = array(
                'No' => $i,
                'Name' => ucwords($row->name),
                'Percentage' => $row->percentage,
                'Action' => $action
            );

            $jsonData['results'][] = $entry;
            $i++;
        }

        echo json_encode($jsonData);
    }
	
	function program_lists()
	{
		$data = array();
		$data['view_content'] = 'program/program_lists';
		$this->load->view('templates/frame', $data);
	}
	
	function program_sub_create()
	{
		$data = array();
		$id_program = $this->input->get('id');
		
		if ($this->input->post('submit') == TRUE)
		{
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('program_objective', 'Tujuan Program', 'required');
			$this->form_validation->set_rules('training_purpose', 'Tujuan Pelatihan', 'required');
			$this->form_validation->set_rules('requirements_of_participant', 'Persyaratan Peserta', 'required');
			$this->form_validation->set_rules('training_material', 'Materi Pelatihan', 'required');
			
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
					$slug = url_title(strtolower(''.$title.'-'.$counter.''));
				}
				else
				{
					$slug = $url_title;
				}
				
				$param = array();
				$param['id_program'] = $id_program;
				$param['name'] = $this->input->post('name');
				$param['slug'] = $slug;
				$param['program_objective'] = $this->input->post('program_objective');
				$param['training_purpose'] = $this->input->post('training_purpose');
				$param['requirements_of_participant'] = $this->input->post('requirements_of_participant');
				$param['training_material'] = $this->input->post('training_material');
				$param['others'] = $this->input->post('others');
				$param['created_date'] = date('Y-m-d H:i:s');
				$param['updated_date'] = date('Y-m-d H:i:s');
				$query = $this->program_sub_model->create($param);
				
				if ($query > 0)
				{
					redirect($this->config->item('link_program_sub_lists').'?id='.$id_program);
				}
				else
				{
					$data['error_save'] = 'Failed Create Data';
				}
			}
		}
		
		$query2 = $this->program_model->info(array('id_program' => $id_program));
		
		if ($query2->num_rows() > 0)
		{
			$data['program'] = $query2->row();
		}
		
		$data['view_content'] = 'program/program_sub_create';
		$this->load->view('templates/frame', $data);
	}
	
	function program_sub_delete()
	{
		$data = array();
        $data['id'] = $this->input->post('id');
        $data['action'] = $this->input->post('action');
        $data['grid'] = $this->input->post('grid');

        $get = $this->program_sub_model->info(array('id_program_sub' => $data['id']));

        if ($get->num_rows() > 0)
        {
            if ($this->input->post('delete') == TRUE)
            {
                $query = $this->program_sub_model->delete($data['id']);

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

    function program_sub_get()
    {
        $page = $this->input->post('page') ? $this->input->post('page') : 1;
        $pageSize = $this->input->post('pageSize') ? $this->input->post('pageSize') : 20;
        $offset = ($page - 1) * $pageSize;
        $i = $offset * 1 + 1;
        $order = 'created_date';
        $sort = 'desc';
        $sort_post = $this->input->post('sort');
        $filter = $this->input->post('filter');
        $id_program = $this->input->get_post('id');
		
        if ($sort_post)
        {
            $order = $sort_post[0]['field'];
            $sort = $sort_post[0]['dir'];
        }

        $query = $this->program_sub_model->lists(array('id_program' => $id_program, 'limit' => $pageSize, 'offset' => $offset, 'order' => $order, 'sort' => $sort));
        $total = $this->program_sub_model->lists_count(array('id_program' => $id_program));
		$jsonData = array('total' => $total, 'results' => array());

        foreach ($query->result() as $row)
        {
            $action = '<a title="Edit" href="program_edit?id='.$row->id_program.'"><i class="fa fa-pencil font16 text-warning"></i></a>&nbsp;
                        <a title="Delete" id="'.$row->id_program.'" class="delete '.$row->id_program.'-delete" href="#"><i class="fa fa-times font16 text-danger"></i></a>';
			
			$entry = array(
                'No' => $i,
                'Name' => ucwords($row->name),
                'ProgramObjective' => $row->program_objective,
                'Action' => $action
            );

            $jsonData['results'][] = $entry;
            $i++;
        }

        echo json_encode($jsonData);
    }
	
	function program_sub_lists()
	{
		if ($this->input->get_post('id') == FALSE) { redirect($this->config->item('link_program_lists')); }
		
		$data = array();
		$query2 = $this->program_model->info(array('id_program' => $this->input->get_post('id')));
		
		if ($query2->num_rows() > 0)
		{
			$data['program'] = $query2->row();
		}
		
		$data['view_content'] = 'program/program_sub_lists';
		$this->load->view('templates/frame', $data);
	}
}