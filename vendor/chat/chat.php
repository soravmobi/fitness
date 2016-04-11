<?php

require_once "opentok.phar";
use OpenTok\OpenTok;
use OpenTok\MediaMode;
use OpenTok\ArchiveMode;
use OpenTok\Session;
use OpenTok\Role;

$API_KEY = "45550192";
$API_SECRET = "e22e9f815131fb1823f2df212394cf91cae6839d";
$apiObj = new OpenTok($API_KEY, $API_SECRET);
$session = $apiObj->createSession(array('mediaMode' => MediaMode::ROUTED));
$sessionId = $session->getSessionId();
$token = $apiObj->generateToken($sessionId);

?>