<?php include('parsing_near_stations.php'); ?>

<div id="nearLinesList">
   <?php for($i = 0; $i <count($res); $i++) : ?>
      <div class="singleLine"  target="lineIndex<?php echo $i ?>" line="<?php echo $res[$i]['line']?>"> 
         <div class="thumb_title">
            <span class="text" style="background:<?php echo $res[$i]['bgcolor']?>; color:<?php echo $res[$i]['fgcolor']?>; border: 4px solid <?php echo $res[$i]['bgcolor']?>;"><?php echo $res[$i]['line'] ?></span>
         </div>
      </div>
   <?php endfor; ?>
</div>
				
<div id="nearStationsForLineList" > 	
   <?php for ($i = 0; $i <count($res); $i++) : ?>
      <div id="lineIndex<?php echo $i ?>" class="allStations">
         <?php foreach ($res[$i]['stations'] as $station): ?>
            <div class="singleStation" target="<?php echo $station['stationID']?>">
               <div class="thumb_title">
                  <span class="text" style="background:<?php echo $res[$i]['bgcolor']?>; color:<?php echo $res[$i]['fgcolor']?>; border: 4px solid <?php echo $res[$i]['bgcolor']?>;"><?php echo $station['station']." (".$station['distance'].'m)' ?></span> <!--&nbsp; -->
               </div>
            </div>
         <?php endforeach; ?>
      </div>
   <?php endfor; ?>
</div>
