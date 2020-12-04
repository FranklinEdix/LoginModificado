<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
    <form action="validar.php" method="post">
        <h1>Sistema de Login</h1>
        <p>Rol
            

            <label><select name="tiposreq" id="sl">
			<?php
                
                    $conn = mysqli_connect("localhost","root","","usuario") or die ("error al conectar");
                  $query = $conn -> query ("SELECT * FROM rol");
                  while ($valores = mysqli_fetch_array($query)) {
                    echo '<option value="'.$valores['IdRol'].'">'.$valores['NombreRol'].'</option>';
                  }
                  mysqli_close($conn);
                ?>
             </select>
            <!--
            <select name="sel" rel="tooltip" placeholder="Seleccione su rol">
            <option value=" " name="admin">ADMIN</option>
            <option value=" " name="logistica">LOGISTICA</option>
            <option value=" " name="postor">POSTOR</option>
            </select>
            -->
        </p>
        <p>Usuario <input type="text" placeholder="Ingrese su código de Usuario" name="usuario" </p>
        <p>Clave <input type="password" placeholder="Ingrese su código de contraseña" name="clave" </p> <br>
        <input type="submit" value="Ingresar">             
    </form>
    <!--Script-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>