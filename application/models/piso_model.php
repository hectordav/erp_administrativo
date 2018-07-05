<?php
class Piso_model extends CI_Model{
    //put your code here
 #*******************************************************************************
    public function get_piso() {
        $piso=$this->db->get('t_piso');
    if ($piso->num_rows()>0) {
        return $piso;
        }else{
        return false;
        }
    }
#*******************************************************************************

}