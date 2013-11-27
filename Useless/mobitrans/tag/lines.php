<?php 
include('parsing_lineslist.php');
include('misc_tag.php');
?>

<div id="linesList" style="margin-bottom: 2em;">
   <?php foreach($linesList as $a_line) : 
      
      $colors = getColorForLine(getLineName($a_line['name']));
      $lineBg = $colors['bg'];
      $lineFg = $colors['fg'];

      $style = "style='background:$lineBg; color:$lineFg; margin-bottom:4px'";	
      ?>
      <div class="tuile aLine"  style="margin-top:-7px;" target="<?php echo $a_line['id']; ?>">
         <span class="text" <?php echo $style ?> >
            Ligne <?php echo $a_line['name']?>
            <div style="clear:both;"></div>
         </span>
      </div>
   <?php endforeach; ?>	

</div>