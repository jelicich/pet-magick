<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Pet Magick</title>

<link rel="stylesheet" href="css/reset.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="css/960_12_col.css" type="text/css" />
<link rel="stylesheet" href="css/layout.css" type="text/css" />

<script type="text/javascript" src="js/lib.js"></script>

<!-- PLAYER -->
<link type="text/css" href="skin/jplayer.blue.monday.css" rel="stylesheet" />
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>-->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.jplayer.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
      $("#jquery_jplayer_1").jPlayer({
        ready: function () {
          $(this).jPlayer("setMedia", {
            m4v: "http://www.jplayer.org/video/m4v/Big_Buck_Bunny_Trailer_480x270_h264aac.m4v",
            ogv: "http://www.jplayer.org/video/ogv/Big_Buck_Bunny_Trailer_480x270.ogv",
            poster: "http://www.jplayer.org/video/poster/Big_Buck_Bunny_Trailer_480x270.png"
          });
        },
        swfPath: "/js",
        supplied: "m4v, ogv"
      });
    });
  </script>


</head>

<body>
	<div id="modalPlayer">
<div id="jp_container_1" class="jp-video">
    <div class="jp-type-single">
      <div id="jquery_jplayer_1" class="jp-jplayer"></div>
      <div class="jp-gui">
        <div class="jp-video-play">
          <a href="javascript:;" class="jp-video-play-icon" tabindex="1">play</a>
        </div>
        <div class="jp-interface">
          <div class="jp-progress">
            <div class="jp-seek-bar">
              <div class="jp-play-bar"></div>
            </div>
          </div>
          <div class="jp-current-time"></div>
          <div class="jp-duration"></div>
          <div class="jp-controls-holder">
            <ul class="jp-controls">
              <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
              <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
              <li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
              <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
              <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
              <li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
            </ul>
            <div class="jp-volume-bar">
              <div class="jp-volume-bar-value"></div>
            </div>
            <ul class="jp-toggles">
              <li><a href="javascript:;" class="jp-full-screen" tabindex="1" title="full screen">full screen</a></li>
              <li><a href="javascript:;" class="jp-restore-screen" tabindex="1" title="restore screen">restore screen</a></li>
              <li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
              <li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
            </ul>
          </div>
          <div class="jp-title">
            <ul>
              <li>Big Buck Bunny Trailer</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="jp-no-solution">
        <span>Update Required</span>
        To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
      </div>
    </div>
  </div>
</div>
<div id="wrapper">
	

	<?php 
		include_once 'templates/header.php'; 
	?>


	<!-- site content -->

	<div id="content" class="mod container_12" >

	<div id='what' >
		<a href="#"><p>What is animal antics ?</p></a>
		<div class='active'>
			<div id='pop-up' class='mod grid_4 '>

				<p> 
					It's time to make your pet a star. Show the rest of the world those moments your pet has done those "amazing...zany...pull your hair out" things that only pets can do and you've managed to capture on video. 
				</p>

			</div>
			<div class=' arrow-top'></div>
		</div>
	</div>
		
		
		<!-- lastest videos -->
		<div id="lastest-video-mod" class="mod grid_9">
			
			<div class="mod-header">
				<h2>Latest videos</h2>
			</div>
			
			<ul class='mod-content clearfix'>

				<li class='video'>
					<!--Puse un div provisorio asi no llorisqueas jajaj. Cuando sepamos como vamos a tomar los valores con js y como mostrar el video lo acomodamos como corresponde. Q opinas? -->
					<div class='wrapper-play'>
						<div class="play"></div>
						<img src="" class="thumb-big video-thumb"/>
					</div>

					<div class="video-last-caption">
						<h3>Hey! let me pass - <span>2:12</span></h3>
						<span><strong>By: </strong> Petter Putter</span>
					</div>
					
				</li>


				<li class='video'>
					<!--Puse un div provisorio asi no llorisqueas jajaj. Cuando sepamos como vamos a tomar los valores con js y como mostrar el video lo acomodamos como corresponde. Q opinas? -->
					<div class='wrapper-play'>
						<div class="play"></div>
						<img src="" class="thumb-big video-thumb"/>
					</div>

					<div class="video-last-caption">
						<h3>Hey! let me pass - <span>2:12</span></h3>
						<span><strong>By: </strong> Petter Putter</span>
					</div>
					
				</li>

			</ul>

		</div>
		<!-- End lastest videos -->

		<!-- advertisement -->
		<div id="publi" class="mod grid_3">
		</div>


		
		<!-- videos module -->
		<div class="mod profiles-mod animal-antics-mod grid_12">
			<div class="mod-header">
					<ul class='clearfix mod-menu' id='menuByPet'>
					
					<li id='dog'><!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
						<a href='#1'> <!-- Reemplazar este valor por el numero q corresponda en la bd segun categoria -->
							Dog
							<div id='arrow-dog'></div>
						</a>
					</li>

					<li id='cat'><!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
						<a href='#2'> <!-- Reemplazar este valor por el numero q corresponda en la bd segun categoria -->
							Cat
							<div id='arrow-cat'></div>
						</a>
					</li>

					<li id='bird'><!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
						<a href='#3'> <!-- Reemplazar este valor por el numero q corresponda en la bd segun categoria -->
							Bird
							<div id='arrow-bird'></div>
						</a>
					</li>

					<li id='rabbit'><!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
						<a href='#rabbit'> <!-- Reemplazar este valor por el numero q corresponda en la bd segun categoria -->
							Rabbit
							<div id='arrow-rabbit'></div>
						</a>
					</li>

					<li id='ferret'><!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
						<a href='#ferret'> <!-- Reemplazar este valor por el numero q corresponda en la bd segun categoria -->
							Ferret
							<div id='arrow-ferret'></div>
						</a>
					</li>

					<li id='others'><!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
						<a href='#'> <!-- Reemplazar este valor por el numero q corresponda en la bd segun categoria -->
							Others
							<div id='arrow-others'></div>
						</a>
					</li>
				</ul>
			</div>
			<ul class='grid-thumbs clearfix mod-content' id='culo'> 
					<?php 
						
						include_once 'templates/anticsModule.php'; 
					?>
				</ul>	
				






		</div>
		<!-- END video module -->

	</div>
	<!-- END site content -->

	<?php 
		include_once 'templates/footer.php'; 
	?>

</div>
<!-- END wrapper-->





<script type="text/javascript">
playVideo();
</script>
</body>
</html>
