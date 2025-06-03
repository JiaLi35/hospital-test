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

// get user details from user_id 
function GetUserDetailsByUID($id){
  // TODO: 1. connect to database
  $database = connectToDB();
  // TODO: 2.1
  $sql = "SELECT * FROM users WHERE id = :id";
  // TODO: 2.2
  $query = $database->prepare( $sql );
  // TODO: 2.3
  $query->execute([
    "id" => $id
  ]);
  // TODO: 2.4 fetch
  $user = $query->fetch(); // get only the first row of the match data

  return $user;
}

// get patient details from id in url
function GetPatientDetailsByID($id) {

  // TODO: 1. connect to database
  $database = connectToDB();
  // TODO: 2.1
  $sql = "SELECT * FROM patients WHERE id = :id";
  // TODO: 2.2
  $query = $database->prepare( $sql );
  // TODO: 2.3
  $query->execute([
    "id" => $id
  ]);
  // TODO: 2.4 fetch
  $patient = $query->fetch(); // get only the first row of the match data

  return $patient;

}

// get patient details from the user id (useful when no patient id)
function GetPatientByUID($user_id){
    $database = connectToDB();

    $sql = "SELECT * FROM patients WHERE user_id = :user_id";

    $query = $database->prepare($sql);

    $query->execute([
        "user_id" => $user_id
    ]);

    $patient = $query->fetch();

    return $patient;
}

// get doctor by doctor id (from url)
function GetDoctorDetailsByID($id){
  $database = connectToDB();
  // TODO: 2.1
  $sql = "SELECT * FROM doctors WHERE id = :id";
  // TODO: 2.2
  $query = $database->prepare( $sql );
  // TODO: 2.3
  $query->execute([
    "id" => $id
  ]);
  // TODO: 2.4 fetch
  $doctor = $query->fetch(); // get only the first row of the match data

  return $doctor;
}

// get doctor by user id 
function GetDoctorByUID($user_id) {
    // return doctor id with user id 
    $database = connectToDB();

    $sql = "SELECT * FROM doctors WHERE user_id = :user_id";

    $query = $database->prepare($sql);

    $query->execute([
        "user_id" => $user_id
    ]);

    $doctor = $query->fetch();

    return $doctor;
}