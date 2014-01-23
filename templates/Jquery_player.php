<!-- JS  & CSS FOR PLAYER -->
<link type="text/css" href="video/skin/jplayer.blue.monday.css" rel="stylesheet" />
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>-->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.jplayer.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){

    $("#jquery_jplayer_1").jPlayer({
        
         ready: function () {
         
          $(this).jPlayer("setMedia", {
           
            m4v: "video/8607_1390385159.mp4",
            ogv: "http://www.jplayer.org/video/ogv/Big_Buck_Bunny_Trailer_480x270.ogv", // ver q onda esto
            poster: "http://www.jplayer.org/video/poster/Big_Buck_Bunny_Trailer_480x270.png"

        })
         },

         swfPath: "js",
        supplied: "m4v, ogv"
    });

       $(".petVideo").click(function(eve){

          eve.preventDefault();

          var thumb = $(this).children('img').attr('src');

          $("#modalPlayer").css('display', 'block');
          $("#jquery_jplayer_1").jPlayer("setMedia", {

              m4v: $(this).attr("href"),
              poster: thumb

           });

         return false;
    });

});
    
listByCategory();
</script>
