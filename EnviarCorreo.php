<?php include("includes/header.php") ?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PhpMailer/Exception.php';
require 'PhpMailer/PHPMailer.php';
require 'PhpMailer/SMTP.php';


if(isset($_GET['id'])){

$id = $_GET['id'];

$mail = new PHPMailer(true);

try {
	require 'db2.php';
    session_start(); 
	ob_start();
    $oferta = $_SESSION['idOferta'];
    ob_start();
    $requerimiento = $_SESSION['reqOferta'];
    $consulta = "SELECT*FROM oferta_postor WHERE NroOferta = '".$oferta."' AND Requerimiento = '".$requerimiento."'";
    $resultado = $mysqli->query($consulta);


    $resultadoEmail = mysqli_query($mysqli, $consulta);
    $rowEmail = mysqli_fetch_row($resultadoEmail);
    //Correo al que se va a enviar que se extrae de la base de datos

    $consultaCod = "SELECT*FROM oferta_postor WHERE NroOferta = '".$oferta."'";

    $resultadoNombre = mysqli_query($mysqli, $consultaCod);

    $rowNombre = mysqli_fetch_row($resultadoNombre);

    $consultaUsuario = "SELECT*FROM usuario WHERE CodigoUsuario = '".$rowNombre[5]."'";
    $resultadoUsuario = mysqli_query($mysqli, $consultaUsuario);

    $rowUsuario = mysqli_fetch_row($resultadoUsuario);

	$mail->SMTPOptions = array(
		'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
		)
	);
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'undacsistema@gmail.com';                     // SMTP username
    $mail->Password   = 'sistemas2021';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('undacsistema@gmail.com', 'UndacSistemas');
     // Add a recipient
    $mail->addAddress($rowEmail[6]);               // Name is optional

    // para que agreges archivos

    	$query = "SELECT*FROM requerimientos Where CODREQ = '".$id."'";
        $resultado = mysqli_query($mysqli, $query);
        $row = mysqli_fetch_array($resultado);
        if($row['TIPREQ'] == 'T001'){
		    ob_start();
		    $doc2 = $_SESSION['doc2'];

		    $mail->AddStringAttachment($doc2,'Compra.pdf', 'base64', 'application/pdf');
        }else{
		    ob_start();
		    $doc3 = $_SESSION['doc3'];

		    $mail->AddStringAttachment($doc3,'Servicio.pdf', 'base64', 'application/pdf');
        }
     /*   
    ob_start();
    $doc = $_SESSION['doc'];
    ob_start();
    $doc2 = $_SESSION['doc2'];
    ob_start();
    $doc3 = $_SESSION['doc3'];
    $mail->AddStringAttachment($doc,'Datos.pdf', 'base64', 'application/pdf');
    $mail->AddStringAttachment($doc2,'Compra.pdf', 'base64', 'application/pdf');
    $mail->AddStringAttachment($doc3,'Servicio.pdf', 'base64', 'application/pdf'); */      // Add attachments
       // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = utf8_decode('Documentos de formalización el contrato de servicios o compra de bienes');
    $mail->Body    = utf8_decode('Muy buenas, dejo adjuntado los documentos que validan el contrato att: <b>SistemasUndac</b>');

    $mail->send();?>
    <center><h1 style="color: #fff; margin: 200px 150px 100px 150px; padding: 50px; background: rgb(0, 120, 0, .6); border-radius: 10px;">Correo enviado exitosamente</h1></center>;
    <?php 
} catch (Exception $e) {?>
    <center><h1 style="color: #fff; margin: 200px 150px 100px 150px; padding: 50px; background: rgb(245, 0, 0, .6); border-radius: 10px;">Correo no enviado</h1></center>;
    <?php
}
}
?>
<?php include("includes/footer.php") ?>