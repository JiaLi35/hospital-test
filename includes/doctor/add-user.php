<?php 

$database = connectToDB();

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];
$role = $_POST["role"];

if ( empty($name) || empty($email) || empty($password) || empty($confirm_password)){
    $_SESSION["error"] = "Please fill up all the required fields.";
    // redirect to signup page
    header("Location: /manage-doctors-add-user");
    exit;

} else if ( $password !== $confirm_password) {
    $_SESSION["error"] = "Your passwords do not match.";
    // redirect to signup page
    header("Location: /manage-doctors-add-user");
    exit;

} else {
    // get user data by email
    $user = getUserByEmail($email);
    
    if ($user){
        $_SESSION["error"] = "The email provided already exists in our system.";
        // redirect to signup page
        header("Location: /manage-doctors-add-user");
        exit;

    } else {
        $sql = "INSERT INTO users (`name`, `email`, `password`, `role`) VALUES (:name, :email, :password, :role)";

        $query = $database->prepare($sql);

        $query->execute([
            "name" => $name,
            "email" => $email,
            "password" => password_hash($password, PASSWORD_DEFAULT),
            "role" => $role
        ]);
        
        // set success message
        $_SESSION["success"] = "Account created successfully. Please redirect to enter doctor information.";
        header("Location: /doctor/redirect?email=" . $email);
        exit;
    }
}