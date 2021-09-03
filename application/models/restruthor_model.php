<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class restruthor_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_resruthor($id) {
        $fecha= date('Y') . '-' . date('m') . '-' . date('d');
        /*$this->db->query('viaje.id_viaje,viaje.placa,vehiculo.capacidad-count(reserva.id_reserva) disponibles,viaje.horario,ruta.descripcion,ruta.mapa');
        $this->db->where('viaje.id_estado_viaje', 1);
        $this->db->where('ruta.id_ruta', $id);
        $this->db->where('date(viaje.horario)', $fecha);
        $this->db->where('reserva.id_estado_reserva', '1');
        $this->db->join('(SELECT reserva.id_viaje,count(reserva.id_viaje) total'
                        .'FROM reserva, viaje'
                . "where viaje.id_viaje=reserva.id_viaje and  reserva.id_estado_reserva='1'"
                . "and viaje.id_estado_viaje='1'"
                . "group by reserva.id_viaje)','viaje.id_viaje=reserva.id_viaje','left'");
        $this->db->join('vehiculo','viaje.placa=vehiculo.placa','inner');
        $this->db->join('ruta','viaje.id_ruta=ruta.id_ruta','inner');
        $this->db->group_by('reserva.id_viaje,viaje.placa,viaje.horario,ruta.descripcion,ruta.mapa');*/
        $Q="SELECT `viaje`.`id_viaje`, `viaje`.`placa`, vehiculo.capacidad-IFNULL(A.total,0) disponibles, "
                . "`viaje`.`horario`, `ruta`.`descripcion`, `ruta`.`mapa` "
                . " FROM `viaje` LEFT JOIN "
                . " (SELECT reserva.id_viaje,count(reserva.id_viaje) total"
                . " FROM reserva, viaje"
                . " where viaje.id_viaje=reserva.id_viaje and  reserva.id_estado_reserva='1'"
                . " and viaje.id_estado_viaje='1'"
                . " group by reserva.id_viaje) A ON A.id_viaje=viaje.id_viaje"
                . " INNER JOIN `vehiculo` ON `viaje`.`placa`=`vehiculo`.`placa` "
                . " INNER JOIN `ruta` ON `viaje`.`id_ruta`=`ruta`.`id_ruta` "
                . " WHERE `viaje`.`id_estado_viaje` = 1 "
                . " AND `ruta`.`id_ruta` = '$id'"
                . " AND date(viaje.horario) = '$fecha'"
                . " AND (vehiculo.capacidad-IFNULL(A.total,0))>0"
                . " GROUP BY `viaje`.`placa`, `viaje`.`horario`, `ruta`.`descripcion`, `ruta`.`mapa`";
        $result = $this->db->query($Q);
        //echo $this->db->last_query();
        //die;
        return $result;
    }
    function get_reserva($id) {
        $fecha= date('Y') . '-' . date('m') . '-' . date('d');
        $this->db->select('id_usuario');
        $this->db->where('reserva.id_usuario', $id);
        $this->db->where('date(viaje.horario)', $fecha);
        $this->db->where('viaje.id_estado_viaje', '1');
        $this->db->where('reserva.id_estado_reserva', '1');
        $this->db->join('viaje','reserva.id_viaje=viaje.id_viaje','inner');
        $query = $this->db->get('reserva');   
        //echo $this->db->last_query();
        //die;
        return $query;
    }
    function get_rutas() {
        $this->db->select('ruta.id_ruta,ruta.descripcion');
        $this->db->join('viaje','ruta.id_ruta=viaje.id_ruta','inner');
        $query = $this->db->get('ruta');
        $result = $query->result();
        $data = array();
        $data[''] = "-- Seleccione un valor --";
        foreach ($result as $value) {
            $data[$value->id_ruta] = $value->descripcion;
        }
        return $data;
    }
    function insertar_reserva($data) {
        $result = $this->db->insert('reserva', $data);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    
    
}
