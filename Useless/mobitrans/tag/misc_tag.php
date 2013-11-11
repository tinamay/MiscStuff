<?php
function startsWith($haystack, $needle)
{
    return $needle === "" || strpos($haystack, $needle) === 0;
}


function getColorForLine($lineName) {
	switch($lineName) {
		case "A":
		$color['fg'] = "white";
		$color['bg'] = "#0077BB";
		return $color;

		case "B":
		$color['fg'] = "white";
		$color['bg'] = "#008B45";
		return $color;

		case "C":
		$color['fg'] = "white";
		$color['bg'] = "#E2007A";
		return $color;
		case "CO":
		$color['fg'] = "black";
		$color['bg'] = "#FFED00";
		return $color;

		case "1":
		$color['fg'] = "black";
		$color['bg'] = "#EC7AAA";
		return $color;

      case "11":
      $color['fg'] = "#000000";
      $color['bg'] = "#FFF598";
      return $color;

      case "13":
      $color['fg'] = "#FFFFFF";
      $color['bg'] = "#BD2A33";
      return $color;

      case "16":
      $color['fg'] = "#FFFFFF";
      $color['bg'] = "#76B2DD";
      return $color;

      case "21":
      $color['fg'] = "#000000";
      $color['bg'] = "#B8D698";
      return $color;

      case "23":
      $color['fg'] = "#FFFFFF";
      $color['bg'] = "#FABC00";
      return $color;

      case "26":
      $color['fg'] = "#000000";
      $color['bg'] = "#F2E339";
      return $color;

      case "30":
      $color['fg'] = "#FFFFFF";
      $color['bg'] = "#68C1C0";
      return $color;

      case "31":
      $color['fg'] = "#FFFFFF";
      $color['bg'] = "#A03187";
      return $color;

      case "32":
      $color['fg'] = "#000000";
      $color['bg'] = "#C6D982";
      return $color;

      case "33":
      $color['fg'] = "#FFFFFF";
      $color['bg'] = "#F39D49";
      return $color;

      case "34":
      $color['fg'] = "#000000";
      $color['bg'] = "#D582B0";
      return $color;

      case "41":
      $color['fg'] = "#FFFFFF";
      $color['bg'] = "#69C0BB";
      return $color;

      case "43":
      $color['fg'] = "#000000";
      $color['bg'] = "#d0e7da";
      return $color;

      case "51":
      $color['fg'] = "#000000";
      $color['bg'] = "#C6D982";
      return $color;

      case "55":
      $color['fg'] = "#000000";
      $color['bg'] = "#76B2DD";
      return $color;

      case "56":
      $color['fg'] = "#000000";
      $color['bg'] = "#F9C28F";
      return $color;

      case "58":
      $color['fg'] = "#000000";
      $color['bg'] = "#F9C28F";
      return $color;

	}
}

function getLineName($someString) {
   if(startsWith($someString, "tram")) {
      return substr($someString, 5);
   } else if(startsWith($someString, "ligne")) {
      return substr($someString, 6);
   } else if (startsWith($someString, "chrono")) {
      return substr($someString,7);
   } else {
      return $someString;
   }
} 

?>