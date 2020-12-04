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
    <h1 class="bad">Error en la autentificación</h1>
    <?php
}

mysqli_free_result($resultado);
mysqli_close($conexion);