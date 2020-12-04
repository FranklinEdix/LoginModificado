<?php include("db.php")?>
<?php include("includes/header.php")?>

<div class="container p-4">
    <div class="col-md-4 mx-auto">
        <?php if(isset($_SESSION['message'])) {?>
            <div class="alert alert-<?= $_SESSION['message_type'] ?>alert-dismissible fade show" role="alert">
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
            <p><input type="txt" placeholder="Ingrese codigo a buscar" name="busqueda" ></p>
                    <input type="submit" class="btn btn-success btn-search" name="buscar" value="Buscar">
            </form>
        </div>       

    </div>
    <br>
    <div class="col-md-8">  
            <table class="table table-bordered">
                <thead>
                    <tr>
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
                <tbody>
                        <?php
                             if (isset($_POST['buscar'])) {
                                 $codex = $_POST['busqueda'];
                                 $sql ="SELECT * FROM requerimientos WHERE CODREQ = '".$codex."'";
                                 $result = mysqli_query($conexion, $sql);
                                 while ($row = mysqli_fetch_array($result)) {?>
                                <tr>
                                    <td><?php echo $row['CODREQ'] ?></td>
                                    <td><?php echo $row['DESREQ'] ?></td>
                                    <td><?php echo $row['TIPREQ'] ?></td>
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
                                    </td>
                                </tr>
                            <?php }
                             } ?>
                </tbody>
            </table>-
    </div>
</div>

<?php include("includes/footer.php") ?>
