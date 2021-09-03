<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class regconductor_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function insertar_usuario($data) {
        $result = $this->db->insert('usuarios', $data);
        //PRINT_R($result);
        //DIE;
        if($result){
            return true;
        }else{
            return false;
        }
    }
    function get_usuario($id) {
        $this->db->select('usuarios.id_usuario');
        $this->db->where('usuarios.id_usuario', $id);
        $query = $this->db->get('usuarios');   
        //echo $this->db->last_query();
        //die;
        return $query;
    }
    
    
}
