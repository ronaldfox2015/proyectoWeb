<?php
namespace Clicks\Utils;

use CaoCsvOutput\Model\Csv;

class Output
{
    public static function excel($headings=array(), $data=array(), $name='reporte')
    {
        $datos = array();
        $datos[]=$headings;
        foreach($data as $row)
            $datos[]=$row;
        $csv = new Csv($datos,',');
        $output = $csv->render();
        $filename = "$name.csv";
        header('Content-type: application/octet-stream;');
        header('Content-Disposition: attachment; filename=' . $filename);
        $output = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $output);
        $output=html_entity_decode($output, ENT_QUOTES, 'ISO-8859-1');
        echo $output;
    }

    public static function json($state='', $msg='', $href='',
            $state1='', $msg1='', $href1='', $data=array(), $extra=array(), $return = false)
    {
        $arrSession=array(
            'state'=>$state,
            'msg'=>$msg,
            'href'=>$href
        );
        $arrData=array(
            'state'=>$state1,
            'msg'=>$msg1,
            'href'=>$href1,
            'src'=>$data
        );

        $result = json_encode(array('session'=>$arrSession, 'data'=>$arrData, 'extra'=>$extra));

        //->by Ander
        if ($return) {
            return $result;
        }
        echo $result;
    }

    public static function vector($state='', $msg='', $href='', $state1='', $msg1='', $href1='', $data=array(), $extra=array())
    {
        $arrSession = array('state'=>$state,  'msg'=>$msg,  'href'=>$href);
        $arrData    = array('state'=>$state1, 'msg'=>$msg1, 'href'=>$href1, 'src'=>$data);

        return array( 'session'=>$arrSession, 'data'=>$arrData, 'extra'=>$extra );
    }

    public static function fechaDisponible($fecha)
    {
        $time = strtotime($fecha);
        $MesNro = date('n',$time);
        $DiaNro = date('d',$time);
        $result="$DiaNro/".self::nombreMes($MesNro);

        return $result;
    }
    
    public static function nombreMes($nro)
    {
        $meses=array(
            'Enero','Febrero','Marzo','Abril','Mayo','Junio',
            'Julio','Agosto','Septiembre','Octubre',
            'Noviembre','Diciembre'
        );

        return $meses[$nro-1];
    }
    
    public static function jsonData($data = array()) 
    {
        $result = json_encode(array('data' => $data));
        echo $result;
    }

}
