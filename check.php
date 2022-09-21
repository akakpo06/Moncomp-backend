<?php
    session_start();
    if ($_SESSION["auth"] == "true") {
        echo json_encode(1);
    }
    else{
        echo json_encode(0);
    }
?>