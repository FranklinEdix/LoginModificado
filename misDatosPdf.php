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
    $requerimiento = $_SESSION['reqOferta'];
    $consulta1 = "SELECT*FROM requerimientos WHERE CODREQ = '".$requerimiento."'";
    $resultado1 = mysqli_query($mysqli, $consulta1);

    $row = mysqli_fetch_row($resultado1);

    $consultaTipo = "SELECT * FROM tipo WHERE IdTipo= '".$row[2]."'";
    $resultadoTipo = mysqli_query($mysqli, $consultaTipo);

    $rowTipo = mysqli_fetch_row($resultadoTipo);

    $oferta = $_SESSION['idOferta'];
    $consultaCod = "SELECT*FROM oferta_postor WHERE NroOferta = '".$oferta."'";

    $resultadoNombre = mysqli_query($mysqli, $consultaCod);

    $rowNombre = mysqli_fetch_row($resultadoNombre);

    $consultaUsuario = "SELECT*FROM usuario WHERE CodigoUsuario = '".$rowNombre[5]."'";
    $resultadoUsuario = mysqli_query($mysqli, $consultaUsuario);

    $rowUsuario = mysqli_fetch_row($resultadoUsuario);

    $this->Image('src/01.png',12,20,20);
    $this->Ln(20);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    ob_start();
    $requerimiento = $_SESSION['reqOferta'];
    $this->Cell(80,10,'Reporte de Postor Ganador para el Requerimiento: '.$requerimiento,0,0,'C');
    $this->Ln(5);
    $this->Cell(180,10,utf8_decode('Señor(a) postor: '.$rowUsuario[1]),0,1,'C');
    // Salto de línea
    $this->Ln(3);
    $this->Line(20, 45, 190, 45);

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

    $this->Cell(0,10,utf8_decode('Datos del Postor '),0,1,'C');

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
require 'db2.php';

ob_start();
$oferta = $_SESSION['idOferta'];
ob_start();
$requerimiento = $_SESSION['reqOferta'];
$consulta = "SELECT*FROM oferta_postor WHERE NroOferta = '".$oferta."' AND Requerimiento = '".$requerimiento."'";
$resultado = $mysqli->query($consulta);


$resultadoEmail = mysqli_query($mysqli, $consulta);
$rowEmail = mysqli_fetch_row($resultadoEmail);

$pdf = new PDF();
$pdf-> AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

while($row = $resultado->fetch_assoc()){
    $pdf->Cell(35, 10, $row['NroOferta'], 1, 0, 'C', 0);
    $pdf->Cell(45, 10, $row['Requerimiento'], 1, 0, 'C', 0);
    $pdf->Cell(45, 10, $row['RucRazonSocial'], 1, 0, 'C', 0);
    $pdf->Cell(35, 10, $row['NroCel'], 1, 0, 'C', 0);
    $pdf->Cell(35, 10, 'S/. '.$row['Oferta'], 1, 1, 'C', 0);
}
$pdf->ln(5);
$pdf->Cell(0,10,utf8_decode('La información sera enviada a este Email: ').$rowEmail['6'],0,1,'I');
$doc = $pdf->Output('', 'S');
$doc2 = $pdf->Output();
ob_start();
$_SESSION['doc'] = $doc;
?>

