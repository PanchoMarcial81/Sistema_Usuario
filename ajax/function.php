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