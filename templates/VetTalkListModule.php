<div class="mod grid_12 vet-talk-mod">
		<?php 
			//include_once 'modHeader.php'; 
		?>
		<!-- talks -->
		<ul class="mod-content pet-loss-mod-list spacer10">


<?php

	$allArticles = $vetTalk->getAllArticles();
	//var_dump($allArticles);
	$t = sizeof($allArticles);
	//$noRepeat = array();
	
	for($i=0; $i<$t; $i++){

		//$j = mt_rand(0, $t -1);
		
		//if(isset($noRepeat) && in_array($j, $noRepeat) ){
			
			//$i--;

		//}else{

			$articleId = $allArticles[$i]["ID_VET_TALK"];

			if(!isset($allArticles[$i]['Pics']['THUMB'])){ $srcImg = 'img/vetTalk/thumb/default.jpg'; }
			else{ $srcImg = 'img/vetTalk/thumb/'.$allArticles[$i]['Pics']['THUMB']; }
			if(!isset($allArticles[$i]['TITLE'])){ $title = '?'; }
			else{ $title = $allArticles[$i]['TITLE']; }
			if(!isset( $allArticles[$i]['CONTENT'])){ $content =  '?'; }
			else{ $content =  $allArticles[$i]['CONTENT']; }

			//array_push($noRepeat, $j);
		
?>
	
				<li class="clearfix">
					<img src= <?php echo $srcImg ?> class="thumb-small side-img"/>
					<div class="content-description bg-txt ">
						<h3><?php echo $title ?></h3>
						<p><?php echo $content ?></p>
						<a href=<?php echo '#'.$articleId ?> class='linkToModule'>View post</a>
					</div>
				</li>
				
<?php
	////}// end else		
		}// end for
?>

</ul>
	</div>