<?php 

$server="localhost";
$user="root";
$pass="";
$data="invent";

try{
    $conn= new PDO ("mysql:host=$server;dbname=$data",$user,$pass);
} catch (PDOException){
    echo "connection failed" .$e->getmessage();
}
?>