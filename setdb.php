<?php

//create db
include('db.php');
$dbname = $db['dbname'];
try {
  $conn = new PDO("mysql:host=$db[host]", $db['username'], $db['password']);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "CREATE DATABASE $dbname";
  $conn->exec($sql);
  echo "Database created successfully<br>";
} catch (PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

//create table
try {
  $conn = new PDO("mysql:host=$db[host];dbname=$db[dbname]", $db['username'], $db['password']);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // sql to create table
  $sql = "CREATE TABLE todos (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  content VARCHAR(255) NOT NULL,
  is_complete TINYINT(1) NOT NULL DEFAULT 0,
  `order` INT(11) NOT NULL
  )";
  $conn->exec($sql);
  echo "Table todos created successfully";
} catch (PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
