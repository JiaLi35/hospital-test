<?php

$id = $_GET["id"];

  if (!isAdmin() && $_SESSION["user"]["id"] != $id) {
    header("Location: /");
    exit;
  }

  if (isDoctor()){
    $doctor = GetDoctorByUID($id);
  } else {
    $patient = GetPatientByUID($id);
  }
  
?>

<?php require "parts/header.php"; ?>

    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Change Password</h1>
      </div>
      <div class="card mb-2 p-4">
        <?php require "parts/message_success.php"; ?>
        <?php require "parts/message_error.php"; ?>
        <form method="POST" action="/user/changepwd">
          <div class="mb-3">
            <div class="row">
              <div class="col">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password"/>
              </div>
              <div class="col">
                <label for="confirm-password" class="form-label"
                  >Confirm Password</label
                >
                <input
                  type="password"
                  class="form-control"
                  id="confirm-password"
                  name="confirm_password"
                />
              </div>
            </div>
          </div>
          <div class="d-grid">
            <!-- pass the id to the action route of changing password -->
            <input type="hidden" name="id" value="<?= $_GET["id"]; ?>">
            <button type="submit" class="btn btn-primary">
              Change Password
            </button>
          </div>
        </form>
      </div>
      <div class="text-center">
        <?php if (isAdmin()) : ?>
        <a href="/manage-users" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Users</a
        >
        <?php elseif (isDoctor()) : ?>
          <a href="/doctor/dashboard?id=<?= $doctor["id"]; ?>" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Profile</a
        >
        <?php else : ?>
          <a href="/patient/dashboard?id=<?= $patient["id"]; ?>" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Profile</a
        >
        <?php endif; ?>
      </div>
    </div>

<?php require "parts/footer.php"; ?>
