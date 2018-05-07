<?php

session_start();

$fee_date_from = $_GET["fee_date_from"];
$fee_date_to =$_GET["fee_date_to"];
$class_name =$_GET["class_name"];
$student_gr =$_GET["student_grno"];

$fee_details1 = array(); //empty
//$payment_details2 = array(); //loop values
$fee_details3 = array(); //empty variable
$fee_details4 = array();

// get database connection
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

include_once '../object/student.php';

$student_details = new Student($db);
$stmt_student_details = $student_details->viewStudentByGr($student_gr);
while ($row_student = $stmt_student_details->fetch(PDO::FETCH_ASSOC))
{
    extract($row_student);
    $_SESSION["STUDENT_NAME"] = $FIRST_NAME." ".$LAST_NAME;
}

include_once '../object/class.php';
$class_details = new Classroom($db);
$stmt_class_details = $class_details->viewClassByClassID($class_name);
while ($row_class = $stmt_class_details->fetch(PDO::FETCH_ASSOC))
{
    extract($row_class);
    $_SESSION["CLASS_NAME"] = $CLASS_NAME;
}

// access payment class using object
include_once '../object/student_payment.php';

$fee = new Student_Payment($db);

$stmt = $fee->generateStudentReport($fee_date_from, $fee_date_to, $student_gr, $class_name);

//echo $stmt;
//exit();
    
$date = new DateTime();
$datetime = $date->format('d-m-y');
$total_amount = 0;

$_SESSION["FEE_DATE_FROM"] = $fee_date_from;
$_SESSION["FEE_DATE_TO"] = $fee_date_to;
$_SESSION["DATE_PRINTED"] = $datetime;
$_SESSION["REPORT_NAME"] = "fee_report_".$_SESSION["DATE_PRINTED"].".pdf";
$_SESSION["DISCLAIMER"] = "* This document is confidential and not to be distributed under any condition without permission.";

while ($row_fee = $stmt->fetch(PDO::FETCH_ASSOC))
{
    extract($row_fee);
    
    $fee_details2 = array($GR_NO, $_SESSION["STUDENT_NAME"], $_SESSION["CLASS_NAME"], $PAYMENT_DATE, $STATUS, $PAYMENT_METHOD, $TOTAL);
    
    $fee_details3 = array_push($fee_details1, $fee_details2);
    $total_amount += $TOTAL;
}

$_SESSION['TOTAL_AMOUNT'] = $total_amount;
$_SESSION["ORGANIZATION_NAME"] = "DHAKA COACHING CENTER";
$_SESSION["ORGANIZATION_LOGO"] = "logo.png";

//$payment_details4 = $payment_details1;
//echo "<pre>";
//print_r($payment_details1);
//echo "</pre>";
//
//
//foreach ( $payment_details1 as $dataRow ) 
//{
//    
//    echo $dataRow['PAYMENT_BY'];
//    
//}
//exit;
if($_SESSION)
{
require_once( "fpdf.php" );

// Begin configuration

$textColour = array( 0, 0, 0 );
$headerColour = array( 100, 100, 100 );
$tableHeaderTopTextColour = array( 1, 1, 1 );
$tableHeaderTopFillColour = array( 190, 197, 209 );
$tableHeaderTopProductTextColour = array( 0, 0, 0 );
$tableHeaderTopProductFillColour = array( 190, 197, 209 );
$tableHeaderLeftTextColour = array( 1, 1, 1 );
$tableHeaderLeftFillColour = array( 232, 235, 239 );
$tableBorderColour = array( 50, 50, 50 );
$tableRowFillColour = array( 232, 235, 239 );
$reportName = $_SESSION["ORGANIZATION_NAME"];
$reportNameYPos = 160;
$logoFile = $_SESSION["ORGANIZATION_LOGO"];
$logoXPos = 50;
$logoYPos = 108;
$logoWidth = 110;
$columnLabels = array( "GR","STUDENT NAME", "CLASS", "DATE", "STATUS", "METHOD", "AMOUNT" );
$rowLabels = array( "ABSENT", "PRESENT", "IN", "OUT", "LEAVE", "", "", ""  );
$chartXPos = 20;
$chartYPos = 250;
$chartWidth = 160;
$chartHeight = 80;
$chartXLabel = "<overall statistics>";
$chartYLabel = "2017 Jan";
$chartYStep = 20000;

$chartColours = array(
                  array( 255, 100, 100 ),
                  array( 100, 255, 100 ),
                  array( 100, 100, 255 ),
                  array( 255, 255, 100 ),
                );

$data = array(
          array( 255, 100, 100, 255, 100, 100, 222, 222 ),
          array( 255, 100, 100, 255, 100, 100, 222, 222 ),
          array( 255, 100, 100, 255, 100, 100, 222, 222 ),
          array( 255, 100, 100, 255, 100, 100, 222, 222 ),
        );

// End configuration

class PDF extends FPDF
{
    /**
      Create the page header, main heading, and intro text
    **/
    
    function Header()
    {
        // Logo
        $this->Image($_SESSION["ORGANIZATION_LOGO"],10,1,30); 
        $this->SetFont( 'Arial', '', 17 );
        $this->Cell( 0, 15, $_SESSION["ORGANIZATION_NAME"], 0, 0, 'C' );
        $this->Ln( 16 );
    }
    
    function Footer()
    {
        // Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial','I',7);
        // Print centered page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

/**
  Create the page header, main heading, and intro text
**/

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
$pdf->SetFont( 'Arial', 'B', 14 );
$pdf->Cell( 0, 15, "Fee Report", 0, 0, 'C' );
$pdf->Ln( 16 );
$pdf->SetFont( 'Arial', 'B', 10 );
$pdf->Write( 6, "From: " );
$pdf->Write( 6, $_SESSION["FEE_DATE_FROM"] );
$pdf->Ln( 6 );
$pdf->Write( 6, "Year: " );
$pdf->Write( 6, $_SESSION["FEE_DATE_TO"] );
$pdf->Cell( 0, 6, "Date Printed: ". $_SESSION["DATE_PRINTED"], 0, 0, 'R' );

/**
  Create the table
**/

$pdf->SetDrawColor( $tableBorderColour[0], $tableBorderColour[1], $tableBorderColour[2]);
$pdf->Ln( 10 );

// Create the table header row
$pdf->SetFont( 'Arial', 'B', 7 );

// "PRODUCT" cell
$pdf->SetTextColor( $tableHeaderTopProductTextColour[0], $tableHeaderTopProductTextColour[1], $tableHeaderTopProductTextColour[2]);

$pdf->SetFillColor( $tableHeaderTopProductFillColour[0], $tableHeaderTopProductFillColour[1], $tableHeaderTopProductFillColour[2]);

for ( $i=0; $i<count($columnLabels); $i++ ) 
{
  //$pdf->MultiCell( 27, 5, $columnLabels[$i], 1);
  $pdf->Cell( 27, 5, $columnLabels[$i], 1, 0, 'C', true );
}

$pdf->Ln( 5 );

// Create the table data rows

$fill = false;
$row = 0;

foreach ( $fee_details1 as $dataRow ) 
{

  // Create the left header cell
  $pdf->SetFont( 'Arial', 'B', 10 );
  $pdf->SetTextColor( $tableHeaderLeftTextColour[0], $tableHeaderLeftTextColour[1], $tableHeaderLeftTextColour[2] );
  $pdf->SetFillColor( $tableHeaderLeftFillColour[0], $tableHeaderLeftFillColour[1], $tableHeaderLeftFillColour[2] );

  // Create the data cells
  $pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
  $pdf->SetFillColor( $tableRowFillColour[0], $tableRowFillColour[1], $tableRowFillColour[2] );
  $pdf->SetFont( 'Arial', '', 10 );

  for ( $i=0; $i<count($columnLabels); $i++ ) 
  {
    if($i == 6)
    {
        $pdf->SetFont( 'Arial', 'B', 10 );
        $pdf->Cell( 27, 5, ( '' .  $dataRow[$i]." Rs"  ), 1, 0, 'R', $fill );
        //$pdf->MultiCell( 27, 5, $dataRow[$i], 1, "C", 255);
    }
    else
    {
        $pdf->Cell( 27, 5, ( '' . $dataRow[$i] ), 1, 0, 'C', $fill );
        //$pdf->MultiCell( 27, 5, $dataRow[$i], 1, "C", 255);
    }
  }

  $row++;
  $fill = !$fill;
  $pdf->Ln( 5 );
}

$pdf->SetFont( 'Arial', 'B', 10 );
    $pdf->Ln( 5 );
$pdf->Cell( 162, 7, "TOTAL AMOUNT", 1, 0, 'L', true );
$pdf->Cell( 27, 7, $_SESSION["TOTAL_AMOUNT"]." Rs", 1, 0, 'R', true );

$pdf->SetTextColor(200);
$pdf->SetFont( 'Arial', 'B', 8 );
$pdf->Ln( 12 );
$pdf->Write( 6, $_SESSION["DISCLAIMER"] );

/***
  Serve the PDF
***/
ob_end_clean();

$pdf->Output( $_SESSION["REPORT_NAME"], "I" );

//ob_end_flush();
    
}

?>