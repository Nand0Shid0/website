<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users2 WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login or SignUp</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="./descarga.png">
  </head>
  <body>
    <?php require 'partials/header.php' ?>
    <?php if(!empty($message)): ?>
  <p> <?= $message ?></p>
<?php endif; ?>

    <?php if(!empty($user)): ?>
      <br> Welcome. <?= $user['email']; ?>
      <br>You are Successfully Logged In
      <a href="logout.php">
        Logout
      </a>
    <?php else: ?>

      <div class="main">
          <h1>Please Login or SignUp</h1>
          <a href="login.php">Login</a> or
          <a href="signup.php">SignUp</a>

      </div>
      

      <div class="main2">
        <h1>Let's Go</h1>
      </div>
    <?php endif; ?>
  </body>
</html>