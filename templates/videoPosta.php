


<a class="petVideo video" href= <?php  echo 'video/'.$v['VIDEO']; ?> >
	<!--Puse un div provisorio asi no llorisqueas jajaj. Cuando sepamos como vamos a tomar los valores con js y como mostrar el video lo acomodamos como corresponde. Q opinas? -->
	<span class='wrapper-play'>
		<span class="play"></span>
		<img src= <?php echo '"video/'.$v['THUMBNAIL'].'"'; ?> class="thumb-big video-thumb"/>
	</span>

	<span class="video-last-caption">
		<h3><?php echo $v['TITLE']; ?></h3>
		<span><?php echo $v['CAPTION']; ?></span>
	</span>
</a>