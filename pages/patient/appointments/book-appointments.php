<?php 
if (isDoctor() || isAdmin() || !isUserLoggedIn() ){
  $_SESSION["error"] = "Please create an account first before booking an appointment.";
  header("Location: /signup");
  exit;
}

  // TODO: 1. connect to database
  $database = connectToDB();
  // TODO: 2. get all the users
    // get id from the url 
  $id = $_GET["id"];
  $user_id = $_SESSION["user"]["id"];
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

  $sql = "SELECT * FROM patients WHERE user_id = :user_id";

  $query = $database->prepare($sql);

  $query->execute([
    "user_id" => $user_id
  ]);

  $patient = $query->fetch();
?>

<?php require "parts/header.php"; ?>

<div class="container my-5" >
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Book Appointment</h1>
      </div>
      <div class="card mb-2 p-4">
        <form method="POST" action="/patient/book">  
        <!-- display success message -->
        <?php require "parts/message_success.php"; ?>
        <!-- display error message -->
        <?php require "parts/message_error.php"; ?>      
         <!--doctor's info start  -->
          <div class="mb-4">
            <div class="row">
            <h3>Doctor's Info</h3>
              <div class="col">
                <label for="doctor_name" class="form-label">Name</label>
                <input type="text" class="form-control" id="doctor_name" name="doctor_name" value="<?= $doctor["name"]; ?>"/>
              </div>
              <div class="col">
                <label for="specialty" class="form-label">Specialty</label>
                <input type="text" class="form-control" id="specialty" name="specialty" value="<?= $doctor["specialty"]; ?>" />
              </div>
            </div>
          </div>
          <!-- doctor's info end -->
          <hr>
          <!-- date time start -->
          <div class="mb-4">
            <div class="row">
              <div class="col">
                <label for="date" class="form-label">Select a Date</label>
                <input type="date" class="form-control" id="date" name="date"/>
              </div>
              <div class="col">
                <label for="time" class="form-label">Select a Time</label>
                <input type="time" class="form-control" id="time" name="time"/>
              </div>
            </div>
          </div>
          <!-- date time end -->
          <hr>
          <!-- patient's info start -->
          <div class="mb-3">
            <div class="row">
            <h3>Patient's Info</h3>
              <div class="col">
                <label for="patient_name" class="form-label">Name</label>
                <input type="text" class="form-control" id="patient_name" name="patient_name" value="<?= $patient["name"]; ?>"/>
              </div>
              <div class="col">
                <label for="ic" class="form-label">NRIC no.</label>
                <input type="number" maxlength="12" class="form-control" id="ic" name="ic" value="<?= $patient["ic"]; ?>"/>
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
          <!-- patient's info end -->
          <div class="d-grid">
            <input type="hidden" name="patient_id" value="<?= $patient["id"]; ?>">
            <input type="hidden" name="doctor_id" value="<?= $doctor["id"]; ?>">
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
        </form>
      </div>
      <div class="text-center">
        <a href="/doctor?id=<?= $doctor['id']; ?>" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Doctors</a
        >
      </div>
    </div>

<?php require "parts/footer.php"; ?>