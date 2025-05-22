<?php 
if (!isDoctor()){
  header("Location: /");
  exit;
}
?>

<?php require "parts/header.php"; ?>
    <div class="container mx-auto my-5" style="max-width: 800px;">
      <h1 class="h1 mb-4 text-center">Dashboard</h1>
      <?php require "parts/message_success.php"; ?>
      <div class="row">
        <!-- manage profile start -->
        <div class="col">
          <div class="card mb-2">
            <div class="card-body">
              <h5 class="card-title text-center">
                <div class="mb-1">
                  <i class="bi bi-person-circle" style="font-size: 3rem;"></i>
                </div>
                Manage Profile
              </h5>
              <div class="text-center mt-3">
                <a href="/doctor/manage-profile?id=<?=$_SESSION["user"]["id"]?>" class="btn btn-primary btn-sm"
                  >Access</a
                >
              </div>
            </div>
          </div>
        </div>
        <!-- manage profile end -->
        <!-- manage appointments start -->
        <div class="col">
          <div class="card mb-2">
            <div class="card-body">
              <h5 class="card-title text-center">
                <div class="mb-1">
                  <i class="bi bi-calendar-check" style="font-size: 3rem;"></i>
                </div>
                Manage Appointments
              </h5>
              <div class="text-center mt-3">
                <a href="/" class="btn btn-primary btn-sm"
                  >Access</a
                >
              </div>
            </div>
          </div>
        </div>
        <!-- manage appointments end -->
      </div>

      <div class="mt-4 text-center">
        <a href="/" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Return To Home</a
        >
      </div>
    </div>

<?php require "parts/footer.php"; ?>
