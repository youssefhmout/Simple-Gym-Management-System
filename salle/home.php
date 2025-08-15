<?php
session_start();
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
} else {
  header("Location: login.php");
  exit();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard - GYM Y&J</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background: #f0f0f0;
      color: #333;
      min-height: 100vh;
      width: 100%;
    }

    .navbar {
      width: 100%;
      background-color: #0a2e5d;
      display: flex;
      align-items: center;
      padding: 15px 30px;
      gap: 30px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
      user-select: none;
    }

    .navbar .logo {
      font-size: 1.8rem;
      font-weight: 900;
      color: white;
      letter-spacing: 4px;
      user-select: none;
    }

    .navbar .logo .highlight {
      color: #ffa500;
      font-style: italic;
      text-shadow: 0 0 8px #ffa500;
    }

    .navbar nav {
      display: flex;
      gap: 20px;
      flex-grow: 1;
    }

    .navbar nav a {
      text-decoration: none;
      color: #a9c4ff;
      font-weight: 700;
      padding: 10px 15px;
      border-radius: 8px;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    .navbar nav a:hover,
    .navbar nav a.active {
      background-color: #ffa500;
      color: #0a2e5d;
      box-shadow: inset 4px 0 0 #cc8400;
    }

    .user-info {
      display: flex;
      align-items: center;
      gap: 10px;
      color: #fff;
      font-weight: 600;
      font-size: 1.2rem;
      margin-right: 20px;
    }

    .user-info svg {
      width: 28px;
      height: 28px;
      fill: #ffa500;
      filter: drop-shadow(0 0 1px #fff);
    }

    .logout-btn {
      background-color: #d43c3c;
      color: white;
      font-weight: 700;
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      text-decoration: none;
      user-select: none;
    }

    .logout-btn:hover {
      background-color: #b13030;
    }

    .container {
      max-width: 800px;
      margin: 50px auto;
      background: white;
      padding: 40px 30px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgb(0 0 0 / 0.1);
      display: flex;
      flex-direction: column;
      gap: 40px;
      align-items: center;
    }


    .header {
      text-align: center;
    }

    .header h6 {
      font-weight: 600;
      color: #0a2e5d;
      font-size: 1.6rem;
      margin-bottom: 10px;
    }

    .mot {
      letter-spacing: 6px;
      color: #d68c02;
      font-weight: bold;
      font-size: 2.4rem;
    }


    .dashboard-cards {
      display: flex;
      flex-direction: column;
      gap: 25px;
      width: 100%;
    }

    .dasch {
      padding: 30px;
      border-radius: 16px;
      color: white;
      text-align: center;
      box-shadow: 0 6px 12px rgb(0 0 0 / 0.15);
      transition: transform 0.3s ease;
    }

    .dasch:nth-child(1) {
      background-color: #0a2e5d;
    }

    .dasch:nth-child(2) {
      background-color: #ffa500;
      color: #0a2e5d;
      font-weight: 700;
    }

    .dasch:nth-child(3) {
      background-color: #d43c3c;
    }

    .dasch:nth-child(4) {
      background-color: #4a90e2;
    }

    .dasch:hover {
      transform: scale(1.07);
      filter: brightness(1.1);
    }

    .dasch h2 {
      font-weight: 700;
      font-size: 1.8rem;
      margin-bottom: 15px;
      color: white;
    }

    .dasch h3 {
      font-size: 3rem;
      font-weight: 900;
      letter-spacing: 1.5px;
      color: white;
    }
  </style>
</head>

<body>

  <header class="navbar">
    <div class="logo">GYM <span class="highlight">Y&J&F</span></div>
    <nav>
      <a href="home.php" class="active">Dashboard</a>
      <a href="members.php">Members</a>
      <a href="subscriptions.php">Subscriptions</a>
    </nav>
    <div class="user-info">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z" />
      </svg>
      <?php echo  $username; ?>
    </div>
    <a href="login.php" class="logout-btn">Logout</a>
  </header>

  <main class="container">
    <div class="header">
      <h2 class="mot">TRAIN HARD - STAY STRONG</h2>
    </div>

    <section class="dashboard-cards">
      <div class="dasch">
        <h2>Total Members</h2>
        <?php 
        include("conn.php") ;
        $req = $conn->prepare("SELECT COUNT(cin) FROM `memb`");
        $req->execute();
        $total = $req->fetch();
        echo "<h3>".$total[0]."<h3>";
        
        ?>
      </div>
      <div class="dasch">
        <h2>Expiring Soon</h2>
        <?php 
          $req = $conn->prepare('SELECT COUNT(cin) FROM memb where date_fin> CURDATE() and date_fin <= DATE_ADD(CURDATE() , INTERVAL 5 DAY ) ;');
          $req->execute();
          $tab = $req->fetch();
          echo '<h3>'.$tab[0].'<h3>';
        
        
        ?>
      </div>
      <div class="dasch">
        <h2>Expired</h2>
        <?php 
                $req = $conn->prepare('SELECT COUNT(cin) FROM memb where date_fin < CURDATE();');
                $req->execute();
                $tab = $req->fetch();
                echo '<h3>'.$tab[0].'<h3>';
        ?>
      </div>
      <div class="dasch">
        <h2>New This Month</h2>
        <?php 
        $req = $conn->prepare('SELECT COUNT(cin) FROM `memb` WHERE MONTH(date_debut)=MONTH(CURDATE())');
        $req->execute();
        $tab = $req->fetch();
        echo '<h3>'.$tab[0].'<h3>';
        ?>
      </div>
    </section>
  </main>

</body>

</html>