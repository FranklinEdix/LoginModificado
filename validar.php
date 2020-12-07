<?php

$usuario=$_POST['usuario'];
$contraseña=$_POST['clave'];
$rol=$_POST['tiposreq'];
session_start();

$_SESSION['usuario']=$usuario;

$conexion=mysqli_connect("localhost","root", "","usuario");

$consulta="SELECT*FROM usuario where CodigoUsuario='$usuario' and ClaveUsuario='$contraseña' and RolUsuario='$rol'";
$resultado=mysqli_query($conexion,$consulta);

$filas=mysqli_num_rows($resultado);

if($filas){
    header("location:home.php");
}else{
    ?>
    <?php
    include("index.php");
    ?>
    <center>
    <h1 class="bad" style="Color: red;">Error en la autentificación</h1>
    </center>
    <?php
}

mysqli_free_result($resultado);
mysqli_close($conexion);