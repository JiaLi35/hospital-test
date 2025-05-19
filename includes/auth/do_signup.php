<?php
$database = connectToDB();

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

if ( empty($name) || empty($email) || empty($password) || empty($confirm_password)){
    $_SESSION["error"] = "Please fill up all the required fields.";
    // redirect to signup page
    header("Location: /signup");
    exit;

} else if ( $password !== $confirm_password) {
    $_SESSION["error"] = "Your passwords do not match.";
    // redirect to signup page
    header("Location: /signup");
    exit;

} else {
    // get user data by email
    $user = getUserByEmail($email);
    
    if ($user){
        $_SESSION["error"] = "The email provided already exists in our system.";
        // redirect to signup page
        header("Location: /signup");
        exit;

    } else {
        $sql = "INSERT INTO users (`name`, `email`, `password`) VALUES (:name, :email, :password)";

        $query = $database->prepare($sql);

        $query->execute([
            "name" => $name,
            "email" => $email,
            "password" => password_hash($password, PASSWORD_DEFAULT)
        ]);

        // set success message
        $_SESSION["success"] = "Account created successfully. Please login with your email and password.";

        header("Location: /login");
        exit;
    }
}