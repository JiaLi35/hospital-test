<?php
$database = connectToDB();

$id = $_POST["id"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

if( empty($password) || empty($confirm_password) ) {
    $_SESSION["error"] = "Please fill in all the fields.";
    header("Location: /manage-users-changepwd?id=" . $id);
    exit;
} else if ($password !== $confirm_password) {
    $_SESSION["error"] = "Your passwords do not match.";
    header("Location: /manage-users-changepwd?id=" . $id);
    exit;
} else {
    $sql = "UPDATE users SET password = :password WHERE id=:id";

    $query = $database->prepare($sql);

    $query->execute([
        "id" => $id,
        "password" => password_hash($password, PASSWORD_DEFAULT)
    ]);

    $_SESSION["success"] = "Password has been updated successfully";
    if (isAdmin()){
        header("Location: /manage-users");
        exit;
    } else if (isDoctor()) {
        $doctor = GetDoctorByUID($id);
        header("Location: /doctor/dashboard?id=" . $doctor["id"]);
        exit;
    } else {
        $patient = GetPatientByUID($id);
        header("Location: /patient/dashboard?id=" . $patient["id"]);
        exit;
    }
    
}