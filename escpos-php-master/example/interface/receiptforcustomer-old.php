<?php
include("../../../include/dbconnect.php");
require __DIR__ . '/../../autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;


try
{
    //SETTING PRINTER NAME

    //$sql_printer = "SELECT * from pos_printer";
    //$result_printer = $conn->query($sql_printer);
    //$row_printer = mysqli_fetch_assoc($result_printer);

    //$printer_name = $row_printer['printer_name'];
    $connector = new WindowsPrintConnector("POS80");
    // Enter the share name for your USB printer here
    //$connector = new NetworkPrintConnector("172.16.1.242", 9100); //WindowsPrintConnector($printer_name);
    //$connector = new WindowsPrintConnector("Receipt Printer");

    /* Print a "Hello world" receipt" */
    $printer = new Printer($connector);
    $logo = EscposImage::load("resources/pos_logo.png", false);
    $logo_footer = EscposImage::load("resources/footer_logo.jpg", false);

    /* Information for the receipt */
    if(isset($_POST['data']))
    {
        $data = json_decode($_POST["data"]);
        //$waiter_id = $_POST["waiter_id"];
        $cust_id = $_POST["custid"];
        $givenamount = $_POST["input_value"];
        $discount = $_POST["discount_percent"];
        $totalamount = $_POST["total_amount"];
    }

    $item =  array();

    foreach($data as $Object)
    {
       //var discounted_amount = (discounted_price/100)*price;
       //discounted_price = price - discounted_amount;

//       $price = $Object->p_price;
//       $discount = $Object->p_discount;
//       $discounted_amount = ($discount/100)*$price;
//       $discounted_price = $price - $discounted_amount;

       //$items[] = new item($Object->p_name.'('.$Object->p_quan.')',$Object->p_price*$Object->p_quan);
       $items[] = new item($Object->p_name, " ".$Object->p_price*$Object->p_quan, " ".$Object->p_quan, $Object->p_discount*$Object->p_quan);
       $amount += $Object->p_price*$Object->p_quan;
       $total_discount += $Object->p_discount*$Object->p_quan;
    }



    //$printer -> text($count);

    //SETTING COMPANY NAME

    $sql_company = "SELECT * from pos_config";
    $result_company = $conn->query($sql_company);
    $row_company = mysqli_fetch_assoc($result_company);

    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    $printer -> bitImage($logo);
    $printer -> feed(1);

    //$company_name = $row_company['company_name'];

    $date = new DateTime();
    $datetime = $date->format('d-m-Y H:i:s');

    $printer -> setJustification(Printer::JUSTIFY_CENTER);

    /* Name of shop */
    $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
    $printer -> text($company_name."\n");
    $printer -> selectPrintMode();
    $printer -> text("www.catchyattire.com");
    $printer -> feed();
    $printer -> text("info@catchyattire.com");
    $printer -> feed();
    $printer -> text("+92-21-35378780-1");
    $printer -> feed();
    $printer -> setJustification(Printer::JUSTIFY_LEFT);
    $printer -> feed();
    $printer -> text("Customer Receipt                No:".$cust_id);
    $printer -> feed();
    $printer -> feed();

    $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);

    $printer -> selectPrintMode();
    $printer -> setTextSize(7, 7);
    //$printer -> text("Customer Receipt\n");
    //$printer -> selectPrintMode();
    //$printer -> feed();
    //$printer -> setEmphasis(true);

    $printer -> setJustification(Printer::JUSTIFY_CENTER);

    //$printer -> text("------------------------------------------------\n");
    $printer -> text(new item('ITEMS', 'PRICE', 'QTY', 'AMOUNT'));
    //$printer -> text(new item('Items', 'Price'));
    $printer -> text(new item('-----', '-----', '---', '------'));
    //$printer -> feed();
    $printer -> setEmphasis(false);

    $printer -> setJustification(Printer::JUSTIFY_LEFT);

    //$count = count($items)."asdasd";

    foreach ($items as $item)
    {
        $printer -> text($item);
        //$printer -> text(new item($item));
        //$printer -> text("asdas");
    }

    //$count = count($items)."asdasd";

    $printer -> setEmphasis(false);
    //$printer -> selectPrintMode();
    $printer -> setJustification(Printer::JUSTIFY_LEFT);
    //$printer -> feed(1);
    $printer -> text(new endreceipt("", '--------', '------'));
    $total = new endreceipt("", 'Total', $totalamount);
    $printer -> text($total);
    $change = $givenamount - $total_discount;
    $printer -> text(new endreceipt("", 'Discount', $total_discount));
//    $printer -> text($dis);
    $printer -> text(new endreceipt("", 'Received', $givenamount));
//    $printer -> text($total);
    $printer -> text(new endreceipt("", 'Return', $change));
    //$printer -> text(new endreceipt("", '--------', '------'));
    //$printer -> text($total);
    $printer -> feed(1);
    $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
    //$printer -> text($total);
    $printer -> selectPrintMode();

    $printer -> setTextSize(8, 8);

    /* Footer */
    $printer -> setJustification(Printer::JUSTIFY_CENTER);

    $printer -> text($datetime . "\n");
    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    $printer -> bitImage($logo_footer);
    //$printer -> text("Powered By Echelon Tech Lab\n");
    //$printer -> text("Phone No: +92-213-437-088-0\n");
    $printer -> text("____________________________________________");
    $printer -> feed(1);
    $printer -> cut();

    /* Close printer */
    $printer -> close();
/*   *****************************************   PRINT Customer RECIEPT ENDS ************************************    */

}
catch (Exception $e)
{
    echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
}



/* A wrapper to do organise item names & prices into columns */
//class item
//{
//    private $name;
//    private $price;
//    private $dollarSign;
//
//    public function __construct($name = '', $price = '', $dollarSign = false)
//    {
//        $this -> name = $name;
//        $this -> price = $price;
//        $this -> dollarSign = $dollarSign;
//    }
//
//    public function __toString()
//    {
//        $rightCols = 10;
//        $leftCols = 38;
//        if ($this -> dollarSign) {
//            $leftCols = $leftCols / 2 - $rightCols / 2;
//        }
//        $left = str_pad($this -> name, $leftCols) ;
//
//        $sign = ($this -> dollarSign ? '$ ' : '');
//        $right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
//        return "$left$right\n";
//    }
//}

class item
{
    private $name;
    private $price;
    private $quantity;
    private $discounted_amount;

    public function __construct($name = '', $price = '', $quantity = '', $discounted_amount = '')
    {
        $this -> name = $name;
        $this -> price = $price;
        $this -> quantity = $quantity;
        $this -> discounted_amount = $discounted_amount;
    }

    public function __toString()
    {
        $left_name = str_pad($this -> name, 20, ' ', STR_PAD_RIGHT);
        $left_price = str_pad($this -> price, 15, ' ', STR_PAD_RIGHT);
        $center = str_pad($this -> quantity, 5);
        $right = str_pad($this -> discounted_amount, 7, ' ', STR_PAD_LEFT);

        return "$left_name$left_price$center$right\n";
    }
}

//class endreceipt
//{
//    private $name;
//    private $price;
//    private $quantity;
//
//    public function __construct($name = '', $quantity = '', $price = '')
//    {
//        $this -> name = $name;
//        $this -> price = $price;
//        $this -> quantity = $quantity;
//    }
//
//    public function __toString()
//    {
//        $left = str_pad($this -> name, 22);
//        $center = str_pad($this -> quantity, 18);
//        $right = str_pad($this -> price, 7);
//
//        return "$left$center$right\n";
//    }
//}

class endreceipt
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
        $left = str_pad($this -> name, 28, ' ', STR_PAD_RIGHT);
        $center = str_pad($this -> quantity, 12, ' ', STR_PAD_RIGHT);
        $right = str_pad($this -> price, 7, ' ', STR_PAD_LEFT);

        return "$left$center$right\n";
    }
}
