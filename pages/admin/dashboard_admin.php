<?php 
if (!isUserLoggedIn() || !isAdmin()){
  header("Location: /");
  exit;
}
?>

<?php require "parts/header.php"; ?>
    <div class="container mx-auto my-5" style="max-width: 800px;">
      <h1 class="h1 mb-4 text-center">Dashboard</h1>
      <?php require "parts/message_success.php"; ?>
      <div class="row">
      <div class="col">
          <div class="card mb-2">
            <div class="card-body">
              <h5 class="card-title text-center">
                <div class="mb-1">
                  <i class="bi bi-pencil-square" style="font-size: 3rem;"></i>
                </div>
                Manage Appointments
              </h5>
              <div class="text-center mt-3">
                <a href="/manage-appointments" class="btn btn-primary btn-sm"
                  >Access</a
                >
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card mb-2">
            <div class="card-body">
              <h5 class="card-title text-center">
                <div class="mb-1">
                  <i class="bi bi-pencil-square" style="font-size: 3rem;"></i>
                </div>
                Manage Doctors
              </h5>
              <div class="text-center mt-3">
                <a href="/manage-doctors" class="btn btn-primary btn-sm"
                  >Access</a
                >
              </div>
            </div>
          </div>
        </div>
        <!-- only show this to admin only -->
        <div class="col">
          <div class="card mb-2">
            <div class="card-body">
              <h5 class="card-title text-center">
                <div class="mb-1">
                  <i class="bi bi-people" style="font-size: 3rem;"></i>
                </div>
                Manage Users
              </h5>
              <div class="text-center mt-3">
                <a href="/manage-users" class="btn btn-primary btn-sm"
                  >Access</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-4 text-center">
        <a href="/" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Return To Home</a
        >
      </div>
    </div>

<?php require "parts/footer.php"; ?>
