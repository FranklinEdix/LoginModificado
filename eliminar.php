<?php
    include("db.php");

    if(isset($_GET['id'])){
        $codigo = $_GET['id'];
        $query = "DELETE FROM requerimientos Where CODREQ = '$codigo'";
        $resultado = mysqli_query($conexion, $query);
        if(!$resultado){
            die("Query Falied");
        }

    $_SESSION['message'] = 'Eliminado satisfactoriamente';
    $_SESSION['message_type'] = 'danger';

    header("Location: home.php");

    }

?>