<?php
$database = connectToDB();

$id = $_POST["id"];
$doctor_id = $_POST["doctor_id"];
$date = $_POST["date"];
$time = $_POST["time"];

if ( empty($date) || empty($time) ){
    $_SESSION["error"] = "Please fill up all the fields.";
    header("Location: /doctor/edit-appointments?id=" . $doctor_id);
    exit;  
} else {
    // add doctor profile info into patients table
    $sql = "UPDATE appointments SET date = :date, time = :time WHERE id = :id";
    
    $query = $database->prepare($sql);
    
    $query->execute([
        "date" => $date,
        "time" => $time,
        "id" => $id
    ]);
    
    $_SESSION["success"] = "Appointment rescheduled successfully.";
    header("Location: /doctor/manage-appointments?id=" . $doctor_id);
    exit;
}