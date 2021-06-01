<?php
session_start();

include("../../includes/conn.php");

if(isset($_SESSION["user"])) {
    $login_role = $_SESSION["role"];
    if($login_role != "employee") {
        header("Location: ../$login_role/");
    }
}

?>