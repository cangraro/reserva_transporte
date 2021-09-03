<?php

/**
 * @author: CXn y Morgan
 * @version    1.0.1, 2013
 */
class simple_xls {

    //private $header = '<html>\n<body>\n<table>\n';

    public function make_xls($array, $ruta, $nombre) {
        if (file_exists($ruta . $nombre)) {
            unlink($ruta . $nombre);
        }

        $fp = @fopen($ruta . $nombre, 'w');
        if (!$fp) {
            return false;
        }
        $header = '<html>
            <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">	  
            </head>
            <body><table>';

        $content = $header . "<tbody>\n";
        $content .="<tr>";
        foreach ($array[0] as $key => $col) {
            $content .="<th>$key</th>\n";
        }

        $content .="</tr>\n";
        foreach ($array as $row) {
            $content .="<tr>";
            foreach ($row as $key => $col) {
                $content .="<td>".strip_tags($col)."</td>\n";
            }
            $content .="</tr>\n";
        }
        $content .= "</tbody>\n</table>\n</body>\n</html>";
        if (fwrite($fp, $content) === FALSE) {
            return false;
        }
        fclose($fp);
        return true;
    }

}

?>
