<?php
class Iva_model extends CI_Model{
    //put your code here

 #*******************************************************************************
    public function get_iva() {
        $modelo=$this->db->get('t_iva');
    if ($modelo->num_rows()>0) {
            return $modelo;
            }else{
                return false;
            }
        }
#*******************************************************************************
 

}