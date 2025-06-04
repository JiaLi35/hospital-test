<?php 
if (isDoctor() || isAdmin() || !isUserLoggedIn() ){
  $_SESSION["error"] = "Please create an account first before booking an appointment.";
  header("Location: /signup");
  exit;
}
    // get id from the url 
  $id = $_GET["id"];
  $user_id = $_SESSION["user"]["id"];

  $doctor = GetDoctorDetailsByID($id); 

  $patient = GetPatientByUID($user_id);
?>

<?php require "parts/header.php"; ?>

<div class="container mx-auto my-5 p-5" >
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
                <input type="text" class="form-control" id="doctor_name" name="doctor_name" value="<?= $doctor["name"]; ?>" readonly/>
              </div>
              <div class="col">
                <label for="specialty" class="form-label">Specialty</label>
                <input type="text" class="form-control" id="specialty" name="specialty" value="<?= $doctor["specialty"]; ?>" readonly/>
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
                />
              </div>
              <div class="col">
                <label for="time" class="form-label">Select a Time</label>
                <select id="time" class="form-control" name="time">
                  <option value="9:00">9:00</option>
                  <option value="9:30">9:30</option>
                  <option value="10:00">10:00</option>
                  <option value="10:30">10:30</option>
                  <option value="11:00">11:00</option>
                  <option value="11:30">11:30</option>
                  <option value="12:00">12:00</option>
                  <option value="13:00">13:00</option>
                  <option value="13:30">13:30</option>
                  <option value="14:00">14:00</option>
                  <option value="14:30">14:30</option>
                  <option value="15:00">15:00</option>
                  <option value="15:30">15:30</option>
                  <option value="16:00">16:00</option>
                  <option value="16:30">16:30</option>
                  <option value="17:00">17:00</option>
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
                <input type="text" class="form-control" id="patient_name" name="patient_name" value="<?= $patient["name"]; ?>"/>
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