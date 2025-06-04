<?php
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
<div class="container my-5 text-center" style="max-width: 500px;">
    <div class="card p-5">
        <h1 class="my-5 border-bottom border-primary pb-3"> Appointment Details </h1> 
        <h3 class="my-3"> Doctor's Info </h3> 
            <div class="row">
                <div class="col">
                    <p class="mb-4">Doctor Name: <?= $appointment["doctor_name"]; ?></p>
                </div>
                <div class="col">
                    <p class="mb-4">Specialty: <?= $appointment["specialty"]; ?></p>
                </div>
            </div>
        <hr> 
        <h3 class="my-3"> Scheduled Date & Time </h3> 
        <div class="row">
            <div class="col">
                <p class="mb-4">Date: <?= $appointment["date"]; ?></p>
            </div>
            <div class="col">
                <?php
                    $apt_time = explode( ":", $appointment["time"] );

                    $time = $apt_time[0] . ":" . $apt_time[1];
                ?>
                <p class="mb-4">Time: <?= $time; ?></p>
            </div>
        </div>
        <hr> 
        <h3 class="my-3"> Patient's Info </h3> 
            <div class="row">
                <div class="col">
                    <p class="mb-4">Patient Name: <?= $appointment["patient_name"]; ?></p>
                </div>
                <div class="col">
                    <p class="mb-4">NRIC No.: <?= $appointment["ic"]; ?></p>
                </div>
                <div class="col">
                    <p class="mb-4">Phone Number: <?= $appointment["phone_number"]; ?></p>
                </div>
                <div class="col">
                    <p class="mb-4">Email: <?= $appointment["email"]; ?></p>
                </div>
                <div class="col">
                    <p class="mb-4">Gender: <?= $appointment["gender"]; ?></p>
                </div>
            </div>
        <hr> 
    </div>
      <div class="text-center mt-3">
        <a href="/patient/manage-appointments?id=<?= $appointment["patient_id"]; ?>" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back</a
        >
      </div>
    </div>
<?php require "parts/footer.php"; ?>