<?php
header('Content-Type: application/json; charset=utf-8');

include('../db.php');

try {
  $pdo = new PDO("mysql:host=$db[host];dbname=$db[dbname];port=$db[port]", $db['username'], $db['password']);
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
  exit;
}

$sql = "UPDATE  todos SET `order`=:order WHERE id = :id";
$statement = $pdo->prepare($sql);
foreach ($_POST['orderList'] as $key => $orderList) {
  $statement->bindValue(':id', $orderList['id'], PDO::PARAM_INT);
  $statement->bindValue(':order', $orderList['order'], PDO::PARAM_INT);
  $result = $statement->execute();
}
