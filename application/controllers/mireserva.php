<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class mireserva extends CI_Controller {

    function __construct() {
//grupo 65 gestion vm
        parent::__construct();


        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model('mireserva_model');

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
        $data['template'] = 'mireserva/index';
        $datos = $this->mireserva_model->get_reserva($this->ion_auth->user()->row()->username);
        if ($datos->num_rows() > 0) {
            $data['mireserva'] = $datos->row();
            $this->load->view('template/template', $data, false, true);          
        }else{
            $data['template'] = 'misviajes/modal_mensaje';
            $data['mensaje']='No tiene reservas';
            $this->load->view('template/template', $data, false, true);
        }
        
    }
    
    function declinar_reser(){        
        $datos['id_estado_reserva'] = $this->input->post('estado');        
        $id = $this->input->post('reserva');       
        //print_r($datos);
        if ($this->mireserva_model->actualizar_estado($datos, $id)) {            
            $data['mensaje'] = "Se ha cancelado la reserva correctamente!";
            $data['full']=$this->load->view('mireserva/index', $data, true);
            $data['mensaje']=$this->load->view('mireserva/modal_mensaje', $data, true);
            
            echo json_encode($data);
            
        } else {
            $data['mensaje'] = "Ha ocurrido un error al actualizar los datos";
            $data['full']=$this->load->view('mireserva/full', $data, true);
            $data['mensaje']=$this->load->view('mireserva/modal_mensaje', $data, true);            
            echo json_encode($data);
        }
    }

    //desplegar la vista
}

?>
