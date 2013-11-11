<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <meta name="ROBOTS" content="INDEX,FOLLOW">
   <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">

   <link href="stylesheet.css" id="user_stylesheet" rel="stylesheet" type="text/css" />
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
   <!--   <script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>		-->
   <!--<script type='text/javascript' src='stuff.js'></script> -->
   <title>Index</title>
</head>

<body>
   <script>
     (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
     (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
     m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
     })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

     ga('create', 'UA-30710600-2', 'riegler.fr');
     ga('send', 'pageview');
   </script>
   <div id="header_content">
      <div id="backButton"><</div>
      <div id="nav_container">
         <a href=".">Horaires TAG</a>
      </div>
      <script>      
         var theUrl = "http://tag.mobitrans.fr/index.php?p=49&I=a0249ta&id=766";

         $(function() {
                     $.ajax({
                         type:'GET',
                         dataType:'jsonp',
                         jsonp:'jsonp',
                         url:theUrl,
                         success:function(data) {
                             $.each(data["tags"], function(index, item) {
                                 var $tag = item.name;
                                 var $count = item.count;
                                 $("body").append('<div class="stackoverflow"> The Tag <span class="q-tag">' + $tag + '</span> has <span class="q-count">' + $count + '</span> Questions.</div>')     });
                         },
                         error:function() {
                             alert("Sorry, I can't get the feed");   
                         }
                     });
                 });
      </script>
      
      <div id="rightButton"><a href=".">⌂</a></div>
      <div style="clear:both;"></div>
      
   </div>
   <div id="loadingAnim"><img src="loading.gif"></div>
   
   <div id="content_container">			

      
         
   </div>   
   
   <div id="foot_container">
      <div class="main_footer">par [M]atthieu Riegler.</div>
      <div class="bottompad">&nbsp;</div>
   </div>   
</body>
</html>
