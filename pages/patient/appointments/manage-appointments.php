<?php

// check if the user is not an admin (must be at very top)
  if( !isUserLoggedIn() ) {
    header("Location: /");
    exit;
  }

  $patient_id = $_GET["id"];

  // TODO: 1. connect to database
  $database = connectToDB();
  // TODO: 2. get all the users
  // TODO: 2.1
  $sql = "SELECT * FROM appointments
          WHERE patient_id = :patient_id AND NOT status = 'Cancelled'
          ORDER BY appointments.id DESC";
  // TODO: 2.2
  $query = $database->prepare( $sql );
  // TODO: 2.3
  $query->execute([
    "patient_id" => $patient_id
  ]);
  // TODO: 2.4
  $appointments = $query->fetchAll();
?>

<?php require "parts/header.php"; ?>
    <div class="container my-5">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Manage Appointments</h1>
        <!-- <div class="text-end"> -->
          <!-- <a href="/manage-doctors-add-user" class="btn btn-primary btn-sm">Book an Appointment</a> -->
        <!-- </div> -->
      </div>
      <div class="card mb-2 p-4">
        <?php require "parts/message_success.php"; ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Doctor name</th>
              <th scope="col">Specialty</th>
              <th scope="col">Date</th>
              <th scope="col">Time</th>
              <th scope="col">Status</th>
              <th scope="col" class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- TODO: 3. use foreach to dsiplay all the users  -->
            <?php foreach ($appointments as $index => $appointment) : ?>
              <tr>
                <th scope="row"><?= $appointment["id"] ?></th>
                <td><?= $appointment["doctor_name"] ?></td>
                <td><?= $appointment["specialty"] ?></td>
                <td><?= $appointment["date"] ?></td>
                <td><?= $appointment["time"] ?></td>
                <?php if ($appointment["status"] === "Pending") : ?>
                    <td><span class="badge bg-warning"><?= $appointment["status"]; ?></span></td>
                <?php elseif ($appointment["status"] === "Scheduled") : ?>
                    <td><span class="badge bg-info"><?= $appointment["status"]; ?></span></td>
                <?php elseif ($appointment["status"] === "Completed") : ?>
                    <td><span class="badge bg-success"><?= $appointment["status"]; ?></span></td>
                <?php endif; ?>


                <td class="text-end">
                  <div class="d-flex justify-content-end">
                    <a href="/"> </a>
                  <!-- Button to trigger cancel confirmation modal -->
                  <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#doctorDeleteModal-<?= $appointment["id"]; ?>">
                  <i class="bi bi-trash"></i>
                  </button>
                  <!-- Modal -->
                  <div class="modal fade" id="doctorDeleteModal-<?= $appointment["id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to cancel this appointment?</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <p>You are tyring to cancel an appointment with Dr. 
                          <br>  
                          <?=$appointment["doctor_name"];?> at <?= $appointment["date"];?>, <?= $appointment["time"];?>
                        </p>
                          <p>This action cannot be reversed.</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <!-- cancel button -->
                          <form method="POST" action="/patient/cancel">
                            <input type="hidden" name="appointment_id" value="<?= $appointment["id"]?>">
                            <input type="hidden" name="patient_id" value="<?= $appointment["patient_id"]?>">
                            <button class="btn btn-danger btn-sm">
                              <i class="bi bi-trash"></i> CONFIRM CANCELLATION
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End of Modal -->
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <div class="text-center">
        <a href="/patient/dashboard?id=<?=$_GET["id"];?>" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Dashboard</a
        >
      </div>
    </div>

<?php require "parts/footer.php"; ?>
