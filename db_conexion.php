<?php

$conn = new mysqli("localhost", "root", "", "sistema_usuarios");

if ($conn->connect_errno) {
	echo "Lo sentimos, este sitio web está experimentando problemas.";
    
    echo "Error: Fallo al conectarse a MySQL debido a: n";
    echo "Error: " . $conn->connect_errno . "\n";
    echo "Error: " . $conn->connect_error . "\n";

	exit;
}

require 'ajax/function.php';
