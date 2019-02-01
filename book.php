<?php
require_once 'DB.php';
require_once 'function.php';

$db = new DB();

$numField = array(
    "org_price",
    "percentage_margin",
    "booking_price"
);

if(isset($_POST['BOOK_NOW']))
{
    $data = $_POST;
    $data['booking_id'] = getBookingId($data);
    $dt = new DateTime();
    $data['booking_date'] = $dt->format('Y-m-d H:i:s');
    
    
    
    unset($data['BOOK_NOW']);
    $fielsName = array_keys($data);
    
    $valueList = array();
    foreach($data as $field => $value){
        if(in_array($field, $numField))
            $valueList[] = $value;
        else
            $valueList[] = "'".$value."'";
    }
    
   $insertQuery = "INSERT INTO bookings (".implode(',',$fielsName).") VALUES (".implode(',',$valueList).")";
    
   $db->executeQuery($insertQuery); 
   
   /* AJAX check  */
   if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
       
       die("Booking completed successfully with booking id : ".$data['booking_id']." , Thank you for booking....");
   }
   else {
       die("Booking completed successfully with booking id :".$data['booking_id']." , Thank you for booking....<br/> 
            <a href='./'>Back to Listing</a>");
   }
   
  
}
else
    die("Invalid access");





