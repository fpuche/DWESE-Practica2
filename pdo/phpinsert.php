<?php

require '../require/comun.php';
//require '../Clases/SubirArchivos.php';
$bd = new BaseDatos();
if (!$bd->isConectado()) {
    header("Location: index.php?r=-1");
    exit();
}
$localidad = Leer::post("localidad");
$precio = Leer::post("precio");
$superficie = Leer::post("superficie");
$habitaciones = Leer::post("habitaciones");
$casa = new Casa(null, $localidad, $precio, $superficie, $habitaciones);
$modelo = new ModeloCasa($bd);
$rcasa = $modelo->add($casa);


$idCasa = $bd->getAutonumerico();


$modeloFoto = new ModeloFoto($bd);

$subir = new SubirArchivos("archivos");
$subir->setNombre($idCasa);
$subir->subir();

$extensiones = $subir->getExtensiones();

foreach ($extensiones as $i => $valor) {
   // echo $i."<br/>";
   // echo $valor."<br/>";
   echo $valor;
    $objetoFoto = new Foto(null, $idCasa, "../uploads/$valor");
    $rFoto = $modeloFoto->add($objetoFoto);
}

$bd->closeConexion();

header("Location: index.php");
?>



