<?php

session_start();

$student_id = $_GET['id'];

// get database connection
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

include_once '../object/student_payment.php';

$payment = new Student_Payment($db);
$stmt_payment = $payment->viewAllPaymentById($student_id);

while ($row_payment = $stmt_payment->fetch(PDO::FETCH_ASSOC))
{
    
extract($row_payment);
    
$_SESSION["TOTAL_FEE"] = $TOTAL;
$_SESSION["DATE"] = $PAYMENT_DATE;
$_SESSION["STATUS"] = $STATUS;
$_SESSION["PAYMENT_METHOD"] = $PAYMENT_METHOD;
$_SESSION["GR_NO"] = $GR_NO;

$date = new DateTime();
$datetime = $date->format('d-m-y');  

$_SESSION["DATE_PRINTED"] = $datetime;

$_SESSION["ORGANIZATION_LOGO"] = "logo.png";
$_SESSION["VOUCHER_NAME"] = "fee_slip_".$datetime.".pdf";

include_once '../object/student.php';

$student = new Student($db);
$stmt_student = $student->viewStudentByGr($student_id);
 
while ($row_student = $stmt_student->fetch(PDO::FETCH_ASSOC))
{
    
extract($row_student);

$_SESSION["STUDENT_NAME"] = $FIRST_NAME." ".$LAST_NAME;
$_SESSION["FATHER_NAME"] = $FATHER_NAME;
    
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
        $this->Cell( 0, 15, "FEE SLIP FOR THE MONTH OF ".$_SESSION["DATE"], 0, 0, 'C' );
        $this->Ln( 16 );

        // First Row       
        $this->SetY(40);
        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "STUDENT GR:", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["GR_NO"], 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "STUDENT NAME: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["STUDENT_NAME"], 1, 0, 'C', false );

        $this->Ln( 5 );

        // Second Row      
        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "TOTAL FEE: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["TOTAL_FEE"], 1, 0, 'C', false );    

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "STATUS: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["STATUS"], 1, 0, 'C', false );

        $this->Ln( 5 );

        // Third Row      
        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "PAYMENT METHOD: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["PAYMENT_METHOD"], 1, 0, 'C', false );    

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "PAYMENT DATE: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["DATE"], 1, 0, 'C', false );

        $this->Ln( 5 );
        
        // Logo
        $this->Image($_SESSION["ORGANIZATION_LOGO"], 10, 100, 30); 
        $this->SetFont( 'Arial', '', 17 );
        $this->Cell( 0, 115, "FEE SLIP FOR THE MONTH OF ".$_SESSION["DATE"], 0, 0, 'C' );
        $this->Ln( 16 );

        // First Row       
        $this->SetY(140);
        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "STUDENT GR:", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["GR_NO"], 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "STUDENT NAME: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["STUDENT_NAME"], 1, 0, 'C', false );

        $this->Ln( 5 );

        // Second Row      
        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "TOTAL FEE: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["TOTAL_FEE"], 1, 0, 'C', false );    

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "STATUS: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["STATUS"], 1, 0, 'C', false );

        $this->Ln( 5 );

        // Third Row      
        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "PAYMENT METHOD: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["PAYMENT_METHOD"], 1, 0, 'C', false );    

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "PAYMENT DATE: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["DATE"], 1, 0, 'C', false );

        $this->Ln( 5 );

        

    }

    function Footer()
    {
        // Go to 1.5 cm from bottom
        $this->SetY(-100);

        for ( $i=0; $i<1; $i++ ) {
          $this->SetFont( 'Arial', 'B', 8 );
          $this->Cell( 80, 5, "STUDENT NAME: ".$_SESSION["STUDENT_NAME"], 1, 0, 'C', false );
        }

        $this->SetY(-100);

        for ( $i=0; $i<1; $i++ ) {
          $this->SetX(110);
          $this->SetFont( 'Arial', 'B', 8 );
          $this->Cell( 80, 5, "STUDENT'S SIGNATURE", 1, 0, 'C', false );
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
//ob_end_flush();
    
}

?>

