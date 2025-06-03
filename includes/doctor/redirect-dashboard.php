<?php
// return doctor id with user id 
    $user_id = $_SESSION["user"]["id"];

    $doctor = GetDoctorByUID($user_id);

    $_SESSION["success"] = "Welcome back, " . $doctor["name"];
        header("Location: /doctor/dashboard?id=" . $doctor["id"]);
        exit;
