<?php

class Entorno {

    private function __construct() {
        
    }

    public static function getServidor() {
        return $_SERVER['SERVER_NAME'];
    }

    public static function getPuerto() {
        return $_SERVER['SERVER_PORT'];
    }

    public static function getRaiz() {
        return $_SERVER['DOCUMENT_ROOT'];
    }

    public static function getMetodo() {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function getParametros() {
        return $_SERVER['QUERY_STRING'];
    }

    public static function getScript() {
        return $_SERVER['SCRIPT_NAME'];
    }

    public static function getPagina() {
        $script = self::getScript();
        $pos = strrpos($script, "/");
        $pagina = substr($script, $pos + 1);
        return $pagina;
    }

    public static function getCarpetaServidor() {
        $script = self::getScript();
        $pos = strrpos($script, "/");
        $pagina = substr($script, 0, $pos);
        return $pagina;
    }

    public static function getCarpetaPadreRaiz() {
        $raiz = self::getRaiz();
        $pos = strrpos($raiz, "/");
        $pagina = substr($raiz, 0, $pos);
        return $pagina;
    }

    public static function getArrayParametros() {
        $array = array();
        $parametros = self::getParametros();
        $partes= explode("&", $parametros);
        foreach ($partes as $indices => $valor) {
            $subpartes= explode("=", $valor);
            if(!isset($subpartes[1])){
                $subpartes[1]="";
            }
            if(isset($array[$subpartes[0]])){
              if(is_array($array[$subpartes[0]]))  {
                  $array[$subpartes[0]][]=$subpartes[1];
              }else{
                 $subarray=array();
                 $subarray[]=$array[$subpartes[0]];
                 $subarray[]=$subpartes[1];
                 $array[$subpartes[0]]=$subarray;
              }
            } else{
            $array[$subpartes[0]]=$subpartes[1];
            }
        }
        return $array;
    }
    
    public static function getEnlaceCarpeta($pagina=""){
        return  $enlace= "http://". self::getServidor().self::getPuerto().self::getCarpetaServidor().$pagina;
    }

}
