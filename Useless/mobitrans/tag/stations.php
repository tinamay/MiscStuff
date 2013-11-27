<?php include('parsing_location.php') ?>
<div id="linesForStations">
   
   <?php foreach($linesForStations as $a_station) : ?>
      <div class="tuile" style="margin-top:20px; margin-bottom:11px;">
         <span class="text"  style="background:#A6B2DD; color:black;"> 
            <?php echo $a_station['name']." (".$a_station['distance']." m)" ?>
         </span>
      </div>
      <?php foreach($a_station['lines'] as $a_line) : 
         $colors = getColorForLine($a_line[0]);
         $lineBg = $colors['bg'];
         $lineFg = $colors['fg'];
         $style = "style=\"background:$lineBg; color:$lineFg; margin-bottom:4px\"";	
         ?>
         <div class="tuile aStation" style="margin-top:-11px;" target="<?php echo $a_line[1]?>">
            <span class="text" <?php echo $style ?> >
               Ligne <?php echo $a_line[0]?>
               <div style="clear:both;"></div>
            </span>
         </div>
      <?php endforeach; ?>
   <?php endforeach; ?>		
</div>