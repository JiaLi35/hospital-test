<?php
// return patient id with user id 
    $database = connectToDB();

    $user_id = $_SESSION["user"]["id"];

    $sql = "SELECT * FROM patients WHERE user_id = :user_id";

    $query = $database->prepare($sql);

    $query->execute([
        "user_id" => $user_id
    ]);

    $patient = $query->fetch();

    $_SESSION["success"] = "Welcome back, " . $patient["name"];
        header("Location: /patient/dashboard?id=" . $patient["id"]);
        exit;