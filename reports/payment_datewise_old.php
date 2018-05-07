<?php

session_start();

// get database connection
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

// access payment class using object
include_once '../object/payment_record.php';
$payment = new Payment($db);

$payment_date_from = $_POST["payment_date_from"];
$payment_date_to = $_POST["payment_date_to"]; 

$stmt = $payment->generateReport($payment_date_from, $payment_date_to);

//$payment_by. $payment_to, $payment_method, $payment_bank, $payment_amount, $payment_contact, $payment_reason, $payment_date;

$date = new DateTime();
$datetime = $date->format('d-m-y'); 

while ($row_payment = $stmt->fetch(PDO::FETCH_ASSOC))
{
    extract($row_payment);
    
    $_SESSION["PAYMENT_BY"] = $PAYMENT_BY;
    $_SESSION["PAYMENT_TO"] = $PAYMENT_TO;
    $_SESSION["PAYMENT_METHOD"] = $PAYMENT_METHOD;
    $_SESSION["PAYMENT_BANK"] = $PAYMENT_BANK;
    $_SESSION["PAYMENT_AMOUNT"] = $PAYMENT_AMOUNT;
    $_SESSION["PAYMENT_CONTACT"] = $PAYMENT_CONTACT_NUMBER;
    $_SESSION["PAYMENT_REASON"] = $PAYMENT_REASON;
    $_SESSION["PAYMENT_DATE"] = $PAYMENT_DATE;
    
    $_SESSION["PAYMENT_DATE_FROM"] = $payment_date_from;
    $_SESSION["PAYMENT_DATE_TO"] = $payment_date_to;
    $_SESSION["DATE_PRINTED"] = $datetime;

}
    
require_once( "fpdf.php" );

class PDF extends FPDF
{
    /**
      Create the page header, main heading, and intro text
    **/

    function Header()
    {
        // Logo
        $this->Image($_SESSION["ORGANIZATION_LOGO"], 10, 1, 30); 
        $this->SetFont( 'Arial', '', 17 );
        $this->Cell( 0, 15, "PAYMENT DETAILS FROM ".$_SESSION["PAYMENT_DATE_FROM"]." TO ".$_SESSION["PAYMENT_DATE_TO"]."", 0, 0, 'C' );
        $this->Ln( 16 );

        // First Row       
        $this->SetY(40);
        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "PAYMENT BY:", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["PAYMENT_BY"], 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "PAYMENT TO: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["PAYMENT_TO"], 1, 0, 'C', false );

        $this->Ln( 5 );

        // Second Row      
        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "PAYMENT METHOD: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["PAYMENT_METHOD"], 1, 0, 'C', false );    

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "PAYMENT BANK: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["PAYMENT_BANK"], 1, 0, 'C', false );

        $this->Ln( 5 );

        // Third Row      
        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "PAYMENT METHOD: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["PAYMENT_METHOD"], 1, 0, 'C', false );    

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "PAYMENT DATE: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["PAYMENT_DATE"], 1, 0, 'C', false );

        $this->Ln( 5 );        

    }

    function Footer()
    {
        // Go to 1.5 cm from bottom
        $this->SetY(-100);

        for ( $i=0; $i<1; $i++ ) {
          $this->SetFont( 'Arial', 'B', 8 );
          $this->Cell( 80, 5, "ACCOUNT MANAGER'S SIGNATURE", 1, 0, 'C', false );
        }

        $this->SetY(-100);

        for ( $i=0; $i<1; $i++ ) {
          $this->SetX(110);
          $this->SetFont( 'Arial', 'B', 8 );
          $this->Cell( 80, 5, "EMPLOYEE'S SIGNATURE", 1, 0, 'C', false );
        }

        $this->SetY(-15);
        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 40, 0, "Date Printed: ".$_SESSION["DATE_PRINTED"], 0, 0, 'C', false );
    }
}
    
?>

<?php
    
/**
  Create the page header, main heading, and intro text
**/

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AddPage('P','A4');;
/***
  Serve the PDF
***/
ob_end_clean();
$pdf->Output( $_SESSION["VOUCHER_NAME"], "I" );
//session_destroy();
ob_end_flush();
    
?>

