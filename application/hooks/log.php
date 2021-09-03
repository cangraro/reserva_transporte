<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Log {

    private $ci;

    public function __construct() {
        $this->ci = & get_instance();
        !$this->ci->load->library('session') ? $this->ci->load->library('session') : false;
        $this->ci->load->library('ion_auth');

        //!$this->ci->load->library('database') ? $this->ci->load->library('database') : false;
        !$this->ci->load->helper('url') ? $this->ci->load->helper('url') : false;
    }

    public function check_login() {
        $parameters = "";
        $valor = "";
        // log_message('debug', 'action: '. $_SERVER['REQUEST_URI']); 
        //print_r($_POST);
        foreach ($_POST as $key => $value) {
            // log_message('debug', 'parameter: '. $key.' valor:'.$value);  

            if (is_array($value)) {
                foreach ($value as $k => $v) {
                    $valor.= $k . '/' . $v;
                }
                $parameters .= '/' . $key . ',' . $valor;
            } else {
                $parameters .= '/' . $key . ',' . $value;
            }
        }

        $user = $this->ci->ion_auth->user()->row();
        
        if ($this->ci->ion_auth->logged_in()) {
       

            //$data['user'] = $user->nombre; //$user->first_name.' '.$user->last_name;
            $data['login'] = $user->username;
            //$data['parametros'] = $parameters;
            $data['fecha'] = $user = date("Y-m-d H:i:s");
            $data['url'] = $user = $_SERVER['REQUEST_URI'];
            $data['ip'] = $this->getRealIP();
            $data['user_agent'] =$_SERVER["HTTP_USER_AGENT"];
            //$query = $this->ci->db->insert('jos_cmi_portafolios_log', $data);
        }
    }

    function getRealIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];

        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];

        return $_SERVER['REMOTE_ADDR'];
    }

}

/*
/end hooks/home.php
*/