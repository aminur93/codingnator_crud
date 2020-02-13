<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/28/2019
     * Time: 5:08 PM
     */
    
    class Car_model extends CI_Model{
    
        public function create($formArray)
        {
            $this->db->insert('car_models',$formArray);
            return $id = $this->db->insert_id();
        }
        
        public function all()
        {
            $result = $this->db
                           ->order_by('id','asc')
                           ->get('car_models')
                           ->result_array();
            //select * from car_models order by id asc
            return $result;
        }
        
        function getRow($id)
        {
            $this->db->where('id',$id);
            $row = $this->db->get('car_models')->row_array();
            //select * from car_models where id = $id;
            return $row;
        }
        
        function update($id, $formArray)
        {
            $this->db->where('id',$id);
            $this->db->update('car_models',$formArray);
            return $id;
        }
        
        function delete($id)
        {
            $this->db->where('id',$id);
            $this->db->delete('car_models');
        }
    }