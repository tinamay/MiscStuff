<?php include('parsing_time.php') ?>
<?php
$colors = getColorForLine($res['line']);
$lineBg = $colors['bg'];
$lineFg = $colors['fg'];

$style = "style=\"background:$lineBg; color:$lineFg; margin-bottom:4px\"";	
?>



<div id="singleStationTimes">
	
	<?php foreach($res['directions'] as $a_direction) : ?>
		<div class="tuile" style="margin-top:20px;">
			<span class="text" <?php echo $style ?> > <?php echo $a_direction['name']?> </span>
		</div>
		<?php foreach($a_direction['time'] as $a_time) : ?>
			<div class="tuile" style="margin-top:-7px;">
				<span class="text" style="background:#A6B2DD; color:black;">
					<span>Prochain départ: </span>
					<span>&nbsp;&nbsp; <?php echo $a_time ?></span>
					<div style="clear:both;"></div>
				</span>
			</div>
		<?php endforeach; ?>
	<?php endforeach; ?>	
	
	
	<!-- NO BUS - U MAD BRO ? -->
	<?php if(count($res['directions']) == 0) :?>	
		<div class="tuile" style="margin-top:20px;">
			<span class="text" <?php echo $style?> >Ligne <?php echo $res['line']?> - Arrêt : <?php echo $res['station']?> </span>
		</div>
		<div class="tuile" style="margin-top:-7px;">
			<span class="text" style="background:#A6B2DD; color:black;">
				<p>Aucun horaire disponible</p>
			</span>
		</div>
	<?php endif; ?>
</div>