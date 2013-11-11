<?php
	 include('simple_html_dom.php');
    include('misc_tag.php');

if (isset($_GET["id"])) {
	$id = $_GET["id"];
} else {
	$id = 762; //Ile Verte représente.
}

$url = "http://tag.mobitrans.fr/index.php?p=49&I=a0249ta&id="."$id";
$mobitrans = "<a href=".$url.">Sur Mobitrans</a><br/>";

//retrieve page from mobitrans
$html = file_get_html($url);

//Test if the result is an error page
if(count($html->find('div.error')) == 1) {
	echo "<a href=".$url.">Mobitrans</a> <br />";
	echo json_encode("error");
	exit();
}

//All the resultat are in within <div class="corpsL"></div>
$resultNode = $html->find('div.corpsL')[0];

//first spanwhiteB has the station name
$arret = $resultNode->find('span.whiteB')[0]->innertext;
$res['station'] = utf8_encode(substr($arret,7));

//third span has the ligne name
$ligne = $resultNode->find('span')[2]->innertext;
$ligne = getLineName($ligne);
$res['line'] = $ligne;

//Skipping the infoTrafic 
$infoTrafic = $resultNode->find('.infoTrafic',0);
$bNodeIndex = 0;
if (isset($infoTrafic)) {
	$bNodeIndex = count($infoTrafic->find('b'));
	$infoTrafic->outertext = '';	
}

$directions = array();
$bNodeCount = count($resultNode->find('b'));
$exploded = explode("<br/><br/>", $resultNode->innertext );



//
//Parsing direction
//

//var_dump($exploded);

$res['directions'] = array();

$bNodes = $resultNode->find('b'); //Direction names are within <b></b>

//How much items at the end of the split do we skip ? (useless content)
if ( count($resultNode->find('span.whiteB')) > 2) {
	$uselessLines = 2;
} else {
	$uselessLines = 1;
}

$bNodeSkip = $bNodeIndex;  
$i = 1; //skipping first element (station + line)


while ($i < count($exploded)-$uselessLines && count($bNodes) > $bNodeSkip) { //not entering loop if no direction provided
	$a_direction['time'] = parseTime($exploded[$i]); 
	while ( $bNodeIndex < count($bNodes)) {
		if (strlen($bNodes[$bNodeIndex]->innertext) >2) {
			$a_direction['name'] = substr($bNodes[$bNodeIndex]->innertext,5); // remove le "Vers: "
			$bNodeIndex++;
			break;
		}
		$bNodeIndex++;
	}
	$i++;
	array_push($res['directions'], $a_direction);
}


//output variables 

if(isset($_GET['json'])) {
	header("Content-type: application/json");
	echo json_encode($res);	
}

if(isset($_GET['vardump'])) {
	echo $mobitrans;
	var_dump($res);
}



function parseTime($inputString)
{
	$result = array();

	$pattern = "/(\d*min|proche|\d*h\d\d)/";

	preg_match_all($pattern, $inputString, $matches);

	return $matches[0];
}

?>