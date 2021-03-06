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
	
	function program_create()
	{
		$data = array();
		
		if ($this->input->post('submit') == TRUE)
		{
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_message('required', '%s harus diisi');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('introduction', 'pengertian program', 'required');
			
			if ($this->form_validation->run() == TRUE)
			{
				$param = array();
				$param['name'] = $this->input->post('name');
				$param['introduction'] = $this->input->post('introduction');
				$param['training_purpose'] = $this->input->post('training_purpose');
				$param['target_participant'] = $this->input->post('target_participant');
				$param['course_content'] = $this->input->post('course_content');
				$param['others'] = $this->input->post('others');
				$query = $this->program_model->create($param);
				
				if ($query->code == 200)
				{
					redirect($this->config->item('link_program_lists').'?msg=success&type=create');
				}
				else
				{
					redirect($this->config->item('link_program_lists').'?msg=error&type=create');
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

        if ($get->code == 200)
        {
            if ($this->input->post('delete') == TRUE)
            {
                $query = $this->program_model->delete(array('id_program' => $data['id']));

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
	
	function program_edit()
	{
		$data = array();
		$data['id'] = $this->input->get('id');
		$query2 = $this->program_model->info(array('id_program' => $data['id']));
		
		if ($query2->code == 200)
		{
			if ($this->input->post('submit') == TRUE)
			{
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
				$this->form_validation->set_message('required', '%s harus diisi');
				$this->form_validation->set_rules('name', 'Name', 'required');
				$this->form_validation->set_rules('introduction', 'pengertian program', 'required');
				
				if ($this->form_validation->run() == TRUE)
				{
					$param = array();
					$param['id_program'] = $data['id'];
					$param['name'] = $this->input->post('name');
					$param['introduction'] = $this->input->post('introduction');
					$param['training_purpose'] = $this->input->post('training_purpose');
					$param['target_participant'] = $this->input->post('target_participant');
					$param['course_content'] = $this->input->post('course_content');
					$param['others'] = $this->input->post('others');
					$query = $this->program_model->update($param);
					
					if ($query->code == 200)
					{
						redirect($this->config->item('link_program_lists').'?msg=success&type=update');
					}
					else
					{
						redirect($this->config->item('link_program_lists').'?msg=error&type=update');
					}
				}
			}
			
			$data['result'] = $query2->result;
			$data['view_content'] = 'program/program_edit';
			$this->load->view('templates/frame', $data);
		}
        else
        {
			$data['view_content'] = 'errors/data_not_found';
			$this->load->view('templates/frame', $data);
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
        $jsonData = array('total' => $query->total, 'results' => array());

        foreach ($query->result as $row)
        {
            $action = '<a title="View" id="'.$row->id_program.'" class="view '.$row->id_program.'-view" href="#"><i class="fa fa-file-text font16"></i></a>&nbsp;
						<a title="Edit" href="program_edit?id='.$row->id_program.'"><i class="fa fa-pencil font16 text-warning"></i></a>&nbsp;
                        <a title="Delete" id="'.$row->id_program.'" class="delete '.$row->id_program.'-delete" href="#"><i class="fa fa-times font16 text-danger"></i></a>';
			
			$entry = array(
                'No' => $i,
                'Name' => '<a title="View Sub Program" href="program_sub_lists?id='.$row->id_program.'">'.ucwords($row->name).'</a>',
                'Introduction' => $row->introduction,
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
		$data['type'] = $this->input->get('type');
		$data['msg'] = $this->input->get('msg');
		$data['view_content'] = 'program/program_lists';
		$this->load->view('templates/frame', $data);
	}
    
    function program_view()
    {
		$id = $this->input->post('id');
		$get = $this->program_model->info(array('id_program' => $id));
		
		if ($get->code == 200)
		{
            $result = $get->result;
			
            $data = array();
            $data['result'] = $result;
			$this->load->view('program/program_view', $data);
		}
		else
		{
			echo "Data Not Found";
		}
    }
	
	function program_sub_create()
	{
		$data = array();
		$id_program = $this->input->get('id');
		
		if ($this->input->post('submit') == TRUE)
		{
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_message('required', '%s harus diisi');
			$this->form_validation->set_rules('name', 'nama', 'required');
			$this->form_validation->set_rules('introduction', 'pengertian program', 'required');
			$this->form_validation->set_rules('training_purpose', 'tujuan pelatihan', 'required');
			$this->form_validation->set_rules('target_participant', 'persyaratan peserta', 'required');
			$this->form_validation->set_rules('course_content', 'materi pelatihan', 'required');
			
			if ($this->form_validation->run() == TRUE)
			{
				$param = array();
				$param['id_program'] = $id_program;
				$param['name'] = $this->input->post('name');
				$param['introduction'] = $this->input->post('introduction');
				$param['training_purpose'] = $this->input->post('training_purpose');
				$param['target_participant'] = $this->input->post('target_participant');
				$param['course_content'] = $this->input->post('course_content');
				$param['others'] = $this->input->post('others');
				$query = $this->program_sub_model->create($param);
				
				if ($query->code == 200)
				{
					redirect($this->config->item('link_program_sub_lists').'?id='.$id_program.'&msg=success&type=create');
				}
				else
				{
					redirect($this->config->item('link_program_sub_lists').'?id='.$id_program.'&msg=error&type=create');
				}
			}
		}
		
		$query2 = $this->program_model->info(array('id_program' => $id_program));
		
		if ($query2->code == 200)
		{
			$data['program'] = $query2->result;
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

        if ($get->code == 200)
        {
            if ($this->input->post('delete') == TRUE)
            {
                $query = $this->program_sub_model->delete(array('id_program_sub' => $data['id']));

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
	
	function program_sub_edit()
	{
		$data = array();
		$data['id'] = $this->input->get('id');
		$query2 = $this->program_sub_model->info(array('id_program_sub' => $data['id']));
		
		if ($query2->code == 200)
		{
			if ($this->input->post('submit') == TRUE)
			{
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
				$this->form_validation->set_message('required', '%s harus diisi');
				$this->form_validation->set_rules('name', 'nama', 'required');
				$this->form_validation->set_rules('introduction', 'pengertian program', 'required');
				$this->form_validation->set_rules('training_purpose', 'tujuan pelatihan', 'required');
				$this->form_validation->set_rules('target_participant', 'persyaratan peserta', 'required');
				$this->form_validation->set_rules('course_content', 'materi pelatihan', 'required');
				
				if ($this->form_validation->run() == TRUE)
				{
					$param = array();
					$param['id_program_sub'] = $data['id'];
					$param['name'] = $this->input->post('name');
					$param['introduction'] = $this->input->post('introduction');
					$param['training_purpose'] = $this->input->post('training_purpose');
					$param['target_participant'] = $this->input->post('target_participant');
					$param['course_content'] = $this->input->post('course_content');
					$param['others'] = $this->input->post('others');
					$query = $this->program_sub_model->update($param);
					
					if ($query->code == 200)
					{
						redirect($this->config->item('link_program_sub_lists').'?id='.$query2->result->program->id_program.'&msg=success&type=update');
					}
					else
					{
						redirect($this->config->item('link_program_sub_lists').'?id='.$query2->result->program->id_program.'&msg=error&type=update');
					}
				}
			}
			
			$data['result'] = $query2->result;
			$data['view_content'] = 'program/program_sub_edit';
			$this->load->view('templates/frame', $data);
		}
        else
        {
			$data['view_content'] = 'errors/data_not_found';
			$this->load->view('templates/frame', $data);
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
		$jsonData = array('total' => $query->total, 'results' => array());

        foreach ($query->result as $row)
        {
            $action = '<a title="View" id="'.$row->id_program_sub.'" class="view '.$row->id_program_sub.'-view" href="#"><i class="fa fa-file-text font16"></i></a>&nbsp;
						<a title="Edit" href="program_sub_edit?id='.$row->id_program_sub.'"><i class="fa fa-pencil font16 text-warning"></i></a>&nbsp;
                        <a title="Delete" id="'.$row->id_program_sub.'" class="delete '.$row->id_program_sub.'-delete" href="#"><i class="fa fa-times font16 text-danger"></i></a>';
			
			$entry = array(
                'No' => $i,
                'Name' => ucwords($row->name),
                'Introduction' => $row->introduction,
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
		$data['id_program'] = $this->input->get_post('id');
		
		$query2 = $this->program_model->info(array('id_program' => $data['id_program']));
		
		if ($query2->code == 200)
		{
			$data['program'] = $query2->result;
		}
		
		$data['type'] = $this->input->get('type');
		$data['msg'] = $this->input->get('msg');
		$data['view_content'] = 'program/program_sub_lists';
		$this->load->view('templates/frame', $data);
	}
    
    function program_sub_view()
    {
		$id = $this->input->post('id');
		$get = $this->program_sub_model->info(array('id_program_sub' => $id));
		
		if ($get->code == 200)
		{
            $result = $get->result;
			
            $data = array();
            $data['result'] = $result;
			$this->load->view('program/program_sub_view', $data);
		}
		else
		{
			echo "Data Not Found";
		}
    }
}
