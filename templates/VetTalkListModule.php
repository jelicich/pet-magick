<div class="grid_8 mod vet-talk-mod list">
	<div class="mod-header">
		
		<ul class='clearfix mod-menu vt-menu-cat' id='menuByPet'>
		
			<li id='dog'><!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
				<a href='pet-loss.php?c=dog'> <!-- Reemplazar este valor por el numero q corresponda en la bd segun categoria -->
					Dog					
				</a>
				<div id='arrow-dog' class="arrow-pet-loss" <?php if(isset($_GET['c']) && $_GET['c']=='dog' || !isset($_GET['c'])) echo 'style="display:block;"'?> ></div>
			</li>

			<li id='cat'><!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
				<a href='pet-loss.php?c=cat'> <!-- Reemplazar este valor por el numero q corresponda en la bd segun categoria -->
					Cat					
				</a>
				<div id='arrow-cat' class="arrow-pet-loss" <?php if(isset($_GET['c']) && $_GET['c']=='cat') echo 'style="display:block;"'?> ></div>
			</li>

			<li id='bird'><!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
				<a href='pet-loss.php?c=bird'> <!-- Reemplazar este valor por el numero q corresponda en la bd segun categoria -->
					Bird
				</a>
				<div id='arrow-bird' class="arrow-pet-loss" <?php if(isset($_GET['c']) && $_GET['c']=='bird') echo 'style="display:block;"'?> ></div>
			</li>

			<li id='rabbit'><!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
				<a href='pet-loss.php?c=rabbit'> <!-- Reemplazar este valor por el numero q corresponda en la bd segun categoria -->
					Rabbit
				</a>
				<div id='arrow-rabbit' class="arrow-pet-loss" <?php if(isset($_GET['c']) && $_GET['c']=='rabbit') echo 'style="display:block;"'?> ></div>
			</li>

			<li id='ferret'><!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
				<a href='pet-loss.php?c=ferret'> <!-- Reemplazar este valor por el numero q corresponda en la bd segun categoria -->
					Ferret
				</a>
				<div id='arrow-ferret' class="arrow-pet-loss" <?php if(isset($_GET['c']) && $_GET['c']=='ferret') echo 'style="display:block;"'?> ></div>
			</li>

			<li id='others'><!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
				<a href='pet-loss.php?c=others'> <!-- Reemplazar este valor por el numero q corresponda en la bd segun categoria -->
					Others
				</a>
				<div id='arrow-others' class="arrow-pet-loss" <?php if(isset($_GET['c']) && $_GET['c']=='others') echo 'style="display:block;"'?>></div>
			</li>
		</ul>

	</div>	
		<?php 
			//include_once 'modHeader.php'; 
		?>
		<!-- talks -->
		<div class="scrollable-list" id="vetTalkListmodule">
			<ul class="mod-content spacer10">


<?php

	if(!isset($_GET['c']))	
		$category = 1;

	switch ($_GET['c']) 
	{
		case 'dog':
			$category = 1;
			$string = 'dog';									
			break;

		case 'cat':
			$category = 2;
			$string = 'cat';
			break;

		case 'bird':
			$category = 3;
			$string = 'bird';
			break;

		case 'rabbit':
			$category = 4;
			$string = 'rabbit';
			break;

		case 'ferret':
			$category = 5;
			$string = 'cat';
			break;

		case 'others':
			$category = 6;
			$string = 'pet';
			break;
		
		default:
			$category = 1;
			$string = 'dog';
			break;									
	}

	$allArticles = $vetTalk->getAllArticles($category);
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
			else{ $title =  htmlspecialchars($allArticles[$i]['TITLE']); }
			if(!isset( $allArticles[$i]['CONTENT'])){ $content =  '?'; }
			else{ $content =   htmlspecialchars($allArticles[$i]['CONTENT']); }

			//array_push($noRepeat, $j);
			$date =  $time->FormatDisplayDate($allArticles[$i]['DATE']);
?>
	
				<li class="clearfix">
					<img src= <?php echo $srcImg ?> class="thumb-small side-img"/>
					<div class="content-description bg-txt ">
						<h3><?php echo $title; if(strlen($title)==65) echo '...'?></h3>
						<p><?php echo $content; if(strlen($content)==80) echo '...'; ?></p>
					<p class="gray_date"><small><?php echo $date; ?></small></p>

						<span id="<?php echo $articleId; ?>" class='linkToModule' />View post</span>
						<!-- <a href=<?php //echo '#'.$articleId ?> class='linkToModule'>View post</a> -->
					</div>
				</li>
				
<?php
	////}// end else		
		}// end for
?>

		</ul>
	</div><!-- scroll -->
	</div>