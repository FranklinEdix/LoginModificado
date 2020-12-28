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
        $queryTipo = "SELECT*FROM tipo where IdTipo = '$tipo'";
        $result = mysqli_query($conexion, $queryTipo); 

        $row = mysqli_fetch_array($result);

        $TipoName = $row['NombreTipo'];

        date_default_timezone_set('America/Lima');

        $fechaActual = date('Y-m-d');

        if($f_conv == $fechaActual){

        if($inicio >= $fechaActual){

        if($fin > $inicio){

        $query = "INSERT INTO requerimientos(CODREQ, DESREQ, TIPREQ, VREFREQ, NCCPREQ, NCONVREQ, PLAZOREQ, FCONREQ, FICREQ, FFCREQ, Estado) 
        VALUES ('$codigo', '$descripcion', '$tipo', '$valor_ref', '$ncc', '$nro_conv', '$plazo_dias', '$f_conv', '$inicio', '$fin', '1')";

        $resultado = mysqli_query($conexion, $query);

        if(!$resultado){
            die("Query Falied");
        }

        $_SESSION['message'] = 'Guardado satisfactoriamente';
        $_SESSION['message_type'] = 'success';

        header("Location: home.php");
        }else{
            die("Fechas no incoherentes");
        }
        }else{
            die("Fechas de inicio pasada");
        }
        }else{
            die("Fechas de convocatoria debe de ser hoy");
        }
    }
?>