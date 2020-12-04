<?php
    include("db.php");

    if(isset($_GET['id'])){
        $codigo = $_GET['id'];
        $query = "SELECT FROM requerimientos Where CODREQ = '$codigo'";
        $resultado = mysqli_query($conexion, $query);
        if(mysqli_num_rows($resultado) == 1){
            $row = mysqli_fetch_array($resultado);
            $codigo = $row['CODREQ'];
        }
    }

?>