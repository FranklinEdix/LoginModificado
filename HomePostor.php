<?php include("db.php") ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requerimientos</title>
    <!--Bootrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/estilos2.css">
    <link rel="shortcut icon" href="./src/robot.ico" type="image/x-icon">
</head>
<body>
<nav class="navbar navbar-light" style="background-color: #adadad;">
    <div class="container">
        <a href="HomePostor.php" class="navbar-brand">
        <img src="src/home.png" width="30" height="30" class="d-inline-block align-top" alt=""> PRINCIPAL</a> 
        <a href="index.php" class="navbar-brand">SALIR <img src="src/salir.png" width="30" height="30" class="d-inline-block align-top" alt=""></a>    
    </div>   
</nav>
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
            <form action="savePostor.php">
                <p>
                    <input type="submit" class="btn btn-success btn-block" name="save_task" value="Agregar Nuevo">
                </p>
            </form>
            <form action="BuscarPostor.php" method="POST">
            <p>
                <input type="txt" placeholder="Ingrese codigo a buscar" name="busqueda" >
                <input type="submit" class="btn btn-success btn-search" name="buscar" value="Buscar">
            </p>
            </form>
        </div>       

    </div>
    <br>
    <div class="col-md-8">  
            <table class="table table-bordered" id="1">
                <thead>
                    <tr class="yyy">
                        <th>NroOferta</th>
                        <th>Requerimientos</th>
                        <th>RucRazonSocial</th>
                        <th>NroCel</th>
                        <th>Oferta</th>
                    </tr>
                </thead>
                <br>
                <tbody>
                        <?php
                            $query = "SELECT * FROM oferta_postor";
                            $resultado_requerimientos = mysqli_query($conexion, $query);

                            while($row = mysqli_fetch_array($resultado_requerimientos)) {?>
                                <tr class="color">
                                    <td><?php echo $row['NroOferta'] ?></td>
                                    <td><?php echo $row['Requerimiento'] ?></td>
                                    <td><?php echo $row['RucRazonSocial'] ?></td>
                                    <td><?php echo $row['NroCel'] ?></td>
                                    <td><?php echo $row['Oferta'] ?></td>
                                </tr>
                            <?php } ?>
                </tbody>
            </table>-
    </div>
</div>
<?php include("includes/footer.php") ?>