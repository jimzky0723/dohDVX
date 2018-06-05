<?php
$pdf->SetFont('Arial','',7);
/*$pdf->SetX(3);
$pdf->Cell(210,325,'',1,0,'C');*/

$pdf->SetFillColor(150, 150, 150); //GRAY
$height = 6.6;
$marginTop1 = 10;

$border =  'LTRB';
$position = '';

$pdf->SetTextColor(255,255,255);
$pdf->SetXY(3,$marginTop1);
$pdf->Cell(210,$height,'IV. CIVIL SERVICE ELIGIBILITY',$border,0,$position,true);


$pdf->SetTextColor(0,0,0);
$marginTop1 += 6.6;
$civilWidth = ['',75,17,20,65,16,17];

$civilRow = [
    '',
    ['','27. CAREER SERVICE/ RA 1080 (BOARD/ BAR) UNDER','','DATE OF','PLACE OF EXAMINATION/CONFERMENT','LICENSE','(if applicable)'],
    ['','SPECIAL LAWS/CES/CSEE','','EXAMINATION/','PLACE OF EXAMINATION','','Date of'],
    ['','BARANGAY ELIGIBILITY / DRIVERS LICENSE','','CONFERMENT','','','Validity']
];



$pdf->SetFillColor(237, 235, 236);
$pdf->SetXY(3,17);
$pdf->Cell(210,20,'',0,0,$position,true);
for($row = 1; $row < count($civilRow); $row++){
    $marginLeft = 3;
    $colorFlag = false;
    $position = 'C';
    for($col = 1; $col < count($civilRow[1]); $col++){

        $border = '1';
        if( $row == 1 ){
            $border = 'LTR';
            if( $col == 2 ){

                $pdf->SetXY($marginLeft,$marginTop1+5);
                $pdf->Cell($civilWidth[$col],$height,'RATING',0,0,$position,$colorFlag);

                $pdf->SetXY($marginLeft,$marginTop1+10);
                $pdf->Cell($civilWidth[$col],$height,'(if Applicable)',0,0,$position,$colorFlag);
            }
            elseif( $col == 5 ){
                $position = 'R';
                $border = 'BTL';
            }
            elseif( $col == 6){
                $position = 'L';
                $border = 'BTR';
            }
        }
        elseif ( $row == 2 ){
            $border = 'LR';
            if( $col == 5 ){
                $pdf->SetXY($marginLeft,$marginTop1+4);
                $pdf->Cell($civilWidth[$col],$height,'NUMBER',0,0,$position,$colorFlag);
            }
        }
        elseif( $row == 3 ){
            $border = 'LRB';
        }


        $pdf->SetXY($marginLeft,$marginTop1);
        $pdf->Cell($civilWidth[$col],$height,$civilRow[$row][$col],$border,0,$position,$colorFlag);

        $marginLeft += $civilWidth[$col];
    }
    $marginTop1 += 6.6;
}

$pdf->SetTextColor(0,0,0);
$pdf->SetWidths(array(75,17,20,65,16,17));
$pdf->SetXY(3,$marginTop1);
$pdf->SetLeftMargin(3);

$civilColumn = ['career_service','rating','date_of_examination','place_examination','license_number','date_of_validity'];
$civilRowCount = 1;

foreach( $civil_eligibility as $row ){
    for( $i = 0; $i < count($civilColumn); $i++ ){
        $civilData[$i] = $row[$civilColumn[$i]];
    }
    $pdf->Row($civilData,'7',5,'C',null);
    $civilRowCount++;
}

for( $j = $civilRowCount; $j <= 7; $j++ ){
    $pdf->Row(['','','','','',''],'7',5,'C',null);
    $civilRowCount++;
}

$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(150, 150, 150); //GRAY
$pdf->SetXY(3,$GLOBALS['marginTop']);
$pdf->Cell(210,$height+8,'','TLR',0,'',true);

$pdf->SetXY(3,$GLOBALS['marginTop']+1);
$pdf->Cell(210,$height,'V. WORK EXPERIENCE',0,0,'',false);

$pdf->SetXY(3,$GLOBALS['marginTop']+6);
$pdf->Cell(210,$height,'(Include private employment. Start from your recent work) Description of duties should be indicated in the attached Work Experience sheet. ',0,0,'',false);

$pdf->SetFillColor(237, 235, 236);
$pdf->SetXY(3,$GLOBALS['marginTop']+14);
$pdf->Cell(210,20,'','1',0,$position,true);


$workWidth = ['',20,20,45,55,15,20,'20','15'];
$work_experienceRow = [
    '',
    ['','28. INCLUSIVE DATES','','POSITION TITLE','DEPARTMENT/AGENCY/OFFICE/COMPANY','MONTHLY','SALARY/JOB/','STATUS OF','GOVT'],
    ['','(mm/dd/yyyy)','','(Write in full/Do not abbreviate)','(Write in full/Do not abbreviate)','SALARY','PAY GRADE','APPOINTMENT','SERVICE'],
    ['','FROM','TO','','','','','','(Y/N)']
];

$GLOBALS['marginTop']+=14;
$pdf->SetTextColor(0,0,0);

for($row = 1; $row < count($work_experienceRow); $row++){
    $marginLeft = 3;
    $colorFlag = false;
    $position = 'C';
    for($col = 1; $col < count($work_experienceRow[1]); $col++){

        $border = 'LRB';
        $marginTopFinal = $GLOBALS['marginTop'];
        $marginLeftFinal = $marginLeft;
        $heightFinal = $height;
        if( $row == 1 ){
            if( $col == 1 ){
                $border = '0';
                $marginTopFinal += 2;
                $marginLeftFinal += 10;
            }
            elseif( $col == 2 ){
                $border = 'R';
            }
            elseif( $col == 3 ){
                $border = 'R';
                $heightFinal += 10;
            }
            elseif( $col == 4 ){
                $border = 'R';
                $heightFinal += 10;
            }
            elseif( $col == 5 ){
                $marginTopFinal += 5;
                $border = 0;
            }
            elseif( $col == 6 ){
                $border = 'LR';
                $heightFinal += 10;
            }
            elseif( $col == 7 ){
                $marginTopFinal += 5;
                $border = 0;
            }
            elseif( $col == 8 ){
                $heightFinal +=5;
                $border = 'L';
            }
        }
        elseif( $row == 2 ){
            if( $col == 1 ){
                $border = '0';
                $marginLeftFinal += 12;
            }
            elseif( $col == 2 ){
                $border = 'R';
            }
            elseif( $col == 3 ){
                $marginTopFinal += 2;
                $border = 0;
            }
            elseif( $col == 4 ){
                $border = 'R';
                $heightFinal += 4;
            }
            elseif( $col == 5 ){
                $marginTopFinal += 2;
                $border = 0;
            }
            elseif( $col == 6 ){
                $marginTopFinal += 2;
                $border = 0;
            }
            elseif( $col == 7 ){
                $border = 'R';
                $heightFinal += 4;
            }
            elseif( $col == 8 ){
                $border = 0;
            }
        }
        elseif( $row == 3 ){
            $border = 1;
            if( $col == 3 ){
                $border = 'RLB';
            }
            elseif ( $col == 4 ){
                $border = 'RLB';
            }
            elseif ( $col == 5 ){
                $border = 'RLB';
            }
            elseif( $col == 6 ){
                $border = 'B';
            }
            elseif ( $col == 7 ){
                $border = 'RLB';
            }
            elseif ( $col == 8 ){
                $border = 'B';
                $heightFinal += 3.2;
                $marginTopFinal -= 3;
            }
        }

        $pdf->SetXY($marginLeftFinal,$marginTopFinal);
        $pdf->Cell($workWidth[$col],$heightFinal,$work_experienceRow[$row][$col],$border,0,$position,$colorFlag);

        $marginLeft += $workWidth[$col];
    }
    $GLOBALS['marginTop'] += 6.6;
}



$pdf->SetWidths(array(20,20,45,55,15,20,20,15));
$pdf->SetXY(3,$GLOBALS['marginTop']);
$pdf->SetLeftMargin(3);

$workColumn = ['date_from','date_to','position_title','company','monthly_salary','salary_grade','status_of_appointment','government_service'];
$work_experienceRowCount = 1;
foreach( $work_experience as $row ){
    for( $i = 0; $i < count($workColumn); $i++ ){
        $work_experienceData[$i] = $row[$workColumn[$i]];
    }
    $pdf->Row($work_experienceData,7,5,'C',null);
    $work_experienceRowCount++;
}

for( $j = $work_experienceRowCount; $j <= 25; $j++ ){
    $pdf->Row(['','','','','','','',''],7,5,'C',null);
    $work_experienceRowCount++;
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
$pdf->Row(['SIGNATURE','','DATE',''],14,7,'C',$rectColor);
?>