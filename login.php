<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Kangcetak</title>
  <?php
    echo "<link rel='stylesheet' type='text/css' href='Style/style.css'>";
  ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="login-bg">
  <div class="login-container">
    <div class="login-left">
      <div class="login-motif">
        <svg width="100%" height="100%" viewBox="0 0 350 600" fill="none" xmlns="http://www.w3.org/2000/svg">
          <rect width="350" height="600" fill="#7b263a"/>
          <polygon points="0,0 350,0 0,350" fill="#b85c4a"/>
          <polygon points="0,600 350,600 350,250" fill="#b85c4a"/>
        </svg>
      </div>
      <div class="login-tabs">
        <button class="login-tab-active">LOGIN</button>
        <span class="login-tab-inactive">SIGN IN</span>
      </div>
    </div>
    <div class="login-right">
      <img src="Assets/logo.png" alt="Logo Kangcetak" class="login-logo">
      <h1 class="login-title">KANGCETAK</h1>
      <h2 class="login-subtitle">LOGIN</h2>
      <form class="login-form" method="POST" action="login.php">
        <div class="login-input-group">
          <i class="fa fa-user login-icon"></i>
          <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="login-input-group">
          <i class="fa fa-lock login-icon"></i>
          <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="login-forgot">
          <a href="#">Forgot Password?</a>
        </div>
        <button type="submit" class="login-btn">LOGIN</button>
        <div class="login-register">
          <span>Belum punya akun?</span> <a href="register.php">Daftar</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html> 