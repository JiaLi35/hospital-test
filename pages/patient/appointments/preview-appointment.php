<?php

if (isDoctor() || isAdmin() || !isUserLoggedIn() ){
    $_SESSION["error"] = "Please create an account first before booking an appointment.";
    header("Location: /");
    exit;
}

  $id = $_GET["id"];

  // TODO: 1. connect to database
  $database = connectToDB();
  // TODO: 2. get all the users
  // TODO: 2.1
  $sql = "SELECT * FROM appointments
          WHERE id = :id";
  // TODO: 2.2
  $query = $database->prepare( $sql );
  // TODO: 2.3
  $query->execute([
    "id" => $id
  ]);
  // TODO: 2.4
  $appointment = $query->fetch();
?>

<?php require "parts/header.php"; ?>
<!-- navbar start -->
<nav class="navbar bg-white">
  <div class="container-fluid">
    <a class="navbar-brand" href="/patient/manage-appointments?id=<?= $appointment["patient_id"];?>">
      <i class="bi bi-arrow-left mx-3"></i>Back
    </a>
  </div>
</nav>
<!-- navbar end -->
<div class="position-fixed" style="left:5%; bottom:5%; z-index:10">
    <button id="download-btn" class="btn btn-sm btn-primary px-3" title="Download as PDF"><i class="bi bi-download me-2"></i>Download As PDF</button>
</div>
<div class="container my-5 text-center" style="max-width: 700px;">
    <div class="card p-5">
        <h1 class="my-4 border-bottom border-primary pb-3"> Appointment Details </h1> 
        <p> <b>Status:</b> <?=$appointment["status"];?> </p>
        <h3 class="my-3"> Doctor's Info </h3> 
            <div class="row">
                <div class="col">
                    <p class="mb-4"><b>Doctor Name:</b> <?= $appointment["doctor_name"]; ?></p>
                </div>
                <div class="col">
                    <p class="mb-4"><b>Specialty:</b> <?= $appointment["specialty"]; ?></p>
                </div>
            </div>
        <hr> 
        <h3 class="my-3"> Scheduled Date & Time </h3> 
        <div class="row">
            <div class="col">
                <p class="mb-4"><b>Date:</b> <?= $appointment["date"]; ?></p>
            </div>
            <div class="col">
                <?php
                    $apt_time = explode( ":", $appointment["time"] );

                    $time = $apt_time[0] . ":" . $apt_time[1];
                ?>
                <p class="mb-4"><b>Time:</b> <?= $time; ?></p>
            </div>
        </div>
        <hr> 
        <h3 class="my-3"> Patient's Info </h3> 
            <div class="row">
                <div class="col-6">
                    <p class="mb-4"><b>Patient Name:</b> <?= $appointment["patient_name"]; ?></p>
                </div>
                <div class="col-6">
                    <p class="mb-4"><b>NRIC No.:</b> <?= $appointment["ic"]; ?></p>
                </div>
                <div class="col-6">
                    <p class="mb-4"><b>Phone Number:</b> <?= $appointment["phone_number"]; ?></p>
                </div>
                <div class="col-6">
                    <p class="mb-4"><b>Email:</b> <?= $appointment["email"]; ?></p>
                </div>
                <div class="col text-center">
                    <p class="mb-4"><b>Gender:</b> <?= $appointment["gender"]; ?></p>
                </div>
            </div>
        <hr> 
    </div>
</div>
<?php require "parts/footer.php"; ?>