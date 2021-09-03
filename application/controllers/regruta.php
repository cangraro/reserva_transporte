<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class regruta extends CI_Controller {

    function __construct() {
//grupo 65 gestion vm
        parent::__construct();


        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model('regruta_model');

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
        $data['template'] = 'regruta/index';
        $this->load->view('template/template', $data, false, true);
    }

    function insertar_ruta() {
        $data['template'] = 'regruta/modal_mensaje';
        $datos['descripcion'] = $this->input->post('desruta');
        $datos['id_lugar_inicio'] = $this->input->post('tipo1');
        $datos['id_lugar_fin'] = $this->input->post('tipo2');
        $datos['mapa'] = $this->input->post('mapa');
        $ruta = $this->regruta_model->get_rut_ex($datos);
        if($ruta->num_rows() > 0) {
            $data['template'] = 'regruta/modal_mensaje';
            $data['mensaje'] = 'El recorrido ingresado ya existe';
            $this->load->view('template/template', $data, false, true); 
        } else {
            if ($this->regruta_model->insertar_ruta($datos)) {
                $data['mensaje'] = "Se ingreso la ruta correctamente";
            } else {
                $data['mensaje'] = "Hubo un error al ingresar la ruta.";
            }
            $this->load->view('template/template', $data, false, true);
            //PRINT_R($data['mensaje']);
            //echo json_encode($data);
        }
    }

}

?>
