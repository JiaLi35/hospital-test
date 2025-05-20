<?php 

$database = connectToDB();

$email = $_GET["email"];

$sql = "SELECT * FROM users WHERE email = :email";

$query = $database->prepare($sql);

$query->execute([
    "email" => $email
]);

$user = $query->fetch();
?>

<?php require "parts/header.php"; ?>

    <div class="card mb-2 p-4">
        <!-- display success message -->
        <?php require "parts/message_success.php"; ?> 
        <a
        href="/manage-doctors-add-info?id=<?= $user["id"]; ?>"
        class="btn btn-primary"
        >Redirect</a>
    </div>

<?php require "parts/footer.php"; ?>