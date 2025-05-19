<?php

function connectToDB(){
    $host ="127.0.0.1";
    $database_name = "hospital";
    $database_user = "root";
    $database_password = "";

    $database = new PDO(
        "mysql:host=$host;dbname=$database_name",
        $database_user,
        $database_password
    );
    
    return $database;
}

/* 
    get user data by email
    input: $email
    output: $user
*/
function getUserByEmail($email){
    // connect to database
    $database = connectToDB();

    // sql command
    $sql = "SELECT * FROM users WHERE email = :email";

    // prepare
    $query = $database->prepare($sql);

    // execute
    $query->execute([
        "email" => $email
    ]);

    // fetching data 
    $user = $query->fetch();
    
    return $user;
}

// check if user is logged in
function isUserLoggedIn(){
    return isset($_SESSION["user"]);
}

// check if current user is an admin
function isAdmin(){
    // check if user session is set (active) or not 
    if ( isset($_SESSION["user"]) ){
        // check if user role is admin 
        if ($_SESSION["user"]["role"] === "admin"){
            return true;
        } 

    } 

    return false; // still means else return false
}

// check if current user is an doctor
function isDoctor(){
    // check if user session is set (active) or not 
    if ( isset($_SESSION["user"]) ){
        // check if user role is doctor 
        if ($_SESSION["user"]["role"] === "Doctor"){
            return true;
        } 

    } 

    return false; // still means else return false
}