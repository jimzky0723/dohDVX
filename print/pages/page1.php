<?php

$pdf->SetFont('Arial','BI',8);

$idTemplateY = 2;
$pictureX = 57;
$pictureY = 27;

$count = 0;
$countRow = 0;
foreach (queryFetchAll() as $row){

    if(isset($row['picture'])){
        $count++;
        $countRow++;

        $pdf->SetXY(3,$idTemplateY);
        $pdf->Cell(0,0,$pdf->Image(__DIR__.'/../images/id_template.png', $pdf->GetX(), $pdf->GetY(), 210,150),'1',0,'L',false);

        try{
            $pdf->SetXY(57,$pictureY);
            $pdf->Cell(0,0,$pdf->Image(__DIR__.'/../images/upload_picture/picture'.'/'.$row['picture'], $pdf->GetX(), $pdf->GetY(), 46.8,53),0,0,'L',false);
            //$pictureX += 105;
            $pdf->SetXY(162,$pictureY);
            $pdf->Cell(0,0,$pdf->Image(__DIR__.'/../images/upload_picture/picture'.'/'.$row['picture'], $pdf->GetX(), $pdf->GetY(), 46.8,53),0,0,'L',false);
        }
        catch (Exception $e){}

        if( $count == 2 ){
            $idTemplateY = 2;
            $pictureX = 57;
            $pictureY = 27;
            $count = 0;
            $pdf->addPage();
        } else {
            $idTemplateY += 157;
            $pictureY += 158;
        }

        if($countRow == 120){
            break;
        }
    }

}

/*$pdf->SetXY(3,160);
$pdf->Cell(0,0,$pdf->Image(__DIR__.'/../images/id_template.png', $pdf->GetX(), $pdf->GetY(), 210,150),'1',0,'L',false);
$pdf->SetXY(57,185);
$pdf->Cell(0,0,$pdf->Image(__DIR__.'/../images/master.jpg', $pdf->GetX(), $pdf->GetY(), 46.8,53),0,0,'L',false);
$pdf->SetXY(162,185);
$pdf->Cell(0,0,$pdf->Image(__DIR__.'/../images/master.jpg', $pdf->GetX(), $pdf->GetY(), 46.8,53),0,0,'L',false);*/

?>