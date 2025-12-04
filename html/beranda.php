<?php
include "db/koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyHero - MLBB Expert System</title>
  <link rel="stylesheet" href="../css/beranda.css?v=1.0">

</head>

<body>

  <!-- NAVBAR -->
  <header class="navbar">
    <div class="logo">
      <img src="../assets/logo.png" alt="logo">
      <span>MyHERO</span>
    </div>

    <nav>
      <a class="active">BERANDA</a>
      <a href="informasi.php">INFORMASI</a>
      <a href="diagnosa.php">DIAGNOSA</a>
      <a href="analisis.php">ANALISIS</a>
      <a href="login.php" class="login-border">LOGIN</a>
    </nav>
  </header>

  <!-- HERO SECTION -->
  <section class="hero">
    <div class="hero-left">
      <h1>
        Find Your Accurate<br>
        Hero <span class="pink">Mobile Legend</span><br>
        <span class="cyan here">Here.</span>
      </h1>

      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut
        labore et dolore magna aliqua.
      </p>

      <a href="diagnosa.php" class="btn-try">LET’S TRY</a>

      <div class="scroll-icon">▾ ▾ ▾</div>
    </div>

    <div class="hero-right">
      <img src="../assets/layyla.png">
    </div>
  </section>

  <!-- WHY CHOOSE US -->
  <section class="why">
    <h2>WHY <span class="pink">CHOOSE US?</span></h2>
    <p class="why-desc">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore.
    </p>

    <div class="why-cards">
      <div class="card">
        <img src="../assets/selena2.png">
        <h3>KELEBIHAN 1</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>

      <div class="card">
        <img src="../assets/selena2.png">
        <h3>KELEBIHAN 2</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>

      <div class="card">
        <img src="../assets/selena2.png">
        <h3>KELEBIHAN 3</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="footer-top">
      <span class="brand">+ MyHero</span>
    </div>

    <div class="footer-nav">
      <a>HOME</a>
      <a>DIAGNOSE</a>
      <a>HERO</a>
      <a>CONTACT</a>
    </div>

    <p class="copy">© 2025 JoHidayatHan. All Right Reserved</p>
  </footer>

</body>

</html>
