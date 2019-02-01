<?php
require_once 'APICall.php';
require_once 'function.php';

/**
 *
 * @author root
 *        
 */
class SearchResult extends APICall
{


    protected $_flightListTemplate = '
    <li id="flight_{quoteReference}" class="list_block_li custom_block_li" data-percentage="{admin_flight_percentage}" data-price="{totalWithMarginPrice}" data-departure="{flight_outboundDepartureDate}" data-arrival="{flight_outboundArrivalDate}"  data-org_price="{totalPrice}">
    <div class="">
    <p class="outbound_departure_airport_code f">{flight_departureAirportCode}</p>
    <p class="departure_time f">&nbsp;&nbsp;{flight_departure_time}</p>
    <br>
    <p class="departure_airport f">{flight_departureAirport}</p>
    </div>
    <div>
    <p class="duration f">{flight_duration}&nbsp;({flight_outbound_leg_info})</p>
    </div>
    <div>
    <p class="outbound_arrival_airport_code f">{flight_arrivalAirportCode}</p>
    <p class="departure_time f">&nbsp;&nbsp;{flight_arraival_time}</p>
    <br>
    <p class="arrival_airport f">{flight_arrivalAirport}</p>
    </div>
    <div">
    <p class="amount f">{totalWithMarginPrice}</p><br/>
    <button onclick="javascript:fillFlightPopup(\'{quoteReference}\')" data-toggle="modal" data-target="#flightBookModal">Enquire</button><br><br>
    <a href="detail/flight.php?quoteReference={quoteReference}" >View Detail</a>
    </div>
    </li>

    /*<li id="flight_{quoteReference}" class="list_block_li" data-percentage="{admin_flight_percentage}" data-price="{totalWithMarginPrice}" data-departure="{flight_outboundDepartureDate}" data-arrival="{flight_outboundArrivalDate}"  data-org_price="{totalPrice}">
    <div style="width: 30%;">
    <p class="outbound_departure_airport_code f">{flight_departureAirportCode}</p>
    <p class="departure_time f">&nbsp;&nbsp;{flight_departure_time}</p>
    <br>
    <p class="departure_airport f">{flight_departureAirport}</p>
    </div>
    <div style="width: 30%;">
    <p class="duration f">{flight_duration}&nbsp;({flight_outbound_leg_info})</p>
    </div>
    <div style="width: 25%;">
    <p class="outbound_arrival_airport_code f">{flight_arrivalAirportCode}</p>
    <p class="departure_time f">&nbsp;&nbsp;{flight_arraival_time}</p>
    <br>
    <p class="arrival_apirrport f">{flight_arrivalAirport}</p>
    </div>
    <div style="width: 15%;">
    <p class="amount f">{totalWithMarginPrice}</p><br/>
    <button onclick="javascript:fillFlightPopup(\'{quoteReference}\')" data-toggle="modal" data-target="#flightBookModal">BOOK NOW</button><br><br>
    <a href="detail/flight.php?quoteReference={quoteReference}" >View Detail</a>
    </div>
    </li>*/
    ';
    
    protected $_hotelListTemplate = '
    <li id="hotel_{quoteReference}" class="list_block_li" data-percentage="{admin_flight_percentage}" data-price="{totalWithMarginPrice}" data-rating="{hotel_rating}"  data-org_price="{totalPrice}">
    <div style="width: 40%;">
    <p class="hotel_name f">{hotel_hotelName}</p><br/> 
    <p class="hotel_location" f">{hotel_resortName}</p>
    <br>
    <p class="hotel_rating f">
    <input type="text" class="rating "  value="{hotel_rating}" data-size="m" title=""/>
    </p>
    </div>
    <div style="width: 40%;">
    <p class="adult_children f">Adult : {hotel_rooms_0_adults}&nbsp;&nbsp;Child : ({hotel_rooms_0_children})</p>
    </div>
    <div style="width: 20%;">
    <p class="amount f">{totalWithMarginPrice}</p><br/>
    <button onclick="javascript:fillHotelPopup(\'{quoteReference}\')" data-toggle="modal" data-target="#flightBookModal">BOOK NOW</button><br><br>
    <a href="detail/hotel.php?quoteReference={quoteReference}" >View Detail</a>
    </div>
    </li>';
    
    
    protected $_packageListTemplate = '
    <li id="package_{quoteReference}" class="custom_block_li" data-percentage="{admin_flight_percentage}" data-price="{totalWithMarginPrice}" data-departure="{flight_outboundDepartureDate}" data-arrival="{flight_outboundArrivalDate}"  data-org_price="{totalPrice}">

<div class="main-li-data-dv" style="border-color:#3B5998;">
    <div class="top-bar-dv">
        <span class="hotel_name"><i class="fa fa-calendar" aria-hidden="true"></i> {hotel_hotelName}</span>
        <span class="hotel_rating"><input type="text" class="rating"  value="{hotel_rating}" data-size="m" title=""/>
		<p id="hotel-star">{hotel_rating}</p></span>
    </div>

    <div class="main-data-dv">
        <div class="img"><img src="img/BeachNoResults.jpg" alt="Image"></div>

        <div class="block_info">
            <div class="info_block">
                <div class="package_hotel_bx">
                    <p class="hotel_location"><i class="fa fa-map-marker" aria-hidden="true"></i> {hotel_resortName}</p>
                    <p class="adult_children"><i class="fa fa-child" aria-hidden="true"></i> Adult : {hotel_rooms_0_adults}&nbsp;&nbsp;Child : ({hotel_rooms_0_children})</p>
                </div>
                <div class="package_flight_bx">
                    <div>
                        <p><i class="fa fa-calendar" aria-hidden="true"></i></p>
                        <!--p class="outbound_departure_airport_code">{flight_departureAirportCode}</p-->
                        <p class="departure_time">{flight_departure_time}</p>
                        <p class="departure_airport">{flight_departureAirport}</p>
                    </div>
                    <div>
                        <p class="duration"><i class="fa fa-clock-o" aria-hidden="true"></i> {flight_duration}({flight_outbound_leg_info})</p>
                    </div>
                    <div>
                        <p><i class="fa fa-calendar" aria-hidden="true"></i></p>
                        <p class="outbound_arrival_airport_code">{flight_arrivalAirportCode}</p>
                        <p class="departure_time">{flight_arraival_time}</p>
                        <p class="arrival_airport">{flight_arrivalAirport}</p>
                    </div>
					<div>
                        <p class="board_type" id="{hotel_boardBasis}"><i class="fa fa-bed" aria-hidden="true"></i> {hotel_boardBasis}</p>
                    </div>
                    <div>
                        <p class="quote_ref"><i class="fa fa-comment" aria-hidden="true"></i> Quote Ref:{quoteReference}</p>
                    </div>
                    <p>&nbsp;</p>
                    <div>
                        <div>
                            <div><b>Opening Hours</b>: 8am to 11pm Daily</div>
                            <!--div><b>Financial Protection: </b>{tradingNameId}</div-->
                            <div>Detail & pricing accurate as of january 10th, 2019 at 15.43 PM</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="package_book_bx">
                <div class="amount-bx">
                    <div>from</div>
                    <div class="amount">&#163;{totalWithMarginPrice}</div>
                    <div>per person <span style="color:#1fb6fd;"><i class="fa fa-question-circle-o" aria-hidden="true"></i></span></div>
                </div>

                <div class="contact-bx-dv">
                    <div>call <b></b> on</div>
                    <div class="phone"><i class="fa fa-phone-square" aria-hidden="true"></i>0207 183 6982</div>
                    <div>or</div>
                    <!--div class="link"><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> Enquire Online</a></div-->
                </div>
                
                <button class="custom-btn" onclick="javascript:fillPackagePopup(\'{quoteReference}\')" data-toggle="modal" data-target="#flightBookModal">Enquire</button><br>
              
                <button class="custom-btn" onclick="window.open(\'detail/package.php?quoteReference={quoteReference}\',\'popUpWindow\',\'height=450,width=710,left=300,top=120,resizable=0,scrollbars=0,toolbar=0,menubar=0,location=0,directories=0, status=yes\');"><i class="fa fa-info-circle" aria-hidden="true"></i> Hotel Details</button>

            </div>
        </div>
    </div>
</div>

    </li>    
    ';
    
    /**
     * Render entity html block
     * 
     * @param stdClass $Object
     * @param string $template
     * @param string $prefix
     * @return string
     */
    protected function renderTemplate($Object,$template,$prefix =''){
        try {
            foreach($Object as $param => $data){

                $key = ((!empty($prefix))?$prefix.'_':'').$param;
                
                if(is_object($data) || is_array($data))
                    $template = $this->renderTemplate($data, $template, $key );
                else
                    $template = str_replace('{' . $key . '}', $data, $template);
            }
            
            return $template;
            
        } catch (\Exception $e) {

            die("Template rendering exception :". $e->getMessage());
        }
        
    }
    
    
    /**
     * Process Flight Api response to HTML
     */
    protected function _processBlockHTML($response,$type ="FLIGHT")
    {
        $html = "";
        
        foreach ($response->Results as $dataObj) {
            if($type != 'DP'){
                $temp = $this->renderTemplate($dataObj, ($type == 'FLIGHT')? $this->_flightListTemplate:$this->_hotelListTemplate);
                $html .= $this->_postRenderTemplate($temp, $dataObj);
            }else{
                $temp = $this->renderTemplate($dataObj,$this->_packageListTemplate);
                $html .= $this->_postRenderTemplate($temp, $dataObj);
            }
        }
        
        return $html;
    }
    
    
    protected function _postRenderTemplate($template, $object){


        $_flight_post_field = array(
            "flight_departure_time" => getFlightTime($object->flight->outboundDepartureDate),
            "flight_arraival_time" =>getFlightTime($object->flight->outboundArrivalDate),
            "flight_outbound_leg_info" => getOutboundLegInfo($object),
            "flight_duration" => getOutboundDuration($object),
            "flight_arrivalAirport" => getAirportName($object,"arrival"),
            "flight_departureAirport" => getAirportName($object,"departure"),
            "totalWithMarginPrice" => getPriceWithAdminMargin($object),
            "json_object" => json_encode($object),
            "admin_flight_percentage" => getAdminPercentageMargin()
        );
        
        
        
        return $this->renderTemplate($_flight_post_field, $template);
        
        
    }
    
    

    /**
     * get all flight from flight search and dp search
     *
     * @param array $parameter
     * @return string|mixed
     */
    /*public function getAllFlight($parameter = array())
    {
        $response = $this->_processBlockHTML($this->getAPIResponse($parameter, "FLIGHT"));
        $response .= $this->_processBlockHTML($this->getAPIResponse($parameter, ""));

        return $response;
    }*/

    
    /**
     * get all hotel from hotel search and dp search 
     *
     * @param array $parameter
     * @return string|mixed
     */
    /*public function getAllHotel($parameter = array())
    {
        $response = $this->_processBlockHTML($this->getAPIResponse($parameter, "HOTEL"),'HOTEL');
        $response .= $this->_processBlockHTML($this->getAPIResponse($parameter, ""),'HOTEL');
        
        return $response;
    }*/
    
    
    /**
     * get flight from flight search only
     *
     * @param array $parameter
     * @return string|mixed
     */
    public function getFlightSearchOnly($parameter = array())
    {
        $response = $this->_processBlockHTML($this->getAPIResponse($parameter, "FLIGHT"));
        
        return $response;
    }
    
    
    /**
     * get hotel from hotel search only
     *
     * @param array $parameter
     * @return string|mixed
     */
    public function getHotelSearchOnly($parameter = array())
    {
        $response = $this->_processBlockHTML($this->getAPIResponse($parameter, "HOTEL"),'HOTEL');
        
        return $response;
    }

    /**
     * get dp search only
     * @param array $parameter
     * @return string
     */
    public function getDPSearchOnly($parameter = array()){
        $response = $this->_processBlockHTML($this->getAPIResponse($parameter,""),"DP");
        
        return $response;
    }

    
}

