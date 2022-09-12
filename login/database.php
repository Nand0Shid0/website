<?php
    $server = 'localhost';
    $username = 'fernando';
    $password = "root";
    $database = 'user2';

    try {
        $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
      } catch (PDOException $e) {
        die('Connection Failed: ' . $e->getMessage());
      }
      
?>