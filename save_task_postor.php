<?php
include("db.php"); 
    if(isset($_POST['save_task_postor'])){
        $requerimientos = $_POST['Req'];
        $ruc = $_POST['RucRsocial'];
        $cel = $_POST['Nrocel'];
        $oferta = $_POST['oferta'];

        $query = "INSERT INTO oferta_postor(Requerimiento, RucRazonSocial, NroCel, Oferta) 
        VALUES ('$requerimientos', '$ruc', '$cel', '$oferta')";

        $resultado = mysqli_query($conexion, $query);

        if(!$resultado){
            die("Query Falied");
        }

        $_SESSION['message'] = 'Guardado satisfactoriamente';
        $_SESSION['message_type'] = 'success';

        header("Location: HomePostor.php");
    }
?>