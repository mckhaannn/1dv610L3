<?php

// $dbServername = 'localhost';
// $dbUsername = 'id7092603_1dv610database';
// $dbPassword = '1dv610';
// $dbname = 'id7092603_1dv610database';
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
