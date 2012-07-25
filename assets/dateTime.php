<?php
$datum = date("j F Y");
$dagvanweek = date("d");
/*$arraydag = array(
 "Zondag",
 "Maandag",
 "Dinsdag",
 "Woensdag",
 "Donderdag",
 "Vrijdag",
 "Zaterdag"
 );
 $dagvanweek = $arraydag[date("w")];*/
$arraymaand = array("Jan", "Feb", "Maa", "Apr", "Mei", "Jun", "Jul", "Aug", "Sept", "Okt", "Nov", "Dec");
$datum = $arraymaand[date("n") - 1] . "," . date(" Y");
$fullDate = $dagvanweek . "," . $datum;
$pieces = explode(",", $fullDate);
//hours and minutes
$hour = date('H');
$minutes = date('i');
array_push($pieces, $hour);
array_push($pieces, $minutes);
echo json_encode($pieces);
?>

