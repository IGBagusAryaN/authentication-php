<?php
session_start();

if (isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header('location: index.php');
    exit;
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
   <link rel="stylesheet" href="../styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <div>
    HALO masuk <?= $_SESSION['name'] ?>
    <form action="dashboard.php" method="POST">
      <button type="submit" name="logout">Logout</button>
    </form>
  </div>

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
