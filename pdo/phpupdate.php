<?php
require "../require/comun.php";
$idcasa= Leer::post('idcasa');
$localidad= Leer::post('localidad');
$precio= Leer::post('precio');
$superficie= Leer::post('superficie');
$habitaciones= Leer::post('habitaciones');

$bd=new BaseDatos();
$modelo= new ModeloCasa($bd);
$casa= new Casa($idcasa, $localidad, $precio, $superficie, $habitaciones);
$r=$modelo->edit($casa);
$modeloFoto = new ModeloFoto($bd);

$subir = new SubirArchivos("archivos");
$subir->setNombre($idcasa);
$subir->subir();

$extensiones = $subir->getExtensiones();

foreach ($extensiones as $i => $valor) {
   // echo $i."<br/>";
   // echo $valor."<br/>";
   //echo $valor;
    $objetoFoto = new Foto(null, $idcasa, "../uploads/$valor");
    $rFoto = $modeloFoto->add($objetoFoto);
}



$bd->closeConexion();
header("Location: index.php?opupdate&r=$r");


