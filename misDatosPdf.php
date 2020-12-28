 <?php include("db.php") ?>
<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(80,10,'Reporte de Postores',0,0,'C');
    // Salto de línea
    $this->Ln(20);

    $this->Cell(35, 10, 'NroOferta', 1, 0, 'C', 0);
    $this->Cell(45, 10, 'Requerimiento', 1, 0, 'C', 0);
    $this->Cell(45, 10, 'RucRazonSocial', 1, 0, 'C', 0);
    $this->Cell(35, 10, 'NroCel', 1, 0, 'C', 0);
    $this->Cell(35, 10, 'Oferta', 1, 1, 'C', 0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

require 'db2.php';

$consulta = "SELECT*FROM oferta_postor";
$resultado = $mysqli->query($consulta);

$pdf = new PDF();
$pdf-> AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

while($row = $resultado->fetch_assoc()){
    $pdf->Cell(35, 10, $row['NroOferta'], 1, 0, 'C', 0);
    $pdf->Cell(45, 10, $row['Requerimiento'], 1, 0, 'C', 0);
    $pdf->Cell(45, 10, $row['RucRazonSocial'], 1, 0, 'C', 0);
    $pdf->Cell(35, 10, $row['NroCel'], 1, 0, 'C', 0);
    $pdf->Cell(35, 10, $row['Oferta'], 1, 1, 'C', 0);
}


$pdf->Output();
?>

