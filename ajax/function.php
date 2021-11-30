<?php 

function limpiar ($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = ""){
	// Iniciamos la variable $conn
	global $conn;

	if (PHP_VERSION < 7) {
		$theValue = get_magic_quotes_gpc() ? stripcslashes($theValue) : $theValue;
	}

	//Agregamos $conn en las funciones mysqli_real_escape_string y mysqli_escape_string
	$theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($conn, $theValue) : mysqli_escape_string($conn, $theValue);

	switch ($theType) {
		case 'text':
			$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
			break;
		case 'long':
		case 'int':
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			break;
		case 'double':
			$theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
			break;
		case 'date':
			$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
			break;
		case 'defined':
			$theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
			break;
	}
	return $theValue;
}

define('url', 'http://localhost/Sistema_Usuarios/');

/*=============================================
FORMATEAR URL
=============================================*/
function limpiar_url($url) {
  // Tranformamos todo a minusculas
  $url = strtolower($url);
  //Rememplazamos caracteres especiales latinos
  $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
  $repl = array('a', 'e', 'i', 'o', 'u', 'n');
  $url = str_replace ($find, $repl, $url);
  // Añadimos los guiones
  $find = array(' ', '&', '\r\n', '\n', '+'); 
  $url = str_replace ($find, '-', $url);
  // Eliminamos y Reemplazamos demás caracteres especiales
  $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
  $repl = array('', '-', '');
  $url = preg_replace ($find, $repl, $url);
  
  return $url;
}

/*=============================================
MOSTRAR ARTICULOS
=============================================*/
function all_articles($limit){
	global $conn;
	$stmt = $conn->prepare("SELECT * FROM ud_articles JOIN ud_users ON ud_users.id = ud_articles.ahutor ORDER BY ud_articles.id DESC LIMIT $limit");
	$stmt->execute();
	return $stmt->get_result();
	$stmt->close();
}

/*=============================================
MOSTRAR INFORMACION DEL ARTICULOS
=============================================*/
function item_post($item){
	global $conn;
	$select = sprintf("SELECT * FROM ud_articles JOIN ud_users ON ud_users.id = ud_articles.ahutor WHERE url = %s", limpiar($item, 'text'));

	$consult = mysqli_query($conn, $select);
	$res_dates = mysqli_fetch_all($consult);
	
	return $res_dates;
	
	mysqli_free_result($consult);
}