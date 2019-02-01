<?php require_once 'function.php'; ?><!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hotel-Flight API Search Listing</title>
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<link rel="stylesheet" href="./css/jquery-ui.css">
	<link rel="stylesheet" href="./css/listing.css">
	<link rel="stylesheet" href="./css/star-rating.css"  media="all" type="text/css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="./js/jquery-1.12.4.js"></script>
	<script src="./js/star-rating.js"></script>
	<script src="./js/jquery-ui.js"></script>
	<?php  /* ?><script src="./js/list.min.js"></script> <?php */ ?>
	<script src="./js/calendar.js"></script>
	<script src="./js/sort.js"></script>
	<script src="./js/listing.js"></script>
	<script src="./js/bootstrap.min.js"></script>

	<style>
	.parent{
        font-weight:bold;
        font-size:16px;
        margin-left:0px;
        color:black;
    }
    .child{
       
    }   margin-left: 4px !important;
	#hotel-star{
	color: #1fb6fd;
	}
	.filter_price_field{
		color:white;
	}
	.hide{
		display:none;
	}	
	.prema_hide{
		display:none;
	}
	#package_search_result_ul .custom_block_li {
	/*	display: none;*/
	}
	.pagination1 {
    display: inline-block;
    padding: 0;
    margin: 0;
}
#hotel-star{
    color:#3B5998;
}

    .pagination1 li{
        display: inline;
        color:  #3B5998
        border: 2px solid #3B5998;
        padding: 15px;
        font-size: 15px;
        font-weight: bold;
       
    }
    .pagination1 .active{
         display: inline;
        color: white;
        border: 2px solid #3B5998;
        padding: 15px;
        font-size: 16px;
        font-weight: bold;
        background-color: #3B5998;
    }
    .pagination1 a{
        padding:15px;
    }
   .pagination1 a:hover{
        padding:15px;
        color: white;
        background-color: #3B5998;
   }
   .btn-success{
    float: right;
    margin: 5px;
   }

	</style>

</head>
<body>
	<div id="tabs">
		<ul>
			<li><a href="#tabs-package">Package</a></li>
			<li><a href="#tabs-hotel">Hotel</a></li>
			<li><a href="#tabs-flight">Flight</a></li>
		</ul>

		<!-- Flight tab starts here -->
		<div id="tabs-flight">
			<div class="flight search view">
				<div class="row"><div class="form-group col-xs-5">	Source Airport : <input value="" type="text" class="fields flight_source_airport" placeholder="From" />
					<input type="hidden" value="" id="flight_source_airport" ></div>
								<?php /*?><select id="flight_source_airport">
								<?php foreach (getSourceAirportCodeForFlight() as $_airport):?>
								<option value="<?php echo $_airport['airport']; ?>"><?php echo $_airport['city'].' ( '.$_airport['airport'].' )'; ?></option>
								<?php endforeach;?>
								</select> <?php */ ?>



								&nbsp;&nbsp;&nbsp;
								<div class="form-group col-xs-5">	Destination Airport :


  

<input value="" type="text" class="fields flight_destination_airport" placeholder="To" >
									<input type="hidden" value="" id="flight_destination_airport" ><br /> <br /> </div></div>
									<div class="row"><div class="form-group col-xs-5">	From Date : <input	type="text" id="flight_from_date" class="fields" /></div>&nbsp;&nbsp;&nbsp; <div class="form-group col-xs-5">To Date : <input
										type="text" id="flight_to_date" class="fields"/></div></div>
										<div class="row">
											<div class="col-sm-12 search-btn-outer">
												<div class="search-btn">		
													<button onclick="javascript:doFlightSearch();" class="btn btn-primary" > SEARCH</button>
												</div>
											</div>
										</div>
									</div>

									<h3 class="f">Search Result</h3>
			<?php /*div class="filter">
				&nbsp;&nbsp;&nbsp;Price :
				<button
					onclick="javascript:Ascending = true;sortByNumber('flight_search_result_ul','price');">Accending</button>
				<button
					onclick="javascript:Ascending = false;sortByNumber('flight_search_result_ul','price');">Decending</button>
			</div>
			<div class="filter">
				&nbsp;&nbsp;&nbsp;Arrival :
				<button
					onclick="javascript:Ascending = true;sortByString('flight_search_result_ul','arrival');">Accending</button>
				<button
					onclick="javascript:Ascending = false;sortByString('flight_search_result_ul','arrival');">Decending</button>
			</div>
			<div class="filter">
				&nbsp;&nbsp;&nbsp;Departure :
				<button
					onclick="javascript:Ascending = true;sortByString('flight_search_result_ul','departure');">Accending</button>
				<button
					onclick="javascript:Ascending = false;sortByString('flight_search_result_ul','departure');">Decending</button>
					</div */?>
					<br />
					<hr />
					<div id="flight_search_result">
						<input type="text" class="fields search" /><div style="float:right;padding: 10px;">Total:<span id="flight_count">0</span></div>
						<!-- Flight search result -->
						
								<ul id="flight_search_result_ul" class="flight_search_result list_block_ul list">
								</ul>		
						
						
						<ul class="pagination"></ul>
						<!-- flight search result ends here -->

					</div>

				</div>
				<!-- flight tab ends here  -->
				<div id="tabs-hotel">
					<!--  hotel tab starts here -->
					<div class="hotel search view">
						<div class="row"><div class="form-group col-xs-4">	Destination : <input value="" placeholder="Choose destination" type="text" class="fields hotel_destinationId" />
							<input value="" type="hidden" id="hotel_destinationId" /></div>
							<?php /* ?><input value="" type="hidden" id="hotel_destinationType" /> <?php */ ?>&nbsp;&nbsp;&nbsp;
							<div class="form-group col-xs-4">	No. of people: <input value="" type="number" class="fields" id="flight_adults" /></div>
							<div class="form-group col-xs-3">	Type : <select id="hotel_boardType" class="fields">
								<option value="-1">All</option>
								<option value="9">Single</option>
								<option value="8">Share</option>
							</select></div></div><br /> <br /> 
							<div class="row"><div class="form-group col-xs-5">	From Date : <input	type="text" id="hotel_from_date" class="fields"/></div>&nbsp;&nbsp;&nbsp;<div class="form-group col-xs-5">To Date : <input
								type="text" id="hotel_to_date" class="fields" /></div></div>
								<div class="row">
									<div class="col-sm-12 search-btn-outer">
										<div class="search-btn">		
											<button onclick="javascript:doHotelSearch();" class="btn btn-primary" > SEARCH</button>
										</div>
									</div>
								</div>
							</div>

							<h3 class="f">Search Result</h3>
			<?php /* div class="filter">
				&nbsp;&nbsp;&nbsp;Price :
				<button
					onclick="javascript:Ascending = true;sortByNumber('hotel_search_result_ul','price');">Accending</button>
				<button
					onclick="javascript:Ascending = false;sortByNumber('hotel_search_result_ul','price');">Decending</button>
			</div>
			<div class="filter">
				&nbsp;&nbsp;&nbsp;Rating :
				<button
					onclick="javascript:Ascending = true;sortByString('hotel_search_result_ul','rating');">Accending</button>
				<button
					onclick="javascript:Ascending = false;sortByString('hotel_search_result_ul','rating');">Decending</button>
					</div */ ?>
					<br />
					<hr />
					<div id="hotel_search_result">
						<input type="text" class="fields search" /><div style="float:right;padding: 10px;">Total:<span id="hotel_count">0</span></div>
						<!-- Flight search result -->
						<ul id="hotel_search_result_ul" class="flight_search_result list_block_ul list">

						</ul>
						<ul class="pagination"></ul>
						<!-- flight search result ends here -->

					</div>
					<!-- hotel tab ends here -->
				</div>
				<div id="tabs-package">
					<!-- package tab start here -->
					<div class="package search view">
						<div class="row"><div class="form-group col-xs-2"> 	Source Airport : <?php /*input value="" type="text" class="fields package_source_airport" placeholder="From Airport" /*/?>
							<input type="hidden" value="" id="package_source_airports" > 
							<select class="fields package_source_airport" id="package_source_airport">
  <option id="Any London" value="-1" class="parent">Any London</option>
  <option id="London-Heathrow" value="71" class="child">London-Heathrow</option>
  <option id="London-Gatwick" value="70" class="child">London-Gatwick</option>
  <option id="London-City" value="69" class="child">London-City</option>
  <option id="London-Stansted" value="74" class="child">London-Stansted</option>
  <option id="London-Luton" value="72" class="child">London-Luton</option>
  <option id="London-Southend" value="73" class="child">London-Southend</option>
  <option id="Any North East / Yorkshire" value=""-10" class="parent">Any North East / Yorkshire</option>
  <option id="Any North West" value="-11" class="parent">Any North West</option>
  <option id="Newcastle" value="80" class="child">Newcastle</option>
  <option id="Liverpool" value="67" class="child">Liverpool</option>
  <option id="Manchester" value="77" class="child">Manchester</option>
  <option id="Blackpool" value="16" class="child">Blackpool</option>
  <option id="Humberside" value="55" class="child">Humberside</option>
  <option id="Leeds Bradford" value="66" class="child">Leeds Bradford</option>
  <option id="Doncaster" value="32" class="child">Doncaster</option>
  <option id="Teeside(Durham Tees Valley)" value="99" class="child">Teeside(Durham Tees Valley)</option>
  <option id="Any Scotland" value="-3" class="parent">Any Scotland</option>
  <option id="Aberdeen" value="4" class="child">Aberdeen</option>
  <option id="Edinburgh" value="37" class="child">Edinburgh</option>
  <option id="Glasgow" value="45" class="child">Glasgow</option>
  <option id="Glasgow  prestwick" value="46" class="child">Glasgow  prestwick</option>
  <option id="Inverness" value="56" class="child">Inverness</option>
  <option id="Any Midlands" value="-2" class="parent">Any Midlands</option>
  <option id="East Midlands" value="36" class="child">East Midlands</option>
  <option id="Birmingham" value="14" class="child">Birmingham</option>
  <option id="Norwich" value="84" class="child">Norwich</option>
  <option id="Coventry" value="30" class="child">Coventry</option>
  <option id="Any Northern Ireland" value="-7" class="parent">Any Northern Ireland</option>
  <option id="Any Ireland" value="-8" class="parent">Any Ireland</option>
  <option id="Belfast-International" value="10" class="child">Belfast-International</option>
  <option id="Belfast-City" value="9" class="child">Belfast-City</option>
  <option id="Dublin" value="34" class="child">Dublin</option>
  <option id="Any South East" value="-12" class="parent">Any South East</option>
  <option id="Southampton" value="95" class="child">Southampton</option>
  <option id="Doncaster Sheffield" value="32" class="child">Doncaster Sheffield</option>
  <option id="Bournemouth" value="17" class="child">Bournemouth</option>
  <option id="Exeter" value="39" class="child">Exeter</option>
  <option id="Any South West/Wales" value="-13" class="parent">Any South West/Wales</option>
  <option id="Cardiff" value="25" class="child">Cardiff</option>
  <option id="Bristol" value="19" class="child">Bristol</option>
</select>
							<?php /*?><select id="package_source_airport">
								 
								<?php  foreach (getSourceAirportCodeForPackage() as $key => $items):?>
								 <optgroup label="<?php echo $key; ?>">
    								 <?php  foreach($items as $item):?>
    									<option value="<?php echo $item['destinationID']; ?>" <?php if($item['destinationID'] === 0){ echo 'disabled'; }?>><?php echo $item['city'].' ( '.$item['airport'].' )'; ?></option>
    								<?php endforeach;?>
								</optgroup>
								<?php endforeach;?>
								</select> <?php */ ?>
</div>
								<div class="form-group col-xs-2">		Destination :	<?php /*input value="" placeholder="Choose Place" type="text" class="fields package_destinationId" /*/?>
				<select class="fields package_destinationId" id="package_destinationId">
  <option id="Brazil" value="1163" class="parent">Brazil</option>
  <option id="Salvador" value="1742" class="child">Salvador</option>
  <option id="Cape Verde" value="2224" class="parent">Cape Verde</option>
  <option id="Sal" value="3021" class="child">Sal</option>
  <option id="Caribbean" value="419" class="parent">Caribbean</option>
  <option id="Antigua" value="558" class="child">Antigua</option>
  <option id="Aruba" value="562" class="child">Aruba</option>
  <option id="Bahamas" value="563" class="child">Bahamas</option>
  <option id="Barbados" value="564" class="child">Barbados</option>
  <option id="Cancun" value="553" class="child">Cancun</option>
  <option id="Cuba" value="577" class="child">Cuba</option>
  <option id="Dominican Republic" value="579" class="child">Dominican Republic</option>
  <option id="Grenada" value="593" class="child">Grenada</option>
  <option id="Jamaica" value="594" class="child">Jamaica</option>
  <option id="St Lucia" value="603" class="child">St Lucia</option>
  <option id="Tobago" value="1946" class="child">Tobago</option>
  <option id="Croatia" value="809" class="parent">Croatia</option>
  <option id="Dubrovnik" value="1971" class="child">Dubrovnik</option>
  <option id="Pula" value="2608" class="child">Pula</option>
  <option id="Split" value="2612" class="child">Split</option>
  <option id="Cyprus" value="2648" class="parent">Cyprus</option>
  <option id="Larnaca" value="2650" class="child">Larnaca</option>
  <option id="Paphos" value="2651" class="child">Paphos</option>
  <option id="Czech Republic" value="812" class="parent">Czech Republic</option>
  <option id="Prague" value="814" class="child">Prague</option>
  <option id="Dubai" value="1175" class="parent">Dubai</option>
  <option id="Egypt" value="21" class="parent">Egypt</option>
  <option id="Hurghada" value="389" class="child">Hurghada</option>
  <option id="Luxor" value="390" class="child">Luxor</option>
  <option id="France" value="5" class="parent">France</option>
  <option id="Paris" value="861" class="child">Paris</option>
  <option id="Germany" value="869" class="parent">Germany</option>
  <option id="Berlin" value="870" class="child">Berlin</option>
  <option id="Greece" value="16" class="parent">Greece</option>
  <option id="Corfu" value="79" class="child">Corfu</option>
  <option id="Crete" value="80" class="child">Crete</option>
  <option id="Halkidiki" value="33" class="child">Halkidiki</option>
  <option id="Kalamata" value="1196" class="child">Kalamata</option>
  <option id="Kefalonia" value="65" class="child">Kefalonia</option>
  <option id="Kos" value="74" class="child">Kos</option>
  <option id="Lesvos" value="2547" class="child">Lesvos</option>
  <option id="Mykonos" value="68" class="child">Mykonos</option>
  <option id="Preveza" value="1160" class="child">Preveza</option>
  <option id="Rhodes" value="75" class="child">Rhodes</option>
  <option id="Samos" value="82" class="child">Samos</option>
  <option id="Santorini" value="40" class="child">Santorini</option>
  <option id="Skiathos" value="64" class="child">Skiathos</option>
  <option id="Thassos" value="81" class="child">Thassos</option>
  <option id="Volos" value="1178" class="child">Volos</option>
  <option id="Zante" value="66" class="child">Zante</option>
  <option id="Hungary" value="1090" class="parent">Hungary</option>
  <option id="Budapest" value="1091" class="child">Budapest</option>
  <option id="India" value="616" class="parent">India</option>
  <option id="Goa" value="617" class="child">Goa</option>
  <option id="Indonesia" value="683" class="parent">Indonesia</option>
  <option id="Bali" value="684" class="child">Bali</option>
  <option id="Ireland" value="1979" class="parent">Ireland</option>
  <option id="Dublin" value="2000" class="child">Dublin</option>
  <option id="Italy" value="20" class="parent">Italy</option>
  <option id="Brescia" value="2578" class="child">Brescia</option>
  <option id="Naples" value="900" class="child">Naples</option>
  <option id="Pisa" value="894" class="child">Pisa</option>
  <option id="Rimini" value="373" class="child">Rimini</option>
  <option id="Rome" value="902" class="child">Rome</option>
  <option id="Sardinia" value="1189" class="child">Sardinia</option>
  <option id="Sicily" value="1190" class="child">Sicily</option>
  <option id="Turin" value="904" class="child">Turin</option>
  <option id="Venice" value="906" class="child">Venice</option>
  <option id="Verona" value="907" class="child">Verona</option>
  <option id="Kenya" value="742" class="parent">Kenya</option>
  <option id="Mombasa" value="767" class="child">Mombasa</option>
  <option id="Malaysia" value="691" class="parent">Malaysia</option>
  <option id="Kota Kinabalu" value="698" class="child">Kota Kinabalu</option>
  <option id="Kuala Lumpar" value="692" class="child">Kuala Lumpar</option>
  <option id="Langkawi" value="696" class="child">Langkawi</option>
  <option id="Penang" value="693" class="child">Penang</option>
  <option id="Maldives" value="632" class="parent">Maldives</option>
  <option id="Male" value="643" class="child">Male</option>
  <option id="Malta" value="24" class="parent">Malta</option>
  <option id="Mexico" value="420" class="parent">Mexico</option>
  <option id="Cancun" value="553" class="child">Cancun</option>
  <option id="Puerto Vallarta" value="548" class="child">Puerto Vallarta</option>
   <option id="Netherlands" value="919" class="parent">Netherlands</option>
  <option id="Amsterdam" value="921" class="child">Amsterdam</option>
  <option id="Spain" value="15" class="parent">Spain</option>
  <option id="Costa Almeria" value="" class="child">Costa Almeria</option>
  <option id="Costa Blanca" value="27" class="child">Costa Blanca</option>
  <option id="Cancun" value="553" class="child">Cancun</option>
  <option id="Costa Brava" value="28" class="child">Costa Brava</option>
  <option id="Costa Dorada" value="29" class="child">Costa Dorada</option>
  <option id="Fuerteventura" value="53" class="child">Fuerteventura</option>
  <option id="Gran Canaria" value="51" class="child">Gran Canaria</option>
  <option id="Ibiza" value="55" class="child">Ibiza</option>
  <option id="Lanzarote" value="52" class="child">Lanzarote</option>
  <option id="Majorca" value="56" class="child">Majorca</option>
  <option id="Menorca" value="57" class="child">Menorca</option>
  <option id="Tenerife" value="50" class="child">Tenerife</option>
  <option id="Barcelona" value="953" class="child">Barcelona</option>
  <option id="Sri Lanka" value="650" class="parent">Sri Lanka</option>
  <option id="Colombo" value="1655" class="child">Colombo</option>
  <option id="Thailand" value="661" class="parent">Thailand</option>
  <option id="Bangkok" value="681" class="child">Bangkok</option>
  <option id="Chiang Mai" value="680" class="child">Chiang Mai</option>
  <option id="Koh Samui" value="669" class="child">Koh Samui</option>
  <option id="Phuket" value="662" class="child">Phuket</option>
  <option id="Turkey" value="19" class="parent">Turkey</option>
  <option id="Antalya" value="348" class="child">Antalya</option>
  <option id="Bodrum" value="351" class="child">Bodrum</option>
  <option id="Dalaman" value="1194" class="child">Dalaman</option>
  <option id="Izmir" value="1222" class="child">Izmir</option>
  <option id="USA" value="412" class="parent">USA</option>
  <option id="Boston" value="470" class="child">Boston</option>
  <option id="Florida" value="413" class="child">Florida</option>
  <option id="Las Vegas" value="526" class="child">Las Vegas</option>
</select>
									<input value="" type="hidden" id="package_destinationId" />&nbsp;&nbsp;&nbsp; </div>
									<div class="form-group col-xs-2">	No. of adults:  <input value="" type="number" class="fields" value="2" placeholder="" id="package_adults" /> </div>
									<div class="form-group col-xs-2">	No. of children:  <input value="" type="number" class="fields" id="package_children" placeholder=""/> </div>

									<div class="form-group col-xs-2">	Rating :
										<select class="fields inp" name="stars" id="stars">
											<option value="-1">Any Rating</option>
											<option value="1">1+ Star</option>
											<option value="2">2+ Stars</option>
											<option value="3">3+ Stars</option>
											<option value="4">4+ Stars</option>
											<option value="5">5 Stars</option>
										</select>
									</div>

								</div>
				<?php /* ?>Type : <select id="package_boardType">
					<option value="9">Single</option>
					<option value="8">Share</option>
				</select><?php */?><br /> <br /> 
				<div class="row">
					<div class="form-group col-xs-2">   Board Type:	

						<select class="fields inp" name="board" id="board">
						<option id="ANY" value="-1">All board basis</option>
							<option id="SC" value="2">Self Catering</option>
							<option id="HB" value="3">Half Board</option>
							<option id="FB" value="4">Full Board</option>
							<option id="AI" value="5">All Inclusive</option>
							<option id="CC" value="6">Catered Chalet</option>
							<option id="BB" value="8">Bed And Breakfast</option>
							<option id="RO" value="9">Room Only</option>
							<option id="CLB" value="12">Club Hotel</option>
						</select>
					</div>
                <div class="form-group col-xs-2">From Date : <input	type="text" id="package_from_date" class="fields"/></div>&nbsp;&nbsp;&nbsp; <?php /*div class="form-group col-xs-2">To Date : <input
                type="text" id="package_to_date" class="fields"/></div*/?>
                <div class="form-group col-xs-2"> No of Nights
                	<?php/*input type="number" class="fields" id="night" name="night" min="0"*/?>
                                            <select class="fields inp" name="night" id="night">
                                                <option value="0">Any Duration</option>
                                                <option value="1">1 Night</option>
                                                <option value="2">2 Nights</option>
                                                <option value="3">3 Nights</option>
                                                <option value="4">4 Nights</option>
                                                <option value="5">5 Nights</option>
                                                <option value="6">6 Nights</option>
                                                <option value="7" selected="selected">7 Nights</option>
                                                <option value="8">8 Nights</option>
                                                <option value="9">9 Nights</option>
                                                <option value="10">10 Nights</option>
                                                <option value="11">11 Nights</option>
                                                <option value="12">12 Nights</option>
                                                <option value="13">13 Nights</option>
                                                <option value="14">14 Nights</option>
                                                <option value="15-20">15-20 Nights</option>
                                                <option value="21">21 Nights</option>
                                                <option value="22-365">Over 21 Nights</option>
                                                </select >
                                            </div>

                                            <div class="form-group col-xs-2">	Days +/-
                                                	<?php/*input type="number" class="fields" name="flexibility" id="flexibility" */?>
                                            <select class="fields inp" name="flexibility" id="flexibility">
                                                <option class="group" value="0">Exact Date</option>
                                                <option value="1">+/-1 Days</option>
                                                <option value="2">+/-2 Days</option>
                                                <option value="3" selected="selected">+/-3 Days</option>
                                                <option value="5">+/-5 Days</option>
                                                <option value="7">+/-7 Days</option>
                                                <option value="14">+/-14 Days</option>
                                                </select>
                                            </div>


                                            </div>
                                            <div class="row">
                                            	<div class="col-sm-12 search-btn-outer">
                                            		<div class="search-btn">		
                                            			<button onclick="javascript:doPackageSearch(1);" class="btn btn-primary search_btn" > SEARCH</button>
                                            		</div>
                                            	</div>
                                            </div>
                                        </div>
                                        <h3 class="f">Search Result</h3>

			<?php /*div class="filter">
				&nbsp;&nbsp;&nbsp;Price :
				<button
					onclick="javascript:Ascending = true;sortByNumber('package_search_result_ul','price');">Accending</button>
				<button
					onclick="javascript:Ascending = false;sortByNumber('package_search_result_ul','price');">Decending</button>
			</div>
			<div class="filter">
				&nbsp;&nbsp;&nbsp;Arrival :
				<button
					onclick="javascript:Ascending = true;sortByString('package_search_result_ul','arrival');">Accending</button>
				<button
					onclick="javascript:Ascending = false;sortByString('package_search_result_ul','arrival');">Decending</button>
			</div>
			<div class="filter">
				&nbsp;&nbsp;&nbsp;Departure :
				<button
					onclick="javascript:Ascending = true;sortByString('package_search_result_ul','departure');">Accending</button>
				<button
					onclick="javascript:Ascending = false;sortByString('package_search_result_ul','departure');">Decending</button>
					</div*/?>
					<br />
					<hr />
					<div id="package_search_result">
						<input type="text" class="fields search" id="search_res" />
						<p class="filter_price_field">&#163;<span id="filter_amt"></span></p>
						<input type="hidden" id="filtered_price_min" />
						<input type="hidden" id="filtered_price_max" />
						<input type="hidden" id="filtered_rating" />
						<input type="hidden" id="filtered_board" />
						<div style="text-align:right; padding: 10px; margin-bottom: 15px;">Results: <span id="current_res">0</span> / <span id="package_count">0</span></div>
						<!-- Flight search result -->
						<div class="row">
							<div class="col-md-4">
								<div class="filter_bx hide">
									<h2><span>Board Basis</span> <span><i class="fa fa-chevron-up" aria-hidden="true"></i></span></h2>
									
										<ul>
											<li>
												<div><span>Any</span></div>
												<div><span class="prema_hide">(<span  id="board_basis_0">0</span>)</span><span><input class="sidebar_filter single-checkbox2" type="checkbox" value="-1"></span></div>
											</li>
											<li>
												<div><span>All inclusive</span></div>
												<div><span class="prema_hide">(<span  id="board_basis_1">0</span>)</span><span><input class="sidebar_filter single-checkbox2" type="checkbox" value="5"></span></div>
											</li>
											<li>
												<div><span>Full Board</span></div>
												<div><span class="prema_hide">(<span  id="board_basis_2">0</span>)</span><span><input class="sidebar_filter single-checkbox2" type="checkbox" value="4"></span></div>
											</li>
											<li>
												<div><span>Half Board</span></div>
												<div><span class="prema_hide">(<span  id="board_basis_3">0</span>)</span><span><input class="sidebar_filter single-checkbox2" type="checkbox" value="3"></span></div>
											</li>
											<li>
												<div><span>Bed & Breakfast</span></div>
												<div><span class="prema_hide">(<span  id="board_basis_4">0</span>)</span><span><input class="sidebar_filter single-checkbox2" type="checkbox" value="8"></span></div>
											</li>
											<li>
												<div><span>Room Only</span></div>
												<div><span class="prema_hide">(<span  id="board_basis_5">0</span>)</span><span><input class="sidebar_filter single-checkbox2" type="checkbox" value="9"></span></div>
											</li>
											<li>
												<div><span>Self Catering</span></div>
												<div><span class="prema_hide">(<span  id="board_basis_6">0</span>)</span><span><input class="sidebar_filter single-checkbox2" type="checkbox" value="2"></span></div>
											</li>
											<li>
												<div><span>Club Hotel</span></div>
												<div><span class="prema_hide">(<span  id="board_basis_7">0</span>)</span><span><input class="sidebar_filter single-checkbox2" type="checkbox" value="12"></span></div>
											</li>
										</ul>
									  </form>
								</div><!-- filter bx -->
								<div class="filter_bx hide">
									<h2><span>Budget</span> <span><i class="fa fa-chevron-up" aria-hidden="true"></i></span></h2>
									<form>
										<ul>
											<li>
												<div><span>Below &#163;200</span></div>
												<div><span class="prema_hide">(<span  id="price0">0</span>)</span><span><input type="hidden" class="price_min1" value="0"/><input class="sidebar_price_filter single-checkbox3" type="checkbox" id="price_max1" value="200"/></span></div>
											</li>
											<li>
												<div><span>&#163;200</span> - <span>&#163;299</span></div>
												<div><span class="prema_hide">(<span  id="price1">0</span>)</span><span><input type="hidden" id="price_min2" value="200"/><input class="sidebar_price_filter single-checkbox3" type="checkbox" id="price_max2" value="299"></span></div>
											</li>
											<li>
												<div><span>&#163;300</span> - <span>&#163;399</span></div>
												<div><span class="prema_hide">(<span  id="price2">0</span>)</span><span><input type="hidden" id="price_min3" value="300"/><input class="sidebar_price_filter single-checkbox3" type="checkbox" id="price_max3" value="399"></span></div>
											</li>
											<li>
												<div><span>&#163;400</span> - <span>&#163;499</span></div>
												<div><span class="prema_hide">(<span  id="price3">0</span>)</span><span><input type="hidden" id="price_min4" value="400"/><input class="sidebar_price_filter single-checkbox3" type="checkbox" id="price_max4" value="499"></span></div>
											</li>
											<li>
												<div><span>&#163;500</span> - <span>&#163;599</span></div>
												<div><span class="prema_hide">(<span  id="price4">0</span>)</span><span><input type="hidden" id="price_min5" value="500"/><input class="sidebar_price_filter single-checkbox3" type="checkbox" id="price_max5" value="599"></span></div>
											</li>
											<li>
												<div><span>&#163;600</span> + <span></span></div>
												<div><span class="prema_hide">(<span  id="price5">0</span>)</span><span><input type="hidden" id="price_max6" value="9999"/> <input class="sidebar_price_filter single-checkbox3" type="checkbox" id="price_min6" value="600"></span></div>
											</li>
										</ul>
									  </form>
								</div><!-- filter bx -->
								<div class="filter_bx hide">
									<h2><span>Rating</span> <span><i class="fa fa-chevron-up" aria-hidden="true"></i></span></h2>
										<ul>
											<li>
												<div>
													<span class="star-icon"><i class="fa fa-star" aria-hidden="true"></i></span>
													<span class="star-icon"><i class="fa fa-star" aria-hidden="true"></i></span>
													
												</div>
												<div><span class="prema_hide">(<span  id="three-stars">0</span>)</span><span><input class="sidebar_filter single-checkbox4" type="checkbox" value="2"></span></div>
											</li>
											<li>
												<div>
													<span class="star-icon"><i class="fa fa-star" aria-hidden="true"></i></span>
													<span class="star-icon"><i class="fa fa-star" aria-hidden="true"></i></span>
													<span class="star-icon"><i class="fa fa-star" aria-hidden="true"></i></span>
												</div>
												<div><span class="prema_hide">(<span  id="three-stars">0</span>)</span><span><input class="sidebar_filter single-checkbox4" type="checkbox" value="3"></span></div>
											</li>
											<li>
												<div>
													<span class="star-icon"><i class="fa fa-star" aria-hidden="true"></i></span>
													<span class="star-icon"><i class="fa fa-star" aria-hidden="true"></i></span>
													<span class="star-icon"><i class="fa fa-star" aria-hidden="true"></i></span>
													<span class="star-icon"><i class="fa fa-star" aria-hidden="true"></i></span>
												</div>
												<div><span class="prema_hide">(<span  id="four-stars">0</span>)</span><span><input class="sidebar_filter single-checkbox4" type="checkbox" value="4"></span></div>
											</li>
											<li>
												<div>
													<span class="star-icon"><i class="fa fa-star" aria-hidden="true"></i></span>
													<span class="star-icon"><i class="fa fa-star" aria-hidden="true"></i></span>
													<span class="star-icon"><i class="fa fa-star" aria-hidden="true"></i></span>
													<span class="star-icon"><i class="fa fa-star" aria-hidden="true"></i></span>
													<span class="star-icon"><i class="fa fa-star" aria-hidden="true"></i></span>
												</div>
												<div><span class="prema_hide">(<span  id="five-stars">0</span>)</span><span><input class="sidebar_filter single-checkbox4" type="checkbox" value="5"></span></div>
											</li>
										</ul>
										<button style="" class="btn btn-success clear_filter" onclick="clearFilter();" >Clear</button>
										<button style="float:right" class="btn btn-success apply-filter" onclick="doPackageSearch(2);" >Apply</button>
									  
								</div><!-- filter bx -->
							</div><!-- col -->
							<div class="col-md-8">
								<ul id="package_search_result_ul" class="package_search_result list_block_ul list">
								</ul>	
							</div><!-- col -->
						</div>
						
						<ul class="pagination"></ul>
						<!-- flight search result ends here -->

					</div>
					<!-- package tab ends here -->
				</div>
			</div>
<script>

$(document).ready(function(){
    $('.single-checkbox2').click(function() {
        $('.single-checkbox2').not(this).prop('checked', false);
    });

    $('.single-checkbox3').click(function() {
        $('.single-checkbox3').not(this).prop('checked', false);
    });

    $('.single-checkbox4').click(function() {
        $('.single-checkbox4').not(this).prop('checked', false);
    });
});
</script>
			<!-- flight Modal -->
			<div class="modal fade" id="flightBookModal" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="popup_flight_detail">
						<div class="flight_from_to"></div>
						<div class="price">Amount : <span class="flight_price"></span></div>
					</div>
					<hr>
					<form class="booking_form" id="flight_book_form">
						<input class="input" type="hidden" id="quote_reference" name="quote_reference" value="" />
						<input class="input" type="hidden" id="org_price" name="org_price" value="" />
						<input class="input" type="hidden" id="percentage_margin" name="percentage_margin" value="" />
						<input class="input" type="hidden" id="booking_price" name="booking_price" value="" />
						<input class="input" type="hidden" id="type" name="type" value="FLIGHT" />
						<table border=0 cellspacing=7 width="100%">
							<tr>
								<td>Name</td>
								<td><input class="fields input" type="text" name="user_name" /></td>
							</tr>
							<tr>
								<td>Email</td>
								<td><input class="fields input" type="text" name="user_email" /></td>
							</tr>
							<tr>
								<td>Phone</td>
								<td><input class="fields input" type="text" name="user_phone" /></td>
							</tr>
							<tr>
								<td>Location</td>
								<td><input class="fields input" type="text" name="user_location" /></td>
							</tr>
							<tr>
								<td colspan=2><input id="popup_submit" type="submit"  name="BOOK NOW" /></td>
							</tr>
						</table>
					</form>
					<div class="ajax_response"></div>

				</div>
			</div>
			<!-- flight popup ends here -->

			<script>
				var number = document.getElementById('night');

			// Listen for input event on numInput.
			number.onkeydown = function(e) {
				if(!((e.keyCode > 95 && e.keyCode < 106)
					|| (e.keyCode > 47 && e.keyCode < 58) 
					|| e.keyCode == 8)) {
					return false;
			}
			}
			var flex = document.getElementById('flexibility');

			// Listen for input event on numInput.
			flex.onkeydown = function(e) {
				if(!((e.keyCode > 95 && e.keyCode < 106)
					|| (e.keyCode > 47 && e.keyCode < 58) 
					|| e.keyCode == 8)) {
					return false;
			}
			}
			</script>
			
			<script>
			$(document).ready(function(){
				  $("#search_res").on("keyup", function() {
					var value = $(this).val().toLowerCase();
					$("#package_search_result_ul .custom_block_li").filter(function() {
					  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
					});
				  });
				  //$("#rating-filter").on("input", function() {
				//	var value = $(this).val().toLowerCase();
					//$("#package_search_result_ul .custom_block_li").filter(function() {
					 // $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
					// });
				  // });
				  // $(".sidebar_filter").change(function() {
					// if($(this). prop("checked") == true) {
						// var value = $(this).val().toLowerCase();
						// $("#package_search_result_ul .custom_block_li").filter(function() {
						  // $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
						// });
					// }
				// });
				  // $(".sidebar_price_filter").change(function() {
					// if($(this). prop("checked") == true) {
						// var price = $( this ).val();
						 // $("#filter_amt").html(price);
						// var value = $(".filter_price_field").text().toLowerCase();
						// $("#package_search_result_ul .custom_block_li").filter(function() {
						  // $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
						// });
					// }
				// });
				 $("#price_max1").change(function() {
					if($(this). prop("checked") == true) {
						var price_max1 = $( this ).val();
						 $("#filtered_price_max").val(price_max1);
						var price_min1 = $("#price_min1").val();
						 $("#filtered_price_min").val(price_min1);
					}
				});
				$("#price_max2").change(function() {
					if($(this). prop("checked") == true) {
						var price_max2 = $( this ).val();
						 $("#filtered_price_max").val(price_max2);
						var price_min2 = $("#price_min2").val();
						 $("#filtered_price_min").val(price_min2);
					}
				});
				$("#price_max3").change(function() {
					if($(this). prop("checked") == true) {
						var price_max3 = $( this ).val();
						 $("#filtered_price_max").val(price_max3);
						var price_min3 = $("#price_min3").val();
						 $("#filtered_price_min").val(price_min3);
					}
				});
				$("#price_max4").change(function() {
					if($(this). prop("checked") == true) {
						var price_max4 = $( this ).val();
						 $("#filtered_price_max").val(price_max4);
						var price_min4 = $("#price_min4").val();
						 $("#filtered_price_min").val(price_min4);
					}
				});
				$("#price_max5").change(function() {
					if($(this). prop("checked") == true) {
						var price_max5 = $( this ).val();
						 $("#filtered_price_max").val(price_max5);
						var price_min5 = $("#price_min5").val();
						 $("#filtered_price_min").val(price_min5);
					}
				});
				$("#price_min6").change(function() {
					if($(this). prop("checked") == true) {
						var price_min6 = $( this ).val();
						 $("#filtered_price_min").val(price_min6);
						 var price_max6 = $("#price_max6").val();
						 $("#filtered_price_max").val(price_max6);
					}
				});
				$(".single-checkbox2").change(function() {
					if($(this). prop("checked") == true) {
						var board = $( this ).val();
						 $("#filtered_board").val(board);
					}
				});
				$(".single-checkbox4").change(function() {
					if($(this). prop("checked") == true) {
						var rating = $( this ).val();
						 $("#filtered_rating").val(rating);
					}
				});
				
				 $("#price_max1").change(function() {
					if($(this). prop("checked") == false) {
						//var price_max1 = $( this ).val();
						 $("#filtered_price_max").val('');
						//var price_min1 = $("#price_min1").val();
						 $("#filtered_price_min").val('');
					}
				});
				$("#price_max2").change(function() {
					if($(this). prop("checked") == false) {
					//	var price_max2 = $( this ).val();
						 $("#filtered_price_max").val('');
					//	var price_min2 = $("#price_min2").val();
						 $("#filtered_price_min").val('');
					}
				});
				$("#price_max3").change(function() {
					if($(this). prop("checked") == false) {
						//var price_max3 = $( this ).val();
						 $("#filtered_price_max").val('');
						//var price_min3 = $("#price_min3").val();
						 $("#filtered_price_min").val('');
					}
				});
				$("#price_max4").change(function() {
					if($(this). prop("checked") == false) {
						//var price_max4 = $( this ).val();
						 $("#filtered_price_max").val('');
						//var price_min4 = $("#price_min4").val();
						 $("#filtered_price_min").val('');
					}
				});
				$("#price_max5").change(function() {
					if($(this). prop("checked") == false) {
						//var price_max5 = $( this ).val();
						 $("#filtered_price_max").val('');
						//var price_min5 = $("#price_min5").val();
						 $("#filtered_price_min").val('');
					}
				});
				$("#price_min6").change(function() {
					if($(this). prop("checked") == false) {
						var price_min6 = $( this ).val();
						 $("#filtered_price_min").val('');
						 var price_max6 = $("#price_max6").val();
						 $("#filtered_price_max").val('');
					}
				});
				$(".single-checkbox2").change(function() {
					if($(this). prop("checked") == false) {
						//var board = $( this ).val();
						 $("#filtered_board").val('-1');
					}
				});
				$(".single-checkbox4").change(function() {
					if($(this). prop("checked") == false) {
						//var rating = $( this ).val();
						 $("#filtered_rating").val('-1');
					}
				});
				$("#package_adults").val(2);
			    $(".clear_filter, .search_btn").click(function() {
					$(".single-checkbox2, .single-checkbox3, .single-checkbox4").prop("checked",false);
					 $("#filtered_board").val('');
					 $("#filtered_rating").val('');
					 $("#filtered_price_min").val('');
					 $("#filtered_price_max").val('');
				});
			
			});
			</script>
  
</table>
</body>
</html>
