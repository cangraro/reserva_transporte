<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('captcha');
    }

    public function createWord() {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $word = '';
        for ($a = 0; $a <= 5; $a++) {
            $b = rand(0, strlen($chars) - 1);
            $word .= $chars[$b];
        }

        return $word;
    }

    public function index() {
        //  $this->ion_auth->register('administrator', '1234', 'admin@admin.com', array( 'first_name' => 'administrador', 'last_name' => 'epymes' ), array('1') );
        //   print_r($this->ion_auth->user()->row());
        
            
        if (!$this->ion_auth->logged_in()) {
            
            // $this->login();
            // $this->session->set_flashdata('error', 'Debes identificarte para usar este componente');
            
            $this->load->view('template/login');
            
        } else {
            //lo redireccionamos al menu ppal
            
            $this->menu_ppal();
            
        }
    }

    public function login() {

        $this->form_validation->set_rules('usuario', 'usuario', 'required');
        $this->form_validation->set_rules('clave', 'clave', 'required');
        $datos['usuario'] = $this->input->post('usuario');
        $datos['clave'] = $this->input->post('clave');

        
        if ($this->ion_auth->is_max_login_attempts_exceeded($datos['usuario'])) {

            $this->session->set_flashdata('message', 'has intentado muchas veces, olvidaste tu clave?');

            redirect('menu/index', 'refresh');
            // print_r($datos);
            return;
        }


        if ($this->ion_auth->login($datos['usuario'], $datos['clave'])) {
            $this->ion_auth->clear_login_attempts($datos['usuario']);
            $messages = $this->ion_auth->messages();

            if ($this->ion_auth->logged_in()) {
                log_message('debug', 'sigue logueado');
            }
            // $this->session->set_flashdata('message', $this->ion_auth->messages());
            // redirect('menu/index');
            redirect('menu/index', 'refresh');
            return;
        } else {
            $messages = $this->ion_auth->messages();

            $this->session->set_flashdata('message', 'Clave o Usuario Incorrecto');
            // $this->session->set_flashdata('error', $this->ion_auth->messages());


            redirect('menu/index', 'refresh');
            return;
            // redirect('/menu'); //use redirects instead of loading views for compatibility with MY_Controller libraries
        }
    }

    public function logout() {
        //log the user out
        $logout = $this->ion_auth->logout();

        //redirect them to the login page
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect('/', 'refresh');
    }

    public function cambiar_clave() {
        $this->form_validation->set_rules('clave_ant', 'Clave Anterior', 'required');
        //le quite lo de caracteres alfa numericos
        $this->form_validation->set_rules('clave', 'clave', 'required|min_length[8]|matches[repetir_clave]|trim|xss_clean');
        $this->form_validation->set_rules('repetir_clave', 'repetir clave', 'required|min_length[8]|trim|xss_clean|matches[clave]');
        //$this->data['nombre'] = mb_convert_case($this->estructura_model->get_nombre($this->ion_auth->user()->row()->username)->NOMBRE_COMPLETO, MB_CASE_TITLE, "UTF-8");


        if ($this->form_validation->run() == false) {

            $this->data['template'] = 'user/cambiar_clave';
            //$this->session->set_flashdata('message', validation_errors());
            $this->load->view('template/template', $this->data);
            return;
        } else {
            $clave_ant = $this->input->post('clave_ant');
            $clave = $this->input->post('clave');
            $identity = $this->session->userdata('identity');
//            print_r($this->session);
//            die;
            // echo $identity;
            $change = $this->ion_auth->change_password($identity, $clave_ant, $clave);

            if ($change) {
                //actualizar la fecha de cambio sin modificar el model de la libreria.
                $datos = array('ultimo_cambio_clave' => date("Y-m-d H:i:s"));
                $this->ion_auth->update($this->session->userdata('user_id'), $datos);
                $this->ion_auth->clear_login_attempts($identity);
                //if the password was successfully changed
                $this->session->set_flashdata('message', 'Clave Actualizada Correctamente!');
                redirect('', 'refresh');
                return;
            } else {
                $this->data['error']= 'La clave anterior no es correcta!';
              //  $this->session->set_flashdata('message', 'La clave anterior no es correcta!');
                $this->data['template'] = 'user/cambiar_clave';
                $this->load->view('template/template', $this->data);
                return;
            }
        }
    }

    public function recuperar_clave() {
        $this->form_validation->set_rules('usuario', "Usuario", 'required');
        $this->form_validation->set_rules('captcha', "Captcha", 'required|validate_captcha');
        /* Get the user's entered captcha value from the form */
        // $userCaptcha = $this->input->post('captcha');
        //echo $userCaptcha;

        /* Get the actual captcha value that we stored in the session (see below) */
        //  $word = $this->session->userdata('captchaWord');
        // echo '---' . $word;

        if ($this->form_validation->run() == TRUE) {
//            $this->mycaptcha->deleteImage();
            $login = $this->input->post('usuario');
            $longitud = 8;
            $new_pass = substr(MD5(rand(5, 100)), 0, $longitud);
            $identity = $this->ion_auth->where('username', $login)->users()->row();
            $datos = array(
                'ultimo_cambio_clave' => 'NULL',
                'password' => $new_pass
            );
            if ($this->ion_auth->update($identity->id, $datos)) {
                $this->session->unset_userdata('captchaWord');
                $this->session->set_flashdata('message', $this->enviar_clave($identity->email, $new_pass));
               // $this->session->set_flashdata('message', $new_pass);
                $this->ion_auth->clear_login_attempts($login);
                redirect('menu/index');
            }
        } else {
//            $data['captcha'] = $this->mycaptcha
//                    ->deleteImage() //these are the 3 methods 
//                    ->createWord()
//                    ->createCaptcha();


            $this->session->set_flashdata('error', 'Por favor verifica los datos');
            $vals = array(
                'word' => $this->createWord(),
//            'font_path' => 'assets/fonts/Monoglyceride.ttf',
                'img_path' => 'captcha/',
                'img_url' => base_url() . 'captcha/',
                'img_width' => '200',
                'img_height' => 50
            );

            /* Generate the captcha */
            $captcha = create_captcha($vals);
            $this->session->set_userdata('captchaWord', $captcha['word']);
            
            $this->load->view('template/recuperar_clave', $captcha);
        }
    }

    public function enviar_clave($email, $new_pass) {
        // $html = $this->back_resumen_venta_pdf($id);
        $this->load->library('email');

        $this->email->from('cagr215@gmail.com', 'Cambio Clave reserva');
        // $this->email->to('granmorgan@gmail.com');
        $this->email->to($email);
//$this->email->cc('another@another-example.com');
        //$this->email->bcc('d-0827A@une.com.co');
        $this->email->subject("Cambio de clave reserva. No responder.");
        $this->email->message("<h1>Su nueva clave para acceder al portal es: $new_pass</h1><h1>Una vez ingreses al portal se te pedira cambio de clave, la clave anterior que te solicita es la que acabas de generar!!.</h1>");
        // $this->email->attach($pdf);

        if (!$this->email->send()) {
            $data['mensaje'] = $this->email->print_debugger();
        } else {
            $data['mensaje'] = "Su nueva clave se a enviado a su correo personal";
        }

        // echo $this->email->print_debugger();


        return $data['mensaje'];
    }

    public function menu_ppal() {
        
        // echo $this->ion_auth->user()->row()->username;
        if ($this->ion_auth->logged_in()) {
            log_message('debug', 'sigue logueado');
            //  echo 'esta logueado';
            $this->load->model('noticias_model');
            $this->data['noticias']=$this->noticias_model->obtener_ultimas_noticias();
            $this->data['mensaje'] = 'Bienvenido al nuevo portal de gestion de ventas, en la parte superior encontraras el acceso a los componentes para ingreso, consulta y gestion segun sea su perfil, si esta accediendo a travez de un smartphone el menu esta en la parte superior derecha. En la parte inferior estan los accesos directos a las herramientas mas usadas.';
            $this->data['template'] = 'dashboard/dashboard';
            $this->data['nombre'] = mb_convert_case("CARLOS", MB_CASE_TITLE, "UTF-8");
            $this->load->view('template/template', $this->data);
        }
        // print_r($this->ion_auth->user()->row());
    }

    //si el browser es ie9 o inferior

    public function browser() {
        $this->load->view('template/browser');
    }

}
