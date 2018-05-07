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
    /* Fill in your own connector here */
    //$connector = new FilePrintConnector("php://stdout");

    $connector = new WindowsPrintConnector("POS80");
    // Enter the share name for your USB printer here
    //$connector = new NetworkPrintConnector("39.44.125.146", 9100);

    $printer = new Printer($connector);
    $logo = EscposImage::load("resources/pos_logo.png", false);

    /* Information for the receipt */
    if(isset($_POST['data']))
    {
        $data = json_decode($_POST["data"]);
//        $waiter_id = $_POST["waiter_id"];
//        $table_id = $_POST["table_id"];
        $cust_id = $_POST["custid"];
//        $givenamount = 0;
//        $sql = "SELECT * FROM waiters WHERE id = '$waiter_id'";
//        $result = $conn->query($sql);
//        $waiter_name = "";
//        while($r = mysqli_fetch_assoc($result))
//        {
//          $waiter_name = $r['name'];
//        }
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

        /* Print top logo */
        $printer -> setJustification(Printer::JUSTIFY_CENTER);

        $type = 1;

        /* Name of shop */
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> bitImage($logo);
        $printer -> text("\n");
        $printer -> feed(1);

        if(isset($_POST['edit_type']))
        {
          $type = $_POST['edit_type'];
        }

        if($type == 0)
        {
            $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            //$printer -> text("CATCHY ATTIRE\n");
            $printer -> selectPrintMode();
            $printer -> text("www.catchyattire.com");
            $printer -> feed();
            $printer -> text("info@catchyattire.com");
            $printer -> feed();
            $printer -> text("+92-21-35378780-1");
            $printer -> feed();
            $printer -> text("Customer ID:".$cust_id);
            $printer -> feed(1);
            $printer -> selectPrintMode();
            //$printer -> text("Karachi.\n");
            //$printer -> feed();
            $printer -> selectPrintMode();

            $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);

            $printer -> selectPrintMode();
            $printer -> text("Cancel Order\n");
            //$printer -> feed();
            $printer -> selectPrintMode();

            /* Title of receipt */
            //$printer -> feed(1);

            //$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);

        }
        else
        {
            /* Name of shop */
            //            $printer -> setJustification(Printer::JUSTIFY_CENTER);
            //            $printer -> bitImage($logo);
            //            $printer -> feed(1);

            $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            //$printer -> text("CATCHY ATTIRE\n");
            $printer -> selectPrintMode();
            $printer -> text("www.catchyattire.com");
            $printer -> feed();
            $printer -> text("info@catchyattire.com");
            $printer -> feed();
            $printer -> text("+92-21-35378780-1");
            $printer -> feed();
            $printer -> text("Customer ID:".$cust_id);
            $printer -> feed(1);
            $printer -> selectPrintMode();
            //$printer -> text("Karachi.\n");
            //$printer -> feed();
            $printer -> selectPrintMode();

            $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);

            $printer -> selectPrintMode();
            $printer -> text("Order Receipt\n");
            //$printer -> feed();
            $printer -> selectPrintMode();

            /* Title of receipt */
            //$printer -> feed(1);
        }

        /* Items */
        //$printer -> setJustification(Printer::JUSTIFY_LEFT);
        $printer -> setEmphasis(true);
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> text(new item('ITEM', 'QUANTITY'));
        $printer -> text(new item('----', '--------'));
        //$printer -> feed(1);
        $printer -> setEmphasis(false);

        $printer -> setJustification(Printer::JUSTIFY_LEFT);
        //$printer -> setEmphasis(true);

        foreach ($items as $item)
        {
            $printer -> text($item);
        }

        $printer -> setEmphasis(true);
        //$printer -> text($subtotal);
        $printer -> setEmphasis(false);
        $printer -> feed();

        /* Tax and total */
        //$printer -> text($tax);
        $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        //$printer -> text($total);
        $printer -> selectPrintMode();

        /* Footer */
        //$printer -> feed(1);
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        //$printer -> text("Thank you for stopping by at Dilpasand Sweets\n");
        //$printer -> text("For trading hours, please visit http://www.dilpasandsweets.com");
        //$printer -> feed(1);
        $printer -> text($datetime . "\n");
        $printer -> feed(1);

        /* Cut the receipt and open the cash drawer */
        $printer -> cut();
        $printer -> pulse();
    }
    $printer -> close();
    /*   *****************************************   PRINT KITCHEN RECIEPT ENDS ************************************    */
}
catch (Exception $e)
{
    echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
}

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
        $rightCols = 20;
        $leftCols = 28;
        if ($this -> dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this -> name, $leftCols) ;

        $sign = ($this -> dollarSign ? '$ ' : '');
        $right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}
