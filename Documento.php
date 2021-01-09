<?php 
include("db.php");
include("includes/header.php");
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        ob_start();
        $_SESSION['reqOferta'] = $id;
        $query = "SELECT*FROM requerimientos Where CODREQ = '".$id."'";
        $resultado = mysqli_query($conexion, $query);
        $row = mysqli_fetch_array($resultado);

        $query1 = "SELECT*FROM oferta_postor WHERE Requerimiento = '".$id."'";
                        //$query = "SELECT MIN(oferta) FROM oferta_postor WHERE Requerimiento = '".$codigo."'";
        $resultado_requerimientos = mysqli_query($conexion, $query1);
        $row1 = mysqli_fetch_array($resultado_requerimientos);
        if(isset($row1)){
            ob_start();
            $_SESSION['idOferta'] = $row1['NroOferta'];
        }
        
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