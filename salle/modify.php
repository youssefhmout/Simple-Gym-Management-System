<?php
session_start();
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
} else {
  header("Location: login.php");
  exit();
} ?>
<?php
    include('conn.php');
    $nom = "" ; $prenom ; $cn = "" ; $age = '' ; $dtd = '' ; $dtf = '';
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            if (isset($_POST['delete'])){
                $cin = $_POST['delete'];
                $req = $conn->prepare("DELETE FROM memb where cin=?");
                $req->execute([$cin]);
                header("location:members.php");
                exit();
            }
            if(isset($_POST['edit'])){
                $cin = $_POST['edit'];
                $req = $conn->prepare("SELECT * FROM memb where `cin` = ?");
                $req->execute([$cin]);
                $tab = $req->fetch(PDO::FETCH_ASSOC);
                if ($tab){
                    $nom = $tab['nom'];$prenom = $tab['prenom'];$age=$tab['age']; $cn= $tab['cin'];
                    $dtd=$tab['date_debut'];$dtf=$tab['date_fin'];
                    

                }
                
                
                

            }

            
        }
    if(isset($_POST['modifier'])){
        $nm = $_POST['name']??'';$pr = $_POST['last'] ?? "";$ag = $_POST['age']??'';$cine = $_POST['cin']??'' ;
        $datde = $_POST['start']??""; $datfin = $_POST['end'] ?? "";
        if(!empty($nm) && !empty($pr) && !empty($cine) && !empty($ag) && !empty($datde) && !empty($datfin)){
            try{
                $req = $conn->prepare("UPDATE memb SET prenom = ? , nom = ? ,  cin = ? , age = ? , date_debut=? , date_fin = ? WHERE cin = '$cine' ;");
                $req->execute([$pr , $nm , $cine,$ag ,$datde,$datfin]);
                echo "<script>alert('Member Modified !!!!!') ; window.location.href = 'members.php';</script>";
            
            }catch(PDOException $error){
                die("hona   " .$error->getMessage());
            }
            
        }

    }
    
          
          
      ?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
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
    <div class="logo">GYM <span class="highlight">Y&J&F</span></div>
    <nav>
      <a href="home.php">Dashboard</a>
      <a href="members.php">Members</a>
      <a href="subscriptions.php" >Subscriptions</a>
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
        <h1>Modify MEMBER</h1>


         <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
      <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" placeholder="Enter name" value="<?php echo $nom ;?>" />
      </div>
      <div>
        <label for="last">Last Name:</label>
        <input type="text" name="last" id="last" placeholder="Enter last name" value="<?php echo $prenom ;?>"/>
      </div>
      <div>
        <label for="cin">CIN:</label>
        <input type="text" name="cin" id="cin" placeholder="Enter CIN" value="<?php echo $cn ;?>" />
      </div>
      <div>
        <label for="age">Age:</label>
        <input type="number" name="age" id="age" placeholder="Enter age" value="<?php echo $age ;?>"/>
      </div>
      <div>
        <label for="start_date">Subscription Start Date:</label>
        <input type="date" id="start_date" name="start" required  value="<?php echo $dtd; ?>" />

      </div>

      <div>
        <label for="end_date">Subscription End Date:</label>
        <input type="date" id="end_date" name="end" required value="<?php echo $dtf ;?>"/>
      </div>
      <input type="submit" value="Modifier" id="button" name="modifier" />
    </form>
  </div>
      </body>
      </html>
      
   











