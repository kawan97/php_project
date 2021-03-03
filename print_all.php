<?php
 ob_start(); 
 ob_end_clean();

 session_start(); 
 if(!isset($_SESSION['uNamebnz'])){
 header('Location:login.php');
 
 }
include "dbcon.php";
include 'tcpdf/tcpdf.php';

$select = $pdo->prepare("SELECT * FROM items  ORDER BY `items`.`id` DESC");
$select->setFetchMode(PDO::FETCH_ASSOC);
$select->execute();


$pdf = new TCPDF('p', 'mm', 'A4', true, 'UTF-8', false);

// set some language dependent data:
$lg = Array();
$lg['a_meta_charset'] = 'UTF-8';
$lg['a_meta_dir'] = 'ltr';
$lg['a_meta_language'] = 'fa';
$lg['w_page'] = 'page';

// set some language-dependent strings (optional)
$pdf->setLanguageArray($lg);
$pdf->setRTL(false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetFont('dejavusans', '', 12);
$sa3at=((int)date('h'))+1;

// add a page
$pdf->AddPage();
//$pdf->Cell(80);
$pdf->Image('logo.jpg', '115', '1', '33', '33');
$pdf->Cell(130,6,' Database',0,1);
$pdf->Cell(20,6,' all items',0,1);
$pdf->SetFont('dejavusans', '', 9);

$pdf->Cell(130,6,' dsdsdss',0,0);
$pdf->SetFont('dejavusans', '', 7);



$pdf->SetFont('dejavusans', '', 8);

$pdf->Cell(130,9,date("l jS \of F Y $sa3at:i:s A"),0,1);
$pdf->SetFont('dejavusans', '', 11);

$pdf->Cell(10,9,'id',1,0);
$pdf->Cell(50,9,'Title',1,0);
$pdf->Cell(20,9,'Purchase',1,0);
$pdf->Cell(20,9,'Sale',1,0);
$pdf->Cell(20,9,'payed',1,0);
$pdf->Cell(20,9,'profit',1,0);
$pdf->Cell(25,9,'inserted',1,0);
$pdf->Cell(33,9,'updated',1,1);
$totalnotpayed=0;
$totalpayed=0;
$totalsale=0;
$totalpur=0;
$totalprofit=0;

while($row=$select->fetch()){
    $notpayed=$row['sale']-$row['payed'];
    $totalnotpayed=$totalnotpayed+$notpayed;
    $totalpayed=$totalpayed+$row['payed'];
    $totalpur=$totalpur+$row['purchase'];
   
    $totalprofit=$totalprofit+$row['profit'];

   
   $totalsale=$totalsale+$row['sale'];
    $pdf->SetFont('dejavusans', '', 11);

$pdf->Cell(10,9,$row['id'],1,0);
$pdf->SetFont('dejavusans', '', 7);

$pdf->Cell(50,9,$row['title'],1,0);
$pdf->SetFont('dejavusans', '', 11);

$pdf->Cell(20,9,$row['purchase'],1,0);
$pdf->Cell(20,9,$row['sale'],1,0);
$pdf->Cell(20,9,$row['payed'],1,0);
$pdf->Cell(20,9,$row['profit'],1,0);
$pdf->Cell(25,9,$row['intered_date'],1,0);
$pdf->SetFont('dejavusans', '', 7);

$pdf->Cell(33,9,$row['update_date'],1,1);

}
$pdf->SetFont('dejavusans', '', 11);

$pdf->Cell(10,9,'',1,0);
$pdf->Cell(50,9,'Total',1,0);
$pdf->Cell(20,9,$totalpur,1,0);
$pdf->Cell(20,9,$totalsale,1,0);
$pdf->Cell(20,9,$totalpayed,1,0);
$pdf->Cell(20,9,$totalprofit,1,0);
$pdf->Cell(25,9,'',1,0);
$pdf->Cell(33,9,'',1,1);
$pdf->Cell(90);
$pdf->Ln(6);

$pdf->Ln(10);



// ---------------------------------------------------------
ob_end_clean();
$pdf->Output();


?>
