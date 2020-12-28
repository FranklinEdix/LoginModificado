<?php
require('fpdf/fpdf.php');

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
    $this->Cell($w,9,$title,0,1,'C',true);
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
    $this->Cell(0,10,'Página '.$this->PageNo(),0,0,'C');
}
function datosEmpresa()
{
  // Times 12
    $this->SetFont('Arial','I',10);
    // Colores
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(010,010,010);
    $this->Cell(0,9,'Direccion',0,1,'L',true);
    $this->Cell(0,9,'Ciudad',0,1,'L',true);
    $this->Cell(0,9,'Telefono',0,1,'L',true);
    $this->Cell(0,9,'Email',0,1,'L',true);
    $this->Ln();

}

function datosProovedor()
{
  // Times 12
    $this->SetFont('Arial','I',10);
    // Colores
    $this->SetTextColor(255,255,255);
    $this->SetFillColor(15,145,31);
    // Contenido 1
    global $x;
    $x = $this->GetStringWidth('PROOVEDOR')+40;
    $this->Cell($x,9,'PROOVEDOR',0,0,'C',true);
    // Contenido 2
    global $z;
    $z = $this->GetStringWidth('ENVIAR A')+40;
    $this->SetX(210/2);
    $this->Cell($z,9,'ENVIAR A',0,1,'C',true);
    // Colores
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(010,010,010);
    $this->Cell(0,9,'Empresa',0,0,'L',true);
    // Columna 2
    $this->SetX(210/2);
    $this->Cell(0,9,'Nombre',0,1,'L',true);
    $this->Cell(0,9,'Departamento',0,0,'L',true);
    // Columna 3
    $this->SetX(210/2);
    $this->Cell(0,9,'Empresa',0,1,'L',true);
    $this->Cell(0,9,'Direccion',0,0,'L',true);
    // Columna 4
    $this->SetX(210/2);
    $this->Cell(0,9,'Direccion',0,1,'L',true);
    $this->Cell(0,9,'Telefono',0,0,'L',true);
    // Columna 5
    $this->SetX(210/2);
    $this->Cell(0,9,'Telefono',0,1,'L',true);
    $this->Cell(0,9,'Email',0,1,'L',true);
    $this->Ln();
}

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
function tablaPrimaria()
{
  // Times 12
    $this->SetFont('Arial','I',10);
    // Colores
    $this->SetTextColor(255,255,255);
    $this->SetFillColor(15,145,31);
    // Cabeceras
    global $a;
    $a = $this->GetStringWidth('CODIGO')+20;
    $this->Cell($a,9,'CODIGO',0,0,'C',true);
    $this->SetX($a);
    global $a1;
    $a1 = $this->GetStringWidth('DESCRIPCION')+80;
    $this->Cell($a1,9,'DESCRIPCION',0,0,'C',true);
    $this->SetX($a1+$a);
    global $a2;
    $a2 = $this->GetStringWidth('CANT.')+4;
    $this->Cell($a2,9,'CANT.',0,0,'C',true);
    $this->SetX($a1+$a+$a2);
    global $a3;
    $a3 = $this->GetStringWidth('PRECIO UNIT.')+4;
    $this->Cell($a3,9,'PRECIO UNIT.',0,0,'C',true);
    $this->SetX($a1+$a+$a2+$a3);
    global $a4;
    $a4 = $this->GetStringWidth('TOTAL')+4;
    $this->Cell($a4,9,'TOTAL',0,1,'C',true);
    // Filas
    // Colores
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(010,010,010);
    // Fila 1
    $this->Cell($a,9,'DATO',1,0,'C',true);
    $this->SetX($a);
    $this->Cell($a1,9,'DATO',1,0,'C',true);
    $this->SetX($a1+$a);
    $this->Cell($a2,9,'DATO',1,0,'C',true);
    $this->SetX($a1+$a+$a2);
    $this->Cell($a3,9,'DATO',1,0,'C',true);
    $this->SetX($a1+$a+$a2+$a3);
    $this->Cell($a4,9,'DATO',1,1,'C',true);
    // Fila 2
    $this->Cell($a,9,'DATO',1,0,'C',true);
    $this->SetX($a);
    $this->Cell($a1,9,'DATO',1,0,'C',true);
    $this->SetX($a1+$a);
    $this->Cell($a2,9,'DATO',1,0,'C',true);
    $this->SetX($a1+$a+$a2);
    $this->Cell($a3,9,'DATO',1,0,'C',true);
    $this->SetX($a1+$a+$a2+$a3);
    $this->Cell($a4,9,'DATO',1,1,'C',true);
    // Fila 3
    $this->Cell($a,9,'DATO',1,0,'C',true);
    $this->SetX($a);
    $this->Cell($a1,9,'DATO',1,0,'C',true);
    $this->SetX($a1+$a);
    $this->Cell($a2,9,'DATO',1,0,'C',true);
    $this->SetX($a1+$a+$a2);
    $this->Cell($a3,9,'DATO',1,0,'C',true);
    $this->SetX($a1+$a+$a2+$a3);
    $this->Cell($a4,9,'DATO',1,1,'C',true);
    // Fila 4
    $this->Cell($a,9,'DATO',1,0,'C',true);
    $this->SetX($a);
    $this->Cell($a1,9,'DATO',1,0,'C',true);
    $this->SetX($a1+$a);
    $this->Cell($a2,9,'DATO',1,0,'C',true);
    $this->SetX($a1+$a+$a2);
    $this->Cell($a3,9,'DATO',1,0,'C',true);
    $this->SetX($a1+$a+$a2+$a3);
    $this->Cell($a4,9,'DATO',1,1,'C',true);
    // Fila 5
    $this->Cell($a,9,'DATO',1,0,'C',true);
    $this->SetX($a);
    $this->Cell($a1,9,'DATO',1,0,'C',true);
    $this->SetX($a1+$a);
    $this->Cell($a2,9,'DATO',1,0,'C',true);
    $this->SetX($a1+$a+$a2);
    $this->Cell($a3,9,'DATO',1,0,'C',true);
    $this->SetX($a1+$a+$a2+$a3);
    $this->Cell($a4,9,'DATO',1,1,'C',true);
    // Salto de linea
    $this->Ln();
    // Total
    // Colores
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(010,010,010);
    $this->SetX($a1+$a);
    // Filas
    global $b;
    $b = $this->GetStringWidth('SUBTOTAL')+4;
    $this->Cell($b,9,'SUBTOTAL',0,0,'C',true);
    $this->SetX($a1+$a+$a2+$a3 - $b+15);
    $this->Cell($b,9,'Dato',0,1,'R',true);
    $this->SetX($a1+$a);
    global $b1;
    $b1 = $this->GetStringWidth('% IMPUESTO')+4;
    $this->Cell($b1,9,'% IMPUESTO',0,0,'C',true);
    $this->SetX($a1+$a+$a2+$a3 - $b1+15);
    $this->Cell($b1,9,'Dato',0,1,'R',true);
    $this->SetX($a1+$a);
    global $b2;
    $b2 = $this->GetStringWidth('IMPUESTO')+4;
    $this->Cell($b2,9,'IMPUESTO',0,0,'C',true);
    $this->SetX($a1+$a+$a2+$a3 - $b2+15);
    $this->Cell($b2,9,'Dato',0,1,'R',true);
    $this->SetX($a1+$a);
    global $b3;
    $b3 = $this->GetStringWidth('TOTAL')+4;
    $this->Cell($b3,9,'TOTAL',0,0,'C',true);
    $this->SetX($a1+$a+$a2+$a3- $b3+15);
    $this->Cell($b3,9,'Dato',0,1,'R',true);
  }
function PrintChapter()
{
    $this->AddPage();
    $this->datosEmpresa();
    $this->datosProovedor();
    $this->solicitante();
    $this->tablaPrimaria();
}
}

$pdf = new PDF();
$title = 'ORDEN DE COMPRA';
$pdf->SetTitle($title);
$pdf->PrintChapter();
$pdf->Output();
?>