<?php

session_start();
include("../include/dbconnect.php");

$sales_date_from = $_GET["sales_date_from"];
$sales_date_to =$_GET["sales_date_to"];

$array = [];
$sql = "select t.product_id,SUM(q) AS 'quantity',mp.p_name,mp.p_price * SUM(q) AS 'price' from (SELECT product_id,SUM(quantity) AS 'q' from takeaway WHERE date_time <= '$sales_date_to' AND date_time >= '$sales_date_from' GROUP BY product_id UNION SELECT product_id,SUM(quantity) AS 'q' from orders WHERE date_time <= '$sales_date_to' AND date_time >= '$sales_date_from' GROUP BY product_id) t JOIN menu_products mp ON mp.p_id = t.product_id GROUP BY t.product_id";
$result = $conn->query($sql);
   
$totalamount = 0;
while($r = mysqli_fetch_assoc($result))
{
    $array[] = $r;
    $totalamount += $r['price'];
}

$sql_company = "SELECT * from pos_config";
$result_company = $conn->query($sql_company);
$row = mysqli_fetch_assoc($result_company);

//print_r($array);
//exit();

$sales_details1 = array(); //empty
$sales_details3 = array(); //empty variable
$sales_details4 = array();

$date = new DateTime();
$datetime = $date->format('d-m-y');
$total_amount = 0;

$_SESSION["SALES_DATE_FROM"] = $sales_date_from;
$_SESSION["SALES_DATE_TO"] = $sales_date_to;
$_SESSION["DATE_PRINTED"] = $datetime;
$_SESSION["REPORT_NAME"] = "sales_report_".$_SESSION["DATE_PRINTED"].".pdf";
$_SESSION["DISCLAIMER"] = "* This document is confidential and not to be distributed under any condition without permission.";

$_SESSION['TOTAL_AMOUNT'] = $totalamount;
$_SESSION["ORGANIZATION_NAME"] = $row['company_name'];
$_SESSION["ORGANIZATION_LOGO"] = "../".$row['company_pdf_image'];

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
$columnLabels = array( "PRODUCT NAME", "QUANTITY", "PRICE");
$rowLabels = array( "aaa", "123", "123");
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
$pdf->Cell( 0, 15, "General Sales Report", 0, 0, 'C' );
$pdf->Ln( 16 );
$pdf->SetFont( 'Arial', 'B', 10 );
$pdf->Write( 6, "From: " );
$pdf->Write( 6, $_SESSION["SALES_DATE_FROM"] );
$pdf->Ln( 6 );
$pdf->Write( 6, "Year: " );
$pdf->Write( 6, $_SESSION["SALES_DATE_TO"] );
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
  $pdf->Cell( 63, 5, $columnLabels[$i], 1, 0, 'C', true );
}

$pdf->Ln( 5 );

// Create the table data rows

$fill = false;
$row = 0;

foreach ( $array as $dataRow ) 
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
    if($i == 2)
    {
        $pdf->SetFont( 'Arial', 'B', 10 );
        $pdf->Cell( 63, 5, ( '' . $dataRow['price'] ." Rs"  ), 1, 0, 'R', $fill );
    }
    else if($i == 1){
         $pdf->Cell( 63, 5, ( '' .  $dataRow['quantity']  ), 1, 0, 'C', $fill );
        
    }
      else
    {
        $pdf->Cell( 63, 5, ( '' .  $dataRow['p_name']  ), 1, 0, 'C', $fill );
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