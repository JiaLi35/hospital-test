<?php 
if (!isUserLoggedIn()){
  header("Location: /");
  exit;
}

$id = $_GET["id"];

$user = GetUserDetailsByUID($id);

if ($user["user_id"] !== $_SESSION["user"]["id"]){
  header("Location: /");
  exit;
}
?>

<?php require "parts/header.php"; ?>

<div class="container my-5" >
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Patient's Details</h1>
      </div>
      <div class="card mb-2 p-4">
        <form method="POST" action="/patient/add-info">  
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
                <label for="ic" class="form-label">NRIC no.</label>
                <input 
                  type="number" 
                  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" 
                  maxlength="12" 
                  class="form-control" 
                  id="ic" 
                  name="ic" 
                  placeholder="Enter your IC without the dashes."
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
                  value=60
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
            <label for="gender" class="form-label">Gender</label>
            <select class="form-control" id="gender" name="gender">
              <option value="female">Female</option>
              <option value="male">Male</option>
            </select>
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