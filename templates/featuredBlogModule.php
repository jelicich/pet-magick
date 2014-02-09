<?php

if(!isset($_GET['p'])){ // tengo q revisar esto pq en lib mando u, no p

	$featuredBlog = $blog->getLastBlog();
	//var_dump($featuredBlog);
	$userId = $featuredBlog['USER_ID'];
	$title = $featuredBlog['TITLE'];
	$content = $featuredBlog['CONTENT'];
	$date = $featuredBlog['DATE'];
	if(!isset($featuredBlog['Pics']['THUMB'])){ $srcImg = 'default.jpg'; }
	else{ $srcImg = $featuredBlog['Pics']['THUMB']; }

}else{

	$blog = new BOBlogs;
	
	$featuredBlog= $blog->getBlogsById($_GET['p']);

	//var_dump($featuredBlog);
	$userId = $featuredBlog[0]['USER_ID'];
	$title = $featuredBlog[0]['TITLE'];
	$content = $featuredBlog[0]['CONTENT'];
	$date = $featuredBlog[0]['DATE'];

	if(!isset($featuredBlog[0]['Pics']['PIC'])){ $srcImg = 'default.jpg'; }
	else{ $srcImg = $featuredBlog[0]['Pics']['PIC']; }
	
}
?>


<div class="mod-header">
	<h2>Featured Blog</h2>
</div>

<div class="mod-content clearfix">
	
	<div class="pic-caption">
		<a class='link-img' href=<?php echo "img/blogs/".$srcImg ?> >
			<img src= <?php echo "img/blogs/thumb/".$srcImg ?> class="thumb-mid"/>
		</a>
		<h3> <?php echo $title ?> </h3>
		<p> <?php echo $date ?> </p>
	</div>
	
	<div class="bg-txt txt-wider">
		
		<p> <?php echo $content ?> </p>

	</div>
	
	<a href= <?php echo "user-profile.php?u=".$userId; ?> ><span>Contact user >></span></a>
	
</div>

<script type="text/javascript">
	modalImg();
</script>