<?php

$org = new BOOrganizations;

if(!isset($_GET['p'])){

	$featuredOrg = $org->getOrganizationsRamdom();
	//var_dump($featuredOrg);
	$userId = $featuredOrg['USER_ID'];
	$name = $featuredOrg['NAME'];
	$description = $featuredOrg['DESCRIPTION'];
	if(!isset($featuredOrg['Pics']['THUMB'])){ $srcImg = 'img/users/thumb/default.jpg'; }
	else{ $srcImg = "img/organizations/thumb/".$featuredOrg['Pics']['THUMB']; }

}else{
	
	$featuredOrg= $org->getOrganizationsById($_GET['p']);
	//var_dump($featuredOrg);
	$userId = $featuredOrg[0]['USER_ID'];
	$name = $featuredOrg[0]['NAME'];
	$description = $featuredOrg[0]['DESCRIPTION'];

	if(!isset($featuredOrg[0]['Pics']['THUMB'])){ $srcImg = 'img/users/thumb/default.jpg'; }
	else{ $srcImg = "img/organizations/thumb/".$featuredOrg[0]['Pics']['THUMB']; }
	
}
?>


<div class="mod-header">
	<h2>Featured organization</h2>
</div>

<div class="mod-content clearfix">
	
	<div class="pic-caption">
		<img src= <?php echo $srcImg ?> class="thumb-mid"/>
		<h3> <?php echo $name ?> </h3>
	</div>
	
	<div class="bg-txt txt-wider">
		
		<p> <?php echo $description ?> </p>

	</div>
	<a href= <?php echo "user-profile.php?u=".$userId; ?> >Contact user</a>
	
</div>

