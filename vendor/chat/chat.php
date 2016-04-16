<?php

require_once "opentok.phar";
use OpenTok\OpenTok;
use OpenTok\MediaMode;
use OpenTok\ArchiveMode;
use OpenTok\Session;
use OpenTok\Role;

if($_SERVER['SERVER_NAME'] == "localhost"){
	$servername = "localhost";
	$username   = "root";
	$password   = "";
	$dbname     = "fitness";
}else{
	$servername = "localhost";
	$username   = "virtuds6_fitness";
	$password   = "H+sLTUp%5rzD";
	$dbname     = "virtuds6_fitness";
}


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM `tokbox` WHERE `id` = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $API_KEY    = $row['api_key'];
        $API_SECRET = $row['api_secret'];
    }
} else {
    	$API_KEY    = "";
        $API_SECRET = "";
}

$apiObj = new OpenTok($API_KEY, $API_SECRET);
$session = $apiObj->createSession(array('mediaMode' => MediaMode::ROUTED));
$sessionId = $session->getSessionId();
$token = $apiObj->generateToken($sessionId);

?>