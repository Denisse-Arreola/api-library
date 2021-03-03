<html>
    <head>
        <title> Barra de busqueda</title>
     <meta charset="utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <LINK REL=StyleSheet HREF="barra.css" TYPE="text/css" MEDIA=screen>
     <title>Barra  </title>
    </head>

    <body>
         <h2>Barraaaaaa</h2>
         <div id="myProgress">
         <div id="myBar"> <div id="label">10%</div> </div>
         </div>
      
         <br>
         <button onclick="move()">Presioname jijiji</button> 

      <script>
         function move() {
         var elem = document.getElementById("myBar");
         var width = 10;
         var id = setInterval(frame, 10);
         
         function frame() {
         if (width >= 100) {
            clearInterval(id);
            } else {
            width++;
            elem.style.width = width + '%';
            document.getElementById("label").innerHTML = width * 1 + '%';
               }
             }
        }


        </script>


    </body>





</html>