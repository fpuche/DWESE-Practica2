<?php

class Casa {

    private $idcasa, $localidad, $precio, $superficie, $habitaciones;

    function __construct($idcasa=null, $localidad="", $precio=0, $superficie=0, $habitaciones=0) {
        $this->idcasa = $idcasa;
        $this->localidad = $localidad;
        $this->precio = $precio;
        $this->superficie = $superficie;
        $this->habitaciones = $habitaciones;
    }

        /**
     * Asigna a cada variable su valor contenido en un array
     * @access public
     * @return asigna valor a las variables
     */
    function set($datos, $inicio = 0) {
        $this->idcasa = $datos[0 + $inicio];
        $this->localidad = $datos[1 + $inicio];
        $this->precio = $datos[2 + $inicio];
        $this->superficie = $datos[3 + $inicio];
        $this->habitaciones = $datos[4 + $inicio];
    }

    public function getIdcasa() {
        return $this->idcasa;
    }

    public function setId($idcasa) {
        $this->idcasa = $idcasa;
    }

    public function getLocalidad() {
        return $this->localidad;
    }

    public function setLocalidad($localidad) {
        $this->localidad = $localidad;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function getSuperficie() {
        return $this->superficie;
    }

    public function setSuperficie($superficie) {
        $this->superficie = $superficie;
    }

    public function getHabitaciones() {
        return $this->habitaciones;
    }

    public function setHabitaciones($habitaciones) {
        $this->habitaciones = $habitaciones;
    }
}
?>
