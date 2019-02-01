/**
 * 
 */

function GetSearchDate(mDate){

	var month = mDate .getMonth() + 1;

    var day = mDate .getDate();

    var year = mDate .getFullYear();
   
    return year + "-" + month + "-" + day;
}

var flightSearchFromDate = GetSearchDate(new Date());
var flightSearchToDate = GetSearchDate(new Date());
var hotelSearchFromDate = GetSearchDate(new Date());
var hotelSearchToDate = GetSearchDate(new Date());
var packageSearchFromDate = GetSearchDate(new Date());
var packageSearchToDate = GetSearchDate(new Date());



$(function() {
	
	$( "#tabs" ).tabs();
	
	new TinyPicker({
        firstBox:document.getElementById('flight_from_date'),
        startDate: new Date(),
        endDate: new Date(),
        lastBox: document.getElementById('flight_to_date'),
        months: 3,
        days: ['Su','Mo','Tu','We','Th','Fr','Sa'],
        local: 'in-IN',
        success: function(s, e){ 
        	flightSearchFromDate = GetSearchDate(s);
        	flightSearchToDate = GetSearchDate(e);
        },
        err: function(){alert('err');}
    }).init();
	
	new TinyPicker({
        firstBox:document.getElementById('hotel_from_date'),
        startDate: new Date(),
        endDate: new Date(),
        lastBox: document.getElementById('hotel_to_date'),
        months: 3,
        days: ['Su','Mo','Tu','We','Th','Fr','Sa'],
        local: 'in-IN',
        success: function(s, e){ 
        	hotelSearchFromDate = GetSearchDate(s);
        	hotelSearchToDate = GetSearchDate(e);
        },
        err: function(){alert('err');}
    }).init();
	
	new TinyPicker({
        firstBox:document.getElementById('package_from_date'),
        startDate: new Date(),
        endDate: new Date(),
        lastBox: document.getElementById('package_to_date'),
        months: 3,
        days: ['Su','Mo','Tu','We','Th','Fr','Sa'],
        local: 'in-IN',
        success: function(s, e){ 
        	packageSearchFromDate = GetSearchDate(s);
        	packageSearchToDate = GetSearchDate(e);
        },
        err: function(){alert('err');}
    }).init();
	

	//doFlightSearch();
	
	
	function toJSONString( form ) {
		var obj = {};
		var elements = form.querySelectorAll( "input, select, textarea" );
		for( var i = 0; i < elements.length; ++i ) {
			var element = elements[i];
			var name = element.name;
			var value = element.value;

			if( name ) {
				obj[ name ] = value;
			}
		}

		return JSON.stringify( obj );
	}

	
		$(".booking_form").each(function(){
			this.addEventListener( "submit", function( e ) {
				e.preventDefault();
				var json = toJSONString( this );
				popupbooking(json);

			}, false);
		});
		

		$(".flight_source_airport").autocomplete({
	        source: "autosuggestion.php?type=flight",
	        /*create: function () {
	            //access to jQuery Autocomplete widget differs depending
	            //on jQuery UI version - you can also try .data('autocomplete')
	            $(this).data('uiAutocomplete')._renderMenu = customRenderMenu;
	        },*/
	        change: function( event, ui ) {
	            //event.preventDefault();
	        	//console.log(ui.item);
	            $("#flight_source_airport").val( ui.item? ui.item.id : '' );
	            $(".flight_source_airport").val(ui.item.label);
	            return false;
	        },
	        /*change: function( event, ui ) {
	        	if(! ui.item)
	        	$("#flight_source_airport").val();
	        }*/
	    });
	    $(".flight_destination_airport").autocomplete({
	        source: "autosuggestion.php?type=flight",
	       /* create: function () {
	            //access to jQuery Autocomplete widget differs depending
	            //on jQuery UI version - you can also try .data('autocomplete')
	            $(this).data('uiAutocomplete')._renderMenu = customRenderMenu;
	        },*/
	        change: function( event, ui ) {
	            //event.preventDefault();
	        	//console.log(ui.item);
	            $("#flight_destination_airport").val( ui.item? ui.item.id : '' );
	            $(".flight_destination_airport").val(ui.item.label);
	            return false;
	        }
	    });
	    $(".hotel_destinationId").autocomplete({
	        source: "autosuggestion.php?type=hotel",
	       /* create: function () {
	            //access to jQuery Autocomplete widget differs depending
	            //on jQuery UI version - you can also try .data('autocomplete')
	            $(this).data('uiAutocomplete')._renderMenu = customRenderMenu;
	        }, */
	        change: function( event, ui ) {
	            //event.preventDefault();
	        	//console.log(ui.item);
	            $("#hotel_destinationId").val( ui.item? ui.item.id : '' );
	            $(".hotel_destinationId").val(ui.item.label);
	           // $("#hotel_destinationType").val(ui.item?ui.item.destinatin_type:'')
	            return false;
	        }
	    });
	    
	    $(".package_source_airport").autocomplete({
	        source: "data/packageSourceAirport.php?type=packageflight",
	        create: function () {
	            //access to jQuery Autocomplete widget differs depending
	            //on jQuery UI version - you can also try .data('autocomplete')
	            $(this).data('uiAutocomplete')._renderMenu = customRenderMenu;
	        },
	        change: function( event, ui ) {
	            //event.preventDefault();
	        	//console.log(ui.item);
	            $("#package_source_airport").val( ui.item? ui.item.id : '' );
	            $(".package_source_airport").val(ui.item.label);
	            return false;
	        }
	    });
	    $('.package_source_airport').click(function() {
	    	if($.trim($(this).val()) == '')
	    		$(this).autocomplete('search', 'null');
	    	else
	    		$(this).autocomplete('search', $(this).val());
	    });
	    $('.package_source_airport').keyup(function() {
	    	if($.trim($(this).val()) == '')
	    		$(this).autocomplete('search', 'null');
	    });
	    
	    $(".package_destinationId").autocomplete({
	        source: "autosuggestion.php?type=packagedest",
	        create: function () {
	            //access to jQuery Autocomplete widget differs depending
	            //on jQuery UI version - you can also try .data('autocomplete')
	            $(this).data('uiAutocomplete')._renderMenu = customRenderMenu;
	        },
	        change: function( event, ui ) {
	            //event.preventDefault();
	        	//console.log(ui.item);
	            $("#package_destinationId").val( ui.item? ui.item.id : '' );
	            $(".package_destinationId").val(ui.item.label);
	            return false;
	        }
	    });
	
	    $('.package_destinationId').click(function() {
	    	if($.trim($(this).val()) == '')
	    		$(this).autocomplete('search', 'null');
	    	else
	    		$(this).autocomplete('search', $(this).val());
	    });
	    $('.package_destinationId').keyup(function() {
	    	if($.trim($(this).val()) == '')
	    		$(this).autocomplete('search', 'null');
	    });

});


var customRenderMenu = function(ul, items){
    var self = this;
    var category = null;
    var sortedItems = items.sort(function(a, b) {
       return a.category.localeCompare(b.category);
    });
 
    $.each(sortedItems, function (index, item) {
        if (item.category == category) {
            category = item.category;
             ul.append("<li class='ui-menu-item-wrapper' style='font-weight:bold;font-style:italic;'>" + category + "</li>");
        }
        self._renderItemData(ul, item);
    });
};


function GetFormattedDate(datestr) {

    var mDate = new Date(datestr);

    var month = mDate .getMonth() + 1;

    var day = mDate .getDate();

    var year = mDate .getFullYear();
   //alert(year + "-" + month + "-" + day);
    return year + "-" + month + "-" + day;

}

function doFlightSearch(){
	
	
	
	var param = {
			"fromAirports": $("#flight_source_airport").val(),
			"toAirports":$("#flight_destination_airport").val(),
		//	"dateMin": GetFormattedDate($("#flight_from_date").val()),
		//	"dateMax": GetFormattedDate($("#flight_to_date").val())
			"dateMin": flightSearchFromDate,
			"dateMax": flightSearchToDate
	};
	
	console.log(param);
	
	var error = new Array(0);
	if(param.fromAirports == "0" || $.trim(param.fromAirports) == ""){
		error.push("Source : "+($.trim($(".flight_source_airport").val()) == ''?"Empty":$(".flight_source_airport").val()));
	}
	
	if(param.toAirports == "0" || $.trim(param.toAirports) == ""){
		error.push("Destination : "+($.trim($(".flight_destination_airport").val()) == ''?"Empty":$(".flight_destination_airport").val()));
	}
	
	if(error.length != 0){
		
		alert("Not serving for location ["+error+"]");
		return true;
	}
	
	
	$( "#flight_search_result_ul" ).html('<li><center><img src="./img/ajax-loader.gif"></center></li>');
	
	
	
	
	if(window.flight_pagination != undefined)
		  delete window.flight_pagination;
	$("#flight_count").html('0');
	
	var request = $.ajax({
	  url: "./process.php?type=flight",
	  method: "POST",
	  data: param,
	  dataType: "html"
	});
	 
	request.done(function( html ) {
			
		if($.trim(html) != ''){
			$( "#flight_search_result_ul" ).html( html );
			$("#flight_count").html($( "#flight_search_result_ul li.list_block_li" ).length);
			
			/*window.flight_pagination = new List('flight_search_result', {
				valueNames : [ 'flight_name', 'outbound_departure_airport_code',
						'departure_time', 'departure_airport', 'duration',
						'outbound_arrival_airport_code', 'departure_time',
						'arrival_apirrport', 'amount' ],
				page : 20,
				pagination : true
			});*/
		}
		else
			$( "#flight_search_result_ul" ).html('<li class="list_block_li" ><center>No Flight available</center></li>');
	  
	});
	 
	request.fail(function( jqXHR, textStatus ) {
		$( "#flight_search_result_ul" ).html( "<li class='list_block_li' ><center>Request failed: " + textStatus+", try again...</center></li>");
	});
}


function doHotelSearch(){
	
	
	var param = {
			"destinationId": $("#hotel_destinationId").val(),
			"adults":$("#flight_adults").val(),
			"boardType":$("#hotel_boardType").val(),
			//"destinationType":$("#hotel_destinationType").val(),
			//"dateMin": GetFormattedDate($("#hotel_from_date").val()),
			//"dateMax": GetFormattedDate($("#hotel_to_date").val())
			"dateMin": hotelSearchFromDate,
			"dateMax": hotelSearchToDate
	};
	
	console.log(param);
	
	var error = new Array(0);
		
	if(param.destinationId == "0" || $.trim(param.destinationId) == ""){
		error.push(($.trim($(".hotel_destinationId").val()) == ''?"Empty":$(".hotel_destinationId").val()));
	}
	
	if(error.length != 0){
		
		alert("Not serving for place ["+error+"]");
		return true;
	}
	
	
	$( "#hotel_search_result_ul" ).html('<li><center><img src="./img/ajax-loader.gif"></center></li>');
	
	if(window.hotel_pagination != undefined)
		  delete window.hotel_pagination;
	$("#hotel_count").html('0');
	
	var request = $.ajax({
	  url: "./process.php?type=hotel",
	  method: "POST",
	  data: param,
	  dataType: "html"
	});
	 
	request.done(function( html ) {
			
		if($.trim(html) != ''){
			$( "#hotel_search_result_ul" ).html( html );
			$("#hotel_count").html($( "#hotel_search_result_ul li.list_block_li" ).length);
			
			showRatingStar('hotel');
			
			/*window.hotel_pagination = new List('hotel_search_result', {
				valueNames : [ 'hotel_name', 'hotel_location',
						'hotel_rating', 'adult_children', 'amount'],
				page : 20,
				pagination : true
			});*/
		}
		else
			$( "#hotel_search_result_ul" ).html('<li class="list_block_li" ><center>No Hotel available</center></li>');
	  
	});
	 
	request.fail(function( jqXHR, textStatus ) {
		$( "#hotel_search_result_ul" ).html( "<li class='list_block_li' ><center>Request failed: " + textStatus+", try again...</center></li>");
	});
}


function doPackageSearch(x){
    $(".pagination1").remove();
	if(x==1){
		var param = {
				"destinationId": $("#package_destinationId").val(),
				"departureId":$("#package_source_airport").val(),
				"adults":$("#package_adults").val(),
				"children":$("#package_children").val(),
				"boardType":$("#board").val(),
				"rating":$("#stars").val(),
			//	"dateMin": GetFormattedDate($("#package_from_date").val()),
			//	"dateMax": GetFormattedDate($("#package_to_date").val())
				"dateMin": packageSearchFromDate,
				"flexibility":$("#flexibility").val(),
			//  "dateMax": packageSearchToDate,
				"durationMin":$("#night").val(),
				"maxResults":68
		};
	}
	else{
		var param = {
			"destinationId": $("#package_destinationId").val(),
		    "departureId":$("#package_source_airport").val(),
			"adults":$("#package_adults").val(),
			"boardType":$("#filtered_board").val(),
			"rating":$("#filtered_rating").val(),
			"priceMin":parseInt($("#filtered_price_min").val()),
			 "priceMax":parseInt($("#filtered_price_max").val()),
			
			"dateMin": packageSearchFromDate,
			"flexibility":$("#flexibility").val(),
			"durationMin":$("#night").val(),
			"maxResults":34
		};
	}
	
	console.log(param);
	
	var error = new Array(0);
	if(param.departureId == "0" || $.trim(param.departureId) == ""){
		error.push("Source : "+($.trim($(".package_source_airport").val()) == ''?"Empty":$(".package_source_airport").val()));
	}
	
	if(param.destinationId == "0" || $.trim(param.destinationId) == ""){
		error.push("Destination : "+($.trim($(".package_destinationId").val()) == ''?"Empty":$(".package_destinationId").val()));
	}
	
	if(error.length != 0){
		
		alert("Not serving for location ["+error+"]");
		return true;
	}
	
	
	$( "#package_search_result_ul" ).html('<li><center><img src="./img/ajax-loader.gif"></center></li>');
	
	
	
	
	
	if(window.hotel_pagination != undefined)
		  delete window.package_pagination;
	$("#package_count").html('0');
	$("#current_res").html('0');
	
	var request = $.ajax({
	  url: "./process.php?type=package",
	  method: "POST",
	  data: param,
	  dataType: "html"
	});
	 
	request.done(function( html ) {
			////alert(html);
		if($.trim(html) != ''){
			$( "#package_search_result_ul" ).html( html );
			$(".hide").removeClass("hide");
		    var total_res =	$('#package_search_result_ul .custom_block_li').length;
		    $("#package_count").html(total_res);
			showRatingStar('package');
				$("#package_search_result_ul").after('<div id="nav" class="pagination1"></div>');
				if(total_res<30)
				var rowsShown = Math.floor(total_res/3);	
				else if(total_res>30&&total_res<300)
				var rowsShown = Math.floor(total_res/8);
				else
				var rowsShown = Math.floor(total_res/15);
				$("#current_res").html(rowsShown);
				var rowsTotal = $('#package_search_result_ul .custom_block_li').length;
				var numPages = rowsTotal/rowsShown;
				for(i = 0;i < numPages;i++) {
					 
					var pageNum = i + 1;
					$('#nav').append('<a href="#" rel="'+i+'">'+pageNum+'</a> ');
				}
				$('#package_search_result_ul .custom_block_li').hide();
				$('#package_search_result_ul .custom_block_li').slice(0, rowsShown).show();
				$('#nav a:first').addClass('active');
				
				$('#nav a').bind('click', function(){

					$('#nav a').removeClass('active');
					$(this).addClass('active');
					var currPage = $(this).attr('rel');
					
					var startItem = currPage * rowsShown;
					var realIndex = (parseInt(currPage)+1)*rowsShown;
					if(realIndex>total_res)
						realIndex=total_res;
					//alert(currPage+' '+rowsShown+' '+realIndex);
					 $("#current_res").html(realIndex);
					var endItem = startItem + rowsShown;
					$('#package_search_result_ul .custom_block_li').css('opacity','0.0').hide().slice(startItem, endItem).
					css('display','table-row').animate({opacity:1}, 300);
				});
			// $("#three-stars").html($("#package_search_result_ul [title='Three Stars']").length);
			// $("#four-stars").html($("#package_search_result_ul [title='Four Stars']").length);
			// $("#five-stars").html($("#package_search_result_ul [title='Five Stars']").length);
			
			// $("#board_basis_1").html($("#package_search_result_ul [id='AI']").length);
			// $("#board_basis_2").html($("#package_search_result_ul [id='FB']").length);
			// $("#board_basis_3").html($("#package_search_result_ul [id='HB']").length);
			// $("#board_basis_4").html($("#package_search_result_ul [id='BB']").length);
			// $("#board_basis_5").html($("#package_search_result_ul [id='RO']").length);
			// $("#board_basis_6").html($("#package_search_result_ul [id='SC']").length);
			// $("#board_basis_7").html($("#package_search_result_ul [id='CLB']").length);
			
			//$("#price1").html($("#package_search_result_ul li.list_block_li").filter(function() {
			 // return parseInt( this.data-price, 10) > 200;
			//})).length;
			/*
			window.package_pagination = new List('package_search_result', {
				valueNames : [ 'hotel_name', 'hotel_location',
						'hotel_rating', 'adult_children', 'amount','flight_name', 'outbound_departure_airport_code',
						'departure_time', 'departure_airport', 'duration',
						'outbound_arrival_airport_code', 'departure_time',
						'arrival_apirrport'],
				page : 20,
				pagination : true
			});*/
		}
		else
			$( "#package_search_result_ul" ).html('<li class="list_block_li" ><center><b>Sorry, we found no offers which meet your search criteria in our database, however this does not mean we cannot meet your travel needs. <br>You can either broaden your search criteria above, try alternate destinations & dates. <br>Or you can call us.Call Our expert travel consultants  With Your Request 0207 183 6982</b></center></li>');
	  
	});
	 
	request.fail(function( jqXHR, textStatus ) {
		$( "#hotel_search_result_ul" ).html( "<li class='list_block_li' ><center>Request failed: " + textStatus+", try again...</center></li>");
	});
}




function fillFlightPopup(quoteReference){
	
	$("#flightBookModal .input").val('');
	
	var departureAirportName = $("#flight_"+quoteReference+" .departure_airport").html();
	var arrivalAirportName = $("#flight_"+quoteReference+" .arrival_apirrport").html();
	var departureAirportCode = $("#flight_"+quoteReference+" .outbound_departure_airport_code").html();
	var departureTime = $("#flight_"+quoteReference+" .departure_time").html();
	var arrivalAirportCode = $("#flight_"+quoteReference+" .outbound_arrival_airport_code").html();
	var arrivalTime = $("#flight_"+quoteReference+" .arrival_apirrport").closest('div').find(".departure_time").html();
	var flightPrice = $("#flight_"+quoteReference+" .amount").html();
	
	var $html =  departureAirportName + " >> " +arrivalAirportName;
	$html += '<br>';
	$html +=  departureAirportCode + "&nbsp;&nbsp;" + departureTime;
	$html += " >> "+ arrivalAirportCode + "&nbsp;&nbsp;" + arrivalTime;
	$(".flight_from_to").html($html);
	
	$(".flight_price").html(flightPrice);
	
	$("#flightBookModal #quote_reference").val(quoteReference);
	$("#flightBookModal #org_price").val($("#flight_"+quoteReference).attr("data-org_price"));
	$("#flightBookModal #percentage_margin").val($("#flight_"+quoteReference).attr("data-percentage"));
	$("#flightBookModal #booking_price").val($("#flight_"+quoteReference+" .amount").html());
	$("#flightBookModal #type").val('FLIGHT');
	
}

function fillHotelPopup(quoteReference){
	
	$("#flightBookModal .input").val('');
	
	var hotelName = $("#hotel_"+quoteReference+" .hotel_name").html();
	var hotelLocation = $("#hotel_"+quoteReference+" .hotel_location").html();
	var hotelRating = $("#hotel_"+quoteReference+" .hotel_rating").html();
	var personCount = $("#hotel_"+quoteReference+" .adult_children").html();
	var hotelPrice = $("#hotel_"+quoteReference+" .amount").html();
	
	var $html = hotelName + ", " + hotelLocation;
	$html += '<br>';
	$html +=  hotelRating + "<br/>";
	$html += personCount;
	$html +='<div class="quote_ref">'+quoteReference+'</div>';
	$(".flight_from_to").html($html);
	
	$(".flight_price").html(hotelPrice);
	
	$("#flightBookModal #quote_reference").val(quoteReference);
	$("#flightBookModal #org_price").val($("#hotel_"+quoteReference).attr("data-org_price"));
	$("#flightBookModal #percentage_margin").val($("#hotel_"+quoteReference).attr("data-percentage"));
	$("#flightBookModal #booking_price").val($("#hotel_"+quoteReference+" .amount").html());
	$("#flightBookModal #type").val('HOTEL');
	
}


function fillPackagePopup(quoteReference){
	
	$("#flightBookModal .input").val('');

	var departureAirportName = $("#package_"+quoteReference+" .departure_airport").html();
	var arrivalAirportName = $("#package_"+quoteReference+" .arrival_apirrport").html();
	var departureAirportCode = $("#package_"+quoteReference+" .outbound_departure_airport_code").html();
	var departureTime = $("#package_"+quoteReference+" .departure_time").html();
	var arrivalAirportCode = $("#package_"+quoteReference+" .outbound_arrival_airport_code").html();
	var arrivalTime = $("#package_"+quoteReference+" .arrival_apirrport").closest('div').find(".departure_time").html();
	var hotelName = $("#package_"+quoteReference+" .hotel_name").html();
	var hotelLocation  = $("#package_"+quoteReference+" .hotel_location").html();
	var hotelRating = $("#package_"+quoteReference+" .hotel_rating").html();
	var personCount = $("#package_"+quoteReference+" .adult_children").html();
	var packagePrice = $("#package_"+quoteReference+" .amount").html();
	
	var $html = departureAirportName + " >> " + arrivalAirportName;
	$html += '<br>';
	$html +=  departureAirportCode + "&nbsp;&nbsp;" +departureTime;
	$html += " >> "+ arrivalAirportCode + "&nbsp;&nbsp;" + arrivalTime;
	$html += "<br><hr size='2'>"+ hotelName + ", " + hotelLocation;
	$html += '<br>';
	$html += hotelRating + "<br/>";
	$html += personCount;
	//$html +='<div class="quote_ref">'+quoteReference+'</div>';
	$(".flight_from_to").html($html);
	
	$(".flight_price").html(packagePrice);
	
	$("#flightBookModal #quote_reference").val(quoteReference);
	$("#flightBookModal #org_price").val($("#package_"+quoteReference).attr("data-org_price"));
	$("#flightBookModal #percentage_margin").val($("#package_"+quoteReference).attr("data-percentage"));
	$("#flightBookModal #booking_price").val($("#package_"+quoteReference+" .amount").html());
	$("#flightBookModal #type").val('PACKAGE');
	
}


function popupbooking(json){
	
	$(".ajax_response").html("We are processing booking, please wait.....")
	
	var request = $.ajax({
		  url: "./book.php",
		  method: "POST",
		  data: JSON.parse(json),
		  dataType: "html"
		});
		 
		request.done(function( html ) {
				
			$(".ajax_response").html("<font color='green'>"+html+"</font>");
			$("#popup_submit").hide();
			setTimeout(function(){
				$(".ajax_response").html('');
				$('.modal').modal('hide');
				$("#popup_submit").show();
			},5000);
		  
		});
		 
		request.fail(function( jqXHR, textStatus ) {
			$(".ajax_response").html("<font color='red'>Request failed: " + textStatus+", try again...</font>")
			setTimeout(function(){
				$(".ajax_response").html('');
			},1000);
		});
	
	
	
}

function showRatingStar(type){
	var $input = $('#'+type+'_search_result_ul input.rating');
    if ($input.length) {
        $input.removeClass('rating-loading').addClass('rating-loading').rating();
    }
}


