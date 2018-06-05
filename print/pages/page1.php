<?php
$marginTop1 = 2;

$pdf->SetFont('Arial','BI',8);
/*$pdf->SetXY(3,$marginTop1);
$pdf->Cell(210,274,'ruseltamayotayong','TLR',0,'L',false);*/
//$pdf->Image(__DIR__.'/../images/id-template.jpg', 40, 20,60,60);
$pdf->Cell( 40, 40, $pdf->Image(__DIR__.'/../images/id-template.jpg', $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false );

?>