<?php 

  if (isset($_GET["filter"]) === true) {
      $filter_keyword = $_GET["filter"];

      // TODO: 1. connect to database
      $database = connectToDB();
      // TODO: 2. get all the users
      $sql = "SELECT * FROM doctors WHERE specialty = :keyword";
      // TODO: 2.2
      $query = $database->prepare( $sql );
      // TODO: 2.3
      $query->execute([
        "keyword" => $filter_keyword
      ]);
      // TODO: 2.4 fetch
      $doctors = $query->fetchAll(); // get only the first row of the match data
  } else {
      // TODO: 1. connect to database
      $database = connectToDB();
      // TODO: 2. get all the users
      $sql = "SELECT * FROM doctors";
      // TODO: 2.2
      $query = $database->prepare( $sql );
      // TODO: 2.3
      $query->execute();
      // TODO: 2.4 fetch
      $doctors = $query->fetchAll(); // get only the first row of the match data
  }

  if(isUserLoggedIn()){
    $user = GetUserDetailsByUID($_SESSION["user"]["id"]);
  }
  
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
            <a class="nav-link"
             href="/">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/find-doctor">Find a Doctor</a>
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

<div class="row gap-0 m-0 p-0">
  <div class="col-6 m-0 p-0">
    <img src="https://www.pantai.com.my/images/pantaihospitalmalaysialibraries/doctors/doctor-banner.webp?Status=Master" style="width:50vw; height:40vh; object-fit:cover;">
  </div>
  <div class="col-6 m-0 p-0">
    <h1 class="d-flex align-items-center h-100 p-3 bg-white">Find a Doctor</h1>
  </div>
</div>

<!-- navbar end -->
<main class="d-flex ">  
  <!-- sidebar -->
  <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 280px;">
      <!-- filter specialty button start -->
      <div class="text-center">
          <h2 class="text-primary my-5">Search</h2>
          <form method="GET" action="/find-doctor" class="d-flex justify-content-center gap-3 flex-column">
            <?php if (isset($_GET["filter"]) === true) : ?>
            <select name="filter">
                <option selected disabled hidden>Select a Specialty</option>
                <option value="Cardiologist" <?= ($filter_keyword === "Cardiologist" ? "selected" : ""); ?>>Cardiologist</option>
                <option value="Surgeon" <?= ($filter_keyword === "Surgeon" ? "selected" : ""); ?>>Surgeon</option>
                <option value="Physician" <?= ($filter_keyword === "Physician" ? "selected" : ""); ?>>Physician</option>
                <option value="Internal Medicine" <?= ($filter_keyword === "Internal Medicine" ? "selected" : ""); ?>>Internal Medicine</option>
            </select>
            <?php else : ?>
            <select name="filter">
                <option selected disabled hidden>Select a Specialty</option>
                <option value="Cardiologist">Cardiologist</option>
                <option value="Surgeon">Surgeon</option>
                <option value="Physician">Physician</option>
                <option value="Internal Medicine">Internal Medicine</option>
            </select>
            <?php endif; ?>
          <button class="btn btn-sm btn-primary">Sort</button>
          <a href="/find-doctor" class="btn btn-dark">Reset</a>
        </form>
      </div>
      <!-- filter specialty button end -->
    </div>
  <!-- sidebar end -->

  <div class="container my-4">
    <div class="row">
      <?php foreach ($doctors as $index => $doctor) : ?>
        <!-- column start -->
          <div class="col-6">
            <!-- card start -->
            <div class="card mb-4 p-3 shadow-sm">
              <div class="row">
                <div class="col-4">
                <?php if (!empty($doctor["image"])) : ?>
                  <img src="<?= $doctor["image"]; ?>" class="mx-auto rounded-5" style="width:200px; height:200px; object-fit:cover">
                <?php endif; ?>
                </div>
                <!-- card body start -->
                <div class="col-8 ps-4">
                <div class="card-body">
                  <h5 class="card-title"><?= $doctor["name"]; ?></h5>
                  <p class="card-text"><?= $doctor["specialty"]; ?></p>
                  <div class="d-flex justify-content-center mt-5 gap-2">
                    <a href="/doctor?id=<?=$doctor["id"]?>" class="btn btn-primary btn-sm align-items-center justify-content-center d-flex flex-fill"><i class="bi bi-person-circle fs-4 mx-2"></i>Profile</a>
                    <a href="/patient/book-appointments?id=<?=$doctor["id"]?>" class="btn btn-success btn-sm align-items-center justify-content-center d-flex flex-fill"><i class="bi bi-calendar fs-4 mx-2"></i>Book Appointment</a>
                  </div>
                </div>
                </div>
                <!-- card body end -->
              </div>
            </div>
            <!-- card end -->
          </div>
          <!-- column end -->
      <?php endforeach; ?>
    </div>
  </div>
</main>
<footer class="p-3 bg-white d-flex justify-content-center h-100 align-items-center">
    <p class="m-0"> © Jia Li 2025 </p>
</footer>
<?php require "parts/footer.php"; ?>