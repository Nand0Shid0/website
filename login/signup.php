<?php
require 'database.php';

$message = '';

if (!empty($_POST['email']) && !empty($_POST['password'])) {

    $sql = "INSERT INTO users2 (email, password, username, name, phone, birthday, privileges, gender) VALUES (:email, :password, :username, :name, :phone, :birthday, :privilege, :gender)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = md5($_POST['password']);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':username', $_POST['username']);
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':phone', $_POST['phone']);
    $stmt->bindParam(':birthday', $_POST['birthday']);
    $stmt->bindParam(':privilege', $_POST['privilege']);
    $stmt->bindParam(':gender', $_POST['gender']);
    
    if ($stmt->execute()) {
      $message = 'Successfully created new user';
      
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="shortcut icon" href="./descarga.png">
    <title>SignUp</title>
</head>
<body>

<?php if(!empty($message)): ?>
  <p> <?= $message ?></p>
<?php endif; ?>


<div class="main">
<h1>SignUp</h1>
  <div class="logn-page">
    <span>or <a href="login.php">Login</a></span>
  </div>


  <form action="signup.php" method="POST">
    <input class="email" name="email" type="email" placeholder="Enter your email">
    <input name="password" type="password" placeholder="Enter your Password">
    <input name="username" type="text" placeholder="Username">
    <input name="name" type="text" placeholder="Name">
    <input name="phone" type="number" placeholder="Phone">
    <input name="birthday" type="date" placeholder="Birth Day">
    <select class="" name="privilege" id="">
        <option value="A">Admin</option>
        <option value="M">Mortal</option>
    </select>
    
    <select class="" name="gender" id="">
        <option value="M">Men</option>
        <option value="W">Women</option>
    </select>
    
    
    <input type="submit" value="SignUp">
  </form>
  <a href="./index.php">Return</a>
</div>

</body>
</html>