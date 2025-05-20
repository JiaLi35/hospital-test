<?php

// check if the user is not an admin (must be at very top)
  if( !isAdmin() ){
    header("Location: /");
    exit;
  }

  // TODO: 1. connect to database
  $database = connectToDB();
  // TODO: 2. get all the users
    // get id from the url 
  $id = $_GET["id"];
  // TODO: 2.1
  $sql = "SELECT * FROM doctors WHERE id = :id";
  // TODO: 2.2
  $query = $database->prepare( $sql );
  // TODO: 2.3
  $query->execute([
    "id" => $id
  ]);
  // TODO: 2.4 fetch
  $doctor = $query->fetch(); // get only the first row of the match data
?>
<?php require "parts/header.php"; ?>
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Edit Doctor</h1>
      </div>
      <div class="card mb-2 p-4">
        <?php require "parts/message_error.php"; ?>
        <form method="POST" action="/doctor/edit">
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
                <input type="number" class="form-control" id="phone_number" name="phone_number" value="<?= $doctor["phone_number"]; ?>"/>
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
          <div class="d-grid">
            <input type="hidden" name="id" value="<?= $doctor["id"]; ?>">
            <button type="submit" class="btn btn-primary">Update</button>
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
