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
								<p>
									Wu-wei is another term which defies exact
									translation so is usually left as it is. It is the
									doctrine of inaction or non-action, but only
									a superficial outlook interprets it as laissez
									faire, in the sense of indifference, for the
									Taoist is not indifferent, but should be totally
									committed to life. If any translation should
									be attempted, possibly “non-interference” or
									“letting-go” is the best. At the lowest level it
									is a policy of naturalness, of “live and let live”
									and of avoiding friction, with its inevitable
									consequences of discord and conflict, whether
									on the individual
									or national scale, and allowing
									the maximum of individual liberty
									and understanding the views of others. It is
									also a letting-go, a giving-way, a yielding, primarily
									a yielding
									of the self, the ego, as that
									which is responsible for introducing selfishness
									and dissonance. At a higher level it is the
									desirelessness, the dispassionateness, which
									leads automatically
									to release from tensions
									and helps towards realization. Action is normally
									the outcome of the incessant, and usually
									feverish, working of the mind taken up
									with desires, daydreams, and the unproductive
									turning over of problems which, like desires,
									are “self ” created and self-centered. Problems
									are solved (which, literally, means “loosened”)
									when tensions are eased and one is able to
									understand the true nature of a thing, hence
									“sleeping on it”, or the sudden flash of intuition
									which comes when the rational mind
									ceases its activity and a spontaneous recognition
									of reality occurs.
									It is a doctrine of immediacy, or, as
									Chuang Tzu calls it, “non-angularity”, of
									spontaneous adaptation and response and of
									perfect acceptance; an action which is so unforced
									and natural that it loses the ordinary
									meaning of action with its accompanying deliberation
									and weighing up, and is so in harmony
									with the natural that it simply is, without
									having to think about it. There is no ulterior
									motive, indeed, there is no motive at all
									in such “actionless action”, since this activity
									Wu-wei is another term which defies exact
									translation so is usually left as it is. It is the
									doctrine of inaction or non-action, but only
									a superficial outlook interprets it as laissez
									faire, in the sense of indifference, for the
									Taoist is not indifferent, but should be totally
									committed to life. If any translation should
									be attempted, possibly “non-interference” or
									“letting-go” is the best. At the lowest level it
									is a policy of naturalness, of “live and let live”
									and of avoiding friction, with its inevitable
									consequences of discord and conflict, whether
									on the individual
									or national scale, and allowing
									the maximum of individual liberty
									and understanding the views of others. It is
									also a letting-go, a giving-way, a yielding, primarily
									a yielding
									of the self, the ego, as that
									which is responsible for introducing selfishness
									and dissonance. At a higher level it is the
									desirelessness, the dispassionateness, which
									leads automatically
									to release from tensions
									and helps towards realization. Action is normally
									the outcome of the incessant, and usually
									feverish, working of the mind taken up
									with desires, daydreams, and the unproductive
									turning over of problems which, like desires,
									are “self ” created and self-centered. Problems
									are solved (which, literally, means “loosened”)
									when tensions are eased and one is able to
									understand the true nature of a thing, hence
									“sleeping on it”, or the sudden flash of intuition
									which comes when the rational mind
									ceases its activity and a spontaneous recognition
									of reality occurs.
									It is a doctrine of immediacy, or, as
									Chuang Tzu calls it, “non-angularity”, of
									spontaneous adaptation and response and of
									perfect acceptance; an action which is so unforced
									and natural that it loses the ordinary
									meaning of action with its accompanying deliberation
									and weighing up, and is so in harmony
									with the natural that it simply is, without
									having to think about it. There is no ulterior
									motive, indeed, there is no motive at all
									in such “actionless action”, since this activity
									Wu-wei is another term which defies exact
									translation so is usually left as it is. It is the
									doctrine of inaction or non-action, but only
									a superficial outlook interprets it as laissez
									faire, in the sense of indifference, for the
									Taoist is not indifferent, but should be totally
									committed to life. If any translation should
									be attempted, possibly “non-interference” or
									“letting-go” is the best. At the lowest level it
									is a policy of naturalness, of “live and let live”
									and of avoiding friction, with its inevitable
									consequences of discord and conflict, whether
									on the individual
									or national scale, and allowing
									the maximum of individual liberty
									and understanding the views of others. It is
									also a letting-go, a giving-way, a yielding, primarily
									a yielding
									of the self, the ego, as that
									which is responsible for introducing selfishness
									and dissonance. At a higher level it is the
									desirelessness, the dispassionateness, which
									leads automatically
									to release from tensions
									and helps towards realization. Action is normally
									the outcome of the incessant, and usually
									feverish, working of the mind taken up
									with desires, daydreams, and the unproductive
									turning over of problems which, like desires,
									are “self ” created and self-centered. Problems
									are solved (which, literally, means “loosened”)
									when tensions are eased and one is able to
									understand the true nature of a thing, hence
									“sleeping on it”, or the sudden flash of intuition
									which comes when the rational mind
									ceases its activity and a spontaneous recognition
									of reality occurs.
									It is a doctrine of immediacy, or, as
									Chuang Tzu calls it, “non-angularity”, of
									spontaneous adaptation and response and of
									perfect acceptance; an action which is so unforced
									and natural that it loses the ordinary
									meaning of action with its accompanying deliberation
									and weighing up, and is so in harmony
									with the natural that it simply is, without
									having to think about it. There is no ulterior
									motive, indeed, there is no motive at all
									in such “actionless action”, since this activity
									Wu-wei is another term which defies exact
									translation so is usually left as it is. It is the
									doctrine of inaction or non-action, but only
									a superficial outlook interprets it as laissez
									faire, in the sense of indifference, for the
									Taoist is not indifferent, but should be totally
									committed to life. If any translation should
									be attempted, possibly “non-interference” or
									“letting-go” is the best. At the lowest level it
									is a policy of naturalness, of “live and let live”
									and of avoiding friction, with its inevitable
									consequences of discord and conflict, whether
									on the individual
									or national scale, and allowing
									the maximum of individual liberty
									and understanding the views of others. It is
									also a letting-go, a giving-way, a yielding, primarily
									a yielding
									of the self, the ego, as that
									which is responsible for introducing selfishness
									and dissonance. At a higher level it is the
									desirelessness, the dispassionateness, which
									leads automatically
									to release from tensions
									and helps towards realization. Action is normally
									the outcome of the incessant, and usually
									feverish, working of the mind taken up
									with desires, daydreams, and the unproductive
									turning over of problems which, like desires,
									are “self ” created and self-centered. Problems
									are solved (which, literally, means “loosened”)
									when tensions are eased and one is able to
									understand the true nature of a thing, hence
									“sleeping on it”, or the sudden flash of intuition
									which comes when the rational mind
									ceases its activity and a spontaneous recognition
									of reality occurs.
									It is a doctrine of immediacy, or, as
									Chuang Tzu calls it, “non-angularity”, of
									spontaneous adaptation and response and of
									perfect acceptance; an action which is so unforced
									and natural that it loses the ordinary
									meaning of action with its accompanying deliberation
									and weighing up, and is so in harmony
									with the natural that it simply is, without
									having to think about it. There is no ulterior
									motive, indeed, there is no motive at all
									in such “actionless action”, since this activity
									Wu-wei is another term which defies exact
									translation so is usually left as it is. It is the
									doctrine of inaction or non-action, but only
									a superficial outlook interprets it as laissez
									faire, in the sense of indifference, for the
									Taoist is not indifferent, but should be totally
									committed to life. If any translation should
									be attempted, possibly “non-interference” or
									“letting-go” is the best. At the lowest level it
									is a policy of naturalness, of “live and let live”
									and of avoiding friction, with its inevitable
									consequences of discord and conflict, whether
									on the individual
									or national scale, and allowing
									the maximum of individual liberty
									and understanding the views of others. It is
									also a letting-go, a giving-way, a yielding, primarily
									a yielding
									of the self, the ego, as that
									which is responsible for introducing selfishness
									and dissonance. At a higher level it is the
									desirelessness, the dispassionateness, which
									leads automatically
									to release from tensions
									and helps towards realization. Action is normally
									the outcome of the incessant, and usually
									feverish, working of the mind taken up
									with desires, daydreams, and the unproductive
									turning over of problems which, like desires,
									are “self ” created and self-centered. Problems
									are solved (which, literally, means “loosened”)
									when tensions are eased and one is able to
									understand the true nature of a thing, hence
									“sleeping on it”, or the sudden flash of intuition
									which comes when the rational mind
									ceases its activity and a spontaneous recognition
									of reality occurs.
									It is a doctrine of immediacy, or, as
									Chuang Tzu calls it, “non-angularity”, of
									spontaneous adaptation and response and of
									perfect acceptance; an action which is so unforced
									and natural that it loses the ordinary
									meaning of action with its accompanying deliberation
									and weighing up, and is so in harmony
									with the natural that it simply is, without
									having to think about it. There is no ulterior
									motive, indeed, there is no motive at all
									in such “actionless action”, since this activity
									Wu-wei is another term which defies exact
									translation so is usually left as it is. It is the
									doctrine of inaction or non-action, but only
									a superficial outlook interprets it as laissez
									faire, in the sense of indifference, for the
									Taoist is not indifferent, but should be totally
									committed to life. If any translation should
									be attempted, possibly “non-interference” or
									“letting-go” is the best. At the lowest level it
									is a policy of naturalness, of “live and let live”
									and of avoiding friction, with its inevitable
									consequences of discord and conflict, whether
									on the individual
									or national scale, and allowing
									the maximum of individual liberty
									and understanding the views of others. It is
									also a letting-go, a giving-way, a yielding, primarily
									a yielding
									of the self, the ego, as that
									which is responsible for introducing selfishness
									and dissonance. At a higher level it is the
									desirelessness, the dispassionateness, which
									leads automatically
									to release from tensions
									and helps towards realization. Action is normally
									the outcome of the incessant, and usually
									feverish, working of the mind taken up
									with desires, daydreams, and the unproductive
									turning over of problems which, like desires,
									are “self ” created and self-centered. Problems
									are solved (which, literally, means “loosened”)
									when tensions are eased and one is able to
									understand the true nature of a thing, hence
									“sleeping on it”, or the sudden flash of intuition
									which comes when the rational mind
									ceases its activity and a spontaneous recognition
									of reality occurs.
									It is a doctrine of immediacy, or, as
									Chuang Tzu calls it, “non-angularity”, of
									spontaneous adaptation and response and of
									perfect acceptance; an action which is so unforced
									and natural that it loses the ordinary
									meaning of action with its accompanying deliberation
									and weighing up, and is so in harmony
									with the natural that it simply is, without
									having to think about it. There is no ulterior
									motive, indeed, there is no motive at all
									in such “actionless action”, since this activity
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
