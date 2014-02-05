<?php

if(!isset($_GET['p'])){ // tengo q revisar esto pq en lib mando u, no p

	$article = $vetTalk->getLastArticle();
	//var_dump($article);
	$userId = $article['USER_ID'];
	$title = $article['TITLE'];
	$content = $article['CONTENT'];
	$date = $article['DATE'];
	$name = $article['Users']['NAME'];
	$lastName = $article['Users']['LASTNAME'];

	if(!isset($article['Pics']['THUMB'])){ $srcImg = 'default.jpg'; }
	else{ $srcImg = $article['Pics']['THUMB']; }

}else{

	$vetTalk = new BOVettalk;
	
	$article= $vetTalk->getArticlesById($_GET['p']);
	//var_dump($article);
	$userId = $article[0]['USER_ID'];
	$title = $article[0]['TITLE'];
	$date = $article[0]['DATE'];
	$content = $article[0]['CONTENT'];
	$name = $article[0]['Users']['NAME'];
	$lastName = $article[0]['Users']['LASTNAME'];

	if(!isset($article[0]['Pics']['THUMB'])){ $srcImg = 'default.jpg'; }
	else{ $srcImg = $article[0]['Pics']['THUMB']; }
	
}

?>

	<div class="mod-header">
		<h2><?php echo $title; ?></h2>
	</div>
	<div class="clearfix mod-content">
		<div><!-- scrolleable -->
			
			<p class="vet-talk-article clearfix"> 
				<a href=<?php echo "img/vetTalk/".$srcImg ?>  class='link-img' > <!--  class="vet-talk-img" -->
					<img src=<?php echo "img/vetTalk/thumb/".$srcImg; ?> class="thumb-mid"/>
				</a>
				<?php echo $content; ?>
			</p>
			<ul class="vet-talk-author">
				<li><strong>Autor</strong><i><?php echo ' '.$name.' '.$lastName; ?></i></li>
				<li><i><?php echo $date; ?></i></li>
			</ul>

		</div>
	</div>

<script type="text/javascript">
	modalImg();
</script>