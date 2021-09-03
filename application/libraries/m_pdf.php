<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class M_pdf {
    
    function pdf()
    {
        $CI = & get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }
 
    function load($params=NULL)
    {
        include_once APPPATH.'/third_party/MPDF/mpdf.php';
         
        if ($params == NULL)
        {
            $param = '"en-GB-x","Letter","","",8,8,12,8,6,3';         
        }
         
        return new mPDF($param);
    }
}