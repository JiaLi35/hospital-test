<?php
$database = connectToDB();

// doctor, date time and patient info
$appointment_id = $_POST["appointment_id"];
$patient_id = $_POST["patient_id"];

$sql = "UPDATE appointments SET status = 'Cancelled' WHERE id = :id";

$query = $database->prepare($sql);

$query->execute([
    "id" => $appointment_id
]);

$_SESSION["success"] = "Appointment cancelled successfully.";
header("Location: /patient/manage-appointments?id=" . $patient_id);
exit;