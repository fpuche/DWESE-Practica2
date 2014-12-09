<?php

class ModeloCasa {

    private $bd;
    private $tabla = "casas";

    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }

        /**
     * Añade un objeto a la tabla casa
     * @access public
     * @return int
     */
    function add(Casa $objeto) {
        $sql = "insert into $this->tabla values(null, :localidad, :precio, :superficie, :habitaciones);";
        $parametros["localidad"] = $objeto->getLocalidad();
        $parametros["precio"] = $objeto->getPrecio();
        $parametros["superficie"] = $objeto->getSuperficie();
        $parametros["habitaciones"] = $objeto->getHabitaciones();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getAutonumerico();
    }

    function getTabla() {
        return $this->tabla;
    }

    /**
     * Devuelve el total de páginas
     * @access public
     * @return int
     */
    function getNumeroPaginas($rpp = Configuracion::RPP) {
        $lista = $this->count();
        return (ceil($lista[0] / $rpp) - 1);
    }

    /**
     * Borra elementos de la base de datos casas
     * @access public
     * @return int
     */
    function delete(Casa $objeto) {
        $sql = "delete from $this->tabla where idcasa = :idcasa;";
        $parametros["idcasa"] = $objeto->getIdcasa();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    /**
     * Borra elementos de la base de datos casas por su id
     * @access public
     * @return int
     */
    function deletePorId($idcasa) {
        return $this->delete(new Casa($idcasa));
    }

    /**
     * Edita elementos de la base de datos casas
     * @access public
     * @return int
     */
    function edit(Casa $objeto) {
        $sql = "update $this->tabla  set localidad = :localidad, precio = :precio, superficie = :superficie, habitaciones = :habitaciones where idcasa = :idcasa";
        $parametros["localidad"] = $objeto->getLocalidad();
        $parametros["precio"] = $objeto->getPrecio();
        $parametros["superficie"] = $objeto->getSuperficie();
        $parametros["habitaciones"] = $objeto->getHabitaciones();
        $parametros["idcasa"] = $objeto->getIdcasa();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    /**
     * Edita elementos de la base de datos casas por su id
     * @access public
     * @return int
     */
    function editPK(Casa $objetoOriginal, Casa $objetoNuevo) {
        $sql = "update $this->tabla  set localidad = :localidad, precio = :precio, superficie = :superficie, habitaciones = :habitaciones where idcasa = :idcasapk";
        $parametros["localidad"] = $objetoNuevo->getLocalidad();
        $parametros["precio"] = $objetoNuevo->getPrecio();
        $parametros["superficie"] = $objetoNuevo->getSuperficie();
        $parametros["habitaciones"] = $objetoNuevo->getHabitaciones();
        $parametros["idcasa"] = $objetoNuevo->getIdcasa();
        $parametros["idcasapk"] = $objetoOriginal->getIdcasa();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    /**
     * Retorna un objeto casa de la base de datos casas por su id
     * @access public
     * @return una casa o null
     */
    function get($idcasa) {
        $sql = "select * from $this->tabla where idcasa = :idcasa";
        $parametros["idcasa"] = $idcasa;
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            $casa = new Casa();
            $casa->set($this->bd->getFila());
            return $casa;
        }
        return null;
    }

    /**
     * El número de casas que coinciden con una condición
     * @access public
     * @return int
     */
    function count($condicion = "1=1", $parametros = array()) {
        $sql = "select count(*) from $this->tabla where $condicion";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            return $numero = $this->bd->getFila(0);
        } else {
            return -1;
        }
    }

    /**
     * Crea la lista de casas según requisitos de paginación
     * @access public
     * @return array o null
     */
    function getList($pagina = 0, $rpp = 2, $condicion = "1=1", $parametros = array(), $orderby = "1") {
        $list = array();
        $principio = $pagina * $rpp; // si empezaramos por 1 en vez de por cero sería $pagina -1 * $rpp
        $sql = "select * from $this->tabla where $condicion order by $orderby limit $principio, $rpp";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            while ($fila = $this->bd->getFila()) {
                $casa = new Casa();
                $casa->set($fila);
                $list[] = $casa;
            }
        } else {
            return null;
        }
        return $list;
    }

    /**
     * Crea selects html con los valores de de la tabla casa
     * @access public
     * @return string
     */
    function selectHtml($idcasa, $name, $condicion, $parametros, $orderby = 1, $valorSeleccionado = "", $blanco = true, $textoBlanco = "&nbsp;") {
        $select = "<select name='$name' idcasa='$idcasa'>";
        $select .="</select>";
        if ($blanco) {
            $select .="<option value=''>$textoBlanco</option>";
        }
        $lista = $this->getList($condicion, $parametros, $orderby);
        foreach ($lista as $objeto) {
            $selected = "";
            if ($objeto->getId() == $valorSeleccionado) {
                $selected = "selected";
            }
            $select .="<option $selected value='" . $objeto->getIdcasa() . "'>" . $objeto->getLocalidad() . ", " . $objeto->getPrecio() . ", " . $objeto->getSuperficie() . ", " . $objeto->getHabitaciones() . "</option>";
        }
        $select .= "</select>";
        return $select;
    }

}

?>
