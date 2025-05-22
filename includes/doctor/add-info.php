<?php

    $database = connectToDB();

    // doctor profile info
    $name = $_POST["name"];
    $specialty = $_POST["specialty"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $biography = $_POST["biography"];
    $user_id = $_POST["user_id"];
    $image = $_FILES["image"];

    if (empty($name) || empty($specialty) || empty($email) || empty($phone_number) || empty($biography) || empty($user_id)) {
        $_SESSION["error"] = "Please fill up all the fields.";
        header("Location: /manage-posts-edit?id=" . $id);
        exit;  
    }

    // trigger the file upload
    // make sure $image is not empty
    if ( !empty( $image ) ) {
        // where is the upload folder
        $target_folder = "uploads/";
        // add the image name to the upload folder path
        $target_path = $target_folder . basename( $image["name"] );
        // move the file to the uploads folder
        move_uploaded_file( $image["tmp_name"] , $target_path );
    }

    // add doctor profile info into doctors table
    $sql = "INSERT INTO doctors (`name`, `specialty`, `email`, `phone_number`, `biography`, `image`, `user_id`) 
            VALUES (:name, :specialty, :email, :phone_number, :biography, :image, :user_id)";
    
    $query = $database->prepare($sql);
    
    $query->execute([
        "name" => $name,
        "specialty" => $specialty,
        "email" => $email,
        "phone_number" => $phone_number,
        "biography" => $biography,
        "image" => isset($target_path) ? $target_path : "",
        "user_id" => $user_id
    ]);
    
    $_SESSION["success"] = "Doctor account and profile created successfully.";
    header("Location: /manage-doctors");
    exit;
