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

    echo $rowEmail['6'];

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
    $mail->addAddress('festradam07@gmail.com', 'Franklin');               // Name is optional

    // para que agreges archivos

    	$query = "SELECT*FROM requerimientos Where CODREQ = '".$id."'";
        $resultado = mysqli_query($mysqli, $query);
        $row = mysqli_fetch_array($resultado);
        if($row['TIPREQ'] == 'T001'){
            ob_start();
		    $doc = $_SESSION['doc'];
		    ob_start();
		    $doc2 = $_SESSION['doc2'];

		    $mail->AddStringAttachment($doc,'Datos.pdf', 'base64', 'application/pdf');
		    $mail->AddStringAttachment($doc2,'Compra.pdf', 'base64', 'application/pdf');
        }else{
            ob_start();
		    $doc = $_SESSION['doc'];
		    ob_start();
		    $doc3 = $_SESSION['doc3'];

		    $mail->AddStringAttachment($doc,'Datos.pdf', 'base64', 'application/pdf');
		    $mail->AddStringAttachment($doc3,'Servicio.pdf', 'base64', 'application/pdf');
        }
    /*ob_start();
    $doc = $_SESSION['doc'];
    ob_start();
    $doc2 = $_SESSION['doc2'];
    ob_start();
    $doc3 = $_SESSION['doc3'];

    $mail->AddStringAttachment($doc,'Datos.pdf', 'base64', 'application/pdf');
    $mail->AddStringAttachment($doc2,'Compra.pdf', 'base64', 'application/pdf');
    $mail->AddStringAttachment($doc3,'Servicio.pdf', 'base64', 'application/pdf'); */       // Add attachments
       // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Primer mensaje desde el sistema PHP';
    $mail->Body    = 'Primer mensaje desde el sistema PHP <b>SistemasUndac</b>';

    $mail->send();
    echo 'Mensaje enviado'.$id;

} catch (Exception $e) {
    echo "Mensaje no enviado: {$mail->ErrorInfo}";
}
}
?>
<?php include("includes/footer.php") ?>