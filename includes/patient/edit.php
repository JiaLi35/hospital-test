<?php

$database = connectToDB();

$id = $_POST["id"];
$name = $_POST["name"];
$phone_number = $_POST["phone_number"];
$email = $_POST["email"];
$gender = $_POST["gender"];

if (empty($name) || empty($email) || empty($phone_number) || empty($gender) || empty($id)){
    $_SESSION["error"] = "Please fill up all the fields.";
    header("Location: /patient/dashboard?id=" . $id);
    exit;  
} else {
    $sql = "UPDATE users SET name = :name WHERE id = :id";

    $query = $database->prepare($sql);

    $query->execute([
        "id" => $_SESSION["user"]["id"],
        "name" => $name
    ]);

    $sql = "UPDATE patients 
            SET name = :name, phone_number = :phone_number, email = :email, gender = :gender 
            WHERE id = :id";

    $query = $database->prepare($sql);

    $query->execute([
        "id" => $id,
        "name" => $name,
        "phone_number" => $phone_number,
        "email" => $email,
        "gender" => $gender
    ]);

    $sql = "UPDATE appointments
            SET patient_name = :patient_name, phone_number = :phone_number, email = :email, gender = :gender  
            WHERE patient_id = :patient_id";

    $query = $database->prepare($sql);

    $query->execute([
        "patient_id" => $id,
        "patient_name" => $name,
        "phone_number" => $phone_number,
        "email" => $email,
        "gender" => $gender
    ]);

}
    $_SESSION["success"] = "Your information has been updated successfully!";
    header("Location: /patient/dashboard?id=" . $id);
    exit;

