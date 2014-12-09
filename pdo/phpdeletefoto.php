<?php
require "../require/comun.php";
$bd = new BaseDatos();
if(!$bd->isConectado()){
    header("location.index.php=?r=1");
    exit();
}
$idfoto=Leer::request("idfoto");
echo $idfoto;
$idcasa=Leer::request("idcasa");
echo $idcasa;
$modelo = new ModeloFoto($bd);
$r=$modelo->deletePorIdFoto($idfoto);
        $bd->closeConexion();
header("Location: ver.php?op=delete&r=$r&idcasa=$idcasa");