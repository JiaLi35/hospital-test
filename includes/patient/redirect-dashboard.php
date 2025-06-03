<?php
// return patient id with user id 
    $user_id = $_SESSION["user"]["id"];

    $patient = GetPatientByUID($user_id);

    $_SESSION["success"] = "Welcome back, " . $patient["name"];
    header("Location: /patient/dashboard?id=" . $patient["id"]);
    exit;