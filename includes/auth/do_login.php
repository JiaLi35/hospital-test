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

            // set success message 
            $_SESSION["success"] = "Welcome back, " . $user["name"] . "!";

            // if user is admin then redirect to admin dashboard
            if (isAdmin()){
                // redirect to dashboard
                header("Location: /admin/dashboard");
                exit;
            } else if (isDoctor()) {
                // redirect to doctor dashboard
                header("Location: /doctor/dashboard");
                exit;
            } else {
                // redirect to patient dashboard
                header("Location: /patient/dashboard");
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