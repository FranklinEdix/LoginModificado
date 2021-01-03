<?php
require('fpdf/fpdf.php');
require ('db2.php');

class PDF extends FPDF
{
function Header()
{
    global $title;
    // Arial bold 15
    $this->SetFont('Arial','B',16);
    // Calculamos ancho y posición del título.
    $w = $this->GetStringWidth($title)+6;
    $this->SetX(200-$w);
    // Colores
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(15,145,31);
    // Título
    $this->Cell($w,9,$title,0,0,'I',true);
    //Fecha
    $this->SetFont('Arial','I',13);
      // Colores
      $this->SetFillColor(255,255,255);
      $this->SetTextColor(010,010,010);
      global $x;
      $x = $this -> GetStringWidth('Fecha: 12-02-2017')+4;
      $this->SetX(52-$x);
        date_default_timezone_set('America/Lima');

        $fecha = date('Y/m/d');
      $this->Cell($x,9,$fecha,0,1,'I',true);
    // Salto de línea
    $this->Ln(10);
}
function Footer()
{
    // Posición a 1,5 cm del final
    $this->SetY(-15);
    // Arial itálica 8
    $this->SetFont('Arial','I',8);
    // Color del texto en gris
    $this->SetTextColor(128);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo(),0,0,'C');
}
function datosEmpresa()
{
  // Times 12
    $this->SetFont('Arial','I',10);
    // Colores
    $this->SetTextColor(255,255,255);
    $this->SetFillColor(15,145,31);
    global $x;
    $x = $this->GetStringWidth('EMPRESA CONTRATISTA')+40;
    $this->Cell($x,9,'EMPRESA CONTRATISTA',0,1,'C',true);
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(010,010,010);
    $this->Cell(0,9,'Email: sistemas@unadac.edu.pe',0,1,'L',true)+6;
    $this->Cell(0,9,'Telefono: 963852741',0,1,'L',true)+6;
    $this->Cell(0,9,'RUC: 75395142635',0,1,'L',true);
    $this->Ln();

}

function datosProovedor()
{
    require ('db2.php');
    session_start();
    ob_start();
    $oferta = $_SESSION['idOferta'];
    $consultaCod = "SELECT*FROM oferta_postor WHERE NroOferta = '".$oferta."'";

    $resultadoNombre = mysqli_query($mysqli, $consultaCod);

    $rowNombre = mysqli_fetch_row($resultadoNombre);

    $consultaUsuario = "SELECT*FROM usuario WHERE CodigoUsuario = '".$rowNombre[5]."'";
    $resultadoUsuario = mysqli_query($mysqli, $consultaUsuario);

    $rowUsuario = mysqli_fetch_row($resultadoUsuario);

    global $x2;
    ob_start();
    $oferta = $_SESSION['idOferta'];
    ob_start();
    $requerimiento = $_SESSION['reqOferta'];
    $consulta = "SELECT*FROM oferta_postor WHERE NroOferta = '".$oferta."' AND Requerimiento = '".$requerimiento."'";
    $resultado = $mysqli->query($consulta);


    $resultadoEmail = mysqli_query($mysqli, $consulta);
    $rowEmail = mysqli_fetch_row($resultadoEmail);
  // Times 12
    $this->SetFont('Arial','I',10);
    // Colores
    $this->SetTextColor(255,255,255);
    $this->SetFillColor(15,145,31);
    // Contenido 1
    global $x;
    $x = $this->GetStringWidth('POSTOR')+40;
    $this->Cell($x,9,'POSTOR',0,1,'C',true);
    // Contenido 2
    /*global $z;
    $z = $this->GetStringWidth('ENVIAR A')+40;
    $this->SetX(210/2);
    $this->Cell($z,9,'ENVIAR A',0,1,'C',true);*/
    // Colores

    $this->SetFillColor(255,255,255);
    $this->SetTextColor(010,010,010);
    global $x4;
    $x4 = $this->GetStringWidth('RUC: ')+6;
    $this->Cell($x4,9,'RUC: ',0,0,'L',true);
    $this->Cell(0,9,$rowEmail['2'],0,1,'L',true);
    // Columna 2
    global $x1;
    $x1 = $this->GetStringWidth('Nombre: ')+6;
    $this->Cell($x1,9,'Nombre: ',0,0,'L',true);
    $this->Cell(0,9,$rowUsuario[1],0,1,'L',true);
    global $x3;
    $x3 = $this->GetStringWidth('Telefono: ')+6;
    $this->Cell($x3,9,'Telefono: ',0,0,'L',true);
    $this->Cell(0,9,$rowEmail['3'],0,1,'L',true);
    // Columna 3
    $x2 = $this->GetStringWidth('Email: ')+6;
    $this->Cell($x2,9,'Email: ',0,0,'L',true);
    $this->Cell(0,9,$rowEmail['6'],0,1,'L',true);
    $this->Ln(10);
}
/*
function solicitante()
{
  // Times 12
    $this->SetFont('Arial','I',10);
    // Colores
    $this->SetTextColor(255,255,255);
    $this->SetFillColor(15,145,31);
    // Cabeceras
    global $y;
    $y = $this->GetStringWidth('SOLICITANTE')+30;
    $this->Cell($y,9,'SOLICITANTE',0,0,'C',true);
    $this->SetX($y);
    global $y1;
    $y1 = $this->GetStringWidth('ENVIAR VIA')+30;
    $this->Cell($y1,9,'ENVIAR VIA',0,0,'C',true);
    $this->SetX($y1+$y);
    global $y2;
    $y2 = $this->GetStringWidth('CONDICIONES DE ENVIO')+30;
    $this->Cell($y2,9,'CONDICIONES DE ENVIO',0,1,'C',true);
    // Filas
    // Colores
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(010,010,010);
    $this->Cell($y,9,'DATO',1,0,'C',true);
    $this->SetX($y);
    $this->Cell($y1,9,'DATO',1,0,'C',true);
    $this->SetX($y1+$y);
    $this->Cell($y2,9,'DATO',1,1,'C',true);
    $this->Ln();
}
*/
function tablaPrimaria()
{
  // Times 12
    $this->SetFont('Arial','I',10);
    // Colores
    $this->SetTextColor(255,255,255);
    $this->SetFillColor(15,145,31);
    // Cabeceras
    global $a;
    $a = $this->GetStringWidth('NROCONVOCATORIA')+20;
    $this->Cell($a,9,'NROCONVOCATORIA',0,0,'C',true);
    $this->SetX($a);
    global $a1;
    $a1 = $this->GetStringWidth('DESCRIPCION')+80;
    $this->Cell($a1,9,'DESCRIPCION',0,0,'C',true);
    $this->SetX($a1+$a);
    global $a2;
    $a2 = $this->GetStringWidth('PRECIO')+4;
    $this->Cell($a2,9,'PRECIO',0,1,'C',true);
    /*global $a3;
    $a3 = $this->GetStringWidth('PRECIO UNIT.')+4;
    $this->Cell($a3,9,'PRECIO UNIT.',0,0,'C',true);
    $this->SetX($a1+$a+$a2+$a3);
    global $a4;
    $a4 = $this->GetStringWidth('TOTAL')+4;
    $this->Cell($a4,9,'TOTAL',0,1,'C',true);*/
    // Filas
    // Colores
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(010,010,010);
    // Fila 1
    require 'db2.php';
    session_start();
    ob_start();
    $requerimiento = $_SESSION['reqOferta'];
    $consulta1 = "SELECT*FROM requerimientos WHERE CODREQ = '".$requerimiento."'";
    $resultado1 = mysqli_query($mysqli, $consulta1);

    $row = mysqli_fetch_row($resultado1);

    ob_start();
    $oferta = $_SESSION['idOferta'];
    $consultaCod = "SELECT*FROM oferta_postor WHERE NroOferta = '".$oferta."' AND Requerimiento = '".$requerimiento."'";

    $resultadoNombre = mysqli_query($mysqli, $consultaCod);

    $rowNombre = mysqli_fetch_row($resultadoNombre);

    $this->Cell($a,9,$row[5],1,0,'C',true);
    $this->SetX($a);
    $this->Cell($a1,9,utf8_decode($row[1]),1,0,'C',true);
    $this->SetX($a1+$a);
    $this->Cell($a2,9,'S/. '.$rowNombre[4],1,0,'C',true);
    $this->SetX($a1+$a);
    // Salto de linea
    $this->Ln(10);
    $this->Ln(10);
    // Total
    // Colores
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(010,010,010);
    $this->SetX($a1);
    // Filas
    require 'db2.php';
    session_start();

    ob_start();
    $requerimiento = $_SESSION['reqOferta'];
    ob_start();
    $oferta = $_SESSION['idOferta'];
    $consultaCod = "SELECT*FROM oferta_postor WHERE NroOferta = '".$oferta."' AND Requerimiento = '".$requerimiento."'";

    $resultadoNombre = mysqli_query($mysqli, $consultaCod);

    $rowNombre = mysqli_fetch_row($resultadoNombre);

    global $b;
    $b = $this->GetStringWidth('SUBTOTAL')+4;
    $this->Cell($b,9,'SUBTOTAL: ',0,0,'C',true);
    $this->SetX($a1+$a+$a2 - $b-3);
    $this->Cell($b,9,'S/. '.$rowNombre[4],0,1,'R',true);
    $this->SetX($a1);
    global $b1;
    $b1 = $this->GetStringWidth('IGV')+4;
    $this->Cell($b1,9,'IGV: ',0,0,'C',true);
    $this->SetX($a1+$a+$a2 - $b1-3);
    $this->Cell($b1,9,'S/. '.$rowNombre[4]*0.18,0,1,'R',true);
    $this->SetX($a1);
    global $b2;
    $b2 = $this->GetStringWidth('TOTAL')+4;
    $this->Cell($b2,9,'TOTAL: ',0,0,'C',true);
    $this->SetX($a1+$a+$a2 - $b2-3);
    $this->Cell($b2,9,'S/. '.$rowNombre[4]*1.18,0,1,'R',true);
    $this->SetX($a1);
    $this->Ln(10);
  }


function PrintChapter()
{
    $this->AddPage();
    $this->datosEmpresa();
    $this->datosProovedor();
    /*$this->solicitante();*/
    $this->tablaPrimaria();
}
}

$pdf = new PDF( );
$title = 'ORDEN DE COMPRA';
$pdf->SetTitle($title);
$pdf->PrintChapter();
$pdf->Output();
?>