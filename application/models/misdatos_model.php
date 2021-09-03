<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class misdatos_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_datos_e($id) {
        
        $this->db->select('usuarios.id_usuario,usuarios.nombres,usuarios.telefono, usuarios.celular,usuarios.email,usuarios.tipo_usuario');
        $this->db->where('users.active', 1);
        $this->db->where('usuarios.id_usuario', $id);        
        $this->db->join('users','usuarios.id_usuario=users.username','inner');
        $q = $this->db->get('usuarios');
        //echo $this->db->last_query();
        //die;
        return $q;
    }
    function get_datos_c($id) {
        
        $this->db->select('usuarios.id_usuario,usuarios.nombres,vehiculo.placa,tipo_vehiculo.desc_tipo,usuarios.telefono, usuarios.celular,usuarios.email,usuarios.tipo_usuario');
        $this->db->where('users.active', 1);
        $this->db->where('usuarios.id_usuario', $id);        
        $this->db->join('vehiculo','usuarios.id_usuario=vehiculo.id_usuario','inner');
        $this->db->join('tipo_vehiculo','vehiculo.id_tipo_vehiculo=tipo_vehiculo.id','inner');
        $this->db->join('users','usuarios.id_usuario=users.username','inner');
        $q = $this->db->get('usuarios');
        //echo $this->db->last_query();
        //die;
        return $q;
    }

    function actualizar_datos_usuarios($datos, $id) {
        $this->db->where('id_usuario', $id);
        $query = $this->db->update('usuarios', $datos);
        //echo $this->db->last_query();  
        //die;
        //log_message('debug', $this->db->last_query());
        return $query;
    }
    function actualizar_datos_users($datos, $id) {
        $this->db->where('username', $id);
        $query = $this->db->update('users', $datos);
        //echo $this->db->last_query();        
        //log_message('debug', $this->db->last_query());
        //die;
        return $query;
    }
    
    
}
