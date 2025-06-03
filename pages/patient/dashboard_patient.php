<?php 
if (!isUserLoggedIn()){
  header("Location: /");
  exit;
}

$id = $_GET["id"];

$patient = GetPatientDetailsByID($id);

if ($patient["user_id"] !== $_SESSION["user"]["id"]){
  header("Location: /");
  exit;
}

?>

<?php require "parts/header.php"; ?>

<main class="d-flex vh-100">
<!-- sidebar -->
<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
    <div class="d-flex align-items-center my-1 link-dark text-decoration-none">
        <a href="/" class="fs-3 text-decoration-none text-black"> <i class="bi bi-arrow-left fs-4"></i> Home</a>
    </div>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li>
        <a href="/patient/dashboard?id=<?= $patient["id"]; ?>" class="nav-link active">
          Your Profile
        </a>
      </li>
      <li>
        <a href="/find-doctor" class="nav-link link-dark">
          Find a Doctor
        </a>
      </li>
      <li>
        <a href="/patient/manage-appointments?id=<?= $patient["id"]; ?>" class="nav-link link-dark">
          Appointments
        </a>
      </li>
    </ul>
    <hr>
    <div class="dropdown">
      <span class="d-flex ms-4 align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
        <strong><?=$patient["name"];?></strong> 
      </span>
      <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
        <li><a class="dropdown-item" href="/logout">Log out</a></li>
      </ul>
    </div>
  </div>
<!-- sidebar end -->

<div class="container my-5" >
    <div class="d-flex justify-content-between align-items-center mb-2">
      <h1 class="h1">Patient profile</h1>
    </div>
    <!-- display success message -->
    <?php require "parts/message_success.php"; ?>
    <!-- display error message -->
    <?php require "parts/message_error.php"; ?>

    <div class="card mb-2 p-4">
      <form method="POST" action="/patient/edit">        
        <div class="mb-3">
          <div class="row">
            <div class="col">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" value="<?= $patient["name"]; ?>"/>
            </div>
            <div class="col">
              <label for="ic" class="form-label">NRIC no.</label>
              <input 
                type="number" 
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" 
                maxlength="12" 
                class="form-control" 
                id="ic" 
                name="ic" 
                value="<?= $patient["ic"]; ?>"
              />
            </div>
          </div>
        </div>
        <div class="mb-3">
          <div class="row">
            <div class="col">
              <label for="phone_number" class="form-label">Phone Number</label>
              <input 
                  type="number" 
                  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" 
                  maxlength="11" 
                  class="form-control" 
                  id="phone_number" 
                  name="phone_number" 
                  value="<?= $patient["phone_number"]; ?>"
                />
            </div>
            <div class="col">
              <label for="email" class="form-label"
                >Email</label
              >
              <input
                type="email"
                class="form-control"
                id="email"
                name="email"
                value="<?= $patient["email"]; ?>"
              />
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="gender" class="form-label">Gender</label>
          <select class="form-control" id="gender" name="gender">
            <option value="female" <?= ($patient["gender"] === "female" ? "selected" : ""); ?>>Female</option>
            <option value="male" <?= ($patient["gender"] === "male" ? "selected" : ""); ?>>Male</option>
          </select>
        </div>
        <div class="d-grid">
          <input type="hidden" name="id" value="<?= $patient["id"]; ?>">
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</main>
<?php require "parts/footer.php"; ?>
