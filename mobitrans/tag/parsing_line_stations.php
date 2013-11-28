<!--
Parsing mobitrans to retrieve the station list for a particular line
ex : http://tag.mobitrans.fr/index.php?p=41&I=c024evn&ligne=60

$linesList containes the dict (name, id);
-->
<?php
	 include('simple_html_dom.php');

if (isset($_GET["id"])) {
	$id = $_GET["id"];
} else {
	$id = 60; //Ile Verte représente.
}

$url = "http://tag.mobitrans.fr/index.php?p=41&I=c024evn&ligne=".$id;
$mobitrans = "<a href=".$url.">Sur Mobitrans</a><br/>";

//retrieve page from mobitrans
$html = file_get_html($url);

//Test if the result is an error page
if(count($html->find('div.error')) == 1) {
	echo "<a href=".$url.">Mobitrans</a> <br />";
	echo json_encode("error");
	exit();
}

$stationList = array();

//All the resultat are in within <div class="corpsL"></div>
$resultNode = $html->find('div.corpsL')[0];

$lineName = $resultNode->find('span')[1]->innertext;
$stationList['line'] = $lineName;
$stationList['stations'] = array();

//first spanwhiteB has the station name
$stations = $resultNode->find('a');

foreach ($stations as $a_station) {
   $id = explode("&",$a_station->href);    #its a url with a bunch of parameter=value 
   $id = substr($id[1],3); #we need parameter n°2 & cut out the parameter name
   $station_name = utf8_encode($a_station->innertext);
   array_push($stationList['stations'], array("id" => $id, "name" => $station_name));
}

if (count($stationList['stations']) > 0) {
   array_pop($stationList['stations']);
}

//output variables 

if(isset($_GET['vardump'])) {
	echo $mobitrans;
	var_dump($stationList);
}

?>