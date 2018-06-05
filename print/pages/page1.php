<?php

$pdf->SetFont('Arial','BI',8);

for($i=1; $i<80000;$i++){
    $pdf->SetXY(3,2);
    $pdf->Cell(0,0,$pdf->Image(__DIR__.'/../images/id_template.png', $pdf->GetX(), $pdf->GetY(), 210,150),'1',0,'L',false);
    $pdf->SetXY(57,27);
    $pdf->Cell(0,0,$pdf->Image(__DIR__.'/../images/master.jpg', $pdf->GetX(), $pdf->GetY(), 46.8,53),0,0,'L',false);

    $pdf->SetXY(3,160);
    $pdf->Cell(0,0,$pdf->Image(__DIR__.'/../images/id_template.png', $pdf->GetX(), $pdf->GetY(), 210,150),'1',0,'L',false);
    $pdf->AddPage();
}



?>