<?php
// $dsn = 'mysql:host=localhost;dbname=todo';
$host = 'localhost';
$dbname = 'todo';
$username = 'root';
$password = '';
// $con = new PDO($dsn, $username, $password);
// if(!$con){
//     echo "Vous n'êtes pas connecté à la base de donnée";
//  }
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
 

?>