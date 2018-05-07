<?php
include("../../../include/dbconnect.php");
require __DIR__ . '/../../autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

try 
{
    //SETTING PRINTER NAME

    $sql_printer = "SELECT * from pos_printer";
    $result_printer = $conn->query($sql_printer);
    $row_printer = mysqli_fetch_assoc($result_printer);

    $printer_name = $row_printer['printer_name'];

    $connector = new NetworkPrintConnector("172.16.1.242", 9100); //WindowsPrintConnector($printer_name);

    /* Information for the receipt */
    if(isset($_POST['data']))
    {
        $data = json_decode($_POST["data"]);
        $waiter_id = $_POST["waiter_id"];
        $table_id = $_POST["table_id"];
        $cust_id = $_POST["custid"];
        $givenamount = 0;

        $sql = "SELECT * FROM waiters WHERE id = '$waiter_id'";
        $result = $conn->query($sql);
        $waiter_name = "";
        while($r = mysqli_fetch_assoc($result))
        {
          $waiter_name = $r['name'];
        }   
    } 
    
    /*   *****************************************   PRINT KITCHEN RECIEPT STARTS ************************************    */
    $i = 0;
   
    foreach($data as $Object)
    {
        $items = array();
        foreach($Object->data as $obj)
        {
            echo var_dump($obj);
            $items[] = new item($obj->P_NAME,$obj->P_QUANTITY);
        }   

        $date = new DateTime();
        $datetime = $date->format('Y-m-d H:i:s');

        /* Start the printer */
        $printer = new Printer($connector);
        
        $logo = EscposImage::load("resources/pos_logo.png", false);
        
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> bitImage($logo);
        $printer -> feed(1);

        $printer -> text("www.catchyattire.com");
        $printer -> feed();
        $printer -> text("info@catchyattire.com");
        $printer -> feed();
        $printer -> text("+92-21-35378780-1");
        $printer -> feed();
        
        /* Print top logo */
        $printer -> setJustification(Printer::JUSTIFY_CENTER);

        $type = 1;

        if(isset($_POST['edit_type']))
        {
          $type = $_POST['edit_type'];
        }

        if($type == 0)
        {        
            $printer -> text("Cancel Order\n");
        }
        else
        {
            //SETTING COMPANY NAME
    
            $sql_company = "SELECT * from pos_config";
            $result_company = $conn->query($sql_company);
            $row_company = mysqli_fetch_assoc($result_company);

            $company_name = $row_company['company_name'];
            
            /* Name of shop */
            $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $printer -> text($company_name."\n");
            $printer -> selectPrintMode();
            $printer -> text("Karachi.\n");
            $printer -> feed();
            $printer -> selectPrintMode();
            $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $printer -> selectPrintMode();
            $printer -> text("Kitchen.\n");
            $printer -> feed();
            $printer -> selectPrintMode();

            /* Title of receipt */
            $printer -> feed(1);
        }

        /* Items */
        $printer -> setEmphasis(true);
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> text(new item('NAME', 'QUANTITY'));
        $printer -> feed(1);
        $printer -> setEmphasis(false);

        $printer -> setJustification(Printer::JUSTIFY_LEFT);    

        foreach ($items as $item) 
        {
            $printer -> text($item);
        }

        $printer -> setEmphasis(true);
        $printer -> setEmphasis(false);
        $printer -> feed();

        /* Tax and total */
        $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer -> selectPrintMode();

        /* Footer */
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> feed(1);
        $printer -> text($datetime . "\n");
        $printer -> feed(1);

        /* Cut the receipt and open the cash drawer */
        $printer -> cut();
        $printer -> pulse();

        $printer -> close();
    }
}
catch(Exception $e)
{
    echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
}
/*   *****************************************   PRINT KITCHEN RECIEPT ENDS ************************************    */

/* A wrapper to do organise item names & prices into columns */
class item
{
    private $name;
    private $price;
    private $dollarSign;

    public function __construct($name = '', $price = '', $dollarSign = false)
    {
        $this -> name = $name;
        $this -> price = $price;
        $this -> dollarSign = $dollarSign;
    }
    
    public function __toString()
    {
        $rightCols = 10;
        $leftCols = 38;
        if ($this -> dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this -> name, $leftCols) ;
        
        $sign = ($this -> dollarSign ? '$ ' : '');
        $right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}
