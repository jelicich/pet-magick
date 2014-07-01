<?php 
	session_start();
	//session_destroy();
	$_SESSION['token'] = sha1(uniqid()); 
	//var_dump($_SESSION);

	include_once "php/classes/BOPopups.php";
	$pop = new BOPopups;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="Pet Magick is a global social network for pet and animal lovers to connect and share the joy that animal companions bring into their life. A place where those grieving with pet loss can get support from others who've been through the same traumatic experience.">
<meta name="keywords" content="pet lovers,pet owners,pet loss,funny pet videos,pet health,animal health,pet information,animal rescue,pet stories,dog club,cat club">

<title>Pet Magick</title>

<link rel="stylesheet" href="css/reset.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="css/960_12_col.css" type="text/css" />
<link rel="stylesheet" href="css/layout.css" type="text/css" />



<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery.js"></script> 
<script type="text/javascript" src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="js/jq_functions.js"></script> 

<script type="text/javascript" src="js/lib.js"></script>

</head>

<body>
	<div id='preloader'><img src='img/loading.gif' alt='loader' /></div>

	<?php 
		include_once 'templates/No_IE.php'; 
?>

<div id="wrapper">
	
	<?php 
		include_once 'templates/header.php'; 
	?>

<!-- site content -->
<div class="container_12" id="content">

	<div class="mod vet-talk-mod  terms" id='mainArticle'>
		<div class="mod-header">
			<h2>About Pet Magick</h2>
		</div>
		<div class="clearfix mod-content">
			<div><!-- scrolleable -->
				<div class="vet-talk-article clearfix"> 
					<div class="blind">
						<div class="terms_scroll" id="aboutText">
							<div class="bg-txt-featured-modules">
								<p>
We at Pet Magick know that pet lovers are one of the most passionate groups on the planet, why – because we are a part of that group and understand the depth of feeling that can develop when you bring an animal into your life. <br><br>
So we decided to create the means for people to channel that passion, a place where animal lovers can connect and share with others who think the same way and know just what they are talking about. Members can create a personal profile with photo’s and details of the times they spend with their animal friends, their family, their bbq, their new car, wedding…whatever is going on in their life that they’d like to share. And it’s <b>FREE!</b><br><br>


<h3>Grief Support</h3><br>
But Pet Magick is more than just a website to show photo’s and chat about pets. It is also a place for those people who are struggling with the death of a loyal pet friend to express their grief and sense of loss and know that they will be supported by other people who also know and fully understand the depth of the emotional pain they are going through. It’s a place to help with the healing process.<br><br>
<h3>Helping Others</h3><br>
Being charitable is a trait that can not only change an individual’s
life, but also improve  a community, a country and eventually the entire planet. 
So we at Pet Magick strongly support the great work being done by animal shelters and 
refuge centers around the world. Our Organizations  page is a directory 
for registered charities to promote themselves and their cause, a page to highlight 
the charitable work they do and any assistance they require to continue making a positive difference to their local community. 
We also understand that individuals or like minded groups may have a worthy charitable project that they’d like to promote and see expand.
 So we’ve created our Projects page, a place for members to post the details and photo’s of a project that’s close to their heart. 
 It may be something as simple as taking a suitable pet to an aged care facility, so the less mobile residents can once again interact 
 with and enjoy the company of a friendly animal. Or a dog owner lobbying the local council for a fenced off, leash free exercise area 
 for other dog owners and their pets to enjoy. One small idea may spread and become a global network of similar charitable projects, 
 that’s the goal of our Projects page.<br><br>
<h3>Having Fun</h3><br>
We also realize that having a pet can be a lot of fun,
 because pets can do some really funny, sometimes crazy things. If you’ve caught those moments on 
 video then make your pet a star by sharing the footage with other pet lovers on our Animal Antics page.<br><br>
<h3>Pet Health</h3><br>
All responsible pet owners are vigilant in monitoring the health of their pet. 
So we have created a page where general animal health advice is available for 
all visitors to view and registered members can post a question and have it answered by a 
qualified animal health advisor. (NB : all the information posted on the Vet Talk page is for 
advisory purposes only, it is not intended as a diagnosis, if you have concerns about your pet’s health, 
see a qualified veterinarian as soon as possible).<br><br>
<h3>Having a Chat</h3><br>
We know pet owners love to chat about “all things pet”, 
so members can send private messages to others from their personal profile page, 
or participate in a public discussion through the Forum section. Comments are always welcome about any of the 
blog articles posted. (NB: we realize that opinions vary on most subjects and we whole heartedly believe in free speech, 
but rude or inflammatory posts / comments will be removed).<br><br>
<h3>Making a Difference</h3><br>
We at Pet Magick want this site to be more than just a place for pet lovers to chat and share photos, we want this site to make a positive contribution to society and building a global community of passionate pet lovers will be the driving force behind that. So whether you join and start a charitable project that spreads worldwide, or join to make some new pet loving friends, by just joining you will be playing your part in an organization that is “making a difference”.
The great comic Spike Milligan said – “Imagine a world where everything living gets a good fair chance at life.”   Now wouldn’t that be great!    

								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END site content -->

	<?php 
		include_once 'templates/footer.php'; 
	?>

</div>
<!-- END wrapper-->

<script type="text/javascript">
	start_scroll('terms_scroll', false);
</script>

</body>
</html>
