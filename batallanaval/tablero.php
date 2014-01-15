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
            
        <!-- Estilos para el tablero -->
        <link rel="stylesheet" href="css/tablero.css">
    </head>
    <body>
        
        <div class="container">
            
            <div class="header">
                <ul class="nav nav-pills pull-right">
                    <li><a href="index.html">Inicio</a></li>
                    <li><a href="dificultad.html">Dificultad</a></li>
                    <li class="active"><a href="#">Tablero</a></li>
                </ul>
                <h3 class="text-primary">Batalla Naval</h3>
            </div>
            
            <div class="jumbotron">
                <h1>¡Hora de la batalla!</h1>
                <hr>
                <div class="table-responsive">
                    <table id="tablero" class="table table-bordered tablero">
                        <tr>
                            <!-- La posicion 0x0 se deja en blanco siempre -->
                            <td></td>
                            <!-- La primera columna muestra la cantidad de casillas ocupadas en esa columna -->
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <!-- La primera fila muestra la cantidad de casillas coupadas en esa fila -->
                            <td>0</td>
                            <!-- Fila de tablero de juego -->
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td><strong>?</strong></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td><strong>?</strong></td>
                            <td><strong>?</strong></td>
                            <td><strong>?</strong></td>
                            <td class="acierto"></td>
                        </tr>
                        <tr>
                            <!-- La primera fila muestra la cantidad de casillas coupadas en esa fila -->
                            <td>0</td>
                            <!-- Fila de tablero de juego -->
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td><strong>?</strong></td>
                            <td class="acierto"></td>
                            <td><strong>?</strong></td>
                            <td class="acierto"></td>
                            <td><strong>?</strong></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                        </tr>
                        <tr>
                            <!-- La primera fila muestra la cantidad de casillas coupadas en esa fila -->
                            <td>0</td>
                            <!-- Fila de tablero de juego -->
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td><strong>?</strong></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td><strong>?</strong></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                        </tr>
                        <tr>
                            <!-- La primera fila muestra la cantidad de casillas coupadas en esa fila -->
                            <td>0</td>
                            <!-- Fila de tablero de juego -->
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td><strong>?</strong></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td><strong>?</strong></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                        </tr>
                        <tr>
                            <!-- La primera fila muestra la cantidad de casillas coupadas en esa fila -->
                            <td>0</td>
                            <!-- Fila de tablero de juego -->
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                        </tr>
                        <tr>
                            <!-- La primera fila muestra la cantidad de casillas coupadas en esa fila -->
                            <td>0</td>
                            <!-- Fila de tablero de juego -->
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td><strong>?</strong></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td><strong>?</strong></td>
                            <td class="agua"></td>
                        </tr>
                        <tr>
                            <!-- La primera fila muestra la cantidad de casillas coupadas en esa fila -->
                            <td>0</td>
                            <!-- Fila de tablero de juego -->
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td><strong>?</strong></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td><strong>?</strong></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                        </tr>
                        <tr>
                            <!-- La primera fila muestra la cantidad de casillas coupadas en esa fila -->
                            <td>0</td>
                            <!-- Fila de tablero de juego -->
                            <td class="acierto"></td>
                            <td><strong>?</strong></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td><strong>?</strong></td>
                            <td class="agua"></td>
                            <td><strong>?</strong></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                        </tr>
                        <tr>
                            <!-- La primera fila muestra la cantidad de casillas coupadas en esa fila -->
                            <td>0</td>
                            <!-- Fila de tablero de juego -->
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td><strong>?</strong></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td><strong>?</strong></td>
                            <td class="acierto"></td>
                        </tr>
                        <tr>
                            <!-- La primera fila muestra la cantidad de casillas coupadas en esa fila -->
                            <td>0</td>
                            <!-- Fila de tablero de juego -->
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td><strong>?</strong></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                        </tr>
                        <tr>
                            <!-- La primera fila muestra la cantidad de casillas coupadas en esa fila -->
                            <td>0</td>
                            <!-- Fila de tablero de juego -->
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td><strong>?</strong></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                        </tr>
                        <tr>
                            <!-- La primera fila muestra la cantidad de casillas coupadas en esa fila -->
                            <td>0</td>
                            <!-- Fila de tablero de juego -->
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td><strong>?</strong></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                            <td class="acierto"></td>
                            <td class="agua"></td>
                        </tr>
                    </table>
                </div>
            </div>
            
        </div>
        
        <!-- jQuery (necesario para el plugin Javascript de Bootstrap -->
        <script src="js/jquery.js"></script>
        <!-- Incluimos el plugin completo de Bootstrap (tambien puede incluirse por separado) -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Lo de rellenar las casillas se hará con php -->
        <script>
            $('#tablero tr td.agua').html('<span class="glyphicon glyphicon-tint"></span>');
            $('#tablero tr td.acierto').html('<span class="glyphicon glyphicon-fire"></span>');
        </script>
    </body>
</html>