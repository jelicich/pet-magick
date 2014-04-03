	<div class="mod grid_12 pet-loss-mod nogrid-mod section ">
			<div class="mod-header">
				<h2><?php echo  htmlspecialchars($a['TITLE']); ?></h2>
			</div>
			
			<div class="mod-content clearfix">
				<div class="pic-caption">
					
					<a class='link-img' href=<?php echo '"'.$a['Pets']['Pics']['PIC'] .'"' ?>>
						<img src=<?php echo '"'.$a['Pets']['Pics']['THUMB'].'"' ?> class="thumb-mid"/>
					</a>

						<?php 

							$since = explode("-" , $a['SINCE']);
							$thru = explode("-" , $a['THRU']);
							
						?>
								
						<dl>
							<dt><?php echo  htmlspecialchars($a['Pets']['NAME']); ?></dt>
							<dd><small><?php echo $since[0].'-'.$thru[0]  ?></small></dd>
						</dl>

						<a class="visit-tribute" href= <?php echo '"user-profile.php?u='. $a['USER_ID'] .'"';?> ><span>View user profile</span></a>
				</div>

		

				<div class="blind">
					<div class="scrollable-text" id="tributeText">
						<div class="bg-txt-featured-modules">
							
							<p><?php echo  htmlspecialchars($a['CONTENT']) ?></p>

						</div>
					</div>
				</div>

				
				<!--
				<div class="bg-txt txt-wider">
					<p><?php //echo $a['CONTENT'] ?></p>
				</div>
				-->
			<!--	<a href=<?php //echo '"user-profile.php?u='. $a['USER_ID'] .'"';?> id='visit-member'><span>View member profile >></span></a> <!-- provisorio -->
				
			</div>
		</div>

<script type="text/javascript">
	//modalImg();
	show_img('.link-img');
	start_scroll('scrollable-text', false);
</script>