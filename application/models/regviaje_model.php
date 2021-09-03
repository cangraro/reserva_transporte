<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class regviaje_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_vehiculos() {
        $this->db->select('vehiculo.placa');
        $this->db->where('vehiculo.estado',1);
        $query = $this->db->get('vehiculo');
        $result = $query->result();
        $data = array();
        $data[''] = "-- Seleccione un valor --";
        if ($query->num_rows() > 0) {
            foreach ($result as $value) {
                $data[$value->placa] = $value->placa;
            }
        }
        return $data;
    }
    function get_rutas() {
        $this->db->select('ruta.id_ruta,ruta.descripcion');
        $query = $this->db->get('ruta');   
        $result = $query->result();
        $data = array();
        $data[''] = "-- Seleccione un valor --";
        if ($query->num_rows() > 0) {
            foreach ($result as $value) {
                $data[$value->id_ruta] = $value->descripcion;
            }
        }
        return $data;
    }
    function insertar_viaje($data) {
        $result = $this->db->insert('viaje', $data);
        //PRINT_R($result);
        //DIE;
        if($result){
            return true;
        }else{
            return false;
        }
    }
    function get_viaje($id) {
        $this->db->select('viaje.id_viaje');
        $this->db->where('viaje.placa', $id['placa']);
        $this->db->where('viaje.horario', $id['horario']);
        $this->db->where('viaje.id_estado_viaje', 1);
        $query = $this->db->get('viaje');   
        //echo $this->db->last_query();
        //die;
        return $query;
    }
    
    
}
