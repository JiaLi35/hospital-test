<?php
$database = connectToDB();

// doctor profile info
$name = $_POST["name"];
$ic = $_POST["ic"];
$email = $_POST["email"];
$phone_number = $_POST["phone_number"];
$gender = $_POST["gender"];
$user_id = $_POST["user_id"];

if (empty($name) || empty($ic) || empty($email) || empty($phone_number) || empty($gender) || empty($user_id)){
    $_SESSION["error"] = "Please fill up all the fields.";
    header("Location: /manage-posts-edit?id=" . $id);
    exit;  
} else {
    // add doctor profile info into patients table
    $sql = "INSERT INTO patients (`name`, `ic`, `email`, `phone_number`, `gender`, `user_id`) 
            VALUES (:name, :ic, :email, :phone_number, :gender, :user_id)";
    
    $query = $database->prepare($sql);
    
    $query->execute([
        "name" => $name,
        "ic" => $ic,
        "email" => $email,
        "phone_number" => $phone_number,
        "gender" => $gender,
        "user_id" => $user_id
    ]);

    $patient = GetPatientByUID($user_id);
    
    $_SESSION["success"] = "Patient profile created successfully.";
    header("Location: /patient/dashboard?id=" . $patient["id"] );
    exit;
}