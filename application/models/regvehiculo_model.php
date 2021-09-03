<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class regvehiculo_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_conductores() {
        $this->db->select('usuarios.id_usuario,usuarios.nombres');
        $this->db->where('usuarios.tipo_usuario',3 );
        $this->db->where('vehiculo.placa',null,false);
        $this->db->join('vehiculo', 'usuarios.id_usuario=vehiculo.id_usuario', 'left');
        $query = $this->db->get('usuarios');
        $result = $query->result();
        $data = array();
        $data[''] = "-- Seleccione un valor --";
        if ($query->num_rows() > 0) {
            foreach ($result as $value) {
                $data[$value->id_usuario] = $value->nombres;
            }
        }
        return $data;
    }
    function get_placa($id) {
        $this->db->select('vehiculo.placa');
        $this->db->where('vehiculo.placa', $id);
        $query = $this->db->get('vehiculo');   
        //echo $this->db->last_query();
        //die;
        return $query;
    }
    function insertar_vehiculo($data) {
        $result = $this->db->insert('vehiculo', $data);
        //PRINT_R($result);
        //DIE;
        if($result){
            return true;
        }else{
            return false;
        }
    }

}
