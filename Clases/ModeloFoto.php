<?php

class ModeloFoto {
    private $bd;
    private $tabla = "fotos";

    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }

    
        /**
     * Añade un objeto a la tabla foto
     * @access public
     * @return int
     */
    function add(Foto $objeto) {           
        $sql = "insert into $this->tabla values(null, :idcasa, :url);";
        $parametros["idcasa"] = $objeto->getIdcasa();
        $parametros["url"] = $objeto->getUrl();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getAutonumerico();
    }
   /**
     * Borra elementos de la base de datos fotos
     * @access public
     * @return int
     */
    function delete(Foto $objeto) {
        $sql = "delete from $this->tabla where idfoto = :idfoto";
        $parametros["idfoto"] = $objeto->getIdfoto();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }


    /**
     * Borra elementos de la base de datos fotos por su id
     * @access public
     * @return int
     */    
    function deletePorIdFoto($idfoto) {
        return $this->delete(new Foto($idfoto));
    }

    
    /**
     * Edita elementos de la base de datos fotos
     * @access public
     * @return int
     */
    function edit(Foto $objeto) {
        $sql = "update $this->tabla  set idcasa = :idcasa, url = :url where idfoto = :idfoto";
        $parametros["idcasa"] = $objeto->getIdcasa();
        $parametros["url"] = $objeto->getUrl();
        $parametros["idfoto"] = $objeto->getIdfoto();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

        /**
     * Edita elementos de la base de datos fotos por su id
     * @access public
     * @return int
     */
    function editPK(Foto $objetoOriginal, Foto $objetoNuevo) {
        $sql = "update $this->tabla  set idcasa = :idcasa,url = :url where idfoto = :idfotopk";
        $parametros["idcasa"] = $objetoNuevo->getIdcasa();
        $parametros["url"] = $objetoNuevo->getUrl();
        $parametros["idfoto"] = $objetoNuevo->getIdfoto();
        $parametros["idfotopk"] = $objetoOriginal->getIdfoto();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

        /**
     * Retorna un objeto foto de la base de datos fotos por su id
     * @access public
     * @return una casa o null
     */
    function get($idfoto) {
        $sql = "select * from $this->tabla where idfoto = :idfoto";
        $parametros["idfoto"] = $idfoto;
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            $foto = new Foto();
            $foto->set($this->bd->getFila());
            return $foto;
        }
        return null;
    }

        /**
     * El número de fotos que coinciden con una condición
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
     * Crea la lista de fotos según requisitos de paginación
     * @access public
     * @return array o null
     */
    function getList($pagina=0, $rpp=10, $condicion = "1=1", $parametros = array(), $orderby = "1") {
        $list = array();
        $principio = $pagina * $rpp; // si empezaramos por 1 en vez de por cero sería $pagina -1 * $rpp
        $sql = "select * from $this->tabla where $condicion order by $orderby limit $principio, $rpp";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            while ($fila = $this->bd->getFila()) {
                $foto = new Foto();
                $foto->set($fila);
                $list[] = $foto;
            }
        } else {
            return null;
        }
        return $list;
    }

    
    /**
     * Crea selects html con los valores de de la tabla foto
     * @access public
     * @return string
     */    
    function selectHtml($idfoto, $name, $condicion, $parametros, $orderby = 1, $valorSeleccionado = "", $blanco = true, $textoBlanco = "&nbsp;") {
        $select = "<select name='$name' idfoto='$idfoto'>";
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
            $select .="<option $selected value='" . $objeto->getIdfoto() . "'>" . $objeto->getIdcasa() . ", " . $objeto->getUrl() ."</option>";
        }
        $select .= "</select>";
        return $select;
    }
    
    /**
     * Obtiene las fotos que tiene una casa por su id
     * @access public
     * @return array o null
     */    
    function getFotoIdCasa($idcasa) {
        $sql = "select * from $this->tabla where idcasa= :idcasa";
        $parametros["idcasa"] = $idcasa;
        $r = $this->bd->setConsulta($sql, $parametros);
        $arrayFotos = array();
        if ($r) 
        {
            while ($fila = $this->bd->getFila()) 
            {
                $foto = new Foto();
                $foto->set($fila);
                $arrayFotos[] = $foto;
            }            
            return $arrayFotos;
        }
        return null;
    }
}

?>
