<?php
include("db.php");

    if(isset($_POST['save_task_postor'])){
        $requerimientos = $_POST['Req'];
        $ruc = $_POST['RucRsocial'];
        $cel = $_POST['Nrocel'];
        $oferta = $_POST['oferta'];
        $correo = $_POST['Correo'];
        $id = $_POST['Req'];

        date_default_timezone_set('America/Lima');

        $fecha = date('Y/m/d');

        ob_start();
        $CodUsuario = $_SESSION['usuario1'];

        $NumPropuestas = "SELECT COUNT(*) AS 'uno' FROM oferta_postor WHERE Requerimiento='".$id."'";

        $resultado0 = mysqli_query($conexion, $NumPropuestas);

        $row = mysqli_fetch_array($resultado0);
        
        $NroOferta = $row['uno'] + 1;

        $query = "INSERT INTO oferta_postor(NroOferta,Requerimiento, RucRazonSocial, NroCel, CodUsuario, Oferta, Correo, FechaOferta) 
        VALUES ('$NroOferta','$requerimientos', '$ruc', '$cel', '$CodUsuario', '$oferta', '$correo', '$fecha')";



        $resultado = mysqli_query($conexion, $query);

        if(!$resultado){
            die("Query Falied");
        }

        $_SESSION['message'] = 'Guardado satisfactoriamente';
        $_SESSION['message_type'] = 'success';
        
        header("Location: HomePostor.php");
    }
?>