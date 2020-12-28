<?php 
include("db.php");
include("includes/header.php");
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "SELECT*FROM requerimientos Where CODREQ = '$id'";
        $resultado = mysqli_query($conexion, $query);
        $row = mysqli_fetch_array($resultado);
        if($row['Estado'] == 1){
            echo "Requerimiento Vigente espere al periodo de finalizacion";
        }else{
            $query = "SELECT*FROM requerimientos Where CODREQ = '$id'";
            $resultado = mysqli_query($conexion, $query);
            $row = mysqli_fetch_array($resultado);
            if($row['TIPREQ'] == "T001"){
                header("Location: OrdenDeCompra.php");
            }else{
                header("Location: OrdenDeServicio.php");
            }
        }

    }
include("includes/footer.php"); ?>