<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class regvehiculo extends CI_Controller {

    function __construct() {
//grupo 65 gestion vm
        parent::__construct();


        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model('regvehiculo_model');

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
        $data['template'] = 'regvehiculo/index';
        $data["conductores"] = $this->regvehiculo_model->get_conductores();
        $this->load->view('template/template', $data, false, true);
    }
    function insertar_vehiculo() {
        $data['template'] = 'regvehiculo/modal_mensaje';
        $datos['placa'] = $this->input->post('placa');
        $datos['marca'] = $this->input->post('marca');
        $datos['modelo'] = $this->input->post('modelo');
        $datos['capacidad'] = $this->input->post('email');
        $datos['id_usuario'] = $this->input->post('conductor');
        $datos['capacidad'] = $this->input->post('capacidad');
        $datos['estado'] = '1';
        $datos['id_tipo_vehiculo'] = $this->input->post('tipo');
        $val=$this->regvehiculo_model->get_placa($datos['placa']);
        if($val->num_rows() > 0) {
            $data['template'] = 'regconductor/modal_mensaje';
            $data['mensaje'] = 'Ya existe el vehiculo ingresado';
            $this->load->view('template/template', $data, false, true); 
        }else{
            if ($this->regvehiculo_model->insertar_vehiculo($datos)) {
                $data['mensaje'] = "Se ingreso el vehiculo correctamente";
            } else {
                $data['mensaje'] = "Hubo un error al ingresar el vehiculo.";
            }
            $this->load->view('template/template', $data, false, true);
            //PRINT_R($data['mensaje']);
            //echo json_encode($data);
        }
    }

}

?>
