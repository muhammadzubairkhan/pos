<?php

session_start();

if(!isset($_SESSION["ORGANIZATION_NAME"]))
{

    //ORGANIZATION DETAILS

    $_SESSION["CLASS"] = "class";

    $_SESSION["ORGANIZATION_NAME"] = "org name";
    $_SESSION["ORGANIZATION_LOGO"] = "logo.png";
    $_SESSION["DATE_PRINTED"] = "Print Date";
    $_SESSION["SELECTED_DATE"] = "Selected Date";
    $_SESSION["DISCLAIMER"] = "* Something Like Disclaimer";
    $_SESSION["REPORT_NAME"] = "attendance_sheet_".$_SESSION["DATE_PRINTED"]."_".$_SESSION["CLASS"].".pdf";



    //ATTENDANCE DETAILS

    $_SESSION["USER_NAME"] = "user name";
    $_SESSION["SERVICE_NO"] = "number";
    $_SESSION["CHECK_IN"] = "check in";
    $_SESSION["CHECK_OUT"] = "check out";
    $_SESSION["ABSENT"] = "absent";
    $_SESSION["PRESENT"] = "present";
    $_SESSION["LEAVE"] = "leave";
    $_SESSION["DATE"] = "date";


    //SUM UP OF DETAILS

    $_SESSION["TOTAL_USERS"] = "total users";
    $_SESSION["TOTAL_ABSENTS"] = "total absents";
    $_SESSION["TOTAL_PRESENTS"] = "total presents";
    
}


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
$columnLabels = array( "NAME","GR.NO", "IN", "OUT", "ABSENT", "PRESENT", "LEAVE", "DATE" );
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
          array( $_SESSION["USER_NAME"], $_SESSION["SERVICE_NO"], $_SESSION["CHECK_IN"], $_SESSION["CHECK_OUT"], $_SESSION["ABSENT"], $_SESSION["PRESENT"], $_SESSION["LEAVE"], $_SESSION["DATE"] ),
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
$pdf->SetFont( 'Arial', '', 10 );
$pdf->Write( 19, "2017 - Attendance Sheet (Total Absents ".$_SESSION["CLASS"].")");
$pdf->Ln( 16 );
$pdf->SetFont( 'Arial', '', 10 );
$pdf->Write( 6, "Organization Name: " );
$pdf->Write( 6, $_SESSION["ORGANIZATION_NAME"] );
$pdf->Ln( 6 );
$pdf->Write( 6, "Class: " );
$pdf->Write( 6, $_SESSION["CLASS"] );
$pdf->Ln( 6 );
$pdf->Cell( 0, 6, "Date Printed: ".$_SESSION["DATE_PRINTED"], 0, 0, 'R' );

/**
  Create the table
**/

$pdf->SetDrawColor( $tableBorderColour[0], $tableBorderColour[1], $tableBorderColour[2]);
$pdf->Ln( 10 );

// Create the table header row
$pdf->SetFont( 'Arial', 'B', 10 );

// "PRODUCT" cell
$pdf->SetTextColor( $tableHeaderTopProductTextColour[0], $tableHeaderTopProductTextColour[1], $tableHeaderTopProductTextColour[2]);

$pdf->SetFillColor( $tableHeaderTopProductFillColour[0], $tableHeaderTopProductFillColour[1], $tableHeaderTopProductFillColour[2]);

for ( $i=0; $i<count($columnLabels); $i++ ) {
  $pdf->Cell( 22, 5, $columnLabels[$i], 1, 0, 'C', true );
}

$pdf->Ln( 5 );

// Create the table data rows

$fill = false;
$row = 0;

foreach ( $data as $dataRow ) {

  // Create the left header cell
  $pdf->SetFont( 'Arial', 'B', 10 );
  $pdf->SetTextColor( $tableHeaderLeftTextColour[0], $tableHeaderLeftTextColour[1], $tableHeaderLeftTextColour[2] );
  $pdf->SetFillColor( $tableHeaderLeftFillColour[0], $tableHeaderLeftFillColour[1], $tableHeaderLeftFillColour[2] );

  // Create the data cells
  $pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
  $pdf->SetFillColor( $tableRowFillColour[0], $tableRowFillColour[1], $tableRowFillColour[2] );
  $pdf->SetFont( 'Arial', '', 10 );

  for ( $i=0; $i<count($columnLabels); $i++ ) {
    $pdf->Cell( 22, 5, ( '' .  $dataRow[$i]  ), 1, 0, 'C', $fill );
  }

  $row++;
  $fill = !$fill;
  $pdf->Ln( 5 );
}

$pdf->Ln( 12 );
$pdf->Write( 6, $_SESSION["DISCLAIMER"]);

/***
  Serve the PDF
***/

$pdf->Output( $_SESSION["REPORT_NAME"], "I" );

?>