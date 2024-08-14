<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Glegoo:wght@400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    <title>Home Page</title>

  </head>
  <body>
    <header>
      <!--NAVBAR-->
      <div class="navbar">
        <div class="logo"><a href="index.php">Notsy</a></div>
        <ul class="links">
          <li><a href="index.php" class="active">Home</a></li>
          <li><a href="About.php">About</a></li>
          <li><a href="Services.php">Services</a></li>
          <li><a href="Feedbacks.php">Feedbacks</a></li>
        </ul>
        <a href="login.php" class="action_btn">Get Started</a>
        <div class="toggle_btn"><i class="fa-solid fa-bars"></i></div>
      </div>

      <!--DROPDOWN BURGER MENU-->
      <div class="dropdown_menu">
        <ul>
          <li><a href="index.php" class="active">Home</a></li>
          <li><a href="About.php">About</a></li>
          <li><a href="Services.php">Services</a></li>
          <li><a href="Feedbacks.php">Feedbacks</a></li>
          <li><a href="login.php">Get Started</a></li>
        </ul>
      </div>
    </header>

    <main>
      <!--BELOW NAVBAR THE FOLD-->
      <section id="hero">
        <h1>From thoughts to tasks, <br>we've got you covered.</h1>
        <br>
        <a href="login.php" class="action_btn1" style="text-align: center;">Get Started</a>

        <!--OVERLAY IMAGE-->
        <img src="images/1814.png" alt=" " class="overlay" width="850" height="420">
      </section>
    </main>

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

    <!-- PAGE CONTENT ONE -->
    <div class="image-container">
      <img src="images/organized.jpg" alt="Sample Image" class="cropped-image">
      <div class="inscription">
        <h1 style="color: black;">Organize Your Life</h1>
        <p style="color: black;">Keep everything in order—passwords, files, shopping lists, and more. Stay organized and never miss a thing.</p>
      </div>
    </div>

    <!--PAGE CONTENT TWO-->
    <div class="image-container2">
      <img src="images/security.jpg" alt="Sample Image" class="cropped-image2">
      <div class="inscription2">
        <h1>Protect Your Data</h1>
        <p>Keep your information safe and secure. We take strong measures to protect your data from unauthorized access, ensuring that your personal details remain private and secure.</p>
      </div>
    </div>

    <!--PAGE CONTENT THREE-->
    <div class="image-container3">
      <img src="images/collaborate.jpg" alt="Sample Image" class="cropped-image3">
      <div class="inscription3">
        <h1 style="color: black;">Collaborate & Share</h1>
        <p style="color: black;">We value your feedback! Share your thoughts and ideas with us to help improve our service. Your input helps us create better interactions and ensure a seamless experience for everyone.</p>
      </div>
    </div>

    <!--FOOTER-->
    <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="footer-col">
            <h4>company</h4>
            <ul>
              <li><a href="#">about us</a></li>
              <li><a href="#">our services</a></li>
              <li><a href="#">privacy policy</a></li>
              <li><a href="#">affiliate program</a></li>
            </ul>
          </div>
          <div class="footer-col">
            <h4>get help</h4>
            <ul>
              <li><a href="#">FAQ</a></li>
              <li><a href="#">shipping</a></li>
              <li><a href="#">returns</a></li>
              <li><a href="#">order status</a></li>
              <li><a href="#">payment options</a></li>
            </ul>
          </div>
          <div class="footer-col">
            <h4>online shop</h4>
            <ul>
              <li><a href="#">watch</a></li>
              <li><a href="#">bag</a></li>
              <li><a href="#">shoes</a></li>
              <li><a href="#">dress</a></li>
            </ul>
          </div>
          <div class="footer-col">
            <h4>follow us</h4>
            <div class="social-links">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
              <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!--SCROLL TO TOP WITH SCRIPT-->
    <div onclick="scrollToTop()" class="scrollTop">Top</div>
    <script>
      function scrollToTop(){
        window.scrollTo(0, 0);
      }
    </script>


    
  </body>
</html>
