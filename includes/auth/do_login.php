<?php
$database = connectToDB();

$email = $_POST["email"];
$password = $_POST["password"];

if ( empty($email) || empty($password) ){
    $_SESSION["error"] = "Please fill up all the fields.";
    // redirect to login page 
    header("Location: /login");
    exit; 

} else {
    // fetching data 
    $user = getUserByEmail($email);

    if ( $user ){

        // verify password
        if (password_verify($password, $user["password"])){

            // store user data in user session
            $_SESSION["user"] = $user;

            if ( isAdmin() ) {
                // set success message 
                $_SESSION["success"] = "Welcome back, " . $user["name"] . "!";
                // redirect to home
                header("Location: /admin/dashboard");
                exit;
            } else if ( isDoctor() ) {
                $doctor = GetDoctorByUID ( $user["id"] ) ;

                // set success message 
                $_SESSION["success"] = "Welcome back, " . $user["name"] . "!";
                // redirect to home
                header("Location: /doctor/dashboard?id=" . $doctor["id"]);
                exit;
            } else {
                $patient = GetPatientByUID ( $user["id"] ) ;

                // set success message 
                $_SESSION["success"] = "Welcome back, " . $user["name"] . "!";
                // redirect to home
                header("Location: /patient/manage-appointments?id=" . $patient["id"]);
                exit;
            }

        } else {
            $_SESSION["error"] =  "Incorrect Password";
            // redirect to login page 
            header("Location: /login");
            exit;
        }
        
    } else {
        $_SESSION["error"] = "This email does not exist";
        // redirect to login page 
        header("Location: /login");
        exit;
    }

}