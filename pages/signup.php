<?php require "parts/header.php"; ?>
<div class="row m-0 p-0">
<div class="col m-0 p-0">
    <img src="https://media.istockphoto.com/id/959978636/photo/a-group-of-young-adults-gathering.jpg?s=612x612&w=0&k=20&c=Z0sUP5sprFB6m8dJejFfCF1X3mKXuBgwMesY4WOiI7k=" style="height:100vh; width:65vw; object-fit:cover;">
  </div>
  <div class="col m-0 p-0 d-flex justify-content-center align-items-center">
    <div class="my-5">
      <h1 class="h1 mb-4 text-center">Register</h1>

        <!-- display error message -->
        <?php require "parts/message_error.php"; ?>

        <form method="POST" action="/auth/signup">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" />
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" />
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input
              type="password"
              class="form-control"
              id="password"
              name="password"
            />
          </div>
          <div class="mb-3">
            <label for="confirm_password" class="form-label"
              >Confirm Password</label
            >
            <input
              type="password"
              class="form-control"
              id="confirm_password"
              name="confirm_password"
            />
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-fu">
              Register
            </button>
          </div>
        </form>

      <!-- links -->
      <div
        class="d-flex justify-content-between align-items-center gap-3 mx-auto pt-3"
      >
        <a href="/" class="text-decoration-none small"
          ><i class="bi bi-arrow-left-circle"></i> Go back</a
        >
        <a href="/login" class="text-decoration-none small"
          >Already have an account? Login here
          <i class="bi bi-arrow-right-circle"></i
        ></a>
      </div>
    </div>
  </div>
</div>

<?php require "parts/footer.php"; ?>