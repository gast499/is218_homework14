<?php
  
  $opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
  ];
  
  $pdo = new PDO('mysql:host=sql2.njit.edu;dbname=tmh27', 'tmh27', '5OsR66EQ6');
  
  //$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  
  $stmt = $pdo->query('SELECT customerName FROM customers');
  echo '<h3>Using PDO</h3>';
  echo '<b>All of the customers (businesses) in the customers table of my database are:</b><br><br>';
  while ($row = $stmt->fetch()){
    echo $row['customerName'] . "<br>";
  }
  
  echo '<br><br>The customer with a customer number of 103 is: <br>';
  //$sql = 'SELECT * FROM customers WHERE customerNumber = ?';
  $customerNumber = 103;
  $stmt = $pdo->prepare('SELECT customerName FROM customers WHERE customerNumber = ?');
  $stmt->execute([$customerNumber]);
  $user = $stmt->fetch();
  print_r($user);
  
  echo '<br><br>The number of customers in the customers table is: ';
  $count = $pdo->query('SELECT count(*) FROM customers')->fetchColumn();
  echo $count;
  
  echo '<br><br>The array when I use the fetchAll command is:<br>';
  $data = $pdo->query('SELECT firstName FROM users')->fetchAll();
  $j = json_encode($data);
  print_r($j);
  
  echo '<br><br>The array when I use the fetchAll(PDO::FETCH_COLUMN) command is: <br>';
  $data = $pdo->query('SELECT firstName FROM users')->fetchAll(PDO::FETCH_COLUMN);
  $j = json_encode($data);
  print_r($j);
  
  echo '<br><br>The array when I use the fetchAll(PDO::FETCH_KEY_PAIR) command is: <br>';
  $data = $pdo->query('SELECT username, firstName FROM users')->fetchAll(PDO::FETCH_KEY_PAIR);
  $j = json_encode($data);
  print_r($j);
  
  echo '<br><br>The number of rows in the users table is: <br>';
  $count = $pdo->query("SELECT count(1) FROM users")->fetchColumn();
  echo $count;
  
  
?>