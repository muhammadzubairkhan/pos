<?php
include("../../../include/dbconnect.php");
require __DIR__ . '/../../autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

/* Fill in your own connector here */
//$connector = new FilePrintConnector("php://stdout");

$connector = new WindowsPrintConnector("POS80");

/* Information for the receipt */
if(isset($_POST['data'])){
    
    $data = json_decode($_POST["data"]);
    $waiter_id = $_POST["waiter_id"];
    $table_id = $_POST["table_id"];
    $cust_id = $_POST["custid"];
    $givenamount = 0;
    
    
    
//      $sql = "SELECT * FROM restaurant_tables WHERE id = '$table_id'";
//     $result = $conn->query($sql);
//    $table_name = "";
//  while($r = mysqli_fetch_assoc($result)){
//      $table_name = $r['name'];
//      
//  }
    $sql = "SELECT * FROM waiters WHERE id = '$waiter_id'";
     $result = $conn->query($sql);
    $waiter_name = "";
  while($r = mysqli_fetch_assoc($result)){
      $waiter_name = $r['name'];
      
  }
//    $sql = "SELECT * FROM restaurant_tables WHERE id = '$table_id'";
//     $result = $conn->query($sql);
//    $table_name = "";
//  while($r = mysqli_fetch_assoc($result)){
//      $table_name = $r['name'];
//      
//  }
    
  //  echo $data[0]->p_id;
    //var_dump($data);
    
    
} 
    
//var_dump($items);
//foreach($items as $i){
//    
//    print_r($i);
//}

//



///* Items */
//$printer -> setJustification(Printer::JUSTIFY_LEFT);
//$printer -> setEmphasis(true);
//$printer -> text(new item('', 'Rs'));
//$printer -> setEmphasis(false);
//foreach ($items as $item) {
//    $printer -> text($item);
//}
//$printer -> setEmphasis(true);
//$printer -> text($subtotal);
//$printer -> setEmphasis(false);
//$printer -> feed();
//




//$subtotal = new item('Subtotal', '12.95');
//$tax = new item('A local tax', '1.30');
//$total = new item('Total', '14.25', true);
/* Date is kept the same for testing */
// $date = date('l jS \of F Y h:i:s A');
/*   *****************************************   PRINT KITCHEN RECIEPT STARTS ************************************    */
$i = 0;
   
foreach($data as $Object){

     $items = array();
    foreach($Object->data as $obj){
   
          echo var_dump($obj);
        $items[] = new item($obj->P_NAME,$obj->P_QUANTITY);
    }
         
    
$date = new DateTime();
$datetime = $date->format('Y-m-d H:i:s');

/* Start the printer */
//$logo = EscposImage::load("resources/escpos-php.png", false);
$printer = new Printer($connector);

/* Print top logo */
$printer -> setJustification(Printer::JUSTIFY_CENTER);
//$printer -> graphics($logo);

    $type = 1;
    if(isset($_POST['edit_type'])){
      $type = $_POST['edit_type'];
        
    }
    if($type == 0){
     //   $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer -> text("CANCEL.\n");
        }else{
/* Name of shop */
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> text("CATCHY ATTIRE.\n");
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


$printer -> text(new item('Waiter Name', $waiter_name));
$printer -> feed(1);
    }
/* Items */
//$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> setEmphasis(true);
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text(new item('NAME', 'QUANTITY'));
   $printer -> feed(1);
$printer -> setEmphasis(false);

$printer -> setJustification(Printer::JUSTIFY_LEFT);
//$printer -> setEmphasis(true);

foreach ($items as $item) {
    
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
$printer -> feed(1);
$printer -> text($datetime . "\n");
$printer -> feed(1);

/* Cut the receipt and open the cash drawer */
$printer -> cut();
$printer -> pulse();

$printer -> close();
}

/*   *****************************************   PRINT KITCHEN RECIEPT ENDS ************************************    */


///* A wrapper to do organise item names & prices into columns */
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
