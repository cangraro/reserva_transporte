<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class regconductor extends CI_Controller {

    function __construct() {
//grupo 65 gestion vm
        parent::__construct();


        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model('regconductor_model');

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
        $data['template'] = 'regconductor/index';
        $this->load->view('template/template', $data, false, true);
    }

    //desplegar la vista
    function insertar_usuarios() {
        $data['template'] = 'regconductor/modal_mensaje';
        $datos['id_usuario'] = $this->input->post('cedula');
        $datos['nombres'] = $this->input->post('nombre');
        $datos['fecha'] = $this->input->post('fecha_nacimiento');
        $datos['email'] = $this->input->post('email');
        $datos['telefono'] = $this->input->post('telefono');
        $datos['celular'] = $this->input->post('celular');
        $datos['tipo_usuario'] = $this->input->post('tipo');
        $val=$this->regconductor_model->get_usuario($datos['id_usuario']);
        if($val->num_rows() > 0) {
            $data['template'] = 'regconductor/modal_mensaje';
            $data['mensaje'] = 'El usuario ya existe en la tabla usuarios';
            $this->load->view('template/template', $data, false, true); 
        }else{
            if ($this->regconductor_model->insertar_usuario($datos)) {
                $data['mensaje'] = "Se ingreso el usuario correctamente";
            } else {
                $data['mensaje'] = "Hubo un error al ingresar el usuario.";
            }
            $this->load->view('template/template', $data, false, true);
            //PRINT_R($data['mensaje']);
            //echo json_encode($data);
        }
    }

}

?>
