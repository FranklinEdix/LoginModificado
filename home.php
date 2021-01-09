<?php include("db.php");     
        ob_start();
        $_SESSION['doc2'] = null;
        ob_start();
        $_SESSION['doc3'] = null;
    ?>
<?php include("includes/header.php") ?>
<div class="container p-4">
    <div class="col-md-4 mx-auto">
        <?php if(isset($_SESSION['message'])) {?>
            <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php session_unset();}?>
        <div class="card card-body">
            <form action="save.php">
                <p>
                    <input type="submit" class="btn btn-success btn-block" name="save_task" value="Agregar Nuevo">
                </p>
            </form>
            <form action="buscar.php" method="POST">
            <p>
                <input type="txt" placeholder="Ingrese codigo a buscar" name="busqueda" >
                <input type="submit" class="btn btn-success btn-search" name="buscar" value="Buscar">
            </p>
            </form>
        </div>       

    </div>
    <br>
    <div class="">  
            <table class="table table-bordered" id="1">
                <thead>
                    <tr class="table-success">
                        <th>Codigo</th>
                        <th>Descripción</th>
                        <th>Tipo</th>
                        <th>Valor Referencial</th>
                        <th>Ncc</th>
                        <th>Nro Conv</th>
                        <th>Plazo en Dias</th>
                        <th>Fecha de Conv</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                    </tr>
                </thead>
                <br>
                <tbody class="table table-dark">
                        <?php
                            $query = "SELECT * FROM requerimientos";
                            $resultado_requerimientos = mysqli_query($conexion, $query);

                            while($row = mysqli_fetch_array($resultado_requerimientos)) {?>
                                <tr class="color">
                                    <td><?php echo $row['CODREQ'];?></td>
                                    <?php 
                                    ob_start();
                                    $_SESSION['reqOferta'] = $row['CODREQ'];?>
                                    <td><?php echo $row['DESREQ'] ?></td>
                                    <td><?php 
                                        $tipo = $row['TIPREQ'];
                                        $queryTipo = "SELECT*FROM tipo where IdTipo = '$tipo'";
                                        $result = mysqli_query($conexion, $queryTipo); 

                                        $row1 = mysqli_fetch_array($result);

                                        $TipoName = $row1['NombreTipo'];    
                                        echo $TipoName ?></td>
                                    <td><?php echo $row['VREFREQ'] ?></td>
                                    <td><?php echo $row['NCCPREQ'] ?></td>
                                    <td><?php echo $row['NCONVREQ'] ?></td>
                                    <td><?php echo $row['PLAZOREQ'] ?></td>
                                    <td><?php echo $row['FCONREQ'] ?></td>
                                    <td><?php echo $row['FICREQ'] ?></td>
                                    <td><?php echo $row['FFCREQ'] ?></td>
                                    <td>
                                    <a href="eliminar.php?id=<?php echo $row['CODREQ'] ?>" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    <a href="edit.php?id=<?php echo $row['CODREQ'] ?>" class="btn btn-secondary">
                                        <i class="fas fa-marker"></i>
                                    </a>
                                    <a <?php
                                            $NumPropuestas = "SELECT COUNT(*) AS 'uno' FROM oferta_postor WHERE Requerimiento='".$_SESSION['reqOferta']."'";

                                            $resultado0 = mysqli_query($conexion, $NumPropuestas);

                                            $row = mysqli_fetch_array($resultado0);
                                            $CantidadOferta = $row['uno'];
                                            if($CantidadOferta == 0){
                                                ?>href="PdfPostorNulo.php?id=<?php echo $_SESSION['reqOferta'] ?>"<?php
                                            }else{
                                                ?>href="ofertas.php?id=<?php echo $_SESSION['reqOferta'] ?>"<?php
                                            }?> class="btn btn-info">
                                        <i class="fas fa-dollar-sign"></i>
                                    </a>
                                    <a <?php
                                            $NumPropuestas = "SELECT COUNT(*) AS 'uno' FROM oferta_postor WHERE Requerimiento='".$_SESSION['reqOferta']."'";

                                            $resultado0 = mysqli_query($conexion, $NumPropuestas);

                                            $row = mysqli_fetch_array($resultado0);
                                            $CantidadOferta = $row['uno'];
                                            if($CantidadOferta == 0){
                                                ?>href="Mensaje.php?id=<?php echo $_SESSION['reqOferta'] ?>"<?php
                                            }else{
                                                ?>href="Documento.php?id=<?php echo $_SESSION['reqOferta'] ?>" target="_blank"<?php
                                            }?> class="btn btn-success">
                                        <i class="fas fa-file-word"></i>
                                    </a>
                                    </td>
                                </tr>
                            <?php }  ?>
                </tbody>
            </table>
    </div>
</div>
<?php include("includes/footer.php") ?>