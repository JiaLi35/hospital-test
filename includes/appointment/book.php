<?php
$database = connectToDB();

// doctor, date time and patient info
$doctor_id = $_POST["doctor_id"];
$doctor_name = $_POST["doctor_name"];
$specialty = $_POST["specialty"];
$date = $_POST["date"];
$time = $_POST["time"];
$patient_id = $_POST["patient_id"];
$patient_name = $_POST["patient_name"];
$ic = $_POST["ic"];
$email = $_POST["email"];
$phone_number = $_POST["phone_number"];
$gender = $_POST["gender"];

if ( empty($doctor_name) || empty($specialty) || empty($date) || empty($time) || empty($patient_name) || empty($ic) || empty($email) || empty($phone_number) || empty($gender)){
    $_SESSION["error"] = "Please fill up all the fields.";
    header("Location: /patient/book-appointments?id=" . $doctor_id);
    exit;  
} else {
    // add doctor profile info into patients table
    $sql = "INSERT INTO appointments (`doctor_id`, `doctor_name`, `specialty`, `date`, `time`, `patient_id`, `patient_name`, `ic`, `email`, `phone_number`, `gender`) 
            VALUES (:doctor_id, :doctor_name, :specialty, :date, :time, :patient_id, :patient_name, :ic, :email, :phone_number, :gender)";
    
    $query = $database->prepare($sql);
    
    $query->execute([
        "doctor_id" => $doctor_id,
        "doctor_name" => $doctor_name,
        "specialty" => $specialty,
        "date" => $date,
        "time" => $time,
        "patient_id" => $patient_id,
        "patient_name" => $patient_name,
        "ic" => $ic,
        "email" => $email,
        "phone_number" => $phone_number,
        "gender" => $gender
    ]);
    
    $_SESSION["success"] = "Appointment successfully booked! You can access it in your dashboard.";
    header("Location: /");
    exit;
}