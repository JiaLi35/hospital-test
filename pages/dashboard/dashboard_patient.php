<?php 
if (!isUserLoggedIn()){
  header("Location: /");
  exit;
}
?>

<?php require "parts/header.php"; ?>
<div class="container card">
    <h1> Patient Dashboard </h1> 
    <?php require "parts/message_success.php"; ?>
    <div class="d-flex justify-content-center">
        <a href="/logout" class="btn btn-link btn-sm">Logout</a>
        <a href="/admin/dashboard" class="btn btn-link btn-sm">Go back to home</a>
    </div>
</div>
<?php require "parts/footer.php"; ?>