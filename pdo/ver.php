
<?php
require '../require/comun.php';
$bd = new BaseDatos();
$idcasa = Leer::request("idcasa");
$modelo = new ModeloCasa($bd);
$casa = $modelo->get($idcasa);
$modelofoto = new ModeloFoto($bd);
$foto = $modelofoto->getFotoIdCasa($idcasa);
$bd->closeConexion();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Editar</title>
        <script src="../js/main.js"></script>

        <!-- CSS -->
        <link href="../css/cssreset.css" rel="stylesheet">
        <link href="../css/estilo.css" rel="stylesheet">

        <!-- Fonts -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    </head>
    <body>

        <div class="brand">Dreamers: Su vivienda</div>
        <div class="address-bar">Pol. Juncaril S/N | Granada | España</div>

        <!-- Menú Enlaces -->
        <nav class="navbar navbar-default" role="navigation">
            <div class="container">

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="../index.php">Index</a>
                        </li>
                        <li>
                            <a href="index2.php">Cliente</a>
                        </li>
                        <li>
                            <a href="index.php">Administrador</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </nav>

        <div class="container">

            <div class="row">
                <div class="box2">
                    <div class="col-lg-12">
                        <hr>
                        <h2 class="intro-text text-center">Editar
                            <strong>Vivienda</strong>
                        </h2>
                        <hr>


                        <form action = "phpupdate.php" method = "POST" id="formulario" enctype="multipart/form-data">
                            <a  href='index.php'>volver</a>
                            <br/>
                            <fieldset>
                                <legend>Editar datos</legend>

                                <input type = "hidden" name = "idcasa" value = "<?php echo $casa->getIdcasa(); ?>"/>

                                Localidad:
                                <br/>
                                <input type="text" name="localidad" value="<?php echo $casa->getLocalidad(); ?>" size="50" id="localidad" placeholder="localidad" required/>
                                <br/>
                                Precio:
                                <br/>
                                <input type="text" name="precio" value="<?php echo $casa->getPrecio(); ?>" size="50" id="precio" placeholder="precio" required/>
                                <br/>
                                Superficie:
                                <br/>
                                <input type="text" name="superficie" value="<?php echo $casa->getSuperficie(); ?>" size="50" id="superficie" placeholder="superficie" required/>
                                <br/>
                                Habitaciones:
                                <br/>
                                <input type="text" name="habitaciones" value="<?php echo $casa->getHabitaciones(); ?>" size="50" id="habitaciones" placeholder="habitaciones" required/>
                                <br/>  
                                <br/>
                                <input type = "submit" value = "Editar" />
                                <br/>
                            </fieldset>
                            <fieldset>

                                <legend>Editar fotos</legend>
                                <br/>
                                <?php
                                foreach ($foto as $indice => $objeto) {
                                    ?> 
                                    <br/>
                                    <img width="200px" src="<?php echo $objeto->getUrl(); ?>"/>
                                    <a data-idfoto='<?php echo $objeto->getIdfoto(); ?>'class='borrar' href='phpdeletefoto.php?idfoto=<?php echo $objeto->getIdfoto(); ?>&idcasa=<?php echo $objeto->getIdcasa(); ?>'>borrar</a>
                                    <br/>
                                    <?php
                                }
                                ?>
                            </fieldset>
                            <fieldset>
                                <legend>Añadir fotos</legend>
                                <br/>
                                <input type="file" name="archivos[]" multiple/><br/><br/>
                                <input type="submit" value="Insertar" /> 
                            </fieldset>
                        </form>                
                    </div>

                </div>
            </div>

        </div>
        <!-- /.container -->

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <p>Copyright &copy; Dreamers 2014</p>
                    </div>
                </div>
            </div>
        </footer>       
    </body>
</html>





