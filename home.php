<?php include("db.php") ?>
<?php include("includes/header.php") ?>
<!--
    <form action="" method="POST">
        <p>CODIGO <input type="text" placeholder="Ingrese el código" name="codigo" </p>
        <p>DESCRIPCIÓN <input type="text" placeholder="Ingrese una descripción" name="descripción" </p>
        <p>TIPO <input type="text" placeholder="Ingrese el tipo" name="tipo" </p>
        <p>VALOR REF <input type="number" placeholder="Ingrese el valor referencial" name="valorref" </p>
        <p>NCC <input type="number" placeholder="Ingrese el NCC" name="ncc" </p>
        <p>NRO CONV <input type="number" placeholder="Ingrese el numero de conv" name="nroconv" </p>
        <p>PLAZO EN DIAS <input type="number" placeholder="Ingrese el plazo en días" name="plazo" </p>
        <p>F CONV <input type="date" placeholder="Ingrese fecha de conv" name="fconv" </p>
        <p>INICIO <input type="date" placeholder="Ingrese fecha de inicio" name="inicio" </p>
        <p>FIN <input type="date" placeholder="Ingrese fecha de fin" name="fin" </p>
       
    </form>
    <a href="#" type="input">Nuevo</a>
    <a href="#" type="input">Modificar</a>
    <a href="#" type="input">Eliminar</a>
    <a href="#" type="input">Buscar</a>
-->
<div class="container p-4">
    <div class="col-md-4">

        <?php if(isset($_SESSION['message'])) {?>
            <div class="alert alert-<?= $_SESSION['message_type'] ?>alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php session_unset();}?>

        <div class="card card-body">
            <form action="save_task.php" method="POST">
                <div class="form-group">    
                    <p>CODIGO <input type="text" placeholder="Ingrese el código" name="codigo" autofocus></p>
                    <p>DESCRIPCIÓN <input type="text" placeholder="Ingrese una descripción" name="descripción"> </p>
                    <p>TIPO <input type="text" placeholder="Ingrese el tipo" name="tipo" ></p>
                    <p>VALOR REF <input type="number" placeholder="Ingrese el valor referencial" name="valorref" ></p>
                    <p>NCC <input type="number" placeholder="Ingrese el NCC" name="ncc" </p>
                    <p>NRO CONV <input type="number" placeholder="Ingrese el numero de conv" name="nroconv" ></p>
                    <p>PLAZO EN DIAS <input type="number" placeholder="Ingrese el plazo en días" name="plazo" ></p>
                    <p>F CONV <input type="date" placeholder="Ingrese fecha de conv" name="fconv" ></p>
                    <p>INICIO <input type="date" placeholder="Ingrese fecha de inicio" name="inicio" ></p>
                    <p>FIN <input type="date" placeholder="Ingrese fecha de fin" name="fin" ></p>
                    <input type="submit" class="btn btn-success btn-block" name="save_task" value="Save Task">
                </div>
            </form>
        </div>       

    </div>

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
                            $query = "SELECT * FROM requerimientos";
                            $resultado_requerimientos = mysqli_query($conexion, $query);

                            while($row = mysqli_fetch_array($resultado_requerimientos)) {?>
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
                                    <a href="edit.php?id=<?php echo $row['CODREQ'] ?>">Modificar</a>
                                    <a href="eliminar.php?id=<?php echo $row['CODREQ'] ?>">Eliminar</a>
                                    </td>
                                </tr>
                            <?php } ?>
                            <!--
                            <a href="edit.php?id=<!?php echo $row['id'] ?>">Modificar</a>
                            <a href="eliminar.php" type="input">Eliminar</a>
                            <a href="buscar.php" type="input">Buscar</a>
                            -->
                </tbody>
            </table>-
    </div>
</div>
<?php include("includes/footer.php") ?>