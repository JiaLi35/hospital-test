<?php 
if (!isDoctor() ){
  header("Location: /");
  exit;
}

  // TODO: 1. connect to database
  $database = connectToDB();
  // TODO: 2. get all the users
    // get id from the url 
  $id = $_GET["id"];
  // TODO: 2.1
  $sql = "SELECT * FROM appointments WHERE id = :id";
  // TODO: 2.2
  $query = $database->prepare( $sql );
  // TODO: 2.3
  $query->execute([
    "id" => $id
  ]);
  // TODO: 2.4 fetch
  $appointment = $query->fetch(); // get only the first row of the match data
?>

<?php require "parts/header.php"; ?>
<!-- navbar start -->
<nav class="navbar bg-white">
  <div class="container-fluid">
    <a class="navbar-brand" href="/doctor/manage-appointments?id=<?=$appointment["doctor_id"];?>">
      <i class="bi bi-arrow-left mx-3"></i>Back
    </a>
  </div>
</nav>
<!-- navbar end -->

<div class="container mx-auto my-5 p-5" >
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Reschedule Appointment</h1>
      </div>
      <div class="card mb-2 p-4">
        <form method="POST" action="/appointment/edit">  
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
                <input type="text" class="form-control" id="doctor_name" name="doctor_name" value="<?= $appointment["doctor_name"]; ?>" disabled/>
              </div>
              <div class="col">
                <label for="specialty" class="form-label">Specialty</label>
                <input type="text" class="form-control" id="specialty" name="specialty" value="<?= $appointment["specialty"]; ?>" disabled/>
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
                <input 
                    type="date" 
                    class="form-control" 
                    id="date" 
                    name="date" 
                    min="<?= date("Y-m-d", strtotime('tomorrow'));?>" 
                    max="<?= date("Y-m-d", strtotime('+1 year'));?>" 
                    value="<?= $appointment["date"]; ?>"
                />
              </div>
              <div class="col">
                <label for="time" class="form-label">Select a Time</label>
                <select id="time" class="form-control" name="time">
                  <option value="9:00:00" <?= ($appointment["time"] === "9:00:00" ? "selected" : ""); ?>>9:00</option>
                  <option value="9:30:00" <?= ($appointment["time"] === "9:30:00" ? "selected" : ""); ?>>9:30</option>
                  <option value="10:00:00" <?= ($appointment["time"] === "10:00:00" ? "selected" : ""); ?>>10:00</option>
                  <option value="10:30:00" <?= ($appointment["time"] === "10:30:00" ? "selected" : ""); ?>>10:30</option>
                  <option value="11:00:00" <?= ($appointment["time"] === "11:00:00" ? "selected" : ""); ?>>11:00</option>
                  <option value="11:30:00" <?= ($appointment["time"] === "11:30:00" ? "selected" : ""); ?>>11:30</option>
                  <option value="12:00:00" <?= ($appointment["time"] === "12:00:00" ? "selected" : ""); ?>>12:00</option>
                  <option value="13:00:00" <?= ($appointment["time"] === "13:00:00" ? "selected" : ""); ?>>13:00</option>
                  <option value="13:30:00" <?= ($appointment["time"] === "13:30:00" ? "selected" : ""); ?>>13:30</option>
                  <option value="14:00:00" <?= ($appointment["time"] === "14:00:00" ? "selected" : ""); ?>>14:00</option>
                  <option value="14:30:00" <?= ($appointment["time"] === "14:30:00" ? "selected" : ""); ?>>14:30</option>
                  <option value="15:00:00" <?= ($appointment["time"] === "15:00:00" ? "selected" : ""); ?>>15:00</option>
                  <option value="15:30:00" <?= ($appointment["time"] === "15:30:00" ? "selected" : ""); ?>>15:30</option>
                  <option value="16:00:00" <?= ($appointment["time"] === "16:00:00" ? "selected" : ""); ?>>16:00</option>
                  <option value="16:30:00" <?= ($appointment["time"] === "16:30:00" ? "selected" : ""); ?>>16:30</option>
                  <option value="17:00:00" <?= ($appointment["time"] === "17:00:00" ? "selected" : ""); ?>>17:00</option>
                </select>
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
                <input type="text" class="form-control" id="patient_name" name="patient_name" value="<?= $appointment["patient_name"]; ?>" disabled/>
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
                  value="<?= $appointment["ic"]; ?>"
                  disabled
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
                  value="<?= $appointment["phone_number"]; ?>"
                  disabled
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
                  value="<?= $appointment["email"]; ?>"
                  disabled
                />
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-control" id="gender" name="gender" disabled> 
                <option value="female" <?= ($appointment["gender"] === "female" ? "selected" : ""); ?>>Female</option>
                <option value="male" <?= ($appointment["gender"] === "male" ? "selected" : ""); ?>>Male</option>
            </select>
          </div>
          <!-- patient's info end -->
          <div class="d-grid">
            <input type="hidden" name="id" value="<?= $appointment["id"]; ?>">
            <input type="hidden" name="doctor_id" value="<?= $appointment["doctor_id"]; ?>">
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
      </div>
      <div class="text-center">
        <a href="/doctor/manage-appointments?id=<?= $appointment['doctor_id']; ?>" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Doctors</a
        >
      </div>
    </div>

<?php require "parts/footer.php"; ?>