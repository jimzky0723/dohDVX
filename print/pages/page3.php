<?php
$GLOBALS['marginTop'] = 2;
$pdf->SetXY(3,$GLOBALS['marginTop']);
$pdf->SetWidths(array(210));
$pdf->SetFont('Arial','',7);
$rectColor = ['r' => 150,'g' => 150,'b' => '150','rectCol' => 'allColumn'];
$pdf->Row(['VI. VOLUNTARY WORK OR INVOLVEMENT IN CIVIC / NON-GOVERNMENT / PEOPLE / VOLUNTARY ORGANIZATION/S'],6.6,7,'L',$rectColor);

$pdf->SetTextColor(0,0,0);
$voluntaryWidth = ['',90,20,20,20,60];
$voluntaryRow = [
    '',
    ['','29. NAME & ADDRESS OF ORGANIZATION','','','',''],
    ['','(Write in full)','','','','POSITION / NATURE OF WORK'],
    ['','','From','To','','']
];
$position = '';
$height = 6.6;
$pdf->SetFillColor(237, 235, 236);
$pdf->SetXY(3,$GLOBALS['marginTop']);
$pdf->Cell(210,20,'',0,0,$position,true);
for($row = 1; $row < count($voluntaryRow); $row++){
    $marginLeft = 3;
    $colorFlag = false;
    $position = 'C';
    for($col = 1; $col < count($voluntaryRow[1]); $col++){

        $border = '1';
        if( $row == 1 ){
            $border = 'RL';
            if( $col == 2 ){
                $border = 'L';

                $pdf->SetXY($marginLeft+9,$GLOBALS['marginTop']+2);
                $pdf->Cell($voluntaryWidth[$col],$height,'INCLUSIVE DATES',0,0,$position,$colorFlag);

                $pdf->SetXY($marginLeft+9,$GLOBALS['marginTop']+7);
                $pdf->Cell($voluntaryWidth[$col],$height,'(mm/dd/yyyy)',0,0,$position,$colorFlag);

            }
            elseif( $col == 3 ){
                $border = 'R';
            }
            elseif( $col == 4 ){
                $pdf->SetXY($marginLeft,$GLOBALS['marginTop']+2);
                $pdf->Cell($voluntaryWidth[$col],$height,'NUMBER OF',0,0,$position,$colorFlag);

                $pdf->SetXY($marginLeft,$GLOBALS['marginTop']+7);
                $pdf->Cell($voluntaryWidth[$col],$height,'HOURS',0,0,$position,$colorFlag);
            }
        }
        elseif ( $row == 2 ){
            $border = 'RL';
            if( $col == 2 ){
                $border = 'LB';
            }
            elseif( $col == 3 ){
                $border = 'RB';
            }
        }
        elseif( $row == 3 ){
            $border = 'RLB';
            if( $col == 2 ){
                $border = 'RTB';
            }
            elseif( $col == 3 ){
                $border = 'LTB';
            }
        }


        $pdf->SetXY($marginLeft,$GLOBALS['marginTop']);
        $pdf->Cell($voluntaryWidth[$col],$height,$voluntaryRow[$row][$col],$border,0,$position,$colorFlag);

        $marginLeft += $voluntaryWidth[$col];
    }
    $GLOBALS['marginTop'] += 6.6;
}


$pdf->SetWidths(array(90,20,20,20,60));
$pdf->SetXY(3,$GLOBALS['marginTop']);
$pdf->SetLeftMargin(3);
$voluntaryColumn = ['name_of_organization','date_from','date_to','number_of_hours','nature_of_work'];
$voluntaryRowCount = 1;
foreach( $voluntary_work as $row ){
    for( $i = 0; $i < count($voluntaryColumn); $i++ ){
        $voluntaryData[$i] = $row[$voluntaryColumn[$i]];
    }
    $pdf->Row($voluntaryData,7,5,'C',null);
    $voluntaryRowCount++;
}

for( $j = $voluntaryRowCount; $j <= 7; $j++ ){
    $pdf->Row(['','','','',''],7,5,'C',null);
    $voluntaryRowCount++;
}


$pdf->SetFillColor(150, 150, 150);
$pdf->SetXY(3,$GLOBALS['marginTop']-1);
$pdf->Cell(210,13,'',1,0,'L',true);


$pdf->SetFont('Arial','B',7);
$pdf->SetTextColor(255,255,255);
$pdf->SetXY(3,$GLOBALS['marginTop']-3);
$pdf->Cell(210,13,'VII. LEARNING AND DEVELOPMENT (L&D) INTERVENTIONS/TRAINING PROGRAMS ATTENDED',0,0,'L',false);

$GLOBALS['marginTop'] += 6.6;
$pdf->SetFont('Arial','',7);
$pdf->SetXY(3,$GLOBALS['marginTop']-5);
$pdf->Cell(210,13,'(Start from the most recent L&D/training program and include only the relevant L&D/training taken for the last five (5) years for Division Chief/Executive/Managerial positions)',0,0,'L',false);
$GLOBALS['marginTop'] += 5.4;


$pdf->SetTextColor(0,0,0);
$trainingWidth = ['',90,20,20,20,20,40];
$trainingRow = [
    '',
    ['','','INCLUSIVE DATES OF','','','TYPE OF LD',''],
    ['','30. TITLE OF LEARNING AND DEVELOPMENT INTERVENTIONS/TRAINING PROGRAMS','ATTENDANCE','','NUMBER OF','(Managerial/','CONDUCTED/SPONSORED BY'],
    ['','(Write in full)','(mm/dd/yyyy)','','HOURS','Supervisory/','(Write in full)'],
    ['','','From','To','','Technician/etc)','']
];
$height = 6.6;
$pdf->SetFillColor(237, 235, 236);
$pdf->SetXY(3,$GLOBALS['marginTop']);
$pdf->Cell(210,26.6,'',0,0,$position,true);
for($row = 1; $row < count($trainingRow); $row++){
    $marginLeft = 3;
    $colorFlag = false;
    $position = 'C';
    for($col = 1; $col < count($trainingRow[1]); $col++){

        $border = '1';
        $marginLeftFinal = $marginLeft;
        $widthFinal = $trainingWidth[$col];
        if( $row == 1 ){
            $border = 'RL';
            if( $col == 2 ){
                $border = '0';
                $marginLeftFinal += 10;
            }
            elseif( $col == 3 ){
                $border = 'R';
            }
        }
        elseif ( $row == 2 ){
            $border = 'RL';
            $pdf->SetFont('Arial','',7);
            if( $col == 1 ){
                $pdf->SetFont('Arial','',6);
            }
            elseif( $col == 2 ){
                $border = '0';
                $marginLeftFinal += 10;
            }
            elseif( $col == 3 ){
                $border = 'R';
            }
        }
        elseif( $row == 3 ){
            $border = 'RL';
            if( $col == 2 ){
                $border = 'B';
                $widthFinal += 20;
            }
            elseif( $col == 3 ){
                $border = 'B';
            }
        }
        elseif( $row == 4 ){
            $border = 'RLB';
            if( $col == 2 ){
                $border = 'RTB';
            }
            elseif( $col == 3 ){
                $border = 'LTB';
            }
        }



        $pdf->SetXY($marginLeftFinal,$marginTop);
        $pdf->Cell($widthFinal,$height,$trainingRow[$row][$col],$border,0,$position,$colorFlag);

        $marginLeft += $trainingWidth[$col];
    }
    $GLOBALS['marginTop'] += 6.6;
}


$pdf->SetWidths(array(90,20,20,20,20,40));
$pdf->SetXY(3,$GLOBALS['marginTop']);
$pdf->SetLeftMargin(3);
$training_programColumn = ['title_of_learning','date_from','date_to','number_of_hours','type_of_id','sponsored_by'];
$training_programRowCount = 1;
foreach( $training_program as $row ){
    for( $i = 0; $i < count($training_programColumn); $i++ ){
        $training_programData[$i] = $row[$training_programColumn[$i]];
    }
    $pdf->Row($training_programData,7,5,'C',null);
    $training_programRowCount++;
}

for( $j = $training_programRowCount; $j <= 15; $j++ ){
    $pdf->Row(['','','','','',''],7,5,'C',null);
    $training_programRowCount++;
}



$pdf->SetXY(3,$GLOBALS['marginTop']);
$pdf->SetWidths(array(210));
$pdf->SetFont('Arial','',7);
$rectColor = ['r' => 150,'g' => 150,'b' => '150','rectCol' => 'allColumn'];
$pdf->Row(['VIII.  OTHER INFORMATION'],6.6,7,'L',$rectColor);

$pdf->SetTextColor(0,0,0);
$other_informationWidth = ['',70,100,40];
$other_informationRow = [
    '',
    ['','','','MEMBERSHIP IN'],
    ['','31. SPECIAL SKILLS and HOBBIES','NON-ACADEMIC DISTINCTIONS / RECOGNITION','33. ASSOCIATION/ORGANIZATION'],
    ['','','(Write in full)','(Write in full)']
];
$height = 6.6;
$pdf->SetFillColor(237, 235, 236);
$pdf->SetXY(3,$GLOBALS['marginTop']);
$pdf->Cell(210,20,'',0,0,$position,true);
for($row = 1; $row < count($other_informationRow); $row++){
    $marginLeft = 3;
    $colorFlag = false;
    $position = 'C';
    for($col = 1; $col < count($other_informationRow[1]); $col++){
        $border = '1';
        $pdf->SetFont('Arial','',6);
        if( $row == 1 ){
            $border = 'TLR';
        }
        elseif( $row == 2 ){
            $border = 'LR';
            if( $col == 3 ){
                $pdf->SetFont('Arial','',6);
            }
        }
        elseif( $row == 3 ){
            $border = 'LBR';
        }

        $pdf->SetXY($marginLeft,$marginTop);
        $pdf->Cell($other_informationWidth[$col],$height,$other_informationRow[$row][$col],$border,0,$position,$colorFlag);

        $marginLeft += $other_informationWidth[$col];
    }
    $GLOBALS['marginTop'] += 6.6;
}

$pdf->SetWidths(array(70,100,40));
$pdf->SetXY(3,$GLOBALS['marginTop']);
$pdf->SetLeftMargin(3);
$other_informationColumn = ['special_skills','recognition','organization'];
$other_informationRowCount = 1;
foreach( $other_information as $row ){
    for( $i = 0; $i < count($other_informationColumn); $i++ ){
        $other_informationData[$i] = $row[$other_informationColumn[$i]];
    }
    $pdf->Row($other_informationData,7,5,'C',null);
    $other_informationRowCount++;
}

for( $j = $other_informationRowCount; $j <= 10; $j++ ){
    $pdf->Row(['','',''],7,5,'C',null);
    $other_informationRowCount++;
}


$pdf->SetFont('Arial','B',7);
$pdf->SetTextColor(237,28,36);
$pdf->SetXY(3,$GLOBALS['marginTop']);
$pdf->Cell(210,4,'(Continue on separate sheet if necessary)',1,0,'C',false);
$GLOBALS['marginTop'] += 4;
$pdf->SetFont('Arial','',15);
$pdf->SetTextColor(0,0,0);
$pdf->SetWidths(array(40,75,25,70));
$pdf->SetXY(3,$GLOBALS['marginTop']);
$rectColor = ['r' => 207,'g' => 207,'b' => '207','rectCol' => '0|2'];
//$pdf->Row(['SIGNATURE','','DATE',''],14,15,'C',$rectColor);
$pdf->Row(['SIGNATURE','','DATE',''],14,7,'C',$rectColor);

?>