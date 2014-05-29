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

<!--[if lte IE 8]> <link rel="stylesheet" href="css/ie/ie_index_8.css" type="text/css" /> <![endif]-->
<!--[if IE 7]> <link rel="stylesheet" href="css/ie/ie_index_7.css" type="text/css" /> <![endif]-->

</head>

<body>
	<div id='preloader'><img src='img/loading.gif' alt='loader' /></div>
<div id="wrapper">
	
	<?php 
		include_once 'templates/header.php'; 
	?>

<!-- site content -->
<div class="container_12" id="content">

	<div class="mod vet-talk-mod  terms" id='mainArticle'>
		<div class="mod-header">
			<h2>Privacy</h2>
		</div>
		<div class="clearfix mod-content">
			<div><!-- scrolleable -->
				<div class="vet-talk-article clearfix"> 
					<div class="blind">
						<div class="terms_scroll" id="aboutText">
							<div class="bg-txt-featured-modules">
								<p>
									This Privacy Policy governs the manner in which Pet Magick Limited collects, 

									uses, maintains and discloses information collected from users (each, a "User") of 

									the www.petmagick.com website ("Site"). This privacy policy applies to the Site and all products 

									and services offered by Pet Magick Limited.

									<br><br><strong>Personal identification information</strong><br><br>

									We may collect personal identification information from Users in a variety of ways, including, 

									but not limited to, when Users visit our site, register on the site, and in connection with other 

									activities, services, features or resources we make available on our Site. Users may be asked 

									for, as appropriate, name, email address. Users may, however, visit our Site anonymously. We 

									will collect personal identification information from Users only if they voluntarily submit such 

									information to us. Users can always refuse to supply personally identification information, 

									except that it may prevent them from engaging in certain Site related activities.

									<br><br><strong>Non-personal identification information</strong><br><br>

									We may collect non-personal identification information about Users whenever they interact 

									with our Site. Non-personal identification information may include the browser name, the type 

									of computer and technical information about Users means of connection to our Site, such as the 

									operating system and the Internet service providers utilized and other similar information.

									<br><br><strong>Web browser cookies</strong><br><br>

									Our Site may use "cookies" to enhance User experience. User's web browser places cookies on 

									their hard drive for record-keeping purposes and sometimes to track information about them. 

									User may choose to set their web browser to refuse cookies, or to alert you when cookies are 

									being sent. If they do so, note that some parts of the Site may not function properly.

									<br><br><strong>How we use collected information</strong><br><br>

									Pet Magick Limited may collect and use Users personal information for the following purposes:

									<br><br>•  To personalize user experience<br><br>

									We may use information in the aggregate to understand how our Users as a group use the 

									services and resources provided on our Site.

									<br><br>•  To send periodic emails<br><br>

									We may use the email address to respond to their inquiries, questions, and/or other 

									requests. If User decides to opt-in to our mailing list, they will receive emails that may 

									include company news, updates, related product or service information, etc. If at any 

									time the User would like to unsubscribe from receiving future emails, they may do so by 

									contacting us via our Site.

									<br><br><strong>How we protect your information</strong><br><br>

									We adopt appropriate data collection, storage and processing practices and security measures 

									to protect against unauthorized access, alteration, disclosure or destruction of your personal 

									information, username, password, transaction information and data stored on our Site.

									Sensitive and private data exchange between the Site and its Users happens over a SSL secured 

									communication channel and is encrypted and protected with digital signatures.

									<br><br><strong>Sharing your personal information</strong><br><br>

									We do not sell, trade, or rent Users personal identification information to others. We may 

									share generic aggregated demographic information not linked to any personal identification 

									information regarding visitors and users with our business partners, trusted affiliates and 

									advertisers for the purposes outlined above.

									Advertising

									Ads appearing on our site may be delivered to Users by advertising partners, who may set 

									cookies. These cookies allow the ad server to recognize your computer each time they send you 

									an online advertisement to compile non personal identification information about you or others 

									who use your computer. This information allows ad networks to, among other things, deliver 

									targeted advertisements that they believe will be of most interest to you. This privacy policy does 

									not cover the use of cookies by any advertisers.

									<br><br><strong>Google Adsense</strong><br><br>

									Some of the ads may be served by Google. Google's use of the DART cookie enables it to serve 

									ads to Users based on their visit to our Site and other sites on the Internet. DART uses "non 

									personally identifiable information" and does NOT track personal information about you, such 

									as your name, email address, physical address, etc. You may opt out of the use of the DART 

									cookie by visiting the Google ad and content network privacy policy at http://www.google.com/

								    privacy_ads.html

								    <br><br><strong>Changes to this privacy policy</strong><br><br>

									Pet Magick Limited has the discretion to update this privacy policy at any time. When we do, we 

									will revise the updated date at the bottom of this page. We encourage Users to frequently check 

									this page for any changes to stay informed about how we are helping to protect the personal 

									information we collect. You acknowledge and agree that it is your responsibility to review this 

									privacy policy periodically and become aware of modifications.

									<br><br><strong>Your acceptance of these terms</strong><br><br>

									By using this Site, you signify your acceptance of this policy. If you do not agree to this policy, 

									please do not use our Site. Your continued use of the Site following the posting of changes to 

									this policy will be deemed your acceptance of those changes.

									<br><br>

									

									This document was last updated on April 03, 2014
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
