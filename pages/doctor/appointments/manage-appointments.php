<?php

// check if the user is not an admin (must be at very top)
  if( !isDoctor() ) {
    header("Location: /");
    exit;
  }

  $doctor_id = $_GET["id"];

  // TODO: 1. connect to database
  $database = connectToDB();
  // TODO: 2. get all the users
  // TODO: 2.1
  $sql = "SELECT * FROM appointments
          WHERE doctor_id = :doctor_id AND NOT status = 'Cancelled'
          ORDER BY appointments.id DESC";
  // TODO: 2.2
  $query = $database->prepare( $sql );
  // TODO: 2.3
  $query->execute([
    "doctor_id" => $doctor_id
  ]);
  // TODO: 2.4
  $appointments = $query->fetchAll();

  $doctor = GetDoctorDetailsByID($doctor_id);

  if ($doctor["user_id"] !== $_SESSION["user"]["id"]){
    header("Location: /");
    exit;
  }
?>

<?php require "parts/header.php"; ?>
<main class="d-flex vh-100">
<!-- sidebar -->
<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
    <div href="/" class="d-flex align-items-center my-1 link-dark text-decoration-none">
      <i class="bi bi-arrow-left fs-3 me-3 mt-1"></i>
        <a href="/" class="fs-3 text-decoration-none text-black">Home</a>
    </div>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li>
        <a href="/doctor/dashboard?id=<?= $doctor["id"]; ?>" class="nav-link link-dark">
          Dashboard
        </a>
      </li>
      <li>
        <a href="/doctor/manage-profile?id=<?= $doctor["id"]; ?>" class="nav-link link-dark">
          Profile
        </a>
      </li>
      <li>
        <a href="/doctor/manage-appointments?id=<?= $doctor["id"]; ?>" class="nav-link active">
          Appointments
        </a>
      </li>
    </ul>
    <hr>
    <div class="dropdown">
      <span class="d-flex ms-4 align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
        <strong><?=$doctor["name"];?></strong> 
      </span>
      <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
        <li><a class="dropdown-item" href="/logout">Log out</a></li>
      </ul>
    </div>
  </div>
<!-- sidebar end -->

    <div class="container my-5">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Manage Appointments</h1>
        <!-- <div class="text-end"> -->
          <!-- <a href="/manage-doctors-add-user" class="btn btn-primary btn-sm">Book an Appointment</a> -->
        <!-- </div> -->
      </div>
      <div class="card mb-2 p-4">
        <?php require "parts/message_success.php"; ?>
        <?php require "parts/message_error.php"; ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Patient name</th>
              <th scope="col">Date</th>
              <th scope="col">Time</th>
              <th scope="col">IC</th>
              <th scope="col">Phone Number</th>
              <th scope="col">Status</th>
              <th scope="col" class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- TODO: 3. use foreach to dsiplay all the users  -->
            <?php foreach ($appointments as $index => $appointment) : ?>
              <tr>
                <th scope="row"><?= $appointment["id"] ?></th>
                <td><?= $appointment["patient_name"] ?></td>
                <td><?= $appointment["date"] ?></td>
                <td><?= $appointment["time"] ?></td>
                <td><?= $appointment["ic"] ?></td>
                <td><?= $appointment["phone_number"] ?></td>
                <?php if ($appointment["status"] === "Pending") : ?>
                    <td><span class="badge bg-warning"><?= $appointment["status"]; ?></span></td>
                <?php elseif ($appointment["status"] === "Scheduled") : ?>
                    <td><span class="badge bg-info"><?= $appointment["status"]; ?></span></td>
                <?php elseif ($appointment["status"] === "Completed") : ?>
                    <td><span class="badge bg-success"><?= $appointment["status"]; ?></span></td>
                <?php endif; ?>

                <td class="text-end">
                  <div class="d-flex justify-content-end gap-2">
                    <!-- confirm appointment button -->
                    <form method="POST" action="/appointment/confirm">
                      <input type="hidden" name="appointment_id" value="<?= $appointment["id"]; ?>" />
                      <input type="hidden" name="doctor_id" value="<?= $appointment["doctor_id"]; ?>" />
                      <input type="hidden" name="status" value="<?= $appointment["status"]; ?>" />
                      <?php if ($appointment["status"] === "Pending") : ?>
                        <button class="btn btn-sm btn-success">Confirm Appointment</button> 
                      <?php elseif ($appointment["status"] === "Scheduled") : ?>
                          <button class="btn btn-sm btn-success">Appointment Completed</button> 
                      <?php endif; ?>
                    </form>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
</main>
<?php require "parts/footer.php"; ?>
