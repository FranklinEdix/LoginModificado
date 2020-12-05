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
    <link rel="stylesheet" href="estilos3.css">
</head>
<body>
<nav class="navbar navbar-light" style="background-color: #adadad;">
    <div class="container">
        <a href="home.php" class="navbar-brand">
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
            <form action="save_task.php" method="POST">
                <div class="form-group" id="2">
                    <table style=" background-color: #fff; width: 100%; height: 500px; border-radius: 20px; padding: 50px; border : 1px solid blak; text-align: center;">
                        <tr>
                            <th style="width: 600px;">Codigo</th>
                            <th ><input type="text" placeholder="Ingrese el código" name="codigo" autofocus></th>
                        </tr>
                        <tr>
                            <th style=" width: 600px;">Descripción</th>
                            <th><input type="text" placeholder="Ingrese una descripción" name="descripción"></th>
                        </tr>
                        <tr>
                        <th style=" width: 600px;">Tipo</th>
                            <th>
                                <label><select name="tipo" id="sm">
                                <?php

                                $conn = mysqli_connect("localhost","root","","usuario") or die ("error al conectar");
                                $query = $conn -> query ("SELECT * FROM tipo");
                                while ($valores = mysqli_fetch_array($query)) {
                                    echo '<option value="'.$valores['IdTipo'].'">'.$valores['NombreTipo'].'</option>';
                                }
                                mysqli_close($conn);
                                ?>
                                </select>
                            </th>
                        </tr>
                        <tr>
                        <th style=" width: 600px;">Valor Ref</th>
                            <th><input type="number" placeholder="Ingrese el valor referencial" name="valorref" ></th>
                        </tr>
                        <tr>
                        <th style=" width: 600px;">Ncc</th>
                            <th><input type="number" placeholder="Ingrese el NCC" name="ncc"></th>
                        </tr>
                        <tr>
                        <th style=" width: 600px;">Nro Conv</th>
                            <th><input type="number" placeholder="Ingrese el numero de conv" name="nroconv" ></th>
                        </tr>
                        <tr>
                        <th style=" width: 600px;">Plazo en Diás</th>
                            <th><input type="number" placeholder="Ingrese el plazo en días" name="plazo" ></th>
                        </tr>
                        <tr>
                        <th style=" width: 600px;">F Conv</th>
                            <th><input type="date" placeholder="Ingrese fecha de conv" name="fconv" ></th>
                        </tr>
                        <tr>
                        <th style=" width: 600px;">Inicio</th>
                            <th><input type="date" placeholder="Ingrese fecha de inicio" name="inicio" ></th>
                        </tr>
                        <tr>
                        <th style=" width: 600px;">Fin</th>
                            <th><input type="date" placeholder="Ingrese fecha de fin" name="fin" ></th>
                        </tr>
                    </table>
                    <br>    
                    <input type="submit" class="btn btn-success btn-block" name="save_task" value="Guardar Nuevo">
                </div>
            </form>
        </div>       

    </div>

    <?php include("includes/footer.php") ?>