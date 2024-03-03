<?php

$method = 'GET';
$idp = 'spid-demo';

if (isset($_GET) && isset($_GET['selected_idp'])) {
    $idp = $_GET['selected_idp'];
    $method = 'GET';
}
if (isset($_POST) && isset($_POST['selected_idp'])) {
    $idp = $_POST['selected_idp'];
    $method = 'POST';
}

switch($method){
  case 'GET':
    $url = $sp->login($idp, 0, 1, 1, null, true);
    break;
  case 'POST':
    $url = $sp->loginPost($idp, 0, 1, 1, null, true);
    break;
}

if (!$url) {
    echo "Already logged in !<br>";
    echo "<a href=\"/\">Home</a>";
} else {
    echo $url;
}
