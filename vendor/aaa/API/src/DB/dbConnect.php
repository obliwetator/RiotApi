<?php

namespace API\dbCall;


function DbOpenConn(string $dbRegion)
{
	$db_server = "localhost";
	$db_user = "root";
	$db_pass = "";
	$db_database = "lol_database_" . $dbRegion;

	$conn = new \mysqli($db_server, $db_user, $db_pass, $db_database) or die("Connect failed: %s\n" . $conn->error);

	// $this->conn = $conn;

	return $conn;
}