<?php

include_once 'fpdf.php';


class PDF extends FPDF
{

}

// Instanciation of inherited class
$pdf = new PDF('P','mm','LEGAL');
$pdf->AliasNbPages();

$pdf->AddPage();
include 'pages/page1.php';

$pdf->Output();

?>

