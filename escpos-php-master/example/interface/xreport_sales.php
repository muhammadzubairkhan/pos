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
        $takeaway_total_amount = 0;
        $dinein_total_amount = 0;
        $damage_total_amount = 0;

        $type = $_POST['type'];
        $report_type = $_POST['report_type'];

        if(isset($_POST['datefrom_zreport']) && isset($_POST['datefrom_zreport']))
        {
            $datefrom_zreport = $_POST['datefrom_zreport'];
            $dateto_zreport = $_POST['dateto_zreport'];
        }

        $data = json_decode($_POST["data"]);    
    } 

    /*   *****************************************   PRINT X SALES REPORT ************************************    */

    $i = 0;

    //PRINT MAIN FUNCTIONS

    $date = new DateTime();
    $datetime = $date->format('Y-m-d H:i:s');

    /* Start the printer */
    $printer = new Printer($connector);
    
    $logo = EscposImage::load("resources/pos_logo.png", false);
    
    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    $printer -> bitImage($logo);
    $printer -> feed(1);

    /* Print top logo */
    $printer -> setJustification(Printer::JUSTIFY_CENTER);

    //SETTING COMPANY NAME
    
    $sql_company = "SELECT * from pos_config";
    $result_company = $conn->query($sql_company);
    $row_company = mysqli_fetch_assoc($result_company);

    $company_name = $row_company['company_name'];
    
    /* Name of shop */
    $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
    //$printer -> text($company_name."\n");
    //$printer -> selectPrintMode();
    $printer -> feed();
    $printer -> selectPrintMode();

    $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);

    $printer -> selectPrintMode();

    $printer -> text("www.catchyattire.com");
    $printer -> feed();
    $printer -> text("info@catchyattire.com");
    $printer -> feed();
    $printer -> text("+92-21-35378780-1");
    $printer -> feed();
    
    if($type == "takeaway" && $report_type == "x-report")
    {
        $takeaway_total_amount = $_POST['takeaway_total_amount'];
        $printer -> text("X SALES REPORT - TAKEAWAY\n");
        $printer -> feed();
        $printer -> selectPrintMode();
    }
    else if($type == "order" && $report_type == "x-report")
    {
        $dinein_total_amount = $_POST['dinein_total_amount'];
        $printer -> text("X SALES REPORT - ORDER\n");
        $printer -> feed();
        $printer -> selectPrintMode();
    }
    else if($type == "damage" && $report_type == "x-report")
    {
        $damage_total_amount = $_POST['damage_total_amount'];
        $printer -> text("X SALES REPORT - DAMAGE\n");
        $printer -> feed();
        $printer -> selectPrintMode();
    }
    else if($type == "takeaway" && $report_type == "z-report")
    {
        $takeaway_total_amount = $_POST['takeaway_total_amount'];
        $printer -> text("Z SALES REPORT - TAKEAWAY\n");
        //$printer -> feed(0.5);
        $printer -> text("FROM: ".$datefrom_zreport."  TO: ".$dateto_zreport."\n");
        $printer -> feed();
        $printer -> selectPrintMode();
    }
    else if($type == "order" && $report_type == "z-report")
    {
        $dinein_total_amount = $_POST['dinein_total_amount'];
        $printer -> text("Z SALES REPORT - ORDER\n");
        //$printer -> feed(0.5);
        $printer -> text("FROM: ".$datefrom_zreport."  TO: ".$dateto_zreport."\n");
        $printer -> feed();
        $printer -> selectPrintMode();
    }
    else if($type == "damage" && $report_type == "z-report")
    {
        $damage_total_amount = $_POST['damage_total_amount'];
        $printer -> text("Z SALES REPORT - DAMAGE\n");
        $printer -> text("FROM: ".$datefrom_zreport."  TO: ".$dateto_zreport."\n");
        $printer -> feed();
        $printer -> selectPrintMode();
    }

    /* Items */
    $printer -> setEmphasis(true);
    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    if($type == "takeaway" || $type == "order")
    {
        $printer -> text("------------------------------------------------\n");
        $printer -> text(new item('NAME', 'QTY', 'PRICE'));
        $printer -> text("------------------------------------------------\n");
    }
    else if($type == "damage")
    {
        $printer -> text("------------------------------------------------\n");
        $printer -> text(new item('NAME', 'NO.DMG', 'PRICE'));
        $printer -> text("------------------------------------------------\n");
    }
    $printer -> setEmphasis(false);

    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    $printer -> setEmphasis(false);

    foreach ($data as $item) 
    {
        $printer -> setJustification(Printer::JUSTIFY_CENTER);

        if($type == "takeaway")
        {
            $printer -> text(new item($item->p_name, $item->quantity, $item->totalprice));
        }
        else if($type == "order")
        {
            $printer -> text(new item($item->p_name, $item->quantity, $item->totalprice));
        }
        else if($type == "damage")
        {
            $printer -> text(new item($item->p_name, $item->no_of_damages, $item->totalprice));
        }
    }

    if($type == "takeaway")
    {
        $printer -> text("------------------------------------------------\n");
        $printer -> text(new item("TOTAL AMOUNT:", "", $takeaway_total_amount));
        $printer -> text("------------------------------------------------\n");
    }
    else if($type == "order")
    {
        $printer -> text("------------------------------------------------\n");
        $printer -> text(new item("TOTAL AMOUNT:", "", $dinein_total_amount));
        $printer -> text("------------------------------------------------\n");
    }
    else if($type == "damage")
    {
        $printer -> text("------------------------------------------------\n");
        $printer -> text(new item("TOTAL AMOUNT:", "", $damage_total_amount));
        $printer -> text("------------------------------------------------\n");
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
    $printer -> text("____________________________________________\n");
    $printer -> text($datetime . "\n");
    $printer -> feed(1);

    /* Cut the receipt and open the cash drawer */
    $printer -> cut();
    $printer -> pulse();

    $printer -> close();

    /*   *****************************************   PRINT KITCHEN RECIEPT ENDS ************************************    */
}
catch(Exception $e)
{
    echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
}

/* A wrapper to do organise item names & prices into columns */
class item
{
    private $name;
    private $price;
    private $quantity;

    public function __construct($name = '', $quantity = '', $price = '')
    {
        $this -> name = $name;
        $this -> price = $price;
        $this -> quantity = $quantity;
    }

    public function __toString()
    {
        $left = str_pad($this -> name, 27);

        $right = str_pad($this -> price, 10);
        $center = str_pad($this -> quantity, 10);
        return "$left$center$right\n";
    }
}