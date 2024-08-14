
<?php
session_start();
require_once 'db_connection.php'; // Include your PDO connection script

// Generate and store CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Securely fetch and sanitize user input
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $csrf_token = filter_input(INPUT_POST, 'csrf_token', FILTER_SANITIZE_STRING);

    // Validate CSRF token
    if (!isset($_SESSION['csrf_token']) || $csrf_token !== $_SESSION['csrf_token']) {
        die("Invalid CSRF token.");
    }

    try {
        // Prepare the SQL statement to insert the new user
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        
        // Bind the username and password parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_BCRYPT));
        
        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to the login page after successful signup
            header("Location: login.php");
            exit();
        } else {
            echo "Error: Could not execute the query.";
        }
    } catch (PDOException $e) {
        // Handle any errors
        echo "Error: " . $e->getMessage();
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="text.css">
  <title>Sign Up</title>
  <style>
    /* SCROLL TO TOP */
    .scrollTop {
      position: fixed;
      bottom: 30px;
      right: 30px;
      padding: 10px 15px;
      background-color: orange;
      color: #fff;
      border-radius: 20px;
      border-radius: 1px solid #fff;
      cursor: pointer;
      transition: all 0.5s ease 0s;
    }

    .scrollTop:hover {
      background-color: #fff;
      color: orange;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
      scroll-behavior: smooth;
    }

    html, body {
      margin: 0;
      padding: 0;
    }

    li {
      list-style: none;
    }

    a {
      text-decoration: none;
      color: #fff;
      font-size: 1rem;
    }

    a:hover {
      color: orange;
    }

    /* HEADER */
    header {
      position: relative;
      padding: 0 2rem;
    }

    .navbar {
      width: 100%;
      height: 60px;
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .navbar .logo a {
      font-size: 1.5rem;
      font-weight: bold;
    }

    .navbar .links {
      display: flex;
      gap: 2rem;
    }

    .navbar .toggle_btn {
      color: #fff;
      font-size: 1.5rem;
      cursor: pointer;
      display: none;
    }

    .action_btn {
      background-color: orange;
      color: #fff;
      padding: 0.5rem 1rem;
      border: none;
      outline: none;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: bold;
      cursor: pointer;
    }

    .action_btn:hover {
      transform: scale(0.95);
      color: #fff;
    }

    .action_btn:active {
      transform: scale(0.95);
    }

    /* DROPDOWN MENU */
    .dropdown_menu {
      display: none;
      position: absolute;
      right: 2rem;
      top: 60px;
      height: 0;
      width: 300px;
      background: rgb(0, 0, 0);
      backdrop-filter: blur(15px);
      border-radius: 20px;
      overflow: hidden;
      transition: height 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .dropdown_menu.open {
      height: 270px;
      width: 240px;
    }

    .dropdown_menu li {
      padding: 0.9rem;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* Add this to highlight the active link */
    .navbar .links a.active,
    .dropdown_menu a.active {
      color: orange;
      border-bottom: 2px solid orange; /* Optional: Add an underline */
    }

    /* RESPONSIVE DESIGN */
    @media (max-width: 992px) {
      .navbar .links,
      .navbar .action_btn {
        display: none;
      }

      .navbar .toggle_btn {
        display: block;
      }

      .dropdown_menu {
        display: block;
      }
    }

    /* Styling for the navbox */
    .navbox {
      width: 100%;
      margin: 0 auto;
      padding: 1rem;
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 50px;
      overflow: hidden;
    }

    .navbox .navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .navbox .logo a {
      font-size: 1.5rem;
      color: #000;
      font-family: "poppins", sans-serif;
    }

    .navbox .links {
      display: flex;
      gap: 2rem;
    }

    .navbox .links a {
      color: #000;
    }

    .navbox .links a:hover {
      color: orange;
    }

    .navbox .action_btn {
      background-color: orange;
      color: #fff;
      padding: 0.5rem 1rem;
      border: none;
      outline: none;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: bold;
      cursor: pointer;
    }

    .navbox .action_btn:hover {
      transform: scale(0.95);
      color: #fff;
    }

    .navbox .action_btn:active {
      transform: scale(0.95);
    }

    .navbox .toggle_btn {
      color: #000;
      font-size: 1.5rem;
      cursor: pointer;
      display: none;
    }

    @media (max-width: 992px) {
      .navbox .links,
      .navbox .action_btn {
        display: none;
      }

      .navbox .toggle_btn {
        display: block;
      }

      .dropdown_menu {
        display: block;
      }
    }

    /* SIGN UP PAGE STYLING */
    .signup-container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: calc(100vh - 60px); /* Adjust height to account for the navbar */
      padding: 2rem;
      background-color: #f9f9f9; /* Light background color */
    }

    .signup-box {
      background-color: #fff;
      padding: 2rem;
      border-radius: 30px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      width: 100%;
    }

    .signup-box h2 {
      margin-bottom: 1rem;
      font-size: 2rem;
      font-weight: normal;
      color: orange;
      text-align: center;
    }

    .textbox {
      margin-bottom: 1.5rem; /* Adjust spacing between fields */
    }

    .textbox input {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #ddd;
      border-radius: 30px;
      font-size: 1rem;
    }

    .signup-btn {
      width: 100%;
      padding: 0.75rem;
      border: none;
      border-radius: 30px;
      background-color: orange;
      color: #fff;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .signup-btn:hover {
      background-color: white;
      color: orange;
      border: 1px solid orange;
    }

    .login-link {
      margin-top: 1rem;
      text-align: center;
    }

    .login-link a {
      color: orange;
      text-decoration: none;
    }

    .login-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <header>
    <!--NAVBAR-->
    <div class="navbox">
      <div class="navbar">
        <div class="logo"><a href="index.php">Notsy</a></div>
        <ul class="links">
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="services.php">Services</a></li>
          <li><a href="feedbacks.php">Feedbacks</a></li>
        </ul>
        <a href="login.php" class="action_btn">Or Login</a>
        <div class="toggle_btn"><i class="fa-solid fa-bars"></i></div>
      </div>

      <!--DROPDOWN BURGER MENU-->
      <div class="dropdown_menu">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="services.php">Services</a></li>
          <li><a href="feedbacks.php">Feedbacks</a></li>
          <li><a href="login.php">Or Login</a></li>
        </ul>
      </div>
    </div>
  </header>

  <!--SCRIPT FOR DROPDOWN BURGER MENU-->
  <script>
    const toggleBtn = document.querySelector('.toggle_btn');
    const toggleBtnIcon = document.querySelector('.toggle_btn i');
    const dropDownMenu = document.querySelector('.dropdown_menu');

    toggleBtn.onclick = function() {
      dropDownMenu.classList.toggle('open');
      const isOpen = dropDownMenu.classList.contains('open');
      toggleBtnIcon.classList = isOpen
        ? 'fa-solid fa-xmark'
        : 'fa-solid fa-bars'; }
  </script>

  <!--SCROLL TO TOP WITH SCRIPT-->
  <div onclick="scrollToTop()" class="scrollTop">Top</div>
  <script>
    function scrollToTop(){
      window.scrollTo(0, 0);
    }
  </script>

<!-- SIGN UP PAGE CONTENT -->
<main class="signup-container">
    <div class="signup-box">
      <h2>Sign Up</h2>
      <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
      <?php endif; ?>
      <form action="" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
        <div class="textbox">
          <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="textbox">
          <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="signup-btn">Sign Up</button>
        <p class="login-link">Already have an account? <a href="login.php">Login</a></p>
      </form>
    </div>
  </main>


</body>
</html>
