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

    case '/changepwd':
        require "pages/changepwd.php";
        break;

    case '/find-doctor':
        require "pages/find-doctor.php";
        break;

    case '/doctor':
        require "pages/doctor.php";
        break;

    // admin pages 
        case '/admin/dashboard':
            require "pages/admin/dashboard_admin.php";
            break;

        // manage users
            case '/manage-users':
                require "pages/admin/users/manage-users.php";
                break;

        // manage doctors (admin)
            case '/manage-doctors':
                require "pages/admin/doctors/manage-doctors.php";
                break;
            
            // add doctors login information
            case '/manage-doctors-add-user':
                require "pages/admin/doctors/manage-doctors-add-user.php";
                break;

            // add doctors information
            case '/manage-doctors-add-info':
                require "pages/admin/doctors/manage-doctors-add-info.php";
                break;

            // edit doctors information (in doctors table)
            case '/manage-doctors-edit':
                require "pages/admin/doctors/manage-doctors-edit.php";
                break;
        
        // manage appointments (admin)
            case '/manage-appointments':
                require "pages/admin/appointments/manage-appointments.php";
                break;

    // patient pages
        case '/patient/dashboard':
            require "pages/patient/dashboard_patient.php";
            break;

        // add info page (after sign up)
        case '/manage-profile-add-info':
            require "pages/patient/profile/manage-profile-add-info.php";
            break;

        // profile page
        case '/patient/manage-profile':
            require "pages/patient/profile/manage-profile.php";
            break;
        
        // manage-appointments
        case '/patient/manage-appointments':
            require "pages/patient/appointments/manage-appointments.php";
            break;
        
        // book new appointment
        case '/patient/book-appointments':
            require "pages/patient/appointments/book-appointments.php";
            break;

    // doctor pages   
        case '/doctor/dashboard':
            require "pages/doctor/dashboard_doctor.php";
            break;
            
        // edit profile / personal information
            case '/doctor/manage-profile':
                require "pages/doctor/profile/manage-profile.php";
                break;
        
        // see appointments
            case '/doctor/manage-appointments':
                require "pages/doctor/appointments/manage-appointments.php";
                break;

        // edit appointment date / time page
            case '/doctor/edit-appointments':
                require "pages/doctor/appointments/edit-appointments.php";
                break;
        
    default:
        require "pages/home.php";
        break;
        
    
    // action routes 
        // auth
        case '/auth/login':
            require "includes/auth/do_login.php";
            break;
        
        case '/auth/signup':
            require "includes/auth/do_signup.php";
            break;

        // set up the action route for edit user 
        case '/user/changepwd':
            require "includes/user/changepwd.php";
            break;    

    // admin actions
        // manage users
            // set up the action route for delete user 
            case '/user/delete':
            require "includes/user/delete.php";
            break;

        // manage doctors
            // set up the action route for add doctor login information into users table
            case '/doctor/add-user':
                require "includes/doctor/add-user.php";
                break;    

            // set up the action route for add doctor information into doctors table
            case '/doctor/add-info':
                require "includes/doctor/add-info.php";
                break;    

            // set up the action route for edit doctor information in doctors table
            case '/doctor/edit':
                require "includes/doctor/edit.php";
                break;    

            // set up the action route for edit doctor information in doctors table
            case '/doctor/delete':
                require "includes/doctor/delete.php";
                break;  

            // redirect the info and select doctor's user_id
            case '/doctor/redirect':
                require "includes/doctor/redirect.php";
                break;    
        
        // manage appointments
            // delete appointments
            case '/appointment/delete':
                require "includes/appointment/delete.php";
                break;

    // doctor actions
        // doctor dashboard with id 
        case '/doctor/redirect-dashboard':
            require "includes/doctor/redirect-dashboard.php";
            break;
        
        // doctor confirm appointment / mark appointment as complete
        case '/appointment/confirm':
            require "includes/appointment/confirm.php";
            break;

        // doctor edit appointment date / time
        case '/appointment/edit':
            require "includes/appointment/edit.php";
            break;
    
    // patient actions
        // patient dashboard with id 
            case '/patient/redirect-dashboard':
                require "includes/patient/redirect-dashboard.php";
                break;

        // manage profile
            // add info to profile
            case '/patient/add-info':
                require "includes/patient/add-info.php";
                break;
            
            // edit profile / personal information
            case '/patient/edit':
                require "includes/patient/edit.php";
                break;
        
        // manage appointment
            // book new appointment (post data to database)
            case '/patient/book':
                require "includes/appointment/book.php";
                break;

            // cancel appointment (delete data from database)
            case '/patient/cancel':
                require "includes/appointment/cancel.php";
                break;
}