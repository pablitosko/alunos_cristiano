<?php
$server = "localhost"; //ip ou alias
$username = "root"; //usuario
$password = ""; //senha banco
$dbname = "cristiano"; //database ou Schema
// Create connection
try{
   $conn = new PDO("mysql:host=$server;dbname=$dbname","$username","$password");
   $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
   die('Unable to connect with the database');
}
