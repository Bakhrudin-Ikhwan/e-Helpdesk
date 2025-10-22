<?php 
session_start(); 

if(isset($_POST['login'])) {
  $u = $_POST['username']; 
  $p = $_POST['password']; 

  // Data user dan role
  $users = [
    'aan' => ['password' => 'sayatampan', 'role' => 'super'],
    'tyo' => ['password' => 'mbahtyo1', 'role' => 'facility'],
    'edi' => ['password' => 'abahedi1', 'role' => 'facility'],
    'rochim' => ['password' => 'penasehat1', 'role' => 'facility']
  ];

  if(isset($users[$u]) && $users[$u]['password'] === $p) {
    $_SESSION['username'] = $u; 
    $_SESSION['role'] = $users[$u]['role']; 

    header('Location: dashboard.php');
    exit;
  } else {
    $error = 'Invalid username/password';
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
  <link rel="icon" href="alhikmah1.png" type="image/png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Helpdesk - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
      .logo {
        display: block;
        margin: 0 auto 10px auto;
        width: 70px;
        height: 70px;
        object-fit: contain;
      }
      .login-footer {
        text-align: center;
        font-size: 0.85rem;
        color: #6c757d;
        margin-top: 15px;
      }
    </style>
  </head>
  <body class="login-body">
<div class="login-box">
      <img src="../assets/img/alhikmah1.png" alt="Logo" class="logo">
      <h4 class="text-success text-center mb-3">AL Hikmah IIBS Batu</h4>

      <?php if(isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
      <?php endif; ?>

      <form method="post">
        <input name="username" class="form-control mb-2" placeholder="Username" required>
        <input name="password" type="password" class="form-control mb-3" placeholder="Password" required>
        <button class="btn btn-success w-100" name="login" type="submit">Login</button>

        <div class="login-footer">
          <p>© IT - 2025 | e-Helpdesk v1.1</p>
        </div>
      </form>
    </div>
  </body>
</html>
