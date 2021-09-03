<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class misdatos extends CI_Controller {

    function __construct() {
//grupo 65 gestion vm
        parent::__construct();


        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model('misdatos_model');

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
        $data['template'] = 'misdatos/index';
        if ($this->ion_auth->in_group(3)) {
            $datos = $this->misdatos_model->get_datos_c($this->ion_auth->user()->row()->username);
        } else {
            $datos = $this->misdatos_model->get_datos_e($this->ion_auth->user()->row()->username);
        }
        if ($datos->num_rows() > 0) {
            $data['datos'] = $datos->row();
            //$data['datos']=$this->load->view('misdatos/index', $datos['datos'], true);            
        }
        $this->load->view('template/template', $data, false, true);
    }

    //desplegar la vista
    function actualizar_datos() {
        $data['template'] = 'misdatos/modal_mensaje';
        $id = $this->ion_auth->user()->row()->username;
        $datos['celular'] = $this->input->post('celular');
        $datos['email'] = $this->input->post('mail');       
        //print_r($datos);
        if ($this->misdatos_model->actualizar_datos_usuarios($datos, $id)) {
            unset($datos['celular']);
            $this->misdatos_model->actualizar_datos_users($datos, $id);
            $data['mensaje'] = "Se han actualizado correctamente los datos!";
        } else {
            $data['mensaje'] = "Se han actualizado correctamente los datos!";
        }
        $this->load->view('template/template', $data, false, true);
    }

}

?>
