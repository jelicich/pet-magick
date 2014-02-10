
<div class="mod grid_8 org-mod">
		<div class="mod-header">
			<h2>Posts</h2>
		</div>
		<!-- talks -->
			<ul class="mod-content pet-loss-mod-list talks-list">


<?php
				
	//include_once "php/classes/BOOrganizations.php";
	//include_once "php/classes/BOPics.php";

	//$org = new BOOrganizations;
	//$pics = new BOPics;


	$allBlogs = $blog->getAllBlogs();
	//var_dump($allBlogs);
	$t = sizeof($allBlogs);
	//$noRepeat = array();
	
	for($i=0; $i<$t; $i++){

	

			$blogId = $allBlogs[$i]["ID_BLOG"];
			$date = $allBlogs[$i]["DATE"];

			if(!isset($allBlogs[$i]['Pics']['THUMB'])){ $srcImg = 'img/users/thumb/default.jpg'; }
			else{ $srcImg = 'img/blogs/thumb/'.$allBlogs[$i]['Pics']['THUMB']; }
			if(!isset($allBlogs[$i]['TITLE'])){ $title = '?'; }
			else{ $title = $allBlogs[$i]['TITLE']; }
			if(!isset( $allBlogs[$i]['CONTENT'])){ $content =  '?'; }
			else{ $content =  $allBlogs[$i]['CONTENT']; }

			//array_push($noRepeat, $i);
		
?>
	
				<li class="clearfix">
					<img src= <?php echo $srcImg ?> class="thumb-small side-img"/>
					<div class="content-description bg-txt ">
						<h3><?php echo $title ?></h3>
						<p><?php echo $content ?></p>
						<p><?php echo $date ?></p>
						<a href=<?php echo '#'.$blogId ?> class='linkToModule'>View post</a>
					</div>
				</li>
				
<?php
			
		}// end for
?>

</ul>
	</div>