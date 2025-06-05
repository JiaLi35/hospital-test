<?php 
if (!isUserLoggedIn() || !isAdmin()){
  header("Location: /");
  exit;
}

$user = GetUserDetailsByUID($_SESSION["user"]["id"]);
?>

<?php require "parts/header.php"; ?>
<!-- navbar start -->
<nav class="navbar navbar-expand-lg bg-white">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Real Hospital</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link" href="/">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/find-doctor">Find a Doctor</a>
        </li>
    <?php if ( isUserLoggedIn() ) : ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $user["name"]; ?>
            </a>
            <ul class="dropdown-menu" style="left:-130%;">
                <li>         
                    <?php if(isAdmin()) : ?>
                        <a href="/admin/dashboard" class="dropdown-item">Access the Dashboard</a>
                    <?php elseif (isDoctor()) : ?>
                        <a href="/doctor/redirect-dashboard" class="dropdown-item">Access the Dashboard</a>
                    <?php else : ?>
                        <a href="/patient/redirect-dashboard" class="dropdown-item">Access the Dashboard</a>
                    <?php endif; ?>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/logout">Logout</a></li>
            </ul>
        </li>
      </ul>
    <?php else : ?>
        <li class="nav-item">
            <a href="/login" class="nav-link">Login</a>
        </li>
    <?php endif; ?>
    </div>
  </div>
</nav>
<!-- navbar end -->

    <div class="container mx-auto my-5" style="max-width: 800px;">
      <h1 class="h1 mb-4 text-center">Dashboard</h1>
      <?php require "parts/message_success.php"; ?>
      <!-- row start -->
      <div class="row">
        <!-- column start -->
        <div class="col">
          <div class="card mb-2">
            <div class="card-body">
              <h5 class="card-title text-center">
                <div class="mb-1">
                  <i class="bi bi-pencil-square" style="font-size: 3rem;"></i>
                </div>
                Manage Appointments
              </h5>
              <div class="text-center mt-3">
                <a href="/manage-appointments" class="btn btn-primary btn-sm"
                  >Access</a
                >
              </div>
            </div>
          </div>
        </div>
        <!-- column end -->
        <!-- column start -->
        <div class="col">
          <div class="card mb-2">
            <div class="card-body">
              <h5 class="card-title text-center">
                <div class="mb-1">
                  <i class="bi bi-pencil-square" style="font-size: 3rem;"></i>
                </div>
                Manage Doctors
              </h5>
              <div class="text-center mt-3">
                <a href="/manage-doctors" class="btn btn-primary btn-sm"
                  >Access</a
                >
              </div>
            </div>
          </div>
        </div>
        <!-- column end -->
        <!-- column start -->
        <div class="col">
          <div class="card mb-2">
            <div class="card-body">
              <h5 class="card-title text-center">
                <div class="mb-1">
                  <i class="bi bi-people" style="font-size: 3rem;"></i>
                </div>
                Manage Users
              </h5>
              <div class="text-center mt-3">
                <a href="/manage-users" class="btn btn-primary btn-sm"
                  >Access</a
                >
              </div>
            </div>
          </div>
        </div>
        <!-- column end -->
      </div>
      <!-- row end -->
    </div>
<?php require "parts/footer.php"; ?>
