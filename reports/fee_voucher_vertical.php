<?php

ob_start();
session_start();

$student_id = $_GET['id'];

// get database connection
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

include_once '../object/student_payment.php';

$payment = new Student_Payment($db);
$stmt = $payment->viewAllPaymentById($student_id);


while ($row_payment = $stmt->fetch(PDO::FETCH_ASSOC))
{
extract($row_payment);

//{$CLASS_NAME}
//{$GR_NO}
//{$TITLE}
//{$DESCRIPTION}
//{$TOTAL}
//{$PAYMENT_DATE}
//{$STATUS}
//{$PAYMENT_METHOD}
                        
$date = new DateTime();
$datetime = $date->format('d-m-y');

if(!isset($_SESSION["VOUCHER_NAME"]))
{
    $_SESSION["DATE_PRINTED"] = $datetime;
    $_SESSION["VOUCHER_NAME"] = "fee_voucher_".$_SESSION["DATE_PRINTED"].".pdf";

    //ORGANIZATION DETAILS

    $_SESSION["ORGANIZATION_LOGO"] = "logo.png";
    $_SESSION["ORGANIZATION_NAME"] = "org name";
    $_SESSION["BANK_ADDRESS"] = "bank address";
    $_SESSION["ADDRESS"] = "address";

    //VOUCHER DETAILS

    $_SESSION["VOUCHER_NUMBER"] = "number";
    $_SESSION["DATE_ISSUED"] = $datetime;

    //STUDENT BIO

    $_SESSION["STUDENT_NAME"] = "student name";
    $_SESSION["FATHER_NAME"] = "father name";
    $_SESSION["GR_NO"] = $GR_NO;
    $_SESSION["ROLL_NO"] = $GR_NO;
    $_SESSION["CLASS"] = $CLASS_NAME;
    $_SESSION["SECTION"] = "section";
    $_SESSION["MONTH"] = "month";


    //PAYMENT DETAILS

    $_SESSION["ADMISSION_FEE"] = "admission fee";
    $_SESSION["MONTHLY_FEE"] = "monthly fee";
    $_SESSION["COMP_LAB_FEE"] = "comp/sci lab fee";
    $_SESSION["ANNUAL_FEE"] = "annual fee";
    $_SESSION["BOARD_FEE"] = "board fee";
    $_SESSION["CAUTION_MONEY"] = "caution money";
    $_SESSION["LATE_FEE"] = "late fee";
    $_SESSION["ARREARS"] = "arrears";
    $_SESSION["FEE_UPTO_DUE_DATE"] = "total fee upto due date";
    $_SESSION["DUE_DATE"] = $PAYMENT_DATE;
    $_SESSION["FEE_AFTER_DUE_DATE"] = "total fee after due date";
}

require_once( "fpdf.php" );


class PDF extends FPDF
{
    /**
      Create the page header, main heading, and intro text
    **/
    
    function Header()
    {                  
        
            //STUDENT COPY
            $this->SetY(0); 
            $this->SetFont( 'Arial', 'B', 8 );
            $this->Cell(80, 8, "Student's Copy", 1, 0, 'C');
            $this->Ln( 4 );
        
            //Logo
            $this->Image($_SESSION["ORGANIZATION_LOGO"], 30, 10, 33);
        
            $this->SetX(25);
            $this->SetFont( 'Arial', 'B', 11 );
            $this->Cell( 25, 40, $_SESSION["ORGANIZATION_NAME"], 0, 0, 'L' );
            $this->Ln( 4 );    
        
            $this->SetX(35);
            $this->SetFont( 'Arial', '', 10 );
            $this->Cell( 0, 40, $_SESSION["BANK_ADDRESS"], 0, 0, 'L' );
            $this->Ln( 4 );        

            $this->SetX(35);
            $this->SetFont( 'Arial', '', 10 );
            $this->Cell( 0, 40, $_SESSION["ADDRESS"], 0, 0, 'L' );
            $this->Ln( 16 ); 
        
            // First Row (Student's Copy)        
        
            $this->SetY(40);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, "Voucher #", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, $_SESSION["VOUCHER_NUMBER"], 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, "Issue Date", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, $_SESSION["DATE_PRINTED"], 1, 0, 'C', false );

            $this->Ln( 10 );
        
            // Second Row (Student's Copy)

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Student's Name:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["STUDENT_NAME"], 1, 0, 'C', false );

            $this->Ln( 5 );
        
            // Third Row (School's Copy)
        
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Father's Name:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["FATHER_NAME"], 1, 0, 'C', false );

            $this->Ln( 5 );
        
            // Fourth Row

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, "GR No:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, $_SESSION["GR_NO"], 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, "Roll No:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, $_SESSION["ROLL_NO"], 1, 0, 'C', false );

            $this->Ln( 5 );
        
            // Fifth Row

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, "Class:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, $_SESSION["CLASS"], 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, "Section:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, $_SESSION["SECTION"], 1, 0, 'C', false );

            $this->Ln( 5 );
        
            // Sixth Row

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 10, "For the month of:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 10, $_SESSION["MONTH"], 1, 0, 'C', false );  

            $this->Ln( 15 );
        
            // 7th Row

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Particulars:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Amount (Rs.)", 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 8th Row

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Admission Fee", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["ADMISSION_FEE"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 9th Row

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Monthly Fee", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["MONTHLY_FEE"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 10th Row

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Comp/Sci Lab Fee", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["COMP_LAB_FEE"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 11th Row

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Annual Fee", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["ANNUAL_FEE"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 12th Row

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Board Fee", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["BOARD_FEE"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 13th Row

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Caution Money", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["CAUTION_MONEY"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 14th Row

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Late Fee", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["LATE_FEE"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 15th Row

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Arrears", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["ARREARS"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 16th Row

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 10, "Total (Upto Due Date)", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 10, $_SESSION["FEE_UPTO_DUE_DATE"], 1, 0, 'C', false ); 

            $this->Ln( 15 );

            // 17th Row

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Due Date:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["DUE_DATE"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 18th Row

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "After Due Date:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["FEE_AFTER_DUE_DATE"], 1, 0, 'C', false );
        
        
        
        
        
        
        
        
            // First Row (Bank's Copy)

            $this->SetY(40);
            $this->SetX(110);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, "Voucher #", 1, 0, 'C', false );
        
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, $_SESSION["VOUCHER_NUMBER"], 1, 0, 'C', false );
        
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, "Issue Date", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, $_SESSION["DATE_ISSUED"], 1, 0, 'C', false );

            $this->Ln( 10 );
        
            // Second Row (Bank's Copy)
        
            $this->SetX(110);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Student's Name:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["STUDENT_NAME"], 1, 0, 'C', false );

            $this->Ln( 5 );
        
            // Third Row (School's Copy)
        
            $this->SetX(110);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Father's Name:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["FATHER_NAME"], 1, 0, 'C', false );

            $this->Ln( 5 );
        
            // Fourth Row
            
            $this->SetX(110);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, "GR No:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, $_SESSION["GR_NO"], 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, "Roll No:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, $_SESSION["ROLL_NO"], 1, 0, 'C', false );

            $this->Ln( 5 );
        
            // Fifth Row
            
            $this->SetX(110);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, "Class:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, $_SESSION["CLASS"], 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, "Section:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, $_SESSION["SECTION"], 1, 0, 'C', false );

            $this->Ln( 5 );
        
            // Sixth Row
            
            $this->SetX(110);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 10, "For the month of:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 10, $_SESSION["MONTH"], 1, 0, 'C', false );  

            $this->Ln( 15 );
        
            // 7th Row
            
            $this->SetX(110);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Particulars:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Amount (Rs.)", 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 8th Row

            $this->SetX(110);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Admission Fee", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["ADMISSION_FEE"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 9th Row
        
            $this->SetX(110);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Monthly Fee", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["MONTHLY_FEE"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 10th Row
            
            $this->SetX(110);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Comp/Sci Lab Fee", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["COMP_LAB_FEE"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 11th Row

            $this->SetX(110);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Annual Fee", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["ANNUAL_FEE"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 12th Row

            $this->SetX(110);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Board Fee", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["BOARD_FEE"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 13th Row

            $this->SetX(110);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Caution Money", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["CAUTION_MONEY"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 14th Row

            $this->SetX(110);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Late Fee", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["LATE_FEE"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 15th Row

            $this->SetX(110);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Arrears", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["ARREARS"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 16th Row

            $this->SetX(110);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 10, "Total (Upto Due Date)", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 10, $_SESSION["FEE_UPTO_DUE_DATE"], 1, 0, 'C', false ); 

            $this->Ln( 15 );

            // 17th Row

            $this->SetX(110);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Due Date:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["DUE_DATE"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 18th Row

            $this->SetX(110);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "After Due Date:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["FEE_AFTER_DUE_DATE"], 1, 0, 'C', false );
        
        
        
        
        
        
        
        
            // First Row (School's Copy)

            $this->SetY(40);
            $this->SetX(210);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, "Voucher #", 1, 0, 'C', false );
        
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, $_SESSION["VOUCHER_NUMBER"], 1, 0, 'C', false );
        
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, "Issue Date", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, $_SESSION["DATE_ISSUED"], 1, 0, 'C', false );

            $this->Ln( 10 );
        
            // Second Row (School's Copy)
        
            $this->SetX(210);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Student's Name:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["STUDENT_NAME"], 1, 0, 'C', false );

            $this->Ln( 5 );
        
            // Third Row (School's Copy)
        
            $this->SetX(210);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Father's Name:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["FATHER_NAME"], 1, 0, 'C', false );

            $this->Ln( 5 );
        
            // Fourth Row
            
            $this->SetX(210);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, "GR No:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, $_SESSION["GR_NO"], 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, "Roll No:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, $_SESSION["ROLL_NO"], 1, 0, 'C', false );

            $this->Ln( 5 );
        
            // Fifth Row

            $this->SetX(210);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, "Class:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, $_SESSION["CLASS"], 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, "Section:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 20, 5, $_SESSION["SECTION"], 1, 0, 'C', false );

            $this->Ln( 5 );
        
            // Sixth Row

            $this->SetX(210);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 10, "For the month of:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 10, $_SESSION["MONTH"], 1, 0, 'C', false );  

            $this->Ln( 15 );
        
            // 7th Row
            
            $this->SetX(210);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Particulars:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Amount (Rs.)", 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 8th Row

            $this->SetX(210);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Admission Fee", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["ADMISSION_FEE"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 9th Row
        
            $this->SetX(210);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Monthly Fee", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["MONTHLY_FEE"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 10th Row
            
            $this->SetX(210);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Comp/Sci Lab Fee", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["COMP_LAB_FEE"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 11th Row

            $this->SetX(210);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Annual Fee", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["ANNUAL_FEE"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 12th Row

            $this->SetX(210);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Board Fee", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["BOARD_FEE"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 13th Row

            $this->SetX(110);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Caution Money", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["CAUTION_MONEY"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 14th Row

            $this->SetX(210);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Late Fee", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["LATE_FEE"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 15th Row

            $this->SetX(210);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Arrears", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["ARREARS"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 16th Row

            $this->SetX(210);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 10, "Total (Upto Due Date)", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 10, $_SESSION["FEE_UPTO_DUE_DATE"], 1, 0, 'C', false ); 

            $this->Ln( 15 );

            // 17th Row

            $this->SetX(210);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "Due Date:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["DUE_DATE"], 1, 0, 'C', false ); 

            $this->Ln( 5 );

            // 18th Row

            $this->SetX(210);
            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, "After Due Date:", 1, 0, 'C', false );

            $this->SetFont( 'Arial', 'I', 8 );
            $this->Cell( 40, 5, $_SESSION["FEE_AFTER_DUE_DATE"], 1, 0, 'C', false );
        
        
        
        

            

            

            

            
        
        //-----------------------------------------------------------------------//
        
            //BANK COPY
            $this->SetY(0); 
            $this->SetX(110);
            $this->SetFont( 'Arial', 'B', 8 );
            $this->Cell(80, 8, "Bank's Copy", 1, 0, 'C');
            $this->Ln( 4 );

            //Logo
            $this->Image($_SESSION["ORGANIZATION_LOGO"], 135, 10, 33);
        
            $this->SetX(125);
            $this->SetFont( 'Arial', 'B', 11 );
            $this->Cell( 25, 40, $_SESSION["ORGANIZATION_NAME"], 0, 0, 'L' );
            $this->Ln( 4 ); 
        
            $this->SetX(135);
            $this->SetFont( 'Arial', '', 10 );
            $this->Cell( 0, 40, $_SESSION["BANK_ADDRESS"], 0, 0, 'L' );
            $this->Ln( 4 );        

            $this->SetX(135);
            $this->SetFont( 'Arial', '', 10 );
            $this->Cell( 0, 40, $_SESSION["ADDRESS"], 0, 0, 'L' );
            $this->Ln( 16 ); 
        
        
        //-----------------------------------------------------------------------//
            
            //SCHOOL COPY
            $this->SetY(0); 
            $this->SetX(210);
            $this->SetFont( 'Arial', 'B', 8 );
            $this->Cell(80, 8, "School's Copy", 1, 0, 'C');
            $this->Ln( 4 );
        
            //Logo
            $this->Image($_SESSION["ORGANIZATION_LOGO"], 235, 10, 33);
        
            $this->SetX(225);
            $this->SetFont( 'Arial', 'B', 11 );
            $this->Cell( 25, 40, $_SESSION["ORGANIZATION_NAME"], 0, 0, 'L' );
            $this->Ln( 4 );    
        
            $this->SetX(235);
            $this->SetFont( 'Arial', '', 10 );
            $this->Cell( 0, 40, $_SESSION["BANK_ADDRESS"], 0, 0, 'L' );
            $this->Ln( 4 );        

            $this->SetX(235);
            $this->SetFont( 'Arial', '', 10 );
            $this->Cell( 0, 40, $_SESSION["ADDRESS"], 0, 0, 'L' );
            $this->Ln( 16 );

        //-----------------------------------------------------------------------//         
             
    }
    
    function Footer()
    {
        // Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        //$this->SetFont('Arial','I',7);
        // Print centered page number
        //$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        
        for ( $i=0; $i<1; $i++ ) {
          $this->SetFont( 'Arial', 'I', 8 );
          $this->Cell( 80, 5, "This voucher is not valid after: ".$_SESSION["DUE_DATE"], 1, 0, 'C', false );
          $this->Ln( 5 );
          $this->Cell( 80, 5, "Parents To Note", 0, 0, 'C', false );
        }
        
        $this->SetY(-15);
        
        for ( $i=0; $i<1; $i++ ) {
          $this->SetX(110);
          $this->SetFont( 'Arial', 'I', 8 );
          $this->Cell( 80, 5, "This voucher is not valid after: ".$_SESSION["DUE_DATE"], 1, 0, 'C', false );
          $this->Ln( 5 );
          $this->SetX(110);
          $this->Cell( 80, 5, "Parents To Note", 0, 0, 'C', false );
        }
        
        $this->SetY(-15);
        
        for ( $i=0; $i<1; $i++ ) {
          $this->SetX(210);
          $this->SetFont( 'Arial', 'I', 8 );
          $this->Cell( 80, 5, "This voucher is not valid after: ".$_SESSION["DUE_DATE"], 1, 0, 'C', false );
          $this->Ln( 5 );
          $this->SetX(210);
          $this->Cell( 80, 5, "Parents To Note", 0, 0, 'C', false );
        }
        
    }
}

/**
  Create the page header, main heading, and intro text
**/

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AddPage('L','A4');;
/***
  Serve the PDF
***/
ob_end_clean();
$pdf->Output( $_SESSION["VOUCHER_NAME"], "I" );
//session_destroy();
ob_end_flush();
    
}

?>