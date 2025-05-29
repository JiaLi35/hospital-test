<?php 
if (!isUserLoggedIn() || isAdmin() || isDoctor()){
  header("Location: /");
  exit;
}

  // TODO: 1. connect to database
  $database = connectToDB();
  // TODO: 2. get all the users
    // get id from the url 
  $id = $_GET["id"];
  // TODO: 2.1
  $sql = "SELECT * FROM patients WHERE id = :id";
  // TODO: 2.2
  $query = $database->prepare( $sql );
  // TODO: 2.3
  $query->execute([
    "id" => $id
  ]);
  // TODO: 2.4 fetch
  $patient = $query->fetch(); // get only the first row of the match data

?>
<?php require "parts/header.php"; ?>

<div class="container my-5" >
    <div class="d-flex justify-content-between align-items-center mb-2">
      <h1 class="h1">Edit Your Details</h1>
    </div>
    <div class="card mb-2 p-4">
      <form method="POST" action="/patient/edit">  
      <!-- display success message -->
      <?php require "parts/message_success.php"; ?>
      <!-- display error message -->
      <?php require "parts/message_error.php"; ?>       
        <div class="mb-3">
          <div class="row">
            <div class="col">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" value="<?= $patient["name"]; ?>"/>
            </div>
            <div class="col">
              <label for="ic" class="form-label">NRIC no.</label>
              <input type="number" class="form-control" id="ic" name="ic" value="<?= $patient["ic"]; ?>"/>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <div class="row">
            <div class="col">
              <label for="phone_number" class="form-label">Phone Number</label>
              <input type="number" class="form-control" id="phone_number" name="phone_number" value="<?= $patient["phone_number"]; ?>"/>
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
    <div class="text-center">
      <a href="/patient/dashboard" class="btn btn-link btn-sm">
        <i class="bi bi-arrow-left"></i> Back to Dashboard
      </a>
    </div>
  </div>

<?php require "parts/footer.php"; ?>