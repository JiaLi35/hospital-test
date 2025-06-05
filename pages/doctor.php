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

<!-- navbar start -->
<nav class="navbar bg-white">
  <div class="container-fluid">
    <a class="navbar-brand" href="/find-doctor">
      <i class="bi bi-arrow-left mx-3"></i>Back
    </a>
  </div>
</nav>
<!-- navbar end -->

    <div class="container my-5 d-flex gap-5 align-items-center">
        <div >
            <img src="<?= $doctor["image"]; ?>" class="img-fluid rounded-4" style="width:200px; height:300px; object-fit:cover;">
        </div>
        <div class="d-flex justify-content-start flex-column gap-5">
            <div>
                <h1 class="mb-3"><?= nl2br($doctor["name"]); ?></h1>
                <h3 class="mb-3"><?= $doctor["specialty"]; ?></h3>
                <a href="/patient/book-appointments?id=<?= $doctor["id"]; ?>" class="btn-success btn btn-sm fs-5"> <i class="bi bi-calendar"></i>  Book Appointment</a>
            </div>
            <div class="text-start">
                <h3 class="text-start"> Share </h3>
                <div class="d-flex justify-content-start gap-3 fs-4">
                    <a href="mailto:<?=$doctor["email"];?>"><i class="bi bi-envelope-fill"></i></a>
                    <a href="#"><i class="bi bi-twitter"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-whatsapp"></i></a>
                </div> 
            </div>
        </div> 
    </div>
    <div class="container card text-start my-3 p-5">
        <div class="d-flex align-items-center">
            <h3 class="mb-4 me-4"> Phone Number: </h3>
            <p class="fs-5"> <?= nl2br($doctor["phone_number"]) ?> </p>
        </div>
        <div class="d-flex align-items-center">
            <h3 class="mb-4 me-4"> Biography: </h3>
            <p class="fs-5"> <?= nl2br($doctor["biography"]) ?> </p>
        </div>
    </div>


<?php require "parts/footer.php"; ?>
