<?php

include("../service/database.php");

$sign_up_message = "";
session_start();

if (isset($_SESSION['is_login'])) {
    header('location: ../dashboard.php');
}

if (isset($_POST['sign_up'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    // $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    // $hash_password = hash('sha256', $password);
    $password = $_POST['password'];
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO users (name, email, password) VALUES 
               ('$name', '$email', '$hash_password')";
        if ($db->query($sql)) {
            $_SESSION['status'] = 'Success';
            $_SESSION['message'] = 'Registration successful! Please sign in to continue.';
            header("location: sign_in.php");
        } else {
            $_SESSION['status'] = 'Error';
            $_SESSION['message'] = 'Registration failed. Please try again.';
            // $sign_up_message = "Daftar akun gagal";
        }
    } catch (mysqli_sql_exception) {
        $sign_up_message = "Email already registered!";
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
                <div class="fw-bold fs-3">Getting Started</div>
                <div class="sub-text">Create your account!</div>
            </header>

            <span class="d-block my-2" style="color: #FF2C2C"><?= $sign_up_message ?></span>

            <form action="sign_up.php" method="POST">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-at"></i></span>
                    <input type="text" name="name" required class="form-control sub-text" placeholder="example : user" aria-label="Username" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" name="email" required class="form-control sub-text" placeholder="example : user@gmail.com" aria-label="Email" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" required class="form-control sub-text" placeholder="minimum 8 characters..." aria-label="Password" aria-describedby="basic-addon1">
                </div>


                <div class="d-grid">
                    <button type="submit" name="sign_up" class="btn btn-primary">Sign Up</button>
                </div>
            </form>
            <div class="text-center mt-3">
                Already have account? <a href="sign_in.php">Sign In</a>
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