<?php

session_start();

if(!isset($_SESSION["ORGANIZATION_NAME"]))
{
    $_SESSION["DATE_PRINTED"] = "date printed";
    $_SESSION["SALARY_SLIP_NAME"] = "salary_slip_".$_SESSION["DATE_PRINTED"].".pdf";

    //ORGANIZATION DETAILS

    $_SESSION["ORGANIZATION_LOGO"] = "logo.png";
    $_SESSION["ORGANIZATION_NAME"] = "org name";
    $_SESSION["EMPLOYEE_ID"] = "emp id";
    $_SESSION["EMPLOYEE_NAME"] = "emp name";

    //VOUCHER DETAILS

    $_SESSION["EMPLOYEE_DEPARTMENT"] = "emp depart";
    $_SESSION["EMPLOYEE_DESIGNATION"] = "emp designation";

    //STUDENT BIO

    $_SESSION["BANK_ACCOUNT"] = "bank account";
    $_SESSION["CHEQUE_NO"] = "cheque number";
    $_SESSION["EARNED_LEAVES"] = "earned leaves";
    $_SESSION["LEAVES"] = "leaves";
    $_SESSION["TOTAL_WORK_DAYS"] = "work days";
    $_SESSION["TOTAL_PRESENT"] = "present";
    $_SESSION["TOTAL_ABSENT"] = "absent";
    $_SESSION["TOTAL_HALF_DAY"] = "half days";
    $_SESSION["TOTAL_SALARY"] = "salary";
    $_SESSION["SALARY_PER_HOUR"] = "salary per month";
    $_SESSION["SALARY_PER_DAY"] = "salary per day";


    //PAYMENT DETAILS

    $_SESSION["BASIC_PAY"] = "basic pay";
    $_SESSION["OTHER_INCENTIVES"] = "incentives";
    $_SESSION["MEDICAL_ALLOWANCE"] = "medical allowance";
    $_SESSION["OTHER_ALLOWANCE"] = "other allowance";
    $_SESSION["INCOME_TAX"] = "income tax";
    $_SESSION["LOAN"] = "loan";
    $_SESSION["LATES"] = "lates";
    $_SESSION["EOBI_CONTRIBUTION"] = "eobi";
    $_SESSION["OTHER"] = "other";
    $_SESSION["TOTAL_DEDUCTIONS"] = "deduction";
    $_SESSION["DATE"] = "date";
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
        $this->Cell( 0, 15, "PAY SLIP FOR THE MONTH OF ".$_SESSION["DATE"], 0, 0, 'C' );
        $this->Ln( 16 );

        // First Row       
        $this->SetY(40);
        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "Employee ID:", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["EMPLOYEE_ID"], 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "Name: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["EMPLOYEE_NAME"], 1, 0, 'C', false );

        $this->Ln( 5 );

        // Second Row      
        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "Department: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["EMPLOYEE_DEPARTMENT"], 1, 0, 'C', false );    

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "Designation: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["EMPLOYEE_DESIGNATION"], 1, 0, 'C', false );

        $this->Ln( 5 );

        // Third Row      
        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "Bank Account: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["BANK_ACCOUNT"], 1, 0, 'C', false );    

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "Cheque No: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["CHEQUE_NO"], 1, 0, 'C', false );

        $this->Ln( 5 );

        // Fourth Row      
        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "Earned Leaves: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["EARNED_LEAVES"], 1, 0, 'C', false );    

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "Leaves: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["LEAVES"], 1, 0, 'C', false );

        $this->Ln( 5 );

        // Fifth Row      
        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "Total Work Days: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["TOTAL_WORK_DAYS"], 1, 0, 'C', false );    

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "Total Presents: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["TOTAL_PRESENT"], 1, 0, 'C', false );

        $this->Ln( 5 );

        // Sixth Row      
        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "Total Absents: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["TOTAL_ABSENT"], 1, 0, 'C', false );    

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "Total Half Days: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["TOTAL_HALF_DAY"], 1, 0, 'C', false );

        $this->Ln( 5 );

        // Seventh Row      
        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "Total Salary: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["TOTAL_SALARY"], 1, 0, 'C', false );    

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, "Salary Per Hour: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'I', 8 );
        $this->Cell( 45, 5, $_SESSION["SALARY_PER_HOUR"], 1, 0, 'C', false );

        $this->Ln( 5 );

        // Eight Row      
        $this->SetFont( 'Arial', 'B', 10 );
        $this->Cell( 90, 5, "Salary Per Day: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'B', 10 );
        $this->Cell( 90, 5, $_SESSION["SALARY_PER_DAY"], 1, 0, 'C', false );   

        $this->Ln( 5 );

        $this->SetFont( 'Arial', 'B', 10 );
        $this->Cell( 90, 5, "Total Salary of this Month: ", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'B', 10 );
        $this->Cell( 90, 5, $_SESSION["TOTAL_SALARY"], 1, 0, 'C', false );

        $this->Ln( 10 );

        // Ninth Row      
        $this->SetFont( 'Arial', 'B', 12 );
        $this->Cell( 45, 5, "Earnings", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'B', 12 );
        $this->Cell( 45, 5, "Amount", 1, 0, 'C', false );    

        $this->SetFont( 'Arial', 'B', 12 );
        $this->Cell( 45, 5, "Deductions", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'B', 12 );
        $this->Cell( 45, 5, "Amount", 1, 0, 'C', false );

        $this->Ln( 5 );

        // Tenth Row      
        $this->SetFont( 'Arial', 'B', 8 );
        $this->Cell( 45, 5, "Basic Pay", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'B', 8 );
        $this->Cell( 45, 5, $_SESSION["BASIC_PAY"], 1, 0, 'C', false );    

        $this->SetFont( 'Arial', 'B', 8 );
        $this->Cell( 45, 5, "Income Tax", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'B', 8 );
        $this->Cell( 45, 5, $_SESSION["INCOME_TAX"], 1, 0, 'C', false );

        $this->Ln( 5 );

        // 11th Row      
        $this->SetFont( 'Arial', 'B', 8 );
        $this->Cell( 45, 5, "Total Working Days", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'B', 8 );
        $this->Cell( 45, 5, $_SESSION["TOTAL_WORK_DAYS"], 1, 0, 'C', false );    

        $this->SetFont( 'Arial', 'B', 8 );
        $this->Cell( 45, 5, "Advances/Loan", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'B', 8 );
        $this->Cell( 45, 5, $_SESSION["LOAN"], 1, 0, 'C', false );

        $this->Ln( 5 );

        // 12th Row      
        $this->SetFont( 'Arial', 'B', 8 );
        $this->Cell( 45, 5, "Other Incentives", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'B', 8 );
        $this->Cell( 45, 5, $_SESSION["OTHER_INCENTIVES"], 1, 0, 'C', false );    

        $this->SetFont( 'Arial', 'B', 8 );
        $this->Cell( 45, 5, "Lates/Leaves", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'B', 8 );
        $this->Cell( 45, 5, $_SESSION["LATES"], 1, 0, 'C', false );

        $this->Ln( 5 );

        // 13th Row      
        $this->SetFont( 'Arial', 'B', 8 );
        $this->Cell( 45, 5, "Medical Allowance", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'B', 8 );
        $this->Cell( 45, 5, $_SESSION["MEDICAL_ALLOWANCE"], 1, 0, 'C', false );    

        $this->SetFont( 'Arial', 'B', 8 );
        $this->Cell( 45, 5, "EOBI Contribution", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'B', 8 );
        $this->Cell( 45, 5, $_SESSION["EOBI_CONTRIBUTION"], 1, 0, 'C', false );

        $this->Ln( 5 );

        // 14th Row      
        $this->SetFont( 'Arial', 'B', 8 );
        $this->Cell( 45, 5, "Other Allowance", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'B', 8 );
        $this->Cell( 45, 5, $_SESSION["OTHER_ALLOWANCE"], 1, 0, 'C', false );    

        $this->SetFont( 'Arial', 'B', 8 );
        $this->Cell( 45, 5, "Other", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'B', 8 );
        $this->Cell( 45, 5, $_SESSION["OTHER"], 1, 0, 'C', false );

        $this->Ln( 5 );

        // 15th Row      
        $this->SetFont( 'Arial', 'B', 12 );
        $this->Cell( 45, 5, "TOTAL SALARY", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'B', 12 );
        $this->Cell( 45, 5, $_SESSION["TOTAL_SALARY"], 1, 0, 'C', false );    

        $this->SetFont( 'Arial', 'B', 12 );
        $this->Cell( 45, 5, "TOTAL DEDUCTIONS", 1, 0, 'C', false );

        $this->SetFont( 'Arial', 'B', 12 );
        $this->Cell( 45, 5, $_SESSION["TOTAL_DEDUCTIONS"], 1, 0, 'C', false );

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

/**
  Create the page header, main heading, and intro text
**/

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

/***
  Serve the PDF
***/

$pdf->Output( $_SESSION["SALARY_SLIP_NAME"], "I" );


?>