<?php 

$database = connectToDB();

$email = $_GET["email"];

$sql = "SELECT * FROM users WHERE email = :email";

$query = $database->prepare($sql);

$query->execute([
    "email" => $email
]);

$user = $query->fetch();

$_SESSION["success"] = "Account created successfully. Please enter doctor information.";
    header("Location: /manage-doctors-add-info?id=" . $user["id"]);
    exit;