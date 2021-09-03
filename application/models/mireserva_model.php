<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class mireserva_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_reserva($id) {
        
        $this->db->select('reserva.id_reserva,estado_reserva.estado,viaje.horario,vehiculo.placa,tipo_vehiculo.desc_tipo,ruta.descripcion,usuarios.nombres,usuarios.celular,ruta.mapa');
        $this->db->where('reserva.id_estado_reserva', 1);
        $this->db->where('viaje.id_estado_viaje', 1);
        $this->db->where('reserva.id_usuario', $id);        
        $this->db->join('estado_reserva','reserva.id_estado_reserva=estado_reserva.id_estado_reserva','inner');
        $this->db->join('viaje','reserva.id_viaje=viaje.id_viaje','inner');
        $this->db->join('vehiculo','viaje.placa=vehiculo.placa','inner');
        $this->db->join('tipo_vehiculo','vehiculo.id_tipo_vehiculo=tipo_vehiculo.id','inner');
        $this->db->join('ruta','ruta.id_ruta=viaje.id_ruta','inner');
        $this->db->join('usuarios','vehiculo.id_usuario=usuarios.id_usuario','inner');
        $q = $this->db->get('reserva');
        //echo $this->db->last_query();
        //die;
        return $q;
    }
    function actualizar_estado($datos, $id) {
        $this->db->where('id_reserva', $id);
        $query = $this->db->update('reserva', $datos);
        //echo $this->db->last_query();  
        //die;
        //log_message('debug', $this->db->last_query());
        return $query;
    }
    function traer_usuarios() {
        $this->db->select('usuarios.id_usuario as cedula,usuarios.email as correo, usuarios.nombres as nombre,usuarios.tipo_usuario');
        $this->db->join('users','usuarios.id_usuario=users.username','left');
        $this->db->where('users.username',NULL,FALSE);
        $q = $this->db->get('usuarios');
         //echo $this->db->last_query();
         //die;
        return $q->result();
    }
    
}
