<?php 

    // start session
    session_start();

    // require the functions file
    require "includes/functions.php";

    // figure out which path the user is on
    $path = $_SERVER["REQUEST_URI"];
    // remove all the query string from the url
    $path = parse_url( $path, PHP_URL_PATH );

switch ($path) {
    // auth routes: 
    case '/login':
        require "pages/login.php";
        break;

    case '/signup':
        require "pages/signup.php";
        break;

    case '/logout':
        require "pages/logout.php";
        break;

    // dashboard routes
    case '/admin/dashboard':
        require "pages/dashboard/dashboard_admin.php";
        break;

    case '/doctor/dashboard':
        require "pages/dashboard/dashboard_doctor.php";
        break;

    case '/patient/dashboard':
        require "pages/dashboard/dashboard_patient.php";
        break;
    
    // manage users (admin)
    case '/manage-users':
        require "pages/users/manage-users.php";
        break;

    case '/manage-users-changepwd':
        require "pages/users/manage-users-changepwd.php";
        break;

    // manage doctors (admin)
    case '/manage-doctors':
        require "pages/doctors/manage-doctors.php";
        break;
    
    case '/manage-doctors-add':
        require "pages/doctors/manage-doctors-add.php";
        break;

    case '/manage-doctors-edit':
        require "pages/doctors/manage-doctors-edit.php";
        break;

    default:
        require "pages/home.php";
        break;
        
    
    // action routes
    case '/auth/login':
        require "includes/auth/do_login.php";
        break;
      
      case '/auth/signup':
        require "includes/auth/do_signup.php";
        break;

    // manage users
        // set up the action route for delete user 
        case '/user/delete':
        require "includes/user/delete.php";
        break;
        
        // set up the action route for edit user 
        case '/user/changepwd':
        require "includes/user/changepwd.php";
        break;    

    // manage doctors
        // set up the action route for add doctor login information into users table
        case '/doctor/add-user':
            require "includes/doctor/add-user.php";
            break;    

        // set up the action route for add doctor information into doctors table
        case '/doctor/add-info':
            require "includes/doctor/add-user.php";
            break;    

        
        // set up the action route for edit doctor information in doctors table
        case '/doctor/edit':
            require "includes/doctor/edit-user.php";
            break;    
}