<?php

/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 * Description of Visitas_model
 *
 * @author Carlos Eduardo Jaramillo Londoño
 */
class Noticias_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    //traer las ultimas 2 noticias.
    function obtener_ultimas_noticias() {
        $this->db->order_by('fecha_publicacion','desc');
        $q = $this->db->get_where('jos_noticias', array('publicado' => 1), 2);
        return $q->result();
    }

    //insertar nueva noticia
    function insertar_noticia($datos) {
        $q = $this->db->insert('jos_noticias', $datos);
       //   log_message('debug',$this->db->last_query());
        
        return $q;
    }

    //editar noticia
    function actualizar_noticia($id, $datos) {
        $this->db->where('id', $id);
        $q = $this->db->update('jos_noticias', $datos);
      //        log_message('debug',$this->db->last_query());
        return $q;
    }

    function obtener_noticia($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $q = $this->db->get('jos_noticias');
        if ($q->num_rows() == 0) {
            return false;
        } else {
            return $q->row();
        }
    }
    function obtener_noticias(){
        $this->db->order_by('fecha_creacion','asc');
        $q = $this->db->get_where('jos_noticias');
          return $q->result();
    }

}

?>
