<?php
require_once 'SearchResult.php';
$search = new SearchResult();

$result = '';

if(empty($_POST))
    $_POST = array();

if($_GET['type'] == 'flight'){
    
    $result = $search->getFlightSearchOnly($_POST);
}
elseif($_GET['type'] == 'hotel'){
    $result = $search->getHotelSearchOnly($_POST);
}
elseif($_GET['type'] == 'package'){
    $result = $search->getDPSearchOnly($_POST);
}
else{
    die("search type not available");
}

echo $result;