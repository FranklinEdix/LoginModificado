<?php include("db.php") ?>
<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    require 'db2.php';
    ob_start();
    $requerimiento = $_SESSION['CODREQ2'];
    $consulta1 = "SELECT*FROM requerimientos WHERE CODREQ = '".$requerimiento."'";
    $resultado1 = mysqli_query($mysqli, $consulta1);

    $row = mysqli_fetch_row($resultado1);

    $consultaTipo = "SELECT * FROM tipo WHERE IdTipo= '".$row[2]."'";
    $resultadoTipo = mysqli_query($mysqli, $consultaTipo);

    $rowTipo = mysqli_fetch_row($resultadoTipo);



    $this->Image('src/01.png',12,20,20);
    $this->Ln(20);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    ob_start();
    $requerimiento = $_SESSION['CODREQ2'];
    $this->Cell(80,10,'Reporte de Postor Ganador para el Requerimiento: '.$requerimiento,0,0,'C');
    $this->Ln(5);

    // Salto de línea
    $this->Ln(3);
    $this->Line(20, 45, 190, 45);
    $this->Ln(5);

    $this->SetFont('Arial','',12);
    $this->SetFillColor(219, 219, 219);
    $this->MultiCell(190,10,utf8_decode('Descripción del Requerimiento: '.$row[1]),1,1,'L');
    $this->Ln(3);
    $this->MultiCell(190,10,utf8_decode('Valor de Referencia: '.$row[3]),1,1,'L');
    $this->Ln(3);
    $this->MultiCell(190,10,utf8_decode('Tipo de requerimiento: '.$rowTipo[1]),1,1,'L');
    $this->Ln(3);
    $this->MultiCell(190,10,utf8_decode('Plazo de requerimiento: '.$row[6].' días'),1,1,'L');
    $this->Ln(10);

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
    function LoadData($file)
{
    // Leer las líneas del fichero
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}
}

$pdf = new PDF();
$pdf-> AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

$pdf->ln(5);
$pdf->Cell(0,10,utf8_decode('No existe ninguna oferta disponible'),0,1,'I');
$doc = $pdf->Output('', 'S');
$doc2 = $pdf->Output();
ob_start();
$_SESSION['doc'] = $doc;
?>
