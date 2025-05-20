<?php
$database = connectToDB();

// doctor profile info
$name = $_POST["name"];
$specialty = $_POST["specialty"];
$email = $_POST["email"];
$phone_number = $_POST["phone_number"];
$biography = $_POST["biography"];
$user_id = $_POST["user_id"];

// // finding user id
// $sql = "SELECT * FROM users WHERE email = :email";

// $query = $database->prepare($sql);

// $query->execute([
//     "email" => $email
// ]);

// $user = $query->fetch();

// get user id


// add doctor profile info into doctors table
$sql = "INSERT INTO doctors (`name`, `specialty`, `email`, `phone_number`, `biography`, `user_id`) 
        VALUES (:name, :specialty, :email, :phone_number, :biography, :user_id)";

$query = $database->prepare($sql);

$query->execute([
    "name" => $name,
    "specialty" => $specialty,
    "email" => $email,
    "phone_number" => $phone_number,
    "biography" => $biography,
    "user_id" => $user_id
]);

$_SESSION["success"] = "Doctor account and profile created successfully.";
header("Location: /manage-doctors");
exit;

