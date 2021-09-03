<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Internet {

    private $ci;

    public function __construct() {
        $this->ci = & get_instance();
//        !$this->ci->load->library('session') ? $this->ci->load->library('session') : false;
//        $this->ci->load->library('ion_auth');

        //!$this->ci->load->library('database') ? $this->ci->load->library('database') : false;
//        !$this->ci->load->helper('url') ? $this->ci->load->helper('url') : false;
    }

    function iever($compare = false, $to = NULL) {
        if (!preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $m) || preg_match('#Opera#', $_SERVER['HTTP_USER_AGENT']))
            return false === $compare ? false : NULL;

        if (false !== $compare && in_array($compare, array('<', '>', '<=', '>=', '==', '!=')) && in_array((int) $to, array(5, 6, 7, 8, 9, 10))) {
            return eval('return (' . $m[1] . $compare . $to . ');');
        } else {
            return (int) $m[1];
        }
    }

    public function check_browser() {
         $CI = & get_instance();
                $method = $CI->router->method;
        if ($this->iever('<=', 9)) {
           // echo 'This browser is Internet Explorer 9 or below.';
           
                // echo $method;
                if ($method != 'browser') {
                    redirect("menu/browser");
                }
            
            
          
            // redirect('', 'Tu navegador no esta soportado "Actualmente usas Internet Explorer 8 o inferior"', $msgType = 'error');
        } else {
             if ($method == 'browser') {
                    redirect();
                }
        }
    }

    public function check_clave() {
        $user = $this->ci->ion_auth->user()->row();
        //print_r($user);
        if ($this->ci->ion_auth->logged_in()) {
            $intervalo = date_diff(date_create($user->ultimo_cambio_clave), date_create(date("Y-m-d H:i:s")));
            // echo $intervalo->format('%R%a');
            if (($intervalo->format('%R%a') > 30) || is_null($user->ultimo_cambio_clave)) {
                // echo $user->ultimo_cambio_clave-date("Y-m-d H:i:s");
                //  echo 'hora de cambiar la clave';
                $CI = & get_instance();
                $method = $CI->router->method;
                // echo $method;
                if ($method != 'cambiar_clave') {
                    redirect("menu/cambiar_clave");
                }
            }
        }
    }

}

/*
/end hooks/home.php
*/