var toggleCount = 0;
//project features
/*
 Use google translate api for basic translation
 EN/DE/FR/NL
 * */

log('javascript start', this, {
	alpha : "root",
	beta : "boot"
});

//check if user is already registered or signedon on this machine
/* local storage API*/
if (true) {
} else {
};

if (getCookie("registeredUser") == null) {

}

startWalkThrough();
/*function showing howto for new users*/
function startWalkThrough() {
	//open modal popup
	$.mobile.changePage("help/walkthrough/one.html", {
		role : 'dialog',
		transition : 'pop'
	});

}


$(document).ready(function() {

	//check for usercookie

	//mobiscroll code

	//get users mobile phone and adjust theme accordingly

	$('#i').scroller({
		preset : 'time',
		theme : 'android	',
		display : 'modal',
		mode : 'scroller',
		onSelect : timeSelected
	});

	function timeSelected(textDate, inst) {
		console.log(textDate)
		//set date

	}


	$('.digitalClock').click(function() {
		$('#i').scroller('option', {
			timeFormat : 'HH:ii'
		});
		$('#i').scroller('show');
		return false;
	});

	//$("#frmVertraging").validationEngine();
	$("tr:even").addClass("even");
	//init date
	$.get("assets/dateTime.php", function(data) {

		//alert(data)
		data = $.parseJSON(data);
		console.log(data);

		//split date and time into segments
		var hourSplit = String(data[3]).split('');
		console.log(hourSplit);
		$("#hourHighDisplay").html(hourSplit[0]);
		$("#hourLowDisplay").html(hourSplit[1]);

		var minutesSplit = String(data[4]).split('');
		console.log(minutesSplit);
		$("#minutesHighDisplay").html(minutesSplit[0]);
		$("#minutesLowDisplay").html(minutesSplit[1]);

		//assign values to hidden input fields
		$('#lstHour').val(data[3]);
		$('#lstMinutes').val(data[4]);

		//set value of selected day
		var toSelect = $("select#lstDay [value='" + data[0] + "']").attr("value");
		var dayIndex = $("select#lstDay [value='" + data[0] + "']").index()
		$("select#lstDay").jqmSelectedIndex(dayIndex);

		//set value of selected month
		var toSelect = $("select#lstMonth [value='" + data[1] + "']").attr("value");
		var monthIndex = $("select#lstMonth [value='" + data[1] + "']").index()
		$("select#lstMonth").jqmSelectedIndex(monthIndex);

		/*//set value of selected year
		 var toSelect = $("select#lstYear [value='" + data[2] + "']").attr("value");
		 var yearIndex = $("select#lstYear [value='" + data[2] + "']").index()
		 $("select#lstYear").jqmSelectedIndex(yearIndex);

		 console.log("jaar: "  + data[2]); */

	});

	$("#dateSelector").toggle();
	$.ajax({
		url : "http://api.irail.be/stations/?lang=NL",
		dataType : "XML",
		success : stationDataSuccesfull
	})

	$("#lstHour").live("change", function() {
		$(this).attr("placeholder", $(this).text())
		//alert("fdjkmdfs");
	});

	$("#btnSubmit").click(function(event) {

		//check validation
		if ($("#lstDepartureStation").val("") || $("#lstArrivalstation").val("")) {
			alert("Gelieve uw vertrek en aankomstdata in te geven")
		} else {
			event.preventDefault();
			var data = $('form').serialize();
			console.log(data);

			registerNewTrainDelay(data);
		}
	});

});

function registerNewTrainDelay(data) {

	//check if alternative route is selected
	/* if ($("#btnAlternativeRoute").attr("enabled") === "true") {
	 console.log("true");
	 } else {
	 console.log("false");
	 }*/
	$.ajax({
		type : "POST",
		url : "assets/management.php",
		data : data,
		success : succeeded,
		cache : false
	});

}

function succeeded(val) {
	try {
		console.log("value die geretourneerd is:" + val);
		processingAnswer = $.parseJSON(val);
		console.log("decoded:" + val);

		setCookie('message', processingAnswer["message"], 1);
		setCookie('errorID', processingAnswer["errorID"], 1);
		$.mobile.changePage("success.html", {
			role : 'dialog',
			transition : 'pop'
		});
	} catch(ex) {
		console.log("Er is iets fout gegaan tijdens het parsen van de json:" + ex)

	}
}

function stationDataSuccesfull(stations) {
	console.log("stations ingeleze");
	var int = 0;
	$(stations).find('station').each(function(index) {
		var xml_station = $(this).text();
		$("#stations").append("<option label ='" + xml_station + "'value='" + xml_station + "'></option>");
	});
	// end each loop
}


$("#overview tr").live("click", function() {
	console.log($(this));
	$(this).after($("#rideDetails").show());
	//$("#popupBasic").popup('open');
});

//set selected index from option
$.fn.jqmSelectedIndex = function(index) {
	var self = $(this)
	self.prop('selectedIndex', index).selectmenu("refresh");

	return self;
}
