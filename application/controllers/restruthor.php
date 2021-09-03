<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class restruthor extends CI_Controller {

    function __construct() {
//grupo 65 gestion vm
        parent::__construct();


        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model('restruthor_model');

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
        $data['template'] = 'restruthor/index';
        $id = $this->ion_auth->user()->row()->username;
        $reserva = $this->restruthor_model->get_reserva($id);
        if ($reserva->num_rows() > 0) {
            $data['template'] = 'misviajes/modal_mensaje';
            $data['mensaje'] = 'El usuario ya tiene una reserva activa';
            $this->load->view('template/template', $data, false, true);            
            
        } else {
            $data['rutas'] = $this->restruthor_model->get_rutas();
            $this->load->view('template/template', $data, false, true);            
        }
    }

    function mostrar_ruta() {
        $id = $this->input->post('ruta');

        $data['restruthor'] = $this->restruthor_model->get_resruthor($id);
        if ($data['restruthor']->num_rows() > 0) {
            $data['restruthor'] = $data['restruthor']->result();
            $data['restruthor'] = $this->load->view('restruthor/mostrar_ruta', $data, true);
            echo json_encode($data);
        } else {
            $data['mensaje'] = 'No hay viajes disponibles en la ruta seleccionada';
            $data['mensaje'] = $this->load->view('restruthor/modal_mensaje', $data, true);
            echo json_encode($data);
        }
        //print_r($data);
        //die();
    }

    //desplegar la vista
    function reservar() {
        $datos['id_usuario'] = $this->ion_auth->user()->row()->username;
        $datos['id_viaje'] = $this->input->post('viaje');
        $datos['id_estado_reserva'] = '1';
        //print_r($datos);
        if ($this->restruthor_model->insertar_reserva($datos)) {
            $data['mensaje'] = "Se realizo la reserva correctamente";
            $data['mensaje'] = $this->load->view('restruthor/modal_mensaje', $data, true);
        } else {
            $data['mensaje'] = "Hubo un error al ingresar la reserva.";
            $data['mensaje'] = $this->load->view('restruthor/modal_mensaje', $data, true);
        }
        //PRINT_R($data['mensaje']);
        echo json_encode($data);
    }

}

?>
