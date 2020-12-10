<?php
include("db.php"); 
    if(isset($_POST['save_task_postor'])){
        $requerimientos = $_POST['Req'];
        $ruc = $_POST['RucRsocial'];
        $cel = $_POST['Nrocel'];
        $oferta = $_POST['oferta'];
        $nro_oferta = $_POST['nro_oferta'];

        $query = "INSERT INTO oferta_postor(NroOferta,Requerimiento, RucRazonSocial, NroCel, Oferta) 
        VALUES ('$nro_oferta','$requerimientos', '$ruc', '$cel', '$oferta')";

        $resultado = mysqli_query($conexion, $query);

        if(!$resultado){
            die("Query Falied");
        }

        $_SESSION['message'] = 'Guardado satisfactoriamente';
        $_SESSION['message_type'] = 'success';

        header("Location: HomePostor.php");
    }
?>