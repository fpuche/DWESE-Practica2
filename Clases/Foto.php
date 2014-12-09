<?php

class Foto {

    private $idfoto, $idcasa, $url;

    function __construct($idfoto = null, $idcasa = null, $url = "") {
        $this->idfoto = $idfoto;
        $this->idcasa = $idcasa;
        $this->url = $url;
    }

    /**
     * Asigna a cada variable su valor contenido en un array
     * @access public
     * @return asigna valor a las variables
     */
    function set($datos, $inicio = 0) {
        $this->idfoto = $datos[0 + $inicio];
        $this->idcasa = $datos[1 + $inicio];
        $this->url = $datos[2 + $inicio];
    }

    public function getIdfoto() {
        return $this->idfoto;
    }

    public function setIdfoto($idfoto) {
        $this->idfoto = $idfoto;
    }

    public function getIdcasa() {
        return $this->idcasa;
    }

    public function setIdcasa($idcasa) {
        $this->idcasa = $idcasa;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

}

?>
