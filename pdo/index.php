
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Su vivienda</title>

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
                        <h2 class="intro-text text-center">Sección para
                            <strong>Administrador</strong>
                        </h2>
                        <hr>


                        <?php
                        require '../require/comun.php';


                        $pagina = 0;
                        if (Leer::get("pagina") != null) {
                            $pagina = Leer::get("pagina");
                        }
                        $bd = new BaseDatos();
                        $modelo = new ModeloCasa($bd);
                        $filas = $modelo->getList($pagina);
                        $paginas = $modelo->getNumeroPaginas();
                        $total = $modelo->count();
                        $enlaces = Util::getEnlacesPaginacion2($pagina, $total[0]);


                        $modelofoto = new ModeloFoto($bd);
                        $foto = array();

                        ?>
                        <!DOCTYPE html>
                        <html>
                            <head>
                                <meta charset="UTF-8">
                                <title>Casa</title>
                                <script src="../js/main.js"></script>
                            </head>
                            <body>   
                                <br/>
                                <fieldset>
                                    <legend>Viviendas</legend><br/>
                                    <table border="1">  
                                        <tr>
                                            <th> idcasa</th>
                                            <th> localidad</th>
                                            <th> precio (€)</th>
                                            <th> superficie (m<sup>2</sup>)</th>
                                            <th> habitaciones</th>
                                            <th> Foto</th> 
                                        </tr>
                                        <?php
                                        foreach ($filas as $indice => $objeto) {
                                            $foto = $modelofoto->getFotoIdCasa($objeto->getIdcasa());
                                            ?>  
                                            <tr>
                                                <td> <?php echo$objeto->getIdcasa(); ?></td>
                                                <td> <?php echo$objeto->getLocalidad(); ?></td>
                                                <td> <?php echo$objeto->getPrecio(); ?></td>
                                                <td> <?php echo$objeto->getSuperficie(); ?></td>   
                                                <td> <?php echo$objeto->getHabitaciones(); ?></td> 
                                                <td width="201px">
                                                    <?php if ($foto == true) { ?>
                                                        <img width="200px" src="<?php echo$foto[0]->getUrl(); ?>"/>
                                                    <?php } ?>
                                                </td>
                                                <td><a data-idcasa='<?php echo $objeto->getIdcasa(); ?>'                           
                                                       class='borrar' href='phpdelete.php?idcasa=<?php echo $objeto->getIdcasa(); ?>'>borrar</a>
                                                </td>
                                                <td><a data-idcasa='<?php echo $objeto->getIdcasa(); ?>'
                                                       href='ver.php?idcasa=<?php echo $objeto->getIdcasa(); ?>'>editar</a>
                                                </td>

                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        <tr>
                                            <td class="paginacion" colspan="8">
                                                <?php echo $enlaces["inicio"]; ?>
                                                <?php echo $enlaces["anterior"]; ?>
                                                <?php echo $enlaces["primero"]; ?>
                                                <?php echo $enlaces["segundo"]; ?>
                                                <?php echo $enlaces["actual"]; ?>
                                                <?php echo $enlaces["cuarto"]; ?>
                                                <?php echo $enlaces["quinto"]; ?>
                                                <?php echo $enlaces["siguiente"]; ?>
                                                <?php echo $enlaces["ultimo"]; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </fieldset>
                                <form action="phpinsert.php" method="POST" enctype="multipart/form-data">
                                    <fieldset>
                                        <legend>Insertar vivienda</legend><br/>
                                <!--            <input type="text" name="idcasa" value="" size="30" id="idcasa" placeholder="idcasa" required/>
                                            <br/>-->
                                        <input type="text" name="localidad" value="" size="50" id="localidad" placeholder="localidad" required/>
                                        <br/>
                                        <input type="text" name="precio" value="" size="50" id="precio" placeholder="precio" required/>
                                        <br/>
                                        <input type="text" name="superficie" value="" size="50" id="superficie" placeholder="superficie" required/>
                                        <br/>
                                        <input type="text" name="habitaciones" value="" size="50" id="habitaciones" placeholder="habitaciones" required/>
                                        <br/>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Añadir foto</legend><br/>
                                        Foto:
                                        <br/>  
                                        <input type="file" name="archivos[]" multiple/><br/><br/>
                                        <input type="submit" value="Insertar" />
                                    </fieldset>
                                </form>
                            </body>
                        </html>
                        <?php
                        $bd->closeConexion();
                        ?>
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













