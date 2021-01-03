<?php
require('fpdf/fpdf.php');
require 'db2.php';
class PDF extends FPDF
{
function Header()
{
    global $title;
    // Arial bold 15
    $this->SetFont('Arial','B',20);
    // Calculamos ancho y posición del título.
    $w = $this->GetStringWidth($title)+6;
    $this->SetX((297-$w)/2);
    // Colores
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(32,33,79);
    // Título
    $this->Cell($w,9,$title,0,0,'C',true);
    // Fecha
    // Times 13
      $this->SetFont('Arial','I',13);
      // Colores
      $this->SetFillColor(255,255,255);
      $this->SetTextColor(010,010,010);
      global $x;
      $x = $this -> GetStringWidth('Fecha: 12-02-2017')+4;
      $this->SetX(280-$x);
        date_default_timezone_set('America/Lima');

        $fecha = date('Y/m/d');
      $this->Cell($x,9,$fecha,0,1,'C',true);
    // Salto de línea
    $this->Ln(8);
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
    $this->Cell(0,10,'Página '.$this->PageNo(),0,0,'C');
}
function datosEmpresa()
{
  // Times 13
    $this->SetFont('Arial','I',13);
    // Colores
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(010,010,010);
    global $x;
    $x = $this->GetStringWidth('Cliente: ')+6;
    $this->Cell($x,9,'Cliente: ',0,0,'L',true);
    require 'db2.php';
    session_start();
    ob_start();
    $oferta = $_SESSION['idOferta'];
    $consultaCod = "SELECT*FROM oferta_postor WHERE NroOferta = '".$oferta."'";

    $resultadoNombre = mysqli_query($mysqli, $consultaCod);

    $rowNombre = mysqli_fetch_row($resultadoNombre);

    $consultaUsuario = "SELECT*FROM usuario WHERE CodigoUsuario = '".$rowNombre[5]."'";
    $resultadoUsuario = mysqli_query($mysqli, $consultaUsuario);

    $rowUsuario = mysqli_fetch_row($resultadoUsuario);
    $this->Cell(0,9,$rowUsuario[1],0,0,'L',true);
    // Columna 2
    //Número de orden
    
    global $x1;
    $this->Cell($x1,9,'',0,1,'L',true);
    // Fila 2
    global $x2;
    ob_start();
    $oferta = $_SESSION['idOferta'];
    ob_start();
    $requerimiento = $_SESSION['reqOferta'];
    $consulta = "SELECT*FROM oferta_postor WHERE NroOferta = '".$oferta."' AND Requerimiento = '".$requerimiento."'";
    $resultado = $mysqli->query($consulta);


    $resultadoEmail = mysqli_query($mysqli, $consulta);
    $rowEmail = mysqli_fetch_row($resultadoEmail);

    $x2 = $this->GetStringWidth('Email: ')+6;
    $this->Cell($x2,9,'Email: ',0,0,'L',true);
    $this->Cell(0,9,$rowEmail['6'],0,0,'L',true);
    $this->ln(10);
    // Columna 3
    global $x3;
    // Times 15
    //Poner número de servicio
    /*$this->SetFont('Arial','I',15);
    $x3 = $this->GetStringWidth('SERV-1528')+6;
    $this->SetX(270-$x3);
    $this->Cell($x3,13,'SERV-1528',1,1,'L',true);*/
    // Times 13
    $this->SetFont('Arial','I',13);
    $this->Ln(8);

}
function tablaPrimaria()
{
  // Times 12
    $this->SetFont('Arial','I',10);
    // Colores
    $this->SetTextColor(255,255,255);
    $this->SetFillColor(32,33,79);
    // Cabeceras
    global $a;
    $a = $this->GetStringWidth('NROCONVOCATORIA')+20;
    $this->Cell($a,9,'NROCONVOCATORIA',0,0,'C',true);
    $this->SetX($a);
    global $a1;
    $a1 = $this->GetStringWidth('DESCRIPCION DEL SERVICIO')+80;
    $this->Cell($a1,9,'DESCRIPCION DEL SERVICIO',0,0,'C',true);
    $this->SetX($a1+$a);
    global $a2;
    $a2 = $this->GetStringWidth('FECHA INICIO')+8;
    $this->Cell($a2,9,'FECHA INICIO',0,0,'C',true);
    $this->SetX($a1+$a+$a2);
    global $a3;
    $a3 = $this->GetStringWidth('FECHA FIN')+8;
    $this->Cell($a3,9,'FECHA FIN',0,0,'C',true);
    $this->SetX($a1+$a+$a2+$a3);
    global $a4;
    $a4 = $this->GetStringWidth('PRECIO')+8;
    $this->Cell($a4,9,'PRECIO',0,1,'C',true);
    // Filas
    // Colores
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(010,010,010);
    require 'db2.php';
    //session_start();

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

    // Fila 1
    $this->Cell($a,9,$row[5],1,0,'C',true);
    $this->SetX($a);
    $this->Cell($a1,9,utf8_decode($row[1]),1,0,'C',true);
    $this->SetX($a1+$a);
    $this->Cell($a2,9,$row[8],1,0,'C',true);
    $this->SetX($a1+$a+$a2);
    $this->Cell($a3,9,$row[9],1,0,'C',true);
    $this->SetX($a1+$a+$a2+$a3);
    $this->Cell($a4,9,'S/. '.$rowNombre[4],1,1,'C',true);
    $this->ln(10);
  }
  function observacion()
  {
    // Colores
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(010,010,010);
    $this->Cell(0,9,'OBSERVACION:_______________________________',0,1,'L',true);
    $this->Ln(8);
  }
  function total()
  {
    $this->SetFont('Arial','I',16);
    // Colores
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(010,010,010);
    $this->Cell(0,9,'RECIBIDO POR:',0,0,'L',true);
    global $x;
    require 'db2.php';
    //session_start();
    ob_start();
    $requerimiento = $_SESSION['reqOferta'];
    ob_start();
    $oferta = $_SESSION['idOferta'];
    $consultaCod = "SELECT*FROM oferta_postor WHERE NroOferta = '".$oferta."' AND Requerimiento = '".$requerimiento."'";

    $resultadoNombre = mysqli_query($mysqli, $consultaCod);

    $rowNombre = mysqli_fetch_row($resultadoNombre);

    $x = $this->GetStringWidth('SubTotal: ')+8;
    $this->SetX(230-$x);
    $this->Cell($x,9,'SubTotal: ',0,0,'C',true);
    $this->Cell(0,9,'S/. '.$rowNombre[4],1,1,'C',true);
    $this->SetX(230-$x);
    $this->Cell($x,9,'IGV: ',0,0,'C',true);
    $this->Cell(0,9,'S/. '.$rowNombre[4]*0.18,1,1,'C',true);
    $this->SetX(230-$x);
    $this->Cell($x,9,'TOTAL: ',0,0,'C',true);
    $this->Cell(0,9,'S/. '.$rowNombre[4]*1.18,1,1,'C',true);
  }
function PrintChapter()
{
    $this->AddPage();
    $this->datosEmpresa();
    $this->tablaPrimaria();
    $this->observacion();
    $this->total();

}
}

$pdf = new PDF('L');
$title = 'ORDEN DE SERVICIO';
$pdf->SetTitle($title);
$pdf->PrintChapter();
$doc3 = $pdf->Output('', 'S');
$doc2 = $pdf->Output();
ob_start();
$_SESSION['doc3'] = $doc3;
?>