<!-- JS  & CSS FOR PLAYER -->
<link type="text/css" href="video/skin/jplayer.blue.monday.css" rel="stylesheet" />
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>-->
<!-- <script type="text/javascript" src="js/jquery.js"></script> -->
<script type="text/javascript" src="js/jquery.jplayer.min.js"></script>

<script type="text/javascript">


$(document).ready(function(){

      function runVideo(videoSrc, imgSrc){

          $("#jquery_jplayer_1").jPlayer({
              
               ready: function () {
               
                $(this).jPlayer("setMedia", {
                 
                  m4v: videoSrc,
                  ogg: videoSrc,// ver q onda esto de los diferentes formatos
                  webm: videoSrc// ver q onda esto de los diferentes formatos
                  //poster: imgSrc

                }).jPlayer('play');
               },

               swfPath: "js",
               supplied: "m4v, ogg, webm"
          });
      }// end runVideo

       
       $(".petVideo").click(function(e){
        alert
            e.preventDefault();
            
            var thumb = $(this).find('img').attr('src');
            var video  = $(this).attr("href");
           // $("#jquery_jplayer_1").jPlayer("setMedia", {m4v: video}, {poster: thumb}).jPlayer("play");
            $(".modalWindows").show(300);

               $("#close").click(function(){ 
                   
                    $(".modalWindows").hide(300); 
                    $("#jquery_jplayer_1").jPlayer('destroy');
                    
               });

            runVideo(video, thumb);

            return false;
       });
});

</script>
