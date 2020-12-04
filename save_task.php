<?php
include("db.php"); 
    if(isset($_POST['save_task'])){
        $codigo = $_POST['codigo'];
        $descripcion = $_POST['descripción'];
        $tipo = $_POST['tipo'];
        $valor_ref = $_POST['valorref'];
        $ncc = $_POST['ncc'];
        $nro_conv = $_POST['nroconv'];
        $plazo_dias = $_POST['plazo'];
        $f_conv = $_POST['fconv'];
        $inicio = $_POST['inicio'];
        $fin = $_POST['fin'];
   
        $query = "INSERT INTO requerimientos(CODREQ, DESREQ, TIPREQ, VREFREQ, NCCPREQ, NCONVREQ, PLAZOREQ, FCONREQ, FICREQ, FFCREQ) 
        VALUES ('$codigo', '$descripcion', '$tipo', '$valor_ref', '$ncc', '$nro_conv', '$plazo_dias', '$f_conv', '$inicio', '$fin')";

        $resultado = mysqli_query($conexion, $query);

        if(!$resultado){
            die("Query Falied");
        }

        $_SESSION['message'] = 'Guardado satisfactoriamente';
        $_SESSION['message_type'] = 'success';

        header("Location: home.php");
    }
?>