<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clave {

    private $ci;

    public function __construct() {
        $this->ci = & get_instance();
        !$this->ci->load->library('session') ? $this->ci->load->library('session') : false;
        $this->ci->load->library('ion_auth');

        //!$this->ci->load->library('database') ? $this->ci->load->library('database') : false;
        !$this->ci->load->helper('url') ? $this->ci->load->helper('url') : false;
    }

    public function check_clave() {
        $user = $this->ci->ion_auth->user()->row();
        //print_r($user);
       /* if ($this->ci->ion_auth->logged_in()) {
            $intervalo = date_diff(date_create($user->ultimo_cambio_clave), date_create(date("Y-m-d H:i:s")));
          // echo $intervalo->format('%R%a');
            if (($intervalo->format('%R%a') > 30) || is_null($user->ultimo_cambio_clave)){
                // echo $user->ultimo_cambio_clave-date("Y-m-d H:i:s");

              //  echo 'hora de cambiar la clave';
                $CI = & get_instance();
                $method = $CI->router->method;
               // echo $method;
                if($method!='cambiar_clave'&&$method!='logout'){
                    redirect("menu/cambiar_clave");
                }
                
            }
            
        }*/
    }

}

/*
/end hooks/home.php
*/