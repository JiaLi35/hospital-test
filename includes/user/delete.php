<?php

    // TODO: 1. connect to database
    $database = connectToDB();

    // TODO: 2. get the user_id from the form
    $id = $_POST["id"];

    // TODO: 3. delete the user
    $sql = "DELETE FROM users WHERE id = :id";

    $query = $database->prepare($sql);

    $query->execute([
        "id" => $id
    ]);

    // TODO: 4. redirect to manage users
    header("Location: /manage-users");
    exit;