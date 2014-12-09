

<?php
require "../require/comun.php";
$bd = new BaseDatos();
if(!$bd->isConectado()){
    header("location.index.php=?r=1");
    exit();
}
$idcasa=Leer::get("idcasa");
$modelo = new ModeloCasa($bd);
$r=$modelo->deletePorId($idcasa);

        $bd->closeConexion();
//header("Location: index.php?op=delete&r=$r&id=$id&cuenta=$cuenta");
header("Location: index.php?op=delete&r=$r");