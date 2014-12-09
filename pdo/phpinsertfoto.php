

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once '../clases/Leer.php';
        require_once '../clases/Subir.php';



        require '../require/comun.php';
        $bd = new BaseDatos();
        if (!$bd->isConectado()) {
            header("Location: index2.php?r=-1");
            exit();
        }

        $idcasa = Leer::post("idcasa");


        $url = "../uploads/" . $idcasa . ".txt";
        $foto = new Foto(null, $idcasa, $url);
        $modelofoto = new ModeloFoto($bd);
        $r = $modelofoto->add($foto);


        $bd->closeConexion();

        header("Location: index.php?op=insertfoto&r=$r");




        $subir = new Subir("archivo");
        $subir->setNombre(Leer::post("nombre"));
        $subir->setAccion(Leer::post("valor"));
        $subir->subir();
        if ($subir->getMensaje_Error() == "") {
            echo '<script>alert (" Mensaje: Procesado");</script>';
        } else {
            echo '<script>alert (" Mensaje: ' . $subir->getMensaje_Error() . '");</script>';
        }
        ?>
    </body>
</html>