<?php

    // TODO: 1. connect to database
    $database = connectToDB();

    // TODO: 2. get the user_id from the form
    $id = $_POST["appointment_id"];

    // TODO: 3. delete the user
    $sql = "DELETE FROM appointments WHERE id = :id";

    $query = $database->prepare($sql);

    $query->execute([
        "id" => $id
    ]);

    // TODO: 4. redirect to manage doctors
    $_SESSION["success"] = "Appointment deleted successfully.";
    header("Location: /manage-appointments");
    exit;