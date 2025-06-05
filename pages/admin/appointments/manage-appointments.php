<?php
// check if the user is not an admin (must be at very top)
  if( !isAdmin() ) {
    header("Location: /");
    exit;
  }

  if (isset($_GET["filter"]) === true) {
    $filter_keyword = $_GET["filter"];

    // TODO: 1. connect to database
    $database = connectToDB();
    // TODO: 2. get all the users
    $sql = "SELECT * FROM appointments 
            WHERE status = :keyword
            ORDER BY appointments.id DESC";
    // TODO: 2.2
    $query = $database->prepare( $sql );
    // TODO: 2.3
    $query->execute([
      "keyword" => $filter_keyword
    ]);
    // TODO: 2.4 fetch
    $appointments = $query->fetchAll(); // get only the first row of the match data
  } else {
    // TODO: 1. connect to database
    $database = connectToDB();
    // TODO: 2. get all the users
    // TODO: 2.1
    $sql = "SELECT * FROM appointments
            ORDER BY appointments.id DESC";
    // TODO: 2.2
    $query = $database->prepare( $sql );
    // TODO: 2.3
    $query->execute();
    // TODO: 2.4
    $appointments = $query->fetchAll();
  }


?>

<?php require "parts/header.php"; ?>
<!-- navbar start -->
<nav class="navbar bg-white">
  <div class="container-fluid">
    <a class="navbar-brand" href="/admin/dashboard">
      <i class="bi bi-arrow-left mx-3"></i>Back
    </a>
  </div>
</nav>
<!-- navbar end -->

    <div class="container my-5">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Manage Appointments</h1>
        <!-- sort start -->
        <form method="GET" action="/manage-appointments" class="d-flex justify-content-center gap-3">
            <?php if (isset($_GET["filter"]) === true) : ?>
            <select name="filter">
                <option selected disabled hidden>Filter by Status</option>
                <option value="Pending" <?= ($filter_keyword === "Pending" ? "selected" : ""); ?>>Pending</option>
                <option value="Scheduled" <?= ($filter_keyword === "Scheduled" ? "selected" : ""); ?>>Scheduled</option>
                <option value="Completed" <?= ($filter_keyword === "Completed" ? "selected" : ""); ?>>Completed</option>
                <option value="Cancelled" <?= ($filter_keyword === "Cancelled" ? "selected" : ""); ?>>Cancelled</option>
            </select>
            <?php else : ?>
            <select name="filter">
                <option selected disabled hidden>Filter by Status</option>
                <option value="Pending">Pending</option>
                <option value="Scheduled">Scheduled</option>
                <option value="Completed">Completed</option>
                <option value="Cancelled">Cancelled</option>
            </select>
            <?php endif; ?>
          <button class="btn btn-sm btn-primary">Sort</button>
          <a href="/manage-appointments" class="btn btn-dark">Reset</a>
        </form>
        <!-- sort end -->
      </div>
      <div class="card mb-2 p-4">
        <?php require "parts/message_success.php"; ?>
        <?php require "parts/message_error.php"; ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Patient name</th>
              <th scope="col">Doctor name</th>
              <th scope="col">Date</th>
              <th scope="col">Time</th>
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
                <td><?= $appointment["doctor_name"] ?></td>
                <td><?= $appointment["date"] ?></td>
                <?php
                    $apt_time = explode( ":", $appointment["time"] );

                    $time = $apt_time[0] . ":" . $apt_time[1];
                ?>
                <td><?= $time; ?></td>
                <?php if ($appointment["status"] === "Pending") : ?>
                    <td><span class="badge bg-warning"><?= $appointment["status"]; ?></span></td>
                <?php elseif ($appointment["status"] === "Scheduled") : ?>
                    <td><span class="badge bg-info"><?= $appointment["status"]; ?></span></td>
                <?php elseif ($appointment["status"] === "Completed") : ?>
                    <td><span class="badge bg-success"><?= $appointment["status"]; ?></span></td>
                <?php else : ?>
                    <td><span class="badge bg-danger"><?= $appointment["status"]; ?></span></td>
                <?php endif; ?>

                <td class="text-end">
                  <div class="d-flex justify-content-end gap-2">
                    <!-- <a href="/preview-appointment?id=<?= $appointment["id"]; ?>" class="btn btn-sm btn-primary" title="Preview"><i class="bi bi-eye"></i></a> -->
                    <!-- Button to trigger cancel confirmation modal -->
                    <button title="Delete" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#doctorDeleteModal-<?= $appointment["id"]; ?>">
                    <i class="bi bi-trash"></i>
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="doctorDeleteModal-<?= $appointment["id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5 text-start" id="exampleModalLabel">
                                Are you sure you want to cancel this appointment?
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">
                                <p>
                                    You are trying to delete an appointment. The appointments status is: <?=$appointment["status"];?>
                                </p>
                                <p>This action cannot be reversed.</p>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <!-- delete button -->
                            <form method="POST" action="/appointment/delete">
                                <input type="hidden" name="appointment_id" value="<?= $appointment["id"]; ?>">
                                <button class="btn btn-danger btn-sm" type="submit">
                                    <i class="bi bi-trash"></i> CONFIRM DELETION
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
    </div>
<?php require "parts/footer.php"; ?>
