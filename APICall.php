<?php

/** 
 * @author root
 * 
 */
class APICall
{

    protected $HOTELSEARCHAPI = "http://planmytour.website.api.ttss.net:8003/hotelSearch.php";

    protected $FLIGHTSEARCHAPI = "http://planmytour.website.api.ttss.net:8003/flightSearch.php";

    protected $HOTELFLIGHTSEARCHAPI = "http://planmytour.website.api.ttss.net:8003/dpSearch.php";

    protected $_commonSearchParameter = array(
        "adults" => 2,
        "children" => 0,
        "dateMin" => "2018-12-10", // must be in yyyy-mm-dd
        // "dateMax" => "2018-12-30", // must be in yyyy-mm-dd
        "flexibility" =>3,
        "durationMax" => 7,
        "durationMin" => 7,
        "maxResults" => 500,
        "outputFormat" => "json",
        "priceMax" => 99999,
        "priceMin" => 0,
        "boardType"=> 5,
        "rating"=> 45,
        
    );

    /**
     * this parameter will be used while HOTELFIGHTSEARCHAPI calling
     *
     * @var array
     */
    protected $_hotelSearchDefaultParameter = array(
        "boardType" => - 1,
        "departureId" => - 1,
        "destinationId" => 125,
		"priceMin"=>0,
		"priceMax"=>9999,
        "destinationType" => "Region",
        "rating" => - 1
    );

    protected $_flightSearchDefaultParameter = array(
        "fromAirports" => "STN",
        "toAirports" => "AGP"
    );

    protected $_catch = array();

    /*
    public function getFlightOnly($parameter = array())
    {
        try {
            $searchParameter = array_merge($this->_commonSearchParameter, $this->_flightSearchDefaultParameter);

            // merge search paramerter
            $searchParameter = array_merge($searchParameter, $parameter);

            $searchQueryString = array();
            foreach ($searchParameter as $key => $value)
                $searchQueryString[] = $key . "=" . $value;
            $searchQueryString = implode("&", $searchQueryString);

            $requestUrl = $this->FLIGHTSEARCHAPI . "?" . $searchQueryString;

            // get request from FLIGHT API
            if (! isset($this->_catch[$requestUrl]))
                $jsonResponse = file_get_contents($requestUrl);
            else
                $jsonResponse = $this->_catch[$requestUrl];

            if (empty($jsonResponse))
                throw new \Exception("EMPTY RESPONSE FROM FLIGHT API");
            else {
                $response = json_decode($jsonResponse);

                if ($response->Status != "success")
                    throw new \Exception("ERROR RESPONSE FROM FLIGHT API");
                else {
                    // process response.....

                    $this->_catch[$requestUrl] = $jsonResponse;

                    return $response;
                }
            }
        } catch (\Exception $e) {
            die("Error in FLIGHT API CALL : " . $e->getMessage());
        }
    }
*/
    protected  function getAPIResponse($parameter = array(), $type='FLIGHT')
    {
        
        try {
            
            //remove all blank parameter
            foreach($parameter as $key => $value){
                if(trim($parameter[$key]) == ''){
                    unset($parameter[$key]);
                }
            }
            
            
            if($type === 'FLIGHT')
                $searchParameter = array_merge($this->_commonSearchParameter, $this->_flightSearchDefaultParameter);
            else
                $searchParameter = array_merge($this->_commonSearchParameter, $this->_hotelSearchDefaultParameter);
            
            // merge search paramerter
            $searchParameter = array_merge($searchParameter, $parameter);

            
            
            $searchQueryString = array();
            foreach ($searchParameter as $key => $value)
                $searchQueryString[] = $key . "=" . $value;
            $searchQueryString = implode("&", $searchQueryString);

            if($type === 'FLIGHT')
                $requestUrl = $this->FLIGHTSEARCHAPI . "?" . $searchQueryString;
            elseif ($type === 'HOTEL')
                $requestUrl = $this->HOTELSEARCHAPI . "?" . $searchQueryString;
            else
                $requestUrl = $this->HOTELFLIGHTSEARCHAPI . "?" . $searchQueryString;
               
            //echo $requestUrl; exit();   // Api request...
            // get request from FLIGHT API
            if (! isset($this->_catch[$requestUrl]))
                $jsonResponse = file_get_contents($requestUrl);
            else
                $jsonResponse = $this->_catch[$requestUrl];

            if (empty($jsonResponse))
                throw new \Exception("Empty response from {$type} search, try again...");
            else {
                $response = json_decode($jsonResponse);

                if ($response->Status != "success")
                    throw new \Exception($response->Logs->Faults[0]->message);
                else {
                    // process response.....
                    if(!isset($this->_catch[$requestUrl]))
                        $this->_catch[$requestUrl] = $jsonResponse;
					//print_r($response);exit();
                    return $response;
                }
				
            }
        } catch (\Exception $e) {
            die("<li class=\"list_block_li\" ><center>" . $e->getMessage()."</center></li>");
        }
    }

    /**
     */
    function __destruct()
    {

        // TODO - Insert your code here
    }
}

