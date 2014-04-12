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
			<h2>Terms and conditions</h2>
		</div>
		<div class="clearfix mod-content">
			<div><!-- scrolleable -->
				<div class="vet-talk-article clearfix"> 
					<div class="blind">
						<div class="terms_scroll" id="aboutText">
							<div class="bg-txt-featured-modules">
									<p><b>Acceptance The Use Of www.petmagick.com Terms and Conditions</b></p><br/>
									<p>Your  access  to  and  use  of  www.petmagick.com is  subject exclusively to these Terms and Conditions. You will not use the Website for any purpose that is unlawful or prohibited by these Terms and Conditions. By using  the  Website  you  are  fully  accepting  the  terms,  conditions  and disclaimers contained in this notice. If you do not accept these Terms and Conditions you must immediately stop using the Website.</p>

									<br/><p><b>Credit card details</b></p><br/>
									<p>www.petmagick.com will never ask for Credit Card details and request that you do not enter it on any of the forms on www.petmagick.com.</p>

									<br/><p><b>Advice</b></p><br/>
									<p>The contents of www.petmagick.com website do not constitute advice and should not be relied upon in making or refraining from making, any decision.</p>

									<br/><p><b>Change of Use</b></p><br/>
									<p>www.petmagick.com reserves the right to:<br /> 4.1 &nbsp;change or remove (temporarily or permanently) the Website or any part of it without notice and you confirm that www.petmagick.com shall not be liable to you for any such change or removal and.<br /> 4.2 &nbsp;change these Terms and Conditions at any time, and your continued use of the Website following any changes shall be deemed to be your acceptance of such change.</p>

									<br/><p><b>Links to Third Party Websites</b></p><br/>
									<p>www.petmagick.com Website may include links to third party websites that are controlled and maintained by others. Any link to other websites is not an endorsement of such websites and you acknowledge and agree that we are not responsible for the content or availability of any such sites.</p>

									<br/><p><b>Copyright </b></p><br/>
									<p>6.1 &nbsp;All  copyright,  trade  marks  and  all  other  intellectual  property  rights  in  the Website and its content (including without limitation the Website design, text, graphics and all software and source codes connected with the Website) are owned by or   licensed to www.petmagick.com or otherwise used by www.petmagick.com as permitted by law.<br /> 6.2 &nbsp;In accessing the Website you agree that you will access the content solely for your personal, non-commercial use. None of the content may be downloaded, copied, reproduced, transmitted, stored, sold or distributed without the prior written consent of the copyright holder. This excludes the downloading, copying and/or printing of pages of the Website for personal, non-commercial home use only.</p>

									<br/><p><b>Disclaimers and Limitation of Liability </b></p><br/>
									<p>7.1 &nbsp;The Website is provided on an AS IS and AS AVAILABLE basis without any representation or endorsement made and without warranty of any kind whether express or implied, including but not limited to the implied warranties of satisfactory quality, fitness for a particular purpose, non-infringement, compatibility, security and accuracy.<br /> 7.2 &nbsp;To the extent permitted by law, www.petmagick.com will not be liable for any indirect or consequential loss or damage whatever (including without limitation loss of business, opportunity, data, profits) arising out of or in connection with the use of the Website.<br /> 7.3 &nbsp;www.petmagick.com makes no warranty that the functionality of the Website will be uninterrupted or error free, that defects will be corrected or that the Website or the server that makes it available are free of viruses or anything else which may be harmful or destructive.<br /> 7.4 &nbsp;Nothing in these Terms and Conditions shall be construed so as to exclude or limit the liability of www.petmagick.com for death or personal injury as a result of the negligence of www.petmagick.com or that of its employees or agents.</p>

									<br/><p><b>Indemnity</b></p><br/>
									<p>You agree to indemnify and hold www.petmagick.com and its employees and agents harmless from and against all liabilities, legal fees, damages, losses, costs and other expenses in relation to any claims or actions brought against www.petmagick.com arising out of any breach by you of these Terms and Conditions or other liabilities arising out of your use of this Website.</p>

									<br/><p><b>Severance</b></p><br/>
									<p>If any of these Terms and Conditions should be determined to be invalid, illegal or unenforceable for any reason by any court of competent jurisdiction then such Term or Condition shall be severed and the remaining Terms and Conditions shall survive and remain in full force and effect and continue to be binding and enforceable.</p>

									<br/><p><b>Governing Law</b></p><br/>
									<p>These Terms and Conditions shall be governed by and construed in accordance with the law of USA and you hereby submit to the exclusive jurisdiction of the USA courts.</p><br/>

									For any further information please email <a href='mailto:saudadeh@gmail.com.com'>webmaster</a>
									<!--Terms and conditions generator from http://madsubmitter.com-->
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
