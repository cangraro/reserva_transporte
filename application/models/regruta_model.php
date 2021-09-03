<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class regruta_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insertar_ruta($data) {
        $result = $this->db->insert('ruta', $data);
        //PRINT_R($result);
        //DIE;
        if($result){
            return true;
        }else{
            return false;
        }
    }
    function get_rut_ex($id) {        
        $this->db->select('ruta.descripcion');
        $this->db->where('ruta.id_lugar_inicio', $id['id_lugar_inicio']);
        $this->db->where('ruta.id_lugar_fin', $id['id_lugar_fin']);        
        $query = $this->db->get('ruta');   
        //echo $this->db->last_query();
        //die;
        return $query;
    }
    
    
}
