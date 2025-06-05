<?php

// check if the user is not an admin (must be at very top)
  if( !isAdmin() ){
    header("Location: /");
    exit;
  }
    
  // get id from the url 
  $id = $_GET["id"];

  $doctor = GetDoctorDetailsByID($id);
?>
<?php require "parts/header.php"; ?>
<!-- navbar start -->
<nav class="navbar bg-white">
  <div class="container-fluid">
    <a class="navbar-brand" href="/manage-doctors">
      <i class="bi bi-arrow-left mx-3"></i>Back
    </a>
  </div>
</nav>
<!-- navbar end -->
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Edit Doctor</h1>
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
                <input type="email" class="form-control" id="email" name="email" value="<?= $doctor["email"]; ?>" readonly/>
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

<?php require "parts/footer.php"; ?>
