<!doctype html>
<!-- Conditional comment for mobile ie7 blogs.msdn.com/b/iemobile/ -->
<!--[if IEMobile 7 ]>    <html class="no-js iem7" lang="en"> <![endif]-->
<!--[if (gt IEMobile 7)|!(IEMobile)]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<title></title>
<meta name="description" content="">
<!-- Mobile viewport optimization h5bp.com/ad -->
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<!-- <script src="js/libs/jquery.uniform.js" type="text/javascript"></script>-->
<script src="js/libs/modernizr-2.0.6.min.js"></script>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" />
<link rel="stylesheet" href="my.css" />
<link rel="stylesheet" href="myDelayTheme.css" />
<style></style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js">
        </script>
<script src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js">
        </script>
		<script>
		$(document).ready(function() {

			$("tr:even").addClass("even");
		});
		</script>
 <style type="text/css">
  .even td{background-color: #CCC;}
  </style>
</head>

<body>



  <div id="container">
    <header>

    </header>
    <div id="main" role="main">
		<?php include("navigation.html");?>

    <div id="overview" data-url="info">
  <?php 
//show delays from person x
 require_once("assets/configDB.php");
			$verbinding = mysql_connect(MYSQL_SERVER, MYSQL_GEBRUIKERSNAAM, MYSQL_PASWOORD) or die("verbinding mislukt:" . mysql_error());
			mysql_select_db(MYSQL_DATABASE) or die("kon database niet openen:" . mysql_error());
			$sql = "SELECT * FROM verOverzicht`;\n";
	
		  $results=mysql_query($sql);		
		echo("<table width='100%'>");
		$val = 0;
		$appliedClass="";
		while($row = mysql_fetch_assoc($results)) { 
		if($val % 2 == 0){
		$appliedClass ="odd";
		}else{
			$appliedClass ="even";
		}
			  echo '<tr class='.$appliedClass.'>';
			  echo '<td>'.$row["datum"].'</td>';
			  echo '<td>'.$row["van"].'</td>';
			  echo '<td>'.$row["naar"].'</td>';
			  echo '<td>'.$row["vertragingen"].'</td>';
			  echo '</tr>';
		}
		echo '</table>';
 
 ?>
</div>

	</div>

    <footer>

    </footer>
  </div> <!--! end of #container -->


  <!-- JavaScript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if necessary -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>

  <!-- scripts concatenated and minified via ant build script-->
  <script src="js/helper.js"></script>
  <!-- end scripts-->

  <!-- Debugger - remove for production -->
  <!-- <script src="https://getfirebug.com/firebug-lite.js"></script> -->

  <!-- Asynchronous Google Analytics snippet. Change UA-XXXXX-X to be your site's ID.
       mathiasbynens.be/notes/async-analytics-snippet -->
  <script>
    var _gaq=[["_setAccount","UA-XXXXX-X"],["_trackPageview"]];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
    g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
    s.parentNode.insertBefore(g,s)}(document,"script"));
  </script>

</body>
</html>