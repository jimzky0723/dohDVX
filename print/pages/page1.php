<?php

$pdf->SetFont('Arial','BI',8);
$pdf->SetXY(3,2);
$pdf->Cell(210,274,$pdf->Image(__DIR__.'/../images/id_template.png', $pdf->GetX(), $pdf->GetY(), 100,60),'1',0,'L',false);
$pdf->SetXY(29,12);
$pdf->Cell(0,0,$pdf->Image(__DIR__.'/../images/master.jpg', $pdf->GetX(), $pdf->GetY(), 21.5,21),0,0,'L',false);
$pdf->SetXY(3,100);
$pdf->Cell(0,0,$pdf->Image(__DIR__.'/../images/id_template.png', $pdf->GetX(), $pdf->GetY(), 100,60),0,0,'L',false);

?>