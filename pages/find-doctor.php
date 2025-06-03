<?php 

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

  if(isUserLoggedIn()){
    $user = GetUserDetailsByUID($_SESSION["user"]["id"]);
  }
  
?>

<?php require "parts/header.php"; ?>

<!-- navbar start -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Real Hospital</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
            <ul class="dropdown-menu">
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

<!-- sort specialty button start -->
<div class="text-center my-3">
  <h1> Find a Doctor </h1> 
    <form method="POST" class="d-flex justify-content-center gap-3">
      <p >Sort by Specialty: </p> 
      <select>
          <option>Select a Specialty</option>
          <option value="Cardiologist">Cardiologist</option>
          <option value="Surgeon">Surgeon</option>
      </select>
    <button class="btn btn-sm btn-primary">Sort</button>
  </form>
</div>
<!-- sort specialty button end -->
 
<div class="container my-4">
  <div class="row">
    <?php foreach ($doctors as $index => $doctor) : ?>
      <!-- column start -->
        <div class="col-4">
          <!-- card start -->
          <div class="card mb-2 p-3">
              <?php if (!empty($doctor["image"])) : ?>
                <img src="<?= $doctor["image"]; ?>" class="mx-auto rounded-5" style="width:200px; height:200px; object-fit:cover">
              <?php endif; ?>
              <!-- card body start -->
              <div class="card-body">
                <h5 class="card-title"><?= $doctor["name"]; ?></h5>
                <p class="card-text"><?= $doctor["specialty"]; ?></p>
                <div class="text-end">
                  <a href="/doctor?id=<?=$doctor["id"]?>" class="btn btn-success btn-sm">Profile</a>
                  <a href="/patient/book-appointments?id=<?=$doctor["id"]?>" class="btn btn-primary btn-sm">Book Appointment</a>
                </div>
              </div>
              <!-- card body end -->
          </div>
          <!-- card end -->
        </div>
        <!-- column end -->
    <?php endforeach; ?>
  </div>
</div>
<?php require "parts/footer.php"; ?>