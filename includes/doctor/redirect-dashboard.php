<?php
// return doctor id with user id 
    $database = connectToDB();

    $user_id = $_SESSION["user"]["id"];

    $sql = "SELECT * FROM doctors WHERE user_id = :user_id";

    $query = $database->prepare($sql);

    $query->execute([
        "user_id" => $user_id
    ]);

    $doctor = $query->fetch();

    $_SESSION["success"] = "Welcome back, " . $doctor["name"];
        header("Location: /doctor/dashboard?id=" . $doctor["id"]);
        exit;
