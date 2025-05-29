<?php require "parts/header.php"; ?>
<div class="container card mt-3">
    <h1> Hospital Management System </h1> 
    <?php require "parts/message_success.php"; ?>
    <?php if ( isUserLoggedIn() ) : ?>
        <div class="d-flex justify-content-center">
            <a href="/logout" class="btn btn-link btn-sm">Logout</a>
            <?php if(isAdmin()) : ?>
                <a href="/admin/dashboard" class="btn btn-link btn-sm">Access the Dashboard</a>
            <?php elseif (isDoctor()) : ?>
                <a href="/doctor/redirect-dashboard" class="btn btn-link btn-sm">Access the Dashboard</a>
            <?php else : ?>
                <a href="/patient/redirect-dashboard" class="btn btn-link btn-sm">Access the Dashboard</a>
            <?php endif; ?>
        </div>
    <?php else : ?>
        <div class="d-flex justify-content-center">
            <a href="/login" class="btn btn-link btn-sm">Login</a>
            <a href="/signup" class="btn btn-link btn-sm">Sign Up</a>
        </div>
    <?php endif; ?>
</div>
<?php require "parts/footer.php"; ?>