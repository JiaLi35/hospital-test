<?php

// check if the user is not an admin (must be at very top)
  if( !isAdmin() ){
    header("Location: /");
    exit;
  }

  $id = $_GET["id"];

  $user = GetUserDetailsByUID($id);

?>

<?php require "parts/header.php"; ?>

<div class="container my-5" >
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Doctor's Details</h1>
      </div>
      <div class="card mb-2 p-4">
        <form method="POST" action="/doctor/add-info" enctype="multipart/form-data">  
        <!-- display success message -->
        <?php require "parts/message_success.php"; ?>
        <!-- display error message -->
        <?php require "parts/message_error.php"; ?>       
          <div class="mb-3">
            <div class="row">
              <div class="col">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $user["name"]; ?>"/>
              </div>
              <div class="col">
                <label for="specialty" class="form-label">Specialty</label>
                <input type="text" class="form-control" id="specialty" name="specialty" />
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
                <label for="email" class="form-label"
                  >Email</label
                >
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  name="email"
                  value="<?= $user["email"]; ?>"
                />
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="biography" class="form-label">Biography</label>
            <textarea class="form-control" id="biography" rows="5" name="biography"></textarea>
          </div>
          <div>
            <input type="file" name="image" accept="image/*">
          </div>
          <div class="d-grid">
            <input type="hidden" name="user_id" value="<?= $user["id"]; ?>">
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
        </form>
      </div>
      <div class="text-center">
        <a href="/manage-doctors" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Doctors</a
        >
      </div>
    </div>

<?php require "parts/footer.php"; ?>