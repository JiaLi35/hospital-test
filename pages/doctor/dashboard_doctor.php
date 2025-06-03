<?php

// check if the user is not an admin (must be at very top)
  if( !isDoctor() ){
    header("Location: /");
    exit;
  }

  // get id from the url 
  $id = $_GET["id"];

  $doctor = GetDoctorDetailsByID($id);

  if ($doctor["user_id"] !== $_SESSION["user"]["id"]){
    header("Location: /");
    exit;
  }
?>

<?php require "parts/header.php"; ?>

<main class="d-flex vh-100">
<!-- sidebar -->
<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
    <div href="/" class="d-flex align-items-center my-1 link-dark text-decoration-none">
      <i class="bi bi-arrow-left fs-3 me-3 mt-1"></i>
        <a href="/" class="fs-3 text-decoration-none text-black">Home</a>
    </div>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li>
        <a href="/doctor/dashboard?id=<?= $doctor["id"]; ?>" class="nav-link active">
          Dashboard
        </a>
      </li>
      <li>
        <a href="/doctor/manage-profile?id=<?= $doctor["id"]; ?>" class="nav-link link-dark">
          Profile
        </a>
      </li>
      <li>
        <a href="/doctor/manage-appointments?id=<?= $doctor["id"]; ?>" class="nav-link link-dark">
          Appointments
        </a>
      </li>
    </ul>
    <hr>
    <div class="dropdown">
      <span class="d-flex ms-4 align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
        <strong><?=$doctor["name"];?></strong> 
      </span>
      <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
        <li><a class="dropdown-item" href="/logout">Log out</a></li>
      </ul>
    </div>
  </div>
<!-- sidebar end -->

    <div class="container mx-auto my-5" style="max-width: 800px;">
      <h1 class="h1 mb-4 text-center">Doctor Dashboard</h1>
      <?php require "parts/message_success.php"; ?>
      <div class="row">
        <!-- manage profile start -->
        <div class="col">
          <div class="card mb-2">
            <div class="card-body">
              <h5 class="card-title text-center">
                <div class="mb-1">
                  <i class="bi bi-person-circle" style="font-size: 3rem;"></i>
                </div>
                Manage Profile
              </h5>
              <div class="text-center mt-3">
                <a href="/doctor/manage-profile?id=<?=$doctor["id"];?>" class="btn btn-primary btn-sm"
                  >Access</a
                >
              </div>
            </div>
          </div>
        </div>
        <!-- manage profile end -->
        <!-- manage appointments start -->
        <div class="col">
          <div class="card mb-2">
            <div class="card-body">
              <h5 class="card-title text-center">
                <div class="mb-1">
                  <i class="bi bi-calendar-check" style="font-size: 3rem;"></i>
                </div>
                Manage Appointments
              </h5>
              <div class="text-center mt-3">
                <a href="/doctor/manage-appointments?id=<?= $doctor["id"]; ?>" class="btn btn-primary btn-sm"
                  >Access</a
                >
              </div>
            </div>
          </div>
        </div>
        <!-- manage appointments end -->
      </div>
    </div>
</main>
<?php require "parts/footer.php"; ?>
