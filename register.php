<?php 
require_once "Database.php";
require_once "headers.php";

$db = new Database;
$db = $db->connect();

$user = json_decode(file_get_contents("php://input"));
$sql = "INSERT INTO users (nif, email, password, created_at) VALUE (:nif, :email, :password, :created_at)";
$stmt = $db->prepare($sql);
$created_at = date("Y-m-d");

$stmt->bindParam(":nif", $user->nif);
$stmt->bindParam(":email", $user->email);
$stmt->bindParam(":password", $user->password);
$stmt->bindParam(":created_at", $created_at);

if($stmt->execute()) {
    $response = ["status" => 1 , "message" => "Record created Successfully."];
}
else{
    $response = ["status" => 0 , "message" => "Failed to create record."];
}
echo json_encode($response);

?>