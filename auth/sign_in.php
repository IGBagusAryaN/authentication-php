<?php
include('../service/database.php');
session_start();

if (isset($_SESSION['is_login'])) {
    header('location: ../dashboard.php');
}

$status = '';
$message = '';
$icon = '';

if (isset($_SESSION['status'])) {
    $status = $_SESSION['status'];
    $message = $_SESSION['message'];
    $icon = strtolower($_SESSION['status']);

    unset($_SESSION['status']);
    unset($_SESSION['message']);
}


if (isset($_POST['sign_in'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";

    // tampung disini
    $results = $db->query($sql);

    if ($results->num_rows > 0) {
        $data = $results->fetch_assoc();
        $_SESSION['name'] = $data['name'];
        $_SESSION['is_login'] = true;
        $_SESSION['status'] = 'Success';
        $_SESSION['message'] = 'You have successfully logged in.';
        header("location: ../dashboard.php");
    } else {
        // echo "data gaada";
        $_SESSION['status'] = 'Error';
        $_SESSION['message'] = 'Incorrect username or password.';

    }
    $db->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="w-100" style="max-width: 350px;">
            <header class="text-center mb-4">
                <div class="fw-bold fs-3">Sign in to your account!</div>
                <!-- <div class="sub-text">Create your account!</div> -->
            </header>

            <!-- <span class="d-block my-2" style="color: #FF2C2C"><?= $sign_in_message ?></span> -->

            <form action="sign_in.php" method="POST">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" name="email" required class="form-control sub-text" placeholder="example : user@gmail.com" aria-label="Email" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" required class="form-control sub-text" placeholder="minimum 8 characters..." aria-label="Password" aria-describedby="basic-addon1">
                </div>


                <div class="d-grid">
                    <button type="submit" name="sign_in" class="btn btn-primary">Sign In</button>
                </div>
            </form>
            <div class="text-center mt-3">
                Don't have an account yet? <a href="sign_up.php">Sign Up</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        <?php if (!empty($status)): ?>
            Swal.fire({
                title: '<?= $status ?>!',
                text: '<?= $message ?>',
                icon: '<?= $icon ?>',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>
    </script>
</body>

</html>