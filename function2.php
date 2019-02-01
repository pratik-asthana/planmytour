<?php

function getFlightTime($departureDatetime){
    $arr = explode("T",$departureDatetime);
    
    $time = explode(':',$arr[1]);
    unset($time[2]);
    
    $originalDate = $arr[0];
    $newDate = date("d/m/Y", strtotime($originalDate));
    
    return $newDate.','.implode(":",$time);
}


function getOutboundLegInfo($object){
    if(intval($object->flight->outboundLegCount) == 1)
        return "Non-Stop";
    else
        return $object->flight->outboundLegCount." Stop";
}


function getInboundLegInfo($object){
    if(intval($object->flight->inboundLegCount) == 1)
        return "Non-Stop";
        else
            return $object->flight->inboundLegCount." Stop";
}

function getOutboundDuration($object){
    $minute = $object->flight->outboundFlightDuration;
    
    $fullHour = intval($minute / 60);
    
    $modMinute = round($minute % 60,2);
    
    return $fullHour."h ".$modMinute."m";
}

function getInboundDuration($object){
    $minute = $object->flight->inboundFlightDuration;
    
    $fullHour = intval($minute / 60);
    
    $modMinute = round($minute % 60,2);
    
    return $fullHour."h ".$modMinute."m";
}


function getAirportName($object, $type="arrival"){
    
    
    $airportName = array(
        "STN" =>"Stansted, London, United Kingdom",
        "AGP" =>"Malaga, Spain"
    );
    
    $airportCode = ($type == 'arrival')?$object->flight->arrivalAirportCode:$object->flight->departureAirportCode;
    
    if(isset($airportName[$airportCode]))
        return $airportName[$airportCode];
    else
        return $airportCode; 
}

function getAdminPercentageMargin($adminUserId = 1){
    // admin price
    require_once 'DB.php';
    
    $db = new DB();
    
    $sql="select * from pricing where id='".$adminUserId."'";
    $commission = 0;
    $result= $db->executeQuery($sql);
    while($dac=mysqli_fetch_array($result))
    {
        $commission=$dac['commpercent'];
        break;
    }
    return floatval($commission)/100; // let's say it is 20%
}

function getPriceWithAdminMargin($object){
   
    
    $PercentMargin = getAdminPercentageMargin();  
    
    $marginprice = $object->totalPrice * $PercentMargin;
    
    return round($object->totalPrice + $marginprice,2);
    
}


function getBookingId($data){
    return strtoupper(md5(str_replace(' ','',$data["quote_reference"].$data['user_name'].time())));
}


/*
function getSourceAirportCodeForFlight(){
    // you put the static array for what the client will provide us
    return array(
        array(
            "airport" => 'STN',
            "city" => "Yorkshire",
            "type" => "optiongroup"
        ),
        array(
            "airport" => 'CGN',
            "city" => "Cologne",
            "type" => "option"
        ),
        array(
            "airport" => 'KRK',
            "city" => "Krakow"
        )
    );
}*/

/*
function getSourceAirportCodeForPackage(){
    $airports = getSourceAirportCodeForFlight();
    
    require_once 'DB.php';
    
    $db = new DB();
    foreach($airports as &$_airport){
        
        $sql="SELECT * FROM region_tree WHERE name LIKE '%{$_airport['city']}%' AND AirportCodes LIKE '%{$_airport['airport']}%'";
        
        $result= $db->executeQuery($sql);
        while($row=mysqli_fetch_array($result))
        {
            $_airport["resort_id"] = $row['Resort'];
        }
    }
    
    return $airports;
    
    
    
    return $return;
}*/
