<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class misviajes extends CI_Controller {

    function __construct() {
//grupo 65 gestion vm
        parent::__construct();


        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model('misviajes_model');

        //print_r($user);
        if ($this->ion_auth->logged_in() && ($this->ion_auth->in_group(2) ||
                $this->ion_auth->in_group(3) || $this->ion_auth->is_admin())) {
            // $this->login();
        } else {
            $this->session->set_flashdata('error', 'No tienes permiso para usar este componente');
            redirect();
        }
    }

    function index() {
        $data['template'] = 'misviajes/index';        
        $data['misviajes'] = $this->misviajes_model->get_viajes($this->ion_auth->user()->row()->username);
       
        if($data['misviajes']!=null){
            $this->load->view('template/template', $data, false, true);
        }else{
            $data['template'] = 'misviajes/modal_mensaje';
            $data['mensaje']='No tiene viajes asignados';
            $this->load->view('template/template', $data, false, true);
        }
        
    }
        
    function mostrar_mapa() {
        $id = $this->input->post('ruta');
        
        $data['mapa'] = $this->misviajes_model->get_mapa($id);
        if ($data['mapa']!='') {         
            //print_r($data);
            $data['mapa']=$this->load->view('misviajes/mostrar_mapa', $data, true);
            echo json_encode($data);
        }
        else{
            $data['mensaje'] = 'No hay mapa para desplegar';
            $data['mensaje']=$this->load->view('misviajes/modal_mensaje', $data, true);
            echo json_encode($data);
        }
        
    }
    function actualizar_estado(){        
        $datos['id_estado_viaje'] = $this->input->post('estado');
        $id = $this->input->post('viaje');
        $datos1['id_estado_reserva']=$this->input->post('estado_r');
        //print_r($datos);
        if ($this->misviajes_model->actualizar_estado($datos, $id)) {            
            $this->misviajes_model->actualizar_estado_reserv($datos1, $id);
            $data['mensaje'] = "Se ha actualizado correctamente el estado!";
            $data['full']=$this->load->view('misviajes/index', $data, true);
            $data['mensaje']=$this->load->view('misviajes/modal_mensaje', $data, true);
            
            echo json_encode($data);
            
        } else {
            $data['mensaje'] = "Ha ocurrido un error al actualizar los datos";
            $data['full']=$this->load->view('misviajes/full', $data, true);
            $data['mensaje']=$this->load->view('misviajes/modal_mensaje', $data, true);            
            echo json_encode($data);
        }
    }

}

?>
