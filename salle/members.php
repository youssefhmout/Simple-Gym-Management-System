<?php
session_start();
  include('conn.php');
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
  <title>GYM Y&J - Subscribers</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap');

    /* Reset & base */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #333;
    }

    body {
      width: 100%;
      background-color: #f0f0f0;
      min-height: 100vh;
    }

    /* Navbar top */
    .navbar {
      width: 100%;
      background-color: #0a2e5d;
      /* أزرق غامق */
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
      /* برتقالي */
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
      /* أزرق فاتح */
      font-weight: 700;
      padding: 10px 15px;
      border-radius: 8px;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    .navbar nav a:hover,
    .navbar nav a.active {
      background-color: #ffa500;
      /* برتقالي */
      color: #0a2e5d;
      /* أزرق غامق */
      box-shadow: inset 4px 0 0 #cc8400;
    }

    /* اسم المستخدم مع أيقونة */
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

    /* زر الخروج */
    .logout-btn {
      background-color: #d43c3c;
      /* أحمر */
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
      background: #fff;
      color: #0a2e5d;
      border-radius: 8px;
      box-shadow: 0 0 15px rgb(0 0 0 / 0.1);
      width: 90%;
      max-width: 1000px;
      padding: 40px 30px;
      margin: 20px auto 50px auto;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    h1 {
      letter-spacing: 6px;
      color: #d68c02;
      font-weight: bold;
      font-size: 2.4rem;
      text-align: center;
      margin-bottom: 10px;
    }

    /* Table styling */
    table {
      width: 100%;
      border-collapse: collapse;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 0 5px 5px rgba(0, 0, 0, 0.15);
    }

    thead {
      background-color: #0a2e5d;
      color: #ffa500;
    }

    th,
    td {
      padding: 15px 20px;
      text-align: center;
      border-bottom: 1px solid #ddd;
      font-weight: 600;
      color: #ffffffb1;
    }

    td {
      color: #0a2e5db9;
      ;
    }

    tbody tr:hover {
      background-color: #e9e6e6;
      color: #0a2e5d;
    }

    button {
      background-color: #ffa500;
      border: none;
      color: #0a2e5d;
      font-weight: 700;
      padding: 8px 14px;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      margin: 0 3px;
      font-family: 'Poppins', sans-serif;
      letter-spacing: 2px;
    }

    button:hover {
      background-color: #d68c02;
      color: #fff;
    }

    .delete-btn {
      background-color: #d43c3c;
      color: #fff;
    }

    .delete-btn:hover {
      background-color: #a73030;
    }

    .tous {
      background-color: #0a2e5d;
      color: #fff;

    }

    .members {
      letter-spacing: 10px;
      margin-bottom: 12px;

    }
    form{
      display: flex;
      flex-direction: row;
      justify-content: center;
      align-items: center;

    }
    .searchcin{
      border: solid 2px gray;
      border-radius:15px;
      padding-left: 10px;
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: space-between;
    }
    .search{
      border: none;
      outline:none ;
      border-right: solid 1px gray;

    }
    #raja{
      background-color: transparent;
      height: 36px;
      overflow:hidden;
      transform: translateY(-5px);
    }
    #icon{
      color: #cc8400;
      font-size: 1.4rem;
      padding: -10px;
    }


  </style>
</head>

<body>

  <header class="navbar">
    <div class="logo">GYM <span class="highlight">Y&J&F</span></div>
    <nav>
      <a href="home.php">Dashboard</a>
      <a href="members.php" class="active">Members</a>
      <a href="subscriptions.php">Subscriptions</a>
    </nav>
    <div class="user-info">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z" />

      </svg>
      <?php echo $username ?>
    </div>
    <a href="login.php" class="logout-btn">Logout</a>
  </header>


  <main class="container">
    <h1>Subscribers List</h1>
    <div class="members">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
      <button type="submit" class="tous" name="total">Total Members</button>
      <button type="submit" name="soon">Expiring Soon</button>
      <button type="submit" class="delete-btn" name="ex">Expired</button>
      <div class="searchcin">
        <input list="list" placeholder="search cin" name="ser" class="search">
        <button type="submit" id="raja" name="search"><i class="bi bi-search" id="icon"></i>

      </div>
</button>
      <datalist id="list">
        <?php 
          
          $req = $conn->prepare('SELECT `cin` FROM memb');
          $req->execute();
          $tab = $req->fetchAll(PDO::FETCH_ASSOC);
          foreach($tab as $i) :?>
          <option value="<?php echo $i['cin'] ;?>" >
            <?php endforeach ; ?>
      </datalist>
    </form>
    </div>

    <table>
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>CIN</th>
          <th>Age</th>
          <th>Date Debut</th>
          <th>Date Fin</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
          <?php

          $html = ""; 
          $button =0 ;
          if(isset($_POST["total"])){
            $button=0 ;
          }
          if(isset($_POST["soon"])){
            $button=1 ;
          }
          if(isset($_POST["ex"])){
            $button=2 ;
          }
          if($button==0){

          
          $req = $conn->prepare('SELECT * FROM memb');
          $req->execute();
          $tab = $req->fetchAll(PDO::FETCH_ASSOC);
          }
          if($button==1){

          
          $req = $conn->prepare('SELECT * FROM memb where date_fin> CURDATE() and date_fin <= DATE_ADD(CURDATE() , INTERVAL 5 DAY ) ;');
          $req->execute();
          $tab = $req->fetchAll(PDO::FETCH_ASSOC);
          }
                if($button==2){
                $req = $conn->prepare('SELECT * FROM memb where date_fin < CURDATE();');
                $req->execute();
                $tab = $req->fetchAll(PDO::FETCH_ASSOC);
          }

          if(isset($_POST["search"])){
            $cins=$_POST["ser"] ;
            if(!empty($cins))
            {
                $req = $conn->prepare('SELECT * FROM memb where cin=?');
                $req->execute([$cins]);
                $tab = $req->fetchAll(PDO::FETCH_ASSOC);
            }
            else{
              echo "<script> alert('option vide !')</script>" ;
            }


          }
          if($tab){
             foreach($tab as $i){
            $nom = $i["nom"];
            $prenom = $i['prenom'];
            $age = $i['age'];
            $cin = $i["cin"];
            $dtd = $i['date_debut'];
            $dtf = $i['date_fin'];
              $html .= "<tr>
                      <td>$prenom</td>
                      <td>$nom</td>
                      <td>$cin</td>
                      <td>$age</td>
                      <td>$dtd</td>
                      <td>$dtf</td>
                      <td>
                      <form method='post' action='modify.php'>
                        <button type='submit' name='edit' value='$cin'>Edit</button>
                         
            <button type='submit'class='delete-btn' name='delete' value='$cin'>Delete</button></form>
          </td>
          </tr>";
              
          }
            echo $html;
            }
            ?>
            



      </tbody>
    </table>
  </main>


</body>

</html>