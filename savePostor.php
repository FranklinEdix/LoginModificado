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
    <link rel="stylesheet" href="./css/estilos3.css">
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
            <div class="alert alert-<?= $_SESSION['message_type'] ?>alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php session_unset();}?>

        <div class="">
            <form action="save_task_postor.php" method="POST">
                <div class="form-group" id="2">
                    <table style=" background-color: #fff; width: 100%; height: 500px; border-radius: 20px; padding: 50px; border : 1px solid blak; text-align: center;">
                         <tr>
                        <th style=" width: 600px;">Numero de Oferta</th>
                            <th><input type="number" placeholder="Ingrese Nro Oferta" name="nro_oferta" min="" max=""></th>
                        </tr>
                        <tr>
                        <tr>
                        <th style=" width: 600px;">Requerimiento</th>
                        <th>

                                <label><select name="Req" id="sm">
                                <?php
                                $conn = mysqli_connect("localhost","root","","usuario") or die ("error al conectar");
                                $query = $conn -> query ("SELECT * FROM requerimientos");
                                while ($valores = mysqli_fetch_array($query)) {
                                    echo '<option value="'.$valores['CODREQ'].'">'.$valores['CODREQ'].'</option>';
                                }
                                mysqli_close($conn);
                                ?>
                                </select>
                        </th>
                        </tr>
                        <tr>
                        <th style=" width: 600px;">RucRazonSocial</th>
                            <th><input type="number" placeholder="Ingrese el ruc de razon social" name="RucRsocial" min="" max=""></th>
                        </tr>
                        <tr>
                        <th style=" width: 600px;">NroCel</th>
                            <th><input type="number" placeholder="Ingrese el nuemero de celular" name="Nrocel" min="" max=""></th>
                        </tr>
                        <tr>
                        <th style=" width: 600px;">Oferta</th>
                            <th><input type="number" placeholder="Ingrese el numero de conv" name="oferta" ></th>
                        </tr>
                    </table>
                    <br>    
                    <input type="submit" class="btn btn-success btn-block" name="save_task_postor" value="Guardar Nuevo">
                </div>
            </form>
        </div>       

    </div>

    <?php include("includes/footer.php") ?>