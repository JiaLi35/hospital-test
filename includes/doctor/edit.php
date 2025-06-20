<?php

$database = connectToDB();

$id = $_POST["id"];
$name = $_POST["name"];
$specialty = $_POST["specialty"];
$phone_number = $_POST["phone_number"];
$email = $_POST["email"];
$biography = $_POST["biography"];
$image = $_FILES["image"];

if (empty($name) || empty($specialty) || empty($email) || empty($phone_number) || empty($biography) || empty($id)){
    $_SESSION["error"] = "Please fill up all the fields.";
    header("Location: /manage-posts-edit?id=" . $id);
    exit;  
} 

if ( !empty( $image["name"] ) ) {
    // where is the upload folder
    $target_folder = "uploads/";
    // add the image name to the upload folder path
    // YYMMDDHHIISS (put date to prevent overwriting of files)
    $target_path = $target_folder . date("YmdHisv") . "_" . basename( $image["name"] );
    // move the file to the uploads folder
    move_uploaded_file( $image["tmp_name"] , $target_path );

// update the post with image path

    $sql = "UPDATE doctors 
    SET name = :name, specialty = :specialty, phone_number = :phone_number, email = :email, biography = :biography, image = :image 
    WHERE id = :id";

    $query = $database->prepare($sql);

    $query->execute([
    "id" => $id,
    "name" => $name,
    "specialty" => $specialty,
    "phone_number" => $phone_number,
    "email" => $email,
    "biography" => $biography,
    "image" => $target_path
    ]);

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
}

$sql = "UPDATE appointments SET doctor_name = :doctor_name, specialty = :specialty WHERE doctor_id = :doctor_id";

$query = $database->prepare($sql);

$query->execute([
    "doctor_id" => $id, 
    "doctor_name" => $name, 
    "specialty" => $specialty
]);

$doctor = GetDoctorDetailsByID($id);

$sql = "UPDATE users SET name = :name WHERE id = :id";

$query = $database->prepare($sql);

$query->execute([
    "id" => $doctor["user_id"], 
    "name" => $name
]);

if (isAdmin()){    
    $_SESSION["success"] = "Doctor information updated successfully.";
    header("Location: /manage-doctors");
    exit;
} else {
    $_SESSION["success"] = "Your information has been updated successfully.";
    header("Location: /doctor/dashboard?id=" . $id);
    exit;
}



