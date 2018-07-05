<?php
class Bodega_model extends CI_Model{
    //put your code here

 #*******************************************************************************
    public function get_bodega() {
        $bodega=$this->db->get('t_bodega');
    if ($bodega->num_rows()>0) {
        return $bodega;
        }else{
        return false;
        }
    }
#*******************************************************************************
 

}