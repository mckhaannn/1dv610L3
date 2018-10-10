<?php
  // setup for sql database connection
  $dbServername = 'localhost';
  $dbUsername = 'root';
  $dbPassword = '';
  $dbname = 'logindatabase';
  try {
    $connection = new PDO("mysql:host=$dbServername;dbname=$dbname;", $dbUsername, $dbPassword);
  } catch(Exception $e) {
    echo $e->getMessage();
  }
