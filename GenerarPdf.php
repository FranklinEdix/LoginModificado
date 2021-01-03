<?php
// generando el pdf
 //este archivo contiene el encabezado y pie de pagina del pdf
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,10,'Hola mundo!');
$doc = $pdf->Output('', 'S');
 
// haciendo referencia a la clase phpmailer
require 'PhpMailes/class.phpmailer.php';
 
$mail = new PHPMailer();
$mail->From = 'remitente@dominio.com';
$mail->FromName = 'Nombre remitente';
$mail->Subject = 'Allegato in PDF';
$mail->Body = 'Se adjunta el reporte en pdf';
$mail->AddAddress('mail@mail.com');
 
// definiendo el adjunto 
$mail->AddStringAttachment($doc, 'doc.pdf', 'base64', 'application/pdf');
// enviando
$mail->Send();
?>