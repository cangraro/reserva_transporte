<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class regviaje extends CI_Controller {

    function __construct() {
//grupo 65 gestion vm
        parent::__construct();


        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model('regviaje_model');

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
        $data['template'] = 'regviaje/index';
        $data["placa"] = $this->regviaje_model->get_vehiculos();
        $data["ruta"] = $this->regviaje_model->get_rutas();
        $this->load->view('template/template', $data, false, true);
    }
    function insertar_viaje() {
        $data['template'] = 'regviaje/modal_mensaje';
        $datos['placa'] = $this->input->post('placa');
        $datos['id_ruta'] = $this->input->post('ruta');
        $datos['horario'] = $this->input->post('fecha'); 
        $datos['id_estado_viaje'] = 1;       
        $val=$this->regviaje_model->get_viaje($datos);
        if($val->num_rows() > 0) {
            $data['template'] = 'regconductor/modal_mensaje';
            $data['mensaje'] = 'El vehiculo tiene una ruta asignada en ese horario';
            $this->load->view('template/template', $data, false, true); 
        }else{
            if ($this->regviaje_model->insertar_viaje($datos)) {
                $data['mensaje'] = "Se ingreso el viaje correctamente";
            } else {
                $data['mensaje'] = "Hubo un error al ingresar el viaje.";
            }
            $this->load->view('template/template', $data, false, true);
            //PRINT_R($data['mensaje']);
            //echo json_encode($data);
        }
    }
    
}

?>
