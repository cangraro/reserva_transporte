<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Noticias extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        //$this->load->library('captcha');
        $this->load->helper('url');
        $this->load->model('noticias_model');
          if ($this->ion_auth->logged_in() && ($this->ion_auth->is_admin())) {
           // $this->login();
        } else {
              $this->session->set_flashdata('error', 'No tienes permiso para usar este componente');
            redirect();
        }
    }

    public $data;

    public function index() {
        $this->data['noticias'] = $this->noticias_model->obtener_noticias();
        $this->data['template'] = 'noticias/index';        
        $this->load->view('template/template', $this->data);
    }

    public function ultimas_noticias() {
        $this->data['noticias'] = $this->noticias_model->obtener_ultimas_noticias();
        $this->load->view('noticas/ultimas_noticias', $this->data);
    }

    public function crear() {


        $this->form_validation->set_rules('usuario', 'usuario', 'required|xss_clean');

        if ($this->form_validation->run() == false) {

            $this->data['template'] = 'noticias/crear';
            $this->load->view('template/template', $this->data);
        } else {
            $datos['autor'] = $this->ion_auth->user()->row()->username;
            $datos['autor_modifica'] = $this->ion_auth->user()->row()->username;
            $datos['titulo'] = $this->input->post('titulo');
          //  $datos['contenido'] = $this->input->post('contenido',false);
            $datos['contenido'] =$_REQUEST['contenido'];
            $datos['fecha_creacion'] = date("Y-m-d H:i:s");
            $datos['fecha_modificacion'] = date("Y-m-d H:i:s");
            // $datos['publicado'] = $this->input->post('publicado');
            // echo $datos['publicado'];
        //    log_message('debug', 'publicado: ' . $datos['publicado']);
            if ($this->input->post('publicado') == '1') {
                $datos['publicado'] = 1;
                $datos['fecha_publicacion'] = date("Y-m-d H:i:s");
            }
        //    print_r($datos);
            
            
            if ($this->noticias_model->insertar_noticia($datos)) {
                echo 'correcto';
                return;
//                $this->index();
            } else {
                echo 'error';
                return;
            }
        }
    }

    //en construccion
    public function editar($id=false) {
        //  $id= $this->input->post('id_noticia');
if($id==false){
    $id = $this->input->post('id');
}
        
        $this->form_validation->set_rules('usuario', 'usuario', 'required|xss_clean');

        if ($this->form_validation->run() == false) {
            $this->data['noticia'] = $this->noticias_model->obtener_noticia($id);
            $this->data['template'] = 'noticias/editar';            
            $this->load->view('template/template', $this->data);
        } else {

            $datos['autor_modifica'] = $this->ion_auth->user()->row()->username;
            $datos['titulo'] = $this->input->post('titulo');
            $datos['contenido'] =$_REQUEST['contenido'];
            $datos['fecha_modificacion'] = date("Y-m-d H:i:s");
          
            if ($this->input->post('publicado') == '1') {
                $datos['publicado'] = 1;
            //      log_message('debug','fecha publicacion'.$this->input->post('fecha_publicacion'));
                if($this->input->post('fecha_publicacion')==''){
                      $datos['fecha_publicacion'] = date("Y-m-d H:i:s");
                }
            } else {
                $datos['publicado'] = 0;
            }
            if ($this->noticias_model->actualizar_noticia($id, $datos)) {
               echo 'correcto';
                return;
            } else {
                 echo 'error';
                return;
            }
        }
    }

}
