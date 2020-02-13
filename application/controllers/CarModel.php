<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/28/2019
     * Time: 2:54 PM
     */
    
    class CarModel extends CI_Controller{
        
        //This method will show car listing page
        public function index()
        {
            $this->load->model('Car_model');
            
            $rows = $this->Car_model->all();
            $data['rows'] = $rows;
            $this->load->view('car_model/list',$data);
        }
        
        public function showCreateFrom()
        {
            $html = $this->load->view('car_model/create','',true);
            $response['html'] = $html;
            echo json_encode($response);
        }
        
        public function save()
        {
            $this->load->model('Car_model');
            
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name','Name','required');
            $this->form_validation->set_rules('color','Color','required');
            $this->form_validation->set_rules('price','Price','required');
            
            if($this->form_validation->run() == true)
            {
                //Save enteries to DB
                $formArray = array();
                $formArray['name'] = $this->input->post('name');
                $formArray['color'] = $this->input->post('color');
                $formArray['price'] = $this->input->post('price');
                $formArray['transmission'] = $this->input->post('transmission');
                $formArray['created_at'] = date('Y-m-d H:i:s');
                
                $id = $this->Car_model->create($formArray);
                
                $row = $this->Car_model->getRow($id);
                $vdata['row'] = $row;
                $rowHtml = $this->load->view('car_model/car_row',$vdata,true);
    
                $response['row'] = $rowHtml;
                $response['status'] = 1;
                $response['message'] = "<div class='alert alert-success'>Record Has Been Added Successfully</div>";
            }else{
                $response['status'] = 0;
                $response['name'] = strip_tags(form_error('name'));
                $response['color'] = strip_tags(form_error('color'));
                $response['price'] = strip_tags(form_error('price'));
                //Error message
            }
    
            echo json_encode($response);
        }
        
        
        public function getCarModel($id)
        {
            $this->load->model('Car_model');
            $row = $this->Car_model->getRow($id);
            $data['row'] = $row;
            
            $html = $this->load->view('car_model/edit',$data,true);
            $response['html'] = $html;
            echo json_encode($response);
        }
        
        public function updateModal()
        {
            $this->load->model('Car_model');
            
            $id = $this->input->post('editId');
    
            $row = $this->Car_model->getRow($id);
            
            if(empty($row))
            {
                $response['msg'] = "Either record deleted or not found in DB";
                $response['status'] = 100;
                json_encode($response);
                exit;
            }
    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name','Name','required');
            $this->form_validation->set_rules('color','Color','required');
            $this->form_validation->set_rules('price','Price','required');
    
            if($this->form_validation->run() == true)
            {
                //Save enteries to DB
                $formArray = array();
                $formArray['name'] = $this->input->post('name');
                $formArray['color'] = $this->input->post('color');
                $formArray['price'] = $this->input->post('price');
                $formArray['transmission'] = $this->input->post('transmission');
                $formArray['updated_at'] = date('Y-m-d H:i:s');
        
                $id = $this->Car_model->update($id,$formArray);
        
                $row = $this->Car_model->getRow($id);
        
                $response['row'] = $row;
                $response['status'] = 1;
                $response['message'] = "<div class='alert alert-success'>Record Has Been Updated Successfully</div>";
            }else{
                $response['status'] = 0;
                $response['name'] = strip_tags(form_error('name'));
                $response['color'] = strip_tags(form_error('color'));
                $response['price'] = strip_tags(form_error('price'));
                //Error message
            }
    
            echo json_encode($response);
        }
        
        public function deleteModel($id)
        {
            $this->load->model('Car_model');
            
            $row = $this->Car_model->getRow($id);
    
            if(empty($row))
            {
                $response['msg'] = "<div class='alert alert-warning'>Either record Already deleted or not found in DB</div>";
                $response['status'] = 0;
                echo json_encode($response);
                exit;
            }else{
                $this->Car_model->delete($id);
                
                $response['msg'] = "<div class='alert alert-success'>Record Deleted Successfully</div>";
                $response['status'] = 1;
                echo json_encode($response);
            }
        }
    }