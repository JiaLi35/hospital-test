<?php
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

    <div class="container my-5 d-flex gap-5 align-items-center" style="max-width: 500px;">
        <div>
            <img src="<?= $doctor["image"]; ?>" class="img-fluid">
        </div>
        <div class="mx-3 text-center">
            <h1 class="mb-4"><?= $doctor["name"]; ?></h1>
            <h3 class="mb-4"><?= $doctor["specialty"]; ?></h3>
        </div>  
    </div>
    <div class="container card text-center my-3 p-5">
        <h3 class="mb-4">Phone Number: <?= $doctor["phone_number"]; ?></h3>
                <div class="d-flex justify-content-center gap-3">
                    <a href="/patient/book-appointments?id=<?= $doctor["id"]; ?>" class="btn-primary btn btn-sm">Book Appointment</a>
                    <a href="/" class="btn-success btn btn-sm">Email</a>
                </div>
    </div>
    <div class="text-center mt-3">
        <a href="/find-doctor" class="btn btn-link btn-sm">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>


<?php require "parts/footer.php"; ?>
