<?php
	//Iniciamos sesión
	session_start();
	
	//Incluimos las variables iniciales del juego.
	include 'configuraciones.php';
	
	//Primeramente verificamos si existe la variable de sesión juego. Si existe, significa que ya hay un juego en curso; sino, empezamos un juego.
	if (isset($_SESSION['juego'])) {
		if (isset($_REQUEST['fila']) && isset($_REQUEST['columna'])) {
			if (es_una_posicion_valida($_REQUEST['fila'], $_REQUEST['columna'], $_SESSION['juego']['tablero'])) {
				$_SESSION['juego']['tablero'][$_REQUEST['fila']][$_REQUEST['columna']]['bombardeado'] = true;
				
				if (es_una_posicion_ocupada($_REQUEST['fila'], $_REQUEST['columna'], $_SESSION['juego']['tablero'])) {
					$_SESSION['juego']['aciertos']++;
				} else {
					$_SESSION['juego']['intentos_fallidos']++;
				}
				
				if ($_SESSION['juego']['aciertos'] >= 20) {
					header('Location: victoria.php');
					exit();
				} else if ($_SESSION['juego']['intentos_fallidos'] >= $_SESSION['juego']['cantidad_maxima_de_fallos']) {
					header('Location: derrota.php');
					exit();
				}
			}
		}
	} else {
		
		//Verificamos que se haya enviado el parámetro de nivel. Si no se envió, seteamos todos los valores a los de nivel inicial.
		if (isset($_REQUEST['nivel'])) {
			
			/*
			 * Chequeamos el valor del parámetro nivel y si corresponde lo asignamos a la variable nivel.
			 * Para hacer esto usamos switch y como valor default usamos siempre el 1, de modo a que si el parámetro enviado no es válido,
			 * seteamos la variable siempre con el valor 1.
			 */
			switch ($_REQUEST['nivel']) {
				case 'facil':
					$_SESSION['juego']['nivel'] = INICIAL_NIVEL;
					$_SESSION['juego']['cantidad_maxima_de_fallos'] = INICIAL_CANTIDAD_MAXIMA_FALLOS;
					$_SESSION['juego']['tamano_tablero'] = INICIAL_TAMANO_TABLERO;
					break;
				case 'medio':
					$_SESSION['juego']['nivel'] = MEDIO_NIVEL;
					$_SESSION['juego']['cantidad_maxima_de_fallos'] = MEDIO_CANTIDAD_MAXIMA_FALLOS;
					$_SESSION['juego']['tamano_tablero'] = MEDIO_TAMANO_TABLERO;
					break;
				case 'dificil':
					$_SESSION['juego']['nivel'] = DIFICIL_NIVEL;
					$_SESSION['juego']['cantidad_maxima_de_fallos'] = DIFICIL_CANTIDAD_MAXIMA_FALLOS;
					$_SESSION['juego']['tamano_tablero'] = DIFICIL_TAMANO_TABLERO;
					break;
				default:
					$_SESSION['juego']['intentos_fallidos'] = 0;$_SESSION['juego']['nivel'] = INICIAL_NIVEL;
					$_SESSION['juego']['cantidad_maxima_de_fallos'] = INICIAL_CANTIDAD_MAXIMA_FALLOS;
					$_SESSION['juego']['tamano_tablero'] = INICIAL_TAMANO_TABLERO;
			}
		} else {
			$_SESSION['juego']['nivel'] = INICIAL_NIVEL;
			$_SESSION['juego']['cantidad_maxima_de_fallos'] = INICIAL_CANTIDAD_MAXIMA_FALLOS;
			$_SESSION['juego']['tamano_tablero'] = INICIAL_TAMANO_TABLERO;
		}
		
		//Seteamos el valor de aciertos e intentos fallidos.
		$_SESSION['juego']['aciertos'] = 0;
		$_SESSION['juego']['intentos_fallidos'] = 0;
		
		//Finalmente inicializamos el tablero.
		$_SESSION['juego']['tablero'] = inicializar_tablero($_SESSION['juego']['tamano_tablero']);
		
		$_SESSION['juego']['conteo'] = contar_posiciones_ocupadas($_SESSION['juego']['tablero'], $_SESSION['juego']['tamano_tablero']);
	}
		
	function inicializar_tablero ($tamano_tablero) {
		
		//Creamos el tablero de acuerdo al nivel. Primeramente seteamos todas las piezas del tablero con el mismo valor.
		$tablero = array();
		
		for ($fila = 0; $fila < $tamano_tablero; $fila++) {
			for ($columna = 0; $columna < $tamano_tablero; $columna++) {
				$tablero[$fila][$columna] = array('ocupado' => false, 'bombardeado' => false);
			}
		}
		
		$tablero = ubicar_acorazado($tablero, $tamano_tablero);
		$tablero = ubicar_cruceros($tablero, $tamano_tablero);
		$tablero = ubicar_destructores($tablero, $tamano_tablero);
		$tablero = ubicar_submarinos($tablero, $tamano_tablero);
		
		return $tablero;
	}
	
	function ubicar_acorazado ($tablero, $tamano_tablero) {
		$posicion_inicial_valida = false;
		
		while (!$posicion_inicial_valida) {
			
			$posicion_inicial = sortear_posicion_inicial($tamano_tablero);
			$orientacion = sortear_orientacion_embarcacion();
			
			if ($orientacion == 'horizontal') {
				
				/*
				 * Verificamos que las siguientes tres columnas se encuentre dentro del tablero.
				 * No controlamos el primer valor ya que al haberle dado un valor máximo a rand(), este primer valor debe ser válido.
				 */
				$posicion_inicial_valida = es_una_posicion_valida($posicion_inicial['fila'], $posicion_inicial['columna'] + 1, $tamano_tablero) &&
										   es_una_posicion_valida($posicion_inicial['fila'], $posicion_inicial['columna'] + 2, $tamano_tablero) &&
										   es_una_posicion_valida($posicion_inicial['fila'], $posicion_inicial['columna'] + 3, $tamano_tablero);
			} else {
				/*
				 * Verificamos que las siguientes tres filas se encuentre dentro del tablero.
				 * No controlamos el primer valor ya que al haberle dado un valor máximo a rand(), este primer valor debe ser válido.
				 */
				$posicion_inicial_valida = es_una_posicion_valida($posicion_inicial['fila'] + 1, $posicion_inicial['columna'], $tamano_tablero) &&
										   es_una_posicion_valida($posicion_inicial['fila'] + 2, $posicion_inicial['columna'], $tamano_tablero) &&
										   es_una_posicion_valida($posicion_inicial['fila'] + 3, $posicion_inicial['columna'], $tamano_tablero);
			}
		}
		
		$tablero[$posicion_inicial['fila']][$posicion_inicial['columna']]['ocupado'] = true;
		if ($orientacion == 'horizontal') {
			$tablero[$posicion_inicial['fila']][$posicion_inicial['columna'] + 1]['ocupado'] = true;
			$tablero[$posicion_inicial['fila']][$posicion_inicial['columna'] + 2]['ocupado'] = true;
			$tablero[$posicion_inicial['fila']][$posicion_inicial['columna'] + 3]['ocupado'] = true;
		} else {
			$tablero[$posicion_inicial['fila'] + 1][$posicion_inicial['columna']]['ocupado'] = true;
			$tablero[$posicion_inicial['fila'] + 2][$posicion_inicial['columna']]['ocupado'] = true;
			$tablero[$posicion_inicial['fila'] + 3][$posicion_inicial['columna']]['ocupado'] = true;
		}
		
		return $tablero;
	}
	
	function ubicar_cruceros ($tablero, $tamano_tablero) {
		for ($i = 0; $i < 2; $i++) {
			
			$posicion_inicial_valida = false;
			
			while (!$posicion_inicial_valida) {
					
				$posicion_inicial = sortear_posicion_inicial($tamano_tablero);
				$orientacion = sortear_orientacion_embarcacion();
					
				if ($orientacion == 'horizontal') {
		
					/*
					 * Verificamos que las siguientes tres columnas se encuentre dentro del tablero.
					* No controlamos el primer valor ya que al haberle dado un valor máximo a rand(), este primer valor debe ser válido.
					*/
					$posicion_inicial_valida = es_una_posicion_valida($posicion_inicial['fila'], $posicion_inicial['columna'] + 1, $tamano_tablero) &&
											   es_una_posicion_valida($posicion_inicial['fila'], $posicion_inicial['columna'] + 2, $tamano_tablero);
					
					//Luego de verificar que la posición es válida, verificamos que ya no se encuentre ocupada
					if ($posicion_inicial_valida) {
						$posicion_inicial_valida = !es_una_posicion_ocupada($posicion_inicial['fila'], $posicion_inicial['columna'], $tablero) &&
												   !es_una_posicion_ocupada($posicion_inicial['fila'], $posicion_inicial['columna'] + 1, $tablero) &&
												   !es_una_posicion_ocupada($posicion_inicial['fila'], $posicion_inicial['columna'] + 2, $tablero);
					}
				} else {
					/*
					 * Verificamos que las siguientes tres filas se encuentre dentro del tablero.
					* No controlamos el primer valor ya que al haberle dado un valor máximo a rand(), este primer valor debe ser válido.
					*/
					$posicion_inicial_valida = es_una_posicion_valida($posicion_inicial['fila'] + 1, $posicion_inicial['columna'], $tamano_tablero) &&
											   es_una_posicion_valida($posicion_inicial['fila'] + 2, $posicion_inicial['columna'], $tamano_tablero);
					
					//Luego de verificar que la posición es válida, verificamos que ya no se encuentre ocupada
					if ($posicion_inicial_valida) {
						$posicion_inicial_valida = !es_una_posicion_ocupada($posicion_inicial['fila'], $posicion_inicial['columna'], $tablero) &&
												   !es_una_posicion_ocupada($posicion_inicial['fila'] + 1, $posicion_inicial['columna'], $tablero) &&
												   !es_una_posicion_ocupada($posicion_inicial['fila'] + 2, $posicion_inicial['columna'], $tablero);
					}
				}
				
				//Si después de los dos controles termina siendo una posición válida, entonces seteamos esos valores en el tablero.
				if ($posicion_inicial_valida) {
					$tablero[$posicion_inicial['fila']][$posicion_inicial['columna']]['ocupado'] = true;
					if ($orientacion == 'horizontal') {
						$tablero[$posicion_inicial['fila']][$posicion_inicial['columna'] + 1]['ocupado'] = true;
						$tablero[$posicion_inicial['fila']][$posicion_inicial['columna'] + 2]['ocupado'] = true;
					} else {
						$tablero[$posicion_inicial['fila'] + 1][$posicion_inicial['columna']]['ocupado'] = true;
						$tablero[$posicion_inicial['fila'] + 2][$posicion_inicial['columna']]['ocupado'] = true;
					}
				}
			}
		}
	
		return $tablero;
	}
	
	function ubicar_destructores ($tablero, $tamano_tablero) {
		for ($i = 0; $i < 3; $i++) {
				
			$posicion_inicial_valida = false;
				
			while (!$posicion_inicial_valida) {
					
				$posicion_inicial = sortear_posicion_inicial($tamano_tablero);
				$orientacion = sortear_orientacion_embarcacion();
					
				if ($orientacion == 'horizontal') {
	
					/*
					 * Verificamos que las siguientes tres columnas se encuentre dentro del tablero.
					* No controlamos el primer valor ya que al haberle dado un valor máximo a rand(), este primer valor debe ser válido.
					*/
					$posicion_inicial_valida = es_una_posicion_valida($posicion_inicial['fila'], $posicion_inicial['columna'] + 1, $tamano_tablero);
						
					//Luego de verificar que la posición es válida, verificamos que ya no se encuentre ocupada
					if ($posicion_inicial_valida) {
						$posicion_inicial_valida = !es_una_posicion_ocupada($posicion_inicial['fila'], $posicion_inicial['columna'], $tablero) &&
												   !es_una_posicion_ocupada($posicion_inicial['fila'], $posicion_inicial['columna'] + 1, $tablero);
					}
				} else {
					/*
					 * Verificamos que las siguientes tres filas se encuentre dentro del tablero.
					* No controlamos el primer valor ya que al haberle dado un valor máximo a rand(), este primer valor debe ser válido.
					*/
					$posicion_inicial_valida = es_una_posicion_valida($posicion_inicial['fila'] + 1, $posicion_inicial['columna'], $tamano_tablero);
						
					//Luego de verificar que la posición es válida, verificamos que ya no se encuentre ocupada
					if ($posicion_inicial_valida) {
						$posicion_inicial_valida = !es_una_posicion_ocupada($posicion_inicial['fila'], $posicion_inicial['columna'], $tablero) &&
												   !es_una_posicion_ocupada($posicion_inicial['fila'] + 1, $posicion_inicial['columna'], $tablero);
					}
				}
	
				//Si después de los dos controles termina siendo una posición válida, entonces seteamos esos valores en el tablero.
				if ($posicion_inicial_valida) {
					$tablero[$posicion_inicial['fila']][$posicion_inicial['columna']]['ocupado'] = true;
					if ($orientacion == 'horizontal') {
						$tablero[$posicion_inicial['fila']][$posicion_inicial['columna'] + 1]['ocupado'] = true;
					} else {
						$tablero[$posicion_inicial['fila'] + 1][$posicion_inicial['columna']]['ocupado'] = true;
					}
				}
			}
		}
	
		return $tablero;
	}
	
	function ubicar_submarinos ($tablero, $tamano_tablero) {
		for ($i = 0; $i < 4; $i++) {
	
			$posicion_inicial_valida = false;
	
			while (!$posicion_inicial_valida) {
					
				$posicion_inicial = sortear_posicion_inicial($tamano_tablero);
				
				$posicion_inicial_valida = es_una_posicion_valida($posicion_inicial['fila'], $posicion_inicial['columna'], $tamano_tablero);
				
				if ($posicion_inicial_valida)
					$posicion_inicial_valida = !es_una_posicion_ocupada($posicion_inicial['fila'], $posicion_inicial['columna'], $tablero);
	
				//Si después de los dos controles termina siendo una posición válida, entonces seteamos esos valores en el tablero.
				if ($posicion_inicial_valida)
					$tablero[$posicion_inicial['fila']][$posicion_inicial['columna']]['ocupado'] = true;
				
			}
		}
	
		return $tablero;
	}
	
	function es_una_posicion_valida ($fila, $columna, $tamano_tablero) {
		if ($fila < $tamano_tablero && $columna < $tamano_tablero)
			return true;
		
		return false;
	}
	
	function sortear_posicion_inicial ($tamano_tablero) {
		$fila = rand(0, $tamano_tablero);
		$columna = rand(0, $tamano_tablero);
		
		return array('fila' => $fila, 'columna' => $columna);
	}
	
	function sortear_orientacion_embarcacion () {
		return rand() % 2 == 0?'horizontal':'vertical';
	}
	
	function es_una_posicion_ocupada ($fila, $columna, $tablero) {
		return $tablero[$fila][$columna]['ocupado']?true:false;
	}
	
	function contar_posiciones_ocupadas ($tablero, $tamano_tablero) {
		$filas = array();
		$columnas = array();
		
		for ($i = 0; $i < $tamano_tablero; $i++) {
			$conteo = 0;
			for ($j = 0; $j < $tamano_tablero; $j++) {
				if ($tablero[$i][$j]['ocupado'])
					$conteo++;
			}
			
			$filas[$i] = $conteo;
		}
		
		for ($i = 0; $i < $tamano_tablero; $i++) {
			$conteo = 0;
			for ($j = 0; $j < $tamano_tablero; $j++) {
				if ($tablero[$j][$i]['ocupado'])
					$conteo++;
			}
				
			$columnas[$i] = $conteo;
		}
		
		return array('filas' => $filas, 'columnas' => $columnas);
	}
	
	//Para imprimir el tablero a partir de la variable de sesión juego. De esta manera se puede verificar que posiciones están ocupadas.
	/*for ($i = 0; $i < $_SESSION['juego']['tamano_tablero']; $i++) {
		for ($j = 0; $j < $_SESSION['juego']['tamano_tablero']; $j++) {
			if ($_SESSION['juego']['tablero'][$i][$j]['ocupado'] == true)
				echo '<strong>' . $_SESSION['juego']['tablero'][$i][$j]['ocupado'] . '</strong>';
			else
				echo 'O';
		}
		echo '<br />';
	}*/
	
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
            
        <!-- Estilos para el tablero -->
        <link rel="stylesheet" href="css/tablero.css">
    </head>
    <body>
        
        <div class="container">
            
            <div class="header">
                <ul class="nav nav-pills pull-right">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="dificultad.php">Dificultad</a></li>
                    <li class="active"><a href="#">Tablero</a></li>
                </ul>
                <h3 class="text-primary">Batalla Naval</h3>
            </div>
            
            <div class="jumbotron">
                <h1>Â¡Hora de la batalla!</h1>
                <hr>
                <div class="table-responsive">
                    <table id="tablero" class="table table-bordered tablero">
                        <tr>
                            <!-- La posicion 0x0 se deja en blanco siempre -->
                            <td></td>
                            <!-- La primera columna muestra la cantidad de casillas ocupadas en esa columna -->
<?php
	foreach ($_SESSION['juego']['conteo']['columnas'] as $cantidad) {
?>
							<td><?php echo $cantidad;?></td>
<?php
	}
?>
                            
                        </tr>
<?php
	foreach ($_SESSION['juego']['tablero'] as $fila=>$columnas) {
?>
						<tr>
							<td><?php echo $_SESSION['juego']['conteo']['filas'][$fila];?></td>
<?php
		foreach ($columnas as $columna=>$valor) {
			if ($valor['bombardeado'] && $valor['ocupado']) {
?>
							<td class="acierto"></td>
<?php
			} else if ($valor['bombardeado'] && !$valor['ocupado']) {
?>
							<td class="agua"></td>
<?php
			} else {
?>
							<td onclick="window.open('tablero.php?fila=<?php echo $fila;?>&columna=<?php echo $columna;?>','_self')"><strong>?</strong></td>
<?php
			}
		}
?>
						</tr>
<?php
	}
?>
                    </table>
                </div>
            </div>
            
        </div>
        
        <!-- jQuery (necesario para el plugin Javascript de Bootstrap -->
        <script src="js/jquery.js"></script>
        <!-- Incluimos el plugin completo de Bootstrap (tambien puede incluirse por separado) -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Lo de rellenar las casillas se harÃ¡ con php -->
        <script>
            $('#tablero tr td.agua').html('<span class="glyphicon glyphicon-tint"></span>');
            $('#tablero tr td.acierto').html('<span class="glyphicon glyphicon-fire"></span>');
        </script>
    </body>
</html>