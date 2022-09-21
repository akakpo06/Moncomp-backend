<?php 
session_start();
require_once "Database.php";
require_once "headers.php";

$db = new Database;
$db = $db->connect();

    $path = explode("/", $_SERVER["REQUEST_URI"]);

    if (isset($path[2]) && isset($path[3])){
        $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":email", $path[2]);
        $stmt->bindParam(":password", $path[3]);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $response = ["status" => true,"id"=> session_id(), "message"=>"authenticated succesfully"];
        }
        else{
            session_destroy();
            $response = ["message"=>"email ou mot de passe incorrect"];
        }
    }
    echo json_encode($response);
?>