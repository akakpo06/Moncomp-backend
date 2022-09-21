<?php 
require_once "Database.php";
require_once "headers.php";

$db = new Database;
$db = $db->connect();

$user = json_decode(file_get_contents("php://input"));

    $statement = $db->prepare("SELECT COUNT(id) AS 'match' FROM users WHERE email=:email");
    $statement->execute(array("email" => $user->email));
    $mail = $statement->fetch();

    $statement = $db->prepare("SELECT COUNT(id) AS 'match' FROM users WHERE nif=:nif");
    $statement->execute(array("nif" => $user->nif));
    $nif = $statement->fetch();

    if($nif["match"] !== "0"){
        $response = ["status" => false , "message" => "Nif incorrect ou déja inscrit."];
    }
    elseif ($mail["match"] !== "0") {
        $response = ["status" => false , "message" => "Email incorrect ou déja inscrit."];
    }
    else{
        $sql = "INSERT INTO users (nif, email, password, created_at) VALUE (:nif, :email, :password, :created_at)";
        $stmt = $db->prepare($sql);
        $created_at = date("Y-m-d");

        $stmt->bindParam(":nif", $user->nif);
        $stmt->bindParam(":email", $user->email);
        $stmt->bindParam(":password", $user->password);
        $stmt->bindParam(":created_at", $created_at);

        if($stmt->execute()) {
            $response = ["status" => true , "message" => "Record created Successfully."];
        }
        else{
            $response = ["status" => false , "message" => "Failed to create record."];
        }
        return;
    }
echo json_encode($response);
?>