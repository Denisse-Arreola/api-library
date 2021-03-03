<!DOCTYPE html>
<html Lang="en">
<head>
    <meta charset="UTF-8">
    <title>Visualizador</title>
    <link rel="stylesheet" href="css/visualizador.css">
</head>
<body>

 <section>
  <h1><center>Visualizar el pdf hahaha</center></h1>

    <center><iframe id="frame" name="frame" src="https://openlibra.com/es/book/download/evaluaciones-nacionales-del-rendimiento-academico-vol-2"></iframe></center>
 </section>

    <script>
        var variable = window.frames[0];
        console.log(variable);
        var frame = variable.document.getElementById('complaints-modal');
        console.log(variable.document);
    </script>

</body>





</html>