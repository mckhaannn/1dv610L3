<?php

  require_once('databaseInformation.php');
  $dbServername = SERVER_NAME;
  $dbUsername = DB_USERNAME;
  $dbPassword = DB_PASSWORD;
  $dbname = DB_NAME;
  try {
    $connection = new PDO("mysql:host=$dbServername;dbname=$dbname;", $dbUsername, $dbPassword);
  } catch(Exception $e) {
    echo $e->getMessage();
  }
