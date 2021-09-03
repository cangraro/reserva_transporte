<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class consultas extends CI_Controller {

    function __construct() {
//grupo 65 gestion vm
        parent::__construct();


        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');        
        $this->load->model('visitas_model');

        //print_r($user);
        if ($this->ion_auth->logged_in() && ($this->ion_auth->in_group(2) ||
                $this->ion_auth->in_group(3) || $this->ion_auth->is_admin())) {
            // $this->login();
        } else {
            $this->session->set_flashdata('error', 'No tienes permiso para usar este componente');
            redirect();
        }
    }

    function validar_estructura() {
        $user = $this->ion_auth->user()->row();
        $cedula = $this->backventas_model->get_estructura($user->id);
        return $cedula;
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

    function index() {
        
    }
    //desplegar la vista
    function factibilidades(){
    
     $data['actualizacion'] = date("Y-m-d H:i:s");
        $data['template'] = 'consultas/consulta_factibilidades';
        $data['nombre'] = mb_convert_case($this->estructura_model->get_nombre($this->ion_auth->user()->row()->username)->NOMBRE_COMPLETO, MB_CASE_TITLE, "UTF-8");
        $this->load->view('template/template', $data);
    }

    function consultar_factibilidad() {
        $this->load->model('backventas_model');
        $valor = $this->input->post('id');
        $datos_factibilidad = $this->backventas_model->buscar_factibilidad_id($valor, "id");
        if ($datos_factibilidad->num_rows() == 0) {
            $datos_factibilidad = $this->backventas_model->buscar_factibilidad_id($valor, "pedido_id");
            if ($datos_factibilidad->num_rows() == 0) {
                $data['mensaje'] = 'No Se Encuentra Factibilidad Con Ese Número';
                $this->load->view('backend_vm/modal_mensaje', $data, false, false);
                return;
            } else {
                $this->load->view('backend_factibilidades/bkn_fact_resumen', $datos_factibilidad->row(), false, false);
            }
            $this->load->view('backend_factibilidades/bkn_fact_resumen', $datos_factibilidad->row(), false, false);
        } else {
            $this->load->view('backend_factibilidades/bkn_fact_resumen', $datos_factibilidad->row(), false, false);
        }
    }

    function visitas() {
        $data['anios'] = $this->visitas_model->anios_visitas();
        //  $codigo_fenix = $this->estructura_model->get_codigo_fenix_jos_user($user->username);
        $data['nombre'] = mb_convert_case($this->estructura_model->get_nombre($this->ion_auth->user()->row()->username)->NOMBRE_COMPLETO, MB_CASE_TITLE, "UTF-8");
        $data['template'] = 'consultas/consulta_visitas';
        $this->load->view('template/template', $data, false);
    }

    function clientes() {

        $data['tipos_documento'] = $this->visitas_model->getTiposDocumento();

        $data['template'] = 'consultas/consulta_clientes';
        $data['nombre'] = mb_convert_case($this->estructura_model->get_nombre($this->ion_auth->user()->row()->username)->NOMBRE_COMPLETO, MB_CASE_TITLE, "UTF-8");
        $this->load->view('template/template', $data);
    }

    function buscar_cliente($documento = null, $tipo = null, $render = true, $return_method = false) {
        $data['scoring'] = false;
        $this->load->model('captura_model');
        $data['tipos_documento'] = $this->visitas_model->getTiposDocumento();

        if ($this->input->post('render') == 'false') {

            $render = false;
        }

        if ($documento == null && $tipo == null) {

            $this->form_validation->set_rules('tipo', 'Tipo de Documento', 'required');
            if ($this->input->post('tipo') == 1) {
                $this->form_validation->set_rules('documento', 'Documento', 'required|min_length[9]|numeric|callback_check_nit');
            } else {
                $this->form_validation->set_rules('documento', 'Documento', 'required|numeric');
            }



            if ($this->form_validation->run() == false) {
                echo validation_errors();
                return;
            } else {
                $documento = $this->input->post('documento');
                $tipo = $this->input->post('tipo');
            }
        }
        $digito = $this->estructura_model->calcular_digito_nit($documento);
        $cliente = $this->captura_model->buscar_empresa($tipo, $documento);
        $data['nombre'] = mb_convert_case($this->estructura_model->get_nombre($this->ion_auth->user()->row()->username)->NOMBRE_COMPLETO, MB_CASE_TITLE, "UTF-8");
        $data['departamentos'] = $this->captura_model->obtener_departamentos();
        $data['cantidad_empleados'] = $this->captura_model->obtener_empleados();
        $data['tipos_entidad'] = $this->captura_model->obtener_entidades();
        $data['sector_economico'] = $this->captura_model->obtener_sectores_economicos();
        $data['nro_pcs'] = $this->captura_model->obtener_nro_pcs();
        $data['nivel_academico'] = $this->captura_model->obtener_nivel_academico_drop();
        $data['actividad_economica'] = array();
        if ($cliente == false) {
            // $data['template'] = 'captura/index';
            $cliente = new stdClass();
            $cliente->numero_documento = $documento;
            $cliente->digito_verificacion = $digito;
            $cliente->id_tipo_documento = $tipo;



            $ciudad[''] = '';
            $data['ciudades'] = $ciudad;
            $data['cliente'] = $cliente;
            if ($render === TRUE) {

                $data['nombre'] = mb_convert_case($this->estructura_model->get_nombre($this->ion_auth->user()->row()->username)->NOMBRE_COMPLETO, MB_CASE_TITLE, "UTF-8");

                $data['template'] = 'captura/nueva_empresa_vm';
                $this->load->view('template/template', $data);
            } else {

                echo $this->load->view('captura/nueva_empresa', $data, true);
            }
        } else {
            $data['scoring'] = $this->captura_model->obtener_scoring($cliente->id);
            $data['mensaje'] = '';
            $id_sector = $this->captura_model->obtener_sector_economico_actividad($cliente->id_actividad_economica);
            $data['actividad_economica'] = $this->captura_model->obtener_actividades_economicas($id_sector);
            $data['id_sector'] = $id_sector;
            if (!isset($cliente->nombre_empresa)) {
                $cliente->nombre_empresa = '';
            }
            //$cliente->fecha_fundacion = date("m/d/Y", strtotime($cliente->fecha_fundacion));

            $data['cliente'] = $cliente;
            $data['tipo_empresa'] = $this->tipo_empresa($cliente->id_tipo_empresa);
            $data['cargos'] = $this->captura_model->obtener_cargos_drop();
            $data['ciudades'] = $this->captura_model->obtener_ciudades($cliente->id_departamento);
            // $data['indicativo'] = $this->captura_model->obtener_indicativo($cliente->id_departamento,$cliente->telefono_fijo);
            $contactos = $this->captura_model->obtener_contactos($cliente->id);


            if ($contactos === false) {
                $data['contactos'] = null;
            } else {
                $data['contactos'] = $contactos;
            }
            if ($render == true) {
                //  echo 'cierto';

                $data['nombre'] = mb_convert_case($this->estructura_model->get_nombre($this->ion_auth->user()->row()->username)->NOMBRE_COMPLETO, MB_CASE_TITLE, "UTF-8");

                $data['template'] = 'captura/editar_empresa_vm';
                $this->load->view('template/template', $data);
            } else {
                if ($return_method == true) {

                    return $this->load->view('consultas/buscar_cliente', $data, true);
                } else {

                    echo $this->load->view('consultas/buscar_cliente', $data, true);
                }
            }
        }
    }

    function cargar_contactos() {
        $this->load->model('captura_model');
        $contactos = $this->captura_model->obtener_contactos($this->input->post('id'));
        if ($contactos === false) {
            $data['contactos'] = null;
        } else {
            $data['contactos'] = $contactos;
        }
        $this->load->view('consultas/contactos_empresa', $data);
    }

    function ver_contacto() {
        $this->load->model('captura_model');
        $id = $this->input->post('contacto_id');
        $contacto = $this->captura_model->obtener_datos_contacto($id);
        $departamento = $this->captura_model->obtener_departamento_ciudad($contacto->id_ciudad);
        $contacto->id_departamento = $departamento->id_departamento;
        $data['cargos'] = $this->captura_model->obtener_cargos_drop();
        $data['departamentos'] = $this->captura_model->obtener_departamentos();
        $data['ciudades'] = $this->captura_model->obtener_ciudades($contacto->id_departamento);
        $data['contacto'] = $contacto;



        $this->load->view('consultas/ver_contacto', $data);
    }

    function tipo_empresa($id_tipo_empresa = false) {
        $this->load->model('captura_model');
        if ($id_tipo_empresa == false) {
            $id_tipo_empresa = $this->input->post('id_tipo_empresa');
            $tipo_empresa = $this->captura_model->obtener_tipo_empresa($id_tipo_empresa);
            echo $tipo_empresa;
        } else {
            $tipo_empresa = $this->captura_model->obtener_tipo_empresa($id_tipo_empresa);
            return $tipo_empresa;
        }
    }

    function acompa() {
        $data['anios'] = $this->visitas_model->anios_visitas();
        //  $codigo_fenix = $this->estructura_model->get_codigo_fenix_jos_user($user->username);
        $data['nombre'] = mb_convert_case($this->estructura_model->get_nombre($this->ion_auth->user()->row()->username)->NOMBRE_COMPLETO, MB_CASE_TITLE, "UTF-8");
        $data['template'] = 'consultas/consulta_acompa';
        $this->load->view('template/template', $data, false);
    }

    function descarga_visita() {
        //$this->load->library('simple_xls');
        $this->load->library('PHPExcel');
        $mes = $this->input->post('mes');
        $anio = $this->input->post('anio');
        $user = $this->ion_auth->user();
        $cedula = $this->visitas_model->get_cedula($user->row()->username);
        $nombre='';

        if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('GESTION_CONSULTA')) {
            //  log_message('debug','es admin....');
            $datos_visitas = $this->visitas_model->obtener_visitas($mes, $anio, null, 1)->result();
        } else {
            //   log_message('debug',$cedula.' la cedula ejecutivo');

            $datos_visitas = $this->visitas_model->obtener_visitas_mes($cedula, $mes, $anio)->result();
        }
        $ruta = BASEPATH . '../tmp/';

        //  log_message('debug', 'ruta de xls' . $ruta);
        //echo $ruta;
        $ruta_anchor = base_url() . 'tmp/';
        // $nombre = 'informe_visitas-' . date('d-m-y_h_i_s_A') . '_' . $cedula . '.xlsx';
        
        if (count($datos_visitas) == 0) {
            $data_return['resultado'] = 0;
        } else {
            $data_return['resultado'] = 1;

            $cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_memcache;
            $cacheSettings = array('memoryCacheSize' => '1024MB');
            PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
            $objPHPExcel = $this->phpexcel->getActiveSheet();
            $this->phpexcel->getProperties()->setCreator("Herramientas de Gestion UNE-Pymes");
//        $this->phpexcel->getProperties()->setLastModifiedBy("e-Pymes");
            $this->phpexcel->getProperties()->setTitle("Informe Visitas");
//        $this->phpexcel->getProperties()->setSubject("Informe generado en " . date('D-m-Y'));
//        $this->phpexcel->getProperties()->setDescription("Consolidado generado para el seguimiento de pedidos une viceprecidencia Pymes");
//
//        $objPHPExcel->getDefaultColumnDimension()->setWidth(20);
//        $objPHPExcel->getDefaultRowDimension()->setRowHeight(15);

            $objPHPExcel->getStyle('A1:T1')->getFill()
                    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('AB162B');

            $objPHPExcel->getStyle('A1:T1')->getFont()->getColor()->setARGB('FFFFFFFF');
            $objPHPExcel->setCellValue('A1', 'CODIGO VISITA');
            $objPHPExcel->setCellValue('B1', 'FECHA VISITA');
            $objPHPExcel->setCellValue('C1', 'FECHA INGRESO_VISITA');
            $objPHPExcel->setCellValue('D1', 'NOMBRE EJECUTIVO');
            $objPHPExcel->setCellValue('E1', 'DOCUMENTO EJECUTIVO');
            $objPHPExcel->setCellValue('F1', 'CARGO');
            $objPHPExcel->setCellValue('G1', 'PLAZA');
            $objPHPExcel->setCellValue('H1', 'NOMBRE CANAL FENIX');
            $objPHPExcel->setCellValue('I1', 'NOMBRE CLIENTE');
            $objPHPExcel->setCellValue('J1', 'DOCUMENTO');
            $objPHPExcel->setCellValue('K1', 'TIPO DOCUMENTO');
            $objPHPExcel->setCellValue('L1', 'NOMBRE CONTACTO');
            $objPHPExcel->setCellValue('M1', 'EMAIL CONTACTO');
            $objPHPExcel->setCellValue('N1', 'TELEFONO CONTACTO');
            $objPHPExcel->setCellValue('O1', 'CELULAR CONTACTO');
            $objPHPExcel->setCellValue('P1', 'OBJETIVO');
            $objPHPExcel->setCellValue('Q1', 'RESULTADO');
            $objPHPExcel->setCellValue('R1', 'LIDER_CATEGORIA');
            $objPHPExcel->setCellValue('S1', 'LIDER_PLAZA');
            $objPHPExcel->setCellValue('T1', 'LIDER_REGIONAL');
            $objPHPExcel->setCellValue('U1', 'TIPO PORTAFOLIO');
            $objPHPExcel->setCellValue('V1', 'VALOR');
            $objPHPExcel->setCellValue('W1', 'PROBABILIDAD');




//        $objPHPExcel->setCellValue('V1', 'LIDER CATEGORIA');
//        $objPHPExcel->setCellValue('W1', 'LIDER PLAZA');
//        $objPHPExcel->setCellValue('X1', 'LIDER REGIONAL');
            $contador = 2;
            foreach ($datos_visitas as $data) {



                $objPHPExcel->setCellValue('A' . $contador, $data->CODIGO_VISITA)
                        ->setCellValue('B' . $contador, $data->FECHA_VISITA)
                        ->setCellValue('C' . $contador, $data->FECHA_INGRESO_VISITA)
                        ->setCellValue('D' . $contador, $data->NOMBRE_EJECUTIVO)
                        ->setCellValue('E' . $contador, $data->DOCUMENTO_EJECUTIVO)
                        ->setCellValue('F' . $contador, $data->CARGO)
                        ->setCellValue('G' . $contador, $data->PLAZA)
                        ->setCellValue('H' . $contador, $data->NOMBRE_CANAL_FENIX)
                        ->setCellValue('I' . $contador, $data->nombre_cliente)
                        ->setCellValue('J' . $contador, $data->documento)
                        ->setCellValue('K' . $contador, $data->nombre_documento)
                        ->setCellValue('L' . $contador, $data->nombre_contacto)
                        ->setCellValue('M' . $contador, $data->email_contacto)
                        ->setCellValue('N' . $contador, $data->telefono_contacto)
                        ->setCellValue('O' . $contador, $data->telefono_celular_contacto)
                        ->setCellValue('P' . $contador, $data->objetivo)
                        ->setCellValue('Q' . $contador, $data->resultado)
                        ->setCellValue('R' . $contador, $data->LIDER_CATEGORIA)
                        ->setCellValue('S' . $contador, $data->LIDER_PLAZA)
                        ->setCellValue('T' . $contador, $data->LIDER_REGIONAL)
                        ->setCellValue('U' . $contador, $data->tipo)
                        ->setCellValue('V' . $contador, $data->valor)
                        ->setCellValue('W' . $contador, $data->probabilidad);



                $contador++;
            }

            //$writer = new PHPExcel_Writer_HTML($this->phpexcel);
            $writer = new PHPExcel_Writer_Excel2007($this->phpexcel);
            $writer->setPreCalculateFormulas(false);
            // header('Content-Type: application/vnd.ms-excel');
//        //log_message('debug', JPATH_BASE);
//        $ruta = JPATH_BASE . '/tmp/';
//        $ruta_anchor = JURI::base() . 'tmp/';
            $nombre = 'informe_visitas-' . date('d-m-y_h_i_s_A') . '_' . $cedula . '.xlsx';
            $writer->save($ruta . $nombre);



            //   simple_xls::make_xls($datos_visitas, $ruta, $nombre);
        }



        //log_message('debug', $ruta_anchor . $nombre);
        $data_return['url_descarga'] = $ruta_anchor . $nombre;
        // $data_return['nombre'] = $nombre;
        $data_return['nombre'] = '';
        $this->load->view('visitas/resultado_descarga', $data_return, false, false);
//$writer->save('php://output'); 
    }

    function descarga_acompa() {
        //$this->load->library('simple_xls');
        $this->load->model('acompa_model');
        $this->load->library('PHPExcel');
        $mes = $this->input->post('mes');
        $anio = $this->input->post('anio');
        $user = $this->ion_auth->user();
        $codigo_fenix = $this->estructura_model->get_codigo_fenix_jos_user($user->row()->username);


        if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('GESTION_CONSULTA')) {
            //  log_message('debug','es admin....');
            $datos_visitas = $this->acompa_model->get_acompas($mes, $anio)->result();
            $nombre = 'informe_acompa_' . date('d-m-y_h_i_s_A') . '.xlsx';
        } else {
            //   log_message('debug',$cedula.' la cedula ejecutivo');

            $datos_visitas = $this->acompa_model->get_acompas($mes, $anio, $codigo_fenix->CODIGO_ASESOR_FENIX)->result();
            $nombre = 'informe_acompa_' . date('d-m-y_h_i_s_A') . '_' . $codigo_fenix->CODIGO_ASESOR_FENIX . '.xlsx';
        }
        $ruta = BASEPATH . '../tmp/';
        /**
         * para saber cuantas columnas son tenemos un arreglo con el alfabeto
         */
        $alpha = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
        //  log_message('debug', 'ruta de xls' . $ruta);
        //echo $ruta;
        $ruta_anchor = base_url() . 'tmp/';
        // $nombre = 'informe_visitas-' . date('d-m-y_h_i_s_A') . '_' . $cedula . '.xlsx';
        if (count($datos_visitas) == 0) {
            $data_return['resultado'] = 0;
        } else {
            $data_return['resultado'] = 1;

            $cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_memcache;
            $cacheSettings = array('memoryCacheSize' => '1024MB');
            PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
            $objPHPExcel = $this->phpexcel->getActiveSheet();
            $this->phpexcel->getProperties()->setCreator("Herramientas de Gestion UNE-Pymes");
//        $this->phpexcel->getProperties()->setLastModifiedBy("e-Pymes");
            $this->phpexcel->getProperties()->setTitle("Informe Acompañamientos");
            $this->phpexcel->getProperties()->setSubject("Informe generado en " . date('D-m-Y'));
//        $this->phpexcel->getProperties()->setDescription("Consolidado generado para el seguimiento de pedidos une viceprecidencia Pymes");
//
//        $objPHPExcel->getDefaultColumnDimension()->setWidth(20);
//        $objPHPExcel->getDefaultRowDimension()->setRowHeight(15);

            $bandera = 0;
            foreach ($datos_visitas as $value) {
                if ($bandera === 0) {
                    //  echo count($value);
                    $objPHPExcel->getStyle('A1:' . $alpha[count($value)] . '1')->getFill()
                            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('AB162B');
                    $objPHPExcel->getStyle('A1:' . $alpha[count($value)] . '1')->getFont()->getColor()->setARGB('FFFFFFFF');
                    // print_r($key);
                    // print_r($value);
                    $conta = 0;
                    $contador = 2;
                    foreach ($value as $key => $v) {
                        $objPHPExcel->setCellValue($alpha[$conta] . '1', $key);
                        $objPHPExcel->setCellValue($alpha[$conta] . $contador, $v);
                        $conta++;
                    }
                    $objPHPExcel->getStyle('A1:' . $alpha[$conta] . '1')->getFill()
                            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('AB162B');
                    $objPHPExcel->getStyle('A1:' . $alpha[$conta] . '1')->getFont()->getColor()->setARGB('FFFFFFFF');

                    $contador = 3;
                    $bandera = 1;
                } else {
                    $conta = 0;
                    foreach ($value as $key => $v) {
                        $objPHPExcel->setCellValue($alpha[$conta] . $contador, $v);

                        $conta++;
                    }
                    $contador++;
                }
            }

//            //$writer = new PHPExcel_Writer_HTML($this->phpexcel);
            $writer = new PHPExcel_Writer_Excel2007($this->phpexcel);
            $writer->setPreCalculateFormulas(false);
            // header('Content-Type: application/vnd.ms-excel');
//        //log_message('debug', JPATH_BASE);
//        $ruta = JPATH_BASE . '/tmp/';
//        $ruta_anchor = JURI::base() . 'tmp/';
            //$nombre = 'informe_acompa-' . date('d-m-y_h_i_s_A') . '_' .$codigo_fenix->CODIGO_ASESOR_FENIX. '.xlsx';
            $writer->save($ruta . $nombre);



            //   simple_xls::make_xls($datos_visitas, $ruta, $nombre);
        }
        //log_message('debug', $ruta_anchor . $nombre);
        $data_return['url_descarga'] = $ruta_anchor . $nombre;
        // $data_return['nombre'] = $nombre;
        $data_return['nombre'] = '';
        $this->load->view('consultas/resultado_descarga', $data_return, false, false);
//$writer->save('php://output'); 
    }

}

?>
