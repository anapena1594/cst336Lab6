<?php

function getDatabaseConnection()
{
    
$servername = "us-cdbr-iron-east-05.cleardb.net";
$username = "b910465920c218";
$password = "9bd5a61c";
$dbname = "heroku_b09823b21f68f71";

// Create connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    return $conn;
    
  }

?>