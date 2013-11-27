<?php 
include('parsing_line_stations.php');
include('misc_tag.php');

$colors = getColorForLine(getLineName($stationList['line']));
$lineBg = $colors['bg'];
$lineFg = $colors['fg'];

$style = "style='background:$lineBg; color:$lineFg; margin-bottom:4px'";	
?>

<div id="stationsForLine" style="margin-bottom: 2em;">
   <?php foreach($stationList['stations'] as $a_station) : ?>
      <div class="tuile aStation"  style="margin-top:-7px;" target="<?php echo $a_station['id']; ?>">
         <span class="text" <?php echo $style ?> >
            <?php echo $a_station['name']?>
            <div style="clear:both;"></div>
         </span>
      </div>
   <?php endforeach; ?>	

</div>