<?php
    session_start();
    if (isset($_SESSION['user_id'])) {
      header('Location: ./index.php');
    }

    require 'database.php';
      
    
      if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $records = $conn->prepare('SELECT id, email, password FROM users2 WHERE email = :email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
    
        $message = '';
    
        if (count($results) > 0 && md5($_POST['password'], $results['password'])) {
          $_SESSION['user_id'] = $results['id'];
          header("Location: /login");
        } else {
          $message = 'Sorry, those credentials do not match';
        }
      }
?>




<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="stylesheet" href="./assets/css/style.css">
   <link rel="shortcut icon" href="./descarga.png">
    <title>Login</title>
</head>
<body>

<?php require './partials/header.php' ?>

<div class="main">
<h1>Login</h1>

<span>or <a href="signup.php">SignUp</a></span>

<?php if(!empty($message)): ?>
  <p> <?= $message ?></p>
<?php endif; ?>
<form action="login.php" method="post">

<form action="login.php" method="POST">
  <input name="email" type="text" placeholder="Enter your email">
  <input name="password" type="password" placeholder="Enter your Password">
  <input type="submit" value="Submit">
</form>

</form>

<a href="./index.php">Return</a>

</div>

</body>
</html>