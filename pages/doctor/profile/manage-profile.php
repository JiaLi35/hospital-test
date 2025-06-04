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
<main class="d-flex">
<!-- sidebar -->
<div class="d-flex flex-column p-3 bg-light" style="width: 280px;">
    <div href="/" class="d-flex align-items-center my-1 link-dark text-decoration-none">
      <i class="bi bi-arrow-left fs-3 me-3 mt-1"></i>
        <a href="/" class="fs-3 text-decoration-none text-black">Home</a>
    </div>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li>
        <a href="/doctor/dashboard?id=<?= $doctor["id"]; ?>" class="nav-link link-dark">
          Dashboard
        </a>
      </li>
      <li>
        <a href="/doctor/manage-profile?id=<?= $doctor["id"]; ?>" class="nav-link active">
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

    <div class="container my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Edit Profile</h1>
        <a href="/changepwd?id=<?= $_SESSION["user"]["id"]; ?>" class="btn btn-sm btn-warning"><i class="bi bi-key"></i> Change Password </a>
      </div>
      <div class="card mb-2 p-4">
        <?php require "parts/message_error.php"; ?>
        <form method="POST" action="/doctor/edit" enctype="multipart/form-data">
          <div class="mb-3">
            <div class="row">
              <div class="col">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $doctor["name"]; ?>"/>
              </div>
              <div class="col">
                <label for="specialty" class="form-label">Specialty</label>
                <input type="text" class="form-control" id="specialty" name="specialty" value="<?= $doctor["specialty"]; ?>"/>
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
                  value="<?= $doctor["phone_number"]; ?>"
                />
              </div>
              <div class="col">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $doctor["email"]; ?>"/>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="biography" class="form-label">Biography</label>
            <textarea class="form-control" id="biography" rows="5" name="biography"><?=$doctor["biography"];?></textarea>
          </div>
          <!-- update image start -->
          <div class="mb-3">
            <label class="form-label">Image</label>
            <div class="mb-3">
              <img src="/<?= $doctor["image"]; ?>" class="img-fluid">
            </div>
            <input type="file" name="image" accept="image/*">
          </div>
          <!-- update image end -->
          <div class="d-grid">
            <input type="hidden" name="id" value="<?= $doctor["id"]; ?>">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
</main>
<?php require "parts/footer.php"; ?>
