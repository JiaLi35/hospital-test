<?php

$database = connectToDB();

$id = $_POST["id"];
$name = $_POST["name"];
$ic = $_POST["ic"];
$phone_number = $_POST["phone_number"];
$email = $_POST["email"];
$gender = $_POST["gender"];

if (empty($name) || empty($ic) || empty($email) || empty($phone_number) || empty($gender) || empty($id)){
    $_SESSION["error"] = "Please fill up all the fields.";
    header("Location: /manage-posts-edit?id=" . $id);
    exit;  
} else {
    $sql = "UPDATE patients 
            SET name = :name, ic = :ic, phone_number = :phone_number, email = :email, gender = :gender 
            WHERE id = :id";

    $query = $database->prepare($sql);

    $query->execute([
        "id" => $id,
        "name" => $name,
        "ic" => $ic,
        "phone_number" => $phone_number,
        "email" => $email,
        "gender" => $gender
    ]);
}
    $_SESSION["success"] = "Your information has been updated successfully!";
    header("Location: /patient/dashboard?id=" . $id);
    exit;

