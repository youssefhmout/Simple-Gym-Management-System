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
  <title>Subscriptions Members - GYM Y&J</title>
  <style>
    /* Reset */
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


    /* Container */
    .container {
      max-width: 600px;
      background-color: #fff;
      margin: 40px auto;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 0 20px rgb(0 0 0 / 0.1);
    }

    .container h1 {
      text-align: center;
      font-size: 2rem;
      color: #0a2e5d;
      margin-bottom: 30px;
      font-weight: 900;
      letter-spacing: 2px;
      text-transform: uppercase;
    }

    form div {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: 700;
      color: #0a2e5d;
      font-size: 1.1rem;
    }

    input[type="text"],
    input[type="number"],
    input[type="date"] {
      width: 100%;
      padding: 12px 15px;
      border: 2px solid #0a2e5d;
      border-radius: 8px;
      font-size: 1rem;
      transition: border-color 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="number"]:focus,
    input[type="date"]:focus {
      border-color: #ffa500;
      outline: none;
    }

    #button {
      display: block;
      width: 100%;
      padding: 15px;
      background-color: #0a2e5d;
      color: white;
      font-weight: 900;
      font-size: 1.2rem;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      margin-top: 10px;
    }

    #button:hover {
      background-color: #ffa500;
      color: #0a2e5d;
    }
  </style>
</head>

<body>
  <header class="navbar">
    <div class="logo">GYM <span class="highlight">Y&J</span></div>
    <nav>
      <a href="home.php">Dashboard</a>
      <a href="members.php">Members</a>
      <a href="subscriptions.php" class="active">Subscriptions</a>
    </nav>
    <div class="user-info">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z" />
      </svg>
      <?php echo  $username; ?>
    </div>
    <a href="login.php" class="logout-btn">Logout</a>
  </header>

  <div class="container">
    <?php
    include('conn.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST["name"];
      $last = $_POST["last"];
      $cin = $_POST["cin"];
      $age = $_POST["age"];
      $date_d = $_POST["start"];
      $date_f = $_POST["end"];


      $sql = $conn->prepare("INSERT into memb values ( ? ,? , ? , ? , ? , ?) ;");
      $sql->execute([$name, $last, $cin, $age , $date_d, $date_f,]);

      echo "<script>
                alert('Succsess Subscriptions ')
            </script>";
    }
    ?>
    <h1>SUBSCRIPTIONS MEMBERS</h1>
    <form method="post" action="<?php echo ($_SERVER['PHP_SELF']); ?>">
      <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" placeholder="Enter name" />
      </div>
      <div>
        <label for="last">Last Name:</label>
        <input type="text" name="last" id="last" placeholder="Enter last name" />
      </div>
      <div>
        <label for="cin">CIN:</label>
        <input type="text" name="cin" id="cin" placeholder="Enter CIN" />
      </div>
      <div>
        <label for="age">Age:</label>
        <input type="number" name="age" id="age" placeholder="Enter age" />
      </div>
      <div>
        <label for="start_date">Subscription Start Date:</label>
        <input type="date" id="start_date" name="start" required  />

      </div>

      <div>
        <label for="end_date">Subscription End Date:</label>
        <input type="date" id="end_date" name="end" required />
      </div>
      <input type="submit" value="Save" id="button" />
    </form>
  </div>
</body>

</html>