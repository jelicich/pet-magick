<?php


if(!isset($_GET['p'])){ // tengo q revisar esto pq en lib mando u, no p

	$article = $vetTalk->getLastArticle();
	//var_dump($article);
	$userId = $article['USER_ID'];
	$title =  htmlspecialchars($article['TITLE']);
	$content =  htmlspecialchars($article['CONTENT']);
	$date = $article['DATE'];
	$name =  htmlspecialchars($article['Users']['NAME']);
	$lastName =  htmlspecialchars($article['Users']['LASTNAME']);

	if(!isset($article['Pics']['THUMB'])){ $srcImg = 'default.jpg'; }
	else{ $srcImg = $article['Pics']['THUMB']; }

}else{

	$vetTalk = new BOVettalk;
	
	$article= $vetTalk->getArticlesById($_GET['p']);
	//var_dump($article);
	$userId = $article[0]['USER_ID'];
	$title =  htmlspecialchars($article[0]['TITLE']);
	$date = $article[0]['DATE'];
	$content =  htmlspecialchars($article[0]['CONTENT']);
	$name =  htmlspecialchars($article[0]['Users']['NAME']);
	$lastName =  htmlspecialchars($article[0]['Users']['LASTNAME']);

	if(!isset($article[0]['Pics']['THUMB'])){ $srcImg = 'default.jpg'; }
	else{ $srcImg = $article[0]['Pics']['THUMB']; }
	
}	
	$time = new BOLocation;
	$date =  $time->FormatDisplayDate($date);
?>
<div class="mod vet-talk-mod" id='mainArticle'>
	<div class="mod-header">
		<h2><?php echo $title; ?></h2>
	</div>
	<div class="clearfix mod-content">
		<div><!-- scrolleable -->
			
			<div class="vet-talk-article clearfix"> 
				<div class="pic-caption">
					<a href=<?php echo "img/vetTalk/".$srcImg ?> class='link-img img-float' >
						<img src=<?php echo "img/vetTalk/thumb/".$srcImg; ?> class="thumb-mid"/>
					</a>
				
					<p><b>By </b><?php echo $name.' '.$lastName; ?></p>
					<span class="gray_date"><small><?php echo $date; ?></small></span>
				
				</div>

				<div class="blind">
					<div class="scrollable-text" id="aboutText">
						<div class="bg-txt-featured-modules">
							
							<p>
								<?php echo $content; ?>
							</p>

						</div>
					</div>
				</div>
			</div>
			

			<!--
			<ul class="vet-talk-author">
				<li><strong>Autor</strong><i><?php echo ' '.$name.' '.$lastName; ?></i></li>
				<li><i><?php echo $date; ?></i></li>
			</ul>-->

		</div>
	</div>
</div>
<script type="text/javascript">
	//modalImg();
	show_img('.link-img');
	start_scroll('scrollable-text', false);
</script>



				