<?php
$database = connectToDB();

// doctor, date time and patient info
$appointment_id = $_POST["appointment_id"];
$doctor_id = $_POST["doctor_id"];
$status = $_POST["status"];

if ($status === "Pending") {
    $sql = "UPDATE appointments SET status = 'Scheduled' WHERE id = :id";

    $query = $database->prepare($sql);

    $query->execute([
        "id" => $appointment_id
    ]);

    $_SESSION["success"] = "Appointment confirmed.";
    header("Location: /doctor/manage-appointments?id=" . $doctor_id);
    exit;
} else {
    $sql = "UPDATE appointments SET status = 'Completed' WHERE id = :id";

    $query = $database->prepare($sql);

    $query->execute([
        "id" => $appointment_id
    ]);

    $_SESSION["success"] = "Appointment marked as completed.";
    header("Location: /doctor/manage-appointments?id=" . $doctor_id);
    exit;
}

