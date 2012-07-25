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
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.css" />
<link rel="stylesheet" href="my.css" />
<link rel="stylesheet" href="myDelayTheme.css" />
<link rel="stylesheet" href="fonts/stylesheet.css" />
<link rel="stylesheet" href="css/mobiscroll-2.0.custom.min.css" />


<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script>
<script src="js/mobiscroll-2.0.custom.min.js"></script>
<script src="js/script.js"></script>

<!-- http://jsbeautifier.org/-->

<script type="text/javascript">
   
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

<div id="register" data-role="page">
<h2>Gepland traject</h2>
  <form id="frmVertraging">
    <table width="100%" border="0" cellspacing="10">
      <tr>
        <!--<td>Van</td>-->
        <td>
       	<input  id="lstDepartureStations"  required title="Vertrekstation is verplicht"  type="text" list="stations" name="departureStation"  class="required" style="width:94%" placeholder="Vertrekstation"/>
	</td>
	
      </tr>
      <tr>
       <!-- <td>Naar</td>-->
        <td>
		<input  id="lstArrivalStations" required title="Aankomst is verplicht" type="text" list="stations" name="arrivalStation" style="width:94%"  placeholder="Aankomststation"/>
			</td>
      </tr>
    <!--  <tr>
      <!--  <td>Datum</td>
        <td width="100%"><input  type="number" id="lstDay"  name="lstDay" style="float:left; width:40px;" placeholder="04" />
          <input  type="text" id="lstMonth"  name="lstMonth" style="float:left; width:40px;"  />
          <input  type="number" id="lstYear"   name="lstYear" style=" width:50px;"/>
		  
        </td>
		</tr>-->
	<tr>
	  <td>
		<fieldset data-role="controlgroup" data-type="horizontal" >
		<select name="lstDay" id="lstDay">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			<option value="13">13</option>
			<option value="14">14</option>
			<option value="15">15</option>
			<option value="16">16</option>
			<option value="17">17</option>
			<option value="18">18</option>
			<option value="19">19</option>
			<option value="20">20</option>
			<option value="21">21</option>
			<option value="22">22</option>
			<option value="23">23</option>
			<option value="24">24</option>
			
	  </select>
		<select name="lstMonth" id="lstMonth" >
			<option value="Jun">juni</option>
			<option value="Jul">juli</option>
			<option value="Aug">augustus</option>
			<option value="Sept">september</option>
			<option value="Okt">oktober</option>
			<option value="Nov">november</option>
			<option value="Dec">december</option>

		</select>
		<!--<select name="lstYear" id="lstYear">
			<option value="2012">2012</option>
			<option value="2013">2013</option>
		</select>-->
		<input type="hidden"  name="lstYear" id="lstYear" value="2012"/>
	</fieldset>
		</td>
		</tr>
		<tr>
			<td>
				<div class="digitalClock">
					<div  class="digit" id="hourHighDisplay">2</div>
					<div class="digit" id="hourLowDisplay">0</div>
					<div class="digit" id="digitalDivider">:</div>
					<div class="digit" id="minutesHighDisplay">3</div>
					<div class="digit" id="minutesLowDisplay">5</div>
				</div>
				<input name="lstHour" id="lstHour" type="hidden">
				<input name="lstMinutes"id="lstMinutes"  type="hidden">
				<input id="i" name="i"  type="hidden" />
			</td>
			
		</tr>

     
  <datalist id="stations" />

   
      <tr>
	  
	    <td width="100%">
			<input  id="btnSubmit" type="button"  data-parameter="foobarshow" class="btn-orange"  data-theme="e" style="width:94%" name="btnSubmit" value="Registreer vertraging" /></td>

      </tr>
	  
    </table>
	
  </form>
  
</div>
<div id="overview" data-role="page">
<ul data-role="listview" class="ui-listview">


		
  <?php 
//show delays from person x
 require_once("assets/configDB.php");
			$verbinding = mysql_connect(MYSQL_SERVER, MYSQL_GEBRUIKERSNAAM, MYSQL_PASWOORD) or die("verbinding mislukt:" . mysql_error());
			mysql_select_db(MYSQL_DATABASE) or die("kon database niet openen:" . mysql_error());
			$sql = "SELECT *,count(*) as aantal FROM `verOverzicht` group by van LIMIT 0, 30 ";
		  $results=mysql_query($sql);		
		echo("<table width='100%'>");
		$index;
			while($row = mysql_fetch_assoc($results)) {
			  $index++;
		
			 echo '<li data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-icon="arrow-r" data-iconpos="right" data-theme="c" class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-li-has-count ui-btn-up-c"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="index.html" class="ui-link-inherit">'. $row["van"] .'-'. $row["naar"].' <span class="ui-li-count ui-btn-up-c ui-btn-corner-all">'. $row["aantal"].'</span></a></div><span class="ui-icon ui-icon-arrow-r ui-icon-shadow">&nbsp;</span></div></li>';
			
		
			/* echo '<tr id="'  .$index .'">';
			  
			  
			 echo '<td width="17"><img src="http://cdn1.iconfinder.com/data/icons/iphone_toolbar_icons/iphone_toolbar_icons/magnifyingglass.png" width="16" height="16"></td>';
			echo '<td>'.$row["datum"].'</td>';
			  echo '<td>'.$row["van"].'</td>';
			  echo '<td>'.$row["naar"].'</td>';
			    echo '<td>'.$row["vertragingen"].'</td>';
				echo '</tr>';*/
			}
			echo '</table>';
				
				mysql_close($verbinding);
 
 ?>
 </ul>
</div>

<div id="info" data-role="page">

<div data-role="popup" id="popupBasic">
	
<div id="rideDetails" style="display:none; width:100%;">

<h1>Alle details van de rit</h1>
<h2>Gepland traject:</h2>
<ul>
<li> vertrektijd: 07:29</li>
<li> aankomsttijd: 08:38</li>
<li> voertuignummer: P7004</li>
</ul>
<h2>Werkelijk traject:</h2>
<ul>
<li> vertrektijd: 07:29</li>
<li> aankomsttijd: 08:38</li>
<li> voertuignummer: L0838</li>
</ul>
<h3>totale vertraging: 45 minuten</h3>
<h3>Registratie geverifieerd en geregistreerd</h3>

</div>
<div data-role="collapsible-set" data-theme="c" data-content-theme="d">
			<div data-role="collapsible">
				<h3>Over deze website</h3>
				<p>Deze website werd ontwikkeld om het registratieproces omtrent vertragingen bij de Belgische spoorwegen eenvoudiger te maken. Het legt de focus op de mobiele gebruiker, die op een eenvoudige manier tijdens het reizen wil registreren hoeveel vertraging hij oploopt tijdens zijn rit. Het is in geen geval de bedoeling dat deze data gebruikt wordt om te provoceren of eventuele klachten te starten aan het adres van de NMBS. Wel is het de bedoeling om een duidelijk beeld te verschaffen hoeveel vertragingen er effectief zijn bij de NMBS.</p>
			</div>
			<div data-role="collapsible">
				<h3>Informatie over vertragingen</h3>
				<ul data-role="listview" class="ui-listview">
			<li data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-icon="arrow-r" data-iconpos="right" data-theme="c" class="ui-btn ui-btn-up-c ui-btn-icon-right ui-li-has-arrow ui-li"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="#/test/docs/lists/lists-nested.html&amp;ui-page=0-8" class="ui-link-inherit"><h3 class="ui-li-heading">Animals</h3><p class="ui-li-desc">All your favorites from aarkvarks to zebras.</p></a></div><span class="ui-icon ui-icon-arrow-r ui-icon-shadow">&nbsp;</span></div></li>
			<li data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-icon="arrow-r" data-iconpos="right" data-theme="c" class="ui-btn ui-btn-up-c ui-btn-icon-right ui-li-has-arrow ui-li"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="#/test/docs/lists/lists-nested.html&amp;ui-page=0-4" class="ui-link-inherit"><h3 class="ui-li-heading">Colors</h3><p class="ui-li-desc">Fresh colors from the magic rainbow.</p></a></div><span class="ui-icon ui-icon-arrow-r ui-icon-shadow">&nbsp;</span></div></li>
			<li data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-icon="arrow-r" data-iconpos="right" data-theme="c" class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-c"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="#/test/docs/lists/lists-nested.html&amp;ui-page=0-3" class="ui-link-inherit"><h3 class="ui-li-heading">Vehicles</h3><p class="ui-li-desc">Everything from cars to planes.</p></a></div><span class="ui-icon ui-icon-arrow-r ui-icon-shadow">&nbsp;</span></div></li>
		</ul>
				<? 
				//rss
				//http://www.railtime.be/website/RSS/RssInfoBar_nl.xml
				// Show number of items  
$items = 4;  

// Load rss into simplexml rss from pctuts http://www.pctuts.be/external.php?do=rss&type=newcontent&sectionid=1&days=120&count=10 just replace this link voor the right one 
$rss        = simplexml_load_file('http://www.railtime.be/website/RSS/RssInfoBar_nl.xml'); 

// Titel from rss 
echo "<h1>{$rss->channel->title}</h1>\n";  

// Get time   
echo "<div class=\"time\">{$rss->channel->lastBuildDate}</div><br>\n";  

// show last items  
for($i=0;$i<$items;$i+=1)  
   {  
   echo "<div class=\"channel\"><a href=\"{$rss->channel->item[$i]->link}\" target=\"_blank\">{$rss->channel->item[$i]->title}</a></div>\n";  
   echo "<div class=\"description\">{$rss->channel->item[$i]->description}</div><br>\n";  
   }  

				?>
				

			</div>
			<div data-role="collapsible">
				<h3>Offici&euml;le procedure NMBS vertragingen</h3>
				<p>
				Sinds 01/09/08 wordt een nieuw compensatiesysteem toegepast dat meer voordelen biedt.
<br/>
Om aanspraak te kunnen maken op een compensatie moet je
biedt.
<br/>
ofwel een occasionele vertraging van minstens 60 minuten oplopen
ofwel herhaaldelijke vertragingen van minstens 15 minuten oplopen op je gebruikelijk traject.
Onder "herhaaldelijke vertragingen" verstaan we minimum 20 vertragingen van minstens 15 minuten of minimum 10 vertragingen van minstens 30 minuten in een periode van 6 maanden vanaf je eerste vertraging. Bijvoorbeeld: tot en met 4 maart 2009 als je een eerste vertraging opliep op 5 september 2008. 
				</p>
			</div>
				<div data-role="collapsible">
				<h3>Instellingen</h3>
				<p>Collapsible content</p>
			</div>
				<div data-role="collapsible">
				<h3>Statistieken</h3>
				
				
				<?php
				require_once("assets/configDB.php");
$verbinding = mysql_connect(MYSQL_SERVER, MYSQL_GEBRUIKERSNAAM, MYSQL_PASWOORD) or die("verbinding mislukt:" . mysql_error());
			mysql_select_db(MYSQL_DATABASE) or die("kon database niet openen:" . mysql_error());
			$sql = "SELECT `vertraingen` FROM `verOverzicht`";
		  $minutes=0;
		  $hours=0;
		  $results=mysql_query($sql);		

			while($row = mysql_fetch_assoc($results)) {
	
			 $vertragingString = $row["vertraingen"];
			  //splitten in uren en minuten
			  $pieces = explode(":", $vertragingString);
			  
			  $hours+=  $pieces[0] ;//uren optellen
			  $minutes+=  $pieces[1] ;//uren optellen
			  
			 
			 }
			 echo "totale vertraging: " . $hours . "uur en" . $minutes . "minuten";
				?>
			</div>
				<div data-role="collapsible">
				<h3>Handige websites</h3>
				<ul>
				<li><a href="http://irail.be/route/" alt="iRail">iRail route planner</a></li>
				<li><a href="http://irail.be/route/" alt="iRail">NMBS route planner</a></li>
				<li><a href="http://irail.be/route/" alt="iRail">De Lijn route planner</a></li>
				<li><a href="http://irail.be/route/" alt="iRail">MIVB route planner</a></li>
				</ul>
			</div>
					<div data-role="collapsible">
				<h3>Vertragingen verwerken en uitprinten</h3>
				<a href="index.html" data-role="button" data-icon="delete">Vertragingen verwerken</a>
				<a href="index.html" data-role="button" data-icon="delete">Vertragingen uitprinten</a>
			</div>
		</div>
  
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