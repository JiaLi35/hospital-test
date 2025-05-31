<?php 

  // TODO: 1. connect to database
  $database = connectToDB();
  // TODO: 2. get all the users
  $sql = "SELECT * FROM doctors";
  // TODO: 2.2
  $query = $database->prepare( $sql );
  // TODO: 2.3
  $query->execute();
  // TODO: 2.4 fetch
  $doctors = $query->fetchAll(); // get only the first row of the match data
?>

<?php require "parts/header.php"; ?>
<div class="text-center my-3">
    <h1> Find a Doctor </h1> 
    <select>
        <option value="Cardiologist">Cardiologist</option>
        <option value="Surgeon">Surgeon</option>
    </select>
</div>
<div class="container my-4">
    <div class="row">
<?php foreach ($doctors as $index => $doctor) : ?>
    <div class="col-4">
      <div class="card mb-2">
          <?php if (!empty($doctor["image"])) : ?>
            <img src="<?= $doctor["image"]; ?>" class="card-image-top" style="width:200px; height:200px;">
          <?php endif; ?>
        <div class="card-body">
          <h5 class="card-title"><?= $doctor["name"]; ?></h5>
          <p class="card-text"><?= $doctor["specialty"]; ?></p>
          <div class="text-end">
            <a href="/doctor?id=<?=$doctor["id"]?>" class="btn btn-success btn-sm">Profile</a>
            <a href="/patient/book-appointments?id=<?=$doctor["id"]?>" class="btn btn-primary btn-sm">Book Appointment</a>
          </div>
        </div>
      </div>
          </div>
      <?php endforeach; ?>
          </div>
          </div>