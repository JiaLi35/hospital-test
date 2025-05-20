<?php

$database = connectToDB();

$id = $_POST["id"];
$name = $_POST["name"];
$specialty = $_POST["specialty"];
$phone_number = $_POST["phone_number"];
$email = $_POST["email"];
$biography = $_POST["biography"];

if (empty($name) || empty($specialty) || empty($email) || empty($phone_number) || empty($biography) || empty($id)){
    $_SESSION["error"] = "Please fill up all the fields.";
    header("Location: /manage-posts-edit?id=" . $id);
    exit;  
} else {
    $sql = "UPDATE doctors 
            SET name = :name, specialty = :specialty, phone_number = :phone_number, email = :email, biography = :biography 
            WHERE id = :id";

    $query = $database->prepare($sql);

    $query->execute([
        "id" => $id,
        "name" => $name,
        "specialty" => $specialty,
        "phone_number" => $phone_number,
        "email" => $email,
        "biography" => $biography
    ]);

    $_SESSION["success"] = "Doctor information updated successfully.";
    header("Location: /manage-doctors");
    exit;
}
