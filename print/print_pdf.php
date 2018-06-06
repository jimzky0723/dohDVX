<?php

include_once 'fpdf.php';

function connect(){
    return new PDO("mysql:host=localhost;dbname=pis",'root','');
}

function queryFetchAll(){
    $db=connect();
    $sql="select * from personal_information ORDER BY id DESC";
    $pdo=$db->prepare($sql);
    $pdo->execute();
    $row=$pdo->fetchAll();
    $db=null;

    return $row;
}

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

