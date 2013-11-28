<!--
Parsing mobitrans to retrieve the lines list


$linesList containes the dict (name, id);
-->
<?php
	 include('simple_html_dom.php');

if (isset($_GET["id"])) {
	$id = $_GET["id"];
} else {
	$id = 762; //Ile Verte représente.
}

$url = "http://tag.mobitrans.fr/index.php?p=13&m=1&I=a0249ta";
$mobitrans = "<a href=".$url.">Sur Mobitrans</a><br/>";

//retrieve page from mobitrans
$html = file_get_html($url);

//Test if the result is an error page
if(count($html->find('div.error')) == 1) {
	echo "<a href=".$url.">Mobitrans</a> <br />";
	echo json_encode("error");
	exit();
}

$linesList = array();

//All the resultat are in within <div class="corpsL"></div>
$formNode = $html->find('form')[0];
$lineOption = $formNode->find('option');

foreach ($lineOption as $aLine) {
   array_push($linesList, array("name" => $aLine->innertext, "id" => $aLine->value));
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