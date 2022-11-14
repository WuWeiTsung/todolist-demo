<?php

include('db.php');

try {
  $pdo = new PDO("mysql:host=$db[host];dbname=$db[dbname];port=$db[port]", $db['username'], $db['password']);
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
  exit;
}

$sql = "SELECT * FROM todos ORDER BY `order` ASC";
$statement = $pdo->prepare($sql);
$statement->execute();
$todos = $statement->fetchAll();

?>
<script>
  let todos = <?= json_encode($todos, JSON_NUMERIC_CHECK) ?>
</script>