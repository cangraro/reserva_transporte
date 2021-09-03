<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class misviajes_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_viajes($id) {
        $fecha= date('Y') . '-' . date('m') . '-' . date('d');        
        //$fecha=$fecha->date;
        //print_r($fecha);
        $this->db->select('viaje.id_viaje,viaje.placa,vehiculo.capacidad-count(reserva.id_reserva) disponibles,viaje.horario,count(reserva.id_reserva) reservas,ruta.descripcion,ruta.mapa');
        $this->db->where('viaje.id_estado_viaje', 1);
        $this->db->where('reserva.id_estado_reserva', 1);
        $this->db->where('vehiculo.id_usuario', $id);
        $this->db->where('date(viaje.horario)', $fecha);
        $this->db->join('vehiculo','viaje.placa=vehiculo.placa','inner');
        $this->db->join('reserva','viaje.id_viaje=reserva.id_viaje','inner');
        $this->db->join('ruta','viaje.id_ruta=ruta.id_ruta','inner');        
        $this->db->group_by('viaje.id_viaje,viaje.placa,vehiculo.capacidad,viaje.horario,ruta.descripcion,ruta.mapa');
        $result = $this->db->get('viaje');
        //echo $this->db->last_query();
        //die;
        return $result->result();
    }
    function get_mapa($id) {
        $this->db->select('ruta.mapa');
        $this->db->join('ruta','viaje.id_ruta=ruta.id_ruta','inner');
        $this->db->where('viaje.id_viaje', $id);
        $query = $this->db->get('viaje');
        //echo $this->db->last_query();
        //die;
        $result = $query->result();
        foreach ($result as $value) {
            $data = $value->mapa;
        }
        return $data;
    }
    function actualizar_estado($datos, $id) {
        $this->db->where('id_viaje', $id);
        $query = $this->db->update('viaje', $datos);
        //echo $this->db->last_query();  
        //die;
        //log_message('debug', $this->db->last_query());
        return $query;
    }
    function actualizar_estado_reserv($datos, $id) {
        $this->db->where('id_viaje', $id);
        $this->db->where('id_estado_reserva', 1);
        $query = $this->db->update('reserva', $datos);
        //echo $this->db->last_query();  
        //die;
        //log_message('debug', $this->db->last_query());
        return $query;
    }
    
    
}
