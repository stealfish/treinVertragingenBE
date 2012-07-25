<!doctype html>
<!-- Conditional comment for mobile ie7 blogs.msdn.com/b/iemobile/ -->
<!--[if IEMobile 7 ]>    <html class="no-js iem7" lang="en"> <![endif]-->
<!--[if (gt IEMobile 7)|!(IEMobile)]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Mijn vertragingen -- Jouw persoonlijke treinvertragingsregistratietool --</title>
<meta name="description" content="">
<!-- Mobile viewport optimization h5bp.com/ad -->
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="100%">
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<!-- Home screen icon  Mathias Bynens mathiasbynens.be/notes/touch-icons -->
<!-- For iPhone 4 with high-resolution Retina display: -->
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/h/apple-touch-icon.png">
<!-- For first-generation iPad: -->
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/m/apple-touch-icon.png">
<!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
<link rel="apple-touch-icon-precomposed" href="img/l/apple-touch-icon-precomposed.png">
<!-- For nokia devices: -->
<link rel="shortcut icon" href="img/l/apple-touch-icon.png">
<!--<link rel="stylesheet" href="css/uniform.default.css" type="text/css" media="screen" charset="utf-8" />
-->
<!-- iOS web app, delete if not needed. https://github.com/h5bp/mobile-boilerplate/issues/94 -->
<!-- <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black"> -->
<!-- <script>(function(){var a;if(navigator.platform==="iPad"){a=window.orientation!==90||window.orientation===-90?"img/startup-tablet-landscape.png":"img/startup-tablet-portrait.png"}else{a=window.devicePixelRatio===2?"img/startup-retina.png":"img/startup.png"}document.write('<link rel="apple-touch-startup-image" href="'+a+'"/>')})()</script> -->
<!-- The script prevents links from opening in mobile safari. https://gist.github.com/1042026 -->
<!-- <script>(function(a,b,c){if(c in b&&b[c]){var d,e=a.location,f=/^(a|html)$/i;a.addEventListener("click",function(a){d=a.target;while(!f.test(d.nodeName))d=d.parentNode;"href"in d&&(d.href.indexOf("http")||~d.href.indexOf(e.host))&&(a.preventDefault(),e.href=d.href)},!1)}})(document,window.navigator,"standalone")</script> -->
<!-- Mobile IE allows us to activate ClearType technology for smoothing fonts for easy reading -->
<meta http-equiv="cleartype" content="on">
<!-- more tags for your 'head' to consider h5bp.com/d/head-Tips -->
<!-- Main Stylesheet -->
<!-- <link rel="stylesheet" href="css/style.css">-->
<!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->

<!-- <script src="js/libs/jquery.uniform.js" type="text/javascript"></script>-->
<script src="js/libs/modernizr-2.0.6.min.js"></script>
<!--<script type="text/javascript" src="http://www.google.com/jsapi"></script>-->
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" />
<link rel="stylesheet" href="my.css" />
<link rel="stylesheet" href="myDelayTheme.css" />
<style></style>
<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
<script src="js/script.js"></script>
<!-- http://jsbeautifier.org/-->
<script>
    //set selected index from option
    $.fn.jqmSelectedIndex = function (index) {
        var self = $(this)
        self.prop('selectedIndex', index).selectmenu("refresh");

        return self;
    }
</script>
<script type="text/javascript">
    var toggleCount = 0;


    $(document).ready(function () {
        //$("#frmVertraging").validationEngine();
        $("tr:even").addClass("even");
        //init date
        $.get("assets/dateTime.php", function (data) {


            //alert(data)
            data = $.parseJSON(data);
            console.log(data);

            $("#lstHour").attr("placeholder", data[3]).attr("value", data[3]);;
            $("#lstMinutes").attr("placeholder", data[4]).attr("value", data[4]);
            
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
            url: "http://api.irail.be/stations/?lang=NL",
            dataType: "XML",
            success: stationDataSuccesfull
        })

        $("#lstHour").live("change", function () {
            $(this).attr("placeholder", $(this).text())
            //alert("fdjkmdfs");
        });


        $("#btnSubmit").click(function (event) {
            event.preventDefault();
            var data = $('form').serialize();
            console.log(data);

            registerNewTrainDelay(data);
           
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
            type: "POST",
            url: "assets/management.php",
            data: data,
            success: succeeded,
            cache: false
        });

    }


    function succeeded(val) {
	try {
        console.log("value die geretourneerd is:" + val);
        processingAnswer = $.parseJSON(val);
        console.log("decoded:"  + val);

        setCookie('message', processingAnswer["message"], 1);
        setCookie('errorID', processingAnswer["errorID"], 1);
        $.mobile.changePage("success.html", {
            role: 'dialog',
            transition: 'pop'
        });
		}catch(ex){
		console.log("Er is iets fout gegaan tijdens het parsen van de json:"  +ex)
		}
    }

    function stationDataSuccesfull(stations) {
        console.log("stations ingeleze");
        var int = 0;
        $(stations).find('station').each(function (index) {
            var xml_station = $(this).text();
            $("#stations").append("<option label ='" + xml_station + "'value='" + xml_station + "'></option>");
        }); // end each loop  
    }
	
	
	$("#overview tr").live("click",function(){
	console.log($(this));
	$(this).after($("#rideDetails").show());
	//$("#popupBasic").popup('open');
	});
</script>
	<!--[if lt IE 9]>
<script src="js/libs/html5shiv/html5shiv.js"></script>
<![endif]-->
 <style type="text/css">
 #overview  tr:first{background-color: #000;}
  #overview .even td{background-color: #CCC;}
  #overview td{font-size:0.8em;}
  #overview {height:100% overflow:hidden;}
  
  
  </style>
</head>
<body>
<div id="container">
<header> 


<div data-position="absolute"    data-role="header" data-tap-toggle="false" class="ui-header ui-bar-a ui-navbar-expanded slideup" role="contentinfo">

	
	
	<div data-role="header" class="ui-footer ui-bar-a" role="contentinfo"  >
		<div data-role="navbar" class="ui-navbar" role="navigation" >
			<ul class="ui-grid-b">
				<li class="ui-block-a"><a data-icon="grid" href="#register" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-iconpos="top" data-theme="b" data-inline="true" class="ui-btn ui-btn-inline ui-btn-icon-top ui-btn-up-a"><span class="ui-btn-inner"><span class="ui-btn-text">Registreren</span><span class="ui-icon ui-icon-grid ui-icon-shadow">&nbsp;</span></span></a></li>
				<li class="ui-block-b"><a class=" ui-btn ui-btn-inline ui-btn-icon-top ui-btn-up-a" data-icon="star" href="#overview" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-iconpos="top" data-theme="a" data-inline="true"><span class="ui-btn-inner"><span class="ui-btn-text">Overzicht</span><span class="ui-icon ui-icon-star ui-icon-shadow">&nbsp;</span></span></a></li>
				<li class="ui-block-c"><a data-icon="gear" href="#info" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-iconpos="top" data-theme="c" data-inline="true" class="ui-btn ui-btn-up-a ui-btn-inline ui-btn-icon-top"><span class="ui-btn-inner"><span class="ui-btn-text">Extra</span><span class="ui-icon ui-icon-gear ui-icon-shadow">&nbsp;</span></span></a></li>
			</ul>
		</div><!-- /navbar -->
	</div>

</header>
<div id="main" role="main">

  
  </div>
   
    <footer>

    </footer>
  </div> <!--! end of #container -->


  <!-- JavaScript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if necessary -->
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.2.min.js"><\/script>')</script>

  <!-- scripts concatenated and minified via ant build script-->
  <script src="js/helper.js"></script>
  <!--<script src="http://www.bisdom-gent.be/nieuwsbrief/js/languages/jquery.validationEngine-nl.js"></script>
<script src="http://www.bisdom-gent.be/nieuwsbrief/js/jquery.validationEngine.js"></script>-->

  <!-- end scripts-->

  <!-- Debugger - remove for production -->
  <!-- <script src="https://getfirebug.com/firebug-lite.js"></script> -->

  <!-- Asynchronous Google Analytics snippet. Change UA-XXXXX-X to be your site's ID.
       mathiasbynens.be/notes/async-analytics-snippet -->


</body>
</html>