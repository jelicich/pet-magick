	<div class="mod grid_12 pet-loss-mod nogrid-mod ">
			<div class="mod-header">
				<h2><?php echo $a['TITLE']; ?></h2>
			</div>
			<div class="mod-content clearfix">
				<div class="pic-caption">
					
					<a class='link-img' href=<?php echo '"'.$a['Pets']['Pics']['PIC'] .'"' ?>>
						<img src=<?php echo '"'.$a['Pets']['Pics']['THUMB'].'"' ?> class="thumb-mid"/>
					</a>
					
					<h3><?php echo $a['Pets']['NAME']; ?></h3>
					<ul>
						<!-- <li>Breed: <?php //echo $a['Pets']['BREED']?></li> -->
						<li><?php echo $a['SINCE'].'-'.$a['THRU'] //aca solo necesitamos el ano. Asi q hay q modificcar el resto?></li> 
						<!-- <li><?php //echo $a['THRU'] ?></li> -->
					</ul>
				</div>
				
				<div class="bg-txt txt-wider">
					<p><?php echo $a['CONTENT'] ?></p>
				</div>

				<a href=<?php echo '"user-profile.php?u='. $a['USER_ID'] .'"';?> id='visit-member'><span>View member profile >></span></a> <!-- provisorio -->
				
			</div>
		</div>