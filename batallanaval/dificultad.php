<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Batalla Naval</title>
        <meta charset="utf-8">
            <meta http-equiv="Pragma" content="no-cache">
                <meta http-equiv="Cache-Control" content="no-cache">
                    
                    <!-- Bootstrap -->
                    <link rel="stylesheet" href="css/bootstrap.min.css">
                        
                        <!-- Tema opcional de Bootstrap -->
                        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
                            
                            <!-- Template para Bootstrap -->
                            <link rel="stylesheet" href="css/jumbotron-narrow.css">
                                </head>
    <body>
        
        <div class="container">
            
            <div class="header">
                <ul class="nav nav-pills pull-right">
                    <li><a href="index.html">Inicio</a></li>
                    <li class="active"><a href="#">Dificultad</a></li>
                    <li><a href="tablero.html">Tablero</a></li>
                </ul>
                <h3 class="text-primary">Batalla Naval</h3>
            </div>
            
            <div class="jumbotron">
                <h1>Seleccioná el grado de dificultad</h1>
                <hr>
                <div class="btn-group-vertical" data-toggle="buttons">
                    <label class="btn btn-danger" onclick="window.open('tablero.html?nivel=dificil','_self')">
                        <input type="radio" name="gradoDificultad" id="nivelFacil"> ¡Que sea bien difícil!
                    </label>
                    <label class="btn btn-default" onclick="window.open('tablero.html?nivel=medio','_self')">
                        <input type="radio" name="gradoDificultad" id="nivelMedio"> Mejor un nivel medio accesible
                    </label>
                    <label class="btn btn-primary" onclick="window.open('tablero.html?nivel=facil','_self')">
                        <input type="radio" name="gradoDificultad" id="nivelMedio"> ¡Que sea fácil nomás!
                    </label>
                </div>
                
            </div>
            
        </div>
        
        <!-- jQuery (necesario para el plugin Javascript de Bootstrap -->
        <script src="js/jquery.js"></script>
        <!-- Incluimos el plugin completo de Bootstrap (tambien puede incluirse por separado) -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>