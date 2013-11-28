<!doctype html>
<html lang="fr">
<head>
   <meta charset="utf-8">
   <title>Titre de la page</title>
   <link rel="stylesheet" href="style.css">
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  
   <script>
   function getLoc() {
      if (navigator.geolocation) {
         navigator.geolocation.getCurrentPosition(function (position) {
            console.log("lala");
            $("#lala").html(position.coords.latitude+","+position.coords.longitude); 
             
         });
      }
   }
   var myVar=setInterval(function(){myTimer()},1000);

   function myTimer()
   {
      var coords = getLoc();
   }
    
   </script>
</head>
<body>
   <div id="lala"></div>
</body>
</html>