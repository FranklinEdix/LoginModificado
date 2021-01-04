<?php 
include("db.php");
include("includes/header.php");
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "SELECT*FROM requerimientos Where CODREQ = '$id'";
        $resultado = mysqli_query($conexion, $query);
        $row = mysqli_fetch_array($resultado);
        if($row['Estado'] == 1){?>
            <center><h1 style="color: #fff; margin: 200px 150px 100px 150px; padding: 50px; background: rgb(120, 0, 0, .6); border-radius: 10px;">Requerimiento vigente, espere al periodo de finalizacion</h1></center>;
        <?php
        }
        else{
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