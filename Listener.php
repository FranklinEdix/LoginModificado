<?php 
	include("db.php"); 
	
	$id = $_POST['IdSelect'];


    $NumPropuestas = "SELECT COUNT(*) AS 'uno' FROM oferta_postor WHERE Requerimiento='".$id."'";

    $resultado = mysqli_query($conexion, $NumPropuestas);
	 
	 while($row = mysqli_fetch_array($resultado))
	  {
	      $consult = $row;
	  }

    echo json_encode($consult, JSON_FORCE_OBJECT);
?> 