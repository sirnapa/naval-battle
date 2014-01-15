<?php
	//Iniciamos sesión
	session_start();
	
	/*
	 * Verificamos si la variable de sesión "jugador" existe, y si es así lo borramos
	 * Esto hace que el juego se reinicie cada que vez que ingresamos a esta pantalla
	 */
	if (isset($_SESSION['juego']))
		unset($_SESSION['juego'])
?>
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
                    <li class="active"><a href="index.php">Inicio</a></li>
                    <li><a href="dificultad.php">Dificultad</a></li>
                    <li><a href="tablero.php">Tablero</a></li>
                </ul>
                <h3 class="text-primary">Batalla Naval</h3>
            </div>
            
            <div class="jumbotron">
                <h1>PERDISTE</h1>
            </div>
            
        </div>
        
        <!-- jQuery (necesario para el plugin Javascript de Bootstrap -->
        <script src="js/jquery.js"></script>
        <!-- Incluimos el plugin completo de Bootstrap (tambien puede incluirse por separado) -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>